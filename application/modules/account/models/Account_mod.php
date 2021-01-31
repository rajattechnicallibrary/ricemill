<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * City Model 
 *
 * @package		Masters
 * @subpackage	Models
 * @category	Masters
 * @author      Dharmendra Pal
 * @website		http://www.thealternativeaccount.com
 * @company     thealternativeaccount Inc
 * @since		Version 1.0
 */
class Account_mod extends CI_Model {
    /**
     * Constructor
     */
    function __construct() {
        parent::__construct();
    }
	
/*
|--------------------------------------------------------------------------
|my_account_view My Account page
|--------------------------------------------------------------------------
*/		
	public function my_account_view() {
	   $id = currentuserinfo()->id;
       $this->db->select('u.*,ud.address,ud.country as country_id,ud.state as state_id, ud.city as city_id');
	   $this->db->from('fs_users as u');
	   $this->db->join('fs_users_details as ud','u.id = ud.user_id','left');
	   $this->db->where('u.id',$id);
	   $query = $this->db->get();
	   if($query->num_rows()>0){
		   return $query->row();
	   } return false;
    }
	

    function edit($userfile) {
		$id = currentuserinfo()->id;
		if($userfile)
		{
	    $data['profile_image']       = $userfile;
		}
		$data['first_name']          = $this->input->post('first_name');
		$data['last_name']           = $this->input->post('last_name');
		$data['subscribe']           = $this->input->post('subscribe');        
        $this->db->where('id', $id);
        $this->db->update('fs_users', $data);
		
		
	   $new_data['country']   = $this->input->post('country');
	   $new_data['state']     = $this->input->post('state');
	   $new_data['city']      = $this->input->post('city');
	   $new_data['address']   = $this->input->post('address');
	   
	   $this->db->where('user_id',$id);
	   $update = $this->db->update('fs_users_details',$new_data);
		
		
		
		
		//echo $this->db->last_query();die;
        if($update){
            return true;          
        } else{
            return false; 
        }        
    }

/*
|--------------------------------------------------------------------------
|End of my_account_view My Account page
|--------------------------------------------------------------------------
*/

/*
|--------------------------------------------------------------------------
|change_passowrd page
|--------------------------------------------------------------------------
*/	
	function change_passowrd() {
		 
		$old_passowrd = md5($this->input->post('old_passowrd'));
		$new_passowrd = md5($this->input->post('new_passowrd'));
        $confirm_new_password = $this->input->post('confirm_new_password');
		$id = currentuserinfo()->id;
		
		$this->db->select('password');
		$this->db->where('id',$id);
		$query = $this->db->get('fs_users');
		$old_created_password = $query->row()->password;
		//pr($old_created_password);
		
		//pr($old_passowrd);
		//die;
		if($old_passowrd == $old_created_password){
			$this->db->set('password', $new_passowrd);
            $this->db->where('id', $id);
            $this->db->update('fs_users');
			//echo $this->db->last_query();die;
            $data["status"] = "success";
		}else{
			$data["status"] = "error";
			$data["error_msg"] = "Current Password Does not matched !";
		}
		return $data;
    }
	
/*
|--------------------------------------------------------------------------
|End of change_passowrd password
|--------------------------------------------------------------------------
*/	
	

/*
|--------------------------------------------------------------------------
|get_my_details my story Page
|--------------------------------------------------------------------------
*/
	public function get_my_details() {
		$id = currentuserinfo()->id;
        $this->db->select('*');
		$this->db->from('fs_users_details');
        $this->db->where('user_id',$id);
        $query = $this->db->get();
		if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return false;
        }
    }
   
   function edit_my_story(){
		$id = currentuserinfo()->id;
		$data['story_title']         = $this->input->post('story_title');
		$data['story_description']   = $this->input->post('story_description');      
        $this->db->where('user_id', $id);
        $update = $this->db->update('fs_users_details', $data);
		//echo $this->db->last_query();die;
        if($update){
            return true;          
        } else{
            return false; 
        }        
    }
