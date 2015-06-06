<?php
//tDebug --  (Db2) -- User -- Person -- Address -- PhoneNumber -- EmailAddress -- Image

// require_once(dirname(dirname(__FILE__)).'/models/tDebug.php');


// require("tDebug.php");
abstract class Db2
{

// use tDebug;

    protected $mysqli;
    protected $personId;

    function __construct($personId = null)
    {
        $this->personId = $personId;

        if (!defined('DB_SERVER')) {
            define("DB_SERVER", "localhost");
        }

        if (!defined('DB_USER')) {
            define("DB_USER", "ian");
        }

        if (!defined('DB_PASS')) {
            define("DB_PASS", "super1964");
        }

        if (!defined('DB_NAME')) {
            define("DB_NAME", "contact");
        }

        $this->mysqli = new mysqli(DB_SERVER, DB_USER, DB_PASS, DB_NAME);

        if (mysqli_connect_errno()) {
            die("Database connection failed. " . mysqli_connect_error() . ": " . mysqli_connect_errno());
        }

    }

}





