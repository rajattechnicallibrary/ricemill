<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Blogs extends CI_Controller {
    /**
     *  Demo Controller
     *
     * @package		Auth
     * @category    Auth
     * @author		Ankit Rajput 
     * @website		http://www.thealternativeaccount.com
     * @company     thealternativeaccount Inc
     * @since		Version 1.0
     */

    /**
     * Constructor
     */
    function __construct() {
        parent::__construct();
        $this->load->model('Blogs_mod');
        $this->load->library('upload');
        $this->load->library('image_lib');
        is_userprotected();
    }

    /* End of constructor */

    /**
     * index
     *
     * This function dispaly main site page
     * 
     * @access	public
     * @return	html data
     */
    public function index() {
        $data['menu_category'] = $this->Blogs_mod->get_menu_category();
        $data['breadcum'] = array("site/" => 'Home', '' => 'Blog List');
        $data['page'] = 'account/blogs_list';
        $data['title'] = 'Track (The Rest Accounting Key) || My Blogs';
        $this->load->view('landing_layout', $data);
    }

    public function blogs_list_ajax() {
        if (!empty($this->input->post('selected'))) {
            $selected = (array) $this->input->post('selected');
        } else {
            $selected = array();
        }
        $filter = array_merge($_POST, $_GET);
        $restdata = $this->Blogs_mod->blogs_list_ajax($filter);
        if ($restdata['status'] == 'success') {
            $result = $restdata['result'];
            $totalData = $restdata['totalData'];
            $totalFiltered = $restdata['totalFiltered'];
            $i = 1;
            if (isset($filter['start']) && $filter['start'] != '') {
                $cno = @$filter['start'] + 1;
            } else {
                $cno = 1;
            }

            foreach ($result as $obj) {
                $nestedData = array();

                $id_encoded = ID_encode($obj->id);
                $row = $obj->id;
                $nestedData[] = $obj->id;
                if (in_array($obj->id, $selected)) {
                    $nestedData[] = '<input type="checkbox" name="selected[]" class="checkboxes" value="' . $obj->id . '" checked="checked"/>';
                } else {
                    $nestedData[] = '<input type="checkbox" name="selected[]" class="checkboxes" value="' . $obj->id . '"/>';
                }
                
                if($obj->blog_data!=''){
                    $blog_data  =   json_decode($obj->blog_data);
                    $obj->title         =   $blog_data->title;
                    $obj->is_approve    =   $blog_data->is_approve;
                }
                
                $nestedData[] = $cno;
                $nestedData[] = ucfirst(substr($obj->title, 0, 10));
                $nestedData[] = $obj->blogs_like;
                $nestedData[] = $obj->blogs_comment;
                if (!empty($obj->blogs_avg_rating)) {
                    $nestedData[] = '<i class="fa fa-star orange" aria-hidden="true"></i> ' . round($obj->blogs_avg_rating, 1);
                } else {
                    $nestedData[] = '0';
                }
				$nestedData[] = $obj->blogs_follower;
                if ($obj->is_approve == 'approve') {
                    $blog_status = 'Published';
                } else if ($obj->is_approve == 'disapprove') {
                    $blog_status = 'Rejected by Admin';
                } else {
                    $blog_status = 'Pending for Approval';
                }


                $nestedData[] = $blog_status;
                //$nestedData[] = $obj->is_approve;
                $str_action = "";
                $str_action .= '<a href="blogs/edit?id=' . ID_encode($obj->id) . '" >Edit</a>';
                if ($obj->is_approve == "approve" ) {
                    $str_action .= "|<a href='" . base_url() . "blogs/blog_details/" . RemoveSpecialChar($obj->title) . "-" . $id_encoded . " ' target='_blank'>View</a>";
                }
                $nestedData[] = $str_action;
                $data[] = $nestedData;
                $i++;
                $cno++;
            }
            $json_data = [
                "draw" => intval($filter['draw']),
                "recordsTotal" => intval($totalData),
                "recordsFiltered" => intval($totalFiltered),
                "data" => $data
            ];
        } else {
            $json_data = [
                "draw" => 0,
                "recordsTotal" => 0,
                "recordsFiltered" => 0,
                "data" => ''
            ];
        }
        echo json_encode($json_data);
    }

    public function edit($id = "") {
        $decode_id = ID_decode($this->input->get('id'));
        $encoded_id = $this->input->get('id');
        //pr($decode_id);die;
        if (isPostBack()) {
            $this->form_validation->set_rules('title', 'Title', 'trim|required');
            $this->form_validation->set_rules('description', 'Description', 'required');
            $this->form_validation->set_rules('menu_category', 'Menu Category', 'required');
            $this->form_validation->set_rules('menu_sub_category', 'Menu Sub Category', 'required');
            //$this->form_validation->set_rules('blog_url', 'URL Of Blog', 'trim|required');

            if ($this->form_validation->run() == FALSE) {
                
            } else {
                $image = '';
                if ($_FILES["image"]["name"]) {
                    $uploadedimage = $this->tmpAjaxUploadImage(); //image upload function
                    if (!empty($uploadedimage['error'])) {
                        set_flashdata('error', $uploadedimage['error']);
                    }
                    $image = $uploadedimage['upload_data'];
                }
                $this->Blogs_mod->edit($decode_id, $image);
                set_flashdata('success', 'Blog updated successfully and it is pending for Admin Approval !');
                redirect('/account/blogs');
            }
        }
        $data['result'] = $this->Blogs_mod->view($decode_id);
        if($data['result']->blog_data!=''){
            $blog_data  =   json_decode($data['result']->blog_data);
            $data['result']->image              =   @$blog_data->image;
            $data['result']->title              =   @$blog_data->title;
            $data['result']->description        =   @$blog_data->description;
            $data['result']->menu_category      =   @$blog_data->menu_category;
            $data['result']->menu_sub_category  =   @$blog_data->menu_sub_category;
            $data['result']->food_category      =   @$blog_data->food_category;
            $data['result']->food_type          =   @$blog_data->food_type; 
            $data['result']->difficulty_level   =   @$blog_data->difficulty_level;
            $data['result']->cooking_time       =   @$blog_data->cooking_time;
            $data['result']->blog_url           =   @$blog_data->blog_url;
        }
        $data['menu_category'] = $this->Blogs_mod->get_menu_category();
        $data['menu_sub_category'] = $this->Blogs_mod->get_menu_subcategory($data['result']->menu_category);
        $data['breadcum'] = array("site/" => 'Home', 'account/blogs' => 'Blog List', '' => 'Update Blog');
        $data['page'] = 'account/blogs_edit';
        $data['title'] = 'Track (The Rest Accounting Key) || Update Blog';
        $this->load->view('landing_layout', $data);
    }

//=======================================================================================
//blogs add
//=======================================================================================	
    public function add() {
        if (isPostBack()) {
            $this->form_validation->set_rules('title', 'Title', 'trim|required');
            $this->form_validation->set_rules('description', 'Description', 'required');
            $this->form_validation->set_rules('menu_category', 'Menu Category', 'required');
            $this->form_validation->set_rules('menu_sub_category', 'Menu Sub Category', 'required');
            //$this->form_validation->set_rules('blog_url', 'URL Of Blog', 'trim|required');
            if ($_FILES["image"]["name"] == '') {
                $this->form_validation->set_rules('image', 'Image', 'required');
            }

            if ($this->form_validation->run() == FALSE) {
                
            } else {
                $image = '';
                if ($_FILES["image"]["name"]) {
                    $uploadedimage = $this->tmpAjaxUploadImage(); //image upload function
                    if (!empty($uploadedimage['error'])) {
                        set_flashdata('error', $uploadedimage['error']);
                    }else{
                    $image = $uploadedimage['upload_data'];
                    }
                }
                $this->Blogs_mod->add($image);
                set_flashdata('success', 'New Blog added successfully and it is pending for Admin Approval !');
                redirect('account/blogs');
            }
        }
        $data['menu_category'] = $this->Blogs_mod->get_menu_category();
        //pr($data['menu_category']);die;
        $data['breadcum'] = array("site" => 'Home', 'account/blogs' => 'Blog List', '' => 'Add Blog');
        $data['page'] = 'account/blogs_add';
        $data['title'] = 'Track (The Rest Accounting Key) || Blogs Add';
        $this->load->view('landing_layout', $data);
    }

//=======================================================================================
//blogs add
//=======================================================================================
//=======================================================================================
//get_menu_subcategory
//=======================================================================================		
    public function get_menu_subcategory() {
        $menu_category_id = $this->input->post('menu_category_id');
        $menu_sub_category = $this->Blogs_mod->get_menu_subcategory($menu_category_id);
        $box = '';
        $box .= '<option value="">Select Menu Subcategory</option>';
        if (!empty($menu_sub_category)) {
            foreach ($menu_sub_category as $key => $val) {
                $box .= '<option value=' . $val->id . ' >' . $val->name . '</option>';
            }
        } else {
            $box = '<option value="">No Data Available</option>';
        }
        echo json_encode($box);
    }

//=======================================================================================
//get_menu_subcategory
//=======================================================================================	
//=======================================================================================
//upload blog image
//=======================================================================================	
    public function tmpAjaxUploadImage() {
        $path = $_FILES['image']['name'];
        $ext = pathinfo($path, PATHINFO_EXTENSION);
        $name = md5(time());
        $bfile_name = $name . "." . $ext;
        $thumb = $name . "_evnt_banner." . $ext;
        $_FILES['image']['name'] = $bfile_name;
        $image_path = './uploads/seller_blogs_image/';
        if (!is_dir($image_path)) {
            mkdir($image_path, 0777, true);
        }
        $config['min_width']  = '800';
        $config['min_height']  = '450';
        $config['upload_path'] = $image_path;
        $config['allowed_types'] = 'gif|jpg|png|GIF|JPG|PNG|JPEG|jpeg';
        $config['max_size'] = '5120';
        $this->load->library('upload');
        $this->upload->initialize($config);
        if (!$this->upload->do_upload('image')) {
            $error = array('error' => $this->upload->display_errors());
            return $error;
        } else {

            $config['image_library'] = 'gd2';
            @$config['source_image'] = './uploads/seller_blogs_image/' . $bfile_name;
            $config['maintain_ratio'] = '0';
            $config['create_thumb'] = true;
            $config['width'] = 216;
            $config['height'] = 122;
            $this->image_lib->clear(); // added this line
            $this->image_lib->initialize($config); // added this line 
            $this->image_lib->resize();

            $data = array('upload_data' => $bfile_name);
            return $data;
        }
    }

//=======================================================================================
//upload blog image
//=======================================================================================		
    public function delete() {
        if ($this->input->post('blog_ids')) {

            $blog_ids = $this->input->post('blog_ids');
            if (!empty($blog_ids)) {
                $update = $this->Blogs_mod->deleteBlogs($blog_ids);
                if ($update) {
                    $res['status'] = 'success';
                    set_flashdata('success', 'Selected Blogs deleted !');
                    // $res['msg']      = 'Selected area deleted!';                                                                 
                } else {
                    $res['status'] = 'error';
                    set_flashdata('success', 'Selected Blogs not deleted !');
                    //$res['msg']      = 'Selected not area deleted!';                                                                 		
                }
            } else {
                $res['status'] = 'error';
                set_flashdata('success', 'Someting went wrong!');
                //$res['msg']      = 'Someting went wrong!';                            
            }

            echo json_encode($res);
        }
    }

    public function export() {
        $result = $this->Blogs_mod->export();
        $filename = date('d-m-Y') . "_" . 'blogs.xls';
        $header = "S.No \t Blog Title \t Likes \t Comments \t Rating \t Number of followers";

        foreach ($result as $row) {
            $date = date("d F, Y", strtotime($row->created_date));
			if ($row->is_approve == 'approve') {
				$blog_status = 'Published';
			} else if ($row->is_approve == 'disapprove') {
				$blog_status = 'Rejected by Admin';
			} else {
				$blog_status = 'Pending for Approval';
			}

            $data_array[] = array('Blog Title' =>ucfirst($row->title), 'Likes' => $row->blogs_like, 'Comments' => $row->blogs_comment, 'Rating' => round($row->blogs_avg_rating, 1),'Number of followers' =>$row->blogs_follower);
        }
        /* ====================using helper function========================= */
        array_to_exl($header, $data_array, $filename); /* calling helper from function_helper */
    }

}

// End of Class
