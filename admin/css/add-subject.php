<?php
include 'common/connection-db.php';
if ($_POST) {
    error_reporting(E_ALL);
    $sub_code = htmlspecialchars($_POST['subcode']);
    $sub_name = htmlspecialchars($_POST['subname']);
    $sub_status = htmlspecialchars($_POST['substatus']);
    $id = htmlspecialchars($_POST['id']);

    $fields = "sub_code='" . $sub_code . "'," .
            "sub_name='" . $sub_name . "'," .
            "status=" . $sub_status;
    $error = 0;
    $msg = '';
    if ($sub_code == "" || $sub_name == "" || $sub_status == "") {
        $msg .= "Field is empty!!!<br/>";
    }


    $insert = 1;
    if ($id) {
        //edit
       $insert = 0;
       $sql = "UPDATE subject SET " .
        $fields .
        " where id=" . $id;
    } else {
        //insert
        $sql = "INSERT INTO subject" .
                "(sub_code, sub_name, status) " .
                "VALUES('" . $sub_code . "', '" . $sub_name . "', $sub_status )";
    }

    $query = mysql_query($sql) or die(mysql_error());
    if ($query) {
        if ($insert)
            $msg = 'Saved successfull,success';
        else
            $msg = 'Updated successfull,success';
    }else
        $msg = 'Error,danger';
    header("Location: subject-list.php?msg=" . $msg);
    exit;
}

$sub_code = '';
$sub_name = '';
$sub_status = '';
$id = isset($_GET['id']) ? $_GET['id'] : '';
if ($id) {
    $query = "SELECT * FROM subject where id='" . $_GET['id'] . "' limit 1";
    $result = mysql_query($query) or die(mysql_error());
    $row = mysql_fetch_assoc($result);
    $sub_code = $row['sub_code'];
    $sub_name = $row['sub_name'];
    $sub_status = $row['status'];
}
?>
<?php
include 'common/header.php';

?>
<script>
    $(document).ready(function() {
        $( "#addsubject" ).validate({
            rules: {
                "subcode":{
                    required: true
                },
                "subname":{
                    required: true
                }
            },

            messages: {
                "firstname": {
                    required: "Please, enter your subject code"
                },
                "subname": {
                    required: "Please, enter subject name"
                }
            }
        });
    });
</script>



<div class="container" style="width: 50%; background: #fff; margin-top: 30px; padding-top: 30px;">
    <form action="" method="POST" id="addsubject" class="form-horizontal" role="form" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?php echo $id ?>"/>
        <div class="form-group">
            <label for="subcode" class="col-lg-4 control-label">Subject Code</label>
            <div class="col-lg-8">
                <input type="text" name="subcode"  class="form-control" id="subcode" value="<?php echo $sub_code; ?>" placeholder="Subject Code">
            </div>
        </div>
        <div class="form-group">
            <label for="subname" class="col-lg-4 control-label">Subject Name</label>
            <div class="col-lg-8">
                <input type="text" name="subname" class="form-control" id="subname" value="<?php echo $sub_name; ?>" placeholder="subname">
            </div>
        </div>

        <div class="form-group">
            <label for="substatus" class="col-lg-4 control-label">Status</label>
            <div class="col-lg-8">
                <select id="substatus"  class="form-control" name="substatus">
                    <option value="Select Status">Select Status</option>
                    <option value="1" <?php if ($sub_status == '1') echo ' selected'; ?>>Enable</option>
                    <option value="0" <?php if ($sub_status == '0') echo ' selected'; ?>>Disable</option>
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