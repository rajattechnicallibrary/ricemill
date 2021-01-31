<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Contact_us Model 
 *
 * @package		Contact_us
 * @subpackage	Contact_us
 * @category	Contact_us 
 * @author		Dharmendra Pal
 * @website		http://www.thealternativeaccount.com
 * @company     thealternativeaccount Inc
 * @since		Version 1.0
 */
class Contact_us_mod extends CI_Model {
    /**
     * Constructor
     */
    function __construct() {
        parent::__construct();
    }

    /**
     * End
     */

	 public function add(){
		 if(!empty($_POST) && is_array($_POST)){
			 $data['first_name']            = $this->input->post('fname_cnt');
			 $data['last_name']             = $this->input->post('lname_cnt');
			 $data['mobile']             	= $this->input->post('mobile_cnt');
			 $data['email']             	= $this->input->post('email_cnt');
			 $data['message']             	= $this->input->post('message_cnt');
		 
		$this->db->insert('fs_contactus',$data);
		$res['insert_id'] 	= $this->db->insert_id();
		$res['sender_name'] = $this->input->post('fname').' '.$this->input->post('lname');
		$res['email'] 	= $this->input->post('email');
		$res['status']		= "success";		 
		 } else {
		$res['insert_id']	= "";
		$res['status']		= "error";			
		 }		
		 return $res;
	 }
}

/* End of Class */
?>