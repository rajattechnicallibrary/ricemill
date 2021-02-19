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
class Report extends CI_Controller {

    function __construct() {
        parent::__construct();
		date_default_timezone_set('Asia/Kolkata');
		$this->load->model('Report_mod');
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

        $data['page'] = 'report/listing';
        $data['title'] = "Track (The Rest Accounting Key) || Report Listing";
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
		echo $this->Report_mod->checkRandomEntery();
	}
	public function account_name(){
		echo json_encode($this->Report_mod->account_name());
		//echo $data;
	}

	public function add(){
		// pr($_POST); die;
        if (isPostBack()) {
            
            $this->form_validation->set_rules('billing_date', 'Billing Date', 'trim|required');
            $this->form_validation->set_rules('khata_entry_no', 'Khata Entry No', 'trim|required');
            $this->form_validation->set_rules('challan_no', 'Challan No.', 'trim|required');
            $this->form_validation->set_rules('account_name', 'Account name', 'trim|required');
			$this->form_validation->set_rules('type_of_account', 'account_type', 'trim|required');

            $this->form_validation->set_rules('rate', 'rate', 'trim|required');
            $this->form_validation->set_rules('total_weight', 'Total Weight', 'trim|required');
			$this->form_validation->set_rules('total_katti', 'Total Katti', 'trim|required');
			
            $this->form_validation->set_rules('final_amount', 'Final Amount', 'trim|required');
			$this->form_validation->set_rules('status', 'Status', 'trim|required');

			if ($this->form_validation->run() == false) {
            } else {
				$old_date = $_POST['billing_date'];            // works

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
					$lastid = $this->Report_mod->add_account($userdata);
					$userdata = array(
						'billing_date' =>$new_date,
						'khata_entry_no' => $_POST['khata_entry_no'],
						'challan_no' => $_POST['challan_no'],
						'purchaser_account_name' => $_POST['account_name'],
						'type_of_account' => $_POST['type_of_account'],
						'rate' => $_POST['rate'],
						'total_weight' => $_POST['total_weight'],
						'total_katti' => $_POST['total_katti'],
						'final_amount' => $_POST['final_amount'],
						'added_by' => $this->session->userdata('userinfo')->id,
						'status' => $_POST['status'],
						'billing_type' =>  $_POST['payment_type'],
						'purchaser_account_no' =>$lastid					
					);
				}else{
					$userdata = array(
						'billing_date' =>$new_date,
						'khata_entry_no' => $_POST['khata_entry_no'],
						'challan_no' => $_POST['challan_no'],
						'purchaser_account_name' => $_POST['account_name'],
						'type_of_account' => $_POST['type_of_account'],
						'rate' => $_POST['rate'],
						'total_weight' => $_POST['total_weight'],
						'total_katti' => $_POST['total_katti'],
						'final_amount' => $_POST['final_amount'],
						'added_by' => $this->session->userdata('userinfo')->id,
						'status' => $_POST['status'],
						'billing_type' =>  $_POST['payment_type'],	
						'purchaser_account_no'=>$isFoundAccountDetail[1]				
					);
				}
				$result = $this->Report_mod->add($userdata);
				set_flashdata("success", "Billing added successfully.");
				redirect('/admin/report/add');     
            }
        }
		
