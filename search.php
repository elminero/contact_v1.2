<?php
require("controllers/LoginController.php");

$login = new LoginController();
$login->verifyLogin();

if ($login->login == 0) {
    header("Location: login.php");
}

require("models/Contact.php");

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <link rel="stylesheet" type="text/css" href="css/main.css"/>
    <script src="javascript/event_handlers.js" type="text/javascript"></script>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link href="" rel="stylesheet" type="text/css" />
    <title>Search By Name</title>
</head>
<body>
<div class="container" >
    <div class="header">
        <!-- Start Header -->
        <?php include("includes/header.php"); ?>
        <!-- end .header -->

        <div class="content">


            <form action="controllers/PersonController.php" method="post" name="">
                <div class="form-content" >
                    <div class="form-block">
                        <span class="form-label">Search</span><span id="error"><?php if($error == 1) {echo "*";} ?></span>
                        <input id ="SearchName" style="width: 320px" name="SearchName" type="text" class="input_text" id="last_name"  maxlength="40" value="" /><br />
                    </div>

                    <div class="form-block">

                        <input id ="SearchName" name="SearchName" type="submit" class="input_text" id="last_name"  value="Profile" /><br />
                    </div>

                </div>
            </form>



        </div><!-- end .content -->

        <?php include("includes/footer.php"); ?>

    </div><!-- end .container -->
</body>
</html>
