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
class Payment_mod extends CI_Model {

    /**
     * Constructor
     */
    function __construct() {
        parent::__construct();
    }
	public function ajax_list_items($search='',$per_page=10,$start=0) 
    {
		$this->db->select("am_campaign.*,am_account_statement.amount as am_account_statement_amount,am_account_statement.type,am_account_statement.status");
		$this->db->join('am_account_statement','am_campaign.id=am_account_statement.campaign_id','inner');
		if($search!='')
        {
			$this->db->like("(CONCAT(am_campaign.campaign_name,' ',am_campaign.amount,' ',am_campaign.description,' ',am_campaign.start_date,' ',am_campaign.end_date,' ',am_account_statement.amount))", $search); 
        }
		$this->db->limit($per_page,$start);
		$this->db->from("am_campaign");
		$data['result']=$this->db->get()->result();
		
		$this->db->select("COUNT(am_campaign.id) AS count");
		$this->db->join('am_account_statement','am_campaign.id=am_account_statement.campaign_id','inner');

        $this->db->from("am_campaign");
        $data['count']=$this->db->count_all_results();
		return $data; 
		
    }
    
    function count_publisher_data() {
        $requestData = $this->input->post(null, true);

        $this->db->select('*');
        if (!empty($requestData['search']['value'])) {
            $search_val = $requestData['search']['value'];
            $this->db->like("(CONCAT(am_account_statement.first_name,' ',am_account_statement.last_name,' ',am_account_statement.email,' ',am_account_statement.mobile,' ',am_account_statement.status))", $search_val); 
        }
        //$this->db->where('user_type',3);
        
		$this->db->where('status !=','Delete');
        return $query = $this->db->get('am_account_statement');
    }

    function get_publisher_data($parent_id = "") {        
        $requestData = $this->input->post(null, true);
        $columns = array(
            1 => 'description',
            2 => 'amount',
            3 => 'duration',
            4 => 'camp_id',
            4 => 'ac.status',
        );
       
       $this->db->select('*, ac.id as camp_id, am_account_statement.status as statustype');
        // $this->db->where('user_type',3);
        $this->db->join('am_campaign as ac','ac.id = am_account_statement.campaign_id','left');
        $this->db->from('am_account_statement');
         
        if (!empty($requestData['search']['value'])) {
            $search_val = $requestData['search']['value']; 
            $this->db->like("(CONCAT(ac.campaign_name,' ',am_account_statement.type,' ',am_account_statement.status))", $search_val); 
            }
        
        if (isset($_GET['status'])) {
           
            $this->db->where("am_account_statement.status =",$_GET["status"]);
        }else {
            $this->db->where("am_account_statement.status !=",'Delete');
        }
        
        if (@$requestData['order'][0]['column'] && @$requestData['order'][0]['dir']) {
            $order = @$requestData['order'][0]['dir'];
            $column_name = $columns[@$requestData['order'][0]['column']];
            $this->db->order_by("$column_name", "$order");
        } else {
            $this->db->order_by("am_account_statement.id", "desc");
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
        // return $query->result();
    }

    function get_city($id){
        $this->db->select("*");
        $this->db->where("state_id",$id);
        $this->db->from('am_city');
        $query = $this->db->get();
        return $query->result();
    }

	
	
}
