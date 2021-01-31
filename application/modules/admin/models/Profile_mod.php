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
class Profile_mod extends CI_Model {

    var $tbl_users = "users";

    /**
     * Constructor
     */
    function __construct() {
        parent::__construct();
    }

    /**
     * profile_info
     *
     * this function give user profile info by user id
     * @access	public
     * @return array
     */
    function profile_info($id = NULL) {

        $this->db->select("u.*,concat(u.first_name,' ',u.last_name) as full_name", false);
        $this->db->where('u.id', $id);
        $query = $this->db->get("$this->tbl_users as u");

        if ($query->num_rows() > 0) {
            $data['status'] = 'success';
            $data['result'] = $query->row();
        } else {

            $data['status'] = 'error';
            $data['error_msg'] = 'Invalid Request';
        }
        return $data;
    }

    /**
     * profile_edit
     *
     * this function update user profile info by user id
     * @access	public
     * @return array
     */
    function profile_edit($user_id = '') {
        if ($user_id != '') {
            //---------------
            $arr = $this->input->post(null, true);
            $result = $this->profile_info($user_id);
            $row = ($result['status'] == "success") ? $result['result'] : '';
            $this->form_validation->set_rules('first_name', 'First Name', "trim|required|max_length[40]");
            //$this->form_validation->set_rules('last_name', 'Last Name', "trim|required|max_length[40]");
            
            /*if($row->mobile_number==$arr['mobile_number']){
                $this->form_validation->set_rules('mobile_number', 'Mobile Number', "trim|required");
            }else{
                $this->form_validation->set_rules('mobile_number', 'Mobile Number', "trim|required|is_unique[fs_users.mobile_number]");
            
                $this->form_validation->set_message('is_unique', 'The %s is already taken');
            }*/
            
            if($row->email==$arr['email']){
                $this->form_validation->set_rules('email', 'Email Address', "trim|required");
            }else{
                $this->form_validation->set_rules('email', 'Email Address', "trim|required|is_unique[fs_users.email]");
            
                $this->form_validation->set_message('is_unique', 'The %s is already taken');
            }
            
            $rs_data = array();
            $rs_data['status'] = '';
            $rs_data['error_msg'] = '';
            /*if (!preg_match("/^[0-9]{10}$/",$this->input->post('mobile_number',true)) && $this->input->post('mobile_number',true)!='') {
          
                $rs_data['error_msg'] = $res['error_msg'].'Mobile Number should be 10 digit number.<br>';
                $rs_data['status'] = 'error';      
            }*/

            if ($this->form_validation->run() == false) {

                $rs_data['error_msg'] = $rs_data['error_msg'].validation_errors();
                $rs_data['status'] = 'error';
            }
            if($rs_data['status']!='error'){
                $this->db->set('first_name', $arr['first_name']);
                $this->db->set('last_name', $arr['last_name']);
                //$this->db->set('mobile_number',$arr['mobile_number']);
                $this->db->set('email', @$arr['email']);

                $this->db->where('id', $user_id);
                $res = $this->db->update($this->tbl_users);
                if ($res) {

                    $rs_data['status'] = 'success';
                }else{
                    $rs_data['status'] = 'error';
                    $rs_data['error_msg'] = "Invalid Request";
                }
            }
            //---------------
        
         
            
        }else{
            $rs_data['status'] = 'error';
            $rs_data['error_msg'] = "User Id is required";
        }


        return $rs_data;
    }

    //changeLgo

    /**
     * changeLgo
     *
     * this function update company Logo
     * @access	public
     * @return array
     */
    function changeLgo($id = '', $thumb = '') {
        if ($id == '' || $thumb == '') {
            $data['status'] = 'error';
            $data['error_msg'] = 'Invalid Request';
        } else {
            $this->db->set('s.cmp_logo', $thumb);
            $this->db->where('s.id', $id);
            $res1 = $this->db->update(DB_CENTERLIZED . ".$this->tbl_sites as s");
            if ($res1) {
                $data['status'] = 'success';
                $data['file_name'] = $thumb;
            } else {
                $data['status'] = 'error';
                $data['error_msg'] = 'Invalid Request';
            }
        }
        return $data;
    }

    /**
     * changeImage
     *
     * this function update user profile image by user id
     * @access	public
     * @return array
     */
    function changeImage($id = NULL, $thumb = NULL, $site_id = '') {
        if (empty($id) || empty($thumb)) {
            $data['status'] = 'error';
            $data['error_msg'] = 'Invalid Request';
        } else {
            $this->db->set('profile_image', $thumb);
            $this->db->where('id', $id);
            $res = $this->db->update($this->tbl_users);
            if ($res) {
                $data['status'] = 'success';
                $data['file_name'] = $thumb;
            } else {
                $data['status'] = 'error';
                $data['error_msg'] = 'Invalid Request';
                $data['file_name'] = '';
            }
        }

        return $data;
    }

