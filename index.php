
<?php
// multiple recipients
$to  = 'gabeshaughnessy@gmail.com' . ', '; // note the comma

$webhookContent = "";

$webhook = fopen('php://input' , 'rb');
while (!feof($webhook)) {
    $webhookContent .= fread($webhook, 4096);
     $webhookContent = json_decode($webhookContent, true);
}
fclose($webhook);


if(isset($webhookContent['order_number'])){
	$order_number = $webhookContent['order_number'];
}
else {
	$order_number = 'no order number';
}
// subject
$subject = 'Email from shopify webhook '.$order_number;

$server_location = 'http://gabesimagination.com/myshirtbin-app/';
// message
$message = '
<html>
<head>
  <title>Title</title>
</head>
<body>
  <p>'.print_r($webhookContent, true).'</p>
  <table>
    <tr>
      <th>Barcode</th>
    </tr>
    <tr>
      <td><img src="'.$server_location.'includes/barcode.php?text='.$order_number.'" alt="'.$order_number.'"  width="300px" height ="75px" /></td>
    </tr>
  </table>
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