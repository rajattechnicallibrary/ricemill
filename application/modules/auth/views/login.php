<?php
$email	=	'';
$password	=	'';
$remember	=	'';

if(get_cookie('email',FALSE)!=NULL)
{
    $email	=	get_cookie('email',FALSE);
}
if(get_cookie('password',FALSE)!=NULL)
{
	$password	=	get_cookie('password',FALSE);
}
if(get_cookie('remember',FALSE)!=NULL)
{
	$remember	=	get_cookie('remember',FALSE);
}
	
$email_decr	=	custom_encryption($email,'ak!@#s$on!','decrypt');
$password_decr	=	custom_encryption($password,'ak!@#s$on!','decrypt');
?>
<div class="acount-sec">
            <div class="login-container">
                <div class="row">
                    
                    <div class="col-md-12">
                      <div class="contact-sec-wrap">
                        <div class="contact-sec">
                            <?= get_flashdata() ?>
                            <div class="row">
                                <div class="col-md-6 col-md-offset-3">  
                                    <div class="widget-login-title">
                                        <div class="logo">
                                         <img src="<?= base_url() ?>assets/images/login_logo.png"/>
                                        </div>
                                    </div><!-- Widget title -->
                                    <div class="account-form">
                                        <span class="error"><?= @$error_msg ?></span>
                                        <form method="POST">
                                            <div class="row">
                                                <div class="feild col-md-12">
                                                    <input type="text" placeholder="E-Mail" name ="email" value="<?php if($remember && $email_decr!=''){echo $email_decr;}?>"/>
                                                    <span class="error"><?= form_error('email')?></span>
                                                </div>
                                                <div class="feild col-md-12">
                                                    <input type="password" placeholder="Password" name="password" value="<?php if($remember && $password_decr!=''){echo $password_decr;}?>"/>
                                                    <span class="error"><?= form_error('password')?></span>
                                                </div>
                                                
                                                <div class="feild col-md-12">
                                                    <input type="submit" value="Login" />
                                                </div>
                                                <div class="col-md-6">
    <!--<input type="checkbox" name="remember" id="test1"  value="1" <?= (@$remember)?"checked='true'":""?> />
    <label for="test1">Remember Me</label>-->
                                                
  
         <div class="checkbox margin-top0">
            <label class="remember-label">
              <input type="checkbox" name="remember" value="1" <?= (@$remember)?"checked='true'":""?>> Remember Me
              <span class="cr i18"><i class="cr-icon fa fa-check"></i></span>
             </label>
            </div>
         <!-- <label class="remember-label"><input type="checkbox" name="remember" value="1" <//?= (@$remember)?"checked='true'":""?>> Remember Me </label>-->
                                                </div>
                                                 <div class="col-md-6">
                                                 <label class="text-right"><a class="forgot-password" href="<?= base_url() ?>auth/forgetpassword">Forgot Password</a></label>
                                                 </div>
                                            </div>
                                        </form>
                                    </div>
                                    
                                </div>
                                
                            </div>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
        </div>
