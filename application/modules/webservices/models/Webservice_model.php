<?php

class Webservice_model extends CI_Model {

    /*constructor*/
    function __construct() {
        parent::__construct();
    }
    
    public function login(){
        $email = $this->security->xss_clean($this->input->post('email',true));
        $password = $this->security->xss_clean($this->input->post('password',true));
       
        /*using email finding password*/
        $this->db->select('*');
        $this->db->from('kyi_users');
        $this->db->where('email',$email);
       
        $query = $this->db->get();
        if($query->num_rows() > 0){
        
            $user_data = $query->row();

            /*check status is active or not*/
            if($user_data->status != 'active' ){
                $res['status'] = 'error';
                $res['error_msg'] = 'Please contact to Admin May be your account is deleted or Inactivated !';
            }else{

                    $password = md5($password);
                    if($user_data->password == $password){
                                            $user_info =  $user_data;
                                            unset( $user_info->password);

                                            
                                                /*if user type 3 || 4 then login*/
                                                if($user_info->user_type == '3' || $user_info->user_type == '4'){

                                                    /*Update last login*/
                                                    $up['last_login'] = date("Y-m-d h:i:s");
                                                    $this->db->where('id', $user_info->id);
                                                    $this->db->update('kyi_users', $up); 

                                                    $res['status'] = 'success';
                                                    $res['result'] = $user_info;
                                                }else{
                                                    $res['status'] = 'error';
                                                    $res['error_msg'] = 'Invalid login credentials !';
                                                }
                                            
                    }else{
                        $res['status'] = 'error';
                        $res['error_msg'] = 'Password does not match !';
                    }


                 }




        }else{
            $res['status'] = 'error';
            $res['error_msg'] = 'Email Id does not exists !';
        }
        return $res;
        
    }

    public function forgot_password(){
        $email = $this->input->post('email', true);

        /*using email finding user data*/
        $this->db->select('*');
        $this->db->from('kyi_users');
        $this->db->where('email', $email);
        $query = $this->db->get();

        if($query->num_rows() > 0){
            $user_data = $query->row();

            /*creating new password*/
            $mail_password = rand(100000, 999999);
           // pr($mail_password);die;
            $new_password = md5($mail_password);

            /*if status is active then update password*/
            if($user_data->status !='active'){
                $res['status'] = 'error';
                $res['error_msg'] = 'Please contact to Admin May be your account is deleted or Inactvated !';
            } else{
                if($user_data->user_type == '3' || $user_data->user_type == '4'){
                    $upd['password'] = $new_password;				
                    $this->db->where('id', $user_data->id);
                    $this->db->update('kyi_users', $upd);	

                    $res['status'] = 'success';
                    $res['new_password'] = $mail_password;
                    $res['result'] = $user_data;

                }else{
                    $res['status'] = 'error';
                    $res['error_msg'] = 'You seems like a admin, Account team and Backend user !';
                }
            }
        }else{
            $res['status'] = 'error';
            $res['error_msg'] = 'You are not registered yet, Retry or register as a new member';

        }
        return $res;
    }


    public function fetch_myprofile_data(){
        $id = $this->input->post('id', true);
        
        $this->db->select('*');
        $this->db->from('kyi_users');
        $this->db->where('id', $id);
        $query = $this->db->get();
        if($query->num_rows() > 0){
            $res['status'] = 'success';
            $res['result'] = $query->row();
        }else{
            $res['status'] = 'error';
            $res['error_msg'] = 'Data not found !';
        }
        return $res;
    }

    public function update_myprofile_data(){
        $id = $this->input->post('id', true);
        
        $this->db->select('*');
        $this->db->from('kyi_users');
        $this->db->where('id', $id);
        $query = $this->db->get();
        if($query->num_rows() > 0){

            //finding first name
            $first_name = $_POST['name'];
            
            $upd['first_name'] = $first_name;
           // $upd['last_name'] = $last_name;
            $upd['mobile_number'] = $this->input->post('mobile_number', true);
            
            $this->db->where('id', $id);
            $this->db->update('kyi_users', $upd);
            
            $this->db->select('*');
            $this->db->from('kyi_users');
            $this->db->where('id', $id);
            $fetched_data_up = $this->db->get();
                $res['status'] = 'success';
                $res['success_msg'] = 'Profile Updated Successfully !';
                $res['result'] = $fetched_data_up->row();
        }else{
            $res['status'] = 'error';
            $res['error_msg'] = 'Profile not updated !';
        }
        return $res;
    }

