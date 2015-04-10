<?php
/**
 * Created by PhpStorm.
 * User: Ian
 * Date: 12/26/2014
 * Time: 2:57 PM
 */
class Db
{
    protected $mysqli;

    function __construct()
    {

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
            define("DB_NAME", "contacts");
        }


        $DdParameters = ['server' => DB_SERVER, 'user' => DB_USER, 'password' => DB_PASS, 'name' => DB_NAME];

        $this->mysqli = new mysqli($DdParameters['server'], $DdParameters['user'], $DdParameters['password'], $DdParameters['name']);

        if (mysqli_connect_errno()) {
            die("Database connection failed. " . mysqli_connect_error() . ": " . mysqli_connect_errno());
        }

    }

}

