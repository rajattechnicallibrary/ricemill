<link href="<?php echo base_url();?>assets/global/css/components-rounded.css" id="style_components" rel="stylesheet" type="text/css"/>

<?php echo get_flashdata(); ?>
<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css"/>
<?php
$QUERY_STRING = $_SERVER['QUERY_STRING'];

?>

<div id="msgShow"></div>
 <main class="main-content bgc-grey-100">
                <div id="mainContent">
                    <div class="container-fluid">
                        <!--<h4 class="c-grey-900 mT-10 mB-30"> List </h4>-->
                        <div class="row">
                            <div class="col-md-12">
                                <div class="bgc-white bd bdrs-3 p-20 mB-20">
                                    
                                    <div class="gap-10 peers"><div class="peer">
									<h4 class="c-grey-900 mB-20 pull-left"> List </h4>
									<button type="button" class="btn cur-p btn-primary pull-right">ADD</button></div></div>
                                   
                    <table class="table table-striped table-bordered"  id="employee-grid-buyer">
                        <thead>

                            <tr>
                            <!-- <th width="1%"> </th>                                -->
								<th width="14%">S.No.</th>
                                <th width="14%"> Person Name</th>
								<th width="14%"> Team Type</th>
                                <th width="14%">Email Id</th>
                                <th width="14%">Mobile Number</th>
								<!-- <th width="15%">Status </th> -->
                                <!-- <th width="9%">Action</th> -->
                            </tr>

                        </thead>
                    </table>


                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
			
       
                    
<script type="text/javascript" src="<?= base_url(); ?>assets/global/plugins/datatables/media/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="<?= base_url(); ?>assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js"></script>

<script src="<?= base_url(); ?>assets/admin/pages/scripts/table-managed.js"></script>

<script>


    $(".custom_filter").on("change", function () {
        var status = $(this).val();
        if (status == '')
        {
            window.location.href = "<?php echo base_url(); ?>admin/buyer";
        } else
        {
            $("#filterForm").submit();
        }
    });

    $(document).on('click', '.group-checkable', function () {
        if ($(this).is(':checked')) {
            $('.checkboxes').prop('checked', true);
            $('.checkboxes').parent().addClass("checked");
        } else {
            $('.checkboxes').prop('checked', false);
            $('.checkboxes').parent().removeClass("checked");
        }
    })

    var table = $('#employee-grid-buyer');
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
        "language": {"search": "My search: ", "lengthMenu": "_MENU_ Records", "paginate": {"previous": "Prev", "next": "Next", "last": "Last", "first": "First"}},
        "columnDefs": [{'className': 'control', 'orderable': false, 'targets': 0},
            {'orderable': false, 'targets': [-1]},
            {"targets": [0], "orderable": false, "searchable": false},
            {"targets": [1], "orderable": false, "searchable": false},
            {"targets": [2], "orderable": true, "searchable": true},
            {"targets": [3], "orderable": true, "searchable": true},
            {"targets": [4], "orderable": true, "searchable": true},
            // {"targets": [5], "orderable": true, "searchable": true},
            
                      
        ],
        "ajax": {
            url: "<?php echo base_url(); ?>admin/manage_team/manage_team_list_ajax?<?php echo $QUERY_STRING; ?>", // json datasource
            type: "post",

            error: function (data) {
                $("#employee-grid_processing").css("display", "none");
            }
            
        },

        "columnDefs": [ {

"targets": [], // column or columns numbers

"orderable": false,  // set orderable for selected columns

}],
		
        "order": [[0, "desc"]] // set first column as a default sort by desc// set first column as a default sort by desc
    });

    $(document).ready(function() {  
        setTimeout(function(){
		    TableManaged.init();
		    $(".form-group-custom").removeClass('hide');
        },1000);
	});
</script> 		