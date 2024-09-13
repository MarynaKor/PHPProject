<?php 
include 'dbconnect.php';
session_start();
if(isset($_SESSION["catergoryId"])) {
  $sql = "SELECT * FROM Articles WHERE Topic = ?";
  $stmt = $conm->prepare($sql);
  $stmt->bind_param('i', $_SESSION["catergoryId"]);
  $stmt->execute();
  $results = $stmt->get_result();
}else{
  $sql = "SELECT * FROM Articles";
  $results = $conm->query($sql);
}
?>
<!DOCTYPE html>
<html>
  <head>
    <link rel="stylesheet" type="text/css" href="style/style.css">
  </head>
  <body>
    <header> 
        <h1>This is the TECH BLOG </h1>
        <ul>
            <li><a href="main.php?action=sort&id=2">Databases</a></li>
            <li><a href="main.php?action=sort&id=1">AI</a></li>
            <li><a href="main.php?action=sort&id=3">Cloud</a></li>
            <li><a href="main.php?action=sort&id=4">WebDev</a></li>
            <li><a href="main.php?action=sort&id=5">ETC</a></li>
            <?php 
            // Check if the session variable 'userId' is set to determine the login state
            if (isset($_SESSION["userId"]) && !empty($_SESSION["userId"])) {
                // Session is set, show the Logout link
                echo '<li><a href="main.php?action=logout" class="red">Logout</a></li>';
            } else {
                // Session is not set, show the Login/Register link
                echo '<li><a href="logIn.php" class="red">LogIn/Register</a></li>';
            }
            ?>  
        </ul>
    </header>    
    <main class="">
        <div class="wrapper">
            <?php
            if ($results->num_rows > 0) {
              while($row = $results->fetch_assoc()) {
                echo "<div class='border'>"; 
                echo "<h3>" . $row["Title"] ."</h3>";
                echo "<p>" . $row["Article"]. "<p><br> <br>"; 
                echo "</div>"; 
                } 
            } else { 
                echo "Sorry, No articles present"; 
                }
            ?>
            
        </div>
    </main>
    <footer>

    </footer>
    </body>
    