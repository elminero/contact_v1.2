<?php
require("Db.php");

class NameDOB extends Db
{
    private $_nameId, $_lastName, $_firstName, $_middleName, $_aliasName, $_birthMonth, $_birthDay, $_birth_year, $_note;
    private $_objNameDOB, $_arrayOfObjNameDOB, $_state, $_countryIso;
    public $nameId, $last, $first, $middle, $alias, $birthMonth, $birthDay, $birthYear, $note, $state, $countryISO, $nameColor = 0;

    public function getAllNames()
    {

        $stmt = $this->mysqli->prepare("
                    SELECT persons.name_id, persons.last_name, persons.first_name, persons.middle_name, persons.alias_name,
                    addresses.state, addresses.country_iso
					FROM persons LEFT OUTER JOIN addresses
					ON persons.name_id = addresses.name_id
					ORDER BY persons.last_name");
        $stmt->execute();
        $stmt->bind_result($this->_nameId, $this->_lastName, $this->_firstName, $this->_middleName, $this->_aliasName, $this->_state, $this->_countryIso);

        while($stmt->fetch()) {

            $this->_objNameDOB = new NameDOB();
            $this->_objNameDOB->nameId = $this->_nameId;
            $this->_objNameDOB->last = $this->_lastName;
            $this->_objNameDOB->first = $this->_firstName;
            $this->_objNameDOB->middle = $this->_middleName;
            $this->_objNameDOB->alias = $this->_aliasName;
            $this->_objNameDOB->birthMonth = $this->_birthMonth;
            $this->_objNameDOB->birthDay = $this->_birthDay;
            $this->_objNameDOB->birthYear = $this->_birth_year;
            $this->_objNameDOB->note = $this->_note;
            $this->_objNameDOB->state = $this->_state;
            $this->_objNameDOB->countryISO = $this->_countryIso;

            $this->_arrayOfObjNameDOB[] = $this->_objNameDOB;
        }

        $stmt->close();

        return $this->_arrayOfObjNameDOB;
    }


    public function getNameById($nameId)  // class Person
    {
        $stmt = $this->mysqli->prepare("
					SELECT name_id, last_name, first_name, middle_name, alias_name, birth_month, birth_day, birth_year, note
					FROM persons
					WHERE name_id = ?");

        $stmt->bind_param("i", $nameId);
        $stmt->execute();
        $stmt->bind_result($this->nameId,
                            $this->last,
                            $this->first,
                            $this->middle,
                            $this->alias,
                            $this->birthMonth,
                            $this->birthDay,
                            $this->birthYear,
                            $this->note);
        $stmt->fetch();
        $stmt->close();
    }


}

/*   For Testing
$nameDOB = new NameDOB();

$names = $nameDOB->getAllNames();


foreach($names as $name) {
    echo $name->first . " " . $name->middle . " " . $name->last . ", " .$name->state . ", " . $name->countryISO ;
    echo "<br />";
}
*/