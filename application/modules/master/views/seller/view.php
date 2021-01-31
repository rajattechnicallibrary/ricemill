

<main class="main-content bgc-grey-100">
                <div id="mainContent">
                    <div class="container-fluid">
                        <h4 class="c-grey-900 mT-10 mB-30">View List</h4>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="bgc-white bd bdrs-3 p-20 mB-20">
                                    <!--<h4 class="c-grey-900 mB-20">Simple Table</h4>-->
                                    <a href="<?=base_url()?>master/site/" id="back-btn" class="btn cur-p btn-primary pull-right">Back</a>
                                    <br><br>
                                    <table class="table">
                                    <thead>
                                            <tr>
                                                <td class="table_bg" scope="col">Name</td>
                                                <td scope="col"><?php echo $result->name;?></td>
                                            </tr>
                                            <tr>
                                                <td class="table_bg" scope="col">Contact Person Name</td>
                                                <td scope="col"><?php echo $result->contact_person_name;?></td>
                                            </tr>
                                            <tr>
                                                <td class="table_bg" scope="col">Contact Person Number</td>
                                                <td scope="col"><?php echo $result->contact_person_number;?></td>
                                            </tr>
                                            <tr>
                                                <td class="table_bg" scope="col">Seller Account No</td>
                                                <td scope="col"><?php echo $result->seller_account_no;?></td>
                                            </tr>
                                            <tr>
                                                <td class="table_bg" scope="col">Bank Name</td>
                                                <td scope="col"><?php echo $result->bank_name;?></td>
                                            </tr>
                                            <tr>
                                                <td class="table_bg" scope="col">Ifsc Code</td>
                                                <td scope="col"><?php echo $result->ifsc_code;?></td>
                                            </tr>
                                            <tr>
                                                <td class="table_bg" scope="col">Branch Code</td>
                                                <td scope="col"><?php echo $result->branch_code;?></td>
                                            </tr>
                                            <tr>
                                                <td class="table_bg" scope="col">Pan Card</td>
                                                <td scope="col"><?php echo $result->pan_card;?></td>
                                            </tr>
                                            <tr>
                                                <td class="table_bg" scope="col">Seller Address</td>
                                                <td scope="col"><?php echo $result->seller_address;?></td>
                                            </tr>
                                            <tr>
                                                <td class="table_bg" scope="col">Seller Gst No</td>
                                                <td scope="col"><?php echo $result->seller_gst_no;?></td>
                                            </tr>
                                            <tr>
                                                <td class="table_bg" scope="col">Remark</td>
                                                <td scope="col"><?php echo $result->remark;?></td>
                                            </tr>
                                            <tr>
                                                <td class="table_bg" scope="col">Added Date</td>
                                                <td scope="col"><?php echo $result->added_date;?></td>
                                            </tr>
                                            <tr>
                                                <td class="table_bg" scope="col">Updated Date</td>
                                                <td scope="col"><?php if(strtotime($result->updated_date) == 0){echo 'Not Yet Updated';}else{ echo $result->updated_date; }?></td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <th  class="table_bg" scope="row">Status</th>
                                                <td><?php echo $result->status;?></td>
                                            </tr>
                                          
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
			