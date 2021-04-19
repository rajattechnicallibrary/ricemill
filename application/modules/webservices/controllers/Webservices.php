<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/webservices/REST_Controller.php';
require APPPATH . '/libraries/webservices/Message.php';

class Webservices extends REST_Controller {
    public $apikey = 'fpcmey2840bg56ud75y007ghg54bsj6410';
    function __construct() {
        parent::__construct();
        $this->load->model('Webservice_model');
       // $
       //// define('API_KEY','fpcmey2840bg56ud75y007ghg54bsj6410');
       // define('ADMIN_NAME','KYI');
    }

    public function registermytoken_post(){
        header('Access-Control-Allow-Origin: *');
        pr($_POST);
        die;
    }

    public function login_post(){
        header('Access-Control-Allow-Origin: *');
        if(isset($_POST['api_key']) && !empty($_POST['api_key'])){
        if(API_KEY == $_POST['api_key']){
            $this->form_validation->set_rules('email','Email','trim|required|valid_email');
            $this->form_validation->set_rules('password','Password','trim|required');
            if ($this->form_validation->run() === true){
                $result = $this->Webservice_model->login();
                if($result['status'] == 'success'){
                    $success = array('responseCode' => '200', 'responseStatus' => 'success', 'responseMessage' => 'Login successfully !', 'data' => $result['result']);
					$this->response($success, 200);
                }else{
                    $error = array('responseCode' => '400', 'responseStatus' => 'error', 'responseMessage' => $result['error_msg']);
					$this->response($error, 200);
                }
            }else{
                $error_msg = validation_errors();
                $error = array('responseCode' => '400', 'responseStatus' => 'error', 'responseMessage' => $error_msg);
                $this->response($error, 200);	
			}
        }else{
			$error_msg = 'API key is invalid';
            $error = array('responseCode' => '400', 'responseStatus' => 'error', 'responseMessage' => $error_msg);
            $this->response($error, 200);
        }
    }else{
			$error_msg = 'api_key field is required !';
            $error = array('responseCode' => '400', 'responseStatus' => 'error', 'responseMessage' => $error_msg);
            $this->response($error, 200);
        }
    }

    public function forgot_password_post(){
         header('Access-Control-Allow-Origin: *');
         if(isset($_POST['api_key']) && !empty($_POST['api_key'])){
        if(API_KEY == $_POST['api_key']){
             $this->form_validation->set_rules('email','Email','trim|required|valid_email');
             if ($this->form_validation->run() === true){
                $result = $this->Webservice_model->forgot_password();
                if($result['status'] == 'success'){

                /*Sending mail with password*/    
				$email_data['to'] = $result['result']->email;
				$email_data['from'] = ADMIN_EMAIL;
				$email_data['sender_name'] = ADMIN_NAME;
				$email_data['subject'] = "Forgot Password";
				$email_data['message'] = array('header' => 'Forgot Password !',
					'body' => '<br/><b> Your Password </b>
					<br/><br/><b>Dear ' .ucfirst( $result['result']->first_name .' '. $result['result']->last_name) . ' ,</b><br>
					<br>Your new password is: ' . $result['new_password'] . ' <br>',
					'mail_footer' => 'Thanks,<br/><br/> Team KYI <br/><br/><br/>');
				_sendEmailNew($email_data);   /* email function for mailjet configuration */
				$success = array('responseCode' => '200', 'responseStatus' => 'success', 'responseMessage' => 'Password Has been Sent Successfully on Your Email Address', 'data' => $result);
				$this->response($success, 200);
                }else{
                    $error = array('responseCode' => '400', 'responseStatus' => 'error', 'responseMessage' => $result['error_msg']);
					$this->response($error, 200);
                }
             }else{
                $error_msg = validation_errors();
                $error = array('responseCode' => '400', 'responseStatus' => 'error', 'responseMessage' => $error_msg);
                $this->response($error, 200);	
			}        
        }else{
			$error_msg = 'API key is invalid';
            $error = array('responseCode' => '400', 'responseStatus' => 'error', 'responseMessage' => $error_msg);
            $this->response($error, 200);
        }
        }else{
			$error_msg = 'api_key field is required !';
            $error = array('responseCode' => '400', 'responseStatus' => 'error', 'responseMessage' => $error_msg);
            $this->response($error, 200);
        }
    }

