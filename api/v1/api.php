<?php

/*
* Checks wether the action parameter is supported or not
*/
function IsValidAction()
{
  $method = $_SERVER['REQUEST_METHOD'];;
  $possible_url = array("insert_person", "remove_person", "get_leaderboard");
  if ($method == "POST")
  {
    if (isset($_POST["action"]) && in_array($_POST["action"], $possible_url))
      return true;
  }
  else if ($method = "GET")
  {
    if (isset($_GET["action"]) && in_array($_GET["action"], $possible_url))
      return true;
  }

  return false;
}

/*
* This function directs the POST requests to their corresponding functions
*/
function ProcessPost()
{
  require("../../includes/helper.php");
  $value = "An error has occurred";

  if (IsValidAction())
  {
    if ($_POST["action"] == "insert_person")
    {
      if (isset($_POST["name"]) && isset($_POST["time"]) &&
          isset($_POST["accuracy"]) && isset($_POST["age"]) &&
          isset($_POST["gender"]))
          {
            $value = InsertNewPersonIntoDatabase($_POST["name"], $_POST["time"], $_POST["accuracy"],
                                                  $_POST["age"], $_POST["gender"]);
          }
      else
        $value = "Missing argument";
    }
    else if ($_POST["action"] == "remove_person")
    {
      if (isset($_POST["id"]))
        $value = RemovePersonFromDatabase($_POST["id"]);
    }
  }
  else
    $value = "Invalid action";

  return $value;
}

/*
* This function directs the GET requests to their corresponding functions
*/
function ProcessGet()
{
  require("../../includes/helper.php");
  $value = "An error has occurred";

  if (IsValidAction())
  {
    if ($_GET["action"] == "get_leaderboard")
    {
      $value = GetLeaderboardForAPI();
    }
  }

  return $value;
}

$method = $_SERVER['REQUEST_METHOD'];
if ($method == "POST")
  $value = ProcessPost();
else if ($method == "GET")
  $value = ProcessGet();
else
  $value = "Unsupported Method";

// return what we've got
exit($value);
?>
