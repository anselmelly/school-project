<?php include 'header.php'; ?>
<?php include 'connection-db.php'; ?>

<form class="form-horizontal" action="login.php" role="form" method="POST" style="width: 400px; margin: 0 auto;">
    <div class="form-group">
        <label for="inputEmail1" class="col-lg-2 control-label">Email</label>
        <div class="col-lg-10">
            <input type="email" class="form-control" name="email" id="inputEmail1" placeholder="Email">
        </div>
    </div>
    <div class="form-group">
        <label for="inputPassword1" class="col-lg-2 control-label">Password</label>
        <div class="col-lg-10">
            <input type="password" name="pwd" class="form-control" id="inputPassword1" placeholder="Password">
        </div>
    </div>
    <div class="form-group">
        <div class="col-lg-offset-2 col-lg-10">
            <div class="checkbox">
                <label>
                    <input type="checkbox"> Remember me
                </label>
            </div>
        </div>
    </div>

    <div class="form-group">
        <div class="col-lg-offset-2 col-lg-10">
            <button type="submit" class="btn btn-default">Sign in</button>
        </div>
        
    </div>
    <div class="form-group">
       <a style="color: #EF1E23; font-size: 14px; font-family: calibri; margin-left: 16px; text-decoration: none;" href="forgot-password.php">Forgot your password?</a>
       <a style="color: #EF1E23; font-size: 14px; font-family: calibri; margin-left: 16px; text-decoration: none;" href="registration-form.php">Don't have an account?</a> 
    </div>
</form>

<?php include 'footer.php'; ?>