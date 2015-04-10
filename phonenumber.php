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

$phone = new PhoneNumber();

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

//

//

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
<title>Untitled Document</title>
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
        <b><?php if($action == "update") echo "Update"; if($action == "create") echo "Add"; ?> Phone Number</b>
        </div>
        <div style="clear: both"></div>

<?php
        echo $avatarNameDOB;
?>

        <div style="clear: both"></div>
        <hr />



<?php
        if($action == "update") {
            echo "<h3 style='float: left'>Update Phone Number</h3>
            <span style='float: right'>";
            echo "<a href=\"controllers/PhoneNumberController.php?action=delete&id={$phoneData['id']}&personId={$_GET['id']}\">delete</a>";
            echo "</span>";
        }

        if($action == "create") {
            echo "<h3>Add Phone Number</h3>";
        }
?>

<div style="clear: both"></div>
<!-- array(4) { ["personId"]=> int(37) ["phoneNumber"]=> string(12) "914-331-8584" ["phoneType"]=> int(2) ["note"]=> string(2) "NY" } -->

        <div style="margin-top: 10px;">
        <form action="controllers/PhoneNumberController.php?action=<?php

        if($action == "update") {
            echo "update";
        }

        if($action == "create") {
            echo "create";
        }

        ?>" method="post" name="addPhone">


	Phone Type:
    <select name="type">
    	<option <?php if($phoneData['phoneType'] == 0)echo "selected"; ?> value="0"> </option>
        <option <?php if($phoneData['phoneType'] == 1)echo "selected"; ?> value="1">Business</option>
        <option <?php if($phoneData['phoneType'] == 2)echo "selected"; ?> value="2">Home</option>
        <option <?php if($phoneData['phoneType'] == 3)echo "selected"; ?> value="3">Fax</option>
        <option <?php if($phoneData['phoneType'] == 4)echo "selected"; ?> value="4">Other</option>
    </select>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	Phone Number:
    <input name="phone" type="text" size="23" value="<?php echo $phoneData['phoneNumber'] ?>"  />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    Notes:
    <input name="note" type="text" size="40" value="<?php echo $phoneData['note'] ?>" /><br />
    

    
    <input type="hidden" name="personId" value="<?php echo $_GET['id'] ?>" />
    <input type="hidden" name="phoneId" value="<?php echo  $_GET['update'] ?>" />

    <div style="float: left; color: #990000; margin-top: 10px;">
        <?php if($validate == "error") {echo "* Phone Number left blank.";} ?>
    </div>

            <div style="float: right; margin-top: 10px;">
        <input type="submit" name="addPhone"
               value="<?php if($action == "update"){echo "Update Phone Number"; }
                            if($action == "create"){echo "Add a Phone Number"; }?>" />
        <br />
    </div>
</form>


            <div style="clear: both"></div>
            <?php // if($action === 'update')
                echo "<hr />" . $phoneEmailAddress; ?>
    </div>
    </div><!-- end .content -->

    <?php
    include("includes/footer.php");
    ?>

</div><!-- end .container -->
</body>
</html>