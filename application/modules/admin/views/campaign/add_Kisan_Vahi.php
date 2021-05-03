<link rel="stylesheet" href="<?php echo base_url();?>assets/css/multiple-select.css" />
<style>
* {
  box-sizing: border-box;
}

body {
  font: 16px Arial;  
}

/*the container must be positioned relative:*/
.autocomplete {
  position: relative;
  display: inline-block;
}

input {
  border: 1px solid transparent;
  background-color: #f1f1f1;
  padding: 10px;
  font-size: 16px;
}

input[type=text] {
  background-color: #f1f1f1;
  width: 100%;
}

input[type=submit] {
  background-color: DodgerBlue;
  color: #fff;
  cursor: pointer;
}

.autocomplete-items {
  position: absolute;
  border: 1px solid #d4d4d4;
  border-bottom: none;
  border-top: none;
  z-index: 99;
  /*position the autocomplete items to be the same width as the container:*/
  top: 100%;
  left: 0;
  right: 0;
  overflow-x: scroll;
    overflow-y: scroll;
    height: 200px;
    background:white
}

.autocomplete-items div {
  padding: 10px;
  cursor: pointer;
  background-color: #fff; 
  border-bottom: 1px solid #d4d4d4; 
}

/*when hovering an item:*/
.autocomplete-items div:hover {
  background-color: #e9e9e9; 
}

