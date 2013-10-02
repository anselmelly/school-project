<html>
<head>
<title>PHPMailer - SMTP (Gmail) basic test</title>
</head>
<body>

<?php

//error_reporting(E_ALL);
error_reporting(E_STRICT);

date_default_timezone_set('America/Toronto');

require_once('../class.phpmailer.php');
//include("class.smtp.php"); // optional, gets called from within class.phpmailer.php if not already loaded

$mail             = new PHPMailer();

$body             = '<h2>Hello</h2>';//file_get_contents('contents.html');
//$body             = preg_replace('/[\]/','',$body);

$mail->IsSMTP(); // telling the class to use SMTP
//$mail->Host       = "mail.yourdomain.com"; // SMTP server
$mail->SMTPDebug  = 2;                     // enables SMTP debug information (for testing)
                                           // 1 = errors and messages
                                           // 2 = messages only
$mail->SMTPAuth   = true;                  // enable SMTP authentication
$mail->SMTPSecure = "ssl";                 // sets the prefix to the servier
$mail->Host       = "smtp.gmail.com";      // sets GMAIL as the SMTP server
$mail->Port       = 465;                   // set the SMTP port for the GMAIL server
$mail->Username   = "rokan.faith@gmail.com";  // GMAIL username
$mail->Password   = "nashpjj21kiankion21";            // GMAIL password

$mail->SetFrom('rokan.faith@gmail.com', 'First Last');

$mail->AddReplyTo("rokan.faith@gmail.com","First Last");

$mail->Subject    = "Test mail";

$mail->AltBody    = "Hello"; // optional, comment out and test

$mail->MsgHTML($body);

$address = "rokan.faith@gmail.com";
$mail->AddAddress($address, "John Doe");

//$mail->AddAttachment("images/phpmailer.gif");      // attachment
//$mail->AddAttachment("images/phpmailer_mini.gif"); // attachment

if(!$mail->Send()) {
  echo "Mailer Error: " . $mail->ErrorInfo;
} else {
  echo "Message sent!";
}

?>

</body>
</html>
