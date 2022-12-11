$(document).ready(function () {

});

function getOptionContent (element, productId) {
    let optionCategoryId = $(element).val();
    $.ajax({
        url: baseUrl + '/products/options/get-option-content/' + optionCategoryId + '/' + productId,
        method: 'GET',
        beforeSend: function() {
            rootLoader.show();
        },
        complete: function () {
            rootLoader.hide();
        }
    })
    .done(function (response) {
        toastr.success(response.message);
        console.log(response);
    })
    .fail(function (xhr, status, err) {
        toastr.error('That Bai cmnr');
    })
}
