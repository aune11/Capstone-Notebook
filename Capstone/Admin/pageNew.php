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
    
    include('dbConnect.php');
    
    $Inst = $conn->query("select InstructorID, ClassID, SectionID from instructor where UserID = '".$_SESSION['UserID']."'");
    if (mysqli_num_rows($Inst) > 0) {
        while($Row = mysqli_fetch_assoc($Inst)) {
            $ClassID = $Row['ClassID'];
            $SectionID = $Row['SectionID'];
            $InstructorID = $Row['InstructorID'];
        }
    }
    else {
        //echo "Error: ".$Inst."<br />".$conn->error;
    }

?>

<div class="newPost" style="width: 600px;">
    
    <form action="pageInsert.php" method="post">
        
        <input type = "hidden" name="ClassID" value ="<?php echo $ClassID ?>" />
        <input type = "hidden" name="SectionID" value ="<?php echo $SectionID ?>" />
        <input type = "hidden" name="InstructorID" value ="<?php echo $InstructorID ?>" />
        
        <p class="postInfo">The first field is the name of the file.  The actual title of your new page
        as you want it to appear to students will need to be incldued in the text box below.  You may use
        the filename for your visible page name if you copy it into the main text field.</p>
        <span class="newPageTitle">Filename: <input type="text" name="pageTitle" size=50 message="You must enter a filename" required="yes" /></span>
        <br />
        <textarea rows="20" cols="70" name="textPost" message="You cannot submit a blank file." required="yes"></textarea>
        <br />
        <input type="submit" value="Create New Page" />
        <p class="postInfo">This form is Markdown compatible.  Markdown is simplified web markup that
        allows easy styling in text posts, such as bolding text, creating lists, etc.  A short guide 
        can be found here. (need link)</p>
    </form>
    
</div>