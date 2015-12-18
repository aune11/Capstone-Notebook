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
    
    $TableName = "login";
    $Table2 = "student";
    $Table3 = "instructor";
	
	if ($errors == 0) {
		//$Info = array();
		$SQLstring = "select t1.UserID, t1.Username, t1.Password, t1.Roles, t2.FName, t2.LName, t3.FName, t3.LName from $TableName t1 ".
                            "join $Table2 t2 on t2.UserID = t1.UserID ".
                            "join $Table3 t3 on t3.UserID = t1.UserID ".
                            "where UserID = '" . $_REQUEST['pid'] . "'";
        //"select * from $TableName where UserID = '" . $_REQUEST['pid'] . "'"; 
		$QueryResult = mysqli_query($conn, $SQLstring);
		
		if (mysqli_num_rows($QueryResult) > 0) {
			while ($Row = mysqli_fetch_assoc($QueryResult)) {
			
				$UserID = $Row['UserID'];
                $FName = $Row['FName'];
                $LName = $Row['LName'];
				$Username = $Row['Username'];
				$Password = $Row['Password'];
				$Role = $Row['Roles'];
			}
			
			mysqli_free_result($QueryResult);
		}
        else {
            echo "something went wrong with the selection query...";
        }
	}
    
    $Table2 = "role";

        if ($errors == 0) {
            $Roless = array();
            $SQLstring2 = "select * from $Table2"; 
            $QueryResult2 = mysqli_query($SQLstring2, $con);
            
            if (mysqli_num_rows($QueryResult2) > 0) {
                while ($Row2 = mysqli_fetch_assoc($QueryResult2)) {
                    $Roless[] = $Row2['Role'];
                }
                
                mysqli_free_result($QueryResult2);
            }
            else {
                echo "something went wrong for generating the role dropdown menu...";
            }
        }
    
	//echo $Roles;

?>

<!--<html>
    
    <head>
        <title>Edit Login Info</title>
        <meta charset="utf-8" />
        <link rel="stylesheet" type="text/css" href="../Styles/styles.css" />
    </head>
    
    <body>
        <div id="main">-->
        <h3 class="addPageTitle">Edit User Data</h3>
        
        <form action="loginUpdate.php" method="post">
            
            <!--hidden pregenerated Student and UserIDs that will be inserted into the respective tables.  ideally, these numbers will be identical-->
            <input type="hidden" name="UserID" message="See list for numbers in use" value="<?php echo $UserID; ?>">
            
            <?php
                echo "Edit login for ".$FName." ".$LName.":";
            ?>
            
            <div class="addColumnBox">
                <span class="addColumnName">Username</span><br />
                <input type="text" name="Username" value="<?php echo $Username; ?>" message="Please enter a class ID (see the class list for ID numbers)" required="yes" size="3" maxlength="1">
            </div>
            <div class="addColumnBox">
                <span class="addColumnName">Password</span><br />
                <input type="text" name="Password" value="<?php echo $Password; ?>" message="Please enter a first name" required="yes" size="20" maxlength="30">
            </div>
            <div class="addColumnBox">
                <span class="addColumnName">Role</span><br />
                <!-- restricts the role option to three specific choices to simplifiy database and organization-->
                <select name="Roles">
                    <?php 
                        foreach ($Roless as $Roles) {
                            echo "<option value='$Roles'>$Role</option>"; // <--2nd $Role singular to test and see if it uses the saved value in the database
                        }
                    ?>
                </select>
            </div>
            
            <div style="clear: both"></div>
            <input type="submit" name="editLogin" value="Save Edits">
        </form>
        <!--</div>
    </body>
    
</html>-->