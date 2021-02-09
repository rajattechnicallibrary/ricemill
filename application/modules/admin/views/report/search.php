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

.blackCSS{
  color: black;
    font-size: x-large;
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

<main class="main-content bgc-grey-100">

                <div id="mainContent">
                    <div class="container-fluid" >
                        <h4 class="c-grey-900 mT-10 mB-30">Search Report</h4>
                        <div class="row">
                        <div class="col-md-12">
                                <div class="bgc-white bd bdrs-3 p-20 mB-20">
                                <div class="mT-30">
                                <div class="form-row">
                                           
                                           <div class="form-group col-md-4" style="height:67px">
                                               <label for="inputEmail4">Search Name *</label>
                                              <?php  
                                                   $name = @$result->search_name;
                                                   $postvalue = @$_SESSION['search_name'];
                                                   // echo $postvalue; die;
                                                   echo form_input(array('autocomplete'=>'off','id'=>'myInput','name' => 'search_name', 'maxlength'=>'25', 'class' => 'form-control', 'placeholder' => 'Account Name', 'value' => !empty($postvalue) ? $postvalue : $name )); ?>
                                              <label  class="error"><div class="help-block" style="color:red"> <?php echo form_error('search_name'); ?></div></label>
                                           </div>
                                           <div class="form-group col-md-1" style="margin-top: 23px;}">
                                                   <button type="submit" class="btn btn-primary" id="search"> Find </button>
                                                    
                                           </div> 
                                           <style>
                                           .selectSetting{
                                             width:inherit;
                                           }
                                           .optionval{
                                            font-size: 18px;
                                            font-weight: 700;
                                            padding: 5px;
                                            margin-left: 10px;
                                           }
                                           </style>
                                           <div class="form-group col-md-7">
                                           <!-- <div class="overflow-auto" style="height:100px; overflow-x:auto"> -->
                                              <select name="" id="mySelect" multiple class="selectSetting" onchange="changeFunc();">
                                              </select>
                                           <!-- </div> -->
  
                                           </div> 
                                       </div>
                                       </div>
                                </div>
                                </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="bgc-white bd bdrs-3 p-20 mB-20">
                               <!-- <div> <a target="_blank" href="<?php echo base_url().'uploads/invoice_slips/'.$users->invoice_name;?>" id="back-btn" class="btn cur-p btn-primary pull-right"><i class="fa fa-download"></i></a></div> -->

                                    <!--<h4 class="c-grey-900 mB-20">Simple Table</h4>-->
                                    <table class="table">
                                        <tbody>
                                            <tr>
                                                <th  class="table_bg" scope="row">नाम</th>
                                                <td id="expense" class="blackCSS"></td>
                                            </tr>
                                            <tr>
                                                <th class="table_bg" scope="row">जमा</th>
                                                <td id="deposit" class="blackCSS"></td>

                                            </tr>
                                            <tr>
                                                <th class="table_bg" scope="row">शेष जमा</th>
                                                <td id="MyfinalDeposit" class="blackCSS"></td>

                                            </tr>
                                            <tr>
                                                <th class="table_bg" scope="row">शेष नाम</th>
                                                <td id="MyFinalExpenses" class="blackCSS"></td>

                                            </tr>
                                            <tr onClick="myFunction()"  data-toggle="modal" data-target="#myModal">
                                                <th class="table_bg" scope="row" >किसान संख्या</th>
                                                <td id="mykisanvahicount" class="blackCSS" style="margin-left:10px"></td>

                                            </tr>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
<style>
.modal-lg {
    max-width: 90% !important;
}
</style>

              <!-- Modal -->
              <div class="modal fade" id="myModal" role="dialog">
              <div class="modal-dialog modal-lg">

                <!-- Modal content-->
                <div class="modal-content">
                  
                  <div class="modal-body">
                  <div class="container">
                      <h2>Information About Kisan</h2>
                      <table class="table" id="runmytable">
                        <thead>
                          <tr>
                            <th>Sno</th>
                            <th>Farmer ID</th>
                            <th>Farmer Name</th>
                            <th>Quantity</th>
                            <th>Amount</th>
                            <th>Purchase Date</th>
                            <th>Latest Account No</th>
                            <th>Center Name</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody id="getData">
                          
                        </tbody>
                      </table>
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                  </div>
                </div>
                
              </div>
              </div>
  
              <script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
            <script>

//myFunction()
function myFunction() {
  if($('#mykisanvahicount').text() == 0){
    alert('There is not Kisan Vahi')
    return
  }
 // $('#myInput').val(($('#mySelect :selected').text()))
  $.ajax({
        url: "<?php echo base_url(); ?>admin/report/Listmytotalkisanvahi",
        type: "POST",
        dataType: 'json',
        data:{'search_name':$('#myInput').val()},
        success: function (a) {
          console.log("**************************",a)
          for(var i = 0 ; i < a.length; i++){
            $('#getData').append(`
                    <tr>
                    <td>`+(i+1)+`</td>
                    <td>`+a[i].Farmer_ID+`</td>
                    <td>`+a[i].Farmer_name+`</td>
                    <td>`+a[i].Quantity+`</td>
                    <td>`+a[i].Ammount+`</td>
                    <td>`+a[i].Purchase_Date+`</td>
                    <td>`+a[i].Latest_Account_no+`</td>
                    <td>`+a[i].CenterName+`</td>
                    <td><button name="unmap" id="kisan_`+a[i].Kisan_ID+`" class="btn btn-primary" value="`+a[i].Kisan_ID+`" onclick="unMapMyID(`+a[i].Kisan_ID+`)">Unmap</button></td>
                    
                    </tr>
              `);
          }
        
          $(document).ready(function() {
      setTimeout(()=>{
      $('#runmytable').DataTable( {
        "order": []
      } );
      } ,);
    } );
    
         
        },
        error: function () {
            alert("Error");
        }
        });

}

function unMapMyID(x){
 // alert(x)
  $.ajax({
        url: "<?php echo base_url(); ?>admin/report/unmapkisanVahi",
        type: "POST",
        dataType: 'json',
        data:{'search_name':x},
        success: function (a) {
          console.log("**************************",a)
          window.reload();
          //myFunction();
        },
        error: function () {
            alert("Error");
        }
        });
}
function autocomplete(inp, arr) {
   
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
autocomplete(document.getElementById("myInput"));

function convertNumberToWords(amount) {
    var words = new Array();
    words[0] = '';
    words[1] = 'One';
    words[2] = 'Two';
    words[3] = 'Three';
    words[4] = 'Four';
    words[5] = 'Five';
    words[6] = 'Six';
    words[7] = 'Seven';
    words[8] = 'Eight';
    words[9] = 'Nine';
    words[10] = 'Ten';
    words[11] = 'Eleven';
    words[12] = 'Twelve';
    words[13] = 'Thirteen';
    words[14] = 'Fourteen';
    words[15] = 'Fifteen';
    words[16] = 'Sixteen';
    words[17] = 'Seventeen';
    words[18] = 'Eighteen';
    words[19] = 'Nineteen';
    words[20] = 'Twenty';
    words[30] = 'Thirty';
    words[40] = 'Forty';
    words[50] = 'Fifty';
    words[60] = 'Sixty';
    words[70] = 'Seventy';
    words[80] = 'Eighty';
    words[90] = 'Ninty';
    amount = amount.toString();
    var atemp = amount.split(".");
    var number = atemp[0].split(",").join("");
    var n_length = number.length;
    var words_string = "";
    if (n_length <= 9) {
        var n_array = new Array(0, 0, 0, 0, 0, 0, 0, 0, 0);
        var received_n_array = new Array();
        for (var i = 0; i < n_length; i++) {
            received_n_array[i] = number.substr(i, 1);
        }
        for (var i = 9 - n_length, j = 0; i < 9; i++, j++) {
            n_array[i] = received_n_array[j];
        }
        for (var i = 0, j = 1; i < 9; i++, j++) {
            if (i == 0 || i == 2 || i == 4 || i == 7) {
                if (n_array[i] == 1) {
                    n_array[j] = 10 + parseInt(n_array[j]);
                    n_array[i] = 0;
                }
            }
        }
        value = "";
        for (var i = 0; i < 9; i++) {
            if (i == 0 || i == 2 || i == 4 || i == 7) {
                value = n_array[i] * 10;
            } else {
                value = n_array[i];
            }
            if (value != 0) {
                words_string += words[value] + " ";
            }
            if ((i == 1 && value != 0) || (i == 0 && value != 0 && n_array[i + 1] == 0)) {
                words_string += "Crores ";
            }
            if ((i == 3 && value != 0) || (i == 2 && value != 0 && n_array[i + 1] == 0)) {
                words_string += "Lakhs ";
            }
            if ((i == 5 && value != 0) || (i == 4 && value != 0 && n_array[i + 1] == 0)) {
                words_string += "Thousand ";
            }
            if (i == 6 && value != 0 && (n_array[i + 1] != 0 && n_array[i + 2] != 0)) {
                words_string += "Hundred and ";
            } else if (i == 6 && value != 0) {
                words_string += "Hundred ";
            }
        }
        words_string = words_string.split("  ").join(" ");
    }
    return words_string;
}

// findExpenses(a){
// //   let leftAmounts = '';
           
// //   if(a.expense.expenses != null){


// // if(a.deposit.deposit > a.expense.expenses){

// //   leftAmounts = a.expense.expenses - a.deposit.deposit;
// //   $('#leftAmountExpense').text(leftAmounts +" ₹/-  " )
// // }else{
// //     $('#deposit').text('कोई नाम नही है')
// // }



// // $('#expense').text(a.expense.expenses+' ₹/-  ' + convertNumberToWords(a.expense.expenses))
// // }else{
// //  $('#deposit').text('कोई नाम नही है')
// // }

// }


// findDeposit(a){
//   // let leftAmounts = '';
//   // if(a.deposit.deposit != null){
//   //     $('#deposit').text(a.deposit.deposit+' ₹/-  ' + convertNumberToWords(a.deposit.deposit))
//   //   }else{
//   //       $('#deposit').text('कोई जमा नही है')
//   //   }
// }


var totalDeposit;
var totalExpenses;
var MyfinalDeposit;
var MyfinalExpenses;

$('#search').click(()=>{
    $.ajax({
        url: "<?php echo base_url(); ?>admin/report/search",
        type: "POST",
        dataType: 'json',
        data:{'search_name':$('#myInput').val()},
        success: function (a) {
          console.log("**************************",a)
          findMyExpenses(a);
          findMyDesposit(a);
          finalDeposit(a);
          finalExpenses(a);
          fetchsearchReport(a)
          mykisanvahi(a)
        },
        error: function () {
            alert("Error");
        }
        });
})
//mykisanvahicount
function mykisanvahi(a){
  console.log(a)
    $.ajax({
        url: "<?php echo base_url(); ?>admin/report/mytotalkisanvahi",
        type: "POST",
        dataType: 'json',
        data:{'search_name':$('#myInput').val()},
        success: function (a) {
          console.log("**************************",a)
          $('#mykisanvahicount').text(a.totalcount)
        },
        error: function () {
            alert("Error");
        }
        });
}
function changeFunc(val){
  $('#myInput').val(($('#mySelect :selected').text()))
  $.ajax({
        url: "<?php echo base_url(); ?>admin/report/search",
        type: "POST",
        dataType: 'json',
        data:{'search_name':$('#myInput').val()},
        success: function (a) {
          console.log("**************************",a)
          findMyExpenses(a);
          findMyDesposit(a);
          finalDeposit(a);
          finalExpenses(a);
          fetchsearchReport(a)
        },
        error: function () {
            alert("Error");
        }
        });
}
function fetchsearchReport(){

    var selectElem = $("#mySelect");
    $('#mySelect').find('option').remove();
    $.ajax({
        url: "<?php echo base_url(); ?>admin/report/fetchsearchReports",
        type: "POST",
        dataType: 'json',
        data:{'search_name':$('#myInput').val()},
        success: function (a) {
          console.log("**************************",a)
            // Iterate over object and add options to select
            $.each(a, function(index, value){
                $("<option/>", {
                    value: value.account_no,
                    text: value.name + '_' + value.account_no,
                    class:'optionval',
                   // 'onclick': reload(value.name + '_' + value.account_no)
                }).appendTo(selectElem);
            });
        },
        error: function () {
            alert("Error");
        }
        
})

}

 function findMyDesposit(val){
    totalDeposit = '';
    $('#deposit').text('');
   // $('#expense').text('');
    totalDeposit = parseInt(val.deposit.deposit);
    console.log('totalDeposit',totalDeposit)
    if(isNaN(totalDeposit)){
      $('#deposit').text('कोई जमा नही है')
    }else{
      $('#deposit').text(totalDeposit +' ₹/-  ' + convertNumberToWords(totalDeposit))
    }
  } 

  function findMyExpenses(val){
    totalExpenses = '';
   // $('#deposit').text('');
    $('#expense').text('');
    totalExpenses = parseInt(val.expenses.expenses);
    console.log('findMyExpenses',totalExpenses)
    if(isNaN(totalExpenses)){
      $('#expense').text('कोई नाम नही है')
    }else{
      $('#expense').text(totalExpenses  +' ₹/-  ' + convertNumberToWords(totalExpenses))
    }
  } 

  function finalDeposit(val){
    console.log('valvalvalval',val.Finaldeposit)
    MyfinalDeposit = '';
    $('#MyfinalDeposit').text('');
    if(val.Finaldeposit){
    MyfinalDeposit = parseInt(val.Finaldeposit);
    $('#MyfinalDeposit').text(MyfinalDeposit  +' ₹/-  ' +convertNumberToWords(MyfinalDeposit));
    }else{
    $('#MyfinalDeposit').text('कोई जमा शेष नही है');
    }
  }  

   function finalExpenses(val){
    //console.log('valvalvalval',val)
    Finalexpenses = '';
    $('#MyFinalExpenses').text('');
    if(val.Finalexpenses){
      Finalexpenses = parseInt(val.Finalexpenses);
    $('#MyFinalExpenses').text(Finalexpenses  +' ₹/-  ' +convertNumberToWords(Finalexpenses));
    }else{
    $('#MyFinalExpenses').text('कोई नाम शेष नही है');

    }
  }     


//runmytable


</script>			