<!--=Sign-up-form-start=-->
<!-- Modal -->
<style>
.error_forget{
	color:#c8202d;
}
#forgot_mobile_number_id{
	color:#c8202d;
}
#p-error{
	    color: #c8202d;
}
#c-error{
	    color: #c8202d;
}
#forgototp_id{
	color:#c8202d;
}
</style>
<div id="forgot_password" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
    <div class="white-form-container">
    <div class="form-leaf"><img src="<?= base_url()?>frontend_assets/images/form-leaf.png"/></div>
    <div class="form-leaf-tamato"><img src="<?= base_url()?>frontend_assets/images/form-tamato.png"/></div>
    <div class="form-bread"><img src="<?= base_url()?>frontend_assets/images/form-bread.png"/></div>
    <div class="form-tamato"><img src="<?= base_url()?>frontend_assets/images/form-simple-tamato.png"/></div>
      <div class="modal-header">
        <button type="button" class="close forgot_passworddd" data-dismiss="modal">&times;</button>
        <!--<h4 class="modal-title"><img src="<?= base_url()?>frontend_assets/images/logo-big-white.png"/></h4>-->
      </div>
      <div class="modal-body ajax_response_result">
		<div class="forgot_password_section">
			<form onsubmit="return validate_forgot_password()" action="" method="" id="forgot_password_form"  class="form" autocomplete="off">
				<div class="error_forget" style="margin-left: -35px;"></div>
				<div class="success" style="margin-left: -35px;"></div>
				<div class="form-row"><h1>Forgot Password</h1></div>
				  <div class="form-field">
					<input class="numbersOnly" type="text" name="mobile_number_varify" onchange="forgot_mobile_checkLength(this)" id="forgot_mobile_number" value="<?php echo set_value('mobile_number_varify'); ?>" autocomplete="off" placeholder="Mobile Number*" maxlength="10"><i class="fa fa-lock"></i>
					<span id="forgot_mobile_number_id" class="help-block"><?php echo form_error('mobile_number_varify'); ?></span>
				  </div>
				  <button  style="padding:10px" class="form-button" type="submit"><span class="processing hide"><i class="fa fa-spin fa-spinner"></i></span><span> Submit</span> </button>
			</form>
		</div>
		<div class="otp_section_verify hide">
			<form onsubmit="return validate_verify_otp()" action="" method="post" id="otp_verify_form"  class="form" autocomplete="off">
				<div class="error_forget" style="margin-left: -35px;"></div>
				<div class="success" style="margin-left: -35px;"></div>
				<div class="form-row"><h1>Verify Account</h1></div>
				  <div class="form-field">
					<input type="text" name="otp_verify" onchange="otpforgotcheckLength(this)" id="forgototp" value="" placeholder="OTP" maxlength="4" autocomplete="off"><i class="fa fa-lock"></i>
					<input type="hidden" name="verify_user_id" value="">
					<span class="help-block" id = "forgototp_id"><?php echo form_error('otp_verify'); ?></span>
				  </div>
				<button style="padding:10px" class="form-button" type="submit"><span class="processing hide"><i class="fa fa-spin fa-spinner"></i></span><span> Submit</span></button>
			</form>
		</div>
		<div class="change_password_section hide">
			<form onsubmit="return validate_change_password();" action="" method="post" id="change_password_form"  class="form" autocomplete="off">
				<div class="error_forget" style="margin-left: -35px;"></div>
				<div class="success" style="margin-left: -35px;"></div>
				<div class="form-row"><h1>Reset Password</h1></div>
				  <div class="form-field">
					<input type="password" name="change_password"  value="<?php echo set_value('change_password'); ?>" placeholder="Password" maxlength="35" autocomplete="off"><i class="fa fa-lock"></i>
					<input type="hidden" name="user_id_verify" value="">
					<span id="p-error" class="help-block"><?php echo form_error('change_password'); ?></span>
				  </div>
				  <div class="form-field">
					<input type="password" name="confirm_change_password"  value="<?php echo set_value('confirm_change_password'); ?>" placeholder="Confirm Password" maxlength="35" autocomplete="off"><i class="fa fa-lock"></i>
					<span id="c-error" class="help-block"><?php echo form_error('confirm_change_password'); ?></span>
				  </div>
				<button  style="padding:10px" class="form-button" type="submit"><span class="processing hide"><i class="fa fa-spin fa-spinner"></i></span><span> Submit</span></button>
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
<script type="text/javascript">