    public function change_password(){
        $id = $this->input->post('id', true);
        $current_password = md5($this->input->post('current_password', true));
        $new_password = md5($this->input->post('new_password', true));

        /*using id and current password find password*/
        $this->db->select('*');
        $this->db->from('kyi_users');
        $this->db->where('id', $id);
        $query = $this->db->get();

        if($query->num_rows() > 0){
            $user_data = $query->row();
            /*update the password*/
            if($user_data->password == $current_password){
               
                $upd['password'] = $new_password;
                $this->db->where('id', $user_data->id);
                $update = $this->db->update('kyi_users', $upd);
                if($update){
                    $res['result'] = $user_data;
                    $res['status'] = 'success';
                    $res['success_msg'] = 'Password updated Successfully';
                }else{
                    $res['status'] = 'error';
                    $res['error_msg'] = 'password not updated !';
                }
            }else{
                $res['status'] = 'error';
                $res['error_msg'] = 'Current password does not matched !';
            } 
        }else{
            $res['status'] = 'error';
            $res['error_msg'] = 'password not updated !';
        }
        return $res;
    }


    public function list_clients(){
        $user_id = $this->input->post('user_id', true);
        
        $this->db->select('*');
        $this->db->from('kyi_client');
        $this->db->where('added_by', $user_id);
        $query = $this->db->get();
        if($query->num_rows() > 0){
            $res['status'] = 'success';
            $res['success_msg'] = 'Data found successfully !';
            $res['result'] = $query->result();
        }else{
            $res['status'] = 'error';
            $res['error_msg'] = 'Data not found !';
        }
        return $res;
    }

    public function add_client(){
        if($_POST){
            $add['name']                = $_POST['name'];
            $add['branch']              = $_POST['branch'];
            $add['address']             = $_POST['address'];
            $add['contact_person_name'] = $_POST['contact_person_name'];
            $add['email']               = $_POST['email'];
            $add['mobile']              = $_POST['mobile'];
            $add['payment_type']        = $_POST['payment_type'];

            $price_unit = $_POST['price_unit'];
            $price = $_POST['price'];
            if($price_unit=='2'){
                $price = "0.$price";
            }
            if(isset($_POST['payment_type']) && $_POST['payment_type'] == '1' || $_POST['payment_type'] == '2'){
                $add['price_unit']      = $price_unit;
                $add['price']           = $price;
            }
            if(isset($_POST['payment_type']) && $_POST['payment_type'] == '2'){
                $add['credit_limit']      = $_POST['credit_limit'];
                $add['credit_limit']      = $_POST['credit_limit'];
            }
            if(isset($_POST['payment_type']) && $_POST['payment_type'] == '1'){
                $add['is_approve']      = '1'; // by default it is approved coz it is prepaid type client
                
            }
            $add['added_by']            = $_POST['user_id'];
            $add['created_date']        = date('Y-m-d H:i:s');
            //pr( $add);die;
            $this->db->insert('kyi_client',$add);
            $res['status'] = 'success';
            $res['success_msg'] = 'Client added successfully !';
        }else{
            $res['status'] = 'error';
            $res['error_msg'] = 'Client not added !';
        }
        return $res;
    }

    public function add_image($data){
        if($_POST){
            $_FILES = $data['upload_data'];
            $add['file_name']    = $_FILES['file_name'];
            $add['file_type']     = $_FILES['file_type'];
            $add['file_size']         = $_FILES['file_size'];
            $add['image_type']         = $_FILES['image_type'];
            $add['image_size_str']       = $_FILES['image_size_str'];
            $add['url']     = base_url('uploads/'.$_FILES['file_name']);
    
            $this->db->insert('upload_image',$add);
            $res['status'] = 'success';
            $res['success_msg'] = $add['url'];

        }else{
            $res['status'] = 'error';
            $res['error_msg'] = 'Image not added !';
        }
        return $res;
    }

