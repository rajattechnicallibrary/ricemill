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
 * @webtax		http://www.thealternativeaccount.com
 * @company             thealternativeaccount Inc
 * @since		Version 1.0
 */
class Tax extends CI_Controller {

    /**
     * Constructor
     */
    function __construct() {
        parent::__construct();
        $this->load->model('tax_mod');
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
        $data['title'] = 'Track (The Rest Accounting Key) | Tax Name';
        $data['page_title'] = 'Tax Name';
        $page = 'tax/listing';
        $data['page'] = $page;
        //$d = array('id' => 'tax_id', 'status' => 'status');
        //$data['citydata'] = $this->tax_mod->getdata($d);
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

            $this->form_validation->set_rules('cgst', 'CGST %',  'trim|required|numeric');
            $this->form_validation->set_rules('sgst', 'SGST %',  'trim|required|numeric');
            $this->form_validation->set_rules('gst', 'GST %',  'trim|numeric');
            $this->form_validation->set_rules('status', 'Status', 'trim|required');
            if ($this->form_validation->run() == FALSE) {
                
            } else {                
                $postdata = array(
                    'cgst'                              => $_POST['cgst'],           
                    'sgst'                              => $_POST['sgst'],           
                    'gst'                              => $_POST['gst'],           
                    'status'                            => $_POST['status'],                  
                );
                $this->tax_mod->add($postdata);
                set_flashdata('success', 'New Tax Name added successfully');
                redirect('/master/tax');
            }
        }
        
        $data['title'] = 'Track (The Rest Accounting Key) | Add Tax Name';
        $data['page_title'] = 'Add Tax Name';
        $data['breadcum'] = array("dashboard/" => 'Home', '' => 'Add Tax Name');
        $page = 'tax/add';        
    //    $d = array('table' => 'aa_tax','status'=>'status','column3'=>'Active');
      //  $data['countrydata'] = getdata($d);         
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
            if ($this->tax_mod->delete_city($post)) {                
                set_flashdata('success', 'Tax Name deleted successfully');
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
        $tax_id = ID_decode($id);
        if (isPostBack()) {
            $tax_id = ID_decode($id);
            $this->form_validation->set_rules('cgst', 'CGST %',  'trim|required|numeric');
            $this->form_validation->set_rules('sgst', 'SGST %',  'trim|required|numeric');
            $this->form_validation->set_rules('gst', 'GST %',  'trim|numeric');
            $this->form_validation->set_rules('status', 'Status', 'trim|required');
           
            if ($this->form_validation->run() == FALSE) {
                
            } else {
                /*check name for pre existance*/
                $city_name        =   $this->input->post('tax_name');
                $check_data         =   $this->tax_mod->check_preexistance($tax_id,$city_name);
                /*End of this*/
                if($check_data)
                {
                    set_flashdata('error', 'Tax Name name already exist.');
                    redirect("/master/tax/edit/$id");
                }else{
                    $this->tax_mod->edit($tax_id);
                    set_flashdata('success', 'Tax Name name updated successfully');
                    redirect('/master/tax');
                }
            }
        }
       // $d = array('table' => 'aa_tax','status'=>'status','column3'=>'Active');
     //   $data['countrydata'] = getdata($d);
        $data['result'] = $this->tax_mod->view($tax_id);        
        $data['title'] = 'Track (The Rest Accounting Key)  | Edit Tax Name';
        $data['page_title'] = 'Update Tax Name';

        $data['breadcum'] = array("dashboard/" => 'Home', '' => 'Update Tax Name');
        $page = 'tax/add';
        $data['page'] = $page;
        // pr($data); die;
        _layout($data);
    }


    /**
     * view function 
     */
     public function view($id = "") {
        $tax_id = ID_decode($id);
        if (!empty($tax_id)) {
            $data['result'] = $this->tax_mod->view(@$tax_id);
            $data['title'] = 'Track (The Rest Accounting Key) | Tax Name View';
            $data['page_title'] = 'Tax Name View';
            $data['breadcum'] = array("dashboard/" => 'Home', '' => 'Tax Name View');
            $page = 'tax/view';
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
        $query          =   $this->tax_mod->count_city_data();
        $totalData      =   $query->num_rows();
// pr($query->num_rows()); die;
        $totalFiltered  =   $totalData;  //
        /*End of counting warehouse data*/
        
       // $d = array('id' => 'tax_id', 'name' => 'name', 'status' => 'status');
        $citydata = $this->tax_mod->get_city_data(); 
         //pr($citydata);die;       
        $data   =   array();
        if(count($citydata)>0)
        {
            $j = $requestData['start'];
            for( $i=0; $i<count($citydata);$i++ ) 
            {  
                $j++;
                $row    =   (array)$citydata[$i];
             //   pr($row); die;
                $nestedData     =   array(); 
                //$nestedData[]   =   "<input type='checkbox'  class='deleteRow' value='".$row['id']."'  />";
                $nestedData[]   =   $j;
                 // $nestedData[]   =   $row["city_name"];
                 $nestedData[]   =   $row["cgst"];
                 // $nestedData[]   =   substr($row["contact_person_name"], 0, 10);
                 // $nestedData[]   =   $row["contact_person_number"];
                 $nestedData[]   =   $row["sgst"];
                 $nestedData[]   =   $row["gst"];
 
                 $nestedData[]   =   $row["status"];	
                 $tax_id        =   $row['tax_id'];
                $nestedData[]   =   $this->load->view("tax/_action", array("row" => $row), true);
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