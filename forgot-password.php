<?php
session_start();
include 'connection-db.php';
include 'header.php';
error_reporting(E_ALL);

if ($_POST) {
    error_reporting(E_ERROR);
    $email = htmlspecialchars($_POST['email']);
    $query = "SELECT password FROM registration where email = '".$email."'";
    $result = mysql_query($query) or die(mysql_error());
    $row = mysql_fetch_array($result);
    
    if ($result) {
        require_once('PHPMailer/class.phpmailer.php');
        $mail = new PHPMailer();

        $body = '<p>Email : ' . $email . '</p>' . '<p>Password : ' . $row['password'] . '</p>';

        $mail->IsSMTP(); // telling the class to use SMTP
        //$mail->Host       = "mail.yourdomain.com"; // SMTP server
        //$mail->SMTPDebug = 2;                     // enables SMTP debug information (for testing)
        // 1 = errors and messages
        // 2 = messages only
        $mail->SMTPAuth = true;                  // enable SMTP authentication
        $mail->SMTPSecure = "ssl";                 // sets the prefix to the servier
        $mail->Host = "smtp.gmail.com";      // sets GMAIL as the SMTP server
        $mail->Port = 465;                   // set the SMTP port for the GMAIL server
        $mail->Username = "rokan.faith@gmail.com";  // GMAIL username
        $mail->Password = "nashpjj21kiankion21";            // GMAIL password


        $mail->SetFrom('rokan.faith@gmail.com', 'First Last');

        $mail->AddReplyTo("rokan.faith@gmail.com", "First Last");

        $mail->Subject = "Your password";

        $mail->AltBody = "Hello"; // optional, comment out and test

        $mail->MsgHTML($body);

        $address = $email;
        $mail->AddAddress($address);

//$mail->AddAttachment("images/phpmailer.gif");      // attachment
//$mail->AddAttachment("images/phpmailer_mini.gif"); // attachment

        if (!$mail->Send()) {
            echo "Mailer Error: " . $mail->ErrorInfo;
        } else {
            echo "Password has been sent in your email";
        }
    }
}
?>
<form style="margin: 0 auto; width: 500px;" id="forgotpassword" action="" method="POST"  class="form-horizontal" role="form" enctype="multipart/form-data">
    <div class="form-group">
        <label for="email" class="col-lg-4 control-label">Email</label>
        <div class="col-lg-8">
            <input type="email" name="email"  class="form-control" id="fristname" placeholder="email"><br/>
            <button type="submit" id="sub" name="sub" class="btn btn-danger" value="Validate!">Submit</button>
        </div>

    </div>

</form>



<script>
    $(document).ready(function() {
        $( "#forgotpassword" ).validate({
            rules: {
                "email":{
                    required: true
                }
            },

            messages: {
                "email": {
                    required: "Please, enter your email"
                }
            }
        });
    });
</script>
<?php include 'footer.php'; ?>
