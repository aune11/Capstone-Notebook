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
	include("dbConnect.php");

	$TableName = "instructor";
	
	if ($errors == 0) {
		$instructors = array();
		$SQLstring = "select * from $TableName"; 
		$QueryResult = mysqli_query($conn, $SQLstring);
		
		if (mysqli_num_rows($QueryResult) > 0) {
			while ($Row = mysqli_fetch_assoc($QueryResult)) {
				$instructors[] = $Row;
			}
			
			//mysql_free_result($QueryResult);
		} else {
            echo "No results were found";
        }
    }
?>

<html>
    
    <head>
        <title>Instructor List</title>
        <meta charset="utf-8" />
        <link rel="stylesheet" type="text/css" href="../Styles/styles.css" />
    </head>
    
    <body>
        
        <!--<div id="main">
            <div>
                <?php //include("adminNav.php"); ?>
            </div>-->
            
            <section class="studentList">
                <table>
                    <tr>
						<td class="listTitle">Instructors</td>
					</tr>
					<tr>
                        <td>InstructorID</td>
						<td>UserID</td>
						<!--<td>ClassID</td>-->
						<td>First Name</td>
						<td>Last Name</td>
                        <td>Phone</td>
						<td>Email</td>
					</tr>
                    <tr>
                        <?php
                            foreach ($instructors as $instructor) {
                                echo "<tr>\n";
                                echo "  <td>" . htmlentities($instructor['InstructorID']) . "</td>\n";
                                echo "  <td>" . htmlentities($instructor['UserID']) . "</td>\n";
                                echo "  <td>" . htmlentities($instructor['FName']) . "</td>\n";
                                echo "  <td>" . htmlentities($instructor['LName']) . "</td>\n";
                                echo "  <td>" . htmlentities($instructor['Phone']) . "</td>\n";
                                echo "  <td>" . htmlentities($instructor['Email']) . "</td>\n";
                                echo "  <td><A HREF='instructorEdit.php?pid=" . htmlentities($instructor['InstructorID']) . "'>Edit</A></td>\n";
                                echo "  <td><A HREF='instructorDelete.php?pid=" . htmlentities($instructor['InstructorID']) . "' onclick='deletion()'>Delete</A></td>\n";
                                echo "</tr>\n";
                            }
                        ?>	
                    </tr>
                </table>
            </section>
        <!--</div>
        
    </body>

</html>-->

<!--will this even work? -->
<script>
    function deletion() {
         if(confirm('WARNING!  By confirming this action, you are deleting ALL of the saved information for this instructor, including account login, posts, etc.  Are you sure you want to continue?')) {
             window.location.href = "instructorDelete.php?pid='<?php htmlentities($instructor['InstructorID']) ?>'"; //will this work?
         }
         else {
             return false;
         }
    }
</script>

<!-- Use this script to have a popup box confirm if the user wants to delete a student, and inform them of the consequences of doing so -->
<!--<script>
    $('.deleteLink').on('click', function(e) {
        function deletion() {
            var confirm = window.confirm("WARNING!  By confirming this action, you are deleting ALL of the saved information for this instructor, " +
                "including account login, posts, etc.  Are you sure you want to continue?"); 
            if (confirm == true) {
                document.location.href = ""; //how is the link built here?
                //header('Location: http://localhost:8080/Captsone/Admin/instructorDelete.php');  //not correct; deletion pending
            }
            else {
                window.alert("Deletion cancelled.");
            }
        }
    });
</script>

<a href ='create.php?monitor_id=$id' onclick="if(confirm('WARNING!  By confirming this action, you are deleting ALL of the saved information for this instructor, including account login, posts, etc.  Are you sure you want to continue?')) return true; else return false;">Delete</a>

<a href ='create.php?monitor_id=$id' onclick="if(confirm('really?')) return true; else return false;">Delete</a> -->


<!--<a href ='create.php?monitor_id=$id' onclick="doConfirm()">
<center>DELETE</center></a> -->

