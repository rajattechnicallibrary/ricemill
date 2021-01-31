<style>
.alert {
	display: block;
	textarea{white-space:pre}
}

</style>
<link href="<?= base_url() ?>frontend_assets/plugin/owlslider/owl.carousel.min.css" rel="stylesheet" type="text/css"/>
<link href="<?= base_url() ?>frontend_assets/plugin/owlslider/owl.theme.default.min.css" rel="stylesheet" type="text/css"/>
<!--Blog-Form-Start-->
<?php echo get_flashdata();?>
<div class="container">
    <div class="add-recipe-main">
	<form onsubmit="return validate_blogs()" method="post" action="<?php echo base_url(); ?>account/blogs/edit?id=<?php echo ID_encode($result->id) ?>" id="blogs_edit" enctype="multipart/form-data" >
        <h1>Update Blog</h1>
        <div class="add-recipe-form">
		
                <div class="add-recipe-grid">
                  <div class="form-group">
                    <label for="">Blog Title<span class="required" aria-required="true" style="color:#e02222">
											* </span> </label>
					<?php 
					
					
					
					$name = $result->title;
					$postvalue = @$_POST['title'];
					?>
                    <input type="text" name="title" value="<?php echo (!empty($postvalue) ? $postvalue :$name)?>" class="form-control" id="" placeholder="Blog Title " maxlength="120">
                  <span class="help-block" style="color:#c8202d"><?php echo form_error('title'); ?></span>
				  </div>
                </div>
                
                <div class="add-recipe-grid">
                  <div class="form-group">
                    <label for="">Description <span class="required" aria-required="true" style="color:#e02222">
											* </span> </label>
					<?php 
					$name = $result->description;
					$postvalue = @$_POST['description'];
					?>
                    <!--<input type="text" name="description" value="<?php //echo (!empty($postvalue) ? $postvalue :$name) ?>" class="form-control" id="" placeholder="Description" maxlength="3000" />-->
					<textarea name="description"  class="form-control" id="blogs_descriptions" placeholder="Description"  rows="2" cols ="40"><?php echo (!empty($postvalue) ? $postvalue :$name) ?></textarea>
					<span class="help-block" id="blogs_descriptions-error" style="color:#c8202d;font-family: OpenSans-Semibold;"></span>
                  </div>
                </div>
                <div class="add-recipe-grid">
				<?php
				
						$upload_blogs_img_path = base_url()."uploads/seller_blogs_image/";
						$blog_img_name = $result->image;
						//pr($blog_img_name);
									if (!file_exists($upload_blogs_img_path.$blog_img_name))
									{
										 $image_blog_path =  $upload_blogs_img_path.$blog_img_name;   
									}
									else
									{
										 $image_blog_path = ""; 
									}
									 
									
							?>
                        <label class="account-label1">Upload image </label><span id ='logo_upload_one' class="hide" style="color:red;text-transform:initial;"> (Image not Uploaded)</span>
							<div class="col-ting">
								<div class="control-group file-upload" id="file-upload1">
								<div class="upload-s">
								  <div class="image-box text-center" style="height:120px;">
								  <?php if (@$blog_img_name==""){?>
							<i class="fa fa-cloud-upload"></i> <br> Upload Image
							<?php } ?>
							<input type="hidden" name="old_image" value="<?=$result->image;?>">
							<img src="<?php echo $image_blog_path;?>" alt="" style="display:block; align:center;" alt=""></div>
								  <div class="controls">
								  <input type="file" name="image" id="image" />
								  </div>
							 </div>										  
								</div>
								<br/>Image size should be greater than 800 X 450 pixels<br/>Only jpg, jpeg, png image allowed<br/><br/>
							</div>
                </div>
				
				
                <div class="add-recipe-grid-1">
                <div class="form-group margin-top20">
                    <label for="" class="margin-top-25">Menu Category <span class="required" aria-required="true" style="color:#e02222">
											* </span> </label>
                    <div class="select-style form-control">
                      <select name="menu_category" id="menu_category">
                        <option value="">Select Menu Category </option>
						 <?php if(!empty($menu_category)){ 
								 foreach($menu_category as $key => $val){
									 if(@$result->menu_category == $val->id){
									   $selected= 'selected="selected"';  
									 } else if(@$_POST['menu_category']){
									   $selected= 'selected="selected"';
									 } else{
										 $selected= '';  
									 }      
								 ?>
							<option value="<?=$val->id?>" <?=$selected?> ><?=$val->name?></option>
							 <?php }} else{ ?>
							<option value="">No State Available</option>
							 <?php } ?>
                      </select>
                    </div>
					  <span class="help-block" style="color:#c8202d"><?php echo form_error('menu_category'); ?></span>
					  
                </div>
				 
                  </div>
                  
                  
                  <div class="add-recipe-grid-1">
                <div class="form-group margin-top20">
                    <label for="" class="margin-top-25">Menu Subcategory <span class="required" aria-required="true" style="color:#e02222">
											* </span></label>
                    <div class="select-style form-control">
                      <select name="menu_sub_category" id="menu_sub_category">
							<?php if(!empty($menu_sub_category)){ 
								foreach($menu_sub_category as $key => $val){
									if(@$result->menu_sub_category == $val->id){
										$selected= 'selected="selected"';  
										} else if(@$_POST['menu_sub_category']){
										$selected= 'selected="selected"';
										} else{
										$selected= '';  
										}      
										?>
										<option value="<?=$val->id?>" <?=$selected?> ><?=$val->name?></option>
									<?php }} else{ ?>
								<option value="">No State Available</option>
							<?php } ?>
                      </select>
                    </div>
					 <span class="help-block" style="color:#c8202d"><?php echo form_error('menu_sub_category'); ?></span>
					 <span class="help-block" id="menu_subcategory_alert" style="color:#c8202d;font-family: OpenSans-Semibold;"></span>
                  </div>
                  </div>
                  
                <div class="add-recipe-grid">
					<div class="form-group">
					<label for="">Food Category </label>
					<div class="clearfix"></div>
					     <label class="radio_label">
						   <input type="radio" name="food_category" value="1" <?php echo ($result->food_category == '1' ? 'checked' : '')?> > <span></span>  Drink
						</label>
						 <label class="radio_label">
						   <input type="radio" name="food_category" value="2" <?php echo ($result->food_category == '2' ? 'checked' : '')?> > <span></span> Dessert
						</label>
                        <label class="radio_label">
						   <input type="radio" name="food_category" value="3" <?php echo ($result->food_category == '3' ? 'checked' : '')?>> <span></span> Snack
						</label>
                        <label class="radio_label">
						   <input type="radio" name="food_category" value="4" <?php echo ($result->food_category == '4' ? 'checked' : '')?>> <span></span> Food
						</label>
					</div>
					</div>
                    
                     <div class="add-recipe-grid">
					<div class="form-group">
					<label for="">Food Type </label>
					<div class="clearfix"></div>
					     <label class="radio_label">
						   <input type="radio" name="food_type" value="1" checked <?php echo ($result->food_type == '1' ? 'checked' : '') ?>  > <span></span>  Veg
						</label>
						 <label class="radio_label">
						   <input type="radio" name="food_type" value="2" <?php echo ($result->food_type == '2' ? 'checked' : '') ?> > <span></span> Non-Veg
						</label>
                       </div>
					</div>
                    
                    <div class="add-recipe-grid">
					<div class="form-group">
					<label for="">Level of Cooking</label>
					<div class="clearfix"></div>
					     <label class="radio_label">
						   <input type="radio" name="difficulty_level" value="1" checked <?php echo ($result->difficulty_level == '1' ? 'checked' : '') ?> > <span></span>  Easy
						</label>
						 <label class="radio_label">
						   <input type="radio" name="difficulty_level" value="2" <?php echo ($result->difficulty_level == '2' ? 'checked' : '') ?>> <span></span> Moderately
						</label>
                        <label class="radio_label">
						   <input type="radio" name="difficulty_level" value="3" <?php echo ($result->difficulty_level == '3' ? 'checked' : '') ?>> <span></span> Need More efforts to cook
						</label>
					</div>
					</div>
                    
                    
                    <div class="add-recipe-grid">
					<div class="form-group">
					<label for="">Cooking Time</label>
					<div class="clearfix"></div>
					     <label class="radio_label">
						   <input type="radio" name="cooking_time" value="1" checked <?php echo ($result->cooking_time == '1' ? 'checked' : '') ?> > <span></span>  Less than 5 mins
						</label>
						 <label class="radio_label">
						   <input type="radio" name="cooking_time" value="2" <?php echo ($result->cooking_time == '2' ? 'checked' : '') ?>> <span></span> 5-15 mins
						</label>
                        <label class="radio_label">
						   <input type="radio" name="cooking_time" value="3" <?php echo ($result->cooking_time == '3' ? 'checked' : '') ?>> <span></span> 15-30 mins and More than 30 mins
						</label>
					</div>
					</div>
                    
                    <div class="add-recipe-grid">
                  <div class="form-group">
                    <label for="">URL of Your Blog (If any)</label>
					<?php 
					$name = $result->blog_url;
					$postvalue = @$_POST['blog_url'];
					?>
                    <input type="text" class="form-control" name="blog_url" value="<?php echo (!empty($postvalue) ? $postvalue :$name) ?>" id="" placeholder="Url of Blog">
                  <span class="help-block" style="color:#c8202d"><?php echo form_error('blog_url'); ?></span>
				  </div>
                </div>
				
				
				
				<!--  <div class="add-recipe-grid-1">
                <div class="form-group margin-top20">
                    <label for="" class="margin-top-25">Status </label>
                    <div class="select-style form-control">
                      <select name="status" id="statis-id">
							<option value="active" <?//= (@$result->status == 'active') ? 'selected' : '' ?>>Active</option>
							<option value="inactive"  <?= (@$result->status == 'inactive') ? 'selected' : '' ?> >Inactive</option>														
						</select>
                    </div>
					 <span class="help-block" style="color:#c8202d"><?php echo form_error('status'); ?></span>
					 
                  </div>
                  </div>-->
				
                    
                  
              </div>
               <div class="recipe-btn-main">
                    
					<button type="submit" class="recipe-submit-button">Submit</button>
					<button type="button" class="recipe-submit-button cancel-button">Cancel</button>
               </div>
			</form>
        </div>
       
