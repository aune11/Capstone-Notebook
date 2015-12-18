<?php

    session_start();
    if(isset($_SESSION['UserID'])) {
    }
    else {
        header("Location: loginForm.php");
    }
    
    include("Admin/dbConnect.php");
    
    global $MatTitle;
    global $MatText;
    
    $Stud = $conn->query("select StudentID, ClassID, SectionID from student where UserID = '".$_SESSION['UserID']."'");
    if (mysqli_num_rows($Stud) > 0) {
        while($Row = mysqli_fetch_assoc($Stud)) {
            $StudentID = $Row['StudentID'];
            $ClassID = $Row['ClassID'];
            $SectionID = $Row['SectionID'];
        }
    }
    else {
        //echo "Error: ".$Stud."<br />".$conn->error;
    }
    
    $Posts = array();
    $PostGet = $conn->query("select * from post where StudentID = '".$StudentID."' and PageID = '".$_GET['page']."' order by PostID"); //is $_REQUEST['pid'] here correct?
    if (mysqli_num_rows($PostGet) > 0) {
        while($Row = mysqli_fetch_assoc($PostGet)) {
            /*$PText = $Row['PText'];
            $Date = $Row['DateCreated'];
            $XCoord = $Row['XCoord'];
            $Ycoord = $Row['YCoord'];*/
            
            $Posts[] = $Row;
        }
    }
    else {
        //echo "Error: ".$PostGet."<br />".$conn->error;
    }
    
    $Images = array();
    $ImageGet = $conn->query("select * from picture where StudentID = '".$StudentID."' and PageID = '".$_GET['page']."' order by PicID"); //is $_REQUEST['pid'] here correct?
    if (mysqli_num_rows($ImageGet) > 0) {
        while($Row = mysqli_fetch_assoc($ImageGet)) {
            /*$PText = $Row['PText'];
            $Date = $Row['DateCreated'];
            $XCoord = $Row['XCoord'];
            $Ycoord = $Row['YCoord'];*/
            
            $Images[] = $Row;
        }
    }
    else {
        //echo "Error: ".$ImageGet."<br />".$conn->error;
    }
    
    $Questions = array();
    $QuestionGet = $conn->query("select * from question where StudentID = '".$StudentID."' and PageID = '".$_GET['page']."' order by QuestionID"); //is $_REQUEST['pid'] here correct?
    if (mysqli_num_rows($QuestionGet) > 0) {
        while($Row = mysqli_fetch_assoc($QuestionGet)) {
            /*$QText = $Row['PText'];
            $Date = $Row['DateCreated'];
            $XCoord = $Row['XCoord'];
            $Ycoord = $Row['YCoord'];*/
            
            $Questions[] = $Row;
        }
    }
    else {
        //echo "Error: ".$QuestionGet."<br />".$conn->error;
    }
    
    //PAGINATION STUFF HERE
    $num_rec_per_page=1;
    //sets the page to 1 if no page has been selected
    if (isset($_GET["page"])) {
        $page  = $_GET["page"];
    } else {
        $page=1;
    }
    
    $start_from = ($page-1) * $num_rec_per_page; 
    $GetPage = "SELECT * FROM page pag ".
            "join student stu on stu.SectionID = pag.SectionID ".
            "where stu.UserID = '".$_SESSION['UserID']."' and ".
                "pag.SectionID = stu.SectionID ".
            "LIMIT $start_from, $num_rec_per_page";
    $Retrieved = $conn->query($GetPage); //run the query

//Warning: mysqli_num_rows() expects parameter 1 to be mysqli_result, boolean given in C:\xampp\htdocs\Capstone\home.php on line 108
    //errors out if these variables aren't globals, no idea why...
    //nothing comes back
    if (mysqli_num_rows($Retrieved) > 0) {
        echo "successful PAGE get";
        while ($Row = mysqli_fetch_assoc($Retrieved)) {
            $MatPage = $Row['PageID'];
            $MatTitle = $Row['Title'];
            $MatText = $Row['Text'];
        }
    }
    else {
        echo "Error: ".$GetPage."<br />".$conn->error;
        echo "nothing found for PAGE";
    }

/* NOT USED
$query = mysql_query("SELECT * FROM keywords");
echo '<table>';
$count = 0;

while($result == mysql_fetch_array($query)){
    if ($count%4==0 && $count!=0) {
        echo '</tr><tr>';
    } elseif($count==0) {
        echo '<tr>';
    }
    $keywordName = $result['keywordName'];
    echo '<td>'.$keywordName."</td>";
    $count++;  
}
echo '</tr>';
*/        

?>
<!doctype html>

