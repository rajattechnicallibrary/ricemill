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
class City extends CI_Controller {

    /**
     * Constructor
     */
    function __construct() {
        parent::__construct();
        $this->load->model('city_mod');
        // is_protected();
        is_adminprotected();
		validate_admin_login();
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
        $data['title'] = 'Track (The Rest Accounting Key) | City';
        $data['page_title'] = 'City';
        $page = 'city/listing';
        $data['page'] = $page;
        $d = array('id' => 'city_id', 'name' => 'name', 'status' => 'status');
        $data['citydata'] = $this->city_mod->getdata($d);
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
            $this->form_validation->set_rules('city_name', 'City Name',  'trim|required|is_unique[am_city.name]');
            $this->form_validation->set_rules('state_name', 'State Name',  'trim|required');
            $this->form_validation->set_rules('status', 'Status', 'required');
            if ($this->form_validation->run() == FALSE) {
                
            } else {                
                $postdata = array(
                    'state_id'        => $_POST['state_name'],
                    'name'              => $_POST['city_name'],                    
                    'status'            => $_POST['status'],                    
                );
                $this->city_mod->add($postdata);
                set_flashdata('success', 'New city added successfully');
                redirect('/master/city');
            }
        }
        
        $data['title'] = 'Track (The Rest Accounting Key) | City Add';
        $data['page_title'] = 'Add City';
        $data['breadcum'] = array("dashboard/" => 'Home', '' => 'Add City');
        $page = 'city/add';        
        $d = array('table' => 'am_state','status'=>'status','column3'=>'Active');
        $data['countrydata'] = getdata($d);         
        $data['page'] = $page;
        // pr( $data); die;
        _layout($data);
    }
       
    /**
     * deletecategories
     *
     * this function delete city
     * 
     * @access	public
     * @return	html data
     */
    public function delete_city() {
        $post = $this->input->post('id');
        if (!empty($post)) {
            if ($this->city_mod->delete_city($post)) {                
                set_flashdata('success', 'City deleted successfully');
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
        
        $city_id = ID_decode($id);
        if (isPostBack()) {
            $city_id = ID_decode($id);
            $this->form_validation->set_rules('city_name', 'City Name',  'trim|required');
            $this->form_validation->set_rules('state_name', 'State Name',  'trim|required');
            $this->form_validation->set_rules('status', 'Status', 'required');
           
            if ($this->form_validation->run() == FALSE) {
                
            } else {
                /*check name for pre existance*/
                $city_name        =   $this->input->post('city_name');
                $check_data         =   $this->city_mod->check_preexistance($city_id,$city_name);
                /*End of this*/
                if($check_data)
                {
                    set_flashdata('error', 'City name already exist.');
                    redirect("/master/city/edit/$id");
                }else{
                    $this->city_mod->edit($city_id);
                    set_flashdata('success', 'City name updated successfully');
                    redirect('/master/city');
                }
            }
        }
        $d = array('table' => 'am_state','status'=>'status','column3'=>'Active');
        $data['countrydata'] = getdata($d);
        $data['result'] = $this->city_mod->view($city_id);        
        $data['title'] = 'Track (The Rest Accounting Key)  | Edit City';
        $data['page_title'] = 'Update City';

        $data['breadcum'] = array("dashboard/" => 'Home', '' => 'Update City');
        $page = 'city/add';
        $data['page'] = $page;
        // pr($data); die;
        _layout($data);
    }


    /**
     * view function 
     */
     public function view($id = "") {
        $city_id = ID_decode($id);
        if (!empty($city_id)) {
            $data['result'] = $this->city_mod->view(@$city_id);
            $data['title'] = 'Track (The Rest Accounting Key) | City View';
            $data['page_title'] = 'City View';
            $data['breadcum'] = array("dashboard/" => 'Home', '' => 'City View');
            $page = 'city/view';
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
        $query          =   $this->city_mod->count_city_data();
        $totalData      =   $query->num_rows();
// pr($query->num_rows()); die;
        $totalFiltered  =   $totalData;  //
        /*End of counting warehouse data*/
        
       // $d = array('id' => 'city_id', 'name' => 'name', 'status' => 'status');
        $citydata = $this->city_mod->get_city_data(); 
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
                
                $nestedData[]   =   $row["city_name"];
                $nestedData[]   =   $row["country_name"];
                $nestedData[]   =   $row["status"];	
                $city_id        =   $row['city_id'];
                $nestedData[]   =   $this->load->view("city/_action", array("row" => $row), true);
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