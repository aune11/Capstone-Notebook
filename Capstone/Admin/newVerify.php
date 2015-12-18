<?php
    include("dbConnect.php");    
    
    if(isset($_POST['Login'])) {
        $Username = $_POST['Username'];
        $Password = $_POST['Password'];

        $query = "select * from login where Username = '".$Username."'";
        $Result = $conn->query($query);

        //$Hash = password_hash($Password, PASSWORD_DEFAULT); //DO NOT DELETE THIS; this hashes the user-entered password for comparison to the db
        
        if (mysqli_num_rows($Result) > 0) {
            while($Row = mysqli_fetch_assoc($Result)) {
                //echo "<br />test";
                $UserID = $Row['UserID'];
                $Username = $Row['Username'];
                $PasswordGet = $Row['Password'];
                $Roles = $Row['Roles'];
            }
        }
        else {
            //echo "Error: ".$Result."<br />".$conn->error;
            echo "No info for that user found.";
        }
        
        echo"<br />".$Password." pw user entered...";
        //echo"<br />".$Hash." the hash...";
        echo"<br />".$PasswordGet." pw from db here...";

        //if($Result->num_rows>0) {
            echo "<br />FIRST";
            //while($Row=$Result->fetch_assoc()) {
                echo "<br />SECOND";
                if (password_verify($Password, $PasswordGet)) { //$Row['Password'] ($Password, $Hash)
                    echo "<br />THIRD";
                    if ($Roles == "Student") {
                        session_start();
                        $_SESSION['UserID'] = $UserID;
                        header("Location: http://localhost:8080/Capstone/home.php");
                    }
                    else if ($Roles == "Admin" || $Roles == "Instructor") {
                        session_start();
                        $_SESSION['UserID'] = $UserID;
                        header("Location: http://localhost:8080/Capstone/Admin/adminHome.php?page=adminHomePage");
                    }
                    else {
                        echo '<br />Invalid password.';
                    }
                }
            //}
        //}
    }
?>