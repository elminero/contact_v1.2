<?php
//tDebug --  Db2 -- (User) -- Person -- Address -- PhoneNumber -- EmailAddress -- Image

require_once(dirname(dirname(__FILE__)).'/models/Db.php');


/*
        TABLE:   user
        COLUMNS: id, username, pass_hash, role, note, date_last_login, ip_last_login
        VARIABLES: $id, $username, $passHash, $role, $note, $dateLastLogin, $ipLastLogin


        id              integer
        username        string
        pass_hash       string
        roles           string
        note            string
        date_last_login TIMESTAMP
        ip_last_login   string

*/


class UserPDO extends Db3  {

    public function addUser($user)  // class Person
    {
        $stmt = $this->pdo->prepare("
				INSERT INTO user
				  (username, pass_hash, role, note, date_last_login, ip_last_login)
				VALUES
				  (?, ?, ?, ?, ?, ?)");

        $stmt->execute([$user['username'], $user['passHash'], $user['role'], $user['note'], $user['dateLastLogin'], $user['ipLastLogin']]);

        return $this->pdo->lastInsertId();
    }

    public function getUserByName($userName)
    {
        $stmt = $this->pdo->prepare("
                SELECT id, username, pass_hash, role, note, date_last_login, ip_last_login
                FROM user
                WHERE username = ?");

        $stmt->execute([$userName]);

        return $stmt->fetch(PDO::FETCH_OBJ);
    }


    public function getUserById($id)
    {
        $stmt = $this->pdo->prepare("
                SELECT id, username, pass_hash, role, note, date_last_login, ip_last_login
                FROM user
                WHERE pass_hash = ?");

        $stmt->execute([$id]);

        return $stmt->fetch(PDO::FETCH_OBJ);
    }

}

/*
$userModel = new UserPDO();

$password = "super9";


$options = [
    'cost' => 11,
    'salt' => mcrypt_create_iv(22, MCRYPT_DEV_URANDOM),
];
$passHash = password_hash($password, PASSWORD_BCRYPT, $options);



$date = new DateTime();
$dateLastLogin = $date->format('Y-m-d H:i:s');

echo $dateLastLogin;

$userField =
['username'=>'Robert', 'passHash'=>$passHash, 'role'=>'1', 'note'=>'The sly fox', 'dateLastLogin'=>$dateLastLogin,
    'ipLastLogin'=>$_SERVER['REMOTE_ADDR']];


 $userModel->addUser($userField);



$user =  $userModel->getUserByName('Robert');



echo var_dump($user);

*/