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
    
    $PageID = $_POST['PageID'];
    $ClassID = $_POST['ClassID'];
    $SectionID = $_POST['SectionID'];
    $InstructorID = $_POST['InstructorID'];
    $Title = $_POST['Title'];
    $Text = $_POST['Text'];
    
	$UpdatePage = "update page " . 
                  "set PageID = '".$PageID."',".
                  "ClassID = '".$ClassID."',". 
                  "SectionID = '".$SectionID."',". 
                  "InstructorID = '".$InstructorID."',".
                  "Title = '".$Title."',".
                  "Text = '".$Text."' ". 
                  "where PageID = ".$_REQUEST['PageID'];

	if (mysqli_query($conn, $UpdatePage)) { 
        echo "Successful page update.";
        header("Location: adminHome.php?page=pagelist"); //not working for some reason...
    }
    else { 
        echo "Error: ".$UpdatePage."<br />".$conn->error.".";
    }
    
?>