<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Auth Model 
 *
 * @package		Auth
 * @subpackage	Models
 * @category	Authentication 
 * @author		Arvind Soni
 * @website		http://www.thealternativeaccount.com
 * @company     thealternativeaccount Inc
 * @since		Version 1.0
 */
class Auth_mod extends CI_Model {

    var $user_table = "users";

    /**
     * Constructor
     */
    function __construct() {
        parent::__construct();
       
    }

    /**
     * End
     */

 /**
     * Register
     *
     * This function User Registeration
     * 
     * @access	public
     * @return	mixed Array 
     */	 
	 public function user_registration() {
        if($_POST){  		
            $data['first_name']     = $_POST['first_name'];
            $data['last_name']      = $_POST['last_name'];
			$data['mobile_number']  = $_POST['mobile_number'];
			$data['email']          = $_POST['email'];
			$data['status']          = 'active';
            $data['password']       = md5($_POST['password']);
			$data['is_verify']      = '0';  
			$data['user_type']      = '4';
			//$data['status']         = 'active';  
			$data['otp']            = '1234';//generate_otp(); 
			$data['created_date']	= date('Y-m-d H:i:s');			
            $this->db->insert("kyi_users", $data);
			$data['user_id'] 	= $this->db->insert_id();
			
			$res_data['user_id']      = $data['user_id'];
			$this->db->insert("kyi_users_details", $res_data);
			
			return $data;
        } else{
            return false;      
        }
    }
	
	
	/**
     * Seller Registration
     *
     * This function Seller Registeration
     * 
     * @access	public
     * @return	mixed Array 
     */	 
	 public function seller_registration() {
        if($_POST){  		
            $data['first_name']     = $_POST['fname'];
            $data['last_name']      = $_POST['lname'];
			$data['mobile_number']  = $_POST['mnumber'];
			$data['email']          = $_POST['email_id'];
			$data['role_id']          = '3';
			$data['food_stall_type']= $_POST['food_stall_type'];
			$data['status']         = 'active';
            $data['password']       = md5($_POST['s_password']);
			$data['is_verify']      = '0';  
			$data['user_type']      = '3';
			$data['otp']            = '1234';//generate_otp(); 
			$data['created_date']	= date('Y-m-d H:i:s');		
			
            $this->db->insert("kyi_users", $data);
			$last_id 				= $this->db->insert_id();
			$data['user_id'] 		= $last_id;
			if($last_id){
			$res_data['user_id']      		= $data['user_id'];
			$res_data['food_joint_name']    = $_POST['food_joint_name'];
			$this->db->insert("kyi_users_details", $res_data);	
			}
			return $data;
        } else{
            return false;      
        }
    }
	
    function otp_verify_seller(){
		if($_POST){  
			$otp = $_POST['s_otp'];
			$user_id = $_POST['s_user_id'];
			$this->db->select('*');
			$this->db->where('id',$user_id);
			$this->db->where('otp',$otp);
			$result = $this->db->get('kyi_users');
			if($result->num_rows() > 0)
			{
				$data['status'] = 'success';
				$data['result']	=	$result->result();
				/*update status in kyi_users table*/
				$upd['is_verify']	=	'1';
				$upd['plan_status']	=	'active';
				$this->db->where('id',$user_id);
				$this->db->update('kyi_users',$upd);
			}else{
				$data['status'] = 'error';
			}
		}
		return $data;
     }
     

	function otp_verify($otp, $user_id){
		if($_POST){			
			$this->db->select('*');
			$this->db->where('id',ID_decode($user_id));
			$this->db->where('otp',$otp);
			$result = $this->db->get('kyi_users');
			if($result->num_rows() > 0)
			{
				$data['status'] = 'success';
				$data['result']	=	$result->result();
				/*update status in kyi_users table*/
				$upd['is_verify']	=	'1';
				$upd['plan_status']	=	'active';
				$this->db->where('id',ID_decode($user_id));
				$this->db->update('kyi_users',$upd);
			}else{
				$data['status'] = 'error';
			}
		}
		return $data;
	 }


    /**
     * forget
     *
     * This function set password and send verification mail
     * 
     * @access	public
     * @return	mixed Array 
     */
    function forgot_password() {

                //   $this->db->select('email')  
                //   $this->db->where('email')  
        $result = $this->db->get($this->user_table);
        if ($result->num_rows() > 0) {
            $userData = $result->row();
			$return['status'] = "success";
            $return['result'] =$userData;
        } else {
            $return['status'] = "error";
            $return['error_msg'] = "Your Mobile Number is not registered yet.";
           
        }
		 return $return;
    }
	
