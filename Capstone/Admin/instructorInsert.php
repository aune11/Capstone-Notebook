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
    include("dbConnect.php");

    $InstructorID = $_POST['InstructorID'];
    $UserID = $_POST['UserID'];
    $FName = $_POST['FName'];
    $LName = $_POST['LName'];
    $Email = $_POST['Email'];
    $Phone = $_POST['Phone'];
    $Username = $_POST['Username'];
    $Password = $_POST['Password'];
    $Roles = $_POST['Roles'];
    
    $StorePW = password_hash($Password, PASSWORD_BCRYPT);
    
	if ($errors == 0) { 
		$SQLstring = "insert into instructor (InstructorID, UserID, FName, LName, Phone, Email) ".
                     "values ('$InstructorID', '$UserID', '$FName', '$LName', '$Phone', '$Email')";
		$SQLstring2 = "insert into login (UserID, Username, Password, Roles) ".
                      "values ('$UserID', '$Username', '$StorePW', '$Roles')";
        
        if (mysqli_query($conn, $SQLstring) &&
            mysqli_query($conn, $SQLstring2)) { 
            echo "Successful Instructor insertion.";
            header("Location: adminHome.php?page=instructorList");
        }
        else { 
            echo "Error with: ".$SQLstring."<br />".$conn->error.".";
            echo "Error with: ".$SQLstring2."<br />".$conn->error."."; 
        }
        /*if (mysqli_query($conn, $SQLstring2)) { 
            echo "Successful Login insertion";
        }
        else {
            echo "Error with: ".$SQLstring2."<br />".$conn->error."."; 
        }*/

        
	}

?>

<!--<html>
    <head>
        <title>Add Instructor</title>
        <meta charset="utf-8" />
        <link rel="stylesheet" type="text/css" href="../Styles/styles.css" />
    </head>
    
    <body>
        <div id="main">
            <nav id="adminNav">
                    <?php //include("adminIncludes/adminNav.php"); ?>
            </nav>
            
            <h3 class="addPageTitle">Instructor Added</h3>
            
            <p>Details for '<?php //echo $FName . " " . $LName; ?>' have been successfully inserted and saved.
        </div>
    </body>
</html>-->