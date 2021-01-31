<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Auth Model 
 *
 * @package		Auth
 * @subpackage	Models
 * @category	Authentication 
 * @author		Arvind Soni
 * @website		http://www.thealternativeaccount.com
 * @company     thealternativeaccount Inc
 * @since		Version 1.0
 */
class Pages_mod extends CI_Model {

    var $user_table = "fs_users";

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
     * get_about_us
     *
     * This function get user details filtered by id
     * 
     * @access	public
     * @param   int - user id
     * @return	mixed Array 
     */
    public function get_content($page_id) {
        $this->db->select("id,name,content,title");
        $this->db->from("fs_cms");
        $this->db->where("id",$page_id);
        $this->db->where("status","active");
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->row();
        }
        return false;
    }  
}

?>