/*when navigating through the items using the arrow keys:*/
.autocomplete-active {
  background-color: DodgerBlue !important; 
  color: #ffffff; 
}
</style>
<main id="myclsid" class="main-content bgc-grey-100">
                <div id="mainContent">
                    <div class="container-fluid">
                        <!--<h4 class="c-grey-900 mT-10 mB-30"> List </h4>-->
                        
                        <div class="row">
                            <div class="masonry-item col-md-12">
                            
                                <div class="bgc-white p-20 bd">
                                <?= get_flashdata() ?>	
                                    <h6 class="c-grey-900">Add Form</h6>
                                    <div class="form-row">
                                    <div class="form-group col-md-2">
                                              <select id="center_type" class="form-control" name="rokad_type">
                                                      <option value="" selected >Select Center</option>
                                                      <option value="1" >शाहाबाद मंडी प्रथम</option>
                                                       <option value="2" >शाहाबाद मंडी द्विती</option>
                                                       <option value="3" >FCS जमुरा-टोडरपुर</option>
                                                       <option value="pcf" >PCF शाहाबाद - शाहाबाद नगर पा. प.</option>
                                                       <option value="reva" >रेवमुरादपुर</option>
                                                       <option value="upss" >यूपीएसएस ( UPSS )</option>
                                                       <option value="todarpur_hardoi" >हरदोई टोडरपुर</option>
                                                </select>                                         
                                           <label  class="error"><div class="help-block" style="color:red"> <?php echo form_error('rokad_type'); ?></div></label>
                                           </div> 
                                    <div class="form-group col-md-2">
                                               <?php  
                                               $name = @$result->name;
                                               $postvalue = @$_POST['farmer_id'];
                                               echo form_input(array('autocomplete'=>'off','name' => 'farmer_id','maxlength'=>'100', 'class' => 'form-control',  'placeholder' => 'Farmer ID', 'value' => !empty($postvalue) ? $postvalue : $name ));
                                            ?>
                                              <label  class="error"><div class="help-block" style="color:red"> <?php echo form_error('farmer_id'); ?></div></label>
                                                  
                                                                                         
                                           </div>
                                           <div class="form-group col-md-2">
                                               <?php  
                                               $name = @$result->name;
                                               $postvalue = @$_POST['purchase_id'];
                                               echo form_input(array('autocomplete'=>'off','name' => 'purchase_id','maxlength'=>'100', 'class' => 'form-control',  'placeholder' => 'Purchase ID', 'value' => !empty($postvalue) ? $postvalue : $name ));
                                            ?>
                                              <label  class="error"><div class="help-block" style="color:red"> <?php echo form_error('purchase_id'); ?></div></label>
                                                  
                                                                                         
                                           </div>
                                           <div class="form-group col-md-2">
                                           <button type="button" id="fetch_button" class="btn btn-primary"> Fetch </button>                                         
                                           </div>
                                    </div>
                                    <div class="mT-30">
                                      <?php echo form_open_multipart('', array('class' => '', 'id' => 'teamForm')); ?>


											<div class="form-row">
                        
                                            <div class="form-group col-md-2">
                                               <label for="inputState2">Center Type *</label>
                                               <select id="center_type" class="form-control nill" name="center_type">
                                                      <option value="" selected >Select Center</option>
                                                      <option value="1" >शाहाबाद मंडी प्रथम</option>
                                                       <option value="2" >शाहाबाद मंडी द्विती</option>
                                                       <option value="3" >FCS जमुरा-टोडरपुर</option>
                                                       <option value="pcf" >PCF शाहाबाद - शाहाबाद नगर पा. प.</option>
                                                       <option value="reva" >रेवमुरादपुर</option>
                                                       <option value="upss" >यूपीएसएस ( UPSS )</option>
                                                       <option value="todarpur_hardoi" >हरदोई टोडरपुर</option>
                                                  </select>                                         
                                           <label  class="error"><div class="help-block" style="color:red"> <?php echo form_error('center_type'); ?></div></label>
                                           </div> 

                                            <div class="form-group col-md-2">
                                               <label for="inputState2">Purchase ID *</label>
                                               <?php  
                                               $name = @$result->name;
                                               $postvalue = @$_POST['purchase_id'];
                                               echo form_input(array('autofocus'=>'autofocus','autocomplete'=>'off','name' => 'purchase_id','maxlength'=>'100', 'class' => 'form-control',  'placeholder' => 'Purchase ID', 'value' => !empty($postvalue) ? $postvalue : $name ));
                                            ?>
                                              <label  class="error"><div class="help-block" style="color:red"> <?php echo form_error('purchase_id'); ?></div></label>
                                                  
                                                                                         
                                           </div> 
                                           <div class="form-group col-md-2">
                                               <label for="inputState2">Farmer ID *</label>
                                               <?php  
                                               $name = @$result->name;
                                               $postvalue = @$_POST['farmer_id'];
                                               echo form_input(array('autofocus'=>'autofocus','autocomplete'=>'off','name' => 'farmer_id','maxlength'=>'100', 'class' => 'form-control',  'placeholder' => 'Farmer ID', 'value' => !empty($postvalue) ? $postvalue : $name ));
                                            ?>
                                              <label  class="error"><div class="help-block" style="color:red"> <?php echo form_error('farmer_id'); ?></div></label>
                                                  
                                                                                         
                                           </div> 
                                           <div class="form-group col-md-6">
                                                    <label for="inputEmail4">Farmer Name*</label>
                                                    <input type="text" name="farmer_name" value="<?php echo set_value('farmer_name') ?>" class="form-control"  placeholder="Farmer Name">
                                                    <label  class="error"><div class="help-block" style="color:red"> <?php echo form_error('farmer_name'); ?></div></label>

                                                </div>
                                            </div>
											<div class="form-row">
                                                
                                            <div class="form-group col-md-2">
                                                    <label for="inputEmail4">Quantity*</label>
                                                    <input type="text" name="quantity"  value="<?php echo set_value('quantity') ?>" class="form-control"  placeholder="Quantity">
                                                    <label  class="error"><div class="help-block" style="color:red"> <?php echo form_error('quantity'); ?></div></label>

                                                </div>
                                                <div class="form-group col-md-2">
                                                    <label for="inputEmail4">Amount*</label>
                                                    <input type="text" name="amount"  value="<?php echo set_value('amount') ?>" class="form-control"  placeholder="Amount">
                                                    <label  class="error"><div class="help-block" style="color:red"> <?php echo form_error('amount'); ?></div></label>

                                                </div>
                                                <div class="form-group col-md-2">
                                                    <label for="inputEmail4">Purchase Date*</label>
                                                    <input type="text" name="purchase_date"  value="<?php echo set_value('purchase_date') ?>" class="form-control"  placeholder="Purchase Date">
                                                    <label  class="error"><div class="help-block" style="color:red"> <?php echo form_error('purchase_date'); ?></div></label>

                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="inputEmail4">PFMS Status*</label>
                                                    <input type="text" name="pfms_status"  value="<?php echo set_value('pfms_status') ?>" class="form-control" placeholder="PFMS Status">
                                                    <label  class="error"><div class="help-block" style="color:red"> <?php echo form_error('pfms_status'); ?></div></label>

                                                </div>
                                            </div>
                                            <div class="form-row">
                                                
                                            <div class="form-group col-md-2">
                                                    <label for="inputEmail4">Bank Account No*</label>
                                                    <input type="text" name="bank_account_no"  value="<?php echo set_value('bank_account_no') ?>" class="form-control"  placeholder="Account No">
                                                    <label  class="error"><div class="help-block" style="color:red"> <?php echo form_error('bank_account_no'); ?></div></label>

                                                </div>
                                                <div class="form-group col-md-2">
                                                    <label for="inputEmail4">Ack Status*</label>
                                                    <input type="text" name="ack_status"  value="<?php echo set_value('ack_status') ?>" class="form-control"  placeholder="Ack Status">
                                                    <label  class="error"><div class="help-block" style="color:red"> <?php echo form_error('ack_status'); ?></div></label>

                                                </div>
                                                <div class="form-group col-md-2">
                                                    <label for="inputEmail4">Payment Status*</label>
                                                    <input type="text" name="payment_status"  value="<?php echo set_value('payment_status') ?>" class="form-control" placeholder="Payment Status">
                                                    <label  class="error"><div class="help-block" style="color:red"> <?php echo form_error('payment_status'); ?></div></label>

                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="inputEmail4">Payment Date*</label>
                                                    <input class="datepicker1" type="text" name="payment_date"  value="<?php echo set_value('payment_date') ?>" class="form-control"  placeholder="Payment Date">
                                                    <label  class="error"><div class="help-block" style="color:red"> <?php echo form_error('payment_date'); ?></div></label>

                                                </div>
                                            </div>
											<div class="form-row">
                                                <div class="form-group col-md-3">
                                                    <label for="inputEmail4">UTR No *</label>
                                                    <input type="text"  name="utr_no" value="<?php echo set_value('utr_no') ?>" class="form-control"  placeholder="UTR No">
                                                    <label  class="error"><div class="help-block" style="color:red"> <?php echo form_error('utr_no'); ?></div></label>

                                                </div>
                                                <div class="form-group col-md-3">
                                                    <label for="inputEmail4">Mobile No *</label>
                                                    <input type="text"  name="mobile_no" value="<?php echo set_value('mobile_no') ?>" class="form-control"  placeholder="Mobile No">
                                                    <label  class="error"><div class="help-block" style="color:red"> <?php echo form_error('mobile_no'); ?></div></label>

                                                </div>
                                                <div class="form-group col-md-6">
                                               <label for="inputState2">Account Name *</label>
                                               <?php  
                                               $name = @$result->name;
                                               $postvalue = @$_POST['account_name'];
