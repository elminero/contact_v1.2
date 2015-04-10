<?php
require_once(dirname(dirname(__FILE__)).'/models/User.php');

//tDebug --  Db2 -- User -- Person -- Address -- PhoneNumber -- EmailAddress -- Image

class LoginController {

    public $login;

    public function verifyLogin ()
    {

        if( isset($_COOKIE["phpContact"])  &&  isset($_COOKIE["phpContactId"]) )  {

                $id = $_COOKIE["phpContact"];

                $cUser = new User();

                $user = $cUser->getUserByid($id);

            if ( $_COOKIE["phpContact"] ===  $user['passHash']  ) {

                $this->login = 1;
            } else {
                $this->login = 0;
            }
        } else {
            $this->login = 0;
        }

    }

}


if( array_key_exists("login", $_POST) ) {

 //   array(3) { ["userName"]=> string(8) "elminero" ["password"]=> string(6) "super8" ["login"]=> string(5) "login" }

    $password = htmlspecialchars(trim($_POST['password']));

    $userName = htmlspecialchars(trim($_POST['userName'])) ;


    $options = [
        'cost' => 11,
        'salt' => mcrypt_create_iv(22, MCRYPT_DEV_URANDOM),
    ];


    $cUser = new User();

    $user = $cUser->getUserByName($userName);


 //   echo var_dump($user);

    if (password_verify($password, $user['passHash'])) {

        $options = [
            'cost' => 11,
            'salt' => mcrypt_create_iv(22, MCRYPT_DEV_URANDOM),
        ];
        $passHash = password_hash($password, PASSWORD_BCRYPT, $options);


        if(setrawcookie("phpContact", $passHash, 0, "/")) { // time() + (86400 * 30)

            setrawcookie("phpContactId", $user['id'], 0, "/");

            setrawcookie("phpContact", $user['passHash'], 0, "/");

            //         echo var_dump($_COOKIE);

            header("Location: ../listcontacts.php");
        }


    } else {
        echo 'Invalid password.';
    }

}


if( (isset($_GET['action'])  && ($_GET['action'] === 'logout')  ) ) {

    setrawcookie("phpContact", "", time() - 3600, "/");

    setrawcookie("phpContactId", "", time() - 3600, "/");

    header("Location: ../index.php");
}