</div>
<!--Blog-Form-End-->

<!--Add-banner-->
<div class="container">
    <div class="control-add-banner">
        <img src="<?= base_url() ?>frontend_assets/images/control-add-banner.png"/>
    </div>
</div>
<!--Add-banner-->
<script>

// only letters with space

$.validator.addMethod("leters_space",function(value,element){
	if(value=='' || value==null)
	{
		return true;
	}
	return  /^[a-zA-Z-,]+(\s{0,1}[a-zA-Z-, ])*$/.test(value);
	},'')
	
// only numbers and letters 

$.validator.addMethod("leters_numbers_space",function(value,element){
	if(value=='' || value==null)
	{
		return true;
	}
	return  /^[a-zA-Z0-9,]+(\s{0,1}[a-zA-Z0-9, ])*$/.test(value);
	},'')	
	
	
$('.cancel-button').on('click',function(){
	url = '<?php echo base_url() ?>account/blogs';
	location = url;
});

$('#menu_category').on('change',function(){
	var menu_category_id = $(this).val();
	$.ajax({
		type:"post",
		url:"<?php echo base_url();?>account/blogs/get_menu_subcategory",
		data:{menu_category_id:menu_category_id},
		success:function(data){
			data = JSON.parse(data);
			$('#menu_sub_category').html(data);
		}
	});
});

