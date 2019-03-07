<?php
include 'dbconnect.php';
include 'functions.php';
//var_dump($_SERVER);

//CheckIf It is a POST //////////////////////////////////////////////////
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    //var_dump($_POST);
    echo "we Have a Post";

    if(!empty($_POST['brand']) AND !empty($_POST['model'])) {
        echo "<br>we can process<br>";
        //var_dump($_POST['title']);

        //Check if Car Brand Exists ////////////////////////////////
        $SQLForCheckIfExists = $connection->prepare(' SELECT * FROM cars WHERE brand = :BRAND');
        $SQLForCheckIfExists->bindParam(':BRAND', $_POST['brand'], PDO::PARAM_STR);
        //$SQLForCheckIfExists->bindParam(':MODEL', $_POST['model'], PDO::PARAM_STR);
        $SqlOutputForCheckIfExists = $SQLForCheckIfExists->execute();
        $ExistsCheck = $SQLForCheckIfExists->rowCount();
        echo "ExistsCheck is :".$ExistsCheck;
        if($ExistsCheck == 0 ) {
            // IS NOT Duplicate ////////////////////////////
            echo "<br>is not duplicate ";

            //SQL //////////////////////////////////////////////////
            $SQL = $connection->prepare('INSERT INTO cars (brand, model) VALUES (:BRAND, :MODEL)');
            $SQL->bindParam(':BRAND', $_POST['brand'], PDO::PARAM_STR);
            $SQL->bindParam(':MODEL', $_POST['model'], PDO::PARAM_STR);

            $SqlOutput = $SQL->execute();
            var_dump($SqlOutput);

            //CheckIf SQL OK //////////////////////////////////////////////////

            if($SqlOutput == true ) {
                $NewId = $connection->lastInsertId();
                echo "MyNew ID is: ".$NewId;
                echo "You can View it here:<a href='viewCars.php?GetMeThisCarId=".$NewId."'/> VIEW </a>";
                //header("Location: view.php?id=".$NewId.""); /* Redirect browser */

            }
            else {
                echo "Error in Insert";
                print_r($SQL->errorInfo());
                $SQL->debugDumpParams();
                var_dump($_POST);
            }
            //EndIf Check SQL OK //////////////////////////////////////////////////
        }

        else {
            // IS Duplicate ////////////////////////////
            echo "<br>is duplicate ";



        }
        // var_dump($SqlOutputForCheckIfExists);



    }
    /// EndIf POst //////////////////////////////
    else {
        echo "<br>we can not process<br>";
    }

}
//EndOf CheckIf It is a POST //////////////////////////////////////////////////
else {
    include 'header.php';
    echo "we dont have a POST";
    ?>
    <form method="POST" action="<?php echo $_SERVER["PHP_SELF"]; ?>" enctype="multipart/form-data">
        <div class="form-group">
            <label for="title">Tip a brand </label>
            <input class="form-control" type="text" name="brand" value=""></input>
        </div>

        <div class="form-group">
            <label for="description">model</label>
            <input class="form-control" name="model"></input>
        </div>
        <div class="form-group cc">
            <button class="btn btn-default" type="submit">Submit</button>
        </div>
    </form>
    <?php
}




