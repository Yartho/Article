<?php

session_start();

//var_dumb($_GET);

echo "Name for Session" . $_GET['nameforsession'];
$_SESSION['nameforsession'] = $_GET['nameforsession'];
$_SESSION['anotherparameter'] = "Something";