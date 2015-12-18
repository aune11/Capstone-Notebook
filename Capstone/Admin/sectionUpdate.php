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
    
    $SectionID = $_POST['SectionID'];
    $ClassID = $_POST['ClassID'];
    $InstructorID = $_POST['InstructorID'];
    $SectionNum = $_POST['SectionNum'];
    $Days = $_POST['Days'];
    $Time = $_POST['Time'];
    
	$UpdateSection = "update section " . 
                  "set SectionID = '".$SectionID."' ,".
                  "ClassID = '".$ClassID."',". 
                  "InstructorID = '".$InstructorID."' ,".
                  "SectionNum = '".$SectionNum."' ,".
                  "Days = '".$Days."', ".
                  "Time = '".$Time."' ".
                  "where SectionID = '".$_REQUEST['SectionID']."'";

	if (mysqli_query($conn, $UpdateSection)) { 
        echo "Successful section update.";
        header("Location: adminHome.php?page=classList"); //not working for some reason...
    }
    else { 
        echo "Error: ".$UpdateSection."<br />".$conn->error.".";
    }
    
?>