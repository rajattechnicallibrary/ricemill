<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * City Model 
 *
 * @package		Masters
 * @subpackage	Models
 * @category	Masters
 * @author      Dharmendra Pal
 * @website		http://www.thealternativeaccount.com
 * @company     thealternativeaccount Inc
 * @since		Version 1.0
 */
class Blogs_mod extends CI_Model {
    /**
     * Constructor
     */
    function __construct() {
        parent::__construct();
    }
/*
|--------------------------------------------------------------------------
|Listing
|--------------------------------------------------------------------------
*/		
	public function blogs_list_ajax($filter){
		//pr($filter);die;
		$id = currentuserinfo()->id;
		 $this->db->select('SQL_CALC_FOUND_ROWS b.id, b.title, b.created_date, b.status,b.is_approve,b.blog_data, (select count(*) from fs_blog_likes as bl where bl.blog_id = b.id)as blogs_like,
						  (select count(*) from fs_blog_comments as bc where bc.blog_id = b.id) as blogs_comment,
					      (select avg(rating) from fs_blog_comments as bcc where bcc.blog_id = b.id) as blogs_avg_rating,
						  (select count(*) from fs_blog_follow as bf where bf.blog_id = b.id) as blogs_follower',false);
		
		if (!empty($filter['search']['value'])) {
            $search_val = $filter['search']['value'];
			$this->db->where("(b.title  LIKE '%$search_val%')");
            //$this->db->where("(b.title  LIKE '%$search_val%' OR  status  LIKE '%$search_val%')");
        }
		
		if ($filter['length'] != '-1') {  // for showing all records
                $this->db->limit($filter['length'], $filter['start']);
            }
			
		if(isset($filter['menu_category']) && $filter['menu_category']!=''){
			    $filter_menu = explode(',',$filter['menu_category']);
               $this->db->where_in("b.menu_category",$filter_menu);
           }	
			
		 if(isset($filter['food_category']) && $filter['food_category']!=''){
               $this->db->where("b.food_category",$filter['food_category']);
           }
           
           if(isset($filter['food_type']) && $filter['food_type']!=''){
               $this->db->where("b.food_type",$filter['food_type']);
           } 
           
           if(isset($filter['start_date']) && $filter['start_date']!='' && isset($filter['end_date']) && $filter['end_date']!=''){
               $start_date  =   str_replace("/","-",$filter['start_date']);
               $end_date    =   str_replace("/","-",$filter['end_date']);
               $start_date1=date('Y-m-d',strtotime($start_date)).' 00:00:00';
               $end_date1=date('Y-m-d',strtotime($end_date)).' 23:59:59';
               $this->db->where("(created_date>='$start_date1' AND created_date<='$end_date1')");
           }	
			$this->db->where('b.status!=','delete');	
			$this->db->where('b.user_id',$id);
			$this->db->order_by('b.id','desc');	
			$query = $this->db->get('fs_blogs as b');
			if($query->num_rows() > 0){
				$res['result'] = $query->result();
				$total_record = $this->db->query('SELECT FOUND_ROWS() as count');
				$res['totalData']       =   $total_record->row()->count;
				$res['totalFiltered']   =   $total_record->row()->count; 
				$res['status']="success";
			}else{
				$res['result'] = '';
				$res['totalData']       =   0;
				$res['totalFiltered']   =   0; 
				$res['status']="error";
			}
			return $res;
	}
/*
|--------------------------------------------------------------------------
|End of Listing
|--------------------------------------------------------------------------
*/
	
/*
|--------------------------------------------------------------------------
|Add
|--------------------------------------------------------------------------
*/public function add($image) 
	{
		$userid=currentuserinfo()->id;
        if($_POST){            
		    $data['user_id']              = $userid;
            $data['title']            	  = $_POST['title'];
            $data['description']      	  = $_POST['description'];
			$data['menu_category']        = $_POST['menu_category'];
            $data['menu_sub_category']    = $_POST['menu_sub_category'];
			$data['food_category']        = $_POST['food_category'];
            $data['food_type']      	  = $_POST['food_type'];
			$data['difficulty_level']     = $_POST['difficulty_level'];
            $data['image']     			  = $image;
            $data['cooking_time']         = $_POST['cooking_time'];
			$data['blog_url']             = $_POST['blog_url'];            
			$data['created_date']         = date('Y-m-d H:i:s');
			$data['is_approve']          = 'pending';
			//$data['status']          = 'inactive';
//pr($data);die;			
            $this->db->insert("fs_blogs", $data);	
            return true;        
        } else{
            return false;      
        }
    }
/*
|--------------------------------------------------------------------------
|End of Add
|--------------------------------------------------------------------------
*/
/*
|--------------------------------------------------------------------------
|Edit
|--------------------------------------------------------------------------
*/
    function edit($id,$image){
        if($image)
        {
	    $data['image'] = $image;
        }
		else{
			 $data['image']=$this->input->post('old_image'); 
		  }
        $data['title']             = $this->input->post('title');
        $data['description']       = $this->input->post('description');
        $data['menu_category']     = $this->input->post('menu_category');  
        $data['menu_sub_category'] = $this->input->post('menu_sub_category');
        $data['food_category']     = $this->input->post('food_category');
        $data['food_type']         = $this->input->post('food_type');    
        $data['difficulty_level']  = $this->input->post('difficulty_level');
        $data['cooking_time']      = $this->input->post('cooking_time');
        $data['blog_url']          = $this->input->post('blog_url');
        $data['is_approve']        = 'pending';
        $dataup['blog_data']       = json_encode($data);
        //$data['status']            = 'inactive';
       // $dataup['is_approve']        = 'pending';		
        $this->db->where('id', $id);
        $update = $this->db->update('fs_blogs',$dataup);
        if($update){
            return true;          
        }else{
            return false; 
        }        
    }
/*
|--------------------------------------------------------------------------
|End of Edit
|--------------------------------------------------------------------------
*/
	
  public function get_menu_category(){
		$this->db->select('id,parent,name,status');
		$this->db->from('fs_menu_category');
		$this->db->where('status','active');
		$this->db->where('parent','0');
		$this->db->order_by('name','asc');
		$query = $this->db->get();
		if($query->num_rows() > 0){
			return $query->result();
		}else{
			return false;
		}
	}
	
	public function get_menu_subcategory($menu_category_id){
		if($menu_category_id){
		$this->db->select('id,parent,name,status');
		$this->db->where('status','active');
		$this->db->where('parent',$menu_category_id);
		$query = $this->db->get('fs_menu_category');
		return $query->result();
		}else{
			return false;
		}
	}
	
	public function view($id){
		$this->db->select('*');
		$this->db->from('fs_blogs');
		$this->db->where('id',$id);
		$query = $this->db->get();
		if($query->num_rows() > 0){
			return $query->row();
		}else{
			return false;
		}
	}
	
	function deleteBlogs($blog_ids) {	
		$blog_ids = explode(',',$blog_ids);		
        $data['status'] = 'delete';
        $this->db->where_in('id', $blog_ids);
        $this->db->update('fs_blogs', $data);		
		$update = $this->db->affected_rows();
		if($update){
			return $update;
		} else {
			return false;
		}
    }
	
	/*
|--------------------------------------------------------------------------
|Export
|--------------------------------------------------------------------------
*/	
	public function export(){
		$ids = $this->input->get('ids');
		$ids = explode(',',$ids);
		$this->db->select('b.id, b.title, b.created_date, b.status,b.is_approve, (select count(*) from fs_blog_likes as bl where bl.blog_id = b.id)as blogs_like,
						  (select count(*) from fs_blog_comments as bc where bc.blog_id = b.id) as blogs_comment,
					      (select avg(rating) from fs_blog_comments as bcc where bcc.blog_id = b.id) as blogs_avg_rating,
						  (select count(*) from fs_blog_follow as bf where bf.blog_id = b.id) as blogs_follower');
		
		$this->db->from('fs_blogs as b');
        $this->db->where_in('b.id',$ids);
		$this->db->order_by('b.id','desc');
		$query = $this->db->get();
		return $query->result();
	}
	
		
}

// end class
?>