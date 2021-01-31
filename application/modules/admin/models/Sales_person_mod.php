<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Profile Model
 *
 * @package		Profile
 * @category            Profile
 * @author		Arvind Soni
 * @website		http://www.thealternativeaccount.com
 * @company     thealternativeaccount Inc
 * @since		Version 1.0
 */
class Sales_person_mod extends CI_Model {

    var $tbl_users          =   "kyi_users";
    //var $tbl_users_details  =   "kyi_users_details";

    /**
     * Constructor
     */
    function __construct() {
        parent::__construct();
    }
    
    
   /**
     * add
     *
     * this function update user profile info by user id
     * @access	public
     * @return array
     */
    function add(){
        $user_id                    =   currentuserinfo()->id;
        $password                   =   $_POST['sales_person_password'];
        $data['first_name']         =   $_POST['first_name'];
       
        $data['mobile_number']      =   $_POST['mobile_number'];
        $data['email']              =   $_POST['email'];
        $data['assigned_manager']          =   $_POST['assign_sales_manager'];
		
        $data['password']           =   md5($password); 
        $data['status']             =   $_POST['status']; 
       // $data['is_verify']          =   '1';
        $data['user_type']          =   '3';
		//$data['role_id']            =   '3';

        $data['added_by']           =   $user_id;
        $data['created_date']       =   date('Y-m-d H:i:s');
        $data['updated_date']       =   $data['created_date'];
       // pr($data);die;
        $this->db->insert("$this->tbl_users", $data);
        $seller_id  =   $this->db->insert_id();
        if($seller_id){
            //---update added by
            $udata['u.added_by']      =   $user_id;
            $this->db->where("u.id",$seller_id);
            
            
            $this->db->update("$this->tbl_users as u", $udata);
            
            if($seller_id){
                $rs_data['status']      =   'success';
                $rs_data['password']    =   $password;
                $rs_data['email']       =   $_POST['email'];
                $rs_data['first_name']  =   $_POST['first_name'];
                //$rs_data['last_name']   =   $_POST['last_name'];
                $rs_data['name']        =   $_POST['first_name'];
				$rs_data['mobile_number']      =   $_POST['mobile_number'];
            }
        }else{
            $rs_data['status'] = 'error';
            $rs_data['error_msg'] = "Invalid Request";
        }
        return $rs_data;
    }
     /* End function */

	 
	 /////////////////////////////////////////////////////////////////////////////////////////////////////////////////

     /**
     * userinfo
     *
     * this function get user(seller) info by id
     * @access	public
     * @return array
     */
    function userinfo($id = NULL){
        
        $this->db->select("u.id as user_id,u.first_name,u.email,u.mobile_number,u.assigned_manager,u.status,u.user_type", false);
        $this->db->from("$this->tbl_users as u");
        
        $this->db->where('u.id', $id);
        $query = $this->db->get();
        //echo $this->db->last_query(); die;
        if ($query->num_rows() > 0) {            
            return $query->row();
        } else {
            return false;
        }        
    }
     /* End function */
	 
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////

     /**
     * update user details
     *
     * this function update user details
     * @access	public
     * @return array
     */
    function sales_person_update($id = NULL,$data_post=array()){   
       	
           $u_data['first_name']            = $data_post['first_name'];
           $u_data['email']                  = $data_post['email'];
           $u_data['mobile_number']         = $data_post['mobile_number'];
           $u_data['assigned_manager']       = $data_post['assign_sales_manager'];
           $u_data['status']                = $data_post['status'];
            //$u_data['is_profile_complete']   = '1';
            //pr( $u_data);die;
            $this->db->where('id',$id);
            $this->db->update('kyi_users',$u_data);
            
           
            $affected = $this->db->affected_rows();
           // pr($affected);die;
            if($affected>=0){
                
               

                $res['status'] ='success';
                $res['msg'] ='Sales Person details updated successfully';
            } else {
                $res['status'] ='error';
                $res['msg'] ='Sales Person details not updated successfully';
            }

           /*
           $new_data['pm_active_plan_id'] = $session_data['userinfo_edit']['food_stall_type'];
           $new_data['pm_plan_start_date'] = $session_data['userinfo_edit']['food_stall_type'];
           $new_data['pm_plan_expire_date'] = $session_data['userinfo_edit']['food_stall_type'];
           */
           
           return $res;
           
           
            }
             /* End function */
            ///////////////////////////////////////////////////////////////////////////////////////////////////////////////


    
    



