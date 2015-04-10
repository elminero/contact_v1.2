<?php
//tDebug --  Db2 -- User -- Person -- (Address) -- PhoneNumber -- EmailAddress -- Image
require_once(dirname(dirname(__FILE__)).'/models/Db.php');

/*
        TABLE:   address
        COLUMNS: id, person_id, address_type, country_iso, state, street, city, postal_code, note
        VARIABLES: $id, $personId, $addressType, $countryIso, $state, $street, $city, $postalCode, $note

        id              integer,
        person_id       integer
        address_type    integer
        country_iso     string
        state           string
        street          string
        city            string
        postal_code     string
        note            string
*/

class Address extends Db2 {

    private $_id, $_personId, $_addressType, $_countryIso, $_state, $_street, $_city, $_postalCode, $_note;

    public function setAddressParam (AddressController $address) {

        $this->_id = $address->getId();
        $this->_personId = $address->getPersonId();
        $this->_addressType = $address->getAddressType();
        $this->_countryIso = $address->getCountryIso();
        $this->_state = $address->getState();
        $this->_street = $address->getStreet();
        $this->_city = $address->getCity();
        $this->_postalCode = $address->getPostalCode();
        $this->_note = $address->getNote();
    }


    public function addAddress($address)  // class Address
    {
        self::setAddressParam($address);

        $stmt = $this->mysqli->prepare("
					INSERT INTO address(
                    person_id, address_type, country_iso, state, street, city, postal_code, note )
					VALUES(
					?,?,?,?,?,?,?,?)");

        $stmt->bind_param("iissssss", $this->_personId, $this->_addressType, $this->_countryIso,
            $this->_state, $this->_street, $this->_city, $this->_postalCode,
            $this->_note);
        $stmt->execute();
        $insertId = $this->mysqli->insert_id;
        $stmt->close();

        return $insertId;
    }


    public function updateAddress($address)  // class Address
    {
        self::setAddressParam($address);

        $stmt = $this->mysqli->prepare("
                    UPDATE address
                    SET
                    address_type = ?,
                    country_iso = ?,
                    state = ?,
                    street = ?,
                    city = ?,
                    postal_code = ?,
                    note = ?
                    WHERE id = ? ");

        $stmt->bind_param("issssssi", $this->_addressType, $this->_countryIso, $this->_state,
            $this->_street, $this->_city, $this->_postalCode, $this->_note, $this->_id);
        $stmt->execute();
 //     $affectedRow = $this->mysqli->affected_rows;
        $stmt->close();

        return $this->_id;
    }


    public function getAllAddress()  // class Address
    {
        $addresses = null;

        $stmt = $this->mysqli->prepare("
                    SELECT id, person_id, address_type, country_iso, state, street, city, postal_code, note
                    FROM address");

        $stmt->execute();
        $stmt->bind_result($id, $personId, $addressType, $countryIso, $state, $street, $city, $postalCode, $note);

        while($stmt->fetch()) {
            $addresses[] = ["id"=>$id, "personId"=>$personId, "addressType"=>$addressType, "countryIso"=>$countryIso,
                            "state"=>$state, "street"=>$street, "city"=>$city, "postalCode"=>$postalCode, "note"=>$note];
        }

        $stmt->close();

        return $addresses;
    }


    public function getAddressById($id)  // class Address
    {
        $stmt = $this->mysqli->prepare("
					SELECT person_id, address_type, country_iso, state, street, city, postal_code, note
					FROM address
					WHERE id = ?");

        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->bind_result($personId, $addressType, $countryIso, $state, $street, $city, $postalCode, $note);
        $stmt->fetch();
        $stmt->close();
        $address = ["personId"=>$personId, "addressType"=>$addressType, "countryIso"=>$countryIso,
            "state"=>$state, "street"=>$street, "city"=>$city, "postalCode"=>$postalCode, "note"=>$note];
        return $address;
    }


    public function getAllAddressByPersonId($personId)  // class Address
    {
        $addresses = null;

        $stmt = $this->mysqli->prepare("
					SELECT id, address_type, country_iso, state, street, city, postal_code, note
					FROM address
					WHERE person_id = ?");

        $stmt->bind_param("i", $personId);
        $stmt->execute();
        $stmt->bind_result($addressId, $addressType, $countryIso, $state, $street, $city, $postalCode, $note);

        while($stmt->fetch())
        {
            $addresses[] = ["addressId"=>$addressId, "addressType"=>$addressType, "countryIso"=>$countryIso,
                "state"=>$state, "street"=>$street, "city"=>$city, "postalCode"=>$postalCode, "note"=>$note];

        }

        $stmt->close();

        return $addresses;
    }


    public function deleteAddress($id)  // class Address
    {
        $stmt = $this->mysqli->prepare("
                    DELETE FROM address
                    WHERE id = ? ");

        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->close();
    }


    public function getAllCountry()
    {
        $countries = null;

        $stmt = $this->mysqli->prepare("
                    SELECT country, iso
                    FROM country");

        $stmt->bind_result($country, $iso);
        $stmt->execute();

        while($stmt->fetch())
        {
            $countries[] = ["country"=>$country, "iso"=>$iso];
        }

        $stmt->close();

        return $countries;

    }


    public function getCountryByISO($iso)
    {
        $country = null;

        $stmt = $this->mysqli->prepare("
                    SELECT country, iso
                    FROM country
                    WHERE iso = ?");

        $stmt->bind_param("s", $iso);
        $stmt->bind_result($country, $iso);
        $stmt->execute();
        $stmt->fetch();
        $stmt->close();

        return $country;
    }



    public function getState($iso)
    {
        $states = null;

        $stmt = $this->mysqli->prepare("
                    SELECT subdivision, iso
                    FROM subdivision
                    WHERE iso = ?");

        $stmt->bind_param("s", $iso);

        $stmt->execute();

        $stmt->bind_result($subdivision, $iso);

        while($stmt->fetch())
        {
            $states[] = ['subdivision'=>$subdivision, 'iso'=>$subdivision];
        }

        $stmt->close();

        return $states;
    }


    function getStateAbbr($USState)
    {
        switch($USState) {

            case "Alabama":
                $stateAbbr = "AL";
                break;
            case "Alaska":
                $stateAbbr = "AK";
                break;
            case "Arizona":
                $stateAbbr = "AZ";
                break;
            case "Arkansas":
                $stateAbbr = "AR";
                break;
            case "California":
                $stateAbbr = "CA";
                break;
            case "Colorado":
                $stateAbbr = "CO";
                break;
            case "Connecticut":
                $stateAbbr = "CT";
                break;
            case "Delaware":
                $stateAbbr = "DE";
                break;
            case "District Of Columbia":
                $stateAbbr = "DC";
                break;
            case "Florida":
                $stateAbbr = "FL";
                break;
            case "Georgia":
                $stateAbbr = "GA";
                break;
            case "Hawaii":
                $stateAbbr = "HI";
                break;
            case "Idaho":
                $stateAbbr = "IA";
                break;
            case "Illinois":
                $stateAbbr = "IL";
                break;
            case "Indiana":
                $stateAbbr = "IN";
                break;
            case "Iowa":
                $stateAbbr = "IA";
                break;
            case "Kansas":
                $stateAbbr = "KS";
                break;
            case "Kentucky":
                $stateAbbr = "KY";
                break;
            case "Louisiana":
                $stateAbbr = "LA";
                break;
            case "Maine":
                $stateAbbr = "MA";
                break;
            case "Maryland":
                $stateAbbr = "MD";
                break;
            case "Massachusetts":
                $stateAbbr = "MA";
                break;
            case "Michigan":
                $stateAbbr = "MI";
                break;
            case "Minnesota":
                $stateAbbr = "MN";
                break;
            case "Mississippi":
                $stateAbbr = "MS";
                break;
            case "Missouri":
                $stateAbbr = "MO";
                break;
            case "Montana":
                $stateAbbr = "MT";
                break;
            case "Nebraska":
                $stateAbbr = "NE";
                break;
            case "Nevada":
                $stateAbbr = "NV";
                break;
            case "New Hampshire":
                $stateAbbr = "NH";
                break;
            case "New Jersey":
                $stateAbbr = "NJ";
                break;
            case "New Mexico":
                $stateAbbr = "NM";
                break;
            case "New York":
                $stateAbbr = "NY";
                break;
            case "North Carolina":
                $stateAbbr = "NC";
                break;
            case "North Dakota":
                $stateAbbr = "ND";
                break;
            case "Ohio":
                $stateAbbr = "OH";
                break;
            case "Oklahoma":
                $stateAbbr = "OK";
                break;
            case "Oregon":
                $stateAbbr = "OR";
                break;
            case "Pennsylvania":
                $stateAbbr = "PA";
                break;
            case "Rhode Island":
                $stateAbbr = "RI";
                break;
            case "South Carolina":
                $stateAbbr = "SC";
                break;
            case "South Dakota":
                $stateAbbr = "SD";
                break;
            case "Tennessee":
                $stateAbbr = "TN";
                break;
            case "Texas":
                $stateAbbr = "TX";
                break;
            case "Utah":
                $stateAbbr = "UT";
                break;
            case "Vermont":
                $stateAbbr = "VT";
                break;
            case "Virginia":
                $stateAbbr = "VA";
                break;
            case "Washington":
                $stateAbbr = "WA";
                break;
            case "West Virginia":
                $stateAbbr = "WV";
                break;
            case "Wisconsin":
                $stateAbbr = "WI";
                break;
            case "Wyoming":
                $stateAbbr = "WY";
                break;
            default:
                $stateAbbr = "notOnList";


        }

        return $stateAbbr;

    }


    public function getAllCityByState($stateAbbr)
    {
        $cities = null;

        $stmt = $this->mysqli->prepare("
                    SELECT DISTINCT city
                    FROM us_zip_code
                    WHERE state = ?
                    AND zip_code_type  = 'STANDARD' ORDER BY city;");

        $stmt->bind_param("s", $stateAbbr);
        $stmt->execute();
        $stmt->bind_result($city);

        while($stmt->fetch())
        {
            $cities[] = ['city'=>$city];
        }

        $stmt->close();

        return $cities;
    }



}

/*      For testing purposes

$address = new Address();

$addressData = $address->getAllAddressByPersonId(1);

echo var_dump($addressData);





        echo $this->_id;
        echo "<br />";
        echo $this->_personId;
        echo "<br />";
        echo $this->_addressType;
        echo "<br />";
        echo $this->_countryIso;
        echo "<br />";
        echo $this->_state;
        echo "<br />";
        echo $this->_street;
        echo "<br />";
        echo $this->_city;
        echo "<br />";
        echo $this->_postalCode;
        echo "<br />";
        echo $this->_note;
*/
