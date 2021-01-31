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
 * @website		http://www.thealternativeaccount.com
 * @company             thealternativeaccount Inc
 * @since		Version 1.0
 */
class Site extends CI_Controller {

    /**
     * Constructor
     */
    function __construct() {
        parent::__construct();
        $this->load->model('site_mod');
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
        $data['title'] = 'Track (The Rest Accounting Key) | Site Name';
        $data['page_title'] = 'Site Name';
        $page = 'site/listing';
        $data['page'] = $page;
        $d = array('id' => 'site_id', 'name' => 'name', 'status' => 'status');
        $data['citydata'] = $this->site_mod->getdata($d);
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
            $this->form_validation->set_rules('site_name', 'Site Name',  'trim|required');
            $this->form_validation->set_rules('contact_person_name', 'Contact Person Name',  'trim|required');
            $this->form_validation->set_rules('contact_person_number', 'Contact Person Number',  'trim|required|numeric');
            $this->form_validation->set_rules('site_account_no', 'Site Account Number',  'trim|required|numeric');
            $this->form_validation->set_rules('site_address', 'Site Address',  'trim|required');
            $this->form_validation->set_rules('site_gst_no', 'Site GST No.',  'trim|required');
            $this->form_validation->set_rules('bank_name', 'Bank Name',  'trim|required');
            $this->form_validation->set_rules('ifsc_code', 'IFSC Code.',  'trim|required');
            $this->form_validation->set_rules('branch_code', 'Branch Code.',  'trim|required');
            $this->form_validation->set_rules('pan_card', 'Pan Card No.',  'trim');
            $this->form_validation->set_rules('remark', 'Remark',  'trim');
            $this->form_validation->set_rules('status', 'Status', 'trim|required');
            if ($this->form_validation->run() == FALSE) {
                
            } else {                
                $postdata = array(
                    'name'                              => $_POST['site_name'],           
                    'contact_person_name'               => $_POST['contact_person_name'],           
                    'contact_person_number'             => $_POST['contact_person_number'],           
                    'site_account_no'              => $_POST['site_account_no'],           
                    'site_address'                 => $_POST['site_address'],           
                    'site_gst_no'                  => $_POST['site_gst_no'],           
                    'bank_name'                         => $_POST['bank_name'],           
                    'ifsc_code'                         => $_POST['ifsc_code'],           
                    'branch_code'                       => $_POST['branch_code'],           
                    'pan_card'                          => $_POST['pan_card'],           
                    'remark'                            => $_POST['remark'],           
                    'status'                            => $_POST['status'],                  
                );
                $this->site_mod->add($postdata);
                set_flashdata('success', 'New Site Name added successfully');
                redirect('/master/site');
            }
        }
        
        $data['title'] = 'Track (The Rest Accounting Key) | Add Site Name';
        $data['page_title'] = 'Add Site Name';
        $data['breadcum'] = array("dashboard/" => 'Home', '' => 'Add Site Name');
        $page = 'site/add';        
        $d = array('table' => 'aa_site','status'=>'status','column3'=>'Active');
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
            if ($this->site_mod->delete_city($post)) {                
                set_flashdata('success', 'Site Name deleted successfully');
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
        $site_id = ID_decode($id);
        if (isPostBack()) {
            $site_id = ID_decode($id);
            $this->form_validation->set_rules('site_name', 'Site Name',  'trim|required');
            $this->form_validation->set_rules('contact_person_name', 'Contact Person Name',  'trim|required');
            $this->form_validation->set_rules('contact_person_number', 'Contact Person Number',  'trim|required|numeric');
            $this->form_validation->set_rules('site_account_no', 'Site Account Number',  'trim|required|numeric');
            $this->form_validation->set_rules('site_address', 'Site Address',  'trim|required');
            $this->form_validation->set_rules('site_gst_no', 'Site GST No.',  'trim|required');
            $this->form_validation->set_rules('bank_name', 'Bank Name',  'trim|required');
            $this->form_validation->set_rules('ifsc_code', 'IFSC Code.',  'trim|required');
            $this->form_validation->set_rules('branch_code', 'Branch Code.',  'trim|required');
            $this->form_validation->set_rules('pan_card', 'Pan Card No.',  'trim');
            $this->form_validation->set_rules('remark', 'Remark',  'trim');
            $this->form_validation->set_rules('status', 'Status', 'trim|required');
           
            if ($this->form_validation->run() == FALSE) {
                
            } else {
                /*check name for pre existance*/
                $city_name        =   $this->input->post('site_name');
                $check_data         =   $this->site_mod->check_preexistance($site_id,$city_name);
                /*End of this*/
                if($check_data)
                {
                    set_flashdata('error', 'Site Name name already exist.');
                    redirect("/master/site/edit/$id");
                }else{
                    $this->site_mod->edit($site_id);
                    set_flashdata('success', 'Site Name name updated successfully');
                    redirect('/master/site');
                }
            }
        }
        $d = array('table' => 'aa_site','status'=>'status','column3'=>'Active');
        $data['countrydata'] = getdata($d);
        $data['result'] = $this->site_mod->view($site_id);        
        $data['title'] = 'Track (The Rest Accounting Key)  | Edit Site Name';
        $data['page_title'] = 'Update Site Name';

        $data['breadcum'] = array("dashboard/" => 'Home', '' => 'Update Site Name');
        $page = 'site/add';
        $data['page'] = $page;
        // pr($data); die;
        _layout($data);
    }


    /**
     * view function 
     */
     public function view($id = "") {
        $site_id = ID_decode($id);
        if (!empty($site_id)) {
            $data['result'] = $this->site_mod->view(@$site_id);
            $data['title'] = 'Track (The Rest Accounting Key) | Site Name View';
            $data['page_title'] = 'Site Name View';
            $data['breadcum'] = array("dashboard/" => 'Home', '' => 'Site Name View');
            $page = 'site/view';
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
        $query          =   $this->site_mod->count_city_data();
        $totalData      =   $query->num_rows();
// pr($query->num_rows()); die;
        $totalFiltered  =   $totalData;  //
        /*End of counting warehouse data*/
        
       // $d = array('id' => 'site_id', 'name' => 'name', 'status' => 'status');
        $citydata = $this->site_mod->get_city_data(); 
         //pr($citydata);die;       
        $data   =   array();
        if(count($citydata)>0)
        {
            $j = $requestData['start'];
            for( $i=0; $i<count($citydata);$i++ ) 
            {  
                $j++;
                $row    =   (array)$citydata[$i];
                $nestedData     =   array(); 
                //$nestedData[]   =   "<input type='checkbox'  class='deleteRow' value='".$row['id']."'  />";
                $nestedData[]   =   $j;
                 // $nestedData[]   =   $row["city_name"];
                 $nestedData[]   =   $row["name"];
                 // $nestedData[]   =   substr($row["contact_person_name"], 0, 10);
                 // $nestedData[]   =   $row["contact_person_number"];
                 $nestedData[]   =   $row["site_account_no"];
 
                 $nestedData[]   =   substr($row["bank_name"],0,10);
                 $nestedData[]   =   substr($row["ifsc_code"],0,10);
                 $nestedData[]   =   substr($row["branch_code"],0,10);
                 $nestedData[]   =   substr($row["pan_card"],0,10);
 
                 $nestedData[]   =   substr($row["site_address"],0,10);
                 $nestedData[]   =   $row["status"];	
                 $site_id        =   $row['site_id'];
                $nestedData[]   =   $this->load->view("site/_action", array("row" => $row), true);
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