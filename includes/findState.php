<?php
ob_start();
require("../models/Address.php");

    $address = new Address();

	$country = $_GET['country'];




    $states = $address->getState($country);

?>

<select id="stateSelect" class="input_text" name="state" style="width:245px; background-color:#B8F5B1; ">

        <?php
			if(  $_GET['state'] != "undefined"     ){
				echo "<option value=\"{$_GET['state']}\">{$_GET['state']}</option>";
			}



			foreach($address->getState($country) as $states) {
				echo "<option value=\"{$states["subdivision"]}\">{$states["subdivision"]}</option>";
			}


			/*
			while ($row = $row = mysqli_fetch_array($result)){
				echo "<option value=\"{$row["subdivision"]}\">{$row["subdivision"]}</option>";	
			}		
			*/

		?>
</select><br />
