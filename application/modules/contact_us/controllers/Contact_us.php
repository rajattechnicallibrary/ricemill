<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Contact_us extends CI_Controller {
    /**
     *  Contact_us Controller
     *
     * @package		Contact_us
     * @category    Contact_us
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
        $this->load->model('contact_us_mod');
		$this->load->library('image_lib');
		$this->load->helper('function');  
		$this->load->library('upload');	
    }

    /* End of constructor */

    /**
     * index
     *
     * This function dispaly main site page
     * 
     * @access	public
     * @return	html data
     */
    public function index() {

		if (isPostBack()) {  
			$this->form_validation->set_rules('fname_cnt', 'First Name',  'trim|required|max_length[35]');
			$this->form_validation->set_rules('lname_cnt', 'Last Name',  'trim|required|max_length[35]');
			$this->form_validation->set_rules('mobile_cnt', 'Mobile',  'trim|required|max_length[10]|numeric');
            $this->form_validation->set_rules('email_cnt', 'Email', 'trim|required|max_length[35]|valid_email');
			$this->form_validation->set_rules('message_cnt', 'Message', 'trim|required');
		
			if ($this->form_validation->run() == FALSE) {
                
            } else {  					
                $result = $this->contact_us_mod->add();
				if($result['status']=='success'){				
				/*sending mail to user's registered email*/
                $email_data['to'] 			= ADMIN_EMAIL;
				$email_data['from'] 		= $result['email'];
				$email_data['sender_name'] 	= $result['sender_name'];
				$email_data['subject'] 		= "Track (The Rest Accounting Key):: Query from customer";
				$email_data['message'] 		= array('header' => 'Query from customer!',
					'body' => 'Hello <br/>You have query<br><br>Thanks,<br/>Track (The Rest Accounting Key)');
				_sendMailPhpMailer($email_data);
				}
                set_flashdata('success', 'We have recieved your query. We will get back to you soon!');
                redirect('/contact_us');
            }		
		}
		
        $data['page'] = 'contact_us/contactsus';
        $data['title'] = 'Track (The Rest Accounting Key) || Contact_us List';
        $data['breadcum']   =   array("site/" => 'Home',''=>'Contact Us');
        $this->load->view('landing_layout', $data);
    }

    /* End of function */
}

// End of Class
