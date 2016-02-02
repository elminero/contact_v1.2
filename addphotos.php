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

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" type="text/css" href="css/main.css"/>
    <title>Add Photos</title>
</head>
    <body>
        <div class="container" >
            <div class="header"><!-- Start Header -->
                <?php include("includes/header.php"); ?>
            </div><!-- end .header -->
                <div style="margin-bottom: 9px">
                <a href="listcontacts.php">list</a> >> <a href="profile.php?id=<?php echo $id; ?>">Profile</a> >> <b>Portfolio</b>
                </div>
                    <div style="clear: both"></div>

                <!-- div 1 Start Avatar -->
                <?php require("avatar.php"); ?>
                <!-- End Avatar -->

                <!-- div 2 Start Name and DOB -->
                <div style="float: left; width: 200px">
                    <?php require("name_dob.php"); ?>
                </div>
                <!-- End Name and DOB -->


                <div style="float: right">

                    <h3 style='float: left'>Add a Photo</h3>

                    <br />


                    <div style="clear: both"></div>

<div class="row" >
    <section class="col-xs-12">
        <form class="form-horizontal" action="controllers/ImageController.php?action=create" method="post" enctype="multipart/form-data" >


            <div class="form-group">
                <div class="col-sm-10 col-sm-offset-2">
                    <div class="checkbox">
                        <label>
                            <input name="avatar" type="checkbox" value="" />Avatar
                        </label>
                    </div>
                </div>
            </div>


            <div class="form-group">
                <label class="col-sm-2 control-label" for="file"><span >File</span><span id="error"></span></label>
                <div class="col-sm-10">
                    <input id="file" name="file" type="file" class=""  />
                </div>
            </div>


            <div class="form-group">
                <label class="col-sm-2 control-label" for="caption"><span>Caption</span><span id="error"></span></label>
                <div class="col-sm-10">
                    <textarea id="caption" name="caption" rows="3" cols="30"  ></textarea>
                </div>
            </div>


            <input type="hidden" name="personId" value="<?php echo $id; ?>" />
            <input type="hidden" name="id" value="0" />

            <div class="form-group">
                <div class="col-sm-10 col-sm-offset-2">
                    <input class="btn btn-default" type="submit" name="imageUpLoad" value="Upload Image" />
                </div>
            </div>


            <?php if($error == 1): ?>
            <span style="color: #990000">
            * Only jpeg files allowed<br />
            * Files must be under 500KB
            </span>
            <?php endif ?>

        </form>
    </section>
</div>


                </div>

                <div style="clear: both"></div>
                <hr />

                <?php while($row = $contact->image->fetch(PDO::FETCH_OBJ)): ?>
                    <a href="picture.php?id=<?php echo $row->id; ?>" ><img alt="" src="images/<?php echo $row->path_file; ?>_t.jpg" /></a>
                <?php endwhile ?>

                    <div style="clear:both" ></div>

            <?php
            include("includes/footer.php");
            ?>

        </div><!-- end .container -->
        <script src="js/jquery-1.12.0.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/script.js"></script>
    </body>
</html>