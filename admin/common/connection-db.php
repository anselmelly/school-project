<?php

$host = "localhost";
$user = "root";
$password = "";

$connect = mysql_pconnect($host, $user, $password) or trigger_error(mysql_error(), E_USER_ERROR);


$db = "school-project";
mysql_select_db($db, $connect)
        or die("Could not connect database");
?>
