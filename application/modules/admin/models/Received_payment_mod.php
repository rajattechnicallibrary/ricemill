<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Profile Model
 *
 * @package		Profile
 * @category            Profile
 * @author		Arvind Soni
 * @website		http://www.thealternativeaccount.com
 * @company     thealternativeaccount Inc
 * @since		Version 1.0
 */
class Received_payment_mod extends CI_Model {

    /**
     * Constructor
     */
    function __construct() {
        parent::__construct();
    }
     /**
     * client_list_ajax
     * @access	public
     * @return array
     */
    function received_payment_list_ajax($filter){
        
        $this->db->select('SQL_CALC_FOUND_ROWS kp.*,kc.name as company_name,kc.branch,kc.contact_person_name,ku.first_name, ku.last_name,ku2.first_name as manager_first_name, ku2.last_name as manager_last_name,concat(ku.first_name ," " ,ku.last_name) as sales_person_name,ku.user_type,ku3.first_name as added_by_account_sales_person,(select first_name from kyi_users where id=kp.approve_by) AS APPROVER_NAME',False);
        $this->db->from('kyi_payment as kp');
        $this->db->join('kyi_client as kc','kp.client_id = kc.id','left');
        $this->db->join('kyi_users as ku','kp.added_by = ku.id','left');
		$this->db->join("kyi_users as ku2",'ku.assigned_manager = ku2.id','left');
		$this->db->join("kyi_users as ku3",'kp.sales_person_id = ku3.id','left');
		
		//$this->db->select("SQL_CALC_FOUND_ROWS kp.*,ku.id as user_id,ku.user_type,ku.first_name,ku.assigned_manager",false);
		//$this->db->from("kyi_payment as kp");
		//$this->db->join("kyi_users as ku","kp.added_by = ku.id","left");
		
		
		$columns = array('kp.id','kp.id','kp.created_date','kc.name,kc.contact_person_name','kp.amount','sales_person_name','manager_first_name','kp.status');
        if (isset($filter['search']['value']) && $filter['search']['value']!=''){
            $search_keyboard    =   $filter['search']['value'];
            $search_keyboard=strtolower($search_keyboard);
            $str = "";
            $str = $str."(LOWER(kc.name) LIKE '$search_keyboard%' OR LOWER(kc.branch) LIKE '$search_keyboard%' OR LOWER(kc.contact_person_name) LIKE '$search_keyboard%')";
            $this->db->where($str);    
        }
        if(isset($filter['order'][0]['column']) &&  $filter['order'][0]['column']!='' && isset($filter['order'][0]['dir']) && $filter['order'][0]['dir']!='' && isset($filter['length']) && $filter['length']!='' && isset($filter['start']) && $filter['start']!=''){
        $this->db->order_by($columns[$filter['order'][0]['column']], $filter['order'][0]['dir']);
        if ($filter['length'] != '-1') {  // for showing all records
             $this->db->limit($filter['length'], $filter['start']);
        }
        }
			
			
		
		if(isset($filter['status']) && $filter['status']!=''){
             $this->db->where("kp.is_approve",$filter['status']);
        }
		if(isset($filter['manager_id']) && $filter['manager_id']!=''){
			$manager_id = ID_decode($filter['manager_id']);
             //$this->db->where("ku.assigned_manager",ID_decode($filter['manager_id']));
			 //$this->db->or_where("kp.added_by ",ID_decode($filter['manager_id']));
			 $this->db->where("(ku.assigned_manager = '$manager_id'  OR kp.added_by = '$manager_id' )");
        }
		if(isset($filter['executive_id']) && $filter['executive_id']!=''){
			$executive = $filter['executive_id'];
             //$this->db->where("ku.id",$filter['executive_id']);
			//$this->db->or_where("kp.added_by ",$filter['executive_id']);
			$this->db->where("(ku.id = '$executive'  OR kp.added_by = '$executive' )");
        }
			
		if(isset($filter['clients_ids']) && $filter['clients_ids']!=''){
             $this->db->where("kp.client_id",$filter['clients_ids']);
			//$this->db->or_where("kp.added_by ",$filter['executive_id']);
        }
		if(isset($filter['contact_person_ids']) && $filter['contact_person_ids']!=''){
             $this->db->where("kc.id",$filter['contact_person_ids']);
			//$this->db->or_where("kp.added_by ",$filter['executive_id']);
        }
			
			
			
        if(isset($filter['start_date']) && @$filter['start_date']!=''){
            $start_date = correct_date($filter['start_date']);            
             //$this->db->where("date(u.created_date) >=",date('Y-d-m',strtotime()));
             $this->db->where("date(kp.created_date) >=",$start_date);
        }
		if(isset($filter['end_date'])&& $filter['end_date']!=''){
            $end_date = correct_date($filter['end_date']);         
            //$this->db->where("date(u.created_date) <=",date('Y-d-m',strtotime($filter['end_date'])));
            $this->db->where("date(kp.created_date) <=",$end_date);

        }
		if(currentuserinfo()->user_type=='4' || currentuserinfo()->user_type=='3'){
			$user_id = currentuserinfo()->id;
			
			$this->db->where("(kp.added_by = '$user_id'  OR ku.assigned_manager = '$user_id' )");
		}
		$this->db->order_by('kp.id','desc');
        $query = $this->db->get();
		//echo $this->db->last_query();die;
        if ($query->num_rows() > 0) {
            $res['result']=$query->result();
            $total_record           =   $this->db->query('SELECT FOUND_ROWS() AS count');
            $res['totalData']       =   $total_record->row()->count;
            $res['totalFiltered']   =   $total_record->row()->count; 
            $res['status']="success";
        } else {
            $res['result']          =   '';
            $res['totalData']       =   0;  
            $res['totalFiltered']       =   0; 
            $res['status']          =   "error";
        }
        return $res;
    }

