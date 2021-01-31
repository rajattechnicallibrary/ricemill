<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * City Model 
 *
 * @package     Recipes
 * @subpackage	Models
 * @category	Recipes
 * @author      Dharmendra Pal
 * @website     http://www.thealternativeaccount.com
 * @company     thealternativeaccount Inc
 * @since		Version 1.0
 */
class Recipes_mod extends CI_Model {
    /**
     * Constructor
     */
    function __construct() {
        parent::__construct();
    }

	 /**
     * add
     *
     * this function is used to add recipes by user
     * @access	public
     * @return array
     */
	
	public function add($image,$video){
		//pr($_POST);die;
		$userid=currentuserinfo()->id;
        if($_POST){            
            $data['name']            	 = $_POST['name'];
			$data['menu_category']        = $_POST['menu_category'];
            $data['menu_sub_category']    = $_POST['menu_sub_category'];
			$data['user_id']             = $userid;
            $data['yeild']      		 = $_POST['yeild'];
			$data['cooking_time']        = $_POST['cooking_time'];
            $data['cooking_utensils']    = $_POST['cooking_utensils'];
			$data['cooking_directions']  = $_POST['cooking_directions'];
            $data['food_type']      	 = $_POST['food_type'];
			$data['difficulty_level']    = $_POST['difficulty_level'];
            $data['image']     			 = $image;
			$data['video']         	     = $video;
            $data['preffered_meal_time'] = $_POST['preffered_meal_time'];
			$data['food_category']       = $_POST['food_category'];
			$data['status']        		 = 'inactive';   
			$data['is_approve']          = 'pending';		
			$data['created_date']	   	 = date('Y-m-d H:i:s');			
           
         //  pr($data); die;
            $this->db->insert("fs_recipe", $data);
			/*insert multiple ingredients */
			$last_id = $this->db->insert_id();
			for ($ix=0; $ix<count($_POST['ingredient']); $ix++)
				{
					$insert_data = array(
						'ingredient' => $_POST['ingredient'][$ix],
						'created_date' => date('Y-m-d H:i:s'),
						'recipe_id'    => $last_id
					);
					$insert = $this->db->insert('fs_recipe_ingredients', $insert_data);
				}
			/*insert multiple ingredients */	
            return true;        
        } else{
            return false;      
        }		
	}
    
    


/*
|----------------------------------------------------------------------------
|Edit recipe 
|----------------------------------------------------------------------------
*/	   
function edit($id,$image,$video) 
{ 
    //pr($_POST);die;
    if($image){
      $data['image']=$image;   
      }else{
        $data['image'] = $this->input->post('old_image');
      }
      if($video){
      $data['video']=$video;   
      }else{
        $data['video']=$this->input->post('old_video');
      }
    $data['name']                = $this->input->post('name');
    $data['yeild']               = $this->input->post('yeild');
    $data['cooking_time']        = $this->input->post('cooking_time');
    $data['cooking_utensils']    = $this->input->post('cooking_utensils');
    $data['cooking_directions']  = $this->input->post('cooking_directions');
	$data['menu_category']     = $this->input->post('menu_category');  
    $data['menu_sub_category'] = $this->input->post('menu_sub_category');
    $data['food_type']           = $this->input->post('food_type');
    $data['difficulty_level']    = $this->input->post('difficulty_level');
    $data['preffered_meal_time'] = $this->input->post('preffered_meal_time');
    $data['food_category']       = $this->input->post('food_category');
    $data['status']        		 = 'inactive';
	$data['is_approve']          = 'pending';
    $dataup['recipe_data']		 = json_encode($data);
    $this->db->where('id',$id);
    $update = $this->db->update('fs_recipe', $dataup);
    
    /*if(is_array($_POST['ingredient']) && !empty($_POST['ingredient'])){
    $this->db->where('recipe_id',$id);
    $this->db->delete('fs_recipe_ingredients');
    foreach($_POST['ingredient'] as $key => $value)
            {
                $insert_data = array(
                    'ingredient' => $_POST['ingredient'][$key],
                    'created_date' => date('Y-m-d H:i:s'),
                    'recipe_id' => $id,
                );
                $insert = $this->db->insert('fs_recipe_ingredients', $insert_data);
            }
			
        }*/
		
}


// add menu category in recipes

 public function get_menu_category(){
		$this->db->select('id,parent,name,status');
		$this->db->from('fs_menu_category');
		$this->db->where('status','active');
		$this->db->where('parent','0');
		$this->db->order_by('name','asc');
		$query = $this->db->get();
		if($query->num_rows() > 0){
			return $query->result();
		}else{
			return false;
		}
	}
	// add menu sub category in recipes
	
	public function get_menu_subcategory($menu_category_id){
		//pr($menu_category_id);die;
		if($menu_category_id){
		$this->db->select('id,parent,name,status');
		$this->db->where('status','active');
		$this->db->where('parent',$menu_category_id);
		$query = $this->db->get('fs_menu_category');
		return $query->result();
		}else{
			return false;
		}
	}



