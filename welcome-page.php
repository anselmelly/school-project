<?php include 'header.php'; ?>
<?php include 'connection-db.php'; ?>
<?php
session_start();
if (!$_SESSION['email']) {
    header('location: login-form.php');
    exit;
}
?>

<div style="width: 600px; margin: 0 auto;">
    <h1>Welcome!!!</h1>

    <a href="update-profile.php"> <button type="button" class="btn btn-primary btn-lg btn-block">Update Profile</button></a>
    <br/>
    <a href="logout.php"><button type="button" class="btn btn-default btn-lg btn-block">Log out</button></a>
    <br/>
</div>

<?php include 'footer.php'; ?>