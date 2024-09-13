<?php 
include 'dbconnect.php';
session_start();
if(isset($_SESSION["title"]) and !empty($_SESSION["title"])){
    $title = $_SESSION["title"];
    $article = $_SESSION["article"];
}else{
    $title ="";
    $article="";
}
?>
<!DOCTYPE html>
<html>
  <head>
    <link rel="stylesheet" type="text/css" href="style/style.css">
  </head>
  <body>
    <header> 
        <h1> This is the TECH BLOG </h1>
        <ul>
            <li><a href="main.php?action=sort&id=2">Databases</a></li>
            <li><a href="main.php?action=sort&id=1">AI</a></li>
            <li><a href="main.php?action=sort&id=3">Cloud</a></li>
            <li><a href="main.php?action=sort&id=4">WebDev</a></li>
            <li><a href="main.php?action=sort&id=5">ETC</a></li>
            <?php 
            // Check if the session variable 'userId' is set to determine the login state
            if (isset($_SESSION['userId']) && !empty($_SESSION['userId'])) {
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
        <h2><?php  echo (isset($title) && !empty($title)) ? 'Edit' : 'Create';  ?> here the Article</h2>

        <form action="main.php?action=createArticle" method="POST">
          <div class="checkbox-group">
            <label>
                <input type="radio" name="topics" value="2"> Databases
            </label>
            <label>
                <input type="radio" name="topics" value="1"> AI
            </label>
            <label>
                <input type="radio" name="topics" value="3"> Cloud
            </label>
            <label>
                <input type="radio" name="topics" value="4"> WebDev
            </label>
            <label>
                <input type="radio" name="topics" value="5"> ETC
            </label>
        </div>
            <label for="title">Titel:</label>
            <input type="text" id="title" name="title" value="<?php echo ($title); ?>" required>
            <label for="content">Inhalt:</label>
            <textarea id="content" name="content" rows="8" required><?php echo ($article); ?></textarea>
            <input type="submit" value="<?php  echo (isset($title) && !empty($title)) ? 'Edit' : 'Create';  ?> Article">
            <button class="back-btn" onclick="window.history.back();"> Go Back</button>
        </form>
    </div>
    </main>
    <footer>
    
    </footer>
    </body>