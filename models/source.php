<?php
require_once(dirname(dirname(__FILE__)).'/models/Db.php');

class SearchPDO extends \contact\Db3
{

public function create($data){}
public function readAll(){}
public function readById($id){}
public function readByPersonId($id){}
public function updateById($data){}
public function deleteById($id){}


    public function getSearchResults($term)
    {
        $sql = "
                SELECT id, last_name, first_name, middle_name, alias_name
                FROM person
                WHERE   last_name   LIKE '%" . $term . "%'
                OR      first_name  LIKE '%" . $term . "%'
                OR      middle_name LIKE '%" . $term . "%'
                OR      alias_name  LIKE '%" . $term . "%'
               ";

        $stmt =  $this->pdo->prepare($sql);
        $stmt->execute();

        return $stmt;
    }
}

$term = trim(strip_tags($_GET['term']));//retrieve the search term that autocomplete sends

$search = new SearchPDO();

$qResults = $search->getSearchResults($term);


while($row = $qResults->fetch(PDO::FETCH_OBJ)) {
    $fullName = $row->last_name;

    if($row->last_name && $row->first_name) {
        $fullName .= ", ";
    }


    $fullName .= $row->first_name;

    if($row->first_name && $row->middle_name) {
        $fullName .= ", ";
    }

    $fullName .= $row->middle_name;

    if($row->alias_name) {
        $fullName .= " alias: ";
    }

    $fullName .= $row->alias_name;

    $searchResult['value']= htmlentities(stripslashes($fullName));
    $searchResult['label'] = htmlentities(stripslashes($fullName));
    $searchResult['id']= (int)$row->id;
    $searchResultSet[] = $searchResult;
}

echo json_encode($searchResultSet);//format the array into json data


/*
$qstring = "SELECT description as value,id FROM test WHERE description LIKE '%".$term."%'";
$result = mysql_query($qstring);//query the database for entries containing the term

while ($row = mysql_fetch_array($result,MYSQL_ASSOC))//loop through the retrieved values
{
    $row['value']=htmlentities(stripslashes($row['value']));
    $row['id']=(int)$row['id'];
    $row_set[] = $row;//build an array
}

$row['value']= "ActionScript";
$row['label'] = "ActionScript";
$row['id']= 1;
$row_set[] = $row;

$row['value']= "AppleScript";
$row['label'] = "AppleScript";
$row['id']= 2;
$row_set[] = $row;

$array = ["value"=>"ActionScript", "label"=>"ActionScript", "id"=>"1"];

*/




