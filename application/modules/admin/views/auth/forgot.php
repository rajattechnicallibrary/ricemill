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
       

           <form class="forget-form" action="" method="post">
				<main class="main-content bgc-grey-100 text-center">
					<div id="mainContent inline_block" style="    display: block;    width: 25%;    margin: 0 auto;">
						<div class="container-fluid text-left">
						
							<div class="row">
							
					
							<div class="col-12 col-md-4 pX-30 pY-30 h-100 bgc-white scrollable pos-r" style="min-width:320px">
							<label class="display_block text-center">
							
									<img src="<?=base_url()?>assets/images/logo.png" alt="">
								</label>
								<h4 class="fw-300 c-grey-900 mB-30">Forgot Password</h4>
								<form>
									<div class="form-group">
									<?= get_flashdata() ?>
										<label class="text-normal text-dark">Email</label>
										<input class="form-control " type="text" autocomplete="off" placeholder="Email" name="email" />
									</div>
									<!--<div class="form-check pull-right">
										<label class="form-check-label">
											<a href="">Forgot Password ? </a>
										</label>
									</div>
									<br>
									<div class="clear"></div>
									<br>-->
									
									<div class="form-group">
										<div class="peers ai-c jc-sb fxw-nw">
											
											<div class="">
											<div class="alert alert-danger display-hide errorMsg" style="display:none;">
												<button class="close" data-close="alert"></button>
												<span>
												Enter your e-mail address below to reset your password. </span>
											</div>
											</div>
										</div>
									</div>
									
									
									<div class="form-group">
										<div class="peers ai-c jc-sb fxw-nw">
											
											
											<div class="peer text-right">

												<a href="<?=base_url()?>/admin/auth/login" id="back-btn" class="btn btn-default">Back</a>
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
			</form>
            

    </div>

<!-- END LOGIN -->

<script src="<?=base_url()?>assets/global/plugins/jquery.min.js" type="text/javascript"></script>
<script src="<?=base_url()?>assets/global/plugins/jquery-migrate.min.js" type="text/javascript"></script>
<script src="<?=base_url()?>assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="<?=base_url()?>assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
<script src="<?=base_url()?>assets/global/plugins/uniform/jquery.uniform.min.js" type="text/javascript"></script>
<script src="<?=base_url()?>assets/global/plugins/jquery.cokie.min.js" type="text/javascript"></script>
<!-- END CORE PLUGINS -->
<!-- BEGIN PAGE LEVEL PLUGINS -->
<script src="<?=base_url()?>assets/global/plugins/jquery-validation/js/jquery.validate.min.js" type="text/javascript"></script>
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="<?=base_url()?>assets/global/scripts/metronic.js" type="text/javascript"></script>
<script src="<?=base_url()?>assets/admin/layout/scripts/layout.js" type="text/javascript"></script>
<script src="<?=base_url()?>assets/admin/layout/scripts/demo.js" type="text/javascript"></script>
<script src="<?=base_url()?>assets/login.js" type="text/javascript"></script>
<script type="<?=base_url()?>text/javascript" src="assets/js/vendor.js"></script>
    <script type="<?=base_url()?>text/javascript" src="assets/js/bundle.js"></script>
<script>
$( ".uppercase" ).click(function() {
  $(".flash-row").remove();
  });
</script>
<!-- END PAGE LEVEL SCRIPTS -->
<script>
jQuery(document).ready(function() {     
Metronic.init(); // init metronic core components
Layout.init(); // init current layout
Login.init();
Demo.init();
setTimeout(function(){ 
	
	$("#errorMsg").hide();}, 4000);
});
</script>
<!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>