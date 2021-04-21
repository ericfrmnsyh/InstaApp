<?php
session_start();
    if(isset($_SESSION['isUser'])){
        true;
    }
    else if(isset($_SESSION['isExpert'])){
        true;
    }
    else{
        header("Location: http://localhost/InstaApp/index.php");
        exit();
    }
?>