
<div class="my-account-section">
	<div class="container container-margin">
		<div class="row">
		<?php echo get_flashdata(); ?>
			<?php echo $this->load->view('elements/user_left_menu');?>			
	<div class="col-md-9">				
		<div class="tab-pane active" id="">
			<div class="myorder-white-grid">
				<h1>My Order Details</h1>
			</div>
			<div class="order-detail-container">
				<h1>Order Details</h1>
				<div class="grid text-center">
				<div class="order-detail-top">
					<div class="order-detail-int">
						<p><b>Order Id :</b> #<?= $result->id; ?></p>
						<p><b>Date | Time :</b> <?php echo date('d F Y', strtotime($result->created_date));?>, <?php echo date("h.i A",strtotime($result->created_date));?></p>
						<p><b>TOtal Amount :</b> <?php echo $result->total_amount ?> Rs/-</p>
					</div>
					<div class="order-detail-int">
						<p><b>Customer Name : </b><?php echo $result->first_name; ?></p>
						<p><b>Delivery Address : </b><?php echo $result->address.' ,'.$result->city_name.' ,'.$result->state_name.' ,'.$result->zipcode ?></p>
						<p><b>Phone No:</b> +91-<?php echo $result->mobile_number; ?></p>
					</div>
				</div>
				</div>
				
				<div class="grid">
					<p>Hi <?php echo ucfirst($result->first_name); ?>,<br /><br />
						Thanks for ordering with Foodstall. <?php echo ucwords($result->food_joint_name); ?> is preparing your order now.
					</p>
				</div>
				
			   <div class="detail-order-full"> 
					<div class="order-ddotted-box">
						<p class="text-center">Estimated Delivery Time: <span><?= date('i',strtotime($result->delivery_estimated_time)) ?> Minutes</span> </p>
					</div>
				 <div class="order-detail-top">
					<div class="order-detail-int">
						<p><b>Order Status : </b> <?php echo ucfirst($result->order_type); ?> 
							<?php if($result->status	== '1' || $result->status	== '2'){ ?>
								<span class="error cancel_popup"> Cancel</span>
							<?php } ?>
						</p>
						<?php if($result->status == 5){ ?>
							<p><b>Cancel Reason : </b><?php echo $result->cancel_reason ?></p>	
						<?php } ?>
						<p><b>Delivery On : </b><?php echo date('d F Y', strtotime($result->delivery_date));?>, <?php echo date("h.i A",strtotime($result->delivery_time));?></p>
					</div>
					<div class="order-detail-int">
						<p><b>ID Transaction : </b> #XXXXXXX</p>
						<p><b>Date | Time : </b><?php echo date('d F Y', strtotime($result->created_date));?>, <?php echo date("h.i A",strtotime($result->created_date));?></p>
					</div>
				</div>   
			   </div>
			   
			   <div class="order-detailgrey-strip">
					<h1>Order summary:</h1></div>
			   <div class="grid">
					<div class="order-detail-int1">
					<?php if($order_summary !='' && is_array($order_summary)){ 
					foreach($order_summary as $key => $val){ ?>
						
						<h2><?= $val->quantity.' X '.$val->menu_varient_name ?><span><?= $currency ?> <?= $val->quantity*$val->unit_price.'.00' ?></span></h2>
					<?php } }else{
					echo "No data found !";
				}?>
						
					
					
					</div>
			   </div>
				 <div class="order-detailgrey-strip">
					<h1>Additional Information: </h1></div>
					
					<div class="grid">
					<?php
					$coupon_code_amount	=	0;
					foreach($order_summary as $c_key => $c_val){
						$coupon_code_amount = $coupon_code_amount + $c_val->coupon_code_amount;
					}
					?>
					<div class="order-detail-int1">
						<h3>+ Total Amount  <span><?= $currency ?> <?= $result->total_amount ?></span></h3>
						<h3>- Discount  <span><?= $currency ?> <?= $result->vendor_discount_amount ?> </span></h3>
						<h3>- Coupon Discount  <span><?= $currency ?> <?= $coupon_code_amount ?></span></h3>
						<h3>+ Tax<span><?= $currency ?> <?= $result->tax_amount ?></span></h3>
						<h3>+ Delivery Fee   <span><?= $currency ?> <?= $result->delivery_charge?> </span></h3>
						
					</div>
					</div>
			   <div class="order-detailgrey-strip">
					<h1>TOTAL <span><?= $currency ?> <?= $result->final_amount ?> </span> </h1></div>
			   <div class="grid">
				<!--<p><b>Payment Type: </b>
				 Freecharge (25% cashback max Rs. 75, valid 2 Txn per user. T&C)  
				To follow up on your order, call Desi Galli at 08527252327, 8527252757.</p>-->
			   </div>
			</div>
		</div>
	</div>
</div>
</div>
</div>
<style>
	.cancel_popup{cursor:pointer; text-decoration: underline;}
</style>
<script>
	$(document).on('click','.cancel_popup',function(){
		$("#cancel_order").modal('show');
	});
</script>
<div id="cancel_order" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
    <div class="white-form-container">
    
      <div class="modal-header">
        <button type="button" class="close forgot_passworddd" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"><img src="<?= base_url()?>frontend_assets/images/logo-big-white.png"/></h4>
      </div>
      <div class="modal-body ajax_response_result">
		<div class="forgot_password_section">
			<form action="" method="" id="cancel_order_form"  class="form" autocomplete="off">
				<div class="error_cancel_order" style="margin-left: -35px;"></div>
				<div class="success" style="margin-left: -35px;"></div>
				<div class="form-row"><h1>Reason</h1></div>
				  <div class="form-field">
					<textarea name="reason" ></textarea>
					<span id="reason_error" class="help-block error"></span>
				  </div>
					<button  style="padding:10px" class="form-button cancel_order_btn" >
						<span class="processing hide"><i class="fa fa-spin fa-spinner"></i></span><span> Submit</span> 
					</button>
			</form>
		</div>
      </div>
      <!--<div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>-->
    </div>
    </div>

  </div>
</div>
<script>
$(document).on('click','.cancel_order_btn',function(){
	var reason = $('textarea[name="reason"]').val();
	if(reason == '')
	{
		$("#reason_error").html('Please give reason.');
		return false;
	}else{
		$.ajax({
            url: "<?= base_url() ?>account/orders/cancel_order",
            type: "POST",
            data: 'reason='+reason+"&order_id=<?= uri_segment(4) ?>",
            beforeSend: function () {
                
            },
            complete: function () {
                //$('#loader-icon').hide();
            },
            success: function (data) {
                console.log(data);
                data = JSON.parse(data);
                if (data['status'] == 'success') {
                    window.location.href = '';
                } else if (data['status'] == 'error') {

                }
            },
            error: function () {
            }
        });
	}
	return false;
});
</script>