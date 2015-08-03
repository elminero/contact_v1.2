<?php
// require("models/Address.php");
require("controllers/PersonController.php");


$nameObj = new PersonController();

$name = $nameObj->getById(2);



echo $name['last'];
