<?php
require("controllers/LoginController.php");

$login = new LoginController();
$login->verifyLogin();

if ($login->login == 0) {
    header("Location: login.php");
}

    ob_start();
    require("avatarNameDOB.php");
    $avatarNameDOB = ob_get_contents();
    ob_end_clean();

    if(isset($_GET['id'])) {
        $id = (int)$_GET['id'];
    }


    if( (isset($_GET['validate']))  &&  ($_GET['validate'] === 'error') ) {
        $error = 1;
    } else {
        $error = null;
    }


    $contact = new Contact($id);
    $contact->getContactById();
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <link rel="stylesheet" type="text/css" href="css/main.css"/>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Add Photos</title>
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
                <a href="listcontacts.php">list</a> >> <a href="profile.php?id=<?php echo $id; ?>">Profile</a> >> <b>Portfolio</b>
                </div>
                    <div style="clear: both"></div>

                <?php echo $avatarNameDOB ?>


                <div style="float: right">

                    <h3 style='float: left'>Add a Photo</h3>

                    <br />


                    <div style="clear: both"></div>

                    <div class="" >
                    <form action="controllers/ImageController.php?action=create" method="post" enctype="multipart/form-data" >


                        <div class="form-block">
                            <span >Avatar</span>
                            <input name="avatar" type="checkbox" class="" value="" /><br />
                        </div>


                        <div class="form-block">
                            <span >File</span><span id="error"></span>
                            <input name="file" type="file" class=""  /><br />
                        </div>


                        <div class="form-block">
                            <span>Caption</span><span id="error"></span>
                            <textarea name="caption" rows="3" cols="30"  ></textarea><br />
                        </div>


                        <input type="hidden" name="personId" value="<?php echo $id; ?>" />
                        <input type="hidden" name="id" value="0" />

                        <div class="form-block" style="margin-top: 10px; float: right">
                        <input type="submit" name="imageUpLoad" value="Upload Image" />
                        </div>


                        <?php if($error == 1): ?>
                        <span style="color: #990000">
                        * Only jpeg files allowed<br />
                        * Files must be under 500KB
                        </span>
                        <?php endif ?>

                    </form>
                    </div>


                </div>

                <div style="clear: both"></div>
                <hr />

                <?php  if($contact->image):

                foreach($contact->image as $image): ?>

                    <a href="picture.php?id=<?php echo $image['id'] ?>" ><img alt="" src="images/<?php echo $image['pathFile']; ?>_t.jpg" /></a>

                <?php endforeach ?>

                <?php  endif; ?>


                    <div style="clear:both" ></div>

            </div><!-- end .content -->

            <?php
            include("includes/footer.php");
            ?>

        </div><!-- end .container -->
    </body>
</html>