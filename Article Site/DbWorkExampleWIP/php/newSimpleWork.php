<?php

include 'dbconnect.php';
include 'functions.php';
/*
$MyVar = "asdas  ";
if(empty($MyVar)) {
    echo "<br>MyVar is empty <br>";
}
else {
    echo "<br>MyVar is not empty: $MyVar <br>";
}
*/

	if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        //var_dump($_POST);
        if(!empty($_POST['title']) AND !empty($_POST['description'])) {
            echo "<br>we can process<br>";
            //var_dump($_POST['title']);

            //SQL //////////////////////////////////////////////////

            $SQL = $connection->prepare('INSERT INTO article (title, description) VALUES (:TITLE, :DESCRIPTION)');
            $SQL->bindParam(':TITLE', $_POST['title'], PDO::PARAM_STR);
            $SQL->bindParam(':DESCRIPTION', $_POST['description'], PDO::PARAM_STR);


            $SqlOutput = $SQL->execute();
            var_dump($SqlOutput);

            //CheckIf SQL OK //////////////////////////////////////////////////

            if($SqlOutput == true ) {
                $NewId = $connection->lastInsertId();
                echo "MyNew ID is: ".$NewId;
                echo "You can View it here:<a href='view.php?id=".$NewId."'/> VIEW </a>";
                header("Location: view.php?id=".$NewId.""); /* Redirect browser */

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
            echo "<br>we can not process<br>";


        }

	}

include 'header.php';
?>
		<form method="POST" action="<?php echo $_SERVER["PHP_SELF"]; ?>" enctype="multipart/form-data">
			<div class="form-group">
			    <label for="title">Tip a title for your project</label>
			    <input class="form-control" type="text" name="title" value=""></input>
			</div>

			<div class="form-group">
			    <label for="description">Define a description for your project</label>
			    <textarea class="form-control" name="description"></textarea>
			</div>
			<div class="form-group cc">
		    	<button class="btn btn-default" type="submit">Submit</button>
			</div>
	</form>