/*
|--------------------------------------------------------------------------
|End of  my story Page
|--------------------------------------------------------------------------
*/	
/*
|--------------------------------------------------------------------------
|User Addresses
|--------------------------------------------------------------------------
*/
	public function user_addresses(){
		$id = currentuserinfo()->id;
		$this->db->select('*');
		$this->db->where('user_id',$id);
		$query = $this->db->get('fs_user_addresses');
		if($query->num_rows() > 0){
			return $query->result();
		}else{
			return false;
		}
	}
	
	public function delete_address($address_id,$user_id){
		$this->db->where('id',$address_id);
		$this->db->where('user_id',$user_id);
		$delete = $this->db->delete('fs_user_addresses');
		if($delete){
			$res['status'] = 'success';
		}else{
			$res['status'] = 'error';
		}
		return $res;
	}
	
	public function get_address_byId($id){
		//pr($id);die;
		$this->db->select('*');
		$this->db->where('id',$id);
		$query = $this->db->get('fs_user_addresses');
		if($query->num_rows() > 0){
			return $query->row();
		}else{
			return false;
		}
	}
	
	public function get_country(){
		$this->db->select('*');
		$this->db->from('fs_country');
		$this->db->where('status','active');
		$this->db->order_by('name','asc');
		$query = $this->db->get();
		if($query->num_rows() > 0 ){
			return $query->result();
		}else{
			return false;
		}
	}
	
	
	public function get_state($id){
		$this->db->select('*');
		$this->db->from('fs_state');
		$this->db->where('status','active');
		$this->db->where('id',$id);
		$this->db->order_by('name','asc');
		$query = $this->db->get();
		if($query->num_rows() > 0 ){
			return $query->result();
		}else{
			return false;
		}
	}
	
	public function get_city($id){
		$this->db->select('*');
		$this->db->from('fs_city');
		$this->db->where('status','active');
		$this->db->where('id',$id);
		$this->db->order_by('name','asc');
		$query = $this->db->get();
		if($query->num_rows() > 0 ){
			return $query->result();
		}else{
			return false;
		}
	}
	
	public function get_state_byCountryId($country_id){
		$this->db->select('*');
		$this->db->from('fs_state');
		$this->db->where('country_id',$country_id);
		$this->db->where('status','active');
		$this->db->order_by('name','asc');
		$query = $this->db->get();
		if($query->num_rows() > 0 ){
			return $query->result();
		}else{
			return false;
		}
	}
	
	public function get_city_byStateId($state_id){
		$this->db->select('*');
		$this->db->from('fs_city');
		$this->db->where('state_id',$state_id);
		$this->db->where('status','active');
		$this->db->order_by('name','asc');
		$query = $this->db->get();
		if($query->num_rows() > 0 ){
			return $query->result();
		}else{
			return false;
		}
	}
	
	public function edit_address($id){
		//pr($_POST);die;
			$data['country_id']			  = $this->input->post('country_id');
			$data['state_id']			  = $this->input->post('state_id');
			$data['city_id'] 			  = $this->input->post('city_id');
			$data['address'] 			  = $this->input->post('address');
			$data['zipcode'] 			  = $this->input->post('zipcode');
			$data['landmark'] 			  = $this->input->post('landmark');
			$data['delivery_instruction'] = $this->input->post('delivery_instruction');
			$data['location']			  = $this->input->post('location');
			$data['lattitude'] 			  = $this->input->post('lattitude');
			$data['longitude'] 			  = $this->input->post('longitude');
		
			$this->db->where('id',$id);
			$update =$this->db->update('fs_user_addresses',$data);
			if($update){
				$res['status'] = 'success'; 
			}else{
				$res['status'] = 'error'; 
			}
		return $res;
	}
	
	

/*
|--------------------------------------------------------------------------
|End of User Addresses
|--------------------------------------------------------------------------
*/
/*
|--------------------------------------------------------------------------
|become Chef
|--------------------------------------------------------------------------
*/
    public function become_chef_add_edit(){
		
		if($this->input->post('experience_of_cooking') == 'yes'){
			$data['brief_bio']              = $this->input->post('brief_bio');
			$data['website']	            = $this->input->post('website');
			$data['cooking_expert_level']   = $this->input->post('cooking_expert_level');
			$data['work_location'] = $this->input->post('work_location');
			$cuisine = $this->input->post('cuisine_speciality');
			$data['cuisine_speciality']      = implode(',',$cuisine);
			$data['experience_of_cooking']	= $this->input->post('experience_of_cooking');
			$data['years_of_experience']    = $this->input->post('years_of_experience');
			$data['profile_type'] 	        = $this->input->post('profile_type');
			$data['user_id'] 	            = currentuserinfo()->id;
			$data['status'] 		        = 'active';
			$data['is_approve'] 		    = 'disapprove';
			$data['created_date'] 	        = date('Y-m-d H:i:s');
			
			$this->db->insert('fs_user_chef',$data);
			$res['result'] = 'inserted';
		}else {
			$upd['status'] 		          = 'active';
			$upd['is_approve'] 		      = 'disapprove';
			$upd['created_date'] 	      = date('Y-m-d H:i:s');
			$upd['user_id'] 	          = currentuserinfo()->id;
			$upd['experience_of_cooking'] = $this->input->post('experience_of_cooking');
			$this->db->insert('fs_user_chef',$upd);
			$res['result'] = 'inserted_no';
		}
		return $res;
	}
	
	public function get_become_chef(){
		$this->db->select('*');
		$this->db->from('fs_user_chef');
		//$this->db->where('status','active');
		$this->db->where('user_id',currentuserinfo()->id);
		$query = $this->db->get();
	    if($query->num_rows() > 0){
			return $query->row(); 
		}else{
			return false;
		}
	}
	
	
	
	public function get_cuisine(){
		$this->db->select('*');
		$this->db->from('fs_cuisine_category');
		$this->db->where('status','active');
		$query = $this->db->get();
		if($query->num_rows() > 0){
			return $query->result();
		}else{
			return false;
		}
	}

/*
|--------------------------------------------------------------------------
|End become Chef
|--------------------------------------------------------------------------
*/



// add address function



public function add_address($id){
		//pr($_POST);die;
			$data['user_id']			  = $id;
			$data['country_id']			  = $this->input->post('country_id');
			$data['state_id']			  = $this->input->post('state_id');
			$data['city_id'] 			  = $this->input->post('city_id');
			$data['address'] 			  = $this->input->post('address');
			$data['zipcode'] 			  = $this->input->post('zipcode');
			$data['landmark'] 			  = $this->input->post('landmark');
			$data['delivery_instruction'] = $this->input->post('delivery_instruction');
			$data['location']			  = $this->input->post('location');
			$data['lattitude'] 			  = $this->input->post('lattitude');
			$data['longitude'] 			  = $this->input->post('longitude');
		
			
			$insert =$this->db->insert('fs_user_addresses',$data);
			if($insert){
				$res['status'] = 'success'; 
			}else{
				$res['status'] = 'error'; 
			}
		return $res;
	}



	
}

// end class
?>