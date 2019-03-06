<?php
include 'dbconnect.php';

//If form not submitted, display form.
if (!isset($_POST['submit'])){


    ?>

    <form method="post" action="search.php">
        titletosearch:  <br />
        <input type="text" name="titletosearch" />

        <p />
        <input type="submit" name="submit" value="Go" />
    </form>

    <?php
//If form submitted, process input.
}else{

//Retrieve string from form submission.
    $city = $_POST['titletosearch'];
    echo "titletosearch $city.";
    if (empty($_POST['titletosearch'])) echo "titletosearch empty";
    // if ($_POST['titletosearch'] == "" ) echo "titletosearch empty";
    else {
        var_dump($_POST['titletosearch']);

        echo "searching for" . $_POST['titletosearch'];

        $SearchString = "%".$_POST['titletosearch']."%";

        $SQL = $connection->prepare('SELECT id,title,description, img FROM article WHERE title LIKE :TITLE');
        $SQL->bindParam(':TITLE',$SearchString, PDO::PARAM_STR);
        $SQL->execute();
        $SQL->setFetchMode(PDO::FETCH_ASSOC);
        print_r($SQL->rowCount());
        $result = $SQL->fetchAll();
        var_dump($result);

        for($ArrayIndex = 0 ; $ArrayIndex < count($result);$ArrayIndex++ ) {
            echo "<br>ArrayIndex ".$ArrayIndex;

            echo "<br><a href='view.php?'> ".$result[$ArrayIndex]['title']."</a>";
            echo "<br>".$result[$ArrayIndex]['description'];

        }
    }
}
?>

</body>
</html>