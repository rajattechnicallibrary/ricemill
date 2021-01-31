<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Auth Model 
 *
 * @package		Dashboard
 * @subpackage	Models
 * @category	Main Dashboard 
 * @author      Dharmendra Pal
 * @website		http://www.thealternativeaccount.com
 * @company     thealternativeaccount Inc
 * @since		Version 1.0
 */
class Dashboard_mod extends CI_Model {

    var $user_table = "users";

    /**
     * Constructor
     */
    function __construct() {
        parent::__construct();
    }

    /**
     * End
     */
	
	
	/**
     * get_customer_data_for_dashboard
     *
     * This function get custmers data how many custmers give responses.
     * 
     * @access	public
     * @param   int - user id
     * @return	mixed Array 
     */
	 
	public function get_customer_data_for_dashboard() {       
        $this->db->select('rufb.id');
        $this->db->from('ri_feedback_set_node_assignment as rfsna');        
        $this->db->join('ri_user_otp AS ruo', 'ruo.node_assignment_id = rfsna.id','inner');       
        $this->db->join('ri_users_feedback_batch AS rufb', 'rufb.node_assignment_id = ruo.node_assignment_id');
        $this->db->where('rfsna.client_id',currentuserinfo()->id);		
	$this->db->where('rfsna.assignment_status','active');
        $this->db->group_by('rufb.user_id');
        $q = $this->db->get(); 
        
        
        if ($q->num_rows() > 0) {
            return $q->num_rows();
        } else {
            return false;
        }
    }
	
	/**
     * get_customer_data_for_dashboard
     *
     * This function to count client units.
     * 
     * @access	public
     * @param   int - user id
     * @return	mixed Array 
     */
	 
	public function count_client_units() {       
        $this->db->select('rcu.id');
        $this->db->from('ri_client_unit as rcu');               
        $this->db->where('rcu.client_id',currentuserinfo()->id);		
		$this->db->where('rcu.status','active');		
        $q = $this->db->get();        
        if ($q->num_rows() > 0) {
            return $q->num_rows();
        } else {
            return false;
        }
    }
	
	/**
     * count_client_feedback_set
     *
     * This function count client feedback sets .
     * 
     * @access	public
     * @param   int - user id
     * @return	mixed Array 
     */
	 
	public function count_client_feedback_set() {       
        $this->db->select('rfs.id');
        $this->db->from('ri_feedback_sets as rfs');               
        $this->db->where('rfs.client_id',currentuserinfo()->id);		
		$this->db->where('rfs.status','active');		
        $q = $this->db->get();        
        if ($q->num_rows() > 0) {
            return $q->num_rows();
        } else {
            return false;
        }
    }
	
	
	/**
     * get_client_feedback_set
     *
     * This function get client feedback sets .
     * 
     * @access	public
     * @param   int - user id
     * @return	mixed Array 
     */
	 
	public function get_client_feedback_set() {
		$client_id = currentuserinfo()->id;
		if($client_id){	
        $this->db->select('rfs.*');
        $this->db->from('ri_feedback_sets as rfs');               
        $this->db->where('rfs.client_id',$client_id);		
		$this->db->where('rfs.status','active');
		$this->db->order_by('rfs.id','desc');		
        $feedback = $this->db->get()->result();
		if(!empty($feedback))
			{
				 $final_array = array();
				 foreach($feedback as $feedback_set_val)
				{
					$this->db->select('rfsq.*');
					$this->db->from('ri_feedback_set_questions as rfsq');						
					$this->db->where('rfsq.ques_status','1');
					$this->db->where('rfsq.feedback_set_id',$feedback_set_val->id);
					$this->db->order_by('rfsq.ques_order','asc');
					$feedback_questions = $this->db->get()->result();
					$final_array[] = array('feedback_set'=>$feedback_set_val,'questions'=>$feedback_questions); 
				}
				return $final_array;
			}
			
		} else {
            return false;
        }
    }
	
