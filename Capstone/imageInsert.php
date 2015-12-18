<?php
    if(!isset($_SESSION)) { 
        session_start(); 
    } 
    elseif(isset($_SESSION['UserID'])) {
    }
    else {
        header("Location: loginForm.php");
    }
    
    include("Admin/dbConnect.php");
    
    $StudentID = $_POST['StudentID'];
    
    $Image = mysqli_real_escape_string($_FILES['image']['name']);
    $ImageData = mysqli_real_escape_string(file_get_contents($_FILES['image']['tmp_name']));
    $ImageType = mysqli_real_escape_string($_FILES['image']['type']);
    
    if (substr($ImageType,0,5) == "image") {
        //echo "Works";
        //stored values should be $Image and $ImageData?
        $ImageUpload = $conn->query("insert into picture (StudentID, Image) values ('{$StudentID}', '{}'");
        echo "Image uploaded!";
    }
    else {
        echo "Only images are allowed";
    }

?>