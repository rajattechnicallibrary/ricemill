<?php
$QUERY_STRING = $_SERVER['QUERY_STRING'];
//pr();die;
?>
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/datepicker/jquery-ui.css"/>
<style>

</style>
<div class="my-account-section">
    <div class="container container-margin">
        <div class="row">
		
		   <?php echo get_flashdata(); ?>
            <div class="container">

                <div class="grid">


                    <?php echo form_open('', array('method' => 'get', 'class' => '', 'id' => 'filterForm')); ?> 
                    <div class="recipe-wd11">
							<div class="check-in form-control">
								<div class="group">
								<input type="text" readonly name="start_date" value="<?= (@$_GET['start_date']) ? $_GET['start_date'] : "" ?>" class="inputMaterial datepicker1" placeholder="Start Date">
							<span class="highlight"></span> <span class="bar"></span>
							</div>
						 </div>
					</div>
                    <div class="recipe-wd11">
						<div class="check-in form-control">
							<div class="group">
								<input type="text" readonly name="end_date" value="<?= (@$_GET['end_date']) ? $_GET['end_date'] : "" ?>" class="inputMaterial datepicker2" placeholder="End Date">
								<span class="highlight"></span> <span class="bar"></span>
							</div>
						</div>
					</div>
					<div class="recipe-wd21">
							<div class="form-group">
    <div class="col-md-12">
        
   
					   <select name="menu_category" id="dates-field2 menu_category" class="multiselect-ui form-control" multiple="multiple">
					   <?php 
					   $category = explode(',',@$_GET['menu_category']);
					   if(!empty($menu_category)){
					   foreach($menu_category as $key=>$val){
					   if(in_array($val->id, $category )){
						   $selected = 'selected="selected"';
					   }else{
						   $selected = '';
					   } ?>
						   <option value="<?php echo $val->id; ?>" <?= $selected ?>><?php echo $val->name; ?></option>
					   <?php } }else{ ?>
					   <option>No data available </option>
					   <?php }?>
						</select>
						 </div>
                         
                         
</div>
</div>

                    <div class="recipe-wd21">
                        <div class="">
                            <select name="food_type" class="selectpicker">
                                <option value="">Food Type</option>
                                <option value="1" <?= (@$_GET['food_type']=='1') ? "selected" : "" ?>>Veg</option>
                                <option value="2" <?= (@$_GET['food_type']=='2') ? "selected" : "" ?>>Non Veg</option>
                            </select>
							
                        </div>
                         <!--<div class="form-group">
                              <select id="lunch" class="selectpicker" title="Food Type">
                                <option>Hot Dog, Fries and a Soda</option>
                                <option>Burger, Shake and a Smile</option>
                                <option>Sugar, Spice and all things nice</option>
                                <option>Baby Back Ribs</option>
                                <option>A really really long option made to illustrate an issue with the live search in an inline form</option>
                              </select>
                         </div>-->
                    </div>

                    <div class="recipe-wd21">
                        <div class=" ">
                            <select name="food_category" id="food_category" class="selectpicker">
                                <option value="" >Food Category</option>
                                <option value="1" <?= (@$_GET['food_category']=='1') ? "selected" : "" ?>>Drink</option>
                                <option value="2" <?= (@$_GET['food_category']=='2') ? "selected" : "" ?>>Dessert</option>
                                <option value="3" <?= (@$_GET['food_category']=='3') ? "selected" : "" ?>>Snacks</option>
                                <option value="4" <?= (@$_GET['food_category']=='4') ? "selected" : "" ?>>Food (main course)</option>

                            </select>
                        </div>
                    </div>

                    <div class="recipe-wd8">
                        <div class="input-append span12">
						
							<span class="filter_btn btn default blue-stripe"><i class="fa fa-search ser_icon" aria-hidden="true"></i></span>
									<span class="reset_btn btn default green-stripe"><i class="fa fa-refresh ref_icon" aria-hidden="true"></i></span>
                            <!--<button type="button" class="filter_btn btn default blue-stripe"><i class="fa fa-search ser_icon" aria-hidden="true"></i></button>-->
                        </div>
                    </div>
                    <?php echo form_close(); ?> 
                    <div class="table-right-btn">
                        <button class="recipe-export-btn blogs_export">Export to Excel</button>
                        <a class="recipe-add-btn" href="<?= base_url() ?>account/blogs/add">Add New</a>
                        <button class="recipe-delete-btn blogs_delete">Delete</button>
                    </div>
                </div>

                <div class="table-container" >
                    <div class="table-responsive restable-div">
                        <table class="table table-striped table-bordered table-hover dataTable no-footer" id="employee-grid">
                            <thead>
                                <tr>
								
								
								<th width="1%"> </th>
								<th class="table-checkbox">
									<input type="checkbox" class="group-checkable" onclick="$('input[name*=\'selected\']').prop('checked', this.checked);"/>
								</th>
                                    <th width="">S.NO.</th>
                                    <th width="14%">Blog Title</th>
                                    <th width="14%">Likes</th>
                                    <th width="14%">Comments</th>
                                    <th width="14%">Rating</th>
									 <th width="14%">Number of followers</th>
                                    <th width="15%">Blog Status </th>
									<!--<th width="15%">Is Approved </th>-->
                                    <th width="9%">Action</th>
                                </tr>
                            </thead>
                        </table>
                    </div>  
                </div>
                <div class="addbanner-eventdetail"> 
                    <img src="<?= base_url(); ?>frontend_assets/images/addbanner-event.jpg"/>
                </div>
            </div>
            <!--Recipe-List-End-->
        </div>
    </div>
