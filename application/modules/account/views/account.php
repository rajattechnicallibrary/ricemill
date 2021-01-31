
<div class="my-account-section">
	<div class="container container-margin">
		<div class="row">
		<?php echo get_flashdata(); ?>
			<?php echo $this->load->view('elements/user_left_menu');?>			
			<div class="col-md-9">
				<div class="account-right-section">
					 <div class="" id="">		
						<h1>Account Setting</h1>
						<div class="account-detail-form">
							<form onsubmit="return validate_account();" action="" method="post" id="my_account_edit" enctype="multipart/form-data">	
							
								<label class="account-label"> First Name <span class="required-span">*</span></label>
								<?php
								$name = @$my_account_view->first_name;
								$postvalue = @$_POST['first_name'];												
								?>
								<input type="text" name="first_name" id="first_name" value="<?php echo (!empty($postvalue) ? $postvalue : $name); ?>" class="account-input">													
						     <span class="help-block" style="color:#c8202d;"><?php echo form_error('first_name'); ?></span>
							
							<label class="account-label"> Last Name <span class="required-span">*</span></label>
							<?php
							$name = @$my_account_view->last_name;
							$postvalue = @$_POST['last_name'];												
							?>
							<input type="text" name="last_name" id="last_name" value="<?php echo (!empty($postvalue) ? $postvalue : $name); ?>" class="account-input">													
						<span class="help-block" style="color:#c8202d;"><?php echo form_error('last_name'); ?></span>
						
						<label class="account-label">Country<span class="required-span">*</span></label>
							<select name="country" id="country" class="account-input">
								<?php if(!empty($country) && is_array($country)){?>
								<option value="" >Select Country</option>
								<?php foreach($country as $key => $val){
								if($my_account_view->country_id == $val->id){
									$selected = 'selected="selected"';
								}elseif(@$_post['country']){
									$selected = 'selected="selected"';
								}else{
									$selected = '';
								}
								?>
									<option value="<?php echo $val->id; ?>" <?php echo $selected; ?>><?php echo $val->name;?></option>
								<?php } }else{?>
									<option>No Country found !</option>
								<?php }?>
							</select>
						<span class="help-block" style="color:#c8202d;"><?php echo form_error('country'); ?></span>
						
						
						<label class="account-label">State<span class="required-span">*</span></label>
							<select name="state" id="state" class="account-input">
							<?php if(!empty($state) && is_array($state)){?>
								<option value="" >Select State</option>
								<?php foreach($state as $key => $val){
									 if(@$my_account_view->state_id == $val->id){
									   $selected= 'selected="selected"';  
									 } else if(@$_POST['state']){
									   $selected= 'selected="selected"';
									 } else{
										 $selected= '';  
									 }      
										 ?>
									<option value="<?php echo $val->id; ?>" <?php echo $selected; ?>><?php echo $val->name;?></option>
							<?php } }else{?>
									<option>No State found !</option>
								<?php }?>
							</select>
						<span class="help-block" style="color:#c8202d;"><?php echo form_error('state'); ?></span>
						
						<label class="account-label">City<span class="required-span">*</span></label>
							<select name="city" id="city" class="account-input">
								<?php if(!empty($city) && is_array($city)){?>
								<option value="" >Select City</option>
								<?php foreach($city as $key => $val){
									 if(@$my_account_view->city_id == $val->id){
									   $selected= 'selected="selected"';  
									 } else if(@$_POST['city']){
									   $selected= 'selected="selected"';
									 } else{
										 $selected= '';  
									 }      
										 ?>
									<option value="<?php echo $val->id; ?>" <?php echo $selected; ?>><?php echo $val->name;?></option>
							<?php } }else{?>
									<option>No City found !</option>
								<?php }?>
							</select>
						<span class="help-block" style="color:#c8202d;"><?php echo form_error('city'); ?></span>
						
						<label class="account-label">Address<span class="required-span">*</span></label>
								<?php
								$name = @$my_account_view->address;
								$postvalue = @$_POST['address'];												
								?>
								<input type="text" name="address" id="address" value="<?php echo (!empty($postvalue) ? $postvalue : $name); ?>" class="account-input">													
						     <span class="help-block" style="color:#c8202d;"><?php echo form_error('address'); ?></span>
						
						
						
						
								<label class="account-label">Email</label>
								<input type="text" class="account-input " readonly="readonly" class="form-control" value="<?php echo $my_account_view->email; ?>">
						        
							<label class="account-label">Mobile</label>
							<div class="col-md-2 codeno">
							<input type="text" class="account-input " data="91" readonly="readonly" class="form-control" value="+91">
							</div>
							 			
								<div class="col-md-10 codeno">
								<input type="text" class="account-input " readonly="readonly" class="form-control" value="<?php echo $my_account_view->mobile_number; ?>">
								</div>
							<label class="account-label">Upload image</label>
								<div class="col-ting">
									<div class="control-group file-upload" id="file-upload1">
									  <div class="image-box text-center">
									  <p> <i class="fa fa-cloud-upload"></i> <br> Upload Image</p><img src="" alt=""></div>
									  <div class="controls">
									  <input type="file" name="userfile" id="image" />
									  </div>												  
									</div>
								</div>
								 <span class="file-text">Only jpg,jpeg,png image allowed.</span>
								 <label class="account-label padding-top20">Newsletter</label>
								<div class="form-field">
					   <div class="rkmd-checkbox checkbox-ripple">
							<label class="input-checkbox checkbox-lightBlue">
							 <input id="ham" type="checkbox" name="subscribe" value="1" <?=($my_account_view->subscribe==1) ? 'checked' : '' ?> >
							  <span class="checkbox"></span>
							</label>
							<label for="ham" class="alble-txt">Subscribe to Newsletter</label>
						</div>
						
					</div>
								
								<!--<span class="subscribe-checkbox1">
								<input type="checkbox" name="subscribe" 
								value="1" <?=($my_account_view->subscribe==1) ? 'checked' : '' ?> >
								<span class="subscribe-span"> Subscribe to Newsletter</span></span>-->
						           
							   


					</div>
								<div class="acc-save"><button type="submit" class="account-btn-save" >Save</button></div>
							</form>	
						</div>
				    </div> 	
					
					
				</div>
			</div>
			
		</div>
	</div>

