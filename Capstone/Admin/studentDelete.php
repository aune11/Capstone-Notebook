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
	
    global $StudentID;
    global $UserID;
    
	if ($errors == 0) {
		//$Info = array();
        echo $_REQUEST['pid'];
        $Student = "select stu.UserID, stu.StudentID, log.UserID from student stu ".
                   "join login log on log.UserID = stu.UserID ".
                   "where stu.StudentID = '".$_REQUEST['pid']."'";
        $StuQuery = $conn->query($Student);
        //echo $Student;
        //if (mysqli_query($conn, $Student)) {
        if (mysqli_num_rows($StuQuery) > 0) {           
            while ($Row = mysqli_fetch_assoc($StuQuery)) {
				$StudentID = $Row['StudentID'];
                $UserID = $Row['UserID'];
			}
			//mysql_free_result($QueryResult);
		} else {
            echo "No results were found or....";
            echo "<br />".$conn->error.".";
        }
        //}
        //echo $StudentID."<br />".$UserID;
        //die();
        
        //*******would rather use one of the two below setups, but neither seems to work ********//
        //the first I saw on Stack Overflow, some were surprised that it worked, but I can't get it to work
        //the second is the original, but apparently you can't have multiple tables in a delete satement...
        //code block to test once database is functional
        /*$SQLstring2 = "delete from ".$Table1." 
                       delete from ".$Table2." 
                       delete from ".$Table3." 
                       delete from ".$Table4." 
                       delete from ".$Table5." 
                       delete from ".$Table6." 
                        where StudentID = '" . $_REQUEST['pid'] . "' or UserID = '" . $_REQUEST['pid'] . "'";
        
                        /*"delete from $TableName1 t1 " .
                        "join $Table2 t2 on t2.UserID = t1.UserID " .
                        "join $Table3 t3 on t3.StudentID = t1.StudentID " .
                        "join $Table4 t4 on t4.StudentID = t1.StudentID " .
                        "join $Table5 t5 on t5.StudentID = t1.StudentID " .
                        "join $Table6 t6 on t6.StudentID = t1.StudentID " .
                        "where t1.StudentID = '" . $_REQUEST['pid'] . "' or t2.UserID = '" . $_REQUEST['pid'] . "'";
                        */
        /*if (mysqli_query($conn, $SQLstring2)) {
            echo "successful deletion of records";
        } else {
            echo "Error: ".$SQLstring2."<br />".$conn->error.".";
        }*/
        
        //alternate code block that does the deletions one at a time.  use this for testing purposes if the string above isn't working for some reason
        $SQLstring2 = "delete from student where UserID = '".$UserID."'"; //StudentID = '" . $_REQUEST['pid'] . "' or UserID = '" . $_REQUEST['pid'] . "'"; 
        $SQLstring3 = "delete from login where UserID = '".$UserID."'"; 
        $SQLstring5 = "delete from picture where StudentID = '".$StudentID."'"; 
        $SQLstring6 = "delete from post where StudentID = '".$StudentID."'"; 
        $SQLstring7 = "delete from question where StudentID = '".$StudentID."'";
        
        if (mysqli_query($conn, $SQLstring2) && 
            mysqli_query($conn, $SQLstring3) && 
            mysqli_query($conn, $SQLstring5) &&
            mysqli_query($conn, $SQLstring6) &&
            mysqli_query($conn, $SQLstring7)) {
            echo "Successful deletion of all chosen student's records.<br />";
            header("Location: adminHome.php?page=studentList");
        }
        else {
            echo "Error: ".$SQLstring2."<br />".$conn->error.".";
            echo "Error: ".$SQLstring3."<br />".$conn->error.".";
            echo "Error: ".$SQLstring5."<br />".$conn->error.".";
            echo "Error: ".$SQLstring6."<br />".$conn->error.".";
            echo "Error: ".$SQLstring7."<br />".$conn->error.".";
        }
	}
	
?>
