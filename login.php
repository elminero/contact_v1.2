<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" type="text/css" href="css/main.css"/>
    <title>Login</title>
</head>
<body>
<div class="container">
    <nav class="navbar navbar-default navbar-header" style="background-color: #1b6d85;" >
        <div class="navbar-header" >
            <ul class="nav navbar-nav" >
                <li><a href="index.php">Home</a></li>
                <li class="active"><a href="login.php">Login</a></li>
            </ul>
        </div>
    </nav>
</div>
<div class="container">
    <div class="row">
        <section class="col-xs-12">
            <form class="form-horizontal" action="controllers/LoginController.php" method="post">
                <!--<fieldset disabled>-->
                <fieldset>
                    <legend>Login</legend>
                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="inputName">User Name</label>
                        <div class="col-sm-10">
                            <input class="form-control" type="text" id="inputName" placeholder="elminero" value="elminero" name="userName"  >
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="inputEmail">Password</label>
                        <div class="col-sm-10">
                            <input class="form-control" type="password" id="inputEmail" placeholder="Email" value="super8" name="password">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-10 col-sm-offset-2">
                            <input type="submit" class="btn btn-default" value="Login" name="login">
                        </div>
                    </div>
                </fieldset>
            </form>
        </section>
    </div><!-- row -->
    <?php include("includes/footer.php"); ?>
</div><!-- end .container -->
<script src="js/jquery-1.12.0.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/script.js"></script>
</body>
</html>
