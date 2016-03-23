<?php 
    require("includes/helper.php");
    $name = $_POST["name"];
    $password = $_POST["password"];
    $time = $_POST["time"];
    $accuracy = $_POST["accuarcy"];

    function Insert()
    {
        if ($password == "pass" && $time != NULL && $name != NULL && $accuracy != NULL)
            echo InsertNewPersonIntoDatabase($name, $time, $accuracy);
        else 
            echo "ERROR: One or more of the parameters are invalid";
    }

?>