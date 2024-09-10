<?php 
    include "dbconnect.php";
    session_start();
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
            case 'createArticle':
                    if ($_SERVER["REQUEST_METHOD"] == "POST") {
                        $title = $_POST['title'];
                        $content = $_POST['content'];
                        $idUser = $_SESSION["userId"]; // Ensure this session variable is correctly set
                
                        // Check if topics are set
                        if (isset($_POST["topics"])) {
                            $idTopic = $_POST["topics"];
                        } else {
                            echo '<script type="text/javascript">';
                            echo 'alert("You forgot to choose which topic it belongs, please choose a topic!");';
                            echo 'window.location.href="createArticle.php";'; // Correct JavaScript syntax
                            echo '</script>';
                            exit(); // Stop execution if no topic is selected
                        }
                
                        // Check if an article with the same title already exists
                        $sql = "SELECT * FROM Articles WHERE Title = ?";
                        $stmt = $conm->prepare($sql);
                        // Bind the title parameter and execute
                        $stmt->bind_param('s', $title);
                        $stmt->execute();
                        $results = $stmt->get_result();
                
                        if ($results->num_rows > 0) {
                            echo '<script type="text/javascript">';
                            echo 'alert("An article with this title already exists, please change your title!");';
                            echo 'window.location.href="createArticle.php";'; // Corrected the redirect page
                            echo '</script>';
                            exit();
                        } else {
                            // Insert the article into the database
                            $sql = "INSERT INTO Articles (Title, Article, Author, Topic) VALUES (?, ?, ?, ?)";
                            $stmt = $conm->prepare($sql);
                            // Bind the parameters: 2 strings and 2 integers
                            $stmt->bind_param('ssii', $title, $content, $idUser, $idTopic);
                            
                            // Execute the insert statement
                            if ($stmt->execute()) {
                                echo '<script type="text/javascript">';
                                echo 'alert("Article has been created! Thank you for your work!");';
                                echo 'window.location.href="userMainPage.php";'; // Redirect to start.php after the alert
                                echo '</script>';
                                exit();
                            } else {
                                // Print the specific error if the execution fails
                                echo "Error occurred: " . $stmt->error;
                            }
                        }
                
                        // Close the statement and connection
                        $stmt->close();
                        $conm->close();
                    }
                    break;
            case 'delete':
                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    $articleId = $_POST['articleId'];
                    $sql = "DELETE FROM Articles WHERE ID = ?";
                    $stmt = $conm->prepare($sql);
                    // bind the parameter 
                    $stmt->bind_param('i', $articleId);
                    //execution
                    if($stmt->execute()){
                        echo '<script type="text/javascript">';
                        echo 'alert("Article has been deleted!");';
                        echo 'window.location.href="userMainPage.php";'; // Redirect to start.php after the alert
                        echo '</script>';
                        exit();  
                    }else{
                        echo "File not deleted!";
                    }
                }
                
                break;
            default:
                echo "default case!";
                break;
            
        }
    }
?>
