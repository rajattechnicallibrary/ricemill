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
class Advertiser_mod extends CI_Model {

    /**
     * Constructor
     */
    function __construct() {
        parent::__construct();
    }
  
	
	function add($data,$passsword){
		$this->db->insert('users', $data);
		$last_id = $this->db->insert_id();
		if (!empty($last_id)) {
            
            $email_data['to'] = $data['email'];
            $email_data['from'] = ADMIN_EMAIL;
            $email_data['sender_name'] = ADMIN_NAME;
            $email_data['subject'] = "User Registration";
            $email_data['message'] = array('header' => 'User Registration.',
                'body' => '<br/><b>Your Account Detail<br> User Name :</b>' . $data['first_name'] . '
                <br><b>Password : </b>' . $passsword . '<br>',
                'mail_footer' => 'Thanks,<br/><br/> Team Track (The Rest Accounting Key) <br/><br/><br/>');
         
              _sendEmailNew($email_data);

		}

	}

	function advertiser_details($id){
		$this->db->select('*');
		$this->db->from('users');
		$this->db->where('id',$id);
		$query=$this->db->get();
		$row=$query->row();
		return $row;
	}
	
	
	function checkEmailUnique($email,$id){
		$this->db->where('id !=',$id);
		$this->db->where('email',$email);
		$query = $this->db->get('users');
		$result = $query->row();
		return $result;		
	}

	function edit($data,$id){
		$this->db->where('id', $id);
		$this->db->update('users',$data);
		
	}

	function listing(){
		$this->db->where('user_type',2);
		
		$query = $this->db->get('users');
		$result = $query->result();
		
		return $result;
	}

	public function ajax_list_items($search='',$per_page=10,$start=0) 
    {
		$this->db->select("*");
		$this->db->where('user_type',2);
		$this->db->where('status !=','Delete');
		if($search!='')
        {
			$this->db->like("(CONCAT(users.first_name,' ',users.last_name,' ',users.email,' ',users.mobile,' ',users.status))", $search); 
        }
		$this->db->limit($per_page,$start);
		$this->db->from("users");
		$data['result']=$this->db->get()->result();
		
        $this->db->select("COUNT(users.id) AS count");
		$this->db->where('user_type',2);
		$this->db->where('status !=','Delete');
        $this->db->from("users");
        $data['count']=$this->db->count_all_results();
		return $data; 
		
	}
	
	function delete($id){
		$this->db->where('id', $id);
		$this->db->update('users', array('status' => 'Delete'));

	}

	function view($id){

	  $this->db->select('u.*, ast.name as state_name, ac.name as city_name'); 
        $this->db->where('u.id',$id);
        $this->db->join('am_state as ast','ast.state_id = u.state_id','left');
        $this->db->join('am_city as ac','ac.city_id = u.city_id','left');
        $query = $this->db->get('users as u');
        
		$result = $query->row();
		return $result;		

	}
	
	function count_advertiser_data() {
        $requestData = $this->input->post(null, true);

        $this->db->select('*');
        if (!empty($requestData['search']['value'])) {
            $search_val = $requestData['search']['value'];
            $this->db->like("(CONCAT(users.first_name,' ',users.last_name,' ',users.email,' ',users.mobile,' ',users.status))", $search_val); 
        }
        $this->db->where('user_type',2);
        if (isset($_GET['status'])) {
           
            $this->db->where("users.status =",$_GET["status"]);
        }else {
            $this->db->where("users.status !=",'Delete');
        }
		$this->db->where('status !=','Delete');
        return $query = $this->db->get('users');
    }

    function get_advertiser_data($parent_id = "") {        
        $requestData = $this->input->post(null, true);
        $columns = array(
            1 => 'first_name',
            2 => 'email',
            3 => 'mobile',
            4 => 'organisation_name'
        );
       
       $this->db->select('*');
        $this->db->where('user_type',2);
        $this->db->from('users');
         
        if (!empty($requestData['search']['value'])) {
            $search_val = $requestData['search']['value']; 
            $this->db->like("(CONCAT(users.first_name,' ',users.last_name,' ',users.email,' ',users.mobile,' ',users.status,' ',users.organisation_name))", $search_val); 
            }
        
        if (isset($_GET['status'])) {
           
            $this->db->where("users.status =",$_GET["status"]);
        }else {
            $this->db->where("users.status !=",'Delete');
        }
        
        if (@$requestData['order'][0]['column'] && @$requestData['order'][0]['dir']) {
            $order = @$requestData['order'][0]['dir'];
            $column_name = $columns[@$requestData['order'][0]['column']];
            $this->db->order_by("$column_name", "$order");
        } else {
            $this->db->order_by("users.id", "desc");
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
	
	function get_state(){
		$this->db->select('*');
		$this->db->where('status','Active');
		$this->db->from('am_state');
		$query=$this->db->get();
        $row=$query->result();
        // pr($row); die;
		return $row;
	
    }
    
    function get_city($id){
        $this->db->select("*");
        $this->db->where("state_id",$id);
        $this->db->from('am_city');
        $query = $this->db->get();
        return $query->result();
    }


}
