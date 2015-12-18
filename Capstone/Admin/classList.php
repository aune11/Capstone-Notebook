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

    $Classes = array();
    /*$Query = "select * from section sec ".
             "join class cla on cla.ClassID = sec.ClassID ".
             "join instructor ins on ins.InstructorID = sec.InstructorID ".
             */
    $Result = $conn->query("select * from section sec ".
                            "join class cla on cla.ClassID = sec.ClassID ".
                            "join instructor ins on ins.InstructorID = sec.InstructorID");
    
    if (mysqli_num_rows($Result) > 0) {
        while ($Row = mysqli_fetch_assoc($Result)) {
            $Classes[] = $Row;
        }
        //mysql_free_result($QueryResult); is this even required?
    }
    else {
        echo "No results were found.";
    }	
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
                <table class="queryResult">
                    <tr>
						<td class="listTitle">Classes and Their Sections</td>
					</tr>
					<tr>
                        <td>Class</td>
						<td>Section</td>
						<td>Instructor</td>
						<td>Days</td>
						<td>Time</td>
					</tr>
                    <tr>
                        <?php
                            foreach ($Classes as $Class) {
                                echo "<tr>\n";
                                echo "  <td>".htmlentities($Class['Name'])."</td>\n";
                                echo "  <td>".htmlentities($Class['SectionNum'])."</td>\n";
                                echo "  <td>".htmlentities($Class['FName'])." ".htmlentities($Class['LName'])."</td>\n";
                                echo "  <td>".htmlentities($Class['Days'])."</td>\n";
                                echo "  <td>".htmlentities($Class['Time'])."</td>\n";
                                echo "  <td><A HREF='classEdit.php?pid=" . htmlentities($Class['ClassID']) . "'>Edit Class</A></td>\n";
                                echo "  <td><A HREF='sectionEdit.php?pid=" . htmlentities($Class['SectionID']) . "'>Edit Section</A></td>\n";
                                echo "  <td><A HREF='sectionDelete.php?pid=" . htmlentities($Class['SectionID']) . "' onclick='deleteLink'>Delete Section</A></td>\n";
                                echo "  <td><A HREF='classDelete.php?pid=" . htmlentities($Class['ClassID']) . "' onclick='deleteLink'>Delete Class*</A></td>\n";
                                echo "</tr>\n";
                            }
                        ?>	
                    </tr>
                </table><br />
                <span class="deleteWarning">*Deleting a Class ALSO deletes its section(s)</span>
            </section>
        <!--</div>
        
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