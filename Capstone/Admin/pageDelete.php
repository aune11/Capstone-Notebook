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
    
	if ($errors == 0) {
		//$Info = array();
        /*$ToDelete = $conn->query("select Title from page where PageID = '" . $_REQUEST['pid'] . "'");

		if (mysqli_query($conn, $ToDelete)) {
			while ($Row = mysqli_fetch_assoc($ToDelete)) {
				$Title = $Row['Title'];
			}
        }
        else {
            echo "Error: ".$ToDelete."<br />".$conn->error.".";
        }*/

        //deletes both the page and its associated posts to prevent potential cross-contamination
        $Deletion= "delete from page where PageID = '".$_REQUEST['pid']."'";
        $ZapPosts = "delete from post where PageID = '".$_REQUEST['pid']."'";
        
        if (mysqli_query($conn, $Deletion) &&
            mysqli_query($conn, $ZapPosts)) {
            echo "Successful deletion of selected page and posts<br />";
            header("Location: adminHome.php?page=pageList"); 
        } else {
            echo "Error: ".$Deletion."<br />".$conn->error.".";
            echo "Error: ".$ZapPosts."<br />".$conn->error.".";
        }
	}
		//mysql_free_result($QueryResult);
	//}
?>