<?php

include 'dbconnect.php';

//var_dump($_GET);


 /*foreach ($_GET as $key => $value) {
    echo "<br><br>$key $value";
}
*/
//echo "idtodosomething" . $_GET['idtodosomething'];

echo "title to search for" . $_GET['titletosearch'];




$SQL = $connection->prepare('SELECT * FROM article WHERE title LIKE :TITLE');
$SQL->bindParam(':TITLE',$_GET['titletosearch'], PDO::PARAM_STR);
$SQL->execute();
$SQL->setFetchMode(PDO::FETCH_ASSOC);
print_r($SQL->rowCount());
$result = $SQL->fetchAll();
var_dump($result);