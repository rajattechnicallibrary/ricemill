    <a href="<?php echo base_url();?>admin/billing/view/<?= ID_encode($row['id'])?>"><i class='fa fa-eye'> </i> </a> 
	<a href="<?php echo base_url();?>admin/billing/edit/<?= ID_encode($row['id'])?>"><i class="fa fa-edit"></i></a>
	<a  target="_blank" href="<?php echo base_url().'uploads/invoice_slips/'.$row['invoice_name'];?>"><i class="fa fa-download"></i></a>
	

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