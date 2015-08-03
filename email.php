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


require_once('models/EmailAddress.php');

$email = new EmailAddress();

$emailData = null;
$action = null;

if(isset($_GET['update'])) {
    $action = "update";
    $updateId = (int)$_GET['update'];
    $emailData = $email->getEmailAddressById($updateId);
} else {
    $action = "create";
}


if( (isset($_GET['validate'])) && ($_GET['validate'] == 'error') ) {
    $validate = "error";
} else {
    $validate = null;
}


?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <link rel="stylesheet" type="text/css" href="css/main.css"/>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Add E-Mail Address</title>
    </head>

    <body>
        <div class="container">
            <!-- Start Header -->
            <?php
                include("includes/header.php");
            ?>
            <!-- end .header -->
            <div class="content">

                <div style="margin-bottom: 9px">
                    <a href="listcontacts.php">List</a> >> <a href="profile.php?id=<?php echo $_GET['id']; ?>" >Profile</a> >>
                    <b><?php if($action == "update") echo "Update"; if($action == "create") echo "Add"; ?> Email Address</b>
                </div>
                <div style="clear: both"></div>


                <?php
                echo $avatarNameDOB;
                ?>

                <div style="clear: both"></div>
                <hr />


                <?php
                if($action == "update") {
                    echo "<h3 style='float: left'>Update eMail Address</h3>
            <span style='float: right'>";
                    echo "<a href=\"controllers\EmailAddressController.php?action=delete&id={$emailData['id']}&personId={$_GET['id']}\">delete</a>";
                    echo "</span>";
                }

                if($action == "create") {
                    echo "<h3>Add eMail Address</h3>";
                }
                ?>

                <div style="clear: both"></div>







                <div style="margin-top: 10px;">


                    <form action="controllers/EmailAddressController.php?action=<?php

                    if($action == "update") {
                        echo "update";
                    }

                    if($action == "create") {
                        echo "create";
                    }

                    ?>" method="post" name="addEmail">


                    <!--$id, $personId, $emailAddress, $emailType, $note-->
                    E-Mail
                    Type:
                    <select name="type">
                        <option <?php if($emailData['emailType'] == 0)echo "selected"; ?> value="0"> </option>
                        <option <?php if($emailData['emailType'] == 1)echo "selected"; ?> value="1">Business</option>
                        <option <?php if($emailData['emailType'] == 2)echo "selected"; ?> value="2">Home</option>
                        <option <?php if($emailData['emailType'] == 3)echo "selected"; ?> value="3">Shared</option>
                        <option <?php if($emailData['emailType'] == 4)echo "selected"; ?> value="4">Previous</option>
                        <option <?php if($emailData['emailType'] == 5)echo "selected"; ?> value="5">Other</option>
                    </select>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    E-Mail Address:
                    <input style="width: 175px"  name="emailAddress" type="text" value="<?php echo $emailData['emailAddress'] ?>"  />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    Notes:
                    <input style="width: 175px"  name="note" type="text" value="<?php echo $emailData['note'] ?>" /><br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;



                        <input type="hidden" name="emailId" value="<?php echo  $_GET['update'] ?>" />


                        <input type="hidden" name="personId" value="<?php echo $_GET['id'] ?>" />

                        <div style="float: left; color: #990000; margin-top: 10px;">
                            <?php if($validate == "error") {echo "* E-Mail Address Is Not Valid.";} ?>
                        </div>



                        <div style="float: right; margin-top: 10px;">
                            <input type="submit" name="addEmail"
                                   value="<?php if($action == "update"){echo "Update eMail Address"; }
                                   if($action == "create"){echo "Add an eMail Address"; }?>" />
                            <br />
                        </div>
                </form>

                    <div style="clear: both"></div>
                    <?php // if($action === 'update')
                        echo "<hr />" . $phoneEmailAddress; ?>

            </div><!-- end .content -->



        </div><!-- end .container -->

            <?php
            include("includes/footer.php");
            ?>

    </body>
</html>