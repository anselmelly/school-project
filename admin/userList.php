<?php
session_start();
if (!$_SESSION['email']) {
    header('location: login-form.php');
    exit;
}


include 'common/connection-db.php';
/*
 * Output
 */
$aColumns = array('id', 'name', 'email', 'gender', 'dob', 'country', 'dept', 'view', 'edit', 'del');
$output = array(
    "aaData" => array()
);

$sql = "SELECT * FROM registration";
$query = mysql_query($sql);
$m = 1;
while ($row = mysql_fetch_array($query)) {
    $data = array();
    for ($i = 0; $i < count($aColumns); $i++) {

        switch ($aColumns[$i]) {

            case 'name':
                $data[] = $row['first_name'] . ' ' . $row['last_name'];
                break;
            case 'id':
                $data[] = $m;
                $m++;
                break;
            case 'view':
                $data[] = '<a href="details-view.php?id=' . $row['id'] . '">View</a>';
                break;
            case 'edit':
                $data[] = '<a href="../admin/update-profile.php?id=' . $row['id'] . '">Edit</a>';
                break;
            case 'del':
                $data[] = '<a href="delete-user.php?id=' . $row['id'] . '">Del</a>';
                break;
            default :
                $data[] = $row[$aColumns[$i]];
                break;
        }
    }
    $output['aaData'][] = $data;
}
echo json_encode($output);
?>