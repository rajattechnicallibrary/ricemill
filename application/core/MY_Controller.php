<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

//error_reporting(0);
class MY_Controller extends CI_Controller {

    function __construct() {
        parent::__construct();
		// $this->controller_name = $this->router->fetch_class();
		// $this->method_name = $this->router->fetch_method();
		// if (!$this->input->is_ajax_request()) 
		// {
		// 	if (currentuserinfo()->role_id!=0 && currentuserinfo()->role_id != 1 && $this->controller_name != "dashboard") 
		// 	{
		// 		//is_protected();
		// 		if($this->controller_name=='role')
		// 		{
		// 			//redirect("permission_denied");
		// 		}
		// 		if($this->method_name=='otherinfo_edit')			/*This is because seller edit form is of 4 steps*/
		// 		{
		// 			$this->method_name='userinfo_edit';
		// 		}
		// 		if($this->method_name=='statutorycompliance_edit')	/*This is because seller edit form is of 4 steps*/
		// 		{
		// 			$this->method_name='userinfo_edit';
		// 		}
		// 		if($this->method_name=='paymentmode_edit')	/*This is because seller edit by admin form is of 4 steps*/
		// 		{
		// 			$this->method_name='userinfo_edit';
		// 		}
		// 		if($this->method_name=='seller_payment')	/*This is because seller edit form is of 4 steps*/
		// 		{
		// 			$this->method_name='userinfo_edit';
		// 		}
				
		// 		$res = has_permission($this->controller_name, $this->method_name);
		// 		if(!$res)
		// 		{
		// 			redirect("permission_denied");
		// 		}
		// 	}else{
				
		// 	}
		// }
		// else if ($this->input->is_ajax_request() && $this->input->post('is_bypass')=='no') 
		// {
		// 	$res = has_permission($this->controller_name, $this->method_name);
		// 	if(!$res)
		// 	{
		// 		redirect("permission_denied");
		// 	}
		// }
		
    }

  
}
?>
