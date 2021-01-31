<!--Add-Recipe-->
<style>
		.profile-pic{width:100%; float:left;}
		.file-upload .image-box {
			margin-top: 0;
			height: 65px;
			width: 100%;
			float: left;
			background: #ffffff;
			cursor: pointer;
			overflow: hidden;
			border: 1px solid #e5e5e5;
			border-radius: 8px;
		}
		.text-center {
			text-align: center;
		}
		.file-upload .image-box p {
			position: relative;
			top: 10%;
			color: #ccc;
			text-transform: uppercase;
		}
		.file-upload .image-box .fa {
			color: #71ba3f;
			font-size: 30px;
		}
		.file-upload .image-box img {
			height: 100%;
			display: none;
		}
		.file-upload .controls {
			display: none;
		}
		.file-text{display:none;}
		
		.file-upload{
				float: left;
				width: 100%;
				height: auto;
				margin: 0px 0px 10px 0px;
			}
			video{
				height:65px;
				float: left;
			}
		</style>
<div class="container">
<?php //pr($menu_category);die;?>
<form onsubmit="return validate_form();" action="<?php echo base_url();?>account/recipes/edit/<?=ID_encode($result['recipe']->id)?>" method="post" id="recipe_edit_front" enctype="multipart/form-data">
    <div class="add-recipe-main">
        <h1>Edit Recipe</h1>
        <div class="add-recipe-form">
                <div class="add-recipe-grid">
                  <div class="form-group">
                    <label for="">Recipe Name <span class="required" aria-required="true" style="color:#e02222;">* </span></label>
					<?php $postvalue = @$_POST['name']; ?>											
                    <input type="text" name="name" value="<?php echo (!empty($postvalue) ? $postvalue :$result['recipe']->name ); ?>" class="form-control"  maxlength="120">
                  <span class="help-block" style="color:#c8202d;"><?php echo form_error('name'); ?></span>
				  </div>
                </div>
                
                
                
                
                <div class="add-recipe-grid">
                <div class="form-group margin-top20">
                    <label for="" class="margin-top-25">Cooking Time <span class="required" aria-required="true" style="color:#e02222;">* </span></label>
                 <div class="select-style form-control">
					<select name="cooking_time">
						<option value="">Select Cooking Time</option>
						<option value="1" <?= (@$_POST['cooking_time'] == '1' || @$result['recipe']->cooking_time == '1') ? 'selected' : '' ?>>Less than 5 minutes</option>
						<option value="2"  <?= (@$_POST['cooking_time'] == '2' || @$result['recipe']->cooking_time == '2') ? 'selected' : '' ?> >5 to 15 minutes</option>														
						<option value="3" <?= (@$_POST['cooking_time'] == '3' || @$result['recipe']->cooking_time == '3') ? 'selected' : '' ?>>15 to 30 minutes</option>
						<option value="4"  <?= (@$_POST['cooking_time'] == '4' || @$result['recipe']->cooking_time == '4') ? 'selected' : '' ?> >More than 30 minutes</option>														
					</select>
					<span class="help-block"><?php echo form_error('cooking_time'); ?></span>
				</div>				
                  </div>
                  </div>
                  
                  <div class="add-recipe-grid">
                  <div class="form-group">
                    <label for="">Cooking Utensils <span class="required" aria-required="true" style="color:#e02222;">* </span> </label>
					<?php $postvalue = @$_POST['cooking_utensils']; ?>
                    <input type="text" name="cooking_utensils" value="<?php echo (!empty($postvalue) ? $postvalue : @$result['recipe']->cooking_utensils); ?>" class="form-control" maxlength="35">
                  </div>
				  <span class="help-block"><?php echo form_error('cooking_utensils'); ?></span>
                </div>
                
                
                <div class="add-recipe-grid">
                  <div class="form-group">
                   <div class="ingredient-d"> <label for="">Ingredients <span class="required" aria-required="true" style="color:#e02222;">* </span> </label></div>
					<div class="input_fields_container">
					<input type="hidden" name="open_block" value="<?= count(@$result['ingredients']) ?>">
					<?php //pr($result['ingredients']);die;
						if(isset($result['ingredients']) && !empty($result['ingredients'])){
							$i= 0; foreach($result['ingredients'] as $value){ ?>
						<div id="ingredient_<?= $i ?>">
							
							<div class="form-group col-md-10 padd-0 padding-left0">
								  <input type="text"  name="ingredient[]" id="ingredient<?= $i ?>" value="<?php echo set_value('ingredient[]',$value->ingredient); ?>" class="form-control" >
									<label style="color:#c8202d;"><span class="help-block" style="color:#c8202d;text-transform: initial !important;font-weight:700;font-size:12px;"></span></label>
							</div>
							<div class="form-group col-md-1" style="padding: 12px 0px 0px 0px;" >
								<a href="javascript:void(0);" class="add add_more_button" id="add<?= $i ?>"><i class="fa fa-plus" style="color:#45bd41;"></i></a>
							
								<?php if($i!=0){ ?>
									<a href="javascript:void(0);" class="minus remove_field" id="add<?= $i ?>" data="<?= $i ?>"><i class="fa fa-minus" style="color:#c8202d;"></i></a>
								<?php } ?>
							
							</div>
						</div>
						<?php $i++; }}else{ ?>
							<div class="form-group col-md-10 padd-0">
									<span>Igredients Not Found</span>
							</div>
						<?php } ?>
					</div>                    				
                  </div>
                </div>
                
                <div class="add-recipe-grid">
                  <div class="form-group">
                    <label for="">How to Cook <span class="required" aria-required="true" style="color:#e02222;">* </span></label>
                    <textarea name="cooking_directions" id="recipe_descriptions" class="form-control" maxlength="3000" rows="2" cols="41"><?php echo set_value('cooking_directions', @$result['recipe']->cooking_directions);?></textarea>
					<span class="help-block" id="recipe_descriptions-error" style="color:#c8202d;font-family: OpenSans-Semibold;"></span>
				  </div>
                </div>
                
                <div class="add-recipe-grid">
                  <div class="form-group">
                    <label for="">Recipe By </label>
                    <input type="text" name="recipe_by" class="form-control" readonly value="<?=$current_user?>" id="" placeholder="BY Default user name"/>
                  </div>
                </div>
				<div class="add-recipe-grid">
				<div class="form-group margin-top20">
				<label for="" class="margin-top-25">Item Category </label>
                    <div class="select-style form-control">
					<?php 
					$postvalue = @$_POST['menu_category'];
					
					?>
                      <select name="menu_category" id="menu_category">
                        <option value="">Select Item Category</option>
						<?php  if(!empty($menu_category)){ 
									
								 foreach($menu_category as $key => $val){
									
									 if(@$result['recipe']->menu_category == $val->id){
										
									   $selected= 'selected="selected"';  
									 } else if(@$_POST['menu_category']){
									   $selected= 'selected="selected"';
									 } else{
										 $selected= '';  
									 }      
								 ?>
							<option value="<?=$val->id?>" <?=$selected?> ><?=$val->name?></option>
							 <?php }} else{ ?>
							<option value="">No Data Available</option>
							 <?php } ?>
                      </select>
                    </div>
				</div>
				 </div>
				 
				 <div class="add-recipe-grid">
				<div class="form-group margin-top20">
				<label for="" class="margin-top-25">Item Subcategory </label>
                    <div class="select-style form-control">
					<?php 
					$postvalue = @$_POST['menu_sub_category'];
					?>
                      <select name="menu_sub_category" id="menu_sub_category">
					   <option value="">Select Item Subcategory</option>
                        <?php if(!empty($menu_sub_category)){ 
								foreach($menu_sub_category as $key => $val){
									if(@$result['recipe']->menu_sub_category == $val->id){
										$selected= 'selected="selected"';  
										} else if(@$_POST['menu_sub_category']){
										$selected= 'selected="selected"';
										} else{
										$selected= '';  
										}      
										?>
										<option value="<?=$val->id?>" <?=$selected?> ><?=$val->name?></option>
									<?php }} else{ ?>
								<option value="">No Data Available</option>
							<?php } ?>
                      </select>
                    </div>
				</div>
				 </div>
                
                <div class="add-recipe-grid">
					<div class="form-group">
					<label for="">Food Type <span class="required" aria-required="true" style="color:#e02222;font-family:OpenSans-Semibold;">* </span></label>
					<div class="clearfix"></div>
					     <label class="radio_label">
						   <input type="radio" name="food_type" value="1" checked="" <?= (@$_POST['food_type'] == '1' ||  @$result['recipe']->food_type == '1' ) ? 'checked' : '' ?>> <span></span>  Veg
						</label>
						 <label class="radio_label">
						   <input type="radio" name="food_type" value="2" <?= (@$_POST['food_type'] == '2' ||  @$result['recipe']->food_type == '2') ? 'checked' : '' ?> > <span></span> Non-Veg
						</label>
					</div>
					</div>
                    
                    <div class="add-recipe-grid">
					<div class="form-group">
					<label for="">Level of Difficulty <span class="required" aria-required="true" style="color:#e02222;font-family:OpenSans-Semibold;">* </span> </label>
					<div class="clearfix"></div>
					     <label class="radio_label">
						   <input type="radio" name="difficulty_level" value="1" checked="" <?= (@$_POST['difficulty_level'] == '1' || @$result['recipe']->difficulty_level == '1' ) ? 'checked' : '' ?> > <span></span>  Easy to cook
						</label>
						 <label class="radio_label">
						   <input type="radio" name="difficulty_level" value="2" <?= (@$_POST['difficulty_level'] == '2' || @$result['recipe']->difficulty_level == '2' ) ? 'checked' : '' ?> > <span></span> Moderately(Difficult to cook)
						</label>
                        <label class="radio_label">
						   <input type="radio" name="difficulty_level" value="3" <?= (@$_POST['difficulty_level'] == '3' || @$result['recipe']->difficulty_level == '3' ) ? 'checked' : '' ?>> <span></span> Need more addorts to cook
						</label>
					</div>
					</div>
					
                    <div class="add-recipe-grid">					   
					<?php
				
						$upload_recipe_img_path = base_url()."uploads/recipe/";
						$recipe_img_name = $result['recipe']->image;
						
									if (!file_exists($upload_recipe_img_path.$recipe_img_name))
									{
										 $image_recipe_path =  $upload_recipe_img_path.$recipe_img_name;   
									}
									else
									{
										 $image_recipe_path = ""; 
									}
									 
									
							?>
					<input type="hidden" name="old_image" value="<?php echo $result['recipe']->image; ?>">		
					<div class="col-md-6 padding-left0">
					<div class="form-group">						
					<label for="">Add image</label><span id ='logo_upload_one' style="display:none;color:red;text-transform:initial;">(Image not Uploaded)</span>
					<div class="control-group file-upload" id="file-upload1">
						<div class="image-box text-center">
						<?php if (@$recipe_img_name==""){?>
						<p> <i class="fa fa-cloud-upload"></i> <br> Upload Image</p><?php } ?>
						<img src="<?php echo $image_recipe_path;?>" alt="" title="Upload Recipe Image" style="display:block; align:center;width: 529px;"></div>
					<div class="controls">
					
						<input type="file" name="image" id="image" />
					</div>
					Image size should be greater than 800 X 450 pixels<br/>Only jpg, jpeg, png image allowed	
																  
					</div>
					
					</div>
					
					</div>	
					<?php
				
						$upload_recipe_video_path = base_url()."uploads/recipe/";
						
						$recipe_video_name = $result['recipe']->video;
						//pr($recipe_video_name);die;
									if (!file_exists($upload_recipe_video_path.$recipe_video_name))
									{
										 $video_recipe_path =  $upload_recipe_video_path.$recipe_video_name;   
									}
									else
									{
										 $video_recipe_path = ""; 
									}
									$image_default_for_video_path = base_url()."frontend_assets/images/";
									$image_default_for_video_name = "video-play.gif";
									if (@$recipe_video_name!="")
									{
										
										
										$full_path_default_for_video_image = $image_default_for_video_path .$image_default_for_video_name;
									}
									else{
										$full_path_default_for_video_image='';
									}
									 
									
							?>
					<input type="hidden" name="old_video" value="<?php echo $result['recipe']->video; ?>">		
					<div class="col-md-6 padding-left0">
					<div class="form-group">						
					<label for="">Add Video <span id ='video_upload' style="display:none;color:#75d36c;text-transform:initial;">(Video Uploaded)</span></label>
					<div class="control-group file-upload" id="file-upload1">
						<div class="image-box text-center">
						<?php if (@$recipe_video_name==""){?>
						<p> <i class="fa fa-cloud-upload"></i> <br> Upload File</p><?php } ?>
						<video id = "video1"  poster="<?php echo $full_path_default_for_video_image;?>" onmouseover="this.play()" onclick = "this.pause()">
							  <source src="<?php echo $video_recipe_path;?>" type="video/mp4">
							  <source src="movie.ogg" type="video/ogg">
							  Your browser does not support the video tag.
								</video></div>
						
					<div class="controls">
						<input type="file" name="video" id="file-upload" />
					</div>												  
					</div>
					</div>
					</div>	


                    </div>
                    
                    <div class="add-recipe-grid">
					<div class="form-group">
					<label for="">Prefered Meal Time </label>
					<div class="clearfix"></div>
					     <label class="radio_label">
						   <input type="radio" name="preffered_meal_time" value="1" checked="" <?= (@$_POST['preffered_meal_time'] == '1' || @$result['recipe']->preffered_meal_time == '1') ? 'checked' : '' ?>> <span></span>  Breakfast
						</label>
						 <label class="radio_label">
						   <input type="radio" name="preffered_meal_time" value="2" <?= (@$_POST['preffered_meal_time'] == '2' || @$result['recipe']->preffered_meal_time == '2') ? 'checked' : '' ?>> <span></span> Lunch
						</label>
                        <label class="radio_label">
						   <input type="radio" name="preffered_meal_time" value="3" <?= (@$_POST['preffered_meal_time'] == '3' || @$result['recipe']->preffered_meal_time == '3') ? 'checked' : '' ?>> <span></span> Dinner
						</label>
                        <label class="radio_label">
						   <input type="radio" name="preffered_meal_time" value="3" <?= (@$_POST['preffered_meal_time'] == '4' || @$result['recipe']->preffered_meal_time == '4' ) ? 'checked' : '' ?>> <span></span> Evening
						</label>
                        <label class="radio_label">
						   <input type="radio" name="preffered_meal_time" value="4" <?= (@$_POST['preffered_meal_time'] == '5' || @$result['recipe']->preffered_meal_time == '5') ? 'checked' : '' ?> > <span></span> Anytime
						</label>
					</div>
					</div>
                    
                    <div class="add-recipe-grid">
					<div class="form-group">
					<label for="">Food Category<span class="required" aria-required="true" style="color:#e02222;font-family:OpenSans-Semibold;">*</label>
					<div class="clearfix"></div>
					     <label class="radio_label">
						   <input type="radio" name="food_category" value="1" checked="" <?= (@$_POST['food_category'] == '1' || @$result['recipe']->food_category == '1' ) ? 'checked' : '' ?>> <span></span>  Drink 
						</label>
						 <label class="radio_label">
						   <input type="radio" name="food_category" value="2" <?= (@$_POST['food_category'] == '2' || @$result['recipe']->food_category == '2') ? 'checked' : '' ?>> <span></span> Dessert
						</label>
                        <label class="radio_label">
						   <input type="radio" name="food_category" value="3" <?= (@$_POST['food_category'] == '3' || @$result['recipe']->food_category == '3') ? 'checked' : '' ?>> <span></span> Snacks
						</label>
                        <label class="radio_label">
						   <input type="radio" name="food_category" value="4" <?= (@$_POST['food_category'] == '4' || @$result['recipe']->food_category == '4') ? 'checked' : '' ?>> <span></span> Food(main course)
						</label>
					</div>
					</div>
					
					<div class="add-recipe-grid">
                  <div class="form-group">
                    <label for="">Yield <span class="required" aria-required="true" style="color:#e02222;">* </span></label>
					<?php $postvalue = @$_POST['yeild']; ?>
                    <input type="text" name="yeild" value="<?php echo (!empty($postvalue) ? $postvalue : $result['recipe']->yeild); ?>" class="form-control numbersOnly"  maxlength="10">
                  <span class="help-block"><?php echo form_error('yeild'); ?></span>
				  </div>
                </div>
					
					
					
              </div>
               <div class="recipe-btn-main">
			   <button type="submit" class="recipe-submit-button">Submit</button>
			   <button type="button" class="recipe-submit-button cancel-button">Cancel</button>
			   </div>
        </div>
     </form>  