	function before_change_pass_otp_verify(){
		if($_POST){  
			$otp = $_POST['otp_verify'];
			$user_id = $_POST['verify_user_id'];
			$this->db->select('*');
			$this->db->where('id',$user_id);
			$this->db->where('otp',$otp);
			$result = $this->db->get('kyi_users');
			if($result->num_rows() > 0)
			{
				$data['status'] = 'success';
				$data['result']	=	$result->result();
			}else{
				$data['status'] = 'error';
			}
		}
		return $data;
	 }

    /**
     * changepassword
     *
     * This function set password and send verification mail
     * 
     * @access	public
     * @return	mixed Array 
     */
	 
	 function change_password(){
		if($_POST){  
			$change_password = $_POST['change_password'];
			$user_id = $_POST['user_id_verify'];
			$this->db->select('*');
			$this->db->where('id',$user_id);
			$result = $this->db->get('kyi_users');
			//echo $this->db->last_query();die;
			
			if($result->num_rows() > 0)
			{   
				$upd['password'] = md5($change_password);
		        $this->db->where('id',$user_id);
				$this->db->update('kyi_users',$upd);
				$data['status'] = 'success';
				$data['result']	=	$result->row();
			}else{
				$data['status'] = 'error';
				$data['error_msg'] = 'Password is Not Changed !';
			}
			
		}
		return $data;
    }
    // function change_password() {

        // $this->form_validation->set_rules('currentpassword', 'Current Password', 'trim|required|checkCurrentpassword');
        // $this->form_validation->set_rules('newpassword', 'New Password', 'trim|min_length[6]|required');
        // $this->form_validation->set_rules('confirmpassword', 'Confirm Password', 'trim|min_length[6]|required|matches[newpassword]');

        // if ($this->form_validation->run() === false) {
            // $return['status'] = "error";
            // return $return;
        // }
        // updating new password
        // $pswd_data['password'] = md5($this->input->post('newpassword'));
        // $current_user_id = currentuserinfo()->id;
        // $this->db->where("id", $current_user_id);
        // $result = $this->db->update("users", $pswd_data);

        // updating changepassword ststus for user
        // $chgpwd_status['is_pwd_changed'] = 1;
        // $this->db->where("id", $current_user_id);
        // $this->db->update("users", $chgpwd_status);
        //pr($this->db->affected_rows()); die;
        // if ($this->db->affected_rows() >= 0) {
            // $return['status'] = "success";
			// $return['current_user_id'] = $current_user_id;
            // $return['success_msg'] = "Your password has been changed successfully. Please login again to continue.";
            // $return['password'] = $this->input->post('newpassword', true);
            // $return['name'] = currentuserinfo()->authorisedperson;
            // $return['email'] = currentuserinfo()->email;
            // return $return;
        // } else {
            // $return['status'] = "error";
            // return $return;
        // }
    // }

    /**
     *
     * This function login authenticate 
     * 
     * @access	public
     * @param   String   plain string
     * @return	String   encrypted string
     */
	 function login_authorization() {
        
        $mobile_number = $this->security->xss_clean($this->input->post('login_mobile_number', true));
        $password = $this->security->xss_clean($this->input->post('login_password', true));
		$data = array();
        $this->db->where("u.mobile_number", $mobile_number);
        $query = $this->db->get("$this->user_table as u");

        if ($query->num_rows() > 0){
            $row = $query->row();
            if($row->user_type !=1){
					$password = md5($password);
				if($password != $row->password){
					$data['error_msg'] = "Password does not match !";
					$data['status'] = 'error';
				}
				else if ($password == $row->password){
					
					$user_info = $row;
					unset($user_info->password);
					if($row->is_verify != 1){
					$data['result'] = $row;
					$data['error_msg'] = "Your account is not verified please Verify OTP !";
					$data['status'] = 'error11';
			        }
					//-----------------------------------------------------
					else if ($user_info->status == "inactive") {
						$data['error_msg'] = "Your account is inactive. Please Contact to Admin.";
						$data['status'] = 'error';
					} else{
						//------update last login date time------
						$login_time = date("Y-m-d h:i:s");
						$up['last_login'] = $login_time;
						$this->db->where('id', $user_info->id);
						$this->db->update($this->user_table, $up);
						$data['status'] = 'success';
						$data['result'] = $user_info;
						
						//---------- end ---------------------------------------
						//-----------
					}	
				}
            }
        }else{
        $data['error_msg'] = "Invalid login credentials";
        $data['status'] = 'error';
		}
        return $data;
    }
	 
	 
	 
    // function login_authorize() {
        // $this->form_validation->set_rules('email', 'Email', 'trim|required');
        // $this->form_validation->set_rules('password', 'Password', 'trim|required');

        // $email = $this->security->xss_clean($this->input->post('email', true));
        // $password = $this->security->xss_clean($this->input->post('password', true));

        // if ($this->form_validation->run() === false) {
            // $data['error_msg'] = ""; //validation_errors();
            // $data['status'] = 'error';
            // return $data;
        // }

