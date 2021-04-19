<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/** 
 * Database helper
 *
 * @package		Helpers
 * @category            database helper
 * @author		Ankit Rajput
 * @website		http://www.thealternativeaccount.com
 * @company             thealternativeaccount Inc 
 * @since		Version 1.0
 */

/**
     * is_adminprotected
     *
     * This function check superadminuser already login or not
     * 
     * @access	public
     * @return	boolean
     */
if (!function_exists('is_adminprotected')) {

        function is_adminprotected() {
            $CI = &get_instance();
            if ($CI->session->userdata('isLogin') == 'yes') {
              //  redirect('/admin/dashboard','refresh');
                return true;
                
            } else {
                redirect('admin/auth');
            }
    }

}
/* End of Function */
/* Date format
 *
 * This function get correct date format
 *
 * @param	
 * @return
 */
if (!function_exists('correct_date')) {    
        function correct_date($posted_date) {
			$posted_date = trim($posted_date);
			if(isset($posted_date)  && $posted_date != '')
			{
				$postdate = str_replace('/', '-',$posted_date); 
				$dateFormat = date("Y-m-d", strtotime($postdate));                      
			}else{
				$dateFormat = '0000-00-00';
			}
            return $dateFormat;
        }
    
    }
    /* End of Function */
/**
     * is_userprotected
     *
     * This function check superadminuser already login or not
     * 
     * @access	public
     * @return	boolean
     */
if (!function_exists('is_userprotected')) {

    function is_userprotected() {
        $CI = &get_instance();
        if ($CI->session->userdata('isLogin') == 'yes') {
            
            return true;
            
        } else {
            redirect('/site');
        }
    }

}

	function ajax_layout($views, $data = array()) {
        $CI = & get_instance();
        $CI->load->view($views, $data);
    }
/* End of Function */


/**
     * validate_admin_login
     *
     * This function check user type and redirect according
     * 
     * @access	public
     * @return	boolean
     */
if (!function_exists('validate_admin_login')) {

    function validate_admin_login() {
        $CI = &get_instance();		
        $CI->db->select("*");
        $CI->db->where('status', 'Active');
        $query = $CI->db->get('aa_template');
        if ($query->num_rows()) {
            $res = $query->row();
            $CI->session->set_userdata('fy', $res);
        }
		if ($CI->session->userdata('isLogin') == 'yes') { 
					if($CI->session->userdata('user_type')==1){	
                   //     redirect('/admin/dashboard','refresh');	
					}  			
		}else{
           redirect('admin/auth');
        }
		
    }

}
/* End of Function */


/**
     * validate_user_login
     *
     * This function check user type and redirect according
     * 
     * @access	public
     * @return	boolean
     */
if (!function_exists('validate_user_login')) {

    function validate_user_login() {
        $CI = &get_instance();		
		if ($CI->session->userdata('isLogin') == 'yes') { 
					if($CI->session->userdata('user_type')==4){							
					} else if($CI->session->userdata('user_type')==3){					
						redirect('/admin/dashboard');		
					} else {							
						redirect('/admin/dashboard');
					}  			
		}
		
    }

}
/* End of Function */

/**
 * @Function _layout
 * @purpose load layout page 
 * @created  2 dec 2014
 */
if (!function_exists('_layout')) {

    function _layout($data = null) {
        $CI = &get_instance();
        
        $CI->load->view('layout', $data);
    }

}
/* End of Function */

/**
 * set_flashdata
 *
 * This function set falsh message value
 * 
 * @access	public
 * 
 */
if (!function_exists('set_flashdata')) {

    function set_flashdata($type, $msg) {
        $CI = &get_instance();
        $CI->session->set_flashdata($type, $msg);
    }

}
/* End of Function */

/**
 * get_flashdata
 *
 * This function give custome flash message formate
 * 
 * @access	public
 * @return	html data
 */
if (!function_exists('get_flashdata')) {

    function get_flashdata() {
        $CI = &get_instance();
        $success = $CI->session->flashdata('success') ? $CI->session->flashdata('success') : '';
        $error = $CI->session->flashdata('error') ? $CI->session->flashdata('error') : '';
        $warning = $CI->session->flashdata('warning') ? $CI->session->flashdata('warning') : '';
        $msg = '';
        if ($success) {
            $msg = '<div class="alert alert-success flash-row">
                            <button class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><i class="ace-icon fa fa-check green"></i>
                            ' . $success . ' </div>';
        } elseif ($error) {
            $msg = '<div class="alert alert-danger flash-row">
			<button class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><i class="ace-icon fa fa-check green"></i>
			<strong>Error!</strong> ' . $error . ' </div>';
        } elseif ($warning) {
            $msg = '<div class="alert alert-warning flash-row">
			<button class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button>
			' . $warning . '</div>';
        }
        return $msg;
    }

}
/* End of Function */

/**
 * isPostBack
 *
 * This function check request send by POST or  not
 * 
 * @access	public
 * @return	html data
 */
if (!function_exists('isPostBack')) {

    function isPostBack() {
        if (strtoupper($_SERVER['REQUEST_METHOD']) == 'POST')
            return true;
        else
            return false;
    }

}
/* End of Function */

/**
 * isGetBack
 *
 * This function check request send by GET or  not
 * 
 * @access	public
 * @return	html data
 */
if (!function_exists('isGetBack')) {

    function isGetBack() {
        if (strtoupper($_SERVER['REQUEST_METHOD']) == 'GET')
            return true;
        else
            return false;
    }

}
/* End of Function */

/**
 * Current Date And Time
 *
 * This function get Current Date And Time
 *
 * @param	
 * @return
 */
if (!function_exists('current_date')) {

    function current_date() {
        $dateFormat = date("Y-m-d H:i:s", time());
        $timeNdate = $dateFormat;
        return $timeNdate;
    }

}
/* End of Function */


/**
 * Date format
 *
 * This function get correct date format
 *
 * @param	
 * @return
 */
if (!function_exists('correct_date')) {    
        function correct_date($posted_date) {
            $postdate = str_replace('/', '-',$posted_date); 
            $dateFormat = date("Y-m-d", strtotime($postdate));                      
            return $dateFormat;
        }
    
    }
    /* End of Function */

/**
 * Featured plan end Date
 *
 * This function get featured plan end Date
 *
 * @param	
 * @return
 */
if (!function_exists('featured_plan_date')) {
    
        function featured_plan_date($userid) {
            $CI = &get_instance();
            $CI->db->select('plan_featured_end_date');
            $CI->db->from('fs_users');
            $CI->db->where('id',$userid);
            $query = $CI->db->get();
            if($query->num_rows()>0){
                return $query->row()->plan_featured_end_date;
            } else {
                return false;
            }            
        }
    
    }
    /* End of Function */
    
/**
 * Date format for view
 *
 * This function get date format for view exp: d/m/Y
 *
 * @param	
 * @return
 */
if (!function_exists('view_date_format')) {    
    function view_date_format($view_date) {
		if($view_date){
        $view_date = str_replace('-', '/',$view_date); 
        $dateFormat = date("d/m/Y", strtotime($view_date));                      
			return $dateFormat;
		} else {
			return false;
		}
        
    }

}
/* End of Function */



/**
 * get_order_status
 *
 * This function check request send by Ajax or not
 *
 * 	
 * @return boolean
 */
