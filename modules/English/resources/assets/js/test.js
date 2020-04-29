const formTest = '#formTest';
const unsure = '.unsure';
const done = '.done';
const submitEnglishBtn = '#submitEnglishBtn';

$(submitEnglishBtn).click(function () {
  mark();
});

$('#doTest').click(function () {
  const ok = confirm('Bạn thực sự muốn nộp bài?');

  if(ok) {
    $(formTest).submit()
  }
});

function mark() {
    const ok = confirm('Bạn thực sự muốn nộp bài');

    if(ok) {
        const data = $(formTest).serialize();
        $.ajax({
            url: $(formTest).attr('action'),
            method: 'POST',
            data: data,
            success: function (result) {
                $('.EnQ').removeClass('list-group-item-success');
                $('.ViQ').removeClass('list-group-item-success');
                const resultMap = result.data.resultMap;
                const score = result.data.score;
                toastr.info(`Số câu làm đúng là: ${score}`);
                console.log(resultMap);
                for (let i in resultMap) {
                  console.log(i)
                  console.log(resultMap[i])
                    if(resultMap[i]) {

                        $(`.EnQ:eq(${i})`).addClass('list-group-item-success');
                        $(`.ViQ:eq(${i})`).addClass('list-group-item-success');
                    }
                }
            },
            error: function () {
                toastr.error('Server error');
            }
        });
    }
}

$(unsure).change(function () {
    const id = $(this).attr('data');
    const check = '#check' + id;
    if ($(this).is(":checked")) {
        $(done).each(function () {
            if ($(this).attr('data') === id && $(this).is(":checked")) {
                $(check).removeClass('btn-default');
                $(check).removeClass('btn-info');
                $(check).addClass('btn-warning');
                return false;
            } else {
                $(check).removeClass('btn-default');
                $(check).removeClass('btn-info');
                $(check).addClass('btn-danger destroyBtn');
            }
        })
    } else {
        $(done).each(function () {
            if ($(this).attr('data') === id && $(this).is(":checked")) {
                $(check).removeClass('btn-danger destroyBtn');
                $(check).removeClass('btn-warning');
                $(check).addClass('btn-info');
                return false;
            } else {
                $(check).removeClass('btn-danger destroyBtn');
                $(check).removeClass('btn-info');
                $(check).addClass('btn-default');
            }
        })
    }
});

$(done).change(function () {
    const id = $(this).attr('data');
    const check = '#check' + id;
    if ($(this).is(":checked")) {
        $(unsure).each(function () {
            if ($(this).attr('data') === id && $(this).is(":checked")) {
                $(check).removeClass('btn-info');
                $(check).removeClass('btn-default');
                $(check).removeClass('btn-danger destroyBtn');
                $(check).addClass('btn-warning');
                return false;
            } else {
                $(check).removeClass('btn-info');
                $(check).removeClass('btn-default');
                $(check).removeClass('btn-danger destroyBtn');
                $(check).addClass('btn-info');
            }
        });
    }
    else {
        $(unsure).each(function () {
            if ($(this).attr('data') === id && $(this).is(":checked")) {
                $(check).removeClass('btn-info');
                $(check).removeClass('btn-danger destroyBtn');
                $(check).removeClass('btn-warning');
                $(check).addClass('btn-default');
                return false;
            } else {
                $(check).removeClass('btn-info');
                $(check).removeClass('btn-danger destroyBtn');
                $(check).removeClass('btn-warning');
                $(check).addClass('btn-default');
            }
        });
    }
});
