$(document).ready(function () {
    updateOption();
});

function updateOption() {
    $('.category-edit').on('click', function (e) {
        e.preventDefault();
        $('.category-edit').addClass('d-none');

        let optionCategoryId = $(this).data('id');
        let optionCategoryName = $(this).data('name');
        let url = $(this).data('url');
        var html = `
            <div class="d-flex new-category${optionCategoryId}">
                <input type="text" id="new_category_${optionCategoryId}" class="form-control me-3 w-75" value="${optionCategoryName}">
                <a href="#" class="option-update btn btn-success">Cập nhật</a>
            </div>
        `;
        $(this).parents('.category-items').append(html);
        $(this).parents('.d-flex').addClass('d-none');

        $('.option-update').on('click', function (e) {
            let newOptionCategoryName = $(this).parents('.category-items').find('.new-category' + optionCategoryId + ' input').val();

            postUpdate(url, newOptionCategoryName);
            $('.new-category' + optionCategoryId).remove();
            $('.category' + optionCategoryId + '> a').text(newOptionCategoryName);
            $('.category' + optionCategoryId).removeClass('d-none');
            $('.category-edit').removeClass('d-none');
        });
    });
}

function postUpdate(url, name) {
    $.ajax({
        url,
        method: "POST",
        data: {
            name
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