    public function fetch_myprofile_data_post(){
        header('Access-Control-Allow-Origin: *');
         if(isset($_POST['api_key']) && !empty($_POST['api_key'])){
        if(API_KEY == $_POST['api_key']){
            $this->form_validation->set_rules('id','Id','trim|required');
             if ($this->form_validation->run() === true){
                $result = $this->Webservice_model->fetch_myprofile_data();
                if($result['status'] == 'success'){
                    $success = array('responseCode' => '200', 'responseStatus' => 'success', 'responseMessage' => 'Data found successfully !', 'data' => $result['result']);
					$this->response($success, 200);
                }else{
                    $error = array('responseCode' => '400', 'responseStatus' => 'error', 'responseMessage' => $result['error_msg']);
					$this->response($error, 200);
                }
             }else{
                $error_msg = validation_errors();
                $error = array('responseCode' => '400', 'responseStatus' => 'error', 'responseMessage' => $error_msg);
                $this->response($error, 200);	
			}
        }else{
			$error_msg = 'API key is invalid';
            $error = array('responseCode' => '400', 'responseStatus' => 'error', 'responseMessage' => $error_msg);
            $this->response($error, 200);
        }
        }else{
			$error_msg = 'api_key field is required !';
            $error = array('responseCode' => '400', 'responseStatus' => 'error', 'responseMessage' => $error_msg);
            $this->response($error, 200);
        }
    }

    function alpha_dash_space($str)
{
    return ( ! preg_match("/^([-a-z_ ])+$/i", $str)) ? FALSE : TRUE;
   
} 

    public function update_myprofile_post(){
        header('Access-Control-Allow-Origin: *');
         if(isset($_POST['api_key']) && !empty($_POST['api_key'])){
        if(API_KEY == $_POST['api_key']){
            $this->form_validation->set_rules('id','Id','trim|required');
            $this->form_validation->set_rules('name','Name','required|callback_alpha_dash_space');
            $this->form_validation->set_message("alpha_dash_space", "Manager Name contains only alphabetic characters.");
            $this->form_validation->set_rules('mobile_number','Mobile Number','trim|required|numeric|min_length[10]|max_length[10]', array(
                'min_length' => 'Mobile Number can not be less than 10 digits.','max_length' =>'Mobile Number can not be greater than 10 digits.'
            ));
             if ($this->form_validation->run() === true){
                $result = $this->Webservice_model->update_myprofile_data();
                if($result['status'] == 'success'){
                    $success = array('responseCode' => '200', 'responseStatus' => 'success', 'responseMessage' => $result['success_msg'], 'data' => $result['result']);
					$this->response($success, 200);
                }else{
                    $error = array('responseCode' => '400', 'responseStatus' => 'error', 'responseMessage' => $result['error_msg']);
					$this->response($error, 200);
                }
             }else{
                $error_msg = validation_errors();
                $error = array('responseCode' => '400', 'responseStatus' => 'error', 'responseMessage' => $error_msg);
                $this->response($error, 200);	
			}
        }else{
			$error_msg = 'API key is invalid';
            $error = array('responseCode' => '400', 'responseStatus' => 'error', 'responseMessage' => $error_msg);
            $this->response($error, 200);
        }
        }else{
			$error_msg = 'api_key field is required !';
            $error = array('responseCode' => '400', 'responseStatus' => 'error', 'responseMessage' => $error_msg);
            $this->response($error, 200);
        }
    }

    public function change_password_post(){
         header('Access-Control-Allow-Origin: *');
         if(isset($_POST['api_key']) && !empty($_POST['api_key'])){
        if(API_KEY == $_POST['api_key']){
            $this->form_validation->set_rules('id', 'Id', "trim|required");
            $this->form_validation->set_rules('current_password', 'Current Password', "trim|required");
            $this->form_validation->set_rules('new_password', 'New Password', "trim|required");
            $this->form_validation->set_rules('confirm_password', 'Confirm Password', "trim|required|matches[new_password]");
            if ($this->form_validation->run() === true){
                $result = $this->Webservice_model->change_password();
                if($result['status'] == 'success'){

                    $email_data['to'] 			= $result['result']->email;
					$email_data['from'] 		= ADMIN_EMAIL;
					$email_data['sender_name'] 	= ADMIN_NAME;
					$email_data['subject'] 		= "Change Password";
					$email_data['message'] 		= array('header' => 'Change Password.',
						'body' => '<br/><b>Your Password has been changed successfully</b>',
						'mail_footer' => 'Thanks,<br/><br/> Team KYI <br/><br/><br/>');
					_sendEmailNew($email_data);
                    $success = array('responseCode' => '200', 'responseStatus' => 'success', 'responseMessage' => $result['success_msg']);
					$this->response($success, 200);
                }else{
                    $error = array('responseCode' => '400', 'responseStatus' => 'error', 'responseMessage' => $result['error_msg']);
					$this->response($error, 200);
                }
            }else{
                $error_msg = validation_errors();
                $error = array('responseCode' => '400', 'responseStatus' => 'error', 'responseMessage' => $error_msg);
                $this->response($error, 200);	
			}
        }else{
			$error_msg = 'API key is invalid';
            $error = array('responseCode' => '400', 'responseStatus' => 'error', 'responseMessage' => $error_msg);
            $this->response($error, 200);
        }
        }else{
			$error_msg = 'api_key field is required !';
            $error = array('responseCode' => '400', 'responseStatus' => 'error', 'responseMessage' => $error_msg);
            $this->response($error, 200);
        }
    }


