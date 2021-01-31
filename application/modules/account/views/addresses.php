<div class="my-account-section">
	<div class="container container-margin">
		<div class="row">
		<?php echo get_flashdata(); ?>
			<?php echo $this->load->view('elements/user_left_menu');?>			
			<div class="col-md-9">
				<div class="account-right-section">
				<div class="actions pull-right add-address-front">
                    <a href="<?php echo base_url(); ?>account/add_address" class="btn btn-default btn-sm">
                        <i class="fa fa-plus"></i> Add Address</a>
					
                </div>
					 <div class="" id="">
					 
						<h1>My Addresses</h1>
						
						<div class="account-detail-form">
						<div class="grid">
						
						<?php if(!empty($user_addresses)){ 
						foreach($user_addresses as $key => $val){  ?>
							<div class="plan-nox">
								<div class="registration-package-box blue-gradient">
									<h3><?= $val->address?></h3>
									<h3><?= $val->zipcode?></h3>
								</div>
								<div class="plan-btn"><a href="<?php echo base_url() ?>account/edit_address?id=<?php echo ID_encode($val->id)?>"><i class="fa fa-edit"></i></a> | <a href="javascript:void()" onclick="return delete_address('<?php echo $val->id ?>','<?php echo $val->user_id ?>')"><i class="fa fa-trash"></i></a></div>
							</div>
						 <?php } }else { ?>
							<div class="plan-nox">
								<div class="registration-package-box blue-gradient">
									<h3>No Data Found !</h3>
								</div>
							</div>
						 <?php }?>
							
						</div>
                    </div>  
				</div>
			</div>
		</div>
	</div>

</div>

<script src="http://localhost/myfoodstall/assets/global/plugins/jquery-validation/js/jquery.validate.min.js" type="text/javascript"></script>
<script>
	function delete_address(id,user){
		var address_id = id;
		var user_id = user;
		var conf = confirm("Are you sure want to delete this address!");
		if(conf){
			$.ajax({ 
				type: 'POST',
				url: '<?php echo base_url(); ?>account/delete_address',
				data:{address_id:address_id,user_id:user_id}, 
				success: function(dat) { 
				var url = '<?php echo base_url(); ?>account/addresses';
				dat =   JSON.parse(dat);	
				if(dat['status']=="success")
				{  
				setTimeout(function(){         
				location = url; 
				}, 1000);
				}else if(dat['status']=="error"){  
				setTimeout(function(){         
				location = url; 
				}, 1000);

				}
				}
				});
		}
	}
</script>

