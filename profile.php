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

// echo $contact->nameDOB->last_name;


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
    <title>Show Contact</title>
</head>

<body>
<div class="container">
    <div class="header">
        <!-- Start Header -->
        <?php
            include("includes/header.php");
        ?>
        <!-- end .header -->
        <div class="content">

            <div style="margin-bottom: 9px">
                <a href="listcontacts.php">List</a> >> <b>Profile</b>
            </div>
            <div style="clear: both"></div>

            <!-- div 1 Start Avatar -->
            <div  style="float: left">

                <?php // echo var_dump($contact->avatar['pathFile']);  ?>

                <a href="picture.php?id=<?php echo $contact->avatar['id'] ?>"><img alt="" src="images/<?php echo $contact->avatar['pathFile']; ?>_t.jpg" /></a>

                <br />

                <div style="float: left">
                    <a href="addphotos.php?id=<?php echo $id ?>">View All</a>
                </div>

                <div style="float: right">
                    <a href="editphotos.php?id=<?php echo $id ?>">Edit</a>
                </div>


            </div>

            <!-- End Avatar -->

            <!-- div 2 Start Name and DOB -->
            <div style="margin-left: 10px; float: left">
                <?php


                $nameDOB = "Name: " . $contact->nameDOB->last_name . " " . $contact->nameDOB->first_name . " " . $contact->nameDOB->middle_name . "<br />" .
                    "Alias: " . $contact->nameDOB->alias_name . "<br />";

                if(($contact->nameDOB->birth_year != 0) AND ($contact->nameDOB->birth_month != 0) AND ($contact->nameDOB->birth_day !=0))
                {
                    $nameDOB .= "DOB: " . $contact->getMonthNameByNumber($contact->nameDOB->birth_month)   . " " . $contact->nameDOB->birth_day . ", " . $contact->nameDOB->birth_year . "<br />";
                }

                if(($contact->nameDOB->birth_year == 0) || ($contact->nameDOB->birth_month == 0) || ($contact->nameDOB->birth_day == 0)) {
                    if (($contact->nameDOB->birth_year == 0) && ($contact->nameDOB->birth_month == 0) && ($contact->nameDOB->birth_day == 0)) {
                        $nameDOB .= "DOB: Unknown";
                    }

                    if (($contact->nameDOB->birth_year != 0) || ($contact->nameDOB->birth_month != 0) || ($contact->nameDOB->birth_day != 0)) {
                        $nameDOB .= "DOB Incomplete : ";
                    }

                    if($contact->nameDOB->birth_year != 0)
                    {
                        $nameDOB .= " Year: " . $contact->nameDOB->birth_year;
                        if($contact->nameDOB->birth_month != 0)
                        {
                            $nameDOB .= ", ";
                        }
                        if($contact->nameDOB->birth_day != 0)
                        {
                            $nameDOB .= ", ";
                        }
                    }

                    if($contact->nameDOB->birth_month != 0)
                    {
                        $nameDOB .= " Month: " . $contact->getMonthNameByNumber($contact->nameDOB->birth_month);
                        if($contact->nameDOB->birth_day != 0)
                            $nameDOB .= ", ";
                    }

                    if($contact->nameDOB->birth_day != 0)
                    {
                        $nameDOB .= " Day: " . $contact->nameDOB->birth_day;
                    }

                    $nameDOB .= "<br />Age Unknown<br />";
                }

                if(($contact->nameDOB->birth_year != 0) AND ($contact->nameDOB->birth_month != 0) AND ($contact->nameDOB->birth_day !=0))
                {
                    $nameDOB .= "Age: " . $contact->getAge($contact->nameDOB->birth_year, $contact->nameDOB->birth_month,
                            $contact->nameDOB->birth_day) . "<br />";
                }

                $nameDOB.="Note: " . "<div style=\"  width: 615px;   \">" . $contact->nameDOB->note . "</div>";
                ?>

                <a href="newcontact.php?id=<?php echo $contact->nameDOB->id; ?>&action=update"><?php echo $nameDOB ?></a>





            </div>
            <div style="clear: both;"></div>
            <hr />
            <!-- End Name and DOB -->


            <!-- Start Phone Numbers -->
            <h3><a href="phonenumber.php?id=<?php echo $_GET['id'] ?>">Add Phone Number</a></h3>

            <!-- $id, $personId, $phoneNumber, $phoneType, $note -->
            <?php if($contact->phoneNumber): ?>

                <?php // echo var_dump($contact->phoneNumber); ?>

                <?php foreach($contact->phoneNumber as $phoneNumber): ?>
                    <?php $phoneLine = /*$phoneNumber['phoneType'] . " " . */$phoneNumber['phoneNumber'] . " " . $phoneNumber['note'] . "<br />"; ?>
                    <a href="phonenumber.php?id=<?php echo $id; ?>&update=<?php echo $phoneNumber['id']; ?>"><?php echo $phoneLine; ?></a>
                <?php endforeach; ?>
                <?php echo "<hr />"; ?>

            <?php endif; ?>


            <!-- End Phone Numbers -->

            <!-- Start Email Address  -->

            <h3><a href="email.php?id=<?php echo $_GET['id'] ?>">Add eMail Address</a></h3>
            <!--  ["emailAddress"]=> string(16) "elminero@cox.net" ["emailType"]=> int(0) ["note"]=> string(14) -->
            <?php
            if($contact->emailAddress): ?>
                <?php foreach($contact->emailAddress as $email): ?>

                    <?php $emailLine = $email['emailAddress'] . " " . /*$email['emailType'] . " " . */$email['note'] . "<br />"; ?>


                    <a href="email.php?id=<?php echo $id; ?>&update=<?php echo $email['id']; ?>"><?php echo $emailLine; ?></a>


                <?php endforeach ?>
                <?php echo "<hr />"; ?>

            <?php endif;  ?>
            <!-- End Email Address -->

            <!-- Start Address -->
            <h3><a href="address.php?id=<?php echo $_GET['id'] ?>">Add Address</a></h3>
            <table>
                <?php $i = 4; $b = 1; ?>


                <?php
                /*
                    ["$addressId"=>$addressId, "addressType"=>$addressType, "countryIso"=>$countryIso,
                    "state"=>$state, "street"=>$street, "city"=>$city, "postalCode"=>$postalCode, "note"=>$note]
                */

                if($contact->address) {
                    foreach($contact->address as $address)
                    {
                        $addressTd = $address['street'] . "<br />" .
                            $address['city'] . ", " . $address['state'] . " " . $address['postalCode'] . " " . $address['countryIso'] . "<br />" .
                            $address['note'];


                        if(($i % 4) == 0)
                        {
                            echo "<tr>";
                        }

                        ?>

                        <td style="padding-right: 20px">




                            <a href="address.php?id=<?php echo $id . "&update=". $address['addressId']; ?>"><?php echo $addressTd; ?></a>


                        </td>

                        <?php
                        if(($b % 4) == 0)
                        {
                            echo "</tr>";
                        }

                        $i++; $b++;

                    }
                }
                ?>
            </table>


            <!-- End Address -->




        </div><!-- end .content -->

        <?php
        include("includes/footer.php");
        ?>

    </div><!-- end .container -->
</body>
</html>

<?php
//mysqli_close($mysqli);
ob_end_flush();
?>