    public function add_campaigns(){
        if($_POST){
            $client_id                             = $_POST['client_id'];
            $add['client_id']                     = $_POST['client_id'];
            $add['added_by']                     = $_POST['user_id'];
            $add['sms_count']                    = $_POST['sms_count'];
            $add['location']                     = $_POST['location'];
            $add['content']                      = $_POST['content'];
            $add['number_edit_to_data_file']     = $_POST['number_edit_to_data_file'];
            $add['execution_date']               = $_POST['execution_date'];
            $add['execution_time']               = $_POST['execution_time'];
			$add['user_name']                    = $_POST['user_name'];
            $add['vmn']                          = $_POST['vmn'];
            $add['password']                     = $_POST['password_cmp'];
            $add['created_date']                 = date('Y-m-d H:i:s');
            $add['updated_date']                 = date('Y-m-d H:i:s');
           // $up['post_date'] = date('Y-m-d');
           // $up['post_time'] = date('H:i:s');
             // get sms cost from client table according client_id
			if( $_POST['sms_count']==0 || $_POST['sms_count']=='0'){
				 $res['status'] = 'error';
                $res['error_msg'] = 'SMS Count can not be 0 ';
				return $res;
				die;
												
			}	
             $this->db->Select("price_unit,price,credit_limit,total_balance,used_balance,payment_type");
             $this->db->where('id',$client_id);
             $this->db->where('is_approve','1');
             $query = $this->db->get('kyi_client');
             if($query->num_rows() > 0){
                 $result    = $query->row();
               // pr( $result);die;
                     // cost per sms
					 $payment_type = $result->payment_type;
                     $used_balance = $result->used_balance;
                     $cost_per_sms = $result->price;
                     $credit_limit = $result->credit_limit;
                     $total_balance = $result->total_balance;
                     $sms_count = $_POST['sms_count'].'.00';
                     // get total cost
                    // pr($cost_per_sms);
                     //pr($sms_count);
                      // pr($total_balance);
						$total_cost = $cost_per_sms * $sms_count;
                        $total_cost_or_used_balance =  $cost_per_sms * $sms_count;
                    
                    
                    // pr($total_cost_or_used_balance);die;
                 
             }
              
             // update  total balance and used balance  in client table also

                // calculate the used cost and added after each campaign add
                if(!empty($total_balance) && !empty($used_balance) && $total_balance>=$used_balance)
                {
                 $total_cost_or_used_balance =  $used_balance  +  $total_cost_or_used_balance;
              
                }
                else{
                    $total_cost_or_used_balance  = $used_balance ;
                }
                //pr($total_cost_or_used_balance);
                if($total_cost_or_used_balance <= $total_balance)
                {
                    $up1['used_balance'] = $total_cost_or_used_balance;
                    $this->db->where('id', $client_id);
                    $update = $this->db->update('kyi_client', $up1);
					
					
                }
                else{

                    $rest_amount = $total_balance - $used_balance;
                }
                
                //pr($rest_amount);

             // insert in campaign table
             $add['cost_per_sms']                      =  $cost_per_sms;
             $add['total_cost']                      = $total_cost_or_used_balance;
             //pr($add);die;

             if($total_cost_or_used_balance<=$total_balance)
             {

					$this->db->insert('kyi_campaign',$add);
						
						// check client data int the ledger balance table
							
							$this->db->select('kbl.*');
							 $this->db->from('kyi_ledger_balance as kbl');
							$this->db->where('kbl.client_id',$client_id);
							$this->db->order_by('kbl.id','desc');
							$this->db->limit(1);
							$query = $this->db->get();
							//echo $this->db->last_query();die;
							if($query->num_rows() > 0)
							{
								$last_record = $query->row();
								// get last balance
								
								$last_record_balance = $last_record->balance;
								// Subtract amount in the last get balance
								$total_balance_after_amount_subtract_in_last_balance = $last_record_balance - $total_cost;
								//pr($total_balance_after_amount_subtract_in_last_balance);die;
										// insert data in the ledger table 
								$ins_data['added_by'] = $_POST['user_id'];
								$ins_data['client_id'] = $_POST['client_id'];
								$ins_data['date'] = date('Y-m-d H:i:s');
								$ins_data['description'] = 'Debit the amount to create campaign';
								$ins_data['dr'] = $total_cost;
								if($total_balance>=0){
									$ins_data['balance'] =  $total_balance_after_amount_subtract_in_last_balance;
								}else{
									$ins_data['balance'] =  '0' ;
								}
								$ins_data['type'] 			=  '2';
								$ins_data['created_date']                 = date('Y-m-d H:i:s');
								$ins_data['updated_date']                 = date('Y-m-d H:i:s');
								 $this->db->insert('kyi_ledger_balance',$ins_data);
								
							}else{
									// insert data in the ledger table 
								$ins_data['added_by'] = $_POST['user_id'];
								$ins_data['client_id'] = $_POST['client_id'];
								$ins_data['date'] = date('Y-m-d H:i:s');
								$ins_data['description'] = 'Debit the amount to create campaign';
								$ins_data['dr'] = $total_cost;
								if($total_balance>=0){
									$ins_data['balance'] =  $total_balance - $total_cost_or_used_balance;
								}else{
									$ins_data['balance'] =  '0' ;
								}
								$ins_data['type'] 			=  '2';
								$ins_data['created_date']                 = date('Y-m-d H:i:s');
								$ins_data['updated_date']                 = date('Y-m-d H:i:s');
								 $this->db->insert('kyi_ledger_balance',$ins_data);
								 
							}
							
						
						
					
						
						
                                    
                                                $res['status'] = 'success';
                                                $res['success_msg'] = 'Campaign added successfully !';
                    }else{
                                                $res['status'] = 'error';
                                                $res['error_msg'] = 'Campaign not added!. You have '. @$rest_amount .' Amount in you account ';
												$res['error_msg'] = "Your Campaign's total amount will be Rs. $total_cost. And you have Rs. $rest_amount in you account. So you can't create Campaign";
                                                $res['rest_amount'] = @$rest_amount;
                    }
            
        }    

                    return $res;
      
    }