//                                                    $val = !empty($postvalue)? $postvalue:$name;
                                               echo form_input(array('autocomplete'=>'off','name' => 'account_name','maxlength'=>'100','id'=>'mymappingInp', 'class' => 'form-control',  'placeholder' => 'Account Name', 'value' => !empty($postvalue) ? $postvalue : $name ));
                                            ?>
                                              <label  class="error"><div class="help-block" style="color:red"> <?php echo form_error('account_name'); ?></div></label>
                                                                                         
                                           </div> 
										
										
                                           <input type="hidden"  name="checknow" value="" class="form-control"  placeholder="checknow">

											
                                           <div class="peer" style="text-align:center"> 
                                                   <button type="submit" class="btn btn-primary"> Submit </button>
                                                   <a href="<?php echo base_url('admin/campaign');?>"><button type="button" class="btn btn-primary"> Cancel </button></a>

                                                   </div>
                                        </form>
                                    </div>
                                </div>
                                                   <!-- <button type="button" class="btn btn-primary" id='myFunction'> Sync Now </button> -->
                               <div style="text-align:center;height:100px; width:auto">
                                      <!-- <iframe id="framemyval" style="height:1000%; width:100%" src="https://eproc.up.gov.in/wheat2122/Uparjan/FarmerReg.aspx?id=Mw==&id1=NQ==" frameborder="0"></iframe> -->
                               
                               </div>  
                            </div>
                        </div>
                    </div>
                </div>
            </main>
            <script>
                      $('input[name=pfms_status]').val('PENDING')
                      $('input[name=bank_account_no]').val('PENDING')
                      $('input[name=ack_status]').val('PENDING')
                      $('input[name=payment_status]').val('PENDING')
                      $('input[name=payment_date]').val('PENDING')
                      $('input[name=utr_no]').val('PENDING')
                      

           $('#fetch_button').click(()=>{
            var farmer_id = $('input[name=farmer_id]').val()
            var purchase_id = $('input[name=purchase_id]').val()
            $.ajax({
                  url: "<?php echo base_url(); ?>admin/accountMapping/getall_farmer_id",
                  type: "POST",
                  dataType: 'json',
                  data:{'farmer_id':farmer_id, 'purchase_id':purchase_id},
                  success: function (a) {
                      arr = a
                      console.log("--------",a)
                      if(a != 0){

                        $('.nill').val(a.CenterName)
                      $('input[name=purchase_id]').val(a.Purchase_ID)
                      $('input[name=farmer_id]').val(a.Farmer_ID)
                      $('input[name=farmer_name]').val(a.Farmer_name)
                      $('input[name=quantity]').val(a.Quantity)
                      $('input[name=amount]').val(a.Ammount)
                      $('input[name=purchase_date]').val(a.Purchase_Date)
                      $('input[name=pfms_status]').val(a.PFMS_Status)
                      $('input[name=bank_account_no]').val(a.Latest_Account_no)
                      $('input[name=ack_status]').val(a.Ack_Status)
                      $('input[name=payment_status]').val(a.Payment_Status)
                      $('input[name=payment_date]').val(a.Payment_Date)
                      $('input[name=utr_no]').val(a.UTR_No)
                      $('input[name=account_name]').val(a.name + "_"+a.account_no)
                      $('input[name=checknow]').val(a.Kisan_ID)
                      $('input[name=mobile_no]').val(a.mobile_no)
                      }else{
                        $('.nill').val('')
                      $('input[name=purchase_id]').val('')
                      $('input[name=farmer_id]').val('')
                      $('input[name=farmer_name]').val('')
                      $('input[name=quantity]').val('')
                      $('input[name=amount]').val('')
                      $('input[name=purchase_date]').val('')
                      $('input[name=pfms_status]').val('')
                      $('input[name=bank_account_no]').val('')
                      $('input[name=ack_status]').val('')
                      $('input[name=payment_status]').val('')
                      $('input[name=payment_date]').val('')
                      $('input[name=utr_no]').val('')
                      $('input[name=account_name]').val('')
                      $('input[name=checknow]').val('')
                      $('input[name=mobile_no]').val('')
                      }
                      
                  },
                  error: function () {
                      alert("Error");
                  }
              });
                })