    public function list_clients_post(){
        header('Access-Control-Allow-Origin: *');
        if(isset($_POST['api_key']) && !empty($_POST['api_key'])){
            if(API_KEY == $_POST['api_key']){
                $this->form_validation->set_rules('user_id', 'user id', "trim|required");
                 if ($this->form_validation->run() === true){
                    $result = $this->Webservice_model->list_clients();
                    if($result['status'] == 'success'){
                        $success = array('responseCode' => '200', 'responseStatus' => 'success', 'responseMessage' => $result['success_msg'],'data' => $result['result']);
                        $this->response($success, 200);
                    }else{
                        $error = array('responseCode' => '400', 'responseStatus' => 'error', 'responseMessage' => $result['error_msg']);
                        $this->response($error, 200);
                    }
                 }else{
                $error_msg = validation_errors();
                $error = array('responseCode' => '400', 'responseStatus' => 'error', 'responseMessage' => $error_msg);
                $this->response($error, 200);	
			    }
            }else{
			$error_msg = 'API key is invalid';
            $error = array('responseCode' => '400', 'responseStatus' => 'error', 'responseMessage' => $error_msg);
            $this->response($error, 200);
            }    
        }else{
			$error_msg = 'api_key field is required !';
            $error = array('responseCode' => '400', 'responseStatus' => 'error', 'responseMessage' => $error_msg);
            $this->response($error, 200);
        }
    }

    public function add_client_post(){
         header('Access-Control-Allow-Origin: *');
        if(isset($_POST['api_key']) && !empty($_POST['api_key'])){
            if(API_KEY == $_POST['api_key']){

                $this->form_validation->set_rules('user_id', 'user id', "trim|required");
                //$this->form_validation->set_rules('name', 'Company Name', "trim|required|is_unique[kyi_client.name]");
                $this->form_validation->set_rules('branch', 'Branch', "trim|required");
                $this->form_validation->set_rules('address', 'Address', "trim|required");
                $this->form_validation->set_rules('contact_person_name', 'Contact person name', "trim|required|alpha",array('alpha'=>'Allows alphabets only'));
               // $this->form_validation->set_rules('email', 'Email', "trim|required|valid_email|is_unique[kyi_client.email]");
                $this->form_validation->set_rules('mobile', 'Mobile', "trim|required|numeric|min_length[10]|max_length[10]", array(
                    'min_length' => 'Mobile Number can not be less than 10 digits.','max_length' =>'Mobile Number  can not be greater than 10 digits.'
                ));
                // $this->form_validation->set_message('min_length', "Mobile can not be less than 10 characters.");
                $this->form_validation->set_rules('payment_type', 'Payment type', "trim|required|numeric");
                if(@$_POST['payment_type'] == '1' ||  @$_POST['payment_type'] == '2'){
                    $this->form_validation->set_rules('price_unit', 'Price unit', "trim|required|numeric");
                    $this->form_validation->set_rules('price', 'Price', "trim|required|numeric");
                }
                if(@$_POST['payment_type'] == '2'){
                   $this->form_validation->set_rules('credit_limit', 'Enter Credit limit', "trim|required|numeric");
                }
                if ($this->form_validation->run() === true){
					/*Checking Email should be unique sales person wise or manager wise*/
					$email =  $this->input->post('email');
					//$company_name =  $this->input->post('name');
					$added_by_id = $this->input->post('user_id'); /*This can be sales person or manager*/
					$this->db->select('id');
					$this->db->where('added_by',$added_by_id);
					$this->db->where('email',$email);
					//$this->db->or_where('name',$company_name);
					$email_data = $this->db->get('kyi_client');
					if($email_data->num_rows() > 0){
						$error = array('responseCode' => '400', 'responseStatus' => 'error', 'responseMessage' => "This email  already added by your account.");
                        $this->response($error, 200);
					}
					/*Checking company name should be unique sales person wise or manager wise*/
					//$email =  $this->input->post('email');
					$company_name =  $this->input->post('name');
					$added_by_id = $this->input->post('user_id'); /*This can be sales person or manager*/
					$this->db->select('id');
					$this->db->where('added_by',$added_by_id);
					//$this->db->where('email',$email);
					$this->db->where('name',$company_name);
					$company_data = $this->db->get('kyi_client');
					if($email_data->num_rows() > 0){
						$error = array('responseCode' => '400', 'responseStatus' => 'error', 'responseMessage' => "This  Company Name already added by your account.");
                        $this->response($error, 200);
					}
					//die;
					/*End of Checking Email should be unique sales person wise or manager wise*/
                    $result = $this->Webservice_model->add_client();
                    if($result['status'] == 'success'){
                        $success = array('responseCode' => '200', 'responseStatus' => 'success', 'responseMessage' => $result['success_msg']);
                        $this->response($success, 200);
                    }else{
                        $error = array('responseCode' => '400', 'responseStatus' => 'error', 'responseMessage' => $result['error_msg']);
                        $this->response($error, 200);
                    }
                }else{
                $error_msg = validation_errors();
               // pr($error_msg);die;
                $error = array('responseCode' => '400', 'responseStatus' => 'error', 'responseMessage' => $error_msg);
                $this->response($error, 200);	
			    }
            }else{
			$error_msg = 'API key is invalid';
            $error = array('responseCode' => '400', 'responseStatus' => 'error', 'responseMessage' => $error_msg);
            $this->response($error, 200);
            }
        }else{
			$error_msg = 'api_key field is required !';
            $error = array('responseCode' => '400', 'responseStatus' => 'error', 'responseMessage' => $error_msg);
            $this->response($error, 200);
        }
    }

