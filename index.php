
<?php
// multiple recipients
$to  = 'gabeshaughnessy@gmail.com' . ', '; // note the comma
$to .= 'gabe@myshirtbin.com';

// subject
$subject = 'Testing Email from shopify webhook';

// message
$message = '
<html>
<head>
  <title>Title</title>
</head>
<body>
  <p>first paragraph!</p>
  <table>
    <tr>
      <th>Barcode</th>
    </tr>
    <tr>
      <td><img src="includes/barcode.php?text=testing" alt="testing" /></td>
    </tr>
  </table>
</body>
</html>
';

// To send HTML mail, the Content-type header must be set
$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

// Additional headers
$headers .= 'To: fulfill@myshirtbin.com' . "\r\n";
$headers .= 'From: gabe@myshirtbin.com' . "\r\n";

// Mail it
mail($to, $subject, $message, $headers);
?>