// $(document).ready(function(){
   
   $('#myFunction').click(()=>{

  //  var abc =  window.frames['framemyval'].contentWindow.document.getElementById('ctl00_ContentPlaceHolder1_txtMob')
  //   console.log(abc)
   var abc =  window.frames['framemyval']
  abc =  document.getElementById("framemyval").contentWindow.document.getElementById('ctl00_ContentPlaceHolder1_txtMob');
    console.log(abc)

    })

            </script>

            <script src="<?php echo base_url();?>assets/js/multiple-select.js"></script>

            <script>

function autocomplete(inp, arr) {
   
   var arr;
  /*the autocomplete function takes two arguments,
  the text field element and an array of possible autocompleted values:*/
  var currentFocus;
  /*execute a function when someone writes in the text field:*/
  inp.addEventListener("input", function(e) {
    $.ajax({
        url: "<?php echo base_url(); ?>admin/billing/account_mapping_name",
        type: "POST",
        dataType: 'json',
        data:{'center_type':$('#center_type').val()},
        success: function (a) {
            arr = a
            console.log(a)
        },
        error: function () {
            alert("Error");
        }
        });
     
      var a, b, i, val = this.value;
      /*close any already open lists of autocompleted values*/
      closeAllLists();
      if (!val) { return false;}
      currentFocus = -1;
      /*create a DIV element that will contain the items (values):*/
      a = document.createElement("DIV");
      a.setAttribute("id", this.id + "autocomplete-list");
      a.setAttribute("class", "autocomplete-items");
      /*append the DIV element as a child of the autocomplete container:*/
      this.parentNode.appendChild(a);
      /*for each item in the array...*/
      for (i = 0; i < arr.length; i++) {
        /*check if the item starts with the same letters as the text field value:*/
        if (arr[i].Farmer_ID.substr(0, val.length).toUpperCase() == val.toUpperCase()) {
          /*create a DIV element for each matching element:*/
          b = document.createElement("DIV");
          /*make the matching letters bold:*/
          b.innerHTML = "<strong>" + arr[i].Farmer_ID.substr(0, val.length) + "</strong>";
          b.innerHTML += arr[i].Farmer_ID.substr(val.length);
          /*insert a input field that will hold the current array item's value:*/
          b.innerHTML += "<input type='hidden' value='" + arr[i].Farmer_ID  + "'>";
         // console.log($('#').val(arr[i].farmer_name))
         
          /*execute a function when someone clicks on the item value (DIV element):*/
          b.addEventListener("click", function(e) {
          //  console.log(window);
              /*insert the value for the autocomplete text field:*/
              inp.value = this.getElementsByTagName("input")[0].value;
              /*close the list of autocompleted values,
              (or any other open lists of autocompleted values:*/
              closeAllLists();
          });
         
          a.appendChild(b);
        }
      }
  });
  /*execute a function presses a key on the keyboard:*/
  inp.addEventListener("keydown", function(e) {
      var x = document.getElementById(this.id + "autocomplete-list");
      if (x) x = x.getElementsByTagName("div");
      if (e.keyCode == 40) {
        /*If the arrow DOWN key is pressed,
        increase the currentFocus variable:*/
        currentFocus++;
        /*and and make the current item more visible:*/
        addActive(x);
      } else if (e.keyCode == 38) { //up
        /*If the arrow UP key is pressed,
        decrease the currentFocus variable:*/
        currentFocus--;
        /*and and make the current item more visible:*/
        addActive(x);
      } else if (e.keyCode == 13) {
        /*If the ENTER key is pressed, prevent the form from being submitted,*/
        e.preventDefault();
        if (currentFocus > -1) {
          /*and simulate a click on the "active" item:*/
          if (x) x[currentFocus].click();
        }
      }
  });
  function addActive(x) {
    /*a function to classify an item as "active":*/
    if (!x) return false;
    /*start by removing the "active" class on all items:*/
    removeActive(x);
    if (currentFocus >= x.length) currentFocus = 0;
    if (currentFocus < 0) currentFocus = (x.length - 1);
    /*add class "autocomplete-active":*/
    x[currentFocus].classList.add("autocomplete-active");
  }
  function removeActive(x) {
    /*a function to remove the "active" class from all autocomplete items:*/
    for (var i = 0; i < x.length; i++) {
      x[i].classList.remove("autocomplete-active");
    }
  }
  function closeAllLists(elmnt) {
    /*close all autocomplete lists in the document,
    except the one passed as an argument:*/
    var x = document.getElementsByClassName("autocomplete-items");
    for (var i = 0; i < x.length; i++) {
      if (elmnt != x[i] && elmnt != inp) {
        x[i].parentNode.removeChild(x[i]);
      }
    }
  }
  /*execute a function when someone clicks in the document:*/
  document.addEventListener("keydown", function (e) {
      closeAllLists(e.target);
  });
}



