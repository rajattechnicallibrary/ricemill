<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Sale Model 
 *
 * @package		AUTHORIZED PAYMENTS
 * @subpackage	Models
 * @category	AUTHORIZED PAYMENTS
 * @author      dharmendra Pal
 * @website		http://www.thealternativeaccount.com
 * @company     thealternativeaccount Inc
 * @since		Version 1.0
 */
class Sale_mod extends CI_Model {

    var $user_table = "users";

    /**
     * Constructor
     */
    function __construct() {
        parent::__construct();
    }

	/*End of function*/
    public function fetch_attr_data($sku_id)
    {
        $query = "SELECT `ria`.`name` AS ATTR_NAME,`riav`.`name` AS ATTR_VAL,`rimam`.`attribute_id`,`rimam`.`attribute_val_id` FROM `ri_item_master_sku_mapping` as `rism` INNER JOIN `ri_item_master_attributes_mapping` AS `rimam` ON `rism`.`attr_mapping_id`=`rimam`.`id` LEFT JOIN `ri_item_attributes` AS `ria` ON `ria`.`id`=`rimam`.`attribute_id` LEFT JOIN `ri_item_attribute_value` AS `riav` ON `riav`.`id`=`rimam`.`attribute_val_id` where `rism`.`sku_id`=$sku_id";
        $query1 = $this->db->query($query);
        if ($query1->num_rows() > 0) {
            return $result = $query1->result_array();
        } else {
            return false;
        }
    }
    /**
     * product_detail
     *
     * This function fetch listing of orders
     * 
     * @access	public
     * @param   int - order id
     * @return	 Array 
     */
	
	
	
    function product_detail() {
        
        $this->db->select('*');
        $this->db->from('ri_client_orders');
        $this->db->where('payment_status', '');
        $this->db->where('(payment_type = "neft" OR payment_type ="cheque")');        
        if(@$this->input->get('countryname'))
        {
            $this->db->where('demographic_country_id',@$this->input->get('countryname'));
        }
        $this->db->order_by('id', 'desc');
        $order_detail = $this->db->get()->result();
        if (!empty($order_detail)) {
            $final_array = array();
            foreach ($order_detail as $order) {
                $this->db->select('rco.id,rco.client_order_id,rco.item_id,rco.sku_id,rco.quantity,rco.sale_price,rco.tax_id,rco.total_cost,sku.sku,sku_map.attr_mapping_id,im.name,im.code,img.image');
                $this->db->from('ri_client_order_items as rco');
                $this->db->join('ri_item_master_sku_price as sku', 'sku.id = rco.sku_id', 'left');
                $this->db->join('ri_item_master as im', 'im.id = rco.item_id', 'left');
                $this->db->join('ri_item_master_sku_mapping sku_map', 'sku_map.sku_id = rco.sku_id');
                $this->db->join('ri_item_master_images img', 'img.item_attr_mapping_id = sku_map.attr_mapping_id', 'left');
                $this->db->where('rco.client_order_id', $order->id);
                $this->db->where('img.is_featured_image', 'y');
				$product_detail = $this->db->get()->result();
                /* fetch shipping cost of item */
                $this->db->select('rco.id,rco.client_order_id,rco.shipping_cost');
                $this->db->from('ri_client_order_shipping as rco');
                $this->db->where('rco.client_order_id', $order->id);
                $shipping_cost = $this->db->get()->result();
                $final_array[] = array('order_detail' => $order, 'product_detail' => $product_detail, 'shipping_cost' => $shipping_cost);
            }
            return $final_array;
        }
    }

	
	/*End of function*/
   
   /*

     *  order_tax 
     *  this function is used to fetch tax values
     *  @access public 
     *  @mixedArray
     */

    public function order_tax($countryid) {
        $this->db->select('taxtype.id as TXT_TYPE_ID,taxparameter.parameter,taxparameter.parameter_rate,taxactive.id as TAX_ACTV_ID');
        $this->db->from('ri_tax_type as taxtype');
        $this->db->join('ri_tax_type_country_mapping_id as taxmap', 'taxtype.id=taxmap.tax_type_id', 'left');
        $this->db->join('ri_tax_parameter as taxparameter', 'taxmap.id=taxparameter.tax_mapping_id', 'left');
        $this->db->join('ri_active_taxes as taxactive', 'taxmap.id=taxactive.tax_type_country_mapping_id', 'left');
        $this->db->where('taxmap.country_id', $countryid);
        $this->db->where('taxactive.entry_type', 'new');
        $this->db->where('taxactive.status', 'active');
        $q = $this->db->get();
        if ($q->num_rows() > 0) {
            return $q->result_array();
        } else {
            return false;
        }
    }