    public function check_creditlimit_approve(){
        $client_id = $this->input->post('client_id');
       
        $this->db->select('*');
        $this->db->where('id',$client_id);
        $this->db->where('payment_type','2');
        $query = $this->db->get('kyi_client');
        if($query->num_rows() > 0){
            $result    = $query->row();
            //pr( $result);die;
            if($result->is_approve == '1'){
                
                $res['status']      = 'success';
                $res['success_msg'] = 'Credit limit is approved';
                $res['result']      =  $result;
            }else{
                $res['status']    = 'error';
                $res['error_msg'] = 'Awaited for credit limit approval from Admin/Sales Manager';
            }
        }else{

            // for prepaid users,check  total_balace 
            $this->db->select('*');
            $this->db->where('id',$client_id);
            $this->db->where('payment_type','1');
            $query = $this->db->get('kyi_client');
            if($query->num_rows() > 0){
                $result    = $query->row();
                if($result->total_balance=='0' ){
                    
                    $res['status']      = 'error';
                    $res['error_msg'] = "You don't have enough balance,Add payment first";
                    $res['result']      =  $result;
                }
                else{
                    $res['status']      = 'success';
                    $res['result']      =  $result;
                    $res['success_msg'] = 'Prepaid User is eligible';
                }
            }

           // $res['status'] = 'error';
           // $res['error_msg'] = 'Payment type is prepaid !';
        }
        return $res;  
    }
	
	// add payment,check credit limit is approved or not(postpaid case only)
	
	 public function when_add_payment_check_creditlimit__is_approve(){
        $client_id = $this->input->post('client_id');
      // pr( $client_id);die;
        $this->db->select('*');
        $this->db->where('id',$client_id);
        $this->db->where('payment_type','2');
        $query = $this->db->get('kyi_client');
        if($query->num_rows() > 0){
            $result    = $query->row();
            //pr( $result);die;
            if($result->is_approve == '1'){
                
                $res['status']      = 'success';
                $res['success_msg'] = 'Credit limit is approved';
                $res['result']      =  $result;
            }else{
                $res['status']    = 'error';
                $res['error_msg'] = 'Awaited for credit limit approval from Admin/Sales Manager';
            }
			 
        }else{
			$res['status']    = 'prepaid';
			$res['error_msg'] = 'It is prepaid user';
		}
		return $res;
         
    }

