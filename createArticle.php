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

        <form action="#" method="post">
          <div class="checkbox-group">
            <label>
                <input type="checkbox" name="checkbox" value="Databases"> Databases
            </label>
            <label>
                <input type="checkbox" name="checkbox" value="AI"> AI
            </label>
            <label>
                <input type="checkbox" name="checkbox" value="Cloud"> Cloud
            </label>
            <label>
                <input type="checkbox" name="checkbox" value="WebDev"> WebDev
            </label>
            <label>
              <input type="checkbox" name="checkbox" value="ETC"> ETC
          </label>
        </div>
            <label for="title">Titel:</label>
            <input type="text" id="title" name="title" required>
        
            <label for="content">Inhalt:</label>
            <textarea id="content" name="content" rows="8" required></textarea>
        
            <button type="submit" class="submit-btn">Einsenden</button>
            <button type="button" class="back-btn" onclick="window.history.back();"> Zurück</button>
        </form>
    </div>
    </main>
    <footer>
    
    </footer>
    </body>