<?php 
    include "dbconnect.php";

    if (isset($_GET['action'])) {
        $action = $_GET['action'];

        switch($action){
            case 'register':
                if($_SERVER["REQUEST_METHOD"] == "POST"){
                    $name = $_POST['Name'];
                    $email = $_POST['EMail'];
                    $password = $_POST['Password'];
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
                
                    if(empty($results)) {
                        //prepare query 
                        $sql = "INSERT INTO Users (Name, EMail, Password)  VALUES (?, ?, ?)";
                        $stmt = $conm->prepare($sql);
                        // bind the parameter
                        $stmt->bind_param('sss', $name, $email, $hash_password);
                        //execution
                        if ($stmt ->execute()) {
                            echo '<script type ="text/JavaScript">';  
                            echo 'alert("User has been successfully created")';  
                            echo '</script>';
                            header("Location: start.php");
                            exit();
                        }
                    }else{
                        echo '<script type ="text/JavaScript">';  
                            echo 'alert("It seems like this user already exists!")';  
                            echo '</script>';
                            echo "$stmt";
                            //header("Location: start.php");
                        }
                }
        
                break;
            case 'login':
                echo "Welcome back!";
                break;
            
            
            default:
                echo "default case!";
                break;
            
        }
    }
?>