<?php
require("controllers/LoginController.php");
require("models/Contact.php");

$contact = new Contact($id);
$contact->getContactById();

ob_start();
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
<?php include("includes/header.php"); ?>
<div class="container">
    <ol class="breadcrumb">
        <li><a href="listcontacts.php">list</a></li>
        <li><b>Profile</b></li>
    </ol>
    <div class="row">
        <section class="col-sm-6">
            <!-- div 1 Start Avatar -->
            <?php require("avatar.php"); ?>
            <!-- End Avatar -->
        </section>
        <section class="col-sm-6">
            <!-- div 2 Start Name and DOB -->
            <?php require("name_dob.php"); ?>
            <!-- End Name and DOB -->
        </section>
    </div>
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
        <hr />
    <?php endif; ?><!-- End Phone Numbers -->

    <!-- Start Email Address  -->

    <h3><a href="email.php?id=<?php echo $_GET['id'] ?>">Add eMail Address</a></h3>
    <!--  ["emailAddress"]=> string(16) "elminero@cox.net" ["emailType"]=> int(0) ["note"]=> string(14) -->

    <?php if($contact->emailAddress): ?>

        <?php while($row = $contact->emailAddress->fetch(PDO::FETCH_OBJ)): ?>
            <?php $emailLine = $row->email_address . " " . /*$email['emailType'] . " " . */$row->note . "<br />"; ?>
            <a href="email.php?id=<?php echo $id; ?>&update=<?php echo $row->id; ?>"><?php echo $emailLine; ?></a>
        <?php endwhile ?>

        <hr />

    <?php endif;  ?><!-- End Email Address -->

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

    <?php include("includes/footer.php"); ?>
</div><!-- end .container -->
<script src="js/bootstrap.min.js"></script>
<script src="js/script.js"></script>
</body>
</html>
<?php ob_end_flush(); ?>