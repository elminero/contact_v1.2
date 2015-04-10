<?php
require("models/Contact.php");

$contact = new Contact($_GET['id']);
$contact->getContactById();

?>

<!-- div 1 Start Avatar -->
<div style="float: left">
    <a href="picture.php?id=<?php echo $contact->avatar['id']; ?>"><img alt="" src="images/<?php echo $contact->avatar['pathFile']; ?>_t.jpg" /></a>
    <br />
    <div style="float: left">
        <a href="addphotos.php?id=<?php echo $contact->nameDOB['id']; ?>">View All</a>
    </div>

    <div style="float: right">
        <a href="editphotos.php?id=<?php echo $contact->nameDOB['id']; ?>">Edit</a>
    </div>
</div>

<!-- End Avatar -->
<!-- Start NameDOB -->
    <div style="margin-left: 10px; float: left; width: 200px">

<?php

$nameDOB = "Name: " . $contact->nameDOB['last'] . " " . $contact->nameDOB['first'] . " " . $contact->nameDOB['middle'] . "<br />" .
    "Alias: " . $contact->nameDOB['alias'] . "<br />";

if(($contact->nameDOB['birthYear'] != 0) AND ($contact->nameDOB['birthMonth'] != 0) AND ($contact->nameDOB['birthDay'] !=0))
{
    $nameDOB .= "DOB: " . $contact->getMonthNameByNumber($contact->nameDOB['birthMonth'])   . " " . $contact->nameDOB['birthDay'] . ", " . $contact->nameDOB['birthYear'] . "<br />";
}

if(($contact->nameDOB['birthYear'] == 0) || ($contact->nameDOB['birthMonth'] == 0) || ($contact->nameDOB['birthDay'] == 0)) {
    if (($contact->nameDOB['birthYear'] == 0) && ($contact->nameDOB['birthMonth'] == 0) && ($contact->nameDOB['birthDay'] == 0)) {
        $nameDOB .= "DOB: Unknown";
    }

    if (($contact->nameDOB['birthYear'] != 0) || ($contact->nameDOB['birthMonth'] != 0) || ($contact->nameDOB['birthDay'] != 0)) {
        $nameDOB .= "DOB Incomplete : ";
    }

    if($contact->nameDOB['birthYear'] != 0)
    {
        $nameDOB .= " Year: " . $contact->nameDOB['birthYear'];
        if($contact->nameDOB['birthMonth'] != 0)
        {
            $nameDOB .= ", ";
        }
        if($contact->nameDOB['birthDay'] != 0)
        {
            $nameDOB .= ", ";
        }
    }

    if($contact->nameDOB['birthMonth'] != 0)
    {
        $nameDOB .= " Month: " . $contact->getMonthNameByNumber($contact->nameDOB['birthMonth']);
        if($contact->nameDOB['birthDay'] != 0)
            $nameDOB .= ", ";
    }

    if($contact->nameDOB['birthDay'] != 0)
    {
        $nameDOB .= " Day: " . $contact->nameDOB['birthDay'];
    }

    $nameDOB .= "<br />Age Unknown<br />";
}

if(($contact->nameDOB['birthYear'] != 0) AND ($contact->nameDOB['birthMonth'] != 0) AND ($contact->nameDOB['birthDay'] !=0))
{
    $nameDOB .= "Age: " . $contact->getAge($contact->nameDOB['birthYear'], $contact->nameDOB['birthMonth'],
            $contact->nameDOB['birthDay']) . "<br />";

}

$nameDOB.="Note: " . "<div style=\"  width: 200px;   \">" . $contact->nameDOB['note'] . "</div>";

// echo $nameDOB;
?>

        <?php if( !isset($_GET['action']) ): ?>
            <a href="newcontact.php?id=<?php echo $contact->nameDOB['id'] ?>&action=update"><?php echo $nameDOB ?></a>
        <?php endif; ?>

        <?php if( isset($_GET['action'])  &&   ($_GET['action'] == 'update')           ): ?>
            <a href="profile.php?id=<?php echo $contact->nameDOB['id'] ?>"><?php echo $nameDOB ?></a>
        <?php endif; ?>

        </div>
<!-- End NameDOB -->





