<?php
    if(!isset($_SESSION)) { 
        session_start(); 
    } 
    elseif(isset($_SESSION['UserID'])) {
        include("adminCheck.php");
    }
    else {
        header("Location: loginForm.php");
    }
    
    include("dbConnect.php");    
    
    //tables to delete from
	//$TableName1 = "instructor";
	//$TableName2 = "login";
	
	if ($errors == 0) {
		/*$SQLstring = "select FName, LName from instructor where UserID = '" . $_REQUEST['pid'] . "'"; // or InstructorID = '" . $_REQUEST['pid'] . "'"; 
		$QueryResult = mysqli_query($conn, $SQLstring);
		
		if (mysqli_query($conn, $SQLstring)) {
			while ($Row = mysqli_fetch_assoc($QueryResult)) {
				$FName = $Row['FName'];
				$LName = $Row['LName'];
			}
        }*/
        
        $Instructor = "select ins.UserID, ins.InstructorID, log.UserID from instructor ins ".
                   "join login log on log.UserID = ins.UserID ".
                   "where ins.InstructorID = '".$_REQUEST['pid']."'";
        $InsQuery = $conn->query($Instructor);
        
        if (mysqli_num_rows($InsQuery) > 0) {           
            while ($Row = mysqli_fetch_assoc($InsQuery)) {
				//$InstructorID = $Row['InstructorID']; //add this back in when added queries to delete from the page table
                $UserID = $Row['UserID'];
			}
			//mysql_free_result($QueryResult);
		} else {
            echo "No results were found or....";
            echo "<br />".$conn->error.".";
        }
        
        //see the studentDelete.php page for a couple of alternative setups.  apparently joins don't work in deletions, but I know this is not true,
        //as I got it to work in the PHPMIDTERM project.  might be a quirk of mysql() that wasn't carried over to mysqli()?
        $SQLstring2 = "delete from instructor where UserID = '".$UserID."'"; //InstructorID = '" . $_REQUEST['pid'] . "' or UserID = '" . $_REQUEST['pid'] . "'"; 
        $SQLstring3 = "delete from login where UserID = '".$UserID."'"; 
        
        if (mysqli_query($conn, $SQLstring2) &&
            mysqli_query($conn, $SQLstring3)) {
            echo "Successful deletion of instructor records<br />";
            header("Location: adminHome.php?page=instructorList"); //just going to use this setup, as it will take the user back to the list page after deletion
        } else {
            echo "Error: ".$SQLstring2."<br />".$conn->error.".";
            echo "Error: ".$SQLstring3."<br />".$conn->error.".";
        }
        /*if (mysqli_query($conn, $SQLstring3)) {
            echo "successful deletion login records<br />";
        } else {
            echo "Error: ".$SQLstring3."<br />".$conn->error.".";
        }*/
	}
?>

<!--<html>
    <head>
        <title>Instructor Deleted</title>
        <meta charset="utf-8" />
        <link rel="stylesheet" type="text/css" href="../Styles/styles.css" />
    </head>
    
    <body>
        <div id="main">
            <nav id="adminNav">
                    <?php //include("adminIncludes/adminNav.php"); ?>
            </nav>
            
            <h3 class="addPageTitle">Instructor Info Deleted</h3>
            
            <p>The instructor AND login information for '<?php //echo $FName . " " . $LName; ?>' have been successfully deleted.
        </div>
    </body>
</html>-->