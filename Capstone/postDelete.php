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

    $PostDelete = "delete from post where PostID = '".$_REQUEST['pid']."'";
    
    if (mysqli_query($conn, $PostDelete)) {
        header("Location: home.php?currentpage=$PageID"); //this isn't staying on the current page for some reason...
    } else {
        echo "Error: ".$PostDelete."<br />".$conn->error.".";
    }
?>