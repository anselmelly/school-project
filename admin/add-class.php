<?php
include 'common/connection-db.php';
if ($_POST) {
    error_reporting(E_ALL);
    $class_code = htmlspecialchars($_POST['classcode']);
    $class_name = htmlspecialchars($_POST['classname']);
    $class_status = htmlspecialchars($_POST['class_status']);
    $id = htmlspecialchars($_POST['id']);

    $fields = "class_code='" . $class_code . "'," .
            "class_name='" . $class_name . "'," .
            "status=" . $class_status;
    $error = 0;
    $msg = '';
    if ($class_code == "" || $class_name == "" || $class_status == "") {
        $msg .= "Field is empty!!!<br/>";
    }


    $insert = 1;
    if ($id) {
        //edit
       $insert = 0;
       $sql = "UPDATE class SET " .
        $fields .
        " where id=" . $id;
    } else {
        //insert
        $sql = "INSERT INTO class" .
                "(class_code, class_name, status) " .
                "VALUES('" . $class_code . "', '" . $class_name . "', $class_status )";
    }

    $query = mysql_query($sql) or die(mysql_error());
    if ($query) {
        if ($insert)
            $msg = 'Saved successfull,success';
        else
            $msg = 'Updated successfull,success';
    }else
        $msg = 'Error,danger';
    header("Location: class-list.php?msg=" . $msg);
    exit;
}

$class_code = '';
$class_name = '';
$class_status = '';
$id = isset($_GET['id']) ? $_GET['id'] : '';
if ($id) {
    $query = "SELECT * FROM class where id='" . $_GET['id'] . "' limit 1";
    $result = mysql_query($query) or die(mysql_error());
    $row = mysql_fetch_assoc($result);
    $class_code = $row['class_code'];
    $class_name = $row['class_name'];
    $class_status = $row['status'];
}
?>
<?php
include 'common/header.php';

?>
<script>
    $(document).ready(function() {
        $( "#addclass" ).validate({
            rules: {
                "classcode":{
                    required: true
                },
                "classname":{
                    required: true
                }
            },

            messages: {
                "classcode": {
                    required: "Please, enter your subject code"
                },
                "classname": {
                    required: "Please, enter subject name"
                }
            }
        });
    });
</script>



<div class="container" style="width: 50%; background: #fff; margin-top: 30px; padding-top: 30px;">
    <form action="" method="POST" id="addclass" class="form-horizontal" role="form" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?php echo $id ?>"/>
        <div class="form-group">
            <label for="classcode" class="col-lg-4 control-label">Class Code</label>
            <div class="col-lg-8">
                <input type="text" name="classcode"  class="form-control" id="classcode" value="<?php echo $class_code; ?>" placeholder="class Code">
            </div>
        </div>
        <div class="form-group">
            <label for="classname" class="col-lg-4 control-label">Class Name</label>
            <div class="col-lg-8">
                <input type="text" name="classname" class="form-control" id="classname" value="<?php echo $class_name; ?>" placeholder="classname">
            </div>
        </div>

        <div class="form-group">
            <label for="class_status" class="col-lg-4 control-label">Status</label>
            <div class="col-lg-8">
                <select id="class_status"  class="form-control" name="class_status">
                    <option value="Select Status">Select Status</option>
                    <option value="1" <?php if ($class_status == '1') echo ' selected'; ?>>Enable</option>
                    <option value="0" <?php if ($class_status == '0') echo ' selected'; ?>>Disable</option>
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