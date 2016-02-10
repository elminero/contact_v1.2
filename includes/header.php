

<div class="header"><!-- Start Header -->

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