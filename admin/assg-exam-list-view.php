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
$aColumns = array('id', 'exam_id', 'exam_date', 'status', 'edit', 'del', 'view');
$output = array(
    "aaData" => array()
);

$sql = "SELECT e.*,et.exam_name as name FROM exam e inner join exam_type et on (e.exam_id=et.id)";
$query = mysql_query($sql);
$m = 1;
while ($row = mysql_fetch_assoc($query)) {
    $data = array();
    for ($i = 0; $i < count($aColumns); $i++) {

        switch ($aColumns[$i]) {

            case 'id':
                $data[] = $m;
                $m++;
                break;
            case 'exam_id':
                $data[] = $row['name'];
                break;
            case 'status':
                $data[] = (($row['status']) ? 'Enable' : 'Disable');
                break;

            case 'edit':
                $data[] = '<a href="add-assg-exam.php?id=' . $row['id'] . '">Edit</a>';
                break;

            case 'del':
                $data[] = '<a href="delete-assg-exam.php?id=' . $row['id'] . '">Del</a>';
                break;

            case 'view':
                $data[] = '<a href="student-view.php?id=' . $row['id'] . '">View</a>';
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