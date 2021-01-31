
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
                                               <label for="inputEmail4">CGSR % *</label>
                                              <?php  $name = @$result->cgst;
                                               $postvalue = @$_POST['cgst'];
//                                                    $val = !empty($postvalue)? $postvalue:$name;
                                               echo form_input(array('type' => 'number', 'step'=>'0.01', 'min' =>'0','name' => 'cgst','maxlength'=>'25', 'class' => 'form-control', 'id' => 'cgst', 'placeholder' => 'CGST %', 'value' => !empty($postvalue) ? $postvalue : $name ));
                                            ?>
                                              <label  class="error"><div class="help-block" style="color:red"> <?php echo form_error('cgst'); ?></div></label>
                                           </div>
                                           <div class="form-group col-md-6">
                                               <label for="inputState2">SGST % *</label>
                                               <?php  $nameS = @$result->sgst;
                                               $postvalueS = @$_POST['sgst'];
//                                                    $val = !empty($postvalue)? $postvalue:$name;
                                               echo form_input(array('type' => 'number','step'=>'0.01', 'min' =>'0','name' => 'sgst','maxlength'=>'25', 'class' => 'form-control', 'id' => 'sgst', 'placeholder' => 'SGST %', 'value' => !empty($postvalueS) ? $postvalueS : $nameS ));
                                            ?>
                                              <label  class="error"><div class="help-block" style="color:red"> <?php echo form_error('sgst'); ?></div></label>
                                                                                         
                                           </div> 
                                       </div>
                                       <div class="form-row">
                                      
                                      <div class="form-group col-md-6">
                                          <label for="inputEmail4">GST % </label>
                                          <!-- <input type="text" name="city_name" value="<?php echo set_value('city_name') ?>"   class="form-control"  placeholder="City Name"> -->
                                         <?php  $name = @$result->gst;
                                          $postvalue = @$_POST['gst'];
//                                                    $val = !empty($postvalue)? $postvalue:$name;
                                          echo form_input(array('readonly' => 'readonly', 'step'=>'0.01', 'min' =>'0', 'type' => 'number','name' => 'gst','maxlength'=>'25', 'class' => 'form-control', 'id' => 'gst', 'placeholder' => 'GST', 'value' => !empty($postvalue) ? $postvalue : $name ));
                                       ?>
                                         <label  class="error"><div class="help-block" style="color:red"> <?php echo form_error('gst'); ?></div></label>
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
                                                   <a href="<?php echo base_url('master/site/');?>"><button type="button" class="btn btn-primary"> Cancel </button></a>

                                                   
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

function GstCal(cgst, sgst){

if(cgst != undefined && sgst != undefined){
      return parseFloat(cgst) + parseFloat(sgst);
}

}


$('#cgst, #sgst, #gst').keyup(function(){

cgst = $('#cgst').val();
sgst = $('#sgst').val();

total = GstCal(cgst, sgst);

if(cgst != undefined && sgst != undefined){

   if( cgst != 0 && sgst != 0){
       $('#gst').val(total);
   }
}
});

function runtotal(){
    cgst = $('#cgst').val();
sgst = $('#sgst').val();

total = GstCal(cgst, sgst);

if(cgst != undefined && sgst != undefined){

   if( cgst != 0 && sgst != 0){
       $('#gst').val(total);
   }
}
}

runtotal();
</script>

