
<main id="myclsid" class="main-content bgc-grey-100">
                <div id="mainContent">
                    <div class="container-fluid">
                        <!--<h4 class="c-grey-900 mT-10 mB-30"> List </h4>-->
                        <div class="row">
                            <div class="masonry-item col-md-12">
                                <div class="bgc-white p-20 bd">
                                    <h6 class="c-grey-900">Add Form</h6>
                                     <?=get_flashdata();?>
                                    <div class="mT-30">
                                        <?php echo form_open_multipart('', array('class' => '', 'id' => 'ciatyform_id',)); ?>
                                        <div class="form-row">
                                           
                                           <div class="form-group col-md-6">
                                               <label for="inputEmail4">Seller Name *</label>
                                              <?php  $name = @$result->name;
                                               $postvalue = @$_POST['seller_name'];
//                                                    $val = !empty($postvalue)? $postvalue:$name;
                                               echo form_input(array('name' => 'seller_name','maxlength'=>'25', 'class' => 'form-control', 'id' => 'cate_id', 'placeholder' => 'Seller Name', 'value' => !empty($postvalue) ? $postvalue : $name ,'onkeyup'=>'validate_character(this)'));
                                            ?>
                                              <label  class="error"><div class="help-block" style="color:red"> <?php echo form_error('seller_name'); ?></div></label>
                                           </div>
                                           <div class="form-group col-md-6">
                                               <label for="inputState2">Contact Person Name *</label>
                                               <?php  $nameS = @$result->contact_person_name;
                                               $postvalueS = @$_POST['contact_person_name'];
//                                                    $val = !empty($postvalue)? $postvalue:$name;
                                               echo form_input(array('name' => 'contact_person_name','maxlength'=>'25', 'class' => 'form-control', 'id' => 'cate_id', 'placeholder' => 'Contact Person Name', 'value' => !empty($postvalueS) ? $postvalueS : $nameS ,'onkeyup'=>'validate_character(this)'));
                                            ?>
                                              <label  class="error"><div class="help-block" style="color:red"> <?php echo form_error('contact_person_name'); ?></div></label>
                                                                                         
                                           </div> 
                                       </div>
                                       <div class="form-row">
                                      
                                           <div class="form-group col-md-6">
                                               <label for="inputEmail4">Contact Person Mobile No. *</label>
                                              <?php  $name = @$result->contact_person_number;
                                               $postvalue = @$_POST['contact_person_number'];
//                                                    $val = !empty($postvalue)? $postvalue:$name;
                                               echo form_input(array('name' => 'contact_person_number','maxlength'=>'25', 'class' => 'form-control', 'id' => 'cate_id', 'placeholder' => 'Contact Person Number', 'value' => !empty($postvalue) ? $postvalue : $name ,'onkeyup'=>'validate_character(this)'));
                                            ?>
                                              <label  class="error"><div class="help-block" style="color:red"> <?php echo form_error('contact_person_number'); ?></div></label>
                                           </div>
                                           <div class="form-group col-md-6">
                                               <label for="inputState2">Seller Account No. *</label>
                                               <?php  $name = @$result->seller_account_no;
                                               $postvalue = @$_POST['seller_account_no'];
//                                                    $val = !empty($postvalue)? $postvalue:$name;
                                               echo form_input(array('type' =>'number' , 'name' => 'seller_account_no','maxlength'=>'25', 'class' => 'form-control', 'id' => 'cate_id', 'placeholder' => 'Seller Account Number', 'value' => !empty($postvalue) ? $postvalue : $name ,'onkeyup'=>'validate_character(this)'));
                                            ?>
                                              <label  class="error"><div class="help-block" style="color:red"> <?php echo form_error('seller_account_no'); ?></div></label>
                                                                                         
                                           </div> 
                                       </div>
                                       <div class="form-row">
                                      
                                           <div class="form-group col-md-6">
                                               <label for="inputEmail4">Bank Name. *</label>
                                              <?php  $name = @$result->bank_name;
                                               $postvalue = @$_POST['bank_name'];
//                                                    $val = !empty($postvalue)? $postvalue:$name;
                                               echo form_input(array('name' => 'bank_name','maxlength'=>'25', 'class' => 'form-control', 'id' => 'cate_id', 'placeholder' => 'Bank Name.', 'value' => !empty($postvalue) ? $postvalue : $name ,'onkeyup'=>'validate_character(this)'));
                                            ?>
                                              <label  class="error"><div class="help-block" style="color:red"> <?php echo form_error('bank_name'); ?></div></label>
                                           </div>
                                           <div class="form-group col-md-6">
                                               <label for="inputState2">IFSC Code. *</label>
                                               <?php  $name = @$result->ifsc_code;
                                               $postvalue = @$_POST['ifsc_code'];
//                                                    $val = !empty($postvalue)? $postvalue:$name;
                                               echo form_input(array('name' => 'ifsc_code','maxlength'=>'25', 'class' => 'form-control', 'id' => 'cate_id', 'placeholder' => 'IFSC Code.', 'value' => !empty($postvalue) ? $postvalue : $name ,'onkeyup'=>'validate_character(this)'));
                                            ?>
                                              <label  class="error"><div class="help-block" style="color:red"> <?php echo form_error('ifsc_code'); ?></div></label>
                                                                                         
                                           </div> 
                                       </div>
                                       <div class="form-row">
                                      
                                           <div class="form-group col-md-6">
                                               <label for="inputEmail4">Bank Branch Code. *</label>
                                              <?php  $name = @$result->branch_code;
                                               $postvalue = @$_POST['branch_code'];