   /*End of function*/
   
   /*

     *  fetch_orders 
     *  this function is used to fetch orders by client id
     *  @access public 
     *  @mixedArray
     */
    function fetch_orders($client_id) {
        $sql = "SELECT `rco`.*,`rcio`.`item_id`,`rim`.`name` AS ITEM_NAME,`rimsp`.`sku` AS SKU,`rcio`.`quantity` AS QUANTITY,`rcio`.`sale_price` AS SALE_PRICE FROM `ri_client_orders` AS `rco` INNER JOIN `ri_client_order_items` AS `rcio` on `rco`.`id`=`rcio`.`client_order_id` INNER JOIN `ri_item_master` AS `rim` ON `rim`.`id`=`rcio`.`item_id` INNER JOIN `ri_item_master_sku_price` AS `rimsp` on `rimsp`.`id`=`rcio`.`id` WHERE `rco`.`client_id`=" . $client_id . "";
        $query_rs = $this->db->query($sql);
        if ($query_rs->num_rows() > 0) {
            return $result = $query_rs->result_array();
        } else {
            return false;
        }
    }
/* end of function */
    /**
     * get_client_rate_it
     * fetch client rate it package
     * @access public
     * @mixed Array
     */
    public function get_client_rate_it($order_id) {

        $this->db->select('rco.id,rco.client_order_id,rco.item_id,rco.sku_id,rco.quantity,rco.sale_price,rco.tax_id,rco.total_cost,sku.sku,sku_map.attr_mapping_id,im.name,im.code,img.image');
        $this->db->from('ri_client_order_items as rco');
        $this->db->join('ri_item_master_sku_price as sku', 'sku.id = rco.sku_id', 'left');
        $this->db->join('ri_item_master as im', 'im.id = rco.item_id', 'left');
        $this->db->join('ri_item_master_sku_mapping sku_map', 'sku_map.id = rco.sku_id');
        $this->db->join('ri_item_master_images img', 'img.item_attr_mapping_id = sku_map.attr_mapping_id', 'left');
        $this->db->where('rco.client_order_id', $order_id);
        $q = $this->db->get();
        if ($q->num_rows() > 0) {
            return $q->result();
        } else {
            return false;
        }
    }
	
	/* end of function */
    
	/**
     * get_authontication_package
     * fetch client authontication package
     * @access public
     * @mixed Array
     */
    
	public function get_authontication_package($authontication_id) {

        $this->db->select('authontication_pkg.*');
        $this->db->from('ri_authentication_packages as authontication_pkg');
        $this->db->where('authontication_pkg.id', $authontication_id);
        $q = $this->db->get();
        if ($q->num_rows() > 0) {
            $data = $q->result();
            foreach ($data as $key => $val) {
                $data1[] = $val;
                return $data1;
            }
        } else {
            return false;
        }
    }
	/* end of the function */
    /**
     * get_sku_client
     *
     * This function to fetch sku and price values 
     * 
     * @access	public
     * @return	mixed Array 
     */
    public function get_sku_client($country_id, $item_id = null) {

        $this->db->select('rate_matrix.*,skumaster.sku');
        $this->db->from('ri_rate_matrix as rate_matrix');
        $this->db->join('ri_item_master_sku_price as skumaster', 'rate_matrix.item_sku_id = skumaster.id', 'left');
        $this->db->where('rate_matrix.demograph_country_id', $country_id);
        if (!empty($item_id)) {
            $this->db->where('rate_matrix.item_id', $item_id);
        }
        $q = $this->db->get();
        if ($q->num_rows() > 0) {
            return $q->result_array();
        } else {
            return false;
        }
    }

	/* end of the function */
    /**
     * order_detail
     *
     * This function to fetch order details
     * 
     * @access	public
     * @return	mixed Array 
     */
	
