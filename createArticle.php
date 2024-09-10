<?php 
include 'dbconnect.php';
session_start();
$title="";
$article="";
$articleID=1;
if(!is_null($articleID)){
    $sql = "SELECT * FROM Articles WHERE ID = ?";
    $stmt= $conm->prepare($sql);
    $stmt->bind_param('i', $articleID);
    $stmt->execute();
    $results = $stmt->get_result();
    if($results->num_rows > 0){
        $content =  $results->fetch_assoc();
        $title = $content["Title"];
        $article= $content["Article"];
    }
}else{

    echo "Not set!";
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
            <li><a href="default.asp">Databases</a></li>
            <li><a href="news.asp">AI</a></li>
            <li><a href="contact.asp">Cloud</a></li>
            <li><a href="contact.asp">WebDev</a></li>
            <li><a href="about.asp">ETC</a></li>
            <li><a href="start.php">LogOut</a></li>
        </ul>
    </header>    
    <main class="">
        <h2>Artikel Einsenden</h2>

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
            <textarea id="content" name="content" rows="8" value="<?php echo ($title); ?>" required></textarea>
        
            <input type="submit" value="Create Article">
            <button class="back-btn" onclick="window.history.back();">Go Back</button>
        </form>
    </div>
    </main>
    <footer>
    
    </footer>
    </body>