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


require_once('models/Address.php');

$address = new AddressPDO();

$qCountries = $address->getAllCountry();

$addressData = null;
$action = null;

if(isset($_GET['update'])) {
    $action = "update";
    $updateId = (int)$_GET['update'];
    $addressData = $address->getAddressById($updateId);


} else {
    $action = "create";
    $_GET['update'] = null;
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <link rel="stylesheet" type="text/css" href="css/main.css"/>
        <script src="statedropdown2.js"></script>

        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Address</title>
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
                <b><?php if($action == "update") echo "Update"; if($action == "create") echo "Add"; ?> Address</b>
            </div>
            <div style="clear: both"></div>

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

            <div style="clear: both" ></div>
            <hr />
            <div>

                <?php
                if($action == "update"): ?>
                    <h3 style='float: left'>Update Address</h3>
            <span style='float: right'>
                    <a id="delete" href="controllers/AddressController.php?action=delete&id=<?php echo $updateId; ?>&personId=<?php echo $_GET['id']; ?>">delete</a>
                    </span>
                <?php endif; ?>

                <?php if($action == "create"): ?>
                    <h3>Add an Address</h3>
                <?php endif; ?>

                <div style="clear: both"></div>

                <form action="controllers/AddressController.php?action=<?php

                if($action == "update") {
                    echo "update";
                }

                if($action == "create") {
                    echo "create";
                }

                ?>" method="post" name="addAddress">
                <div class="form-content">
                    <div class="form-block">
                        <span class="form-label">Address Type</span>
                        <div align="center">
                            <select name="address_type" >
                                <option <?php if (($action == "update") && ($addressData->address_type == 0)) {echo "selected";} ?> value="0" >  </option>
                                <option <?php if (($action == "update") && ($addressData->address_type == 1)) {echo "selected";} ?>  value="1" > Current Street </option>
                                <option <?php if (($action == "update") && ($addressData->address_type == 2)) {echo "selected";} ?>  value="2" > Current Mailing </option>
                                <option <?php if (($action == "update") && ($addressData->address_type == 3)) {echo "selected";} ?>  value="3" > Previous Street </option>
                                <option <?php if (($action == "update") && ($addressData->address_type == 4)) {echo "selected";} ?>  value="4" > Previous Mailing </option>
                                <option <?php if (($action == "update") && ($addressData->address_type == 5)) {echo "selected";} ?>  value="5" > Current Crash Pad </option>
                                <option <?php if (($action == "update") && ($addressData->address_type == 6)) {echo "selected";} ?>  value="6" > Previous Crash Pad </option>
                                <option <?php if (($action == "update") && ($addressData->address_type == 7)) {echo "selected";} ?>  value="7" > Other </option>
                            </select><br />
                        </div>
                    </div><!-- end .form-block -->

                    <div class="form-block"><!-- start select country -->
                        <span class="form-label">Country</span>
                        <select  id="country" class="input_text" name="country_iso" style="width:245px; background-color:#B8F5B1"    >

                            <?php if($addressData): ?>
                                <option value= "<?php echo $addressData->country_iso;  ?> ">
                                    <?php // echo $address->getCountryByISO($addressData->country_iso);
                                    echo $address->getCountryByISO($addressData->country_iso);                                                              ?> </option>
                            <?php endif ?>

                            <option value= "1"> </option>
                            <option value="US" > United States </option  >
                            <option value="CA" > Canada </option>
                            <option value="MX" > Mexico </option>

                            <?php while($row = $qCountries->fetch(PDO::FETCH_OBJ) ) : ?>
                                <option value="<?php echo $address->getCountryByISO($row->iso) ; ?>" >
                                <?php echo $row->country; ?> </option>
                            <?php endwhile; ?>

                        </select><br />
                    </div><!-- end select country -->


                    <div class="form-block" ><!-- start select State -->
                        <span class="form-label">State:</span>
                        <select id="stateSelect" class="input_text" name="state" style="width:245px; " >
                            <option value="<?php if ($action == "update") {echo $addressData->state;}  ?>"><?php if ($action == "update") {echo $addressData->state;}  ?></option>
                            <option value="">Select Country First</option>
                        </select><br />
                    </div><!-- end select State -->

                    <div class="form-block" id="city"><!-- start input City -->
                        <span class="form-label">City</span>
                        <input style="width:240px;" class="input_text" type="text" name="city" maxlength="40" value="<?php if ($action == "update") {echo $addressData->city;} ?>" /><br />
                    </div><!-- end input City -->



                    <div class="form-block"><!-- start input Street -->
                    <span class="form-label">Street</span>
                    <input style="width: 240px"  class="input_text" type="text" name="street" maxlength="40" value="<?php if ($action == "update") {echo $addressData->street;} ?>" /><br />
                    </div><!-- end input Street -->


                    <div class="form-block">
                    <span class="form-label">Postal Code</span>
                    <input style="width: 240px" class="input_text" type="text" name="postal_code" size="37" maxlength="40" value="<?php if ($action == "update") {echo $addressData->postal_code;} ?>" /><br />
                    </div>


                    <div class="form-block">
                        <span  class="form-label">Notes</span>
                        <textarea style="float: right" rows="3" cols="28" name="note" ><?php if ($action == "update") {echo $addressData->note;} ?></textarea><br />
                    </div>
                    <div style="clear: both"></div>
                    <div class="form-block" style="margin-top: 10px; float: right">

                        <input type="hidden" name="personId" value="<?php echo $_GET['id'] ?>" />
                        <input type="hidden" name="id" value="<?php echo  $_GET['update'] ?>" />

                        <input type="submit" name="addAddress"
                               value="<?php
                               if($action == "update"){echo "Update Address"; }
                               if($action == "create"){echo "Add Addresses"; }?>"
                               id="<?php echo $action?>"
                            />

                    </div>
                </div><!-- end .form-content -->
            </form>
            </div>

            <div style="clear: both"></div>
            <?php // if($action === 'update')
            echo "<hr />" . $phoneEmailAddress; ?>
        </div><!-- end .content -->

        <?php
        include("includes/footer.php");
        ?>

    </div><!-- end .container -->
    </body>
</html>