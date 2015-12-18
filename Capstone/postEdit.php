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
    
    $GetPost = $conn->query("select * from post where PostID = '".$_REQUEST['pid']."'");  //is $_REQUEST['pid'] the right syntax?
    if (mysqli_num_rows($GetPost) > 0) {
        while($Row = mysqli_fetch_assoc($GetPost)) {
            $PostID = $Row['PostID'];
            $StudentID = $Row['StudentID'];
            $ClassID = $Row['ClassID'];
            $SectionID = $Row['SectionID'];
            $PageID = $Row['PageID'];
            $Title = $Row['Title'];
            $PText = $Row['PText'];
        }
    }
    else {
        echo "Error: ".$GetPost."<br />".$conn->error;
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
            
                <!-- post creation area.  uses same rules as the Student area of the main home page for now -->
                <section id="student" style="border-right: none;">
                    <div class="submissionArea">
                        <p>Post Edit.  There is no length limit, however blank submissions won't be accepted.</p>
                        <br />
                        <form action="postUpdate.php" method="post">
                            <input type="hidden" name="PostID" value="<?php echo $PostID; ?>" />
                            <input type="hidden" name="StudentID" value="<?php echo $StudentID; ?>" />
                            <input type="hidden" name="ClassID" value="<?php echo $ClassID; ?>" />
                            <input type="hidden" name="SectionID" value="<?php echo $SectionID; ?>" />
                            <input type="hidden" name="PageID" value="<?php echo $PageID; ?>" />
                            <input type="text" name="Title" value="<?php echo $Title; ?>"required="yes" size="50" /><br />
                            <textarea rows="45" cols="75" class="postArea" name="PText"><?php echo $PText ?></textarea><br />
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
        if ($('.postArea').val() == '') { 
            $('#noText')
                .css('color', 'red')
                .css('font-style', 'italic')
                .text('No text detected.  Cannot upload a blank post.');
            e.preventDefault(); //stops the form action from completing and keeps the user on the current page
        }
    });
</script>