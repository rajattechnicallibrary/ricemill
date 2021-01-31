 <?php if(is_array($order_list) && !empty($order_list)) { 
		foreach($order_list as $key =>$val ){
		//$vendor_logo = base_url()."uploads/logo_image/".$val->logo_image;?>
    
    <div class="menu-right-top-order myaccount-right-int-more">
        <div class="menu-order-left">
		<a href="<?= base_url();?>account/orders/order_details/<?php echo ID_encode($val->id)?>">
		<?php 
			if($val->logo_image !='' && file_exists("./uploads/logo_image/$val->logo_image")){ ?>
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
		
		
		$date = '2017-07-01';
		$delivery_date = date('F d, Y', strtotime($val->delivery_date));
		//echo $date;

		?>
            <p><img src="<?php echo base_url();?>frontend_assets/images/order-clock-icon.png"/><?=$delivery_date?> <?=$delivery_time?></p>
        </div>
		
    </div>
	<?php } } ?>