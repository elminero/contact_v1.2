<?php
require dirname(__DIR__).'/vendor/autoload.php';
use Carbon\Carbon;

$ip =  "Current IP Address: " . $_SERVER['REMOTE_ADDR'];
?>

<div class="footer row">
    <section class="col-sm-8">
        <?php echo $ip; ?>
    </section>
    <section class="col-sm-4 ">
    <?php

    /*
    if (isset($login->login) && ($login->login) == 1) {
        $timeZone = new UserPDO();
        echo carbon::now($timeZone->getTimeZoneByUserId($_COOKIE["phpContactId"]))->format('l jS \\of F Y');
    }
    */

    echo carbon::now(file_get_contents('https://ipapi.co/1.2.3.4/timezone/'))->format('l jS \\of F Y');

    ?>
    </section>
</div>


<!--

Eastern ........... America/New_York
Central ........... America/Chicago
Mountain .......... America/Denver
Mountain no DST ... America/Phoenix
Pacific ........... America/Los_Angeles
Alaska ............ America/Anchorage
Hawaii ............ America/Adak
Hawaii no DST ..... Pacific/Honolulu

-->