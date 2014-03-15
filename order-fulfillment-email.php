
<?php
$debug = false;
$webhookContent = json_decode(file_get_contents('php://input'), true);
$server_location = 'http://gabesimagination.com/myshirtbin-app/';

//order number
	if(isset($webhookContent['order_number'])){
		$order_number = $webhookContent['order_number'];
	}
	else {
		$order_number = 'no order number';
	}
//created at
	if(isset($webhookContent['created_at'])){
		$created_at = '' ;//date('d/m/Y', $webhookContent['created_at']);
	}
	else {
		$created_at = 'no created at date';
	}
//Billing Details
	//name
	if(isset($webhookContent['billing_address']['name'])){
		$billing_name = $webhookContent['billing_address']['name'];
	}
	else{
		$billing_name = 'no billing name';
	}
	//address 1
	if(isset($webhookContent['billing_address']['address1'])){
		$billing_address_1 = $webhookContent['billing_address']['address1'];
	}
	else{
		$billing_address_1 = 'no billing address';
	}
	//address 2
	if(isset($webhookContent['billing_address']['address2'])){
		$billing_address_2 = $webhookContent['billing_address']['address2'];
	}
	else{
		$billing_address_2 = '';
	}
	//city
	if(isset($webhookContent['billing_address']['city'])){
		$billing_city = $webhookContent['billing_address']['city'];
	}
	else{
		$billing_city = 'no billing city';
	}
	//province
	if(isset($webhookContent['billing_address']['province'])){
		$billing_province = $webhookContent['billing_address']['province'];
	}
	else{
		$billing_province = 'no billing province';
	}
	//zip
	if(isset($webhookContent['billing_address']['zip'])){
		$billing_zip = $webhookContent['billing_address']['zip'];
	}
	else{
		$billing_zip = 'no billing address';
	}
	//country
	if(isset($webhookContent['billing_address']['country'])){
		$billing_country = $webhookContent['billing_address']['country'];
	}
	else{
		$billing_country = 'no billing country';
	}
	//phone
	if(isset($webhookContent['billing_address']['phone'])){
		$billing_phone = $webhookContent['billing_address']['phone'];
	}
	else{
		$billing_phone = 'no shipping phone';
	}
//Shipping Details
	//name
	if(isset($webhookContent['shipping_address']['name'])){
		$shipping_name = $webhookContent['shipping_address']['name'];
	}
	else{
		$shipping_name = 'no shipping name';
	}
	//address 1
	if(isset($webhookContent['shipping_address']['address1'])){
		$shipping_address_1 = $webhookContent['shipping_address']['address1'];
	}
	else{
		$shipping_address_1 = 'no shipping address';
	}
	//address 2
	if(isset($webhookContent['shipping_address']['address2'])){
		$shipping_address_2 = $webhookContent['shipping_address']['address2'];
	}
	else{
		$shipping_address_2 = '';
	}
	//city
	if(isset($webhookContent['shipping_address']['city'])){
		$shipping_city = $webhookContent['shipping_address']['city'];
	}
	else{
		$shipping_city = 'no shipping city';
	}
	//province
	if(isset($webhookContent['shipping_address']['province'])){
		$shipping_province = $webhookContent['shipping_address']['province'];
	}
	else{
		$shipping_province = 'no shipping province';
	}
	//zip
	if(isset($webhookContent['shipping_address']['zip'])){
		$shipping_zip = $webhookContent['shipping_address']['zip'];
	}
	else{
		$shipping_zip = 'no shipping address';
	}
	//country
	if(isset($webhookContent['shipping_address']['country'])){
		$shipping_country = $webhookContent['shipping_address']['country'];
	}
	else{
		$shipping_country = 'no shipping country';
	}
	//phone
	if(isset($webhookContent['shipping_address']['phone'])){
		$shipping_phone = $webhookContent['shipping_address']['phone'];
	}
	else{
		$shipping_phone = 'no shipping phone';
	}
// END SHIPPING

//LINE ITEMS 
	if(isset($webhookContent['line_items'])){
		$line_items = $webhookContent['line_items'];
	}
	else{
		$line_items = 'no line items';
	}

//cart note
	if(isset($webhookContent['note'])){
		$cart_note = $webhookContent['note'];
	}
	else{
		$cart_note = '';
	}

//cart totals 
	//taxes
	if(isset($webhookContent['total_tax'])){
		$total_tax = $webhookContent['total_tax'];
	}
	else{
		$total_tax = '0.00';
	}
	//shipping cost
	if(isset($webhookContent['shipping_lines']['price'])){
		$shipping_cost = $webhookContent['shipping_lines']['price'];
	}
	else{
		$shipping_cost = '0.00';
	}
	//subtotal price
	if(isset($webhookContent['subtotal_price'])){
		$subtotal_price = $webhookContent['subtotal_price'];
	}
	else{
		$subtotal_price = '0.00';
	}
	//total price
	if(isset($webhookContent['total_price'])){
		$total_price = $webhookContent['total_price'];
	}
	else{
		$total_price = '0.00';
	}

