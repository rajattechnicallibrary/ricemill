<a href="<?php echo base_url();?>admin/campaign/view/<?=$row['id']?>"><i class='fa fa-eye'> </i> </a> 
	<a href="<?php echo base_url();?>admin/campaign/edit/<?= $row['id']?>"><i class="fa fa-edit"></i></a>
	

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