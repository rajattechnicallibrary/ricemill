<link rel="stylesheet" href="<?php echo base_url();?>assets/css/multiple-select.css" />

<main id="myclsid" class="main-content bgc-grey-100">
                <div id="mainContent">
                    <div class="container-fluid">
                        <!--<h4 class="c-grey-900 mT-10 mB-30"> List </h4>-->
                        <div class="row">
                            <div class="masonry-item col-md-12">
                                <div class="bgc-white p-20 bd">
                                    <h6 class="c-grey-900">Add Form</h6>
                                    <div class="mT-30">
                                      <?php echo form_open_multipart('', array('class' => '', 'id' => 'teamForm',)); ?>

                                            
											<div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <label for="inputEmail4">Campaign Name*</label>
													
                                                    <input type="text"  class="form-control" name="campaign_name" id="campaignName" value="<?php echo $campaign_details->campaign_name;?>" placeholder="Campaign Name">
                                                    <label class="error"><div class="help-block" style="color:red"> <?php echo form_error('campaign_name'); ?></div></label>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="inputEmail4">Start Date*</label>
                                                    <input type="text" disabled class="form-control" value="<?php echo $campaign_details->start_date;?>" name="start_date" id="datepicker" placeholder="Start Date">
                                                    <label  class="error"><div class="help-block" style="color:red"> <?php echo form_error('start_date'); ?></div></label>

                                                </div>
                                            </div>
											<div class="form-row">
                                            <div class="form-group col-md-6">
                                                    <label for="inputEmail4">End Date*</label>
                                                    <input type="text" value="<?php echo $campaign_details->end_date;?>" name="end_date"  class="form-control" id="end_date" placeholder="End Date">
                                                    <label  class="error"><div class="help-block" style="color:red"> <?php echo form_error('end_date'); ?></div></label>

                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="inputState2">Campaign Type*</label>
                                                    <select id="inputState2" class="form-control" disabled name="campaign_type">
                                                        <option value="">Select</option>
														<option value="1" <?php if($campaign_details->campaign_type==1) echo 'selected="selected"'; ?> > Click</option>
                                                        <option value="2" <?php if($campaign_details->campaign_type==2) echo 'selected="selected"'; ?>> Impression</option>
                                                        <option  value="3" <?php if($campaign_details->campaign_type==3) echo 'selected="selected"'; ?>> Lead</option>
                                                    </select>
                                                    <label  class="error"><div class="help-block" style="color:red"> <?php echo form_error('campaign_type'); ?></div></label>

                                                </div>
                                               
                                            </div>
											<div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <label for="inputEmail4">Amount ( &#163; ) *</label>
                                                    <input type="number" disabled min="1" name="amount" value="<?php echo $campaign_details->amount;?>" class="form-control" id="amount" placeholder="Amount">
                                                    <label  class="error"><div class="help-block" style="color:red"> <?php echo form_error('amount'); ?></div></label>

                                                </div>
												 <div class="form-group col-md-6">
                                                    <label for="inputEmail4">Description*</label>
                                                    <input type="text" name="description" class="form-control" value="<?php echo $campaign_details->description;?>" id="description" placeholder="Description">
                                                    <label  class="error"><div class="help-block" style="color:red"> <?php echo form_error('description'); ?></div></label>

                                                </div>
												<div class="form-group col-md-6">
                                                    <label for="inputState1">Duration*</label>
                                                    <select id="inputState1" class="form-control" name="duration">
                                                        <option value=""> Select</option>
														<option value="1" <?php if($campaign_details->duration==1) echo 'selected="selected"'; ?>> Weekly</option>
                                                        <option value="2"  <?php if($campaign_details->duration==2) echo 'selected="selected"'; ?>> Monthly</option>
                                                    </select>
                                                    <label class="error"><div class="help-block" style="color:red"> <?php echo form_error('duration'); ?></div></label>

                                                </div>
												<div class="form-group col-md-6">
                                                    <label for="inputState3">Select Publisher*</label>
                                                    <?php
                                                           

                                                    ?>
                                                    <select id="inputState3"  class="form-control" name="publisher_type[]" multiple="multiple">
                                                    
														<?php
														if(!empty($publisher)){
															foreach($publisher as $key=>$value){
														?>
                                                        <option value="<?php echo $value->id;?>" 
                                                        
                                                       <?php
                                                        if (in_array($value->id, $newdata)){
                                                            echo "selected=selected";
                                                        }
                                                        ?>
                                                        
                                                        ><?php echo $value->first_name;?></option>
														<?php
														}
														}
														?>
                                                    </select>
                                                    <label  class="error"><div class="help-block" style="color:red"> <?php echo form_error('publisher_type[]'); ?></div></label>

                                                </div>
												
												<div class="form-group col-md-6">
                                            <div class="fileinput fileinput-new" data-provides="fileinput">
                                                <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
                                                    <?php
                                                    if(!empty($campaign_details->campaign_image)){
                                                    ?>
                                                    <img src="<?php echo base_url(); ?>assets/uploads/campaign/<?php echo $campaign_details->campaign_image?>" height="100px" height="100px"/>
                                                   <?php
                                                    }else{?>     
                                                    <img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image" id="img1" alt=""/>
                                                    <?php
                                                    }?>        
                                                
                                                </div>
                                                <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;">
                                                </div>
                                                <div class="select-img21">
                                                    <span class="btn default btn-file  select-profile-imgs">
                                                        <span class="fileinput-new btn btn-primary">
                                                            Select image </span>
                                                        <span class="fileinput-exists btn btn-primary">
                                                            Change </span>
                                                        <input type="file" name="userfile"   id="userfile" data="<?=@$result->profile_image?>"  >
                                                    </span>
                                                    <a href="javascript:;" class="btn default btn-danger fileinput-exists" data-dismiss="fileinput">
                                                        Remove </a>
											<label  class="error"><div class="help-block" style="color:red">
											<?php 
												if(!empty($error)){
													echo $error;
												}
											?>
											
											</div></label><br>

                                                </div>
                                            </div>
											</div>
											<div class="form-group col-md-6">
                                                    <label for="inputState4">Status*</label>
                                                    <select id="inputState4" class="form-control" name="status">
                                                        <option value="">Select</option>
														<option value="1" <?php if($campaign_details->status==1) echo 'selected="selected"'; ?>> Assigned</option>
                                                        <option value="2" <?php if($campaign_details->status==2) echo 'selected="selected"'; ?>> Accepted</option>
														<option value="3" <?php if($campaign_details->status==3) echo 'selected="selected"'; ?>> Pending</option>
														<option value="3" <?php if($campaign_details->status==4) echo 'selected="selected"'; ?>> Closed</option>
                                                    </select>
                                                    <label class="error"><div class="help-block" style="color:red"> <?php echo form_error('status'); ?></div></label>

                                                </div>
												
											</div>
                                            <div class="form-group">
                                                <div class="checkbox checkbox-circle checkbox-info peers ai-c text-center">
                                                   <div class="peer"> 
                                                   <button type="submit" class="btn btn-primary"> Submit </button>
                                                   <a href="<?php echo base_url('admin/service_charge');?>"><button type="button" class="btn btn-primary"> Cancel </button></a>

                                                   </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>



<script src="<?php echo base_url();?>assets/js/multiple-select.js"></script>





<script>
$( function() {
	
	 $.validator.addMethod('date', function (value) { 
        return /^\d{4}\-(0?[1-9]|1[012])\-(0?[1-9]|[12][0-9]|3[01])$/.test(value); 
    }, '<div class="help-block" style="color:red">Please select valid date.</div>');
    $.validator.addMethod('valid_no', function (value) { 
        return /^[0-9]*$/.test(value); 
    }, '<div class="help-block" style="color:red">Please enter valid no.</div>');

     $( "#datepicker" ).datepicker(
	({ 
	
	dateFormat: 'yy-mm-dd',
	onSelect: function(selected) {
          $("#end_date").datepicker("option","minDate", selected)
        }
	
	
	})
	
	);
	$("#end_date").datepicker(
		({ dateFormat: 'yy-mm-dd',
			onSelect: function(selected) {
				$("#datepicker").datepicker("option","maxDate", selected)
			}

		})
	);
  } );
  
  function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            document.getElementById('img1').src =  e.target.result;
        }

        reader.readAsDataURL(input.files[0]);
    }
}  
   $("#teamForm").validate({
    rules: {
        campaign_name:{
            required: true,
            maxlength: "40",
        },
        start_date:{
            required: true,
            
			date:true,
		

        }
        ,
        campaign_type:{
            required: true,
            maxlength: "40",
            
        },
        end_date:{
            required: true,
            date:true,

        },
		amount:{
            required: true,
            maxlength: "40",
            valid_no:true,
        },
		description:{
            required: true,
            maxlength: "400",
        },
		duration:{
            required: true,
            maxlength: "40",
        },
		advertiser_type:{
            required: true,
            maxlength: "40",
        },
		status:{
            required: true,
            maxlength: "40",
        },
		
	},
    messages:{
            campaign_name:{
               required: '<div class="help-block" style="color:red"> Campaign Name is required.</div>',
               alphanumeric_dash_underscore: '<div class="help-block" style="color:red">Letters,Numbers,Dash,Space or Underscore only allowed .</div>',
               maxlength :'<div class="help-block" style="color:red">Maximunm Campaign Name length should be 40</div>',
            },
            start_date:{
               required: '<div class="help-block" style="color:red"> Start Date is required.</div>',
               alphanumeric_dash_underscore: '<div class="help-block" style="color:red">Letters,Numbers,Dash,Space or Underscore only allowed .</div>',
               maxlength :'<div class="help-block" style="color:red">Maximunm Start Date length should be 40</div>',
            },
            campaign_type:{
               required: '<div class="help-block" style="color:red"> Campaign  is required.</div>',
               alphanumeric_dash_underscore: '<div class="help-block" style="color:red">Letters,Numbers,Dash,Space or Underscore only allowed .</div>',
               maxlength :'<div class="help-block" style="color:red">Maximunm Campaign length should be 40</div>',
            },
            end_date:{
               required: '<div class="help-block" style="color:red">End Date is required.</div>',
               alphanumeric_dash_underscore: '<div class="help-block" style="color:red">Letters,Numbers,Dash,Space or Underscore only allowed .</div>',
               maxlength :'<div class="help-block" style="color:red">Maximunm End Date length should be 40</div>',
            
            },
			amount:{
               required: '<div class="help-block" style="color:red"> Amount is required.</div>',
               alphanumeric_dash_underscore: '<div class="help-block" style="color:red">Letters,Numbers,Dash,Space or Underscore only allowed .</div>',
               maxlength :'<div class="help-block" style="color:red">Maximunm Amount length should be 40</div>',
            },
            description:{
               required: '<div class="help-block" style="color:red"> Description is required.</div>',
               alphanumeric_dash_underscore: '<div class="help-block" style="color:red">Letters,Numbers,Dash,Space or Underscore only allowed .</div>',
               maxlength :'<div class="help-block" style="color:red">Maximunm Description length should be 400.</div>',
            },
            duration:{
               required: '<div class="help-block" style="color:red">Duration is required.</div>',
               alphanumeric_dash_underscore: '<div class="help-block" style="color:red">Letters,Numbers,Dash,Space or Underscore only allowed .</div>',
               maxlength :'<div class="help-block" style="color:red">Maximunm End Date length should be 40</div>',
            
            },
			advertiser_type:{
               required: '<div class="help-block" style="color:red">Advertiser type is required.</div>',
               alphanumeric_dash_underscore: '<div class="help-block" style="color:red">Letters Type,Numbers,Dash,Space or Underscore only allowed .</div>',
               maxlength :'<div class="help-block" style="color:red">Maximunm End Date length should be 40</div>',
            
            },status:{
               required: '<div class="help-block" style="color:red">Status is required.</div>',
               alphanumeric_dash_underscore: '<div class="help-block" style="color:red">Letters,Numbers,Dash,Space or Underscore only allowed .</div>',
               maxlength :'<div class="help-block" style="color:red">Maximunm End Date length should be 40</div>',
            
            },
			
	}
             
             
             ,

});

  
  
  
  
 </script>
 <script>
    $(function() {
        $('#inputState3').change(function() {
            console.log($(this).val());
        }).multipleSelect({
            width: '100%'
        });
    });
</script>