	 public function fetch_feedback_responses($feedback_id)
    {
        $this->db->select("rufb.id AS batch_id,rufb.feedback_set_id,rufb.user_id AS CUSTOMER_ID,rufb.happy_percent,rufb.un_happy_percent,rufb.neutral_percent,rufb.created_at ");
        $this->db->from('ri_users_feedback_batch AS rufb');
        // $this->db->join('ri_feedback_set_node_assignment as rfsna','rufb.node_assignment_id=rfsna.id','inner');
        // $this->db->join('ri_client_unit AS rcu', 'rcu.id=rfsna.unit_id','inner');
        // $this->db->join('ri_client_unit_location AS rcul','rcul.client_unit_id=rfsna.unit_id');
        $this->db->where('rufb.feedback_set_id',$feedback_id);
        // $this->db->group_by('rufb.feedback_set_id');
        $q = $this->db->get();
        if ($q->num_rows() > 0) {
            return $q->result();
        } else {
            return false;
        }
    }
	
	
	 public function count_feedback_responses($feedback_id)
    {
        $this->db->select("rufb.id");
        $this->db->from('ri_users_feedback_batch AS rufb');      
        $this->db->where('rufb.feedback_set_id',$feedback_id);        
        $q = $this->db->get();
        if ($q->num_rows() > 0) {
            return $q->num_rows();
        } else {
            return false;
        }
    }
	
	/* */
	public function get_question_response($questions_id,$feedback_set_id = null){
		/* user feedback responses */
		$this->db->select('ruf.*');
		$this->db->from('ri_users_feedback as ruf');		
                if($feedback_set_id != ''){
                    $this->db->join('ri_users_feedback_batch AS rufb', 'rufb.id =  ruf.feedback_batch_id'); 
                    $this->db->where('rufb.feedback_set_id', $feedback_set_id);
                }
		$this->db->where('ruf.feedback_set_question_id',$questions_id);
		$this->db->order_by('ruf.id','desc');
		$q = $this->db->get();
                //echo $this->db->last_query();
		if($q->num_rows()>0){
			return $q->result();
		} else {
			return false;
		}
						
	}
	/**
     * count_client_responses
     *
     * This function count client responses on feedback sets .
     * 
     * @access	public
     * @param   int - user id
     * @return	mixed Array 
     */
	 
	public function count_client_responses() {    
        $this->db->select("count(*) as total_response");
        $this->db->from('ri_client_unit AS rcu');
        $this->db->join('ri_feedback_set_node_assignment AS rfsna' , 'rfsna.unit_id=rcu.id');
        $this->db->join('ri_users_feedback_batch AS rufb','rufb.node_assignment_id=rfsna.id');
        $this->db->where('rcu.client_id',  currentuserinfo()->id);
        $this->db->where('rfsna.status','');
        $this->db->where('rfsna.assignment_status','active');
        
        $q = $this->db->get();
      //  echo $this->db->last_query();die;
        if ($q->num_rows() > 0) {
            return $q->result();
        } else {
            return false;
        }
        
           
        $this->db->select('rfs.id');
        $this->db->from('ri_feedback_sets as rfs'); 
		$this->db->join('ri_users_feedback_batch as rufb','rufb.feedback_set_id=rfs.id','inner');	
        $this->db->where('rfs.client_id',currentuserinfo()->id);		
		$this->db->where('rfs.status','active');		
        $q = $this->db->get();        
        if ($q->num_rows() > 0) {
            return $q->num_rows();
        } else {
            return false;
        }
    }
	
	
	public function get_global_rating_report_data() {  
		$this->db->select('ruf.answer,rufb.feedback_set_id');	
		$this->db->from('ri_users_feedback AS ruf');
		$this->db->join('ri_users_feedback_batch as rufb','rufb.id = ruf.feedback_batch_id','inner');
		$this->db->join('ri_feedback_set_node_assignment as rfsna','rufb.node_assignment_id = rfsna.id','inner');	
		$this->db->where('rfsna.client_id',currentuserinfo()->id);   
        $q =  $this->db->get();
        if ($q->num_rows() > 0) {
            return $q->result();
        } else {
            return false;
        }       
    }
    
	
    /* End of function */
    
    
    
    
    public function fetch_client_assigned_cic_unit()
    {
        //SELECT `rcu`.`id` FROM `ri_client_unit` AS `rcu` INNER Join `ri_feedback_set_node_assignment` AS `rfsna` on `rfsna`.`unit_id`=`rcu`.`id` where `rcu`.`client_id`=62 group by `rcu`.`id``
        $this->db->select("rcu.id,rcu.unit_name");
        $this->db->from('ri_client_unit AS rcu');
        $this->db->join('ri_feedback_set_node_assignment AS rfsna' , 'rfsna.unit_id=rcu.id');
        $this->db->where('rcu.client_id',  currentuserinfo()->id);
        $this->db->group_by('rcu.id');
        $q = $this->db->get();
        if ($q->num_rows() > 0) {
            return $q->result();
        } else {
            return false;
        }
    }
    
