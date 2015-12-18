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
	include("dbConnect.php"); //USE $conn, NOT $con!!
	
    //each query here selects the highest number+1 to set an ID
	if ($errors == 0) {
		$SQLstring = "select max(StudentID) + 1 as NewNumber from student;";  
        $QueryResult = mysqli_query($conn, $SQLstring);//$con->query($SQLstring);

        if (mysqli_num_rows($QueryResult) > 0) {
            while($Row = mysqli_fetch_assoc($QueryResult)) {
                echo "<br />New highest StudentID selected.";
                if (isset($QueryResult)) { 
                    if ($errors == 0) {
                        $StudentID = $Row['NewNumber'];
                    }
                }
                else {
                    print "something went wrong for student...";
                }
                echo $StudentID;
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
    
    if ($errors == 0) {
		$Classes = array();
        $GetClass = $conn->query("select sec.SectionID, sec.ClassID, sec.SectionNum, sec.Days, sec.Time, cla.ClassID, cla.Name from section sec ".
                                 "join class cla on cla.ClassID = sec.ClassID");
		
		if (mysqli_num_rows($GetClass) > 0) {
			while ($Row = mysqli_fetch_assoc($GetClass)) {
				//$FName[] = $Row['FName'];
                //$LName[] = $Row['LName'];
                $Classes[] = $Row;
			}
			//mysqli_free_result($QueryResult4);
		}
        else {
            echo "Something went wrong for generating the classes...";
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
        <h3 class="addPageTitle">Add New Student</h3>
        
        <form action="studentInsert.php" method="post">
            
            <!--hidden pregenerated Student and UserIDs that will be inserted into the respective tables.  ideally, these numbers will be identical-->
            <input type="hidden" name="StudentID" message="See list for numbers in use" value="<?php echo $StudentID; ?>">
            <input type="hidden" name="UserID" message="See list for numbers in use" value="<?php echo $UserID; ?>">
            <!--<input type="hidden" name="IPadID" message="See list for numbers in use" value="<?php //echo $IPadID; ?>">-->
            
            <div class="addColumnBox">
                <span class="addColumnName">Class and Section</span><br />
                <!--<input type="text" name="ClassID" message="Please enter a class ID (see the class list for ID numbers)" required="yes" size="3" maxlength="1">-->
                <select name="ClassID">
                    <?php 
                        foreach ($Classes as $Class) {
                            echo "<option value='".$Class['ClassID']."'>".$Class['Name']." ".$Class['SectionNum']." ".$Class['Days']." ".$Class['Time']."</option>";
                        }
                    ?>
                </select>
            </div>
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
                <br /><span class="addColumnName">Role: Student</span><br /><br />
                <input type="hidden" name="Roles" message="See list for numbers in use" value="Student">
            </div>
            <div class="addColumnBox">
                <span class="addColumnName">Username</span><br />
                <input type="text" name="Username" message="Please enter a username" required="yes" size="20" maxlength="50">
            </div>
            <div class="addColumnBox">
                <span class="addColumnName">Password</span><br />
                <input type="text" name="Password" message="Please enter a password" required="yes" size="20" maxlength="50">
            </div>
            
            <div style="clear: both"></div>
            <input type="submit" name="addStudent" value="Add Student">
        </form>
        <!--</div>
    <!--</body>
    
</html>-->