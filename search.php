<?php
require("controllers/LoginController.php");

$login = new LoginController();
$login->verifyLogin();

if ($login->login == 0) {
    header("Location: login.php");
}

require("models/Contact.php");

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <link rel="stylesheet" type="text/css" href="css/main.css"/>

    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">

    <script src="//code.jquery.com/jquery-1.11.3.min.js"></script>

    <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>


    <script src="javascript/event_handlers.js" type="text/javascript"></script>

    <script>



        $(function() {

            var action;

            document.getElementById("tags").focus();

                $("#tags").autocomplete({

                    minLength: 2,

                    source: "source.php",

                    focus: function (event, ui) {
                        $("#topics").val(ui.item.label);
                        return false;
                    },

                    select: function( event, ui ) {


                    //    $("#results").text(ui.item.value);

                        $("#tagValue").val(ui.item.id);

                        action = "profile.php?id="+ui.item.id;


                        document.getElementById("searchForm").setAttribute("action", action);

                    }

                });


        });
    </script>







    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

    <title>Search By Name</title>
</head>
<body>
<div class="container" >
    <div class="header"><!-- Start Header -->
        <?php include("includes/header.php"); ?>
    </div><!-- end .header -->
        <div class="content">
                <p id ="qwerty"></p>
            <form id="searchForm" action="search.php" method="post" name="search">

            <!--<form action="controllers/PersonController.php" method="post" name="search">-->

                <div style="width: 490px" >
                    <div >
                        <span style="float: left; padding-right: 10px" >Search</span>
                        <input style="float: left" id="tags" type="text" size="45"  name="name"/>
                        <input name="value" type="hidden" id="tagValue" />
                    </div>
                    <div class="form-block">
                        <input style="float: right" id ="SearchName" name="SearchName" type="submit" class="input_text" value="Profile" /><br />
                    </div>
                </div>
            </form>
        </div><!-- end .content -->
        <?php include("includes/footer.php"); ?>
    </div><!-- end .container -->
</body>
</html>