    function order_detail($id) {

        $client_id = currentuserinfo()->id;
        if (!empty($id)) {
            $this->db->select('*');
            $this->db->from('ri_client_orders');
            $this->db->where('id', $id);
            $this->db->where('client_id', $client_id);
            $this->db->order_by('id', 'desc');
            $order_detail = $this->db->get()->result();
            if (!empty($order_detail)) {
                $final_array = array();
                foreach ($order_detail as $order) {
                    $this->db->select('attrval.name as colorname,rco.id,rco.client_order_id,rco.item_id,rco.sku_id,rco.quantity,rco.sale_price,rco.tax_id,rco.total_cost,sku.sku,sku_map.attr_mapping_id,im.name,im.code,img.image');
                    $this->db->from('ri_client_order_items as rco');
                    $this->db->join('ri_item_master_sku_price as sku', 'sku.id = rco.sku_id', 'left');
                    $this->db->join('ri_item_master as im', 'im.id = rco.item_id', 'left');
                    $this->db->join('ri_item_master_sku_mapping sku_map', 'sku_map.id = rco.sku_id');
                    $this->db->join('ri_item_master_images img', 'img.item_attr_mapping_id = sku_map.attr_mapping_id', 'left');
                    $this->db->join('ri_item_master_attributes_mapping itmattr', 'sku_map.attr_mapping_id = itmattr.id', 'left');
                    $this->db->join('ri_item_attribute_value attrval', 'itmattr.attribute_val_id = attrval.id', 'left');
                    $this->db->join('ri_item_attributes attr', 'attrval.attribute_id = attr.id', 'left');
                    $this->db->where('rco.client_order_id', $order->id);

                    // $this->db->where('img.is_featured_image','y');
                    $q = $this->db->get();
                    $product_detail = $q->result();
                    /* fetch shipping cost of item */
                    $this->db->select('rco.id,rco.client_order_id,rco.item_id,rco.shipping_unit_id,rco.item_sku,rco.shipping_cost,rco.quantity,sku.sku,im.name,sku_map.attr_mapping_id,attrval.name as colorname');
                    $this->db->from('ri_client_order_shipping as rco');
                    $this->db->join('ri_item_master_sku_price as sku', 'sku.id = rco.item_sku', 'left');
                    $this->db->join('ri_item_master as im', 'im.id = rco.item_id', 'left');
                    $this->db->join('ri_item_master_sku_mapping sku_map', 'sku_map.id = rco.item_sku');
                    $this->db->join('ri_item_master_attributes_mapping itmattr', 'sku_map.attr_mapping_id = itmattr.id', 'left');
                    $this->db->join('ri_item_attribute_value attrval', 'itmattr.attribute_val_id = attrval.id', 'left');
                    $this->db->join('ri_item_attributes attr', 'attrval.attribute_id = attr.id', 'left');
                    $this->db->where('rco.client_order_id', $order->id);

                    $q1 = $this->db->get();
                    $shipping_cost = $q1->result();

                    $final_array[] = array('order_detail' => $order, 'product_detail' => $product_detail, 'shipping_cost' => $shipping_cost);
                }

                return $final_array;
            }
        } else {
            $return['error'] = 'invalide request';
            return $return;
        }
    }

    /**
     * End
     */

    /**
     * fetch_billing_info_data
     *
     * This function to fetch billing info data of client
     * 
     * @access	public
     * @return	mixed Array 
     */
    public function fetch_billing_info_data($client_id, $country_id) {

        $sql = "SELECT rcbi.*,group_concat(`rdv`.`name`)AS LOCATION FROM  ri_client_billing_info_location AS rcbil join `ri_demographic_value` AS `rdv` ON `rdv`.`id`= `rcbil`.`demographic_structure_val_id` left join `ri_client_billing_info` AS rcbi ON `rcbil`.`billing_info_id`=`rcbi`.`id` WHERE `rcbi`.`client_id` = '" . $client_id . "' AND `rcbi`.`country_id` = '" . $country_id . "'";
        $result = $this->db->query($sql);
        if ($result->num_rows() > 0) {
            return $result->result()[0];
        } else {
            return false;
        }
    }

	/* end of the function */
	
    /**
     * fetch_shipping_carriers
     *
     * This function to fetch all authentication packages
     * 
     * @access	public
     * @return	mixed Array 
     */
    public function fetch_shipping_carriers($country_id) {
        $this->db->select("*");
        $this->db->where('country_id', $country_id);
        $result = $this->db->get("ri_shipping_carriers");
        if ($result->num_rows() > 0) {
            return $result->result();
        } else {
            return false;
        }
    }

