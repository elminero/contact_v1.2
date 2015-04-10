<?php

class PhoneNumber2
{
    private $_phoneNumber, $_note;


    function __construct()
    {

    }




    public function addPhoneNumber(PNController $phone)
    {

        $this->_phoneNumber = $phone->getPhoneNumber();

        $this->_note = $phone->getNote();


        echo $this->_phoneNumber;

        echo "<br />";

        echo $this->_note;

    }






}






class PNController
{


    private $_phoneNumber, $_note;




    function __construct($phoneNumber, $note)
    {
        $this->_phoneNumber = $phoneNumber;
        $this->_note = $note;

    }


    public function getPhoneNumber()
    {
        return $this->_phoneNumber;
    }


    public function getNote()
    {
        return $this->_note;
    }

}








if( array_key_exists("addPhone", $_POST)  ) {

    $cPhone = new PNController($_POST['phoneNumber'], $_POST['note']);



    $phoneModel = new PhoneNumber2();





   $phoneModel->addPhoneNumber($cPhone);

}


?>




<form action="test.php" method="post" >

    Phone Number: <input type="text" name="phoneNumber" /><br />

    Note: <input type="text" name="note" /><br />

    <input type="submit" name="addPhone" value="Add Phone Number">

</form>