    /**
     * view client datails
     *
     * this function view client datails via id 
     */
    public function view($id){
        $this->db->select('*');
        $this->db->from('kyi_client');
        $this->db->where('id',$id);
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return $query->row();
        } else{
            return false;
        }
    }
     /* 
     * update user details
     *
     * this function update user details
     * @access	public
     * @return array
     */
    function edit($id = null){   
        $u_data['name']                = $_POST['company_name'];
        $u_data['branch']              = $_POST['branch'];
        $u_data['address']             = $_POST['address'];
        $u_data['contact_person_name'] = $_POST['contact_person_name'];
        $u_data['email']               = $_POST['email'];
        $u_data['mobile']              = $_POST['mobiles'];
        $u_data['payment_type']        = $_POST['payment_type'];
        if(@$_POST['payment_type'] == '2'){
             $u_data['credit_limit']        = $_POST['credit_limit'];
        }
       
        $u_data['price_unit']          = $_POST['price_unit'];
        $u_data['price']          = $_POST['price'];
        $this->db->where('id',$id);
        $this->db->update('kyi_client',$u_data);
        $affected = $this->db->affected_rows();
        if($affected>= 0){
            $res['status'] ='success';
            $res['msg'] ='Client details updated successfully';
        } else {
            $res['status'] ='error';
            $res['msg'] ='Client details not updated successfully';
        }
        return $res;
        }
    

	/**
     * sales_manager_list_ajax
     *
     * this function update user profile info by user id
     * @access	public
     * @return array
     */

    function  sales_manager_list(){
        $this->db->select("u.id,u.first_name");
        $this->db->from(" kyi_users as u");
         $this->db->where('u.status','active');
        $this->db->where('u.user_type','4');
		$this->db->order_by('u.id','desc');
        $query = $this->db->get();
        //echo $this->db->last_query();die;
            if ($query->num_rows() > 0) {
                return $query->result();
            }
            else{
                return false;
            }
    }
	
	/**
     * sales_executive_list_ajax
     *
     * this function update user profile info by user id
     * @access	public
     * @return array
     */

    function  sales_executive_list(){
        //$this->db->select("u.id,u.first_name");
        //$this->db->from(" kyi_users as u");
        $this->db->select('SQL_CALC_FOUND_ROWS kp.*,kc.name as company_name,kc.branch,kc.contact_person_name,ku.id,ku.first_name, ku.last_name,ku2.first_name as manager_first_name, ku2.last_name as manager_last_name,concat(ku.first_name ," " ,ku.last_name) as sales_person_name,ku.user_type',False);
        $this->db->from('kyi_payment as kp');
        $this->db->join('kyi_client as kc','kp.client_id = kc.id','letf');
        $this->db->join('kyi_users as ku','kp.added_by = ku.id','letf');
		$this->db->join("kyi_users as ku2",'ku.assigned_manager = ku2.id','left');
        $this->db->where('ku.status','active');
        $this->db->where('ku.user_type','3');
		if(currentuserinfo()->user_type =='4')
		{
			$user_id = currentuserinfo()->id;
			
			
			$this->db->where("(kp.added_by = '$user_id'  OR ku.assigned_manager = '$user_id' )");
	
	
		}
		$this->db->group_by('ku.id');
		//$this->db->order_by('u.id','desc');
        $query = $this->db->get();
        //echo $this->db->last_query();die;
            if ($query->num_rows() > 0) {
                return $query->result();
            }
            else{
                return false;
            }
    }
	
	
	/**
     * client_names_ajax
     *
     * this function update user profile info by user id
     * @access	public
     * @return array
     */

    function  client_names_list(){
        $this->db->select("kc.id,kc.name");
        $this->db->from(" kyi_client as kc");
		$user_id = currentuserinfo()->id;
        $this->db->where('kc.added_by',$user_id);
		$this->db->order_by('kc.id','desc');
        $query = $this->db->get();
        //echo $this->db->last_query();die;
            if ($query->num_rows() > 0) {
                return $query->result();
            }
            else{
                return false;
            }
    }
	
	
	
	
	function client_person_mobile_exist($valuekey)
    {
		//pr($valuekey);die;
        $encoded_Id = $this->uri->segment('4');    
        
        $user_id = ID_decode($encoded_Id);    

        $this->db->where('id !=',$user_id);
        $this->db->where('mobile =',$valuekey);
        $query = $this->db->get('kyi_client');
      //echo $this->db->last_query(); die;
        if ($query->num_rows() > 0){
            return $query->num_rows();
        }
        else{
            return false;
        }
    }
	
	
	 function approved_payment_status($payment_id,$is_approve) 
	{	
            	
            //------------------------------------
			
			$this->db->Select('client_id,amount,approve_by');
        $this->db->where('id',$payment_id);
        $query = $this->db->get('kyi_payment');
        if($query->num_rows() > 0){
            $result    = $query->row();
            $amount = $result->amount;
            $client = $result->client_id;
			$approve_by = $result->approve_by;
			
        }

        // get total cost from client
		if($approve_by==0){
			$this->db->Select('id,total_balance');
			$this->db->where('id',$client);
			$query = $this->db->get('kyi_client');
			if($query->num_rows() > 0){
				$result    = $query->row();
				$total_balance = $result->total_balance;
				//pr($total_balance);die;
			}

			// adding amount in client table 
		
			$up1['total_balance'] =  $total_balance + $amount;
			$this->db->where('id', $client);
		   $update1 =  $this->db->update('kyi_client', $up1);
			
		}	
			
			
            if(!empty($is_approve)){
              $data['is_approve'] =  $is_approve;
			  $data['approve_by'] =  currentuserinfo()->id; // By admin
			
		$this->db->where('id', $payment_id);
        $this->db->update('kyi_payment', $data);		
		$rs = $this->db->affected_rows();
		if($rs){
			return true;
		} else {
			return false;
		}	
    }
	}
	
	
	public function ajax_sales_person($id){
		//pr($id);die;
		$this->db->select("u.id");
        $this->db->from(" kyi_users as u");
        
        $this->db->where('u.id',$id);
		
         $this->db->where('u.status','active');
		$this->db->order_by('u.id','desc');
        $query = $this->db->get();
		
			   	  
        if ($query->num_rows() > 0) {
			$gang_id = explode(',',$query->row()->id);
            
			$this->db->select('u1.id,u1.first_name');
			$this->db->from("kyi_users as u1");
             $this->db->where('u1.status','active');
			$this->db->where_in('u1.assigned_manager',$gang_id);	   
			$query1 = $this->db->get();				
			 if ($query1->num_rows() > 0) {
				 $res['status_sales_person'] = 'success';
				 $res['result_sales_person'] = $query1->result();				
			 } else {
				$res['status_sales_person'] = 'error';
				$res['result_sales_person'] = '';	
			}
			// get clients now, which are added by manager
			$this->db->select("kc.id");
			$this->db->from(" kyi_client as kc");

			$this->db->where('kc.added_by',$id);

			$this->db->order_by('kc.id','desc');
			$query2 = $this->db->get()->result();
			//echo $this->db->last_query();die;
			$client_arr = array();
			foreach($query2 as $val){
				$client_arr []= $val->id;
			}
			if ($client_arr) 
			{
				$this->db->select('kc1.id,kc1.name');
				$this->db->from("kyi_client as kc1");
		
				$this->db->where_in('kc1.id',$client_arr);	   
				$query3 = $this->db->get();	
				//echo $this->db->last_query();die;			
				 if ($query3->num_rows() > 0) {
					 $res['status_client'] = 'success';
					 $res['result_client'] = $query3->result();	
					
				 } else {
					 $res['status_client'] = 'error';
					 $res['result_client'] = '';				
				 }
			} else {
				$res['status_sales_person'] = 'error';
				$res['result_sales_person'] = '';	
			}
        } else {
			$res['status'] = 'error';
			$res['result'] = '';	
		}
		
		//pr($res);die;
        return $res;
    }
	
	
	// get client names 
	
	public function ajax_client_names($sales_person_id){
		//pr($sales_person_id);die;
		$this->db->select("kc.id");
        $this->db->from(" kyi_client as kc");
        
        $this->db->where('kc.added_by',$sales_person_id);
       
		$this->db->order_by('kc.id','desc');
        $query = $this->db->get()->result();
		$client_arr = array();
			foreach($query as $val){
				$client_arr []= $val->id;
			}
			//pr($client_arr);die;
			//pr($query);die;   	  
        if ($client_arr) {
			
			
			$this->db->select('kc1.id,kc1.name');
			$this->db->from("kyi_client as kc1");
		
			$this->db->where_in('kc1.id',$client_arr);	   
			$query1 = $this->db->get();	
			//echo $this->db->last_query();die;			
			 if ($query1->num_rows() > 0) {
				 $res['status'] = 'success';
				 $res['result'] = $query1->result();				
			 } else {
				 $res['status'] = 'error';
				 $res['result'] = '';				
			 }
        } else {
			$res['status'] = 'error';
			$res['result'] = '';	
		}
        return $res;
	}
	
	// ajax contact person name
	public function ajax_contact_person_names($client_id){
		//pr($sales_person_id);die;
		$this->db->select("kc.id");
        $this->db->from(" kyi_client as kc");
        
        $this->db->where('kc.id',$client_id);
       
		$this->db->order_by('kc.id','desc');
        $query = $this->db->get();
		  	  
        if ($query->num_rows() > 0) {
			
			
			$client_id = explode(',',$query->row()->id);
			
			$this->db->select('kc1.id,kc1.contact_person_name');
			$this->db->from("kyi_client as kc1");
		
			$this->db->where_in('kc1.id',$client_id);	   
			$query1 = $this->db->get();	
			//echo $this->db->last_query();die;			
			 if ($query1->num_rows() > 0) {
				 $res['status'] = 'success';
				 $res['result'] = $query1->result();				
			 } else {
				 $res['status'] = 'error';
				 $res['result'] = '';				
			 }
        } else {
			$res['status'] = 'error';
			$res['result'] = '';	
		}
        return $res;
	}
	
	
	

}