function MappingIDautocomplete(inp, arr) {
   
   var arr;
  /*the autocomplete function takes two arguments,
  the text field element and an array of possible autocompleted values:*/
  var currentFocus;
  /*execute a function when someone writes in the text field:*/
  inp.addEventListener("input", function(e) {
    $.ajax({
        url: "<?php echo base_url(); ?>admin/billing/account_name",
        type: "POST",
        dataType: 'json',
        success: function (a) {
            arr = a
        },
        error: function () {
            alert("Error");
        }
        });
        console.log(arr)
      var a, b, i, val = this.value;
      /*close any already open lists of autocompleted values*/
      closeAllLists();
      if (!val) { return false;}
      currentFocus = -1;
      /*create a DIV element that will contain the items (values):*/
      a = document.createElement("DIV");
      a.setAttribute("id", this.id + "autocomplete-list");
      a.setAttribute("class", "autocomplete-items");
      /*append the DIV element as a child of the autocomplete container:*/
      this.parentNode.appendChild(a);
      /*for each item in the array...*/
      for (i = 0; i < arr.length; i++) {
        /*check if the item starts with the same letters as the text field value:*/
        if (arr[i].name.substr(0, val.length).toUpperCase() == val.toUpperCase()) {
          /*create a DIV element for each matching element:*/
          b = document.createElement("DIV");
          /*make the matching letters bold:*/
          b.innerHTML = "<strong>" + arr[i].name.substr(0, val.length) + "</strong>";
          b.innerHTML += arr[i].name.substr(val.length);
          /*insert a input field that will hold the current array item's value:*/
          b.innerHTML += "<input type='hidden' value='" + arr[i].name + '_' +arr[i].account_id +"'>";
          /*execute a function when someone clicks on the item value (DIV element):*/
          b.addEventListener("click", function(e) {
          //  alert("----")
              /*insert the value for the autocomplete text field:*/
              inp.value = this.getElementsByTagName("input")[0].value;
              /*close the list of autocompleted values,
              (or any other open lists of autocompleted values:*/
              closeAllLists();
          });
          a.appendChild(b);
        }
      }
  });
  /*execute a function presses a key on the keyboard:*/
  inp.addEventListener("keydown", function(e) {
      var x = document.getElementById(this.id + "autocomplete-list");
      if (x) x = x.getElementsByTagName("div");
      if (e.keyCode == 40) {
        /*If the arrow DOWN key is pressed,
        increase the currentFocus variable:*/
        currentFocus++;
        /*and and make the current item more visible:*/
        addActive(x);
      } else if (e.keyCode == 38) { //up
        /*If the arrow UP key is pressed,
        decrease the currentFocus variable:*/
        currentFocus--;
        /*and and make the current item more visible:*/
        addActive(x);
      } else if (e.keyCode == 13) {
        /*If the ENTER key is pressed, prevent the form from being submitted,*/
        e.preventDefault();
        if (currentFocus > -1) {
          /*and simulate a click on the "active" item:*/
          if (x) x[currentFocus].click();
        }
      }
  });
  function addActive(x) {
    /*a function to classify an item as "active":*/
    if (!x) return false;
    /*start by removing the "active" class on all items:*/
    removeActive(x);
    if (currentFocus >= x.length) currentFocus = 0;
    if (currentFocus < 0) currentFocus = (x.length - 1);
    /*add class "autocomplete-active":*/
    x[currentFocus].classList.add("autocomplete-active");
  }
  function removeActive(x) {
    /*a function to remove the "active" class from all autocomplete items:*/
    for (var i = 0; i < x.length; i++) {
      x[i].classList.remove("autocomplete-active");
    }
  }
  function closeAllLists(elmnt) {
    /*close all autocomplete lists in the document,
    except the one passed as an argument:*/
    var x = document.getElementsByClassName("autocomplete-items");
    for (var i = 0; i < x.length; i++) {
      if (elmnt != x[i] && elmnt != inp) {
        x[i].parentNode.removeChild(x[i]);
      }
    }
  }
  /*execute a function when someone clicks in the document:*/
  document.addEventListener("keydown", function (e) {
      closeAllLists(e.target);
  });
}