//                                                    $val = !empty($postvalue)? $postvalue:$name;
                                               echo form_input(array('name' => 'branch_code','maxlength'=>'25', 'class' => 'form-control', 'id' => 'cate_id', 'placeholder' => 'Bank Branch Code.', 'value' => !empty($postvalue) ? $postvalue : $name ,'onkeyup'=>'validate_character(this)'));
                                            ?>
                                              <label  class="error"><div class="help-block" style="color:red"> <?php echo form_error('branch_code'); ?></div></label>
                                           </div>
                                           <div class="form-group col-md-6">
                                               <label for="inputState2">PAN Card No. </label>
                                               <?php  $name = @$result->pan_card;
                                               $postvalue = @$_POST['pan_card'];
//                                                    $val = !empty($postvalue)? $postvalue:$name;
                                               echo form_input(array('name' => 'pan_card','maxlength'=>'25', 'class' => 'form-control', 'id' => 'cate_id', 'placeholder' => 'PAN Card No.', 'value' => !empty($postvalue) ? $postvalue : $name ,'onkeyup'=>'validate_character(this)'));
                                            ?>
                                              <label  class="error"><div class="help-block" style="color:red"> <?php echo form_error('pan_card'); ?></div></label>
                                                                                         
                                           </div> 
                                       </div>
                                       <div class="form-row">
                                      
                                           <div class="form-group col-md-6">
                                               <label for="inputEmail4">Seller Address *</label>
                                              <?php  $name = @$result->seller_address;
                                               $postvalue = @$_POST['seller_address'];
//                                                    $val = !empty($postvalue)? $postvalue:$name;
                                               echo form_input(array('name' => 'seller_address','maxlength'=>'25', 'class' => 'form-control', 'id' => 'cate_id', 'placeholder' => 'Seller Address', 'value' => !empty($postvalue) ? $postvalue : $name ,'onkeyup'=>'validate_character(this)'));
                                            ?>
                                              <label  class="error"><div class="help-block" style="color:red"> <?php echo form_error('seller_address'); ?></div></label>
                                           </div>
                                           <div class="form-group col-md-6">
                                               <label for="inputState2">Seller GST No. *</label>
                                               <?php  $name = @$result->seller_gst_no;
                                               $postvalue = @$_POST['seller_gst_no'];
//                                                    $val = !empty($postvalue)? $postvalue:$name;
                                               echo form_input(array('name' => 'seller_gst_no','maxlength'=>'25', 'class' => 'form-control', 'id' => 'cate_id', 'placeholder' => 'Seller GST No.', 'value' => !empty($postvalue) ? $postvalue : $name ,'onkeyup'=>'validate_character(this)'));
                                            ?>
                                              <label  class="error"><div class="help-block" style="color:red"> <?php echo form_error('seller_gst_no'); ?></div></label>
                                                                                         
                                           </div> 
                                       </div>
                                       <div class="form-row">
                                      
                                      <div class="form-group col-md-6">
                                          <label for="inputEmail4">Remark </label>
                                          <!-- <input type="text" name="city_name" value="<?php echo set_value('city_name') ?>"   class="form-control"  placeholder="City Name"> -->
                                         <?php  $name = @$result->remark;
                                          $postvalue = @$_POST['remark'];
//                                                    $val = !empty($postvalue)? $postvalue:$name;
                                          echo form_input(array('name' => 'remark','maxlength'=>'25', 'class' => 'form-control', 'id' => 'cate_id', 'placeholder' => 'Remark', 'value' => !empty($postvalue) ? $postvalue : $name ,'onkeyup'=>'validate_character(this)'));
                                       ?>
                                         <label  class="error"><div class="help-block" style="color:red"> <?php echo form_error('remark'); ?></div></label>
                                      </div>
                                      <div class="form-group col-md-6">
                                          <label for="inputState2">Status*</label>
                                              <select id="inputState2" class="form-control" name="status">
                                                  <option value="Active">Active</option>
                                                  <option value="Inactive">Inactive</option>
                                                 
                                              </select>
                                      
                                      </div> 
                                  </div>
                                            
                                            <div class="form-group">
                                                <div class="checkbox checkbox-circle checkbox-info peers ai-c text-center">
                                                   <div class="peer"> 
                                                   
                                                   <button type="submit" class="btn btn-primary"> Submit </button>
                                                   <a href="<?php echo base_url('master/seller/');?>"><button type="button" class="btn btn-primary"> Cancel </button></a>

                                                   
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
                    </div>
                </div>
            </main>


<script>
 $.validator.addMethod("leters_space",function(value,element){
        if(value=='' || value==null)
        {
            return true;
        }
        return  /^[A-Za-z]+( [A-Za-z]+)*$/.test(value);
},'');  

$('#ciatyform_id').validate({
    rules:{
        seller_name:{
            required:true,
        },
        city_name:{
            required:true,
            leters_space:true,
        }
    },
    messages:{
        seller_name:{
         required:'<div style="color:red">seller Name field is required.</div>',        
        },
        city_name:{
         required:'<div style="color:red">City name field is required.</div>',   
         leters_space:'<div style="color:red">Letters and space allowed Only.</div>',
        }
    }
});


</script>