    public function add_payment(){
        if($_POST){
            $add['client_id']          = $_POST['client_id'];
            $add['added_by']           = $_POST['user_id'];
            $add['amount']             = $_POST['amount'];
            $add['payment_ref_number'] = $_POST['payment_ref_number'];
            $add['payment_mod']        = $_POST['payment_mod'];
            $add['transaction_id']     = $_POST['transaction_id'];
            $add['remark']             = $_POST['remark'];
            $add['created_date']       = date('Y-m-d H:i:s');
			
            $this->db->insert('kyi_payment',$add);
			/*Update total balance*/
				$client = $_POST['client_id'];
				$this->db->Select('id,total_balance,payment_type,is_approve');
				$this->db->where('id',$client);
				$query = $this->db->get('kyi_client');
				if($query->num_rows() > 0){
					$result    = $query->row();
					$total_balance = $result->total_balance;
					$payment_type = $result->payment_type;
					$approve_credit_limit = $result->is_approve;
				}
				
				
				
				

				// adding amount in client table 
				$total_balanc_after_amount = $total_balance + $_POST['amount'];
				$up1['total_balance'] =  $total_balance + $_POST['amount'];

				// update total balance  in client table also
				$this->db->where('id', $client);
				$update1 =  $this->db->update('kyi_client', $up1);
				
				// insert data in the ledger table 
				// check client data int the ledger balance table
				
				$this->db->select('kbl.*');
				 $this->db->from('kyi_ledger_balance as kbl');
				 $this->db->where('kbl.client_id',$client);
				$this->db->order_by('kbl.id','desc');
				$this->db->limit(1);
				$query = $this->db->get();
				//echo $this->db->last_query();die;
				if($query->num_rows() > 0)
				{
					$last_record = $query->row();
					// get last balance, last credit limit 
					$last_record_amount = $last_record->cr;
					$last_record_balance = $last_record->balance;
					// add amount in the last get balance
					$total_balance_after_amount_add_in_last_balance = $last_record_balance + $_POST['amount'];
					// add amount into  last cr 
					$total_cr_after_amount_add_in_last_balance = $last_record_amount + $_POST['amount'];
					
					
					
					
					
					$payment_mod = $_POST['payment_mod'];
					
							if($payment_mod=='1'){
								$payment_mods = 'PAYTM';
							}
							else if($payment_mod=='2'){
								$payment_mods = 'NEFT';
							}
							else if($payment_mod=='3'){
								$payment_mods = 'CHEQUE';
							}
							else if($payment_mod=='4'){
								$payment_mods = 'CASH';
							}
							else{
								$payment_mods ='';
							}
						
							$ins_data['added_by'] = $_POST['user_id']; 
							$ins_data['client_id'] = $_POST['client_id'];
							$ins_data['date'] = date('Y-m-d H:i:s');
							$ins_data['description'] = "Payment added in the system. Payment add mod $payment_mods";
							$ins_data['cr']     =  $_POST['amount'];
							$ins_data['balance'] = $total_balance_after_amount_add_in_last_balance;
							$ins_data['type'] =  '4';
							$ins_data['created_date']                 = date('Y-m-d H:i:s');
							$ins_data['updated_date']                 = date('Y-m-d H:i:s');
							 $this->db->insert('kyi_ledger_balance',$ins_data);
					
					
					
				}else{
							$payment_mod = $_POST['payment_mod'];
							if($payment_mod=='1'){
								$payment_mods = 'PAYTM';
							}
							else if($payment_mod=='2'){
								$payment_mods = 'NEFT';
							}
							else if($payment_mod=='3'){
								$payment_mods = 'CHEQUE';
							}
							else if($payment_mod=='4'){
								$payment_mods = 'CASH';
							}
							else{
								$payment_mods ='';
							}
						
							$ins_data['added_by'] = $_POST['user_id']; 
							$ins_data['client_id'] = $_POST['client_id'];
							$ins_data['date'] = date('Y-m-d H:i:s');
							$ins_data['description'] = "Payment added in the system. Payment add mod $payment_mods";
							$ins_data['cr'] = $_POST['amount'];
							$ins_data['balance'] =   $total_balanc_after_amount;
							$ins_data['type'] =  '4';
							$ins_data['created_date']                 = date('Y-m-d H:i:s');
							$ins_data['updated_date']                 = date('Y-m-d H:i:s');
							 $this->db->insert('kyi_ledger_balance',$ins_data);
				}
				
				
				
				
				
				
			/*End of Update total balance*/
            $res['status'] = 'success';
            $res['success_msg'] = 'Payment added successfully !';
        }else{
            $res['status'] = 'error';
            $res['error_msg'] = 'Payment not added !';
        }
        return $res;
    }

