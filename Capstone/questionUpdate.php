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
    
    $QuestionID = $_POST['QuestionID'];
    $StudentID = $_POST['StudentID'];
    $ClassID = $_POST['ClassID'];
    $SectionID = $_POST['SectionID'];
    $PageID = $_POST['PageID'];
    $QText = $_POST['QText'];
    
	$UpdateQuestion = "update question " . 
                      "set QuestionID = '".$QuestionID."',". 
                      "PageID = ".$PageID.",".
                      "ClassID = '".$ClassID."',". 
                      "SectionID = '".$SectionID."',". 
                      "StudentID = '".$StudentID."',". 
                      "QText = '".$QText."' ". 
                      "where QuestionID = ".$_REQUEST['QuestionID'];
    
	if (mysqli_query($conn, $UpdateQuestion)) { 
        echo "Successful question update.";
        header("Location: home.php?currentpage=$PageID"); //this isn't staying on the current page for some reason...
    }
    else { 
        echo "Error: ".$UpdateQuestion."<br />".$conn->error.".";
    }
    
?>