// spaces not allowed on input fields

$("input[name='otp_verify']").keypress(function( e ) {
    if(e.which === 32) 
        return false;
});
$("input[name='change_password']").keypress(function( e ) {
    if(e.which === 32) 
        return false;
});
$("input[name='confirm_change_password']").keypress(function( e ) {
    if(e.which === 32) 
        return false;
});


function passwordcheckLength1(pwd) {	
	var value = $("input[name='change_password']").val();	
	var regularExpression = /^(?=.*[0-9])(?=.*[a-zA-Z])([a-zA-Z0-9]+).{5,}$/;
    var valid = regularExpression.test(value);
	if(!valid){
		$(".error").html('');
		$("#p-error").html('Password should be alphanumeric and minimum 6 characters !');
			return false;
	}else{
		$("#p-error").html('');
			return true;
	}	
}

/*password validation */
function passwordcheckLength2(pwd) {
	 var value = $("input[name='confirm_change_password']").val();
	var regularExpression = /^(?=.*[0-9])(?=.*[a-zA-Z])([a-zA-Z0-9]+).{5,}$/;
    var valid = regularExpression.test(value);
	if(!valid){
		$(".error").html('');
		$("#c-error").html('Password should be alphanumeric and minimum 6 characters !');
			return false;
	}else{
		$("#c-error").html('');
			return true;
	}	
}


 //  validate mobile number takes only numeric values
$(document).ready(function() {
    $("#forgot_mobile_number").keydown(function (e) {
		$('#forgot_mobile_number_id').html('');
		
        // Allow: backspace, delete, tab, escape, enter and .
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110]) !== -1 ||
             // Allow: Ctrl+A, Command+A
            (e.keyCode === 65 && (e.ctrlKey === true || e.metaKey === true)) || 
             // Allow: home, end, left, right, down, up
            (e.keyCode >= 35 && e.keyCode <= 40)) {
                 // let it happen, don't do anything
                 return;
        }
        // Ensure that it is a number and stop the keypress
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
			$(".error_forget").html('');
			$('#forgot_mobile_number_id').html('Mobile Number should be numeric');
            e.preventDefault();
        }
		else{
			$('#forgot_mobile_number_id').html(' ');
		}
    });
});
 // validate the input length of the mobile field
 function forgot_mobile_checkLength(el) {	 
	 $(".error_forget").html('');
  if (el.value != '' && el.value.length != 10) {
	
    $('#forgot_mobile_number_id').html('Mobile Number is not valid');			
	return false;
  }
  else if(el.value == ''){
	 $('#forgot_mobile_number_id').html('Please enter mobile number.');				
				return false; 
  }else{
	  $('#forgot_mobile_number_id').html('');				
				return true; 
  }
}

//  validate OTP number takes only numeric values
$(document).ready(function() {
    $("#forgototp").keydown(function (e) {
		$('#forgototp_id').html('');
		
        // Allow: backspace, delete, tab, escape, enter and .
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110]) !== -1 ||
             // Allow: Ctrl+A, Command+A
            (e.keyCode === 65 && (e.ctrlKey === true || e.metaKey === true)) || 
             // Allow: home, end, left, right, down, up
            (e.keyCode >= 35 && e.keyCode <= 40)) {
                 // let it happen, don't do anything
                 return;
        }
        // Ensure that it is a number and stop the keypress
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
			$(".error_forget").html('');
			$('#forgototp_id').html('You are trying to enter wrong otp');
            e.preventDefault();
        }
		else{
			$('#forgototp_id').html(' ');
		}
    });
});

 // validate the OTP length 
 function otpforgotcheckLength(otp) {
	// alert(e1);
  if (otp.value.length != 4) {
	$(".error_forget").html('');
    //$('#forgototp_id').html('OTP is not valid');
	
	return false;
  }
  else{
	 $('#forgototp_id').html('');				
	// $(".error").html('Please fill mandatory field.');
	return true; 
  }
}

