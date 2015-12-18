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
    
    $GetSection = $conn->query("select * from section where SectionID = '".$_REQUEST['pid']."'");  //is $_REQUEST['pid'] the right syntax?
    if (mysqli_num_rows($GetSection) > 0) {
        while($Row = mysqli_fetch_assoc($GetSection)) {
            $SectionID = $Row['SectionID'];
            $ClassID = $Row['ClassID'];
            $InstructorID = $Row['InstructorID'];
            $SectionNum = $Row['SectionNum'];
            $Days = $Row['Days'];
            $Time = $Row['Time'];
        }
    }
    else {
        echo "Error: ".$GetSection."<br />".$conn->error;
    }
    
    if ($errors == 0) {
		$Instructors = array();
        $GetInst = $conn->query("select InstructorID, FName, LName from instructor");
		
		if (mysqli_num_rows($GetInst) > 0) {
			while ($Row = mysqli_fetch_assoc($GetInst)) {
				//$FName[] = $Row['FName'];
                //$LName[] = $Row['LName'];
                $Instructors[] = $Row;
			}
			//mysqli_free_result($QueryResult4);
		}
        else {
            echo "Something went wrong for generating the instructors...";
        }
	}
    
    if ($errors == 0) {
		$Classes = array();
        $GetClass = $conn->query("select * from class");
		
		if (mysqli_num_rows($GetClass) > 0) {
			while ($Row = mysqli_fetch_assoc($GetClass)) {
				//$FName[] = $Row['FName'];
                //$LName[] = $Row['LName'];
                $Classes[] = $Row;
			}
			//mysqli_free_result($QueryResult4);
		}
        else {
            echo "Something went wrong for generating the classes...";
        }
	}
?>

<h3>SectionEdit</h3>
<div class="submissionArea">
    <form action="sectionUpdate.php" method="post">
        <input type="hidden" name="SectionID" value="<?php echo $SectionID; ?>" />
        <div class="addColumnBox">
            <span class="addColumnName">Class Name</span>
            <!--<input type="text" name="ClassName" message="Please enter a class name" required="yes" size="20" maxlength="30">-->
            <select name="ClassID">
                <?php 
                    foreach ($Classes as $Class) {
                        echo "<option value='".$Class['ClassID']."'>".$Class['Name']."</option>";
                    }
                ?>
            </select>
        </div><br />
        <div class="addColumnBox">
            <span class="addColumnName">Section Number</span>
            <!--<input type="text" name="ClassName" message="Please enter a name" required="yes" size="20" maxlength="30">-->
            <input type="text" name="SectionNum" message="Please enter the section number" value="<?php echo $SectionNum; ?>" required="yes" size="2" maxlength="1">
        </div><br />
        <div class="addColumnBox">
            <span class="addColumnName">Days</span>
            <input type="text" name="Days" message="Please enter the days" value="<?php echo $Days; ?>" required="yes" size="20" maxlength="30">
        </div><br />
        <div class="addColumnBox">
            <span class="addColumnName">Time</span>
            <input type="text" name="Time" message="Please enter the class time" value="<?php echo $Time; ?>" required="yes" size="20" maxlength="50">
        </div><br />
        <div class="addColumnBox">
            <span class="addColumnName">Instructor</span>
            <select name="InstructorID">
                <?php 
                    foreach ($Instructors as $Instructor) {
                        echo "<option value='".$Instructor['InstructorID']."'>".$Instructor['FName']." ".$Instructor['LName']."</option>";
                    }
                ?>
            </select>
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