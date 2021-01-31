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
class Reason extends CI_Controller {

    /**
     * Constructor
     */
    function __construct() {
        parent::__construct();
        $this->load->model('reason_mod');
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
        $data['title'] = 'Track (The Rest Accounting Key) | reason';
        $data['page_title'] = 'reason';
        $page = 'reason/listing';
        $data['page'] = $page;
        $d = array('id' => 'reason_id', 'name' => 'name', 'status' => 'status');
        $data['citydata'] = $this->reason_mod->getdata($d);
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
            $this->form_validation->set_rules('reason_name', 'reason Name',  'trim|required|is_unique[aa_reason.name]');
            $this->form_validation->set_rules('status', 'Status', 'required');
            if ($this->form_validation->run() == FALSE) {
                
            } else {                
                $postdata = array(
                    'name'        => $_POST['reason_name'],           
                    'status'            => $_POST['status'],                    
                );
                $this->reason_mod->add($postdata);
                set_flashdata('success', 'New reason added successfully');
                redirect('/master/reason');
            }
        }
        
        $data['title'] = 'Track (The Rest Accounting Key) | Add reason';
        $data['page_title'] = 'Add reason';
        $data['breadcum'] = array("dashboard/" => 'Home', '' => 'Add reason');
        $page = 'reason/add';        
        $d = array('table' => 'aa_reason','status'=>'status','column3'=>'Active');
        $data['countrydata'] = getdata($d);         
        $data['page'] = $page;
        // pr( $data); die;
        _layout($data);
    }
       
    /**
     * deletecategories
     *
     * this function delete reason
     * 
     * @access	public
     * @return	html data
     */
    public function delete_city() {
        $post = $this->input->post('id');
        if (!empty($post)) {
            if ($this->reason_mod->delete_city($post)) {                
                set_flashdata('success', 'reason deleted successfully');
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
        $reason_id = ID_decode($id);
        if (isPostBack()) {
            $reason_id = ID_decode($id);
            $this->form_validation->set_rules('reason_name', 'reason Name',  'trim|required');
            $this->form_validation->set_rules('status', 'Status', 'required');
           
            if ($this->form_validation->run() == FALSE) {
                
            } else {
                /*check name for pre existance*/
                $city_name        =   $this->input->post('reason_name');
                $check_data         =   $this->reason_mod->check_preexistance($reason_id,$city_name);
                /*End of this*/
                if($check_data)
                {
                    set_flashdata('error', 'reason Name already exist.');
                    redirect("/master/reason/edit/$id");
                }else{
                    $this->reason_mod->edit($reason_id);
                    set_flashdata('success', 'reason Name updated successfully');
                    redirect('/master/reason');
                }
            }
        }
        $d = array('table' => 'aa_reason','status'=>'status','column3'=>'Active');
        $data['countrydata'] = getdata($d);
        $data['result'] = $this->reason_mod->view($reason_id);        
        $data['title'] = 'Track (The Rest Accounting Key)  | Edit reason';
        $data['page_title'] = 'Update reason';

        $data['breadcum'] = array("dashboard/" => 'Home', '' => 'Update reason');
        $page = 'reason/add';
        $data['page'] = $page;
        // pr($data); die;
        _layout($data);
    }


    /**
     * view function 
     */
     public function view($id = "") {
        $reason_id = ID_decode($id);
        if (!empty($reason_id)) {
            $data['result'] = $this->reason_mod->view(@$reason_id);
            $data['title'] = 'Track (The Rest Accounting Key) | reason View';
            $data['page_title'] = 'reason View';
            $data['breadcum'] = array("dashboard/" => 'Home', '' => 'reason View');
            $page = 'reason/view';
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
        $query          =   $this->reason_mod->count_city_data();
        $totalData      =   $query->num_rows();
// pr($query->num_rows()); die;
        $totalFiltered  =   $totalData;  //
        /*End of counting warehouse data*/
        
       // $d = array('id' => 'reason_id', 'name' => 'name', 'status' => 'status');
        $citydata = $this->reason_mod->get_city_data(); 
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
                $nestedData[]   =   $row["country_name"];
                $nestedData[]   =   $row["status"];	
                $reason_id        =   $row['reason_id'];
                $nestedData[]   =   $this->load->view("reason/_action", array("row" => $row), true);
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