if (!function_exists('get_order_status')) {
    
        function get_order_status($status_id) {
            $CI = &get_instance();
            $CI->db->select('*');
            $CI->db->from('fs_order_status');            
            if($status_id==1){
                $CI->db->where('id !=',$status_id);
            } else if($status_id==2){
                $CI->db->where('id !=',1);
                $CI->db->where('id !=',$status_id);
            } else if($status_id==3){
                $CI->db->where('id !=',1);
                $CI->db->where('id !=',2);
                $CI->db->where('id !=',$status_id);
                $CI->db->where('id !=',5);
            } else if($status_id==4){
                $CI->db->where('id !=',1);
                $CI->db->where('id !=',2);
                $CI->db->where('id !=',3);                
                $CI->db->where('id !=',5); 
                $CI->db->where('id !=',$status_id);            
            } else if($status_id==5) {
                $CI->db->where('id !=',1);
                $CI->db->where('id !=',2);
                $CI->db->where('id !=',3);
                $CI->db->where('id !=',4); 
                $CI->db->where('id !=',$status_id);                        
            } else {
                $CI->db->where('id !=',0);
            }

            $query = $CI->db->get();
            if($query->num_rows()>0){
                return $query->result();
            } else{
                return false;
            }
        }
    
    }
    /* End of Function */

/**
 * Current User Info 
 * 
 * If user loged then returl current user info
 *
 * @access	public
 * @return	mixed	boolean or depends on what the array contains
 */
if (!function_exists('currentuserinfo')) {

    function currentuserinfo() {
        $CI = &get_instance();
        return $CI->session->userdata("userinfo");
    }

}
if (!function_exists('fy')) {

    function fy() {
        $CI = &get_instance();
        return $CI->session->userdata("fy");
    }

}
/* End of Function */



/**
 * uri_segment
 * this function give url segment value
 * @param int 
 * @return string
 */
if (!function_exists('uri_segment')) {

    function uri_segment($val) {
        $CI = &get_instance();
        return $CI->uri->segment($val);
    }

}
/* End of Function */

/**
 * pr
 * this function print data with <pre> tag
 * @access	public
 */
if (!function_exists('pr')) {

    function pr($data = null) {
        echo '<pre>';
        print_r($data);
        echo '</pre>';
    }

}
/* End of Function */



/**
 * is_ajax_post
 *
 * This function check request send by Ajax or not
 *
 * 	
 * @return boolean
 */
if (!function_exists('is_ajax_post')) {

    function is_ajax_post() {
        $CI = &get_instance();
        if (!$CI->input->is_ajax_request()) {
            show_error('No direct script access allowed');
            exit;
        }
    }

}
/* End of Function */



/**
 * Function to check ajax request
 *
 * @access	public
 */
if (!function_exists('is_ajax_request')) {

    function is_ajax_request() {
        $CI = &get_instance();
        if (!$CI->input->is_ajax_request()) {
            show_error('No direct script access allowed');
            exit;
        }
    }

}
/* End of Function */






/**
 * _show404
 *
 * This function show error message
 *
 * 	
 * @return array 
 */
if (!function_exists('_show404')) {

    function _show404() {
        $CI = &get_instance();
        $data['title'] = 'Error';
        $data['subTitle'] = 'Wrong Page';
        $data['page'] = 'error';
        _layout($data);
    }

}
/* End of Function */





/**
 * custom_encryption
 *
 * This function encryt and decrypt value on the base action value
 * @param string
 * @param string
 * @param string
 * 	
 * @return string
 */
if (!function_exists('custom_encryption')) {

    function custom_encryption($string, $key, $action) {  //echo die($action);
        if ($action == 'encrypt')
            return ;//base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, md5($key), $string, MCRYPT_MODE_CBC, md5(md5($key))));
        elseif ($action == 'decrypt')
            return ; //rtrim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, md5($key), base64_decode($string), MCRYPT_MODE_CBC, md5(md5($key))), "\0");
    }

}
/* End of Function */


/**
 * get_topics
 *
 * This function give  captcha image
 * 
 * @return html data
 * 	
 */
if (!function_exists('getcaptchacode')) {

    function getcaptchacode() {
        $CI = & get_instance();
        $CI->load->helper('captcha');
        $listAlpha = 'abcdefghijklmnopqrstuvwxyz0123456789';
        $numAlpha = 5;
        $captcha = substr(str_shuffle($listAlpha), 0, $numAlpha);

        $path = config_item('base_url') . 'captcha/';
        //$fontpath = config_item('base_url').'bucket/frontend/assets/fonts/TitilliumWeb-BoldItalic.ttf';
        $fontpath = 'assets/fonts/verdana.ttf';
        $vals = array(
            'word' => $captcha,
            'img_path' => './captcha/',
            'img_url' => $path,
            //'font_path'	 => 'c:/windows/fonts/verdana.ttf',
            'font_path' => $fontpath,
            'img_width' => '159',
            'img_height' => '32',
            'border' => 0,
            'expiration' => 1800
        );
        $get_captcha = create_captcha($vals); //pr($get_captcha); die;
        $CI->session->set_userdata('codecaptcha', $get_captcha['word']);
        return $get_captcha;
    }

}
/* End of Function */

/**
 * obj_to_arr
 *
 * This function convert std object array into array 
 * 
 * @return array
 * 	
 */
if (!function_exists('obj_to_arr')) {

    function obj_to_arr($obj_arr) {
        $obj_arr = (array) $obj_arr;
        $chkey = array_keys($obj_arr);
        $chval = array_values($obj_arr);
        unset($obj_arr);
        $obj_arr = array_combine($chkey, $chval);
        return $obj_arr;
    }

}
/* End of Function */


/**
 * Id_encode
 *
 * This function to encode ID by a custom number
 * @param string
 * 	
 */
if (!function_exists('ID_encode')) {

    function ID_encode($id) {
        $encode_id = '';
        if ($id) {
            $encode_id = rand(1111, 9999) . (($id + 19)) . rand(1111, 9999);
        } else {
            $encode_id = '';
        }
        return $encode_id;
    }

}
if (!function_exists('email_encoded')) {

    function email_encoded($e) {
        $email_encoded = rtrim(strtr(base64_encode($e), '+/', '-_'), '=');
        return $email_encoded;
    }

}


if (!function_exists('email_decoded')) {

    function email_decoded($e) {
        $email_decoded = base64_decode(strtr($e, '-_', '+/'));
        return $email_decoded;
    }

}
/* End of function */

/**
 * Id_decode
 *
 * This function to decode ID by a custom number
 * @param string
 * 	
 */
if (!function_exists('ID_decode')) {

    function ID_decode($encoded_id) {
        $id = '';
        if ($encoded_id) {
            $id = substr($encoded_id, 4, strlen($encoded_id) - 8);
            $id = $id - 19;
        } else {
            $id = '';
        }
        return $id;
    }

}
/* End of function */




/**
 * _sendMailPhpMailer
 *
 * This function send mail to the given email id 
 * @param string
 * 	
 */
