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
    
    $SecQuery = $conn->query("select SectionID from section where ClassID = ".$ClassID."");
    if (mysqli_num_rows($SecQuery) > 0) {
        while ($Row = mysqli_fetch_assoc($SecQuery)) {
            $SectionID = $Row['SectionID'];
        }
    }
    else {
        echo "No results were found.";
    }
    
	$SQLstring = "update student " . 
					"set StudentID = '" . $_POST['StudentID'] . "'," . 
						"UserID = " . $_POST['UserID'] . "," .
						"ClassID = '" . $_POST['ClassID'] . "'," .
                        "SectionID = '" . $SectionID . "'," . 
						"FName = '" . $_POST['FName'] . "'," . 
						"LName = '" . $_POST['LName'] . "'," . 
						"Email = '" . $_POST['Email'] . "' " . 
						"where StudentID = " . $_REQUEST['StudentID'];

    /*$SQLstring2 = "update login " .
                    "set Roles = '" . $_POST['Roles'] . "' " .
                    "where UserID = " . $_REQUEST['StudentID'];
    */
	if (mysqli_query($conn, $SQLstring)) {
            echo "Successful Student update.";
            header("Location: adminHome.php?page=studentList");
    }
    else {
        echo "Error: ".$SQLstring."<br />".$conn->error;   
    }


?>

<!--<html>
    <head>
        <title>Student Update</title>
        <meta charset="utf-8" />
        <link rel="stylesheet" type="text/css" href="../Styles/styles.css" />
    </head>
    
    <body>
        <div id="main">
            <!--<nav id="adminNav">
                    <?php //include("adminIncludes/adminNav.php"); ?>
            </nav>
            
            <h3 class="addPageTitle">Student Info Updated</h3>
            
            <p>Details for '<?php //echo $FName . " " . $LName; ?>' have been successfully updated and saved.
        </div>
    </body>
</html>-->