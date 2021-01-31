<?php

defined('BASEPATH') OR exit('No direct script access allowed');
/**
     *  Profile Controller
     *
     * @package		Profile
     * @category        Profile
     * @author		Arvind Soni
     * @website		http://www.thealternativeaccount.com
     * @company         thealternativeaccount Inc
     * @since		Version 1.0
     */
class Profile extends CI_Controller {
    

    /**
     * Constructor
     */
    function __construct() {
        parent::__construct();
        is_adminprotected();        
		validate_admin_login();
        $this->load->model('Profile_mod');
        $this->load->model('Advertiser_mod');
    }

    /* End of constructor */

    /**
     * index
     *
     * This function show user profile info
     * 
     * @access	public
     * @return	html data
     */
    public function index() {
        $data['page'] 		= 'profile/profile';
        $data['title'] 		= 'Track (The Rest Accounting Key) || Profile';
        $user_deatils		=$this->session->userdata('userinfo');
        // pr( $user_deatils->state_id); die;
        $data['state']= $this->Advertiser_mod->get_state();
        $data['city']= $this->Advertiser_mod->get_city($user_deatils->state_id);
        // pr( $data['city']); die;
        $data['user_data']	=$this->Profile_mod->profile_deatils($user_deatils->id);
        $data['user']	=$this->Profile_mod->profile_deatils($user_deatils->id);
        
        // pr($data); die;
		$this->load->view('layout', $data);
    }

    /* End of Function */

    /**
     * changeImage
     *
     * this function update user profile image by user id
     * @access	public
     * @return array
     */
    public function changeImage() {

        $user_id = currentuserinfo()->id;

        if (@$_FILES['userfile']['name'] != '') {

            $path = $_FILES['userfile']['name'];
            $ext = pathinfo($path, PATHINFO_EXTENSION);
            $name = md5(time());
            $file_name = $name . "." . $ext;
            $thumb = $name . "_thumb." . $ext;
            $_FILES['userfile']['name'] = $file_name;
            $config['upload_path'] = "./uploads/profile_image/";
            $config['allowed_types'] = 'gif|jpg|png|GIF|JPG|PNG|JPEG|jpeg';
            //$config['max_size'] 		= '2048';
            $this->load->library('upload', $config);

            if (!$this->upload->do_upload()) {
                $error = array('error_msg' => $this->upload->display_errors(), 'status' => 'error');
                echo json_encode($error);
                die;
            } else {
                $config['image_library'] = 'gd2';
                $config['source_image'] = "./uploads/profile_image/$file_name";
                $config['create_thumb'] = true;
                $config['width'] = 200;
                $config['height'] = 200;
                $this->load->library('image_lib', $config);
                $this->image_lib->resize();

                unlink($config['upload_path'] . $file_name);
            }
            $result = $this->Profile_mod->changeImage($user_id, $thumb);
            if ($result['status'] == "success") {
                $userdata = $this->session->userdata("userinfo");
                $userdata->profile_image = $thumb;
                $this->session->set_userdata("userinfo", $userdata);
            }
            $this->session->set_flashdata('success', 'Profile Image updated Successfully.');
            echo json_encode($result);
            die;
        } else {
            $data['status'] = 'error';
            $data['error_msg'] = 'Invalid Request';
            echo json_encode($data);
            die;
        }
    }

    /* END Function */

    /**
     * reset_password
     *
     * this function reset password
     * 
     * @access	public
     * @return	html data
     */
    public function reset_password() {

        $user_id = currentuserinfo()->id;
        if (isPostBack()) {
            $arr = $this->input->post(null, true);

            $result = $this->Profile_mod->reset_password($user_id);

            if ($result['status'] == "success") {

               
                $remember='';
                $this->session->set_userdata('userinfo');
                $this->session->set_userdata('isLogin');
                setcookie('fs_email','',time()+(86400 * 30),"/");
                $this->session->set_flashdata('success','Password changed successfully.');
                redirect('admin/auth/login');
            } else {

                $this->session->set_flashdata('error', $result['error_msg']);
                redirect('admin/profile/reset_password');
            }
        }else{
            $data['result'] = '';
            $data['breadcum'] = 'Reset Password';
            $data['page'] = 'profile/reset_password';
            $data['title'] = 'Track (The Rest Accounting Key) || Reset Password';
            $this->load->view('layout', $data);
        }
    }

    /* END Function */
	
	
	
	public function save_ajax()
    {


        if (isPostBack()) {
            
            $this->form_validation->set_rules('first_name', 'First Name', 'trim|required');
            $this->form_validation->set_rules('last_name', 'Last Name', 'trim|required');
            $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
            $this->form_validation->set_rules('mobile', 'Mobile', 'trim|required|max_length[15]|min_length[7]');
            if ($this->form_validation->run() == false) {

                $result['validation_error'] = validation_errors();
                $result['status'] = 'error';
                echo json_encode($result);

            } else {
				
                $userdata = array(
                    'first_name' => $_POST['first_name'],
                    'last_name' => $_POST['last_name'],
                    'email' => $_POST['email'],
                    'mobile' => $_POST['mobile'],
                );
				$this->session->set_userdata("profile_info", $userdata);
                $result['status'] = 'success';
				

                echo json_encode($result);
            }
        }
    }
	
	function update_profile_data(){
		
        if (isPostBack()) {

            $this->form_validation->set_rules('org_name', 'Organisation Name ', 'trim|required');
            $this->form_validation->set_rules('state', 'State', 'trim|required');
            $this->form_validation->set_rules('city', 'City', 'trim|required');
            $this->form_validation->set_rules('address', 'address', 'trim|required');
			$this->form_validation->set_rules('zip_code', 'Zipcode', 'trim|required|numeric');
            $this->form_validation->set_rules('company_mobile', 'Mobile', 'trim|required|numeric|max_length[15]|min_length[7]');
			// $this->form_validation->set_rules('fax', 'fax', 'trim|required|numeric');
			if ($this->form_validation->run() == false) {
                $result['validation_error'] = validation_errors();
                $result['status'] = 'error';
                echo json_encode($result);
               

            } else {
				
                $advertiser_info=$this->session->userdata('profile_info');
				$data=$this->session->userdata('userinfo');
				 $new_array= array();
                $new_array['organisation_name'] =$_POST['org_name'];
                $new_array['state_id']          =$_POST['state'];
                $new_array['city_id']           =$_POST['city'];
                $new_array['address']           =$_POST['address'];
                $new_array['zipcode']           =$_POST['zip_code'];
                $new_array['mobile_no']         =$_POST['company_mobile'];
                // $new_array['fax']               =$_POST['fax'];
                $new_array['first_name']        =$advertiser_info['first_name'];
                $new_array['last_name']         =$advertiser_info['last_name'];
                $new_array['mobile']            =$advertiser_info['mobile'];
               
				$this->Profile_mod->update($new_array,$data->id);
				$this->session->unset_userdata('profile_info');
				$data->first_name=$advertiser_info['first_name'];
				$data->last_name=$advertiser_info['last_name'];
				$this->session->set_flashdata('success', 'Profile Updated successfully');
                $result['status'] = 'success';
				
				if($data->user_type==1){
					$result['url']='admin/dashboard';
				}
				if($data->user_type==2){
					$result['url']='advertiser/campaign';
				}
				if($data->user_type==3){
					$result['url']='publisher/campaign';
				}
				echo json_encode($result); 
            }
        }
    
	
	}
	
	
	
	
	
	
	
	
	
	
}
