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
    //if (isset($_POST['addStudent'])) {
        include("dbConnect.php");
    //}

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
            //$QueryResult = mysqli_query($conn, $SQLstring);
            
            $SQLstring2 = "insert into login (UserID, Username, Password, Roles) ".
                          "values ('{$UserID}', '{$Username}', '{$StorePW}', '{$Roles}')";
            //$QueryResult2 = mysqli_query($conn, $SQLstring2);

            if (mysqli_query($conn, $SQLstring) &&
                mysqli_query($conn, $SQLstring2)) { 
                    echo "Successful Student insertion.";
                    header("Location: adminHome.php?page=studentList");
            }
            else { 
                echo "Error with: ".$SQLstring."<br />".$conn->error.".";
                echo "Error with: ".$SQLstring2."<br />".$conn->error.".";
            }
            
            /*if () { 
                echo "Successful Login insertion";
                //$UserID = mysqli_insert_id($con); //are these two lines required here?
                //$_SESSION['UserID'] = mysqli_insert_id($con);
            }
            else {
                echo "Error with: ".$SQLstring2."<br />".$conn->error."."; 
            }*/
        }
    //}

?>
<!--
<html>
    <head>
        <title>Add Student</title>
        <meta charset="utf-8" />
        <link rel="stylesheet" type="text/css" href="../Styles/styles.css" />
    </head>
    
    <body>
        <div id="main">
            <!--<nav id="adminNav">
                    <?php //include("adminIncludes/adminNav.php"); ?>
            </nav>
            
            <h3 class="addPageTitle">Student Added</h3>
            
            <p>Details for '<?php //echo $FName . " " . $LName; ?>' have been successfully inserted and saved.</p>
        </div>
    </body>
</html>-->