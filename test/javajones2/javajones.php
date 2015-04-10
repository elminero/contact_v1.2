<?php
define("DB_SERVER", "localhost");
define("DB_USER", "ian");
define("DB_PASS", "super1964");
define("DB_NAME", "contacts");

$mysqli = new mysqli(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
if(mysqli_connect_errno()){
    die("Database connection failed. " . mysqli_connect_error() . ": " . mysqli_connect_errno());
}



phpinfo();









/*
$nameId = 1;
$query = "SELECT phone_id, name_id, phone_number, phone_type, note
                  FROM phone_numbers
                  WHERE name_id = {$nameId}";

$results = $mysqli->query($query);


$results->fetch_array($results);











$nameId = 1;
$phoneNumbers = array();
$stmt = $mysqli->prepare("
                      SELECT phone_id, name_id, phone_number, phone_type, note
                      FROM phone_numbers
                      WHERE name_id = ?");

$stmt->bind_param("i", $nameId);
$stmt->execute();
$stmt->bind_result($phoneId, $nameId, $phoneNumber, $phoneType, $note);
while($stmt->fetch())
{
    $phoneNumbers[] = array($phoneId, $nameId, $phoneNumber, $phoneType, $note);
}
echo var_dump($phoneNumbers) ;

*/






/*

$query = "SELECT phone_id, name_id, phone_number, phone_type, note
          FROM phone_numbers
          WHERE name_id = {$name_id}";

$results = $mysqli->query($query);

while($row[] = mysqli_fetch_assoc($results))
{
}

mysqli_free_result($results);
array_pop($row);

echo var_dump($row);



// $results = mysqli_query($mysqli, $query);


while($row[] = mysqli_fetch_assoc($results))
{
}

mysqli_free_result($results);
array_pop($row);

*/