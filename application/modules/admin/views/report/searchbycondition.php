<main class="main-content bgc-grey-100">
                <div id="mainContent">
                    <div class="container-fluid">
                        <h4 class="c-grey-900 mT-10 mB-30">View List</h4>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="bgc-white bd bdrs-3 p-20 mB-20">
                                    <?php echo form_open_multipart('', array('class' => '', 'id' => 'ciatyform_id',)); ?>

                                <div class="form-row">
                                           
                                           <div class="form-group col-md-2">
                                               <label for="inputEmail4">Billing Date *</label>
                                               <?php  
                                                        $name = @$result->billing_date;
                                                        $postvalue = @$_SESSION['billing_date'];
                                                        // echo $postvalue; die;
                                                        echo form_input(array('id'=>'datepicker','name' => 'billing_date', 'maxlength'=>'25', 'class' => 'form-control', 'placeholder' => 'Billing Date', 'value' => !empty($postvalue) ? $postvalue : $name )); ?>
                                            </div>
                                           <div class="form-group col-md-2">
                                               <label for="inputEmail4">Billing Date *</label>
                                               <?php  
                                                        $name = @$result->billing_date;
                                                        $postvalue = @$_SESSION['billing_date'];
                                                        // echo $postvalue; die;
                                                        echo form_input(array('id'=>'datepicker','name' => 'billing_date', 'maxlength'=>'25', 'class' => 'form-control', 'placeholder' => 'Billing Date', 'value' => !empty($postvalue) ? $postvalue : $name )); ?>
                                            </div>
                                           <div class="form-group col-md-2">
                                               <label for="inputEmail4">Billing Date *</label>
                                               <?php  
                                                        $name = @$result->billing_date;
                                                        $postvalue = @$_SESSION['billing_date'];
                                                        // echo $postvalue; die;
                                                        echo form_input(array('id'=>'datepicker','name' => 'billing_date', 'maxlength'=>'25', 'class' => 'form-control', 'placeholder' => 'Billing Date', 'value' => !empty($postvalue) ? $postvalue : $name )); ?>
                                            </div>
                                           <div class="form-group col-md-2">
                                               <label for="inputEmail4">Billing Date *</label>
                                               <?php  
                                                        $name = @$result->billing_date;
                                                        $postvalue = @$_SESSION['billing_date'];
                                                        // echo $postvalue; die;
                                                        echo form_input(array('id'=>'datepicker','name' => 'billing_date', 'maxlength'=>'25', 'class' => 'form-control', 'placeholder' => 'Billing Date', 'value' => !empty($postvalue) ? $postvalue : $name )); ?>
                                            </div>
                                           <div class="form-group col-md-2">
                                               <label for="inputEmail4">Billing Date *</label>
                                               <?php  
                                                        $name = @$result->billing_date;
                                                        $postvalue = @$_SESSION['billing_date'];
                                                        // echo $postvalue; die;
                                                        echo form_input(array('id'=>'datepicker','name' => 'billing_date', 'maxlength'=>'25', 'class' => 'form-control', 'placeholder' => 'Billing Date', 'value' => !empty($postvalue) ? $postvalue : $name )); ?>
                                            </div>
                                           <div class="form-group col-md-2 " style="margin-top:30px">
                                           <button type="submit" class="btn btn-primary"> Search </button>
                                        </div>

                                </div>
                                </form>
                                <a onclick="printData()" id="back-btn" class="btn cur-p btn-primary pull-right" style="color:white">Print</a>

                                    <!--<h4 class="c-grey-900 mB-20">Simple Table</h4>-->
                                    <table class="table" border="1" cellpadding="3" id="printTable">
                                        <thead>
                                            <tr style="text-align: center;">
                                                <th class="table_bg" scope="col">Sno</th>
                                                <th class="table_bg" scope="col">Account ID</th>
                                                <th class="table_bg" scope="col">Account Name</th>
                                                <th class="table_bg" scope="col">नाम</th>
                                                <th class="table_bg" scope="col">जमा</th>
                                                <th class="table_bg" scope="col">शेष</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach($users as $key => $user){?>
                                            <tr style="text-align: center;">
                                                <td><?php echo $key+1;?></td>
                                                <td><?php echo $user->account_no;?></td>
                                                <td><?php echo $user->name;?></td>
                                                <td><?php echo round($user->expenses,2) ;?></td>
                                                <td><?php echo round($user->deposit,2);?></td>
                                                <td><?php echo abs($user->finalamt);?></td>
                                               
                                            </tr>
                                       <?php }; ?>
                                            

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
            <script type="text/javascript">     
   function printData()
{
   var divToPrint=document.getElementById("printTable");
   newWin= window.open("");
   newWin.document.write(divToPrint.outerHTML);
   newWin.print();
   newWin.close();
}
   
$(document).ready(function() {
    $('#printTable').DataTable( {
        "processing": true,
        "aLengthMenu": [1000]
    } );
} );

 </script>

 <style id="table_style" type="text/css">
    body
    {
        font-family: Arial;
        font-size: 10pt;
    }
    table
    {
        border: 1px solid #ccc;
        border-collapse: collapse;
    }
    table th
    {
        background-color: #F7F7F7;
        color: #333;
        font-weight: bold;
    }
    table th, table td
    {
        padding: 5px;
        border: 1px solid #ccc;
    }
</style>
            
			