if (!function_exists('_sendMailPhpMailer')) {

    function _sendMailPhpMailer($email_data) {
        $CI = &get_instance();
        $isCISendmail   =   $CI->config->item('sendmailCI');
        if(!$isCISendmail){// mail send by CI sendmail
            
            $config['protocol'] = 'sendmail';
            $config['mailpath'] = '/usr/sbin/sendmail';
            $config['charset']  = 'iso-8859-1';
            $config['wordwrap'] = true;
            
            $CI->email->set_mailtype("html");
            $CI->email->initialize($config);
            $CI->email->from('tekshapers.rajat@gmail.com');
            $CI->email->to('tekshapers.rajat@gmail.com'); 

            // if(@$email_data['to']!=''){
            // }
            
            // if(@$email_data['cc']!=''){
            //     $CI->email->cc(@$email_data['cc']);
            // }
        
            // if(@$email_data['bcc']!=''){
            //     $CI->email->bcc(@$email_data['bcc']); 
            // }
        
            // $i=0;
            // if(@$email_data['file']!=''){
            //     if(is_array(@$email_data['file']) && count(@$email_data['file'])>0){
            //         $arr_files   =   array();
            //         $arr_files   =   @$email_data['file'];
            //         $arr_files_name   =   @$email_data['file_name'];
            //         foreach($arr_files as $file){
            //             $CI->email->attach($file,'attachment',$arr_files_name[$i]);
            //             $i++;
            //         }
                
            //     }else{
                    
            //         $CI->email->attach($email_data['file'],'attachment',@$email_data['file_name']);  
            //     }
            
            // }
            
            $CI->email->subject(ucfirst('Yes'));
            // $data['message']    =   'sfsdfsdfsdf';//$email_data['message'];
            // if(isset($email_data['cmp_logo'])){
            //     $data['cmp_logo']   =   @$email_data['cmp_logo'];
            // }else{
            //     $data['cmp_logo']   =   @currentuserinfo()->cmp_logo;
            // }
       
           // $msg = $CI->load->view('email_template/email_layout', $data, true);
            $CI->email->message('jkjkkjhkjh');
                pr($CI->email->send());
            pr(error_get_last());
                echo "-------------";
            die;
            if (true) {
                return TRUE;
            } else {
                return FALSE;
            }
            
        }else{
            echo "ddddd";
        }
        

    }
}    
/* End of Function */



/**
 * _sendMailOrderConfirmPhpMailer
 *
 * This function send mail to the given email id 
 * @param string
 * 	
 */
if (!function_exists('_sendMailOrderConfirmPhpMailer')) {

    function _sendMailOrderConfirmPhpMailer($email_data,$order_template_data) {
        $CI = &get_instance();
        $isCISendmail   =   $CI->config->item('sendmailCI');
        if($isCISendmail){// mail send by CI sendmail
            
            $config['protocol'] = 'sendmail';
            $config['mailpath'] = '/usr/sbin/sendmail';
            $config['charset']  = 'iso-8859-1';
            $config['wordwrap'] = true;
            
            $CI->email->set_mailtype("html");
            $CI->email->initialize($config);
            $CI->email->from($email_data['from'],ucwords($email_data['sender_name']));

            if(@$email_data['to']!=''){
                $CI->email->to(@$email_data['to']); 
            }
            
            if(@$email_data['cc']!=''){
                $CI->email->cc(@$email_data['cc']);
            }
        
            if(@$email_data['bcc']!=''){
                $CI->email->bcc(@$email_data['bcc']); 
            }
        
            $i=0;
            if(@$email_data['file']!=''){
                if(is_array(@$email_data['file']) && count(@$email_data['file'])>0){
                    $arr_files   =   array();
                    $arr_files   =   @$email_data['file'];
                    $arr_files_name   =   @$email_data['file_name'];
                    foreach($arr_files as $file){
                        $CI->email->attach($file,'attachment',$arr_files_name[$i]);
                        $i++;
                    }
                
                }else{
                    
                    $CI->email->attach($email_data['file'],'attachment',@$email_data['file_name']);  
                }
            
            }
            
            $CI->email->subject(ucfirst($email_data['subject']));
            $data['message']    =   $email_data['message'];
			$data['order_details']   =   $order_template_data['order_details'];
			$data['cart_data']   =   $order_template_data['cart_data'];
			
            if(isset($email_data['cmp_logo'])){
                $data['cmp_logo']   =   @$email_data['cmp_logo'];
            }else{
                $data['cmp_logo']   =   @currentuserinfo()->cmp_logo;
            }
       
            $msg = $CI->load->view('email_template/email_order_template', $data, true);
            $CI->email->message($msg);

            if ($CI->email->send()) {
                return TRUE;
            } else {
                return FALSE;
            }
            
        }else{
            $CI->load->library('Sendmail');
            $mail = new PHPMailer(); // create a new object
            $mail->IsSMTP(); // enable SMTP
            $mail->SMTPDebug = 1; // debugging: 1 = errors and messages, 2 = messages only
            $mail->SMTPAuth = true; // authentication enabled
            $mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for GMail
            $mail->Host = "smtp.gmail.com";
            $mail->Port = 465; // or 587
            $mail->IsHTML(true);
            $mail->Username = "erp@kyisolutions.com";//ankit2@thealternativeaccount.com    OR   test.thealternativeaccount@gmail.com";
            $mail->Password = "kyi@1234";                 //developer@thealternativeaccount1
            
            
            //
            //$mail->SetFrom($email_data['from'],$email_data['sender_name'],0);
            $mail->Subject = $email_data['subject'];
            $data['message'] = $email_data['message'];
			$data['order_details']   =   $order_template_data['order_details'];
			$data['cart_data']   =   $order_template_data['cart_data'];
			
            if(isset($email_data['cmp_logo'])){
                $data['cmp_logo']   =   @$email_data['cmp_logo'];
            }else{
                $data['cmp_logo']   =   @currentuserinfo()->cmp_logo;
            }
        
            $msg = $CI->load->view('email_templates/email_order_template', $data, true);
            //echo $msg;die;
            $mail->Body = $msg;
        
            if (@$email_data['from']!='') {
           
                $mail->SetFrom(@$email_data['from'],@$email_data['sender_name'],'1'); 
            }
       
            if (@$email_data['to']!='') {
                $arr_to =   explode(',',@$email_data['to']);
                foreach($arr_to as $to){
                    $mail->AddAddress($to);
                }
            
            }
            if (@$email_data['cc']!='') {
                $arr_cc =   explode(',',@$email_data['cc']);
                foreach($arr_cc as $cc){
                    $mail->AddCC($cc);
                }
            
            }
        
            if(@$email_data['bcc']!='') {
                $arr_bcc =   explode(',',@$email_data['bcc']);
                foreach($arr_bcc as $bcc){
                    $mail->AddBCC($bcc);
                }
            }
        
            if(@$email_data['file']!='') {
                if(is_array(@$email_data['file']) && count(@$email_data['file'])>0){
                    $arr_files       =   array();
                    $arr_files_name  =   array();
                    $arr_files       =   @$email_data['file'];
                    $i=0;
                    if(is_array(@$email_data['file_name']) && count(@$email_data['file_name'])>0){
                        $arr_files_name   =   @$email_data['file_name'];
                        foreach($arr_files as $file){
                   
                            $mail->AddAttachment($file,$arr_files_name[$i]); 
                            $i++;
                        }
                    }else{
                        foreach($arr_files as $file){
                   
                            $mail->AddAttachment($file); 
                   
                        } 
                    }
               
                
                }else{
                    $CI->email->attach();
                    $mail->AddAttachment($email_data['file']);
                }
            
            }

            if($mail->Send()){
                return TRUE;
			
            }else{
                return FALSE;
			
            }
        }
        

    }
}    
/* End of Function */





