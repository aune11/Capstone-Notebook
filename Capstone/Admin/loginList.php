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
    
    $TableName = "login";
	$Table2 = "student"; //will eventually have student and instructor names tied to logins, but for now, just getting it to work
    $Table3 = "instructor";
    
	if ($errors == 0) {
		$Users = array();
		$SQLstring = "select t1.UserID, t1.Username, t1.Password, t1.Roles, t2.FName, t2.LName, t3.FName, t3.LName from $TableName t1 join $Table2 t2 on t2.UserID = t1.UserID join $Table3 t3 on t3.UserID = t1.UserID"; 
		$QueryResult = mysqli_query($SQLstring, $con);
		
		if (mysqli_num_rows($QueryResult) > 0) {
			while (($Row = mysqli_fetch_assoc($QueryResult)) !== FALSE) {
				$Users[] = $Row;
			}
			//mysqli_free_result($QueryResult);
		}
        else {
            echo "No results were found.";
        }
	}
    
?>

<!--html>
    
    <head>
        <title>Student List</title>
        <meta charset="utf-8" />
        <link rel="stylesheet" type="text/css" href="../Styles/styles.css" />
    </head>
    
    <body>
        
        <div id="main">
            <div>
                <?php //include("adminNav.php"); ?>
            </div>-->
            
            <section class="studentList">
                <table>
                    <tr>
						<td class="listTitle">Students</td>
					</tr>
					<tr>
                        <td>UserID</td>
						<td>Username</td>
						<td>Password</td>
						<td>Role</td>
					</tr>
                    <tr>
                        <?php
                            foreach ($Users as $User) {
                                echo "<tr>\n";
                                echo "  <td>" . htmlentities($User['UserID']) . "</td>\n";
                                echo "  <td>" . htmlentities($User['FName']) . "</td>\n";
                                echo "  <td>" . htmlentities($User['LName']) . "</td>\n";
                                echo "  <td>" . htmlentities($User['Username']) . "</td>\n";
                                echo "  <td>" . htmlentities($User['Password']) . "</td>\n";
                                echo "  <td>" . htmlentities($User['Roles']) . "</td>\n";
                                echo "  <td><A HREF='loginEdit.php?pid=" . htmlentities($User['UserID']) . "'>Edit</A></td>\n";
                                //leaving the Edit/Delete buttons out for now, since user data is deleted along with accound deletion; makes it easier to manage
                                //echo "  <td><A HREF='studentDelete.php?pid=" . htmlentities($student['StudentID']) . "' class='deleteLink'>Delete</A></td>\n";
                                echo "</tr>\n";
                            }
                        ?>	
                    </tr>
                </table>
            </section>
        <!--</div>
        
    </body>

</html>-->