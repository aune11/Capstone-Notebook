<?php
    if(!isset($_SESSION)) { 
        session_start(); 
    } 
    elseif(isset($_SESSION['UserID'])) {
    }
    else {
        header("Location: loginForm.php");
    }
    
    include('Admin/dbConnect.php');
    
    $PicID = $_POST['PicID'];
    $PageID = $_POST['PageID'];
    $StudentID = $_POST['StudentID'];
    //file properties

    $File = $_FILES['image']['tmp_name'];
    //if(!empty($_FILES) && isset($_FILES['image'])){
     //   echo $_FILES['image']['tmp_name'];
    //}
    if (!isset($File)) {
        echo "No image selected.";
    }
    else {
        //addslashes() function used to prevent SQL injection
        $Image = addslashes(file_get_contents($_FILES['image']['tmp_name']));
        $ImgName = addslashes($_FILES['image']['name']);
        $ImgSize = getimagesize($_FILES['image']['tmp_name']); //checks that it actually is an image more than anything
        
        if ($ImgSize == false) {
            echo "Not an image.";
        }
        else {
            
            $Insert = "insert into picture (PicID, PageID, StudentID, Name, Image) ".
                        "values ('{$PicID}', '{$PageID}', '{$StudentID}', '{$ImgName}', '{$Image}')";
            if (mysqli_query($conn, $Insert)) { 
                echo "Image submitted successfully";
                header("Location: home.php?currentpage=$PageID");
                //$UserID = mysqli_insert_id($con); //are these two lines required here?
                //$_SESSION['UserID'] = mysqli_insert_id($con);
            }
            else {
                echo "Error with: ".$Insert."<br />".$conn->error.".  Unable to save image information.";
            }
            

        }
    }

?>