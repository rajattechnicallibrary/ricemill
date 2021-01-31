<style>


.account-btn-cancel {
    font-size: 18px;
    padding: 10px 80px;
    border-radius: 5px;
    border: none;
    color: #333333;
	margin: -2px 0px -14px 17px;
    background-color: #E5E5E5;
}

.account-btn-save{
	    margin: 3px 0px;
}
 /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
      
	  #map-container1 {        
		     margin: 30px 0px 24px 0px;
		height:250;
		
      }
	  
	  #map1 {
        width:100%;height:400px;
      }
	  
      /* Optional: Makes the sample page fill the window. */
      #description {
        font-family: Roboto;
        font-size: 15px;
        font-weight: 300;
      }

      #infowindow-content .title {
        font-weight: bold;
      }

      #infowindow-content {
        display: none;
      }

      #map1 #infowindow-content {
        display: inline;
      }

      .pac-card {
        margin: 10px 10px 0 0;
        border-radius: 2px 0 0 2px;
        box-sizing: border-box;
        -moz-box-sizing: border-box;
        outline: none;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);
        background-color: #fff;
        font-family: Roboto;
      }

      #pac-container {
        padding-bottom: 12px;
        margin-right: 12px;
      }

      .pac-controls {
        display: inline-block;
        padding: 5px 11px;
      }

      .pac-controls label {
        font-family: Roboto;
        font-size: 13px;
        font-weight: 300;
      }

      #pac-input {
        background-color: #fff;
        font-family: Roboto;
        font-size: 15px;
        font-weight: 300;
        margin-left: 12px;
        padding: 0 11px 0 13px;
        text-overflow: ellipsis;
        width: 400px;
      }

      #pac-input:focus {
        border-color: #4d90fe;
      }

      #title {
        color: #fff;
        background-color: #4d90fe;
        font-size: 25px;
        font-weight: 500;
        padding: 6px 12px;
      }
      #target {
        width: 345px;
      }
	  .radio-inline+.radio-inline {margin-left:4px}
      .img-thumbnail{width:100%}
	  
</style>

<script>
      function initAutocomplete() {
        var map1 = new google.maps.Map(document.getElementById('map1'), {
          //center: {lat: 28.7041, lng: 77.1025},
		  center: {lat: <?= (@$user_address->lattitude)?@$user_address->lattitude:'28.5355'?>, lng: <?= (@$user_address->longitude)?@$user_address->longitude:'77.3910'?>},
          zoom: 9,
          mapTypeId: 'roadmap',
		  draggable:true
        });
		
		myLatlng = {lat: <?= (@$user_address->lattitude)?@$user_address->lattitude:'28.5355'?>, lng: <?= (@$user_address->longitude)?@$user_address->longitude:'77.3910'?>};
		//myLatlng = {lat: '23.4241', lng: '53.8478'};
		console.log(myLatlng);
		
		var marker = new google.maps.Marker({
          position: myLatlng,
          map: map1,
          title: '',
		  zoom: 6,
		  draggable:true
        });
	
	  google.maps.event.addListener(marker, 'dragend', function() {
		//alert(marker.getPosition().lat());
		jQuery('#lattitude').val(marker.getPosition().lat());
		jQuery('#longitude').val(marker.getPosition().lng());
		map1.panTo(marker.getPosition()); 
	  });
  
  
        // Create the search box and link it to the UI element.
        var input = document.getElementById('pac-input');
		
        var searchBox = new google.maps.places.SearchBox(input);
		
        map1.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

        // Bias the SearchBox results towards current map1's viewport.
        map1.addListener('bounds_changed', function() {
          searchBox.setBounds(map1.getBounds());
        });

        var markers = [];
        // Listen for the event fired when the user selects a prediction and retrieve
        // more details for that place.
        searchBox.addListener('places_changed', function() {
          var places = searchBox.getPlaces();

          if (places.length == 0) {
            return;
          }
	
          // Clear out the old markers.
          markers.forEach(function(marker) {
            marker.setMap(null);
          });
          markers = [];

          // For each place, get the icon, name and location.
          var bounds = new google.maps.LatLngBounds();
		 
          places.forEach(function(place) {
            if (!place.geometry) {
              console.log("Returned place contains no geometry");
              return;
            }
			
            var icon = {
				
             // url: place.icon,
              size: new google.maps.Size(71, 71),
              origin: new google.maps.Point(0, 0),
              anchor: new google.maps.Point(17, 34),
              scaledSize: new google.maps.Size(25, 25)
            };

            // Create a marker for each place.
			//alert(place.geometry.location);
            markers.push(new google.maps.Marker({
              map: map1,
              icon: icon,
              title: place.name,
			  position: place.geometry.location,
			  draggable:true
            }));
            if (place.geometry.viewport) {
              // Only geocodes have viewport.
              bounds.union(place.geometry.viewport);
            } else {
              bounds.extend(place.geometry.location);
            }
			jQuery('#lattitude').val(place.geometry.location.lat());
			jQuery('#longitude').val(place.geometry.location.lng());
			
          });
          map1.fitBounds(bounds);
        });
		
      }

	
    </script>

