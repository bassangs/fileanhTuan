function filterProductByBrand(id, e)
{
    $.ajax({
        url: '/filter',
        type: 'GET',
        data: {
            'id': id
        },
        success: function(response) {
            if(response.status == 200) {
                $("#product_grid").html(response.data);
                $('.set-bg').each(function () {
                    var bg = $(this).data('setbg');
                    $(this).css('background-image', 'url(' + bg + ')');
                });
            }
        }
    });
}