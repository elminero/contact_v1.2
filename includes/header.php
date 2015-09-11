<div class="header"><!-- Start Header -->
    <ul  class="nav">
        <li><a href="listcontacts.php">List of All Contacts</a></li>
        <li><a href="newcontact.php">New Contact</a></li>
        <li><a href="controllers/LoginController.php?action=logout">Log Out</a></li>
        <li id="timer" style="float: right; margin-right: 10px;">300</li>
    </ul>
</div><!-- end .header -->

<script>
        var time = 300;

        function logout() {
            alert("Logout");
        }

        function timer() {
            time--;

            if (time > 0) {
                document.getElementById("timer").innerHTML = time.toString();
            } else {
                window.location = "controllers/LoginController.php?action=logout";
            }

        }

        var intervalHandler = setInterval(timer, 1000);

        document.onmousemove = function() {
            time = 301;
            //clearInterval(intervalHandler);
        };


        document.onclick = function() {
            time = 301;
            //clearInterval(intervalHandler);
        };


        document.onkeydown = function() {
            time = 301;
            //clearInterval(intervalHandler);
        };
</script>

<!--
http://localhost/contact_v1/controllers/loginController.php?action=logout

http://localhost/contact_v1/controllers/LoginController.php

-->