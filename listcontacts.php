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

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/styles.css">
    <!--<link rel="stylesheet" type="text/css" href="css/main.css"/>-->
    <title>List of All Contacts</title>
</head>
<body>
<div class="container">
    <div class="header"><!-- Start Header -->
        <?php include("includes/header.php"); ?>
    </div><!-- end .header -->
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
<script src="js/jquery-1.12.0.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/script.js"></script>
</body>
</html>
