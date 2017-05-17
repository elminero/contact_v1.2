<?php
require_once(dirname(dirname(__FILE__)).'/models/User.php');

//tDebug --  Db2 -- User -- Person -- Address -- PhoneNumber -- EmailAddress -- Image

class LoginController {

    public $login;

    public function verifyLogin ()
    {

        if( isset($_COOKIE["phpContact"])  &&  isset($_COOKIE["phpContactId"]) )  {

                $id = $_COOKIE["phpContact"];

                $cUser = new UserPDO();

                $user = $cUser->readById($id);

            if ( $_COOKIE["phpContact"] ===  $user->pass_hash  ) {

                $this->login = 1;
            } else {
                $this->login = 0;
            }
        } else {
            $this->login = 0;
        }

    }

}


$login = new LoginController();
$login->verifyLogin();

if ($login->login == 0) {

    header("Location: ../login.php");
}



if( array_key_exists("login", $_POST) ) {

    $password = htmlspecialchars(trim($_POST['password']));

    $userName = htmlspecialchars(trim($_POST['userName'])) ;


    $options = [
        'cost' => 12,
    ];


    $cUser = new UserPDO();

    $user = $cUser->readByName($userName);


 //   echo var_dump($user);

    if (password_verify($password, $user->pass_hash)) {

        $options = [
            'cost' => 12,
        ];
        $passHash = password_hash($password, PASSWORD_BCRYPT, $options);


        if(setrawcookie("phpContact", $passHash, 0, "/")) { // time() + (86400 * 30)

            setrawcookie("phpContactId", $user->id, 0, "/");

            setrawcookie("phpContact", $user->pass_hash, 0, "/");

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




