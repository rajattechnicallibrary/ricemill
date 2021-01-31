<main class="main-content bgc-grey-100">
                <div id="mainContent">
                    <div class="container-fluid">
                        <h4 class="c-grey-900 mT-10 mB-30">View List</h4>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="bgc-white bd bdrs-3 p-20 mB-20">
                                <a href="<?=base_url()?>admin/service_charge" id="back-btn" class="btn cur-p btn-primary pull-right">Back</a><br><br>

                                    <!--<h4 class="c-grey-900 mB-20">Simple Table</h4>-->
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th class="table_bg" scope="col">Campaign Name</th>
                                                <th scope="col"><?php echo ucfirst($users->campaign_name);?></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <th  class="table_bg" scope="row">Start Date</th>
                                                <td><?php echo $users->start_date;?></td>
                                            </tr>
                                            <tr>
                                                <th class="table_bg" scope="row">End Date</th>
                                                <td><?php echo $users->end_date;?></td>
                                            </tr>
                                            <tr>
                                                <th class="table_bg" scope="row">Campaign Type</th>
                                                <td>
												<?php
												
												if($users->campaign_type ==1){
													echo "Click";
												}
												if($users->campaign_type ==2){
													echo "Impression";
												}
												if($users->campaign_type ==3){
													echo "Lead";
												}
												
												
												
												?></td>
                                            </tr>

                                            <tr>
                                                <th class="table_bg" scope="row">Amount ( &#163; )</th>
                                                <td><?php echo $users->amount;?></td>
                                            </tr>

                                            <tr>
                                                <th class="table_bg" scope="row">Description</th>
                                                <td><?php echo ucfirst($users->description);?></td>
                                            </tr>
                                            <tr>
                                                <th class="table_bg" scope="row">Campaign Image</th>
                                                <td><img src="<?php echo base_url(); ?>assets/uploads/campaign/<?php echo $users->campaign_image?>" height="100px" height="100px"/></td>
                                            </tr>
                                            <tr>
                                                <th class="table_bg" scope="row">Duration</th>
                                                <td>
												<?php
												
												if($users->duration ==1){
													echo "Weekly";
												}
												if($users->duration ==2){
													echo "Monthly";
												}
												?>
												
												
												
												
												</td>
                                            </tr>
											<tr>
                                                <th class="table_bg" scope="row">Status</th>
                                                <td>
												<?php
												
												if($users->status ==1){
													echo "Assigned";
												}
												if($users->status ==2){
													echo "Accepted";
												}
												
												if($users->status ==3){
													echo "Pending";
												}
												if($users->status ==4){
													echo "closed";
												}
												?></td>
                                            </tr>
											    <th class="table_bg" scope="row">Advertiser Name</th>
                                                <td>
												<?php
												
												echo ucfirst($users->first_name.' '.$users->last_name);
												
												?></td>
                                            </tr>





                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
			