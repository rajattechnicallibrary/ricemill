
<main class="main-content bgc-grey-100">
                <div id="mainContent">
                    <div class="container"  >
                            <?php echo form_open_multipart('', array('class' => '', 'id' => 'teamForm')); ?>
                        <div class="form-row">
                                           
                                           <div class="form-group col-md-4" style="height:67px">
                                               <label for="inputEmail4">Search Report *</label>
                                              <?php  
                                              $old_date = $this->session->all_userdata("setParchaDate")['setParchaDate']; 
                                              $middle = strtotime($old_date);             // returns bool(false)
                                              
                                              $new_date = date('d-m-Y', $middle);
                                              
                                              $name = @$result->search_name;
                                              $postvalue = @$new_date;
                                              // echo $postvalue; die;
                                              echo form_input(array('id'=>'myInput','name' => 'search_name', 'maxlength'=>'25', 'class' => 'form-control', 'placeholder' => 'Search Report...', 'value' => !empty($postvalue) ? $postvalue : $name )); ?>
                                              <label  class="error"><div class="help-block" style="color:red"> <?php echo form_error('search_name'); ?></div></label>
                                           </div>
                                           <div class="form-group col-md-1" style="margin-top: 27px;}">
                                                   <button type="submit" class="btn btn-primary" id="search"> Search </button>
                                                    
                                           </div> 
                                           </div> 
                                           </form>
                                           <?php if(!empty($kisanVahiData)){?>
                                            <div>
                                             
                            <div class="col-md-12">
                                <div class="bgc-white bd bdrs-3 p-20 mB-20">
                              
                                <table id="dtBasicExample" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
  <thead>
    <tr>
      <th class="th-sm">SNO

      </th>
      <th class="th-sm">Farmer ID

      </th>
      <th class="th-sm">Farmer Name

      </th>
      <th class="th-sm">Center Name

      </th>
      <th class="th-sm">Purchase date

      </th>
      <th class="th-sm">Cust Name

      </th>
      <th class="th-sm">Amount</th>
    </tr>
  </thead>
  <tbody>
  <?php  if (!empty($kisanVahiData)) { $sums = 0; foreach($kisanVahiData as $key=>$val){?>
    <tr>
      <td><?php echo $key+1; ?></td>
      <td><?php echo $val->Farmer_ID; ?></td>
      <td><?php echo $val->Farmer_name; ?></td>
      <td><?php echo $val->CenterName; ?></td>
      <td><?php echo $val->Purchase_Date; ?></td>
      <td><?php echo $val->name; ?></td>
      <td><?php echo $val->Ammount; ?></td>
      
    </tr>
    <?php }
    }?>
  </tbody>
  
</table>
                                </div>
                            </div>
  
                        <?php }else{?>
                        <h1 style="text-align:center">किसान वही पर्चा अभी उपलब्ध नहीं है | </h1>
                        <?php }?>
                    </div>
                </div>
            </main>
            <script type="text/javascript"> 
              $( function() {
   // alert(new Date());
    $( "#myInput" ).datepicker({ 
        
        dateFormat: "dd-mm-yy",
        "setDate": '01-11-2020'     
        });
  } );


  $(document).ready(function() {
    $('#dtBasicExample').DataTable();
} );


   function printData()
{
   var divToPrint=document.getElementById("printTable");
   newWin= window.open("");
   newWin.document.write(divToPrint.outerHTML);
   newWin.print();
  // newWin.close();
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
            
			