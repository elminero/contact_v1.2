

<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">

<script src="../js/jquery-1.12.0.min.js"></script>
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>

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


<div class="header"><!-- Start Header -->

    <nav class="navbar navbar-default">

            <ul class="nav navbar-nav">
                <li><a href="listcontacts.php">List</a></li>
                <li><a href="newcontact.php">New</a></li>
                <li><a href="controllers/LoginController.php?action=logout"><span id="timer">Logout 5:00</span></a></li>
            </ul>
            <form class="navbar-form navbar-right" role="search" id="searchForm" action="search.php" method="post" name="search">
                <div class="form-group">
                    <div class="input-group">
                        <input type="text" id="tags" class="form-control home-search" placeholder="Search For Name" name="name" >
                        <input name="value" type="hidden" id="tagValue" />
                        <span class="input-group-btn">
                            <button class="btn btn-default" type="submit" value="Profile" id ="SearchName" name="SearchName">Search</button>
                        </span>
                    </div>
                </div>
            </form>
    </nav>

<!--
<div class="btn-group btn-group-justified" role="group" aria-label="...">
    <div class="btn-group" role="group">
        <a href="listcontacts.php"><button type="button" class="btn btn-primary">List</button></a>
    </div>
    <div class="btn-group" role="group">
        <a href="search.php"><button type="button" class="btn btn-primary">Search</button></a>
    </div>
    <div class="btn-group" role="group">
        <a href="newcontact.php"><button type="button" class="btn btn-primary">New</button></a>
    </div>
    <div class="btn-group" role="group">
        <a href="controllers/LoginController.php?action=logout"><button id="timer" type="button" class="btn btn-primary">Logout 5:00</button></a>
    </div>
</div>
-->
<!--
    <ul id="nav" class="nav">
        <li><a href="listcontacts.php">List of All Contacts</a></li>
        <li><a href="search.php">Search By Name</a></li>
        <li><a href="newcontact.php">New Contact</a></li>
        <li ><a style="width: 194px" id="timer" href="controllers/LoginController.php?action=logout">Logout 5:00</a></li>
    </ul>
-->
    <!--<li id="timer" style="float: right; margin-right: 10px;">Time Remaining Before Logout 5:00</li>-->

</div><!-- end .header -->

<script>


        var time = 300;
        var maxTime = time + 1;

        function getDisplayTime() {
            var minutes = Math.floor(time / 60);
            var seconds = time - minutes * 60;

            if (seconds < 10) {
                seconds = "0"+seconds.toString();
            } else {
                seconds = seconds.toString();
            }

            return minutes.toString() + ":" + seconds;
        }


        function timer() {
            time--;

            if (time > 0) {
                document.getElementById("timer").innerHTML = "Logout " + getDisplayTime();
            } else {
                clearInterval(intervalHandler );
                window.location = "controllers/LoginController.php?action=logout";
            }

        }

        var intervalHandler = setInterval(timer, 1000);

        function reStart() {
            time = maxTime;
        }

        document.addEventListener("keydown", reStart);
        document.addEventListener("scroll", reStart);
        document.addEventListener("click", reStart);
        document.addEventListener("mousemove", reStart);
        document.addEventListener("wheel", reStart);

</script>

<!--
http://localhost/contact_v1/controllers/loginController.php?action=logout

http://localhost/contact_v1/controllers/LoginController.php

-->