	/* end of the function */
	
    /**
     * fetch_shipping_unit_by_id
     *
     * This function to fetch unit info by Id
     * 
     * @access	public
     * @return	mixed Array 
     */
    public function fetch_shipping_unit_by_id($unit_id) {
        $sql = "SELECT rcu.*,group_concat(rdv.name) AS ADDRESS FROM  `ri_client_unit_location` AS `rcul` JOIN `ri_demographic_value` AS `rdv` ON `rdv`.`id`= `rcul`.`demographic_structure_val_id` left Join  `ri_client_unit` AS `rcu` ON `rcu`.`id`=`rcul`.`client_unit_id` WHERE `rcu`.`id` = '" . $unit_id . "' group by `rcu`.`id`";
        $query1 = $this->db->query($sql);
        if ($query1->num_rows() > 0) {
            return $result = $query1->row();
        } else {
            return false;
        }
    }

	
	/* end of the function */
	
    /**
     * rate_it_sku
     *
     * This function to fetch rate it sku code 
     * 
     * @access	public
     * @return	mixed Array 
     */
	
    public function rate_it_sku($rait_sku_id) {
        $this->db->select('sku');
        $this->db->from('ri_item_master_sku_price');
        $this->db->where('id', $rait_sku_id);
        $q = $this->db->get();
        if ($q->num_rows() > 0) {
            return $q->result();
        } else {
            return false;
        }
    }
	
    /* end of the function */
    /**
     * get_cheque_and_neft_data 
     * this function is used get cheque and neft data
	 * @access	public
     * @return	mixed Array 
     */
	 
    public function get_cheque_and_neft_data($order_id)
    {
        $this->db->select('rcnd.*,rco.demographic_country_id,rco.grand_total_amount,rc.name as CURRENCY_NAME,rc.code,rc.symbol');
        $this->db->from('ri_cheque_neft_data as rcnd');
        $this->db->join('ri_client_orders as rco','rco.id = rcnd.order_id','left');
        $this->db->join('ri_currency as rc','rco.demographic_country_id = rc.country_id','left');
        $this->db->where('rcnd.order_id',$order_id);
        $this->db->where('rcnd.status =','');
        $q = $this->db->get();
        if($q->num_rows()>0){
            return $q->result();
        } else {
            return false;
        }
    }
	
	/* end of the function */
    /**
     * get_cheque_and_neft_data 
     * this function is used get cheque and neft data
     * @access	public
     * @return	mixed Array 
	 */
	
	public function get_authentication_id($order_id){
		$this->db->select('client_id,authentication_id');
		$this->db->from('ri_client_orders');
		$this->db->where('id',$order_id);
		$q = $this->db->get();
		if($q->num_rows()>0){
			return $q->result();
		} else {
			return false;
		}
	}
	
	/* end of the function */
	 /**
     * get_authentication_response
     *
     * This function to fetch all authentication packages
     * 
     * @access	public
     * @return	mixed Array 
     */
    public function get_authentication_response($authentication_id) {
        $this->db->select("*");
        $this->db->where('id', $authentication_id);
        $result = $this->db->get("ri_authentication_packages");
        if ($result->num_rows() > 0) {
            return $result->result();
        } else {
            return false;
        }
    }
	
	/* end of the function */
	
	/**
     * get_user_response
     *
     * This function to fetch users responses
     * 
     * @access	public
     * @return	mixed Array 
     */
    public function get_user_response($client_id) {
        $this->db->select("package_response");
        $this->db->where('id',$client_id);
        $result = $this->db->get("users");
        if ($result->num_rows() > 0) {
            return $result->result();
        } else {
            return false;
        }
    }
	
	
	/* end of the function */
	
	/**
     * get_order_detail_byId
     *
     * This function to fetch order details by order id for sale module
     * 
     * @access	public
     * @return	mixed Array 
     */
	 
