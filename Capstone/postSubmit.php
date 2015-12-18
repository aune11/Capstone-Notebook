<?php
    if(!isset($_SESSION)) { 
        session_start(); 
    } 
    elseif(isset($_SESSION['UserID'])) {
        $StudentID = $_SESSION['UserID'];
    }
    else {
        header("Location: loginForm.php");
    }
    include("Admin/dbConnect.php");
    
    $PostID;
    $PageID = $_REQUEST['pid'];
    $ClassID = $conn->query("select ClassID from student where StudentID = '".$_SESSION['UserID']."'");
    $SectionID = $conn->query("select SectionID from student where StudentID = '".$_SESSION['UserID']."'");
?>


<div class="submissionArea">
    <p>Enter your post for submission here.  There is no length limit, however blank submissions won't be accepted.</p>
    <br />
    <form action="postUpload.php" method="post">
        <input type="hidden" name="StudentID" value="<?php echo $StudentID; ?>" />
        <input type="hidden" name="ClassID" value="<?php echo $ClassID; ?>" />
        <input type="hidden" name="SectionID" value="<?php echo $SectionID; ?>" />
        <input type="text" name="title" required="yes" size="30" />
        <textarea rows="10" columns="50" class="postArea" name="PText"></textarea>
        <input type="submit" name="submit" value="Submit" class="submitPost" /><span id="noText"></span>
    </form>
</div>

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