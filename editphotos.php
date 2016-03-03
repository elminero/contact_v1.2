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

    <title>Add Photos</title>
</head>
<body>
<?php include("includes/header.php"); ?>
<div class="container" >

    <ol class="breadcrumb">
        <li><a href="listcontacts.php">list</a></li>
        <li><a href="profile.php?id=<?php echo $id; ?>">Profile</a></li>
        <li><b>Edit Photos</b></li>
    </ol>

<div class="row" >


        <div class="col-sm-5" style="padding-right: 12px;">
            <p>
                <?php require("avatar.php"); ?>
            </p>
        </div>




        <div class="col-sm-5">

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
                                <textarea name="caption" class="form-control" id="caption"  ></textarea>
                            </div>
                        </div>

                        <input type="hidden" name="personId" value="<?php echo $id; ?>" />
                        <input type="hidden" name="id" value="0" />

                        <div class="form-group">
                            <div class="col-sm-10 col-sm-offset-2">
                                <input class="btn btn-default" type="submit" name="imageUpLoad" value="Upload Image" />
                            </div>
                        </div>

                    </form>
            </div>


</div><!--end <div class="row">-->


<hr/>
    <div class="row">
        <!-- div 2 Start Name and DOB -->
        <div class="col-sm-12">
            <p>
                <?php require("name_dob.php"); ?>
            </p>
        </div>
    </div>




<!--
        ["id"]=> int(65)
        ["personId"]=> int(1)
        ["pathFile"]=> string(20) "15/01/31/02/4f31c144"
        ["caption"]=> string(11) "pin-up girl"
        ["avatar"]=> int(0) ["visible"]
-->
        <?php  if($contact->image):

        while($row = $contact->image->fetch(PDO::FETCH_OBJ)): ?>

                <?php // echo var_dump($image); ?>


                    <div class="row">
                        <hr/>


                        <div class="col-sm-6">
                            <img class="img-responsive" alt="" src="images/<?php echo $row->path_file; ?>_t.jpg" /><br/>
                            <div style="" class="form-group"><a class="btn btn-danger" id="delete" href="controllers/ImageController.php?action=delete&id=<?php echo $row->id; ?>&personId=<?php echo $row->person_id; ?>">delete</a></div>
                        </div>

                        <div class="col-sm-6">
                        <form class="form-horizontal"
                              action="controllers/ImageController.php?action=update&id=<?php echo $row->person_id;  ?>"
                              method="post" enctype="multipart/form-data" >

                            <div class="form-group">
                                <div class="col-sm-10 col-sm-offset-2">
                                    <div class="checkbox">
                                        <label>
                                            <input name="avatar" type="checkbox" value="" <?php if($row->avatar == 1) echo "checked"; ?>/>Avatar
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="caption"><span>Caption</span><span id="error"></span></label>
                                <div class="col-sm-10">
                                    <textarea name="caption" class="form-control" id="caption"  ><?php echo $row->caption; ?></textarea>
                                </div>
                            </div>

                            <input type="hidden" name="id" value="<?php echo $row->id; ?>" />

                            <input type="hidden" name="personId" value="<?php echo $id; ?>" />

                            <div class="form-group">
                                <div class="col-sm-10 col-sm-offset-2">
                                    <input class="btn btn-default" type="submit" name="imageUpLoad" value="Update Image" />
                                </div>
                            </div>
                        </form>


                        </div>
                    </div>






            <?php endwhile ?>

        <?php  endif; ?>
        <div style="clear:both" ></div>

    <?php
    include("includes/footer.php");
    ?>

</div><!-- end .container -->
<script src="js/bootstrap.min.js"></script>
<script src="js/script.js"></script>
</body>
</html>