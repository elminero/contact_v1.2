<form name="add_address" method="post" action="portfolio.php">

    Address Type
    <select name="address_type" >
        <option value="0" >  </option>
        <option value="1" > Current Street </option>
        <option value="2" > Current Mailing </option>
        <option value="3" > Previous Street </option>
        <option value="4" > Previous Mailing </option>
        <option value="5" > Current Crash Pad </option>
        <option value="6" > Previous Crash Pad </option>
        <option value="7" > Other </option>
    </select>

    Country
    <select id="country" class="input_text" name="country_iso" style="width:245px; background-color:#B8F5B1"    >
        <option value= "1"> </option>
        <option value="US" > United States </option  >
        <option value="CA" > Canada </option>
        <option value="MX" > Mexico </option>
        <?php
        foreach($countries as $country): ?>
            <option value="<?php echo $country['countryIso']?>" > <?php echo $country['country'] ?> </option>
        <?php endforeach; ?>
    </select>
    <br />

    State
    <select id="statediv" class="input_text" name="state" style="width:245px; >
                        <option value="" >Select Country First</option>
    </select>

    City
    <select class="input_text" name="city" style="width:245px; color:#CCC;">
        <option value="" >Select Country and State First</option>
    </select>
    <br />

    Address
    <input class="input_text" type="text" name="street" size="30" maxlength="40" />

    Postal Code
    <input class="input_text" type="text" name="postal_code" size="20" maxlength="40" />
    <br />

    Notes
    <textarea rows="5" cols="40" name="note_address" ></textarea>

    <input type="hidden" name="insert_id" value="<?php echo $_POST['name_id']; ?>" />
    <input type="submit" name="add_address" value="Add Addresses" />


</form>