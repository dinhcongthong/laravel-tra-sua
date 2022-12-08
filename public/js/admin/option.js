$(document).ready(function () {
    updateOption();
});

function updateOption() {
    $('.category-edit').on('click', function (e) {
        e.preventDefault();

        let optionCategoryId = $(this).data('id');
        let optionCategoryName = $(this).data('name');
        var html = `
            <div class="d-flex">
                <input type="text" class="form-control me-3 w-75" value="${optionCategoryName}">
                <a href="#" class="option-update btn btn-success">Cập nhật</a>
            </div>
        `;
        $(this).parents('.category-items').append(html);
        $(this).parents('.d-flex').addClass('d-none');

        $('.option-update').on('click', function (e) {

        });

        if (postUpdate(url, newOptionCategoryName)) {
            toastr.success('Cập nhật thành công');
            return;
        }
        toastr.error('Cập nhật thất bại');
    });
}

function postUpdate (url, name) {
    $.ajax({
        url,
        method: "POST",
        data: {
            name
        }
    })
    .done(function (response) {
        if (response.success) {
            return true;
        }
        return false;
    })
    .fail(function (xhr, status, error) {
        return false;
    })
}
