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


    <script src="//code.jquery.com/jquery-1.11.2.min.js"></script>




    <!-- JS file -->
    <script src="node_modules/easy-autocomplete/dist/jquery.easy-autocomplete.min.js"></script>

    <!-- CSS file -->
    <link rel="stylesheet" href="node_modules/easy-autocomplete/dist/easy-autocomplete.min.css">

    <!-- Additional CSS Themes file - not required-->
    <link rel="stylesheet" href="node_modules/easy-autocomplete/dist/easy-autocomplete.themes.min.css">






    <script src="javascript/event_handlers.js" type="text/javascript"></script>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

    <title>Search By Name</title>
</head>
<body>
<div class="container" >
    <div class="header"><!-- Start Header -->
        <?php include("includes/header.php"); ?>
    </div><!-- end .header -->

        <div class="content">


            <form action="controllers/PersonController.php" method="post" name="search">
                <div class="form-content" >
                    <div >
                        <span class="">Search</span>
                        <input id ="match"  name="search_name"  /><br />
                        <script>
                            var options = {
                                url: "" +
                                "node_modules/easy-autocomplete/demo/resources/countries.json",

                                getValue: "name",

                              //  data: ["Clark Kent", "Diana Prince", "Tony Stark", "Bruce Wayne", "Selina Kyle"],
                                list: {
                                    maxNumberOfElements: 15,
                                    showAnimation: {
                                        type: "fade", //normal|slide|fade
                                        time: 400,
                                        callback: function() {}
                                    },

                                    hideAnimation: {
                                        type: "slide", //normal|slide|fade
                                        time: 400,
                                        callback: function() {}
                                    },


                                    match: {
                                        enabled: true
                                    }

                                },

                                theme: "plate-dark"

                            };

                            $("#match").easyAutocomplete(options);

                        </script>


                    </div>

                    <div class="form-block">

                        <input id ="SearchName" name="SearchName" type="submit" class="input_text" id="last_name"  value="Profile" /><br />
                    </div>

                </div>
            </form>



        </div><!-- end .content -->

        <?php include("includes/footer.php"); ?>

    </div><!-- end .container -->
</body>
</html>
