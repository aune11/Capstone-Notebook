<?php
    //include('Admin/dbConnect.php');
    
    $Navs = array();
    $Query = "SELECT pag.PageID, pag.Title, pag.SectionID, stu.SectionID, stu.UserID FROM page pag ". 
             "join student stu on stu.SectionID = pag.SectionID ".
             "where stu.UserID = '".$_SESSION['UserID']."'";// and ".
             //"pag.SectionID = stu.SectionID";
    $Result = $conn->query($Query);
    
    //$MenuDisplay = '';
    $Navs = array();
    if (mysqli_num_rows($Result)>0) {
        while ($Row = mysqli_fetch_array($Result)) {
            //$PageID = $Row['PageID'];
            //$Title = $Row['Title'];
            $Navs[] = $Row;
            //$MenuDisplay = '<a href="home.php?currentpage='.$PageID.'">'.$Title.'</a><br />';
            //echo $MenuDisplay;
        }
    }
    foreach ($Navs as $Nav) {
        //echo $Nav['PageID']." ";
        //echo '<a href="home.php?currentpage='.$Nav['PageID'].'>'.$Nav['Title'].'</a><br />';
        echo '<span class="innerStudentNavLink"><a href="home.php?currentpage='.$Nav['PageID'].'">'.$Nav['Title'].'</a></span><br /><br />';
    }
?>