function validate_forgot_password(){
	$(".forgot_password_section").find('button').find('.processing').removeClass('hide');
	$(".forgot_password_section").find('button').prop('disabled', true);
	var error = true;
	if($("input[name='mobile_number_varify']").val()	==	'')
	{
		error = false;
		$("input[name='mobile_number_varify']").css('border-bottom','1px solid #c8202d');
	}
	else if($("#forgot_mobile_number").val().length != 10)
	{
		error = false;
		$("input[name='mobile_number']").css('border-bottom','1px solid #c8202d');
	}
	else{
		$("input[name='mobile_number_varify']").css('border-bottom','');
	}
	
	if(error == true)
	{
		$(".error_forget").html('');
		jQuery.ajax({
			type: "POST",
			url: "<?php echo site_url('auth/forgot_password') ?>",    
			data: $("#forgot_password_form").serialize(),
			success: function(res) {
				
				res = JSON.parse(res);
				if(res['status'] == 'success')
				{
					//alert(res['status']);
					$("input[name='verify_user_id']").val(res['user_id']);
					$(".forgot_password_section").addClass('hide');
					$(".success").html(res['success_msg']);
					$(".error_forget").html('');
					$(".otp_section_verify").removeClass('hide');
				}else if(res['status'] == 'error'){
					$(".error_forget").html(res['error_msg']);
					$(".success").html('');
				}
				$(".forgot_password_section").find('button').find('.processing').addClass('hide');
				$(".forgot_password_section").find('button').prop('disabled', false);
			 }
		});
		return false;
	}else{
		$(".success").html('');
		if($("input[name='mobile_number_varify']").val() ==''){
			$('#forgot_mobile_number_id').html('');			
			$(".error_forget").html('Please fill mandatory field.');
		} else {
			$(".error_forget").html('');
		}
		$(".forgot_password_section").find('button').find('.processing').addClass('hide');
		$(".forgot_password_section").find('button').prop('disabled', false);
		return false;
	}
}

function validate_verify_otp(){
	$(".otp_section_verify").find('button').find('.processing').removeClass('hide');
	$(".otp_section_verify").find('button').prop('disabled', true);
	var error = true;
	if($("input[name='otp_verify']").val()	==	'')
	{
		error = false;
		$("input[name='otp_verify']").css('border-bottom','1px solid #c8202d');
	}else if($("#forgototp").val().length != 4)
	{
		error = false;
		$('#forgototp_id').html('OTP length is invalid');
		$("input[name='otp_verify']").css('border-bottom','1px solid #c8202d');
	}else{
		$("input[name='otp_verify']").css('border-bottom','');
	}
	
	if(error == true)
	{
		$(".error_forget").html('');		
		jQuery.ajax({
			type: "POST",
			url: "<?php echo site_url('auth/before_change_pass_otp_verify') ?>",    
			data: $("#otp_verify_form").serialize(),
			success: function(res) {
				
				res = JSON.parse(res);
				if(res['status'] == 'success')
				{   
					$("input[name='user_id_verify']").val(res['user_id']);
					$(".otp_section_verify").addClass('hide');
					$(".success").html(res['success_msg']);
					$(".error_forget").html('');
					$(".change_password_section").removeClass('hide');
				}else if(res['status'] == 'error'){
					$(".error_forget").html(res['error_msg']);
					$(".success").html('');
				}
				$(".otp_section_verify").find('button').find('.processing').addClass('hide');
				$(".otp_section_verify").find('button').prop('disabled', false);
			 }
		});
		return false;
	}else{
		
		
		
		
		
		
		
		
		if($("input[name='otp_verify']").val() ==''){
					
			$(".error_forget").html('Please fill mandatory field.');
			$('#forgototp_id').html('');
		} else {
			$(".error_forget").html('');
		}
		
		$(".success").html('');
		$(".otp_section_verify").find('button').find('.processing').addClass('hide');
		$(".otp_section_verify").find('button').prop('disabled', false);
		return false;
	}
}

