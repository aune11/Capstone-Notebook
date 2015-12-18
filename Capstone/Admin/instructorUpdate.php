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
    
    $TableName = "instructor";
    $Table2 = "login";
    
	$SQLstring = "update instructor " . 
					"set InstructorID = '" . $_POST['InstructorID'] . "'," . 
						"UserID = " . $_POST['UserID'] . ", " .
						//"CLassID = '" . $_POST['ClassID'] . "', " . 
						"FName = '" . $_POST['FName'] . "', " . 
						"LName = '" . $_POST['LName'] . "', " .
                        "Phone = '" . $_POST['Phone'] . "', " . 
						"Email = '" . $_POST['Email'] . "' " . 
						//"Roles = " . $_POST['Role'] . "," . 
						"where InstructorID = " . $_REQUEST['InstructorID'];
	//$QueryResult = @mysqli_query($SQLstring, $con);
    $SQLstring2 = "update login " .
                    "set Roles = '" . $_POST['Roles'] . "' " .
                    "where UserID = " . $_REQUEST['InstructorID'];

	if (mysqli_query($conn, $SQLstring) &&
        mysqli_query($conn, $SQLstring2)) { 
            echo "Successful Instructor update.";
            header("Location: adminHome.php?page=instructorList");
    }
    else { 
        echo "Error: ".$SQLstring."<br />".$conn->error.".";
        echo "Error: ".$SQLstring2."<br />".$conn->error.".";
    }


?>

<!--<html>
    <head>
        <title>Instructor Update</title>
        <meta charset="utf-8" />
        <link rel="stylesheet" type="text/css" href="../Styles/styles.css" />
    </head>
    
    <body>
        <div id="main">
            <nav id="adminNav">
                    <?php //include("adminIncludes/adminNav.php"); ?>
            </nav>
            
            <h3 class="addPageTitle">Instructor Info Updated</h3>
            
            <p>Details for '<?php //echo $FName . " " . $LName; ?>' have been successfully updated and saved.
        </div>
    </body>
</html>-->