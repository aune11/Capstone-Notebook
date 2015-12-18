<?php

    session_start();
    if(isset($_SESSION['UserID'])) {
    }
    else {
        header("Location: loginForm.php");
    }

?>

<!DOCTYPE html>

<html>
    <head>
        <title>Verify Login</title>
    </head>
    
    <body>
	
        <h2>Verify Login</h2>
        
        <?php
        
            $errors = 0;
            $DBConnect = include('dbConnect.php');
                
            if ($DBConnect === false) {
                echo "<p>Unable to connect to database server.  Error code " . mysql_errno() . ": " . mysql_error() . "</p>\n";
                ++$errors;
            }
            else {
                $DBName = "notebook";
                $result = @mysql_select_db($DBName, $DBConnect);
                
                if ($result === false) {
                    echo "<p>Unable to connect to database server.  Error code " . mysql_errno() . ": " . mysql_error() . "</p>\n";
                    ++$errors;
                }
            }
            
            $TableName = "login";
            
            if ($errors == 0) {
                $SQLstring = "select * from $TableName where Username = '" . $_POST['username'] . "' and Password = '" . $_POST['password'] . "'";
                $QueryResult = @mysql_query($SQLstring, $DBConnect);
                
                if (mysql_num_rows($QueryResult) == 0) {
                    echo "<p>The username/password combination entered is not valid.</p>\n";
                    ++$errors;
                }
                else {
                    $Row = mysql_fetch_assoc($QueryResult);
                    $_SESSION['UserID'] = $Row['UserID'];
					$_SESSION['Roles'] = $Row['Roles'];
                    $UserName = $Row['Fname'] . " " . $Row['LName'];
                    echo "<p>Welcome back, $UserName</p>\n";
                }
            }

            if ($errors > 0) {
                echo "<p>Please use the back button to return to the form to fix the indicated errors.,/p>\n";
            }
            
            if ($errors == 0) {
                
                if ($Row['Roles'] == "Instructor" || $Row['Roles'] == "Admin") { 
                    header('Location: http://localhost:8080/Captsone/Admin/adminHome.php');
                }
                else {
                    header('Location: http://localhost:8080/Captsone/home.php');
                }
				//header('Location: http://localhost:8080/Captsone/Admin/adminHome.php'); //<-- this will eventually be removed
            }
        
        ?>
    
    </body>
</html>