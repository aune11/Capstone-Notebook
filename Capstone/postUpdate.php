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
    
    $PostID = $_POST['PostID'];
    $StudentID = $_POST['StudentID'];
    $ClassID = $_POST['ClassID'];
    $SectionID = $_POST['SectionID'];
    $PageID = $_POST['PageID'];
    $Title = $_POST['Title'];
    $PText = $_POST['PText'];
    
	$UpdatePost = "update post " . 
                  "set PostID = '".$PostID."',". 
                  "PageID = ".$PageID.",".
                  "ClassID = '".$ClassID."',". 
                  "SectionID = '".$SectionID."',". 
                  "StudentID = '".$StudentID."',".
                  "Title = '".$Title."',".
                  "PText = '".$PText."' ". 
                  "where PostID = ".$_REQUEST['PostID'];

	if (mysqli_query($conn, $UpdatePost)) { 
        echo "Successful post update.";
        header("Location: home.php?currentpage=$PageID"); //not working for some reason...
    }
    else { 
        echo "Error: ".$UpdatePost."<br />".$conn->error.".";
    }
    
?>