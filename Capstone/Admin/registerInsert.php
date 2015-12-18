<?php
    session_start();
    /*if(isset($_SESSION['UserID'])) {
    }
    else {
        header("Location: loginForm.php");
    }*/
    
        $errors = 0;
    //if (isset($_POST['addStudent'])) {
        include("dbConnect.php");


        $StudentID = $_POST['StudentID'];
        $UserID = $_POST['UserID'];
        $ClassID = $_POST['ClassID'];
        $FName = $_POST['FName'];
        $LName = $_POST['LName'];
        $Email = $_POST['Email'];
        $Username = $_POST['Username'];
        $Password = $_POST['Password'];
        $Roles = $_POST['Roles'];
            
        $StorePW = password_hash($Password, PASSWORD_BCRYPT);        
        
        $SecQuery = $conn->query("select SectionID from section where ClassID = ".$ClassID."");
        if (mysqli_num_rows($SecQuery) > 0) {
            while ($Row = mysqli_fetch_assoc($SecQuery)) {
                $SectionID = $Row['SectionID'];
            }
        }
        else {
            echo "No results were found.";
        }
         
        if ($errors == 0) {    
            $SQLstring = "insert into student (StudentID, UserID, ClassID, SectionID, FName, LName, Email) ".
                         "values ('{$StudentID}', '{$UserID}', '{$ClassID}', '{$SectionID}', '{$FName}', '{$LName}', '{$Email}')";

            $SQLstring2 = "insert into login (UserID, Username, Password, Roles) ".
                          "values ('{$UserID}', '{$Username}', '{$StorePW}', '{$Roles}')";

            if (mysqli_query($conn, $SQLstring) &&
                mysqli_query($conn, $SQLstring2)) { 
                    echo "Successful Student creation.";
                    header("Location: loginForm.php");
            }
            else { 
                echo "Error with: ".$SQLstring."<br />".$conn->error.".";
                echo "Error with: ".$SQLstring2."<br />".$conn->error.".";
            }
        }
    //}
?>