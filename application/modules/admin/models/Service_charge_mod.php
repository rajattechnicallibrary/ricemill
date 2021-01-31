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
class Service_charge_mod extends CI_Model {

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
    function campaign_list_ajax($filter){
        $this->db->select("SQL_CALC_FOUND_ROWS kc.*,ck.name as company_name,ck.branch,ck.contact_person_name,ck.total_balance,ck.used_balance, u.first_name, u.last_name,u.user_type,u.assigned_manager,ku.first_name as manager_first_name, ku.last_name as manager_last_name", false);
        $this->db->from("kyi_campaign as kc");
		$this->db->join("kyi_client as ck",'kc.client_id = ck.id','left');
        $this->db->join("kyi_users as u",'kc.added_by = u.id','left');
        $this->db->join("kyi_users as ku",'u.assigned_manager = ku.id','left');
        $columns = array('kc.id','kc.id','kc.id','kc.id','kc.id','manager_first_name','ck.branch');
        if (isset($filter['search']['value']) && $filter['search']['value']!=''){
            $search_keyboard    =   $filter['search']['value'];
            $search_keyboard=strtolower($search_keyboard);
            $str = "";
            $str = $str."(LOWER(ck.name) LIKE '$search_keyboard%' OR LOWER(ck.branch) LIKE '$search_keyboard%' OR LOWER(ck.contact_person_name) LIKE '$search_keyboard%')";
            $this->db->where($str);    
        }
        if(isset($filter['order'][0]['column']) &&  $filter['order'][0]['column']!='' && isset($filter['order'][0]['dir']) && $filter['order'][0]['dir']!='' && isset($filter['length']) && $filter['length']!='' && isset($filter['start']) && $filter['start']!=''){
        $this->db->order_by($columns[$filter['order'][0]['column']], $filter['order'][0]['dir']);
        if ($filter['length'] != '-1') {  // for showing all records
             $this->db->limit($filter['length'], $filter['start']);
        }
        }
			
			
		
		if(isset($filter['status']) && $filter['status']!=''){
             $this->db->where("kc.status",$filter['status']);
        }
		
		if(isset($filter['date_type']) && @$filter['date_type']!=''){
			
			if($filter['date_type']=="execution_date")
			{
				if(isset($filter['start_date']) && @$filter['start_date']!=''){
					$start_date = correct_date($filter['start_date']);            
					 //$this->db->where("date(u.created_date) >=",date('Y-d-m',strtotime()));
					 $this->db->where("date(kc.execution_date) >=",$start_date);
				}
					if(isset($filter['end_date'])&& $filter['end_date']!=''){
						$end_date = correct_date($filter['end_date']);         
						//$this->db->where("date(u.created_date) <=",date('Y-d-m',strtotime($filter['end_date'])));
						$this->db->where("date(kc.execution_date) <=",$end_date);

					}
			
			}
			
			
			if($filter['date_type']=="posted_date")
			{
				if(isset($filter['start_date']) && @$filter['start_date']!=''){
					$start_date = correct_date($filter['start_date']);            
					 //$this->db->where("date(u.created_date) >=",date('Y-d-m',strtotime()));
					 $this->db->where("date(kc.post_date) >=",$start_date);
				}
					if(isset($filter['end_date'])&& $filter['end_date']!=''){
						$end_date = correct_date($filter['end_date']);         
						//$this->db->where("date(u.created_date) <=",date('Y-d-m',strtotime($filter['end_date'])));
						$this->db->where("date(kc.post_date) <=",$end_date);

					}
			
			}
			
             //$this->db->where("u.assigned_manager ",ID_decode($filter['manager_id']));
        }	
			
			
			
        if(isset($filter['start_date']) && @$filter['start_date']!='' && $filter['date_type']==''){
            $start_date = correct_date($filter['start_date']);            
             //$this->db->where("date(u.created_date) >=",date('Y-d-m',strtotime()));
             $this->db->where("date(kc.created_date) >=",$start_date);
        }
		if(isset($filter['end_date'])&& $filter['end_date']!='' && $filter['date_type']==''){
            $end_date = correct_date($filter['end_date']);         
            //$this->db->where("date(u.created_date) <=",date('Y-d-m',strtotime($filter['end_date'])));
            $this->db->where("date(kc.created_date) <=",$end_date);

        }
		if(currentuserinfo()->user_type=='4' || currentuserinfo()->user_type=='3'){
			$user_id = currentuserinfo()->id;
			
			$this->db->where("(kc.added_by = '$user_id'  OR ku.assigned_manager = '$user_id' )");
        }
        

        $this->db->order_by('kc.id','desc');
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
        $this->db->select("u.id,u.first_name");
        $this->db->from(" kyi_users as u");
        $this->db->where('u.status','active');
        $this->db->where('u.user_type','3');
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
	
	
	
	function  client_names_list($id){
        $this->db->select('ku1.id,ku1.name');
		$this->db->from("kyi_client as ku1");
        $this->db->where('ku1.added_by',$id);
		$this->db->where('ku1.payment_type =','2');
		$this->db->order_by('ku1.id','desc');
        $query = $this->db->get();
        //echo $this->db->last_query();die;
		if ($query->num_rows() > 0) {
				 $res['status'] = 'success';
				 $res['result'] = $query->result();				
			 } else {
				 $res['status'] = 'error';
				 $res['result'] = '';				
			 }
            return $res;
    }
	
	function  branch_names_list($id){
        $this->db->select('ku1.id,ku1.branch');
		$this->db->from("kyi_client as ku1");
        $this->db->where('ku1.id',$id);
		$this->db->order_by('ku1.id','desc');
        $query = $this->db->get();
        //echo $this->db->last_query();die;
            if ($query->num_rows() > 0) {
				 $res['status'] = 'success';
				 $res['result'] = $query->result();				
			 } else {
				 $res['status'] = 'error';
				 $res['result'] = '';				
			 }
            return $res;
    }
	
	function  contact_names_list($id){
        $this->db->select('ku1.id,ku1.contact_person_name');
		$this->db->from("kyi_client as ku1");
        $this->db->where('ku1.id',$id);
		$this->db->order_by('ku1.id','desc');
        $query = $this->db->get();
        //echo $this->db->last_query();die;
            if ($query->num_rows() > 0) {
				 $res['status'] = 'success';
				 $res['result'] = $query->result();				
			 } else {
				 $res['status'] = 'error';
				 $res['result'] = '';				
			 }
            return $res;
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
	
	function update_used_sms_counts($camp_id,$used_sms_count,$sms_count) 
	{	
       
        if(!empty($camp_id)){
			if($used_sms_count <= $sms_count)
             $up['used_sms_count'] = $used_sms_count;
			 $up['post_date'] = date('Y-m-d');
			 $up['post_time'] = date('H:i:s');
			 
        }
        $this->db->where('id', $camp_id);
		$update =  $this->db->update('kyi_campaign', $up); 
	
		$rs = $this->db->affected_rows();
		if($rs){
			return true;
		} else {
			return false;
		}	
			
			
            
	}
	
	 function closed_sms_status($camp_ids,$sms_count,$used_sms_count) 
	{	
           
			if($sms_count == $used_sms_count){
				$up['status'] = 'closed';
				$this->db->where('id', $camp_ids);
				$update =  $this->db->update('kyi_campaign', $up);
			}
		
		$rs = $this->db->affected_rows();
		if($rs){
			return true;
		} else {
			return false;
		}
	
		
			
    
	}
	
	/**
     * view client datails
     *
     * this function view client datails via id 
     */
    public function views($id){
		
        $this->db->select("SQL_CALC_FOUND_ROWS kc.*,ck.name as company_name,ck.branch,ck.contact_person_name,ck.total_balance,ck.used_balance, u.first_name, u.last_name,u.user_type,u.assigned_manager,ku.first_name as manager_first_name, ku.last_name as manager_last_name", false);
        $this->db->from("kyi_campaign as kc");
		$this->db->join("kyi_client as ck",'kc.client_id = ck.id','left');
        $this->db->join("kyi_users as u",'kc.added_by = u.id','left');
        $this->db->join("kyi_users as ku",'u.assigned_manager = ku.id','left');
      
        //$this->db->or_where('ku.assigned_manager',$user_id);
        //$this->db->order_by('kc.id','desc');
        $this->db->where('kc.id',$id);
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return $query->row();
        } else{
            return false;
        }
    }
	
		public function ajax_company_names($id){
		//pr($id);die;
		$this->db->select('ku1.id,ku1.name');
		$this->db->from("kyi_client as ku1");
        $this->db->where('ku1.added_by',$id);
		$this->db->where('ku1.payment_type =','2');
		$this->db->order_by('ku1.id','desc');
        $query = $this->db->get();
        //echo $this->db->last_query();die;
		if ($query->num_rows() > 0) {
				 $res['status'] = 'success';
				 $res['result'] = $query->result();				
			 } else {
				 $res['status'] = 'error';
				 $res['result'] = '';				
			 }
            return $res;
      
	}
	
	public function ajax_branch_names($id){
		//pr($id);die;
		$this->db->select("ku.id");
        $this->db->from(" kyi_client as ku");
        
        $this->db->where('ku.id',$id);
         //$this->db->where('u.status','active');
		$this->db->order_by('ku.id','desc');
        $query = $this->db->get();
		//echo $this->db->last_query();die;	   	  
        if ($query->num_rows() > 0) {
			$client_id = explode(',',$query->row()->id);
            //pr($client_id);die;
			$this->db->select('ku1.id,ku1.branch');
			$this->db->from("kyi_client as ku1");
             //$this->db->where('u1.status','active');
			$this->db->where_in('ku1.id',$client_id);	   
			$query1 = $this->db->get();				
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
	
	public function ajax_contact_person_names($id){
		//pr($id);die;
		$this->db->select("ku.id");
        $this->db->from(" kyi_client as ku");
        
        $this->db->where('ku.id',$id);
         //$this->db->where('u.status','active');
		$this->db->order_by('ku.id','desc');
        $query = $this->db->get();
		//echo $this->db->last_query();die;	   	  
        if ($query->num_rows() > 0) {
			$client_id = explode(',',$query->row()->id);
            //pr($client_id);die;
			$this->db->select('ku1.id,ku1.contact_person_name');
			$this->db->from("kyi_client as ku1");
             //$this->db->where('u1.status','active');
			$this->db->where_in('ku1.id',$client_id);	   
			$query1 = $this->db->get();				
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
	
	// add payments
	
	function add_payment(){
        $added_by                    =   currentuserinfo()->id;
        
        $data['sales_person_id']      =   $_POST['pay_sales_person'];
        $data['client_id']              =   $_POST['client_name_id'];
        $data['added_by']          =   $added_by;
		
        $data['based_on']             =   $_POST['based_on']; 
		$data['tax_status']             =   $_POST['gen_type']; 
		$data['payment_mod']             =   $_POST['mod_payment_id'];
		$data['amount']             =   $_POST['amount_collected'];
       // $data['is_verify']          =   '1';
        //$data['user_type']          =   '3';
		//$data['role_id']            =   '3';

       // $data['added_by']           =   $user_id;
        $data['created_date']       =   date('Y-m-d H:i:s');
        $data['updated_date']       =   $data['created_date'];
        //pr($data);die;
        $this->db->insert("kyi_payment", $data);
        $seller_id  =   $this->db->insert_id();
        if($seller_id){
          $rs_data['status']      =   'success';
		  $rs_data['msg']      =   'Payment Added successfully';
        }else{
            $rs_data['status'] = 'error';
            $rs_data['error_msg'] = "Invalid Request";
        }
        return $rs_data;
    }
	
	
	function account_payment_list_ajax($filter){
       
        $this->db->select('SQL_CALC_FOUND_ROWS kp.*,kc.name as company_name,kc.name,kc.branch,kc.contact_person_name,kc.gstin,ku.first_name, ku.last_name,ku2.first_name as manager_first_name, ku2.last_name as manager_last_name,concat(ku.first_name ," " ,ku.last_name) as sales_person_name,ku.user_type,ku3.first_name as added_by_account_sales_person,(select first_name from kyi_users where id=kp.approve_by) AS APPROVER_NAME',False);
        $this->db->from('kyi_payment as kp');
        $this->db->join('kyi_client as kc','kp.client_id = kc.id','left');
        $this->db->join('kyi_users as ku','kp.added_by = ku.id','left');
		$this->db->join("kyi_users as ku2",'ku.assigned_manager = ku2.id','left');
		$this->db->join("kyi_users as ku3",'kp.sales_person_id = ku3.id','left');
		
		//$this->db->select("SQL_CALC_FOUND_ROWS kp.*,ku.id as user_id,ku.user_type,ku.first_name,ku.assigned_manager",false);
		//$this->db->from("kyi_payment as kp");
		//$this->db->join("kyi_users as ku","kp.added_by = ku.id","left");
		
		
		$columns = array('kp.id','kp.id','kp.created_date','kc.branch','kp.amount','sales_person_name','manager_first_name','kp.status');
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
		if(isset($filter['executive_id']) && $filter['executive_id']!='' &&  $filter['executive_id'] != 'No Records Found !'){
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
		if(currentuserinfo()->user_type=='4'){
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
	
	function count_all_campaign_ajax($filter){
		$user_id = currentuserinfo()->id;
			
			
	
         $this->db->select('SQL_CALC_FOUND_ROWS kp.*,(select COUNT(id) from kyi_campaign where added_by = kp.added_by AND client_id = kp.client_id  GROUP BY kp.client_id) as Total_campaign,(select sum(total_cost) from kyi_campaign where added_by = kp.added_by AND client_id = kp.client_id  GROUP BY kp.client_id) as Total_balance  ,(select sum(used_sms_count) from kyi_campaign where added_by = kp.added_by AND client_id = kp.client_id  GROUP BY kp.client_id) as Total_used_sms_count  ,(select sum(sms_count) from kyi_campaign where added_by = kp.added_by AND client_id = kp.client_id  GROUP BY kp.client_id) as Total_sms_count,kts.name,kts.branch,kts.contact_person_name',False);
        $this->db->from('kyi_campaign as kp');
        $this->db->join('kyi_client as kts',"kp.client_id=kts.id","left");
		//$this->db->join('kyi_client as kt',"kp.client_id=kt.id","left");
        $this->db->join('kyi_users as ku','kp.added_by = ku.id','left');
		$this->db->join("kyi_users as ku2",'ku.assigned_manager = ku2.id','left');
		//$this->db->join("kyi_users as ku3",'kp.sales_person_id = ku3.id','left');
		$this->db->where("(kp.added_by = '$user_id' )");
		$this->db->group_by("kp.client_id");
			
		
		$columns = array('kp.id','kp.id','kp.created_date','kc.name','kp.amount','sales_person_name','manager_first_name','kp.status');
        if (isset($filter['search']['value']) && $filter['search']['value']!=''){
            $search_keyboard    =   $filter['search']['value'];
            $search_keyboard=strtolower($search_keyboard);
            $str = "";
            $str = $str."(LOWER(kts.name) LIKE '$search_keyboard%' OR LOWER(kts.branch) LIKE '$search_keyboard%' OR LOWER(kts.contact_person_name) LIKE '$search_keyboard%')";
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
             //$this->db->where("ku.assigned_manager",ID_decode($filter['manager_id']));
			 //$this->db->or_where("kp.added_by ",ID_decode($filter['manager_id']));
            $manager_id = ID_decode($filter['manager_id']);
             $this->db->where("(ku.assigned_manager = '$manager_id'  OR kp.added_by = '$manager_id' )");
        }
		if(isset($filter['executive_id']) && $filter['executive_id']!=''){
             $this->db->where("ku.id",$filter['executive_id']);
			$this->db->or_where("kp.added_by ",$filter['executive_id']);
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
	
	
	function update_gstamount() 
	{	
          
				$payment_id = $_POST['payment_id'];
				$gst_amounts = $_POST['gst_amounts'];
				$gst_type = $_POST['payment_type'];
				$invoice_date = correct_date($_POST['invoice_date']);
				//pr($invoice_date);die;
				$invoice_due_date = correct_date($_POST['invoice_due_date']);
				$payment_date = correct_date($_POST['payment_date']);
				$invoice_status = $_POST['gst_status'];
				$gstin_id = $_POST['gstin_id'];
			
			
			
			if(!empty($gst_amounts) && $gst_type=="1"){
				$up['tax_status'] = '0';  // it shows gst is applied
				$up['tax_amount'] = $gst_amounts;
				
			}
			
			$up['is_generate_invoice'] = '1';
			$up['invoice_create_date'] = $invoice_date;
			$up['invoice_status'] = $invoice_status;
			$up['invoice_due_date'] = $invoice_due_date;
			$up['payment_date'] = $payment_date;
			$up['status'] = 'completed';
			$up['gstin'] = $gstin_id;
			$this->db->where('id', $payment_id);
			$update =  $this->db->update('kyi_payment', $up);
		
		$rs = $this->db->affected_rows();
		if($rs){
			return true;
		} else {
			return false;
		}
	
		
			
    
	}
	function update_gstamount_with_no_gst(){
		
		$payment_id = $_POST['payment_id'];
		$gst_amounts = '';
		$gst_type = $_POST['payment_type'];
		$gstin_id = '';
		$up['tax_status'] = '1';  // it shows gst is not  applied
		$up['tax_amount'] = $gst_amounts;
		$up['status'] = 'completed';
		$up['gstin'] = $gstin_id;
		$this->db->where('id', $payment_id);
			$update =  $this->db->update('kyi_payment', $up);
		
		$rs = $this->db->affected_rows();
		if($rs){
			return true;
		} else {
			return false;
		}
	}
	function get_client_invoice_pdf_data($payment_id){
		//pr($payment_id);die;
		$this->db->Select('kp.*,kc.name as client_name,kc.branch,kc.address as client_address,kc.email as client_email,kc.mobile,kc.payment_type,kc.price,kc.price_unit,kc.total_balance,kc.gstin,kcm.id as campaign_id,kcm.sms_count,kcm.cost_per_sms',false);
		$this->db->From('kyi_payment as kp');
		$this->db->join('kyi_client as kc','kp.client_id = kc.id','left');
		$this->db->join('kyi_campaign as kcm','kp.client_id = kcm.client_id','left');
		$this->db->Where('kp.id',$payment_id);
		$query = $this->db->get();
		//echo$this->db->last_query();die;
		if($query->num_rows() > 0){
			$result = $query->row();
			return $result;
		}else{
			return false;
		}
		
	}
	
	function change_payment_account_status($payment_id) 
	{	
           
			if(!empty($payment_id) ){
				$up['status'] = 'completed';  // it shows status completed is applied
				
				
			}
			
			$this->db->where('id', $payment_id);
			$update =  $this->db->update('kyi_payment', $up);
		
		$rs = $this->db->affected_rows();
		if($rs){
			return true;
		} else {
			return false;
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
		//echo $echo $this->db->last_query();die;
			   	  
        if ($query->num_rows() > 0) {
			$gang_id = explode(',',$query->row()->id);
           // pr ($gang_id);die;
			$this->db->select('u1.id,u1.first_name');
			$this->db->from("kyi_users as u1");
            $this->db->where('u1.status','active');
			$this->db->where_in('u1.assigned_manager',$gang_id);	   
			$query1 = $this->db->get();	
            //echo $this->db->last_query();die;
			if ($query1->num_rows() > 0) {
                //echo'yesss';die;
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
			$query2 = $this->db->get();
			//echo $this->db->last_query();die;
            if($query2->num_rows() > 0){
                  $client_arr = array();
                foreach($query2 as $val){
                    $client_arr []= $val->id;
                }
                if ($client_arr) {
				$this->db->select('kc1.id,kc1.name');
				$this->db->from("kyi_client as kc1");
			
				$this->db->where_in('kc1.id',$client_arr);	   
				$query3 = $this->db->get();	
				echo $this->db->last_query();die;			
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
	public function ajax_contact_person_names1($client_id){
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
	// ajax contact person name
	public function ajax_contact_person_namesq($client_id){
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

	function  client_names_lists(){
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
	
	
	//Rahul Setia
	function advertiser_details(){
		$this->db->select("id,first_name");
        $this->db->from(" users");
        $this->db->where('status',"Active");
		$this->db->where('user_type',"2");
		$this->db->order_by('id','desc');
        $query = $this->db->get();
        //echo $this->db->last_query();die;
            if ($query->num_rows() > 0) {
                return $query->result();
            }
            else{
                return false;
            }
			
    }
    
    //Rahul Setia
	function publisher_details(){
		$this->db->select("id,first_name");
        $this->db->from(" users");
        $this->db->where('status',"Active");
		$this->db->where('user_type',"3");
		$this->db->order_by('id','desc');
        $query = $this->db->get();
        //echo $this->db->last_query();die;
            if ($query->num_rows() > 0) {
                return $query->result();
            }
            else{
                return false;
            }
			
    }
    






	function add($data){
        $this->db->insert('am_campaign', $data);
        $last_id = $this->db->insert_id();
        return $last_id;
        
			
	}
	function Campaign_details($id){
		$this->db->select("am_campaign.*, users.first_name, users.last_name");
		$this->db->join('users', 'am_campaign.added_by=users.id','left');
        $this->db->from("am_campaign");
		
		$this->db->where('am_campaign.id',$id);
		$this->db->order_by('am_campaign.id','desc');
        $query = $this->db->get();
        //echo $this->db->last_query();die;
            if ($query->num_rows() > 0) {
                return $query->row();
            }
            else{
                return false;
            }
		
	}

	
	
	function update($data,$id){
		$this->db->where('id',$id);
		$this->db->update('am_campaign',$data);
	}
	
	public function ajax_list_items($search='',$per_page=10,$start=0) 
    {
		$this->db->select("*");
		if($search!='')
        {
			$this->db->like("(CONCAT(am_campaign.campaign_name,' ',am_campaign.amount,' ',am_campaign.description))", $search); 
        }
		$this->db->limit($per_page,$start);
		$this->db->from("am_campaign");
		$data['result']=$this->db->get()->result();
		
        $this->db->select("COUNT(am_campaign.id) AS count");
        $this->db->from("am_campaign");
        $data['count']=$this->db->count_all_results();
		return $data; 
		
	}
	
	function count_campaign_data() {
        $requestData = $this->input->post(null, true);

		$this->db->select('*');
        $this->db->order_by('id','desc');
        if (isset($_GET['status'])) {
           
            $this->db->where("am_campaign.status =",$_GET["status"]);
        }
		
        if (!empty($requestData['search']['value'])) {
            $search_val = $requestData['search']['value'];
            $this->db->like("(CONCAT(am_campaign.campaign_name,' ',am_campaign.amount,' ',am_campaign.description))", $search_val); 
        }
		
       
		return $query = $this->db->get('am_campaign');
    }

    function get_campaign_data($parent_id = "") {  
		
        $requestData = $this->input->post(null, true);
        $columns = array(
            1 => 'campaign_name',
            2 => 'start_date',
            3 => 'end_date',
            4=> 'campaign_type',
            5 => 'amount',
            6 => 'description',
            7 => 'duration',
            8 => 'description',



        );
       
        $this->db->select("am_campaign.*, CONCAT(u.first_name,' ',u.last_name) as advertiser_name");
        $this->db->join('users as u','u.id = am_campaign.added_by','left');
        $this->db->from("am_campaign");
        if (isset($_GET['status'])) {
           
            $this->db->where("am_campaign.status =",$_GET["status"]);
        }
		
         
        if (!empty($requestData['search']['value'])) {
            $search_val = $requestData['search']['value']; 
            $this->db->like("(CONCAT(campaign_name,' ',amount,' ',description))", $search_val); 
            }
        
        
        
        if (@$requestData['order'][0]['column'] && @$requestData['order'][0]['dir']) {
            $order = @$requestData['order'][0]['dir'];
            $column_name = $columns[@$requestData['order'][0]['column']];
            $this->db->order_by("$column_name", "$order");
        } else {
            $this->db->order_by("id", "desc");
        }
        if (@$requestData['length'] && $requestData['length'] != '-1') {
            $this->db->limit($requestData['length'], $requestData['start']);
        }
    
       
		$query = $this->db->get();
		
        if ($query->num_rows()) {
            return $query->result();
        } else {
            //return false;
        }
    }
    
function publisher_insert($id,$data){
    $this->db->where('campaign_id', $id);
    $this->db->delete('am_publisher_mapping'); 
    $this->db->insert_batch('am_publisher_mapping', $data); 

}

function publisher_mapping_deatils($id){
    $this->db->select("publisher_id");
    $this->db->from("am_publisher_mapping");
    $query = $this->db->get();
    //echo $this->db->last_query();die;
        if ($query->num_rows() > 0) {
            return $query->result();
        }
        else{
            return false;
        }

}


function update_mapping_deatils($id,$data){
    $this->db->where('id',$id);
    $this->db->update('am_campaign',$data);
}




}
