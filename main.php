<?php 
    include "dbconnect.php";

    if (isset($_GET['action'])) {
        $action = $_GET['action'];
        switch($action){
            case 'register':
                if($_SERVER["REQUEST_METHOD"] == "POST"){
                    $name = $_POST['username'];
                    $password = $_POST['password'];
                    $email = $_POST['email'];
                    //encode the password for security reason
                    $hash_password = md5($password);
                    //if user exist then don't create a new
                    $sql = "SELECT * FROM Users WHERE Name = ? OR EMail = ?";
                    $stmt = $conm->prepare($sql);
                    // bind the parameter 
                    $stmt->bind_param('ss', $name, $email);
                    //execution
                    $stmt->execute();
                    //results
                    $results = $stmt->get_result();
                    
                    if ($results->num_rows > 0) {
                        echo '<script type ="text/JavaScript">';  
                        echo 'alert("It seems like this user already exists!") ';  
                        echo 'window.location.href="logIn.php"';
                        echo '</script>';
                    }else{
                        $sql = "INSERT INTO Users (Name, Password, EMail)  VALUES (?, ?, ?)";
                        $stmt = $conm->prepare($sql);
                        // bind the parameter
                        $stmt->bind_param('sss', $name, $hash_password, $email);
                        //execution
                        //$stmt->execute();
                        //print_r($stmt);
                        if ($stmt->execute()) {
                            //header("Location: start.php");
                            echo '<script type ="text/JavaScript">';  
                            echo 'alert("User has been successfully created, Please Log In now with you credentials!")';  
                            echo 'window.location.href="logIn.php"';
                            echo '</script>';
                            exit();  
                        }else{
                            echo"account error";
                        } 
                }
            }
                break;
            case 'login':
                if($_SERVER["REQUEST_METHOD"] == "POST"){
                    $name = $_POST['username'];
                    $password = $_POST['password'];
                    //encode the password for security reason
                    $hash_password = md5($password);
                    //if user exist then don't create a new
                    $sql = "SELECT * FROM Users WHERE Name = ? AND Password = ?";
                    $stmt = $conm->prepare($sql);

                    // bind the parameter 
                    $stmt->bind_param('ss', $name, $hash_password);
                    //execution
                    $stmt->execute();
                    //results
                    $results = $stmt->get_result();
                    
                    if ($results->num_rows > 0) {
                        session_start();
                        $_SESSION["userLoggedIn"] = $name;
                        echo '<script type ="text/JavaScript">';  
                        echo 'window.location.href="userMainPage.php"';
                        echo '</script>';
                        exit();
                    }else{
                        print_r($results);
                        echo '<script type ="text/JavaScript">';  
                        echo 'alert("User has been successfully created")';  
                        echo 'window.location.href="logIn.php"';
                        echo '</script>';
                        
                    }
                }
                break;
            case 'logout':
                session_start();
                session_unset(); //deletes all the variables that we saved 
                session_destroy();
                header("Location: start.php");
                exit;
            case'create Article':
                if($_SERVER["REQUEST_METHOD"] == "POST"){
                    $title = $_POST['title'];
                    $content = $_POST['content'];
                    $_SESSION["userId"]= $idUser;
                    if(isset($_POST[checkDatabases])){
                        $idTopic = 2;
                    }else if(isset($_POST[checkAI])){
                        $idTopic = 1;
                    }else if(isset($_POST[checkCloud])){
                        $idTopic = 3;
                    }else if(isset($_POST[checkWebDev])){
                        $idTopic = 4;
                    }else if(isset($_POST[checkETC])){
                        $idTopic = 5;
                    }else{
                        echo '<script type ="text/JavaScript">';  
                        echo 'alert("You forgot to choose which topic it belongs, please chose a topic!") ';  
                        echo 'window.location.href="createArticle.php"';
                        echo '</script>';
                    }
                    //if title exists then please refer for the user to change the title
                    $sql = "SELECT * FROM Articles WHERE Title= ? ";
                    $stmt = $conm->prepare($sql);
                    // bind the parameter 
                    $stmt->bind_param('s', $title);
                    //execution
                    $stmt->execute();
                    //results
                    $results = $stmt->get_result();
                    
                    if ($results->num_rows > 0) {
                        echo '<script type ="text/JavaScript">';  
                        echo 'alert("An Article with this title already exists, please change your title!") ';  
                        echo 'window.location.href="logIn.php"';
                        echo '</script>';
                    }else{
                        $sql = "INSERT INTO Articles (Title, Content, Author, Topic)  VALUES (?, ?, ?, ?)";
                        $stmt = $conm->prepare($sql);
                        // bind the parameter
                        $stmt->bind_param('ssii', $title, $content, $idUser, $idTopic);
                        //execution
                        if ($stmt->execute()) {
                            //header("Location: start.php");
                            echo"Account created";
                            echo '<script type ="text/JavaScript">';  
                            echo 'alert("Article has been created! Thank you for your work!")';  
                            echo '</script>';
                            header("Location: start.php");
                            exit();  
                        }else{
                            echo"ooops something went wrong...";
                        } 
                }
            }
            
            default:
                echo "default case!";
                break;
            
        }
    }
?>
