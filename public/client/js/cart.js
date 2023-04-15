function changeQty(val, id)
{
    if (val != "" && val <= 0) {
        swal({ title: 'Số lượng tối thiểu là 1', type: 'error' });
    }

    if (!Number(val) || window.event.keyCode == 8) {
        return;
    }

    $.ajax({
        url: '/change-qty',
        type: 'GET',
        data: {
            'qty': val,
            'id': id
        },
        success: function(response) {
            if(response.status == 200) {
                $('#qty_cart').html(response.totalQty);
                $('#cart-total').html(`Tổng tiền<span>${response.totalPrice}</span>`);
                $(`#cart-item-total-${response.productId}`).html(response.price);
                $('#price_cart').html(response.totalPrice);
            }
        }
    });
}