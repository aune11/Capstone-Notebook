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
    
    global $ClassID;  //why do I need to use global variables here?
    global $SectionID;
    global $FName;
    global $LName;
    global $Email;
    //global $Role;
	
	if ($errors == 0) {
        //for some reason, the query breaks if I try to put it on multiple lines, even with proper " . "
		$SQLstring = "select * from student where StudentID = '" . $_REQUEST['pid'] . "'";//"select * from $TableName t1 join $Table2 t2 on t2.StudentID = t1.StudentID where t1.StudentID = '" . $_REQUEST['pid'] . "' and t2.StudentID = '" . $_REQUEST['pid'] . "'"; 
		$QueryResult = mysqli_query($conn, $SQLstring);// or trigger_error("Query failed; SQL: $SQLstring - Error: ".mysqli_error($SQLstring), E_USER_ERROR); //the "or trigger_error...added on
		
		if (mysqli_num_rows($QueryResult) > 0) {
            //echo "SOMETHING FROM FIRST QUERY!!"; //shows up...
			while ($Row = mysqli_fetch_assoc($QueryResult)) {
			
				$StudentID = $Row['StudentID'];
                $UserID = $Row['UserID'];
                $ClassID = $Row['ClassID'];
                $SectionID = $Row['SectionID'];
				$FName = $Row['FName'];
				$LName = $Row['LName'];
				$Email = $Row['Email'];
                //$IPad = $Row['IPadNum'];
				//$Role = $Row['Role'];
			}
			//mysqli_free_result($QueryResult);
		}
        else {
            echo "something went wrong with the selection query...";
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

<html>
    
    <head>
        <title>Edit Student</title>
        <meta charset="utf-8" />
        <link rel="stylesheet" type="text/css" href="../Styles/styles.css" />
    </head>
    
    <body>
        <div id="main">
            
            <!-- top of the page, class heading, navigation dropdown menu, and Next/Previous page buttons will go here -->
            <header id="top">
                <?php include("../includes/header.php"); ?>
            </header>
            
            <!--<div>-->
            <nav id="adminNav">
                <span><a href="logout.php">LOGOUT</a></span>
                <?php include("adminIncludes/adminNav.php"); ?>
            </nav>
            
            <h3 class="addPageTitle">Edit Student</h3>
            
            <form action="studentUpdate.php" method="post">
                
                <!--hidden pregenerated Student and UserIDs that will be inserted into the respective tables.  ideally, these numbers will be identical-->
                <input type="hidden" name="StudentID" message="See list for numbers in use" value="<?php echo $StudentID; ?>">
                <input type="hidden" name="UserID" message="See list for numbers in use" value="<?php echo $UserID; ?>">
                
                <div class="addColumnBox">
                    <span class="addColumnName">Class and Section</span>
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
                    <span class="addColumnName">First Name</span>
                    <input type="text" name="FName" value="<?php echo $FName; ?>" message="Please enter a first name" required="yes" size="20" maxlength="30">
                </div>
                <div class="addColumnBox">
                    <span class="addColumnName">Last Name</span>
                    <input type="text" name="LName" value="<?php echo $LName; ?>" message="Please enter a last name" required="yes" size="20" maxlength="30">
                </div>
                <div class="addColumnBox">
                    <span class="addColumnName">Email</span>
                    <input type="text" name="Email" value="<?php echo $Email; ?>" message="Please enter an email" required="yes" size="20" maxlength="50">
                </div>
                <div class="addColumnBox">
                    <span class="addColumnName">Role: Student</span><br />
                    <input type="hidden" name="Roles" message="See list for numbers in use" value="Student">
                </div>
                <input type="submit" name="editStudent" value="Save Edits">                
            </form>
            <div style="clear: both"></div>
            <!--</div>-->
            
            <!-- copyright and school info/contact will go here -->
            <footer id="bottom">
                <?php include("../includes/footer.php"); ?>
            </footer>
        </div>
    </body>
    
</html>