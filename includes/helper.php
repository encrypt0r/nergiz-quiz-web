<?php 
    
    function RenderPart($part, $data = array())
    {
        require_once("config.php");
        extract($data);
        require($part . ".php");
    }
    
    function GetTopTen()
    {
        $people = GetLeaderBoard();
        if ($result->num_rows > 0)
        {
        echo "<table class='table'>";
        echo "<tr>";
        echo "<td>num</td><td>ID</td><td>Name</td><td>Age</td>";
        echo "</tr>";
        // output data for each row
        $limit = 0;
        while($row = $people>fetch_assoc())
        {
            echo "<tr>";
            echo "<td>" . ($limit + 1) . "</td>";
            echo "<td>" . $row["id"] . "</td>";
            echo "<td>" . $row["firstName"] . " " . $row["lastName"] . "</td>";
            echo insertCell($row["age"]);
            echo "</tr>";
            
            $limit += 1;
        }
        echo "</table>";
        }
    }
    
    function GetLeaderBoard()
    {
        $conn = EstablishConnection();
        $sql = "SELECT * FROM people ORDER BY accuracy DESC, time LIMIT 0, 10 ";
        $result = $conn->query($sql);
        
        if ($result->num_rows > 0)
        {
            echo "<table class='table table-striped table-bordered'>";
            echo "<thead>";
            echo "<tr>";
            echo "<th>#</td><th>Name</td><th>Accuracy</th><th>Time</th>";
            echo "</tr>";
            echo "</thead>";
            echo "<tbody>";
            // output data for each row
            $limit = 0;
            while($row = $result->fetch_assoc())
            {
                $cells = array(($limit + 1), $row["name"], ($row["accuracy"] * 100 . "%"), $row["time"]);
                InsertRow($cells);

                $limit += 1;
            }
            echo "</tbody>";
            echo "</table>";
        }
    }
    
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
    
    function InsertRow($cells = array())
    {
        
        echo "<tr>";
        foreach ($cells as $cell) {
            InsertTableCell($cell);
        }
        echo "</tr>";
    }
    
    function InsertTableCell($data)
    {
        echo "<td>" . $data . "</td>";
    }
?>