function validate_change_password(){
	$(".change_password_section").find('button').find('.processing').removeClass('hide');
	$(".change_password_section").find('button').prop('disabled', true);
	var error = true;
	var value = $("input[name='change_password']").val();
	var value_conf = $("input[name='confirm_change_password']").val();
	
	var regularExpression = /^(?=.*[0-9])(?=.*[a-zA-Z])([a-zA-Z0-9]+).{5,}$/;
    var valid = regularExpression.test(value);
	var valid_conf = regularExpression.test(value_conf);
	if($("input[name='change_password']").val()	==	'')
	{
		error = false;
		$("input[name='change_password']").css('border-bottom','1px solid #c8202d');
	}
	else if($("input[name='change_password']").val().length < 6)
	{
		error = false;
		$(".error").html('');
		$('#p-error').html('Password should be 6 characters long');
		$("input[name='change_password']").css('border-bottom','1px solid #c8202d');
	}
	else if(!valid)
	{
		error = false;
		$("input[name='change_password']").css('border-bottom','1px solid #c8202d');
		$(".error").html('');
		$('#p-error').html('Password should be alphanumeric ');
	}
	
	else{
		$("input[name='change_password']").css('border-bottom','');
		$('#p-error').html('');
	}
	if($("input[name='confirm_change_password']").val()	==	'')
	{
		error = false;
		$("input[name='confirm_change_password']").css('border-bottom','1px solid #c8202d');
	}else if($("input[name='confirm_change_password']").val().length < 6)
	{
		error = false;
		$(".error").html('');
		$('#c-error').html('Password should be 6 characters long');
		$("input[name='confirm_change_password']").css('border-bottom','1px solid #c8202d');
	}
	else if(!valid_conf)
	{
		error = false;
		$("input[name='confirm_change_password']").css('border-bottom','1px solid #c8202d');
		$(".error").html('');
		$('#c-error').html('Password should be alphanumeric ');
	}
	
	else{
		$("input[name='confirm_change_password']").css('border-bottom','');
		$('#c-error').html('');
	}
	
	//var password = $("input[name='change_password']").val();
	//var confirm_change_password = $("input[name='confirm_change_password']").val();
    //    if (password != confirm_change_password) {
    //       $("input[name='confirm_change_password']").css('border-bottom','10px solid #c8202d');
    //        return false;
     //   }
     //   return true;
	
	if(error == true)
	{ 
		$(".error_forget").html('');
		jQuery.ajax({
			type: "POST",
			url: "<?php echo site_url('auth/change_password') ?>",    
			data: $("#change_password_form").serialize(),
			success: function(res) {
				
				res = JSON.parse(res);
				if(res['status'] == 'success')
				{   
					$("#forgot_password").addClass('hide');
					$("#login").modal('show');
					$(".success").html(res['success_msg']);
					$(".error_forget").html('');
					
				}else if(res['status'] == 'error'){
					$(".error_forget").html(res['error_msg']);
					$(".success").html('');
				}
				$(".change_password_section").find('button').find('.processing').addClass('hide');
				$(".change_password_section").find('button').prop('disabled', false);
			 }
		});
		return false;
	}else{
		$(".success").html('');
		$(".error_forget").html('Please fill all mandatory fields.');
		$(".change_password_section").find('button').find('.processing').addClass('hide');
		$(".change_password_section").find('button').prop('disabled', false);
		return false;
	}
}

$.validator.addMethod("mobno", function(value,element){
	return  /^[0-9]{10}$/.test(value);	
},''); 

/*$(document).ready(function() {   
   $('#user_registration_add').click(function(){
    jQuery.ajax({
		type: "POST",
		url: "<?php echo site_url('auth/user_registration') ?>",    
		data: $("#reg_form").serialize(),
		success: function(res) {
			alert(json.stringify(res));
			//$(".ajax_response_result").html(res);
		 }
    });
  });
});*/
</script>
<!--=Sign-up-form-End=-->