/**
 * send mobile one time password 
 * send one time password api function
 */
if (!function_exists('send_otp')) {

    function send_otp($content, $number) {
        $content = urlencode($content);
        $Url = "http://tra.smsmyntraa.com/API/WebSMS/Http/v1.0a/index.php?username=" . USERNAME . "&password=" . PASSWORD . "&sender=" . SENDERID . "&to=" . $number . "&message=" . $content . "&reqid=1&format={json|text}&route_id=Transactional&callback=&unique=0&sendondate=" . date('Y-m-d H:i:s') . "";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $Url);
        curl_setopt($ch, CURLOPT_USERAGENT, "MozillaXYZ/1.0");
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);
        $output = curl_exec($ch);
        $errmsg = curl_error($ch);
        $cInfo = curl_getinfo($ch);
        curl_close($ch);
        return $output;
    }

}


if(!function_exists('array_to_excel')) { 
    function array_to_excel($data, $filename = ""){
    	if ($filename != ""){
            header("Content-Disposition: attachment; filename=\"$filename\"");
            header("Content-Type: application/vnd.ms-excel");
    	}		
    	
    	ob_start();
    	$flag = false;		
          foreach($data as $row) {
          
		   /*  if(!$flag) {
              // display field/column names as first row
              echo implode("\t", array_keys($row)) . "\n";
              $flag = true;
            } */
           // array_walk($row, __NAMESPACE__ . '\cleanData');
            echo implode("\t", array_values($row)) . "\n";
          }	
    }
}

    
    function convertNumber($number)
    {
            list($integer, $fraction) = explode(".", (string) $number);

            $output = "";

            if ($integer{0} == "-")
            {
                $output = "negative ";
                $integer    = ltrim($integer, "-");
            }
            else if ($integer{0} == "+")
            {
                $output = "positive ";
                $integer    = ltrim($integer, "+");
            }

            if ($integer{0} == "0")
            {
                $output .= "zero";
            }
            else
            {
                $integer = str_pad($integer, 36, "0", STR_PAD_LEFT);
                $group   = rtrim(chunk_split($integer, 3, " "), " ");
                $groups  = explode(" ", $group);

                $groups2 = array();
                foreach ($groups as $g)
                {
                    $groups2[] = convertThreeDigit($g{0}, $g{1}, $g{2});
                }

                for ($z = 0; $z < count($groups2); $z++)
                {
                    if ($groups2[$z] != "")
                    {
                        $output .= $groups2[$z] . convertGroup(11 - $z) . (
                                $z < 11
                                && !array_search('', array_slice($groups2, $z + 1, -1))
                                && $groups2[11] != ''
                                && $groups[11]{0} == '0'
                                    ? " and "
                                    : ", "
                            );
                    }
                }

                $output = rtrim($output, ", ");
            }

            if ($fraction > 0)
            {
                $output .= " point";
                for ($i = 0; $i < strlen($fraction); $i++)
                {
                    $output .= " " . convertDigit($fraction{$i});
                }
            }

            return $output;
        }

        function convertGroup($index)
        {
            switch ($index)
            {
                case 11:
                    return " decillion";
                case 10:
                    return " nonillion";
                case 9:
                    return " octillion";
                case 8:
                    return " septillion";
                case 7:
                    return " sextillion";
                case 6:
                    return " quintrillion";
                case 5:
                    return " quadrillion";
                case 4:
                    return " trillion";
                case 3:
                    return " billion";
                case 2:
                    return " million";
                case 1:
                    return " thousand";
                case 0:
                    return "";
            }
        }

        function convertThreeDigit($digit1, $digit2, $digit3)
        {
            $buffer = "";

            if ($digit1 == "0" && $digit2 == "0" && $digit3 == "0")
            {
                return "";
            }

            if ($digit1 != "0")
            {
                $buffer .= convertDigit($digit1) . " hundred";
                if ($digit2 != "0" || $digit3 != "0")
                {
                    $buffer .= " and ";
                }
            }

            if ($digit2 != "0")
            {
                $buffer .= convertTwoDigit($digit2, $digit3);
            }
            else if ($digit3 != "0")
            {
                $buffer .= convertDigit($digit3);
            }

            return $buffer;
        }

        function convertTwoDigit($digit1, $digit2)
        {
            if ($digit2 == "0")
            {
                switch ($digit1)
                {
                    case "1":
                        return "ten";
                    case "2":
                        return "twenty";
                    case "3":
                        return "thirty";
                    case "4":
                        return "forty";
                    case "5":
                        return "fifty";
                    case "6":
                        return "sixty";
                    case "7":
                        return "seventy";
                    case "8":
                        return "eighty";
                    case "9":
                        return "ninety";
                }
            } else if ($digit1 == "1")
            {
                switch ($digit2)
                {
                    case "1":
                        return "eleven";
                    case "2":
                        return "twelve";
                    case "3":
                        return "thirteen";
                    case "4":
                        return "fourteen";
                    case "5":
                        return "fifteen";
                    case "6":
                        return "sixteen";
                    case "7":
                        return "seventeen";
                    case "8":
                        return "eighteen";
                    case "9":
                        return "nineteen";
                }
            } else
            {
                $temp = convertDigit($digit2);
                switch ($digit1)
                {
                    case "2":
                        return "twenty $temp";
                    case "3":
                        return "thirty $temp";
                    case "4":
                        return "forty $temp";
                    case "5":
                        return "fifty $temp";
                    case "6":
                        return "sixty $temp";
                    case "7":
                        return "seventy $temp";
                    case "8":
                        return "eighty $temp";
                    case "9":
                        return "ninety $temp";
                }
            }
        }

        function convertDigit($digit)
        {
            switch ($digit)
            {
                case "0":
                    return "zero";
                case "1":
                    return "one";
                case "2":
                    return "two";
                case "3":
                    return "three";
                case "4":
                    return "four";
                case "5":
                    return "five";
                case "6":
                    return "six";
                case "7":
                    return "seven";
                case "8":
                    return "eight";
                case "9":
                    return "nine";
            }
        }


function get_datetime_by_defined_timezone($datetime,$timezone = NULL)
{
    if($timezone == '')
    {
        $timezone_dat = fieldByCondition("users",array('id'=>  currentuserinfo()->id),"timezone"); 
        if(!empty($timezone_dat)){$timezone = $timezone_dat->timezone;}else{$timezone   =   date_default_timezone_get();}
        $date = new DateTime($datetime, new DateTimeZone(date_default_timezone_get()));
    }else{
        $date = new DateTime($datetime, new DateTimeZone($timezone));
    }
    
    
    //$date->format('Y-m-d H:i:s') . "\n";
    $date->setTimezone(new DateTimeZone($timezone));
    return $date->format('Y-m-d H:i:s');

}

function convert_datetime_by_defined_timezone($datetime,$timezone_from,$timezone_to)
{
    $date = new DateTime($datetime, new DateTimeZone($timezone_from));
    //$date->format('Y-m-d H:i:s') . "\n";
    $date->setTimezone(new DateTimeZone($timezone_to));
    return $date->format('Y-m-d H:i:s');

}

