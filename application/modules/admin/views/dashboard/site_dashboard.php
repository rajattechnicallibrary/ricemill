<main class="main-content bgc-grey-100">
               <div id="mainContent">
			   <?=get_flashdata();?>
			          <h4 class="c-grey-900 mT-10 mB-30">Dashboard</h4>
                  <div class="row gap-20 masonry pos-r">
                     <div class="masonry-sizer col-md-6"></div>
                     <div class="masonry-item w-100">
                        <div class="row gap-20">
                           <div class="col-md-3 text-center">
                              <a href="Javascript:void(0)">
                                    <div class="layers bd bgc-white p-20">
                              
                                    <div class="layer w-100 mB-20">
                                    
                                          <h6 class="lh-1">Top Purchaser</h6>

                                    </div>
                                    <div class="layer w-100">
                                          <div class="peers ai-sb fxw-nw">
                                          <!--<div class="peer peer-greed"><span id="sparklinedash3"></span></div>-->
                                          <div class="peer"><span class="d-ib lh-0 va-m fw-600 bdrs-10em pX-15 pY-15 bgc-purple-50 c-purple-500"><?php echo @$maxpurchaser->maxpurchaser; ?></span></div>
                                          </div>
                                    </div>
                                    </div>
                              </a>
                           </div>
                           <div class=" col-md-3 text-center">
                           <a href="Javascript:void(0)">
                              <div class="layers bd bgc-white p-20">
                                 <div class="layer w-100 mB-20">
                                    <h6 class="lh-1">Total Paddy Purchase (qtl)</h6>
                                 </div>
                                 <div class="layer w-100">
                                    <div class="peers ai-sb fxw-nw">
                                       <!--<div class="peer peer-greed"><span id="sparklinedash4"></span></div>-->
                                       <div class="peer"><span class="d-ib lh-0 va-m fw-600 bdrs-10em pX-15 pY-15 bgc-blue-50 c-blue-500"><?php echo round($total_weight->FinalWeight); ?></span></div>
                                    </div>
                                 </div>
                              </div>
                        </a>
                           </div>
                           <div class="col-md-3 text-center">
                              <div class="layers bd bgc-white p-20">
                                 <div class="layer w-100 mB-20">
                                    <h6 class="lh-1">Total Paddy Purchase Amount (Rs)</h6>
                                 </div>
                                 <div class="layer w-100">
                                    <div class="peers ai-sb fxw-nw">
                                       <!--<div class="peer peer-greed"><span id="sparklinedash3"></span></div>-->
                                       <div class="peer"><span class="d-ib lh-0 va-m fw-600 bdrs-10em pX-15 pY-15 bgc-green-50 c-green-500"><?php echo  round($FinalAmountPaddy->FinalAmountPaddy);?></span></div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <div class=" col-md-3 text-center">
                              <div class="layers bd bgc-white p-20">
                                 <div class="layer w-100 mB-20">
                                    <h6 class="lh-1">Total Katti</h6>
                                 </div>
                                 <div class="layer w-100">
                                    <div class="peers ai-sb fxw-nw">
                                       <!--<div class="peer peer-greed"><span id="sparklinedash4"></span></div>-->
                                       <div class="peer"><span class="d-ib lh-0 va-m fw-600 bdrs-10em pX-15 pY-15 bgc-red-50 c-red-500"><?php echo round($TotalKatti->TotalKatti); ?></span></div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           
						   <div class="masonry-item col-md-6 hide">
							<div class="bgc-white p-20 bd">
							<p class="my_count">Count</p>
								<h5 class="c-grey-900">Total Monthly Income</h5>
								<div class="mT-30">
									<canvas id="bar-chart" height="220"></canvas>
								</div>
							</div>
							</div>
							<div class="masonry-item col-md-6 hide">
							<div class="bgc-white p-20 bd">
								<h5 class="c-grey-900">Total Campaigns</h5>
								<div class="mT-30">
								<p class="my_count">Count</p>
									<canvas id="bar-chart_1" height="220"></canvas>
								</div>
							</div>
							</div>
                        </div>
                     </div>
                  </div>
               </div>
               <div id="mainContent">
                  <div class="row gap-20 masonry pos-r">
                     <div class="masonry-sizer col-md-6"></div>
                     <div class="masonry-item w-100">
                        <div class="row gap-20">
                           <div class="col-md-3 text-center">
                              <a href="Javascript:void(0)">
                                    <div class="layers bd bgc-white p-20">
                              
                                    <div class="layer w-100 mB-20">
                                    
                                          <h6 class="lh-1">Center I (qtl)</h6>

                                    </div>
                                    <div class="layer w-100">
                                          <div class="peers ai-sb fxw-nw">
                                          <!--<div class="peer peer-greed"><span id="sparklinedash3"></span></div>-->
                                          <div class="peer"><span class="d-ib lh-0 va-m fw-600 bdrs-10em pX-15 pY-15 bgc-purple-50 c-purple-500"><?php echo @$first->totalQuant; ?></span></div>
                                          </div>
                                    </div>
                                    </div>
                              </a>
                           </div>
                           <div class=" col-md-3 text-center">
                           <a href="Javascript:void(0)">
                              <div class="layers bd bgc-white p-20">
                                 <div class="layer w-100 mB-20">
                                    <h6 class="lh-1">Center II (qtl)</h6>
                                 </div>
                                 <div class="layer w-100">
                                    <div class="peers ai-sb fxw-nw">
                                       <!--<div class="peer peer-greed"><span id="sparklinedash4"></span></div>-->
                                       <div class="peer"><span class="d-ib lh-0 va-m fw-600 bdrs-10em pX-15 pY-15 bgc-blue-50 c-blue-500"><?php echo ($second->totalQuant); ?></span></div>
                                    </div>
                                 </div>
                              </div>
                        </a>
                           </div>
                           <div class="col-md-3 text-center">
                              <div class="layers bd bgc-white p-20">
                                 <div class="layer w-100 mB-20">
                                    <h6 class="lh-1">Jamura (qtl)</h6>
                                 </div>
                                 <div class="layer w-100">
                                    <div class="peers ai-sb fxw-nw">
                                       <!--<div class="peer peer-greed"><span id="sparklinedash3"></span></div>-->
                                       <div class="peer"><span class="d-ib lh-0 va-m fw-600 bdrs-10em pX-15 pY-15 bgc-green-50 c-green-500"><?php echo  ($jamura->totalQuant);?></span></div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <div class=" col-md-3 text-center">
                              <div class="layers bd bgc-white p-20">
                                 <div class="layer w-100 mB-20">
                                    <h6 class="lh-1">PCF (qtl)</h6>
                                 </div>
                                 <div class="layer w-100">
                                    <div class="peers ai-sb fxw-nw">
                                       <!--<div class="peer peer-greed"><span id="sparklinedash4"></span></div>-->
                                       <div class="peer"><span class="d-ib lh-0 va-m fw-600 bdrs-10em pX-15 pY-15 bgc-red-50 c-red-500"><?php echo ($pcf->totalQuant); ?></span></div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           
						   <div class="masonry-item col-md-6 hide">
							<div class="bgc-white p-20 bd">
							<p class="my_count">Count</p>
								<h5 class="c-grey-900">Total Monthly Income</h5>
								<div class="mT-30">
									<canvas id="bar-chart" height="220"></canvas>
								</div>
							</div>
							</div>
							<div class="masonry-item col-md-6 hide">
							<div class="bgc-white p-20 bd">
								<h5 class="c-grey-900">Total Campaigns</h5>
								<div class="mT-30">
								<p class="my_count">Count</p>
									<canvas id="bar-chart_1" height="220"></canvas>
								</div>
							</div>
							</div>
                        </div>
                     </div>
                  </div>
               </div>
               <div id="mainContent">
                  <div class="row gap-20 masonry pos-r">
                     <div class="masonry-sizer col-md-6"></div>
                     <div class="masonry-item w-100">
                        <div class="row gap-20">
                           <div class="col-md-3 text-center">
                              <a href="Javascript:void(0)">
                                    <div class="layers bd bgc-white p-20">
                              
                                    <div class="layer w-100 mB-20">
                                    
                                          <h6 class="lh-1">Revamuradpur (qtl)</h6>

                                    </div>
                                    <div class="layer w-100">
                                          <div class="peers ai-sb fxw-nw">
                                          <!--<div class="peer peer-greed"><span id="sparklinedash3"></span></div>-->
                                          <div class="peer"><span class="d-ib lh-0 va-m fw-600 bdrs-10em pX-15 pY-15 bgc-purple-50 c-purple-500"><?php echo @$reva->totalQuant; ?></span></div>
                                          </div>
                                    </div>
                                    </div>
                              </a>
                           </div>
                           <div class=" col-md-3 text-center">
                           <a href="Javascript:void(0)">
                              <div class="layers bd bgc-white p-20">
                                 <div class="layer w-100 mB-20">
                                    <h6 class="lh-1">UPSS (qtl)</h6>
                                 </div>
                                 <div class="layer w-100">
                                    <div class="peers ai-sb fxw-nw">
                                       <!--<div class="peer peer-greed"><span id="sparklinedash4"></span></div>-->
                                       <div class="peer"><span class="d-ib lh-0 va-m fw-600 bdrs-10em pX-15 pY-15 bgc-blue-50 c-blue-500"><?php echo ($upss->totalQuant); ?></span></div>
                                    </div>
                                 </div>
                              </div>
                        </a>
                           </div>
                           <div class="col-md-3 text-center">
                              <div class="layers bd bgc-white p-20">
                                 <div class="layer w-100 mB-20">
                                    <h6 class="lh-1"> Todharpur (qtl)</h6>
                                 </div>
                                 <div class="layer w-100">
                                    <div class="peers ai-sb fxw-nw">
                                       <!--<div class="peer peer-greed"><span id="sparklinedash3"></span></div>-->
                                       <div class="peer"><span class="d-ib lh-0 va-m fw-600 bdrs-10em pX-15 pY-15 bgc-green-50 c-green-500"><?php echo  ($todharpur->totalQuant);?></span></div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <div class=" col-md-3 text-center">
                              <div class="layers bd bgc-white p-20">
                                 <div class="layer w-100 mB-20">
                                    <h6 class="lh-1">Total Katti</h6>
                                 </div>
                                 <div class="layer w-100">
                                    <div class="peers ai-sb fxw-nw">
                                       <!--<div class="peer peer-greed"><span id="sparklinedash4"></span></div>-->
                                       <div class="peer"><span class="d-ib lh-0 va-m fw-600 bdrs-10em pX-15 pY-15 bgc-red-50 c-red-500"><?php echo round($TotalKatti->TotalKatti); ?></span></div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           
						   <div class="masonry-item col-md-6 hide">
							<div class="bgc-white p-20 bd">
							<p class="my_count">Count</p>
								<h5 class="c-grey-900">Total Monthly Income</h5>
								<div class="mT-30">
									<canvas id="bar-chart" height="220"></canvas>
								</div>
							</div>
							</div>
							<div class="masonry-item col-md-6 hide">
							<div class="bgc-white p-20 bd">
								<h5 class="c-grey-900">Total Campaigns</h5>
								<div class="mT-30">
								<p class="my_count">Count</p>
									<canvas id="bar-chart_1" height="220"></canvas>
								</div>
							</div>
							</div>
                        </div>
                     </div>
                  </div>
               </div>
            </main>
            <script>
		$(document).ready(function(){
		$("#contactInfo_next").click(function(){
			$(".info-tab-contianer:nth-child(1) p").css("border-bottom", "none");
			$(".info-tab-contianer:nth-child(2) p").css("border-bottom", "2px solid #2196f3");
			$(".alpha_num_a").hide();
			$(".alpha_num_b").show();
		});
			$("#companyInfo_back").click(function(){
				$(".info-tab-contianer:nth-child(2) p").css("border-bottom", "none");
				$(".info-tab-contianer:nth-child(1) p").css("border-bottom", "2px solid #2196f3");
				$(".alpha_num_b").hide();
				$(".alpha_num_a").show();
			});
		});
	</script>   