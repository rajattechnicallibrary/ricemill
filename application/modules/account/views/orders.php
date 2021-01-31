<?php echo get_flashdata(); ?>
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
			<?php echo $this->load->view('elements/user_left_menu');?>			
			<div class="col-md-9">
				<div class="account-right-section">
					 <div class="" id="">		
						<h1>Account Setting</h1>
						<div class="account-detail-form">
							<form onsubmit="return validate_account();" action="" method="post" id="my_account_edit" enctype="multipart/form-data">	
							
								<label class="account-label"> First Name <span class="required-span">*</span></label>
								<?php
								$name = @$my_account_view->first_name;
								$postvalue = @$_POST['first_name'];												
								?>
								<input type="text" name="first_name" id="first_name" value="<?php echo (!empty($postvalue) ? $postvalue : $name); ?>" class="account-input">													
						     <span class="help-block" style="color:#c8202d;"><?php echo form_error('first_name'); ?></span>
							
							<label class="account-label"> Last Name <span class="required-span">*</span></label>
							<?php
							$name = @$my_account_view->last_name;
							$postvalue = @$_POST['last_name'];												
							?>
							<input type="text" name="last_name" id="last_name" value="<?php echo (!empty($postvalue) ? $postvalue : $name); ?>" class="account-input">													
						<span class="help-block" style="color:#c8202d;"><?php echo form_error('last_name'); ?></span>
								<label class="account-label">Email</label>
								<input type="text" class="account-input " readonly="readonly" class="form-control" value="<?php echo $my_account_view->email; ?>">
						        
							<label class="account-label">Mobile</label>
							<div class="col-md-2 codeno">
							<input type="text" class="account-input " data="91" readonly="readonly" class="form-control" value="+91">
							</div>
							 			
								<div class="col-md-10 codeno">
								<input type="text" class="account-input " readonly="readonly" class="form-control" value="<?php echo $my_account_view->mobile_number; ?>">
								</div>
							<label class="account-label">Upload image</label>
								<div class="col-ting">
									<div class="control-group file-upload" id="file-upload1">
									  <div class="image-box text-center">
									  <p> <i class="fa fa-cloud-upload"></i> <br> Upload Image</p><img src="" alt=""></div>
									  <div class="controls">
									  <input type="file" name="image" id="image" />
									  </div>												  
									</div>
								</div>
								 <span class="file-text">Only jpg,jpeg,png image allowed.</span>
								
								<label class="account-label">Newsletter</label>
								<!--<span class="subscribe-checkbox1">
								<input type="checkbox" name="subscribe" 
								value="1" <?=($my_account_view->subscribe==1) ? 'checked' : '' ?> >
								<span class="subscribe-span"> Subscribe to Newsletter</span></span>-->
						           <input id="ham" type="checkbox" name="subscribe" value="1" <?=($my_account_view->subscribe==1) ? 'checked' : '' ?> >
							   <label for="ham">Subscribe to Newsletter</label>


								<button type="submit" class="account-btn-save" >Save</button>
							</form>	
						</div>
				    </div> 	
					
					
					<div class="tab" id="tab_2">		
						<h1>Change Password  </h1>
						<div class="account-detail-form">
						<form action="" method="post" id="" >	
							<label class="account-label"> Current password   <span class="required-span">*</span></label>
							<input type="text" class="account-input">
						 
							<label class="account-label"> Password   <span class="required-span">*</span></label>
							<input type="text" class="account-input">
							
							<label class="account-label">Confirmation  <span class="required-span">*</span></label>
							<input type="text" class="account-input">
							 
							<input type="submit" value="Save" class="account-btn-save">
						</form>	
						</div>
				    </div> 
					
					
					
					
					
				</div>
			</div>
			
		</div>
	</div>

</div>

<script src="http://localhost/myfoodstall/assets/global/plugins/jquery-validation/js/jquery.validate.min.js" type="text/javascript"></script>
<script>
$("#my_account_edit").validate({
	rules: {
		first_name:{
			required:true,
		},            
		 last_name:{
			required: true,  
	},
	},	
	messages: {
		first_name: {
			required: '<span class="help-block" style="color:#c8202d;">First Name is required ! </span>',
		},
		last_name: {
			required:'<span class="help-block" style="color:#c8202d;">Last Name is required !</span>',
		}          
		
	}
});



$('.image-box').click(function(event) {
  var imgg = $(this).children('img');
  $(this).siblings().children("input").trigger('click');  

  $(this).siblings().children("input").change(function() {
    var reader = new FileReader();

    reader.onload = function (e) {
      var urll = e.target.result;
      $(imgg).attr('src', urll);
      imgg.parent().css('background','transparent');
			imgg.show();
      imgg.siblings('p').hide();
			
    }
    reader.readAsDataURL(this.files[0]);
  }); 
});
</script>

