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
    
    $Username = $_POST['Username'];
    $PasswordEnter = $_POST['Password'];
    $Roles = $_POST['Roles'];
    
    $StorePW = password_hash($PasswordEnter, PASSWORD_BCRYPT);
    
    $TableName = "login";
	$SQLstring = "update $TableName " . 
					"set Username = '" . $Username . "'," . 
						"Password = '" . $StorePW . "'," .
						"Roles = '" . $Roles . "' " . 
						"where UserID = '" . $_REQUEST['UserID'] . "'";
	//$QueryResult = mysqli_query($SQLstring, $con);
	//echo $QueryResult;
	if (mysqli_query($conn, $SQLstring)) {
        echo "Successful user update.";
    }
    else {                                                    
        echo "Error: ".$SQLstring."<br />".$conn->error.".";
    }   
    /*    
	if ($QueryResult === false) {
		echo "<p>Unable to save your user update information.  Error code " . mysql_errno() . ": " . mysql_error() . "</p>\n";
		++$errors;
	}
	//else {
	//	$UserID = mysql_insert_id($DBConnect);
	//	$_SESSION['UserID'] = mysql_insert_id($DBConnect);
	//}
	*/
	$SQLstring1 = "select Username from $TableName"; 
	$QueryResult1 = mysqli_query($conn, $SQLstring1);
    if (mysqli_num_rows($QueryResult1) > 0) {
        while ($Row = mysqli_fetch_assoc($QueryResult1)) {
            $Username = $Row['Username'];
        }
        echo "Successful update";
        header("Location: adminHome.php?page=loginList");
        //mysqli_free_result($QueryResult1);
    }
    else {
        echo "No results were found.";
    }

?>

<!--<html>
    <head>
        <title>Login Update</title>
        <meta charset="utf-8" />
        <link rel="stylesheet" type="text/css" href="../Styles/styles.css" />
    </head>
    
    <body>
        <div id="main">
            <nav id="adminNav">
                    <?php //include("adminIncludes/adminNav.php"); ?>
            </nav>
            
            <h3 class="addPageTitle">Student Info Updated</h3>
            
            <p>Details for <?php //echo $Username; ?> have been successfully inserted and saved.
        </div>
    </body>
</html>-->