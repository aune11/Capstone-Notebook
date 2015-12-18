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

    //delete the sections along with the class since the class they're tied to no longer exists
    //may want to also delete the pages and posts associated with the class/section, but will need
    //clarification on that
    $ClassDelete = "delete from class where ClassID = '".$_REQUEST['pid']."'";
    $SectionDelete = "delete from section where ClassID = '".$_REQUEST['pid']."'";
    
    if (mysqli_query($conn, $ClassDelete) &&
        mysqli_query($conn, $SectionDelete)) {
        header("Location: home.php?page=classList");//home.php?page=$PageID"); //this isn't staying on the current page for some reason...
    } else {
        echo "Error: ".$ClassDelete."<br />".$conn->error.".<br /><br />";
        echo "Error: ".$SectionDelete."<br />".$conn->error.".";
    }
?>