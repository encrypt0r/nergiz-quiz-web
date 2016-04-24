<?php
   /*
    * Inserts a new person into the leaderboard and returns its rank
    * and the number of participants and the leaderboard at current
    * time.
    */
    function InsertNewPersonIntoDatabase($name, $time, $accuracy, $age, $gender)
    {
        // insert person into database
        $conn = EstablishConnection();
        $sql = "INSERT INTO people
                (name, time, accuracy, age, isMale) VALUES
                ('" . $name . "'," . $time . ", " . $accuracy . ", " . $age . ", " . $gender . ")";

        if ($conn->query($sql) == TRUE)
        {
            $leaderboard = GetLeaderBoard(-1);

            $number = 1;
            $rank = -1;
            while ($row = $leaderboard->fetch_assoc())
            {
                $condition = ($row["name"] == $name && round($row["accuracy"], 1) == round($accuracy, 1) && $row["time"] == $time);
                if ($condition)
                    $rank = $number;
                    
                $number++;
            }
            return $rank . "#" . ($number - 1) . "#" . GetLeaderboardForAPI();
        }
        else
            return "ERROR: " . $sql . "<br>" . $conn->error;;

       $conn->close();
    }

   /*
    * Returns the leaderboard in a way that the client app understands
    */
    function GetLeaderboardForAPI()
    {
        $leaderboard = GetLeaderBoard(10);
        $data = "";
        $number = 1;
        while($row = $leaderboard->fetch_assoc())
        {
            // the order of the values is very important for the client application.
            // the client app expects this order: rank, name, accuracy, time
            // any change in the order causes big problems
            $data .= $number;
            $data .= "," . $row["name"];
            $data .= "," . $row["accuracy"];
            $data .= "," . $row["time"];
            $data .= "|";
            $number++;
        }

        return $data;
    }
   /*
    * Removes a person with the specified id from the database
    */
    function RemovePersonFromDatabase($id)
    {
        $conn = EstablishConnection();
        $sql = "DELETE FROM people WHERE id = " . $id;

        if ($conn->query($sql) == TRUE)
            return "person with ID:" . $id . " removed from database.";
        else
            return "ERROR: " . $sql . "<br>" . $conn->error;;
    }

   /*
    * Renders a part of a page, e.g: header and footer
    */
    function RenderPart($part, $data = array())
    {
        require_once("config.php");
        extract($data);
        require($part . ".php");
    }

   /*
    * Queries the database for top $num participants and returns an array of them.
    * To get all of the participants, enter -1 form $num
    */
    function GetLeaderBoard($num)
    {
        $conn = EstablishConnection();
        if ($num == -1)
            $sql = "SELECT * FROM people ORDER BY accuracy DESC, time, register_date";
        else
            $sql = "SELECT * FROM people ORDER BY accuracy DESC, time, register_date LIMIT 0, " . $num;
        $result = $conn->query($sql);

        $conn->close();
        return $result;
    }

   /*
    * Queries the database for top $num participants and returns an array of them.
    * To get all of the participants, enter -1 form $num
    */
    function GetLatestParticipants($num)
    {
        $conn = EstablishConnection();
        if ($num == -1)
            $sql = "SELECT * FROM people ORDER BY register_date DESC";
        else
            $sql = "SELECT * FROM people ORDER BY register_date DESC LIMIT 0, " . $num;
        $result = $conn->query($sql);

        $conn->close();
        return $result;
    }
    
   /*
    * Lists the top participants in an HTML table
    */
    function RenderLeaderboard($num, $writeID = FALSE)
    {
        $leaderboard = GetLeaderBoard($num);
        RenderHTMLTable($leaderboard);
    }
    
   /*
    * Lists the latest participants in an HTML table
    */
    function RenderLatest($num, $writeID = FALSE)
    {
        $leaderboard = GetLatestParticipants($num);
        RenderHTMLTable($leaderboard, $writeID);
    }
    
   /*
    * Creates an HTML table out of an array object
    */
    function RenderHTMLTable($theArray, $writeID = FALSE)
    {
        if ($theArray->num_rows > 0)
        {
            echo "<table class='table table-striped table-bordered'>";
            echo "<thead>";
            echo "<tr>";
            echo "<th>#</th>";
            if ($writeID)
                echo "<th>ID</th>";
            echo "<th>Name</th><th>Accuracy</th><th>Time</th>";
            echo "</tr>";
            echo "</thead>";
            echo "<tbody>";
            // output data for each row
            $number = 0;
            while($row = $theArray->fetch_assoc())
            {
                $timeProcessed = GetTimeInHumanLanguage($row["time"]);
                if ($writeID)
                    $cells = array(($number + 1), $row["id"] , $row["name"], round(($row["accuracy"] * 100), 1) . "%", $timeProcessed);
                else
                    $cells = array(($number + 1), $row["name"], round(($row["accuracy"] * 100), 1) . "%", $timeProcessed);
                InsertRow($cells);

                $number += 1;
            }
            echo "</tbody>";
            echo "</table>";
        }
    }
    
   /*
    * Establishes a connection with the database and returns the connection as an object.
    */
    function EstablishConnection()
    {
        require("config.php");
        // create connection
        $conn = new mysqli($serverName, $userName, $password, $dbName);

        // check connection
        if ($conn->connect_error)
        {
            die("Connection failed: " . $conn->connect_error);
        }

        return $conn;
    }

   /*
    * Inserts a row into a table, used by RenderLeaderboard()
    */
    function InsertRow($cells = array())
    {

        echo "<tr>";
        foreach ($cells as $cell) {
            echo "<td>" . $cell . "</td>";
        }
        echo "</tr>";
    }

   /*
    * Changes time from integer (number of seconds) to a more human-friendly format
    */
    function GetTimeInHumanLanguage($seconds)
    {
        $minutes = floor(($seconds / 60));
        $remSeconds = $seconds - ($minutes * 60);

        $time = "";
        if ($minutes > 0)
        {
            $time .= $minutes . " Minute" . MakeItPlural($minutes) . " and ";
            $time .= $remSeconds . " Second" . MakeItPlural($remSeconds);
        }
        else
        {
            $time .= $remSeconds . " Second" . MakeItPlural($remSeconds);
        }

        return $time;
    }

   /*
    * Decides wether a noun thats after a number (e.g: 10 persons) needs to plural or singular
    */
    function MakeItPlural($num)
    {
        if ($num == 1)
            return "";
        else
            return "s";
    }
?>
