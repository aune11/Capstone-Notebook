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

	//if ($errors == 0) {
        //$TableName = "student";
		$students = array();
		$SQLstring = "select * from student"; 
		$QueryResult = mysqli_query($conn, $SQLstring);
		
		if (mysqli_num_rows($QueryResult) > 0) {
			while ($Row = mysqli_fetch_assoc($QueryResult)) {
				$students[] = $Row;
			}
			//mysql_free_result($QueryResult); is this even required?
		}
        else {
            echo "No results were found.";
        }
	//}
	
?>

<!--<html>
    
    <head>
        <title>Student List</title>
        <meta charset="utf-8" />
        <link rel="stylesheet" type="text/css" href="../Styles/styles.css" />
    </head>
    
    <body>
        
        <div id="main">
            <!--<div>
                <?php //include("adminIncludes/adminNav.php"); ?>
            </div>-->
            
            <section class="studentList">
                <table>
                    <tr>
						<td class="listTitle">Students</td>
					</tr>
					<tr>
                        <td>StudentID</td>
						<td>UserID</td>
						<td>ClassID</td>
						<td>First Name</td>
						<td>Last Name</td>
						<td>Email</td>
					</tr>
                    <tr>
                        <?php
                            foreach ($students as $student) {
                                echo "<tr>\n";
                                echo "  <td>" . htmlentities($student['StudentID']) . "</td>\n";
                                echo "  <td>" . htmlentities($student['UserID']) . "</td>\n";
                                echo "  <td>" . htmlentities($student['ClassID']) . "</td>\n";
                                echo "  <td>" . htmlentities($student['FName']) . "</td>\n";
                                echo "  <td>" . htmlentities($student['LName']) . "</td>\n";
                                echo "  <td>" . htmlentities($student['Email']) . "</td>\n";
                                echo "  <td><A HREF='studentEdit.php?pid=" . htmlentities($student['StudentID']) . "'>Edit</A></td>\n";
                                echo "  <td><A HREF='studentDelete.php?pid=" . htmlentities($student['StudentID']) . "'>Delete</A></td>\n";
                                echo "</tr>\n";
                            }
                        ?>	
                    </tr>
                </table>
            </section>
        <!--</div>-->
        
    <!--</body>

</html>-->

<!-- Use this script to have a popup box confirm if the user wants to delete a student, and inform them of the consequences of doing so -->
<script>
    $('.deleteLink').on('click', function(e) {
        function deletion() {
            var txt;
            var r = confirm("WARNING!  By confirming this action, you are deleting ALL of the saved information for this student, " +
                "including account login, posts, iPad info, etc.  Are you sure you want to continue?"); 
            if (r == true) {
                header('Location: http://localhost:8080/Captsone/Admin/studentDelete.php');  //is this even the correct syntax??
            } else {
            }
        }
    });
</script>