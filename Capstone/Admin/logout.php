<?php
    //destroys the session
    session_start();
    unset($_SESSION['UserID']);
    session_destroy();
    
    //automatically sends the user back to the login page on a successful logout
    header('Location: http://localhost:8080/Capstone/Admin/loginForm.php');
?>