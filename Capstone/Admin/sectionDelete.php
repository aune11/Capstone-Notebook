<?php
    if(!isset($_SESSION)) { 
        session_start(); 
    } 
    elseif(isset($_SESSION['UserID'])) {
        include('adminCheck.php');
    }
    else {
        header("Location: loginForm.php");
    }
    
    include("dbConnect.php");    
    
    //$PageID = $_REQUEST['pid'];//$_GET['page'];

    $SectionDelete = "delete from section where SectionID = '".$_REQUEST['pid']."'";
    
    if (mysqli_query($conn, $SectionDelete)) {
        header("Location: home.php?page=$PageID"); //this isn't staying on the current page for some reason...
    } else {
        echo "Error: ".$SectionDelete."<br />".$conn->error.".";
    }
?>