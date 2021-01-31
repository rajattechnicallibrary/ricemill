<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Orders extends CI_Controller {	 

	 function __construct() {		
        parent::__construct();
        $this->load->model('Orders_mod'); 
        $this->load->model('admin/Seller_mod');        
        $this->load->helper('function');  
		$this->load->library('upload');
		is_adminprotected();
    }

	/**
	 * Index .
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	 
	public function index() {        	
		$order_list	        				=	$this->Orders_mod->get_myorders('3','0');  
			//pr($order_list);die;
		if($order_list['status']=='success'){
			$data['order_list'] 			= $order_list['result'];
			$data['total_row'] 				= $order_list['total_row'];
		} else{
			$data['order_list'] 			= '';
			$data['total_row'] 				= '';
		}       
		
		$data['breadcum'] 					= 	array("site/" => 'Home', 'account/orders/' => 'Order Listing');
        $data['page'] = 'account/orders_list';
        $data['title'] = "Track (The Rest Accounting Key) || Order Listing";
        $this->load->view('landing_layout', $data);
    }

	
	/*End of index function*/
    
    
       public function load_more_orders() {
        $per_page 		= '3';	
		$page 			= $this->input->get('page');
        $order_list 	= $this->Orders_mod->get_myorders($per_page,$page);   
		
        if($order_list['status']=='success'){
			$data['order_list'] 			= $order_list['result'];
			$data['total_row'] 				= $order_list['total_row'];
		} else{
			$data['order_list'] 			= '';
			$data['total_row'] 				= '';
		}
		$res['view'] = $this->load->view('account/load_more_orders', $data, true);
        $res['status'] = 'success';
		
        echo json_encode($res);
        die;
    }
	
	public function order_details(){
		
		$order_id = ID_decode($this->uri->segment('4'));
		$data['result'] = $this->Orders_mod->order_details($order_id);
		$data['order_summary'] = $this->Orders_mod->order_summary($order_id);
		$data['currency']	=	get_user_currency();
		$data['breadcum'] 					= 	array("site/" => 'Home', 'account/orders/' => 'Order Listing', '' => 'Order Details');
        $data['page'] = 'account/order_details';
        $data['title'] = "Track (The Rest Accounting Key) || Order Details";
        $this->load->view('landing_layout', $data);
	
	}
	
	public function cancel_order(){
		$order_id 	= 	$this->input->post('order_id');
		$reason 	= 	$this->input->post('reason');
		
		$result = $this->Orders_mod->cancel_order($order_id,$reason);
		if($result['status'] == 'success'){
			$res['status'] = 'success';
			set_flashdata('success', 'Order cancelled successfully !');
		}else{
			$res['status'] = 'error';
			set_flashdata('error', 'Some error occured!');
		}
		echo json_encode($res);
	}
	
    
 
 
}
/*End of class*/