<div class="footer">
    <?php
    $ip =  "Current IP Address: " . $_SERVER['REMOTE_ADDR'];
    $date = date("F j, Y");
    ?>

    <div style="float:left"><?php echo $ip ?></div>
    <div style="float:right"><?php echo $date ?></div>
    <div style="clear: both"></div>

</div>