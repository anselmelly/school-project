<?php

session_start();
if (!$_SESSION['email']) {
    header('location: login-form.php');
    exit;
}
include 'common/connection-db.php';

function getSubjets($ids)
{
    $subjects = '';
    $sql = "select * from subject where id IN ($ids)";
    $result = mysql_query($sql);
    while($row = mysql_fetch_assoc($result))
    {
        $subjects.=$row['sub_name'].',';
    }
    return rtrim($subjects, ',');
}
/*
 * Output
 */
$aColumns = array('id', 'class_id', 'subject_id', 'edit', 'del');
$output = array(
    "aaData" => array()
);

$sql = "SELECT cs.id,cs.subject_id as subjects,c.class_name as classname FROM class_subject cs inner join class c on (cs.class_id=c.id)";
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
            case 'class_id':
                $data[] = $row['classname'];
                break;

            case 'subject_id':
                $data[] = getSubjets($row['subjects']);
                break;

            case 'edit':
                $data[] = '<a href="add-class-subject.php?id=' . $row['id'] . '">Edit</a>';
                break;
            case 'del':
                $data[] = '<a href="delete-class-subject.php?id=' . $row['id'] . '">Del</a>';
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