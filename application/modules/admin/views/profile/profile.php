<main class="main-content bgc-grey-100">
                <div id="mainContent">
				<h4 class="c-grey-900 mT-10 mB-30">My Profile</h4>
                    <div class="row gap-20 masonry pos-r">
                        <div class="masonry-sizer col-md-12"></div>
                        <div class="masonry-item col-md-12">
                            <div class="bgc-white p-20 bd">
							<div id="errormsg" style="color:red"></div>
								 <div id="errormsg1" style="color:red"></div>
                                <!--<h6 class="c-grey-900">Complex Form Layout</h6>-->
								
								<!-- <ul>
									<li class="mbr-gallery-filter-all">
										<a class=" btn-md active" href=""> Contact Info </a>
									</li>
									<li>
										<a class="btn-md" href=""> Company Info </a>
									</li>
								</ul> -->
								
								<div class="col-md-12">
									<div class="row">
										<div class="col-md-6 text-center info-tab-contianer">
											<p> Contact Info </p>
										</div>
										
										<div class="col-md-6 text-center info-tab-contianer">
											<p> Company Info </p>
										</div>
									</div>
								</div>
								
                                <div class="mT-30 alpha_num_a">
                                <?php echo form_open('', array('class' => '', 'id' => 'teamForm')); ?>
                                
                                
                                        <div class="form-row">
                                            <div class="form-group offset-md-1 col-md-5">
                                                <label for="frst_nme" class="input-label"> First Name *</label>
                                                <input type="text"  value="<?php echo $user_data->first_name;?>"class="input-content form-control" id="frst_nme" name="first_name"  placeholder="First Name" maxlength="40">
                                            </div>
                                            <span class="help-block"><?php echo form_error('first_name'); ?></span>

                                            <div class="form-group col-md-5">
                                                <label for="last_nme" class="input-label"> Last Name * </label>
                                                <input type="text" value="<?php echo $user_data->last_name;?>" class="input-content form-control" id="last_nme" name="last_name" placeholder="Last Name">
                                            </div>
                                        </div>
										<div class="form-row">
                                            <div class="form-group offset-md-1 col-md-5">
                                                <label for="email_id" class="input-label"> Email * </label>
                                                <input type="email" readonly value="<?php echo $user_data->email;?>" class="input-content form-control" name="email" id="email_id" placeholder="Email">
                                            </div>
                                            <div class="form-group col-md-5">
                                                <label for="mo" class="input-label"> Mobile No. * </label>
                                                <input type="number" min="1" value="<?php echo $user_data->mobile;?>" class="input-content form-control" name="mobile" id="mo" placeholder="Mobile No.">
                                            </div>
                                            <span class="help-block" id="mobile_number_id"><?php echo form_error('mobile_number'); ?></span>
                                        </div>
										<div class="text-center my-4">
											<button type="submit" class="btn btn-primary nxt-btn">Next</button>
										</div>
                                    </form>
                                </div>

								
							<div class="mT-30 alpha_num_b" style="display: none;">
                                <?php echo form_open('', array('class' => '', 'id' => 'publisher_org')); ?>
                                        <div class="form-row">
                                            <div class="form-group offset-md-1 col-md-5">
                                                <label for="org_name" class="input-label"> Organisation Name&nbsp;* </label>
                                                <input type="text" value="<?=($user_data) ? $user_data->organisation_name : ''?>" class="input-content form-control" name="org_name" id="org_name" placeholder="Organisation Name">
                                            </div>
                                            <div class="form-group col-md-5">
                                                <label for="statem" class="input-label"> State * </label>
                                                <select id="statem" name="state" class=" input-content form-control" onchange="abc();">
                                                <option value="">Please Select </option>

                                                <?php if(!empty($state)){?>
                                                <?php foreach($state as $key => $val){?>
                                                
                                                    <option value="<?php echo $val->state_id; ?>" <?php if($user->state_id==$val->state_id){echo "selected";} ?>><?php echo $val->name; ?> </option>
                                                <?php }?>
                                                <?php }?>
                                                </select>
                                            </div>
                                        </div>
										<div class="form-row">
                                            <div class="form-group offset-md-1 col-md-5">
                                                <label for="inputState" class="input-label"> City * </label>
                                                <select id="inputCity" name="city" class=" input-content form-control">
                                                    <option value=''> Select City </option>
                                                    <?php
                                                        if(!empty($city)){
                                                            foreach($city as $values)
                                                            {                                                               
                                                                
                                                        ?>
                                                        <option value=<?php echo $values->city_id;?> <?php if($user->city_id==$values->city_id){echo "selected";} ?>> <?php echo $values->name;?></option>
                                                       <?php
                                                     }
                                                    }

                                                    ?>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-5">
                                                <label for="inputPassword4" class="input-label"> Address * </label>
                                                <input type="text" value="<?=($user_data) ? $user_data->address : ''?>" class="input-content form-control" name="address" id="address" placeholder="Address">
                                            </div>
                                        </div>
										<div class="form-row">
                                            <div class="form-group offset-md-1 col-md-5">
                                                <label for="zipcode" class="input-label"> Zip Code * </label>
                                                <input type="number" min="1" class="input-content form-control" value="<?=($user_data) ? $user_data->zipcode : ''?>"  name="zip_code" id="zipcode" placeholder="Zip Code">
                                            </div>
                                            <div class="form-group col-md-5">
                                                <label for="mobile" class="input-label">Company Mobile No* </label>
                                                <input type="number" min="1" class="input-content form-control"  value="<?=($user_data) ? $user_data->mobile_no : ''?>" name="company_mobile" id="mobile" placeholder="Company Mobile No.">
                                            </div>
                                        </div>
										<div class="form-row">
                                            <div class="form-group offset-md-1 col-md-5">
                                                <label for="fax" class="input-label"> Fax </label>
                                                <input type="number" min="1" class="input-content form-control"  value="<?=($user_data) ? $user_data->fax : ''?>" id="fax" name="fax" placeholder="Fax">
                                            </div>
                                            
                                        </div>
    									<div class="text-center my-4 form-row">
											<div class="offset-md-4 col-md-2 text-center">
												<button type="button" id="companyInfo_back" class="btn btn-primary nxt-btn">Back</button>
											</div>
											<div class="col-md-2 text-center">
												<button type="submit" class="btn btn-primary nxt-btn">Submit</button>
											</div>
										</div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
 <script>
	  $.validator.addMethod('zipcode', function (value) { 
        return /^[0-9]*$/.test(value); 
    }, '<div class="help-block" style="color:red">Please enter valid zipcode.</div>');

    $.validator.addMethod('valid_no', function (value) { 
        return /^[0-9]*$/.test(value); 
    }, '<div class="help-block" style="color:red">Please enter valid no.</div>');

