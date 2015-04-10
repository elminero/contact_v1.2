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

        $person = new Person();
        $this->nameDOB = $person->getPersonById($this->personId);


        $address = new Address();
        $this->address = $address->getAllAddressByPersonId($this->personId);


        $phoneNumber = new PhoneNumber();
        $this->phoneNumber = $phoneNumber->getAllPhoneNumberByPersonId($this->personId);


        $emailAddress = new EmailAddress();
        $this->emailAddress = $emailAddress->getAllEmailAddressByPersonId($this->personId);

        // $this->emailAddress = self::getAllEmailAddressByPersonId($this->personId);

        $image = new Image();
        $this->avatar = $image->getAvatarImageByPersonId($this->personId);


        // $this->avatar = self::getAvatarImageByPersonId($this->personId);

        $this->image = $image->getAllImageByPersonId($this->personId);

    }

}



/*

$contact = new Contact(40);
$addressField = ['addressType'=>3, 'countryIso'=>'US', 'state'=>'Arizona', 'street'=>'21 Calle Caliente',
    'city'=>'Tucson', 'postalCode'=>'28474', 'note'=>'Fucking Hot Here'];
*/


//$contact->addAddress($addressField);





// $address->add($addressField);






// $contact->dumpObject();


// $contact->getContactById();

// echo $contact->nameDOB['last'] . " " . $contact->nameDOB['first'] . " " . $contact->nameDOB['middle'];
//echo "<br/>";
//echo $contact->nameDOB['birthMonth'] . "/" . $contact->nameDOB['birthDay'] . "/" . $contact->nameDOB['birthYear'];
//echo "<br/>";
// echo var_dump($contact->address);

