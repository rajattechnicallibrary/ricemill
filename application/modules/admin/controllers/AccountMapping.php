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
class AccountMapping extends CI_Controller {

    function __construct() {
        parent::__construct();
		date_default_timezone_set('Asia/Kolkata');
		$this->load->model('AccountMapping_mod');
		//is_adminprotected();
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

        $data['page'] = 'campaign/listing';
        $data['title'] = "Track (The Rest Accounting Key) || Campaign Listing";
        $data['pageno'] = $pageno;
        //$data['users']= $this->Advertiser_mod->listing();
        $this->load->view('layout', $data);
    }
    

	public function ajax_list_items()
    {
        
		$post=$this->input->post(null,true);
		$per_page = 10;
        $search='';
        if($this->input->is_ajax_request())
        {
            $page = $this->input->post('page');
            $per_page = $this->input->post('perpage');
            $search = $this->input->post('search');
            $search = isset($search) && !empty($search) ? $search : '';
            $search=trim($search);
            $cur_page = $page;
            $page -= 1;
            $start = $page * $per_page;
            if($per_page==1)
            {
                $per_page=100000;    
            }
            $previous_btn = true;
            $next_btn = true;
            $first_btn = false;
            $last_btn = false;
            $response=$this->AccountMapping_mod->ajax_list_items($search,$per_page,$start);
            $data['result']=$response;
            $views = 'campaign/banner_listing';
            $count=$response['count'];
            $data['start'] = $start;
            $data['cur_page'] = $cur_page;
            $data['no_of_paginations'] = ceil($count / $per_page);
            $data['previous_btn'] = $previous_btn;
            $data['next_btn'] = $next_btn;
            $data['first_btn'] = $first_btn;
            $data['last_btn'] = $last_btn;
          
			ajax_layout($views,$data);
        }
    } 
	
	public function account_mapping(){

		if(isPostBack()){
			$this->form_validation->set_rules('rokad_type', 'Center Type', 'trim|required');
            $this->form_validation->set_rules('farmer_id', 'Farmer', 'trim|required');
            $this->form_validation->set_rules('farmer_name', 'Farmer Name', 'trim|required');
            $this->form_validation->set_rules('CenterName', 'Center Name', 'trim|required');
			$this->form_validation->set_rules('account_name', 'Account Name', 'trim|required');
			if ($this->form_validation->run() == false) {
				set_flashdata("error", "Invalid Data.");
            } else {
				$result = $this->AccountMapping_mod->account_mapping();
				$results = $this->AccountMapping_mod->count_account_mapping();
				//pr($results);  die;
				if($result){
					set_flashdata("success", "Kissan Vahi Added successfully.Last ID is ".$_POST['farmer_id']." (Total Count ".$results." )");
					redirect('/admin/accountMapping/account_mapping');
				}
				
			}
		}
		$data['page'] = 'campaign/add';
        $data['title'] = "Track (The Rest Accounting Key) || Add";
        $this->load->view('layout', $data);
	}

	public function add_Kisan_Vahi(){
		//pr($_POST);
		// die;

		
		if(isPostBack()){
			$this->form_validation->set_rules('center_type', 'Center Type', 'trim|required');
            $this->form_validation->set_rules('purchase_id', 'Purchase ID', 'trim');
            $this->form_validation->set_rules('farmer_id', 'Farmer ID', 'trim|required');
            $this->form_validation->set_rules('farmer_name', 'Farmer Name', 'trim|required');
            $this->form_validation->set_rules('quantity', 'Quantity', 'trim|required');
            $this->form_validation->set_rules('amount', 'Amount', 'trim');
            $this->form_validation->set_rules('purchase_date', 'Purchase Date', 'trim');
            $this->form_validation->set_rules('pfms_status', 'PFMS Status', 'trim');
			$this->form_validation->set_rules('bank_account_no', 'Account Number', 'trim');
			$this->form_validation->set_rules('ack_status', 'ACK Status', 'trim');
			$this->form_validation->set_rules('payment_status', 'Payment Status', 'trim');
			$this->form_validation->set_rules('payment_date', 'Payment Date', 'trim');
			$this->form_validation->set_rules('utr_no', 'Payment UTR No.', 'trim');
			$this->form_validation->set_rules('account_name', 'Account Name', 'trim|required');
			if ($this->form_validation->run() == false) {
				set_flashdata("error", "Invalid Data.");
            } else {
				
				$result = $this->AccountMapping_mod->add_Kisan_Vahi();
			//	$results = $this->AccountMapping_mod->count_account_mapping();
				//pr($results);  die;
				if($result){
					set_flashdata("success", "Kisaan Vahi Added successfully.Last ID is ".$_POST['farmer_id']." (Total Count ".$results." )");
					redirect('/admin/accountMapping/add_Kisan_Vahi');
				}
				
			}
		}
		$data['page'] = 'campaign/add_Kisan_Vahi';
        $data['title'] = "Track (The Rest Accounting Key) || Add";
        $this->load->view('layout', $data);
	}

