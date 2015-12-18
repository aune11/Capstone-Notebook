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
    
    $Inst = $conn->query("select InstructorID from instructor where UserID = '".$_SESSION['UserID']."'");
    if (mysqli_num_rows($Inst) > 0) {
        while($Row = mysqli_fetch_assoc($Inst)) {
            $InstructorID = $Row['InstructorID'];
        }
    }
    else {
        echo "Error: ".$Inst."<br />".$conn->error;
        $errors++;
    }

	if ($errors == 0) {
		$Pages = array();
        $PageFind = $conn->query("select * from page where InstructorID = '".$InstructorID."'");
		//$SQLstring = "select * from $TableName"; 
		//$QueryResult = mysqli_query($conn, $SQLstring);
		
		if (mysqli_num_rows($PageFind) > 0) {
			while ($Row = mysqli_fetch_assoc($PageFind)) {
				$Pages[] = $Row;
			}
			//mysql_free_result($QueryResult);
		} else {
            echo "No results were found";
        }
    }
?>

<!--<html>
    
    <head>
        <title>Instructor List</title>
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
						<td class="listTitle">Pages You Have Created</td>
					</tr>
					<tr>
                        <td>Filename</td>
					</tr>
                    <tr>
                        <?php
                            foreach ($Pages as $Page) {
                                //echo "<span class='navLink'><a href='home.php?page=".$Nav['PageID']."'>".$Nav['Title']."</a></span><br />";
                                echo "<tr>\n";
                                echo "  <td><span class='navLink'><a href='home.php?page=".htmlentities($Page['PageID'])."'>".htmlentities($Page['Title'])."</a></span></td>";//"  <td>".htmlentities($Page['Title'])."</td>\n";
                                echo "  <td><A HREF='pageEdit.php?pid=" . htmlentities($Page['PageID']) . "'>Edit</A></td>\n";
                                echo "  <td><A HREF='pageDelete.php?pid=" . htmlentities($Page['PageID']) . "' onclick='deletion()'>Delete</A></td>\n";
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