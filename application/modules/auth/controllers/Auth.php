<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {
    /**
     *  Site Controller
     *
     * @package		Auth
     * @category    Auth
     * @author		Ankit Rajput 
     * @website		http://www.thealternativeaccount.com
     * @company     thealternativeaccount Inc
     * @since		Version 1.0
     */

    /**
     * Constructor
     */
    function __construct() {
        parent::__construct();
        $this->load->model('auth_mod');
        $this->load->model('admin/manageclient_mod');
        if ($this->session->userdata('isLogin') == 'yes' && uri_segment(2) != 'logout' && uri_segment(2) != 'changepassword' && uri_segment(2) != 'goto_admin_panel' ) {
            redirect('/dashboard');
        }
    }

    /* End of constructor */

    /**
     * index
     *
     * This function dispaly main site page
     * 
     * @access	public
     * @return	html data
     */
    public function index() {
        redirect(base_url() . 'auth/login');
    }

    /* End of function */

    /**
     * login
     *
     * This function for login into panel
     * 
     * @access	public
     * @return	html data
     */
	public function login(){
		if (isPostBack()) {
				$mobile_number =  $this->input->post('login_mobile_number',true); 
				$password      =   $this->input->post('password',true); 
				$this->form_validation->set_rules('login_mobile_number', "Mobile Number", 'trim|required');
				$this->form_validation->set_rules('login_password', 'Password', 'trim|required');
			if($this->form_validation->run() === false){
				$rs_data['error_msg'] = validation_errors();
				$rs_data['status'] = 'error';
			}else{
				$result_data       =   $this->auth_mod->login_authorization();				
				if($result_data['status']=="error11"){
					$rs_data['user_id']	            =	ID_encode($result_data['result']->id);
					$rs_data['error_msg'] = $result_data['error_msg'];;
					$rs_data['status'] = 'error11';
					
					/*sending mail to user's registered email*/
					$email_data['to'] 			= $result_data['result']->email;
					$email_data['from'] 		= ADMIN_EMAIL;
					$email_data['sender_name'] 	= "Track (The Rest Accounting Key) Admin";
					$email_data['subject'] 		= "Track (The Rest Accounting Key):: Account Created Successfully";
					$email_data['message'] 		= array('header' => 'Account Created Successfully !',
						'body' => 'Hello <strong style="font-weight: bolder;font-size: 14px;">' . $result_data['result']->first_name . ', </strong>
												<br/>Your account has been created successfully
											<br/><strong style="font-weight: bolder;font-size: 14px;">Your OTP:</strong> ' . $result_data['result']->otp . '
												<br/><strong style="font-weight: bolder;font-size: 14px;">To verify your account. Please use above one time password.</strong>    
											<br><br>Thanks,<br/>Track (The Rest Accounting Key)');
					_sendMailPhpMailer($email_data);
				}
				else if($result_data['status']=="success"){
				   $this->session->set_userdata("userinfo",$result_data['result']);   
				   $this->session->set_userdata("isLogin",'yes'); 
				   $this->session->set_userdata("user_type",$result_data['result']->user_type); 
				   $mobile_number_enc   =   custom_encryption($mobile_number,'ak!@#s$on!','encrypt');
				   $password_enc   =   custom_encryption($password,'ak!@#s$on!','encrypt');
				   /* if($remember) // set remember username and password in cookie 
				   {
						setcookie('fs_email',$email_enc,time()+(86400 * 30),"/");
						setcookie('fs_password',$password_enc,time()+(86400 * 30),"/");
						setcookie('fs_remember',$remember,time()+(86400 * 30),"/");

				   }else{
						setcookie('fs_email','',time()+(86400 * 30),"/");
						setcookie('fs_password','',time()+(86400 * 30),"/");
						setcookie('fs_remember',$remember,time()+(86400 * 30),"/");
				   } */
					$rs_data['status']		        =	'success';
                    $rs_data['user_type']	        =	$result_data['result']->user_type;
                    $rs_data['user_id']	            =	ID_encode($result_data['result']->id);
                    $rs_data['is_profile_complete']	=	$result_data['result']->is_profile_complete;
					$rs_data['is_approved']			=	$result_data['result']->is_approved;
					$rs_data['success_msg']			=	'You are successfully Login!';
				}else{
					$rs_data['error_msg'] = $result_data['error_msg'];;
					$rs_data['status'] = 'error';
				}
			
			}
			echo json_encode($rs_data);
		 }
	}
	 

    /**
     * Register
     *
     * This function for registartion
     * 
     * @access	public
     * @return	html data
     */
    public function user_registration() {
        if (isPostBack()) {
			$this->form_validation->set_rules('first_name','First Name','trim|required|max_length[35]');
			$this->form_validation->set_rules('last_name','Last Name','trim|required|max_length[35]');
			$this->form_validation->set_rules('mobile_number','Mobile Number','trim|required|is_unique[fs_users.mobile_number]|max_length[10]');
			$this->form_validation->set_rules('email','Email','trim|required|valid_email|is_unique[fs_users.email]');
			$this->form_validation->set_rules('password','Password','trim|required|max_length[20]');
			if ($this->form_validation->run() == FALSE) {
                $data['status']	=	'error';
				$data['error_msg']	=	validation_errors();
            }else {  					
				$result = $this->auth_mod->user_registration();
				$data['status']	=	'success';
				$data['success_msg']	=	'You have successfully registered. One Time Password has been sent to your Mobile Number and Email Address. Please check and verify your account!';
				$data['user_id']	=	$result['user_id'];
				/*sending mail to user's registered email*/
                $email_data['to'] 			= $result['email'];
				$email_data['from'] 		= ADMIN_EMAIL;
				$email_data['sender_name'] 	= "Track (The Rest Accounting Key) Admin";
				$email_data['subject'] 		= "Track (The Rest Accounting Key):: Account Created Successfully";
				$email_data['message'] 		= array('header' => 'Account Created Successfully !',
					'body' => 'Hello <strong style="font-weight: bolder;font-size: 14px;">' . $result['first_name'] . ', </strong>
											<br/>Your account has been created successfully
										<br/><strong style="font-weight: bolder;font-size: 14px;">Your OTP:</strong> ' . $result['otp'] . '
											<br/><strong style="font-weight: bolder;font-size: 14px;">To verify your account. Please use above one time password.</strong>    
										<br><br>Thanks,<br/>Track (The Rest Accounting Key)');
				_sendMailPhpMailer($email_data);
            }
			
			echo json_encode($data);
			
			
			
			
			
			
            // $result = $this->auth_mod->register();
            // if ($result['status'] == 'success') {
                // sending mail to client's registered email
                // $email_data['from'] = ADMIN_EMAIL;
                // $email_data['to'] = trim($this->input->post('email'));
                // $email_data['subject'] = "New Registration";
                // $email_data['message'] = $this->load->view("email_templates/registration", $result, true);                
				// send_mail($email_data);
                // redirect('/auth/success');
            // }
        }
        // /* fetching countries */
        // $data['countries'] = $this->auth_mod->fetch_country();
        // /* fetching Industry Tags */
       // $data['industry_tags'] = $this->auth_mod->fetch_industry_tags();
        // /* fetching Industry */
       // $data['industry'] = $this->auth_mod->fetch_industry();
        // $data['title'] = "Rate-It || Register";
        // $data['page'] = "auth/register";
        // $this->load->view('login_layout', $data);
    }

    /* End of function */
	
	 /**
     * Register
     *
     * This function for registartion
     * 
     * @access	public
     * @return	html data
     */
    public function seller_registration() {
        if (isPostBack()) {			
			$this->form_validation->set_rules('fname','First Name','trim|required|max_length[35]');
			$this->form_validation->set_rules('lname','Last Name','trim|required|max_length[35]');
			$this->form_validation->set_rules('mnumber','Mobile Number','trim|required|is_unique[fs_users.mobile_number]|max_length[10]');
			$this->form_validation->set_rules('email_id','Email','trim|required|valid_email|is_unique[fs_users.email]');
			$this->form_validation->set_rules('s_password','Password','trim|required|max_length[20]');
			$this->form_validation->set_rules('food_joint_name','Food Joint Name','trim|required|max_length[40]|is_unique[fs_users_details.food_joint_name]');
			$this->form_validation->set_rules('food_stall_type','Food Category','trim|required|max_length[20]');
			if ($this->form_validation->run() == FALSE) {
                $data['status']	=	'error';

				$data['error_msg']	=	validation_errors();
            }else {  					
				$result = $this->auth_mod->seller_registration();
				$data['status']	=	'success';
				$data['success_msg']	=	'You have successfully registered. One Time Password has been sent to your Mobile Number and Email Address. Please check and verify your account!';
				$data['user_id']	=	$result['user_id'];
				/*sending mail to user's registered email*/
                $email_data['to'] 			= $result['email'];
				$email_data['from'] 		= ADMIN_EMAIL;
				$email_data['sender_name'] 	= "Track (The Rest Accounting Key) Admin";
				$email_data['subject'] 		= "Track (The Rest Accounting Key):: Account Created Successfully";
				$email_data['message'] 		= array('header' => 'Account Created Successfully !',
					'body' => 'Hello <strong style="font-weight: bolder;font-size: 14px;">' . $result['first_name'] . ', </strong>
											<br/>Your account has been created successfully
										<br/><strong style="font-weight: bolder;font-size: 14px;">Your OTP:</strong> ' . $result['otp'] . '
											<br/><strong style="font-weight: bolder;font-size: 14px;">To verify your account. Please use above one time password.</strong>    
										<br><br>Thanks,<br/>Track (The Rest Accounting Key)');
				_sendMailPhpMailer($email_data);
            }
			
			echo json_encode($data);			
        }        
    }

    /* End of function */
	
	
	
	
	/*otp_verify*/
	function otp_verify_seller(){
		if (isPostBack()) {            
			$this->form_validation->set_rules('s_otp','Otp','trim|required');
			$this->form_validation->set_rules('s_user_id','User Id','trim|required');
			if ($this->form_validation->run() == FALSE) {
                $data['status']	=	'error';
				$data['error_msg']	=	validation_errors();
            }else {  					
               $result = $this->auth_mod->otp_verify_seller();
			   
			   
			   if($result['status']	==	'success')
			   {
					$data['status']	=	'success';
					$data['success_msg']	=	'You have successfully verified. Please login using your credentials !';
				   /*sending mail to user's registered email on verify*/
					$email_data['to'] 			= $result['result']['0']->email;
					$email_data['from'] 		= ADMIN_EMAIL;
					$email_data['sender_name'] 	= "Track (The Rest Accounting Key) Admin";
					$email_data['subject'] 		= "Track (The Rest Accounting Key):: Account Created Successfully";
					$email_data['message'] 		= array('header' => 'Account Created Successfully !',
						'body' => 'Hello <strong style="font-weight: bolder;font-size: 14px;">' . $result['result']['0']->first_name . ', </strong>
												<br/>Your account has been verified successfully.
												<br/><strong style="font-weight: bolder;font-size: 14px;">To login your account, Please use your credentials.</strong>    
											<br><br>Thanks,<br/>Track (The Rest Accounting Key)');
					_sendMailPhpMailer($email_data);
			   }else if($result['status']	==	'error'){
				   $data['status']	=	'error';
				   $data['error_msg']	=	'Invalid Otp';
			   }
            }
			
			echo json_encode($data);	
		}
	}
	/* End of function */
	
	/*otp_verify*/
	function otp_verify(){
		$otp = $_POST['otp'];
		$user_id = $_POST['user_id'];
		if (isPostBack()) {
			$this->form_validation->set_rules('otp','Otp','trim|required');
			$this->form_validation->set_rules('user_id','User Id','trim|required');
			if ($this->form_validation->run() == FALSE) {
                $data['status']	=	'error';
				$data['error_msg']	=	validation_errors();
            }else {  					
               $result = $this->auth_mod->otp_verify($otp, $user_id);
			   
			   
			   if($result['status']	==	'success')
			   {
					$data['status']	=	'success';
					$data['success_msg']	=	'You have successfully verified. Please login using your credentials !';
				   /*sending mail to user's registered email on verify*/
					$email_data['to'] 			= $result['result']['0']->email;
					$email_data['from'] 		= ADMIN_EMAIL;
					$email_data['sender_name'] 	= "Track (The Rest Accounting Key) Admin";
					$email_data['subject'] 		= "Track (The Rest Accounting Key):: Account Created Successfully";
					$email_data['message'] 		= array('header' => 'Account Created Successfully !',
						'body' => 'Hello <strong style="font-weight: bolder;font-size: 14px;">' . $result['result']['0']->first_name . ', </strong>
												<br/>Your account has been verified successfully.
												<br/><strong style="font-weight: bolder;font-size: 14px;">To login your account, Please use your credentials.</strong>    
											<br><br>Thanks,<br/>Track (The Rest Accounting Key)');
					_sendMailPhpMailer($email_data);
			   }else if($result['status']	==	'error'){
				   $data['status']	=	'error';
				   $data['error_msg']	=	'Invalid Otp';
			   }
            }
			
			echo json_encode($data);	
		}
	}
	
	function login_otp_verify(){
		$otp = $_POST['otp_login'];
		$user_id = $_POST['user_login_id'];
		if (isPostBack()) {
			$this->form_validation->set_rules('otp_login','Otp','trim|required');
			//$this->form_validation->set_rules('user_id','User Id','trim|required');
			if ($this->form_validation->run() == FALSE) {
                $data['status']	=	'error';
				$data['error_msg']	=	validation_errors();
            }else {  					
               $result = $this->auth_mod->otp_verify($otp, $user_id);
			   if($result['status']	==	'success')
			   {
					$data['status']	=	'success';
					$data['success_msg']	=	'You have successfully verified. Please login using your credentials !';
				   /*sending mail to user's registered email on verify*/
					$email_data['to'] 			= $result['result']['0']->email;
					$email_data['from'] 		= ADMIN_EMAIL;
					$email_data['sender_name'] 	= "Track (The Rest Accounting Key) Admin";
					$email_data['subject'] 		= "Track (The Rest Accounting Key):: Account Created Successfully";
					$email_data['message'] 		= array('header' => 'Account Created Successfully !',
						'body' => 'Hello <strong style="font-weight: bolder;font-size: 14px;">' . $result['result']['0']->first_name . ', </strong>
												<br/>Your account has been verified successfully.
												<br/><strong style="font-weight: bolder;font-size: 14px;">To login your account, Please use your credentials.</strong>    
											<br><br>Thanks,<br/>Track (The Rest Accounting Key)');
					_sendMailPhpMailer($email_data);
			   }else if($result['status']	==	'error'){
				   $data['status']	=	'error';
				   $data['error_msg']	=	'Invalid Otp';
			   }
            }
			
			echo json_encode($data);	
		}
	}
	
	
	/* End of function */
	
    /**
     * get_industry_tag
     * this function fetch industry tages based on industry id
     * @access public
     * @mixed Array
     */
    public function get_industry_tag() {
        $country_id = $this->input->post('country_id');
        $structure = $this->auth_mod->fetch_industry_tags_by_id($country_id);
         $str ='';
        if (!empty($structure)) {            
            foreach ($structure as $key => $value) {
                $str .='<option value="' . $value->id . '">' . ucwords($value->name) . '</option>';
            }
            echo $str;
        } else {
            echo '<option value="">no industry tags </option>';
        }
    }

    /**
     * Success
     *
     * This function for show success page after registration
     * 
     * @access	public
     * @return	html data
     */
    public function success() {
        $data['title'] = "Rate-It || Success";
        $data['page'] = "auth/success";
        $this->load->view('login_layout', $data);
    }

    /* End of function */

    /**
     * forgetpassword
     *
     * This function for recover password
     * 
     * @access	public
     * @return	html data
     */
    public function forgot_password() {
        if (isPostBack()) {

			$this->form_validation->set_rules('mobile_number_varify','Mobile Number','trim|required|max_length[10]');
			if ($this->form_validation->run() == FALSE) {
                $data['status']	=	'error';
				$data['error_msg']	=	validation_errors();
            }else {  					
					$result = $this->auth_mod->forgot_password();
					if($result['status']	==	'success')
					{
						
						$data['id'] = $result['result']->id;
						
						
							$data['otp'] = "1234"; //generate_otp();
							$this->auth_mod->update_otp_on_forgot($data);
						
						
						
						$data['status']	=	'success';
						$data['success_msg']	=	'We have sent an OTP on your Mobile Number and Email Address. Kindly verify the same to Reset Your Password !';
						$data['user_id']	    =	$result['result']->id;
						/*sending mail to user's registered email*/
						$email_data['to'] 			= $result['result']->email;
						$email_data['from'] 		= ADMIN_EMAIL;
						$email_data['sender_name'] 	= "Track (The Rest Accounting Key) Admin";
						$email_data['subject'] 		= "Track (The Rest Accounting Key)::OTP Verification";
						$email_data['message'] 		= array('header' => 'Account Created Successfully !',
							'body' => 'Hello <strong style="font-weight: bolder;font-size: 14px;">' . $result['result']->first_name . ', </strong>
													<br/>
												<br/><strong style="font-weight: bolder;font-size: 14px;">Your OTP:</strong> ' . $data['otp'] . '
													<br/><strong style="font-weight: bolder;font-size: 14px;">Please use above OTP then change your password !</strong>    
												<br><br>Thanks,<br/>Track (The Rest Accounting Key)');
						_sendMailPhpMailer($email_data);
						
					}
				else if($result['status']	==	'error'){
				   $data['status']	=	'error';
				   $data['error_msg']	=	'Mobile number is not registered !';
			   }
			}
			echo json_encode($data);
		}
    }

    /* End of function */
	function before_change_pass_otp_verify(){
		if(isPostBack()) {
			$this->form_validation->set_rules('otp_verify','Otp','trim|required');
			$this->form_validation->set_rules('verify_user_id','User Id','trim|required');
			
			if ($this->form_validation->run() == FALSE) {
                $data['status']	=	'error';
				$data['error_msg']	=	validation_errors();
            }else {  					
               $result = $this->auth_mod->before_change_pass_otp_verify();
			   if($result['status']	==	'success')
			   {	$data['user_id'] = $result['result'][0]->id;
					$data['status']	=	'success';
					$data['success_msg']	=	'You have successfully verified. Please change your password !'; 
			   }else if($result['status']	==	'error'){
				   $data['status']	=	'error';
				   $data['error_msg']	=	'Invalid Otp';
			   }
            }
			echo json_encode($data);	
		}
	}
	
	
	
	
    /**
     * changepassword
     *
     * This function for change password
     * 
     * @access	public
     * @return	html data
     */
	 
	 public function change_password() {
        if (isPostBack()) {
				$this->form_validation->set_rules('change_password', 'New Password', 'trim|required');
				$this->form_validation->set_rules('confirm_change_password', 'Confirm Password', 'trim|required|matches[change_password]');
				$this->form_validation->set_rules('user_id_verify','User Id','trim|required');
			if ($this->form_validation->run() === false) {
				$data['status'] = "error";
				$data['error_msg']	=	validation_errors();
			}else{
				$result = $this->auth_mod->change_password();
				$data['status']	=	'success';
				$data['success_msg']	=	'You have successfully changed your password !';
				$data['user_id']	    =	$result['result']->id;
				/*sending mail to user's registered email*/
                $email_data['to'] 			= $result['result']->email;
				$email_data['from'] 		= ADMIN_EMAIL;
				$email_data['sender_name'] 	= "Track (The Rest Accounting Key) Admin";
				$email_data['subject'] 		= "Track (The Rest Accounting Key)::OTP Verification";
				$email_data['message'] 		= array('header' => 'Password Changed !',
					'body' => 'Hello <strong style="font-weight: bolder;font-size: 14px;">' . $result['result']->first_name . ', </strong>
											<br/>
										<br/><strong style="font-weight: bolder;font-size: 14px;"></strong>
											<br/><strong style="font-weight: bolder;font-size: 14px;">Your password is changed please Login.</strong>    
										<br><br>Thanks,<br/>Track (The Rest Accounting Key)');
				_sendMailPhpMailer($email_data);
            }
			echo json_encode($data);
        }
    }
    // public function change_password() {
        // if ($this->session->userdata('isLogin') != 'yes') {
            // redirect('/auth/login');
        // }
        // if (isPostBack()) {
            // $result = $this->auth_mod->change_password();
            // if ($result['status'] == 'success') {
				
				
				// $module_name 		= 	$this->uri->segment(1);
				// $method_name		= 	$this->uri->segment(2);
				// $module_record_id	=	$result['current_user_id'];
				// activity_log($module_name,$method_name,$module_record_id);
				
                // set_flashdata("success", $result['success_msg']);
                // $this->session->set_userdata('logout', '1');
                // /* sending mail to client's registered email */
                // $email_data['from'] = 'no-reply@rate-it.services';
                // $email_data['to'] = trim(currentuserinfo()->email);
                // $email_data['subject'] = "Password changed";
                // $email_data['message'] = $this->load->view("email_templates/changepassword", $result, true);
                // send_mail($email_data);
                // redirect('/auth/changepassword');
            // } else if ($result['status'] == 'error') {
                
            // }
        // }
        //$data['breadcum'] = array("dashboard/" => 'Home', '' => 'Change Password');
        // $data['title'] = "Rate-It || Change Password";
        // $data['page'] = "auth/changepassword";
        // $this->load->view('layout', $data);
    // }

    /* End of function */

    /**
     * logout
     *
     * This function to logout user
     * 
     * @access	public
     * @return	html data
     */
    public function logout() {
        $this->session->sess_destroy();
        redirect('/site');
    }
   
    /* End of function */

    /**
     * goto_admin_panel
     *
     * This function to goto admin panel
     * 
     * @access	public
     * @return	html data
     */
    
    public function goto_admin_panel()
    {   
        $this->session->unset_userdata("userinfo");
        $this->session->unset_userdata("login_type");
        $this->session->unset_userdata('isLogin');
        
        $admin_id   =   $this->session->userdata('idAdmin');
        /*fetch client data*/
        $user_info =  $this->manageclient_mod->fetch_client_data($admin_id);
        $user_info  =   $user_info[0];
        /*setting data into session*/
        $this->session->set_userdata("userinfo", $user_info);
        $this->session->set_userdata("login_type", $user_info->user_type);
        $this->session->set_userdata('isLogin', 'yes');
        $this->session->unset_userdata('isAdmin');
        redirect('/admin/manageclient');
    }
	
	/* End of Function */
}
// End of Class
