<?php 
    $serverName = "localhost";
    $userName = "root";
    $password = "";
    $database = "phpmyadmin";

    $conm = new mysqli($serverName, $userName, $password, $database);
    
    if ($conm->connect_error) {
         die("Connection failed: " . $conm->connect_error); 
    }
    $sql = "SELECT * FROM Articles";
    $result = $conm->query($sql);
    if ($result->num_rows > 0) {
         while($row = $result->fetch_assoc()) { 
            echo "id: " . $row["ID"]. " - Name: " . $row["Title"]. "<br>"; 
        } 
    } else {
         echo "0 results"; 
        }

    $conn->close();

    ?>
