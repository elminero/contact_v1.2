<?php
// ob_start();

// require("models/Contact.php");

require("models/Person.php");
require("controllers/LoginController.php");

$login = new LoginController();
$login->verifyLogin();

if ($login->login == 0) {
    header("Location: login.php");
}

$contact = new PersonPDO();
$stmt = $contact->getAllPerson();

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd" >
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <link rel="stylesheet" type="text/css" href="css/main.css"/>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>List of All Contacts</title>
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
            <b>List</b>
        </div>
        <div style="clear: both"></div>
        <table>
            <?php while($row = $stmt->fetch(PDO::FETCH_OBJ)): ?>
                <?php $nameLastFirstMiddle = $row->first_name . " " . $row->middle_name  . " " . $row->last_name ; ?>
                <tr>
                    <td><a href="profile.php?id=<?php echo $row->id; ?>"><?php echo $nameLastFirstMiddle; ?></a></td>
                </tr>
            <?php endwhile ?>
        </table>
    </div><!-- end .content -->

    <?php include("includes/footer.php"); ?>

</div><!-- end .container -->
</body>
</html>
