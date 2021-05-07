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
	
        // $api_url = 'https://eproc.up.gov.in/wheat2122/Uparjan/Nominee_Update.aspx';
    //     $api_url = urlencode($api_url);
    //     $api_url = file_get_contents($api_url);
    //    // $api_url = var_dump($api_url);
        
    //     pr($api_url); 
    //   //  curl_close($curlSession);
    //     die;



        $data['total_weight']   = $this->Auth_mod->RealTimeDataCount()['billing'];
        $data['FinalAmountPaddy']   = $this->Auth_mod->RealTimeDataCount()['FinalAmountPaddy'];
        $data['TotalKatti']   = $this->Auth_mod->RealTimeDataCount()['TotalKatti'];
        $data['maxpurchaser']   = $this->Auth_mod->RealTimeDataCount()['maxpurchaser'];
        $data['first']   = $this->Auth_mod->RealTimeDataCount()['first'];
        $data['second']   = $this->Auth_mod->RealTimeDataCount()['second'];
        $data['jamura']   = $this->Auth_mod->RealTimeDataCount()['jamura'];
        $data['pcf']   = $this->Auth_mod->RealTimeDataCount()['pcf'];
        $data['reva']   = $this->Auth_mod->RealTimeDataCount()['reva'];
        $data['upss']   = $this->Auth_mod->RealTimeDataCount()['upss'];
        $data['todharpur']   = $this->Auth_mod->RealTimeDataCount()['todharpur'];
       // $data['FinalWeight']   = $data['total_weight']->FinalWeight;
    //   pr($data); die;
        $data['total_runningcampaigns']   = 50;
        // pr($this->session->all_userdata()); die;
        $data['page'] = 'dashboard/site_dashboard';
        $data['title'] = 'Track (The Rest Accounting Key) ||p Dashboard';
        $this->load->view('layout',$data);
    }
    public function profilesss() {
        $data['page'] = 'profile/profile';
        $data['title'] = 'Track (The Rest Accounting Key) || Dashboard';
        $this->load->view('layout',$data);
    }

    public function sendWhatsapp(){

      // pr($_POST); die;
            $custommsg = 'अपके नाम ' .$_POST['totalExpenses']. ' धन राशी है | अपके जमा ' .$_POST['deposit']. ' धन राशी है शेष नाम ' .$_POST['MyFinalExpenses']; 
            $chatApiToken = "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJleHAiOjE2MjE0MzA1MDgsInVzZXIiOiI5MTg4ODc5MDUwNzAifQ.4LwafGBl-ZEmWAAixPeVTGZMDBSBPrzp7PV6DAlNXMM"; // Get it from https://www.phphive.info/255/get-whatsapp-password/
            $number = $_POST['mobile_no']; // Number
            $message = $custommsg; // Message
            $curl = curl_init();
            curl_setopt_array($curl, array(
            CURLOPT_URL => 'http://chat-api.phphive.info/message/send/text',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS =>json_encode(array("jid"=> $number."@s.whatsapp.net", "message" => $message)),
            CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer '.$chatApiToken,
                'Content-Type: application/json'),
            ));
            $response = curl_exec($curl);
            curl_close($curl);
            echo $response;
    }

    public function email($emailTo,$emailToName, $subject, $body){
       // pr($emailTo); die;
            $this->load->library('Sendmail');
            $mail = new PHPMailer(); // create a new object
            $mail->IsSMTP(); // enable SMTP
            $mail->SMTPDebug = 1; // debugging: 1 = errors and messages, 2 = messages only
            $mail->SMTPAuth = true; // authentication enabled
            $mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for GMail
            $mail->Host = "smtp.gmail.com";
            $mail->Port = 465; // or 587
            $mail->IsHTML(true);
            $mail->Username = "tekshapers.rajat@gmail.com";//ankit2@thealternativeaccount.com    OR   test.thealternativeaccount@gmail.com";
            $mail->Password = "Rkg@5853";  
            $mail->Subject = 'sss';
            $mail->Body = 'sdfsdf';
            $mail->AddAddress($emailTo, $emailToName);
            $mail->SetFrom('admin@thecrindustries.com', 'C R Industries');
            $mail->Subject = $subject;
            $mail->AltBody = $body;
            $mail->MsgHTML('sssss');
            $mail->Send();
            if($mail->Send()){
                echo  'TRUE';
			
            }else{
                echo 'FALSE';
			
            }
    }
	
    public function invoice_creation(){
        generate_kyi_invoice_pdf();
    }
    public function js_invoice_creation(){
       // $data['page'] = 'billing/add';
		//$data['title'] = "Track (The Rest Accounting Key) || Edit";
        
		$this->load->view('invoice_data/js_pdfs', true);
       // $this->load->view('layout', $data);
    }
	/*End of function*/
    
    
    
    public function mydata(){
        
    //     $file = fopen("uploads/abc.csv","r");
    //     $data = [];
    //     $i = 0;
    //     while(!feof($file))
    //     {
    //         $data[] = fgetcsv($file);
    //     }
    //   pr($data);
    //    for($j = 0 ; $j < count($data) ; ){
    //         $date = str_replace('/', '-', $data[$j][12]);
    //         $updateData			=	array(
    //             //'PFMS_Status' =>  $data[$j][7],
    //             //'Ack_Status' =>  $data[$j][10],
    //             //'Payment_Status' =>  $data[$j][11],
    //             'Payment_Date' => date('d-m-Y',strtotime($date)),
    //             //'Purchase_ID' =>  $data[$j][0],
    //              );
    //                 // pr($updateData); die;                  
    //             $this->db->where('Farmer_ID', $data[$j][1]);
    //             $this->db->where('FY', fy()->FY);
    //             $this->db->where('product_type', fy()->product_type);	
    //             $this->db->update('kisanvahidata',$updateData);
    //         $j++;
    //    }
    //     die;
        // Check form submit or not 
        if($this->input->post('upload') != NULL ){ 
           $data = array(); 
           if(!empty($_FILES['file']['name'])){ 
             // Set preference 
                $config['upload_path'] = 'uploads/'; 
                $config['allowed_types'] = 'csv'; 
               // $config['encrypt_name'] = true; 
                $config['max_size'] = '1000'; // max_size in kb 
                $config['file_name'] = $_FILES['file']['name'];
    
                // Load upload library 
                $this->load->library('upload',$config); 
        
                // File upload
                if($this->upload->do_upload('file')){ 
                // Get data about the file
                $uploadData = $this->upload->data(); 
                $filename = $uploadData['file_name'];

                    $file = fopen("uploads/".$filename,"r");
                    $data = [];
                    $i = 0;
                    while(!feof($file))
                    {
                        $data[] = fgetcsv($file);
                    }
                //    pr($data);  die;                

              for($j = 0 ; $j < count($data) ; ){
                $date = str_replace('/', '-', $data[$j][12]);
                $updateData			=	array(
                'PFMS_Status' =>  $data[$j][7],
                'Ack_Status' =>  $data[$j][10],
                'UTR_No' =>  $data[$j][13],
                'Farmer_name_PFMS' =>  $data[$j][3],
                'Payment_Status' =>  $data[$j][11],
                'Payment_Date' => date('d-m-Y',strtotime($date)),
                'Purchase_ID' =>  $data[$j][0],
                 );
                $this->db->where('Farmer_ID', $data[$j][1]);
                $this->db->where('FY', fy()->FY);
                $this->db->where('CenterName', $_POST['centerType']);
                $this->db->where('product_type', fy()->product_type);	
                $this->db->update('kisanvahidata',$updateData);
            $j++;
            }

            $data['response'] = '<h1>successfully uploaded '.$filename."</h1>"; 
             }else{ 
                $data['response'] = 'failed'; 
             } 
          }else{ 
             $data['response'] = 'failed'; 
          } 
          // load view 
          $this->load->view('invoice_data/js_pdfs',$data); 
        }else{
          // load view 
          $this->load->view('invoice_data/js_pdfs'); 
        }
    
      }

      public function all_mydata(){
        
        //      $file = fopen("uploads/fy_all_data_excel_2.csv","r");
        // $data = [];
        // $i = 0;
        // while(!feof($file))
        // {
        //     $data[] = fgetcsv($file);
        // }
            if($this->input->post('upload') != NULL ){ 
               $data = array(); 
               if(!empty($_FILES['file']['name'])){ 
                 // Set preference 
                    $config['upload_path'] = 'uploads/'; 
                    $config['allowed_types'] = 'csv'; 
                   // $config['encrypt_name'] = true; 
                    $config['max_size'] = '1000'; // max_size in kb 
                    $config['file_name'] = $_FILES['file']['name'];
        
                    // Load upload library 
                    $this->load->library('upload',$config); 
            
                    // File upload
                    if($this->upload->do_upload('file')){ 
                    // Get data about the file
                    $uploadData = $this->upload->data(); 
                    $filename = $uploadData['file_name'];
    
                        $file = fopen("uploads/".$filename,"r");
                        $data = [];
                        $i = 0;
                        while(!feof($file))
                        {
                            $data[] = fgetcsv($file);
                        }
                    //    pr($data);  die;                
    
                  for($j = 0 ; $j < count($data) ; ){
        //           $date = str_replace('/', '-', $data[$j][12]);
                    $updateData			=	array(
                    'Farmer_hindi_name' =>  $data[$j][0],
                    'bank_name' =>  $data[$j][4],
                    'ifsc_code' =>  $data[$j][6],
                    'mobile_no' =>  $data[$j][1],
                    'Farmer_ID' =>  $data[$j][2],
                     );
                  //   pr($updateData);
                    $this->db->where('Farmer_ID', $data[$j][2]);
                    $this->db->where('FY', fy()->FY);
                    $this->db->where('CenterName', $_POST['centerType']);
                    $this->db->where('product_type', fy()->product_type);	
                    $this->db->update('kisanvahidata',$updateData);
                $j++;
                }
    
                $data['response'] = '<h1>successfully uploaded '.$filename."</h1>"; 
                 }else{ 
                    $data['response'] = 'failed'; 
                 } 
              }else{ 
                 $data['response'] = 'failed'; 
              } 
              // load view 
              $this->load->view('invoice_data/all_my_js_pdfs',$data); 
            }else{
              // load view 
              $this->load->view('invoice_data/all_my_js_pdfs'); 
            }
        
          }
    
}
/*End of class*/