	public function add(){
        if (isPostBack()) {
            
            $this->form_validation->set_rules('campaign_name', 'Campaign Name', 'trim|required');
            $this->form_validation->set_rules('start_date', 'Start Date', 'trim|required');
            $this->form_validation->set_rules('campaign_type', 'Campaign Type', 'trim|required');
            $this->form_validation->set_rules('end_date', 'End_Date', 'trim|required');
			$this->form_validation->set_rules('amount', 'Amount', 'trim|required|numeric');
            $this->form_validation->set_rules('description', 'Description', 'trim|required');
            $this->form_validation->set_rules('duration', 'Duration', 'trim|required');
           $this->form_validation->set_rules('publisher_type[]', 'Publisher Type', 'trim|required');
			$this->form_validation->set_rules('status', 'Status', 'trim|required');
			if ($this->form_validation->run() == false) {

               

            } else {
                
                $directory 	= './assets/uploads/campaign'; 
               			 @mkdir($directory, 0777); 
		                @chmod($directory,  0777);  
		                $config['upload_path'] 		= $directory;
		                $config['allowed_types'] 	= 'jpeg|jpg|png|gif';            
		                $config['encrypt_name'] 	= TRUE;
		                $this->load->library('upload', $config);
                        $this->upload->initialize($config);
						if ($this->upload->do_upload('userfile')) { 
							$input 							= array();	
							$image_data = $this->upload->data();
							$image = $image_data['file_name'];
				   
							if(!empty($_FILES['userfile']['name']) && isset($_FILES['userfile']['name'])) {
								$image_data = $this->upload->data();
								$image_1 = $image_data['file_name'];
								$input['back_image'] 			= $image_1;
							}else{
								 $input['back_image']  ='';
							}
							$userdata = array(
								'campaign_name' => $_POST['campaign_name'],
								'start_date' => $_POST['start_date'],
								'campaign_type' => $_POST['campaign_type'],
								'end_date' => $_POST['end_date'],
								'amount' => $_POST['amount'],
								'description' => $_POST['description'],
								'duration' => $_POST['duration'],
								//'assign_for' => $_POST['advertiser_type'],
								'added_by' => $this->session->userdata('userinfo')->id,
								'status' => $_POST['status'],
								'created_date' =>  date("Y-m-d"),
								'campaign_image'=> $input['back_image'],
								
							);
							
							 $result = $this->AccountMapping_mod->add($userdata);
							
							
							 $data_mapping =array();
							 if(!empty($_POST['publisher_type'])){
								 foreach($_POST['publisher_type'] as $key=> $value){
									 $data_mapping[$key]['campaign_id'] =$result;
									 $data_mapping[$key]['publisher_id'] =$value;
									 $data_mapping[$key]['assgined_by'] =$_SESSION['userinfo']->id;
									 $data_mapping[$key]['flag_status'] =1;
								 }
							 }
							 
							 $this->AccountMapping_mod->publisher_insert($id,$data_mapping);
							 set_flashdata("success", "Campaign added successfully.");
							redirect('/admin/campaign');     
                                    
                            
                        }else{
								$data['error']=$this->upload->display_errors();
								
						}
                        
                           
                    
            }
        }
		$data['publisher']=$this->AccountMapping_mod->publisher_details();
		$data['page'] = 'campaign/add';
        $data['title'] = "Track (The Rest Accounting Key) || Add";
        $this->load->view('layout', $data);
	}
	
	
	