    public function add_meeting_post(){
         header('Access-Control-Allow-Origin: *');
        if(isset($_POST['api_key']) && !empty($_POST['api_key'])){
            if(API_KEY == $_POST['api_key']){
                $this->form_validation->set_rules('client_id', 'Client id', "trim|required");
                $this->form_validation->set_rules('user_id', 'User id', "trim|required");
                $this->form_validation->set_rules('date', 'Select Date', "trim|required");
                $this->form_validation->set_rules('time', 'Select Time', "trim|required");
                $this->form_validation->set_rules('remark', 'Remarks', "trim|required");
                $this->form_validation->set_rules('location', 'location', "trim|required");
                $this->form_validation->set_rules('lat', 'latitude', "trim|required");
                $this->form_validation->set_rules('long', 'longitude', "trim|required");
                if ($this->form_validation->run() === true){
                    $result = $this->Webservice_model->add_meeting();
                    if($result['status'] == 'success'){
                        $success = array('responseCode' => '200', 'responseStatus' => 'success', 'responseMessage' => $result['success_msg']);
                        $this->response($success, 200);
                    }else{
                        $error = array('responseCode' => '400', 'responseStatus' => 'error', 'responseMessage' => $result['error_msg']);
                        $this->response($error, 200);
                    }
                }else{
                $error_msg = validation_errors();
                $error = array('responseCode' => '400', 'responseStatus' => 'error', 'responseMessage' => $error_msg);
                $this->response($error, 200);	
			    }
            }else{
			$error_msg = 'API key is invalid';
            $error = array('responseCode' => '400', 'responseStatus' => 'error', 'responseMessage' => $error_msg);
            $this->response($error, 200);
            }
        }else{
			$error_msg = 'api_key field is required !';
            $error = array('responseCode' => '400', 'responseStatus' => 'error', 'responseMessage' => $error_msg);
            $this->response($error, 200);
        }
    }

