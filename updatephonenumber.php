<?php 
	ob_start();
	require_once("includes/functions.php");

    $phoneNumber = new PhoneNumber;

if(array_key_exists('delete_phone_numbers', $_POST))
{
	$insert_id = $_POST['insert_id'];
	$phoneNumber->delete();
	header("Location: portfolio.php?insert_id=" . $insert_id);
}

if(array_key_exists('modify_phone_numbers', $_POST))
{
    $phoneNumbers = $phoneNumber->getPhoneNumbersFromPhoneId($_POST);
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <link rel="stylesheet" type="text/css" href="css/main.css"/>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Phone Number Update</title>
</head>

<body>
<div class="container">
    <ul class="nav">
        <li><a href="listcontacts.php">List of All Contacts</a></li>
    </ul>
    <div class="header">
    </div><!-- end .header -->
    <div class="content">

<form name="update_phone_numbers" action="portfolio.php" method="post">
	<?php
    $i = 0; 
    foreach($phoneNumbers as $key => $phoneNumber){ ?>
        
        <!--<input type="text" name="phone_type" value="<?php // echo $phone_number_array[$i]['phone_type']  ?>"  /> -->
        <input type="hidden" name="<?php echo "phone_id&" . $i ?>" value="<?php echo $phoneNumber['phoneId'] ?>" />
        
        <select name="<?php echo "phone_type&" . $i ?>">
            <option value="0" <?php if(0 == $phoneNumber['phoneType']){echo 'selected="selected"' ;} ?> > </option>
            <option value="1" <?php if(1 == $phoneNumber['phoneType']){echo 'selected="selected"' ;} ?> >Business</option>
            <option value="2" <?php if(2 == $phoneNumber['phoneType']){echo 'selected="selected"' ;} ?> >Home</option>
            <option value="3" <?php if(3 == $phoneNumber['phoneType']){echo 'selected="selected"' ;} ?> >Fax</option>
            <option value="4" <?php if(4 == $phoneNumber['phoneType']){echo 'selected="selected"' ;} ?> >Other</option>
        </select>

        <input type="text" name="<?php echo "phone_number&" . $i ?>" 
            value="<?php echo $phoneNumber['phoneNumber']  ?>"
            size="15" maxlength="40"  
        />
        
        <input type="text" name="<?php echo "note_text&" . $i ?>" 
        	value="<?php echo $phoneNumber['note']  ?>"
            size="50" maxlength="40"  
         />
        
        
        <br />
        <?php	
	$i++;	
    }?>	
	<input type="hidden" name="insert_id" value="<?php echo $_POST['insert_id']; ?>" />
    <input name="update_phone_numbers" type="submit" value="Update Phone Numbers" />
</form>
</div><!-- end .content -->
</div><!-- end .container -->
</body>
</html>