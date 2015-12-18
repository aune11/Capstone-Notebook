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
    
    /*if (isset($_GET['PicID'])) { 
        $PicID = mysqli_real_escape_string($_GET['PicID']);
        
        $GetPic = $conn->query("select * from picture where PicID = '".$PicID."'");
        while ($Row = mysqli_fetch_assoc($GetPic)) {
            $ImageData = $Row['Image'];
        }
        header("content-type: image/jpg"); //may have to change to .jpeg or other
        echo $ImageData;
    }
    else {
        echo"Error";
    }*/
    
    $PicID = addslashes($_REQUEST['PicID']);
    $Image = $conn->query("select * from picture where PicID = '".$PicID."'");
    $Image = mysqli_fetch_assoc($Image);
    $Image = $Image['Image'];
    
    header("Content-type: image/jpeg");
    
    echo $Image;

?>