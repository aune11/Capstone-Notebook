<?php
    if(!isset($_SESSION)) { 
        session_start(); 
    } 
    elseif(isset($_SESSION['UserID'])) {
        include("adminCheck.php");
    }
    else {
        header("Location: loginForm.php");
    }
    include("dbConnect.php");
    
    $ClassID = $_POST['ClassID'];
    $SectionID = $_POST['SectionID'];
    $InstructorID = $_POST['InstructorID'];
    $PageTitle = $_POST['pageTitle'];
    $TextPost = $_POST['textPost'];
    
    $NewFile = file_put_contents($PageTitle.'.md', $TextPost);//fopen("$TextPost", "w") or die("Unable to create file!");
    //$TextToWrite = $TextPost;
    //fwrite($NewFile, $TextToWrite);
    //fclose($NewFile);
    
    $Insert = $conn->query("insert into page (ClassID, SectionID, InstructorID, Title, Text) values('{$ClassID}', '{$SectionID}', '{$InstructorID}', '{$PageTitle}', '{$NewFile}')");
    if (mysqli_query($conn, $Insert)) { 
        echo "Successful new page insertion";
         header("Location: adminHome.php?page=pageList");
        //$UserID = mysqli_insert_id($con); //are these two lines required here?
        //$_SESSION['UserID'] = mysqli_insert_id($con);
    }
    else {
        echo "Error with: ".$Insert."<br />".$conn->error."."; 
    }
?>

<!--//reference only
/*
$filename = $_POST['pageTitle'];
$contents = $_POST['textPost'];

if (empty($filename)) { 
    echo "No file name entered.  File not submitted.";
    die();
}

//the data
//open the file and choose the mode; since file shouldn't exist, will create the file
file_put_contents('includes' . $directory . '/' . $filename . '.md', $contents);

//print "File Submitted";
header('Location: index.php');
*/-->