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
    
    $errors = 0;
    include("dbConnect.php");
    
    $GetPage = $conn->query("select * from page where PageID = '".$_REQUEST['pid']."'");  //is $_REQUEST['pid'] the right syntax?
    if (mysqli_num_rows($GetPage) > 0) {
        while($Row = mysqli_fetch_assoc($GetPage)) {
            $PageID = $Row['PageID'];
            $ClassID = $Row['ClassID'];
            $SectionID = $Row['SectionID'];
            $InstructorID = $Row['InstructorID'];
            $Title = $Row['Title'];
            $Text = $Row['Text'];
        }
    }
    else {
        echo "Error: ".$GetPost."<br />".$conn->error;
    }
?>

<html>
    
    <head>
        <title>Edit Page</title>
        <meta charset="utf-8" />
        <link rel="stylesheet" type="text/css" href="../Styles/styles.css" />
    </head>
    
    <body>
        <div id="main">
            
            <!-- top of the page, class heading, navigation dropdown menu, and Next/Previous page buttons will go here -->
            <header id="top">
                <?php include("../includes/header.php"); ?>
            </header>
            
            <!--<div>-->
            <nav id="adminNav">
                <span><a href="logout.php">LOGOUT</a></span>
                <?php include("adminIncludes/adminNav.php"); ?>
            </nav>
            
            <h3 class="addPageTitle">Edit Instructor</h3>
            
            <form action="pageUpdate.php" method="post">
                <input type="hidden" name="PageID" value="<?php echo $PageID; ?>" />
                <input type="hidden" name="ClassID" value="<?php echo $ClassID; ?>" />
                <input type="hidden" name="SectionID" value="<?php echo $SectionID; ?>" />
                <input type="hidden" name="InstructorID" value="<?php echo $InstructorID; ?>" />
                <input type="text" name="Title" value="<?php echo $Title; ?>"required="yes" size="30" /><br />
                <textarea rows="20" cols="70" class="postArea" name="Text"><?php echo $Text ?></textarea>
                <input type="submit" name="submit" value="Submit" class="submitPost" /><span id="noText"></span>
                <div style="clear: both"></div>
            </form>
            <!--</div>-->
            
            <!-- copyright and school info/contact will go here -->
            <footer id="bottom">
                <?php include("../includes/footer.php"); ?>
            </footer>
        </div>
    </body>
    
</html>