		$data['page'] = 'report/add';
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
				$this->Report_mod->edit($city_id, $userdata);
				$data['pdf_data'] = $this->Report_mod->Billing_details($city_id);
				generate_kyi_invoice_pdf($data);
				set_flashdata('success', 'Billing updated successfully');
				redirect('/admin/report/listing');
            }
        }
		$data['result'] = $this->Report_mod->view($city_id);    

		$data['quality']	=	$this->Report_mod->quality_details();
		$data['purchaser']	=	$this->Report_mod->purchaser_details();
		$data['site']		=	$this->Report_mod->site_details();
		$data['seller']		=	$this->Report_mod->seller_details();
		$data['sgst']		=	$this->Report_mod->sgst();


		//$data['newdata'] = $newdata;
		//pr($data); die;
		$data['page'] = 'report/add';
		$data['title'] = "Track (The Rest Accounting Key) || Edit";
		$this->load->view('layout', $data);
		
	}
	
	

	public function listing(){
		
		$data['page'] = 'report/listing';
        $data['title'] = "Track (The Rest Accounting Key) || Billing Listing";
        // $data['pageno'] = $pageno;
        //$data['users']= $this->Advertiser_mod->listing();
        $this->load->view('layout', $data);
	}


	public function view($id =null){
		
       
        $data['page'] = 'report/view';
        $data['title'] = "Track (The Rest Accounting Key) || Billing View";
		$data['users']= $this->Report_mod->Billing_details($id);
		$this->load->view('layout', $data);
		
		
	}

	// public function getthLastBill(){
	// 	if (isPostBack()){
	// 		$data = $this->Report_mod->getCurrentDataForExpenses($id);
	// 		$data = $this->Report_mod->getCurrentDataForDeposit();
	// 		pr($data);
	// 	}
	// }
	public function search($id =null){
		if (isPostBack()) {
			//pr($_POST);
			//die;
			$isFoundAccountDetail = explode('_',$_POST['search_name']);
			$data['expenses'] = $this->Report_mod->fetchtheFinalAmountexpenses($isFoundAccountDetail[1]);
			$data['deposit'] = $this->Report_mod->fetchtheFinalAmountdeposit($isFoundAccountDetail[1]);
			$data['Finaldeposit'] = '';
			$data['Finalexpenses'] = '';
		//	pr($data['expenses']->expenses);
			if($data['expenses']->expenses != '' && ($data['expenses']->expenses > $data['deposit']->deposit)){
				$data['Finalexpenses']  = $data['expenses']->expenses - $data['deposit']->deposit;
			}else if ($data['deposit']->deposit != '' && ($data['deposit']->deposit > $data['expenses']->expenses  )) {
				$data['Finaldeposit'] = $data['deposit']->deposit - $data['expenses']->expenses;
			}
			//if($data['deposit']->deposit > $data['expenses']->expense)
			$this->Report_mod->logSearchResult($data, $isFoundAccountDetail);

			// generate_kyi_invoice_pdf($data);
			echo json_encode($data);
			return;			
		}
       
        $data['page'] = 'report/search';
        $data['title'] = "Track (The Rest Accounting Key) || Search Report";
	//	$data['users']= $this->Report_mod->Billing_details($id);
		$this->load->view('layout', $data);
		
		
	}

	public function byaccount_name(){
			if (isPostBack()) {
			//pr($_POST);
			//die;
			$isFoundAccountDetail = explode('_',$_POST['search_name']);
			$data['expenses'] = $this->Report_mod->fetchtheFinalAmountexpenses($isFoundAccountDetail[1]);
			$data['deposit'] = $this->Report_mod->fetchtheFinalAmountdeposit($isFoundAccountDetail[1]);
			$data['Finaldeposit'] = '';
			$data['Finalexpenses'] = '';
		//	pr($data['expenses']->expenses);
			if($data['expenses']->expenses != '' && ($data['expenses']->expenses > $data['deposit']->deposit)){
				$data['Finalexpenses']  = $data['expenses']->expenses - $data['deposit']->deposit;
			}else if ($data['deposit']->deposit != '' && ($data['deposit']->deposit > $data['expenses']->expenses  )) {
				$data['Finaldeposit'] = $data['deposit']->deposit - $data['expenses']->expenses;
			}
			//if($data['deposit']->deposit > $data['expenses']->expense)
			$this->Report_mod->logSearchResult($data, $isFoundAccountDetail);

			// generate_kyi_invoice_pdf($data);
			echo json_encode($data);
			return;			
		}
		
        $data['page'] = 'report/view';
        $data['title'] = "Track (The Rest Accounting Key) || Search Report";
		$data['users']= $this->Report_mod->Billing_details();
		//$data['expenses']= $this->Report_mod->expenses_Billing_details();
		// pr($data);
		//$count[] = count($data['expenses']);
		//$count[] = count($data['deposit']);
		//$count = max($count);
		// echo $count;
		// echo "<br>";
		//echo  count($data['deposit']);
		// die;
		//$newdata = [];
		// for( $i=0; $i<($count);$i++ ) 
		// {  
			
		// 	if($data['deposit'][$i]->account_no == $data['expenses'][$i]->account_no ){
		// 		pr($data['expenses'][$i]);
			
		// 	}

			
		// }
		$this->load->view('layout', $data);
		
	}
	
	public function mytotalkisanvahi(){
		if (isPostBack()) {
			$isFoundAccountDetail = explode('_',$_POST['search_name']);
		//	pr($isFoundAccountDetail); die;
			echo json_encode($this->Report_mod->fetchsearchReportbykishanvahi($isFoundAccountDetail[1]));
		}
	}
	public function Listmytotalkisanvahi(){
		if (isPostBack()) {
			$isFoundAccountDetail = explode('_',$_POST['search_name']);
			//pr($isFoundAccountDetail); die;
			echo json_encode($this->Report_mod->Listmytotalkisanvahi($isFoundAccountDetail[1]));
		}
	}
	public function ListmytotalDeposit(){
		if (isPostBack()) {
			$isFoundAccountDetail = explode('_',$_POST['search_name']);
			//pr($isFoundAccountDetail); die;
			echo json_encode($this->Report_mod->ListmytotalDeposit($isFoundAccountDetail[1]));
		}
	}
	public function ListmytotalExpenses(){
		if (isPostBack()) {
			$isFoundAccountDetail = explode('_',$_POST['search_name']);
			//pr($isFoundAccountDetail); die;
			echo json_encode($this->Report_mod->ListmytotalExpenses($isFoundAccountDetail[1]));
		}
	}
	public function unmapkisanVahi(){
		if (isPostBack()) {
			echo json_encode($this->Report_mod->unmapkisanVahi($_POST['search_name']));
		}
	}
	public function rokad_parcha(){
		if (isPostBack()) {
			$old_date = $_POST['search_name'];            // works
			$middle = strtotime($old_date);             // returns bool(false)
			$new_date = date('Y-m-d', $middle);
			$this->session->set_userdata("setParchaDate",$new_date);   
		}

		//pr(@$_POST['search_name']); die;
		if(empty(@$_POST['search_name'])){
			$new_date = date('Y-m-d',strtotime("-2day"));
			$this->session->set_userdata("setParchaDate",$new_date);   
		}
		$data['page'] = 'report/view_rokad_parcha';
        $data['title'] = "Track (The Rest Accounting Key) || Search Report";
		$data['naam']= $this->Report_mod->naam_Billing_details();
		$data['jama']= $this->Report_mod->jama_Billing_details();
	//	pr($data); die;
		$this->load->view('layout', $data);
	}


	public function view_all() {
        $requestData    = $this->input->post(null,true);
        /*Counting warehouse data*/
        $query          =   $this->Report_mod->count_Billing_data();
        $totalData      =   $query->num_rows();
        // pr($query->num_rows()); die;
        $totalFiltered  =   $totalData;  //
        /*End of counting warehouse data*/
        
       // $d = array('id' => 'city_id', 'name' => 'name', 'status' => 'status');
        $citydata = $this->Report_mod->get_Billing_data(); 
	 
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
                
                $nestedData[]   =   '<a href="'.base_url().'admin/report/view/'.ID_encode($row['id']).'">'.$row['truck_no'].'</a>';
				$nestedData[]   =   $row["purchaser_name"];
				$nestedData[]   =   $row["seller_name"];
                $nestedData[]   =   $row["seller_amount"];
                $nestedData[]   =   $row["site_name"];
                $nestedData[]   =   $row["gst_amount"];

				$nestedData[]   =   $this->load->view("report/_action", array("row" => $row), true);
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
	
	public function fetchsearchReports(){
	//	pr();
		if (isPostBack()) {
			$isFoundAccountDetail = explode('_',$_POST['search_name']);
			echo json_encode($this->Report_mod->fetchsearchReport($isFoundAccountDetail));
		}

	}

	public function searchbycondition(){
		if(isPostBack()){
		}
		$data['page'] = 'report/searchbycondition';
		$data['title'] = "Track (The Rest Accounting Key) || Search Report By Condition";
		$data['users']= $this->Report_mod->Billing_details();
		$this->load->view('layout', $data);

	}

	
	

}

/*End of class*/