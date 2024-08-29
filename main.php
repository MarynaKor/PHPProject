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
                        echo '</script>';
                        header("Location: start.php");
                    }else{
                        $sql = "INSERT INTO Users (Name, Password, EMail)  VALUES (?, ?, ?)";
                        $stmt = $conm->prepare($sql);
                        // bind the parameter
                        $stmt->bind_param('sss', $name, $hash_password, $email);
                        //execution
                        //$stmt->execute();
                        //print_r($stmt);
                        if ($stmt->execute()) {
                            header("Location: start.php");
                            echo"Account created";
                            echo '<script type ="text/JavaScript">';  
                            echo 'alert("User has been successfully created")';  
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
                    $stmt->bind_param('ss', $name, $password);
                    //execution
                    $stmt->execute();
                    //results
                    $results = $stmt->get_result();
                    
                    if ($results->num_rows > 0) {
                        header("Location: createArticle.php");
                    }else{
                        echo"There was an error try again or if you don't have an account please register.";
                }
            }
                echo "Welcome back!";
                break;
            
            
            default:
                echo "default case!";
                break;
            
        }
    }
?>