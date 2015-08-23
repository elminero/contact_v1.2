<?php
ob_start();
require("../models/Address.php");

$address = new AddressPDO();


//$city = new City();

//$state = getUSStateAbbreviation($_GET['state']);

$state = $address->getStateAbbr($_GET['state']);





$qCities = $address->getAllCityByState($state);

?>


<?php if ($state === "notOnList"): ?>
    <div class="form-block">
        <span class="form-label">City</span>
        <input style="width:245px;" class="input_text" type="text" name="city" maxlength="40" value=""  /><br />
    </div>
<?php endif; ?>

<?php if ($state != "notOnList"): ?>
<span class="form-label">City</span>
<select style="width:245px;" id="country" class="input_text" name="city" >

    <?php while($row = $qCities->fetch(PDO::FETCH_OBJ)): ?>
        <?php $city = ucwords(strtolower($row->city)); ?>
        <option value="<?php echo $city; ?>"><?php echo $city; ?></option>";
    <?php endwhile; ?>

</select>
<br />
<?php endif; ?>