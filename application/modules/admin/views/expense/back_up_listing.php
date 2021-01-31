<main class="main-content bgc-grey-100">
                <div id="mainContent">
                    <div class="container-fluid">
                        <!--<h4 class="c-grey-900 mT-10 mB-30"> List </h4>-->
                        <div class="row">
                            <div class="col-md-12">
                                <div class="bgc-white bd bdrs-3 p-20 mB-20">
                                    <?=get_flashdata();?>
                                    <div class="gap-10 peers"><div class="peer">
									<h4 class="c-grey-900 mB-20 pull-left"> List </h4>
									
                                    <!-- <a href="<?=base_url()?>/admin/campaign/add" id="back-btn" class="btn cur-p btn-primary pull-right">ADD</a> -->
                                    </div></div>
                                    
                                    <div class="portlet-body">
							<?php echo form_open('', 'method="post"'); ?>
								<div class="row">
									<div class="col s4">
										<!--<div class="show-left">Show</div>-->
										<div class="col s6">
										show
											<select class="form-control col-md-3 pading_8" id="perpage" name="perpage">
												<option value="10">10</option>
												<option value="20">20</option>
												<option value="30">30</option>
												<option value="50">50</option>
												<option value="100">100</option>
												<option value="1">All</option>
											</select>
										</div>
										<!--<div class="show-right">Rows</div>-->
									</div>
									<div class="col s6">&nbsp;</div>
									<div class="col s2">
										<div class="col-md-8 pull-right">
										&nbsp;<input type="text" name="search" id="search" class="form-control" placeholder="Search" /> </div>
                                    </div>
									
								</div>
							<?php echo form_close();  ?>
							<div class="">   
								<div class="col-md-12">
									<div class="table-responsive confirms margin-sm-top" id="gridlisting">
										<!-- async hit comes here -->
									</div>
								</div>
							</div>
						</div>
                                
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>

<script>
$(document).ready(function() {
   
   
    gridloader('<?php echo $pageno; ?>');
	//==========Page click==========//
	$('#gridlisting').on('click','li.page_active,li.previous,li.next',function(){
        var page = $(this).attr('p');
       
		 $("html, body").animate({ scrollTop: 0 }, "slow");
        gridloader(page);
    });
    //==========Close Page click==========//
    //==========Change Per Page==========//
    $('#perpage').change(function () {
        
        gridloader(1);
    });
    //==========Close Change Per Page==========//
    //==========On Search Load Grid============//
    // $('#search').click(function(){
    //     gridloader(1);
    // }) ;
    $('#search').keyup(function(){
        gridloader(1);
    }) ;
    //=========Close On Search Load Grid======//
    
});
function gridloader(page)
{
    
	var perpage = $("#perpage").val();
    var search = $("#search").val();
   // var token_value=1;
	$.ajax
    ({
        
        type: "POST",
        url: '<?php echo base_url();?>admin/campaign/ajax_list_items',
		data: "page="+page+"&perpage="+perpage+"&search="+search,
         beforeSend: function(){
           $("#gridlisting").html("<center><img src='<?php echo base_url(); ?>assets/images/circleloading.gif'/></center>");  
         }, 
        success: function(response)
        {
           $("#gridlisting").html(response);
         }
    }); 	
}
</script>