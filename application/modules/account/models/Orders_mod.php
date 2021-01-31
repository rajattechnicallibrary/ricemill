<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Orders Model 
 *
 * @package		Orders
 * @subpackage	Orders
 * @category	Orders
 * @author      Dharmendra Pal
 * @website		http://www.thealternativeaccount.com
 * @company     thealternativeaccount Inc
 * @since		Version 1.0
 */
class Orders_mod extends CI_Model {
    var $tbl_order          = "fs_order";
    var $tbl_order_details  = "fs_order_details";
    var $tbl_users          = "fs_users";
    var $tbl_users_details  = "fs_users_details";

    /**
     * Constructor
     */
    function __construct() {
        parent::__construct();
    }
    //==================================================================================================================
    // orders_list_ajax
    //==================================================================================================================
    
    /**
     * orders_list_ajax
     *
     * this function update user profile info by user id
     * @access	public
     * @return array
     */
	public function get_myorders($per_page = null, $page = null){
		 $this->db->select("SQL_CALC_FOUND_ROWS o.id,o.user_id,o.vendor_id,o.delivery_time,o.delivery_date,o.delivery_charge,o.final_amount,concat(u.first_name,' ',u.last_name) as vendor_name,u.profile_image,ud.logo_image,ud.food_joint_name,os.order_type as order_status,(SELECT group_concat(name) as cuisine_catgory FROM fs_cuisine_category as cc LEFT JOIN fs_user_cuisine_category_mapping as uccm ON cc.id=uccm.cuisine_cat_id WHERE o.vendor_id=uccm.user_id GROUP BY uccm.user_id) as cuisine_catgory", false);
        $this->db->from(" $this->tbl_order as o");
        $this->db->join(" $this->tbl_users as u","u.id=o.vendor_id","inner");
        $this->db->join(" $this->tbl_users_details as ud","ud.user_id=o.vendor_id","inner");
        $this->db->join(" fs_order_status as os","os.id=o.status","inner");		
		$this->db->where("o.user_id",currentuserinfo()->id);
		$this->db->limit($per_page, ($page * $per_page));
		$this->db->order_by('o.id','desc');
		$query = $this->db->get();
		$count = $this->db->query("SELECT FOUND_ROWS() AS count")->row('count');
		//echo $this->db->last_query(); die;
		if($query->num_rows()>0){
			$data['status'] 		= 'success';
			$data['total_row'] 		= $count;
			$data['result'] 		= $query->result();			
			return $data;			
		} else {
			return false;
		}		
	}


