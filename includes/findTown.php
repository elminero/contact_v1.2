<?php
ob_start();
require("../models/Address.php");

$address = new Address();


//$city = new City();

//$state = getUSStateAbbreviation($_GET['state']);

$state = $address->getStateAbbr($_GET['state']);





$cities = $address->getAllCityByState($state);

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
    <?php foreach($address->getAllCityByState($state) as $city): ?>
        <?php $city = ucwords(strtolower($city['city'])); ?>
        <option value="<?php echo $city; ?>"><?php echo $city; ?></option>";
    <?php endforeach; ?>
</select>
<br />
<?php endif; ?>