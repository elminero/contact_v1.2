<?php
require("models/Contact.php");

$contact = new Contact($_GET['id']);
$contact->getContactById();

$nameDOB =  $contact->nameDOB;

/*
object(stdClass)#6 (9) { ["id"]=> string(1) "1" ["last_name"]=> string(6) "Farber" ["first_name"]=> string(6) "Robert"
["middle_name"]=> string(3) "Ian" ["alias_name"]=> string(5) "Robby" ["birth_month"]=> string(2) "11"
["birth_day"]=> string(2) "27" ["birth_year"]=> string(4) "2010" ["note"]=> string(19) "The quick brown fox" }
*/
?>

<!-- div 1 Start Avatar -->
<div style="float: left">
    <a href="picture.php?id=<?php echo $contact->avatar->id; ?>"><img alt="" src="images/<?php echo $contact->avatar->path_file; ?>_t.jpg" /></a>
    <br />
    <div style="float: left">
        <a href="addphotos.php?id=<?php echo $nameDOB->id; ?>">View All</a>
    </div>

    <div style="float: right">
        <a href="editphotos.php?id=<?php echo $nameDOB->id; ?>">Edit</a>
    </div>
</div>

<!-- End Avatar -->

<!-- Start NameDOB -->
    <div style="margin-left: 10px; float: left; width: 200px">

<?php

$name = "Name: " . $nameDOB->last_name . " " . $nameDOB->first_name . " " . $nameDOB->middle_name . "<br />" .
    "Alias: " . $nameDOB->alias_name . "<br />";

if(($nameDOB->birth_year != 0) AND ($nameDOB->birth_month != 0) AND ($nameDOB->birth_day != 0))
{
    $name .= "DOB: " . $contact->getMonthNameByNumber($nameDOB->birth_month)   . " " . $nameDOB->birth_day . ", " . $nameDOB->birth_year . "<br />";
}

if(($nameDOB->birth_year == 0) || ($nameDOB->birth_month == 0) || ($nameDOB->birth_day == 0)) {
    if (($nameDOB->birth_year == 0) && ($nameDOB->birth_month == 0) && ($nameDOB->birth_day == 0)) {
        $name .= "DOB: Unknown";
    }

    if (($contact->nameDOB->birth_year != 0) || ($nameDOB->birth_month != 0) || ($nameDOB->birth_day != 0)) {
        $name .= "DOB Incomplete : ";
    }

    if($nameDOB->birth_year != 0)
    {
        $name .= " Year: " . $nameDOB->birth_year;
        if($nameDOB->birth_month != 0)
        {
            $name .= ", ";
        }
        if($nameDOB->birthDay != 0)
        {
            $name .= ", ";
        }
    }

    if($nameDOB->birthMonth != 0)
    {
        $name .= " Month: " . $contact->getMonthNameByNumber($contact->nameDOB->birthMonth);
        if($nameDOB->birth_day != 0)
            $name .= ", ";
    }

    if($nameDOB->birth_day != 0)
    {
        $name .= " Day: " . $nameDOB->birthDay;
    }

    $name .= "<br />Age Unknown<br />";
}

if(($nameDOB->birth_year != 0) AND ($nameDOB->birth_month != 0) AND ($nameDOB->birth_day !=0))
{
    $name .= "Age: " . $contact->getAge($nameDOB->birth_year, $nameDOB->birth_month,
            $nameDOB->birth_day) . "<br />";

}

$name.="Note: " . "<div style=\"  width: 200px;   \">" . $nameDOB->note . "</div>";

// echo $nameDOB;
?>

        <?php if( !isset($_GET['action']) ): ?>
           <!-- <a href="newcontact.php?id=<?php // echo $nameDOB->id; ?>&action=update"><?php // echo  $nameDOB->id; ?></a> -->
        <?php endif; ?>

        <?php // if( isset($_GET['action'])  &&   ($_GET['action'] == 'update')           ): ?>
            <a href="profile.php?id=<?php echo $nameDOB->id; ?>"><?php echo $name; ?></a>
        <?php // endif; ?>

        </div>
<!-- End NameDOB -->