	 /**
     * orders_list_ajax
     *
     * this function update user profile info by user id
     * @access	public
     * @return array
     */
    function orders_list_ajax($filter){	
        $this->db->select("SQL_CALC_FOUND_ROWS o.*,concat(u.first_name,' ',u.last_name) as buyer,ud.food_joint_name,os.order_type as order_status", false);
        $this->db->from(" $this->tbl_order as o");
        $this->db->join(" $this->tbl_users as u","u.id=o.user_id","inner");
        $this->db->join(" $this->tbl_users_details as ud","ud.user_id=o.vendor_id","inner");
        $this->db->join(" fs_order_status as os","os.id=o.status","inner");		
		
		if(currentuserinfo()->user_type ==3){			
        $this->db->where("o.vendor_id",currentuserinfo()->id);
		}
		
        $columns = array('o.id','ud.food_joint_name','u.first_name','u.last_name','o.status');
        if (isset($filter['search']['value']) && $filter['search']['value']!=''){
                
            $search_keyboard    =   $filter['search']['value'];
            $search_keyboard=strtolower($search_keyboard);
            $str = "";
            $str = $str."(LOWER(ud.food_joint_name) LIKE '$search_keyboard%' OR LOWER(o.status) LIKE '$search_keyboard%' OR LOWER(u.first_name) LIKE '$search_keyboard%' OR LOWER(u.last_name) LIKE '$search_keyboard%')";
            $this->db->where($str);    
        }
        
        if(isset($filter['order'][0]['column']) &&  $filter['order'][0]['column']!='' && isset($filter['order'][0]['dir']) && $filter['order'][0]['dir']!='' && isset($filter['length']) && $filter['length']!='' && isset($filter['start']) && $filter['start']!=''){
            $this->db->order_by($columns[$filter['order'][0]['column']], $filter['order'][0]['dir']);
            if ($filter['length'] != '-1') {  // for showing all records
                $this->db->limit($filter['length'], $filter['start']);
            }
        }
		
		if(isset($filter['order_by'])==1){
			if(isset($filter['start_date']) && @$filter['start_date']!=''){
				$start_date = correct_date($filter['start_date']);            
				 $this->db->where("date(o.created_date) >=",$start_date);
			}
			if(isset($filter['end_date'])&& $filter['end_date']!=''){
				$end_date = correct_date($filter['end_date']);         				
				$this->db->where("date(o.created_date) <=",$end_date);

			}
		}
		
		if(isset($filter['order_by'])==2){
			if(isset($filter['start_date']) && @$filter['start_date']!=''){
				$start_date = correct_date($filter['start_date']);            				 
				 $this->db->where("date(o.delivery_date) >=",$start_date);
			}
			if(isset($filter['end_date'])&& $filter['end_date']!=''){
				$end_date = correct_date($filter['end_date']);         
				$this->db->where("date(o.delivery_date) <=",$end_date);

			}	
		}		
		if(isset($filter['food_joint_id']) && @$filter['food_joint_id']!=''){
             $this->db->where("o.vendor_id ",ID_decode($filter['food_joint_id']));
        }
		
		 if(isset($filter['lattitude']) && $filter['lattitude'] !='' && isset($filter['longitude']) && $filter['longitude'] !=''){
            $this->db->where("o.delivery_lattitude ",$filter['lattitude']);
            $this->db->where("o.delivery_longitude ",$filter['longitude']);
		}
		
		 if(isset($filter['status']) && $filter['status']!=''){
             $this->db->where("o.status",ID_decode($filter['status']));
        }	
		    
        $query = $this->db->get();
	//echo $this->db->last_query();die;
        if ($query->num_rows() > 0) {
            
                $res['result']=$query->result();
                $total_record           =   $this->db->query('SELECT FOUND_ROWS() AS count');
                $res['totalData']       =   $total_record->row()->count;
                $res['totalFiltered']   =   $total_record->row()->count; 
                $res['status']="success";
            

            //---------------------- 
        } else {

            $res['result']          =   '';
            $res['totalData']       =   0;  
            $res['totalFiltered']       =   0; 
            $res['status']          =   "error";
        }
        return $res;
    }
    
    
     /**
     * view
     *
     * this function to get view
     * @access	public
     * @return array
     */
	 
	 public function order_details($order_id){
		$this->db->select('o.id,o.created_date,o.total_amount,o.delivery_date,o.delivery_time,o.vendor_discount_amount,o.tax_amount,o.delivery_charge,o.final_amount,o.status,u.first_name,u.last_name,u.mobile_number,ua.address,ua.zipcode,st.name as state_name,
							ci.name as city_name,ud.food_joint_name,ud.delivery_estimated_time,ud.landline_number ,ud.alternate_number,os.order_type,o.cancel_reason');
        $this->db->from('fs_order as o');
		$this->db->join('fs_users as u','o.user_id = u.id','inner');
		$this->db->join('fs_user_addresses as ua','o.address_id = ua.id','inner');
		$this->db->join('fs_state as st','ua.state_id = st.id','inner');
		$this->db->join('fs_city as ci','ua.city_id = ci.id','inner');
		$this->db->join('fs_users_details as ud','o.vendor_id=ud.user_id','inner');
		$this->db->join('fs_order_status as os','o.status=os.id','inner');
		$this->db->where('o.id',$order_id);
		
        $query = $this->db->get();		
		if($query->num_rows() > 0)
		{
			return $query->row();
		}else{
			return false;
		}
	}
	
	public function cancel_order($order_id,$reason){
		$order_id = ID_decode($order_id);
		$upd['status']	=	'5';
		$upd['cancel_reason']	=	$reason;
		$upd['cancel_by']	=	currentuserinfo()->id;
		$this->db->where('id',$order_id);
		$this->db->update('fs_order',$upd);
		$data['status']	=	'success';
		return $data;
	}
	
	public function order_summary($order_id){
		$this->db->select('mv.menu_varient_name,od.*');
		$this->db->from('fs_order_details as od');
		$this->db->join('fs_menu_varient as mv','od.menu_varient_id = mv.id','left');
		$this->db->where('od.order_id',$order_id);
		$query = $this->db->get();
		if($query->num_rows() > 0){
			return $query->result();
		}else{
			return false;
		}
	}

	/**
     * order_status
     *
     * this function to get order status
     * @access	public
     * @return array
     */
	 
	 public function order_status(){
		$this->db->select('*');        
        $query = $this->db->get('fs_order_status');
        if($query->num_rows() > 0)
		{
			return $query->result();
		}else{
			return false;
		}
	}

	
}

// end class
?>