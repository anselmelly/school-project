<?php

include '../connection-db.php';
error_reporting(E_ALL);

if ($_POST) {
    $email = htmlspecialchars($_POST['email']);
    $pwd = htmlspecialchars($_POST['pwd']);

$sql = 'SELECT email 
        FROM admin 
        WHERE email = "' . $email . '" 
        AND password = "' . $pwd . '"';
    
    $query = mysql_query($sql) or die(mysql_error());
    $total = mysql_num_rows($query);
    if ($total > 0) {
        session_start();
        $_SESSION['email'] = $email;
//        $_SESSION['pwd'] = $pwd;
        header('location: users.php');
    } else {
        header('location: index.php?msg=Failed');
    }
    exit;
}
?>