    public function payment_request_list(){
        $user_id = $this->input->post('user_id');
        $payment_id = $this->input->post('id');
        $this->db->select('kp.*,kc.name as client_name,kc.branch,kc.contact_person_name,concat(ku.first_name ," " ,ku.last_name) as sales_person_name,ku.user_type');
        $this->db->from('kyi_payment as kp');
        $this->db->join('kyi_client as kc','kp.client_id = kc.id','left');
        $this->db->join('kyi_users as ku','kp.added_by = ku.id','left');
        //$this->db->where('kp.added_by',$user_id);
        $this->db->where('kp.is_approve!=','1');
        $this->db->where("(kc.added_by = '$user_id'  OR ku.assigned_manager = '$user_id' )");
        //$this->db->or_where('ku.assigned_manager',$user_id);
        $this->db->order_by('kp.id','desc');
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return $query->result();
		} else {
			return false;
		}	
    }


    public function list_ppls(){
        $user_id = $this->input->post('user_id');
        
       $this->db->select('kc.id,kc.name as company_name,kc.branch,kc.price as amount,kc.added_by,kc.contact_person_name,kc.credit_limit,kc.is_approve as payment_approve,kc.created_date,kc.updated_date,concat(ku.first_name ," " ,ku.last_name) as sales_person_name', FALSE);
        $this->db->from('kyi_client as kc');
        
        $this->db->join('kyi_users as ku','kc.added_by = ku.id','left');
		
        $this->db->where('kc.payment_type=','2');
        $this->db->where('kc.is_approve=','0');

		$this->db->where("(kc.added_by = '$user_id'  OR ku.assigned_manager = '$user_id' )");
         
        
        $this->db->order_by('kc.id','desc');
        $query = $this->db->get();
		//echo $this->db->last_query();
        if($query->num_rows() > 0){
            return $query->result();
		} else {
			return false;
		}
    }
    


    public function ppl_approve_or_amount(){
        $ppl_id = $this->input->post('ppl_id');

       
        //pr($ppl_id);die;
        // $approve_person_id = $this->input->post('approve_person_id');
        $amount = $this->input->post('amount');
         $up['is_approve'] = '1';
       // $up['approve_by'] = $approve_person_id;
        if(!empty($amount)){
             $up['credit_limit'] = $amount;
        }
        $this->db->where('id', $ppl_id);
       $update =  $this->db->update('kyi_client', $up);
	   
      
        if($update){

            $this->db->select("id,credit_limit,added_by,total_balance,is_approve");
            $this->db->where('id',$ppl_id);
            $this->db->where('is_approve','1');
            $query = $this->db->get('kyi_client');
            if($query->num_rows() > 0){
                $result    = $query->row();
				$added_by = $result->added_by;
				$client_id = $result->id;
                $credit_limit = $result->credit_limit;
                $total_balance = $result->total_balance;
				$total_balanc_after_credit = $credit_limit +  $total_balance;
                $up1['total_balance'] = $credit_limit +  $total_balance;
                $this->db->where('id',$ppl_id);
                $update1 = $this->db->update('kyi_client', $up1);
				
				// insert data in the ledger table 
					$ins_data['added_by'] = '1'; // by admin
					$ins_data['client_id'] = $client_id;
					$ins_data['date'] = date('Y-m-d H:i:s');
					$ins_data['description'] = 'Credit Limit Is approved';
					$ins_data['cr'] = $credit_limit;
					$ins_data['balance'] =   $total_balanc_after_credit;
					$ins_data['type'] =  '3';
					$ins_data['created_date']                 = date('Y-m-d H:i:s');
					$ins_data['updated_date']                 = date('Y-m-d H:i:s');
					 $this->db->insert('kyi_ledger_balance',$ins_data);
				
				
            }
                $res['status']      = 'success';
                $res['success_msg'] = 'PPl is approved';
                
            }else{
                $res['status']    = 'error';
                $res['error_msg'] = 'Awaited for PPl approval from admin';
            }
         return $res;
        }


        public function payment_approve(){
        $payment_id = $this->input->post('id');
        $this->db->Select('client_id,amount');
        $this->db->where('id',$payment_id);
        $query = $this->db->get('kyi_payment');
        if($query->num_rows() > 0){
            $result    = $query->row();
            $amount = $result->amount;
            $client = $result->client_id;
        }

       



        $approve_person_id = $this->input->post('approve_person_id');
       // $amount = $this->input->post('amount');
         $up['is_approve'] = '1';
        $up['approve_by'] = $approve_person_id;
        $this->db->where('id', $payment_id);
       $update =  $this->db->update('kyi_payment', $up);
      
        if($update){
                $res['status']      = 'success';
                $res['success_msg'] = 'Payment is approved';
            }else{
                $res['status']    = 'error';
                $res['error_msg'] = 'Awaited for Payment approval from admin';
            }
         return $res;
        }




        public function list_users_with_status(){
            $user_id = $this->input->post('user_id', true);
            
            $this->db->select('*');
            $this->db->from('kyi_users');
            $this->db->where('id', $user_id);
            $query = $this->db->get();
            if($query->num_rows() > 0){
                $res['status'] = 'success';
                $res['success_msg'] = 'Data found successfully !';
                $res['result'] = $query->row();
            }else{
                $res['status'] = 'error';
                $res['error_msg'] = 'Data not found !';
            }
            return $res;
        }
    

 
}

?>