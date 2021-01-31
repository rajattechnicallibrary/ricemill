<!DOCTYPE html>
<html>
<head>
    <!-- Meta-Information -->
    <title><?= (@$title)?$title:"Rate-It" ?></title>
    <meta charset="utf-8">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Vendor: Bootstrap Stylesheets http://getbootstrap.com -->
    <link rel="stylesheet" href="<?= base_url() ?>assets/css/bootstrap.min.css">
    <!-- Our Website CSS Styles -->
    <link rel="stylesheet" href="<?= base_url() ?>assets/css/icons.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/css/main.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/css/responsive.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/css/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
   <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/css/bootstrap-multiselect.css" type="text/css"/>-->    
    <link rel="stylesheet" href="<?= base_url() ?>assets/css/bootstrap-select.css">
	<link rel="icon" href="<?= base_url() ?>assets/images/favicon_32.ico" type="image/ico" sizes="16x16">
	
</head>
<body>
<!--<div id="progressBar">
    <div class="loader"></div>
</div>-->     
<div class="main-content">

<div class="account-user-sec">
    <div class="account-sec">
        <div class="account-top-bar">
            <div class="login-container">
                 <div class="logo-top">
                    <a href="<?= base_url()?>auth" title=""><img src="<?= base_url() ?>assets/images/logo.png"/></a>
                </div>
                <ul class="account-header-link">
                    <?php if($this->session->userdata('isLogin')    ==  'yes'){ ?>
                    <li><a href="javascript:void(0);" title="">Welcome <?= currentuserinfo()->businessname?></a></li>
                        <li><a href="<?= base_url() ?>auth/logout" title="">Logout</a></li>
                    <?php }else{ ?>
                        <li><a href="<?= base_url() ?>auth/login" class="<?= (uri_segment(2)=='login')?"active":"" ?>" title="">Login</a></li>
                        <li><a href="<?= base_url() ?>auth/register" class="<?= (uri_segment(2)=='register')?"active":"" ?>">Register</a></li>
                        <li><a href="<?= base_url() ?>auth/forgetpassword" class="<?= (uri_segment(2)=='forgetpassword')?"active":"" ?>">Forgot Password</a></li>
                    <?php } ?>    
                </ul>
            </div>
        </div>
        <?php $this->load->view($page);?>
        <footer>
            <div class="container">
            <div class="col-md-6">
             <div class="footer_center"><a class="forgot-password" href="<?= base_url() ?>pages/terms_n_conditions">Terms &amp; Conditions</a>
             <a class="privacy_policy text-success" href="<?= base_url() ?>pages/privacy_policy">Privacy Policy</a>
             </div>
            </div>
            <div class="col-md-6">
                <p>Copyright:  © Seekers Tech</p>
                </div>
                
            </div>
        </footer>
    </div><!-- Account Sec -->
</div>

</div><!-- Main Content -->


<!-- Vendor: Javascripts -->

<!--<script src="<?= base_url() ?>assets/js/jquery-2.1.3.js"></script>-->
<script src="<?= base_url() ?>assets/js/bootstrap.min.js"></script>

<!-- Our Website Javascripts -->
<script src="<?= base_url() ?>assets/js/bootstrap-multiselect.js"></script>
<link rel="stylesheet" href="<?= base_url() ?>assets/css/bootstrap-multiselect.css"/>
<script src="<?= base_url() ?>assets/js/bootstrap-select.js"></script>
<script src="<?= base_url() ?>assets/js/index.js"></script>




</body>
</html>
