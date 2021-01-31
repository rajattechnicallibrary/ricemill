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
class Seller_mod extends CI_Model {

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
        $password                   =   generate_password();
        $data['first_name']         =   $_POST['first_name'];
        $data['last_name']          =   $_POST['last_name'];
        $data['mobile_number']      =   $_POST['mobile_number'];
        $data['email']              =   $_POST['email'];
        $data['food_stall_type']    =   $_POST['food_stall_type'];
		
        $data['password']           =   md5($password); 
        $data['status']             =   $_POST['status']; 
        $data['is_verify']          =   '1';
        $data['user_type']          =   '3';
		$data['role_id']            =   '3';

        $data['added_by']           =   $user_id;
        $data['created_date']       =   date('Y-m-d H:i:s');
        $data['updated_date']       =   $data['created_date'];
        $this->db->insert("$this->tbl_users", $data);
        $seller_id  =   $this->db->insert_id();
        if($seller_id){
            //---update added by
            $udata['u.added_by']      =   $user_id;
            $this->db->where("u.id",$seller_id);
            
            
            $this->db->update("$this->tbl_users as u", $udata);
            $d_data['user_id']      =   $seller_id;
            $d_data['user_id']      =   $seller_id;
			$d_data['food_joint_name']    =  $_POST['food_joint_name'];
            $d_data['updated_date'] =   $data['created_date']; 
            $this->db->insert("$this->tbl_users_details",$d_data);
            $seller_did  =   $this->db->insert_id();
            if($seller_did){
                $rs_data['status']      =   'success';
                $rs_data['password']    =   $password;
                $rs_data['email']       =   $_POST['email'];
                $rs_data['first_name']  =   $_POST['first_name'];
                $rs_data['last_name']   =   $_POST['last_name'];
                $rs_data['name']        =   $_POST['first_name'].' '.$_POST['last_name'];
				$rs_data['mobile_number']      =   $_POST['mobile_number'];
            }
        }else{
            $rs_data['status'] = 'error';
            $rs_data['error_msg'] = "Invalid Request";
        }
        return $rs_data;
    }
     /* End function */

    /**
     * view
     *
     * this function update user profile info by user id
     * @access	public
     * @return array
     */
	 
	 public function fetch_cuisine_category(){
		$this->db->select('*');
        $this->db->where('status', 'active');
		$this->db->order_by('name','asc');
        $query = $this->db->get('fs_cuisine_category');
        if($query->num_rows() > 0)
		{
			return $query->result();
		}else{
			return false;
		}
	}
	
	public function fetch_seller(){
		$this->db->select('*');
        $this->db->where('status', 'active');
		$this->db->where('user_type', '3');
		$this->db->order_by('first_name','asc');
        $query = $this->db->get('fs_users');
        if($query->num_rows() > 0)
		{
			return $query->result();
		}else{
			return false;
		}
    }
        /*
        get food joints from */

	public function fetch_food_joints(){
        $this->db->select('u.id,ud.food_joint_name');
        $this->db->from('fs_users as u','');
        $this->db->join('fs_users_details as ud','u.id=ud.user_id','left');
        $this->db->where('u.status !=', 'delete');
		$this->db->where('u.user_type', '3');
		$this->db->where('u.user_type', '3');
		$this->db->order_by('ud.food_joint_name','asc');
        $query = $this->db->get();
        if($query->num_rows() > 0)
		{
			return $query->result();
		}else{
			return false;
		}
    }
    


    function seller_info($id = NULL){

        $this->db->select("u.*,concat(u.first_name,' ',u.last_name) as full_name", false);
        $this->db->where('u.id', $id);
        $query = $this->db->get("$this->tbl_users as u");

        if ($query->num_rows() > 0) {
            $data['status'] = 'success';
            $data['result'] = $query->row();
        } else {

            $data['status'] = 'error';
            $data['error_msg'] = 'Invalid Request';
        }
        return $data;
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
        
        $this->db->select("u.id as user_id,u.first_name,u.last_name,u.email,u.mobile_number,u.food_stall_type,u.status,u.plan_status,u.user_type,u.role_id,u.profile_image,u.added_by,u.is_profile_complete,ud.*", false);
        $this->db->from("$this->tbl_users as u");
        $this->db->join("fs_users_details as ud","u.id=ud.user_id","left");
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
     
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function seller_plans(){
        $this->db->select("p.*", false);

        $query = $this->db->get("fs_plan as p");        
        
        if ($query->num_rows() > 0) {            
            return  $query->result();            
        } else {
            return false;
        }        
    }

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////

     /**
     * update user details
     *
     * this function update user details
     * @access	public
     * @return array
     */
    function seller_update($id = NULL,$session_data=array()){   	
           $u_data['first_name']            = $session_data['userinfo_edit']['first_name'];
           $u_data['last_name']             = $session_data['userinfo_edit']['last_name'];
           $u_data['mobile_number']         = $session_data['userinfo_edit']['mobile_number'];
           $u_data['food_stall_type']       = $session_data['userinfo_edit']['food_stall_type'];
           $u_data['status']                = $session_data['userinfo_edit']['status'];
			$u_data['is_profile_complete']   = '1';
            $this->db->where('id',$id);
            $this->db->update('fs_users',$u_data);
            
           /* update other datilsa of user*/
           if($session_data['userinfo_edit']['logo_image']){
            $new_data['logo_image']             = $session_data['userinfo_edit']['logo_image'];
           }

           if($session_data['userinfo_edit']['banner_image']){
            $new_data['banner_image']             = $session_data['userinfo_edit']['banner_image'];
           }

           $new_data['landline_number']             = $session_data['userinfo_edit']['landline_number'];
           $new_data['alternate_number']            = $session_data['userinfo_edit']['alternate_number'];
           $new_data['food_joint_name']             = $session_data['userinfo_edit']['food_joint_name'];
           $new_data['food_type']                   = $session_data['userinfo_edit']['food_type'];
           $new_data['about']                       = $session_data['userinfo_edit']['about'];
           $new_data['year_of_inception']           = $session_data['userinfo_edit']['year_of_inception'];
           $new_data['deliver_food_at_home']        = $session_data['userinfo_edit']['deliver_food_at_home'];
           $new_data['provide_catering_event']      = $session_data['userinfo_edit']['provide_catering_event'];
           $new_data['take_order_for_take_away']    = $session_data['userinfo_edit']['take_order_for_take_away'];
           
           $new_data['distance_radius']             = $session_data['userinfo_edit']['distance_radius'];
           $open_days                               = implode(',',$session_data['userinfo_edit']['open_days']);           
           $new_data['open_days']                   = $open_days;
		   
		   if($session_data['userinfo_edit']['deliver_food_at_home']==1){
		   $new_data['delivery_fee_applicable']     = $session_data['userinfo_edit']['delivery_free_applicable'];
           $new_data['delivery_fee_applicable_for'] = $session_data['userinfo_edit']['delivery_fee_applicable_for'];
           $new_data['delivery_fee']                = $session_data['userinfo_edit']['delivery_fee'];                      
           $new_data['discount']                    = $session_data['userinfo_edit']['discount'];   
		   $new_data['last_order_time_for_delivery']= $session_data['userinfo_edit']['last_order_time_for_delivery'];
		   } else if($session_data['userinfo_edit']['deliver_food_at_home']==0){
            if($session_data['userinfo_edit']['minimum_order'] !=''){
               // $new_data['minimum_order']               = $session_data['userinfo_edit']['minimum_order'];

            } else {
                //$new_data['minimum_order']               = $session_data['userinfo_edit']['minimum_order_value'];
            }
           }
           $new_data['delivery_estimated_time']     = $session_data['userinfo_edit']['delivery_estimated_time']; 
           $new_data['minimum_order']               = $session_data['userinfo_edit']['minimum_order_value'];	   
           $new_data['business_hour_open_time']     = $session_data['userinfo_edit']['business_hour_open_time'];
           $new_data['business_hour_close_time']    = $session_data['userinfo_edit']['business_hour_close_time'];           
           $new_data['website_url']                 = $session_data['userinfo_edit']['website_url'];
           $new_data['country']                     = $session_data['userinfo_edit']['country'];
           $new_data['state']                       = $session_data['userinfo_edit']['state'];
           $new_data['city']                        = $session_data['userinfo_edit']['city'];
           $new_data['address']                     = $session_data['userinfo_edit']['address'];
           $new_data['zipcode']                     = $session_data['userinfo_edit']['zipcode'];
           $new_data['landmark']                    = $session_data['userinfo_edit']['landmark'];
		   $new_data['oi_facebook_url']             = $session_data['userinfo_edit']['oi_facebook_url'];
           $new_data['oi_instgram_id']              = $session_data['userinfo_edit']['oi_instgram_id'];          
           $new_data['highlight']                   = $session_data['userinfo_edit']['highlight'];
           $new_data['lattitude']                   = $session_data['userinfo_edit']['lattitude'];
           $new_data['longitude']                   = $session_data['userinfo_edit']['longitude'];
           $new_data['google_search_address']       = $session_data['userinfo_edit']['location'];
           $new_data['oi_beneficiary_name']         = $session_data['otherinfo_edit']['oi_beneficiary_name'];
           $new_data['oi_bank_name']                = $session_data['otherinfo_edit']['oi_bank_name'];
           $new_data['oi_bank_location']            = $session_data['otherinfo_edit']['oi_bank_location'];
           $new_data['oi_account_number']           = $session_data['otherinfo_edit']['oi_account_number'];
           $new_data['oi_ifsc_code']                = $session_data['otherinfo_edit']['oi_ifsc_code'];           
           $new_data['sct_gst_number']              = $session_data['statutorycompliance_edit']['sct_gst_number'];
           $new_data['sct_pan_number']              = $session_data['statutorycompliance_edit']['sct_pan_number'];
           $new_data['sct_tin_number']              = $session_data['statutorycompliance_edit']['sct_tin_number'];
           $new_data['sct_cin_number']              = $session_data['statutorycompliance_edit']['sct_cin_number'];
           
           if($session_data['payment_data']['plan_id']=='1'){
            $new_data['pm_active_plan_id']          = $session_data['payment_data']['plan_id'];            
            $new_data['pm_plan_start_date']         = date('Y-m-d H:i:s');
            $new_data['pm_plan_expire_date']        = date('Y-m-d H:i:s',strtotime(date("Y-m-d H:i:s", time()) . " + 365 day"));                       
            } else {
            $new_data['pm_active_plan_id']          = $session_data['payment_data']['plan_id'];
           }    
			
           $this->db->where('user_id',$id);
           $this->db->update('fs_users_details',$new_data);
            $affected = $this->db->affected_rows();
            
            if($affected>=0){
                
                if(is_array($session_data['payment_data']) && !empty($session_data['payment_data'])){                    
                    $rows = $this->db->get_where('fs_user_plan_payment', array('user_id' => $id))->num_rows();

                    if($rows>0){
                        $up_user['status'] ='inactive';                     
                        $this->db->where('user_id',$id);
                        $this->db->update('fs_user_plan_payment',$up_user);
                        $uer_data = $this->db->affected_rows();
                        if($uer_data>=0){
                            $this->db->insert('fs_user_plan_payment',$session_data['payment_data']);                    
                        }
                    } else {
                        $this->db->insert('fs_user_plan_payment',$session_data['payment_data']);                    
                    }
					if( ($session_data['payment_data']['plan_id']	==	'1' && $session_data['payment_data']['pay_instant_or_later']	==	'2') || ($session_data['payment_data']['plan_id']	==	'2' ) ){	/*update in user table plan_expire date*/
						$upd_usr_plan['pm_plan_start_date']	=	'0000-00-00 00:00:00';
						$upd_usr_plan['pm_plan_expire_date']	=	'0000-00-00 00:00:00';
						$this->db->where('user_id',$id);
                        $this->db->update('fs_users_details',$upd_usr_plan);
					}
                }

                if(is_array($session_data['userinfo_edit']['cuisines_category']) && !empty($session_data['userinfo_edit']['cuisines_category'])){
                    $this->db->where('user_id',$id);
                    $this->db->delete('fs_user_cuisine_category_mapping');
    
                    foreach($session_data['userinfo_edit']['cuisines_category'] as $ke => $val){
                        $ins_data['user_id']            = $id;
                        $ins_data['cuisine_cat_id']     =  $val;
                        $this->db->insert('fs_user_cuisine_category_mapping',$ins_data);
                    }
                }

                $res['status'] ='success';
                $res['msg'] ='Seller details updated successfully';
            } else {
                $res['status'] ='error';
                $res['msg'] ='Seller details not updated successfully';
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


////////////////////////////////////////////// Seller profile completed from seller end ///////////////////////////////////////////////////////////////////

     /**
     * complete seller profile 
     *
     * this function update seller details
     * @access	public
     * @return array
     */
    function seller_completed_profile($id = NULL,$session_data=array()){ 
        $u_data['first_name']            = $session_data['userinfo_edit']['first_name'];
        $u_data['last_name']             = $session_data['userinfo_edit']['last_name'];
        $u_data['mobile_number']         = $session_data['userinfo_edit']['mobile_number'];
        $u_data['food_stall_type']       = $session_data['userinfo_edit']['food_stall_type'];
        //$u_data['status']                = $session_data['userinfo_edit']['status'];
        $u_data['is_profile_complete']   = '1';

         $this->db->where('id',$id);
         $this->db->update('fs_users',$u_data);
         
        /* update other datilsa of user*/
        if($session_data['userinfo_edit']['logo_image']){
         $new_data['logo_image']             = $session_data['userinfo_edit']['logo_image'];
        }

        if($session_data['userinfo_edit']['banner_image']){
         $new_data['banner_image']             = $session_data['userinfo_edit']['banner_image'];
        }

        $new_data['landline_number']             = $session_data['userinfo_edit']['landline_number'];
        $new_data['alternate_number']            = $session_data['userinfo_edit']['alternate_number'];
        $new_data['food_joint_name']             = $session_data['userinfo_edit']['food_joint_name'];
        $new_data['food_type']                   = $session_data['userinfo_edit']['food_type'];
        $new_data['about']                       = $session_data['userinfo_edit']['about'];
        $new_data['year_of_inception']           = $session_data['userinfo_edit']['year_of_inception'];
        $new_data['deliver_food_at_home']        = $session_data['userinfo_edit']['deliver_food_at_home'];
        $new_data['provide_catering_event']      = $session_data['userinfo_edit']['provide_catering_event'];
        $new_data['take_order_for_take_away']    = $session_data['userinfo_edit']['take_order_for_take_away'];
        
        $new_data['distance_radius']             = $session_data['userinfo_edit']['distance_radius'];
        $open_days                               = implode(',',$session_data['userinfo_edit']['open_days']);           
        $new_data['open_days']                   = $open_days;
        
        if($session_data['userinfo_edit']['deliver_food_at_home']==1){
        $new_data['delivery_fee_applicable']     = $session_data['userinfo_edit']['delivery_free_applicable'];
        $new_data['delivery_fee_applicable_for'] = $session_data['userinfo_edit']['delivery_fee_applicable_for'];
        $new_data['delivery_fee']                = $session_data['userinfo_edit']['delivery_fee'];           
        $new_data['discount']                    = $session_data['userinfo_edit']['discount'];   
        $new_data['last_order_time_for_delivery']= $session_data['userinfo_edit']['last_order_time_for_delivery'];
        } else if($session_data['userinfo_edit']['deliver_food_at_home']==0){
            if($session_data['userinfo_edit']['minimum_order'] !=''){
                //$new_data['minimum_order']               = $session_data['userinfo_edit']['minimum_order'];
    
            } else {
               // $new_data['minimum_order']               = $session_data['userinfo_edit']['minimum_order_value'];
            }

        }

        $new_data['delivery_estimated_time']     = $session_data['userinfo_edit']['delivery_estimated_time']; 
        $new_data['minimum_order']               = $session_data['userinfo_edit']['minimum_order_value'];           
        $new_data['business_hour_open_time']     = $session_data['userinfo_edit']['business_hour_open_time'];
        $new_data['business_hour_close_time']    = $session_data['userinfo_edit']['business_hour_close_time'];           
        $new_data['website_url']                 = $session_data['userinfo_edit']['website_url'];
        $new_data['country']                     = $session_data['userinfo_edit']['country'];
        $new_data['state']                       = $session_data['userinfo_edit']['state'];
        $new_data['city']                        = $session_data['userinfo_edit']['city'];
        $new_data['address']                     = $session_data['userinfo_edit']['address'];
        $new_data['zipcode']                     = $session_data['userinfo_edit']['zipcode'];
        $new_data['landmark']                    = $session_data['userinfo_edit']['landmark'];
		$new_data['oi_facebook_url']             = $session_data['userinfo_edit']['oi_facebook_url'];
        $new_data['oi_instgram_id']              = $session_data['userinfo_edit']['oi_instgram_id'];
        $new_data['highlight']                   = $session_data['userinfo_edit']['highlight'];
        $new_data['lattitude']                   = $session_data['userinfo_edit']['lattitude'];
        $new_data['longitude']                   = $session_data['userinfo_edit']['longitude'];
        $new_data['google_search_address']       = $session_data['userinfo_edit']['location'];
        $new_data['oi_beneficiary_name']         = $session_data['otherinfo_edit']['oi_beneficiary_name'];
        $new_data['oi_bank_name']                = $session_data['otherinfo_edit']['oi_bank_name'];
        $new_data['oi_bank_location']            = $session_data['otherinfo_edit']['oi_bank_location'];
        $new_data['oi_account_number']           = $session_data['otherinfo_edit']['oi_account_number'];
        $new_data['oi_ifsc_code']                = $session_data['otherinfo_edit']['oi_ifsc_code'];       
        $new_data['sct_gst_number']              = $session_data['statutorycompliance_edit']['sct_gst_number'];
        $new_data['sct_pan_number']              = $session_data['statutorycompliance_edit']['sct_pan_number'];
        $new_data['sct_tin_number']              = $session_data['statutorycompliance_edit']['sct_tin_number'];
        $new_data['sct_cin_number']              = $session_data['statutorycompliance_edit']['sct_cin_number'];
        
        if($session_data['payment_data']['plan_id']=='1'){
         $new_data['pm_active_plan_id']          = $session_data['payment_data']['plan_id'];            
         $new_data['pm_plan_start_date']         = date('Y-m-d H:i:s');
         $new_data['pm_plan_expire_date']        = date('Y-m-d H:i:s',strtotime(date("Y-m-d H:i:s", time()) . " + 365 day"));                       
         } else {
         $new_data['pm_active_plan_id']          = $session_data['payment_data']['plan_id'];
        }    
         
        $this->db->where('user_id',$id);
        $this->db->update('fs_users_details',$new_data);
         $affected = $this->db->affected_rows();
         
         if($affected>=0){
             
             if(is_array($session_data['payment_data']) && !empty($session_data['payment_data'])){                    
                 $rows = $this->db->get_where('fs_user_plan_payment', array('user_id' => $id))->num_rows();

                 if($rows>0){
                     $up_user['status'] ='inactive';                     
                     $this->db->where('user_id',$id);
                     $this->db->update('fs_user_plan_payment',$up_user);
                     $uer_data = $this->db->affected_rows();
                     if($uer_data>=0){
                         $this->db->insert('fs_user_plan_payment',$session_data['payment_data']);                    
                     }
                 } else {
                     $this->db->insert('fs_user_plan_payment',$session_data['payment_data']);                    
                 }
             }

             if(is_array($session_data['userinfo_edit']['cuisines_category']) && !empty($session_data['userinfo_edit']['cuisines_category'])){
                 $this->db->where('user_id',$id);
                 $this->db->delete('fs_user_cuisine_category_mapping');
 
                 foreach($session_data['userinfo_edit']['cuisines_category'] as $ke => $val){
                     $ins_data['user_id']            = $id;
                     $ins_data['cuisine_cat_id']     =  $val;
                     $this->db->insert('fs_user_cuisine_category_mapping',$ins_data);
                 }
             }

             $res['status'] ='success';
             $res['msg'] ='Profile has been completed  Successfully';
         } else {
             $res['status'] ='error';
             $res['msg'] ='Profile has not been completed Successfully.';
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
     * delete
     *
     * this function delete selected sellers [Soft Delete] 
     * @access	public
     * @return array
     */
    function delete($seller_ids) {	
        $sellerIds = explode(',',$seller_ids);		
        $data['status'] = 'delete';
        $this->db->where_in('id', $sellerIds);
        $this->db->update("$this->tbl_users as u", $data);		
        $update = $this->db->affected_rows();
        if($update){
            $data['status']="success";
        } else {
            $data['status']     = 'error';
            $data['error_msg']  = 'Invalid Request';
           
        }
        return $data;
    }
    
    
 /**
     * delete
     *
     * this function delete selected sellers [Soft Delete] 
     * @access	public
     * @return array
     */
    function seller_information($seller_id) {	     
        $this->db->select('u.*');        
        $this->db->from("$this->tbl_users as u");
        $this->db->where('id', $seller_id);
        $query = $this->db->get();
        if($query->num_rows()>0){
            return $query->row();
        } else {
            return false;           
        }        
    }
    

    /**
     * get_planbyid
    
     * get_planbyid
     *
     * this function get_planbyid [Soft Delete] 
     * @access	public
     * @return array
     */
    function get_planbyid($userid) {
        $this->db->select('upp.*');
        $this->db->from('fs_user_plan_payment as upp');
        $this->db->where('user_id', $userid);
        $this->db->where('status','active');
        $this->db->where('payment_status','success');
        $query = $this->db->get();        
        if($query->num_rows()>0){
            return $query->row();    
        } else {            
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
    function seller_list_ajax($filter){

        $this->db->select("SQL_CALC_FOUND_ROWS u.*,(case when u.food_stall_type=1 then 'Food Truck' when u.food_stall_type=2 then 'Track (The Rest Accounting Key)' when u.food_stall_type=3 then 'Home Made Food' END) as food_stall,concat(u.first_name,' ',u.last_name) as `full_name`,ud.food_joint_name,ud.address,ud.pm_active_plan_id,ud.pm_plan_start_date,ud.pm_plan_expire_date,(SELECT name FROM fs_city as c WHERE c.id=ud.city) as city_name", false);
        $this->db->from(" $this->tbl_users as u");
        $this->db->join("fs_users_details as ud","u.id=ud.user_id","left");
        $this->db->where('u.user_type','3');
        $columns = array('u.id','u.id','ud.food_joint_name','u.email','u.mobile_number','food_stall','u.status');
        
        if (isset($filter['search']['value']) && $filter['search']['value']!=''){
                
            $search_keyboard    =   $filter['search']['value'];
            $search_keyboard=strtolower($search_keyboard);
            $str = "";
            $str = $str."(LOWER(ud.food_joint_name) LIKE '$search_keyboard%' OR LOWER(u.status) LIKE '$search_keyboard%' OR LOWER(u.email) LIKE '$search_keyboard%' OR LOWER(u.mobile_number) LIKE '$search_keyboard%')";
            $this->db->where($str);    
        }
        
        
        if(isset($filter['status']) && $filter['status']!=''){
             $this->db->where("u.status",$filter['status']);
        }
		
		if(isset($filter['start_date']) && @$filter['start_date']!=''){
            $start_date = correct_date($filter['start_date']);            
             //$this->db->where("date(u.created_date) >=",date('Y-d-m',strtotime()));
             $this->db->where("date(u.created_date) >=",$start_date);
        }
		if(isset($filter['end_date'])&& $filter['end_date']!=''){
            $end_date = correct_date($filter['end_date']);         
            //$this->db->where("date(u.created_date) <=",date('Y-d-m',strtotime($filter['end_date'])));
            $this->db->where("date(u.created_date) <=",$end_date);

        }
		if(isset($filter['food_joint_id']) && @$filter['food_joint_id']!=''){
             $this->db->where("ud.user_id ",ID_decode($filter['food_joint_id']));
        }
		
		if(isset($filter['cuisine_category']) && $filter['cuisine_category']!=''){
            $cuisine_category = explode(',',@$filter['cuisine_category']);            
			$this->db->join('fs_user_cuisine_category_mapping as fuccm','fuccm.user_id=u.id');
			$this->db->where_in("fuccm.cuisine_cat_id",$cuisine_category);
        }

        if(isset($filter['lattitude']) && $filter['lattitude'] !='' && isset($filter['longitude']) && $filter['longitude'] !=''){
            $this->db->where("ud.lattitude ",$filter['lattitude']);
            $this->db->where("ud.longitude ",$filter['longitude']);
       }

       if(isset($filter['cuisine_category']) && $filter['cuisine_category']!=''){
        $this->db->group_by('fuccm.user_id');
		
       }

       if(isset($filter['order'][0]['column']) &&  $filter['order'][0]['column']!='' && isset($filter['order'][0]['dir']) && $filter['order'][0]['dir']!='' && isset($filter['length']) && $filter['length']!='' && isset($filter['start']) && $filter['start']!=''){
        $this->db->order_by($columns[$filter['order'][0]['column']], $filter['order'][0]['dir']);
         if ($filter['length'] != '-1') {  // for showing all records
             $this->db->limit($filter['length'], $filter['start']);
         }
     }
 
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

//----------------------------------------------------------------------------------------------------------------------
function cuisinedropdownarraybyuser_id($id){
    $this->db->select('uccm.cuisine_cat_id');      
    $this->db->from("fs_user_cuisine_category_mapping as uccm");   
    $this->db->where("uccm.user_id",$id);
    $query=$this->db->get();

    $cuisine_list = array();
    //$cuisine_list ="Select cuisine";
    if($query->num_rows()>0){ 
    $data = $query->result();
    foreach ($data as $rows) {
        $cuisine_list[] = $rows->cuisine_cat_id;
    }
    return $cuisine_list;
    } else {
        return false;
    }
  
}

//---------------------------------------------------------------------------------------------------------------------
    function food_joint_name_exist($valuekey)
    {
        $encoded_Id = $this->uri->segment('4');        
        $user_id = ID_decode($encoded_Id);        
        $this->db->where('user_id !=',$user_id);
        $this->db->where('food_joint_name',$valuekey);
        $query = $this->db->get('fs_users_details');
      //  echo $this->db->last_query(); die;
        if ($query->num_rows() > 0){
            return $query->num_rows();
        }
        else{
            return false;
        }
    }



//----------------------------------------------------------------------------------------------------------------------
function plan_amount($plan_id){
    $this->db->select('pl.amount');      
    $this->db->from("fs_plan as pl");   
    $this->db->where("pl.id",$plan_id);
    $query=$this->db->get();
    if($query->num_rows()>0){     
        return $query->row()->amount;
    } else {
        return false;
    }
}

public function fetch_payment_data($user_id){
	$this->db->select('upp.*,u.first_name,ud.food_joint_name');
	$this->db->from('fs_user_plan_payment as upp');
	$this->db->join('fs_users as u','upp.user_id=u.id','right');
	$this->db->join('fs_users_details as ud','ud.user_id = u.id','right');
	$this->db->where('upp.user_id',$user_id);
	$this->db->order_by('upp.status','asc');
	return $query = $this->db->get()->result();
}

// change Event  status active or in active
	
	function changeEventStatus($id,$status) {
        $data['status'] = $status;
        $this->db->where('id', $id);
        $this->db->update('fs_users', $data);		
		$data['update'] = $this->db->affected_rows();
		if($data['update']){
			return $data;
		} else {
			return false;
		}
    }

	// change Event  status active or in active
	
	function approveSeller($id,$status) {
        $data['is_approved'] = $status;
        $this->db->where('id', $id);
        $this->db->update('fs_users', $data);		
		$data['update'] = $this->db->affected_rows();
		if($data['update']){
			return $data;
		} else {
			return false;
		}
    }
	

}
