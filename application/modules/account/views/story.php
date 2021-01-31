<?php //pr($my_details->story_title);die;?>
<style>
.profile-pic{width:100%; float:left;}
.file-upload .image-box {
    margin-top: 0;
    height: 66px;
    width: 150px;
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
}
.file-upload .image-box .fa {
    color: #45bd41;
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





 

input[type=checkbox] {
  opacity: 0;
  float:left;
}

input[type=checkbox] + label {
  margin: 0 0 0 20px;
  position: relative;
  cursor: pointer;
  font-size: 16px;
  font-family: monospace;
  float: left;
}

input[type=checkbox] + label ~ label {
  margin: 0 0 0 40px;
}

input[type=checkbox] + label::before {
  content: ' ';
  position: absolute;
  left: -35px;
  top: -3px;
  width: 25px;
  height: 25px;
  display: block;
  background: #fff;
  border: 1px solid #A9A9A9;
}

input[type=checkbox] + label::after {
  content: ' ';
  position: absolute;
  left: -35px;
  top: -3px;
  width: 25px;
  height: 24px;
  display: block;
  z-index: 1;
  background: url('data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZpZXdCb3g9IjE4MS4yIDI3MyAxNyAxNiIgZW5hYmxlLWJhY2tncm91bmQ9Im5ldyAxODEuMiAyNzMgMTcgMTYiPjxwYXRoIGQ9Ik0tMzA2LjMgNTEuMmwtMTEzLTExM2MtOC42LTguNi0yNC04LjYtMzQuMyAwbC01MDYuOSA1MDYuOS0yMTIuNC0yMTIuNGMtOC42LTguNi0yNC04LjYtMzQuMyAwbC0xMTMgMTEzYy04LjYgOC42LTguNiAyNCAwIDM0LjNsMjMxLjIgMjMxLjIgMTEzIDExM2M4LjYgOC42IDI0IDguNiAzNC4zIDBsMTEzLTExMyA1MjQtNTI0YzctMTAuMyA3LTI1LjctMS42LTM2eiIvPjxwYXRoIGZpbGw9IiMzNzM3MzciIGQ9Ik0xOTcuNiAyNzcuMmwtMS42LTEuNmMtLjEtLjEtLjMtLjEtLjUgMGwtNy40IDcuNC0zLjEtMy4xYy0uMS0uMS0uMy0uMS0uNSAwbC0xLjYgMS42Yy0uMS4xLS4xLjMgMCAuNWwzLjMgMy4zIDEuNiAxLjZjLjEuMS4zLjEuNSAwbDEuNi0xLjYgNy42LTcuNmMuMy0uMS4zLS4zLjEtLjV6Ii8+PHBhdGggZD0iTTExODcuMSAxNDMuN2wtNTYuNS01Ni41Yy01LjEtNS4xLTEyLTUuMS0xNy4xIDBsLTI1My41IDI1My41LTEwNi4yLTEwNi4yYy01LjEtNS4xLTEyLTUuMS0xNy4xIDBsLTU2LjUgNTYuNWMtNS4xIDUuMS01LjEgMTIgMCAxNy4xbDExNC43IDExNC43IDU2LjUgNTYuNWM1LjEgNS4xIDEyIDUuMSAxNy4xIDBsNTYuNS01Ni41IDI2Mi0yNjJjNS4yLTMuNCA1LjItMTIgLjEtMTcuMXpNMTYzNC4xIDE2OS40bC0zNy43LTM3LjdjLTMuNC0zLjQtOC42LTMuNC0xMiAwbC0xNjkuNSAxNjkuNS03MC4yLTcxLjljLTMuNC0zLjQtOC42LTMuNC0xMiAwbC0zNy43IDM3LjdjLTMuNCAzLjQtMy40IDguNiAwIDEybDc3LjEgNzcuMSAzNy43IDM3LjdjMy40IDMuNCA4LjYgMy40IDEyIDBsMzcuNy0zNy43IDE3NC43LTE3Ni40YzEuNi0xLjcgMS42LTYuOS0uMS0xMC4zeiIvPjwvc3ZnPg==') no-repeat center center;
  -ms-transition: all .2s ease;
  -webkit-transition: all .2s ease;
  transition: all .3s ease;
  -ms-transform: scale(0);
  -webkit-transform: scale(0);
  transform: scale(0);
  opacity: 0;
  background-color: #45bd41;
}

input[type=checkbox]:checked + label::after {
  -ms-transform: scale(1);
  -webkit-transform: scale(1);
  transform: scale(1);
  opacity: 1;
}








 



</style>
<div class="my-account-section">
	<div class="container container-margin">
		<div class="row">
		<?php echo get_flashdata(); ?>
			<?php echo $this->load->view('elements/user_left_menu');?>			
			<div class="col-md-9">
				<div class="account-right-section">
					<div class="" id="">		
						<h1>My Story</h1>
						<div class="account-detail-form">
						<form action="" method="post" id="my_story_edit" onsubmit="return validate_mystory()">
								<?php
								$name = $my_details->story_title;
								$postvalue = @$_POST['story_title'];
								?>
							<label class="account-label">Story Title<span class="required-span">*</span></label>
							<input type="text" name="story_title" id="story_title" value="<?php echo (!empty($postvalue) ? $postvalue : $name); ?>" class="account-input" maxlength="35">
						
							<span class="help-block" style="color:#c8202d;"><?php echo form_error('story_title'); ?></span>
							
							<?php
								$name = $my_details->story_description;
								$postvalue = @$_POST['story_description'];
								?>
							<label class="account-label">Story Description<span class="required-span">*</span></label>
							<div class="row">
								<div class="form-group col-md-12">
	                  <textarea name="story_description" class="form-control ckeditor" maxlength="3000" required="" rows="9" cols="41"><?php echo ($postvalue ? $postvalue : $name)?></textarea>               
								
								
								<span class="help-block" style="color:#c8202d;font-family: OpenSans-Semibold;" id="story_description_alert"></span>
								<span class="help-block" style="color:#c8202d;"><?php echo form_error('story_description'); ?></span>
								
								</div>
								</div>	
							<button type="submit" class="account-btn-save">Save</button>
						</form>	
						</div>
				    </div> 
				</div>
			</div>
			
		</div>
	</div>

</div>
<script src="<?=base_url()?>assets/ckeditor/ckeditor.js" type="text/javascript"></script>
<script src="http://localhost/myfoodstall/assets/global/plugins/jquery-validation/js/jquery.validate.min.js" type="text/javascript"></script>
<script>
$("#my_story_edit").validate({
	rules: {
		story_title:{
			required:true,
		},		
		 story_description:{
			required: true,	
		},
	},	
	messages: {
		story_title: {
			required: '<span class="help-block" style="color:#c8202d;">Story Title is required ! </span>',
		},
		story_description: {
			required:'<span class="help-block" style="color:#c8202d;">Story Description  is required !</span>',
		},
	}
});


/* function validate_mystory(){
	if($("textarea[name='story_description']").val()	==	'')
	{
		$("#story_description_alert").html('STORY DESCRIPTION IS REQUIRED !');
		return false;
	}else{
		$("#story_description_alert").html('');
	} */
	

}
</script>