	function get_order_detail_byId($id)
	{			
		if(!empty($id)){
			$this->db->select('*');
			$this->db->from('ri_client_orders');
			$this->db->where('id',$id);			
            $this->db->order_by('id','desc');
			$order_detail = $this->db->get()->result();
			if(!empty($order_detail))
			{  
                $final_array = array();
         		foreach($order_detail as $order)
				{
					 $this->db->select('attrval.name as colorname,rco.id,rco.client_order_id,rco.item_id,rco.sku_id,rco.quantity,rco.sale_price,rco.tax_id,rco.total_cost,sku.sku,sku_map.attr_mapping_id,im.name,im.code,img.image');
					 $this->db->from('ri_client_order_items as rco');
					 $this->db->join('ri_item_master_sku_price as sku', 'sku.id = rco.sku_id', 'left');
					 $this->db->join('ri_item_master as im', 'im.id = rco.item_id', 'left');
					 $this->db->join('ri_item_master_sku_mapping sku_map', 'sku_map.id = rco.sku_id');
					 $this->db->join('ri_item_master_images img', 'img.item_attr_mapping_id = sku_map.attr_mapping_id','left');
					 $this->db->join('ri_item_master_attributes_mapping itmattr', 'sku_map.attr_mapping_id = itmattr.id','left');
					 $this->db->join('ri_item_attribute_value attrval', 'itmattr.attribute_val_id = attrval.id','left');
					 $this->db->join('ri_item_attributes attr', 'attrval.attribute_id = attr.id','left');
					 $this->db->where('rco.client_order_id',$order->id);					
					$this->db->where('img.is_featured_image','y');
					 $q 				= $this->db->get();					
					 $product_detail 	= $q->result();					
					 /* fetch shipping cost of item */
					 $this->db->select('rco.id,rco.client_order_id,rco.item_id,rco.shipping_unit_id,rco.item_sku,rco.shipping_cost,rco.quantity,sku.sku,im.name,sku_map.attr_mapping_id,attrval.name as colorname');
					 $this->db->from('ri_client_order_shipping as rco');
					 $this->db->join('ri_item_master_sku_price as sku', 'sku.id = rco.item_sku', 'left');
					 $this->db->join('ri_item_master as im', 'im.id = rco.item_id', 'left');
					 $this->db->join('ri_item_master_sku_mapping sku_map', 'sku_map.id = rco.item_sku');	
					 $this->db->join('ri_item_master_attributes_mapping itmattr', 'sku_map.attr_mapping_id = itmattr.id','left');
					 $this->db->join('ri_item_attribute_value attrval', 'itmattr.attribute_val_id = attrval.id','left');
					 $this->db->join('ri_item_attributes attr', 'attrval.attribute_id = attr.id','left');
					 $this->db->where('rco.client_order_id',$order->id);
					 
					 $q1 				= $this->db->get();					 
					$shipping_cost		= $q1->result();	
					 
					 $final_array[] = array('order_detail'=>$order,'product_detail'=>$product_detail,'shipping_cost' =>$shipping_cost); 
					
				}
				
				return $final_array;
   	
			}

		}else {
		$return['error'] ='invalide request';
		return $return;
		}
	}

	/* end of the function */
	
	/**
     * fetch_client_info_by_client_id
     *
     * This function to fetch client information using client id
     * 
     * @access	public
     * @return	html data
     */
    public function fetch_client_info_by_client_id($client_id) {
		
		$userid = $client_id;
		$sql    =   "SELECT rcit.*,rd.county_name,(SELECT name FROM ri_industry WHERE id = u.industry) AS INDUSTRY_NAME ,u.* FROM  (SELECT rcit.client_id,group_concat(rit.name separator ', ') as industry_tag_name FROM ri_client_industry_tags as rcit left join ri_industry_tags as rit on rit.id=rcit.industry_tag_id where rcit.client_id='".$userid."' group by rcit.client_id) as rcit left join (SELECT rcdc.client_id, GROUP_CONCAT( rdc.name separator ', ') as county_name
		FROM ri_client_demographic_country AS rcdc
		LEFT JOIN ri_demographic_country AS rdc ON rdc.id = rcdc.demographic_country_id
		WHERE rcdc.client_id =  '".$userid."'
		GROUP BY rcdc.client_id) as rd on rd.client_id=rcit.client_id left join users as u on u.id=rcit.client_id where rcit.client_id='".$userid."'";
        $clientinfo =   $this->db->query($sql)->result();		
        return $clientinfo;		
    }

	
    /* End of function */
	
	
	
	
}

// end class
?>