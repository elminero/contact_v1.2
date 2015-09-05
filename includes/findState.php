<?php
ob_start();
require("../models/Address.php");

    $address = new AddressPDO();
	$country = urlencode($_GET['country']) ;
    $qStates = $address->getStatesByCountry($country);
?>

<select id="stateSelect" class="input_text" name="state" style="width:245px; background-color:#B8F5B1; ">



        <?php while($row = $qStates->fetch(PDO::FETCH_OBJ)): ?>
            <option value="<?php echo $row->subdivision; ?>"><?php echo $row->subdivision; ?></option>
        <?php endwhile; ?>

</select><br />


