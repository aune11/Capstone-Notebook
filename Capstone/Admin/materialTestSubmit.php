<?php
    
    //$directory = $_POST['directory'];
    
	//$filename = $_POST['filename'];
	//$contents = $_POST['contents'];
    
    //if (empty($filename)) { 
    //    echo "No file name entered.  File not submitted";

    //    die();
    //}
    
	//the data
	//open the file and choose the mode; since file shouldn't exist, will create the file
	//file_put_contents('includes' . $directory . '/' . $filename . '.md', $contents);
    
    //$NewMarkdownPage = file_put_contents($filename.'.md', $contents);
    
	//print "File Submitted";
    //header('Location: index.php');
    
    
    session_start();
    if(isset($_SESSION['UserID'])) {
    }
    else {
        header("Location: loginForm.php");
    }
    
    $errors = 0;
    include('dbConnect.php'); 
    
    if ($errors == 0) {
        $ClassID = 1;//$_POST['ClassID']; //restore when testing finished
        $InstructorID = 1;//$_POST['InstructorID']; //restore when testing finished
        $Title = $_POST['filename'];
		$Text = $_POST['contents'];
        
        $SectionID = 1; //remove this when the below block is uncommented
        
        //ADD THIS BACK IN
        /*$SecQuery = $conn->query("select SectionID from section where ClassID = ".$ClassID."");
        if (mysqli_num_rows($SecQuery) > 0) {
            while ($Row = mysqli_fetch_assoc($SecQuery)) {
                $SectionID = $Row['SectionID'];
            }
        }
        else {
            echo "No results were found.";
        }*/
		
        $NewMarkdownPage = file_put_contents($Title.'.md', $Text);
        
		$SQLstring = "insert into page (ClassID, SectionID, InstructorID, Title, Text) ".
                        "values ('{$ClassID}', '{$SectionID}', '{$InstructorID}', '{$Title}', '{$NewMarkdownPage}')";

        if (mysqli_query($conn, $SQLstring)) { 
                echo "Page submitted successfully";
                header("Location: adminHome.php"); 
            }
        else {
            echo "Error with: ".$SQLstring."<br />".$conn->error.".  Unable to save post information.";
        }
	}
?>