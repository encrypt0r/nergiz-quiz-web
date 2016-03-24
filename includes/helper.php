<?php
    /*
    * Inserts a new person into the leaderboard and returns its rank and id
    */
    function InsertNewPersonIntoDatabase($name, $time, $accuracy)
    {
        // insert person into database
        $conn = EstablishConnection();
        $sql = "INSERT INTO people (name, time, accuracy) VALUES ('" . $name . "'," . $time . ", " . $accuracy . ")";
        
        // get his rank and id
        $rank = -1;
        $id = -1;
        if ($conn->query($sql) == TRUE)
        {
            $leaderboard = GetLeaderBoard(-1);
            $order = 1;
            while ($row = $leaderboard->fetch_assoc())
            {
                if ($row["name"] === $name && $row["accuracy"] === $accuracy && $row["time"] === $time)
                {
                    $rank = $order;
                    $id = $row["id"];
                    break;
                }
                
                $order++;
            }
            
            return $rank . ";" . $id;
        }
        else 
            return "ERROR: " . $sql . "<br>" . $conn->error;;
            
       $conn->close();
    }
    
    function RemovePersonFromDatabase($id)
    {
        $conn = EstablishConnection();
        $sql = "DELETE FROM people WHERE id = " . $id;
        
        if ($conn->query($sql) == TRUE)
            return "SUCCESS";
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
            $sql = "SELECT * FROM people ORDER BY accuracy DESC, time";
        else       
            $sql = "SELECT * FROM people ORDER BY accuracy DESC, time LIMIT 0, " . $num;
        $result = $conn->query($sql);
        
        $conn->close();
        return $result;
    }
    
    /*
    * Renders the leaderboard as an html table.
    */
    function RenderLeaderboard($num, $writeID = FALSE)
    {
        $leaderboard = GetLeaderBoard($num);
        if ($leaderboard->num_rows > 0)
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
            $order = 0;
            while($row = $leaderboard->fetch_assoc())
            {
                $timeProcessed = GetTimeInHumanLanguage($row["time"]);
                if ($writeID)
                    $cells = array(($order + 1), $row["id"] , $row["name"], ($row["accuracy"] * 100 . "%"), $timeProcessed);
                else
                    $cells = array(($order + 1), $row["name"], ($row["accuracy"] * 100 . "%"), $timeProcessed);
                InsertRow($cells);

                $order += 1;
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