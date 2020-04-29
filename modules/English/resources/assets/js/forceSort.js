function forceSort(sort, item, change = 0) {
    let beginNo;
    const itemLength = $(item).length;

    function changeItem(uiItem) {
        let html = $(uiItem).next().html();
        if(html === undefined) {
            html = $(uiItem).prev().html();
            $(item).eq(itemLength - 2).parent('li').remove();
        }
        html = `<li class="list-group-item">${html}</li>`;
        $(uiItem).next().remove();
        if (beginNo === itemLength) {
            $(item).eq(beginNo - 2).parent('li').after(html);
        } else if (beginNo === 1) {
            $(item).eq(0).parent('li').before(html);
        } else {
            $(item).eq(beginNo - 1).parent('li').before(html);
        }
    }

    if (change !== 0) {
        $(sort).sortable({
            revert: true,
            start: function (event, ui) {
                beginNo = parseInt($(ui.item).find('span').text());
                console.log(beginNo);
            },
            stop: function (event, ui) {
                changeItem(ui.item);
                setIds(item);
            }
        });
    } else {
        $(sort).sortable({
            revert: true,
            stop: function (event, ui) {
                setIds(item);
            }
        });
    }
    function setIds(item) {
        $(item).each(function (k) {
            let i = k + 1;
            if(i < 10) {
                i = `&nbsp;&nbsp;${i}`;
            }
            $(this).html(i);
        });
    }
    setIds(item);
}

function setIds(item) {
    $(item).each(function (k) {
        let i = k + 1;
        if(i < 10) {
            i = `&nbsp;&nbsp;${i}`;
        }
        $(this).html(i);
    });
}

const sortable = '#sortable';

const addSectionBtn = '#addSection';
$(addSectionBtn).click(function () {
    const noNew = `<div class="input-group form-group  text-info">
        <span class="input-group-addon no"></span>
        <input type="hidden" value="0" name="section_ids[]">
        <input type="text" name="section_names[]" class="form-control">
        <span class="input-group-addon removeSection text-danger"><i class="glyphicon-remove glyphicon"></i></span>
    </div>`;
    $('#sortable').append(noNew);
    forceSort(sortable, '.no');
});
const removeSectionBtn = '.removeSection';
$(document).on('click', removeSectionBtn, function () {
    $(this).parent('div').remove();
});

const addLessonBtn = '#addLesson';
$(addLessonBtn).click(function () {
    const noNew = `<div class="input-group form-group text-info">
        <span class="input-group-addon no "></span>
        <input type="hidden" value="0" name="lesson_ids[]">
        <input type="text" name="lesson_names[]" class="form-control">
        <span class="input-group-addon removeSection text-danger"><i class="glyphicon-remove glyphicon "></i></span>
    </div>`;
    $('#sortable').append(noNew);
    forceSort(sortable, '.no');
});

const removeLessonBtn = '.removeSection';
$(document).on('click', removeLessonBtn, function () {
    $(this).parent('div').remove();
});

const addCrazyBtn = '#addCrazyBtn';
const addCreateCrazyBtn = '#addCreateCrazyBtn';

let noCrazy = 'a';

$(addCrazyBtn).click(function () {
    newRow(noCrazy);
    noCrazy = String.fromCharCode(noCrazy.charCodeAt(0) + 1);
});

$(addCreateCrazyBtn).click(function () {
    newRow();
});

function newRow(noCrazy = '') {
    const noNew = `
        <tr>
        <td><span class="btn btn-default no"></span></td>
        <td><input type="number" value="0" name="times[${noCrazy}]" required class="form-control"></td>
        <td><input name="sentences[${noCrazy}]" required class="form-control englishInput"></td>
        <td><input name="meanings[${noCrazy}]" required class="form-control"></td>
        <td class="text-right">
            <span class="btn btn-danger removeCrazyBtn"><i class="fa fa-remove"></i></span>
        </td>
        </tr>
    `;

    $('#sortable').append(noNew);
    forceSort(sortable, '.no');
}

const removeCrazyBtn = '.removeCrazyBtn';

$(document).on('click', removeCrazyBtn, function () {
    $(this).parents('tr').remove();
    forceSort(sortable, '.no');
});


const enSortable = '#EnSortable';
const viSortable = '#ViSortable';
const enNo = '.EnNo';
const viNo = '.ViNo';

forceSort(enSortable, enNo);
forceSort(viSortable, viNo);

const changeSort = '#changeSort';

$(changeSort).change(function () {
    const isChange = $(this).val();
    if (isChange) {
        forceSort(enSortable, enNo, 1);
        forceSort(viSortable, viNo, 1);
    } else {
        forceSort(enSortable, enNo);
        forceSort(viSortable, viNo);
    }
});

let isChange = false;

function isSortOrChange(isChange) {
    if (isChange) {
        forceSort(enSortable, enNo, 1);
        forceSort(viSortable, viNo, 1);
        toastr.info('Switch mode to change');
    } else {
        forceSort(enSortable, enNo);
        forceSort(viSortable, viNo);
        toastr.info('Switch mode to sort');
    }
}