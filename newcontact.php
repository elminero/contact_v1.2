<?php
require("controllers/LoginController.php");

$login = new LoginController();
$login->verifyLogin();

if ($login->login == 0) {
    header("Location: login.php");
}

require("models/Contact.php");


ob_start();
require("phoneEmailAddress.php");
$phoneEmailAddress = ob_get_contents();
ob_end_clean();

require("controllers/PersonController.php");

$updateForm = null;

// http://localhost/contact_v1.1/newcontact.php?id=1&action=update

if(  isset($_GET['action']) && $_GET['action'] === 'update'  ) {

        $action = "update";
        $id = (int)$_GET['id'];

        $contact = new PersonPDO();

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
        <script src="javascript/event_handlers.js" type="text/javascript"></script>
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

<?php
                    $id = NULL;

                    if( isset($_GET['id']) )
                    $id = $_GET['id'];

                    if( isset($_POST['id']) )
                    $id = $_POST['id'];

                    $contact = new Contact($id);
                    $contact->getContactById();
?>


                    <!-- div 1 Start Avatar -->
                        <?php require("avatar.php"); ?>
                    <!-- End Avatar -->

                    <div style="float: left; width: 200px">
                        <?php require("name_dob.php"); ?>
                    </div>



                <?php endif; ?>
                <?php if($action == "update"): ?>
                    <h3 style='float: left'>Update Contact</h3>
                    <span style='float: right'>
                    <a id="delete" href="controllers/PersonController.php?action=delete&id=<?php echo $id; ?>">delete</a>
                    </span>
                <?php endif; ?>

                <?php if($action == "create"): ?>
                    <h3>Create a New Contact</h3>
                <?php endif; ?>

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
                            <input id ="lastName" style="width: 320px" name="lastName" type="text" class="input_text" id="last_name"  maxlength="40" value="<?php if($action == "update") echo $updateForm->last_name; ?>" /><br />
                        </div>

                        <div  class="form-block">
                            <span class="form-label">First</span><span id="error"><?php if($error == 1) {echo "*";} ?></span>
                            <input style="width: 320px" type="text" class="input_text" name="firstName" id="email" size="50" maxlength="40" value="<?php if($action == "update") echo $updateForm->first_name; ?>" /><br />
                        </div>

                        <div  class="form-block">
                            <span class="form-label">Middle</span><span id="error"><?php if($error == 1) {echo "*";} ?></span>
                            <input style="width: 320px" type="text" class="input_text" name="middleName" id="subject" size="50" maxlength="40" value="<?php if($action == "update") echo $updateForm->middle_name; ?>"/><br />
                        </div>

                        <div  class="form-block">
                            <span class="form-label">Alias</span><span id="error"><?php if($error == 1) {echo "*";} ?></span>
                            <input style="width: 320px" type="text" class="input_text" name="aliasName" id="subject" size="50" maxlength="40" value="<?php if($action == "update") echo $updateForm->alias_name;; ?>" /><br />
                        </div>

                        <div  class="form-block">
                            <span class="form-label">Date of Birth</span>
                            <div align="center">

                                <select  name="birthMonth" id="birth_month" size="1">

                                    <?php if($action == "update"): ?>
                                        <option value="<?php echo $updateForm->birth_month; ?>"><?php echo $contact->getMonthNameByNumber($updateForm->birth_month); ?></option>
                                    <?php endif; ?>

                                    <?php foreach($months as $value => $month): ?>
                                        <option value="<?php echo $value; ?>"><?php echo $month; ?></option>
                                    <?php endforeach; ?>

                                </select>

                                <select  name="birthDay" id="birth_day" size="1">

                                    <?php if($action == "update"): ?>
                                        <option value="<?php echo $updateForm->birth_day; ?>"><?php echo $updateForm->birth_day; ?></option>
                                    <?php endif; ?>

                                    <option value="0"> </option>

                                    <?php for($i = 1; $i <=31; $i++): ?>
                                        <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                    <?php endfor; ?>

                                </select>

                                <select  name="birthYear" id="year" size="1">

                                    <?php if($action == "update"): ?>
                                        <option value="<?php echo $updateForm->birth_year; ?>"><?php echo $updateForm->birth_year; ?></option>
                                    <?php endif; ?>

                                    <option value="0"> </option>
                                    <?php for ($y = date('Y'); $y >= date('Y') - 110; $y--): ?>
                                        <option value="<?php echo $y; ?>"><?php echo $y; ?></option>
                                    <?php endfor; ?>

                                </select>
                                
                            </div>

                        </div>

                        <div class="form-block">
                            <span  class="form-label">Notes</span>
                            <textarea style="float: right" rows="1" cols="40" name="note" ><?php
                           if($action == 'update') {
                               echo $updateForm->note;
                           }
                        ?></textarea><br />
                        </div>
                        <div style="clear: both"></div>
                        <div class="form-block" style="margin-top: 10px; float: right">

                            <input type="hidden" name="personId" value="<?php echo $updateForm->id ?>" />
                            <input type="submit" name="addNewContact" value="<?php
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

