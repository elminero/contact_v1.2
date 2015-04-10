<?php
// ob_start();

require("models/Contact.php");
require("controllers/LoginController.php");

$login = new LoginController();
$login->verifyLogin();

if ($login->login == 0) {
    header("Location: login.php");
}


$mNameList = new Person();



$nameList = $mNameList->getAllPerson();





?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd" >
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <link rel="stylesheet" type="text/css" href="css/main.css"/>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>List of All Contacts</title>
</head>
<body>
<div class="container">
    <!-- Start Header -->
    <?php
        include("includes/header.php");
    ?>
    <!-- end .header -->
    <div class="content">
        <div style="margin-bottom: 9px">
            <b>List</b>
        </div>
        <div style="clear: both"></div>
        <table>
            <?php

            if($nameList) {
            foreach($nameList as $name)
                {
                    $nameLastFirstMiddle = $name['first'] . " " . $name['middle'] . " " . $name['last'];
                    echo
                    "<tr>" .
                        "<td>" .
                            "<a href=\"profile.php?id={$name['id']}\">{$nameLastFirstMiddle}</a>" .
                        "</td>
                        <td>";
                      //  if($person['state'])
                      //  {
                         //   echo $person['state'] . ", " . $address->getCountryFromIso($person['countryIso']);
                      //  }
                        echo "</td>" .
                    "</tr>";
                }
            }
            ?>
        </table>
    </div><!-- end .content -->
</div><!-- end .container -->
</body>
</html>