</div>

<script src="http://localhost/myfoodstall/assets/global/plugins/jquery-validation/js/jquery.validate.min.js" type="text/javascript"></script>
<script>
$.validator.addMethod("leters_space",function(value,element){
	if(value=='' || value==null)
	{
		return true;
	}
	return  /^[A-Za-z]+( [A-Za-z]+)*$/.test(value);
	},'')
$("#my_account_edit").validate({
	rules: {
		first_name:{
			required:true,
			leters_space:true,
		},            
		 last_name:{
			required: true,  
			leters_space:true,
		},
		 country:{
			required: true,
		},
		 state:{
			required: true,  
		},
		 city:{
			required: true,  
		},
		 address:{
			required: true,  
		}
	},	
	messages: {
		first_name: {
			required: '<span class="help-block" style="color:#c8202d;">First Name is required ! </span>',
			leters_space: '<span class="help-block" style="color:#c8202d;">First Name is invalid ! </span>',
		},
		last_name: {
			required:'<span class="help-block" style="color:#c8202d;">Last Name is required !</span>',
			leters_space: '<span class="help-block" style="color:#c8202d;">Last Name is invalid ! </span>',
		},
		country: {
			required:'<span class="help-block" style="color:#c8202d;">Country is required !</span>',
		},
		state: {
			required:'<span class="help-block" style="color:#c8202d;">State is required !</span>',
		},
		city: {
			required:'<span class="help-block" style="color:#c8202d;">City is required !</span>',
		},
		address: {
			required:'<span class="help-block" style="color:#c8202d;">Address is required !</span>',
		}
		
	}
});


$('#image').on('change',function(){
      var filename = $(this).val().replace(/C:\\fakepath\\/i, '');	  
      var fileobj = $(this).val();		 
      switch(fileobj.substring(fileobj.lastIndexOf('.') + 1).toLowerCase()){
        case 'jpg': case 'png': case 'jpeg':
            break;
        default:
            $(this).val('');
			$(".image-box").find('p').next().attr('src','');
			$(".image-box").find('p').css('display','block');
            alert("Sorry wrong format(Only jpg,jpeg,png allowed)","Warning");
            return false;
      }	  
    // $('#attachment_name').html(filename);
   });
   
   $('#image').bind('change', function() {
		var val = $(this).val();	
		var dftlsize=2048000;    
	  if(this.files[0].size>dftlsize)
	  {
	   $(this).val('');
	   alert("Sorry your Image size exceeds limit 2 MB","Warning");
	   return false; 
	  }
	});
	
	
	
$('#country').on('change',function(){
	var country_id = $('select[name="country"]').val();
	$.ajax({
		type:"POST",
		url:"<?php echo base_url(); ?>account/get_state",
	    data:{country_id:country_id},
		success:function(data){
			data = JSON.parse(data);
			$('#state').html(data);
		}
	});
});	

$('#state').on('change',function(){
	var state_id = $('select[name="state"]').val();
	$.ajax({
		type:'POST',
		url:'<?php echo base_url(); ?>account/get_city',
		data:{state_id:state_id},
		success:function(data){
			data = JSON.parse(data);
			$('#city').html(data);
		}
	});
});
</script>

