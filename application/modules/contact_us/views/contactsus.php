<!--Contact-Us-Page-Start-->
<div class="container">
<div class="contact-container">
    <h1>Contact Us</h1>
	<?php echo get_flashdata(); ?>
	<form onsubmit="return validate_contact();" method="post" action="<?php echo base_url(); ?>contact_us" id="contact_add" enctype="multipart/form-data" >    
		<div class="row">
		<div class="col-md-6">
		
               <div class="form-group">
               <label for="">First Name<span class="required" aria-required="true" style="color:#e02222">
									* </span></label>
               <input type="text" name="fname_cnt" value="<?php echo set_value('fname_cnt');?>" class="form-control" id="" maxlength="35" placeholder=""/>
			   <span class="help-block" id="fname_cnt_msg_id" style="color:#c8202d"><?php echo form_error('fname_cnt'); ?></span>
            </div>
       
		</div>
		<div class="col-md-6">		
               <div class="form-group">
               <label for="">Last Name<span class="required" aria-required="true" style="color:#e02222">
									* </span></label>
               <input type="text" name="lname_cnt" value="<?php echo set_value('lname_cnt');?>" class="form-control" id="" maxlength="35" placeholder=""/>
              <span class="help-block" id="lname_cnt_msg_id" style="color:#c8202d"><?php echo form_error('lname_cnt'); ?></span>
			</div>        
		</div>
		</div>
		<div class="row">
		<div class="col-md-6">
		 <div class="form-group">
               <label for="">Mobile Number<span class="required" aria-required="true" style="color:#e02222">
									* </span></label>
               <input type="text" name="mobile_cnt" value="<?php echo set_value('mobile_cnt');?>" class="form-control numbersOnly" id="" maxlength="10" placeholder=""/>
			     <span class="help-block" id="mobile_cnt_msg_id" style="color:#c8202d"><?php echo form_error('mobile_cnt'); ?></span>
            </div>
		
		</div>
		<div class="col-md-6">
		 <div class="form-group">
               <label for="">Email ID<span class="required" aria-required="true" style="color:#e02222">
									* </span></label>
               <input type="text" name="email_cnt" value="<?php echo set_value('email_cnt');?>" class="form-control" id="" maxlength="35" placeholder=""/>
              <span class="help-block" id="email_cnt_msg_id" style="color:#c8202d"><?php echo form_error('email_cnt'); ?></span>
			</div>
		
		</div>
		</div>
	<div class="row">
		<div class="col-md-6">
		<div class="form-group">
               <label for="">Message<span class="required" aria-required="true" style="color:#e02222">* </span></label>
			   <textarea class="form-control" name="message_cnt" value="" id="" maxlength="100"><?php echo set_value('message_cnt');?></textarea>
               <!--<input type="text" class="form-control min-height80" name="message_cnt" value="<?php echo set_value('message_cnt');?>" id="" maxlength="35" placeholder=""/>-->
			     <span class="help-block" id="message_cnt_msg_id" style="color:#c8202d"><?php echo form_error('message_snt'); ?></span>
            </div>
		
		</div>		
	</div>
	
	<div class="contact-btn-outer"><button type="submit" class="recipe-submit-button">Submit</div>	
	</form>
	</div>	
</div>

<!--Contact-Us-Page-End-->
<script>

$(document).ready(function() {
	
    $(".numbersOnly").keypress(function(key) {
		
        if(key.charCode < 48 || key.charCode > 57) return false;
    });
});


jQuery.validator.addMethod("lettersonly", function(value, element) {
  return this.optional(element) || /^[a-z]+$/i.test(value);
}, "Only characters allowed !"); 

