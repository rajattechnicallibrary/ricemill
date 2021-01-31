<div class="passmain-content">
    <?= get_flashdata() ?>
    <h3>Change Password</h3>
    <form method="POST">
    <div class="changepassword_container">

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Current Password<span class="red">*</span></label>
                    <input type="password" name="currentpassword" class="form-control" id="" placeholder="" value="<?= ($_POST && $_POST['currentpassword'])?set_value('currentpassword'):"" ?>">
                    <span class="error"><?= form_error('currentpassword') ?></span>
                </div>
            </div>
            <div class="col-md-6">
                &nbsp;
            </div>

        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>New Password<span class="red">*</span></label>
                    <input type="password" name="newpassword" class="form-control" id="" placeholder="" value="<?= ($_POST && $_POST['currentpassword'])?set_value('newpassword'):"" ?>">
                    <span class="error"><?= form_error('newpassword') ?></span>
                </div>
            </div>
            <div class="col-md-6">
                &nbsp;
            </div>

        </div>


        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Confirm password<span class="red">*</span></label>
                    <input type="password" name="confirmpassword" class="form-control" id="" placeholder="" value="<?= ($_POST && $_POST['currentpassword'])?set_value('confirmpassword'):"" ?>">
                </div>
            </div>
            <div class="col-md-6">
                &nbsp;
            </div>

        </div>
    </div>
    <div class="row">
        <div class="col-md-12"><input type="submit" class="submit1" value="Change"></div>
    </div>
    </form>
</div><!-- Main Content -->
<?php
if($this->session->userdata('logout')   ==  '1')
{
    $this->session->unset_userdata('logout');?>
    <script>
        setTimeout(function(){
            window.location.href="<?=base_url()?>auth/logout";
        },4000);
    </script>
<?php }
?>