<div class="acount-sec">
    <div class="login-container">
        <div class="row">

            <div class="col-md-12">
                <form method="post">
                    <div class="register-form">
                    <div class="row">                                
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Business Name<span class="red">*</span><span class="greenfont"><span data-toggle="tooltip" title="Enter your business name"><i aria-hidden="true" class="fa fa-question-circle"></i></span></label>
                                <input type="text" class="form-control" id="businessname" name="businessname" value="<?= (@$_POST && $_POST['businessname']!='')?set_value('businessname'):""?>" placeholder="" maxlength="50">
                                <span class="error"><?= form_error('businessname') ?></span>
                            </div>
                        </div>
                        <div class="col-md-4">   
                            <div class="form-group">
                                <label>Business Aliases<span class="greenfont"><span data-toggle="tooltip" title="Input names and press enter key"><i aria-hidden="true" class="fa fa-question-circle"></i></span></span></label>
                                <input type="text" class="form-control" id="tokenfield" name="businessalias" value="<?= (@$_POST && $_POST['businessalias']!='')?set_value('businessalias'):""?>" placeholder="" maxlength="50">
                            </div>
                        </div>  
                        <div class="col-md-4">
                            &nbsp;
                        </div>
                    </div> 
                        
                    <div class="row">                    
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Operation in Countries<span class="red">*</span><span class="greenfont"><span data-toggle="tooltip" title="Countries where you operate."><i aria-hidden="true" class="fa fa-question-circle"></i></span></span></label>
                                <div class="btnfullwidth multiselect_icon">
                                    <select class="form-control multiselect2" multiple="multiple" id="country" name="country[]">
                                        <?php if (!empty($countries)) {
                                            foreach ($countries as $c_key => $c_val) {
                                                ?>
                                                <option value="<?= $c_val->id ?>" <?= (@$_POST && @$_POST['country']!='' && in_array($c_val->id,$_POST['country']))?"selected='selected'":""?>><?= $c_val->name ?></option>
                                            <?php }
                                        } else {
                                            ?>
                                            <option value="">No country </option>
<?php } ?>
                                    </select>
                                    <span class="error"><?= form_error('country[]') ?></span>
                                </div>


                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Industry<span class="red">*</span><span class="greenfont"><span data-toggle="tooltip" title="Primary industry of your business."><i aria-hidden="true" class="fa fa-question-circle"></i></span></span></label>
                                <div class="btnfullwidth">
                                    <select class="selectpicker" data-live-search="true" title="Select"  name="industry" id="industry_id">
                                        <!--<option value="9999" <?php //($_POST && $_POST['industry'] == '9999')?"selected='selected'":""?>>Others</option>-->
										 <option value="">Select Industry</option>
                                        <?php if (!empty($industry)) {
                                            foreach ($industry as $i_key => $i_val) {
                                                ?>
                                                <option value="<?= $i_val->id ?>" <?= ($_POST && ($i_val->id == @$_POST['industry']))?"selected='selected'":""?>><?= $i_val->name ?></option>
                                            <?php }
                                        }  ?>
                                        
                                    </select>
                                </div>
                                <style>
                                    
                                    .bootstrap-select.btn-group.show-tick .dropdown-menu li.selected a span.check-mark {
                                        position: absolute;
                                        display: inline-block;
                                        left: 4px;
                                        margin-top: 6px;
                                        font-size: 11px;
                                        color: #78c143;
                                    }
                                    .dropdown-menu>li>.selected:focus{ border:0;}
                                </style>
                                <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap-glyphicons.css" rel="stylesheet">
                            </div>
                        </div>
                        <!--<div class="col-md-4 <?php //echo (@$_POST && $_POST['industry']== '9999')?"":"hide"?>" id="spec_industry">
                            <div class="form-group">
                                <label>Specify Industry  <span class="red">*</span><span class="greenfont"></span></label>
                                <input type="text" class="form-control" name="specifyindustry" id="" placeholder="" value="<?php //echo ($_POST && @$_POST['specifyindustry']!='')?set_value('specifyindustry'):"" ?>" maxlength="50">
                                <span class="error"><?php //echo form_error('specifyindustry') ?></span>
                            </div>
                        </div>-->
                         <div class="col-md-4 ins_tag">
                            <div class="form-group">
                                <label>Industry Tags<span class="red">*</span><span class="greenfont"><span data-toggle="tooltip" title="Industry specialization."><i aria-hidden="true" class="fa fa-question-circle"></i></span></span></label>
                                <div class="btnfullwidth multiselect_icon">
                                    <?php if(@$_POST && @$_POST['industry']!=''){
                                        $structure = $this->auth_mod->fetch_industry_tags_by_id(@$_POST['industry']); ?>
                                        <select class="selectpicker form-control multiselect2" title="Select" multiple="multiple" name="industrytags[]" id="industry_tag_id">
                                            <?php if($structure){ 
                                                foreach($structure as $s_key => $s_val){ ?>
                                                    <option value="<?= $s_val->id ?>" <?= (@$_POST && @$_POST['industrytags'] && in_array($s_val->id,@$_POST['industrytags']))?"selected='selected'":"" ?> ><?= ucwords($s_val->name) ?></option>
                                                <?php }
                                            } ?>
                                        </select>
                                        
                                    <?php }else{ ?>
                                        <select class="selectpicker" title="Select" multiple="multiple" name="industrytags[]" id="industry_tag_id">
                                        </select>
                                    <?php } ?>
                                    <span class="error"><?= form_error('industrytags[]') ?></span>
                                </div>
								
								


                            </div>
                        </div>
						<!--<div class="col-md-4">
                            <div class="form-group">
                                <label>Operation in Countries<span class="red">*</span><span class="greenfont"><span data-toggle="tooltip" title="" data-original-title="Countries where you operate."><i aria-hidden="true" class="fa fa-question-circle"></i></span></span></label>
                                <div class="btnfullwidth multiselect_icon">
                                    <span class="multiselect-native-select"><select class="form-control multiselect2" multiple="multiple" id="country" name="country[]">
                                                                                        <option value="1">India</option>
                                                                                            <option value="2">America</option>
                                                                                            <option value="3">China</option>
                                                                                </select>
                                    <span class="error"></span>
                                </div>


                            </div>
                        </div>-->
                        
                    </div>


                   


                    <div class="row">
                        <div class="h-divider"></div>
                    </div>


                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Authorised Person<span class="red">*</span><span class="greenfont"><span data-toggle="tooltip" title="Person authorised to be an administrator."><i aria-hidden="true" class="fa fa-question-circle"></i></span></span></label>
                                <input type="text" name="authorisedperson" class="form-control" id="authorisedperson" value="<?= ($_POST && @$_POST['authorisedperson']!='')?set_value('authorisedperson'):"" ?>" placeholder="" maxlength="35">
                                <span class="error"><?= form_error('authorisedperson') ?></span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            &nbsp;
                        </div>
                        <div class="col-md-4">
                            &nbsp;
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Email<span class="red">*</span></label>
                                <input type="text" name="email" class="form-control" value="<?= ($_POST && @$_POST['email']!='')?set_value('email'):"" ?>" id="email" placeholder="" maxlength="50">
                                <span class="error"><?= form_error('email') ?></span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group row">
                                <div class="col-md-12"> <label>Phone <span class="red">*</span></label></div>                                        
                                <div class="col-md-2 padding-right5 input-bottomtxt">
                                    <input type="text" class="form-control" id="phonecountrycode" name="phonecountrycode" placeholder="" value="<?= ($_POST && @$_POST['phonecountrycode']!='')?set_value('phonecountrycode'):"" ?>" maxlength="3">
                                    <span class="<?= (form_error('phonecountrycode')!='')?"error":"" ?>">Country Code</span>
                                </div>
                                <div class="col-md-3 padding-right5 input-bottomtxt padding-left5">
                                    <input type="text" class="form-control" id="phoneareacode" name="phoneareacode" placeholder="" value="<?= ($_POST && @$_POST['phoneareacode']!='')?set_value('phoneareacode'):"" ?>" maxlength="5">
                                    <span class="<?= (form_error('phoneareacode')!='')?"error":"" ?>">Area Code</span>
                                </div>
                                <div class="col-md-7 padding-left5 input-bottomtxt">
                                    <input type="text" class="form-control" id="phonenumber" name="phonenumber" placeholder="" value="<?= ($_POST && @$_POST['phonenumber']!='')?set_value('phonenumber'):"" ?>" maxlength="10">
                                    <span class="<?= (form_error('phonenumber')!='')?"error":"" ?>">Phone Number</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group row">
                                <div class="col-md-12"> <label>Mobile <span class="red">*</span></label></div>                              
                                <div class="col-md-2 padding-right5 input-bottomtxt">
                                    <input type="text" class="form-control" id="mobilecountrycode" name="mobilecountrycode" placeholder="" value="<?= ($_POST && @$_POST['mobilecountrycode']!='')?set_value('mobilecountrycode'):"" ?>" maxlength="3">
                                    <span class="<?= (form_error('mobilecountrycode')!='')?"error":"" ?>">Country Code</span>
                                </div>
                                <div class="col-md-10 input-bottomtxt">
                                    <input type="text" class="form-control" id="mobilenumber" name="mobilenumber" placeholder="" value="<?= ($_POST && @$_POST['mobilenumber']!='')?set_value('mobilenumber'):"" ?>" maxlength="10">
                                    <span class="<?= (form_error('mobilenumber')!='')?"error":"" ?>">Mobile Number</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="width-auto">
                           <div class="pull-left"> 
                            <div class="checkbox margin-top0">
                            <label class="remember-label">
                             <input type="checkbox" name="agree" id="test1"  value="1" <?= (set_value('agree'))?"checked='true'":""?> >
                             
                             <span class="cr i18"><i class="cr-icon fa fa-check"></i></span>
                             </label>
                            </div>
                            </div>
                              <div class="pull-left"><span class="check-margin-login">I agree to the <a target="_blank" href="<?= base_url() ?>pages/terms_n_conditions">Term & Conditions </a> and <a target="_blank" href="<?= base_url()?>pages/privacy_policy">Privacy Policy</a> </span>
                  <span class="error"><?= form_error('agree') ?></span>
                  </div>
                        
                            <!--<label class="remember-label checkagreetxt">
                                <input type="checkbox" name="agree" value="1" <//?= (set_value('agree'))?"checked='true'":""?>> I agree to the <a target="_blank" href="<//?= base_url() ?>pages/terms_n_conditions">Term & Conditions </a> and <a target="_blank" href="<//?= base_url()?>pages/privacy_policy">Privacy Policy</a> </label>
                            <span class="error"><//?= form_error('agree') ?></span>-->
                        </div>
                  
                    </div>
                    </div>

                    <div class="row">
                        <div class="col-md-3"><input type="submit" class="submit" value="Register"></div>
                    </div>

                </div>
                </form>
            </div>
        </div>
    </div>



