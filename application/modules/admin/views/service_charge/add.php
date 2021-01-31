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
                                      <?php echo form_open_multipart('', array('class' => '', 'id' => 'teamForm')); ?>


											<div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <label for="inputEmail4">Campaign Name*</label>
                                                    <input type="text" value="<?php echo set_value('campaign_name') ?>" class="form-control" name="campaign_name" id="campaignName" placeholder="Campaign Name">
                                                    <label class="error"><div class="help-block" style="color:red"> <?php echo form_error('campaign_name'); ?></div></label>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="inputEmail4">Start Date*</label>
                                                    <input type="text" class="form-control" value="<?php echo set_value('start_date') ?>"  name="start_date" id="datepicker" placeholder="Start Date">
                                                    <label  class="error"><div class="help-block" style="color:red"> <?php echo form_error('start_date'); ?></div></label>

                                                </div>
                                            </div>
											<div class="form-row">
                                                
                                                <div class="form-group col-md-6">
                                                    <label for="inputEmail4">End Date*</label>
                                                    <input type="text" name="end_date"  value="<?php echo set_value('end_date') ?>" class="form-control" id="end_date" placeholder="End Date">
                                                    <label  class="error"><div class="help-block" style="color:red"> <?php echo form_error('end_date'); ?></div></label>

                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="inputState">Campaign Type*</label>
                                                    <select id="inputState" class="form-control" name="campaign_type">
                                                        <option value="">Select</option>
														<option <?php echo (set_value('campaign_type') == '1') ? " selected=' selected'" : "" ?> value="1"> Click</option>
                                                        <option <?php echo (set_value('campaign_type') == '2') ? " selected=' selected'" : "" ?> value="2"> Impression</option>
                                                        <option  <?php echo (set_value('campaign_type') == '3') ? " selected=' selected'" : "" ?> value="3"> Lead</option>
                                                    </select>
                                                    <label  class="error"><div class="help-block" style="color:red"> <?php echo form_error('campaign_type'); ?></div></label>

                                                </div>
                                            </div>
											<div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <label for="inputEmail4">Amount  ( &#163; ) *</label>
                                                    <input type="number" min="1" min="0" name="amount" value="<?php echo set_value('amount') ?>" class="form-control" id="amount" placeholder="Amount">
                                                    <label  class="error"><div class="help-block" style="color:red"> <?php echo form_error('amount'); ?></div></label>

                                                </div>
												 <div class="form-group col-md-6">
                                                    <label for="inputEmail4">Description*</label>
                                                    <input type="text" name="description" value="<?php echo set_value('description') ?>" class="form-control" id="description" placeholder="Description">
                                                    <label  class="error"><div class="help-block" style="color:red"> <?php echo form_error('description'); ?></div></label>

                                                </div>
												<div class="form-group col-md-6">
                                                    <label for="inputState1">Duration*</label>


                                                    <select id="inputState1" class="form-control" name="duration">
                                                        <option value="">Select</option>
														<option value="1" <?php echo (set_value('duration') == '1') ? " selected=' selected'" : "" ?> > Weekly</option>
                                                        <option value="2" <?php echo (set_value('duration') == '2') ? " selected=' selected'" : "" ?>> Monthly</option>
                                                    </select>
                                                    <label class="error"><div class="help-block" style="color:red"> <?php echo form_error('duration'); ?></div></label>

                                                </div>
												<div class="form-group col-md-6">
                                                    <label for="inputState2">Select Advertiser*</label>
                                                    <select id="inputState3"  class="form-control" name="publisher_type[]" multiple="multiple">
                                                    
														<?php
														if(!empty($publisher)){
															foreach($publisher as $key=>$value){
														?>
                                                        <option value="<?php echo $value->id;?>" 
                                                        
                                                       
                                                        
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
                                                    <img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image" id="img1" alt=""/>
                                                </div>
                                                <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;">
                                                </div>
                                                <div class="select-img21">
                                                    <span class="default btn-file  select-profile-imgs">
                                                        <!--<span class="fileinput-new btn btn-primary">
                                                            Select image </span>
                                                        <span class="fileinput-exists btn btn-primary">
                                                            Change </span>

                                                        <input type="file"   name="userfile"   id="userfile" data="<?=@$result->profile_image?>"  >-->
                                                    </span>
                                                    <span class="default">
                                                    <input type="file" name="userfile"   id="userfile" data="<?=@$result->profile_image?>" style="border: 1px solid #ddd; padding: 5px 5px;">
                                                    </span>
                                                    <a href="javascript:;" class="btn default fileinput-exists  btn-danger" data-dismiss="fileinput">
                                                        Remove </a>
											<label  class="error"><div class="help-block" style="color:red">
											<?php
if (!empty($error)) {
    echo $error;
}
?>


											</div></label>

                                                </div>
                                            </div>
											</div>
											<div class="form-group col-md-6">
                                                    <label for="inputState3">Status*</label>
                                                    <select id="inputState3" class="form-control" name="status">
                                                        <option value="">Select</option>
														<option <?php echo (set_value('status') == '1') ? " selected=' selected'" : "" ?>value="1"> Assigned</option>
                                                        <option <?php echo (set_value('status') == '2') ? " selected=' selected'" : "" ?>value="2"> Accepted</option>
														<option <?php echo (set_value('status') == '3') ? " selected=' selected'" : "" ?>value="3"> Pending</option>
														<option <?php echo (set_value('status') == '4') ? " selected=' selected'" : "" ?> value="4"> Closed</option>
                                                    </select>
                                                    <label class="error"><div class="help-block" style="color:red"> <?php echo form_error('status'); ?></div></label>

                                            </div>

											</div>
                                            <div class="form-group">
                                                <div class="checkbox checkbox-circle checkbox-info peers ai-c text-center">
                                                   <div class="peer"> 
                                                   <button type="submit" class="btn btn-primary"> Submit </button>
                                                   <a href="<?php echo base_url('admin/campaign');?>"><button type="button" class="btn btn-primary"> Cancel </button></a>

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
        minDate: new Date(),
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

    // $.validator.addMethod('startdate', function (value) {
    //          return /\d{4}-\d{2}-\d{2}/.test(value);
    // }, 'Please enter a valid start_date.');




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