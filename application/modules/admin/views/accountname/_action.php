    <a style="margin:10px" class="" href="<?php echo base_url();?>admin/account_name/view/<?= ID_encode($row['account_id'])?>"><i class='fa fa-eye'> </i> </a> 
	<a style="margin:10px" class="" href="<?php echo base_url();?>admin/account_name/edit/<?= ID_encode($row['account_id'])?>"><i class="fa fa-edit"></i></a>
	<!-- <a style="margin:10px" class="" href="<?php echo base_url();?>admin/account_name/delete/<?= ID_encode($row['account_id'])?>"><i class="fa fa-trash"></i></a> -->
	

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

<script>
</script>