$("#contact_add").validate({
	rules: {
		fname_cnt:{
			required:true,
			lettersonly:true,
		},
		lname_cnt:{
			required:true,
			lettersonly:true,
		},
		mobile_cnt:{
			required:true,
			maxlength: 10,
			minlength: 10,
			number:true,
		},
		email_cnt:{
			required:true,
			email:true,
		},
		message_cnt:{
			required:true,
		},
	},       	              
	messages: {
		fname_cnt: {
			required: '<span class="help-block" style="color:#c8202d;">First name is required ! </span>',
		},
		lname_cnt: {
			required: '<span class="help-block" style="color:#c8202d;">Last Name is required ! </span>',
		},
		mobile_cnt: {
			required: '<span class="help-block" style="color:#c8202d;">Mobile number is required ! </span>',
			number: '<span class="help-block" style="color:#c8202d;">Only number is required ! </span>',
		},          
		email_cnt: {
			required:'<span class="help-block" style="color:#c8202d;">Email Id is required !</span>',
			email:'<span class="help-block" style="color:#c8202d;">Valid Email Id is required !</span>',
		},
		message_cnt: {
			required:'<span class="help-block" style="color:#c8202d;">Message is required !</span>'
		},
	}
}); 


/*
function validate_contact(){
	var error=true;
	
	// for first name allowed only characters 
	var regularExpression = /^[a-zA-Z-,]+(\s{0,1}[a-zA-Z-, ])*$/;
	var regularExpressionLname = /^[a-zA-Z-,]+(\s{0,1}[a-zA-Z-, ])*$/;
	//for email only
	var regularExpressionEmail = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
   
	// for alphanumerics
	var regularExpressionAplha = /^[a-zA-Z0-9,]+(\s{0,1}[a-zA-Z0-9, ])*$/;
	
	var fname_cnt_val = $("input[name='fname_cnt']").val();
	
    var valid_fname_cnt = regularExpression.test(fname_cnt_val);
	
	var lname_cnt_val = $("input[name='lname_cnt']").val();
	
    var valid_lname_cnt = regularExpressionLname.test(lname_cnt_val);
	
	var email_cnt_val = $("input[name='email_cnt']").val();
	
    var valid_email_cnt = regularExpressionEmail.test(email_cnt_val);
	
	var message_cnt_val = $("input[name='message_cnt']").val();
	
    var valid_message_cnt = regularExpressionAplha.test(message_cnt_val);
	
	
	if($("input[name='fname_cnt']").val()	==	'')
	{
		error = false;
		
		$('#fname_cnt_msg_id').html('First name is required ');
	}else if(!valid_fname_cnt)
	{
		error = false;
		
		$(".error").html('');
		$('#fname_cnt_msg_id').html('First name is not valid ');
	}else{
		
		$('#fname_cnt_msg_id').html(' ');
	}
	
	if($("input[name='lname_cnt']").val()	==	'')
	{
		error = false;
		
		$('#lname_cnt_msg_id').html('Last name is required ');
	}else if(!valid_lname_cnt)
	{
		error = false;
		
		$(".error").html('');
		$('#lname_cnt_msg_id').html('Last name is not valid ');
	}else{
		
		$('#lname_cnt_msg_id').html(' ');
	}
	
	if($("input[name='mobile_cnt']").val()	==	'')
	{
		error = false;
		$('#mobile_cnt_msg_id').html('Mobile number is required');
	}
	else if($("input[name='mobile_cnt']").val().length != 10)
	{
		error = false;
		$('#mobile_cnt_msg_id').html('Mobile number is not valid');
	}
	else{
		
		$('#mobile_cnt_msg_id').html('');
	}
	if($("input[name='email_cnt']").val()	==	'')
	{
		error = false;
		
		$('#email_cnt_msg_id').html('Email is required ');
	}else if(!valid_email_cnt)
	{
		error = false;
		
		$(".error").html('');
		$('#email_cnt_msg_id').html('Email is not valid ');
	}else{
		
		$('#email_cnt_msg_id').html(' ');
	}
	if($("input[name='message_cnt']").val()	==	'')
	{
		error = false;
		
		$('#message_cnt_msg_id').html('Message is required ');
	}else if(!valid_message_cnt)
	{
		error = false;
		
		$(".error").html('');
		$('#message_cnt_msg_id').html('Message is not valid ');
	}else{
		
		$('#message_cnt_msg_id').html(' ');
	}
	
	
	return error;
	if(error == true)
	{
		return true;
	}
	return false;
} */
</script>