/*An array containing all the country names in the world:*/
//var countries = ["Afghanistan","Albania","Algeria","Andorra","Angola","Anguilla","Antigua & Barbuda","Argentina","Armenia","Aruba","Australia","Austria","Azerbaijan","Bahamas","Bahrain","Bangladesh","Barbados","Belarus","Belgium","Belize","Benin","Bermuda","Bhutan","Bolivia","Bosnia & Herzegovina","Botswana","Brazil","British Virgin Islands","Brunei","Bulgaria","Burkina Faso","Burundi","Cambodia","Cameroon","Canada","Cape Verde","Cayman Islands","Central Arfrican Republic","Chad","Chile","China","Colombia","Congo","Cook Islands","Costa Rica","Cote D Ivoire","Croatia","Cuba","Curacao","Cyprus","Czech Republic","Denmark","Djibouti","Dominica","Dominican Republic","Ecuador","Egypt","El Salvador","Equatorial Guinea","Eritrea","Estonia","Ethiopia","Falkland Islands","Faroe Islands","Fiji","Finland","France","French Polynesia","French West Indies","Gabon","Gambia","Georgia","Germany","Ghana","Gibraltar","Greece","Greenland","Grenada","Guam","Guatemala","Guernsey","Guinea","Guinea Bissau","Guyana","Haiti","Honduras","Hong Kong","Hungary","Iceland","India","Indonesia","Iran","Iraq","Ireland","Isle of Man","Israel","Italy","Jamaica","Japan","Jersey","Jordan","Kazakhstan","Kenya","Kiribati","Kosovo","Kuwait","Kyrgyzstan","Laos","Latvia","Lebanon","Lesotho","Liberia","Libya","Liechtenstein","Lithuania","Luxembourg","Macau","Macedonia","Madagascar","Malawi","Malaysia","Maldives","Mali","Malta","Marshall Islands","Mauritania","Mauritius","Mexico","Micronesia","Moldova","Monaco","Mongolia","Montenegro","Montserrat","Morocco","Mozambique","Myanmar","Namibia","Nauro","Nepal","Netherlands","Netherlands Antilles","New Caledonia","New Zealand","Nicaragua","Niger","Nigeria","North Korea","Norway","Oman","Pakistan","Palau","Palestine","Panama","Papua New Guinea","Paraguay","Peru","Philippines","Poland","Portugal","Puerto Rico","Qatar","Reunion","Romania","Russia","Rwanda","Saint Pierre & Miquelon","Samoa","San Marino","Sao Tome and Principe","Saudi Arabia","Senegal","Serbia","Seychelles","Sierra Leone","Singapore","Slovakia","Slovenia","Solomon Islands","Somalia","South Africa","South Korea","South Sudan","Spain","Sri Lanka","St Kitts & Nevis","St Lucia","St Vincent","Sudan","Suriname","Swaziland","Sweden","Switzerland","Syria","Taiwan","Tajikistan","Tanzania","Thailand","Timor L'Este","Togo","Tonga","Trinidad & Tobago","Tunisia","Turkey","Turkmenistan","Turks & Caicos","Tuvalu","Uganda","Ukraine","United Arab Emirates","United Kingdom","United States of America","Uruguay","Uzbekistan","Vanuatu","Vatican City","Venezuela","Vietnam","Virgin Islands (US)","Yemen","Zambia","Zimbabwe"];

