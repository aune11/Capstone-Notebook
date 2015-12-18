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
        //$SectionID = $_POST['SectionID'];
        $InstructorID = $_POST['InstructorID'];
        $Title = $_POST['Title'];
		$Text = $_POST['Text'];
        
        $SecQuery = $conn->query("select SectionID from section where ClassID = ".$ClassID."");
        if (mysqli_num_rows($SecQuery) > 0) {
            while ($Row = mysqli_fetch_assoc($SecQuery)) {
                $SectionID = $Row['SectionID'];
            }
        }
        else {
            echo "No results were found.";
        }
		
		$SQLstring = "insert into page (ClassID, SectionID, InstructorID, Title, Text) ".
                        "values ('{$ClassID}', '{$SectionID}', '{$InstructorID}', '{$Title}', '{$Text}')"; //eventually add back in DateCreated, Position, '$DateCreated', 'Position'
                        //$SQLstring->bindParam(':name', $name); //PARAMS  PARAMS EVERYWHERE!  do this for ALL sql 
        
        //$QueryResult = $conn->query($SQLstring);
		
        
        if (mysqli_query($conn, $SQLstring)) { 
                echo "Page submitted successfully";
                header("Location: adminHome.php?page=adminHomePage");
            }
        else {
            echo "Error with: ".$SQLstring."<br />".$conn->error.".  Unable to save post information.";
        }
	}
?>