<?php 
    $serverName = "localhost";
    $userName = "root";
    $password = "";
    $database = "phpmyadmin";

    $conm = new mysqli($serverName, $userName, $password, $database);
    
    if ($conm->connect_error) {
         die("Connection failed: " . $conm->connect_error); 
    }else{
        echo"hello Testing";
    }
