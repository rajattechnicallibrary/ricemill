<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends MY_Controller {

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

    /**
     * Constructor
     */ 
    function __construct() {
        parent::__construct();
        $this->load->model('Auth_mod');
       //  is_adminprotected();
       //validate_admin_login();
        validate_admin_login();
    }
	
	/**
     * End of function
     */
	 
	 /**
     * index
     *
     * This function to render dashboard page initially
     * 
     * @access	public
     * @return  html
     */

    public function index() {
	

        $data['total_weight']   = $this->Auth_mod->RealTimeDataCount()['billing'];
        $data['FinalAmountPaddy']   = $this->Auth_mod->RealTimeDataCount()['FinalAmountPaddy'];
        $data['TotalKatti']   = $this->Auth_mod->RealTimeDataCount()['TotalKatti'];
        $data['maxpurchaser']   = $this->Auth_mod->RealTimeDataCount()['maxpurchaser'];
       // $data['FinalWeight']   = $data['total_weight']->FinalWeight;
    //   pr($data); die;
        $data['total_runningcampaigns']   = 50;
        // pr($this->session->all_userdata()); die;
        $data['page'] = 'dashboard/site_dashboard';
        $data['title'] = 'Track (The Rest Accounting Key) || Dashboard';
        $this->load->view('layout',$data);
    }
    public function profilesss() {
        $data['page'] = 'profile/profile';
        $data['title'] = 'Track (The Rest Accounting Key) || Dashboard';
        $this->load->view('layout',$data);
    }

    public function email(){

     //   pr(phpinfo()); 
       // die;

//        $config['protocol'] = 'sendmail';
// $config['mailpath'] = '/usr/sbin/sendmail';
// $config['charset'] = 'iso-8859-1';
// $config['wordwrap'] = TRUE;

// $this->email->initialize($config);


//        $this->load->library('email');
       $this->load->library('Sendmail');

// $this->email->from('tekshapers.rajat@gmail.com', 'Your Name');
// $this->email->to('tekshapers.rajat@gmail.com');
// // $this->email->cc('another@another-example.com');
// // $this->email->bcc('them@their-example.com');

// $this->email->subject('Email Test');
// $this->email->message('Testing the email class.');

//         $this->email->send();


            $mail = new PHPMailer(); // create a new object
            $mail->IsSMTP(); // enable SMTP
            $mail->SMTPDebug = 1; // debugging: 1 = errors and messages, 2 = messages only
            $mail->SMTPAuth = true; // authentication enabled
            $mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for GMail
            $mail->Host = "smtp.gmail.com";
            $mail->Port = 465; // or 587
            $mail->IsHTML(true);
            $mail->Username = "erp@kyisolutions.com";//ankit2@thealternativeaccount.com    OR   test.thealternativeaccount@gmail.com";
            $mail->Password = "kyi@1234";  
            $mail->Subject = 'sss';
            $mail->Body = 'sdfsdf';
           // $mail->AddAddress = 'tekshapers.rajat@gmail.com';

            $mail->AddAddress('sendto@gmail.com', 'abc');
      $mail->SetFrom('xxxxxx@gmail.com', 'def');
      $mail->Subject = 'PHPMailer Test Subject via mail(), advanced';
      $mail->AltBody = 'To view the message, please use an HTML compatible email viewer!'; // optional - MsgHTML will create an alternate automatically
      $mail->MsgHTML('sssss');
      $mail->Send();



            if($mail->Send()){
                echo  'TRUE';
			
            }else{
                echo 'FALSE';
			
            }

        _sendMailPhpMailer('tekshapers.rajat@gmail.com');
       // echo "Yes";
    }
	
	/*End of function*/
}
/*End of class*/