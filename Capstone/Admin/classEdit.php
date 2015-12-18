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
    
    $GetClass = $conn->query("select * from class where ClassID = '".$_REQUEST['pid']."'");  //is $_REQUEST['pid'] the right syntax?
    if (mysqli_num_rows($GetClass) > 0) {
        while($Row = mysqli_fetch_assoc($GetClass)) {
            $ClassID = $Row['ClassID'];
            $Name = $Row['Name'];
        }
    }
    else {
        echo "Error: ".$GetClass."<br />".$conn->error;
    }
?>

<h3>Class Edit</h3>
<div class="submissionArea">
    <form action="classUpdate.php" method="post">
        <input type="hidden" name="ClassID" value="<?php echo $ClassID; ?>" />
        <div class="addColumnBox">
            <span class="addColumnName">Class Name</span>
            <input type="text" name="Name" message="Please enter a class name" value="<?php echo $Name; ?>"required="yes" size="20" maxlength="30">
        </div><br />
        <div style="clear: both"></div>
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