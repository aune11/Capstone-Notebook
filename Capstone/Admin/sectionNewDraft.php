<?php
	
	session_start();
    if(isset($_SESSION['UserID'])) {
        include("adminCheck.php");
    }
    else {
        header("Location: loginForm.php");
    }

	$errors = 0;
	include("dbConnect.php"); //USE $conn, NOT $con!!
	
    //each query here selects the highest number+1 to set an ID
	//print $errors . "first area errors";
	if ($errors == 0) {
		$SQLstring = "select max(ClassID) + 1 as NewNumber from section";  
        $QueryResult = mysqli_query($conn, $SQLstring);//$con->query($SQLstring);

        if (mysqli_num_rows($QueryResult) > 0) {
            while($Row = mysqli_fetch_assoc($QueryResult)) {
                echo "<br />New highest ClassID selected.";
            }
        }
        else {
            echo "Error: ".$SQLstring."<br />".$conn->error;
        }        
	}
    
    //sets the ID column numbers
	if (isset($QueryResult)) { 
		if ($errors == 0) {
			$Row = mysqli_fetch_assoc($QueryResult);
			$ClassID = $Row['NewNumber'];
		}
	}
	else {
		print "Something went wrong for ClassID...";
	}
    
    if ($errors == 0) {
		$Instructors = array();
        $GetInst = $conn->query("select FName, LName from instructor");
		//$SQLstring4 = "select * from $TableName4"; 
		//$QueryResult4 = mysqli_query($conn, $SQLstring4);
		
		if (mysqli_num_rows($GetInst) > 0) {
			while ($Row = mysqli_fetch_assoc($GetInst)) {
				$FName[] = $Row['FName'];
                $LName[] = $Row['LName'];
			}
			//mysqli_free_result($QueryResult4);
		}
        else {
            echo "Something went wrong for generating the instructors...";
        }
	}
    
?>

<!--<html>
    
    <head>
        <title>Add Student</title>
        <meta charset="utf-8" />
        <link rel="stylesheet" type="text/css" href="../Styles/styles.css" />
    </head>
    
    <body>
        <div id="main">-->
        <h3 class="addPageTitle">Add New Class</h3>
        
        <form action="studentInsert.php" method="post">
            
            <!--hidden pregenerated Student and UserIDs that will be inserted into the respective tables.  ideally, these numbers will be identical-->
            <input type="hidden" name="ClassID" message="See list for numbers in use" value="<?php echo $ClassID; ?>">
            
            <!--<div class="addColumnBox">
                <span class="addColumnName">Instructor</span><br />
                <?php 
                    /*foreach ($Instructors as $Instructor) {
                        echo "<option value='$Instructor'>".$FName." ".$LName."</option>"; //$Instructor
                    }*/
                ?>
            </div>-->
            <div class="addColumnBox">
                <span class="addColumnName">Class Name</span><br />
                <input type="text" name="ClassName" message="Please enter a first name" required="yes" size="20" maxlength="30">
            </div>
            <div class="addColumnBox">
                <span class="addColumnName">Days</span><br />
                <input type="text" name="Days" message="Please enter a last name" required="yes" size="20" maxlength="30">
            </div>
            <div class="addColumnBox">
                <span class="addColumnName">Time</span><br />
                <input type="text" name="Time" message="Please enter an email" required="yes" size="20" maxlength="50">
            </div>
            <div class="addColumnBox">
                <span class="addColumnName">Term</span><br />
                <input type="text" name="Term" message="Please enter an email" required="yes" size="20" maxlength="50">
            </div>
            <div class="addColumnBox">
                <span class="addColumnName">Year</span><br />
                <input type="text" name="Year" message="Please enter an email" required="yes" size="20" maxlength="50">
            </div>


            <div class="addColumnBox">
                <span class="addColumnName">Role</span><br />
                <!-- restricts the role option to three specific choices to simplifiy database and organization-->
                <select name="Roles">
                    <?php 
                        foreach ($Roless as $Roles) {
                            echo "<option value='$Roles'>$Roles</option>";
                        }
                    ?>
                </select>
            </div>

            
            <div style="clear: both"></div>
            <input type="submit" name="addStudent" value="Add Student">
        </form>
        </div>
    <!--</body>
    
</html>-->