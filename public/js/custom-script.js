// const baseUrl = $('base').attr('href') + '/';

$(function () {
    $.fn.showLoading = (function () {
        if (!$('.loading-box').length) {
            let loadingHtml = `
                <div class="loading-box">
                    <div class="loading-bg"></div>
                    <div class="loading-body">
                        <div class="form-group">
                            <img src="${baseUrl}imgs/loader-2_food.gif" alt="">
                        </div>
                        <div>
                            Loading, please wait...
                        </div>
                    </div>
                </div>
            `;
            $('body').append(loadingHtml);
        }
    });
    $.fn.hideLoading = (function () {
        setTimeout(function () {
            $('.loading-box').remove();
        }, 300);
    })
    $.ajaxSetup({
        headers: {
            'X-CSRF-Token': $('meta[name="_token"]').attr('content')
        }
    });

    $('#select_all').click(function (event) {
        if (this.checked) {
            // Iterate each checkbox
            $(':checkbox').each(function () {
                this.checked = true;
            });
        } else {
            alert('43633');
            $(':checkbox').each(function () {
                this.checked = false;
            });
        }
    });

    $(document).on('click', '#changeselectStatus', function () {
        ajax_url = $(this).data('url');

        $(document).showLoading();

        $.ajax({
            url: ajax_url,
            type: 'POST',
            success: function (res) {
                $('#cartFooter').html(res.cart_footer);
                $(document).hideLoading();
            }
        });

    });

    $(document).on('keyup', '#order_search', function () {
        let ajax_url = $('#order_search').data('url'),
            search = $('#order_search').val(),
            user_id = $('#order_user_id').val(),
            limit = $('#order_limit').val(),
            date = $('#order_date').val();

        $.ajax({
            url: ajax_url,
            type: 'GET',
            data: {
                search: search,
                user_id: user_id,
                date: date,
                limit: limit,
            },
            headers: {
                'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (res) {
                $('#order_lists').html(res.data);
            }
        });
    });
    $(document).on('change', '#order_user_id,#order_date,#order_limit', function () {
        let ajax_url = $('#order_search').data('url'),
            search = $('#order_search').val(),
            user_id = $('#order_user_id').val(),
            limit = $('#order_limit').val(),
            date = $('#order_date').val();

        $.ajax({
            url: ajax_url,
            type: 'GET',
            data: {
                search: search,
                user_id: user_id,
                date: date,
                limit: limit,
            },
            headers: {
                'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (res) {
                $('#order_lists').html(res.data);
            }
        });
    });

    
    // $(document).on('change', '#inquery_color_id', function () {
    //     let ajax_url = $(this).data('url'),
    //         category_id = $('#inquery_category_id').val(),
    //         color_id = $('#inquery_color_id').val(),
    //         size_id = $('#inquery_size_id').val();
    //     if (color_id && size_id) {
    //         $.ajax({
    //             url: ajax_url,
    //             type: 'GET',
    //             data: {
    //                 category_id: category_id,
    //                 color_id: color_id,
    //                 size_id: size_id
    //             },
    //             headers: {
    //                 'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
    //             },
    //             success: function (res) {
    //                 // Price
    //                 $('#inquery_price').html(res);
    //                 $('#inquery_price').attr('data-price', res);

    //                 // Gst Price
    //                 let gst_price = (res * 18) / 100;
    //                 $('#inquery_gst').html(gst_price);
    //                 $('#inquery_gst').attr('data-price', gst_price);

    //                 // Total Price
    //                 let total_price = res + gst_price;
    //                 $('#inquery_total_price').html(total_price);
    //                 $('#inquery_total_price').attr('data-price', total_price);

    //                 $('#price_div').css('display', 'block');
    //             }
    //         });
    //     } else {
    //         $('#inquery_price').html('');
    //         $('#inquery_price').attr('data-price', '');
    //         $('#inquery_gst').html('');
    //         $('#inquery_gst').attr('data-price', '');
    //         $('#inquery_total_price').html('');
    //         $('#inquery_total_price').attr('data-price', '');
    //         $('#price_div').css('display', 'none');
    //     }
    // });


});
