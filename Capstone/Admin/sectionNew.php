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
		$SQLstring = "select max(SectionID) + 1 as NewNumber from section";  
        $QueryResult = $conn->query($SQLstring);//$con->query($SQLstring);

        if (mysqli_num_rows($QueryResult) > 0) {
            while($Row = mysqli_fetch_assoc($QueryResult)) {
                echo "<br />New highest SectionID selected.";
                if (isset($QueryResult)) { 
                    if ($errors == 0) {
                        //$Row = mysqli_fetch_assoc($QueryResult);
                        $SectionID = $Row['NewNumber'];
                    }
                }
                else {
                    print "Something went wrong for SectionID...";
                }
            }
        }
        else {
            echo "Error: ".$SQLstring."<br />".$conn->error;
        }        
	}
    
    if ($errors == 0) {
		$Instructors = array();
        $GetInst = $conn->query("select InstructorID, FName, LName from instructor");
		
		if (mysqli_num_rows($GetInst) > 0) {
			while ($Row = mysqli_fetch_assoc($GetInst)) {
				//$FName[] = $Row['FName'];
                //$LName[] = $Row['LName'];
                $Instructors[] = $Row;
			}
			//mysqli_free_result($QueryResult4);
		}
        else {
            echo "Something went wrong for generating the instructors...";
        }
	}
    
    if ($errors == 0) {
		$Classes = array();
        $GetClass = $conn->query("select * from class");
		
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
        <h3 class="addPageTitle">Add New Section</h3>
        
        <form action="sectionInsert.php" method="post">
            
            <!--hidden pregenerated Student and UserIDs that will be inserted into the respective tables.  ideally, these numbers will be identical-->
            <input type="hidden" name="SectionID" message="See list for numbers in use" value="<?php echo $SectionID; ?>">
            
            <!--<div class="addColumnBox">
                <span class="addColumnName">Instructor</span><br />
                <?php 
                    /*foreach ($Instructors as $Instructor) {
                        echo "<option value='$Instructor'>".$FName." ".$LName."</option>"; //$Instructor
                    }*/
                ?>
            </div>-->
            <div class="addColumnBox">
                <span class="addColumnName">Class Name</span>
                <select name="ClassID">
                    <?php 
                        foreach ($Classes as $Class) {
                            echo "<option value='".$Class['ClassID']."'>".$Class['Name']."</option>";
                        }
                    ?>
                </select>
            </div><br />
            <div class="addColumnBox">
                <span class="addColumnName">Section Number</span>
                <!--<input type="text" name="ClassName" message="Please enter a name" required="yes" size="20" maxlength="30">-->
                <input type="text" name="SectionNum" message="Please enter the section number" required="yes" size="2" maxlength="1">
            </div><br />
            <div class="addColumnBox">
                <span class="addColumnName">Days</span>
                <input type="text" name="Days" message="Please enter the days" required="yes" size="20" maxlength="30">
            </div><br />
            <div class="addColumnBox">
                <span class="addColumnName">Time</span>
                <input type="text" name="Time" message="Please enter the class time" required="yes" size="20" maxlength="50">
            </div><br />
            <div class="addColumnBox">
                <span class="addColumnName">Instructor</span>
                <select name="InstructorID">
                    <?php 
                        foreach ($Instructors as $Instructor) {
                            echo "<option value='".$Instructor['InstructorID']."'>".$Instructor['FName']." ".$Instructor['LName']."</option>";
                        }
                    ?>
                </select>
                <!--<select name="InstructorID">
                    <?php /*$the_key = 1;
                        foreach ($Instructors as $val) {
                            echo "<option value='".$val['InstructorID']."'>".$val['InstructorID']."".$val['FName']." ".$val['LName']."</option>";
                            
                            if ($val['InstructorID']==$the_key) {
                                echo ' selected="selected"';
                            }
                             echo $val['InstructorID']; ?></option><?php
                        }*/
                    ?>
                </select>-->
            </div><br />
            <div style="clear: both"></div>
            <input type="submit" name="addStudent" value="Add Section">
        </form>
        <!--</div>
    <!--</body>
    
</html>-->
    
    
    