function get_default_timezone_of_user()
{
    $timezone_dat = fieldByCondition("users",array('id'=>  currentuserinfo()->id),"timezone"); 
    if(!empty($timezone_dat))
    {
        $timezone = $timezone_dat->timezone;
    }else{
        $timezone   =   date_default_timezone_get();
    }
    return $timezone;
}

/**
 * Function for restore data
 */
if (!function_exists('restoreData')) {

    function restoreData($arr) {
        $CI = &get_instance();
        $table = $arr->table;
        $col1 = $arr->col1;
        if($arr->col2){ 
        $col2 = $arr->col2;         
        }
        $whr[$col2] = $arr->id;
        $upd[$col1] = $arr->value;        
        $CI->db->update($table, $upd, $whr);
//        echo $CI->db->last_query(); die;
        if ($CI->db->affected_rows()) {
            $res['status'] = 'success';
            $res['message'] = null;
        } else {
            $res['status'] = 'error';
            $res['message'] = $CI->db->_error_message();
        }
        return $res;
    }

}

/* End of Function */

/**
 * export_data
 *
 * This function give data on given condition 
 *
 * 	
 * @return array or boolean
 */
if (!function_exists('export_data')) {

    function export_data($conArr,$field) {			
        $CI = &get_instance();
        $CI->db->select($field, false);
        $CI->db->from($conArr['table']);
		if(!empty($conArr['column1'])){
        $CI->db->where_in($conArr['column1'], $conArr['ids']);
        }
		$CI->db->order_by($conArr['column1'],'desc');
        $query = $CI->db->get();		
        if ($query->num_rows()>0) {
            return $query->result();
        } else {
        return false;
		}
    }

}
/* End of Function */


	
//=============================================Export=================================================	
if(! function_exists('array_to_exl'))
{
    function array_to_exl($header,$excellists, $download = "")
    {
		$num=0;
		$data=NULL;
		if($excellists!=null)
		{
			foreach ($excellists as $row)
			{
				$num++;
				$line = $num."\t";
				foreach($row as $value)
				{
					if(!isset($value) || trim($value) == "")
					{
						$value = "\t";
					}
					else
					{
						$value = str_replace('"' , '""' , $value);
						$value = '"' . $value . '"' . "\t";
					}
					$line .= $value;
				}
				$data .= trim($line). "\n";
			}
			$data = str_replace("\r" , "" , $data);
			if(trim($data) == "")
			{
				$data = "\n(0)Records Found!\n";
			}
		}
		if ($download != "")
		{
			header('Content-Type: application/msexcel');
			header('Content-Disposition: attachement; filename="' . $download . '"');
			header("Pragma: no-cache");
			header("Expires: 0");
			print "$header\n$data";
		}
	}
//=============================================End Export=================================================	
	
}
    /* End of Function */


/*

 * function:: generate password 
 * author:: Arvind Soni    
 * This function generate random 6 digit number  
 */
if(! function_exists('generate_password')){
    function generate_password(){
        return random_string('numeric',6);
    }
}
/* End of Function */


/*

 * function:: generate password 
 * author:: Arvind Soni    
 * This function generate random 6 digit number  
 */
if(! function_exists('get_foodCategoryName')){
    function get_foodCategoryName($indx){
        $foodCAT    =   array('1'=>'Food Truck','2'=>'Track (The Rest Accounting Key)','3'=>'Home Made Food');
        return $foodCAT[$indx];        
    }
}
/* End of Function */


/*

 * function:: get_cat
   author:: Dharmendra Pal 
 * This function single row  */
function get_cat($table,$id = NULL)
{
	$CI =& get_instance();
	
	$CI->db->where('id',$id);
	$r    = $CI->db->get($table);
	
	return $r->row();
} 
/* End of Function */


/*
* function:: get image
author:: Dharmendra Pal 
* This function get image */
if(! function_exists('get_file')){
 function get_file($path=null,$filename=null){
    if(isset($path) && isset($filename)){
        $uploaded_path = base_url()."uploads/".$path;
        $filename =  $uploaded_path.'/'.$filename;

    } else {
        $filename = 'uploads/placeholder.png';
    }

     return $filename;
 }
}
/* End of Function */



/*
* function:: get image thumb
author:: Dharmendra Pal 
* This function get image */
if(! function_exists('get_image_thumb')){
    function get_image_thumb($filename=null,$type){

        /*type= _thumb, 40x40, 100x100, 200x200*/              
        if($type && $filename){
            $image_expl = explode('.',$filename);            
            $thumb_name = $image_expl[0]."_".$type.'.'.@$image_expl[1];
       
        } else {
            $thumb_name = '';
        }

        return $thumb_name;
    }
   }
   /* End of Function */

/*
* function:: get image thumb with ext a
author:: Dharmendra Pal 
* This function get image */
if(! function_exists('get_image_thumb_a')){
    function get_image_thumb_a($filename=null,$type){

        /*type= _thumb, 40x40, 100x100, 200x200*/              
        if($type && $filename){
            $image_expl = explode('.',$filename);            
            $thumb_name = $image_expl[0]."a_".$type.'.'.@$image_expl[1];
       
        } else {
            $thumb_name = '';
        }

        return $thumb_name;
    }
   }
   /* End of Function */

   
   function createUrlByTitleAndId($title,$id)
   {
       return RemoveSpecialChar($title)."-".ID_encode($id);
   }
   
/*
* function:: 
author:: Dharmendra Pal 
* This function get image */
if(! function_exists('RemoveSpecialChar')){
function RemoveSpecialChar($value){
    $result  = preg_replace('/[^a-zA-Z0-9_]/s','_',$value);
            
    return $result;
    }

}
/* End of Function */

if(! function_exists('getIdByUrl')){
    function getIdByUrl($url){
        $url_break = explode('-',$url);
        $Id         = ID_decode($url_break[1]);
        return $Id;
    }

}


/*
* function:: get_days
 * author:: Arvind Soni
 *  This function get days
*  */
if(! function_exists('get_days')){
 function get_days(){
    $days   =   array();
    $days['Monday']='Monday';
    $days['Tuesday']='Tuesday';
    $days['Wednesday']='Wednesday';
    $days['Thursday']='Thursday';
    $days['Friday']='Friday';
    $days['Saturday']='Saturday';
    $days['Sunday']='Sunday';
    return $days;
 }
}
/* End of Function */

/*
* function:: get_hours
 * author:: Arvind Soni
 *  This function get hours
*  */
if(! function_exists('get_hours')){
 function get_hours(){
    $hours   =   array();
    $hour = 0;
    while($hour < 24)
    {
        $hours[date('H:i:s',mktime($hour,0,0,1,1,2011))] = date('H:i',mktime($hour,0,0,1,1,2011));
        $hour++;       
    }          
    return $hours;
 }
}
/* End of Function */

/*
* function:: get_radious
 * author:: Arvind Soni
 *  This function get radious
*  */
if(! function_exists('get_radious')){
 function get_radious(){
    $radious   =   array();
    $r = 100;
    while($r < 2000)
    {
       $radious[$r]=$r.' M';
       $r=$r+100;
    }          
    return $radious;
 }
}
/* End of Function */
if(! function_exists('generate_otp')){
 function generate_otp(){
    $otp   =  rand(1000,9999);        
    return $otp;
 }
}

