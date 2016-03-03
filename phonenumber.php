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

ob_start();
require("phoneEmailAddress.php");
$phoneEmailAddress = ob_get_contents();
ob_end_clean();


require_once('models/PhoneNumber.php');

$phone = new PhoneNumberPDO();

$phoneData = null;
$action = null;

if(isset($_GET['update'])) {
    $action = "update";
    $updateId = (int)$_GET['update'];
    $phoneData = $phone->getPhoneNumberById($updateId);

} else {
    $action = "create";
    $_GET['update'] = null;
}


if( (isset($_GET['validate'])) && ($_GET['validate'] == 'error') ) {
    $validate = "error";
} else {
    $validate = null;
}

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

     <title>Phone Numbers</title>
 </head>

<body>
<?php include("includes/header.php"); ?>
<div class="container">

<ol class="breadcrumb">
    <li><a href="listcontacts.php">List</a></li>
    <li><a href="profile.php?id=<?php echo $_GET['id']; ?>" >Profile</a></li>
    <li><b><?php if($action == "update") echo "Update"; if($action == "create") echo "Add"; ?> Phone Number</b></li>
</ol>



        <?php
        $id = NULL;

        if( isset($_GET['id']) )
            $id = $_GET['id'];

        if( isset($_POST['id']) )
            $id = $_POST['id'];

        $contact = new Contact($id);
        $contact->getContactById();
        ?>

    <div class="row">
        <div class="col-sm-5" style="padding-right: 12px;">
            <p>
                <?php require("avatar.php"); ?>
            </p>
        </div>
        <div class="col-sm-5">
            <form class="form-horizontal" action="controllers/PhoneNumberController.php?action=<?php

            if($action == "update") {
                echo "update";
            }

            if($action == "create") {
                echo "create";
            }

            ?>" method="post" name="addPhone">


                <?php if($action == "update"): ?>
                    <h3 style="float: left">Update Phone Number</h3>
                    <span style='float: right'>
            <a class="btn btn-danger" id="delete" href="controllers/PhoneNumberController.php?action=delete&id=<?php echo $phoneData->id; ?>&personId=<?php echo $_GET['id']; ?>">delete</a>
            </span><br />
                    <div style="clear: both"></div>
                <?php endif; ?>

                <?php if($action == "create"): ?>
                    <h3>Add Phone Number</h3>
                <?php endif; ?>


                <div class="form-group">
                    <label class="col-sm-2 control-label" for="type">Type</label>
                    <div class="col-sm-10">
                        <select name="type" class="form-control" id="type">
                            <option <?php if(($action == "update") && ($phoneData->phone_type == 0)) {echo "selected";} ?> value="0"> </option>
                            <option <?php if(($action == "update") && ($phoneData->phone_type == 1)) {echo "selected";} ?> value="1">Business</option>
                            <option <?php if(($action == "update") && ($phoneData->phone_type == 2)) {echo "selected";} ?> value="2">Home</option>
                            <option <?php if(($action == "update") && ($phoneData->phone_type == 3)) {echo "selected";} ?> value="3">Fax</option>
                            <option <?php if(($action == "update") && ($phoneData->phone_type == 4)) {echo "selected";} ?> value="4">Other</option>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label" for="phone">Phone</label>
                    <div class="col-sm-10">
                        <input name="phone" type="text" class="form-control" id="phone"  value="<?php if($action == "update") {echo $phoneData->phone_number;} ?>" /><br />
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label" for="note">Notes</label>
                    <div class="col-sm-10">
            <textarea name="note" class="form-control" id="note"  ><?php
                if($action == 'update') {
                    echo $phoneData->note;
                }
                ?></textarea>
                    </div>
                </div>

                <input type="hidden" name="personId" value="<?php echo $_GET['id'] ?>" />
                <input type="hidden" name="phoneId" value="<?php echo  $_GET['update'] ?>" />

                <div style="float: left; color: #990000; margin-top: 10px;">
                    <?php if($validate == "error") {echo "* Phone Number left blank.";} ?>
                </div>

                <div class="form-group">
                    <div class="col-sm-10 col-sm-offset-2">
                        <input class="btn btn-default"  type="submit" name="addPhone" value="<?php
                        if($action == "create") {
                            echo "Create";
                        }elseif($action == "update") {
                            echo "Update";
                        }
                        ?>"
                               id="<?php
                               if($action == "create") {
                                   echo "create";
                               }elseif($action == "update") {
                                   echo "update";
                               }
                               ?>"
                            />
                    </div>
                </div>

            </form>
        </div><!--<div class="col-sm-5">-->
    </div><!--<div class="row">-->


<hr/>

<!-- array(4) { ["personId"]=> int(37) ["phoneNumber"]=> string(12) "914-331-8584" ["phoneType"]=> int(2) ["note"]=> string(2) "NY" } -->

<div class="row">
    <!-- div 2 Start Name and DOB -->
    <div class="col-sm-12">
        <p>
            <?php require("name_dob.php"); ?>
        </p>
    </div>
</div>

<?php echo "<hr />" . $phoneEmailAddress; ?>


    <?php
    include("includes/footer.php");
    ?>

</div><!-- end .container -->
<script src="js/bootstrap.min.js"></script>
<script src="js/script.js"></script>
</body>
</html>