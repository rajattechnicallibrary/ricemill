<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {
	
	/**
     *  Admin Controller
     *
     * @package		Admin
     * @category    Admin
     * @author		Dharmendra Pal
     * @website		http://www.thealternativeaccount.com
     * @company     thealternativeaccount Inc
     * @since		Version 1.0
     */

    /**
     * Constructor
     */
    function __construct() {
        parent::__construct();  
		is_adminprotected();		
		validate_admin_login();		
    }

    /* End of constructor */
	
	/**
     *index
     *
     * This function dispaly login page
     * 
     * @access	public
     * @return	html data
    */
    public function index()
    
	{
        redirect(base_url('admin/auth/login'));               
            
	}
        
         /*End of Function*/
}
