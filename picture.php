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
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/styles.css">
        <link rel="stylesheet" type="text/css" href="css/main.css"/>
        <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
        <script src="js/jquery-1.12.0.min.js"></script>
        <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
        <title>Picture</title>
    </head>
    <body>
    <?php include("includes/header.php"); ?>
    <div class="container" >
        <ol class="breadcrumb">
            <li><a href="listcontacts.php">list</a></li>
            <li><a href="profile.php?id=<?php echo $personId; ?>">Profile</a></li>
            <li><a href="addphotos.php?id=<?php echo $personId; ?>&action=update"> Portfolio</a></li>
            <li><b>Picture</b></li>
        </ol>
        <a href="addphotos.php?id=<?php echo $personId; ?>">View All</a>
        <div style=" margin: 0 auto; width: <?php echo getimagesize( "images/" . $image->getImageById($id)->path_file . ".jpg" )[0] . "px" ; ?>;">
            <div align="center" >
                <nav style="width: 275px">
                    <ul class="pager" >
                        <li class="previous" >
                            <a style="background-color: #1b6d85;" href="picture.php?id=<?php echo $image->previousImageId;  ?>" ><< Previous</a>
                        </li>
                        <li class="next">
                            <a style="background-color: #1b6d85;" href="picture.php?id=<?php echo $image->nextImageId; ?>" >Next >></a>
                        </li>
                    </ul>
                </nav>
            </div>
            <a href="picture.php?id=<?php echo $image->nextImageId;  ?>" >
                <img class="img-rounded" src="images/<?php echo $image->getImageById($id)->path_file; ?>.jpg"  />
            </a>
            <div class="caption" style="color: black; background-color: white; padding: 10px; margin: 10px 0; ">
                <?php echo  $image->getImageById($id)->caption;     ?>
            </div>
        </div>
        <?php include("includes/footer.php"); ?>
    </div><!-- end .container -->
    <script src="js/bootstrap.min.js"></script>
    <script src="js/script.js"></script>
    </body>
</html>