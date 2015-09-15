<div class="header"><!-- Start Header -->
    <ul  class="nav">
        <li><a href="listcontacts.php">List of All Contacts</a></li>
        <li><a href="newcontact.php">New Contact</a></li>
        <li><a href="controllers/LoginController.php?action=logout">Log Out</a></li>
        <li id="timer" style="float: right; margin-right: 10px;">Time Remaining Before Logout 5:00</li>
    </ul>
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
                document.getElementById("timer").innerHTML = "Time Remaining Before Logout " + getDisplayTime();
            } else {
                clearInterval(intervalHandler );
                // var url = "http://www.google.com/";
                // window.location = url;
                // window.location.replace (url);
                // window.location.replace('index.php');
                window.location = "controllers/LoginController.php?action=logout";
            }

        }

        var intervalHandler = setInterval(timer, 1000);

        document.onmousemove = function() {
            time = maxTime;
        };


        document.onclick = function() {
            time = maxTime;
        };


        document.onkeydown = function() {
            time = maxTime;
        };


        document.onscroll = function() {
            time = maxTime;
        };

        document.onmousewheel  = function() {
            time = maxTime;
        };
        
        document.addEventListener("wheel", reStart);

        function reStart() {
            time = maxTime;
        }

</script>

<!--
http://localhost/contact_v1/controllers/loginController.php?action=logout

http://localhost/contact_v1/controllers/LoginController.php

-->