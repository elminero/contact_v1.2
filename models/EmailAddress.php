<?php
//tDebug --  Db2 -- User -- Person -- Address -- PhoneNumber -- (EmailAddress) -- Image
// require("PhoneNumber.php");
require_once(dirname(dirname(__FILE__)).'/models/Db.php');

/*
        TABLE:   email_address
        COLUMNS: id, person_id, email_address, email_type, note
        VARIABLES: $id, $personId, $emailAddress, $emailType, $note

        id              integer
        person_id       integer
        email_address   string
        email_type      integer
        note            string
*/

class EmailAddress extends Db2 {

    private $_id, $_personId, $_emailAddress, $_type, $_note;

    public function setEmailParam (EmailAddressController $email) {

        $this->_personId = $email->getPersonId();
        $this->_emailAddress =  $email->getEmailAddress();
        $this->_type = $email->getType();
        $this->_note = $email->getNote();
        $this->_id = $email->getId();
    }


    public function addEmailAddress($email)  // class EmailAddress
    {
        self::setEmailParam($email);

        $insertId = null;

        $stmt = $this->mysqli->prepare("
					INSERT INTO email_address(
                    person_id, email_address, email_type, note )
					VALUES(
					?,?,?,?)");

        $stmt->bind_param("isis", $this->_personId, $this->_emailAddress, $this->_type, $this->_note );
        $stmt->execute();
        $insertId = $this->mysqli->insert_id;
        $stmt->close();

        return $insertId;
    }


    public function updateEmailAddress($email)  // class EmailAddress
    {
        self::setEmailParam($email);

        $stmt = $this->mysqli->prepare("
                                UPDATE email_address
                                SET
                                email_address = ?,
                                email_type = ?,
                                note = ?
                                WHERE id = ? ");

        $stmt->bind_param("sisi", $this->_emailAddress, $this->_type, $this->_note, $this->_id);
        $stmt->execute();
        $stmt->close();

        return $this->_id;
    }


    public function getAllEmailAddress()  // class EmailAddress
    {
        $emailAddresses = null;

        $stmt = $this->mysqli->prepare("
                    SELECT id, person_id, email_address, email_type, note
                    FROM email_address");

        $stmt->execute();
        $stmt->bind_result($id, $personId, $emailAddress, $emailType, $note);

        while($stmt->fetch()) {
            $emailAddresses[] = ['id'=>$id, 'personId'=>$personId, 'emailAddress'=>$emailAddress,
                                 'emailType'=>$emailType, 'note'=>$note];
        }

        $stmt->close();

        return $emailAddresses;
    }


    public function getEmailAddressById($id)  // class EmailAddress
    {
        $stmt = $this->mysqli->prepare("
					SELECT id, person_id, email_address, email_type, note
					FROM email_address
					WHERE id = ?");

        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->bind_result($id, $personId, $emailAddress, $emailType, $note);
        $stmt->fetch();
        $stmt->close();
        $emailAddress = ['id'=>$id, 'personId'=>$personId, 'emailAddress'=>$emailAddress, 'emailType'=>$emailType, 'note'=>$note];

        return $emailAddress;
    }


    public function getAllEmailAddressByPersonId($personId)
    {
        $emailAddresses = null;

        $stmt = $this->mysqli->prepare("
					SELECT id, email_address, email_type, note
					FROM email_address
					WHERE person_id = ?");

        $stmt->bind_param("i", $personId);
        $stmt->execute();
        $stmt->bind_result($id, $emailAddress, $emailType, $note);

        while($stmt->fetch())
        {
            $emailAddresses[] = ['id'=>$id, 'emailAddress'=>$emailAddress, 'emailType'=>$emailType, 'note'=>$note];
        }

        $stmt->close();

        return $emailAddresses;
    }


    public function deleteEmailAddress($id)  // class EmailAddress
    {
        $stmt = $this->mysqli->prepare("
                    DELETE FROM email_address
                    WHERE id = ? ");

        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->close();
    }

}



