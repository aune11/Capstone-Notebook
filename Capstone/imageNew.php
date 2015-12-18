<?php
    if(!isset($_SESSION)) { 
        session_start(); 
    } 
    elseif(isset($_SESSION['UserID'])) {
    }
    else {
        header("Location: loginForm.php");
    }
    
    include("Admin/dbConnect.php");
    
    $PageID = $_REQUEST['pid'];
    
    if ($errors == 0) {
		$SQLstring = "select max(PicID) + 1 as NewNumber from picture;";  
        $QueryResult = mysqli_query($conn, $SQLstring);//$con->query($SQLstring);

        if (mysqli_num_rows($QueryResult) > 0) {
            while($Row = mysqli_fetch_assoc($QueryResult)) {
                //echo "<br />New highest PicID selected.";
                if (isset($QueryResult)) { 
                    if ($errors == 0) {
                        $PicID = $Row['NewNumber'];
                    }
                }
                else {
                    print "something went wrong for pic ID...";
                }
                //echo $PicID;
            }
        }
        else {
            echo "Error: ".$SQLstring."<br />".$conn->error;
        }        
	}
    
    $Stud = $conn->query("select StudentID from student where UserID = '".$_SESSION['UserID']."'");
    if (mysqli_num_rows($Stud) > 0) {
        while($Row = mysqli_fetch_assoc($Stud)) {
            $StudentID = $Row['StudentID'];
        }
    }
    else {
        echo "Error: ".$Stud."<br />".$conn->error;
    }
    
    /********
     *need to get the PageID for the current page as well somehow
     ********/
    
?>

<!doctype html>

<html>
    <head>
        <title>Science Notebook</title>
        <meta charset="utf-8" />
        <link rel="stylesheet" type="text/css" href="Styles/studentHomeStyles.css">
    </head>
    
    <body>
        
        <div id="main">
        
            <!-- top of the page, class heading, navigation dropdown menu, and Next/Previous page buttons will go here -->
            <header id="top">
                <?php include("includes/header.php"); ?>
            </header>
            
            <!--contained to fill the page up if nothing is present-->
            <div class="content">
                
                <div id="studentNav">
                    <div class="innerStudentNav">
                        <?php include('studentNav.php'); ?>
                    </div>
                </div>
            
                <!-- question edit area.  uses same rules as the Student area of the main home page for now -->
                <section id="student" style="border-right: none;">
                    <div class="submissionArea">
                        <p>Image Upload</p>
                        <br />
                        <form action="uploadImage.php" method="post" enctype="multipart/form-data"> <!--send to imageInsert.php if the all in one doesn't work-->
                        <?php
                            //echo "The PicID is ".$PicID."<br />";
                            //echo "The PageID is ".$PageID."<br />";
                        ?>
                            <input type = "hidden" name="PicID" value ="<?php echo $PicID ?>" />
                            <input type = "hidden" name="PageID" value ="<?php echo $PageID ?>" />
                            <input type = "hidden" name="StudentID" value ="<?php echo $StudentID ?>" />
                            <span>Browse for the image you want to upload.</span><br /><br />
                            <?php //to change max file size, change max_allowed_packet line in my.ini file.  save and restart the server for change to take effect ?>
                            <span><strong>NOTE:</strong> Images larger than 3MB in size cannot be uploaded.  Check the size of your image if you are unsure or having trouble submitting.</span><br /><br />
                                <input type="file" name="image" /><br /><br />
                                <input type="submit" value="Upload Image" />
                        </form>
                    </div>
                </section>
                
                <div style="clear: both"></div>
            
            </div>
            
            <!-- copyright and school info/contact will go here -->
            <footer id="bottom">
                <?php include("includes/footer.php"); ?>
            </footer>
            
        </div>
            
    </body>
</html>