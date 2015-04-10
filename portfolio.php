<?php
ob_start();
require("models/Contact.php");


$id = NULL;

if( isset($_GET['id']) )
    $id = $_GET['id'];

if( isset($_POST['id']) )
$id = $_POST['id'];

$contact = new Contact($id);
$contact->getContactById();



?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <link rel="stylesheet" type="text/css" href="css/main.css"/>
    <script type="text/javascript">
        function confirmDelete()
        {
            return confirm('Are your sure?');
			//if(answer){
			//	document.getElementById("formid").submit()
			//}
        }
    </script>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Portfolio</title>
</head>

<body>
<div class="container">
    <div class="header">

        <div class="header"><!-- Start Header -->
            <ul  class="nav">
                <li><a href="listcontacts.php">List of All Contacts</a></li>
                <li><a href="newcontact.php">New Contact</a></li>
            </ul>
        </div><!-- end .header -->

    <div class="content">

    </div><!-- end .content -->

        <?php
        include("includes/footer.php");
        ?>



</div><!-- end .container -->
</body>
</html>

<?php
	ob_end_flush();
?>