</div>
<!--Add-Recipe-End-->
<script>

// for video player

var video1 = document.getElementById('video1');

function videoPausePlayHandler(e) {
	if (e.type == 'playing') {
 	 video1.removeAttribute("controls","controls");
	} else if (e.type == 'pause') {
   video1.removeAttribute("controls");
	}
}

video1.addEventListener('playing', videoPausePlayHandler, false);
video1.addEventListener('pause', videoPausePlayHandler, false);



/* image file validation */
$("#image").change( function( e ) {
	$("#logo_upload_one").css('display','none');
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
				$("#logo_upload_one").css('display','block');
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
			$("#logo_upload_one").css('display','block');
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

/* video file validation */
$('#file-upload').on('change',function(){
	var filename = $(this).val().replace(/C:\\fakepath\\/i, '');	  
	var fileobj = $(this).val();		 
	switch(fileobj.substring(fileobj.lastIndexOf('.') + 1).toLowerCase()){
		case 'mp4': case 'avi': case 'wmv':
		$("#video_upload").css('display','inline-block');
		break;
	default:
		$(this).val('');
		$(".image-box").find('p').next().attr('src','');
		$(".image-box").find('p').css('display','block');
		$("#video_upload").css('display','none');
		alert("Sorry wrong format(Only mp4,avi,wmv allowed)","Warning");
		return false;
	}
});

$('#file-upload').bind('change', function() {
	var val = $(this).val();	
	var dftlsize=8388608 // 8mb = 8388608 bytes;    
	if(this.files[0].size>dftlsize)
	{
	$(this).val('');
	$("#video_upload").css('display','none');
	alert("Sorry your Video size exceeds limit 8 MB","Warning");
	return false; 
	}
});

/*end file validation*/
$('.cancel-button').on('click', function() {
		url = '<?php echo base_url();?>account/recipes';	
		location = url;
	});
	
	
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

$(document).ready(function () {
  //called when key is pressed in textbox
  $("input[name='yeild']").keypress(function (e) {
     //if the letter is not digit then display error and don't type anything
     if (e.which != 8 && e.which != 9 && e.which != 13 && e.which != 0 && (e.which < 48 || e.which > 57)) {
        //display error message
        //$("#yield_num").html("Numbers Only").show().fadeOut("slow");
               return false;
    }
   });
});

$("#recipe_edit_front").validate({
	
	rules: {
		
		name:{
			required:true,
			leters_space:true,
			remote :{
				        url:"<?php echo base_url(); ?>account/recipes/verify_name",
						data:{'id':'<?php echo $result['recipe']->id ?>'},
			        },
		},            
		 yeild:{
			required: true,                
		},
		 cooking_time: {
		required: true        
		},
		cooking_utensils:{
			required:true,
			leters_numbers_space:true,
		},
		cooking_directions:{
			required:true,
			//leters_numbers_space:true,
		},
		
	},       	              
	messages: {
		name: {
			required: '<span class="help-block" style="color:#c8202d;">Recipe Name is Required ! </span>',
			leters_space: '<span class="help-block" style="color:#c8202d">Recipe Name is Invalid ! </span>',
		},
		yeild: {
			required:'<span class="help-block" style="color:#c8202d;">Yield is Required !</span>'
		},           
		cooking_time: {
			required:'<span class="help-block margin-top10"" style="color:#c8202d;">Cooking Time is Required !</span>'
		},
		cooking_utensils: {
			required: '<span class="help-block" style="color:#c8202d;">Cooking Utensils is Required ! </span>',
			leters_numbers_space: '<span class="help-block" style="color:#c8202d">Cooking Utensils is Invalid ! </span>',
		},
		cooking_directions: {
			required: '<span class="help-block" style="color:#c8202d;">How To Cook is Required ! </span>',
			//leters_numbers_space: '<span class="help-block" style="color:#c8202d">How To Cook is Invalid ! </span>',
		},
		
	}
	
	
	
	
	
});

function validate_form()
{
	var error = false;
	$("input[name='ingredient[]']").each(function(){
		if($(this).val() == '')
		{
			$(this).next('label').html('Ingredient Field is Required !');
			error = false;
		}else{error = true;}
	});
	
	var limitWord = 500;
	var value = $("#recipe_descriptions").val();
		var words = $.trim(value).split(" ");
		if(words.length > limitWord){
			 $('#recipe_descriptions-error').html('Only 500 words allowed !');
			 error = false;
		}else{
			$('#recipe_descriptions-error').html('');
		}
	return error;
}



$( "#recipe_descriptions" ).on( "keydown", function( event ) {
	$('#recipe_descriptions-error').html('');
});
</script>







<script>
    $(document).ready(function() {
    var max_fields_limit      = 10; //set limit for maximum input fields
    var x = 1; //initialize counter for text box
	

    $(document).on('click','.add_more_button',function(e){ //click event on add more fields button having class add_more_button
        var count = $("input[name='open_block']").val();
		var next_count =  parseInt(count)+1;
		var ingredient = $('#ingredient'+count).val(); // ingredient value
		//alert(ingredient);return false;
		if(ingredient == ''){
			alert("Please fill Ingredients field then click on Add more Ingredients","Warning");
			return false;
			}else{
				if(x < max_fields_limit){ //check conditions
				count++;
			 
				var str = '';
				str += '<div id="ingredient_'+count+'">';
				str += '	<div class="form-group col-md-10 padding-left0 padd-0">';
				str += '		<input type="text"  name="ingredient[]" id="ingredient'+count+'" class="form-control" >';
				str += '		<span class="help-block" style="color:#c8202d;font-family:OpenSans-Semibold;font-size:.7em;"></span>';
				str += '	</div>';
				str += '	<div class="form-group col-md-1" style="padding: 12px 0px 0px 0px;" >';
				str += '		<a href="javascript:void(0);" class="add add_more_button" id="add'+count+'" data="'+count+'"><i class="fa fa-plus" style="color:#45bd41;"></i></a>';
				str += '		<a href="javascript:void(0);" class="remove_field" id="remove'+count+'" data="'+count+'"><i class="fa fa-minus" style="color:#c8202d;"></i></a>';
				str += '	</div>';
				str += '</div>';
				$('.input_fields_container').append(str); 
				$("input[name='open_block']").val(next_count);
			}
		}
		
    });  
    $('.input_fields_container').on("click",".remove_field", function(e){
		//user click on remove text links
        var remove_block = $(this).attr('data');
		$("#ingredient_"+remove_block).remove(); 
    })
});

// menu sub category
$(document).on('change','#menu_category',function(){
	var menu_category_id = $(this).val();
	$.ajax({
		type:"post",
		url:"<?php echo base_url();?>account/recipes/get_menu_subcategory",
		data:{menu_category_id:menu_category_id},
		success:function(data){
			data = JSON.parse(data);
			$('#menu_sub_category').html(data);
		}
	});
	
	

});


</script>	
<script type="text/javascript">
$(document).ready(function() {
	
    $(".numbersOnly").keypress(function(key) {
		
        if(key.charCode < 48 || key.charCode > 57) return false;
    });
});
</script>