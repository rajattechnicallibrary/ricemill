<main class="main-content bgc-grey-100">
                <div id="mainContent">
                    <div class="container-fluid">
                        <h4 class="c-grey-900 mT-10 mB-30">View List</h4>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="bgc-white bd bdrs-3 p-20 mB-20">
                               <div> <a target="_blank" href="<?php echo base_url().'uploads/invoice_slips/'.$users->invoice_name;?>" id="back-btn" class="btn cur-p btn-primary pull-right"><i class="fa fa-download"></i></a></div>
                                <a href="<?=base_url()?>admin/campaign" id="back-btn" class="btn cur-p btn-primary pull-right">Back</a>

                                    <!--<h4 class="c-grey-900 mB-20">Simple Table</h4>-->
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th class="table_bg" scope="col">Billing Date</th>
                                                <th scope="col"><?php echo ucfirst($users->billing_date);?></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <th  class="table_bg" scope="row">Truck No.</th>
                                                <td><?php echo $users->truck_no;?></td>
                                            </tr>
                                            <tr>
                                                <th class="table_bg" scope="row">Challan No</th>
                                                <td><?php echo $users->challan_no;?></td>
                                            </tr>
                                            <tr>
                                                <th class="table_bg" scope="row">Bill No</th>
                                                <td><?php echo $users->bill_no;?></td>
                                            </tr>

                                            <tr>
                                                <th class="table_bg" scope="row">Quality</th>
                                                <td><a href="<?php echo base_url('master/quality/view/').Id_encode($users->quality);?>"><?php echo $users->quality_name;?></a></td>
                                            </tr>

                                            <tr>
                                                <th class="table_bg" scope="row">Product Quantity </th>
                                                <td><?php echo ($users->quantity);?></td>
                                            </tr>
                                            <tr>
                                                <th class="table_bg" scope="row">Purchaser Name</th>
                                                <!-- <td><?php echo $users->purchaser_name;?></td> -->
                                                <td><a href="<?php echo base_url('master/purchaser/view/').Id_encode($users->purchaser_id);?>"><?php echo $users->purchaser_name;?></a></td>
                                            </tr>
                                            <tr>
                                                <th class="table_bg" scope="row">Purchaser Rate</th>
                                                <td><?php echo $users->purchaser_rate;?></td>
                                            </tr>
											<tr>
                                                <th class="table_bg" scope="row">Purchaser Amount</th>
                                                <td><?php echo $users->purchaser_amount;?></td>
                                            </tr>
											<tr>
                                                <th class="table_bg" scope="row">Site Name</th>
                                                <td><a href="<?php echo base_url('master/site/view/').Id_encode($users->site_id);?>"><?php echo $users->name;?></a></td>
                                            </tr>
											<tr>
                                                <th class="table_bg" scope="row">Seller Name</th>
                                                <td><a href="<?php echo base_url('master/site/view/').Id_encode($users->seller_id);?>"><?php echo $users->seller_name;?></a></td>
                                            </tr>
											<tr>
                                                <th class="table_bg" scope="row">Seller Rate </th>
                                                <td><?php echo $users->seller_rate;?></td>
                                            </tr>
											<tr>
                                                <th class="table_bg" scope="row">Seller Amount</th>
                                                <td><?php echo $users->seller_amount;?></td>
                                            </tr>
											<tr>
                                                <th class="table_bg" scope="row">Purchaser Amount</th>
                                                <td><?php echo $users->purchaser_amount;?></td>
                                            </tr>
                                            <tr>
											    <th class="table_bg" scope="row">Gross Profit (GP)</th>
                                                <td><?php echo $users->profit;?></td>
                                            </tr>
                                            <tr>
											    <th class="table_bg" scope="row">CGST </th>
                                                <td><?php echo $users->cgst;?></td>
                                            </tr>
                                            <tr>
											    <th class="table_bg" scope="row">SGST</th>
                                                <td><?php echo $users->sgst;?></td>
                                            </tr>
                                            <tr>
											    <th class="table_bg" scope="row">Amount After GST</th>
                                                <td><?php echo $users->gst_amount;?></td>
                                            </tr>
                                            <tr>
											    <th class="table_bg" scope="row">Status</th>
                                                <td><?php echo $users->status;?></td>
                                            </tr>





                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
			