        // $this->db->where("email", $email);
        // $this->db->where("password", md5($password));
        // $query = $this->db->get($this->user_table);

        // if ($query->num_rows() > 0) {
            
     
            // /*Fetching user data*/
                // $this->db->where("email", $email);
                // $query = $this->db->get($this->user_table);
                // $user_info = $query->row();
            // /*End of fetching user data*/
            // if ($user_info->status === "inactive") {
                // if ((int) $user_info->user_type === 'admin') {
                    // $data['error_msg'] = "Admin account is inactive.";
                // } else {
                    // $data['error_msg'] = "Your account has been inactive.";
                // }
                // $data['status'] = 'error';
                // return $data;
            // } else {
                // $data['status'] = 'success';
                // if ($user_info->role_id == 0) {
                    // $data['user_info'] = $user_info;
                // } else {
                    // /* saving subuser id in session */
                    // $user_info->subuser_id = $user_info->id;

                    // $user_info->id = $user_info->added_by;
                    // $data['user_info'] = $user_info;
                // }
                // return $data;
            // }
        // } else {
            // $data['status'] = 'error';
            // $data['error_msg'] = "Invalid Credentials.";
            // return $data;
        // }
    // }
/* End of Function */
    /**
     * login_fb
     *
     * This function to login from Facebook credentials
     * 
     * @access	public
     * @return	html data
     */
    public function login_fb() {
        $arr = $this->input->post(null, true);
        /* checking either this facebook email exist in system already */
        $site_id = $this->input->post('site_id', true);
        $db_name = DB_PREFIX . $site_id;
        $email = $this->input->post('email', true);
        $this->db->select('id');
        $this->db->where('email', $arr['email']);
        $query = $this->db->get($db_name . '.users');
        $row_id = $query->row();

        if ($query->num_rows() > 0) { /* If facebook email ID already exist in database for this instance */
            $ins_id = $row_id->id;
        } else { /* If facebook email ID is not exist in database for this instance */
            $data['first_name'] = $arr['first_name'];
            $data['last_name'] = $arr['last_name'];
            $data['user_name'] = $arr['email'];
            $data['email'] = $arr['email'];
            $data['user_type'] = '3';
            $data['email_verify'] = 1;
            $token = md5(time());
            $data['token'] = $token;
            $data['status'] = 'active';
            $data['created'] = current_date();
            $data['modified'] = current_date();
            $data['status'] = 'active';
            $db_name = DB_PREFIX . $arr['site_id'];
            /* insert in users table of user's own database */
            $this->db->insert($db_name . '.users', $data);
            $ins_id = $this->db->insert_id();
        }
        $user_info = $this->get_user_by_id($ins_id, $arr['site_id']);
        unset($user_info->password);
        $user_info->name = $user_info->first_name . ' ' . $user_info->last_name;
        $dat['id'] = $ins_id;

        $dat['status'] = 'success';
        $dat['site_id'] = $arr['site_id'];
        $dat['result'] = $user_info;
        return $dat;
    }

    /* End of Function */

    /**
     * fetch_country
     *
     * This function to fetch countries
     * 
     * @access	public
     * @return	html data
     */
    public function fetch_country() {
        $this->db->select("*");
        $countries = $this->db->get("ri_demographic_country")->result();
        return $countries;
    }

    /* End of function */

    /**
     * fetch_industry_tags
     *
     * This function to fetch industry tags
     * 
     * @access	public
     * @return	html data
     */
    public function fetch_industry_tags() {
        $this->db->select("*");
        $industry_tags = $this->db->get("ri_industry_tags")->result();
        return $industry_tags;
    }
/* End of Function */	
    /**
     * fetch_industry_tags_by
     *
     * This function to fetch industry tags by industry id
     * 
     * @access	public
     * @return	html data
     */
    public function fetch_industry_tags_by_id($industry_id) {
        $this->db->select("*");
        $this->db->from("ri_industry_tags");
        $this->db->where('industry_id', $industry_id);
        $this->db->order_by('name','asc');
        $q = $this->db->get();
        if ($q->num_rows() > 0) {
            return $q->result();
        } else {
            return false;
        }
    }

    /* End of function */

    /**
     * fetch_industry
     *
     * This function to fetch industry
     * 
     * @access	public
     * @return	html data
     */
    public function fetch_industry() {
        $this->db->select("*");
        $this->db->order_by('name','asc');
        $industry = $this->db->get("ri_industry")->result();
        return $industry;
    }

    /* End of function */
	
	//update otp in database on forgot password
	public function update_otp_on_forgot($data) {
		//pr($data);die;
		if(!empty($data)){
			$updateData=array("otp"=>$data['otp']);

			$this->db->where("id",$data['id']);
			$this->db->update("kyi_users",$updateData);
			
			//echo $this->db->last_query();die;
		}
        
        
		
        
    }

    /* End of function */
}
/* End of Class */
?>