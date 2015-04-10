<?php
	ob_start();	
	require_once("includes/functions.php");

	$emailAddress = new EmailAddress;

	if(array_key_exists("delete_email_addresses", $_POST))
    {
		$emailAddress->delete();
	}


	if(array_key_exists("modify_email_addresses", $_POST))
	{
		$emailAddressArray = $emailAddress->getFromEmailIds();
	}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <link rel="stylesheet" type="text/css" href="css/main.css"/>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Update E-Mail Addresses</title>
    </head>
    <body>
        <div class="container">
            <div class="header">
                <ul  class="nav"><!-- Start Header -->
                    <li><a href="listcontacts.php">List of All Contacts</a></li>
                </ul>
            </div><!-- end .header -->

            <div class="content">
                <form name="update_email_addresses" action="portfolio.php" method="post">
                    <?php
                    $i = 0;
                    foreach($emailAddressArray as $value)
                    {       ?>
                        <input type="hidden" name="<?php echo "email_id&" . $i ?>" value="<?php echo $emailAddressArray[$i]['emailId'] ?>" />
                        <select name="<?php echo "phone_type&" . $i ?>">
                            <option value="0" <?php if(0 == $emailAddressArray[$i]['emailType']){echo 'selected="selected"' ;} ?> > </option>
                            <option value="1" <?php if(1 == $emailAddressArray[$i]['emailType']){echo 'selected="selected"' ;} ?> >Business</option>
                            <option value="2" <?php if(2 == $emailAddressArray[$i]['emailType']){echo 'selected="selected"' ;} ?> >Home</option>
                            <option value="3" <?php if(3 == $emailAddressArray[$i]['emailType']){echo 'selected="selected"' ;} ?> >Fax</option>
                            <option value="4" <?php if(4 == $emailAddressArray[$i]['emailType']){echo 'selected="selected"' ;} ?> >Other</option>
                        </select>
                        <input type="text" name="<?php echo "email_address&" . $i ?>"
                            value="<?php echo $emailAddressArray[$i]['emailAddress']  ?>"
                            size="40" maxlength="40"
                        />
                        <input type="text" name="<?php echo "note&" . $i ?>"
                            value="<?php echo $emailAddressArray[$i]['note']  ?>"
                            size="50" maxlength="40"
                        />
                        <br />
                        <?php
                        $i++;
                    }       ?>
                    <input type="hidden" name="insert_id" value="<?php echo $_POST['insert_id']; ?>" />
                    <input name="update_email_addresses" type="submit" value="Update E-Mail Addresses" />
                </form>
            </div><!-- end .content -->
        </div><!-- end .container -->
    </body>
</html>