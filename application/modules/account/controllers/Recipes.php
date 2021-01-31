<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Recipes extends CI_Controller {
    /**
     *  Demo Controller
     *
     * @package		My Account
     * @category    Recipes
     * @author		Dharmendra Pal
     * @website		http://www.thealternativeaccount.com
     * @company     thealternativeaccount Inc
     * @since		Version 1.0
     */

    /**
     * Constructor
     */
    function __construct() {
        parent::__construct(); 
        $this->load->model('Recipes_mod');	
        $this->load->library('upload');
        $this->load->library('image_lib');
			is_userprotected();
    }

    /* End of constructor */

    /**
     * index
     *
     * This function display recipes list
     * 
     * @access	public
     * @return	html data
     */
    public function index() {//pr($_GET);
      
	$data['recipes_list'] = "";
        
        $data['breadcum'] = array("site/" => 'Home', '' => 'Recipe List');
        $data['page'] = 'account/recipes_list';
        $data['title'] = 'Track (The Rest Accounting Key) || Recipes';
        $this->load->view('landing_layout', $data);		
    }
    
    
    
    /**
     * recipes listing
     *
     * This function display recipes list
     * 
     * @access	public
     * @return	html data
     */

    public function recipes_list_ajax(){

        if (!empty($this->input->post('selected'))) {
            $selected = (array)$this->input->post('selected');
        } else {
            $selected = array();
        }

         $filter = array_merge($_POST, $_GET);
		//pr($_POST);die;
        $resdata = $this->Recipes_mod->recipes_list_ajax($filter);       
        if ($resdata['status'] == 'success') {
            $result = $resdata['result'];
            // pr($result);die;
            $totalData = $resdata['totalData'];
            $totalFiltered = $resdata['totalFiltered'];
            $i = 1;
            if (isset($filter['start']) && $filter['start'] != '') {
                $cno = @$filter['start'] + 1;
            } else {
                $cno = 1;
            }
            foreach ($result as $obj) {
                $nestedData = array();
                $id_encoded = ID_encode($obj->id);
                $row    =   $obj->id;
                //recipe_data
                if($obj->recipe_data!=''){
                    $recipe_data    =   json_decode($obj->recipe_data);
                    $obj->name        =   $recipe_data->name;
                    $obj->is_approve        =   $recipe_data->is_approve;
                }
                $nestedData[] = $obj->id;
                if (in_array($obj->id, $selected)) {
                    $nestedData[] = '<input type="checkbox" name="selected[]" class="checkboxes" value="'.$obj->id.'" checked="checked"/>';
                    }else{
                        $nestedData[] = '<input type="checkbox" name="selected[]" class="checkboxes" value="'.$obj->id.'"/>';
                    }
                $nestedData[] = $cno;
                $nestedData[] = $obj->name;
                $nestedData[] = $obj->likes;
                $nestedData[] = $obj->comments;
               // $nestedData[] = date("F d,Y",strtotime($obj->created_date));
				if(!empty($obj->avg_rating)){
					$nestedData[] = '<i class="fa fa-star orange" aria-hidden="true"></i> '.round($obj->avg_rating,1);
				}else{
					$nestedData[] = '0';
                }

                 if ($obj->is_approve == 'approve') {
                    $recipe_status = 'Published';
                } else if ($obj->is_approve == 'disapprove') {
                    $recipe_status = 'Rejected by Admin';
                } else {
                    $recipe_status = 'Pending for Approval';
                }

                //$nestedData[] = $obj->status;
				$nestedData[] = $obj->recipes_follower;
                $nestedData[] = $recipe_status;
                $str_action="";
                $str_action.="<a href='".base_url()."account/recipes/edit/".$id_encoded." '>Edit</a>";
				if($obj->is_approve == "approve"){
				$str_action.="|<a href='".base_url()."recipes/recipes_details/".RemoveSpecialChar($obj->name)."-".$id_encoded." ' target='_blank'>View</a>"; 
                }
				//$str_action.="<a>Edit</a><a href=".base_url()."/recipes/recipes_details/".RemoveSpecialChar($obj->name)."-".$id_encoded" ">|View</a>"; 
                $nestedData[] = $str_action;
                $data[] = $nestedData;
                $i++;
                $cno++;
            }
            
            $json_data = array(
                "draw" => intval($filter['draw']),
                "recordsTotal" => intval($totalData),
                "recordsFiltered" => intval($totalFiltered),
                "data" => $data
            );
        } else {
            $json_data = array(
                "draw" => 0,
                "recordsTotal" => 0,
                "recordsFiltered" => 0,
                "data" => ''
            );
        }
        //pr($json_data);die;
        echo json_encode($json_data);
        die;
    }

    /**
     * add
     *
     * This function adds recipes
     * 
     * @access	public
     * @return	html data
     */
    
    public function add(){
        if (isPostBack()){
			$this->form_validation->set_rules('name', 'Recipe Name',  'trim|required|is_unique[fs_recipe.name]');
            $this->form_validation->set_rules('yeild', 'Yield', 'trim|required');
			$this->form_validation->set_rules('cooking_time', 'Cooking Time',  'required');
            $this->form_validation->set_rules('cooking_utensils', 'Cooking Utensils', 'trim|required');
    		$this->form_validation->set_rules('food_type', 'Food Type',  'required');
            $this->form_validation->set_rules('difficulty_level', 'Difficulty Level', 'required');
			$this->form_validation->set_rules('preffered_meal_time', 'Preffered Meal Time', 'required');
			$this->form_validation->set_rules('food_category', 'Food Category',  'required');
			
			if (empty($_FILES['image']['name']))
				{
					$this->form_validation->set_rules('image', 'Recipe Image', 'required');
				}
			if ($this->form_validation->run() == FALSE) { 
				//echo validation_errors(); die;
            } else {				
				$image='';
  		      if($_FILES["image"]["name"]){
  		        $uploadedimage=$this->tmpAjaxUploadImage(); //image upload function
                //pr($uploadedimage); die;
				if(!empty($uploadedimage['error'])){
                   set_flashdata('error',$uploadedimage['error']); 
                }else{
                $image=$uploadedimage['upload_data'];
                }
               // $image=$uploadedimage['upload_data']['file_name'];
				
  		      }
			  
			$video='';
  		      if($_FILES["video"]["name"]){
  		        $uploadedvideo=$this->tmpAjaxUploadVideo(); //video upload function
				//pr($uploadedvideo); die;
                if(!empty($uploadedvideo['error'])){
                   set_flashdata('error',$uploadedvideo['error']);  
                }
                $video=$uploadedvideo['upload_data']['file_name'];
  		      }

			
				$this->Recipes_mod->add($image,$video);
                set_flashdata('success', 'New Recipe added successfully and it is pending for Admin Approval !');
                redirect('/account/recipes');
			}  
        }
		
		$data['menu_category'] = $this->Recipes_mod->get_menu_category();
        $data['current_user']  = currentuserinfo()->first_name.' '.currentuserinfo()->last_name;
	//	pr($data['current_user']); die;
        $data['account_view'] = "";
        $data['breadcum'] = array("site/" => 'Home', 'account/recipes' => 'Recipe List',''=>'Add');
        $data['page'] = 'recipe_add';
        $data['page_title'] = 'Add Recipe';
        $data['title'] = 'Track (The Rest Accounting Key) || Add Recipe';
        $this->load->view('landing_layout', $data);
    }
    
    
    /**
     * edit
     *
     * This function edit
     * 
     * @access	public
     * @return	html data
     */

    public function edit($id = ""){

        $uri_id = $this->uri->segment(4);        
        $decode_id  = ID_decode($uri_id);
        $encoded_id =  $uri_id;
		//pr($_POST);die;
        if (isPostBack()){
			$this->form_validation->set_rules('name', 'Recipe Name',  'trim|required');
            $this->form_validation->set_rules('yeild', 'Yield', 'trim|required');
			$this->form_validation->set_rules('cooking_time', 'Cooking Time',  'required');
            $this->form_validation->set_rules('cooking_utensils', 'Cooking Utensils', 'trim|required');
    		$this->form_validation->set_rules('food_type', 'Food Type',  'required');
            $this->form_validation->set_rules('difficulty_level', 'Difficulty Level', 'required');
			$this->form_validation->set_rules('preffered_meal_time', 'Preffered Meal Time', 'required');
			$this->form_validation->set_rules('food_category', 'Food Category',  'required');
			
			
			if ($this->form_validation->run() == FALSE) { 
				//echo validation_errors(); die;
            } else {				
				$image='';
  		      if($_FILES["image"]["name"]){
  		        $uploadedimage=$this->tmpAjaxUploadImage(); //image upload function
                //pr($uploadedimage); die;
				if(!empty($uploadedimage['error'])){
                   set_flashdata('error',$uploadedimage['error']); 
                }
				$image=$uploadedimage['upload_data'];
                //$image=$uploadedimage['upload_data']['file_name'];
  		      }
			  
			$video='';
  		      if($_FILES["video"]["name"]){
  		        $uploadedvideo=$this->tmpAjaxUploadVideo(); //video upload function
                if(!empty($uploadedvideo['error'])){
                   set_flashdata('error',$uploadedvideo['error']);  
                }
                $video=$uploadedvideo['upload_data']['file_name'];
                }

				$this->Recipes_mod->edit($decode_id,$image,$video);
                set_flashdata('success', 'Recipe updated successfully and it is pending for Admin Approval !');
                redirect('/account/recipes');
			}  
        }

        $data['current_user']  = currentuserinfo()->first_name.' '.currentuserinfo()->last_name;	
        $data['result'] = $this->Recipes_mod->view($decode_id);
		//pr($data['result']['ingredients']); die;
         if($data['result']['recipe']->recipe_data!=''){
            $obj    =   json_decode($data['result']['recipe']->recipe_data);
            $data['result']['recipe']->image  =   @$obj->image;
            $data['result']['recipe']->video  =   @$obj->video;
            $data['result']['recipe']->name  =   @$obj->name;
            $data['result']['recipe']->yeild  =   @$obj->yeild;
            $data['result']['recipe']->cooking_time  =   @$obj->cooking_time;
            $data['result']['recipe']->cooking_utensils  =   @$obj->cooking_utensils;
            $data['result']['recipe']->cooking_directions  =   @$obj->cooking_directions;
            $data['result']['recipe']->food_type  =   @$obj->food_type;
            $data['result']['recipe']->difficulty_level  =   @$obj->difficulty_level;
            $data['result']['recipe']->preffered_meal_time  =   @$obj->preffered_meal_time;
            $data['result']['recipe']->food_category  =   @$obj->food_category;
            //$data['result']['recipe']->status  =   $obj->status;
            $data['result']['recipe']->is_approve   =   $obj->is_approve;
            $data['result']['recipe']->menu_category   =   @$obj->menu_category;
            
            
            /* foreach($obj->ingredient as $val){
                $ingredients[]=(object)array('ingredient'=>$val);
            }
            
            $data['result']['ingredients']          =   $ingredients; */
            
        }
        $data['account_view'] = "";
        $data['menu_category'] = $this->Recipes_mod->get_menu_category();

        $data['menu_sub_category'] = $this->Recipes_mod->get_menu_subcategory($data['result']['recipe']->menu_category);
        $data['breadcum'] = array("site/" => 'Home', 'account/recipes' => 'Recipe List',''=>'Edit');
        $data['page'] = 'recipe_edit';
        $data['page_title'] = 'Edit Recipe';
        $data['title'] = 'Track (The Rest Accounting Key) || Edit Recipe';

        $this->load->view('landing_layout', $data);
    }
    

	/*
|----------------------------------------------------------------------------
|Upload image
|----------------------------------------------------------------------------
*/ 

public function tmpAjaxUploadImage($id = null)
{
        $path = $_FILES['image']['name'];
        $ext = pathinfo($path, PATHINFO_EXTENSION);
        $name = md5(time());          
        $bfile_name = $name . "." . $ext;
        $thumb = $name . "_thumb." . $ext;            
        $_FILES['image']['name']             = $bfile_name;
        $image_path   = './uploads/recipe/';
        if(!is_dir($image_path)) 
        {
            mkdir($image_path,0777, true);
        }
        $config['min_width']  = '800';
        $config['min_height']  = '450';
        $config['upload_path']                      = $image_path;
        $config['allowed_types']                    = 'gif|jpg|png|GIF|JPG|PNG|JPEG|jpeg';
        $config['max_size'] = '5120';   
        $this->load->library('upload');
        $this->upload->initialize($config);                       
        if (!$this->upload->do_upload('image')) {                  
            $error=array('error'=>$this->upload->display_errors());
            return $error;          
        } else {
            
            $config['image_library'] = 'gd2';
            @$config['source_image'] = './uploads/recipe/'.$bfile_name;
            $config['maintain_ratio'] = '0';
            $config['create_thumb'] = true;                
            $config['width'] = 216;
            $config['height'] = 122;  
            $this->image_lib->clear(); // added this line
            $this->image_lib->initialize($config); // added this line 
            $this->image_lib->resize();

            $data=array('upload_data'=>$bfile_name);
            return $data;                
        }

}

/*
 public function tmpAjaxUploadImage($id = null)
    {
        $config['upload_path'] = './uploads/recipe/';
        $config['allowed_types'] = 'jpg|jpeg|png|gif|JPG|JPEG|PNG';
        $config['max_size'] = '1248';
        $config['encrypt_name'] = true;
        $config['remove_spaces'] = true;
        $config['overwrite'] = false;
        $this->load->library('upload');
        $this->upload->initialize($config);

        if (!$this->upload->do_upload('image'))
        {
            $error=array('error'=>$this->upload->display_errors());
            return $error;
        } else
        {
            $data=array('upload_data'=>$this->upload->data());
            return $data;
        }
    }
*/
	
	/*
|----------------------------------------------------------------------------
|Upload Video
|----------------------------------------------------------------------------
*/ 	
    public function tmpAjaxUploadVideo($id = null)
    {
        $config['upload_path'] = './uploads/recipe/';
        $config['allowed_types'] = 'mp4|avi|wmv';
        $config['max_size'] = '80000';
        $config['encrypt_name'] = true;
        $config['remove_spaces'] = true;
        $config['overwrite'] = false;
        $this->load->library('upload');
        $this->upload->initialize($config);

        if (!$this->upload->do_upload('video'))
        {
            $error=array('error'=>$this->upload->display_errors());
            return $error;
        } else
        {
            $data=array('upload_data'=>$this->upload->data());
            return $data;
        }
    }
    


    //================================= delete ======================================================		
public function delete() {				
    if ($this->input->post('recipe_ids')) {
           
        $recipe_ids = $this->input->post('recipe_ids');					                       							
            if(!empty($recipe_ids)){
            $update  = $this->Recipes_mod->deleteRecipes($recipe_ids);
                if($update){
                $res['status']   = 'success'; 
                set_flashdata('success', 'Selected Recipes deleted!');                                                                               
                } else {
                $res['status']   = 'error'; 
                    set_flashdata('success', 'Selected Recipes not deleted!');                                                                         		
                }
            } else {                                                                                    
                $res['status']   = 'error'; 
                set_flashdata('success', 'Someting went wrong!');
                //$res['msg']      = 'Someting went wrong!';                            
            }                                    
            
            echo json_encode($res);
    }
    
}

//get_menu_subcategory
//=======================================================================================		
	public function get_menu_subcategory(){
		$menu_category_id = $this->input->post('menu_category_id');
		$menu_sub_category = $this->Recipes_mod->get_menu_subcategory($menu_category_id);
			$box  = '';
			$box .= '<option value="">Select Item Subcategory</option>';
			if(!empty($menu_sub_category)){
				foreach($menu_sub_category as $key => $val)
				{
					$box .= '<option value='.$val->id.' >'.$val->name.'</option>';
				}
			}else{
				$box = '<option value="">No Data Available</option>';
			}
			echo json_encode($box);
	}
//=======================================================================================
//get_menu_subcategory


//===================================== export =============================================================

public function export(){
    $result = $this->Recipes_mod->export();
   pr($result); die;
    $filename=date('d-m-Y')."_".'recipe.xls'; 
    $header="S.No \t Recipe Name \t Likes \t Comments \t Rating \t Number of followers"; 

      foreach($result as $row){
         $data_array[] = array('Recipe Name'=>ucfirst($row->name),'Likes'=>$row->likes,'Comments'=>$row->comments,'Rating'=>round($row->avg_rating,1),'Number of followers'=>$row->recipes_follower);
      } 
       /*====================using helper function=========================*/				
 array_to_exl($header,$data_array,$filename); /*calling helper from function_helper*/	        
}


    public function verify_name(){
        $name = $_GET['name'];
        $id = $_GET['id'];
        if(isset($id) && !empty($id))
        {
            $this->db->where('id !=',$id);
        }
        $result = $this->db->get_where('fs_recipe',array('name'=>$name));
        if($result->num_rows()){
            echo "false";
        }else{
            echo "true";
        }
    }
	
}
// End of Class