</div>

<script type="text/javascript" src="<?= base_url(); ?>assets/global/plugins/datatables/media/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="<?= base_url(); ?>assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js"></script>

<script src="<?= base_url(); ?>assets/admin/pages/scripts/table-managed.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/datepicker/jquery-ui.js"></script>
<script>
		$(document).on('click','.reset_btn',function(){
			window.location.href = '<?= base_url() ?>account/blogs';
		});
    $(document).on('click','.filter_btn',function(){
		var url 				= 	"<?= base_url() ?>"+"account/blogs?";
		
	var start_date  		= 	$("input[name='start_date']").val().replace(/\s+/g, '');
        start_date				=	start_date.trim();
	var end_date  			= 	$("input[name='end_date']").val().replace(/\s+/g, '');
		end_date		=	end_date.trim();
        if(start_date != '' && end_date == '')
        {
            alert('End Date field is required!');
            return false;
        }
		if(start_date == '' && end_date != '')
		{
			alert('Start Date field is required!');
			return false;
		}    
		if(start_date !=''){
					url = url+"&start_date="+start_date;
			}
			
			if(end_date !=''){
					url = url+"&end_date="+end_date;
			}
		    var menu_category   = $("select[name='menu_category']").val();
			
			if(menu_category !=null){
					url = url+"&menu_category="+menu_category;
			}	
			
			var food_type		= 	$("select[name='food_type']").val();
			    if(food_type !=''){
					url = url+"&food_type="+food_type;
				}
			
			var food_category  			= 	$("select[name='food_category']").val();
			if(food_category !=''){
					url = url+"&food_category="+food_category;
				}
			
			//alert(start_date);alert(end_date);alert(menu_category);alert(food_type);alert(food_category);							
			window.location.href = url;
		});
		
		
		
    $(document).ready(function () {
        //	var dateToday = new Date();
        from = $(".datepicker1").datepicker({
            numberOfMonths: 1,
            dateFormat: 'dd/mm/yy',
            //	minDate: dateToday,
            //changeMonth: true,
            //changeYear: true,			
        })
                .on("change", function () {
                    to.datepicker("option", "minDate", getDate(this));

                }),
                to = $(".datepicker2").datepicker({
            numberOfMonths: 1,
            dateFormat: 'dd/mm/yy',
            //minDate: dateToday,
            //changeMonth: true,
            //changeYear: true,			
        })
                .on("change", function () {
                    from.datepicker("option", "maxDate", getDate(this));
                });
        function getDate(element) {
            return element.value;
        }
    });
    var table = $('#employee-grid');

    // begin first table
    // begin first table
    table.dataTable({
        // Internationalisation. For more info refer to http://datatables.net/manual/i18n     
        "bStateSave": false, // save datatable state(pagination, sort, etc) in cookie.
        "processing": true,
        "serverSide": true,
        "lengthMenu": [
            [5, 15, 20, -1],
            [5, 15, 20, "All"] // change per page values here
        ],
        // set the initial value
        "pageLength": 5,
        "pagingType": "bootstrap_full_number",
        "language": {"Search": "My search: ", "lengthMenu": "_MENU_ Records", "paginate": {"previous": "Prev", "next": "Next", "last": "Last", "first": "First"}},
        "columnDefs": [{'className': 'control', 'orderable': false, 'targets': 0},
            {'orderable': false, 'targets': [-1]},
            {"targets": [0], "visible": false, "searchable": false},
            {"targets": [1], "orderable": false, "searchable": false},
            {"targets": [2], "orderable": true, "searchable": true},
            {"targets": [3], "orderable": false, "searchable": false},
            {"targets": [4], "orderable": false, "searchable": false},
            {"targets": [5], "orderable": false, "searchable": false},
            {"targets": [6], "orderable": false, "searchable": false},
            {"targets": [7], "orderable": false, "searchable": false},
            {"targets": [8], "orderable": false, "searchable": false}
        ],
        "ajax": {
            url: "<?php echo base_url(); ?>account/blogs/blogs_list_ajax?<?php echo $QUERY_STRING; ?>", // json datasource
                        type: "post",

                        error: function (data) {
                            $("#employee-grid_processing").css("display", "none");
                        }

                    },
                    // "order": [[0, "desc"]] // set first column as a default sort by desc// set first column as a default sort by desc
                });

                $(document).ready(function () {
                    setTimeout(function () {
                        TableManaged.init();
                        $(".form-group-custom").removeClass('hide');
                    }, 1000);
                });