    public function add_campaigns_post(){
         header('Access-Control-Allow-Origin: *');
        if(isset($_POST['api_key']) && !empty($_POST['api_key'])){
            if(API_KEY == $_POST['api_key']){
                $this->form_validation->set_rules('client_id', 'Client id', "trim|required|numeric");
                $this->form_validation->set_rules('user_id', 'User id', "trim|required|numeric");
                $this->form_validation->set_rules('sms_count', 'SMS count', "trim|required|numeric");
                $this->form_validation->set_rules('location', 'Location', "trim|required");
                $this->form_validation->set_rules('content', 'Content', "trim|required");
                $this->form_validation->set_rules('number_edit_to_data_file', 'Number edit to data file', "trim|required|numeric");
                $this->form_validation->set_rules('execution_date', 'Execution date', "trim|required");
                $this->form_validation->set_rules('execution_time', 'Execution time', "trim|required");
				$this->form_validation->set_rules('user_name', 'User Name', "trim|required");
				$this->form_validation->set_rules('vmn', 'VMN', "trim|required");
				$this->form_validation->set_rules('password_cmp', 'Password', "trim|required");
                if ($this->form_validation->run() === true){
                    $result = $this->Webservice_model->add_campaigns();
                    if($result['status'] == 'success'){
                        $success = array('responseCode' => '200', 'responseStatus' => 'success', 'responseMessage' => $result['success_msg']);
                        $this->response($success, 200);
                    }else{
                        $error = array('responseCode' => '400', 'responseStatus' => 'error', 'responseMessage' => $result['error_msg'],'data'=>$result['rest_amount']);
                        $this->response($error, 200);
                    }
                }else{
                $error_msg = validation_errors();
                $error = array('responseCode' => '400', 'responseStatus' => 'error', 'responseMessage' => $error_msg);
                $this->response($error, 200);	
			    }
            }else{
			$error_msg = 'API key is invalid';
            $error = array('responseCode' => '400', 'responseStatus' => 'error', 'responseMessage' => $error_msg);
            $this->response($error, 200);
            }
        }else{
			$error_msg = 'api_key field is required !';
            $error = array('responseCode' => '400', 'responseStatus' => 'error', 'responseMessage' => $error_msg);
            $this->response($error, 200);
        }
    }

    public function check_creditlimit_approve_post(){
         header('Access-Control-Allow-Origin: *');
        if(isset($_POST['api_key']) && !empty($_POST['api_key'])){
            if(API_KEY == $_POST['api_key']){
                $this->form_validation->set_rules('client_id', 'Client id', "trim|required|numeric");
                if ($this->form_validation->run() === true){
                    $result = $this->Webservice_model->check_creditlimit_approve();
                    if($result['status'] == 'success'){
                        $success = array('responseCode' => '200', 'responseStatus' => 'success', 'responseMessage' => $result['success_msg'], 'data' => $result['result']);
                        $this->response($success, 200);
                    }else{
                        $error = array('responseCode' => '400', 'responseStatus' => 'error', 'responseMessage' => $result['error_msg']);
                        $this->response($error, 200);
                    }
                }else{
                $error_msg = validation_errors();
                $error = array('responseCode' => '400', 'responseStatus' => 'error', 'responseMessage' => $error_msg);
                $this->response($error, 200);	
			    }
            }else{
			$error_msg = 'API key is invalid';
            $error = array('responseCode' => '400', 'responseStatus' => 'error', 'responseMessage' => $error_msg);
            $this->response($error, 200);
            }
        }else{
			$error_msg = 'api_key field is required !';
            $error = array('responseCode' => '400', 'responseStatus' => 'error', 'responseMessage' => $error_msg);
            $this->response($error, 200);
        }
    }
	
	
	public function when_add_payment_check_creditlimit__is_approve_post(){
         header('Access-Control-Allow-Origin: *');
        if(isset($_POST['api_key']) && !empty($_POST['api_key'])){
            if(API_KEY == $_POST['api_key']){
                $this->form_validation->set_rules('client_id', 'Client id', "trim|required|numeric");
                if ($this->form_validation->run() === true){
                    $result = $this->Webservice_model->when_add_payment_check_creditlimit__is_approve();
					//pr($result);die;
                    if($result['status'] == 'success'){
                        $success = array('responseCode' => '200', 'responseStatus' => 'success', 'responseMessage' => $result['success_msg'], 'data' => $result['result']);
                        $this->response($success, 200);
                    }else if($result['status'] == 'error'){
                        $error = array('responseCode' => '400', 'responseStatus' => 'error', 'responseMessage' => $result['error_msg']);
                        $this->response($error, 200);
                    }
					if($result['status'] == 'prepaid'){
                        $success = array('responseCode' => '200', 'responseStatus' => 'error', 'responseMessage' => $result['error_msg']);
                        $this->response($success, 200);
                    }
					
                }else{
                $error_msg = validation_errors();
                $error = array('responseCode' => '400', 'responseStatus' => 'error', 'responseMessage' => $error_msg);
                $this->response($error, 200);	
			    }
            }else{
			$error_msg = 'API key is invalid';
            $error = array('responseCode' => '400', 'responseStatus' => 'error', 'responseMessage' => $error_msg);
            $this->response($error, 200);
            }
        }else{
			$error_msg = 'api_key field is required !';
            $error = array('responseCode' => '400', 'responseStatus' => 'error', 'responseMessage' => $error_msg);
            $this->response($error, 200);
        }
    }
	
