<?php
    if(!isset($_SESSION)) { 
        session_start(); 
    } 
    elseif(isset($_SESSION['UserID'])) {
    }
    else {
        header("Location: loginForm.php");
    }
    
    include("Admin/dbConnect.php");
    
    //$PageID = $_REQUEST['pid'];//$_GET['page'];

    $QuestionDelete = "delete from question where QuestionID = '".$_REQUEST['pid']."'";
    
    if (mysqli_query($conn, $QuestionDelete)) {
        header("Location: home.php?currentpage=$PageID"); //this isn't staying on the current page for some reason...
    } else {
        echo "Error: ".$QuestionDelete."<br />".$conn->error.".";
    }
?>