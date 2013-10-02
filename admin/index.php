<!--
To change this template, choose Tools | Templates
and open the template in the editor.
-->
<!DOCTYPE html>
<html>
    <head>
        <title>School Project</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

        <!-- css -->

        <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css">
        <link rel="stylesheet" href="http://netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap-theme.min.css">

        <link href="dataTable/media/css/jquery.dataTables.css" rel="stylesheet">
        <link rel="stylesheet" href="css/style.css">

        <!-- js -->

        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
        <script src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>

        <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
        <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
        <script src="dataTable/media/js/jquery.dataTables.min.js" type="text/javascript"></script>
        <script src="../js/jquery.validate.js" type="text/javascript"></script>

    </head>
    <body>

        <div class="container" style="width: 50%; background: #fff; margin-top: 30px; padding-top: 30px;">
                                
            <form class="form-horizontal" action="login.php" role="form" method="POST" style="width: 400px; margin: 0 auto;">
                <div class="form-group">
                    <label for="inputEmail1" class="col-lg-2 control-label glyphicon glyphicon-user "> Email</label>
                    <div class="col-lg-10">
                        <input type="email" class="form-control" name="email" id="inputEmail1" placeholder="Email">
                    </div>
                </div>
                <div class="form-group">
                    <label for="password" class="col-lg-2 control-label glyphicon glyphicon-wrench"> Password</label>
                    <div class="col-lg-10">
                        <input type="password" name="pwd" class="form-control" id="password" placeholder="Password">
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
                        <button type="submit" class="btn btn-primary">Sign in</button>
                    </div>
                </div>
            </form>
            
            

        </div>
    </body>
</html>