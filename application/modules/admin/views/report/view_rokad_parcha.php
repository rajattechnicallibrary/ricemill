<main class="main-content bgc-grey-100">
                <div id="mainContent">
                    <div class="container"  >
                                <a onclick="printData()" id="back-btn" class="btn cur-p btn-primary pull-right" style="color:white">Print</a>
                        <h4 class="c-grey-900 mT-10 mB-30 text-center" style="font-weight:900; text-decoration:underline">रोकड़ पर्चा</h4>
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
                        <div class="container" id="printTable" style="text-align: center; border: 4px solid black;">
                                              <div style="text-align:center;"><img width="50" height="50" src="https://i.pinimg.com/originals/df/7a/c3/df7ac32ca67a39a812bbe7b7b69f1a28.jpg" alt="" srcset=""></div>
                            <div class="col-md-12">
                                <div class="bgc-white bd bdrs-3 p-20 mB-20">

                                    
                                    <div class="container-fluid" style="border: 4px dashed black;">
                                   
  <h1 class="text-center" style="font-weight:500; font-size:20px; text-decoration:underline">दिनांक: <?php $old_date = $this->session->all_userdata("setParchaDate")['setParchaDate']; 
			$middle = strtotime($old_date);             // returns bool(false)
			
            $new_date = date('d-m-Y', $middle);
            echo $new_date;?></h1>
  <div class="col-xs-1 text-center" style="margin:8px; display: flex;">
    <div class="col-sm-9 col-md-6 col-lg-6 text-center;" style="border: 2px solid; border-left: none;border-top: none;border-bottom: none; width: 50%">
      <p class="text-center" style="font-weight:900; ; font-size:20px; text-decoration:underline">जमा</p>
        <!-- <div class="row">
        
    </div> -->
           <?php  $sums = 0; foreach($naam as $key=>$val){?>
    <div class="grid-container">

    <div class="grid-child purple">
                <?php $sums += $val->karch_amount; echo $val->karch_amount;?>
    </div>

    <div class="grid-child green">
                <?php echo $val->account_name;?>
    </div>
  
    </div>
        <?php }?>
<style>
.grid-container {
    display: grid;
    grid-template-columns: 1fr 1fr;
    grid-gap: 20px;
}
</style>
    <div style="text-align:left; margin-left:20px">
   <hr style="border: 1px solid black">
   <span class="margin-left-short"> <?php echo @$sums; ?> </span>
    <hr style="border: 1px solid black">
    </div>
    </div>
    <div class="col-6" style="width:50%">
      <p class="text-center" style="font-weight:900; font-size:20px; text-decoration:underline">नाम</p>
      <?php $sum = 0; foreach($jama as $key=>$val){?>
        <div class="grid-container">

<div class="grid-child purple">
            <?php $sum += $val->karch_amount; echo $val->karch_amount;?>
</div>

<div class="grid-child green">
            <?php echo $val->account_name;?>
</div>

</div>

<style>
.margin-left-short{
    margin-left: 40px;
    font-weight: bolder;
}
</style>

     
        <?php }?>
   <div style="text-align:left; margin-left:20px">
   <hr style="border: 1px solid black">
   <span class="margin-left-short"> <?php echo @$sum; ?> </span>
    <hr style="border: 1px solid black">
    </div>
    </div>
  </div>
</div>  
<div style="text-align:center;color:green;font-size:30px"><?php echo "शेष रोकड़ पर्चा: ".($sums-$sum); ?></div>
                                </div>
                            </div>
                        </div>
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
            
			