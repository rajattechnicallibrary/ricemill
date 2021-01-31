<html>
<head>
<title> </title>
<style>
body{background:#eeeeee; float:left; padding:20px;font-family:arial;}
table{background:#fff; }
table, th, td {
    border-collapse: collapse;
 
 
}
th, td {
     padding: 5px 24px;
    text-align: left;
}

</style>
</head>
<body>
<table style="width:100%">
  <tr >
  <td colspan="2">
  <?php 
 // pr($order_details['order_items_details']);die;
  
  
  $time_string=$order_details['order_details']->delivery_estimated_time;
	
	$estimate_time=substr($time_string, 3, 2);
  
	$currency = get_user_currency();
	
	//pr($your_array);
	//pr($delivery_landmark);
	//pr($country_name);
	//pr($state_name);
	//pr($city_name); die;
	
	//die;
   $scr_logo  =   base_url()."assets/admin/layout4/img/logo-big-new-white.png";
       
?>
  <img alt="Logo" src="<?=$scr_logo ?>" style="width:168px; padding-top: 5px; padding-bottom: 15px;"/></td>
   
  </tr>
  
   <?=@$message['body']?>
  <tr>
    <td colspan="2" style="color: #c8202d;font-weight: bold;font-size: 20px;padding-top: 20px;text-align: center;font-family: arial;">Order Confirmed
    <br/><span style="font-size: 15px; color:#000;line-height: 26px;">Order ID <?=@$order_details['order_details']->id?></span>
    </td>
  </tr>
  <tr>
    <td style="color:#000; font-weight:bold ; font-family: arial;float:left">Hi <?=@$order_details['order_details']->sender_first_name?>,</td>
    <td style="color:#FF0000;font-weight:bold; float:right;font-family: arial;"></td>
  </tr>
  <tr>
    <td style="color:#777; font-size:13px; font-weight:normal; font-family: arial;float:left">Thanks for ordering with foodstall. <?=$order_details['order_details']->stall_name?> is preparing your order now.</td>
  </tr>
   <tr>
    <td  colspan="2" >
        <table width="80%" align="center">
            <tr>
                    <td align="center" style="color: #777;font-weight: bold;border: 1px solid #e7e7e7;font-size: 14px;padding: 15px 0px;text-align: center;font-family: arial;
    background: #f1f1f1;margin: 10px 0px;;">Estimated Wait Time: <span style="font-family: arial;font-size: 13px;color:#c8202d;"><?=@$estimate_time?> minutes</span></td> 
            </tr>
        </table>
    </td>
  </tr>
  
  <tr>
    <td colspan="2" style="color:#000; font-weight:bold ; font-family: arial;float:left">Customer Information</td>   
  </tr>
  <tr>
    <td colspan="2" style="color: #777;font-size: 13px;font-weight: normal;font-family: arial;float: left;"><?=@$order_details['order_details']->sender_first_name?>&nbsp;<<?=@$order_details['order_details']->sender_last_name?></td>
  </tr>
  
  <tr>
    <td colspan="2" style="color: #777;font-size: 13px;font-weight: normal;font-family: arial;float: left;"><?=@$order_details['order_details']->delivery_address?> <br /><?=@$order_details['order_details']->delivery_landmark?>  <?=@$order_details['order_details']->city_name?> (<?=@$order_details['order_details']->state_name?>)<br /><?=@$order_details['order_details']->country_name?>
	<br /><?=@$order_details['order_details']->delivery_zipcode?>
</td>
  </tr>
 
   
<tr>
<td colspan="2">
<table style="width:100%;border:12px solid #fff;font-family: arial;">
  <tr>
    <th style="color: #000;font-weight: bold; padding-top: 20px;">Order Summary</th>
  </tr>
   <tr style="border-bottom:2px solid #bfbebe;">
    <th style="font-family: arial;">#</th>
    <th style="font-family: arial;">Product</th>
     <th style="font-family: arial;">Unit</th>
    <th style="font-family: arial;">Qty</th>
	 <th style="font-family: arial;">Price</th>
	 
  </tr>
   <?php $count = 1; foreach($order_details['order_items_details'] as $val) {
	    ?>
  <tr style="border-bottom:2px solid #e4e4e4">

    <td style="font-size:14px; text-align:center;width:15%;"><?=@$count?></td>
    <td style="font-size:14px;text-align:center;width:15%;"><?=@$val->menu_varient_name?></td>
	 <td style="font-size:14px;text-align:center;width:15%;"><?=@$val->unit_price?></td>
	  <td style="font-size:14px;text-align:center; width:15%;"><?=@$val->quantity?></td>
	   <td style="font-size:14px;text-align:center;width:40%;"><?=$currency." ".@$val->total_price?> </td>
	   
 
  </tr>
 <?php $count=$count+1;   }?>
  <tr>
    <td style="font-size:14px; text-align:center;width:15%;">&nbsp;</td>
	<td style="font-size:14px; text-align:center;width:15%;">&nbsp;</td>
	<td style="font-size:14px; text-align:center;width:15%;"> &nbsp;</td>
	<td style="font-size:14px; text-align:center;width:15%;">&nbsp;</td>
	
		<td style="color: #777;font-size:14px;width:40%;text-align:center;">Discounted Price :  <span style="color:#000">  <?=$currency." ".@$cart_data['discount']?> </span><span style="color: #FF0000;">  <span></td>
  </tr>
    <tr>
     <td style="font-size:14px; text-align:center;width:15%;">&nbsp;</td>
	<td style="font-size:14px; text-align:center;width:15%;">&nbsp;</td>
	<td style="font-size:14px; text-align:center;width:15%;">&nbsp;</td>
	<td style="font-size:14px; text-align:center;width:15%;">&nbsp;</td>
	<td style="color: #777;font-size:14px;width:40%;text-align:center;">Sub Total : <span  style="color: #FF0000;font-weight:700"><?=$currency." ".@$cart_data['subTotal']?> </span></td>
  </tr>
    <tr>
     <td style="font-size:14px; text-align:center;width:15%;">&nbsp;</td>
	<td style="font-size:14px; text-align:center;width:15%;">&nbsp;</td>
	<td style="font-size:14px; text-align:center;width:15%;">&nbsp;</td>
	<td style="font-size:14px; text-align:center;width:15%;">&nbsp;</td>
	<td style="color: #777;font-size:14px;width:40%;text-align:center;">CGST : <span  style="color: #FF0000;font-weight:700"><?=$currency." ".@$cart_data['cgst']?> </span></td>
  </tr>
  
   <tr>
     <td style="font-size:14px; text-align:center;width:15%;">&nbsp;</td>
	<td style="font-size:14px; text-align:center;width:15%;">&nbsp;</td>
	<td style="font-size:14px; text-align:center;width:15%;">&nbsp;</td>
	<td style="font-size:14px; text-align:center;width:15%;">&nbsp;</td>
	<td style="color: #777;font-size:14px;width:40%;text-align:center;">SGST : <span  style="color: #FF0000;font-weight:700"><?=$currency." ".@$cart_data['sgst']?> </span></td>
  </tr>
  <tr>
     <td style="font-size:14px; text-align:center;width:15%;">&nbsp;</td>
	<td style="font-size:14px; text-align:center;width:15%;">&nbsp;</td>
	<td style="font-size:14px; text-align:center;width:15%;">&nbsp;</td>
	<td style="font-size:14px; text-align:center;width:15%;">&nbsp;</td>
	
	<td style="color: #777;font-size:14px;width:40%;text-align:center;">Delivery Fees : <span  style="color: #FF0000;font-weight:700"><?=$currency." ".@$cart_data['deliveryFee']?> </span></td>
	
  </tr>
  <tr>
     <td style="font-size:14px; text-align:center;width:15%;">&nbsp;</td>
	<td style="font-size:14px; text-align:center;width:15%;">&nbsp;</td>
	<td style="font-size:14px; text-align:center;width:15%;">&nbsp;</td>
	<td style="font-size:14px; text-align:center;width:15%;">&nbsp;</td>
	<?php if (@$cart_data['coupon_discount']!=''){ ?>
	<td style="color: #777;font-size:14px;width:40%;text-align:center;">coupon : <span  style="color: #FF0000;font-weight:700"><?=$currency." ".@$cart_data['coupon_discount']?> </span> <?php } ?></td>
	
  </tr>
    <tr>
     <td style="font-size:14px; text-align:center;width:15%;">&nbsp;</td>
	<td style="font-size:14px; text-align:center;width:15%;"> &nbsp;</td>
	<td style="font-size:14px; text-align:center;width:15%;">&nbsp;</td>
	<td style="font-size:14px; text-align:center;width:15%;">&nbsp;</td>
	<td style="color: #777;font-size:14px;width:40%;text-align:center;">Grand Total : <span  style="color: #FF0000;font-weight:700"><?=$currency." ".@$cart_data['finalTotal']?> </span></td>
  </tr>
   
</table>
</td>
</tr>
<tr>
    <td colspan="2" style="font-weight:700">Payment Type,</td>
  </tr>
  <tr>
    <td colspan="2"  style="padding-top:5px;color: #777;font-size:14px">Cod</td>
  </tr>
</table>




</body>
</html>