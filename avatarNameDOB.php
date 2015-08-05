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
        <a href="addphotos.php?id=<?php echo $contact->nameDOB->id; ?>">View All</a>
    </div>

    <div style="float: right">
        <a href="editphotos.php?id=<?php echo $contact->nameDOB->id; ?>">Edit</a>
    </div>
</div>

<!-- End Avatar -->
<!-- Start NameDOB -->
    <div style="margin-left: 10px; float: left; width: 200px">

<?php

$nameDOB = "Name: " . $contact->nameDOB->last_name . " " . $contact->nameDOB->first_name . " " . $contact->nameDOB->middle_name . "<br />" .
    "Alias: " . $contact->nameDOB->alias_name . "<br />";

if(($contact->nameDOB->birth_year != 0) AND ($contact->nameDOB->birthMonth != 0) AND ($contact->nameDOB->birthDay != 0))
{
    $nameDOB .= "DOB: " . $contact->getMonthNameByNumber($contact->nameDOB->birthMonth)   . " " . $contact->nameDOB->birthDay . ", " . $contact->nameDOB->birth_year . "<br />";
}

if(($contact->nameDOB->birth_year == 0) || ($contact->nameDOB->birthMonth == 0) || ($contact->nameDOB->birthDay == 0)) {
    if (($contact->nameDOB->birth_year == 0) && ($contact->nameDOB->birthMonth == 0) && ($contact->nameDOB->birthDay == 0)) {
        $nameDOB .= "DOB: Unknown";
    }

    if (($contact->nameDOB->birth_year != 0) || ($contact->nameDOB->birthMonth != 0) || ($contact->nameDOB->birthDay != 0)) {
        $nameDOB .= "DOB Incomplete : ";
    }

    if($contact->nameDOB->birth_year != 0)
    {
        $nameDOB .= " Year: " . $contact->nameDOB->birth_year;
        if($contact->nameDOB->birthMonth != 0)
        {
            $nameDOB .= ", ";
        }
        if($contact->nameDOB->birthDay != 0)
        {
            $nameDOB .= ", ";
        }
    }

    if($contact->nameDOB->birthMonth != 0)
    {
        $nameDOB .= " Month: " . $contact->getMonthNameByNumber($contact->nameDOB->birthMonth);
        if($contact->nameDOB->birthDay != 0)
            $nameDOB .= ", ";
    }

    if($contact->nameDOB->birthDay != 0)
    {
        $nameDOB .= " Day: " . $contact->nameDOB->birthDay;
    }

    $nameDOB .= "<br />Age Unknown<br />";
}

if(($contact->nameDOB->birth_year != 0) AND ($contact->nameDOB->birthMonth != 0) AND ($contact->nameDOB->birthDay !=0))
{
    $nameDOB .= "Age: " . $contact->getAge($contact->nameDOB->birth_year, $contact->nameDOB->birthMonth,
            $contact->nameDOB->birthDay) . "<br />";

}

$nameDOB.="Note: " . "<div style=\"  width: 200px;   \">" . $contact->nameDOB->note . "</div>";

// echo $nameDOB;
?>

        <?php if( !isset($_GET['action']) ): ?>
            <a href="newcontact.php?id=<?php echo $contact->nameDOB->id; ?>&action=update"><?php echo $nameDOB ?></a>
        <?php endif; ?>

        <?php if( isset($_GET['action'])  &&   ($_GET['action'] == 'update')           ): ?>
            <a href="profile.php?id=<?php echo $contact->nameDOB->id; ?>"><?php echo $nameDOB ?></a>
        <?php endif; ?>

        </div>
<!-- End NameDOB -->





