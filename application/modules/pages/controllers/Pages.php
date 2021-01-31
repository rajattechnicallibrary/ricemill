<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Pages extends CI_Controller {


     /**
     * Constructor
     */
    function __construct() {
        parent::__construct();
        $this->load->model('pages_mod');        
    }


    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     * 		http://example.com/index.php/welcome
     * 	- or -
     * 		http://example.com/index.php/welcome/index
     * 	- or -
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see https://codeigniter.com/user_guide/general/urls.html
     */
    public function index($page_name) 
	{ 
		$this->db->select('*');
		$this->db->where('name',$page_name);
		$page_data = $this->db->get('fs_cms');
		if($page_data->num_rows() > 0)
		{
			$page_data = $page_data->result();
			$page_data = $page_data[0];
		}
        $page_id                    = $page_data->id;
        
        if($page_id==1){
            $data['breadcum'] = array("site/" => 'Home', '' => 'About Us');
        } else if($page_id==2) {
            $data['breadcum']           = array("site/" => 'Home', '' => 'Terms and Conditions '); 
        } else if($page_id==3){
            $data['breadcum']           = array("site/" => 'Home', '' => 'Privacy Policy');
        } else if($page_id==4) {
            $data['breadcum']           = array("site/" => 'Home', '' => 'Press & News');
        } else if($page_id==5){
            $data['breadcum']           = array("site/" => 'Home', '' => 'Customer Service');
        } else if($page_id==6){
            $data['breadcum']           = array("site/" => 'Home', '' => 'GUIDELINES FOR USERS');
        } else if($page_id==7){
            $data['breadcum']           = array("site/" => 'Home', '' => 'RETURN POLICY');
        } else {

        }

        $data['pages_content']      = $this->pages_mod->get_content($page_id);       
        $data['page']               = 'pages/pages';
        $data['title']              = 'Track (The Rest Accounting Key) || Privacy Policy';
        $this->load->view('landing_layout', $data);


    }
    
    public function privacy_policy()
    {

        $page_id                    = $this->input->get('id');
        $page_id                    = ID_decode($page_id);
        $data['about_us']           = $this->pages_mod->get_content($page_id);       
        $data['breadcum']           = array("site/" => 'Home', '' => 'Privacy Policy');
        $data['page']               = 'pages/pages';
        $data['title']              = 'Track (The Rest Accounting Key) || Privacy Policy';
        $this->load->view('landing_layout', $data);
    }
    
    /* public function terms_n_conditions()
    {

        $page_id                    = $this->input->get('id');
        $page_id                    = ID_decode($page_id);
        $data['about_us']           = $this->pages_mod->get_content($page_id);       
        $data['breadcum']           = array("site/" => 'Home', '' => 'Terms and Conditions ');
        $data['page']               = 'pages/pages';
        $data['title']              = 'Track (The Rest Accounting Key) || Terms and Conditions';
        $this->load->view('landing_layout', $data);
    } */
    
    
      public function about_us()
        {
            $page_id            = $this->input->get('id');
            $page_id            = ID_decode($page_id);
            $data['about_us']   = $this->pages_mod->get_content($page_id);
           // pr($data['about_us']); die;
           
            $data['page']   = 'pages/pages';
            $data['title'] = 'Track (The Rest Accounting Key) || About Us';
            $this->load->view('landing_layout', $data);
        }
    
   

}
