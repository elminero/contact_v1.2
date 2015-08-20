<?php
//tDebug --  Db2 -- User -- Person -- Address -- (PhoneNumber) -- EmailAddress -- Image
// require("Address.php");
require_once(dirname(dirname(__FILE__)).'/models/Db.php');

/*
        TABLE:   phone_number
        COLUMNS: id, person_id, phone_number, phone_type, note
        VARIABLES: $id, $personId, $phoneNumber, $phoneType, $note

        id              integer
        person_id       integer
        phone_number    string
        phone_type      integer
        note            text
*/

class PhoneNumber extends Db2  {

    private $_id, $_personId, $_phoneNumber, $_phoneType, $_note;

    public function setPhoneParam (PhoneNumberController $phone) {

        $this->_id = $phone->getId();
        $this->_personId = $phone->getPersonId();
        $this->_phoneNumber = $phone->getNumber();
        $this->_phoneType = $phone->getType();
        $this->_note = $phone->getNote();
    }


    public function addPhoneNumber(PhoneNumberController $phone)  // class PhoneNumber
    {
        self::setPhoneParam($phone);

        $insertId = null;

        $stmt = $this->mysqli->prepare("
					INSERT INTO phone_number(
                    person_id, phone_number, phone_type, note )
					VALUES(
					?,?,?,?)");

        $stmt->bind_param("isis", $this->_personId, $this->_phoneNumber, $this->_phoneType, $this->_note);
        $stmt->execute();
        $insertId = $this->mysqli->insert_id;
        $stmt->close();

        return $insertId;
    }


    public function updatePhoneNumber($phone)  // class PhoneNumber
    {

        self::setPhoneParam($phone);

        $stmt = $this->mysqli->prepare("
                                UPDATE phone_number
                                SET
                                phone_number = ?,
                                phone_type = ?,
                                note = ?
                                WHERE id = ? ");

        $stmt->bind_param("sisi", $this->_phoneNumber, $this->_phoneType, $this->_note, $this->_id);
        $stmt->execute();

     //   $affectedRow = $this->mysqli->affected_rows;

        $stmt->close();

        return $this->_id;

    }


    public function getAllPhoneNumber()  // class PhoneNumber
    {
        $phoneNumbers = null;

        $stmt = $this->mysqli->prepare("
                    SELECT id, person_id, phone_number, phone_type, note
                    FROM phone_number");

        $stmt->execute();
        $stmt->bind_result($id, $personId, $phoneNumber, $phoneType, $note);

        while($stmt->fetch()) {
            $phoneNumbers[] = ["id"=>$id, "personId"=>$personId, "phoneNumber"=>$phoneNumber, "phoneType"=>$phoneType,
                "note"=>$note];
        }

        $stmt->close();

        return $phoneNumbers;
    }


    public function getPhoneNumberById($id)  // class PhoneNumber
    {
        $stmt = $this->mysqli->prepare("
					SELECT id, person_id, phone_number, phone_type, note
					FROM phone_number
					WHERE id = ?");

        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->bind_result($id, $personId, $phoneNumber, $phoneType, $note);
        $stmt->fetch();
        $stmt->close();
        $phoneNumber = ["id"=>$id, "personId"=>$personId, "phoneNumber"=>$phoneNumber, "phoneType"=>$phoneType, "note"=>$note];
        return $phoneNumber;
    }


    public function getAllPhoneNumberByPersonId($personId)
    {
        $phoneNumbers = null;

        $stmt = $this->mysqli->prepare("
					SELECT id, phone_number, phone_type, note
					FROM phone_number
					WHERE person_id = ?");

        $stmt->bind_param("i", $personId);
        $stmt->execute();
        $stmt->bind_result($id, $phoneNumber, $phoneType, $note);

        while($stmt->fetch())
        {
            $phoneNumbers[] = ["id"=>$id, "phoneNumber"=>$phoneNumber, "phoneType"=>$phoneType, "note"=>$note];
        }

        $stmt->close();

        return $phoneNumbers;
    }


    public function deletePhoneNumber($id)  // class PhoneNumber
    {
        $stmt = $this->mysqli->prepare("
                    DELETE FROM phone_number
                    WHERE id = ? ");

        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->close();
    }

}


class PhoneNumberPDO extends Db3  {

    private $_id, $_personId, $_phoneNumber, $_phoneType, $_note;

    public function setPhoneParam (PhoneNumberController $phone) {

        $this->_id = $phone->getId();
        $this->_personId = $phone->getPersonId();
        $this->_phoneNumber = $phone->getNumber();
        $this->_phoneType = $phone->getType();
        $this->_note = $phone->getNote();
    }


    public function addPhoneNumber(PhoneNumberController $phone)  // class PhoneNumber
    {
        self::setPhoneParam($phone);

        $stmt = $this->pdo->prepare("
					INSERT INTO phone_number(
                    person_id, phone_number, phone_type, note )
					VALUES(
					?,?,?,?)");

        $stmt->execute([$this->_personId, $this->_phoneNumber, $this->_phoneType, $this->_note]);

        return $this->pdo->lastInsertId();
    }


    public function updatePhoneNumber($phone)  // class PhoneNumber
    {
        self::setPhoneParam($phone);

        $stmt = $this->pdo->prepare("
                                UPDATE phone_number
                                SET
                                phone_number = ?,
                                phone_type = ?,
                                note = ?
                                WHERE id = ? ");

        $stmt->execute([$this->_phoneNumber, $this->_phoneType, $this->_note, $this->_id]);

        return $this->_id;
        /*

        self::setPhoneParam($phone);

        $stmt = $this->mysqli->prepare("
                                UPDATE phone_number
                                SET
                                phone_number = ?,
                                phone_type = ?,
                                note = ?
                                WHERE id = ? ");

        $stmt->bind_param("sisi", $this->_phoneNumber, $this->_phoneType, $this->_note, $this->_id);
        $stmt->execute();

        //   $affectedRow = $this->mysqli->affected_rows;

        $stmt->close();

        return $this->_id;
        */
    }


    public function getAllPhoneNumber()  // class PhoneNumber
    {

        /*
        $phoneNumbers = null;

        $stmt = $this->mysqli->prepare("
                    SELECT id, person_id, phone_number, phone_type, note
                    FROM phone_number");

        $stmt->execute();
        $stmt->bind_result($id, $personId, $phoneNumber, $phoneType, $note);

        while($stmt->fetch()) {
            $phoneNumbers[] = ["id"=>$id, "personId"=>$personId, "phoneNumber"=>$phoneNumber, "phoneType"=>$phoneType,
                "note"=>$note];
        }

        $stmt->close();

        return $phoneNumbers;
        */
    }


    public function getPhoneNumberById($id)  // class PhoneNumber
    {
      //  $stmt = $this->pdo

        /*
        $stmt = $this->mysqli->prepare("
					SELECT id, person_id, phone_number, phone_type, note
					FROM phone_number
					WHERE id = ?");

        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->bind_result($id, $personId, $phoneNumber, $phoneType, $note);
        $stmt->fetch();
        $stmt->close();
        $phoneNumber = ["id"=>$id, "personId"=>$personId, "phoneNumber"=>$phoneNumber, "phoneType"=>$phoneType, "note"=>$note];
        return $phoneNumber;
        */


    }


    public function getAllPhoneNumberByPersonId($personId)
    {

        /*
        $phoneNumbers = null;

        $stmt = $this->mysqli->prepare("
					SELECT id, phone_number, phone_type, note
					FROM phone_number
					WHERE person_id = ?");

        $stmt->bind_param("i", $personId);
        $stmt->execute();
        $stmt->bind_result($id, $phoneNumber, $phoneType, $note);

        while($stmt->fetch())
        {
            $phoneNumbers[] = ["id"=>$id, "phoneNumber"=>$phoneNumber, "phoneType"=>$phoneType, "note"=>$note];
        }

        $stmt->close();

        return $phoneNumbers;

        */
    }


    public function deletePhoneNumber($id)  // class PhoneNumber
    {
        /*
        $stmt = $this->mysqli->prepare("
                    DELETE FROM phone_number
                    WHERE id = ? ");

        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->close();
        */
    }

}






/*

$phone = new PhoneNumber();

$phoneInfo = $phone->getPhoneNumberById(1);

echo var_dump($phoneInfo);



*/
