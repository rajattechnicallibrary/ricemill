<br>
<table id="dataTable" class="table table-striped table-bordered" cellspacing="0" width="100%">

                                        <thead>
                                            <tr>
                                                <th>S.No.</th>
                                                <th>Campaign Name</th>
                                                <th>Amount</th>
                                                <th>Description</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
										
                                        <tbody>
                                        <?php
											if(!empty($result['result'])){
													
                                                    $var = 1;
                                                    foreach($result['result']  as $value){

                                        ?>
                                            <tr>
                                           
                                                <td><?php echo $var++;?></td>
                                                <td><?php echo $value->campaign_name;?></td>
                                                <td><?php echo $value->amount;?></td>
                                                <td><?php echo $value->description;?></td>
                                                <td><a href="<?php base_url();?>/affiliateme/admin/campaign/view/<?php echo $value->id;?>"><i class="ti-eye mR-5"></i></a>
													<a href="<?php base_url();?>/affiliateme/admin/campaign/edit/<?php echo $value->id;?>"><i class="ti-pencil mR-5"></i></a>	
													
                                            </tr>
                                                                                
                                                                                
                                        <?php
                                                }
                                                
                                            }else{
                                                ?>
										        <tr><td colspan="7"> No Record Found</td>	</tr>
											<?php
											}
											?>
                                      </tbody>
										
                                    </table>
<?php
$paging = custompaging($cur_page, $no_of_paginations, $previous_btn, $next_btn, $first_btn, $last_btn);
echo $paging;
?>

<script>