//set up email variables.

$to  = 'fulfill@myshirtbin.com'; // note the comma
// subject
$subject = 'MyShirtBin Fulfillment Notification for Order '.$order_number;
$barcode = '<img src="'.$server_location.'includes/barcode.php?text='.$order_number.'" alt="Order Number Barcode '.$order_number.'"  width="100%" />';

// message
$message = '';
if($debug === true){
	$message .= '<p> Debug Content: '.print_r($webhookContent, true).'</p>';
}
$message .='
<html>
<head>
  <title>'.$subject.'</title>
</head>
<body>';
$message .= '
<table width="100%">
<tbody>
	<tr>';

//logo and details
$message .= '
	<td>
		<img src="'.$server_location.'includes/logo.png" alt="MyShirtBin.com"  width="100%" style="max-width:300px; max-height:52px;" />
		<p>Invoice/Order #'.$order_number.' <strong>|</strong> Date: '.$created_at.'</p>
	</td> ';

//barcode
$message .= '	<td>
		'.$barcode.'
	</td>';

//sold to
$message .= 
	'</tr>
	<tr>
		<td width="50%">
			<p><strong>SOLD TO:</strong><br />'.
			$billing_name.'<br />'.
			$billing_address_1.', '.$billing_address_2.'<br />'.
			$billing_city.', '.$billing_province.', '.$billing_zip.', '.$billing_country.'<br />'.
			$billing_phone
			.'</p>
		</td>';
//shipped to
$message .= 
		'<td width="50%">
			<p><strong>SHIP TO:</strong><br />'.
				$shipping_name.'<br />'.
				$shipping_address_1.', '.$shipping_address_2.'<br />'.
				$shipping_city.', '.$shipping_province.', '.$shipping_zip.', '.$shipping_country.'<br />'.
				$shipping_phone
			.'</p>
		</td>';
$message .= '
	</tr></tbody></table>';
$message .= '	<table width="100%" style ="border: 1px solid #ccc;"><thead style="background-color: #aaa;">
	<tr>';
$message .='<th >Description</th><th>Qty</th><th>Price</th><th>Total</th></tr></thead><tbody>';

//Line Items
if(is_array($line_items) && count($line_items) > 0){
	foreach ($line_items as $line_item) {
		$message .=
		'<tr >
			<td width="60%" style ="border-bottom: 1px solid #ccc; border-right: 1px solid #ccc; text-align:left;">'.$line_item['title'].($line_item['variant_title'] != '' ? ' | '.$line_item['variant_title'] : '').'</td>
			<td width="10%" style ="border-bottom: 1px solid #ccc; border-right: 1px solid #ccc; text-align:right;">'.$line_item['quantity'].'</td>
			<td width="10%" style ="border-bottom: 1px solid #ccc; border-right: 1px solid #ccc; text-align:right;">$'.$line_item['price'].'</td>
			<td width="10%" style ="border-bottom: 1px solid #ccc; text-align:right;">$'.$line_item['price']*$line_item['quantity'].'</td>
		</tr>';
	}	
}
$message .= '</tbody></table>';
$message .= '<table width="100%"><tbody>
	<tr>';
$message .='<td width="70%">'.$cart_note.'</td>
<td width="30%">
	<p>
		<span style="text-align: left; width:50%; display:block; float: left;">Subtotal</span><span style="text-align: right; width:50%; display: block; float: right;">'.$subtotal_price.'</span>
		<span style="text-align: left; width:50%; display: block; float: left;">Taxes</span><span style="text-align: right; width:50%; display: block; float: right;">'.$total_tax.'</span>
		<span style="text-align: left; width:50%; display:block; float: left;">Shipping</span><span style="text-align: right; width:50%; display: block; float: right;">'.$shipping_cost.'</span>
		<span style="text-align: left; width:50%; display: block; float: left;"><strong>Total</strong></span><span style="text-align: right; width:50%; display: block; float: right;">'.$total_price.'</span>
	</p>
</td>';
$message .='</tr></tbody></table>';
$message .= '
<p style="text-align:center; width:100%;"><strong>Thanks for shopping at <a style="text-decoration: none;" href="http://myshirtbin.com" title="Visit My Shirt Bin" target="_blank" >MyShirtBin.com</a></strong></p>
</body>
</html>';

// To send HTML mail, the Content-type header must be set
$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

// Additional headers
$headers .= 'From: orders@myshirtbin.com' . "\r\n";

// Mail it
mail($to, $subject, $message, $headers);
?>