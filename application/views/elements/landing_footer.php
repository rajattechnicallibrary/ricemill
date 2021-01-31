    <footer>
        <div class="col">
            <ul>
			<?php if(empty(currentuserinfo()->id)){ ?>
			 <li>
			 <div class="seller-sign-up_btn" data-toggle="modal" data-target=""><a href="javascript:void(0);">Become a seller </a>
			 	<script>
					$(document).on('click',".seller-sign-up_btn",function(){
						$("#seller_sign-up").modal('show');
					});
				</script>
			 <div>
			 </li>			
			<?php } else {?>				
                <li><a href="<?php echo base_url();?>offers">Offers</a></li>
				
			<?php } ?>			
                <li><a href="<?php echo base_url();?>events">Events</a></li>
				<li><a href="<?php echo base_url();?>blogs">Blogs</a></li>
				<li><a href="<?php echo base_url();?>recipes">Recipes</a></li>
               
				 
            </ul>
        </div>
        <div class="col">
            <ul>
                <li><a href="<?php echo base_url();?>pages/index/aboutus">About Us </a></li>
                <li><a href="<?php echo base_url();?>contact_us">Contact Us</a></li>
                <li><a href="<?php echo base_url();?>advertise_with_us">Advertise with us </a></li>
				 <li><a href="<?php echo base_url();?>careers">Careers</a></li>
            </ul>
        </div>
        <div class="col">
            <ul>
                <li><a href="<?php echo base_url();?>report_spam">Report Spam </a></li>
                <li><a href="<?php echo base_url();?>pages/index/pressandnews">Press & News</a></li>
                <li><a href="<?php echo base_url();?>pages/index/returnpolicy">Return Policy</a></li>
				<li><a href="<?php echo base_url();?>chefs">Chefs</a></li>
            </ul>
        </div>
        <div class="col">
            <ul>
                <li><a href="<?php echo base_url();?>pages/index/privacypolicy">Privacy Policy </a></li>
                <li><a href="<?php echo base_url();?>pages/index/customerservice">Customer Service</a></li>
                <li><a href="<?php echo base_url();?>featured_dealers">Featured Dealers</a></li>
            </ul>
        </div>
          <div class="col">
            <ul>
                <li><a href="<?php echo base_url();?>cooking_institutes">Institutes/Campuses </a></li>
                <li><a href="<?php echo base_url();?>pages/index/guidelines">Guidelines for Users</a></li>
                <li><a href="<?php echo base_url();?>pages/index/terms_n_conditions">Terms and Conditions </a></li>
            </ul>
        </div>
        <div class="bottomstrip">Copyright &copy; RESTAURANT. All Rights Reserved</div>
    </footer>
<!--=Footer-End=-->
<!--=Sign-up-form-start=-->
<!-- Modal -->

<?= $this->load->view('elements/seller_signup'); ?>

<!--=Sign-up-form-End=-->