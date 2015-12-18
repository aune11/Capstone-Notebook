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

    $ClassID = $_POST['ClassID'];
    $Name = $_POST['Name'];
    
	$UpdateClass = "update class " . 
                  "set ClassID = ".$ClassID.", ". 
                  "Name = '".$Name."' ".
                  "where ClassID = '".$_REQUEST['ClassID']."'";

	if (mysqli_query($conn, $UpdateClass)) { 
        echo "Successful class update.";
        header("Location: adminHome.php?page=classList");//".$_GET['page'].""); //not working for some reason...
    }
    else { 
        echo "Error: ".$UpdateClass."<br />".$conn->error.".";
    }
    
?>