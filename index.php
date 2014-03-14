
<?php
//where does this application live?
$server_location = 'http://gabesimagination.com/myshirtbin-app/';
/* get webhook data from Shopify and assign it to variables */
$webhookContent = "";

$webhook = fopen('php://input' , 'rb');
while (!feof($webhook)) {
    $webhookContent .= fread($webhook, 4096);
     $webhookContent = json_decode($webhookContent, true);
}
fclose($webhook);

//order number
	if(isset($webhookContent['order_number'])){
		$order_number = $webhookContent['order_number'];
	}
	else {
		$order_number = 'no order number';
	}
//created at
	if(isset($webhookContent['created_at'])){
		$created_at = date('d/m/Y', $webhookContent['created_at']);
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



//set up email varialbles.

$to  = 'gabeshaughnessy@gmail.com'; // note the comma
// subject
$subject = 'Email from shopify webhook '.$order_number;


// message
$message = '';
$message .='
<html>
<head>
  <title>Title</title>
</head>
<body>';
$message .= '
<table>
	<tr>';

//logo and details
$message .= '
	<td>
		<img src="'.$server_location.'includes/logo.png" alt="My Shirt Bin Logo"  width="500px" height ="86px" />
		<p>Invoice/Order #'.$order_number.' <strong>|</strong> Date: '.$created_at.'</p>
	</td> ';

//barcode
$message .= '	<td>
		<img src="'.$server_location.'includes/barcode.php?text='.$order_number.'" alt="'.$order_number.'"  width="300px" height ="75px" />
	</td>';

//sold to
$message .= 
	'</tr>
	<tr><td>
		<p><strong>SOLD TO:</strong><br />'.
		$billing_name.'<br />'.
		$billing_address_1.', '.$billing_address_2.'<br />'.
		$billing_city.', '.$billing_province.', '.$billing_zip.', '.$billing_country		
	.'</td>';

//shipped to
$message .= '	<td>
	<p><strong>SHIP TO:</strong><br />	
</td>';
$message .= '
	</tr>
</table>';
$message .= '
<table>

</table>
<p>'.print_r($webhookContent, true).'</p>
</body>
</html>
	';

// To send HTML mail, the Content-type header must be set
$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

// Additional headers
$headers .= 'To: fulfill@myshirtbin.com' . "\r\n"; //another way to add a too address here.
$headers .= 'From: gabe@myshirtbin.com' . "\r\n";

// Mail it
mail($to, $subject, $message, $headers);
?>