<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Account extends CI_Controller {
    /**
     *  Demo Controller
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
        $this->load->model('Account_mod');	
		$this->load->library('upload');
        $this->load->library('image_lib');
			is_userprotected();
			redirect('admin/auth');
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
			redirect('admin/auth');
    }
    public function edit() {
		if (isPostBack()) {                     
            $this->form_validation->set_rules('first_name', 'First Name',  'trim|required|max_length[35]');
			$this->form_validation->set_rules('last_name', 'Last Name', 'trim|required|max_length[35]');
			$this->form_validation->set_rules('country', 'Country', 'required');
			$this->form_validation->set_rules('state', 'State', 'required');
			$this->form_validation->set_rules('city', 'City', 'required');
			$this->form_validation->set_rules('address', 'Address', 'trim|required');
            if ($this->form_validation->run() == FALSE) {
               
            }else{
			$userfile='';
  		      if($_FILES["userfile"]["name"]){
  		        $uploadedimage=$this->tmpAjaxUploadImage(); //image upload function
                if(!empty($uploadedimage['error'])){
                   set_flashdata('error',$uploadedimage['error']); 
                }
                $userfile=$uploadedimage['upload_data'];
				
  		      }
				  //pr($uploadedimage['upload_data']);die;
                    $this->Account_mod->edit($userfile);
					$userdata = $this->session->userdata("userinfo");
					if($userfile!=''){
						$userdata->profile_image = $userfile;
					}
					$userdata->first_name = $this->input->post('first_name');
					$userdata->last_name = $this->input->post('last_name');
				    $this->session->set_userdata("userinfo", $userdata);
                    set_flashdata('success', 'Account Details updated successfully !');
                    redirect('/account/edit');
                
            }
        }
		$data['my_account_view'] = $this->Account_mod->my_account_view();
		$data['country'] = $this->Account_mod->get_country();
		$data['state'] = $this->Account_mod->get_state($data['my_account_view']->state_id);
	    $data['city'] = $this->Account_mod->get_city($data['my_account_view']->city_id);
		//pr($data['my_account_view']);die;
		$data['breadcum'] = array("site/" => 'Home', '' => 'Account');
        $data['page'] = 'account';
        $data['title'] = 'Track (The Rest Accounting Key) || Account';
        $this->load->view('landing_layout', $data);
    
	}
	
	 public function password() {
		//pr($_POST);die;
		if (isPostBack()) {                
            $this->form_validation->set_rules('old_passowrd', 'Old Password',  'trim|required|max_length[35]');
			$this->form_validation->set_rules('new_passowrd', 'New Password', 'trim|required|max_length[35]');
			$this->form_validation->set_rules('confirm_new_password', 'Confirm Password', 'trim|required|matches[new_passowrd]|max_length[35]');
            if ($this->form_validation->run() == FALSE) {
               
            }else{
					$result = $this->Account_mod->change_passowrd();
					if($result["status"] == "success"){
						set_flashdata('success', 'Password updated successfully !');
						redirect('/account/password');
					}else if($result["status"] == "error"){
						set_flashdata('error',$result["error_msg"]);
						redirect('/account/password');
					}
                }
            }
		//$data['my_account_view'] = $this->Account_mod->my_account_view();
		//pr($data['my_account_view']);die;
		$data['breadcum'] = array("site/" => 'Home', '' => 'Password');
        $data['page'] = 'account/password';
        $data['title'] = 'Track (The Rest Accounting Key) || Password';
        $this->load->view('landing_layout', $data);
    
	}
	
	 public function story() {
		if (isPostBack()) {                
            $this->form_validation->set_rules('story_title', 'Story Title',  'trim|required');
			$this->form_validation->set_rules('story_description', 'Story Description',  'trim|required');
			if ($this->form_validation->run() == FALSE) {
               
            }else{
				$this->Account_mod->edit_my_story();
				set_flashdata('success', 'Story updated successfully !');
				redirect('/account/story');
                
                }
            }
		$data['my_details'] = $this->Account_mod->get_my_details();
		$data['breadcum'] = array("site/" => 'Home', '' => 'Story');
        $data['page'] = 'account/story';
        $data['title'] = 'Track (The Rest Accounting Key) || Story';
        $this->load->view('landing_layout', $data);
    
	}
	
	public function orders() {
		//pr($_POST);die;
		if (isPostBack()) {                
            $this->form_validation->set_rules('old_passowrd', 'Old Password',  'trim|required|max_length[35]');
			$this->form_validation->set_rules('new_passowrd', 'New Password', 'trim|required|max_length[35]');
			$this->form_validation->set_rules('confirm_new_password', 'Confirm Password', 'trim|required|matches[new_passowrd]|max_length[35]');
            if ($this->form_validation->run() == FALSE) {
               
            }else{
					$result = $this->Account_mod->change_passowrd();
					if($result["status"] == "success"){
						set_flashdata('success', 'Password updated successfully');
						redirect('/my_account/change_password');
					}else if($result["status"] == "error"){
						set_flashdata('error',$result["error_msg"]);
						redirect('/my_account/change_password');
					}
                }
            }
		//$data['my_account_view'] = $this->Account_mod->my_account_view();
		//pr($data['my_account_view']);die;
		$data['breadcum'] = array("site/" => 'Home', '' => 'Orders');
        $data['page'] = 'my_account/change_password';
        $data['title'] = 'Track (The Rest Accounting Key) || Change Password';
        $this->load->view('landing_layout', $data);
    
	}
	
	public function addresses() {
		$data['user_addresses'] = $this->Account_mod->user_addresses();
		$data['breadcum'] = array("site/" => 'Home', '' => 'Addresses');
        $data['page'] = 'account/addresses';
        $data['title'] = 'Track (The Rest Accounting Key) || Addesses';
        $this->load->view('landing_layout', $data);
	}
	
	public function tmpAjaxUploadImage()
    {
		$path = $_FILES['userfile']['name'];
		$ext = pathinfo($path, PATHINFO_EXTENSION);
		$name = md5(time());          
		$bfile_name = $name . "." . $ext;
		$thumb = $name . "_evnt_banner." . $ext;            
		$_FILES['userfile']['name']             = $bfile_name;
		$image_path   = './uploads/user_image/';
						if(!is_dir($image_path)) 
						{
							mkdir($image_path,0777, true);
						}
		
		$config['upload_path']                      = $image_path;
		$config['allowed_types']                    = 'gif|jpg|png|GIF|JPG|PNG|JPEG|jpeg';
		$config['max_size'] = '5120';   
		$this->load->library('upload');
		$this->upload->initialize($config);                       
		if (!$this->upload->do_upload('userfile')) {                  
			$error=array('error'=>$this->upload->display_errors());
			return $error;          
		} else {
			
			$config['image_library'] = 'gd2';
			@$config['source_image'] = './uploads/user_image/'.$bfile_name;
			$config['maintain_ratio'] = '0';
			$config['create_thumb'] = true;                
			$config['width'] = 34;
			$config['height'] = 34;  
			$this->image_lib->clear(); // added this line
			$this->image_lib->initialize($config); // added this line 
			$this->image_lib->resize();

			$data=array('upload_data'=>$bfile_name);
			return $data;                
		}

    }
	
	
	public function delete_address(){
		$user_id = $this->input->post('user_id');
		$address_id = $this->input->post('address_id');
		$result = $this->Account_mod->delete_address($address_id,$user_id);
		if($result['status'] == 'success'){
			$res['status'] = 'success';
			set_flashdata('success', 'Address deleted successfully !');
		}else{
			$res['status'] = 'error';
			set_flashdata('error', 'Address not deleted !');
		}
		echo json_encode($res);
	}
	
	public function edit_address($id = ""){
		$id = ID_decode($this->input->get('id'));
		$encoded_id = ID_decode($this->input->get('id'));
		if (isPostBack()) {                
            $this->form_validation->set_rules('country_id', 'Country',  'required');
			$this->form_validation->set_rules('state_id', 'State', 'required');
			$this->form_validation->set_rules('city_id', 'City', 'required');
			$this->form_validation->set_rules('address', 'Address',  'trim|required');
			$this->form_validation->set_rules('zipcode', 'Zipcode', 'trim|required');
			$this->form_validation->set_rules('landmark', 'landmark', 'trim|required');
			$this->form_validation->set_rules('delivery_instruction', 'Delivery Instruction', 'trim|required');
            if ($this->form_validation->run() == FALSE) {
             
            }else{
					$result = $this->Account_mod->edit_address($id);
					if($result["status"] == "success"){
						set_flashdata('success', 'Address updated successfully !');
						redirect('/account/addresses');
					}else if($result["status"] == "error"){
						set_flashdata('error','Address not updated');
						redirect("/account/edit_address?id=$encoded_id");
					}
                }
            }
		$data['user_address'] = $this->Account_mod->get_address_byId($id);
		$data['country'] = $this->Account_mod->get_country();
		$data['state'] = $this->Account_mod->get_state($data['user_address']->state_id);
	    $data['city'] = $this->Account_mod->get_city($data['user_address']->city_id);
		$data['breadcum'] = array("site/" => 'Home', 'account/addresses' => 'Addresses','' => 'Edit Address');
        $data['page'] = 'account/edit_address';
        $data['title'] = 'Track (The Rest Accounting Key) || Edit Address';
        $this->load->view('landing_layout', $data);
	}
	
	public function get_state(){
		$country_id = $this->input->post('country_id');
		$result = $this->Account_mod->get_state_byCountryId($country_id);
		$box = '';
		$box .= '<option value="">Select State</option>';
		if(!empty($result)){
			foreach($result as $key => $val){
				
				$box .= '<option value='.$val->id.'>'.$val->name.'</option>';
			}
		}else{
			$box = '<option value="">No Data Found !</option>';
		}
		echo json_encode($box);
	}
	
	public function get_city(){
		$state_id = $this->input->post('state_id');
		$result = $this->Account_mod->get_city_byStateId($state_id);
		$box = '';
		$box .='<option value="">Select City</option>';
		if(!empty($result)){
			foreach($result as $key => $val){
				$box .= '<option value = '.$val->id.'>'.$val->name.'</option>';
			}
		}else{
				$box = '<option value="">No Data Found !</option>';
			}
		echo json_encode($box);
	}
//===========================================================================================================
//Beacome a chef
//===========================================================================================================	
public function chef(){
	//pr($_POST);die;
		if (isPostBack()) { 
					$result = $this->Account_mod->become_chef_add_edit();
					if($result["result"] == "inserted" ){
						set_flashdata('success', 'Chef Created successfully !');
						redirect('/account/chef');
					}else if($result["result"] == "inserted_no"){
						set_flashdata('success','Chef Created successfully');
						redirect("/account/chef");
					}else{
						set_flashdata('error','Chef not updated !');
						redirect("/account/chef");
					}
                
            }
		$data['get_become_chef'] = $this->Account_mod->get_become_chef();
		$data['get_cuisine'] = $this->Account_mod->get_cuisine();
		//pr($data['get_cuisine']);die;
		$data['breadcum'] = array("site/" => 'Home','' => 'I am a Chef');
        $data['page'] = 'account/chef';
        $data['title'] = 'Track (The Rest Accounting Key) || I am a Chef';
        $this->load->view('landing_layout', $data);
	}

//===========================================================================================================
//Beacome a chef
//===========================================================================================================	    


// ADD ADDRESS FUNCTION  STATRTS HERE

public function add_address($id = ""){
	$id = ID_decode($this->input->get('id'));
		//pr($id);
		if (isPostBack()) {                
            $this->form_validation->set_rules('country_id', 'Country',  'required');
			$this->form_validation->set_rules('state_id', 'State', 'required');
			$this->form_validation->set_rules('city_id', 'City', 'required');
			$this->form_validation->set_rules('address', 'Address',  'trim|required');
			$this->form_validation->set_rules('zipcode', 'Zipcode', 'trim|required');
			$this->form_validation->set_rules('landmark', 'landmark', 'trim|required');
			$this->form_validation->set_rules('delivery_instruction', 'Delivery Instruction', 'trim|required');
            if ($this->form_validation->run() == FALSE) {
             
            }else{
					$result = $this->Account_mod->add_address($id);
					if($result["status"] == "success"){
						set_flashdata('success', 'Address added successfully !');
						redirect('/account/addresses');
					}else if($result["status"] == "error"){
						set_flashdata('error','Address not added');
						redirect("/account/add_address");
					}
                }
            }
		//$data['user_address'] = $this->Account_mod->get_address_byId($id);
		$data['country'] = $this->Account_mod->get_country();
		
		
		$data['breadcum'] = array("site/" => 'Home', 'account/addresses' => 'Addresses','' => 'Add Address');
        $data['page'] = 'account/add_address';
        $data['title'] = 'Track (The Rest Accounting Key) || Add Adddress';
        $this->load->view('landing_layout', $data);
	}


// ENDS ADD ADDRESS FUNCTION   HERE


	
}
// End of Class
