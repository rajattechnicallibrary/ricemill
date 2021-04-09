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
class Setting extends CI_Controller {

    function __construct() {
        parent::__construct();
		date_default_timezone_set('Asia/Kolkata');
		$this->load->model('Setting_mod');
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

        $data['page'] = 'billing/listing';
        $data['title'] = "Track (The Rest Accounting Key) || Billing Listing";
        $data['pageno'] = $pageno;
        //$data['users']= $this->Advertiser_mod->listing();
        $this->load->view('layout', $data);
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

	public function billingCyle(){
		echo $this->Setting_mod->checkRandomEntery();
	}
	public function account_name(){
		echo json_encode($this->Setting_mod->account_name());
		//echo $data;
	}

	public function deposite(){
		// pr($_POST); die;
        if (isPostBack()) {
            
            $this->form_validation->set_rules('billing_date', 'Billing Date', 'trim|required');
            $this->form_validation->set_rules('khata_entry_no', 'Khata Entry No', 'trim|required');
            $this->form_validation->set_rules('challan_no', 'Challan No.', 'trim|required');
            $this->form_validation->set_rules('account_name', 'Account name', 'trim|required');
			$this->form_validation->set_rules('type_of_account', 'account_type', 'trim|required');

			$this->form_validation->set_rules('remark', 'Remark', 'trim');
			
            $this->form_validation->set_rules('karch_amount', 'Final Amount', 'trim|required');
			$this->form_validation->set_rules('status', 'Status', 'trim|required');

			if ($this->form_validation->run() == false) {
            } else {
				$old_date = $_POST['billing_date'];   
				$this->session->set_userdata('billing_date',$_POST['billing_date']); 
				         // works

				$middle = strtotime($old_date);             // returns bool(false)
		
				$new_date = date('Y-m-d', $middle);
				$isFoundAccountDetail = explode('_',$_POST['account_name']);
				if(count($isFoundAccountDetail) == 1){
					pr('not found');
					$userdata = array(
						'name' =>$_POST['account_name'],
						'added_by' => $this->session->userdata('userinfo')->id,
						'status' => $_POST['status'],
					);
					$lastid = $this->Setting_mod->add_account($userdata);
					$userdata = array(
						'rokad_date' =>$new_date,
						'rokad_entry_no' => $_POST['khata_entry_no'],
						'challan_no' => $_POST['challan_no'],
						'type_of_account' => $_POST['type_of_account'],
						'remark' => $_POST['remark'],
						'account_name' => $_POST['account_name'],
						'karch_amount' => $_POST['karch_amount'],
						'added_by' => $this->session->userdata('userinfo')->id,
						'status' => $_POST['status'],
						'account_no' =>$lastid					
					);
				}else{
					$userdata = array(
						'rokad_date' =>$new_date,
						'rokad_entry_no	' => $_POST['khata_entry_no'],
						'challan_no' => $_POST['challan_no'],
						'type_of_account' => $_POST['type_of_account'],
						'remark' => $_POST['remark'],
						'account_name' => $_POST['account_name'],
						'karch_amount' => $_POST['karch_amount'],
						'added_by' => $this->session->userdata('userinfo')->id,
						'status' => $_POST['status'],
						'account_no'=>$isFoundAccountDetail[1]				
					);
				}
				$result = $this->Setting_mod->add($userdata);
			//	$result = $this->Setting_mod->getCurrentDataForExpenses($userdata);
				set_flashdata("success", "Account added successfully.");
				redirect('/admin/account/deposite');     
            }
        }
		
		$data['page'] = 'account/add';
		$data['title'] = "Track (The Rest Accounting Key) || Add";
		
        $this->load->view('layout', $data);
	}

	public function expenditure(){
		// pr($_POST); die;
        if (isPostBack()) {
            
            $this->form_validation->set_rules('billing_date', 'Billing Date', 'trim|required');
            $this->form_validation->set_rules('khata_entry_no', 'Khata Entry No', 'trim|required');
            $this->form_validation->set_rules('challan_no', 'Challan No.', 'trim|required');
            $this->form_validation->set_rules('account_name', 'Account name', 'trim|required');
			$this->form_validation->set_rules('type_of_account', 'account_type', 'trim|required');
			$this->form_validation->set_rules('remark', 'Remark', 'trim');
            $this->form_validation->set_rules('karch_amount', 'Final Amount', 'trim|required');
			$this->form_validation->set_rules('status', 'Status', 'trim|required');

			if ($this->form_validation->run() == false) {
            } else {
				$old_date = $_POST['billing_date'];   
				$this->session->set_userdata('billing_date',$_POST['billing_date']); 
				//pr($this->session->all_userdata('billing_date'));      // works
			//	die;
				$middle = strtotime($old_date);             // returns bool(false)
				$new_date = date('Y-m-d', $middle);
				$isFoundAccountDetail = explode('_',$_POST['account_name']);
				if(count($isFoundAccountDetail) == 1){
					$userdata = array(
						'name' =>$_POST['account_name'],
						'added_by' => $this->session->userdata('userinfo')->id,
						'status' => $_POST['status'],
					);
					$lastid = $this->Setting_mod->add_account($userdata);
					$userdata = array(
						'rokad_date' =>$new_date,
						'rokad_entry_no' => $_POST['khata_entry_no'],
						'challan_no' => $_POST['challan_no'],
						'type_of_account' => $_POST['type_of_account'],
						'remark' => $_POST['remark'],
						'rokad_type' => $_POST['rokad_type'],
						'account_name' => $_POST['account_name'],
						'karch_amount' => $_POST['karch_amount'],
						'added_by' => $this->session->userdata('userinfo')->id,
						'status' => $_POST['status'],
						'account_no' =>$lastid					
					);
				}else{
					$userdata = array(
						'rokad_date' =>$new_date,
						'rokad_entry_no	' => $_POST['khata_entry_no'],
						'challan_no' => $_POST['challan_no'],
						'type_of_account' => $_POST['type_of_account'],
						'remark' => $_POST['remark'],
						'rokad_type' => $_POST['rokad_type'],
						'account_name' => $_POST['account_name'],
						'karch_amount' => $_POST['karch_amount'],
						'added_by' => $this->session->userdata('userinfo')->id,
						'status' => $_POST['status'],
						'account_no'=>$isFoundAccountDetail[1]				
					);
				}
				$result = $this->Setting_mod->add($userdata);
				set_flashdata("success", "Expenditure added successfully.");
				redirect('/admin/account/expenditure');     
            }
        }
		
		$data['page'] = 'expense/add';
		$data['title'] = "Track (The Rest Accounting Key) || Add";
		
        $this->load->view('layout', $data);
	}
	
	
	
	function edit($id = null){
		
		$city_id = ID_decode($id);
        if (isPostBack()) {
            $city_id = ID_decode($id);
			$this->form_validation->set_rules('billing_date', 'Billing Date', 'trim|required');
            $this->form_validation->set_rules('truck_no', 'Truck No', 'trim|required');
            $this->form_validation->set_rules('challan_no', 'Challan No.', 'trim|required');
            $this->form_validation->set_rules('bill_no', 'Bill No', 'trim|required');
			$this->form_validation->set_rules('quality', 'Quality', 'trim|required');

            $this->form_validation->set_rules('quantity', 'Quantity', 'trim|required');
            $this->form_validation->set_rules('purchaser_name', 'Purchaser Name', 'trim|required');
			$this->form_validation->set_rules('purchaser_rate', 'Purchaser Rate', 'trim|required');
			
            $this->form_validation->set_rules('purchaser_amount', 'Purchaser Amount', 'trim|required');
            $this->form_validation->set_rules('site_name', 'Site Name', 'trim|required');
            $this->form_validation->set_rules('seller_name', 'Seller Name', 'trim|required');
            $this->form_validation->set_rules('site_name', 'Site Name', 'trim|required');
            $this->form_validation->set_rules('seller_rate', 'Seller Rate', 'trim|required');
			$this->form_validation->set_rules('seller_amount', 'Seller Amount', 'trim|required');
			
            $this->form_validation->set_rules('profit', 'Profit', 'trim|required');
            $this->form_validation->set_rules('cgst', 'CGST', 'trim|required');
            $this->form_validation->set_rules('sgst', 'SGST', 'trim|required');
            $this->form_validation->set_rules('gst_amount', 'After GST Amount', 'trim|required');
			$this->form_validation->set_rules('status', 'Status', 'trim|required');
           
            if ($this->form_validation->run() == FALSE) {
                
            } else {
				$old_date = $_POST['billing_date'];            // works

				$middle = strtotime($old_date);             // returns bool(false)
		
                $new_date = date('Y-m-d', $middle);
				
				
				
                /*check name for pre existance*/
				//$city_name        =   $this->input->post('city_name');
				$userdata = array(
					'billing_date' =>$new_date,
					'truck_no' => $_POST['truck_no'],
					'challan_no' => $_POST['challan_no'],
					'bill_no' => $_POST['bill_no'],
					'quality' => $_POST['quality'],
					'quantity' => $_POST['quantity'],
					'purchaser_name' => $_POST['purchaser_name'],
					'purchaser_rate' => $_POST['purchaser_rate'],
					'purchaser_amount' => $_POST['purchaser_amount'],
					'site_name' => $_POST['site_name'],
					'seller_name' => $_POST['seller_name'],
					'seller_rate' => $_POST['seller_rate'],
					'seller_amount' => $_POST['seller_amount'],
					'profit' => $_POST['profit'],
					'cgst' => $_POST['cgst'],
					'sgst' => $_POST['sgst'],
					'gst_amount' => $_POST['gst_amount'],
					'added_by' => $this->session->userdata('userinfo')->id,
					'status' => $_POST['status'],
					'created_date' =>  date("Y-m-d"),
					
				);
				$this->Setting_mod->edit($city_id, $userdata);
				$data['pdf_data'] = $this->Setting_mod->Billing_details($city_id);
				generate_kyi_invoice_pdf($data);
				set_flashdata('success', 'Billing updated successfully');
				redirect('/admin/billing/listing');
            }
        }
		$data['result'] = $this->Setting_mod->view($city_id);    

		$data['quality']	=	$this->Setting_mod->quality_details();
		$data['purchaser']	=	$this->Setting_mod->purchaser_details();
		$data['site']		=	$this->Setting_mod->site_details();
		$data['seller']		=	$this->Setting_mod->seller_details();
		$data['sgst']		=	$this->Setting_mod->sgst();


		//$data['newdata'] = $newdata;
		//pr($data); die;
		$data['page'] = 'billing/add';
		$data['title'] = "Track (The Rest Accounting Key) || Edit";
		$this->load->view('layout', $data);
		
	}
	
	

	public function listing(){
		
		$data['page'] = 'billing/listing';
        $data['title'] = "Track (The Rest Accounting Key) || Billing Listing";
        // $data['pageno'] = $pageno;
        //$data['users']= $this->Advertiser_mod->listing();
        $this->load->view('layout', $data);
	}


	public function change_fy($id =null){
		
		if (isPostBack()) {
			//pr($_POST);
			//die;
			$userdata = array(
				'template_id' =>$_POST['template_fy'],
				'status' =>'Active',
			);
			$data['fy']= $this->Setting_mod->add_fy($userdata);
			set_flashdata('success', 'Financial Year Loaded Successfully');
		}
        $data['page'] = 'setting/view';
        $data['title'] = "Track (The Rest Accounting Key) || Billing View";
		$data['fy']= $this->Setting_mod->get_all_financial_year();
		// pr($data); die;
		$this->load->view('layout', $data);
		
		
	}
	
	public function view_all() {
        $requestData    = $this->input->post(null,true);
        /*Counting warehouse data*/
        $query          =   $this->Setting_mod->count_Billing_data();
        $totalData      =   $query->num_rows();
        // pr($query->num_rows()); die;
        $totalFiltered  =   $totalData;  //
        /*End of counting warehouse data*/
        
       // $d = array('id' => 'city_id', 'name' => 'name', 'status' => 'status');
        $citydata = $this->Setting_mod->get_Billing_data(); 
	 
          // die;     
        $data   =   array();
        if(count($citydata)>0)
        {
            $j = $requestData['start'];
            for( $i=0; $i<count($citydata);$i++ ) 
            {  
                $j++;
                $row    =   (array)$citydata[$i];
				$nestedData     =   array();
                $nestedData[]   =   $j;
                
                $nestedData[]   =   '<a href="'.base_url().'admin/billing/view/'.ID_encode($row['id']).'">'.$row['truck_no'].'</a>';
				$nestedData[]   =   $row["purchaser_name"];
				$nestedData[]   =   $row["seller_name"];
                $nestedData[]   =   $row["seller_amount"];
                $nestedData[]   =   $row["site_name"];
                $nestedData[]   =   $row["gst_amount"];

				$nestedData[]   =   $this->load->view("billing/_action", array("row" => $row), true);
				//pr($nestedData); die;
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
	
	public function gen(){
		// pr($this->Setting_mod->Billing_details('2')); die;
		

	}

	
	

}

/*End of class*/