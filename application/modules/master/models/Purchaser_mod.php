<?php

class Purchaser_mod extends CI_Model {

    function __construct() {
        parent::__construct();
    }

//THIS FUNCTION ADD COLOR1
    public function add($data) {
      //  pr($data);    die;           
        if ($this->db->insert("aa_purchaser_name", $data)) {
            return true;
        }
    }

//THIS FUNCTION GET city AND SUBcity DATA
    function getdata($attributes, $parent_id = "") {

        $CI = &get_instance();
        $CI->db->select($attributes);
        $CI->db->from('aa_purchaser_name');
        $CI->db->where('status', 'Active');

        $query = $CI->db->get();
        if ($query->num_rows()) {
            return $query->result();
        }
        return false;
    }

//THIS FUNCTION GET DATA THROUGH ID
    function getdatathroughid($table = "", $attributes = "", $id = "") {
        $CI = &get_instance();
        $CI->db->select($attributes);
        $CI->db->from($table);
        $CI->db->where('purchaser_id', $id);
        $CI->db->where('status', 'active');
        $query = $CI->db->get();
        if ($query->num_rows()) {
            return $query->row_array();
        }
        return false;
    }

//  THIS FUNCTION DELETE city DATA
    function delete_city($id) {
        $data['status'] = 'Delete';
        $this->db->where('purchaser_id', $id);
        $this->db->update('aa_purchaser_name', $data);
        return true;
    }

//  THIS FUNCTION EDIT city DATA
    function edit($id) {
      //  $data['purchaser_id'] = $id;//$this->input->post('quality_name');
        $postdata = array(
                    'name'                              => $_POST['purchaser_name'],           
                    'contact_person_name'               => $_POST['contact_person_name'],           
                    'contact_person_number'             => $_POST['contact_person_number'],           
                    'purchaser_account_no'              => $_POST['purchaser_account_no'],           
                    'purchaser_address'                 => $_POST['purchaser_address'],           
                    'purchaser_gst_no'                  => $_POST['purchaser_gst_no'],           
                    'bank_name'                         => $_POST['bank_name'],           
                    'ifsc_code'                         => $_POST['ifsc_code'],           
                    'branch_code'                       => $_POST['branch_code'],           
                    'pan_card'                          => $_POST['pan_card'],           
                    'remark'                            => $_POST['remark'],           
                    'status'                            => $_POST['status'],                    
        );
        //pr($data); die;
        $this->db->where('purchaser_id', $id);
        $this->db->update('aa_purchaser_name', $postdata);
    }

//  THIS FUNCTION VIEW city DATA
    function view($id) {
        $this->db->select('*');
        $this->db->where('purchaser_id', $id);
        return $query = $this->db->get("aa_purchaser_name")->row();
    }

    function count_city_data() {
        $requestData = $this->input->post(null, true);

        $this->db->select('*');
        
        if (isset($_GET['status'])) {
            $this->db->where("status =",$_GET["status"]);
        }
        else {
            $this->db->where("status !=",'Delete');
        }        
        
        if (!empty($requestData['search']['value'])) {
            $search_val = $requestData['search']['value'];
            $this->db->where("(name  LIKE '%$search_val%' OR  status  LIKE '%$search_val%')");
        }
        return $query = $this->db->get('aa_purchaser_name');
    }

    function get_city_data($parent_id = "") {        
        $requestData = $this->input->post(null, true);
        $columns = array(
            1 => 'wct.name',
            2 => 'wct.purchaser_account_no',            
            3 => 'wct.bank_name',
            4 => 'wct.ifsc_code',
            5   => 'wct.branch_code',
            6   => 'wct.pan_card',
            7   => 'wct.purchaser_address',
            8   => 'wct.status',
        );
        
        $this->db->select('wct.*, wct.purchaser_id, wct.name as city_name,wct.status, wcntry.name as country_name,wcntry.purchaser_id');
        $this->db->from('aa_purchaser_name as wct');
         $this->db->join('aa_purchaser_name wcntry','wct.purchaser_id=wcntry.purchaser_id','left');
         
        if (!empty($requestData['search']['value'])) {
            $search_val = $requestData['search']['value'];            
            $this->db->where("(wct.name LIKE '%$search_val%' OR wcntry.name LIKE '%$search_val%' OR wct.contact_person_name LIKE '%$search_val% ')");
        }
        
        if (isset($_GET['status'])) {
           
            $this->db->where("wct.status =",$_GET["status"]);
        }else {
            $this->db->where("wct.status !=",'Delete');
        }
        
        if (@$requestData['order'][0]['column'] && @$requestData['order'][0]['dir']) {
            $order = @$requestData['order'][0]['dir'];
            $column_name = $columns[@$requestData['order'][0]['column']];
            $this->db->order_by("$column_name", "$order");
        } else {
            $this->db->order_by("wct.purchaser_id", "desc");
        }
        if (@$requestData['length'] && $requestData['length'] != '-1') {
            $this->db->limit($requestData['length'], $requestData['start']);
        }

        $query = $this->db->get();
        //echo $this->db->last_query(); die;
        if ($query->num_rows()) {
            return $query->result();
        } else {
            //return false;
        }
    }

    /**
     * check_preexistance
     *
     * function for check either color name pre exist
     * 
     * @access	public
     * @return	html data
     */
    function check_preexistance($id, $city_name) {
        $this->db->select('*');
        $this->db->where('purchaser_id !=', $id);
        $this->db->where('name ', $city_name);
        $query = $this->db->get('aa_purchaser_name');
      //  echo $this->db->last_query();
        return $query->num_rows();
        //die();
    }

    /* End of function */
}