//  validate mobile number takes only numeric values
$(document).ready(function() {
   
    $("#mo").keydown(function (e) {
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
			$('#mobile_number_id').html("");
		}
    });
});



 $("#teamForm").validate({
    
    rules: {
        first_name:{
            required: true,
            maxlength: "20",
        },
        last_name:{
            required: true,
            maxlength: "20",
        }
        ,
        email:{
            required: true,
            maxlength: "40",
            email: true
        },
        mobile:{
            required: true,
            maxlength: "14",
            minlength: "7",
            valid_no:true,
        }
    },
    messages:{
            first_name:{
               required: '<div class="help-block" style="color:red"> First Name is required.</div>',
               maxlength :'<div class="help-block" style="color:red">Maximunm First Name length should be 20.</div>',
            },
            last_name:{
               required: '<div class="help-block" style="color:red"> Last Name is required.</div>',
               maxlength :'<div class="help-block" style="color:red">Maximunm Last Name length should be 20.</div>',
            },
            email:{
               required: '<div class="help-block" style="color:red"> Email address is required.</div>',
               alphanumeric_dash_underscore: '<div class="help-block" style="color:red">Letters,Numbers,Dash,Space or Underscore only allowed .</div>',
               maxlength :'<div class="help-block" style="color:red">Maximunm Email Id length should be 40.</div>',
               email: "<div class='help-block' style='color:red'>Please enter a valid email address.</div>",
            },
            mobile:{
               required: '<div class="help-block" style="color:red"> Mobile no. is required.</div>',
               maxlength: jQuery.validator.format("<div class='help-block' style='color:red'>Max limit at least 14 digits.</div>"),
               minlength: jQuery.validator.format("<div class='help-block' style='color:red'>It should be at least 7 digits required.</div>")
            
            }
        },
        submitHandler: function () {
			var formdata =$('#teamForm').serialize();
         //   jAlert("Not Change credit limit.Your total amount is Rs.");
            $.ajax({
                url: "<?php echo base_url("admin/profile/save_ajax"); ?>",
                type: "POST",
                data: formdata,
                success: function(result){
                    var res = JSON.parse(result);
                    if(res.status == 'success'){
                        $(".info-tab-contianer:nth-child(1) p").css("border-bottom", "none");
                        $(".info-tab-contianer:nth-child(2) p").css("border-bottom", "2px solid #2196f3");
                        $(".alpha_num_a").hide();
                        $(".alpha_num_b").show();
                        $('#errormsg').hide();
                     }else{
                         $('#errormsg').html(res.validation_error)
                        }
                    }
                });
        }
});


 $("#publisher_org").validate({
   
    rules: {
        org_name:{
            required: true,
            maxlength: "40",
        },
        state:{
            required: true,
            maxlength: "40",
        },
        city:{
            required: true,
            maxlength: "40",
        },
        address:{
            required: true,
           
        },
        zip_code:{
            required: true,
            maxlength: "40",
			zipcode:true,
        },
		
        company_mobile:{
            required: true,
            maxlength: "14",
            minlength: "7",
            valid_no:true,
        },
		fax:{
           // required: true,
            maxlength: "40",
        },  		
    },
    messages:{
        org_name:{
               required: '<div class="help-block" style="color:red"> Organisation Name is required.</div>',
               alphanumeric_dash_underscore: '<div class="help-block" style="color:red">Letters,Numbers,Dash,Space or Underscore only allowed .</div>',
               maxlength :'<div class="help-block" style="color:red">Maximunm  Organisation Name length should be 40</div>',
            },
            state:{
               required: '<div class="help-block" style="color:red"> State Name is required.</div>',
               alphanumeric_dash_underscore: '<div class="help-block" style="color:red">Letters,Numbers,Dash,Space or Underscore only allowed .</div>',
               maxlength :'<div class="help-block" style="color:red">Maximunm State length should be 40</div>',
            },
            city:{
               required: '<div class="help-block" style="color:red"> City is required.</div>',
               alphanumeric_dash_underscore: '<div class="help-block" style="color:red">Letters,Numbers,Dash,Space or Underscore only allowed .</div>',
               maxlength :'<div class="help-block" style="color:red">Maximunm City length should be 40</div>',
            },
            address:{
               required: '<div class="help-block" style="color:red"> Address is required.</div>',
               
            },
            zip_code:{
               required: '<div class="help-block" style="color:red"> Zip Code is required.</div>',
               alphanumeric_dash_underscore: '<div class="help-block" style="color:red">Letters,Numbers,Dash,Space or Underscore only allowed .</div>',
               maxlength :'<div class="help-block" style="color:red">Maximunm Zip Code length should be 40</div>',
            },
            company_mobile:{
               required: '<div class="help-block" style="color:red"> Company Mobile is required.</div>',
               maxlength: jQuery.validator.format("<div class='help-block' style='color:red'>Max limit at least 14 digits.</div>"),
               minlength: jQuery.validator.format("<div class='help-block' style='color:red'>It should be at least 7 digits required.</div>")
             },
           fax:{
              // required: '<div class="help-block" style="color:red"> Fax is required.</div>',
               alphanumeric_dash_underscore: '<div class="help-block" style="color:red">Letters,Numbers,Dash,Space or Underscore only allowed .</div>',
               maxlength :'<div class="help-block" style="color:red">Maximunm Fax length should be 40</div>',
            },
        },  submitHandler: function () {
         //   jAlert("Not Change credit limit.Your total amount is Rs.");
            $.ajax({
                url: "<?php echo base_url("admin/profile/update_profile_data"); ?>",
                type: "POST",
                data: $("#publisher_org").serialize(),
                
                success: function(result){
                    var res = JSON.parse(result);
                    if(res.status == 'success'){
                        window.location.href="<?=base_url()?>"+res.url;
                        $(".info-tab-contianer:nth-child(1) p").css("border-bottom", "none");
                        $(".info-tab-contianer:nth-child(2) p").css("border-bottom", "2px solid #2196f3");
                        $(".alpha_num_a").hide();
                        $(".alpha_num_b").show();
                        $('#errormsg1').hide();
                     }else{
                         $('#errormsg1').html(res.validation_error)
                        }
                    }
                });
   }

});

</script>


     <script>
		$(document).ready(function(){
		$("#contactInfo_next").click(function(){
			$(".info-tab-contianer:nth-child(1) p").css("border-bottom", "none");
			$(".info-tab-contianer:nth-child(2) p").css("border-bottom", "2px solid #2196f3");
			$(".alpha_num_a").hide();
			$(".alpha_num_b").show();
		});
			$("#companyInfo_back").click(function(){
				$(".info-tab-contianer:nth-child(2) p").css("border-bottom", "none");
				$(".info-tab-contianer:nth-child(1) p").css("border-bottom", "2px solid #2196f3");
				$(".alpha_num_b").hide();
				$(".alpha_num_a").show();
			});
		});
	</script>