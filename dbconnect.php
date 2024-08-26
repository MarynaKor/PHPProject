<?php 

    $serverName = "localhost";
    $userName = "root";
    $password = "";
    $database = "ITNews";

    $conm = new mysqli($serverName, $userName, $password, $database);
    
    if ($conm->connect_error) {
         die("Connection failed: " . $conm->connect_error); 
    }
    

    ?>
