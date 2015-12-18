<?php
    if(!isset($_SESSION)) { 
        session_start(); 
    } 
    elseif(isset($_SESSION['UserID'])) {
    }
    else {
        header("Location: loginForm.php");
    }
    
    include("dbConnect.php");
    
    //why do these need to be globals to work??
    global $ClassID;
    global $SectionID;
    
    $Inst = $conn->query("select * from instructor where UserID = '".$_SESSION['UserID']."'");
    if (mysqli_num_rows($Inst) > 0) {
        while($Row = mysqli_fetch_assoc($Inst)) {
            $InstructorID = $Row['InstructorID'];
        }
    }
    else {
        //echo "Error: ".$Stud."<br />".$conn->error;
    }
    
    $Classes = array();
    $Create = $conn->query("select sec.SectionID, sec.ClassID, sec.SectionNum, cla.Name from section sec ".
                           "join class cla on cla.ClassID = sec.ClassID ".
                           "where sec.InstructorID = '".$InstructorID."'");
    if (mysqli_num_rows($Create) > 0) {
        while($Row = mysqli_fetch_assoc($Create)) {
            //$ClassID = $Row['ClassID'];
            //$SectionID = $Row['SectionID'];
            $Classes[] = $Row;
        }
    }
    else {
        //echo "Error: ".$Stud."<br />".$conn->error;
    }
    
    //$PostID;
    //$PageID = $_REQUEST['pid']; //is this the right syntax?
    
    //don't need this part?  combined wit hthe first query.  not sure why I split them in the first place...
    /*$IDs = $conn->query("select ClassID, SectionID from student where StudentID = '".$StudentID."'");
    if (mysqli_num_rows($IDs) > 0) {
        while($Row = mysqli_fetch_assoc($IDs)) {
            $ClassID = $Row['ClassID'];
            $SectionID = $Row['SectionID'];
        }
    }
    else {
        echo "Error: ".$IDs."<br />".$conn->error;
    }*/
?>


<div class="submissionArea">
    <h3>New Page</h3>
    <p>Enter material for submission here.  There is no length limit, however blank submissions won't be accepted.</p>
    
    <p class="postInfo">The first field is the name of the file.  The actual title of your new page
    as you want it to appear to students will need to be included in the main text box.  You may use
    the filename for your visible page name if you copy it into the main text field.</p>
    <br />
    <?php
        //echo "instID".$InstructorID."<br />";
        //echo "classID".$ClassID."<br />";
        //echo "sectionID".$SectionID."<br />";
    ?>
    <form action="materialInsert.php" method="post">
        <input type="hidden" name="InstructorID" value="<?php echo $InstructorID; ?>" />
        <!--<input type="hidden" name="ClassID" value="<?php //echo $ClassID; ?>" />
        <input type="hidden" name="SectionID" value="<?php //echo $SectionID; ?>" />-->
        <div class="formElement">
            <select name="ClassID">
                <?php 
                    foreach ($Classes as $Class) {
                        echo "<option value='".$Class['ClassID']."'>".$Class['Name']." ".$Class['SectionNum']."</option>";
                    }
                ?>
            </select>
        </div>
        <!--<input type="hidden" name="PageID" value="<?php //echo $PageID; ?>" />-->
        <input type="text" name="Title" required="yes" size="80" /><br />
        <textarea rows="20" cols="70" class="postArea" name="Text" required="yes"></textarea><br />
        <input type="submit" name="submit" value="Submit" class="submitPost" /><span id="noText"></span>
    </form>
</div>

<script>
    //checks to see that there is text within the post field; if text is detected, script cancels and form action continues as normal
    //$('#noName').hide();
   /* $('.submitPost').on('click', function(e) {
        //if no text is detected, an error message is displayed
        if ($('.postArea').val() == '') { 
            $('#noText')
                .css('color', 'red')
                .css('font-style', 'italic')
                .text('No text detected.  Cannot upload a blank post.');
            e.preventDefault(); //stops the form action from completing and keeps the user on the current page
        }
    });*/
</script>