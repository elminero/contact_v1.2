<div class="header"><!-- Start Header -->
    <ul  class="nav">
        <li><a href="listcontacts.php">List of All Contacts</a></li>
        <li><a href="newcontact.php">New Contact</a></li>
        <li><a href="controllers/LoginController.php?action=logout">Log Out</a></li>
        <li id="timer" style="float: right; margin-right: 10px;">10</li>
    </ul>
</div><!-- end .header -->

<script>
        var time = 10;

        function logout() {
            alert("Logout");
        }

        function timer() {
            time--;

            if (time < 0) {
                window.location = "controllers/LoginController.php?action=logout";
                // window.open("controllers/LoginController.php?action=logout");
                // window.open(url, windowName, "height=200,width=200");
            } else {
                document.getElementById("timer").innerHTML = time.toString();
            }

        }

        setInterval(timer, 1000);
</script>

<!--
http://localhost/contact_v1/controllers/loginController.php?action=logout

http://localhost/contact_v1/controllers/LoginController.php

-->