    public function testingpop_post(){
       if(isset($_POST['api_key']) && !empty($_POST['api_key'])){
           if(API_KEY == $_POST['api_key']){
               $this->form_validation->set_rules('client_id', 'Client id', "trim|required|numeric");
               if ($this->form_validation->run() === true){
                   $result = $this->Webservice_model->testinginsert();
                   //pr($result);die;
                   if($result['status'] == 'success'){
                       $success = array('responseCode' => '200', 'responseStatus' => 'success', 'responseMessage' => $result['success_msg']);
                       $this->response($success, 200);
                   }else if($result['status'] == 'error'){
                       $error = array('responseCode' => '400', 'responseStatus' => 'error', 'responseMessage' => $result['error_msg']);
                       $this->response($error, 200);
                   }
                   if($result['status'] == 'prepaid'){
                       $success = array('responseCode' => '200', 'responseStatus' => 'error', 'responseMessage' => $result['error_msg']);
                       $this->response($success, 200);
                   }
                   
               }else{
               $error_msg = validation_errors();
               $error = array('responseCode' => '400', 'responseStatus' => 'error', 'responseMessage' => $error_msg);
               $this->response($error, 200);	
               }
           }else{
           $error_msg = 'API key is invalid';
           $error = array('responseCode' => '400', 'responseStatus' => 'error', 'responseMessage' => $error_msg);
           $this->response($error, 200);
           }
       }else{
           $error_msg = 'api_key field is required !';
           $error = array('responseCode' => '400', 'responseStatus' => 'error', 'responseMessage' => $error_msg);
           $this->response($error, 200);
       }
   }

    public function add_payment_post(){
         header('Access-Control-Allow-Origin: *');
        if(isset($_POST['api_key']) && !empty($_POST['api_key'])){
             if(API_KEY == $_POST['api_key']){
                $this->form_validation->set_rules('client_id', 'Client id', "trim|required|numeric");
                $this->form_validation->set_rules('user_id', 'User Id', "trim|required|numeric");
                $this->form_validation->set_rules('amount', 'Amount', "trim|required|numeric");
                $this->form_validation->set_rules('payment_ref_number', 'Payment Ref. No.', "trim|required|numeric");
                $this->form_validation->set_rules('payment_mod', 'Mode of Payment', "trim|required|numeric");
                //$this->form_validation->set_rules('transaction_id', 'Transation ID / Cheque No.', "trim|required");   
                //$this->form_validation->set_rules('remark', 'Remarks', "trim|required");
                if ($this->form_validation->run() === true){
                    $result = $this->Webservice_model->add_payment();
                    if($result['status'] == 'success'){
                        $success = array('responseCode' => '200', 'responseStatus' => 'success', 'responseMessage' => $result['success_msg']);
                        $this->response($success, 200);
                    }else{
                        $error = array('responseCode' => '400', 'responseStatus' => 'error', 'responseMessage' => $result['error_msg']);
                        $this->response($error, 200);
                    }
                }else{
                $error_msg = validation_errors();
                $error = array('responseCode' => '400', 'responseStatus' => 'error', 'responseMessage' => $error_msg);
                $this->response($error, 200);	
			    }
             }else{
			$error_msg = 'API key is invalid';
            $error = array('responseCode' => '400', 'responseStatus' => 'error', 'responseMessage' => $error_msg);
            $this->response($error, 200);
            }
        }else{
			$error_msg = 'api_key field is required !';
            $error = array('responseCode' => '400', 'responseStatus' => 'error', 'responseMessage' => $error_msg);
            $this->response($error, 200);
        }
    }

