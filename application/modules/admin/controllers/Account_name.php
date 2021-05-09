<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 *  Client Controller
 *
 * @package		Admin
 * @category    Client
 * @author		
 * @website		http://www.thealternativeaccount.com
 * @company     thealternativeaccount Inc
 * @since		Version 1.0
 */
class Account_name extends CI_Controller {

    function __construct() {
        parent::__construct();
		date_default_timezone_set('Asia/Kolkata');
		$this->load->model('AccountName_mod');
		is_adminprotected();
		validate_admin_login();
            
    }

    /* End of constructor */

    /**
     * index
     *
     * This function show list of Client
     * 
     * @access	public
     * @return	html data
     */
    

	public function index($pageno=1)
    {

       $this->listing();
    }
	
	public function smsapi(){
		$apiKey = urlencode('Svp9MNjCkmA-28pROePEJhhgKmB1Ip9l01wC0UWBHk');
	
		// Message details
		$numbers = array(8887905070);
		$sender = urlencode('TXTLCL');
		$message = rawurlencode('This is your message');
	 
		$numbers = implode(',', $numbers);
	 
		// Prepare data for POST request
		$data = array('apikey' => $apiKey, 'numbers' => $numbers, "sender" => $sender, "message" => $message);
	 
		// Send the POST request with cURL
		$ch = curl_init('https://api.textlocal.in/send/');
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$response = curl_exec($ch);
		curl_close($ch);
		
		// Process your response here
		echo $response;
	}


	public function add(){
		// pr($_POST); die;
        if (isPostBack()) {
            
            $this->form_validation->set_rules('account_name', 'Account Name', 'trim|required');
			$this->form_validation->set_rules('contact_person_number', 'Mobile No', 'trim');
			$this->form_validation->set_rules('status', 'Status', 'trim|required');
            
			if ($this->form_validation->run() == false) {
            } else {

				
				$userdata = array(
					'name' => $_POST['account_name'],
					'contact_person_number' => $_POST['contact_person_number'],
					'added_by' => $this->session->userdata('userinfo')->id,
					'status' => $_POST['status'],
					'updated_date' =>  date("Y-m-d"),
				);
				$result = $this->AccountName_mod->add($userdata);
				set_flashdata('success', 'Account Name Added successfully');
				redirect('/admin/account_name');     
            }
        }
		
		$data['page'] = 'accountname/add';
		$data['title'] = "Track (The Rest Accounting Key) || Add";
		
        $this->load->view('layout', $data);
	}
	
	
	
	function edit($id = null){
		$city_id = ID_decode($id);
        if (isPostBack()) {
            $city_id = ID_decode($id);
			$this->form_validation->set_rules('account_name', 'Account Name', 'trim|required');
			$this->form_validation->set_rules('contact_person_number', 'Mobile No', 'trim');
			$this->form_validation->set_rules('status', 'Status', 'trim|required');
            if ($this->form_validation->run() == FALSE) {
            } else {
				$userdata = array(
					'name' => $_POST['account_name'],
					'contact_person_number' => $_POST['contact_person_number'],
					'added_by' => $this->session->userdata('userinfo')->id,
					'status' => $_POST['status'],
					'updated_date' =>  date("Y-m-d"),
				);
				$this->AccountName_mod->edit($city_id, $userdata);
				set_flashdata('success', 'Account Name updated successfully');
				redirect('/admin/account_name');
            }
        }
		$data['result'] = $this->AccountName_mod->view($city_id);    
		$data['page'] = 'accountname/add';
		$data['title'] = "Track (The Rest Accounting Key) || Edit";
		$this->load->view('layout', $data);
	}
	
	

	public function listing(){
		
		$data['page'] = 'accountname/listing';
        $data['title'] = "Track (The Rest Accounting Key) || Listing";
        // $data['pageno'] = $pageno;
        //$data['users']= $this->Advertiser_mod->listing();
        $this->load->view('layout', $data);
	}


	public function view($id =null){
		
       
        $data['page'] = 'accountname/view';
        $data['title'] = "Track (The Rest Accounting Key) || Billing View";
		$data['users']= $this->AccountName_mod->Billing_details($id);
		$this->load->view('layout', $data);
		
		
	}
	
	public function view_all() {
        $requestData    = $this->input->post(null,true);
        /*Counting warehouse data*/
        $query          =   $this->AccountName_mod->count_Billing_data();
        $totalData      =   $query->num_rows();
        // pr($query->num_rows()); die;
        $totalFiltered  =   $totalData;  //
        /*End of counting warehouse data*/
        
       // $d = array('id' => 'city_id', 'name' => 'name', 'status' => 'status');
        $citydata = $this->AccountName_mod->get_Billing_data(); 
		// pr(count($citydata));
		// die;
        //   die;     
        $data   =   array();
        if(count($citydata) > 0)
        {
            $j = $requestData['start'];
            for( $i=0; $i<count($citydata);$i++ ) 
            {  
                $j++;
                $row    =   (array)$citydata[$i];
				$nestedData     =   array();
                $nestedData[]   =   $j;
                
                // $nestedData[]   =   '<a href="'.base_url().'admin/accountname/view/'.ID_encode($row['account_id']).'">'.$row['account_id'].'</a>';
                $nestedData[]   =   $row["account_id"];
				$nestedData[]   =   $row["name"];
				$nestedData[]   =   $row["contact_person_number"];
                // $nestedData[]   =   $row["site_name"];
                // $nestedData[]   =   $row["gst_amount"];

				$nestedData[]   =   $this->load->view("accountname/_action", array("row" => $row), true);
				// pr($nestedData); die;
                $data[]         =   $nestedData;
            }
        }

        $json_data = array(
            "draw"            => intval( $requestData['draw'] ),   // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw. 
            "recordsTotal"    => intval( $totalData ),  // total number of records
            "recordsFiltered" => intval( $totalFiltered ), // total number of records after searching, if there is no searching then totalFiltered = totalData
            "data"            => $data   // total data array
        );

        echo json_encode($json_data);  // send data as json format
	}
	

}

/*End of class*/