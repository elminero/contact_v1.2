<?php 
	ob_start();	
	require_once("includes/functions.php");

$address = new Address;
$countries = $address->listAllCountries();


if(array_key_exists('delete_address', $_POST))
{	
	$_POST['insert_id'] =  $address->delete();
	$url = "location: portfolio.php?insert_id=" . $_POST['insert_id'];
	header($url);
}

if(array_key_exists('modify_address', $_POST))
{
    $addressFromAddressId = $address->getAddressFromAddressId($_POST['address_id']);
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <link rel="stylesheet" type="text/css" href="css/main.css"/>
    <script language="javascript" type="text/javascript">
        var county_iso = "<?php print($addressFromAddressId['countryIso']); ?>"
        var state = "<?php print($addressFromAddressId['state']); ?>"
    </script>

    <script language="javascript" type="text/javascript">
        function getXMLHTTP()
        { //function to return the xml http object
            var xmlhttp=false;
            try
            {
                xmlhttp=new XMLHttpRequest();
            }
            catch(e)
            {
                try
                {
                    xmlhttp= new ActiveXObject("Microsoft.XMLHTTP");
                }
                catch(e)
                {
                    try
                    {
                    xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
                    }
                    catch(e1)
                    {
                        xmlhttp=false;
                    }
                }
            }
            return xmlhttp;
        }
    </script>

    <script language="javascript" type="text/javascript">
        function getState(country_iso, state  ) {
            //document.write(countryId);

            var strURL="includes/findState.php?country=" + country_iso + "&state=" + state;
            var req = getXMLHTTP();

            if (req) {

                req.onreadystatechange = function() {
                    if (req.readyState == 4) {
                        // only if "OK"
                        if (req.status == 200) {
                            document.getElementById('statediv').innerHTML=req.responseText;
                        } else {
                            alert("There was a problem while using XMLHTTP:\n" + req.statusText);
                        }
                    }
                };
                req.open("GET", strURL, true);
                req.send(null);
            }
        }
    </script>


    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Address Update</title>
</head>

<body onload="getState(county_iso, state)">
    <div class="container">
            <div class="header">
            <ul  class="nav"><!-- Start Header -->
                <li><a href="listcontacts.php">List of All Contacts</a></li>
            </ul>
        </div><!-- end .header -->

        <div class="content">
            <form name="add_address" method="post" action="portfolio.php">
            <div class="form-content">
                <div class="form-block">
                <span class="form-label">Address Type</span>
                    <div align="center">
                    <select  name="address_type" >
                    <option <?php if($addressFromAddressId['addressType'] == 0){echo ' selected="selected" ';} ?> value="0" >  </option>
                    <option <?php if($addressFromAddressId['addressType'] == 1){echo ' selected="selected" ';} ?> value="1" > Current Street </option>
                    <option <?php if($addressFromAddressId['addressType'] == 2){echo ' selected="selected" ';} ?> value="2" > Current Mailing </option>
                    <option <?php if($addressFromAddressId['addressType'] == 3){echo ' selected="selected" ';} ?> value="3" > Previous Street </option>
                    <option <?php if($addressFromAddressId['addressType'] == 4){echo ' selected="selected" ';} ?> value="4" > Previous Mailing </option>
                    <option <?php if($addressFromAddressId['addressType'] == 5){echo ' selected="selected" ';} ?> value="5" > Current Crash Pad </option>
                    <option <?php if($addressFromAddressId['addressType'] == 6){echo ' selected="selected" ';} ?> value="6" > Previous Crash Pad </option>
                    <option <?php if($addressFromAddressId['addressType'] == 7){echo ' selected="selected" ';} ?> value="7" > Other </option>
                    <option <?php if($addressFromAddressId['addressType'] == 8){echo ' selected="selected" ';} ?> value="8" > Unknown </option>
                    </select><br />
                    </div>
                </div>


                 <?php

                $country = $address->getCountryFromIso($addressFromAddressId['countryIso'])
                 ?>

                <div class="form-block">
                    <span class="form-label">Country</span>
                    <select class="input_text" name="country_iso" style="width:328px; background-color:#B8F5B1" onchange="getState(this.value)" >
                        <?php echo "<option value= \" {$addressFromAddressId['countryIso']}  \"  >" . " {$country} " .  "</option>";  ?>

                        <?php
                        foreach($countries as $country)
                        { ?>
                        <option value="<?php echo $country['countryIso']?>" > <?php echo $country['country'] ?> </option>
                        <?php }?>
                    </select><br />
                </div>

                <div class="form-block">
                    <span class="form-label">Address</span>
                    <input class="input_text" type="text" name="street" size="50" maxlength="40" value="<?php echo $addressFromAddressId['street']; ?>" /><br />
                </div>

                <div class="form-block">
                <span class="form-label">City</span>
                <input class="input_text" type="text" name="city" size="50" maxlength="40" value="<?php echo $addressFromAddressId['city']; ?>" /><br />
                </div>

                <div class="form-block" id="statediv">
                    <span class="form-label">State: / Province: / Territory:</span><br />
                    <select class="input_text" name="state" style="width:245px; background-color:#B8F5B1; ">
                    <option value="<?php echo $addressFromAddressId['state']; ?>" ><?php echo $addressFromAddressId['state']; ?></option>
                    </select><br />
                </div>


                <div class="form-block">
                <span class="form-label">Postal Code</span>
                <input class="input_text" type="text" name="postal_code" size="50" maxlength="40" value="<?php echo $addressFromAddressId['postalCode']; ?>" /><br />
                </div>


                <div class="form-block">
                    <span  class="form-label">Notes</span>
                    <textarea style="float: right" rows="10" cols="40" name="note_address" ><?php echo $addressFromAddressId['note']; ?></textarea><br />
                </div>
                <div style="clear: both"></div>
                <div class="form-block" style="margin-top: 10px;">
                    <input type="hidden" name="address_id" value="<?php echo $_POST['address_id'] ?> " />
                    <input type="hidden" name="insert_id" value="<?php echo $_POST['insert_id'] ?>" />
                    <input type="submit" name="update_address" value="Update Address" />
                </div>

            </div>
            </form>
        </div><!-- end .content -->
    </div><!-- end .container -->
</body>
</html>