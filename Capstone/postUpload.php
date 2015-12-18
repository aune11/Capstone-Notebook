<?php
    if(!isset($_SESSION)) { 
        session_start(); 
    } 
    elseif(isset($_SESSION['UserID'])) {
    }
    else {
        header("Location: loginForm.php");
    }
    
    $errors = 0;
    include('Admin/dbConnect.php'); 
    
    if ($errors == 0) {
		$TableName = "post";

        $StudentID = $_POST['studID']; 
		$PText = $_POST['postArea'];
		$DateCreated = $_POST['date'];
		//$Position = $_POST['position']; //is this used in initial creation?
		
		$SQLstring = "insert into $TableName (StudentID, PText, DateCreated, Position) values ('$StudentID', $PText, '$DateCreated', '$Position')";
		$QueryResult = @mysql_query($SQLstring, $DBConnect);
		
        
        if (mysqli_query($conn, $SQLstring)) { 
                echo "Post submitted successfully";
                header("Location: localhost:8080/Capstone/home.php");
                //$UserID = mysqli_insert_id($con); //are these two lines required here?
                //$_SESSION['UserID'] = mysqli_insert_id($con);
            }
        else {
            echo "Error with: ".$SQLstring2."<br />".$conn->error.".  Unable to save post information.";
        }
        

	}

?>