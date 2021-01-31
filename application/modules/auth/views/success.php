<style type="text/css">
body{background-color:#f1f1f1; }
.orangebtnsuccess{display: inline-block !important; text-align: center !important; width: 100% !important;}
.orangebtnsuccess a{text-align: center; background: #faa61a;border:1px solid #faa61a !important; color:#fff !important; cursor:pointer; text-transform: uppercase; padding:5px 20px !important; border-radius:25px; width: 150px; margin:0 auto;}
.orangebtnsuccess a:hover{text-align: center;background-color:#323232 !important; border: 1px solid #323232 !important; color:#fff !important;cursor:pointer; text-transform: uppercase; padding:5px 20px !important; border-radius:25px; width: 150px; margin:0 auto;}
</style>
<div style="width: 600px; height:auto; margin: 0 auto; background: #f1f1f1; margin-top: 100px; margin-bottom: 100px;  border-radius: 5px;border: 1px solid #e4e4e4; display: block; overflow: hidden;">
							<div style="float:left;width: 580px; height:auto; background: #fff;  padding:100px 35px; margin: 10px;">
								<div style="text-align:center; "><img src="<?= base_url() ?>assets/images/email_registered_icon.png"/></div>
								<div style="font-family: arial; font-size: 16px; color:#3e8b0b; font-weight:normal; text-transform: uppercase; padding:10px 0px; text-align:center;">Successfully Registered !</div>
								<div class="orangebtnsuccess" ><a style="color: #fff !important;" href="<?php echo base_url('auth/login'); ?>">go to Login</a></div>
							</div>
						</div>
<?php
if($this->session->userdata('isLogin')  !=  'yes')
{
    //$this->session->unset_userdata('logout');?>
    <script>
        setTimeout(function(){
            window.location.href="<?=base_url()?>auth/login";
        },4000);
    </script>
<?php }
?>