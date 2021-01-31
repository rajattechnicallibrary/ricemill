<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Permission_denied extends CI_Controller {
	/**
	 *  Site Controller
	 *
	 * @package		Permission_denied
	 * @category    Permission_denied
	 * @author		Sumit Kumar 
	 * @website		http://www.thealternativeaccount.com
	 * @company     thealternativeaccount Inc
	 * @since		Version 1.0
	 */
	 /**
     * Constructor
     */
    function __construct() 
    {
        parent::__construct();
        $this->load->model('admin/Seller_mod');
    }
    /*End of constructor*/
    
	/**
     *index
     *
     * This function dispaly main site page
     * 
     * @access	public
     * @return	html data
     */
	public function index()
	{
		$data['title'] = 'Access Denied';
        $data['subTitle'] = 'Access Denied';
        $data['page'] =  'access_denied';
		$this->load->view('layout', $data);
	}
}
