<?php
include 'common/connection-db.php';

if ($_POST) {
    error_reporting(E_ALL);
    $class_id = htmlspecialchars($_POST['class']);
    $subjects = $_POST['subjects'];
    $id = htmlspecialchars($_POST['id']);
    $ids = implode(',', $subjects);


    $error = 0;
    $msg = '';
    $insert = 1;

    if (!$id) {
        $sql = 'insert into class_subject (class_id,subject_id) values(' . $class_id . ', "' . $ids . '")';
        $query = mysql_query($sql);
        if ($insert) {
            $msg = 'Saved successfull,success';
        }else
            $msg = 'Can not saved,failed';
        header("Location: subject-class-list.php?msg=" . $msg);
        exit;
    } else {
        //update
        $sql = 'update class_subject set class_id = ' . $class_id . ', subject_id= "' . $ids . '" where id = ' . $id;
        $qyery = mysql_query($sql);
        if ($insert) {
            $msg = 'Updated successfully,success';
        }else
            $msg = 'Can not updated,failed';
        header("Location: subject-class-list.php?msg=" . $msg);
        exit;
    }
}

$class_id = '';
$subjects = array();
$id = isset($_GET['id']) ? $_GET['id'] : '';
if ($id) {
    $query = "SELECT * FROM class_subject where id='" . $_GET['id'] . "'";
    $result = mysql_query($query) or die(mysql_error());
    while ($row = mysql_fetch_assoc($result)) {
        $class_id = $row['class_id'];
        $subjects = $row['subject_id'];
    }
    $subjects = explode(',', $subjects);
}
?>
<?php
include 'common/header.php';
?>
<script>
    $(document).ready(function() {
        $( "#subclassmap" ).validate({
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
    <form action="" method="POST" id="subclassmap" class="form-horizontal" role="form" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?php echo $id ?>"/>
        <div class="form-group">
            <label for="classid" class="col-lg-4 control-label">Class</label>
            <div class="col-lg-8">
                <?php
                $query = "SELECT * FROM class where status=1";
                $result = mysql_query($query) or die(mysql_error());
                $class = array();
                while ($row = mysql_fetch_array($result)) {
                    $class[$row['id']] = $row['class_name'];
                }
                ?>
                <select id="class"  class="form-control" name="class">
                    <option value="">Select Class</option>
                    <?php foreach ($class as $key => $value): ?>
                        <option value="<?php echo $key ?>" <?php echo ($key == $class_id) ? ' selected' : '' ?>><?php echo $value ?></option>

                    <?php endforeach; ?>
                </select>
            </div>
        </div>

        <div class="form-group">
            <label for="classid" class="col-lg-4 control-label">Subject</label>
            <div class="col-lg-8">
                <?php
                $query = "SELECT * FROM subject where status=1";
                $result = mysql_query($query) or die(mysql_error());
                $sub = array();
                while ($row = mysql_fetch_array($result)) {
                    $sub[$row['id']] = $row['sub_name'];
                }
                ?>
                <?php foreach ($sub as $key => $value): ?>
                    <div class="col-lg-14">
                        <input <?php echo in_array($key, $subjects) ? 'checked' : ''; ?> type="checkbox" name="subjects[]" value="<?php echo $key ?>" > &nbsp;<?php echo $value ?>
                    </div>
                <?php endforeach; ?>
            </div>

        </div>
        <div class="form-group" style="float: left; margin-left: 145px;">
            <div class="col-lg-2">
                <button type="submit" id="sub" name="sub" class="btn btn-danger" value="Validate!">Submit</button>
            </div>
        </div>

    </form>
</div>
<?php include 'common/footer.php'; ?>