<?php

include 'connection-db.php';

if ($_POST) {
    error_reporting(E_ERROR);
    $first_name = htmlspecialchars($_POST['firstname']);
    $last_name = htmlspecialchars($_POST['lastname']);
    $email = htmlspecialchars($_POST['email']);
    $pwd = htmlspecialchars($_POST['pwd']);
    $gender = htmlspecialchars($_POST['sex']);
    $dob = date("Y-m-d", strtotime(htmlspecialchars($_POST['datepicker'])));
    $country = htmlspecialchars($_POST['country']);
    $dept = htmlspecialchars($_POST['dept']);
    $photo = htmlspecialchars($_POST['photo']);
    $agree = htmlspecialchars($_POST['checkbox']);

    $msg = '';
    if ($first_name == "" || $last_name == "" || $email == "" || $pwd == "" || $gender == "" || $dob == "" ||
            $country == "" || $dept == "" || $agree == "") {
        $msg .= "Field is empty!!!<br/>";
    }

    if (strlen($pwd) < 6) {
        $msg .= "password must be at least six digit <br/>";
    }

    $duplicate = mysql_query("SELECT email FROM registration WHERE email='" . $_POST['email'] . "'");
    if (mysql_num_rows($duplicate) > 0) {
        $msg .= '<b>Email already used.</b><br/>';
    }
    if ($msg) {
        header('Location: registration-form.php?msg=' . $msg);
        exit;
    }

    $fname = '';
    if (isset($_FILES["photo"]["name"])) {
        // image upload
        $uploads_dir = 'upload';
        $allowedExts = array("jpg", "jpeg", "gif", "png");
        $extension = end(explode(".", $_FILES["photo"]["name"]));

        if ($_FILES["photo"]["type"] == "image/gif" || $_FILES["photo"]["type"] == "image/jpg" || $_FILES["photo"]["type"] == "image/jpeg" || $_FILES["photo"]["type"] == "image/png" && $_FILES["photo"]["size"] < 2500000 && in_array($extension, $allowedExts)) {

            if ($_FILES["photo"]["error"] > 0) {

                echo "Error: " . $_FILES["photo"]["error"] . "<br />";
            } else {

                $fname = rand(1002, 102124).$_FILES["photo"]["name"];
                $move = move_uploaded_file($_FILES['photo']['tmp_name'], "$uploads_dir/$fname");
                if ($move) {
                    echo "image upload successfully";
                } else {
                    echo "image uplaod fail";
                }
            }
        } else {

            echo "Invalid file type";
        }
    }

    $sql = "INSERT INTO registration " .
            "(first_name, last_name, email, password, gender, dob, country, dept,photo) " .
            "VALUES('" . $first_name . "', '" . $last_name . "', '" . $email . "', '" . $pwd . "', '" . $gender . "', '" . $dob . "', 
           '" . $country . "', '" . $dept . "','" . $fname . "')";


    $query = mysql_query($sql) or die(mysql_errno());
    if ($query) {
        require_once('PHPMailer/class.phpmailer.php');


        $mail = new PHPMailer();

        $body = '<h2>Hello</h2>'; //file_get_contents('contents.html');
//$body             = preg_replace('/[\]/','',$body);

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

        $mail->Subject = "Test mail";

        $mail->AltBody = "Hello"; // optional, comment out and test

        $mail->MsgHTML($body);

        $address = $email;
        $mail->AddAddress($address);

//$mail->AddAttachment("images/phpmailer.gif");      // attachment
//$mail->AddAttachment("images/phpmailer_mini.gif"); // attachment

        if (!$mail->Send()) {
            echo "Mailer Error: " . $mail->ErrorInfo;
        } else {
            echo "Message sent!";
        }
    }
}
?>