</script>

<script>
$(document).on('click','.blogs_delete',function(){
	var blog_ids = [];
	$.each($("input[name='selected[]']:checked"), function(){            
	blog_ids.push($(this).val());            
	});
	
	if(parseInt(blog_ids.length) == 0)
	{
	alert("Please select at least one record(s) ");
	return false;
	}
	
	var conf = confirm("Are you sure want to delete the selected records(s)!");
	if(conf){
		$.ajax({ 
				type: 'POST',
				url: '<?php echo base_url(); ?>account/blogs/delete',
				data:"blog_ids="+blog_ids, 
				success: function(dat) { 
				var url = '<?php echo base_url(); ?>account/blogs';
				dat =   JSON.parse(dat);	
				if(dat['status']=="success")
				{  
				setTimeout(function(){         
				location = url; 
				}, 1000);
				}else if(dat['status']=="error"){  
				setTimeout(function(){         
				location = url; 
				}, 1000);

				}
				}
				});
	}

	
});

  $(document).on('click','.blogs_export', function () {
	var ids         =   [];    

	$.each($("input[name='selected[]']:checked"), function(){            
	ids.push($(this).val());            
	});  
	if(parseInt(ids.length) == 0)
	{
	alert("Please select at least one record(s)");
	return false;
	}
	var conf = confirm("Are you sure want to export the selected records(s)!");
	if(conf){             
			var url = '<?php echo base_url(); ?>account/blogs/export';	
			if (ids !='') {
				url += '?ids=' + encodeURIComponent(ids);
			}
			location = url;	
			setTimeout(function(){         
			window.location.href= "<?php echo base_url(); ?>account/blogs" ;
			}, 2000);	
			}
	
	});

</script>
