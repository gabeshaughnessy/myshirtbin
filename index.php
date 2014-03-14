
<?php
// multiple recipients
$to  = 'gabeshaughnessy@gmail.com' . ', '; // note the comma

// subject
$subject = 'Another Testing Email from shopify webhook';
$server_location = 'http://gabesimagination.com/myshirtbin-app/';
// message
$message = '
<html>
<head>
  <title>Title</title>
</head>
<body>
  <p>'.print_r($_POST, true).'</p>
  <table>
    <tr>
      <th>Barcode</th>
    </tr>
    <tr>
      <td><img src="'.$server_location.'includes/barcode.php?text=testing" alt="testing"  width="300px" height ="75px" /></td>
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