<div class="my-account-section">
	<div class="container container-margin">
		<div class="row">
		<?php echo get_flashdata(); ?>
			<?php echo $this->load->view('elements/user_left_menu');?>			
			<div class="col-md-9">
				<div class="account-right-section">
					 <div class="" id="">		
						<h1>Add Address</h1>
						<div class="account-detail-form">
						  <form action="<?php echo base_url();?>account/add_address?id=<?=ID_encode(currentuserinfo()->id)?>" method="post" id="edit_address">
							<div class="add-recipe-grid-1">
								<div class="form-group margin-top20">
									<label for="" class="margin-top-25">Country  <span class="required" aria-required="true" style="color:#e02222">
									* </span></label>
								<div class="select-style form-control">
									<select name="country_id" id="country_id">
										<option value="">Select Country</option>
										<?php if(!empty($country) && is_array($country)){
											foreach($country as $key => $val){
												if($user_address->country_id == $val->id){
													$selected = 'selected="selected"';
												}else if(@$_POST['country_id']){
													$selected = 'selected="selected"';
												}else{
													 $selected= '';  
												 } 
											?>
												<option value="<?= $val->id ?>" <?php echo $selected; ?>><?= $val->name ?></option>
										<?php  } }else { ?>
										No Data Found !
									<?php }?>
										
									</select>
								</div>
								<span class="help-block" style="color:#c8202d;"><?php echo form_error('country_id'); ?></span>
								</div>

							</div>
							<div class="add-recipe-grid-1">
								<div class="form-group margin-top20">
									<label for="" class="margin-top-25">State  <span class="required" aria-required="true" style="color:#e02222">
									* </span></label>
									<div class="select-style form-control">
										<select name="state_id" id="state_id">
											<option value="">Select State</option>
											<?php if(!empty($state) && is_array($state)){
												foreach($state as $key => $val){ 
													if($user_address->state_id == $val->id){
														$selected ='selected="selected"';
													}else if(@$_POST['state_id']){
														$selected ='selected="selected"';
													}else{
														$selected ='';
													}
												?>
													<option value="<?= $val->id ?>" <?= $selected ?> ><?= $val->name ?></option>
										<?php } } else { ?>
											No Data Found !
										<?php }?>
											
										</select>
									</div>
									<span class="help-block" style="color:#c8202d;"><?php echo form_error('state_id'); ?></span>
								</div>
							</div>
							<div class="add-recipe-grid-1">
								<div class="form-group margin-top20">
									<label for="" class="margin-top-25">City  <span class="required" aria-required="true" style="color:#e02222">
									* </span></label>
									<div class="select-style form-control">
										<select name="city_id" id="city_id">
											<option value="">Select City</option>
											<?php if(!empty($city) && is_array($city)){
												foreach($city as $key => $val){ 
													if($user_address->city_id == $val->id){
														$selected ='selected="selected"';
													}else if(@$_POST['city_id']){
														$selected ='selected="selected"';
													}else{
														$selected ='';
													}
												?>
													<option value="<?= $val->id ?>" <?= $selected ?>><?= $val->name ?></option>
										<?php } } else { ?>
											No Data Found !
										<?php }?>
											
										</select>
									</div>
									<span class="help-block" style="color:#c8202d;"><?php echo form_error('city_id'); ?></span>
								</div>
							</div>
							<div class="add-recipe-grid-1">
							  <div class="form-group">
								<label for="">Address <span class="required" aria-required="true" style="color:#e02222">
									* </span></label>
								<input type="text" name="address" value="<?php echo set_value('address')?>" class="form-control" id="" placeholder="" maxlength="100"/>
							  <span class="help-block" style="color:#c8202d;"><?php echo form_error('address'); ?></span>
							  </div>
							</div>
							
							<div class="add-recipe-grid-1">
							  <div class="form-group">
								<label for="">Zipcode <span class="required" aria-required="true" style="color:#e02222">
									* </span></label>
								<input type="text" name="zipcode" value="<?php echo set_value('zipcode')?>" class="form-control numbersOnly" id="" placeholder="" maxlength="6"/>
							    <span class="help-block" style="color:#c8202d;"><?php echo form_error('zipcode'); ?></span>
							 </div>
							</div>
							
							<div class="add-recipe-grid-1">
							  <div class="form-group">
								<label for="">Landmark <span class="required" aria-required="true" style="color:#e02222">
									* </span></label>
								<input type="text" name="landmark" value="<?php echo set_value('landmark')?>" class="form-control" id="" placeholder="" maxlength="35"/>
							   <span class="help-block" style="color:#c8202d;"><?php echo form_error('landmark'); ?></span>
							  </div>
							</div>
							
							<div class="add-recipe-grid-1">
							  <div class="form-group">
								<label for="">Delivery Instructions<span class="required" aria-required="true" style="color:#e02222">
									* </span> </label>
								<input type="text" name="delivery_instruction" value="<?php echo set_value('delivery_instruction')?>" class="form-control" id="" placeholder="" maxlength="100"/>
								 <span class="help-block" style="color:#c8202d;"><?php echo form_error('delivery_instruction'); ?></span>
							 </div>
							</div>
							
							
	<!-----------------map--------------map--------map-----------------map-----------------map---------------------------------------->						
							
							 <div class="row">
								 <div class="col-md-12">
									<label>Enter Your Location <span class="required" aria-required="true" style="color:#e02222">
									* </span></label>    
									<div class="" id="map-container1">
									
										<input type="text" name="location"  placeholder="" id="pac-input" class="form-control" required />
										<span class="help-block"></span>
									<div class="" id="map1">
									</div>	
										</div>
								</div>
                            </div>
							<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCxS50H7b7SuCAsATse_C4L0x7Nccpk3TM&libraries=places&callback=initAutocomplete" async defer></script> 

                            <div class="row hide">
                                <div class="col-md-6">
                                    <div class="form-group ">
                                            <?php 
                                            if($user_address != ''){
													$lattitude = $user_address->lattitude;
                                                } else { 
													$lattitude = '28.5355';
                                                }
                                            ?>
                                        <label> Lattitude <span class="required" aria-required="true"> * </span></label>
                                        <div class="">
                                            <input type="text" name="lattitude" value="<?=(isset($_POST['lattitude']))?$_POST['lattitude']:$lattitude?>" id="lattitude" class="form-control " >
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group ">
                                            <?php 
                                            if($user_address !=''){
													$longitude = $user_address->longitude;
                                                } else {
													$longitude = 	'77.3910';
                                                }
                                            ?>
                                        <label>Longitude <span class="required" aria-required="true"> * </span></label>
                                        <div class="">
                                            <input type="text" name="longitude" value="<?=(isset($_POST['longitude']))?$_POST['longitude']:$longitude?>" id="longitude" class="form-control " placeholder="">
                                        </div>
                                    </div>
                                </div>
                            </div>
