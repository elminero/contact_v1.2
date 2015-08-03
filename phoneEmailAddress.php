<?php

if( isset($_GET['id']) ) {
    $id = (int)$_GET['id'];
}


$contact = new Contact($id);
$contact->getContactById();
?>

<!-- Start Phone Numbers -->
<h3><a href="phonenumber.php?id=<?php echo $_GET['id'] ?>">Add Phone Number</a></h3>

<!-- $id, $personId, $phoneNumber, $phoneType, $note -->
<?php if($contact->phoneNumber): ?>

    <?php // echo var_dump($contact->phoneNumber); ?>

    <?php foreach($contact->phoneNumber as $phoneNumber): ?>
        <?php $phoneLine = /*$phoneNumber['phoneType'] . " " .*/ $phoneNumber['phoneNumber'] . " " . $phoneNumber['note'] . "<br />"; ?>
        <a href="phonenumber.php?id=<?php echo $id; ?>&update=<?php echo $phoneNumber['id']; ?>"><?php echo $phoneLine; ?></a>
    <?php endforeach; ?>
    <?php echo "<hr />"; ?>

<?php endif; ?>


<!-- End Phone Numbers -->

<!-- Start Email Address  -->

<h3><a href="email.php?id=<?php echo $_GET['id'] ?>">Add eMail Address</a></h3>
<?php
if($contact->emailAddress): ?>
    <?php foreach($contact->emailAddress as $email): ?>

        <?php $emailLine = $email['emailAddress'] . " " . /*$email['emailType'] . " " .*/ $email['note'] . "<br />"; ?>

        <a href="email.php?id=<?php echo $id; ?>&update=<?php echo $email['id']; ?>"><?php echo $emailLine; ?></a>

        <?php // echo $emailLine; ?>

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
                <a href="address.php?id=<?php echo $id; ?>&update=<?php echo $address['addressId']; ?>"><?php echo $addressTd; ?></a>
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





