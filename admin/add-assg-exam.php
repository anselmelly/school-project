<?php
include 'common/connection-db.php';
if ($_POST) {
    error_reporting(E_ALL);
    $exam_id = htmlspecialchars($_POST['exam_id']);
    $doex = date("Y-m-d", strtotime(htmlspecialchars($_POST['datepicker'])));
    $exam_status = htmlspecialchars($_POST['examstatus']);
    $id = htmlspecialchars($_POST['id']);

    $fields = "exam_id='" . $exam_id . "'," .
            "exam_date='" . $doex . "'," .
            "status=" . $exam_status;

    $error = 0;
    $msg = '';
    if ($exam_id == "" || $doex == "" || $exam_status == "") {
        $msg .= "Field is empty!!!<br/>";
    }
    $insert = 1;
    if ($id) {
        //edit
        $insert = 0;
        $sql = "UPDATE exam SET " .
                $fields .
                " where id=" . $id;
    } else {
        //insert
        $sql = "INSERT INTO exam" .
                "(exam_id, exam_date, status) " .
                "VALUES('" . $exam_id . "', '" . $doex . "', $exam_status)";
    }

    $query = mysql_query($sql) or die(mysql_error());
    if ($query) {
        if ($insert)
            $msg = 'Saved successfull,success';
        else
            $msg = 'Updated successfull,success';
    }else
        $msg = 'Error,danger';
    header("Location: assg-exam-list.php?msg=" . $msg);
    exit;
}

$exam_id = '';
$doex = '';
$exam_status = '';
$id = isset($_GET['id']) ? $_GET['id'] : '';
if ($id) {
    $query = "SELECT * FROM exam where id='" . $_GET['id'] . "' limit 1";
    $result = mysql_query($query) or die(mysql_error());
    $row = mysql_fetch_assoc($result);
    $exam_id = $row['exam_id'];
    $doex = $row['exam_date'];
    $exam_status = $row['status'];
}
?>
<?php
include 'common/header.php';
?>
<script>
    $(document).ready(function() {
        $( "#assignexam" ).validate({
            rules: {
                "exam_id":{
                    required: true
                },
                "datepicker":{
                    required: true
                }
            },

            messages: {
                "exam_id": {
                    required: "Please, enter your exam code"
                },
                "datepicker": {
                    required: "Please, enter exam type"
                }
            }
        });
    });
</script>


<div class="container" style="width: 50%; background: #fff; margin-top: 30px; padding-top: 30px;">
    <form action="" method="POST" id="assignexam" class="form-horizontal" role="form" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?php echo $id ?>"/>
        <div class="form-group">
            <label for="examid" class="col-lg-4 control-label">Exam Type</label>
            <div class="col-lg-8">
                <?php
                $query = "SELECT * FROM exam_type where status=1";
                $result = mysql_query($query) or die(mysql_error());
                $exams = array();
                while ($row = mysql_fetch_array($result)) {
                    $exams[$row['id']] = $row['exam_name'];
                }
                ?>

                <select id="exam_id"  class="form-control" name="exam_id">
                    
                    <option value="">Select Exam</option>
                    <?php foreach ($exams as $key => $value): ?>
                        <option value="<?php echo $key ?>" <?php echo ($key == $exam_id) ? ' selected' : '' ?>><?php echo $value ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>


        <div class="form-group">
            <label for="dateofbirth" class="col-lg-4 control-label">Date of Exam</label>
            <div class="col-lg-8">
                <input type="text" id="datepicker" name="datepicker" class="form-control"  placeholder="Date of exam" value="<?php echo $doex; ?>" >
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