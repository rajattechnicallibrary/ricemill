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
<!-- BEGIN GLOBAL MANDATORY STYLES -->
<link href="<?=base_url()?>assets/css/bootstrap.css" rel="stylesheet">
    <link href="<?=base_url()?>assets/css/chart.css" rel="stylesheet">
    <link href="<?=base_url()?>assets/css/jqstooltip.css" rel="stylesheet">
    <link href="<?=base_url()?>assets/css/layout.css" rel="stylesheet">





<style>
        #loader {
            transition: all .3s ease-in-out;
            opacity: 1;
            visibility: visible;
            position: fixed;
            height: 100vh;
            width: 100%;
            background: #fff;
            z-index: 90000
        }
        
        #loader.fadeOut {
            opacity: 0;
            visibility: hidden
        }
        
        .spinner {
            width: 40px;
            height: 40px;
            position: absolute;
            top: calc(50% - 20px);
            left: calc(50% - 20px);
            background-color: #333;
            border-radius: 100%;
            -webkit-animation: sk-scaleout 1s infinite ease-in-out;
            animation: sk-scaleout 1s infinite ease-in-out
        }
        
        @-webkit-keyframes sk-scaleout {
            0% {
                -webkit-transform: scale(0)
            }
            100% {
                -webkit-transform: scale(1);
                opacity: 0
            }
        }
        
        @keyframes sk-scaleout {
            0% {
                -webkit-transform: scale(0);
                transform: scale(0)
            }
            100% {
                -webkit-transform: scale(1);
                transform: scale(1);
                opacity: 0
            }
        }
    </style>
</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->
<?php
$fs_email	=	'';
$fs_password	=	'';
$fs_remember	=	'';
if(get_cookie('fs_email',FALSE)!=NULL)
{
	$fs_email	=	get_cookie('fs_email',FALSE);
}

if(get_cookie('fs_password',FALSE)!=NULL)
{
	$fs_password	=	get_cookie('fs_password',FALSE);
}

if(get_cookie('fs_email',FALSE)!=NULL)
{
	$fs_remember	=	get_cookie('fs_remember',FALSE);
}
	
$fs_email_decr	=	custom_encryption($fs_email,'ak!@#s$on!','decrypt');
$fs_password_decr	=	custom_encryption($fs_password,'ak!@#s$on!','decrypt');

?>
<body class="app is-collapsed">
    <div id="loader">
        <div class="spinner"></div>
    </div>
   
 <main class="main-content bgc-grey-100 text-center">
 <form onsubmit="return validat_admin_login();"  id="login-form1" action="" method="post" >

                <div id="mainContent inline_block" style="display:inline-block;">
                    <div class="container-fluid text-left">
                        <div class="row">
						
						<div class="col-12 col-md-4 pX-30 pY-30 h-100 bgc-white scrollable pos-r" style="min-width:320px">
							<label class="display_block text-center">
								<img src="<?=base_url()?>assets/images/logo.png" alt="">
							</label>
						
							<h4 class="fw-300 c-grey-900 mB-30" style="font-size: 16px;color: #1a7fd0 !important;">Track (The Rest Accounting Key)</h4>
							<form>
								<div class="form-group">
								<?= get_flashdata() ?>	
									<label class="text-normal text-dark">Email</label>
									<input   id="email" class="form-control " type="text" autocomplete="off" placeholder="Email Address" name="email" value="<?php if(@$fs_remember && @$fs_email_decr!=''){echo @$fs_email_decr;}?>"/>
                    				<span class="help-block"><?php echo form_error('email'); ?></span>  

					
								</div>
								<div class="form-group">
									<label class="text-normal text-dark">Password</label>
									<input  id="password"  class="form-control" type="password" autocomplete="off" placeholder="Password" name="password" value="<?php if(@$fs_remember && @$fs_password_decr!=''){echo @$fs_password_decr;}?>"/>
                <span class="help-block"><?php echo form_error('password'); ?></span> 
								</div>
								<div class="form-check pull-right">
									<label class="form-check-label">
									<a href="<?=base_url()?>admin/auth/forgot" id="forget-password" >Forgot Password?</a>
									</label>
								</div>
								<br>
								<div class="clear"></div>
								<br>
								
								<div class="form-group">
									<div class="peers ai-c jc-sb fxw-nw">
										<div class="">
										<div class="checkbox checkbox-circle checkbox-info peers ai-c">
												<input type="checkbox" id="inputCall1" name="remember" class="peer" <?php if(@$fs_remember){echo "checked";}?>>
												<label for="inputCall1" class="peers peer-greed js-sb ai-c"><span class=" peer-greed">Remember Me</span></label>
											</div>
											
											
											
											
											
										</div>
										<div class="peer text-right">
											<button class="btn btn-primary">Login</button>
										</div>
									</div>
								</div>
							</form>
						</div>
                        </div>
                    </div>
                </div>
			</form>
            </main>

            

<!-- END LOGIN -->


<script type="text/javascript" src="<?=base_url()?>assets/js/vendor.js"></script>
    <script type="text/javascript" src="<?=base_url()?>assets/js/bundle.js"></script>
	<script src="<?=base_url()?>assets/global/plugins/jquery.min.js" type="text/javascript"></script>
<script src="<?=base_url()?>assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<!-- END CORE PLUGINS -->
<!-- BEGIN PAGE LEVEL PLUGINS -->
<script src="<?=base_url()?>assets/global/plugins/jquery-validation/js/jquery.validate.min.js" type="text/javascript"></script>
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<!-- END PAGE LEVEL SCRIPTS -->
<script>
jQuery(document).ready(function() {     
setTimeout(function(){ $("#errorMsg").hide();}, 4000);
});



  $("#login-form1").validate({
	rules: {
		email:{
			required:true,
			email: true
		},            
		password: {
			required: true        
		},            
	},       	              
	messages: {
		email: {
			required:'<span class="help-block" style="color:red">Email is required!</span>',
			email:'<span class="help-block" style="color:red">Invalid email format!</span>'
		},           
		password: {
			required:'<span class="help-block" style="color:red">Password is required!</span>'
		},
	}
});
</script>
<script type="text/javascript">
        window.addEventListener('load', () => {
            const loader = document.getElementById('loader');
            setTimeout(() => {
                loader.classList.add('fadeOut');
            }, 300);
        });
    </script>

<!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>