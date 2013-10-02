<?php

session_start();
if (!$_SESSION['email']) {
    header('location: login-form.php');
    exit;
}
include 'common/header.php';
include 'common/connection-db.php';

if (isset($_GET['id'])) {
    $id = mysql_real_escape_string($_GET['id']);
    $sql = 'delete from class_subject where id='.$id;
    $result = mysql_query($sql);
    $msg = '';
    if($result)
    {
        $msg = 'Successfull,success';
    } 
    else
        $msg = 'Error,danger';
    
    header("Location: subject-class-list.php?msg=".$msg);
}

?>