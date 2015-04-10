<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd" >
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <link rel="stylesheet" type="text/css" href="css/main.css"/>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Login</title>
</head>
<body>
<div class="container">
    <div class="header"><!-- Start Header -->
        <ul  class="nav">
            <li><a href="index.php">Home</a></li>
            <li><a href="login.php">Login</a></li>
        </ul>
    </div><!-- end .header -->

    <div class="content">

        <h1>Login</h1>

        <form action="controllers/LoginController.php" method="post" >

        <div style="width: 250px">

            <div style="padding: 5px">
                User Name
                <input style="float: right" type="text" name="userName" value="elminero" /><br />
            </div>

            <div style="padding: 5px">
                Password
                <input style="float: right" type="password" name="password" value="super8" /><br />
            </div>

            <div style="padding: 5px">
                <input style="float: right" type="submit" name="login" value="login"/>
            </div>

        </div>

        </form>



    </div><!-- end .content -->
</div><!-- end .container -->
</body>
</html>