<script>
    $(document).on('change',"select[name='industry']",function(){
        if($(this).val() == '9999')
        {
            $("#spec_industry").removeClass('hide');
            $('.ins_tag').addClass('cl');
        }else if($(this).val() != '9999')
        {
            $("#spec_industry").addClass('hide');
            $('.ins_tag').removeClass('cl');
        }
    });
</script>   

<script>
  $(document).ready(function () {
    var mySelect = $('#first-disabled2');

    $('#special').on('click', function () {
      mySelect.find('option:selected').prop('disabled', true);
      mySelect.selectpicker('refresh');
    });

    $('#special2').on('click', function () {
      mySelect.find('option:disabled').prop('disabled', false);
      mySelect.selectpicker('refresh');
    });

    $('#basic2').selectpicker({
      liveSearch: true,
      maxOptions: 1
    });
  });
  $(function(){
    $(".multiselect-container li a input").addClass("sdfsgsfg");
    
  });
  $(document).on('change','.multiselect-container li a input',function(){
      if($(this).prop('checked')==true)
      {
          $(this).parents().eq(0).css('color','#fff');
      }else if($(this).prop('checked')==false)
      {
          $(this).parents().eq(0).css('color','#777');
      }
  });
</script> 

<link href="http://sliptree.github.io/bootstrap-tokenfield/dist/css/bootstrap-tokenfield.css" type="text/css" rel="stylesheet">
<link href="http://sliptree.github.io/bootstrap-tokenfield/dist/css/tokenfield-typeahead.css" type="text/css" rel="stylesheet">
 <script type="text/javascript" src="http://sliptree.github.io/bootstrap-tokenfield/dist/bootstrap-tokenfield.js" charset="UTF-8"></script>
<script>
$('#tokenfield').tokenfield({
  autocomplete: {
    source: ['red','blue','green','yellow','violet','brown','purple','black','white'],
    delay: 100
  },
  showAutocompleteOnFocus: true
})
</script> 
<script>
$(document).ready(function(){
    $('#industry_id').on('change',function(){
        var countryID = $(this).val();       
        if(countryID){
            $.ajax({
                type:'POST',
		dataType: "HTML",
                url:'<?php echo base_url();?>auth/get_industry_tag',
                data:'country_id='+countryID,
                success:function(data){
                                //console.log(data);
                                $('#industry_tag_id').html('');        
				$('#industry_tag_id').html(data).selectpicker("refresh");					
                }
            }); 
        }
    });
    
});
</script>