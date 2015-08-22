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
           <div>
            <?php
            echo $avatarNameDOB;
            ?>
            </div>
            <div style="clear: both" ></div>
            <hr />
            <div>

                <?php
                if($action == "update") {
                    echo "<h3 style='float: left'>Update Address</h3>
            <span style='float: right'>";
                    echo "<a href=\"controllers/AddressController.php?action=delete&id={$updateId}&personId={$_GET['id']}\">delete</a>";
                    echo "</span>";
                }

                if($action == "create") {
                    echo "<h3>Add an Address</h3>";
                }
                ?>

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
                                <option <?php if($addressData->address_type == 0)echo "selected"; ?> value="0" >  </option>
                                <option <?php if($addressData->address_type == 1)echo "selected"; ?>  value="1" > Current Street </option>
                                <option <?php if($addressData->address_type == 2)echo "selected"; ?>  value="2" > Current Mailing </option>
                                <option <?php if($addressData->address_type == 3)echo "selected"; ?>  value="3" > Previous Street </option>
                                <option <?php if($addressData->address_type == 4)echo "selected"; ?>  value="4" > Previous Mailing </option>
                                <option <?php if($addressData->address_type == 5)echo "selected"; ?>  value="5" > Current Crash Pad </option>
                                <option <?php if($addressData->address_type == 6)echo "selected"; ?>  value="6" > Previous Crash Pad </option>
                                <option <?php if($addressData->address_type == 7)echo "selected"; ?>  value="7" > Other </option>
                            </select><br />
                        </div>
                    </div><!-- end .form-block -->

                    <div class="form-block">
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
                    </div><!-- end .form-block -->


                    <div class="form-block">
                    <span class="form-label">Address</span>
                    <input style="width: 240px"  class="input_text" type="text" name="street" maxlength="40" value="<?php echo $addressData->street; ?>" /><br />
                    </div>






                    <div class="form-block" id="city">

                        <span class="form-label">City</span>

                        <?php if(!$addressData->city): ?>

                        <input style="width:240px;" class="input_text" type="text" name="city" maxlength="40" /><br />

                        <?php endif; ?>

                    <?php if($action == "update"): ?>

                    <select style="width:240px;" class="input_text" name="city" >
                        <option value="<?php echo $addressData->city; ?>" ><?php echo $addressData->city; ?></option>
                    </select>

                    <?php endif; ?>


                        <?php if($action == "create"): ?>

                    <select class="input_text" name="city" style="width:240px; color:#CCC;">
                        <option value="" >Select Country and State First</option>
                    </select>

                        <?php endif; ?>

                    <br />
                    </div>


                    <div class="form-block" >
                    <span class="form-label">State:</span>
                    <select id="stateSelect" class="input_text" name="state" style="width:245px; " >

                        <option value="<?php echo $addressData->state;  ?>"><?php echo $addressData->state;  ?></option>


                        <option value="">Select Country First</option>
                    </select><br />
                    </div>


                    <div class="form-block">
                    <span class="form-label">Postal Code</span>
                    <input style="width: 240px" class="input_text" type="text" name="postal_code" size="37" maxlength="40" value="<?php echo $addressData->postal_code; ?>" /><br />
                    </div>


                    <div class="form-block">
                        <span  class="form-label">Notes</span>
                        <textarea style="float: right" rows="3" cols="28" name="note" ><?php echo $addressData->note; ?></textarea><br />
                    </div>
                    <div style="clear: both"></div>
                    <div class="form-block" style="margin-top: 10px; float: right">

                        <input type="hidden" name="personId" value="<?php echo $_GET['id'] ?>" />
                        <input type="hidden" name="id" value="<?php echo  $_GET['update'] ?>" />

                        <input type="submit" name="addAddress"
                               value="<?php
                               if($action == "update"){echo "Update Address"; }
                               if($action == "create"){echo "Add Addresses"; }?>" />

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