
<?php
session_start();
include 'dbconnect.php';
include 'functions.php';
include 'header.php';

var_dump($_GET);
//var_dump($_SESSION);


$result = GetFromDBWithId($_GET['id'],$connection);

echo "<div class='row'>";

for ($count = 0; $count < count($result); $count++) {
    if(is_array($result[$count]) == true ) {
        foreach ($result[$count] as $key => $value) {
            echo "<div class='col'>";
            if($key == 'img') echo "<img src='$value'>";
            else echo "<p> $value </p>";
            echo "</div>";
        }
    }
    if(isset($_SESSION['loggedin'])){ if($_SESSION['loggedin'] == true) echo "<p><a href='edit.php?id=".$result[$count]['id']."'</a> edit.php </p>";}


}

echo "</div class='row'>";

include 'footer.php';