<html>
    <head>
        <title>Science Notebook</title>
        <meta charset="utf-8" />
        <link rel="stylesheet" type="text/css" href="Styles/studentHomeStyles.css">
    </head>
    
    <body>
        
        <div id="main">
        
            <!-- top of the page, class heading, navigation dropdown menu, and Next/Previous page buttons will go here -->
            <header id="top">
                <?php include("includes/header.php"); ?>
            </header>
            
            <!--top level functions like next/previous page, upload post or image -->
            <div class="menubar">
                <span style="margin-right: 5%;"><a href="postNew.php">New Post</a></span>
                <span style="margin-right: 5%;"><a href="iamgeNew.php">New Image</a></span>
                <span style="margin-right: 5%;"><a href="questionNew.php">New Question</a></span>
                <span><a href="Admin/logout.php">Log Out</a></span>
            </div>
            
            <div class="pagination" style="border-bottom: thin solid black;">
                <!--this here should create the arrow keys and page numbers, dependent on how many pages match the earlier query that pulls
                the data for the given student for the given section-->
                <?php 
                    $Pages = "SELECT * FROM page"; 
                    $PagesResult = $conn->query($Pages); //run the query
                    $total_records = mysqli_num_rows($PagesResult);  //count number of records
                    $total_pages = ceil($total_records / $num_rec_per_page); 
                    
                    echo "<a href='Capstone/home.php?page=1'>".'|<-'."</a> "; // Go to 1st page //"<a href='pagination.php?page=1'>".'|<-'."</a> ";
                    
                    $CurrentPage;
                    
                    for ($i=1; $i<=$total_pages; $i++) {
                        echo "<a href='Capstone/home.php?page=".$i."'>".$i."</a> "; //"<a href='pagination.php?page=".$i."'>".$i."</a> ";
                        echo "";
                    };
                    
                    echo "<a href='Capstone/home.php?page=$total_pages'>".'->|'."</a> "; // Goto last page //"<a href='pagination.php?page=$total_pages'>".'->|'."</a> ";
                ?>
            </div>
            
            <!--contained to fill the page up if nothing is present-->
            <div class="content">
            
                <!-- left side of the page.  this is where student-submitted posts and images will show up.  eventual functionality will allow
                them to move posts around the page and organize them however they want or to have it line up with instructor material -->
                <section id="student">
                    student
                    <?php
                        
                        //outputs the posts in order that they appear in the database                        
                        foreach ($Posts as $Post) {
                            echo '<div class="postOutput">';
                            echo '  '.htmlentities($Post['PText']).'<br />';
                            echo '  '.htmlentities($Post['DateCreated']).'<br />';
                            echo '  <a href="postEdit.php?pid='.htmlentities($Post['PostID']).'">Edit</a> | <a href="postDelete.php?pid='.htmlentities($Post['PostID']).'">Delete</a>';
                            echo '</div><br />';
                        }
                        //alternative method to try if necessary
                        //$Row=mysqli_fetch_array($Post,MYSQLI_ASSOC);
                        //printf ('<div class="postOutput">%s (%s)</div>\n', $Row['PText'], $Row['DateCreated']);
                        
                        foreach ($Images as $Image) {
                            echo '<div class="iamgeOutput">';
                            echo '  <img src="imageShow.php?id='.htmlentities($Image['Image']).'" />';
                            echo '  <a href="postDelete.php?pid='.htmlentities($Image['PicID']).'">Delete</a>';
                            echo '</div><br />';
                        }
                        
                    ?>                    
                </section>
                
                <!-- middle column of the page.  any questions asked about the class material (e.g. "What does this term on line 29 mean?")
                will go here.  same functionality as the first column, but text only; students will still be able to move posts around to
                line them up with the text -->
                <section id="question">
                    question
                    <?php
                        
                        //outputs the posts in order that they appear in the database                        
                        foreach ($Questions as $Question) {
                            echo '<div class="postOutput">';
                            echo '  '.htmlentities($Question['QText']).'<br />';
                            echo '  '.htmlentities($Question['DateCreated']).'<br />';
                            echo '  <a href="questionEdit.php?pid='.htmlentities($Question['QuestionID']).'">Edit</a> | <a href="questionDelete.php?pid='.htmlentities($Question['QuestionID']).'">Delete</a>';
                            echo '</div><br />';
                        }
                        
                    ?>  
                </section>
                
                <!-- right side of the page.  instructor material only, students will not be able to alter or manipulate this side of the
                page.  may or may not allow functionality of dragging posts over and dropping them on it, but for now, will not -->
                <section id="instructor">
                    instructor<br /><br />

                    <!--outputs the selected material-->
                    <?php  
                        echo $MatTitle."<br /><br />";
                        echo $MatText;
                    ?>
                </section>
                
                <div style="clear: both"></div>
            
            </div>
            
            <!-- copyright and school info/contact will go here -->
            <footer id="bottom">
                <?php include("includes/footer.php"); ?>
            </footer>
            
        </div>
            
    </body>
</html>