    public function payment_request_list_post(){
         header('Access-Control-Allow-Origin: *');
        if(isset($_POST['api_key']) && !empty($_POST['api_key'])){
             if(API_KEY == $_POST['api_key']){
                //$this->form_validation->set_rules('id', ' payment id', "trim|required|numeric");
                $this->form_validation->set_rules('user_id', ' user id', "trim|required|numeric");
                if ($this->form_validation->run() === true){
                            $result = $this->Webservice_model->payment_request_list();
                         
                            if(is_array( $result) && !empty( $result)){
                                $array_response = array();
                                foreach($result as $key => $val){
                                    $array_response[] = $val; 
                                   // pr($val->created_date);die;
                                    /* Created date only */
                                    if($val->created_date){
                                        $created_date = explode(' ',$val->created_date);
                                        $date 				= view_date_format($created_date[0]);
                                       
                                        //$time 				= $created_date[1];
                                        // 24-hour time to 12-hour time 
                                       // $time_in_12_hour_format  = DATE("g:i a", STRTOTIME($time));
                                        $array_response[$key]->created_date = $date;						
                                        } else {
                                        $array_response[$key]->created_date = '--';		
                                        }
                                }
                            }
                            $success = array('responseCode' => '200', 'responseStatus' => 'success', 'responseMessage' => 'Complaint list', 'data' => $array_response);
                            $this->response($success, 200);
                        } else {
                            $error = array('responseCode' => '400', 'responseStatus' => 'error', 'responseMessage' => 'No data found!');
                            $this->response($error, 200);
                        }	
                    } else {
                        $error_msg = validation_errors();
                        $error = array('responseCode' => '400', 'responseStatus' => 'error', 'responseMessage' => $error_msg);
                        $this->response($error, 200);	
                    }
                 } else {
                    $error = array('responseCode' => '400', 'responseStatus' => 'error', 'responseMessage' => 'Invalid api key!');
                    $this->response($error, 200); 
                 }
            } 


     public function list_ppl_post(){
        header('Access-Control-Allow-Origin: *');
        
           if(isset($_POST['api_key']) && !empty($_POST['api_key'])){
             if(API_KEY == $_POST['api_key']){
                $this->form_validation->set_rules('user_id', ' user id', "trim|required|numeric");
                if ($this->form_validation->run() === true){
                    $result = $this->Webservice_model->list_ppls();
                    if(is_array( $result) && !empty( $result)){
                        $array_response = array();
                        foreach($result as $key => $val){
                            $array_response[] = $val; 
                           // pr($val->created_date);die;
                            /* Created date only */
                            if($val->created_date){
                                $created_date = explode(' ',$val->created_date);
                                $date 				= view_date_format($created_date[0]);
                               
                                $time 				= $created_date[1];
                                // 24-hour time to 12-hour time 
                                $time_in_12_hour_format  = DATE("g:i A", STRTOTIME($time));
                                $array_response[$key]->created_date = $date .", ".$time_in_12_hour_format;						
                                } else {
                                $array_response[$key]->created_date = '--';		
                                }
                        }
                    }
                    $success = array('responseCode' => '200', 'responseStatus' => 'success', 'responseMessage' => 'Complaint list', 'data' => $array_response);
                    $this->response($success, 200);
                } else {
                    $error = array('responseCode' => '400', 'responseStatus' => 'error', 'responseMessage' => 'No data found!');
                    $this->response($error, 200);
                }	
            } else {
                $error_msg = validation_errors();
                $error = array('responseCode' => '400', 'responseStatus' => 'error', 'responseMessage' => $error_msg);
                $this->response($error, 200);	
            }
         } else {
            $error = array('responseCode' => '400', 'responseStatus' => 'error', 'responseMessage' => 'Invalid api key!');
            $this->response($error, 200); 
         }
    } 


    public function ppl_approve_or_amount_post(){
         header('Access-Control-Allow-Origin: *');
        if(isset($_POST['api_key']) && !empty($_POST['api_key'])){
            if(API_KEY == $_POST['api_key']){
                $this->form_validation->set_rules('ppl_id', 'PPL id', "trim|required|numeric");
               // $this->form_validation->set_rules('approve_person_id', 'Approved person id', "trim|required|numeric");
                if ($this->form_validation->run() === true){
                    $result = $this->Webservice_model->ppl_approve_or_amount();
                    //pr($result);die;
                    if($result['status'] == 'success'){
                        $success = array('responseCode' => '200', 'responseStatus' => 'success', 'responseMessage' => $result['success_msg']);
                        $this->response($success, 200);
                    }else{
                        $error = array('responseCode' => '400', 'responseStatus' => 'error', 'responseMessage' => $result['error_msg']);
                        $this->response($error, 200);
                    }
                }else{
                $error_msg = validation_errors();
                $error = array('responseCode' => '400', 'responseStatus' => 'error', 'responseMessage' => $error_msg);
                $this->response($error, 200);	
			    }
            }else{
			$error_msg = 'API key is invalid';
            $error = array('responseCode' => '400', 'responseStatus' => 'error', 'responseMessage' => $error_msg);
            $this->response($error, 200);
            }
        }else{
			$error_msg = 'api_key field is required !';
            $error = array('responseCode' => '400', 'responseStatus' => 'error', 'responseMessage' => $error_msg);
            $this->response($error, 200);
        }
    }


