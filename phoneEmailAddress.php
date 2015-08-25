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

    <?php while($row = $contact->phoneNumber->fetch(PDO::FETCH_OBJ)): ?>
        <?php $phoneLine = /*$phoneNumber['phoneType'] . " " . */$row->phone_number . " " . $row->note . "<br />"; ?>
        <a href="phonenumber.php?id=<?php echo $id; ?>&update=<?php echo $row->id; ?>"><?php echo $phoneLine; ?></a>
    <?php endwhile; ?>

    <?php echo "<hr />"; ?>

<?php endif; ?>


<!-- End Phone Numbers -->

<!-- Start Email Address  -->

<h3><a href="email.php?id=<?php echo $_GET['id'] ?>">Add eMail Address</a></h3>
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

<table>
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
            <td style="padding-right: 20px">
            <a href="address.php?id=<?php  echo $id . "&update=". $row->id; ?>"><?php echo $addressTd; ?></a>
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





