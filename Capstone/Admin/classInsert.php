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
    
    $errors = 0;
    include('dbConnect.php'); 
    
    if ($errors == 0) {

        $ClassID = $_POST['ClassID'];
        $Name = $_POST['Name'];
		
		$SQLstring = "insert into class (ClassID, Name) ".
                        "values ('{$ClassID}', '{$Name}')";
                        //$SQLstring->bindParam(':name', $name); //PARAMS  PARAMS EVERYWHERE!  do this for ALL sql 

        if (mysqli_query($conn, $SQLstring)) { 
                echo "Post submitted successfully";
                header("Location: adminHome.php?page=$PageID");
            }
        else {
            echo "Error with: ".$SQLstring."<br />".$conn->error.".  Unable to save post information.";
        }
	}

?>