    public function fetch_active_cic_for_client()
    {
        //SELECT `rcu`.`id` FROM `ri_client_unit` AS `rcu` INNER Join `ri_feedback_set_node_assignment` AS `rfsna` on `rfsna`.`unit_id`=`rcu`.`id` where `rcu`.`client_id`=62 group by `rcu`.`id``
        //$this->db->select("rcu.id,rcu.unit_name,rfsna.item_id_id");
        $this->db->select("count(*) as total_cic");
        $this->db->from('ri_client_unit AS rcu');
        $this->db->join('ri_feedback_set_node_assignment AS rfsna' , 'rfsna.unit_id=rcu.id');
        $this->db->where('rcu.client_id',  currentuserinfo()->id);
        $this->db->where('rfsna.status','');
        $this->db->where('rfsna.assignment_status','active');
        //echo $this->db->last_query();
        $q = $this->db->get();
        if ($q->num_rows() > 0) {
            return $q->result();
        } else {
            return false;
        }
    }
	
	 public function fetch_unit_wise_responses_dashboard($unit_id=null)
    {        
        $this->db->select("rufb.id AS batch_id,rcu.country_id,rfsna.unit_id,rufb.feedback_set_id,rufb.user_id AS CUSTOMER_ID,rufb.happy_percent,rufb.un_happy_percent,rufb.neutral_percent,rufb.created_at,rfsna.client_id,rfsna.item_id_id AS CIC_MAP_ID");
        $this->db->from('ri_users_feedback_batch AS rufb');
        $this->db->join('ri_feedback_set_node_assignment as rfsna','rufb.node_assignment_id=rfsna.id','inner');
        $this->db->join('ri_client_unit AS rcu', 'rcu.id=rfsna.unit_id','inner');
        $this->db->join('ri_client_unit_location AS rcul','rcul.client_unit_id=rfsna.unit_id');
        if($unit_id)
        {
            $this->db->where('rfsna.unit_id',$unit_id);
        }
		$this->db->where('rcu.client_id',currentuserinfo()->id);
        $this->db->group_by('rufb.id');
        $q = $this->db->get();
        if ($q->num_rows() > 0) {
            return $q->result();
        } else {
            return false;
        }
    }
	
	
	
    public function fetch_unit_wise_responses($unit_id=null)
    {        
        $this->db->select("rufb.id AS batch_id,rcu.country_id,rfsna.unit_id,rufb.feedback_set_id,rufb.user_id AS CUSTOMER_ID,rufb.happy_percent,rufb.un_happy_percent,rufb.neutral_percent,rufb.created_at,rfsna.client_id,rfsna.item_id_id AS CIC_MAP_ID");
        $this->db->from('ri_users_feedback_batch AS rufb');
        $this->db->join('ri_feedback_set_node_assignment as rfsna','rufb.node_assignment_id=rfsna.id','inner');
        $this->db->join('ri_client_unit AS rcu', 'rcu.id=rfsna.unit_id','inner');
        $this->db->join('ri_client_unit_location AS rcul','rcul.client_unit_id=rfsna.unit_id');
        if($unit_id)
        {
            $this->db->where('rfsna.unit_id',$unit_id);
        }
        $this->db->group_by('rufb.id');
        $q = $this->db->get();
        if ($q->num_rows() > 0) {
            return $q->result();
        } else {
            return false;
        }
    }
    
