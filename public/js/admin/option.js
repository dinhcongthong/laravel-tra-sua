$(document).ready(function () {
    updateOptionCategory();
    updateOption();
});

function updateOptionCategory() {
    $('.category-edit').on('click', function (e) {
        e.preventDefault();
        $('.category-edit').addClass('d-none');

        let optionCategoryId = $(this).data('id');
        let optionCategoryName = $(this).data('name');
        let url = $(this).data('url');
        var html = `
            <div class="d-flex new-category${optionCategoryId}">
                <input type="text" id="new_category_${optionCategoryId}" class="form-control me-3 w-75" value="${optionCategoryName}">
                <a href="#" class="option-category-update btn btn-success">Cập nhật</a>
            </div>
        `;
        $(this).parents('.category-items').append(html);
        $(this).parents('.d-flex').addClass('d-none');

        $('.option-category-update').on('click', function (e) {
            let newOptionCategoryName = $(this).parents('.category-items').find('.new-category' + optionCategoryId + ' input').val();

            postUpdate(url, newOptionCategoryName);
            $('.new-category' + optionCategoryId).remove();
            $('.category' + optionCategoryId + '> a').text(newOptionCategoryName);
            $('.category' + optionCategoryId).removeClass('d-none');
            $('.category-edit').removeClass('d-none');
        });
    });
}

function updateOption () {
    $('.option-edit').on('click', function (e) {
        e.preventDefault();

        $('.option-edit').addClass('d-none');
        let optionId = $(this).data('id');
        let optionName = $(this).data('name');
        let url = $(this).data('url');
        let html = `
            <div class="d-flex new-option${optionId}">
                <input type="text" id="new_option${optionId}" class="form-control me-3 w-75" value="${optionName}">
                <a href="#" class="option-update btn btn-success">Cập nhật</a>
            </div>
        `;
        $(this).parents('.option-items').append(html);
        $(this).parents('.d-flex').addClass('d-none');

        $('.option-update').on('click', function () {
            let newOptionName = $('#new_option' + optionId).val();
            console.log(newOptionName);
            postUpdate(url, newOptionName);

            $('.new-option' + optionId).remove();
            $('.option' + optionId + '> p').text(newOptionName);
            $('.option' + optionId).removeClass('d-none');
            $('.option-edit').removeClass('d-none');
        })
    })
}


function postUpdate(url, name) {
    $.ajax({
        url,
        method: "POST",
        data: {
            name
        },
        beforeSend: function () {
            rootLoader.show();
        },
        complete: function () {
            rootLoader.hide();
        }
    })
    .done(function (response) {
        if (response.success) {
            toastr.success('Cập nhật thành công');
        }
    })
    .fail(function (xhr, status, error) {
        toastr.error('Cập nhật thất bại');
    })
}

async function saveNewOptionCategory () {
    let newOptionCategoryName = $('#create_option_category').val();
    let url = baseUrl + '/products/options/update-category/0';
    await postUpdate(url, newOptionCategoryName);
    location.reload();
}

async function saveNewOption (categoryName, categoryId, url) {
    let newOptionName = $('#create_option').val();

    let title = 'Thêm một ' + categoryName + ' mới'
    $('#optionNewLabel').text(title);

    $('#btn_save_new_option').on('click', function (e) {
        // $.ajax({

        // })
    })
}

function deleteOptionCategory (url, e) {
    e.preventDefault();
    if (confirm('Bạn có chắc chắn muốn xóa hạng mục này không?')) {
        $.ajax({
            method: 'DELETE',
            url,
            beforeSend: function () {
                rootLoader.show();
            },
            complete: function () {
                rootLoader.hide();
            }
        })
        .done(function (response) {
            toastr.success('Thành Công!!!');
            location.reload();
        })
        .fail(function (xhr, status, err) {
            toastr.error('Thất bại cmnr~~~');
        })
    } else {
    }
}
