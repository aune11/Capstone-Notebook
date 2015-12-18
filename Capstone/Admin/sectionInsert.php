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
    include('dbConnect.php'); 
    
    if ($errors == 0) {
        $SectionID = $_POST['SectionID'];
        $ClassID = $_POST['ClassID'];
        $InstructorID = $_POST['InstructorID'];
        $SectionNum = $_POST['SectionNum'];
        $Days = $_POST['Days'];
        $Time = $_POST['Time'];
        
        //$FName = $_POST['FName'];
        //$LName = $_POST['LName'];
		
        /*$Inst = "select InstructorID from instructor where InstructorID = '".$_POST['InstructorID']."'";//FName = '".$FName."' and LName = '".$LName."'";
        
        $conn->query($Inst); 
        if (mysqli_num_rows($Inst) > 0) {
            while($Row = mysqli_fetch_assoc($Inst)) {
                $InstructorID = $Row['InstructorID'];
            }
        }
        else {
            echo "Error: ".$Inst."<br />".$conn->error;
        }   */
        
		$SQLstring = "insert into section (SectionID, ClassID, InstructorID, SectionNum, Days, Time) ".
                        "values ('{$SectionID}', '{$ClassID}', '{$InstructorID}', '{$SectionNum}', '{$Days}', '{$Time}')";
                        //$SQLstring->bindParam(':name', $name); //PARAMS  PARAMS EVERYWHERE!  do this for ALL sql 

        if (mysqli_query($conn, $SQLstring)) { 
                echo "Post submitted successfully";
                header("Location: adminHome.php?page=classList"); //need the actual variable
            }
        else {
            echo "Error with: ".$SQLstring."<br />".$conn->error.".  Unable to save post information.";
        }
	}

?>