$(function() {
    changeOrderStatus();
    getOrderDetail();
    checkAllOrders();
});

function changeOrderStatus() {
    $('.order-status').on('change', function() {
        let statusId = $(this).val();
        let orderId = $(this).data('id');
        let url = $(this).data('url');
        $.ajax({
                method: 'GET',
                url,
                data: {
                    statusId,
                    orderId
                },
                beforeSend: function () {
                    rootLoader.show();
                },
                complete: function () {
                    rootLoader.hide();
                }
            })
            .done(function(res) {
                if (!res.success) {
                    toastr.error('Lỗi cmnr!');
                    return;
                }
                toastr.success(res.message)
            })
            .fail(function(xhr, status, errors) {
                console.log(xhr)
                console.log(status)
                console.log(errors)
            })
    })
}

function getOrderDetail() {
    $('.order-detail').on('click', function (e) {
        e.preventDefault();
        let orderId = $(this).data('id');
        let url = $(this).data('url');
        $.ajax({
            url,
            method: 'GET',
            data: {
                orderId
            },
            beforeSend: function() {
                rootLoader.show();
            },
            complete: function () {
                rootLoader.hide();
            }
        })
        .done(function (res) {
            $('#order_id').text(res.data.id)
            $('#buyer').text(res.data.customer_name)
            let totalPayment = new Intl.NumberFormat('en-IN', { maximumSignificantDigits: 3 }).format(res.data.total_payment) + ' đ'

            $('#total_payment').text(totalPayment)
            $('#phone').text(res.data.customer_phone)
            $('#status').text(res.data.get_status.name)
            $('#status').addClass('badge bg-' + res.data.get_status.color_class)
            $('#note').text(res.data.note)
            $('#order_date').text(res.data.order_date)
            $('#updated_at').text(res.data.updated_at)
            $('#payment_method').text(res.data.get_payment_method.name)
            $('#order_detail_modal').modal('show');
            let html = '';
            html += `<table class="table table-bordered" id="order_item_table">
                        <thead>
                            <th>Sản phẩm</th>
                            <th>Tên</th>
                            <th>Số lượng</th>
                            <th>Ghi chú</th>
                        </thead>
                        <tbody>`;
            res.data.get_order_items.forEach((item) => {
                html += `<tr>
                            <td>
                                <img src="${item.product_img_url}" alt="" width="100">
                            </td>
                            <td>${item.product_name}</td>
                            <td>X${item.qty}</td>
                            <td>${item.note}</td>
                        </tr>`
                    });
            html += `</tbody></table>`;
            $('.modal-body').append(html);
            $("#order_detail_modal").on("hidden.bs.modal", function () {
                $('#order_item_table').remove();
                $('#status').removeClass();
            });

        })
        .fail(function (xhr, status, errors) {
            console.log(xhr)
            console.log(status)
            console.log(errors)
        })
    });
}

function checkAllOrders() {
    $('#check_all_orders').change(function () {
        if (this.checked) {
            $('input[name="order_checked[]"]').prop('checked', true);
        } else {
            $('input[name="order_checked[]"]').prop('checked', false);
        }
    })
    $('input[type="checkbox"]').change(function () {
        if (this.checked) {
            $('#btn_discount').show();
        }
        if ($('input[name="order_checked[]"]:checked').length < 1) {
            $('#btn_discount').hide();
        }
    })
}
