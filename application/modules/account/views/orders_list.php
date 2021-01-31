

<div class="my-account-section">
	<div class="container container-margin">
		<div class="row">
		<?php echo get_flashdata(); ?>
			<?php echo $this->load->view('elements/user_left_menu');?>			
			<div class="col-md-9">				
	<div class="tab-pane active" id="">
            <div class="myorder-white-grid">
        <h1>My Order</h1>
    </div>
	<div id="order-load">
	<div class="load_order_data">
    <?php if(is_array($order_list) && !empty($order_list)) {
$i = 0;		
		foreach($order_list as $key =>$val ){ 		
		//$vendor_logo = get_image_thumb($val->logo_image,'thumb');
		
		//$vendor_logo = base_url()."uploads/logo_image/".$val->logo_image;
		//pr($vendor_logo); die;
		?>
    
    <div class="menu-right-top-order myaccount-right-int-more">
        <div class="menu-order-left">
		<a href="<?= base_url();?>account/orders/order_details/<?php echo ID_encode($val->id)?>">
		<?php 
			if($val->logo_image !='' && file_exists("./uploads/logo_image/get_image_thumb($val->logo_image,'thumb')")){ ?>
			<img src="<?php echo base_url(); ?>uploads/logo_image/<?php echo get_image_thumb($val->logo_image,'thumb') ?>"/>
					
			<?php	}else{ ?>
					<img src="<?php echo base_url(); ?>frontend_assets/images/product_default.png"/>
				
			<?php } ?>
			</a>
		</div>
        
		
		<div class="menu-order-mid">
            <h1><a href="<?= base_url();?>account/orders/order_details/<?php echo ID_encode($val->id)?>"><?php echo $val->food_joint_name;?></a></h1>
            <p>Cuisines: <?php echo $val->cuisine_catgory;?></p>
            <h2>Rs. <?php echo $val->final_amount;?>/-</h2>
        </div>
        
        <div class="menu-order-right">
            <h1><?php echo ucfirst($val->order_status);?></h1>
		<?php 
		
		$delivery_time = $val->delivery_time; 
		$delivery_time = date('h:i A', strtotime($delivery_time));			
		$delivery_date = date('F d, Y', strtotime($val->delivery_date));
		//echo $date;

		?>
            <p><img src="<?php echo base_url();?>frontend_assets/images/order-clock-icon.png"/><?=$delivery_date?> <?=$delivery_time?></p>
        </div>
		
    </div>
	<?php $i++;} } else { ?>
		    <div class="menu-right-top-order">
        No order found !
			</div>
	<?php } ?>
	<input type="hidden" name="page_order" value="0">
    <input type="hidden" name="total_order" value="<?= @$total_row ?>">
	</div>
		<?php if (@$total_row > @$i) { ?>
			<div class="row load_more_order" style="margin: 7px 0px">
				<div class="load-outer">
					<div class="menu-load-btn">Load More</div>
				</div>
			</div>
		<?php } ?>
		<div class="proccessing hide">
			<center><img src="<?= base_url() ?>frontend_assets/images/proccessing.gif"></center>
		</div>
	
	</div>
	
    </div>
			</div>
			
		</div>
	</div>
</div>
<script>
 //stall_dish_block
    $(document).on('click', '.load_more_order', function () {
        var pagenum = $("input[name='page_order']").val();
        pagenum = parseInt(pagenum) + 1;
        
        if ($("#order-load .myaccount-right-int-more").length < $("input[name='total_order']").val()) {
            getresult_order("<?php echo base_url(); ?>account/orders/load_more_orders?<?= $_SERVER['QUERY_STRING'] ?>&page=" + pagenum);
            $("input[name='page_order']").val(pagenum);
        } else {
            $(".load_more_order").hide();
        }

    });
	
	
	 function getresult_order(url) {
        $('.proccessing').removeClass('hide');
        $(".load_more_order").hide();
        $.ajax({
            url: url,
            type: "GET",
            data: '',
            beforeSend: function () {
                $('#loader_searches').html('<img class="loader-btn"  src="<?php echo base_url(); ?>frontend_assets/img/loader.gif" width="30" height="30" border="0" alt="">');
            },
            complete: function () {
                //$('#loader-icon').hide();
            },
            success: function (data) {
                console.log(data);
                data = JSON.parse(data);
                if (data['status'] == 'success') {
                    $(".load_order_data").append(data['view']);
					var total_record = '<?= $total_row ?>';
					
				    if(total_record == $(".myaccount-right-int-more").length)
						 {
							 $('.load_more_order').addClass('hide');
						 }else{
							
						 }
					
					
					
                } else if (data['status'] == 'error') {

                }

                setTimeout(function () {
                    $('.proccessing').addClass('hide');
                    $(".load_more_order").show();
                }, 500);

            },
            error: function () {
            }
        });
    }
</script>

