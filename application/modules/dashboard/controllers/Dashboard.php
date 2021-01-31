<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends MY_Controller {

    /**
     * Constructor
     */
    function __construct() {
        parent::__construct();
        $this->load->model('dashboard_mod');
        $this->load->model('rating/rating_mod');
        //$this->load->library('MailChimp');
		
     is_adminprotected();
     validate_admin_login();
        //$list_id = '781f5ee56c';
        //$result = $this->mailchimp->post("lists/$list_id/members", [ 'email_address' => 'ankit21@thealternativeaccount.com', 'merge_fields' => ['FNAME'=>'Ralph', 'LNAME'=>'Vugts'], 'status' => 'subscribed', ]);
        
    }

    /* End of constructor */

    public function index() {
        
        
 
    }

    

    

    

    

    

}
