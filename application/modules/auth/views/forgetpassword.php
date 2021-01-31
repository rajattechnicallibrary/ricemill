<div class="acount-sec resetpass-sec">
    <div class="login-container">
        <div class="row">

            <div class="col-md-12">
                <div class="register-form">
                    <div class="row">
                        <div class="col-md-6 col-md-offset-3">  

                            <div class="account-form1">
                                
                                <form method="POST">
                                    <div class="row">
                                        <div class="feild col-md-12">
                                            <label class="text-center padding-bottom30">Enter Email to Reset Password ! </label>
                                            <span class="clearfix"></span>
                                            <?= get_flashdata() ?>
                                            <input type="text" placeholder="" name="email" value="<?= ($_POST)?set_value('email'):""?>"/>
                                            <span class="error"><?= form_error('email') ?></span>
                                        </div>
                                        <div class="feild col-md-12">
                                            <input type="submit" value="Reset Password" class="forgot_password_btn" />
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