/*
 * function:: get_menu_sub_category
   author:: Dharmendra Pal 
 * This function single row  */
function get_menu_sub_category($menu_category_id,$menu_subcategory_id = null)
{
	$CI =& get_instance();
	$CI->db->where('parent',$menu_category_id);
	if(isset($menu_subcategory_id) && $menu_subcategory_id != '')
	{
		$CI->db->or_where('id',$menu_subcategory_id);
	}
	$r    = $CI->db->get('fs_menu_category');
	if($r->num_rows() > 0)
	{
		return $r->result();
	}else{
		return false;
	}
} 
/* End of Function */


function get_user_currency()
{
    return "Rs.";
}

function get_location_by_session($session_index,$type = ''){
    $CI =& get_instance();
    $locationSession =   $CI->session->userdata($session_index);
    if($type)
    {
        return $locationSession[$type];
    }else{
        $locationSession =   $CI->session->userdata($session_index);
        return $locationSession;
    }
}

function get_cart_stall_id()
{
    $CI =& get_instance();
	$stall_data_session	=	$CI->session->userdata('stall_data_session');
	return $stall_data_session['stall_id'];
}

function get_plan_data($vendor_id){
	$CI =& get_instance();
	$CI->db->select('fsud.pm_active_plan_id,fsud.pm_plan_start_date,fsud.pm_plan_expire_date,fsupp.*');
	$CI->db->join('fs_user_plan_payment as fsupp','fsupp.user_id=fsud.user_id');
	$CI->db->where('fsud.user_id',$vendor_id);
	$CI->db->where('fsupp.status','active');
	$result = $CI->db->get('fs_users_details as fsud');
	if($result->num_rows() > 0){
		$user_data	=	$result->result();
		$user_data	=	$user_data[0];
		$current_date 	=	date('Y-m-d');
		$data['pay_instant_or_later']		=	$user_data->pay_instant_or_later;
		$data['pay_online_or_bank_deposit']	=	$user_data->pay_online_or_bank_deposit;
		$data['plan_id']					=	$user_data->plan_id;
		$data['plan_payment_approve']		=	$user_data->is_approve;
		if($user_data->is_approve 	==	'1'){	/*plan is approved*/
		
			$data['is_active']	=	'yes';
			$data['plan_id']	=	$user_data->pm_active_plan_id;
			
			if($user_data->pm_active_plan_id == '1'){	/*pay annualy*/
				
				if($user_data->pay_instant_or_later	==	'1'){		/*pay instant*/
					if($user_data->pay_online_or_bank_deposit == '1'){	/*pay online*/
						if($current_date <= date('Y-m-d',strtotime($user_data->pm_plan_expire_date)))
						{
							$data['menu_limit']	=	'unlimit';
						}else{
							$data['is_active']	=	'no';
						}
					}else if($user_data->pay_online_or_bank_deposit == '2'){	/*Bank deposit*/
						if($current_date <= date('Y-m-d',strtotime($user_data->pm_plan_expire_date)))
						{
							$data['menu_limit']	=	'unlimit';
						}else{
							$data['is_active']	=	'no';
						}
					}
				}else if($user_data->pay_instant_or_later	==	'2'){		/*Pay later*/
					$data['menu_limit']	=	'5';
				}else if($user_data->pay_instant_or_later	==	'0'){		/*Pay later*/
					$data['menu_limit']	=	'5';
				}
			}else if($user_data->pm_active_plan_id == '2'){		/*pay per order*/
				$data['menu_limit']	=	'unlimit';
			}
			//pr($user_data);
		}else{
			$data['is_active']	=	'no';
			$data['menu_limit']	=	'5';
		}
		return $data;
	}else{
		return false;
	}
	
	
	 
}



function featured_stall_by_location_and_type($food_stall_type = null,$limit = null){
		$CI 			=	& get_instance();
		$current_date 	= 	date('Y-m-d');
		$stall_data		=	$CI->session->userdata('stall_data_session');
		$stall_id   	= 	$stall_data['stall_id'];
		$stall_location_session = $CI->session->userdata('stall_location_session');
		
		$CI->db->select('fsu.*,fsud.food_joint_name As title,fsud.about as description,fsud.logo_image as image,fsud.banner_image,fsud.food_joint_name,fsud.google_search_address');
		$CI->db->join('fs_users_details as fsud','fsu.id=fsud.user_id');
		$CI->db->where('fsu.plan_featured_id !=','0');
		$CI->db->where('fsu.plan_featured_end_date >',$current_date);
		if($stall_location_session['location'] != ''){
			$CI->db->where('fsud.google_search_address',$stall_location_session['location']);
		}
		if(isset($food_stall_type) && $food_stall_type != '')
		{
			$CI->db->where('fsu.food_stall_type',$food_stall_type);
		}
		$CI->db->order_by('fsu.avg_rating','desc');
		if(isset($limit) && $limit != '')
		{
			$CI->db->limit($limit);
		}
		$result = $CI->db->get('fs_users AS fsu');
		return $result->result();
	}
	
	/**
 * get user role group
 * fetch user role group asssign
 * */
if (!function_exists('get_role_group')) {

    function get_role_group() {
        $CI = &get_instance();
        $CI->db->select("id,role_name");
        $CI->db->where('status', 'active');
		$CI->db->where('id != ', '3');	/*this is seller role id so */
        $query = $CI->db->get('fs_roles');

        if ($query->num_rows()) {
            $res = $query->result();
            return $res;
        }
        return false;
		
    }

}





function cooking_institute_slider_by_institute_id($institute_id = null){
		$CI 			=	& get_instance();
		
		$institute_id   	= 	$institute_id;
		//$stall_location_session = $CI->session->userdata('stall_location_session');
		$CI->db->select("id");
        
		//$CI->db->where('id ', $institute_id);	/*this is seller role id so */
        $query = $CI->db->get('fs_cooking_institutes');
		$res[] = '';
        if ($query->num_rows()) {
            $res = $query->result();
			//pr($institute_id);
			//pr($res);die;
			if(!empty($res))
			{
				$prev_key = '';
				$next_key = '';
				foreach($res as $key => $val){
					
					$dat_key = $key;
					$dat_val = $val->id;
					if($val->id == $institute_id){
					
							//pr($dat_key);
							$next_key = $dat_key +1;
							$prev_key = $dat_key -1;
					
						
					}
						
				@$res['prev_val'] = $res[$prev_key]->id;
				@$res['next_val'] = $res[$next_key]->id;
					}
					
				
					//$next_key = 
					
					
					
				
				
				
			}
			//pr($res);die;
            return $res;
        }
        return false;
	}




/**
 * has user permission
 * this function is used to check user permission
 * */
