<?php


abstract class db3
{
   protected $pdo;


    function __construct() {
        $this->pdo = new PDO("mysql:host=localhost;dbname=contact;charset=utf8", "ian", "super1964");
    }


}


class PersonPDO extends db3
{

    public function getPersonById($id) {

        $stmt =  $this->pdo->prepare("
            SELECT id, last_name, first_name, middle_name, alias_name, birth_month, birth_day, birth_year, note
            FROM person
            WHERE id = ?");

        $stmt->execute(array($id));

        return $stmt->fetch(PDO::FETCH_OBJ);
    }

}


$personObj = new PersonPDO();

$person = $personObj->getPersonById(1);


echo $person->last_name;













