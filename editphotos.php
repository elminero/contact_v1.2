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
            <a href="listcontacts.php">list</a> >> <a href="profile.php?id=<?php echo $id; ?>">Profile</a> >> <b>Edit Photos</b>
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



                </form>
            </div>


        </div>

        <div style="clear: both"></div>
        <hr />

<!--
        ["id"]=> int(65)
        ["personId"]=> int(1)
        ["pathFile"]=> string(20) "15/01/31/02/4f31c144"
        ["caption"]=> string(11) "pin-up girl"
        ["avatar"]=> int(0) ["visible"]
-->




        <?php  if($contact->image):

            foreach($contact->image as $image): ?>

                <?php // echo var_dump($image); ?>


                <div style="padding: 5px; ">
                    <a style="margin: 5px; padding-right: 25px; float: left" href="picture.php?id=<?php echo $image['id'] ?>" ><img alt="" src="images/<?php echo $image['pathFile']; ?>_t.jpg" /></a>
                    <div style="float: left ">

                        <form style="float: right"
                              action="controllers/ImageController.php?action=update&id=<?php echo $image['personId']; ?>"
                              method="post" enctype="multipart/form-data" >



                            <div class="form-block">
                                <span >Avatar</span>
                                <input name="avatar" type="checkbox" class="" value=""
                                <?php if($image['avatar'] == 1) echo "checked"; ?>    />
                                <br />
                            </div>

                            <div class="form-block">
                                <span>Caption</span><span id="error"></span>
                                <textarea name="caption" rows="5" cols="40"  ><?php echo $image['caption']; ?></textarea><br />
                            </div>

                            <input type="hidden" name="id" value="<?php echo $image['id']; ?>" />

                            <input type="hidden" name="personId" value="<?php echo $id; ?>" />







                            <div class="form-block" style="margin-top: 10px; float: right">
                                <input type="submit" name="imageUpLoad" value="Update Image" />
                            </div>



                        </form>



                    </div><div style="float: right "><a href="controllers/ImageController.php?action=delete&id=<?php echo $image['id']; ?>&personId=<?php echo $image['personId']; ?>">delete</a></div>
                    <div style="clear: both"></div>

                </div>

            <?php endforeach ?>

        <?php  endif; ?>






        <!-- <img src="images/15/01/29/14/4ffce04d_t.jpg" /> --?
            <!--

            <div style="width:550px">
                <a href="picture.php?pic=">
                    <img style="margin:15px; float:left;" src="images/" />
                </a><br />
                <div align="center" style="margin-bottom:10px; float:right;">
                    <form style=" display:inline;" action="addphotos.php" method="post" name="captionEdit" >
                        <textarea rows="5" cols="36" name="caption" ></textarea>
                        <input type="hidden" name="insert_id" value="" />
                        <input type="hidden" name="caption_edit_image_id" value="" /><br />
                        <input type="submit" name="captionEdit" value="Add Caption" />
                    </form>
                    <form style=" display:inline;" action="addphotos.php" method="post" name="set_avatar" >
                        <input type="hidden" name="insert_id" value="" />
                        <input type="hidden" name="set_image_id" value="" />
                        <input type="submit" name="avatar" value="Set as Avatar" />
                    </form>
                    <form style=" display:inline;" action="addphotos.php" method="post" name="delete_image" >
                        <input type="hidden" name="insert_id" value="" />
                        <input type="hidden" name="delete_image_id" value="" />
                        <input type="submit" name="delete_image" value="Delete Image" />
                    </form>
                </div>
            </div>

            -->
        <div style="clear:both" ></div>

    </div><!-- end .content -->
</div><!-- end .container -->
</body>
</html>