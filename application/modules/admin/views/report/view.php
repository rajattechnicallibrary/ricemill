<main class="main-content bgc-grey-100">
                <div id="mainContent">
                    <div class="container-fluid">
                        <h4 class="c-grey-900 mT-10 mB-30">View List</h4>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="bgc-white bd bdrs-3 p-20 mB-20">
                                <a onclick="printData()" id="back-btn" class="btn cur-p btn-primary pull-right" style="color:white">Print</a>

                                    <!--<h4 class="c-grey-900 mB-20">Simple Table</h4>-->
                                    <table class="table" border="1" cellpadding="3" id="printTable">
                                        <thead>
                                            <tr style="text-align: center;">
                                                <th class="table_bg" scope="col">Sno</th>
                                                <th class="table_bg" scope="col">Account ID</th>
                                                <th class="table_bg" scope="col">नाम</th>
                                                <th class="table_bg" scope="col">जमा</th>
                                                <th class="table_bg" scope="col">Status</th>
                                                <!-- <th class="table_bg" scope="col">शेष जमा</th>
                                                <th class="table_bg" scope="col">शेष नाम</th> -->
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach($users as $key => $user){?>
                                            <tr style="text-align: center;">
                                                <td><?php echo $key+1;?></td>
                                                <td><?php echo $user->account_id ;?></td>
                                                <td><?php echo $user->name;?></td>
                                                <td><?php echo $user->karch_amount;?></td>
                                               <td> <?php if($user->verification == 'pending'){

                                                        echo "<button class='btn btn-primary'>Pending</button>";

                                                 } else if ($user->verification == 'done'){

                                                    echo "<button class='btn btn-success'>Done</button>";

                                                 } else if($user->verification == 'undone'){
                                              
                                                    echo "<button class='btn btn-danger'>Undone</button>";

                                                 }; ?>
                                                </td>
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
            
			