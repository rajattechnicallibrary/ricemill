<style>

.bold{
    font-weight: 600;
    font-size: large;
}
</style>
<main class="main-content bgc-grey-100">
                <div id="mainContent">
                    <div class="container-fluid">
                        <h4 class="c-grey-900 mT-10 mB-30">View List</h4>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="bgc-white bd bdrs-3 p-20 mB-20">
                                <a onclick="printData()" id="back-btn" class="btn cur-p btn-primary pull-right" style="color:white">Print</a>

                                    <!--<h4 class="c-grey-900 mB-20">Simple Table</h4>-->
                                    
                                    <table class="table" border="5" cellpadding="3" id="printTable">
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
                                            <tr style="text-align: center; font-size:large ;font-weight:600;">
                                                <td><?php echo $key+1;?></td>
                                                <td><?php echo $user->account_no;?></td>
                                                <td><?php echo $user->name;?></td>
                                                <td><?php echo round($user->expenses,2) ;?></td>
                                                <td><?php echo round($user->deposit,2);?></td>
                                                <td><?php if(round($user->finalamt,2) > 0){ echo '<b style="color:green">जमा | '.round($user->finalamt,2).' ₹ </b> '; } else if(round($user->finalamt,2) == 0){ echo '<b style="color:black">कुछ नहीं | '.round($user->finalamt,2).' ₹ </b> ';}else{ echo '<b style="color:red">नाम | '.abs(round($user->finalamt,2)).' ₹ </b>'; }?></td>
                                               
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
<script src="https://momentjs.com/downloads/moment.js"></script>

            <script type="text/javascript">     
   function printData()
{

   var divToPrint=document.getElementById("printTable");
   newWin= window.open("");
    // $('title').text(moment().format('DD-MM-YYYY')+"_ Latest All Account Status");
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
            
			