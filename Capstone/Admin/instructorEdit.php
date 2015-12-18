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

    $con = include("dbConnect.php");
    
    
	$TableName = "instructor";
    //global $ClassID;  //why do I need to use global variables here?
    global $FName;
    global $LName;
    global $Email;
    global $Phone;
    //global $Role;
	
	if ($errors == 0) {
		$SQLstring = "select * from instructor where InstructorID = '" . $_REQUEST['pid'] . "'"; 
		$QueryResult = mysqli_query($conn, $SQLstring);
		
		if (mysqli_num_rows($QueryResult) > 0) {
			while ($Row = mysqli_fetch_assoc($QueryResult)) {
			
				$InstructorID = $Row['InstructorID'];
                $UserID = $Row['UserID'];
                //$ClassID = $Row['ClassID'];
				$FName = $Row['FName'];
				$LName = $Row['LName'];
				$Email = $Row['Email'];
                $Phone = $Row['Phone'];
				//$Role = $Row['Roles'];
			}
			//mysqli_free_result($QueryResult);
		}
        else {
            echo "something went wrong with the selection query...";
        }
	}
    
    $TableName3 = "role";
	
	if ($errors == 0) {
		$Roless = array();
		$SQLstring3 = "select * from $TableName3"; 
		$QueryResult3 = mysqli_query($conn, $SQLstring3);
		
		if (mysqli_num_rows($QueryResult3) > 0) {
			while ($Row3 = mysqli_fetch_assoc($QueryResult3)) {
				$Roless[] = $Row3['Role'];
			}
			//mysqli_free_result($QueryResult3);
		}
        else {
            echo "something went wrong with generating the role dropdown menu...";
        }
	}

?>

<html>
    
    <head>
        <title>Edit Instructor</title>
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
            
            <h3 class="addPageTitle">Edit Instructor</h3>
            
            <form action="instructorUpdate.php" method="post">
                
                <!--hidden pregenerated Student and UserIDs that will be inserted into the respective tables.  ideally, these numbers will be identical-->
                <input type="hidden" name="InstructorID" message="See list for numbers in use" value="<?php echo $InstructorID; ?>">
                <input type="hidden" name="UserID" message="See list for numbers in use" value="<?php echo $UserID; ?>">
                
                <!--<div class="addColumnBox">
                    <span class="addColumnName">Class ID</span><br />
                    <input type="text" name="ClassID" value="<?php //echo $ClassID; ?>" message="Please enter a class ID (see the class list for ID numbers)" required="yes" size="3" maxlength="1">
                </div>-->
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
                    <span class="addColumnName">Phone</span>
                    <input type="text" name="Phone" value="<?php echo $Phone; ?>" message="Please enter a phone number" required="yes" size="20" maxlength="50">
                </div>
                <div class="addColumnBox">
                    <span class="addColumnName">Role: </span>
                    <span>Instructor</span>
                    <!-- restricts the role option to three specific choices to simplifiy database and organization-->
                    <!--<select name="Roles">
                        <?php 
                            /*foreach ($Roless as $Roles) {
                                echo "<option value='$Roles'>$Roles</option>"; // <--2nd $Role singular to test and see if it uses the saved value in the database
                            }*/
                        ?>
                    </select>-->
                </div>
                <input type="submit" name="editInstructor" value="Save Edits">
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