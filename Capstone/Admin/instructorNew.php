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
	
    //each query here selects the highest number+1 to set an ID

	if ($errors == 0) {
		$SQLstring = "select max(InstructorID) + 1 as NewNumber from instructor;"; 
		$QueryResult = mysqli_query($conn, $SQLstring);

        if (mysqli_num_rows($QueryResult) > 0) {
            while($Row = mysqli_fetch_assoc($QueryResult)) {
                echo "<br />New highest InstructorID selected.";
                if (isset($QueryResult)) { 
                    if ($errors == 0) {
                        $InstructorID = $Row['NewNumber'];
                    }
                }
                else {
                    print "something went wrong for instructor...";
                }
                echo $InstructorID;
            }
        }
        else {
            echo "Error: ".$SQLstring."<br />".$conn->error;
        }
	}

	if ($errors == 0) {
		$SQLstring2 = "select max(UserID) + 1 as NewUser from login"; 
		$QueryResult2 = mysqli_query($conn, $SQLstring2);
        
        if (mysqli_num_rows($QueryResult2) > 0) {
            while($Row2 = mysqli_fetch_assoc($QueryResult2)) {
                echo "<br />New highest UserID selected.";
                if (isset($QueryResult2)) { 
                    if ($errors == 0) {
                        $UserID = $Row2['NewUser'];
                    }
                }
                else {
                    print "something went wrong for login...";
                }
                echo $UserID;
            }
        }
        else {
            echo "Error: ".$SQLstring2."<br />".$conn->error;
        }
	}
   
    //used to select the Role table for the Roles dropdown menu    	
	if ($errors == 0) {
		$Roless = array();
		$SQLstring4 = "select * from role"; 
		$QueryResult4 = mysqli_query($conn, $SQLstring4);
		
		if (mysqli_num_rows($QueryResult4) > 0) {
			while ($Row4 = mysqli_fetch_assoc($QueryResult4)) {
				$Roless[] = $Row4['Role'];
			}
			
			mysqli_free_result($QueryResult4);
		}
        else {
            echo "something went wrong for generating the role dropdown menu...";
        }
	}
	
?>

<!--<html>
    
    <head>
        <title>Add Instructor</title>
        <meta charset="utf-8" />
        <link rel="stylesheet" type="text/css" href="../Styles/styles.css" />
    </head>
    
    <body>
        <div id="main">-->
        <h3 class="addPageTitle">Add New Instructor</h3>
        
        <form action="instructorInsert.php" method="post">
            
            <!--hidden pregenerated Student and UserIDs that will be inserted into the respective tables.  ideally, these numbers will be identical-->
            <input type="hidden" name="InstructorID" message="See list for numbers in use" value="<?php echo $InstructorID; ?>">
            <input type="hidden" name="UserID" message="See list for numbers in use" value="<?php echo $UserID; ?>">
            
            <!--<div class="addColumnBox">
                <span class="addColumnName">Class ID</span><br />
                <input type="text" name="ClassID" message="Please enter a class ID (see the class list for ID numbers)" required="yes" size="3" maxlength="1">
            </div>-->
            <div class="addColumnBox">
                <span class="addColumnName">First Name</span><br />
                <input type="text" name="FName" message="Please enter a first name" required="yes" size="20" maxlength="30">
            </div>
            <div class="addColumnBox">
                <span class="addColumnName">Last Name</span><br />
                <input type="text" name="LName" message="Please enter a last name" required="yes" size="20" maxlength="30">
            </div>
            <div class="addColumnBox">
                <span class="addColumnName">Email</span><br />
                <input type="text" name="Email" message="Please enter an email" required="yes" size="20" maxlength="50">
            </div>
            <div class="addColumnBox">
                <span class="addColumnName">Phone</span><br />
                <input type="text" name="Phone" message="Please enter a phone number" required="yes" size="20" maxlength="50">
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
            <div class="addColumnBox">
                <span class="addColumnName">Username</span><br />
                <input type="text" name="Username" message="Please enter a username" required="yes" size="20" maxlength="50">
            </div>
            <div class="addColumnBox">
                <span class="addColumnName">Password</span><br />
                <input type="password" name="Password" message="Please enter a password" required="yes" size="20" maxlength="50">
            </div>
            
            <div style="clear: both"></div>
            <input type="submit" name="addInstructor" value="Add Instructor">
        </form>
        <!--</div>
    </body>
    
</html>-->