$("#blogs_edit").validate({
	rules: {
		title:{
			required:true,
			leters_numbers_space:true,
		},
		description:{
			required:true,
			//leters_numbers_space:true,
		},
		blog_url: {
		 //required: true,
		url:true,
		},
		menu_category:{
			required:true,
		},
		menu_sub_category: {
		 required: true,
		},
	},       	              
	messages: {
		title: {
			required: '<span class="help-block" style="color:#c8202d">Title is required! </span>',
			leters_numbers_space: '<span class="help-block" style="color:#c8202d">Title is invalid ! </span>',
		},
		description: {
			required: '<span class="help-block" style="color:#c8202d">Description is required! </span>',
			//leters_numbers_space: '<span class="help-block" style="color:#c8202d">Description is invalid ! </span>',
		},
		blog_url: {
			//required:'<span class="help-block" style="color:#c8202d">URL OF BLog is required!</span>',
			url:'<span class="help-block" style="color:#c8202d">Please fill a valid URL ! </span>',
		},
		menu_category: {
			required: '<span class="help-block margin-top10" style="color:#c8202d">Menu Category is required ! </span>',
		},
		menu_sub_category: {
			required:'<span class="help-block margin-top10" style="color:#c8202d">Menu Subcategory is required !</span>',
		},
	}
});