/*initiate the autocomplete function on the "myInput" element, and pass along the countries array as possible autocomplete values:*/
//autocomplete(document.getElementById("myInput"));
MappingIDautocomplete(document.getElementById("mymappingInp"));


    $( function() {
   // alert(new Date());
    $( "#datepicker .datepicker1" ).datepicker({ 
        
        dateFormat: "dd-mm-yy",
        "setDate": '01-11-2020'     
        });
  } );

function getkisanData(){
 // console.log($('#center_type').val());
if($('#center_type').val() == ''){
  alert('Select Center');
  return;
}
  $.ajax({
        url: "<?php echo base_url(); ?>admin/billing/getall_farmer_id",
        type: "POST",
        dataType: 'json',
        data:{'farmer_id':$('#myInput').val(), 'center_type':$('#center_type').val()},
        success: function (a) {
         console.log(a);
          if(a == null){
            alert('This Farmer ID is Already Mapped with another account')
            $('#farmer_name').val('');
            $('#CenterName').val('');
            $('#quantity').val('');
            $('#amount').val('');
            return;
          }
          // return
           
            $('#farmer_name').val(a.Farmer_name)

          if(a.CenterName == '1'){
            $('#CenterName').val('Center_1')
          }else if (a.CenterName == '2'){
            $('#CenterName').val('Center_2')
          } else if (a.CenterName == '3'){
            $('#CenterName').val('Center_3')
          } else if (a.CenterName == 'pcf') {
            $('#CenterName').val('PCF')
          }else if (a.CenterName == 'reva'){
            $('#CenterName').val('Reva')
          }else if (a.CenterName == 'upss'){
            $('#CenterName').val('UPSS')
          }else{
            $('#CenterName').val('No_Detail')
          }
            $('#quantity').val(a.Quantity)
            $('#amount').val(a.Ammount)

        },
        error: function () {
           // alert("Error");
        }
        });

}
  

//var result = $.getScript("https://eproc.up.gov.in/wheat2122/Uparjan/FarmerReg.aspx?id=NA==");


</script>

