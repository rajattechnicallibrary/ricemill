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
class Purchaser extends CI_Controller {

    /**
     * Constructor
     */
    function __construct() {
        parent::__construct();
        $this->load->model('purchaser_mod');
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
        $data['title'] = 'Track (The Rest Accounting Key) | Purchaser Name';
        $data['page_title'] = 'Purchaser Name';
        $page = 'purchaser/listing';
        $data['page'] = $page;
        $d = array('id' => 'purchaser_id', 'name' => 'name', 'status' => 'status');
        $data['citydata'] = $this->purchaser_mod->getdata($d);
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
            $this->form_validation->set_rules('purchaser_name', 'Purchaser Name',  'trim|required');
            $this->form_validation->set_rules('contact_person_name', 'Contact Person Name',  'trim|required');
            $this->form_validation->set_rules('contact_person_number', 'Contact Person Number',  'trim|required|numeric');
            $this->form_validation->set_rules('purchaser_account_no', 'Purchaser Account Number',  'trim|required|numeric');
            $this->form_validation->set_rules('purchaser_address', 'Purchaser Address',  'trim|required');
            $this->form_validation->set_rules('purchaser_gst_no', 'Purchaser GST No.',  'trim|required');
            $this->form_validation->set_rules('bank_name', 'Bank Name',  'trim|required');
            $this->form_validation->set_rules('ifsc_code', 'IFSC Code.',  'trim|required');
            $this->form_validation->set_rules('branch_code', 'Branch Code.',  'trim|required');
            $this->form_validation->set_rules('pan_card', 'Pan Card No.',  'trim');
            $this->form_validation->set_rules('remark', 'Remark',  'trim');
            $this->form_validation->set_rules('status', 'Status', 'trim|required');
            if ($this->form_validation->run() == FALSE) {
                
            } else {                
                $postdata = array(
                    'name'                              => $_POST['purchaser_name'],           
                    'contact_person_name'               => $_POST['contact_person_name'],           
                    'contact_person_number'             => $_POST['contact_person_number'],           
                    'purchaser_account_no'              => $_POST['purchaser_account_no'],           
                    'purchaser_address'                 => $_POST['purchaser_address'],           
                    'purchaser_gst_no'                  => $_POST['purchaser_gst_no'],           
                    'bank_name'                         => $_POST['bank_name'],           
                    'ifsc_code'                         => $_POST['ifsc_code'],           
                    'branch_code'                       => $_POST['branch_code'],           
                    'pan_card'                          => $_POST['pan_card'],           
                    'remark'                            => $_POST['remark'],           
                    'status'                            => $_POST['status'],                    
                );
                $this->purchaser_mod->add($postdata);
                set_flashdata('success', 'New Purchaser Name added successfully');
                redirect('/master/purchaser');
            }
        }
        
