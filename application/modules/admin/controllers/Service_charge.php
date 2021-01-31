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
class Service_charge extends CI_Controller {

    function __construct() {
        parent::__construct();
		date_default_timezone_set('Asia/Kolkata');
		$this->load->model('Campaign_mod');
		$this->load->model('Service_charge_mod');
		
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

        $data['page'] = 'service_charge/listing';
        $data['title'] = "Track (The Rest Accounting Key) || Service Listing";
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
            $response=$this->Campaign_mod->ajax_list_items($search,$per_page,$start);
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
							
							 $result = $this->Campaign_mod->add($userdata);
							
							
							 $data_mapping =array();
							 if(!empty($_POST['publisher_type'])){
								 foreach($_POST['publisher_type'] as $key=> $value){
									 $data_mapping[$key]['campaign_id'] =$result;
									 $data_mapping[$key]['publisher_id'] =$value;
									 $data_mapping[$key]['assgined_by'] =$_SESSION['userinfo']->id;
									 $data_mapping[$key]['flag_status'] =1;
								 }
							 }
							 
							 $this->Campaign_mod->publisher_insert($id,$data_mapping);
							 set_flashdata("success", "Campaign added successfully.");
							redirect('/admin/campaign');     
                                    
                            
                        }else{
								$data['error']=$this->upload->display_errors();
								
						}
                        
                           
                    
            }
        }
		$data['publisher']=$this->Campaign_mod->publisher_details();
		$data['page'] = 'campaign/add';
        $data['title'] = "Track (The Rest Accounting Key) || Add";
        $this->load->view('layout', $data);
	}
	
	
	
	function edit($id = null){

		// pr($_POST); die;

		$data['campaign_details']=$this->Campaign_mod->Campaign_details($id);
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
					
					$this->Campaign_mod->publisher_insert($id,$data_mapping);

					
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
								
								$result = $this->Campaign_mod->update($userdata,$id);
							
								



								set_flashdata("success", "Service Charge updated successfully.");
								redirect('/admin/service_charge');    
									
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
							
							$result = $this->Service_charge_mod->update($userdata,$id);
							set_flashdata("success", "Service Charge updated successfully.");
							redirect('/admin/service_charge');     

						}
						
						
							
							   
						
				}
			}
		
		}else{
			redirect('/admin/service_charge');     
			
		}
		$data['publisher']=$this->Campaign_mod->publisher_details();
		$data['publisher_mapping_deatils']=$this->Campaign_mod->publisher_mapping_deatils($id);
		$newdata =array();	
		if(!empty($data['publisher_mapping_deatils'])){
			foreach($data['publisher_mapping_deatils'] as $value){
				$newdata[] =$value->publisher_id;
			}
		}
		$data['newdata'] = $newdata;
		$data['page'] = 'service_charge/edit';
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
                $result = $this->Campaign_mod->add_payment();
				
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
		
       
        $data['page'] = 'service_charge/view';
        $data['title'] = "Track (The Rest Accounting Key) || Campaign View";
		$data['users']= $this->Service_charge_mod->Campaign_details($id);
		
		if(!empty( $data['users'])){
			$this->load->view('layout', $data);
		}else{
			redirect('/admin/service_charge/');
		}
	}
	
	public function view_all() {
        $requestData    = $this->input->post(null,true);
        /*Counting warehouse data*/
        $query          =   $this->Service_charge_mod->count_campaign_data();
        $totalData      =   $query->num_rows();
        // pr($query->num_rows()); die;
        $totalFiltered  =   $totalData;  //
        /*End of counting warehouse data*/
        
       // $d = array('id' => 'city_id', 'name' => 'name', 'status' => 'status');
        $citydata = $this->Service_charge_mod->get_campaign_data(); 
	 
                
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
                $nestedData[]   =   $row["campaign_name"];
				if($row["campaign_type"] == 1){
					$nestedData[]   = 'Click';					
				}else if($row["campaign_type"] == 2){
					$nestedData[]   = 'Impression';					
				}else{					
					$nestedData[]   = 'Lead';
				}
                $nestedData[]   =   $row["amount"];
                $nestedData[]   =   substr($row['description'],0,20);
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
				if($row["status"] == 3){			
					//$nestedData[]   ="<a href='#' data-toggle=modal data-target=#myModal_".$row['id'].">Add</a>";
					//$nestedData[]   ="<a href='#' data-toggle=modal data-target=#myModal_1>Add</a>";
					$nestedData[] 		='__';
					
					}else if($row["status"] ==1 && !empty($row["service_charge_advertiser"]))
					{
						$nestedData[] 	= $row["service_charge_advertiser"];
						
					
					}
					else if($row["status"] ==2 )
					{
						$nestedData[] 	= "";
					}
					else if($row["status"] == 4 )
					{
						$nestedData[] 	= $row["service_charge_advertiser"];
					}
					else{
						$nestedData[]   ="<a href='#' data-toggle=modal data-target=#myModal_".$row['id'].">Add</a>";
					}


					if($row["status"] == 3){			
						//$nestedData[]   ="<a href='#' data-toggle=modal data-target=#myModal_".$row['id'].">Add</a>";
						//$nestedData[]   ="<a href='#' data-toggle=modal data-target=#myModal_1>Add</a>";
						$nestedData[] 		='__';
						
						}else if($row["status"] ==1 && !empty($row["service_charge_publisher"]))
						{
							$nestedData[] 	= $row["service_charge_publisher"];
							
						
						}
						else if($row["status"] ==2 )
						{
							$nestedData[] 	= "";
						}
						else if($row["status"] == 4 )
						{
							$nestedData[] 	= "";
						}
						else{
							$nestedData[]   ="<a href='#' data-toggle=modal data-target=#myModal2_".$row['id'].">Add</a>";
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
				$nestedData[]   =   $this->load->view("service_charge/_action", array("row" => $row), true);
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

	public function submit_price(){
		if (isPostBack()) {
            
            $this->form_validation->set_rules('comment', 'Price', 'trim|required|numeric|greater_than[0]');
            if ($this->form_validation->run() == false) {

                $data = array(
                    'comment' => form_error('comment'),
                    
                   
                );
    			$result['validation_error'] = $data;
                $result['status'] = 'error';
                echo json_encode($result);

            } else {
				
                $userdata = array(
                    'service_charge_advertiser' => $_POST['comment'],
                    
				);
				///$this->session->set_userdata("advertiser_info", $userdata);
                //$result['status'] = 'success';
				 $this->Service_charge_mod->update_mapping_deatils($_POST['mapping_id'],$userdata);
				 set_flashdata("success", "Service Charge updated successfully.");

				echo true;
				die;
            }
        }
		
	}
	

	public function submit_price_publisher(){
		if (isPostBack()) {
            
            $this->form_validation->set_rules('comment', 'Price', 'trim|required|numeric|greater_than[0]');
            if ($this->form_validation->run() == false) {

                $data = array(
                    'comment' => form_error('comment'),
                    
                   
                );
    			$result['validation_error'] = $data;
                $result['status'] = 'error';
                echo json_encode($result);

            } else {
				
                $userdata = array(
                    'service_charge_publisher' => $_POST['comment'],
                    
				);
				$this->Service_charge_mod->update_mapping_deatils($_POST['mapping_id'],$userdata);
				set_flashdata("success", "Service Charge updated successfully.");

				echo true;
				die;
            }
        }
		
	}

}

/*End of class*/