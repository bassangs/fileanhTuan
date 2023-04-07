function addToCart(id) {
    $.ajax({
        url: '/add-to-cart',
        type: 'GET',
        data: {
            'id': id
        },
        success: function(response) {
            if(response.status == 200) {
                $("#qty_cart").html(response.qty);
                $("#price_cart").html(response.price.toLocaleString('it-IT', {style : 'currency', currency : 'VND'}));
                swal({ title: 'Thêm giỏ hàng thành công', type: 'success' });
            }
        }
    });
}