    /**
     * sales_manager_list_ajax
     *
     * this function update user profile info by user id
     * @access	public
     * @return array
     */

    function  sales_manager_list(){
        $this->db->select("u.id,u.first_name");
        $this->db->from(" $this->tbl_users as u");
        $this->db->where('u.status','active');
        $this->db->where('u.user_type','4');
		$query = $this->db->order_by('u.id','desc');
        $query = $this->db->get();
        //echo $this->db->last_query();die;
            if ($query->num_rows() > 0) {
                return $query->result();
            }
            else{
                return false;
            }
    }
	

    /**
     * seller_list_ajax
     *
     * this function update user profile info by user id
     * @access	public
     * @return array
     */
    function sales_person_list_ajax($filter){

       // $this->db->select("SQL_CALC_FOUND_ROWS u.*,(case when u.user_type=1 then 'Admin' when u.food_stall_type=2 then 'Track (The Rest Accounting Key)' when u.food_stall_type=3 then 'Home Made Food' END) as food_stall,concat(u.first_name,' ',u.last_name) as `full_name`,ud.food_joint_name,ud.address,ud.pm_active_plan_id,ud.pm_plan_start_date,ud.pm_plan_expire_date,(SELECT name FROM fs_city as c WHERE c.id=ud.city) as city_name", false);
       $this->db->select("SQL_CALC_FOUND_ROWS u.id,concat(u.first_name,' ',u.last_name) as `sales_person_name`,u.email,u.mobile_number,u.assigned_manager,u.status,(SELECT ku1.first_name FROM kyi_users as ku1 WHERE ku1.id=u.assigned_manager GROUP BY ku1.assigned_manager ORDER BY ku1.id) as sales_manager_name",False);
       $this->db->from(" $this->tbl_users as u");
        
        $this->db->where('u.user_type','3');
        $columns = array('u.id','u.id','u.id','u.id','u.id','u.id','u.id');
        
        if (isset($filter['search']['value']) && $filter['search']['value']!=''){
                
            $search_keyboard    =   $filter['search']['value'];
            $search_keyboard=strtolower($search_keyboard);
            $str = "";
            $str = $str."(LOWER(u.first_name) LIKE '$search_keyboard%' OR LOWER(u.last_name) LIKE '$search_keyboard%' OR LOWER(u.status) LIKE '$search_keyboard%' OR LOWER(u.email) LIKE '$search_keyboard%' OR LOWER(u.mobile_number) LIKE '$search_keyboard%')";
            $this->db->where($str);    
        }
        

       if(isset($filter['order'][0]['column']) &&  $filter['order'][0]['column']!='' && isset($filter['order'][0]['dir']) && $filter['order'][0]['dir']!='' && isset($filter['length']) && $filter['length']!='' && isset($filter['start']) && $filter['start']!=''){
        $this->db->order_by($columns[$filter['order'][0]['column']], $filter['order'][0]['dir']);
         if ($filter['length'] != '-1') {  // for showing all records
             $this->db->limit($filter['length'], $filter['start']);
         }
     }
        $this->db->order_by('u.id','desc');
        $query = $this->db->get();
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


//---------------------------------------------------------------------------------------------------------------------
    function sales_person_mobile_exist($valuekey)
    {
        $encoded_Id = $this->uri->segment('4');    
        
        $user_id = ID_decode($encoded_Id);    

        $this->db->where('id !=',$user_id);
        $this->db->where('mobile_number =',$valuekey);
        $query = $this->db->get('kyi_users');
      // echo $this->db->last_query(); die;
        if ($query->num_rows() > 0){
            return $query->num_rows();
        }
        else{
            return false;
        }
    }




	

}
