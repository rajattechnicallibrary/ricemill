<style>
label.error{
    color:#c8202d !important;
    font-weight: normal!important;
    font-size:12px !important;
}
</style>
<!-- BEGIN CONTENT -->
<div class="row">
    <div class="col-md-12" style="padding: 15px 0px; width:95%; margin:0px 10px;background: #fff; padding:0px 0px 20px 0px;">
        <?php echo get_flashdata(); ?>      
        <div class="portlet box blue">
            <div class="portlet-title black">
                <div class="caption">Edit Team </div>
            </div>
           
            <div class="portlet-body">

                <div class="form-body">	
                    <?php echo form_open('', array('class' => '','id'=>'teamForm')); ?>							
                        <div class="row">
                            <div class="form-group col-md-6">
                                
                                <label class="control-label">Person Name <span class="required" aria-required="true">* </span></label>
                                <div class="">   
                                    <input type="text" name="first_name" value="<?php echo (!empty($postvalue) ? $postvalue : $user_detail->first_name); ?>"  class="form-control" maxlength="40"/>
                                </div>
                                <span class="help-block"><?php echo form_error('first_name'); ?></span>
                            </div>
                            <div class="col-md-6">
                                
                                    <label class="control-label">Type</label>
                                 <div class="form-group" style="line-height:17px;margin-top: 7px;">
                                    <div class="radio-list" style="line-height:-40px">
                                      <label class="radio-inline">
									  <?php $postvalue = @$_POST['team_type'];?>
                                          <div class="radio" id="uniform-optionsRadios5">
                                          <input type="radio" name="team_type" id="optionsRadios1" value="6" <?= (@$postvalue=='6' || $user_detail->user_type =='6')?"checked":"checked"?>></div>
                                      Backend Team</label>
                                      
                                      <label class="radio-inline">
                                        <div class="radio" id="uniform-optionsRadios4">
                                        <input type="radio" name="team_type" id="optionsRadios3" value="5" <?= (@$postvalue=='5' || $user_detail->user_type =='5')?"checked":""?> ></div>
                                      Account Team</label>
                                       
                                    </div>
                                </div>
                                <span class="help-block"><?php echo form_error('team_type'); ?></span>    
                            </div>
                        </div>
                        
                        <div class="row">
						
						<div class="col-md-6">
                                
                                    <label class="control-label">Email Id <span class="required" aria-required="true"> * </span></label>
                                 <div class="">    
                                     <input type="email" name="email" value="<?php echo (!empty($postvalue) ? $postvalue : $user_detail->email); ?>"  class="form-control" maxlength="40"/>
                                </div>
                                <span class="help-block"><?php echo form_error('email'); ?></span>    
                            </div>
						
                            <div class="form-group col-md-6">
                               
                                    <label class="control-label">Mobile Number <span class="required" aria-required="true"> * </span></label>
                                <div class="">      <input type="text" name="mobile_number"  id="mobile_number" value="<?php echo (!empty($postvalue) ? $postvalue : $user_detail->mobile_number); ?>" maxlength="10" class="form-control"/>
                                </div>
                                 <span class="help-block" id="mobile_number_id"><?php echo form_error('mobile_number'); ?></span> 
								
                            </div>
                          
                            </div>
							
							
							<div class="row">
                            
                            
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Status <span class="required" aria-required="true">* </span></label>
                                   
                                    <div class="select-style">
														<select name="status" id="statis-id">
															<option value="active" <?= (@$user_detail->status == 'active') ? 'selected' : '' ?>>Active</option>
															<option value="inactive"  <?= (@$user_detail->status == 'inactive') ? 'selected' : '' ?> >Inactive</option>														
														</select>
														
													</div> 
                                          
                                </div>
                            </div>
                        </div>
                        
                        
                        

                        

                        <div class="text-center margin_top_btm_20 col-md-12" > <!--style="float: left;padding-left:10px; width:100%;"--> 
                            <button type="submit" class="btn blue">Submit</button>
                            <button type="button" class="btn default cancel-button" >Cancel</button>
                        </div>  					
                    <?php echo form_close();?>	
                </div>
				</div>
            </div>
        </div>	

    </div>

</div>

<!-- END PAGE CONTENT-->
<script type="text/javascript" src="<?=base_url()?>assets/validate.js"></script>       

<script>
	
	// validate the input length of the mobile field
 function mobcheckLength(sel) {
	
		if (sel.value.length != 10) {
			//alert();
			$('#mobile_number_id').html('');
			$('#mobile_number_id').html('<div class="help-block">Mobile Number is not valid.</div>');			
				return false;
		}
		else{
			$('#mobile_number_id').html('');				
				return true; 
			}
 
}

 //  validate mobile number takes only numeric values
$(document).ready(function() {
    $("#mobile_number").keydown(function (e) {
		$('#mobile_number_id').html('');
		
        // Allow: backspace, delete, tab, escape, enter and .
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110]) !== -1 ||
             // Allow: Ctrl+A, Command+A
            (e.keyCode === 65 && (e.ctrlKey === true || e.metaKey === true)) || 
             // Allow: home, end, left, right, down, up
            (e.keyCode >= 35 && e.keyCode <= 40)) {
                 // let it happen, don't do anything
                 return;
        }
        // Ensure that it is a number and stop the keypress
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
			$('#mobile_number_id').html('');
            e.preventDefault();
        }
		else{
			$('#mobile_number_id').html(" ");
		}
    });
});
	
	
        


    $('.cancel-button').on('click', function () {
        url = '<?php echo base_url(); ?>admin/manage_team';
        location = url;
    });

    $.validator.addMethod("leters_space", function (value, element) {
        if (value == '' || value == null)
        {
            return true;
        }
        return  /^[A-Za-z]+( [A-Za-z]+)*$/.test(value);
    }, '')

    $.validator.addMethod("mobno", function(value,element) {
        
        return  /^[0-9]{10}$/.test(value);
},'');  

$("#teamForm").validate({
    rules: {  
        first_name:{
            required: true,
            maxlength: "40",	
        },mobile_number:{
                required: true,
                mobno: true
        },email:{
               required: true,
               email:true
        
        },team_type1:{
            required: true,
        },team_password:{
            required: true,
        },status:{
               required: true,
        }
        
         
    },
    messages:{
            first_name:{
               required: '<div class="help-block"> Person Name is required.</div>',
               alphanumeric_dash_underscore: '<div class="help-block">Letters,Numbers,Dash,Space or Underscore only allowed .</div>',
               maxlength :'<div class="help-block">Maximunm First Name length should be 40</div>',	
            },
            last_name:{
               required: '<div class="help-block">Last Name is required.</div>',
               alphanumeric_dash_underscore: '<div class="help-block">Letters,Numbers,Dash,Space or Underscore  only allowed .</div>',
               maxlength :'<div class="help-block">Maximunm Last Name length should be 40</div>',
            },mobile_number:{
                required: '<div class="help-block">Mobile Number is required.</div>',
                mobno: '<div class="help-block">Mobile Number should be 10 digit number.</div>',
                maxlength: jQuery.validator.format("<div class='help-block' style='color:red'>Invalid length.It should be {0} digits only.</div>"),
            },email:{
                required: '<div class="help-block">Email Id is required.</div>',
                email: '<div class="help-block">Invalid email address.</div>',
            },team_type1:{
                required: '<div class="help-block">Assign Sales Manager is required.</div>',
            },team_password:{
                required: '<div class="help-block">Password is required.</div>',
            },status:{
                required: '<div class="help-block">Status is required.</div>',
            }
          
    }
    
});        

</script>	
