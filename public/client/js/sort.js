$(document).ready(function() {
    $("#sort_price").change(function () {
        var sort = $(this).val();
        $.ajax({
            url: '/sort',
            type: 'GET',
            data: {
                'sort': sort
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
    });
});