<?php
    include("dbConnect.php");
    $SQL = "select * from Login where UserID = '".$_SESSION['UserID']."'";
    $Result = $conn->query($SQL);
    
    if($Result->num_rows>0) {
        while($Row=$Result->fetch_assoc()) {
            if ($Row['Roles'] == "Admin" || $Row['Roles'] == "Instructor") {
            }
            else {
                header("Location: home.php"); //http://localhost:8080/Capstone/
            }
        }
    }
?>