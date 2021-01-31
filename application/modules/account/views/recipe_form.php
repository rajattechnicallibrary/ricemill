<link href="<?php echo base_url(); ?>assets/global/css/components-rounded.css" id="style_components" rel="stylesheet" type="text/css"/>
<div class="my-account-section">
    <div class="container container-margin">
        <div class="row">
            <?php echo get_flashdata(); ?>
            <div class="container">

                <div class="add-recipe-main">
                    <h1><?= @$page_title ?></h1>
                    <div class="add-recipe-form">
                        <div class="add-recipe-grid">
                            <div class="form-group">
                                <label for="">Recipe Name <span class="required" aria-required="true"> * </span></label>
                                <div class="">
                                    <input type="text" name="name"  class="form-control" id="" placeholder="Recipe Name">
                                </div>
                                <span class="help-block"><?php echo form_error('name'); ?></span>
                            </div>
                        </div>

                        <div class="add-recipe-grid">
                            <div class="form-group">
                                <label for="">Yield <span class="required" aria-required="true"> * </span></label>
                                <div class="">
                                    <input type="text" name="yeild"  class="form-control" id="" placeholder="Yield">
                                </div>
                                <span class="help-block"><?php echo form_error('yeild'); ?></span>
                            </div>
                        </div>



                        <div class="add-recipe-grid-1">
                            <div class="form-group">
                                <label>Cooking Time <span class="required" aria-required="true">
                                        * </span></label>
                                <div class="select-style">
                                    <select name="cooking_time" id="cooking_time">
                                        <option value="">Select Cooking Time</option>
                                        <option value="1" <?= (@$_POST['cooking_time'] == '1') ? 'selected' : '' ?>>Less than 5 minutes</option>
                                        <option value="2"  <?= (@$_POST['cooking_time'] == '2') ? 'selected' : '' ?> >5 to 15 minutes</option>														
                                        <option value="3" <?= (@$_POST['cooking_time'] == '3') ? 'selected' : '' ?>>15 to 30 minutes</option>
                                        <option value="4"  <?= (@$_POST['cooking_time'] == '4') ? 'selected' : '' ?> >More than 30 minutes</option>														
                                    </select>
                                </div>
                                <span class="help-block"><?php echo form_error('cooking_time'); ?></span>
                            </div>
                        </div>

                        <div class="add-recipe-grid">
                            <div class="form-group">
                                <label>Cooking Utensils	 <span class="required" aria-required="true">* </span></label>
                                <div class="">
                                    <input type="text" name="cooking_utensils" value="" class="form-control" maxlength="35">												
                                </div>
                                <span class="help-block"><?php echo form_error('cooking_utensils'); ?></span>
                            </div>
                        </div>


                        <div class="add-recipe-grid">
                            <div class="form-group">
                                <label for="">INgredients</label>
                                <input type="text"  name="ingredient[]" id="ingredient0" class="form-control" >
                               <span class="help-block"></span>
                               
                            </div>
                        </div>

                        <div class="add-recipe-grid">
                            <div class="form-group">
                                <label for="">HOw to Cook</label>
                                <div class="">										
                                    <textarea name="cooking_directions" class="form-control ckeditor" maxlength="3000" required="" rows="2" cols="41"><?php echo set_value('cooking_directions'); ?></textarea>               
                                </div>
                            </div>
                        </div>

                        <div class="add-recipe-grid">
                            <div class="form-group">
                                <label for="">Recipe By</label>
                                <input type="text" class="form-control" id="" placeholder="BY Default user name"/>
                            </div>
                        </div>

                        <div class="add-recipe-grid">
                            <div class="form-group">
                                <label for="">Food Type</label>
                                <div class="clearfix"></div>
                                <label class="radio_label">
                                    <input type="radio" name="food_type" value="2" checked=""> <span></span>  Vegetarian
                                </label>
                                <label class="radio_label">
                                    <input type="radio" name="food_type" value="1"> <span></span> Non-Veg
                                </label>
                            </div>
                        </div>

                        <div class="add-recipe-grid">
                            <div class="form-group">
                                <label for="">Level of Difficulty</label>
                                <div class="clearfix"></div>
                                <label class="radio_label">
                                    <input type="radio" name="difficulty_level"  value="1"> <span></span>  Easy to cook
                                </label>
                                <label class="radio_label">
                                   <input type="radio" name="difficulty_level"  value="2"> <span></span> Moderately(Difficult to cook)
                                </label>
                                <label class="radio_label">
                                    <input type="radio" name="difficulty_level"  value="3"> <span></span> Need more addorts to cook
                                </label>
                            </div>
                        </div>

                        <div class="add-recipe-grid">
                            <div class="col-md-6 padding-left0">
                                <div class="form-group">
                                    <label for="">Add image</label>
                                    <div class="upload-s">
                                        <label for="file-upload" class="custom-file-upload">
                                            <i class="fa fa-cloud-upload"></i>Upload File
                                        </label>
                                        <input type="file" name="image" id="file-upload" />
                                        
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6 padding-right0">
                                <div class="form-group">
                                    <label for="">Add Video</label>
                                    <div class="upload-s">
                                        <label for="file-upload" class="custom-file-upload">
                                            <i class="fa fa-cloud-upload"></i>Upload File
                                        </label>
                                        <input id="file-upload" type="file">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="add-recipe-grid">
                            <div class="form-group">
                                <label for="">Prefered Meal Time</label>
                                <div class="clearfix"></div>
                                <label class="radio_label">
                                    <input type="radio" name="Prefered Meal Time" value="7" checked=""> <span></span>  Breakfast
                                </label>
                                <label class="radio_label">
                                    <input type="radio" name="Prefered Meal Time" value="8" > <span></span> Lunch
                                </label>
                                <label class="radio_label">
                                    <input type="radio" name="Prefered Meal Time" value="9"> <span></span> Dinner
                                </label>
                                <label class="radio_label">
                                    <input type="radio" name="Prefered Meal Time" value="10"> <span></span> Evening
                                </label>
                                <label class="radio_label">
                                    <input type="radio" name="Prefered Meal Time" value="11"> <span></span> Anytime
                                </label>
                            </div>
                        </div>

                        <div class="add-recipe-grid">
                            <div class="form-group">
                                <label for="">Prefered Meal Time</label>
                                <div class="clearfix"></div>
                                <label class="radio_label">
                                    <input type="radio" name="Prefered Meal Time1" value="7" checked=""> <span></span>  Drink 
                                </label>
                                <label class="radio_label">
                                    <input type="radio" name="Prefered Meal Time1" value="8" > <span></span> Dessert
                                </label>
                                <label class="radio_label">
                                    <input type="radio" name="Prefered Meal Time1" value="9"> <span></span> Snacks
                                </label>
                                <label class="radio_label">
                                    <input type="radio" name="Prefered Meal Time1" value="10"> <span></span> Food(main course)
                                </label>
                            </div>
                        </div>

                        <div class="add-recipe-grid-1">
                            <div class="form-group">
                                <label for="">Category</label>
                                <div class="select-style form-control">
                                    <select>
                                        <option value="01/01/2017">Spanish Cuisine</option>
                                        <option value="10/02/2017">Spanish Cuisine</option>
                                        <option value="01/01/2017">Spanish Cuisine</option>
                                        <option value="01/01/2017">Spanish Cuisine</option>
                                    </select>
                                </div>
                            </div>
                        </div>


                        <div class="add-recipe-grid-1">
                            <div class="form-group">
                                <label for="">Sub Category</label>
                                <div class="select-style form-control">
                                    <select>
                                        <option value="01/01/2017">Andalusia</option>
                                        <option value="10/02/2017">Andalusia</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="recipe-btn-main"><input type="button" name="Submit" class="recipe-submit-button" value="Submit"/></div>
                </div>
            </div> 
        </div>   
    </div>  
</div>
<script src="<?= base_url() ?>assets/ckeditor/ckeditor.js" type="text/javascript"></script>
