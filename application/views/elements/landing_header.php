<?php //pr(get_image_thumb(currentuserinfo()->profile_image,'thumb'));die; ?>
<div class="outer">
<!--==Internal--Header-Section-Start==-->
<div class="container-fluid">
    <div class="int-header">
           <div class="wrapper">
            
        <!--=header-start=-->
            <header>
                <div class="logo-div">
                    <div class="logo"><a href="<?= base_url(); ?>"><img src="<?php echo base_url();?>frontend_assets/images/logo-big.png"/></a></div></div>
                <div class="navigation-div">
                    <nav class="navbar navbar-default">
                      <div class="container-fluid">
                        <!-- Brand and toggle get grouped for better mobile display -->
                        <div class="navbar-header">
                          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                          </button>                          
                        </div>                    
                        <!-- Collect the nav links, forms, and other content for toggling -->
                        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                          <ul class="nav navbar-nav">
                            <li class="<?= (uri_segment(1)== 'site' || uri_segment(1)== '')?"active":"" ?>"><a href="<?= base_url(); ?>">Home <span class="sr-only">(current)</span></a></li>
                            <li class="<?= (uri_segment(3)== 'aboutus')?"active":"" ?>"><a href="<?php echo base_url();?>pages/index/aboutus">About Us</a></li>
                            <li class="<?= (uri_segment(1)== 'advertise_with_us')?"active":"" ?>"><a href="<?php echo base_url();?>advertise_with_us">Advertise with us </a></li>
                            <li class="<?= (uri_segment(1)== 'careers')?"active":"" ?>"><a href="<?php echo base_url();?>careers">Careers</a></li>
                            <li class="<?= (uri_segment(1)== 'events')?"active":"" ?>"><a href="<?php echo base_url();?>events">Events</a></li>
                            <li class="<?= (uri_segment(1)== 'offers')?"active":"" ?>"><a href="<?php echo base_url();?>offers">Offers</a></li>
                            <!--<li class="dropdown">
                              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Dropdown <span class="caret"></span></a>
                              <ul class="dropdown-menu">
                                <li><a href="#">Action</a></li>
                                <li><a href="#">Another action</a></li>
                                <li><a href="#">Something else here</a></li>
                                <li role="separator" class="divider"></li>
                                <li><a href="#">Separated link</a></li>
                                <li role="separator" class="divider"></li>
                                <li><a href="#">One more separated link</a></li>
                              </ul>
                            </li>-->
                          </ul>
                       
                        
                        </div><!-- /.navbar-collapse -->
                      </div><!-- /.container-fluid -->
                    </nav>
                </div>
                <!--<div class="login-outer">
                    <div class="login-btn" data-toggle="modal" data-target="#sign-up"><a href="#">Register</a></div>
                    <div class="login-btn"  data-toggle="modal" data-target="#login"><a href="#">Login</a></div>
                </div>-->
				<?php if(empty(currentuserinfo()->id)){ ?>
                <div class="login-outer">
                    
                    <div class="login-btn" id="login-btn-for-other" data-toggle="modal" data-target="#login"><a href="javascript:void(0);">Login</a></div>
					<div class="login-btn sign-up_btn" data-toggle="modal" data-target=""><a href="javascript:void(0);">Register</a></div>
					<script>
						$(document).on('click',".sign-up_btn",function(){
							
							$("#sign-up").modal('show');
						});
					</script>
                </div>
				<?php }else{?>
                <div class="dropdown">
				<?php if(currentuserinfo()->profile_image != '' && file_exists("./uploads/user_image/".currentuserinfo()->profile_image)){ ?>
					 <img src="<?= base_url() ?>uploads/user_image/<?php echo get_image_thumb(currentuserinfo()->profile_image,'thumb'); ?>" class="img-circle" />
				<?php }else{ ?>
					<img src="<?= base_url() ?>frontend_assets/images/user.png"/>
				<?php } ?>
				  <button class="btn dropdown-toggle" type="button" data-toggle="dropdown">Welcome <?= currentuserinfo()->first_name ?>
                  	<span class="caret"></span></button>
                  <ul class="dropdown-menu">
                   <li><a href="<?php echo base_url();?>account">My Account</a></li>
				   <li><a href="<?php echo base_url();?>account/blogs">My Blogs</a></li>
				    <li><a href="<?php echo base_url();?>account/recipes">My Recipes</a></li>
                    <li><a href="<?php echo base_url();?>account/orders">My Order</a></li>
                    <li><a href="javascript:void(0);" class="newbee_up_btn">New Bee</a></li>
                    <li><a href="#">Priority Membership</a></li>
                    <li><a href="#">Change Password</a></li>
                    <li><a href="#">Deactivate or Delete Account</a></li>
                     <li><a href="<?php echo base_url();?>auth/logout">Sign Out</a></li>
                  </ul>
				  <script>
					$(document).on('click',".newbee_up_btn",function(){							
						$("#new_bee").modal('show');						
					});
					
				</script>
                </div>
					<?php } ?>
            </header>
        <!--=header-End=-->
        </div>
    </div>
</div>
<!--==Banner-Section-End==-->