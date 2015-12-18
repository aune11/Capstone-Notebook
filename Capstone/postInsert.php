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
		$TableName = "post";
        
        //$PostID = $_POST['PostID'];
        $PageID = $_POST['PageID'];
        $ClassID = $_POST['ClassID'];
        $SectionID = $_POST['SectionID'];
        $StudentID = $_POST['StudentID'];
        $Title = $_POST['Title'];
		$PText = $_POST['PText'];
        //put the below back in later
		//$DateCreated = $_POST['date']; 
		//$Position = $_POST['position']; //is this used in initial creation?
		
		$SQLstring = "insert into $TableName (PageID, ClassID, SectionID, StudentID, Title, PText, DateCreated) ".
                        "values ('{$PageID}', '{$ClassID}', '{$SectionID}', '{$StudentID}', '{$Title}', '{$PText}', now())"; //eventually add back in DateCreated, Position, '$DateCreated', 'Position'
                        //$SQLstring->bindParam(':name', $name); //PARAMS  PARAMS EVERYWHERE!  do this for ALL sql 
        
        //$QueryResult = $conn->query($SQLstring);
		
        
        if (mysqli_query($conn, $SQLstring)) { 
                echo "Post submitted successfully";
                header("Location: home.php?currentpage=$PageID");
                //$UserID = mysqli_insert_id($con); //are these two lines required here?
                //$_SESSION['UserID'] = mysqli_insert_id($con);
            }
        else {
            echo "Error with: ".$SQLstring."<br />".$conn->error.".  Unable to save post information.";
        }

	}

?>