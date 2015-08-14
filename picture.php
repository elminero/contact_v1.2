<?php
require("controllers/LoginController.php");

$login = new LoginController();
$login->verifyLogin();

if ($login->login == 0) {
    header("Location: login.php");
}

	ob_start();
require("models/Contact.php");

// This id is the id of the picture.
if(isset($_GET['id'])) {
    $id = (int)$_GET['id'];
}

$image = new ImagePDO();

$personId = $image->getPersonIdByImageId($id);

$image->setPreviousNextImageId($id);


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xmlns="http://www.w3.org/1999/html">
    <head>
        <link rel="stylesheet" type="text/css" href="css/main.css"/>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Picture</title>
    </head>
    <body>
        <div class="container" >
            <!-- Start Header -->
            <?php
                include("includes/header.php");
            ?>
            <!-- end .header -->
            <div class="content">
                <div style="margin-bottom: 9px">
                <a href="listcontacts.php">list</a> >> <a href="profile.php?id=<?php echo $personId; ?>">

                    Profile</a> >> <a href="addphotos.php?id=<?php echo $personId; ?>"> Portfolio</a> >> <b>Picture</b>
                </div>

                <div style="clear: both"></div>


                <a href="addphotos.php?id=<?php echo $personId; ?>">View All</a>
                <div align="center" style="margin:1px; padding:1px;">
                    <div style="padding:10px;">
                        <a href="picture.php?id=<?php echo $image->previousImageId;  ?>" ><< Previous</a>
                        &nbsp; &nbsp;
                        <a href="picture.php?id=<?php echo $image->nextImageId; ?>" > Next >></a><br />
                    </div>
                    <a href="picture.php?id=<?php echo $image->nextImageId;  ?>" >
                        <img src="images/<?php echo $image->getImageById($id)->path_file; ?>.jpg"  />
                    </a>
                    <br />
                    <div align="left">
                        <?php // echo $Picture->caption; ?>
                    </div>
                </div>
            </div><!-- end .content -->

            <?php
            include("includes/footer.php");
            ?>

        </div><!-- end .container -->
    </body>
</html>

