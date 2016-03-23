<?php 
require("includes/helper.php");
$name = $_POST["name"];
$password = $_POST["password"];
$time = $_POST["time"];
$accuracy = $_POST["accuracy"];

var_dump($_POST);
    echo InsertNewPersonIntoDatabase($name, $time, $accuracy);
?>