function validate_blogs(){
	$('#blogs_descriptions-error').html('');
	var error = true;
	var limitWord = 500;
	var value = $("#blogs_descriptions").val();
			var words = $.trim(value).split(" ");
			if(words.length > limitWord){
				 $('#blogs_descriptions-error').html('Only 500 words allowed !');
				 error = false;
			}else{
				$('#blogs_descriptions-error').html('');
			}
	  return error;
} 

$("#image").change( function( e ) {
	$("#logo_upload_one").addClass('hide');
   var file, img;
    e.preventDefault(); //Stop the submit for now
                                //Replace with your selector to find the file input in your form
    var file = this.files[0];

    if( file ) {
        var img = new Image();
		var val = $(this).val();
        img.src = window.URL.createObjectURL( file );

        img.onload = function() {
            var width = img.naturalWidth,
                height = img.naturalHeight;          
            window.URL.revokeObjectURL( img.src );

            if( width >= 799 && height >= 449 ) {
                form.submit();
            }
            else {
                $(this).val('');
				$("#logo_upload_one").removeClass('hide');
				$(".image-box").find('p').next().attr('src','');
				$(".image-box").find('p').css('display','block');
				alert("Image size should be greater than 800 X 450 pixels");
            }
        };

        //check the extension of image

        

        switch(val.substring(val.lastIndexOf('.') + 1).toLowerCase()){
        
        case 'gif': case 'jpg': case 'png': case 'GIF': case 'JPG': case 'PNG': case 'JPEG': case 'jpeg':
            break;
        default:
			$(this).val('');
			$("#logo_upload_one").removeClass('hide');
			$(".image-box").find('p').next().attr('src','');
			$(".image-box").find('p').css('display','block');
			alert("Sorry wrong format(Only jpg,jpeg,png allowed)");
            break;
    } // end here check extension of image

    }
    else { //No file was input or browser doesn't support client side reading
        form.submit();
    }

});
   
   $('#image').bind('change', function() {
		var val = $(this).val();	
		var dftlsize=2048000;    
	  if(this.files[0].size>dftlsize)
	  {
	   $(this).val('');
	   alert("Sorry your Image size exceeds limit 2 MB","Warning");
	   return false; 
	  }
	});
	
	
$( "#blogs_descriptions" ).on( "keydown", function( event ) {
	$('#blogs_descriptions-error').html('');
});
</script>


