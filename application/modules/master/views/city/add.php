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
                                                    <label for="inputState2">State Name*</label>
                                                           
                                                        <select id="inputState2" class="form-control" name="state_name">
                                                            <option value="">Select State</option>
                                                            <?php if(!empty($countrydata)){
                                                                foreach($countrydata as $key => $val){
                                                                if(@$result->state_id == $val->state_id){
                                                                    $selected= 'selected="selected"';  
                                                                  } else if(@$_POST['state_id']){
                                                                    $selected= 'selected="selected"';
                                                                  } else{
                                                                      $selected= '';  
                                                                  }  
                                                                  
                                                                  ?>
                                                            <option value="<?=$val->state_id?>" <?=$selected?> ><?=$val->name?></option>
                                                            <?php }} else{ ?>
                                                        <option value="">No state Available</option>
                                                         <?php } ?>
                                                        </select>
                                                    <label  class="error"><div class="help-block" style="color:red"> <?php echo form_error('state_name'); ?></div></label>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="inputEmail4">City Name*</label>
                                                    <!-- <input type="text" name="city_name" value="<?php echo set_value('city_name') ?>"   class="form-control"  placeholder="City Name"> -->
                                                   <?php $name = @$result->city_name;
                                                    $postvalue = @$_POST['city_name'];
//                                                    $val = !empty($postvalue)? $postvalue:$name;
                                                    echo form_input(array('name' => 'city_name','maxlength'=>'25', 'class' => 'form-control', 'id' => 'cate_id', 'placeholder' => 'City Name', 'value' => !empty($postvalue) ? $postvalue : $name ,'onkeyup'=>'validate_character(this)'));
                                                 ?>
                                                    <label  class="error"><div class="help-block" style="color:red"> <?php echo form_error('city_name'); ?></div></label>
                                                </div>
                                            </div>
                                          
                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <label for="inputState2">Status*</label>
                                                        <select id="inputState2" class="form-control" name="status">
                                                        <?php 
                                                        
                                                         if(@$result->status == $val->status){
                                                            $selected= 'selected="selected"';  
                                                         }
                                                        
                                                        ?>
                                                            <option value="Active" <?php if(@$result->status == 'Active'){echo 'selected="selected"'; }?> >Active</option>
                                                            <option value="Inactive" <?php if(@$result->status == 'Inactive'){echo 'selected="selected"'; }?> >Inactive</option>
                                                           
                                                        </select>
                                                    <label  class="error"><div class="help-block" style="color:red"> <?php echo form_error('state_name'); ?></div></label>
                                                </div>                                          
                                            </div>
                                            <div class="form-group">
                                                <div class="checkbox checkbox-circle checkbox-info peers ai-c text-center">
                                                   <div class="peer"> 
                                                   <button type="submit" class="btn btn-primary"> Submit </button>
                                                   <a href="<?php echo base_url('master/city/');?>"><button type="button" class="btn btn-primary"> Cancel </button></a>
                                                   
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
        state_name:{
            required:true,
        },
        city_name:{
            required:true,
            leters_space:true,
        }
    },
    messages:{
        state_name:{
         required:'<div style="color:red">State name field is required.</div>',        
        },
        city_name:{
         required:'<div style="color:red">City name field is required.</div>',   
         leters_space:'<div style="color:red">Letters and space allowed Only.</div>',
        }
    }
});


</script>

