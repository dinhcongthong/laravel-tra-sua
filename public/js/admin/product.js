$(document).ready(function () {
    clearDataWhenModalClosed();
});

function getOptionContent(productId) {
    let optionCategoryId = $('#option_category').val();
    if (optionCategoryId === '') {
        toastr.error('Vui lòng chọn một loại bổ sung!!!');
        return;
    }
    $('#optionModalLabel').text($('#option_category option:selected').text());

    $.ajax({
        url: baseUrl + '/products/options/get-option-content/' + optionCategoryId + '/' + productId,
        method: 'GET',
        beforeSend: function () {
            rootLoader.show();
        },
        complete: function () {
            rootLoader.hide();
        }
    })
    .done(function (response) {
        let result = response.data.result;
        // console.log(result);
        result.forEach(function (item, index) {
            let price = '';
            if (item.get_product_options.length > 0) {
                price = item.get_product_options[0].price;
            }
            let html = `
                <tr>
                    <td>${index + 1}</td>
                    <td>${item.name}</td>
                    <td>
                        <input type="hidden" name="id[]" class="form-control" value="${item.id}">
                        <input type="text" name="price[]" class="form-control" value="${price}">
                    </td>
                </tr>
            `;
            $('#option_table tbody').append(html);
        });
    })
    .fail(function (xhr, status, err) {
        toastr.error('That Bai cmnr');
    })
}

function clearDataWhenModalClosed() {
    $('#optionModal').on('hidden.bs.modal', function () {
        $('#option_table tbody tr').remove();
    })
}

function saveOption(productId) {
    let data = $('#option_form').serializeArray();
    $.ajax({
        method: 'POST',
        url: baseUrl + '/products/options/post-option-content/' + productId,
        data,
        beforeSend: function () {
            rootLoader.show();
        },
        complete: function () {
            rootLoader.hide();
        }
    })
    .done(function (response) {
        toastr.success('Thành công');
        console.log(response);
    })
    .fail(function (xhr, status, error) {
        toastr.error('Thất bại cmnr!!!');
    })
}
