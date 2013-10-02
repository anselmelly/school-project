<?php
session_start();
if (!$_SESSION['email']) {
    header('location: login-form.php');
    exit;
}
include 'common/header.php';
include 'common/connection-db.php';
?>

<?php
if (isset($_GET['id'])) {
    $id = mysql_real_escape_string($_GET['id']);
    $sql = 'select from registration where id='.$id;
   // $sql = "SELECT * FROM registration where id ='" . $_GET['id'] . "'";
    $result = mysql_query($sql);
    $q = mysql_query($result);

    while ($row = mysql_fetch_array($q)) {
        echo $row['first_name'] . " " . $row['last_name'];
        echo "<br>";
    }
}
?>

