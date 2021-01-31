<style>
.multiselect-native-select .btn{ border:1px solid #e7e2e2 !important;}
.dropdown-menu {
  position: absolute;
  top: 100%;
  right: 0;
  z-index: 1000;
  display: none;
  float: left;
  min-width: 230px;
  padding: 5px 0;
  margin: 2px 0 0;
  font-size: 14px;
  text-align: left;
  list-style: none;
  background-color: #fff;
  -webkit-background-clip: padding-box;
  background-clip: padding-box;
  border: 1px solid #ccc;
  border: 1px solid rgba(0, 0, 0, .15);
  border-radius: 4px;
  -webkit-box-shadow: 0 6px 12px rgba(0, 0, 0, .175);
  box-shadow: 0 6px 12px rgba(0, 0, 0, .175);
  width: 100% !important;
  max-height: 250px;
  overflow-x: hidden;
  overflow-y: scroll;
}
.sel_eror{position: absolute; height: 0px; margin-top: 32px; width: 860px; top: 33px; left: 0;}
</style>
<?php //pr($get_become_chef);die;?>
<div class="my-account-section">
	<div class="container container-margin">
		<div class="row">
		<?php echo get_flashdata(); ?>
			<?php echo $this->load->view('elements/user_left_menu');?>			
			<div class="col-md-9">
				<div class="account-right-section">
					 <div class="" id="">		
						<h1>I am a Chef</h1>
						<?php if(!empty($get_become_chef)){?>
						<div class="account-detail-form">
						<label class="account-label">Your Status is : <?php echo ($get_become_chef->is_approve == 'approve') ? 'Approved' : 'Disapproved'?></label>
						</div>
						<?php } else{?>
						<div class="account-detail-form">
						  <form action="<?php echo base_url();?>account/chef" method="post" id="become_chef_edit" onsubmit="return become_chef()">
							
						<div class="add-recipe-grid">
							<div class="form-group">
								<label class="account-label">Do you have prior experience of cooking ? <span class="required-span">*</span> </label>
								<?php 
								@$name = $get_become_chef->experience_of_cooking;
								?>
								<div class="clearfix"></div>
									<label class="radio_label">
									<input type="radio" name="experience_of_cooking"  value="yes" id="experience_of_cooking_yes"  <?php echo ($name == 'yes' ? 'checked' : '')?> > <span></span>Yes  
								    </label>
									<label class="radio_label">
									<input type="radio" name="experience_of_cooking"  value="no" id="experience_of_cooking_no"  <?php echo ($name == 'no' ? 'checked' : '')?> > <span></span>No
								</label>
								<span class="help-block" style="color:#c8202d" id="experience_of_cooking_alert"></span>
							</div>
						</div>
							
						<div class="<?php if(@$get_become_chef->experience_of_cooking=='yes'){
										echo 'experience_of_cooking';
									}else{
										echo 'experience_of_cooking hide'; 
									}
									?>">	
							<div class="add-recipe-grid-1">
							  <div class="form-group">
								<label class="account-label" for="">Brief Bio <span class="required" aria-required="true" style="color:#e02222;">* </span></label>
								<textarea name="brief_bio" class="form-control" maxlength="150" rows="2" cols="41"><?php echo set_value('brief_bio');?></textarea>
									<span class="help-block" style="color:#c8202d;"><?php echo form_error('brief_bio'); ?></span>
							  </div>
							</div>		
							<div class="add-recipe-grid-1">
							 <div class="form-group">
								<label for="" class="account-label">Website <span class="required" aria-required="true" style="color:#e02222;">* </span></label>
								<?php @$postvalue = @$_POST['website']; ?>											
								<input type="text" name="website" value="<?php echo (!empty($postvalue) ? $postvalue :"" ); ?>" class="form-control">
							  <span class="help-block" style="color:#c8202d;"><?php echo form_error('website'); ?></span>
							  </div>
							</div>
									
							<div class="add-recipe-grid-1">
							<div class="form-group margin-top20">
								<label for="" class="account-label margin-top-25">Cooking Expert Level <span class="required" aria-required="true" style="color:#e02222;">* </span></label>
							 <div class="select-style form-control">
								<select name="cooking_expert_level">
									<option value="">Select Cooking Expert Level</option>
									<option value="1" <?= (@$_POST['cooking_expert_level'] == '1' ) ? 'selected' : '' ?>>Professional</option>
									<option value="2"  <?= (@$_POST['cooking_expert_level'] == '2'  ) ? 'selected' : '' ?> >Part-time</option>														
									<option value="3" <?= (@$_POST['cooking_expert_level'] == '3' ) ? 'selected' : '' ?>>Hobby</option>
									<option value="4"  <?= (@$_POST['cooking_expert_level'] == '4') ? 'selected' : '' ?> >Just for Fun</option>														
								</select>
								<span class="help-block"><?php echo form_error('cooking_expert_level'); ?></span>
							</div>				
							  </div>
							  </div>		
							
							
							<div class="add-recipe-grid-1">
                                    <div class="form-group margin-top20">
                                       <label for="" class="account-label margin-top-25">Cuisine Speciality <span class="required" aria-required="true" style="color:#e02222;">* </span></label>
                                        <div class="" >  
											<select id="cuisine_speciality" name="cuisine_speciality[]" class="multiselect-ui form-control" multiple="multiple">
											<?php foreach($get_cuisine as $key => $val){?>
											<option value="<?php echo $val->id?>"><?php echo $val->name?></option>
											<?php }?>
											</select>
                                        </div>
                                        <span class="help-block" id="cuisines_category_id"><?php echo form_error('cuisine_speciality[]'); ?></span>
                                    </div>
                                </div>

								<div class="add-recipe-grid-1">
									<div class="form-group">
										<label for="" class="account-label">Where do you work ? <span class="required" aria-required="true" style="color:#e02222;">* </span></label>
										<?php @$postvalue = @$_POST['work_location']; ?>											
										<input type="text" name="work_location" value="<?php echo (!empty($postvalue) ? $postvalue :"" ); ?>" class="form-control"  maxlength="120">
										<span class="help-block" style="color:#c8202d;"><?php echo form_error('work_location'); ?></span>
									</div>
								</div>	
							
							<div class="add-recipe-grid-1">
								<div class="form-group margin-top20">
									<label class="account-label margin-top-25" >Number of Years Experience  <span class="required-span">*</span>
									<div class="select-style form-control">
									<?php 
									@$name = $_POST['years_of_experience'];
									?>
									<select name="years_of_experience" id="years_of_experience">
									    <option value="" >Select Number of Years Experience</option>
										<option value="0-1" <?php echo ($name == '0-1' ? 'selected' : '')?>>0-1 Years Experience </option>
										<option value="1-5" <?php echo ($name == '1-5' ? 'selected' : '')?>>1-5 Years Experience </option>
										<option value="5-10" <?php echo ($name == '5-10' ? 'selected' : '')?>>5-10 Years Experience </option>
										<option value="10-20" <?php echo ($name == '10-20' ? 'selected' : '')?>>10-20 Years Experience </option>
										<option value="20-30" <?php echo ($name == '20-30' ? 'selected' : '')?>>20-30 Years Experience </option>
									</select>
									</div>
									<span class="help-block" style="color:#c8202d" id="years_of_experience_alert"></span>
								</div>
							</div>
							
							<div class="add-recipe-grid-1">
								<div class="form-group margin-top20">
									<label class="account-label margin-top-25" >Define your profile  <span class="required-span">*</span></label></label>
									<?php 
									@$name = $_POST['profile_type'];
									?>
									<div class="select-style form-control">
									<select name="profile_type" id="profile_type">
										<option value="">Select Define your profile</option>
										<option value="fresher" <?php echo ($name == 'fresher' ? 'selected' : '')?>>Fresher</option>
										<option value="experienced" <?php echo ($name == 'experienced' ? 'selected' : '')?>>Experienced</option>
									</select>
									</div>
									<span class="help-block" style="color:#c8202d;margin:11px 0px 4px -11px;" id="profile_type_alert"></span>
								</div>
							</div>
							</div>
						<div class="<?php if(@$get_become_chef->experience_of_cooking=='yes'){
										echo 'submit';
									}else{
										echo 'submit hide'; 
									}
									?>">
							<div class="text-center margin_top_btm_20 col-md-12" > <!--style="float: left;padding-left:10px; width:100%;"--> 
								<button type="submit" class="account-btn-save">Save</button>
							</div>
						</div>	
						  </form>
						</div>
						<?php }?>
                    </div>  
				</div>
			</div>
		</div>
	</div>

