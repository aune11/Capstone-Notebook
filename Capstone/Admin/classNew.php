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

	$errors = 0;
	include("dbConnect.php"); //USE $conn, NOT $con!!
    
    //each query here selects the highest number+1 to set an ID
	//print $errors . "first area errors";
	if ($errors == 0) {
		$SQLstring = "select max(ClassID) + 1 as NewNumber from class";  
        $QueryResult = mysqli_query($conn, $SQLstring);//$con->query($SQLstring);

        if (mysqli_num_rows($QueryResult) > 0) {
            while($Row = mysqli_fetch_assoc($QueryResult)) {
                echo "<br />New highest ClassID selected.";
                if (isset($QueryResult)) { 
                    if ($errors == 0) {
                        //$Row = mysqli_fetch_assoc($QueryResult);
                        $ClassID = $Row['NewNumber'];
                    }
                }
                else {
                    print "Something went wrong for ClassID...";
                }
            }
        }
        else {
            echo "Error: ".$SQLstring."<br />".$conn->error;
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
        <?php echo "new classID is ".$ClassID; ?>
        <form action="classInsert.php" method="post">
            
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
                <input type="text" name="Name" message="Please enter a class name" required="yes" size="20" maxlength="30">
            </div>

            
            <div style="clear: both"></div>
            <input type="submit" name="addStudent" value="Add Class">
        </form>
        <!--</div>
    <!--</body>
    
</html>-->