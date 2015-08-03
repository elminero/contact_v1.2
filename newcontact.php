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

require("controllers/PersonController.php");

$updateForm = null;

if(  isset($_GET['action']) && $_GET['action'] === 'update'  ) {
        $action = "update";
        $id = $_GET['id'];

        $contact = new Person();

        $updateForm = $contact->getPersonById($id);
    } else {
        $action = "create";
}

$error = NULL;
if( isset($_GET['validate'])  && ($_GET['validate'] == "error") ) {
    $error = 1;
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <link rel="stylesheet" type="text/css" href="css/main.css"/>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link href="" rel="stylesheet" type="text/css" />
        <title>Add a New Contact</title>
    </head>
    <body>
        <div class="container" >
            <div class="header">
                <!-- Start Header -->
                <?php
                    include("includes/header.php");
                ?>
                <!-- end .header -->
            <div class="content">
                <?php if($action === 'update'):?>
                <div style="margin-bottom: 9px">
                    <a href="listcontacts.php">List</a> >> <a href="profile.php?id=<?php echo $id; ?>" >Profile</a> >> <b>Update</b>
                </div>
                    <div style="clear: both"></div>
                    <?php echo $avatarNameDOB; ?>
                <?php endif; ?>
                <?php
                if($action == "update") {
                    echo "<h3 style='float: left'>Update Contact</h3>
                    <span style='float: right'>";
                    echo "<a href=\"controllers/PersonController.php?action=delete&id={$id}\">delete</a>";
                    echo "</span>";
                }

                if($action == "create") {
                    echo "<h3>Create a New Contact</h3>";
                }
                ?>
                    <div style="<?php  if($action === 'update') echo "float: right" ?>">
                    <form action="controllers/PersonController.php?action=<?php

                    if($action == "update") {
                        echo "update";
                    }

                    if($action == "create") {
                        echo "create";
                    }

                    ?>" method="post" name="addContact">

                    <div class="form-content" >

                        <div class="form-block">
                            <span class="form-label">Last</span><span id="error"><?php if($error == 1) {echo "*";} ?></span>
                            <input style="width: 320px" name="lastName" type="text" class="input_text" id="last_name"  maxlength="40" value="<?php echo $updateForm['last']; ?>" /><br />
                        </div>

                        <div  class="form-block">
                            <span class="form-label">First</span><span id="error"><?php if($error == 1) {echo "*";} ?></span>
                            <input style="width: 320px" type="text" class="input_text" name="firstName" id="email" size="50" maxlength="40" value="<?php echo $updateForm['first']; ?>" /><br />
                        </div>

                        <div  class="form-block">
                            <span class="form-label">Middle</span><span id="error"><?php if($error == 1) {echo "*";} ?></span>
                            <input style="width: 320px" type="text" class="input_text" name="middleName" id="subject" size="50" maxlength="40" value="<?php echo $updateForm['middle']; ?>"/><br />
                        </div>

                        <div  class="form-block">
                            <span class="form-label">Alias</span><span id="error"><?php if($error == 1) {echo "*";} ?></span>
                            <input style="width: 320px" type="text" class="input_text" name="aliasName" id="subject" size="50" maxlength="40" value="<?php echo $updateForm['alias']; ?>" /><br />
                        </div>

                        <div  class="form-block">
                            <span class="form-label">Date of Birth</span>
                            <div align="center">
                                <select  name="birthMonth" id="birth_month" size="1">
                                <?php

                                if($action == 'update') {
                                    echo "<option value=\"{$updateForm['birthMonth']}\">{$contact->getMonthNameByNumber($updateForm['birthMonth'])}</option>";
                                }
                                    foreach($months as $value => $month)
                                    {
                                        echo "<option value=\"{$value}\">{$month}</option>";
                                    }
                                    ?>
                                </select>
                                <select  name="birthDay" id="birth_day" size="1">
                                <?php
                                    if($action == 'update') {
                                    echo "<option value=\"{$updateForm['birthDay']}\">{$updateForm['birthDay']}</option>";
                                    }
                                ?>
                                    <option value="0"> </option>
                                    <?php
                                    for($i = 1; $i <=31; $i++)
                                    {
                                        echo "<option value=\"{$i}\">{$i}</option>";
                                    }
                                    ?>
                                </select>
                                <select  name="birthYear" id="year" size="1">

                                    <?php
                                    if($action == 'update') {
                                        echo "<option value=\"{$updateForm['birthYear']}\">{$updateForm['birthYear']}</option>";
                                    }
                                    ?>

                                    <option value="0"> </option>
                                    <?php
                                    $current_year = date('Y');
                                    for ($y = $current_year; $y >= $current_year - 110; $y--)
                                    {
                                        echo "<option value=\"{$y}\">{$y}</option>";
                                    }
                                    ?>
                                </select>
                            </div>

                        </div>

                        <div class="form-block">
                            <span  class="form-label">Notes</span>
                            <textarea style="float: right" rows="1" cols="40" name="note" ><?php
                           if($action == 'update') {
                               echo $updateForm['note'];
                           }
                        ?></textarea><br />
                        </div>
                        <div style="clear: both"></div>
                        <div class="form-block" style="margin-top: 10px; float: right">

                            <input type="hidden" name="personId" value="<?php echo $updateForm['id'] ?>" />
                            <input type="submit" name="addNewContact"
                                   value="<?php
                                   if($action == "update"){echo "Update Contact"; }
                                   if($action == "create"){echo "Add Contact"; }?>" />
                        </div>
                        <span style="float: left" id="error"><?php if($error == 1) {echo "* All contacts must have at least one name or alias.";} ?></span>
                        <div style="clear: both"></div>

                    </div>
                </form>
                    </div>

                <div style="clear: both"></div>
                <?php if($action === 'update') echo "<hr />" . $phoneEmailAddress; ?>
            </div><!-- end .content -->

                <?php
                include("includes/footer.php");
                ?>

            </div><!-- end .container -->
    </body>
</html>