    public function payment_approve_post(){
         header('Access-Control-Allow-Origin: *');
        if(isset($_POST['api_key']) && !empty($_POST['api_key'])){
            if(API_KEY == $_POST['api_key']){
                $this->form_validation->set_rules('id', 'Payment id', "trim|required|numeric");
                $this->form_validation->set_rules('approve_person_id', 'Approved person id', "trim|required|numeric");
                if ($this->form_validation->run() === true){
                    $result = $this->Webservice_model->payment_approve();
                    //pr($result);die;
                    if($result['status'] == 'success'){
                        $success = array('responseCode' => '200', 'responseStatus' => 'success', 'responseMessage' => $result['success_msg']);
                        $this->response($success, 200);
                    }else{
                        $error = array('responseCode' => '400', 'responseStatus' => 'error', 'responseMessage' => $result['error_msg']);
                        $this->response($error, 200);
                    }
                }else{
                $error_msg = validation_errors();
                $error = array('responseCode' => '400', 'responseStatus' => 'error', 'responseMessage' => $error_msg);
                $this->response($error, 200);	
			    }
            }else{
			$error_msg = 'API key is invalid';
            $error = array('responseCode' => '400', 'responseStatus' => 'error', 'responseMessage' => $error_msg);
            $this->response($error, 200);
            }
        }else{
			$error_msg = 'api_key field is required !';
            $error = array('responseCode' => '400', 'responseStatus' => 'error', 'responseMessage' => $error_msg);
            $this->response($error, 200);
        }
    }



    // user details with status


    public function list_users_with_status_post(){
        header('Access-Control-Allow-Origin: *');
        if(isset($_POST['api_key']) && !empty($_POST['api_key'])){
            if(API_KEY == $_POST['api_key']){
                $this->form_validation->set_rules('user_id', 'user id', "trim|required");
                 if ($this->form_validation->run() === true){
                    $result = $this->Webservice_model->list_users_with_status();
                    if($result['status'] == 'success'){
                        $success = array('responseCode' => '200', 'responseStatus' => 'success', 'responseMessage' => $result['success_msg'],'data' => $result['result']);
                        $this->response($success, 200);
                    }else{
                        $error = array('responseCode' => '400', 'responseStatus' => 'error', 'responseMessage' => $result['error_msg']);
                        $this->response($error, 200);
                    }
                 }else{
                $error_msg = validation_errors();
                $error = array('responseCode' => '400', 'responseStatus' => 'error', 'responseMessage' => $error_msg);
                $this->response($error, 200);	
			    }
            }else{
			$error_msg = 'API key is invalid';
            $error = array('responseCode' => '400', 'responseStatus' => 'error', 'responseMessage' => $error_msg);
            $this->response($error, 200);
            }    
        }else{
			$error_msg = 'api_key field is required !';
            $error = array('responseCode' => '400', 'responseStatus' => 'error', 'responseMessage' => $error_msg);
            $this->response($error, 200);
        }
    }

 
    function imageupload_post(){
     header('Access-Control-Allow-Origin: *');
    //die;
        if(isset($_POST['api_key']) && !empty($_POST['api_key'])){
            if($this->apikey == $_POST['api_key']){
                $config['upload_path']          = './uploads/';
                $config['allowed_types']        = '*';
                 $config['encrypt_name']    =   TRUE;
                $this->load->library('upload', $config);
                if ( ! $this->upload->do_upload('file'))
                { 
                    $error = array('error' => $this->upload->display_errors());
                    $error = array('responseCode' => '400', 'responseStatus' => 'error', 'responseMessage' => $error );
                    $this->response($error, 200);
                } 
                else
                {
                        $data = array('upload_data' => $this->upload->data());
                         $result = $this->Webservice_model->add_image($data);
                      //   pr($result);
                        if($result['status'] == 'success'){
                            $success = array('responseCode' => '200', 'responseStatus' => 'success', 'responseMessage' => $result['success_msg']);
                            $this->response($success, 200);
                        }else{
                            $error = array('responseCode' => '400', 'responseStatus' => 'error', 'responseMessage' => $result['error_msg']);
                            $this->response($error, 200);
                        }
                } 
                
            }else{
			$error_msg = 'API key is invalid';
            $error = array('responseCode' => '400', 'responseStatus' => 'error', 'responseMessage' => $error_msg);
            $this->response($error, 200);
            }    
        }else{
			$error_msg = 'api_key field is required !';
            $error = array('responseCode' => '400', 'responseStatus' => 'error', 'responseMessage' => $error_msg);
            $this->response($error, 200);
        }
    }


}