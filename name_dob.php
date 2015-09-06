<?php // * User: Ian * Date: 9/6/2015

// require("models/Contact.php");

$contact = new Contact($_GET['id']);
$contact->getContactById();

$nameDOB =  $contact->nameDOB;
?>




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
            $nameDOB .= "DOB Incomplete: <br /> ";
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
    <a  id = "mainTitle" href="newcontact.php?id=<?php echo $contact->nameDOB->id; ?>&action=update"><?php echo $nameDOB ?></a>

</div>
<div style="clear: both;"></div>
<!-- End Name and DOB -->