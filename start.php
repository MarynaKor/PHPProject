<?php 
include 'dbconnect.php';
$sql = "SELECT * FROM Articles";
$results = $conm->query($sql);
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
            <li><a href="default.asp">Databases</a></li>
            <li><a href="news.asp">AI</a></li>
            <li><a href="contact.asp">Cloud</a></li>
            <li><a href="contact.asp">WebDev</a></li>
            <li><a href="about.asp">ETC</a></li>
            <li ><a href="logIn.php" class="red">LogIn/Register</a></li>
        </ul>
    </header>    
    <main class="">
        <div class="wrapper">
            <?php
            if ($results->num_rows > 0) {
              while($row = $results->fetch_assoc()) {
                echo "<div>"; 
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
    