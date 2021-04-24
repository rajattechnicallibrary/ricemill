<!DOCTYPE html>
<html>
<head>
      <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
      <title><?=(isset($title)) ? $title : 'Track (The Rest Accounting Key)'?></title>
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta content="width=device-width, initial-scale=1" name="viewport"/>
      <meta content="" name="description"/>
      <meta content="" name="author"/>
      <meta charset="utf-8"/>
      <meta http-equiv="refresh" content="90000; url=<?=base_url()?>admin/auth/logout" />
      <?php $this->load->view('elements/header');?>
      <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
      <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>
        <link href="<?php echo base_url(); ?>assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css" rel="stylesheet" type="text/css"/>

   </head>
   <body class="app">
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
         <div class="sidebar">
            <div class="sidebar-inner">
               <div class="sidebar-logo">
                  <div class="peers ai-c fxw-nw">
                     <div class="peer peer-greed">
                        <a class="sidebar-link td-n" href="<?php echo base_url('admin/dashboard')?>">
                           <div class="peers ai-c fxw-nw">
                              <div class="peer">
                                 <div class="logo"><img src="<?php echo  base_url(); ?>assets/images/logo.png" alt=""></div>
                              </div>
                              <div class="peer peer-greed">
                                 <h5 class="lh-1 mB-0 logo-text"><?php 
                                 if($_SESSION['user_type'] == 1){
                                     echo "Administrator";
                                 }else{
                                    echo ucfirst(@currentuserinfo()->first_name . ' ' . @currentuserinfo()->last_name);
                                 }
                                 ?></h5>
                              </div>
                           </div>
                        </a>
                     </div>
                     <div class="peer">
                        <div class="mobile-toggle sidebar-toggle"><a href="#" class="td-n"><i class="ti-arrow-circle-left"></i></a></div>
                     </div>
                  </div>
               </div>
               <?php $this->load->view('elements/left_menu')?>
            </div>
         </div>


         <div class="page-container">
            <div class="header navbar">
               <div class="header-container">
                  <ul class="nav-left">
                     <li><a id="sidebar-toggle" class="sidebar-toggle" href="javascript:void(0);"><i class="ti-menu"></i></a></li>

                  </ul>
                 
                  <ul class="nav-right">
                     <li class="dropdown">
                     <a href="Javascript:void(0)" class="dropdown-toggle no-after peers fxw-nw ai-c lh-1" data-toggle="dropdown">
                           <div class="peer">
                              <span style="font-size: 15px; color:blue">Financial Year</span>
                              <span class="fsz-sm c-grey-900">
                                 <?= "|| ".ucfirst(@fy()->FY)?>
                              </span>
                              <span class="fsz-sm c-grey-900" style="color:blue">
                                 <?php if(@fy()->product_type == '1') { echo " || Paddy ||"; } ?>
                                 <?php if(@fy()->product_type == '2') { echo "|| Wheat ||"; } ?>
                              </span>
                              <span style="font-size: 13px; color:black" id="current_date"></span>
                             
                           </div>
                          
                        </a>
                     </li>
                     <li class="dropdown">
                        <a href="#" class="dropdown-toggle no-after peers fxw-nw ai-c lh-1" data-toggle="dropdown">
                           <div class="peer mR-10"><img class="w-2r bdrs-50p" src="assets/images/dp.jpg" alt=""></div>
                           <div class="peer"><span class="fsz-sm c-grey-900"><?=ucfirst(@currentuserinfo()->first_name . ' ' . @currentuserinfo()->last_name)?></span></div>
						                <span class="arrow"><i class="ti-angle-down my_cls"></i></span>
                        </a>
                        <?php
						if(!empty($_SESSION['user_type'])){
							if($_SESSION['user_type'] == 1){
		
						?>
						<ul class="dropdown-menu fsz-sm profile-menu">
                           <li><a href="<?=base_url('admin/profile')?>" class="d-b td-n pY-5 bgcH-grey-100 c-grey-700"><i class="ti-settings mR-10"></i> <span>My Profile</span></a></li>
                           <li><a href="<?=base_url('admin/profile/reset_password')?>" class="d-b td-n pY-5 bgcH-grey-100 c-grey-700"><i class="ti-settings mR-10"></i> <span>Change Password</span></a></li>
                           <li role="separator" class="divider"></li>
                           <li><a href="<?=base_url('admin/logout')?>" class="d-b td-n pY-5 bgcH-grey-100 c-grey-700"><i class="ti-power-off mR-10"></i> <span>Logout</span></a></li>
                        </ul>
						<?php
							}
						}
						?>
						<?php
						if(!empty($_SESSION['user_type'])){
							if($_SESSION['user_type'] == 2){
		
						?>
						<ul class="dropdown-menu fsz-sm profile-menu">
                           <li><a href="<?=base_url('advertiser/profile')?>" class="d-b td-n pY-5 bgcH-grey-100 c-grey-700"><i class="ti-settings mR-10"></i> <span>My Profile</span></a></li>
                           <!-- <li><a href="<?=base_url('advertiser/campaign')?>" class="d-b td-n pY-5 bgcH-grey-100 c-grey-700"><i class="ti-user mR-10"></i> <span>My Campaigns</span></a></li> -->
                           <li><a href="<?=base_url('advertiser/profile/reset_password')?>" class="d-b td-n pY-5 bgcH-grey-100 c-grey-700"><i class="ti-settings mR-10"></i> <span>Change Password</span></a></li>
                           <li role="separator" class="divider"></li>
                           <li><a href="<?=base_url('advertiser/logout')?>" class="d-b td-n pY-5 bgcH-grey-100 c-grey-700"><i class="ti-power-off mR-10"></i> <span>Logout</span></a></li>
                        </ul>
						<?php
							}
						}
						?>
						<?php
						if(!empty($_SESSION['user_type'])){
							if($_SESSION['user_type'] == 3){
		
						?>
						<ul class="dropdown-menu fsz-sm profile-menu">
                           <li><a href="<?=base_url('publisher/profile')?>" class="d-b td-n pY-5 bgcH-grey-100 c-grey-700"><i class="ti-settings mR-10"></i> <span>My Profile</span></a></li>
                           <!-- <li><a href="<?=base_url('publisher/campaign')?>" class="d-b td-n pY-5 bgcH-grey-100 c-grey-700"><i class="ti-user mR-10"></i> <span>My Campaigns</span></a></li> -->
                           <!-- <li><a href="<?=base_url('publisher/earning')?>" class="d-b td-n pY-5 bgcH-grey-100 c-grey-700"><i class="ti-settings mR-10"></i> <span>My Earnings</span></a></li> -->
                           <li><a href="<?=base_url('publisher/profile/reset_password')?>" class="d-b td-n pY-5 bgcH-grey-100 c-grey-700"><i class="ti-settings mR-10"></i> <span>Change Passsword</span></a></li>
                           <li role="separator" class="divider"></li>
                           <li><a href="<?=base_url('publisher/logout')?>" class="d-b td-n pY-5 bgcH-grey-100 c-grey-700"><i class="ti-power-off mR-10"></i> <span>Logout</span></a></li>
                        </ul>
						<?php
							}
						}
						?>
						
						
						
                     </li>
                  </ul>
               </div>
            </div>
            <?php $this->load->view($page)?>
            <?php $this->load->view('elements/footer')?>
         </div>
      </div>
    
      <script type="text/javascript" src="<?= base_url(); ?>assets/admin/assets/js/vendor.js"></script>
      <script type="text/javascript" src="<?= base_url(); ?>assets/admin/assets/js/bundle.js"></script>


