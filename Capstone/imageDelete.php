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
        
    $PicDelete = "delete from picture where PicID = '".$_REQUEST['pid']."'";
    
    if (mysqli_query($conn, $PicDelete)) {
        header("Location: home.php?currentpage=$PageID"); //how to get this working...
    } else {
        echo "Error: ".$PicDelete."<br />".$conn->error.".";
    }
?>