    /**
     * reset_password
     *
     * this function reset password
     * 
     * @access	public
     * @return	html data
     */
    public function reset_password($id = NULL) {
        $this->form_validation->set_rules('password', 'Password', "trim|required");
        $this->form_validation->set_rules('confirm_password', 'Confirm Password', "trim|required");
        $this->form_validation->set_rules('new_password', 'New Password', "trim|required");


        if ($this->form_validation->run() == false) {
            $data['error_msg'] = validation_errors();
            $data['status'] = 'error';

            return $data;
        }
        $new_password = $this->input->post('new_password', NULL);
        $confirm_password = $this->input->post('confirm_password', NULL);

        if ($new_password != $confirm_password) {
            $data["error_msg"] = "New Password and Confirm Password should be same";
            $data["status"] = "error";
            return $data;
        }

        $old_password = md5($this->input->post('password', NULL));
        $new_password = md5($this->input->post('new_password', NULL));
        $confirm_password = md5($this->input->post('confirm_password', NULL));

        $db_old_password = $this->db->get_where($this->tbl_users, array('id' => $id))->row()->password;

        if($old_password == $db_old_password) {
            $this->db->set('password', $new_password);
            $this->db->where('id', $id);
            $this->db->update($this->tbl_users);
            $data["status"] = "success";
        }else{
            $data["error_msg"] = "Please enter correct password";
            $data["status"] = "error";
        }

        return $data;
    }

    /* END Function */

    function users_list_ajax() {
        $requestData = $_REQUEST;



        $columns = array('u.id', 'u.first_name', 'u.status');
        $this->db->select("SQL_CALC_FOUND_ROWS u.*,concat(u.first_name,' ',u.last_name) as name,r.name as role_name", FALSE);
        $this->db->join("$this->tbl_roles as r", "r.id=u.user_type", "left");
        if (!empty($requestData['search']['value'])) {
            $ser = $requestData['search']['value'];
            $this->db->like('first_name', $ser);
            $this->db->or_like('status', $ser);
        }

        $this->db->order_by($columns[$requestData['order'][0]['column']], $requestData['order'][0]['dir']);
        if ($requestData['length'] != '-1') {  // for showing all records
            $this->db->limit($requestData['length'], $requestData['start']);
        }
        $query = $this->db->get("$this->tbl_users as u");
//        echo $this->db->last_query(); die;
        $data = array();
        if ($query->num_rows() > 0) {


            $result = $query->result();

            $totalFiltered = $query->num_rows();
            $total_record = $this->db->query('SELECT FOUND_ROWS() AS `count`');
            $totalData = $total_record->row()->count;
            $totalFiltered = $total_record->row()->count;
            $i = 1;
            if (isset($requestData['start']) && $requestData['start'] != '') {
                $cno = @$requestData['start'] + 1;
                ;
            } else {
                $cno = 1;
            }

            foreach ($result as $obj) {
                $nestedData = array();
                $nestedData[] = $obj->id;
                $nestedData[] = $cno;
                $nestedData[] = $obj->name;
                $nestedData[] = $obj->email;
                $nestedData[] = $obj->contact_number;
                $nestedData[] = $obj->role_name;
//                $nestedData[] = $obj->plan_fee;
//                $str_status = '';
//                if ($obj->status == 'active') {
//                    $str_status = $str_status . '<span class="label label-sm label-success"> Active </span>';
//                } else if ($obj->status == 'inactive') {
//                    $str_status = $str_status . '<span class="label label-sm label-danger"> Inctive </span>';
//                } 
//
//                $nestedData[] = $str_status;
                $str_action = '<a href="' . base_url('user/edit/' . ID_encode($obj->id)) . '" class="btn btn-xs btn-info margin-right-10 "> <i class="fa fa-edit"></i> </a> <a href="javascript:;" data="' . ID_encode($obj->id) . '" class="btn  btn-xs btn-danger margin-right-10 del-plan"> <i class="fa fa-trash"></i> </a>';
                $nestedData[] = $str_action;
                $data[] = $nestedData;
                $i++;
                $cno++;
            }
        } else {
            $data['status'] = 'error';
            $data['error_msg'] = 'Invalid Request';
        }

        $json_data = array(
            "draw" => intval($requestData['draw']),
            "recordsTotal" => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data" => $data
        );
        return $json_data;
    }
	
	function update($data,$id){
		$this->db->where('id', $id);
		$this->db->update('users',$data);
		
		
	}
	
	function profile_deatils($id){
		$this->db->where('id',$id);
		$query = $this->db->get('users');
		$result = $query->row();
		return $result;		
		
	}
	
	
	
	
	
	
	
	
	
	
}
