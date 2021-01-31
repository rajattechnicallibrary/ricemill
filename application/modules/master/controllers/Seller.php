<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 *  Auth Controller
 *
 * @package		Auth
 * @subpackage  Models
 * @category    City Master 
 * @author		Geet
 * @webseller		http://www.thealternativeaccount.com
 * @company             thealternativeaccount Inc
 * @since		Version 1.0
 */
class Seller extends CI_Controller {

    /**
     * Constructor
     */
    function __construct() {
        parent::__construct();
        $this->load->model('seller_mod');
        is_adminprotected();
		validate_admin_login();
        // is_protected();
    }

    /**
     * Index
     *
     * function show all list of city Info
     * 
     * @access	public
     * @return	html data
     */
    public function index() {
        $data['title'] = 'Track (The Rest Accounting Key) | Seller Name';
        $data['page_title'] = 'Seller Name';
        $page = 'seller/listing';
        $data['page'] = $page;
        $d = array('id' => 'seller_id', 'name' => 'name', 'status' => 'status');
        $data['citydata'] = $this->seller_mod->getdata($d);
        _layout($data);
    }

    /**
     * Add
     *
     * function add new city for product
     * 
     * @access	public
     * @return	html data
     */
    public function add() {
         
        if (isPostBack()) {
            // pr($_POST); die;
            $this->form_validation->set_rules('seller_name', 'Seller Name',  'trim|required');
            $this->form_validation->set_rules('contact_person_name', 'Contact Person Name',  'trim|required');
            $this->form_validation->set_rules('contact_person_number', 'Contact Person Number',  'trim|required|numeric');
            $this->form_validation->set_rules('seller_account_no', 'Seller Account Number',  'trim|required|numeric');
            $this->form_validation->set_rules('seller_address', 'Seller Address',  'trim|required');
            $this->form_validation->set_rules('seller_gst_no', 'Seller GST No.',  'trim|required');
            $this->form_validation->set_rules('bank_name', 'Bank Name',  'trim|required');
            $this->form_validation->set_rules('ifsc_code', 'IFSC Code.',  'trim|required');
            $this->form_validation->set_rules('branch_code', 'Branch Code.',  'trim|required');
            $this->form_validation->set_rules('pan_card', 'Pan Card No.',  'trim');
            $this->form_validation->set_rules('remark', 'Remark',  'trim');
            $this->form_validation->set_rules('status', 'Status', 'trim|required');

            if ($this->form_validation->run() == FALSE) {
                
            } else {                
                $postdata = array(
                    'name'                              => $_POST['seller_name'],           
                    'contact_person_name'               => $_POST['contact_person_name'],           
                    'contact_person_number'             => $_POST['contact_person_number'],           
                    'seller_account_no'                 => $_POST['seller_account_no'],           
                    'seller_address'                    => $_POST['seller_address'],           
                    'seller_gst_no'                     => $_POST['seller_gst_no'],           
                    'bank_name'                         => $_POST['bank_name'],           
                    'ifsc_code'                         => $_POST['ifsc_code'],           
                    'branch_code'                       => $_POST['branch_code'],           
                    'pan_card'                          => $_POST['pan_card'],           
                    'remark'                            => $_POST['remark'],           
                    'status'                            => $_POST['status'],                    
                );
                $this->seller_mod->add($postdata);
                set_flashdata('success', 'New Seller Name added successfully');
                redirect('/master/seller');
            }
        }
        
        $data['title'] = 'Track (The Rest Accounting Key) | Add Seller Name';
        $data['page_title'] = 'Add Seller Name';
        $data['breadcum'] = array("dashboard/" => 'Home', '' => 'Add Seller Name');
        $page = 'seller/add';        
        $d = array('table' => 'aa_seller','status'=>'status','column3'=>'Active');
        $data['countrydata'] = getdata($d);         
        $data['page'] = $page;
        // pr( $data); die;
        _layout($data);
    }
       
    /**
     * deletecategories
     *
     * this function delete State
     * 
     * @access	public
     * @return	html data
     */
    public function delete_city() {
        $post = $this->input->post('id');
        if (!empty($post)) {
            if ($this->seller_mod->delete_city($post)) {                
                set_flashdata('success', 'Seller Name deleted successfully');
                //redirect('/city');
            } else {
                set_flashdata('success', 'Some error occured');
            }
        }
    }

