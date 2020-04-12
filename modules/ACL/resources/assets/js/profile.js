$("#birthday").datetimepicker({format: 'YYYY-MM-DD'});
const rateUserBtn = '.rateUserBtn';
const rateHidden = '#rateHidden';
$(document).on('click', rateUserBtn, function () {
    const self = $(this);
    const start = self.attr('data-start');
    $(rateHidden).val(start);
});

$('#coin').magicFormatNumber('#number')

function errorMessage(errors) {
    let errorMessages = '';
    for (let errorName in errors) {
        for (let error of errors[errorName]) {
            errorMessages += error + "<br/>";
        }
    }
    return errorMessages;
}

const backupBtn = '#backupBtn';
const privateKeyRoute = '#privateKeyRoute';

$(backupBtn).click(function () {
    const url = $(privateKeyRoute).val();
    $.ajax({
        url: url,
        method: 'GET',
        success: function (privateKey) {
            const mnemonic = decryptMnemonic(privateKey);
            $('#mnemonicTxt').val(mnemonic);
            $('#qrCoeRecovery').html('').qrcode({
                size: '200',
                render: 'image',
                text: mnemonic
            });
        }
    })
});

const Enable2stepBtn = '#Enable2stepBtn';
const TwoStepTxt = '#TwoStepTxt';
const TowStepQrImage = '#TowStepQrImage';
const createOtpRoute = '#createOtpRoute';

$(Enable2stepBtn).click(function () {
    const url = $(createOtpRoute).val();
    $.ajax({
        url: url,
        method: 'POST',
        success: function (data) {
            console.log(data);
            $(TwoStepTxt).val(data.key);
            $(TowStepQrImage).html(`<img src="${data.url}" style="margin: auto" alt="code qr" id="TowStepQrImage" class="img-responsive">`)
        },
        error: function (error) {
            console.log(error);
            toastr.error(error.responseJSON.message);
        }
    })
});

const twoStep = '#twoStep';
const twoStepBtn = '#twoStepBtn';
const twoStepEnable = '#twoStepEnable';
const twoStepEnableForm = '#twoStepEnableForm';
const twoStepDisableForm = '#twoStepDisableForm';

$(twoStepEnableForm).submit(function (e) {
    e.preventDefault();
    if ($(twoStepEnableForm).valid()) {
        const self = $(this);
        const data = self.serialize();
        const url = self.attr('action');
        $.ajax({
            url: url,
            method: 'POST',
            data: data,
            success: function (data) {
                toastr.success('Enable 2-step success', '', 10000);
                $(twoStepEnableForm).modal('show');
                location.reload();
            },
            error: function (error) {
                const errors = error.responseJSON.errors;
                let errorMessages = errorMessage(errors);
                toastr.error(errorMessages, 'Errors', 10000);
            }
        })
    }
});

$(twoStepBtn).click(function () {
    $(twoStep).modal('hide');
    setTimeout(function () {
        $(twoStepEnable).modal('show');
    }, 500);
});

// $(twoStepEnableForm).validate({
//     rules: {
//         otp: {
//             required: true,
//         },
//     }
// });
//
// $(twoStepDisableForm).validate({
//     rules: {
//         otp: {
//             required: true,
//         },
//     }
// });

$(twoStepDisableForm).submit(function (e) {
    e.preventDefault();
    if ($(twoStepDisableForm).valid()) {
        const self = $(this);
        const data = self.serialize();
        const url = self.attr('action');
        $.ajax({
            url: url,
            method: 'POST',
            data: data,
            success: function (data) {
                toastr.success('Disable 2-step success', '', 10000);
                $(twoStepDisableForm).modal('show');
                location.reload();
            },
            error: function (error) {
                const errors = error.responseJSON.errors;
                let errorMessages = errorMessage(errors);
                toastr.error(errorMessages, 'Errors', 10000);
            }
        })
    }
});

function copyToClipboard(element) {
    var copyText = document.getElementById(element);
    copyText.select();
    document.execCommand("copy");
    toastr.success('Copied', '', 10000);
}
