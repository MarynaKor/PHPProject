<?php 
    include "db_connect.php";

    if (isste($_GET['action'])) {
        $action = $_GET['action'];

        switch($action){
            case 'register':
                echo "Hello There";
                break;
            case 'login':
                echo "Welcome back!";
                break;
            
                default:
                    break;
            
        }
    }
?>