</div>

<script src="http://localhost/myfoodstall/assets/global/plugins/jquery-validation/js/jquery.validate.min.js" type="text/javascript"></script>
<script>
$('#experience_of_cooking_yes').on('click',function(){
	$(".experience_of_cooking").removeClass('hide');
	$(".submit").removeClass('hide');
});

$('#experience_of_cooking_no').on('click',function(){
	$(".experience_of_cooking").addClass('hide');
	$(".submit").removeClass('hide');
});


/* function become_chef()  
	{
		var experience_of_cooking = $("input[name='experience_of_cooking']:checked").val();
		if(experience_of_cooking == 'yes'){
		var error = true;
		$("input[name='experience_of_cooking[]']").each(function(){
			if($(this).val() == ''){
				error = false;
				$("#experience_of_cooking_alert").html('DO YOU HAVE PRIOR EXPERIENCE OF COOKING IS REQUIRED !');
			}else{
				$("#experience_of_cooking_alert").html('');
			}
		});
		$("select[name='years_of_experience']").each(function(){
			if($(this).val() == ''){
				error = false;
				$("#years_of_experience_alert").html('NUMBER OF YEARS EXPERIENCE IS REQUIRED !');
			}else{
				$("#years_of_experience_alert").html('');
			}
		});
		$("select[name='profile_type']").each(function(){
			if($(this).val() == ''){
				error = false;
				$("#profile_type_alert").html('NUMBER OF YEARS EXPERIENCE IS REQUIRED !');
			}else{
				$("#profile_type_alert").html('');
			}
		});
		return error;
		}
	} */

	$("#become_chef_edit").validate({
	rules: {
		
		brief_bio:{
			required:true,
		},
		website:{
			required:true,
			url:true,
		},
		cooking_expert_level:{
			required:true,
		},
		'cuisine_speciality[]':{
			required:true,
		},
		work_location:{
			required:true,
		},
		years_of_experience:{
			required:true,
		},
		profile_type:{
			required:true,
		},
	},       	              
	messages: {
		
		brief_bio: {
			required: '<span class="help-block" style="color:#c8202d">Brief Bio is required !</span>',
		},
		website: {
			required: '<span class="help-block" style="color:#c8202d">Website is required !</span>',
			url: '<span class="help-block" style="color:#c8202d">Valid Website is required !</span>',
		},
		cooking_expert_level: {
			required: '<span class="help-block" style="color:#c8202d;margin:11px 0px 4px -11px">Cooking Expert Level is required !</span>',
		},
		'cuisine_speciality[]': {
			required: '<span class="help-block sel_eror" style="color:#c8202d;margin:11px 0px 4px 0px; width: 230px;">Cuisine Speciality is required !</span>',
		},
		work_location: {
			required: '<span class="help-block" style="color:#c8202d">Work is required !</span>',
		},
		years_of_experience: {
			required: '<span class="help-block" style="color:#c8202d;margin:11px 0px 4px -11px">Years of Experience is required! </span>',
		},
		profile_type: {
			required: '<span class="help-block" style="color:#c8202d;margin:11px 0px 4px -11px">Profile Type is required ! </span>',
		},
	}
});
	
	
	
</script>

