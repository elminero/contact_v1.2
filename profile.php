<?php
ob_start();
require("models/Contact.php");
require("controllers/LoginController.php");

$login = new LoginController();
$login->verifyLogin();

if ($login->login == 0) {
    header("Location: login.php?");
}

$id = NULL;

if( isset($_GET['id']) )
    $id = $_GET['id'];

if( isset($_POST['id']) )
    $id = $_POST['id'];

$contact = new Contact($id);
$contact->getContactById();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" type="text/css" href="css/main.css"/>

    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">

    <script src="js/jquery-1.12.0.min.js"></script>
    <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>

    <title>Show Contact</title>
</head>
<body>
<div class="container">
    <div class="header"><!-- Start Header -->
        <?php include("includes/header.php"); ?>
    </div><!-- end .header -->

            <div style="margin-bottom: 9px">
                <a href="listcontacts.php">List</a> >> <b>Profile</b>
            </div>
            <div style="clear: both"></div>

            <div class="row">
                <div class="col-sm-5" style="padding-right: 12px;">

                    <p>
                        <?php require("avatar.php"); ?>
                    </p>
                </div>
                <div class="col-sm-5">

                    <p>
                        <?php require("name_dob.php"); ?>
                    </p>
                </div>
            </div>


            <div style="clear: both"></div>


            <hr />
            <!-- Start Phone Numbers -->
            <h3><a href="phonenumber.php?id=<?php echo $_GET['id'] ?>">Add Phone Number</a></h3>

            <!-- $id, $personId, $phoneNumber, $phoneType, $note -->
            <?php if($contact->phoneNumber): ?>

                <?php // echo var_dump($contact->phoneNumber); ?>

                <?php while($row = $contact->phoneNumber->fetch(PDO::FETCH_OBJ)): ?>
                    <?php $phoneLine = /*$phoneNumber['phoneType'] . " " . */$row->phone_number . " " . $row->note . "<br />"; ?>
                    <a href="phonenumber.php?id=<?php echo $id; ?>&update=<?php echo $row->id; ?>"><?php echo $phoneLine; ?></a>
                <?php endwhile; ?>
                <?php echo "<hr />"; ?>

            <?php endif; ?>

            <!-- End Phone Numbers -->

            <!-- Start Email Address  -->

            <h3><a href="email.php?id=<?php echo $_GET['id'] ?>">Add eMail Address</a></h3>
            <!--  ["emailAddress"]=> string(16) "elminero@cox.net" ["emailType"]=> int(0) ["note"]=> string(14) -->
            <?php
            if($contact->emailAddress): ?>

                <?php while($row = $contact->emailAddress->fetch(PDO::FETCH_OBJ)): ?>
                    <?php $emailLine = $row->email_address . " " . /*$email['emailType'] . " " . */$row->note . "<br />"; ?>
                    <a href="email.php?id=<?php echo $id; ?>&update=<?php echo $row->id; ?>"><?php echo $emailLine; ?></a>
                <?php endwhile ?>

                <?php echo "<hr />"; ?>

            <?php endif;  ?>
            <!-- End Email Address -->

            <!-- Start Address -->
            <h3><a href="address.php?id=<?php echo $_GET['id'] ?>">Add Address</a></h3>

            <table >
                <?php $i = 4; $b = 1; ?>
                <?php  if($contact->address): ?>
                <?php while ($row = $contact->address->fetch(PDO::FETCH_OBJ)): ?>
                <?php $addressTd = $row->street . "<br />" .
                    $row->city . ", " . $row->state . " " . $row->postal_code . " " . $row->country_iso . "<br />" .
                    $row->note;
                if(($i % 4) == 0)
                {
                    echo "<tr>";
                }
                ?>
                <td style="padding-right: 20px; color: white">
                    <a style="color: white" href="address.php?id=<?php  echo $id . "&update=". $row->id; ?>"><?php echo $addressTd; ?></a>
                    <?php
                    if(($b % 4) == 0)
                    {
                        echo "</tr>";
                    }
                    $i++; $b++;
                    ?>
                    <?php endwhile; ?>
                    <?php endif; ?>
            </table>
            <!-- End Address -->

        <?php
        include("includes/footer.php");
        ?>
    </div><!-- end .container -->

<script src="js/bootstrap.min.js"></script>
<script src="js/script.js"></script>
</body>
</html>

<?php
ob_end_flush();
?>