    /**
     * Edit
     *
     * this function update city
     * 
     * @access	public
     * @return	html data
     */
    public function edit($id = "") {
        // pr($_POST);die;
        $seller_id = ID_decode($id);
        if (isPostBack()) {
            $seller_id = ID_decode($id);
            $this->form_validation->set_rules('seller_name', 'Seller Name',  'trim|required');
            $this->form_validation->set_rules('contact_person_name', 'Contact Person Name',  'trim|required');
            $this->form_validation->set_rules('contact_person_number', 'Contact Person Number',  'trim|required|numeric');
            $this->form_validation->set_rules('seller_account_no', 'Seller Account Number',  'trim|required|numeric');
            $this->form_validation->set_rules('seller_address', 'Seller Address',  'trim|required');
            $this->form_validation->set_rules('seller_gst_no', 'Seller GST No.',  'trim|required');
            $this->form_validation->set_rules('bank_name', 'Bank Name',  'trim|required');
            $this->form_validation->set_rules('ifsc_code', 'IFSC Code.',  'trim|required');
            $this->form_validation->set_rules('branch_code', 'Branch Code.',  'trim|required');
            $this->form_validation->set_rules('pan_card', 'Pan Card No.',  'trim');
            $this->form_validation->set_rules('remark', 'Remark',  'trim');
            $this->form_validation->set_rules('status', 'Status', 'trim|required');
           
            if ($this->form_validation->run() == FALSE) {
                
            } else {
                /*check name for pre existance*/
                $city_name        =   $this->input->post('seller_name');
                $check_data         =   $this->seller_mod->check_preexistance($seller_id,$city_name);
                /*End of this*/
                if($check_data)
                {
                    set_flashdata('error', 'Seller Name name already exist.');
                    redirect("/master/seller/edit/$id");
                }else{
                    $this->seller_mod->edit($seller_id);
                    set_flashdata('success', 'Seller Name name updated successfully');
                    redirect('/master/seller');
                }
            }
        }
        $d = array('table' => 'aa_seller','status'=>'status','column3'=>'Active');
        $data['countrydata'] = getdata($d);
        $data['result'] = $this->seller_mod->view($seller_id);        
        $data['title'] = 'Track (The Rest Accounting Key)  | Edit Seller Name';
        $data['page_title'] = 'Update Seller Name';

        $data['breadcum'] = array("dashboard/" => 'Home', '' => 'Update Seller Name');
        $page = 'seller/add';
        $data['page'] = $page;
        // pr($data); die;
        _layout($data);
    }


    /**
     * view function 
     */
     public function view($id = "") {
        $seller_id = ID_decode($id);
        if (!empty($seller_id)) {
            $data['result'] = $this->seller_mod->view(@$seller_id);
            $data['title'] = 'Track (The Rest Accounting Key) | Seller Name View';
            $data['page_title'] = 'Seller Name View';
            $data['breadcum'] = array("dashboard/" => 'Home', '' => 'Seller Name View');
            $page = 'seller/view';
//            pr($data);die;
            $data['page'] = $page;
            _layout($data);
        }
    }




    
    /**
     * view_all
     *
     * this function to view all city
     * 
     * @access	public
     * @return	html data
     */
    public function view_all() {
        $requestData    = $this->input->post(null,true);
        /*Counting warehouse data*/
        $query          =   $this->seller_mod->count_city_data();
        $totalData      =   $query->num_rows();
// pr($query->num_rows()); die;
        $totalFiltered  =   $totalData;  //
        /*End of counting warehouse data*/
        
       // $d = array('id' => 'seller_id', 'name' => 'name', 'status' => 'status');
        $citydata = $this->seller_mod->get_city_data(); 
         //pr($citydata);die;       
        $data   =   array();
        if(count($citydata)>0)
        {
            $j = $requestData['start'];
            for( $i=0; $i<count($citydata);$i++ ) 
            {  
                $j++;
                $row    =   (array)$citydata[$i];
              //  pr($row);
                $nestedData     =   array(); 
                //$nestedData[]   =   "<input type='checkbox'  class='deleteRow' value='".$row['id']."'  />";
                $nestedData[]   =   $j;
                $nestedData[]   =   $row["name"];
                // $nestedData[]   =   substr($row["contact_person_name"], 0, 10);
                // $nestedData[]   =   $row["contact_person_number"];
                $nestedData[]   =   $row["seller_account_no"];

                $nestedData[]   =   substr($row["bank_name"],0,10);
                $nestedData[]   =   substr($row["ifsc_code"],0,10);
                $nestedData[]   =   substr($row["branch_code"],0,10);
                $nestedData[]   =   substr($row["pan_card"],0,10);

                $nestedData[]   =   substr($row["seller_address"],0,10);
                $nestedData[]   =   $row["status"];	
                $seller_id        =   $row['seller_id'];
                $nestedData[]   =   $this->load->view("seller/_action", array("row" => $row), true);
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
    /*End of function*/
    
    function restoreData(){
        $arr =  json_decode($_POST['arr']);        
        $res = restoreData($arr);
        //$this->session->set_flashdata("alert",array("c"=>"s","m"=>"Data has been Restored"));
        set_flashdata('success', 'Data has been Restored'); 
        echo json_encode($res);
    }

}