<?php
// require dirname(__DIR__).'/models/User.php';
require dirname(__DIR__).'/vendor/autoload.php';

use Carbon\Carbon;

$timeZone = new UserPDO();

?>

<div class="footer">
    <?php
    $ip =  "Current IP Address: " . $_SERVER['REMOTE_ADDR'];
 //   $date = date("F j, Y");
    ?>

    <div style="float:left"><?php echo $ip; ?></div>
    <div style="float:right"><?php echo carbon::now($timeZone->getTimeZoneByUserId(1))->format('l jS \\of F Y'); ?></div>
    <div style="clear: both"></div>

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