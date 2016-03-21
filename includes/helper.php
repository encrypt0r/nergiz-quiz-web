<?php 
    
    function RenderPart($part, $data = array())
    {
        require_once("config.php");
        extract($data);
        require($part . ".php");
    }

?>