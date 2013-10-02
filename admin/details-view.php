<?php
include 'common/header.php';
include 'common/connection-db.php';
?>

<?php
if (isset($_GET['id'])) {
    $sql = "SELECT * FROM registration where id ='" . $_GET['id'] . "'";
    $q = mysql_query($sql);
    $row = mysql_fetch_assoc($q);
}
?>
<?php include 'nav.php'; ?>
<table class="table table-hover" style="width: 750px; margin: 0 auto;">
    <tr>
        <td>Name</td>
        <td><?php echo $row['first_name'] . ' ' . $row['last_name']; ?></td>
    </tr>
    <tr>
        <td>Email</td>
        <td><?php echo $row['email']; ?></td>
    </tr>
    <tr>
        <td>Gender</td>
        <td><?php echo $row['gender']; ?></td>
    </tr>
    <tr>
        <td>Date of birth</td>
        <td><?php echo $row['dob']; ?></td>
    </tr>
    <tr>
        <td>Country</td>
        <td><?php echo $row['country']; ?></td>
    </tr>
    <tr>
        <td>Department</td>
        <td><?php echo $row['dept']; ?></td>
    </tr>
    <tr>
        <td>Photo</td>
        <td><img src="../upload/<?php echo $row['photo']; ?>" /></td>
    </tr>
    
</table>

<?php include 'common/footer.php'; ?>