<script src="<?php echo base_url(); ?>assets/global/plugins/jquery-migrate.min.js" type="text/javascript"></script>
<!-- IMPORTANT! Load jquery-ui.min.js before bootstrap.min.js to fix bootstrap tooltip conflict with jquery ui tooltip -->
<script src="<?php echo base_url(); ?>assets/global/plugins/jquery-ui/jquery-ui.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/global/plugins/jquery.cokie.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/global/plugins/uniform/jquery.uniform.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
<!-- END CORE PLUGINS -->
<!-- BEGIN PAGE LEVEL PLUGINS -->
<script type="text/javascript" src="<?php echo base_url(); ?>assets/global/plugins/select2/select2.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/global/plugins/datatables/media/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/global/plugins/datatables/extensions/TableTools/js/dataTables.tableTools.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/global/plugins/datatables/extensions/ColReorder/js/dataTables.colReorder.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/global/plugins/datatables/extensions/Scroller/js/dataTables.scroller.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js"></script>
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="<?php echo base_url(); ?>assets/global/scripts/metronic.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/admin/layout4/scripts/layout.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/admin/layout4/scripts/demo.js" type="text/javascript"></script>
<!--<script src="<?php echo base_url(); ?>assets/admin/pages/scripts/table-managed.js"></script>-->
<script src="<?php echo base_url(); ?>assets/admin/pages/scripts/form-samples.js"></script>

<!--jAlert -->
<!-- <script src="<?php echo base_url(); ?>assets/jquery-alert-dialogs/js/jquery.ui.draggable.js" type="text/javascript"></script> -->
<!-- Core files -->
<script src="<?php echo base_url(); ?>assets/jquery-alert-dialogs/js/jquery.alerts.js" type="text/javascript"></script>
<link href="<?php echo base_url(); ?>assets/jquery-alert-dialogs/css/jquery.alerts.css" rel="stylesheet" type="text/css" media="screen" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/global/plugins/select2/select2.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/datepicker/jquery-ui.css"/>

<!--End jAlert -->

<script type="text/javascript" src="<?php echo base_url(); ?>assets/datepicker/jquery-ui.js"></script>

<script type="text/javascript" src="<?php echo base_url(); ?>assets/select/fSelect.js"></script>
<script>
$(function() {
        $('.bs-select').fSelect();
    });
                           display_ct();
                           function display_ct() {
                              var today = new Date();

var date = today.getFullYear()+'-'+(today.getMonth()+1)+'-'+today.getDate();

var time = today.getHours() + ":" + today.getMinutes() + ":" + today.getSeconds();

var dateTime = date+' '+time;
document.getElementById('current_date').innerHTML = dateTime;
tt = display_c();
 }

</script>

<!-- BEGIN PAGE LEVEL PLUGINS -->
<script type="text/javascript" src="<?php echo base_url(); ?>assets/global/plugins/bootstrap-select/bootstrap-select.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/global/plugins/jquery-multi-select/js/jquery.multi-select.js"></script>
<!-- END PAGE LEVEL PLUGINS -->
<script src="<?php echo base_url(); ?>assets/admin/pages/scripts/components-dropdowns.js"></script>
<script src="<?php echo base_url(); ?>assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js"></script>

   </body>
</html>