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
    include("Admin/dbConnect.php");    
    
    if ($errors == 0) {
        //$PostID = $_POST['PostID'];
        $PageID = $_POST['PageID'];
        $ClassID = $_POST['ClassID'];
        $SectionID = $_POST['SectionID'];
        $StudentID = $_POST['StudentID']; 
		$QText = $_POST['QText'];
        //put the below back in later
		//$DateCreated = $_POST['date']; 
		//$Position = $_POST['position']; //is this used in initial creation?
		
		$SQLstring = "insert into question (PageID, ClassID, SectionID, StudentID, QText, DateCreated) ".
                        "values ('{$PageID}', '{$ClassID}', '{$SectionID}', '{$StudentID}', '{$QText}', now())"; //eventually add back in DateCreated, Position, '$DateCreated', 'Position'
		//$QueryResult = @mysql_query($SQLstring, $DBConnect);
		
        
        if (mysqli_query($conn, $SQLstring)) { 
                echo "Post submitted successfully";
                //header("Location: localhost:8080/Capstone/home.php");
                header("Location: home.php?currentpage=$PageID"); //this isn't staying on the current page for some reason...
                //$UserID = mysqli_insert_id($con); //are these two lines required here?
                //$_SESSION['UserID'] = mysqli_insert_id($con);
            }
        else {
            echo "Error with: ".$SQLstring."<br />".$conn->error.".  Unable to save post information.";
        }
	}

?>