<?php
    if(!isset($_SESSION)) { 
        session_start(); 
    } 
    elseif(isset($_SESSION['UserID'])) {
    }
    else {
        header("Location: loginForm.php");
    }
    
    $errors = 0;
    include("Admin/dbConnect.php");
    
    $Stud = $conn->query("select StudentID from student where UserID = '".$_SESSION['UserID']."'");
    if (mysqli_num_rows($Stud) > 0) {
        while($Row = mysqli_fetch_assoc($Stud)) {
            $StudentID = $Row['StudentID'];
        }
    }
    else {
        echo "Error: ".$Stud."<br />".$conn->error;
    }
    
    $PageID = $_REQUEST['pid']; //is this the right syntax?
    
    $IDs = $conn->query("select ClassID, SectionID from student where StudentID = '".$StudentID."'");
    if (mysqli_num_rows($IDs) > 0) {
        while($Row = mysqli_fetch_assoc($IDs)) {
            $ClassID = $Row['ClassID'];
            $SectionID = $Row['SectionID'];
        }
    }
    else {
        echo "Error: ".$IDs."<br />".$conn->error;
    }
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
            
                <!-- question creation area.  uses same rules as the Student area of the main home page for now -->
                <section id="student" style="border-right: none;">
                    <div class="submissionArea">
                        <p>Enter your question here.  There is no length limit, however blank submissions won't be accepted.</p>
                        <br />
                        <form action="questionInsert.php" method="post">
                            <input type="hidden" name="StudentID" value="<?php echo $StudentID; ?>" />
                            <input type="hidden" name="ClassID" value="<?php echo $ClassID; ?>" />
                            <input type="hidden" name="SectionID" value="<?php echo $SectionID; ?>" />
                            <input type="hidden" name="PageID" value="<?php echo $PageID; ?>" />
                            <!--<input type="text" name="title" required="yes" size="30" />-->
                            <textarea rows="10" cols="50" class="questionArea" name="QText"></textarea>
                            <input type="submit" name="submit" value="Submit" class="submitPost" /><span id="noText"></span>
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

<script>
    //checks to see that there is text within the post field; if text is detected, script cancels and form action continues as normal
    //$('#noName').hide();
    $('.submitPost').on('click', function(e) {
        //if no text is detected, an error message is displayed
        if ($('.questionArea').val() == '') { 
            $('#noText')
                .css('color', 'red')
                .css('font-style', 'italic')
                .text('No text detected.  Cannot upload a blank post.');
            e.preventDefault(); //stops the form action from completing and keeps the user on the current page
        }
    });
</script>