function has_permission($controller, $action) {
	if(currentuserinfo()->role_id == '1'){
		return true;
	}
    $CI = &get_instance();
    $submoduel_id = 0;
    $dataqry = $CI->db->select('id')->from("fs_modules")->where(array("module_value" => $controller, "parent_id !=" => 0, "status" => 'active'))->get()->row();
	if ($dataqry) {
        $submoduel_id = @$dataqry->id;
    }
    if ($submoduel_id > 0) {
        $get_perm_qry = $CI->db->select('method_id')->get_where('fs_roles_modules_mapping', array('role_id' => currentuserinfo()->role_id, 'submoduel_id' => $submoduel_id));
	   if ($get_perm_qry->num_rows()) {
            $all_method = isset($get_perm_qry->row()->method_id) ? explode(',', $get_perm_qry->row()->method_id) : array();
            $CI->db->where_in('id', $all_method);
            $get_mth_qry = $CI->db->select('method_value')->get_where('fs_method', array('status' => 'active'));
            if ($get_mth_qry->num_rows()) {
                $prm_method = array();
                $i = 0;
                foreach ($get_mth_qry->result() as $val) {
                    $prm_method[$i] = $val->method_value;
                    $i++;
                }
                if (in_array($action, $prm_method)) {
                    return true;
                } else {
                    return false;
                }
            } else {
                return false;
            }
        } else {
            return false;
        }
    } else {
        return false;
    }
}

function social_media(){
	 $CI = &get_instance();
	    $CI->db->select('id,social_media_name,link');
		$CI->db->from('fs_social_media');
		$query = $CI->db->get();
		if($query->num_rows() > 0){
			return $query->result();
		}else{
			return false;
		}
	}
/* End of Function */
        
        
/**
 * unique_email
 *
 * This function to check  unique user email
 * @param string
 *  	
 */
if (!function_exists('unique_email')) {
    function unique_email($email='',$id=''){
     
        $CI = &get_instance();
        $CI->db->select('id');
        $CI->db->where('email',$email);
     
        if($id!=''){
        $CI->db->where("id != ", "$id");
        }
        $query  =   $CI->db->get("fs_newbee");
       
        if ($query->num_rows()){
           
            return 200;
        }
        else{
           
           return 404;
        }
        
       return 404;
       
    }
}
/*End of function*/

/**
 * unique_mobile
 *
 * This function to check  unique mobile
 * @param string
 *  	
 */
if (!function_exists('unique_mobile')) {
    function unique_mobile($mobile='',$id=''){
     
        $CI = &get_instance();
        $CI->db->select('id');
        $CI->db->where('mobile',$mobile);
     
        if($id!=''){
        $CI->db->where("id != ", "$id");
        }
        $query  =   $CI->db->get("fs_newbee");
       
        if ($query->num_rows()){
           
            return 200;
        }
        else{
           
           return 404;
        }
        
       return 404;
       
    }
}
/*End of function*/

/**
 * get_adminInfo
 *
 * This function to fetch admin Info
 * @param string
 *  	
 */
if (!function_exists('get_adminInfo')) {
    function get_adminInfo(){
        $CI = &get_instance();
        $CI->db->select("id,concat(first_name,' ',last_name) as user_name,first_name,last_name,email,mobile_number,profile_image");
        $CI->db->where('user_type','1');
        $query  =   $CI->db->get("fs_users");
        if($query->num_rows()){
           $rs_data['result']   =   $query->row();
           $rs_data['status']   =   "success"; 
        }else{
           $rs_data['result']   =   '';
           $rs_data['status']   =   "error"; 
        }
        return $rs_data;
    } 
}
/*End of function*/

/**
 * _sendEmailNew
 *
 * This function send mail to the given email id 
 * @param string
 * 	
 */
if (!function_exists('_sendEmailNew')) {

    function _sendEmailNew($email_data) {
        $CI = &get_instance();
        $CI->load->library('email');
        $CI->email->set_mailtype("html");
        $CI->email->from($email_data['from'], ucwords($email_data['sender_name']));
        $CI->email->to($email_data['to']);
        if (!empty($email_data['cc'])) {
            $CI->email->cc($email_data['cc']);
        }
        if (!empty($email_data['bcc'])) {
            $CI->email->bcc($email_data['bcc']);
        }
        if (!empty($email_data['file'])) {
            $CI->email->attach($email_data['file']);
        }
        $CI->email->subject(ucfirst($email_data['subject']));
        $data['message'] = $email_data['message'];
        $msg = $CI->load->view('email_templates/send_mail', $data, true);
        $data['message'] = $email_data['message'];
        $msg = $CI->load->view('email_templates/send_mail', $data, true);
        $CI->email->message($msg);
        if ($CI->email->send()) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
	
}
	
	/**
 * get_salesperson and sales manager name
 *
 * This function to fetch get_salesperson and sales manager name
 * @param string
 *  	
 */
if (!function_exists('get_sales_person_name')) {
    function get_sales_person_name($id){
        $CI = &get_instance();
        $CI->db->select("ku.id,concat(ku.first_name,' ',ku.last_name) as sales_person_name,ku.assigned_manager,concat(ku2.first_name,'',ku2.last_name)as sales_manager_name",false);
		  $CI->db->from('kyi_users as ku');
		 $CI->db->join('kyi_users as ku2','ku.assigned_manager = ku2.id');
        $CI->db->where('ku.id',$id);
        $query  =   $CI->db->get();
        if($query->num_rows()){
           $rs_data['result']   =   $query->row();
           $rs_data['status']   =   "success"; 
        }else{
           $rs_data['result']   =   '';
           $rs_data['status']   =   "error"; 
        }
        return $rs_data;
    } 
}
/*End of function*/
	
	

	
	
	
function approve_by_user_type($approve_by){
	$CI = &get_instance();
	$CI->db->select('user_type');
	$CI->db->where('id',$approve_by);
	$result = $CI->db->get('kyi_users')->row();
	//pr($result->user_type);
	return $result->user_type;
	
}

// generate invoice

if (!function_exists('generate_kyi_invoice_pdf')) 
	{
		function generate_kyi_invoice_pdf($dat)
		{
				//	pr($dat); die;
					//pr($dat['pdf_data']->campaign_id);die;
					$data['result_pdf'] = $dat;
					//ob_start(); 
					error_reporting(E_ALL);
				$CI = &get_instance();
				require('./assets/TCPDF-master/tcpdf.php');	
				// create new PDF document
				$pdf = new tcpdf(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);		
				// set document information
				$pdf->SetCreator(PDF_CREATOR);
				// set default header data
				// $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH,PDF_HEADER_TITLE, null, array(0,64,255), array(0,64,128));
				// $pdf->setFooterData(array(0,64,0), array(0,64,128));

				// set header and footer fonts
				// $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
				// $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
			
				// set default monospaced font
				$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

				// set margins
				$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
				$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
				$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

				// set auto page breaks
				$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

				// set image scale factor
				$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
				
				// set some language-dependent strings (optional)
				if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
					require_once(dirname(__FILE__).'/lang/eng.php');
				$pdf->setLanguageArray($l);
				}
			
				// ---------------------------------------------------------



				// set default font subsetting mode
				$pdf->setFontSubsetting(true);

				// Set font
				// dejavusans is a UTF-8 Unicode font, if you only need to
				// print standard ASCII chars, you can use core fonts like
				// helvetica or times to reduce file size.
				$pdf->SetFont('dejavusans', '', 14, '', true);

				// Add a page
				// This method has several options, check the source code documentation for more information.
				$pdf->AddPage();

				// set text shadow effect
				$pdf->setTextShadow(array('enabled'=>true, 'depth_w'=>0, 'depth_h'=>0, 'color'=>array(196,196,196), 'opacity'=>1, 'blend_mode'=>'Normal'));	
				// Print text using writeHTMLCell()
				//$html = $CI->load->view('pdfs',true);
				 
					$html = $CI->load->view('invoice_data/pdfs', true);
				 
				//pr($html);die;
				// ---------------------------------------------------------		
				// Close and output PDF document
				// This method has several options, check the source code documentation for more information.
				 
				  // Print text using writeHTMLCell()
				
					$pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);
                    $random = rand(999,10000);
				// ---------------------------------------------------------
					$filename= "invoice_number_{$random}.pdf";
					// update created invoice name in database also
					    // $payment_id = $dat['pdf_data']->id;
						// $up['invoice_name'] = $filename;
						// $CI->db->where('id',$payment_id);
						// $query = $CI->db->update('am_billing',$up);
					//pr($filename);die;
					if (!is_dir('uploads/invoice_slips')) {
						mkdir('./uploads/invoice_slips' , 0777, TRUE);

						}
						$uploaded_path = "./uploads/invoice_slips";
						$filelocation = $uploaded_path;
					   //pr($filelocation);  die; 

					$fileNL = $filelocation."/".$filename;
					 //pr($fileNL);die;   
					 ob_end_clean();
					 $pdf_string = $pdf->Output($fileNL, 'F');
				 
		 	
		}
		 	
	}


	
	// get currency in words also
	
	function getIndianCurrency(float $number)
{
    $decimal = round($number - ($no = floor($number)), 2) * 100;
    $hundred = null;
    $digits_length = strlen($no);
    $i = 0;
    $str = array();
    $words = array(0 => '', 1 => 'one', 2 => 'two',
        3 => 'three', 4 => 'four', 5 => 'five', 6 => 'six',
        7 => 'seven', 8 => 'eight', 9 => 'nine',
        10 => 'ten', 11 => 'eleven', 12 => 'twelve',
        13 => 'thirteen', 14 => 'fourteen', 15 => 'fifteen',
        16 => 'sixteen', 17 => 'seventeen', 18 => 'eighteen',
        19 => 'nineteen', 20 => 'twenty', 30 => 'thirty',
        40 => 'forty', 50 => 'fifty', 60 => 'sixty',
        70 => 'seventy', 80 => 'eighty', 90 => 'ninety');
    $digits = array('', 'hundred','thousand','lakh', 'crore');
    while( $i < $digits_length ) {
        $divider = ($i == 2) ? 10 : 100;
        $number = floor($no % $divider);
        $no = floor($no / $divider);
        $i += $divider == 10 ? 1 : 2;
        if ($number) {
            $plural = (($counter = count($str)) && $number > 9) ? 's' : null;
            $hundred = ($counter == 1 && $str[0]) ? ' and ' : null;
            $str [] = ($number < 21) ? $words[$number].' '. $digits[$counter]. $plural.' '.$hundred:$words[floor($number / 10) * 10].' '.$words[$number % 10]. ' '.$digits[$counter].$plural.' '.$hundred;
        } else $str[] = null;
    }
    $Rupees = implode('', array_reverse($str));
    $paise = ($decimal) ? "." . ($words[$decimal / 10] . " " . $words[$decimal % 10]) . ' Paise' : '';
    return ($Rupees ? $Rupees . 'Rupees ' : '') . $paise .'Only';
}