        $data['title'] = 'Track (The Rest Accounting Key) | Add Purchaser Name';
        $data['page_title'] = 'Add Purchaser Name';
        $data['breadcum'] = array("dashboard/" => 'Home', '' => 'Add Purchaser Name');
        $page = 'purchaser/add';        
        $d = array('table' => 'aa_purchaser_name','status'=>'status','column3'=>'Active');
        $data['countrydata'] = getdata($d);         
        $data['page'] = $page;
        // pr( $data); die;
        _layout($data);
    }
       
    /**
     * deletecategories
     *
     * this function delete quality
     * 
     * @access	public
     * @return	html data
     */
    public function delete_city() {
        $post = $this->input->post('id');
        if (!empty($post)) {
            if ($this->purchaser_mod->delete_city($post)) {                
                set_flashdata('success', 'Purchaser Name deleted successfully');
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
        $purchaser_id = ID_decode($id);
        if (isPostBack()) {
            $purchaser_id = ID_decode($id);
            $this->form_validation->set_rules('purchaser_name', 'Purchaser Name',  'trim|required');
            $this->form_validation->set_rules('contact_person_name', 'Contact Person Name',  'trim|required');
            $this->form_validation->set_rules('contact_person_number', 'Contact Person Number',  'trim|required|numeric');
            $this->form_validation->set_rules('purchaser_account_no', 'Purchaser Account Number',  'trim|required|numeric');
            $this->form_validation->set_rules('purchaser_address', 'Purchaser Address',  'trim|required');
            $this->form_validation->set_rules('purchaser_gst_no', 'Purchaser GST No.',  'trim|required');
            $this->form_validation->set_rules('bank_name', 'Bank Name',  'trim|required');
            $this->form_validation->set_rules('ifsc_code', 'IFSC Code.',  'trim|required');
            $this->form_validation->set_rules('branch_code', 'Branch Code.',  'trim|required');
            $this->form_validation->set_rules('pan_card', 'Pan Card No.',  'trim');
            $this->form_validation->set_rules('remark', 'Remark',  'trim');
            $this->form_validation->set_rules('status', 'Status', 'trim|required');
           
            if ($this->form_validation->run() == FALSE) {
                
            } else {
                /*check name for pre existance*/
                $city_name        =   $this->input->post('purchaser_name');
                $check_data         =   $this->purchaser_mod->check_preexistance($purchaser_id,$city_name);
                /*End of this*/
                if($check_data)
                {
                    set_flashdata('error', 'Purchaser Name already exist.');
                    redirect("/master/purchaser/edit/$id");
                }else{
                    $this->purchaser_mod->edit($purchaser_id);
                    set_flashdata('success', 'Purchaser Name updated successfully');
                    redirect('/master/purchaser');
                }
            }
        }
        $d = array('table' => 'aa_purchaser_name','status'=>'status','column3'=>'Active');
        $data['countrydata'] = getdata($d);
        $data['result'] = $this->purchaser_mod->view($purchaser_id);        
        $data['title'] = 'Track (The Rest Accounting Key)  | Edit Purchaser Name';
        $data['page_title'] = 'Update Purchaser Name';

        $data['breadcum'] = array("dashboard/" => 'Home', '' => 'Update Purchaser Name');
        $page = 'purchaser/add';
        $data['page'] = $page;
        // pr($data); die;
        _layout($data);
    }


    /**
     * view function 
     */
     public function view($id = "") {
        $purchaser_id = ID_decode($id);
        if (!empty($purchaser_id)) {
            $data['result'] = $this->purchaser_mod->view(@$purchaser_id);
            $data['title'] = 'Track (The Rest Accounting Key) | Purchaser Name View';
            $data['page_title'] = 'quality View';
            $data['breadcum'] = array("dashboard/" => 'Home', '' => 'Purchaser Name View');
            $page = 'purchaser/view';
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
        $query          =   $this->purchaser_mod->count_city_data();
        $totalData      =   $query->num_rows();
// pr($query->num_rows()); die;
        $totalFiltered  =   $totalData;  //
        /*End of counting warehouse data*/
        
       // $d = array('id' => 'purchaser_id', 'name' => 'name', 'status' => 'status');
        $citydata = $this->purchaser_mod->get_city_data(); 
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
                // pr($row);
                //$nestedData[]   =   "<input type='checkbox'  class='deleteRow' value='".$row['id']."'  />";
                $nestedData[]   =   $j;
                
                // $nestedData[]   =   $row["city_name"];
                $nestedData[]   =   $row["name"];
                // $nestedData[]   =   substr($row["contact_person_name"], 0, 10);
                // $nestedData[]   =   $row["contact_person_number"];
                $nestedData[]   =   $row["purchaser_account_no"];

                $nestedData[]   =   substr($row["bank_name"],0,10);
                $nestedData[]   =   substr($row["ifsc_code"],0,10);
                $nestedData[]   =   substr($row["branch_code"],0,10);
                $nestedData[]   =   substr($row["pan_card"],0,10);

                $nestedData[]   =   substr($row["purchaser_address"],0,10);
                $nestedData[]   =   $row["status"];	
                $purchaser_id        =   $row['purchaser_id'];
                $nestedData[]   =   $this->load->view("purchaser/_action", array("row" => $row), true);
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