    public function fetch_unit_wise_responses_for_nps($unit_id=null)
    {
        //SELECT `rufb`.id AS batch_id,`rcu`.`country_id`,`rfsna`.`unit_id`,`rufb`.`feedback_set_id`,`rufb`.`user_id` AS CUSTOMER_ID,`rufb`.`happy_percent`,`rufb`.`un_happy_percent`,`rufb`.`neutral_percent`,`rufb`.`created_at`,`rfsna`.`client_id`,`rfsna`.`item_id_id` AS CIC_MAP_ID FROM `ri_users_feedback_batch` AS `rufb` inner join `ri_feedback_set_node_assignment` as `rfsna` on `rufb`.`node_assignment_id`=`rfsna`.`id` INNER JOIN `ri_client_unit` AS `rcu` on  `rcu`.`id`=`rfsna`.`unit_id`  INNER JOIN `ri_client_unit_location` AS `rcul` ON `rcul`.`client_unit_id`=`rfsna`.`unit_id` where `rfsna`.`unit_id`='26' group by `rufb`.`id``
        $this->db->select("runf.answer,rufb.id AS batch_id,rcu.country_id,rfsna.unit_id,rufb.feedback_set_id,rufb.user_id AS CUSTOMER_ID,rufb.happy_percent,rufb.un_happy_percent,rufb.neutral_percent,rufb.created_at,rfsna.client_id,rfsna.item_id_id AS CIC_MAP_ID");
        $this->db->from('ri_users_feedback_batch AS rufb');
        $this->db->join('ri_feedback_set_node_assignment as rfsna','rufb.node_assignment_id=rfsna.id','inner');
        $this->db->join('ri_client_unit AS rcu', 'rcu.id=rfsna.unit_id','inner');
        $this->db->join('ri_client_unit_location AS rcul','rcul.client_unit_id=rfsna.unit_id');
        $this->db->join('ri_users_nps_feedback AS runf','runf.feedback_batch_id=rufb.id');
        if($unit_id)
        {
            $this->db->where('rfsna.unit_id',$unit_id);
        }
        $this->db->group_by('rufb.id');
        $q = $this->db->get();
        if ($q->num_rows() > 0) {
            return $q->result();
        } else {
            return false;
        }
    }
	
	
	public function fetch_unit_wise_nps_responses_for_dashboard($unit_id=null)
    {        
        $this->db->select("runf.answer,rufb.id AS batch_id,rcu.country_id,rfsna.unit_id,rufb.feedback_set_id,rufb.user_id AS CUSTOMER_ID,rufb.happy_percent,rufb.un_happy_percent,rufb.neutral_percent,rufb.created_at,rfsna.client_id,rfsna.item_id_id AS CIC_MAP_ID");
        $this->db->from('ri_users_feedback_batch AS rufb');
        $this->db->join('ri_feedback_set_node_assignment as rfsna','rufb.node_assignment_id=rfsna.id','inner');
        $this->db->join('ri_client_unit AS rcu', 'rcu.id=rfsna.unit_id','inner');
        $this->db->join('ri_client_unit_location AS rcul','rcul.client_unit_id=rfsna.unit_id');
        $this->db->join('ri_users_nps_feedback AS runf','runf.feedback_batch_id=rufb.id');
        if($unit_id)
        {
            $this->db->where('rfsna.unit_id',$unit_id);
        }
		$this->db->where('rcu.client_id',currentuserinfo()->id);
        $this->db->group_by('rufb.id');
        $q = $this->db->get();
        if ($q->num_rows() > 0) {
            return $q->result();
        } else {
            return false;
        }
    }
}

?>