if(!function_exists('custompaging'))
{
    function custompaging($cur_page,$no_of_paginations,$previous_btn,$next_btn,$first_btn,$last_btn)
    {
        $msg='';
        if ($cur_page >= 7)
        {
            $start_loop = $cur_page - 3;
            if ($no_of_paginations > $cur_page + 3)
            {
                $end_loop = $cur_page + 3;
            }
            else if ($cur_page <= $no_of_paginations && $cur_page > $no_of_paginations - 6)
            {
                $start_loop = $no_of_paginations - 6;
                $end_loop = $no_of_paginations;
            } 
            else
            {
                $end_loop = $no_of_paginations;
            }
        } 
        else 
        {
            $start_loop = 1;
            if ($no_of_paginations > 7)
                $end_loop = 7;
            else
                $end_loop = $no_of_paginations;
        }
        //===========view parts===========//
        $msg .= "<div class='text-right'style='margin-right:15px;'><div class='dataTables_paginate paging_simple_numbers'>
                    <ul class='pagination pagination_right'>";
                    // FOR ENABLING THE FIRST BUTTON
                    if ($first_btn && $cur_page > 1)
                    {
                        $msg .= "<li p='1' class='paginate_button previous '>First</li>";
                    }
                    else if ($first_btn)
                    {
                        $msg .= "<li p='1' class='paginate_button previous disabled '>First</li>";
                    }
                    // FOR ENABLING THE PREVIOUS BUTTON
                    if ($previous_btn && $cur_page > 1)
                    {
                        $pre = $cur_page - 1;
                        $msg .= "<li p='$pre' class='paginate_button previous '><a href='#'><i class='material-icons'>Previous</i></a></li>";
                    }
                    else if ($previous_btn)
                    {
                        $msg .= "<li class='paginate_button  disabled'><a href='#'><i class='material-icons'>Previous</i></a></li>";
                    }
                    for ($i = $start_loop; $i <= $end_loop; $i++)
                    {
                        if ($cur_page == $i)
                            $msg .= "<li p='$i'  class='paginate_button page_active  active current'><a>{$i}</a></li>";
                        else
                            $msg .= "<li p='$i' class=' paginate_button page_active active'><a>{$i}</a></li>";
                    }

                    // TO ENABLE THE NEXT BUTTON
                    if ($next_btn && $cur_page < $no_of_paginations)
                    {
                        $nex = $cur_page + 1;
                        $msg .= "<li p='$nex' class='paginate_button  next '><a href='#'><i class='material-icons'>Next</i></a></li>";
                    }
                    else if ($next_btn)
                    {
                        $msg .= "<li class='paginate_button disabled '><a href='#'><i class='material-icons'>Next</i></a></li>";
                    }

                    // TO ENABLE THE END BUTTON
                    if ($last_btn && $cur_page < $no_of_paginations)
                    {
                        $msg .= "<li p='$no_of_paginations' class='active'>Last</li>";
                    } 
                    else if ($last_btn)
                    {
                        $msg .= "<li p='$no_of_paginations' class='inactive'>Last</li>";
                    }
                    $total_string = "<span class='totalfront pull-left pagination_left' a='$no_of_paginations'>Page <b>" . $cur_page . "</b> of <b>$no_of_paginations</b></span>";
                    $msg = $msg . "</ul>" . $total_string . "</div>";  // Content for pagination
return $msg;
         
    }
}

	
//THIS FUNCTION GET service AND SUBservice DATA
function getdata($attributes) {          
    $CI = &get_instance();
    $CI->db->select('*');
    $CI->db->from($attributes['table']);
    
    if(!empty($attributes['id'])){
    $CI->db->where($attributes['id'], $attributes['column1']);
    }
    
    if(!empty($attributes['name'])){
    $CI->db->where($attributes['name'], $attributes['column2']);
    }
    
    if(!empty($attributes['status'])){
    $CI->db->where($attributes['status'], $attributes['column3']);
    }  
    if(!empty($attributes['column4'])){
        $CI->db->order_by($attributes['column4'],'ASC');
        }  
 //   $CI->db->limit(50);
    $query = $CI->db->get();
    //echo $CI->db->last_query(); die;
    if ($query->num_rows()) {
        return $query->result();
    }
    return false;
}

    /* End of function */
?>

