
                $(document).on('click', '.down_qty', function () {
                    var rowid = $(this).attr('data-rowid');
                    var qty = $(this).next('b').html();
                    qty = parseInt(qty);
                    var th = $(this);
                    if (qty == 1) {
                        $(this).parents().eq('2').remove();
                    }
                    if (qty > 0)
                    {
                        qty = qty - 1;
                        $(this).next('b').html(qty);
                        /*Removing this product quantity from cart*/
                        $.ajax({
                            type: "post",
                            url: url+"stall_list/cart/removeQtyCart",
                            data: {rowid: rowid, qty: qty},
                            success: function (dat) {
                                dat = JSON.parse(dat);
                                if (dat['status'] == 'success')
                                {
                                    if (dat['isEmpty'] != 0) {
                                        $("#subTotal").html(dat['subTotal']);
                                        $("#stallDiscount").html("- "+dat['discount']);
										if(dat['coupon_discount']	!= ''){
											$("#couponDiscount_blc").removeClass('hide');
											$("#couponDiscount").html("- "+dat['coupon_discount']);
										}else{
											$("#couponDiscount_blc").addClass('hide');
											$("#couponDiscount").html("- 0");
											$("#promo_code").val('');
											$(".remove_promo_code ").addClass('hide');
										}
                                        $("#deliveryFee").html(dat['deliveryFee']);
                                        $("#sgst").html(dat['sgst']);
                                        $("#cgst").html(dat['cgst']);
                                        $("#finalTotal").html(dat['finalTotal']);
                                        th.parents().eq('0').next('span').html(dat['item_total_price']);
                                    } else {
										var str =	'<div class="return-section-bottom">';
										str 	+=	'	<img src="'+url1+'frontend_assets/images/empty_cart.png">';
										str 	+=	'	<h2> EMPTY BAG</H2>';
										str 	+=	'<p>Your food bag is Curently Empty</p>';
										//str 	+=	'<button class="return-btn ">Return To Stall</button>';
										str 	+=	'</div>';
                                        $(".bag_content").html(str);
										$('.overlay_blc').css('position','relative');
										$('.overlay_blc').find('.overlay').removeClass('hide');
										$('.return_to_menu_btn').removeClass('hide');
                                    }
                                }
                            }
                        });
                        /*End of removing this product quantity from cart*/
                    }
                });
                $(document).on('click', '.up_qty', function () {
                    var rowid = $(this).attr('data-rowid');
                    var qty = $(this).prev('b').html();
                    qty = parseInt(qty);
                    var th = $(this);
                    if (qty > 0)
                    {
                        qty = qty + 1;
                        $(this).prev('b').html(qty);
                        /*Removing this product quantity from cart*/
                        $.ajax({
                            type: "post",
                            url: url+"stall_list/cart/addQtyCart",
                            data: {rowid: rowid, qty: qty},
                            success: function (dat) {
                                dat = JSON.parse(dat);
                                if (dat['status'] == 'success')
                                {
                                    $("#subTotal").html(dat['subTotal']);
                                    $("#stallDiscount").html("- "+dat['discount']);
									if(dat['coupon_discount']	!= ''){
										$("#couponDiscount_blc").removeClass('hide');
										$("#couponDiscount").html("- "+dat['coupon_discount']);
									}else{
										$("#couponDiscount_blc").addClass('hide');
										$("#couponDiscount").html("- 0");
									}
                                    $("#deliveryFee").html(dat['deliveryFee']);
                                    $("#sgst").html(dat['sgst']);
                                    $("#cgst").html(dat['cgst']);
                                    $("#finalTotal").html(dat['finalTotal']);
                                    th.parents().eq('0').next('span').html(dat['item_total_price']);
                                }
                            }
                        });
                        /*End of removing this product quantity from cart*/
                    }
                });
                $(document).on('click', '.removeItem', function () {
                    var rowid = $(this).attr('data-rowid');
                    var th = $(this);
                    if (rowid)
                    {
                        /*Removing this product quantity from cart*/
                        $.ajax({
                            type: "post",
                            url: url+"stall_list/cart/removeItemCart",
                            data: {rowid: rowid},
                            success: function (dat) {
                                dat = JSON.parse(dat);
                                if (dat['status'] == 'success')
                                {
                                    if (dat['isEmpty'] != 0) {
                                        $("#subTotal").html(dat['subTotal']);
                                        $("#stallDiscount").html("- "+dat['discount']);
										if(dat['coupon_discount']	!= ''){
											$("#couponDiscount_blc").removeClass('hide');
											$("#couponDiscount").html("- "+dat['coupon_discount']);
										}else{
											$("#couponDiscount_blc").addClass('hide');
											$("#couponDiscount").html("- 0");
											$("#promo_code").val('');
											$(".remove_promo_code ").addClass('hide');
										}
                                        $("#deliveryFee").html(dat['deliveryFee']);
                                        $("#sgst").html(dat['sgst']);
                                        $("#cgst").html(dat['cgst']);
                                        $("#finalTotal").html(dat['finalTotal']);
										$(".cartbtn").find('span').html('('+dat['cart_count']+')');
                                        th.parents().eq('1').remove();
                                    } else {
										var str =	'<div class="return-section-bottom">';
										str 	+=	'	<img src="'+url1+'frontend_assets/images/empty_cart.png">';
										str 	+=	'	<h2> EMPTY BAG</H2>';
										str 	+=	'<p>Your food bag is Curently Empty</p>';
										//str 	+=	'<button class="return-btn ">Return To Stall</button>';
										str 	+=	'</div>';
                                        $(".bag_content").html(str);
										$('.overlay_blc').css('position','relative');
										$('.overlay_blc').find('.overlay').removeClass('hide');
										$('.return_to_menu_btn').removeClass('hide');
										$(".cartbtn").find('span').html('('+dat['cart_count']+')');
                                    }
                                } else if (data['status'] == 'error') {

                                }
                            }
                        });
                        /*End of removing this product quantity from cart*/
                    }
                });
            

    $(document).on('click', '.menu_item_varient_drop li', function () {
        var menu_id = $(this).attr('data-menu_id');
        $("#menu_item_blc" + menu_id).find("input[name='cart_menu_item_varient_id']").val($(this).attr('data-menu_varient_id'));
        $("#menu_item_blc" + menu_id).find(".yield").html($(this).attr('data-yield'));
        $(this).parents().eq('1').find('button').find('#unit').text($(this).find('a').attr('data-unit'));
        $(this).parents().eq('1').find('button').find('#price').text($(this).find('a').attr('data-price'));
        //$(this).parents().eq('1').find('button').text($(this).find('a').html());
    });
    $(document).on('click', '.add_cart', function () {
        var th = $(this);
        var menu_id = $(this).parents().eq('0').find('input[name="cart_menu_item_id"]').val();
        var menu_varient_id = $(this).parents().eq('0').find('input[name="cart_menu_item_varient_id"]').val();
        var stall_id = $("input[name='stall_id']").val();
        //alert(stall_id);
        if(stall_id == undefined){  /*This is for whrn hit come from stall list page (for dish)*/
            var stall_id = $(this).parents().eq('0').find("input[name='dish_stall_id']").val();
        }
        //alert(menu_id);
        //alert(menu_varient_id);
        $.ajax({
            type: "post",
            url: url+"stall_list/cart/addCart",
            data: {menu_varient_id: menu_varient_id, menu_id: menu_id, stall_id: stall_id},
            success: function (data) {
                data = JSON.parse(data);
				
                if (data['status'] == 'success')
                {
                    /*this is for stall list (dish section)*/
                    $(".search-addcart").find('span').html("("+data['cart_count']+")");
                    $(".your_bag").html(data['bag_view']);
                    if(data['is_same_stall'] == false)
                    {   /*this is for stall list page dish section*/
                        $("#dishes .myaccount-right-int").each(function(){ 
                            $(this).find('.overlay').removeClass('hide');
                        });
                        th.parents().eq('3').find('.overlay').addClass('hide');
                    }
                } else if (data['status'] == 'error') {
					alert(data['error_msg']);
					return false;
                }
            }
        });

    });
