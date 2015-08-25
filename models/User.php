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

class User extends Db2  {

    public function addUser($user)  // class Person
    {
        $insertId = null;

        $stmt = $this->mysqli->prepare("
				INSERT INTO user
				  (username, pass_hash, role, note, date_last_login, ip_last_login)
				VALUES
				  (?, ?, ?, ?, ?, ?)");

        $stmt->bind_param("ssisss", $user['username'], $user['passHash'], $user['role'], $user['note'], $user['dateLastLogin'], $user['ipLastLogin']);
        $stmt->execute();
        $stmt->close();

        $insertId = $this->mysqli->insert_id;

        return $insertId;
    }

    public function getUserByName($userName)
    {
        $stmt = $this->mysqli->prepare("
                SELECT id, username, pass_hash, role, note, date_last_login, ip_last_login
                FROM user
                WHERE username = ?");

        $stmt->bind_param("s", $userName);
        $stmt->execute();
        $stmt->bind_result($id, $username, $passHash, $role, $note, $dateLastLogin, $ipLastLogin);
        $stmt->fetch();

        $user = ['id'=>$id, 'username'=>$username, 'passHash'=>$passHash, 'role'=>$role, 'note'=>$note,
                'dateLastLogin'=>$dateLastLogin, 'ipLastLogin'=>$ipLastLogin];

        $stmt->close();

        return $user;
    }


    public function getUserById($id)
    {
        $stmt = $this->mysqli->prepare("
                SELECT id, username, pass_hash, role, note, date_last_login, ip_last_login
                FROM user
                WHERE pass_hash = ?");

        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->bind_result($id, $username, $passHash, $role, $note, $dateLastLogin, $ipLastLogin);
        $stmt->fetch();

        $user = ['id'=>$id, 'username'=>$username, 'passHash'=>$passHash, 'role'=>$role, 'note'=>$note,
            'dateLastLogin'=>$dateLastLogin, 'ipLastLogin'=>$ipLastLogin];

        $stmt->close();

        return $user;
    }

}



class UserPDO extends Db3  {

    public function addUser($user)  // class Person
    {
        /*
        $insertId = null;

        $stmt = $this->mysqli->prepare("
				INSERT INTO user
				  (username, pass_hash, role, note, date_last_login, ip_last_login)
				VALUES
				  (?, ?, ?, ?, ?, ?)");

        $stmt->bind_param("ssisss", $user['username'], $user['passHash'], $user['role'], $user['note'], $user['dateLastLogin'], $user['ipLastLogin']);
        $stmt->execute();
        $stmt->close();

        $insertId = $this->mysqli->insert_id;

        return $insertId;

        */
    }

    public function getUserByName($userName)
    {
        /*
        $stmt = $this->mysqli->prepare("
                SELECT id, username, pass_hash, role, note, date_last_login, ip_last_login
                FROM user
                WHERE username = ?");

        $stmt->bind_param("s", $userName);
        $stmt->execute();
        $stmt->bind_result($id, $username, $passHash, $role, $note, $dateLastLogin, $ipLastLogin);
        $stmt->fetch();

        $user = ['id'=>$id, 'username'=>$username, 'passHash'=>$passHash, 'role'=>$role, 'note'=>$note,
            'dateLastLogin'=>$dateLastLogin, 'ipLastLogin'=>$ipLastLogin];

        $stmt->close();

        return $user;
        */
    }


    public function getUserById($id)
    {
        /*
        $stmt = $this->mysqli->prepare("
                SELECT id, username, pass_hash, role, note, date_last_login, ip_last_login
                FROM user
                WHERE pass_hash = ?");

        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->bind_result($id, $username, $passHash, $role, $note, $dateLastLogin, $ipLastLogin);
        $stmt->fetch();

        $user = ['id'=>$id, 'username'=>$username, 'passHash'=>$passHash, 'role'=>$role, 'note'=>$note,
            'dateLastLogin'=>$dateLastLogin, 'ipLastLogin'=>$ipLastLogin];

        $stmt->close();

        return $user;
        */
    }

}

/*
$userModel = new User();

$password = "super8";


$options = [
    'cost' => 11,
    'salt' => mcrypt_create_iv(22, MCRYPT_DEV_URANDOM),
];
$passHash = password_hash($password, PASSWORD_BCRYPT, $options);



$date = new DateTime();
$dateLastLogin = $date->format('Y-m-d H:i:s');

echo $dateLastLogin;

$userField =
['username'=>'elminero', 'passHash'=>$passHash, 'role'=>'1', 'note'=>'The sly fox', 'dateLastLogin'=>$dateLastLogin,
    'ipLastLogin'=>$_SERVER['REMOTE_ADDR']];


 $userModel->addUser($userField);



$user =  $userModel->getUserByName('elminero');

*/

// echo var_dump($user);

