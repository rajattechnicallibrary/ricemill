<a href="<?php echo base_url();?>admin/service_charge/view/<?=$row['id']?>"><i class='fa fa-eye'> </i> </a> 
<?php
if($row['status']!='4'){
    ?>
	<a href="<?php echo base_url();?>admin/service_charge/edit/<?= $row['id']?>"><i class="fa fa-edit"></i></a>
<?php
}

?>

	

<?php
if(@$_GET['status'] == 'delete')
{
$restoreArr = array(
    'table'=>'fs_users',
    'col1'=> 'status',
    'col2'=> 'id',
    'value'=>'active',
    'id'=>ID_decode($row),    
    ); 
$resA = htmlspecialchars(json_encode($restoreArr));
?>

<?php } ?>


<div id="myModal_<?php echo $row['id'];?>" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Add Price</h4>
      </div>
      <div class="modal-body">
      <?php echo form_open_multipart('', array('class' => '', 'id' => 'teamForm',)); ?>
      <div class="form-group ">
            <label for="inputEmail4">Add Price  *</label>
            <input type="hidden" name="mapping_id"  id="mapping_id" value="<?=$row['id']?>">
            <input type="number" class="form-control" rows="10" id="comment<?=$row['id']?>" name="rejected_reason">
            
            <div class="help-block" id="comment_error<?=$row['id']?>" style="color:red"></div>
    </div>
        </form>
      </div>
      <div class="modal-footer">
      <button type="button" class="btn btn-primary" id="reject_button1<?=$row['id']?>" data="<?=$row['id']?>">  Submit </button>   
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

<div id="myModal2_<?php echo $row['id'];?>" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Add Price</h4>
      </div>
      <div class="modal-body">
      <?php echo form_open_multipart('', array('class' => '', 'id' => 'teamForm',)); ?>
      <div class="form-group ">
            <label for="inputEmail4">Add Price  *</label>
            <input type="hidden" name="mapping_id"  id="mapping_id" value="<?=$row['id']?>">
            <input type="number" class="form-control" rows="10" id="comment2<?=$row['id']?>" name="rejected_reason">
            
            <div class="help-block" id="comment_error2<?=$row['id']?>" style="color:red"></div>
    </div>
        </form>
      </div>
      <div class="modal-footer">
      <button type="button" class="btn btn-primary" id="reject_button2<?=$row['id']?>" data="<?=$row['id']?>">  Submit </button>   
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>


<script>
$("#reject_button1<?=$row['id']?>").click(function(){   
   
        var ids = $(this).attr('data');
        var comment = $("#comment<?=$row['id']?>").val();
        $.ajax({
                url: "<?php echo base_url("admin/service_charge/submit_price"); ?>",
                type: "POST",
                data: 'mapping_id='+ids+'&comment='+comment,
                success: function(result){
                    if(result == 1){
                        window.location="<?php echo base_url("admin/service_charge"); ?>";
                    }

                    var obj=JSON.parse(result);
                    if(obj.validation_error.comment!=null){

                        $('#comment_error<?=$row['id']?>').html(obj.validation_error.comment);
                    }else{
                        $('.comment_error<?=$row['id']?>').html("");
                    }

                    
                }
            });

    });

</script>

<script>
$("#reject_button2<?=$row['id']?>").click(function(){   
    var ids = $(this).attr('data');
        var comment = $("#comment2<?=$row['id']?>").val();
        $.ajax({
                url: "<?php echo base_url("admin/service_charge/submit_price_publisher"); ?>",
                type: "POST",
                data: 'mapping_id='+ids+'&comment='+comment,
                success: function(result){
                    if(result == 1){
                        
                        window.location="<?php echo base_url("admin/service_charge"); ?>";
                       
                    }

                    var obj=JSON.parse(result);
                    if(obj.validation_error.comment!=null){

                        $('#comment_error2<?=$row['id']?>').html(obj.validation_error.comment);
                    }else{
                        $('.comment_error2<?=$row['id']?>').html("");
                    }

                    
                }
            });

    });

</script>