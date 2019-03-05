<?php 
session_start();
include 'dbconnect.php';
include 'functions.php';
include 'header.php';

//FillIn SQL //////////////////////
$SQL = $connection->prepare('select * from `article`');
$SQL->execute();
$SQL->setFetchMode(PDO::FETCH_ASSOC);
print_r($SQL->rowCount());
$result = $SQL->fetchAll();

//var_dump($result);
if($_SESSION["loggedin"] == true) echo "<div class='row'><p><a href='new.php'> new.php </a> </p></div>";

for ($count = 0; $count < count($result); $count++) {
    echo "<div class='row'>";


    if (is_array($result[$count]) == true) {

        //Loop and Create HTML
        // print_r($result[$count]);
        echo  "<a href='view.php?id=".$result[$count]['id']."'> <p>" . $result[$count]['title'] . "</p></a>";
        echo "<p>"."<img src ='".$result[$count]['img']."'></p>";
        echo "<p>" . $result[$count]['description'] . "</p>";

        echo "</div>";
    }
}



