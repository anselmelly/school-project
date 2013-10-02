<?php

session_start();
if (!$_SESSION['email']) {
    header('location: logout.php');
    exit;
}
include 'common/header.php';
include 'common/connection-db.php';
?>

    <?php include 'nav.php'; ?>

<?php //include 'common/footer.php'; ?>