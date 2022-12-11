$(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    previewImage();
    toastrSetting();
});

function previewImage() {
    $('.img-file').change(function () {
        const file = this.files[0];
        if (file) {
            let reader = new FileReader();
            reader.onload = function (event) {
                $('.img-preview').attr('src', event.target.result);
            }
            reader.readAsDataURL(file);
        }
    });
}

function toastrSetting() {
    toastr.options = {
        "closeButton": true,
        "newestOnTop": false,
        "progressBar": true,
        "preventDuplicates": false,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "10000",
        "timeOut": "3000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    }
}
