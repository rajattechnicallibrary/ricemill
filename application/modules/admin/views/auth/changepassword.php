<!DOCTYPE html>

<html lang="en">
<!-- BEGIN HEAD -->
<head>
<meta charset="utf-8"/>
<title><?=(isset($title))?$title:'Track (The Rest Accounting Key)'?></title>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<meta http-equiv="Content-type" content="text/html; charset=utf-8">
<meta content="" name="description"/>
<meta content="" name="author"/>
<link href="<?=base_url()?>assets/css/bootstrap.css" rel="stylesheet">
    <link href="<?=base_url()?>assets/css/chart.css" rel="stylesheet">
    <link href="<?=base_url()?>assets/css/jqstooltip.css" rel="stylesheet">
    <link href="<?=base_url()?>assets/css/layout.css" rel="stylesheet">
<!-- END THEME STYLES -->
</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->
<body class="app is-collapsed">
    <div id="loader">
        <div class="spinner"></div>
    </div>
    <script type="text/javascript">
        window.addEventListener('load', () => {
            const loader = document.getElementById('loader');
            setTimeout(() => {
                loader.classList.add('fadeOut');
            }, 300);
        });
    </script>
    <div>
       

				<main id="chngpswd" class="main-content bgc-grey-100 text-center">
					<div id="mainContent inline_block" style="display:inline-block;">
						<div class="container-fluid text-left contwith">
						
							<div class="row">					
					
							<div class="col-12 col-md-4 pX-30 pY-30 h-100 bgc-white scrollable pos-r" style="min-width:320px">
							<label class="display_block text-center">
							
									<img src="<?=base_url()?>assets/images/logo.png" alt="">
								</label>
								<h4 class="fw-300 c-grey-900 mB-30 text-center">Reset Password</h4>
								<?php echo form_open('', array('class' => '', 'id' => 'teamForm')); ?>
									<div class="form-group">
									<?= get_flashdata() ?>
										<label class="text-normal text-dark ">Password</label>
										<input type="password" class="input-content form-control col-md-12" name="new_password" value="" placeholder="New Password">
									</div>
									<div class="form-group">
										<label class="text-normal text-dark">Confirm Password</label>
										<input type="password" class="input-content form-control col-md-12" name="confirm_password" value=""  placeholder="Confirm Password">
									</div>
		
									<div class="form-group">
										<div class="peers ai-c jc-sb fxw-nw">
											<div class="peer text-right">
												<button type="submit" class="btn btn-primary">Submit</button>
											</div>
										</div>
									</div>
								</form>
							</div>
							</div>
						</div>
					</div>
				</main>
    </div>

<script src="<?=base_url()?>assets/global/plugins/jquery.min.js" type="text/javascript"></script>

<script src="<?=base_url()?>assets/global/plugins/jquery-validation/js/jquery.validate.min.js" type="text/javascript"></script>

<script>
//  validate mobile number takes only numeric values
$(document).ready(function() {
    $("#mo").keydown(function (e) {
		$('#mobile_number_id').html('');

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
			$('#mobile_number_id').html('');
            e.preventDefault();
        }
		else{
			$('#mobile_number_id').html("");
		}
    });
});


$("input[name='password']").keypress(function( e ) {
    if(e.which === 32) 
        return false;
});
 $("input[name='new_password']").keypress(function( e ) {
    if(e.which === 32) 
        return false;
});
$("input[name='confirm_password']").keypress(function( e ) {
    if(e.which === 32) 
        return false;
});

//Our validation script will go here.
    $(document).ready(function(){
    
       //custom validation rule - text only
      $.validator.addMethod("alphnumOnly", 
                              function(value, element) {
                                  return /^(?=.*[0-9])(?=.*[a-zA-Z])([a-zA-Z0-9]+).{5,}$/.test(value);
                              }, 
                              "Password should be alphanumeric and not less than 6 characters"
      );

$.validator.addMethod("is_password_match", function(value,element) {
 var newPass =   $("input[name='new_password']").val();
 if(newPass==value){
     return true;
 }
 return false;
},'');  

});

 $("#teamForm").validate({
    rules: {

        new_password:{
            required: true,
            alphnumOnly: true,
        },
        confirm_password:{
            required: true,
			alphnumOnly: true,
            is_password_match:true,
        }
    },
    messages:{

            new_password:{
               required: '<div class="help-block" style="color:red"> New password is required.</div>',
               alphnumOnly: '<div class="help-block" style="color:red"> Password should be alphanumeric and not less than 6 characters.</div>'
            },
            confirm_password:{
               required: '<div class="help-block" style="color:red"> Confirm password is required.</div>',
               alphnumOnly: '<div class="help-block" style="color:red"> Password should be alphanumeric and not less than 6 characters.</div>',
               is_password_match:'<span class="help-block" style="color:red">New Password & Confirm New Password should be same.</span>',
              }
        }
});

	</script>
<!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>