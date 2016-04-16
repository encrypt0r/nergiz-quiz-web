<?php
require("includes/helper.php");
$operation = $_POST["operation"];
$id = $_POST["id"];
$name = $_POST["name"];
$password = $_POST["password"];
$time = $_POST["time"];
$accuracy = $_POST["accuracy"];
$gender = $_POST["gender"];
$age = $_POST["age"];

if ($operation == "insert")
    echo InsertNewPersonIntoDatabase($name, $time, $accuracy, $age, $gender);
else if ($operation == "remove")
    echo RemovePersonFromDatabase($id);
else
    echo "Error: Unknown operation.";
    
?>