	function edit($id = null){

		// pr($_POST); die;

		$data['campaign_details']=$this->AccountMapping_mod->Campaign_details($id);
		if(!empty($data['campaign_details'])){
			if (isPostBack()) {
				 $this->form_validation->set_rules('campaign_name', 'Campaign Name', 'trim|required');
				// $this->form_validation->set_rules('start_date', 'Start Date', 'trim|required');
				// $this->form_validation->set_rules('campaign_type', 'Campaign Type', 'trim|required');
				$this->form_validation->set_rules('end_date', 'End_Date', 'trim|required');
				// $this->form_validation->set_rules('amount', 'Amount', 'trim|required|numeric');
				$this->form_validation->set_rules('description', 'Description', 'trim|required');
				$this->form_validation->set_rules('duration', 'Duration', 'trim|required');
				$this->form_validation->set_rules('publisher_type[]', 'Publisher Type', 'trim|required');
				$this->form_validation->set_rules('status', 'Status', 'trim|required');
				
				if ($this->form_validation->run() == false) {
					
				   

				} else {
					
					$data_mapping =array();
					if(!empty($_POST['publisher_type'])){
						foreach($_POST['publisher_type'] as $key=> $value){
							$data_mapping[$key]['campaign_id'] =$id;
							$data_mapping[$key]['publisher_id'] =$value;
							$data_mapping[$key]['assgined_by'] =$_SESSION['userinfo']->id;
							$data_mapping[$key]['flag_status'] =1;
						}
					}
					
					$this->AccountMapping_mod->publisher_insert($id,$data_mapping);

					
						$directory 	= './assets/uploads/campaign'; 
						@mkdir($directory, 0777); 
						@chmod($directory,  0777);  
						$config['upload_path'] 		= $directory;
						$config['allowed_types'] 	= 'jpeg|jpg|png|gif';            
						$config['encrypt_name'] 	= TRUE;
						$this->load->library('upload', $config);
						$this->upload->initialize($config);
						if(!empty($_FILES['userfile']['name'])){
							unlink('./assets/uploads/campaign/'.$data['campaign_details']->campaign_image);
							if ($this->upload->do_upload('userfile')) { 
										$input 							= array();	
										$image_data = $this->upload->data();
										$image = $image_data['file_name'];
							   
								if(!empty($_FILES['userfile']['name']) && isset($_FILES['userfile']['name'])) {
									$image_data = $this->upload->data();
									$image_1 = $image_data['file_name'];
									$input['back_image'] 			= $image_1;
									
								}else{
									$input['back_image']  			='';
								}
								$userdata = array(
									'campaign_name' => $_POST['campaign_name'],
									// 'start_date' 	=> $_POST['start_date'],
									// 'campaign_type' => $_POST['campaign_type'],
									'end_date' 		=> $_POST['end_date'],
									// 'amount' 		=> $_POST['amount'],
									'description' 	=> $_POST['description'],
									'duration' => $_POST['duration'],
									//'assign_for' => $_POST['advertiser_type'],
									'status' => $_POST['status'],
									'created_date' =>  date("Y-m-d"),
									'campaign_image'=> $input['back_image'],
								);
								
								$result = $this->AccountMapping_mod->update($userdata,$id);
							
								



								set_flashdata("success", "Campaign updated successfully.");
								redirect('/admin/campaign/index');    
									
							}else{
								$data['error']=$this->upload->display_errors();
								$input['back_image']  ='';
								
								
							}
							
						}else{
							$input['back_image'] =$data['campaign_details']->campaign_image;
							$userdata = array(
								'campaign_name' => $_POST['campaign_name'],
								// 'start_date' => $_POST['start_date'],
								// 'campaign_type' => $_POST['campaign_type'],
								'end_date' => $_POST['end_date'],
								// 'amount' => $_POST['amount'],
								'description' => $_POST['description'],
								'duration' => $_POST['duration'],
								
								//'assign_for' => $_POST['advertiser_type'],

								'status' => $_POST['status'],
								'created_date' =>  date("Y-m-d"),
								'campaign_image'=> $input['back_image'],
								'mobile_no'=> $_POST['mobile_no'],
								'service_charge_advertiser'=> $_POST['service_charge_advertiser'],
								'service_charge_publisher'=> $_POST['service_charge_publisher'],
							);
							
							$result = $this->AccountMapping_mod->update($userdata,$id);
							set_flashdata("success", "Campaign updated successfully.");
							redirect('/admin/campaign');     

						}
						
						
							
							   
						
				}
			}
		
		}else{
			redirect('/admin/campaign/index');     
			
		}
		$data['publisher']=$this->AccountMapping_mod->publisher_details();
		$data['publisher_mapping_deatils']=$this->AccountMapping_mod->publisher_mapping_deatils($id);
		$newdata =array();	
		if(!empty($data['publisher_mapping_deatils'])){
			foreach($data['publisher_mapping_deatils'] as $value){
				$newdata[] =$value->publisher_id;
			}
		}
		$data['newdata'] = $newdata;
		$data['page'] = 'campaign/edit';
		$data['title'] = "Track (The Rest Accounting Key) || Edit";
		$this->load->view('layout', $data);
		
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	


	public function listing(){
		
        if (isPostBack()) { 
			
            $this->form_validation->set_rules('pay_sales_person', 'Sales Person',  'trim|required');
			$this->form_validation->set_rules('client_name_id', 'Clent',  'trim|required');
			$this->form_validation->set_rules('client_branch_id', 'Branch',  'trim|required');
			$this->form_validation->set_rules('client_contact_person_id', 'Contact Person',  'trim|required');
			$this->form_validation->set_rules('based_on', 'Based On',  'trim|required');
			$this->form_validation->set_rules('mod_payment_id', 'Mode Of Payment',  'trim|required');
			$this->form_validation->set_rules('amount_collected', 'Amount Collected',  'trim|required');
			if ($this->form_validation->run() == false) {
                
            }else{
                $result = $this->AccountMapping_mod->add_payment();
				
                if($result['status'] == 'success'){
                    set_flashdata('success', $result['msg']);
                    redirect('/admin/campaign/account_payment_list');
                }else{
                    set_flashdata('error',$result['msg']);
                    redirect('/admin/campaign/add_payment');
                }
            } 
            }

		
		
        $data['page'] = 'campaign/listing';
        $data['title'] = "Track (The Rest Accounting Key) || Add";
        $this->load->view('layout', $data);
	}
	public function view($id =null){
		
       
        $data['page'] = 'campaign/view';
        $data['title'] = "Track (The Rest Accounting Key) || Campaign View";
		$data['users']= $this->AccountMapping_mod->Campaign_details($id);
		
		if(!empty( $data['users'])){
			$this->load->view('layout', $data);
		}else{
			redirect('/admin/campaign/');
		}
	}
	
	public function view_all() {
        $requestData    = $this->input->post(null,true);
        /*Counting warehouse data*/
        $query          =   $this->AccountMapping_mod->count_campaign_data();
        $totalData      =   $query->num_rows();
        // pr($query->num_rows()); die;
        $totalFiltered  =   $totalData;  //
        /*End of counting warehouse data*/
        
       // $d = array('id' => 'city_id', 'name' => 'name', 'status' => 'status');
        $citydata = $this->AccountMapping_mod->get_campaign_data(); 
	 
                
        $data   =   array();
        if(count($citydata)>0)
        {
            $j = $requestData['start'];
            for( $i=0; $i<count($citydata);$i++ ) 
            {  
                $j++;
                $row    =   (array)$citydata[$i];
				$nestedData     =   array();
				//pr($row); 
                //$nestedData[]   =   "<input type='checkbox'  class='deleteRow' value='".$row['id']."'  />";
                $nestedData[]   =   $j;
                
                $nestedData[]   =   $row["campaign_name"];
				$nestedData[]   =   $row["start_date"];
				$nestedData[]   =   $row["end_date"];
				if($row["campaign_type"] == 1){
					$nestedData[]   = 'Click';					
				}else if($row["campaign_type"] == 2){
					$nestedData[]   = 'Impression';					
				}else{					
					$nestedData[]   = 'Lead';
				}
                $nestedData[]   =   $row["amount"];
                $nestedData[]   =   substr($row['description'],0,20);
				// $nestedData[]   =   $row["duration"];
				
				if($row["duration"] == 1){
					$nestedData[]   = 'Weekly';					
				}else if($row["duration"] == 2){
					$nestedData[]   = 'Monthly';					
				}else {					
					$nestedData[]   = 'Went Wrong';
				}


				if(!empty($row["advertiser_name"])){

					$nestedData[]   =   $row["advertiser_name"];

				}else{
					
					$nestedData[]   =  "Not Assigned";
				}
				
			//pr($row);
				if($row["status"] == 1){
					$nestedData[]   = 'Assigned';					
				}else if($row["status"] == 2){
					$nestedData[]   = 'Accepted';					
				}else if($row["status"] == 3){			
					$nestedData[]   = 'Pending';
				}else if($row["status"] == 4){			
					$nestedData[]   = 'Closed';
				}else {					
					$nestedData[]   = 'Other';
				}
				$nestedData[]   =   $this->load->view("campaign/_action", array("row" => $row), true);
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

	
	

}

/*End of class*/