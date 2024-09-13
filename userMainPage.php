<?php 
include 'dbconnect.php';
session_start();
if(!isset($_SESSION["userLoggedIn"])){
  header("location: start.php");
}
$username = $_SESSION['userLoggedIn'];
$sql = "SELECT * FROM Users WHERE Name = ?";
$stmt= $conm->prepare($sql);
$stmt->bind_param('s', $username);
$stmt->execute();
$results = $stmt->get_result();
$user = $results->fetch_assoc();
$idUser = $user["ID"];
$_SESSION["userId"]= $idUser;
//Selecting the articles
$sql = "SELECT * FROM Articles WHERE Author = ?";
$stmt= $conm->prepare($sql);
$stmt->bind_param('s', $idUser);
$stmt->execute();
$results = $stmt->get_result();
?>
<!DOCTYPE html>
<html>
  <head>
    <link rel="stylesheet" type="text/css" href="style/style.css">
  </head>
  <body>
    <header> 
        <h1>This is the TECH BLOG</h1>
        <ul>
            <li><a href="main.php?action=sort&id=2">Databases</a></li>
            <li><a href="main.php?action=sort&id=1">AI</a></li>
            <li><a href="main.php?action=sort&id=3">Cloud</a></li>
            <li><a href="main.php?action=sort&id=4">WebDev</a></li>
            <li><a href="main.php?action=sort&id=5">ETC</a></li>
            <li><a href="main.php?action=logout" class="red">LogOut</a></li>

        </ul>
    </header>    
    <main>
    <div class ="user_main">
      <ul class="block">
          <?php
          if ($results->num_rows > 0) {
              while($row = $results->fetch_assoc()) { ?>
                <li>
                <h3><?php echo($row["Title"])?></h3>
                <div class="nextTo">
                <form method="POST" action="main.php?action=delete">
                  <input type="hidden" name="articleId" value ="<?php echo($row["ID"])?>">
                  <button type="submit" class="delete right"> Delete</button>
                </form>
               <form method="POST" action="main.php?action=createArticle">
                 <input type="hidden" name="articleId" value ="<?php echo($row["ID"])?>">
                 <button type= "submit" class="edit right"> Edit</button>
              </form>
                </div>
            </li>
          <?php } 
        }else{
        echo "Sorry seems like you have no articles...";
        }
        ?>
      </ul>
    <button><a href="createArticle.php">Create New Article</a></button>
    </div>
    </main>
    <footer>
    
    </footer>
    </body>