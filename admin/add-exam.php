<?php
include 'common/connection-db.php';
if ($_POST) {
    error_reporting(E_ALL);
    $exam_code = htmlspecialchars($_POST['examcode']);
    $exam_name = htmlspecialchars($_POST['examname']);
    $exam_status = htmlspecialchars($_POST['examstatus']);
    $id = htmlspecialchars($_POST['id']);

    $fields = "exam_code='" . $exam_code . "'," .
            "exam_name='" . $exam_name . "'," .
            "status=" . $exam_status;

    $error = 0;
    $msg = '';
    if ($exam_code == "" || $exam_name == "" || $exam_status == "") {
        $msg .= "Field is empty!!!<br/>";
    }
    $insert = 1;
    if ($id) {
        //edit
        $insert = 0;
        $sql = "UPDATE exam_type SET " .
                $fields .
                " where id=" . $id;
    } else {
        //insert
        $sql = "INSERT INTO exam_type" .
                "(exam_code, exam_name, status) " .
                "VALUES('" . $exam_code . "', '" . $exam_name . "', $exam_status)";
    }

    $query = mysql_query($sql) or die(mysql_error());
    if ($query) {
        if ($insert)
            $msg = 'Saved successfull,success';
        else
            $msg = 'Updated successfull,success';
    }else
        $msg = 'Error,danger';
    header("Location: exam-list.php?msg=" . $msg);
    exit;
}

$exam_code = '';
$exam_name = '';
$exam_status = '';
$id = isset($_GET['id']) ? $_GET['id'] : '';
if ($id) {
    $query = "SELECT * FROM exam_type where id='" . $_GET['id'] . "' limit 1";
    $result = mysql_query($query) or die(mysql_error());
    $row = mysql_fetch_assoc($result);
    $exam_code = $row['exam_code'];
    $exam_name = $row['exam_name'];
    $exam_status = $row['status'];
}
?>
<?php
include 'common/header.php';
?>
<script>
    $(document).ready(function() {
        $( "#addexam" ).validate({
            rules: {
                "examcode":{
                    required: true
                },
                "examname":{
                    required: true
                }
            },

            messages: {
                "classcode": {
                    required: "Please, enter your exam code"
                },
                "examname": {
                    required: "Please, enter exam type"
                }
            }
        });
    });
</script>



<div class="container" style="width: 50%; background: #fff; margin-top: 30px; padding-top: 30px;">
    <form action="" method="POST" id="addexam" class="form-horizontal" role="form" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?php echo $id ?>"/>
        <div class="form-group">
            <label for="examcode" class="col-lg-4 control-label">Exam Code</label>
            <div class="col-lg-8">
                <input type="text" name="examcode"  class="form-control" id="examcode" value="<?php echo $exam_code; ?>" placeholder="exam Code">
            </div>
        </div>
        <div class="form-group">
            <label for="examname" class="col-lg-4 control-label">Exam type</label>
            <div class="col-lg-8">
                <input type="text" name="examname" class="form-control" id="examname" value="<?php echo $exam_name; ?>" placeholder="class name">
            </div>
        </div>

        <div class="form-group">
            <label for="examstatus" class="col-lg-4 control-label">Status</label>
            <div class="col-lg-8">
                <select id="examstatus"  class="form-control" name="examstatus">
                    <option value="Select Status">Select Status</option>
                    <option value="1" <?php if ($exam_status == '1') echo ' selected'; ?>>Enable</option>
                    <option value="0" <?php if ($exam_status == '0') echo ' selected'; ?>>Disable</option>
                </select>
            </div>
        </div>

        <div class="form-group">
            <div class="col-lg-offset-9">
                <button type="submit" id="sub" name="sub" class="btn btn-danger" value="Validate!">Submit</button>
            </div>
        </div>

    </form>
</div>
<?php include 'common/footer.php'; ?>