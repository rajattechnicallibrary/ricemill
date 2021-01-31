<div class="panel-content">
    <!--Row-1-->
    <div class="row">
        <div class="col-md-4">
            <div class="dashboard_box_white">
                 <div class="widget">
                            <div class="widget-controls">
                                <span class="refresh-content"><i class="fa fa-refresh"></i></span>
                            </div><!-- Widget Controls -->
                            <div class="mini-stats ">
                                <span><img src="<?php echo base_url();?>assets/images/dashboard_customer_icon.png"/></span>
                                <p><i class="fa  fa-arrow-up up"></i> Customers</p>
                                <?php if($total_customers) { ?>
								<h3><?=@$total_customers?></h3>
								<?php } else { ?>
								<h3>0</h3>
								<?php } ?>
                            </div>
                        </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="dashboard_box_white">
                 <div class="widget">
                            <div class="widget-controls">
                                <span class="refresh-content"><i class="fa fa-refresh"></i></span>
                            </div><!-- Widget Controls -->
                            <div class="mini-stats ">
                                <span><img src="<?php echo base_url();?>assets/images/feedset_purple.png"/></span>
                                <p><i class="fa  fa-arrow-up up"></i> RESPONSES</p>
                                <?php if($total_feedback_responses) { ?>
								<h3><?=@$total_feedback_responses?></h3>
								<?php } else { ?>
								<h3>0</h3>
								<?php } ?>
                            </div>
                        </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="dashboard_box_white">
			<?php if(!empty($fetch_global_rating)) { foreach($fetch_global_rating as $global_key => $global_val){				
			$p_happy	=	round($global_val['happy_p']);
			$p_neutral	=	round($global_val['neutral_p']);
			$p_unhappy	=	round($global_val['unhappy_p']);			
			$total_global = $p_happy + $p_neutral + $p_unhappy;
			if($total_global == 101){ $p_neutral = $p_neutral-1;}
			if($total_global == 99){ $p_neutral = $p_neutral+1;}
			?>
                 <div class="widget">
                    <div class="widget-controls">
                        <span class="refresh-content"><i class="fa fa-refresh"></i></span>
                      </div><!-- Widget Controls -->  
                      <div class="dashboard_heading"><?=$global_key?></div>
                      <div class="dashboard_md_50">
                        <div class="dashboard_avtart_main">
                            <div class="dashboard-avtar-img">
                                <img src="<?php echo base_url();?>assets/images/dashboard_avtar_green.png"/>
                            </div>
                            <div class="dashboard_avtar_green_txt"><?=$p_happy?>%</div>
                        </div>
                        <div class="dashboard_avtart_main">
                             <div class="dashboard-avtar-img">
                                 <img src="<?php echo base_url();?>assets/images/dashboard_avtar_yellow.png"/>
                             </div>
                              <div class="dashboard_avtar_yellow_txt"><?=$p_neutral?>%</div>
                        </div>
                        <div class="dashboard_avtart_main">
                             <div class="dashboard-avtar-img">
                                 <img src="<?php echo base_url();?>assets/images/dashboard_avtar_red.png"/>
                             </div>
                              <div class="dashboard_avtar_red_txt"><?=$p_unhappy?>%</div>
                        </div>
                      </div>
                      
                      <div class="dashboard_md_50">
                        <div class="dashboard_totalresponses_main">
                            <div class="dashboard_totalresponsesgreybox">
                                <strong>Total Responses</strong>
                                <span><?=$global_val['total_response']?></span>
                            </div>
                        </div>
                      </div>
                                              
                   </div>
			<?php } }else{ ?>
                            <div class="widget">
                    <div class="widget-controls">
                        <span class="refresh-content"><i class="fa fa-refresh"></i></span>
                      </div><!-- Widget Controls -->  
                      <div class="dashboard_heading">GLOBAL RATING</div>
                      <div class="dashboard_md_50">
                        <div class="dashboard_avtart_main">
                            <div class="dashboard-avtar-img">
                                <img src="<?php echo base_url();?>assets/images/dashboard_avtar_green.png"/>
                            </div>
                            <div class="dashboard_avtar_green_txt">0%</div>
                        </div>
                        <div class="dashboard_avtart_main">
                             <div class="dashboard-avtar-img">
                                 <img src="<?php echo base_url();?>assets/images/dashboard_avtar_yellow.png"/>
                             </div>
                              <div class="dashboard_avtar_yellow_txt">0%</div>
                        </div>
                        <div class="dashboard_avtart_main">
                             <div class="dashboard-avtar-img">
                                 <img src="<?php echo base_url();?>assets/images/dashboard_avtar_red.png"/>
                             </div>
                              <div class="dashboard_avtar_red_txt">0%</div>
                        </div>
                      </div>
                      
                      <div class="dashboard_md_50">
                        <div class="dashboard_totalresponses_main">
                            <div class="dashboard_totalresponsesgreybox">
                                <strong>Total Responses</strong>
                                <span>0</span>
                            </div>
                        </div>
                      </div>                     
                   </div>
                        <?php } ?>
            </div>
        </div>
    </div>
    <!--Row-1-End-->
    
    <!--Row-2-->
    <div class="row">
        <div class="col-md-4">
            <div class="dashboard_box_white">
                 <div class="widget">
                            <div class="widget-controls">
                                <span class="refresh-content"><i class="fa fa-refresh"></i></span>
                            </div><!-- Widget Controls -->
                            <div class="mini-stats ">
                                <span><img src="<?php echo base_url();?>assets/images/dashboard_unit_icon.png"/></span>
                                <p><!--<i class="fa  fa-arrow-up up"></i>--> unit</p>
                                <?php if($total_units) { ?>
								<h3><?=@$total_units?></h3>
								<?php } else { ?>
								<h3>0</h3>
								<?php } ?>
                            </div>
                        </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="dashboard_box_white">
                 <div class="widget">
                            <div class="widget-controls">
                                <span class="refresh-content"><i class="fa fa-refresh"></i></span>
                            </div><!-- Widget Controls -->
                            <div class="mini-stats ">
                                <span><img src="<?php echo base_url();?>assets/images/active-cic-dsh.png"/></span>
                                <p style='font-style: normal'><i class="fa  fa-arrow-up up"></i> active CIC<span style="text-transform: lowercase;">s</span></p>
                                <!--<h3><?=@$total_feedback_set?></h3>-->
                                <h3><?= @$active_cic_for_client[0]->total_cic ?></h3>
                            </div>
                        </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="dashboard_box_white">
			<?php if(!empty($fetch_nps_rating)) { foreach($fetch_nps_rating as $nps_key => $nps_val){					
			$nps_happy	=	round($nps_val['yes_p']);
			$nps_neutral	=	round($nps_val['not_sure_p']);
			$nps_unhappy	=	round($nps_val['no_p']);			
			
			$total_global_nps = $nps_happy + $nps_neutral + $nps_unhappy;
			if($total_global_nps == 101){ $nps_neutral = $nps_neutral-1;}
			if($total_global_nps == 99){ $nps_neutral = $nps_neutral+1;}
			
			?>
                 <div class="widget">
                    <div class="widget-controls">
                        <span class="refresh-content"><i class="fa fa-refresh"></i></span>
                      </div><!-- Widget Controls -->  
                      <div class="dashboard_heading"><?=$nps_key?></div>
                      <div class="dashboard_md_50">
                        <div class="dashboard_avtart_main">
                            <div class="dashboard-avtar-img">
                                <img src="<?php echo base_url();?>assets/images/dashboard_avtar_green.png"/>
                            </div>
                            <div class="dashboard_avtar_green_txt"><?=$nps_happy?>%</div>
                            <div class="dashboard_bulb_main">
                            <div class="dashboard_bulb_icon"><img src="<?php echo base_url();?>assets/images/dashboard_bulb_icon.png"/></div>
                            <div class="dashboard_bulb_txt"><?=$nps_val['yes_count']?></div>
                        </div>
                        </div>
                        <div class="dashboard_avtart_main">
                             <div class="dashboard-avtar-img">
                                 <img src="<?php echo base_url();?>assets/images/dashboard_avtar_yellow.png"/>
                             </div>
                              <div class="dashboard_avtar_yellow_txt"><?=$nps_neutral?>%</div>
                              <div class="dashboard_bulb_main">
                            <div class="dashboard_bulb_icon"><img src="<?php echo base_url();?>assets/images/dashboard_bulb_icon.png"/></div>
                            <div class="dashboard_bulb_txt"><?=$nps_val['not_sure_count']?></div>
                        </div>
                        </div>
                        <div class="dashboard_avtart_main">
                             <div class="dashboard-avtar-img">
                                 <img src="<?php echo base_url();?>assets/images/dashboard_avtar_red.png"/>
                             </div>
                              <div class="dashboard_avtar_red_txt"><?=$nps_unhappy?>%</div>
                              <div class="dashboard_bulb_main">
                            <div class="dashboard_bulb_icon"><img src="<?php echo base_url();?>assets/images/dashboard_bulb_icon.png"/></div>
                            <div class="dashboard_bulb_txt"><?=$nps_val['no_count']?></div>
                        </div>
                        </div>
                      </div>
                      
                      <div class="dashboard_md_50">
                        <div class="dashboard_totalresponses_main">
                            <div class="dashboard_totalresponsesgreybox">
                                <strong>Total Responses</strong>
                                <span><?=$nps_val['total_response']?></span>
                            </div>
                        </div>
                      </div>
                                              
                   </div>
			<?php }}else{ ?>
                               <div class="widget">
                    <div class="widget-controls">
                        <span class="refresh-content"><i class="fa fa-refresh"></i></span>
                      </div><!-- Widget Controls -->  
                      <div class="dashboard_heading">Global Net Promoter Score</div>
                      <div class="dashboard_md_50">
                        <div class="dashboard_avtart_main">
                            <div class="dashboard-avtar-img">
                                <img src="<?php echo base_url();?>assets/images/dashboard_avtar_green.png"/>
                            </div>
                            <div class="dashboard_avtar_green_txt">0%</div>
                            <div class="dashboard_bulb_main">
                            <div class="dashboard_bulb_icon"><img src="<?php echo base_url();?>assets/images/dashboard_bulb_icon.png"/></div>
                            <div class="dashboard_bulb_txt">0</div>
                        </div>
                        </div>
                        <div class="dashboard_avtart_main">
                             <div class="dashboard-avtar-img">
                                 <img src="<?php echo base_url();?>assets/images/dashboard_avtar_yellow.png"/>
                             </div>
                              <div class="dashboard_avtar_yellow_txt">0%</div>
                              <div class="dashboard_bulb_main">
                            <div class="dashboard_bulb_icon"><img src="<?php echo base_url();?>assets/images/dashboard_bulb_icon.png"/></div>
                            <div class="dashboard_bulb_txt">0</div>
                        </div>
                        </div>
                        <div class="dashboard_avtart_main">
                             <div class="dashboard-avtar-img">
                                 <img src="<?php echo base_url();?>assets/images/dashboard_avtar_red.png"/>
                             </div>
                              <div class="dashboard_avtar_red_txt">0%</div>
                              <div class="dashboard_bulb_main">
                            <div class="dashboard_bulb_icon"><img src="<?php echo base_url();?>assets/images/dashboard_bulb_icon.png"/></div>
                            <div class="dashboard_bulb_txt">0</div>
                        </div>
                        </div>
                      </div>
                      
                      <div class="dashboard_md_50">
                        <div class="dashboard_totalresponses_main">
                            <div class="dashboard_totalresponsesgreybox">
                                <strong>Total Responses</strong>
                                <span>0</span>
                            </div>
                        </div>
                      </div>                     
                   </div> 
                        <?php } ?>
            </div>
        </div>
    </div>
    <!--Row-2-End-->
    
	
    <!--Row-3-->
    <div class="row">
	<div class="col-md-4">
            <div class="dashboard_box_white1">
                 <div class="widget">
                            <div class="widget-controls">                               
                                <span class="refresh-content"><i class="fa fa-refresh"></i></span>
                            </div><!-- Widget Controls -->
                            <div class="dashboard_heading1">top 5 : <span> Unit wise Ratings </span></div>
						 <?php if(!empty($fetch_unit_wise_rating)) { foreach($fetch_unit_wise_rating as $unit_wisekey => $unit_wise_val){
							$happy=round($unit_wise_val['happy_p']);
							$neutral=round($unit_wise_val['neutral_p']);
							$unhappy=round($unit_wise_val['unhappy_p']);
								
						 
						 ?>	
						   <div class="dashboard_full_strip">
                            
                            <div class="dashboard_md_60">
                                <div class="dashboard_score_icon"><img src="<?php echo base_url();?>assets/images/dashboard_score_icon.png"/></div>
                                
                                <div class="dashboard_scoretxt_main">
                                <div class="dashboard_score_icon_txt"><?=$unit_wisekey?></div>
                                <div class="dashboard_bulb_main">
                            <div class="dashboard_bulb_icon"><img src="<?php echo base_url();?>assets/images/dashboard_bulb_icon.png"></div>
                            <div class="dashboard_bulb_txt"><?=$unit_wise_val['total_response']?></div>
                        </div>
                        </div>
                            </div>
                            
                            <div class="dashboard_md_40">
                                <div class="dashboard_avtart_main">
                                    <div class="text-center"><img src="<?php echo base_url();?>assets/images/dashboard_green_curv.png"/></div>
                                    <div class="dashboard_avtar_green_txt"><?=$happy?>%</div>
                                </div>
                                <div class="dashboard_avtart_main">
                                    <div class="text-center"><img src="<?php echo base_url();?>assets/images/dashboard_yellow_curv.png"/></div>
                                    <div class="dashboard_avtar_yellow_txt"><?=$neutral?>%</div>
                                </div>
                                <div class="dashboard_avtart_main">
                                    <div class="text-center"><img src="<?php echo base_url();?>assets/images/dashboard_red_curv.png"/></div>
                                    <div class="dashboard_avtar_red_txt"><?=$unhappy?>%</div>
                                </div>
                            </div>
                            </div>
						 <?php }}else{ ?>
                                                    <div class="rating-heading">No Rating Found!</div>
                                                 <?php } ?>
                        </div>
            </div>
        </div>
       
	
		
      <div class="col-md-4">
            <div class="dashboard_box_white1">
                 <div class="widget">				 
                            <div class="widget-controls">                               
                                <span class="refresh-content"><i class="fa fa-refresh"></i></span>
                            </div><!-- Widget Controls -->
                            <div class="dashboard_heading1">top 5 : <span> Unit wise net promoter scores</span></div> 
							<?php if(!empty($fetch_unit_wise_rating_for_nps)) { foreach($fetch_unit_wise_rating_for_nps as $nps_key => $nps_val) {							
							$nps_happy=round($nps_val['yes_p']);
							$nps_neutral=round($nps_val['not_sure_p']);
							$nps_unhappy=round($nps_val['no_p']);
							?>	
							<div class="dashboard_full_strip">
                            
                            <div class="dashboard_md_60">
                                <div class="dashboard_score_icon"><img src="<?php echo base_url();?>assets/images/dashboard_score_icon.png"/></div>
                                
                                <div class="dashboard_scoretxt_main">
                                <div class="dashboard_score_icon_txt"><?=$nps_key?></div>
                                <div class="dashboard_bulb_main">
                            <div class="dashboard_bulb_icon"><img src="<?php echo base_url();?>assets/images/dashboard_bulb_icon.png"></div>
                            <div class="dashboard_bulb_txt"><?=$nps_val['total_response']?></div>
                        </div>
                        </div>
                            </div>
                            
                            <div class="dashboard_md_40">
                                <div class="dashboard_avtart_main">
                                    <div class="text-center"><img src="<?php echo base_url();?>assets/images/dashboard_green_curv.png"/></div>
                                    <div class="dashboard_avtar_green_txt"><?=$nps_happy?>%</div>
                                    <div class="dashboard_smalltxt"><?=$nps_val['yes_count']?></div>
                                </div>
                                <div class="dashboard_avtart_main">
                                    <div class="text-center"><img src="<?php echo base_url();?>assets/images/dashboard_yellow_curv.png"/></div>
                                    <div class="dashboard_avtar_yellow_txt"><?=$nps_neutral?>%</div>
                                    <div class="dashboard_smalltxt"><?=$nps_val['not_sure_count']?></div>
                                </div>
                                <div class="dashboard_avtart_main">
                                    <div class="text-center"><img src="<?php echo base_url();?>assets/images/dashboard_red_curv.png"/></div>
                                    <div class="dashboard_avtar_red_txt"><?=$nps_unhappy?>%</div>
                                    <div class="dashboard_smalltxt"><?=$nps_val['no_count']?></div>
                                </div>
                            </div>
                            </div>  
                            <?php }}else{ ?>							
                                <div class="rating-heading">No Rating Found!</div>
                            <?php } ?>
                             </div>
            </div>
        </div>
       <div class="col-md-4">
            <div class="dashboard_box_white1">
		
                 <div class="widget">
				 
                            <div class="widget-controls">                               
                                <span class="dashboard_sort"><i id="go-left" class="fa fa-caret-left"></i><i id="go-right" class="fa fa-caret-right"></i></span>
                                 <span class="refresh-content"><i class="fa fa-refresh"></i></span>
                            </div><!-- Widget Controls -->	
														
                            <div class="dashboard_heading1">Feedback Set : <span id="fdb_set_name">	<?php if($feedback_set) { ?>						
							<?=@$feedback_set[0]['feedback_set']->feedback_set?>							
							</span>
							<?php } else {?>
							</div>
							<div class="rating-heading">No Feedback Found!</div>
							<?php } ?>
                            <div class="slider" >
                                <div>
								<?php if(!empty($feedback_set)) { $i=0; 
                                                                
                                                                foreach($feedback_set as $feedback_key => $feedback_val) { 
								$i++;
								$happy = 0;
								$neutral = 0;
								$unhappy = 0;
								$feedback_resp	=	$this->dashboard_mod->fetch_feedback_responses($feedback_val['feedback_set']->id);
								
								$count_feedback_resp	=	$this->dashboard_mod->count_feedback_responses($feedback_val['feedback_set']->id);
								if($count_feedback_resp){
								$total_response    	 =   $count_feedback_resp;								
								} else {
								$total_response    	 =   0;	
								}
								if ($feedback_resp) {
									$total_response1 = count($feedback_resp);
									foreach ($feedback_resp as $ur_key => $ur_val) {
										$happy = $happy + $ur_val->happy_percent;
										$neutral = $neutral + $ur_val->neutral_percent;
										$unhappy = $unhappy + $ur_val->un_happy_percent;
									}
									$happy_p = round($happy / $total_response1);
									$neutral_p = round($neutral / $total_response1);
									$unhappy_p = round($unhappy / $total_response1);                   
									
								} else {
									$happy_p = 0;
									$neutral_p = 0;
									$unhappy_p = 0;                    			
								}
								 $totalper1 = $happy_p+$neutral_p+$unhappy_p;
								
								if($totalper1 ==101){$neutral_p = $neutral_p-1;}
								if($totalper1 ==99){$neutral_p = $neutral_p+1;}
								
								?>
                                    <div id="slider<?= $i ?>">
                                        <style>#slider<?= $i ?>{width:315px !important;} </style>
									<input type="hidden" name="feedback_set" value="<?php echo $feedback_val['feedback_set']->feedback_set; ?>" >
									 <?php foreach($feedback_val['questions'] as $ques_key => $ques_val) { ?>
                                        <div class="dashboard_full_strip_12">
                                            <div class="dashboard_md_60">
                                                <div class="dashboard_edit_icon"><img src="<?php echo base_url();?>assets/images/dashboard_edit_icon.png"/></div>
                                                <div class="dashboard_edit_icon_txt"><?=$ques_val->question?></div>
                                            </div>
                                            <?php $question_responses		=	$this->dashboard_mod->get_question_response($ques_val->id); 
							
								       if($question_responses){
									$f_happy = 0;$f_unhappy = 0;$f_neutral = 0;
									foreach($question_responses as $rd_key => $rd_val)
									{
										if($rd_val->answer == 'happy')
										{
											$f_happy  =   $f_happy+1;
										}else if($rd_val->answer == 'unhappy'){
											$f_unhappy  =   $f_unhappy+1;
										}else if($rd_val->answer == 'neutral'){
											$f_neutral  =   $f_neutral+1;
										}
									}
									$f_happy             =   round(($f_happy*100)/count($question_responses));
									$f_unhappy           =   round(($f_unhappy*100)/count($question_responses));
									$f_neutral           =   round(($f_neutral*100)/count($question_responses));
									//$total_response    	 =   count($question_responses);
								}else{
									$f_happy             	=   0;
									$f_unhappy           	=   0;
									$f_neutral      		=   0;
									// $total_response    	=   0;
								}
								 $totalper = $f_happy+$f_unhappy+$f_neutral;
								
								if($totalper ==101){$f_neutral = $f_neutral-1;}
								if($totalper ==99){$f_neutral = $f_neutral+1;}
							?>
                                            <div class="dashboard_md_40">
                                                <div class="dashboard_avtart_main">
                                                    <div class="text-center"><img src="<?php echo base_url();?>assets/images/dashboard_green_curv.png"/></div>
                                                    <div class="dashboard_avtar_green_txt"><?=$f_happy?>%</div>
                                                </div>
                                                <div class="dashboard_avtart_main">
                                                    <div class="text-center"><img src="<?php echo base_url();?>assets/images/dashboard_yellow_curv.png"/></div>
                                                    <div class="dashboard_avtar_yellow_txt"><?=$f_neutral?>%</div>
                                                </div>
                                                <div class="dashboard_avtart_main">
                                                    <div class="text-center"><img src="<?php echo base_url();?>assets/images/dashboard_red_curv.png"/></div>
                                                    <div class="dashboard_avtar_red_txt"><?=$f_unhappy?>%</div>
                                                </div>
                                            </div>
                                        </div>
									 <?php } ?>
                                        <div class="dashboard_full_strip">
                                            <div class="dashboard_md_50">
                                                <div class="dashboard_avtart_main">
                                                    <div class="dashboard-avtar-img">
                                                        <img src="<?php echo base_url();?>assets/images/dashboard_avtar_green.png"/>
                                                    </div>
                                                    <div class="dashboard_avtar_green_txt"><?=$happy_p?>%</div>
                                                </div>
                                                <div class="dashboard_avtart_main">
                                                     <div class="dashboard-avtar-img">
                                                         <img src="<?php echo base_url();?>assets/images/dashboard_avtar_yellow.png"/>
                                                     </div>
                                                      <div class="dashboard_avtar_yellow_txt"><?=$neutral_p?>%</div>
                                                </div>
                                                <div class="dashboard_avtart_main">
                                                     <div class="dashboard-avtar-img">
                                                         <img src="<?php echo base_url();?>assets/images/dashboard_avtar_red.png"/>
                                                     </div>
                                                      <div class="dashboard_avtar_red_txt"><?=$unhappy_p?>%</div>
                                                </div>
                                            </div>
                                              
                                            <div class="dashboard_md_50">
                                                <div class="dashboard_totalresponses_main1">
                                                    <div class="dashboard_totalresponsesgreybox">
                                                        <strong>Total Responses</strong>
                                                        <span><?=$total_response?></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
								<?php }} ?>
                                    

                                </div>
                            </div> <!-- End Slider -->

                            
                            
                        </div>
            </div>
        </div>  
    </div>
    <!--Row-3-End-->
    </div>
	<script src="<?=base_url()?>assets/js/jquery.diyslider.js"></script> 