    /*
    |----------------------------------------------------------------------------
    |Check Pre existance recipe name
    |----------------------------------------------------------------------------
    */
    function check_preexistance($id, $name) {
        $this->db->select('*');
        $this->db->where('id !=', $id);
        $this->db->where('name ', $name);
        $query = $this->db->get('fs_recipe');        
        return $query->num_rows();        
    }

    
        /*
    |----------------------------------------------------------------------------
    |View by Id 
    |----------------------------------------------------------------------------
    */
    function view($id) {        
        $this->db->select('*');
        $this->db->from('fs_recipe');
        $this->db->where('id', $id);
		 
        $query = $this->db->get(); 
		//echo $this->db->last_query();die;
        $res['recipe'] = $query->row();
        
        $this->db->select('ingredient,recipe_id,id as ingredients_id');
        $this->db->where('recipe_id', $id);
        $res['ingredients'] = $this->db->get("fs_recipe_ingredients")->result();
        return $res;
    }


     /**
     * seller_list_ajax
     *
     * this function update user profile info by user id
     * @access	public
     * @return array
     */
    function recipes_list_ajax($filter){
		$id = currentuserinfo()->id;
        $this->db->select("SQL_CALC_FOUND_ROWS r.id,r.user_id,r.name,r.created_date,r.status,r.recipe_data,r.is_approve,
						(select COUNT(*) from fs_recipe_likes as rl where rl.recipe_id = r.id)as likes,
							(select COUNT(*) from fs_recipe_comments as rc where rc.recipe_id = r.id) as comments,
							(select AVG(frc.rating)from fs_recipe_comments as frc where frc.recipe_id= r.id) as avg_rating,
							(select count(*) from fs_recipe_follow as rf where rf.recipe_id = r.id) as recipes_follower", false);
        
        $columns = array('u.id','u.id','u.name','u.id','u.id','u.id','u.status','u.status');
        if(isset($filter['search']['value']) && $filter['search']['value']!=''){
            $search_keyboard    =   $filter['search']['value'];
            $search_keyboard=strtolower($search_keyboard);
            $this->db->where("(r.name  LIKE '%$search_keyboard%')");
        }
        
        //if(isset($filter['order'][0]['column']) &&  $filter['order'][0]['column']!='' && isset($filter['order'][0]['dir']) && $filter['order'][0]['dir']!='' && isset($filter['length']) && $filter['length']!='' && isset($filter['start']) && $filter['start']!=''){
           // $this->db->order_by($columns[$filter['order'][0]['column']], $filter['order'][0]['dir']);
            if ($filter['length'] != '-1') {  // for showing all records
                $this->db->limit($filter['length'], $filter['start']);
            }
        //}
        
           if(isset($filter['food_category']) && $filter['food_category']!=''){
               $this->db->where("r.food_category",$filter['food_category']);
           }
           
           if(isset($filter['food_type']) && $filter['food_type']!=''){
               $this->db->where("r.food_type",$filter['food_type']);
           } 
           
           if(isset($filter['start_date']) && $filter['start_date']!='' && isset($filter['end_date']) && $filter['end_date']!=''){
               $start_date  =   str_replace("/","-",$filter['start_date']);
               $end_date    =   str_replace("/","-",$filter['end_date']);
               $start_date1=date('Y-m-d',strtotime($start_date)).' 00:00:00';
               $end_date1=date('Y-m-d',strtotime($end_date)).' 23:59:59';
               $this->db->where("(created_date>='$start_date1' AND created_date<='$end_date1')");
           } 

				 $this->db->where("r.status !=",'delete');
			     $this->db->where("r.user_id", $id);
				 $this->db->order_by("r.id", 'desc');
        $query = $this->db->get("fs_recipe as r");
	//echo $this->db->last_query();die;
        if ($query->num_rows() > 0) {
            
                $res['result']=$query->result();
                $total_record           =   $this->db->query('SELECT FOUND_ROWS() AS count');
                $res['totalData']       =   $total_record->row()->count;
                $res['totalFiltered']   =   $total_record->row()->count; 
                $res['status']="success";            
            //---------------------- 
        } else {

            $res['result']          =   '';
            $res['totalData']       =   0;  
            $res['totalFiltered']       =   0; 
            $res['status']          =   "error";
        }
        return $res;
    }
/* deleteRecipes */

    function deleteRecipes($recipe_ids) {	
		$recipe_ids = explode(',',$recipe_ids);		
        $data['status'] = 'delete';
        $this->db->where_in('id',$recipe_ids);
        $this->db->update('fs_recipe', $data);		
		$update = $this->db->affected_rows();
		if($update){
			return $update;
		} else {
			return false;
		}
    }


   /* |--------------------------------------------------------------------------
    |Export
    |--------------------------------------------------------------------------
    */	
        public function export(){
            $ids = $this->input->get('recipes_ids');
            $ids = explode(',',$ids);
        $this->db->select("r.id,r.user_id,r.name,r.created_date,r.status,r.recipe_data,r.is_approve,
						(select COUNT(*) from fs_recipe_likes as rl where rl.recipe_id = r.id)as likes,
							(select COUNT(*) from fs_recipe_comments as rc where rc.recipe_id = r.id) as comments,
							(select AVG(frc.rating)from fs_recipe_comments as frc where frc.recipe_id= r.id) as avg_rating,
							(select count(*) from fs_recipe_follow as rf where rf.recipe_id = r.id) as recipes_follower");
            $this->db->from('fs_recipe as r');
            $this->db->where_in('r.id',$ids);
            $this->db->order_by('r.id','desc');
            $query = $this->db->get();
            return $query->result();
        }




	

}

?>