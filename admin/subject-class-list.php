<?php
session_start();
if (!$_SESSION['email']) {
    header('location: login-form.php');
    exit;
}
include 'common/header.php';
include 'common/connection-db.php';
?>

<?php if (isset($_GET['msg'])): ?>
    <?php
    $msg = explode(',', $_GET['msg']);
    $message = $msg[0];
    $css_class = $msg[1];
    ?>
    <div class="alert alert-<?php echo $css_class ?>">
        <?php echo $message; ?>
    </div>
<?php endif; ?>
<h2 style="margin: 0 0 0 15px;">Exam <a class="pull-right" href="add-class-subject.php"><button type="button" class="btn btn-primary navbar-btn">Map class-subject</button></a></h2>
<hr>
<div id="users" style="margin-bottom: 20px;"></div>
<script>
    $(document).ready(function() {
        $('#users').html( '<table cellpadding="0" cellspacing="0" border="0" class="display" id="sub_list"></table>' );
        $('#sub_list').dataTable( {
            "aoColumns": [
                { "sTitle": "id" },
                { "sTitle": "Class" },
                { "sTitle": "subject" },
                { "sTitle": "edit" },
                { "sTitle": "del" }
            ],
            "bProcessing": true,
            "sAjaxSource": 'sub-class-list-view.php'
        } );   
    } );
</script>

<?php
//include 'common/footer.php'; ?>