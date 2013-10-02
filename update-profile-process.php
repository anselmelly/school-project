<?php

session_start();
include 'connection-db.php';
if ($_SESSION['email']) {
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

    $query = "SELECT * FROM registration";
    $result = mysql_query($query) or die(mysql_error());

    while ($row = mysql_fetch_assoc($result)) {
        $first_name = $row['first_name'];
        $last_name = $row['last_name'];
        $email = $row['email'];
        $pwd = $row['password'];
        $gender = $row['gender'];
        $dob = $row['dob'];
        $country = $row['country'];
        $dept = $row['dept'];
        $photo = $row['photo'];
    }
}
?>