<!-----------------map--------------map--------map-----------------map-----------------map---------------------------------------->													
							
							<div class="text-center margin_top_btm_20 col-md-12" > <!--style="float: left;padding-left:10px; width:100%;"--> 
								<button type="submit" class="account-btn-save">Save</button>
							    <button type="button" class="account-btn-cancel cancel-button" >Cancel</button>
							</div>
							
						  </form>
						</div>
                    </div>  
				</div>
			</div>
		</div>
	</div>

</div>

<script src="http://localhost/myfoodstall/assets/global/plugins/jquery-validation/js/jquery.validate.min.js" type="text/javascript"></script>
<script type="text/javascript">
$(document).ready(function() {
	
    $(".numbersOnly").keypress(function(key) {
		
        if(key.charCode < 48 || key.charCode > 57) return false;
    });
});
</script>
<script>


$('.cancel-button').on('click',function(){
	url = '<?php echo base_url() ?>account/addresses';
	location = url;
});

	$('#country_id').on('change',function(){
		var country_id = $(this).val();
		$.ajax({
			type:'POST',
			url:'<?php echo base_url() ?>account/get_state',
			data:{country_id:country_id},
			success:function(data){
				data = JSON.parse(data);
				$('#state_id').html(data);
			}
		});
	});
	
	$('#state_id').on('change',function(){
		var state_id = $(this).val();
		$.ajax({
			type:'POST',
			url:'<?php echo base_url() ?>account/get_city',
			data:{state_id:state_id},
			success:function(data){
				data = JSON.parse(data);
				$('#city_id').html(data);
			}
		});
	});
	
	$("#edit_address").validate({
	rules: {
		country_id:{
			required:true,
		},
		state_id:{
			required:true,
		},
		city_id:{
			required:true,
		},
		address:{
			required:true,
		},
		zipcode:{
			required:true,
		},
		landmark:{
			required:true,
		},
		delivery_instruction:{
			required:true,
		},
	},       	              
	messages: {
		country_id: {
			required: '<span class="help-block margin-top10" style="color:#c8202d;">Country is required ! </span>',
		},
		state_id: {
			required: '<span class="help-block margin-top10" style="color:#c8202d;">State is required ! </span>',
		},
		city_id: {
			required: '<span class="help-block margin-top10" style="color:#c8202d;">City is required ! </span>',
		},          
		address: {
			required:'<span class="help-block" style="color:#c8202d;">Address is required !</span>'
		},
		zipcode: {
			required:'<span class="help-block" style="color:#c8202d;">Zipcode is required !</span>'
		},
		landmark: {
			required:'<span class="help-block" style="color:#c8202d;">Landmark is required !</span>'
		},
		delivery_instruction: {
			required:'<span class="help-block" style="color:#c8202d;">Delivery Instruction is required !</span>'
		},
	}
});

</script>

