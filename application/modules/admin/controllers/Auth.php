<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {
	
	/**
     *  Auth Controller
     *
     * @package		Auth
     * @category    Auth
     * @author		Arvind Soni
     * @website		http://www.thealternativeaccount.com
     * @company     thealternativeaccount Inc
     * @since		Version 1.0
     */

    /**
     * Constructor
     */
    function __construct() {
        parent::__construct();
        $this->load->model('Auth_mod');
    }

    /* End of constructor */
	
	/**
     *index
     *
     * This function dispaly login page
     * 
     * @access	public
     * @return	html data
    */
	public function index()
	{
            if($this->session->userdata('isLogin') == 'yes'){       	
                redirect(base_url('admin/dashboard'));
            }else{
               
                redirect(base_url('admin/auth/login'));
               
            }
            
    }
    
    public function cron_job(){
        $this->Auth_mod->cron_job_test();
    }
        
         /*End of Function*/
	
    /**
     * Login
     *
     * This function display login page
     * 
     * @access	public
     * @return	html data
    */
        public function login(){
          //  pr(phpinfo()); 
          //  die;
            $this->cron_job();
            if(isPostBack()) 
            {
            
                $this->load->library('form_validation');
                $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
                $this->form_validation->set_rules('password', 'password', 'trim|required');
                if ($this->form_validation->run()) 
                {
            
                   
                $remember   =   $this->input->post('remember',true); 
                $email      =   $this->input->post('email',true); 
                $password   =   $this->input->post('password',true); 
                
                $rs_data    =   $this->Auth_mod->login_authorize();  
                               	
				if($rs_data['status']=="success"){
                 
                   $this->session->set_userdata("userinfo",$rs_data['result']);   
                   $this->session->set_userdata("isLogin",'yes'); 
				   $this->session->set_userdata("user_type",$rs_data['result']->user_type); 
                  
                   $email_enc   =   custom_encryption($email,'ak!@#s$on!','encrypt');
                   $password_enc   =   custom_encryption($password,'ak!@#s$on!','encrypt');
                   if($remember) // set remember username and password in cookie 
                   {
                        setcookie('fs_email',$email_enc,time()+(86400 * 30),"/");
                        setcookie('fs_password',$password_enc,time()+(86400 * 30),"/");
                        setcookie('fs_remember',$remember,time()+(86400 * 30),"/");

                   }else{
                        setcookie('fs_email','',time()+(86400 * 30),"/");
                        setcookie('fs_password','',time()+(86400 * 30),"/");
                        setcookie('fs_remember',$remember,time()+(86400 * 30),"/");
                   }
                  
					if($rs_data['result']->user_type== 1 || $rs_data['result']->user_type== 3){
                        redirect(base_url('admin/dashboard'),'refresh');
					}
                }else{
                    if($rs_data['error_msg'] != '')
                    {
                        $this->session->set_flashdata("error", $rs_data['error_msg']);	
                    }
                    redirect(base_url('admin/auth/login'));
                }



            
                }else{

                    $data['title'] = 'Track (The Rest Accounting Key) || Login';
                    $this->load->view('auth/login', $data);
                }
            }else{
                if ($this->session->userdata('isLogin') == 'yes') {       	
                    redirect(base_url('admin/dashboard'));
                }else{
               
                    $data['title'] = 'Track (The Rest Accounting Key) || Login';
                    $this->load->view('auth/login', $data);
                }
            }
        }
        
        /*End of Function*/
    
    
	
    /**
     *Forget
     *
     * This function send password to user mail in case forget
     * 
     * @access	public
     * @return	html data
     */
    function getToken($length){
        $token = "";
        $codeAlphabet = "KJDASKFJSGLENWELFGYUZDKVAJFVGKUOQIWTEYWEBFSDNVMNMXCSIUFYKSDBFJSGHDFSFBJH";
        $codeAlphabet.= "abcdefghijklmnopqrstujfytfr8t98876gkjhgfuz";
        $codeAlphabet.= "441321165887954321452100215231";
        $max = strlen($codeAlphabet); // edited
   
       for ($i=0; $i < $length; $i++) {
           $token .= $codeAlphabet[rand(0, $max-1)];
       }
   
       return $token;
   }


        public function forgot(){
           $token   =   $this->getToken(50) ;
            if($this->session->userdata('isLogin') == 'yes') {       	
                redirect(base_url('admin/dashboard'));
            }else{
                if(isPostBack()){
                    
                    $this->load->library('form_validation');
                    $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
                    if ($this->form_validation->run()) 
                    {
                        $arr        =   $this->input->post(null,true);
                        $email      =   $this->input->post('email',true);
                        $rs_data    =   $this->Auth_mod->forgot($token);            

                    if($rs_data['valid']){
                        $email_data['to']           =   $email;
                        $email_data['from']         =   ADMIN_EMAIL;
                        $email_data['sender_name']  =  "Track (The Rest Accounting Key) Admin";
                        $email_data['subject']      = 	"Password Reset";
                        $email_data['message']      = 	array(
                                                        'header' =>'Password Reset !',
                    						            'body' =>'Hello <strong style="font-weight: bolder;font-size: 14px;">'.ucfirst($rs_data['name']).', </strong>
                                                        <br/><br><a href="'.base_url().'admin/auth/verifyToken/'.$token."/".email_encoded($email).'"> Your Password Reset Link </a>.<br><br>Regards,<br/>Team Track (The Rest Accounting Key)');
           	
										
        
                _sendMailPhpMailer($email_data) ; 
                

                    set_flashdata('success','Your Reset password link has been send to your Email Address.');
                    redirect(base_url().'admin/auth/forgot');
                    }else{
                        set_flashdata('error','Please enter correct Email Address.');
                        redirect(base_url().'admin/auth/forgot');
                    }


                    }else{

                        $data['title'] = 'Track (The Rest Accounting Key) || Forgot';
                        $this->load->view('auth/forgot', $data);
                    }
                    
                }else{
                    $data['title'] = 'Track (The Rest Accounting Key) || Forgot';
                    $this->load->view('auth/forgot', $data);
                }
                
            }
            
        }

          /**
             * Verify Token
             *
             * This function destroy all saved session
             * 
             * @access	public
             * @return	html data
 */


        public function verifyToken($token, $email)
        {   
            if($this->session->userdata('isLogin') == 'yes') {       	
                redirect(base_url('admin/dashboard'));
            }else{
                if(isset($token) && isset($email)){
                    $rs_data    =   $this->Auth_mod->tokenVerification($token, email_decoded($email));
                    if($rs_data['valid']){
                        $this->session->set_userdata('authenticate','200');
                        $this->session->set_userdata('uid',$rs_data['uid']);
                        redirect(base_url().'admin/auth/changePassword');
                    }else{     
                        $this->session->set_userdata('authenticate','400');                   
                        set_flashdata('error',$rs_data['msg']);
                        redirect(base_url().'admin/auth/forgot');
                    }
                }
                
            }
            
        }
         /*End of Function*/
        
         public function changePassword()
        {   
            if(isPostBack()){
                $this->form_validation->set_rules('new_password', 'New Password', 'trim|required');
				$this->form_validation->set_rules('confirm_password', 'Confirm Password', 'trim|required|matches[new_password]');
			if ($this->form_validation->run() === false) {
				$data['status'] = "error";
				$data['error_msg']	=	validation_errors();
			}else{
                $user_id = $this->session->userdata('uid');
                if(isset($user_id) && !empty($user_id)){
                    $this->session->unset_userdata('uid'); 
                    $this->session->unset_userdata('authenticate');
                    $result = $this->Auth_mod->updatedpassword($user_id);
                    if($result['valid']){

                        set_flashdata('success','You have successfully changed your password');
                        redirect(base_url().'admin/auth/login');
                                                
                    }else{
                        set_flashdata('error','Something went wrong');
                        redirect(base_url().'admin/auth/forgot');
                    }
                }else{
                    set_flashdata('error','Something went wrong');
                    redirect(base_url().'admin/auth/forgot');
                }
            }
            }else{
                if($this->session->userdata('authenticate') != '200') {   
                    $this->session->unset_userdata('authenticate');  	
                    redirect(base_url('admin/auth/forgot'));
                }else{
                    $data['title'] = 'Track (The Rest Accounting Key) || Change Password';
                    $this->load->view('auth/changepassword', $data);
                } 
            }           
        }

      

        /**
     * Logout
     *
     * This function destroy all saved session
     * 
     * @access	public
     * @return	html data
     */
    public function logout() 
    {

        $this->session->sess_destroy();
        redirect(base_url().'admin/auth/login');
    	/*if(currentuserinfo()->user_type==1){
            $this->session->sess_destroy();
            redirect(base_url().'admin/auth/login');	
        } else {
            $this->session->sess_destroy();
            redirect(base_url().'site');	
        }*/
	
    }
    /*End of Function*/

    public function testandRun(){
        echo "iiiiiiiiiiiiiii";
    }
}
