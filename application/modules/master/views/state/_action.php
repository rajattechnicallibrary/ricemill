
<?php 

if(@$_GET['status'] !='delete'){ ?>
	<a href="<?php echo base_url();?>master/state/view/<?= ID_encode($row['state_id'])?>"><i class='fa fa-eye'> </i> </a> </a>
	<a href="<?php echo base_url();?>master/state/edit/<?= ID_encode($row['state_id'])?>"><i class="fa fa-edit"></i></a>
	
	<a href="javascript:void(0);" class="btn  btn-xs btn-danger margin-right-10 " title="delete" onclick="delete_state(<?php echo $row['state_id'] ; ?>);">
    <i class="fa fa-trash"></i>
</a>
<?php }
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