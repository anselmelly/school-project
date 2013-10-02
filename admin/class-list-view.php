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
$aColumns = array('id', 'class_code', 'class_name', 'status', 'edit', 'del');
$output = array(
    "aaData" => array()
);

$sql = "SELECT * FROM class";
$query = mysql_query($sql);
$m = 1;
while ($row = mysql_fetch_array($query)) {
    $data = array();
    for ($i = 0; $i < count($aColumns); $i++) {

        switch ($aColumns[$i]) {

            case 'id':
                $data[] = $m;
                $m++;
                break;
            case 'status':
                $data[] = (($row['status']) ? 'Enable' : 'Disable');
                break;

            case 'edit':
                $data[] = '<a href="add-class.php?id=' . $row['id'] . '">Edit</a>';
                break;
            case 'del':
                $data[] = '<a href="delete-class.php?id=' . $row['id'] . '">Del</a>';
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