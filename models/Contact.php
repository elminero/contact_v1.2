<?php
// Db2 -- Person -- Address -- PhoneNumber -- EmailAddress -- Image -- (Contact)

require_once(dirname(dirname(__FILE__)).'/models/Person.php');
require_once(dirname(dirname(__FILE__)).'/models/Address.php');
require_once(dirname(dirname(__FILE__)).'/models/PhoneNumber.php');
require_once(dirname(dirname(__FILE__)).'/models/EmailAddress.php');
require_once(dirname(dirname(__FILE__)).'/models/Image.php');

class Contact extends Person {

    public $nameDOB, $address, $phoneNumber, $emailAddress, $avatar, $image;


    public function getContactById()
    {

        $person = new PersonPDO();
        $this->nameDOB = $person->getPersonById($this->personId);

        // $person = new Person();
        // $this->nameDOB = $person->getPersonById($this->personId);


        $address = new Address();
        $this->address = $address->getAllAddressByPersonId($this->personId);


        $phoneNumber = new PhoneNumberPDO();
        $this->phoneNumber = $phoneNumber->getAllPhoneNumberByPersonId($this->personId);


        $emailAddress = new EmailAddress();
        $this->emailAddress = $emailAddress->getAllEmailAddressByPersonId($this->personId);

        // $this->emailAddress = self::getAllEmailAddressByPersonId($this->personId);

//       $image = new Image();
  //      $this->avatar = $image->getAvatarImageByPersonId($this->personId);

        $image = new ImagePDO();
        $this->avatar = $image->getAvatarImageByPersonId($this->personId);

        // $this->avatar = self::getAvatarImageByPersonId($this->personId);

     $this->image = $image->getAllImageByPersonId($this->personId);

    }

}
/*

$contact= new Contact();

$contact->getContactById();


//echo var_dump($contactPDO->image);

while($row = $contact->image->fetch(PDO::FETCH_OBJ)) {
    echo $row->path_file;
}

echo "<br />";

// echo var_dump($contactPDO->image);


*/