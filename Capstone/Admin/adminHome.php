<?php
    if(!isset($_SESSION)) { 
        session_start(); 
    } 
    elseif(isset($_SESSION['UserID'])) {
        include('../adminIncludes/adminCheck.php');
    }
    else {
        header("Location: http://localhost:8080/Capstone/Admin/loginForm.php");
    }
?>

<!doctype html>
<html>
    
    <head>
        <title>Instructor Page</title>
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
                <span><a href="logout.php">LOGOUT</a></span><br />
                <span><a href="materialTest.php">MARKDOWN TESTING</a></span><br />
                <span><a href="materialTestRead.php">MARKDOWN TEST READ</a></span>
                <?php include("adminIncludes/adminNav.php"); ?>
            </nav>
            
            <!-- main area of the admin page.  every page in the nav section will appear here as an include-->
            <section id="adminMainArea">
                <?php
                    if (isset($_GET['page'])) {
                        switch ($_GET['page']) {
                            case 'adminHomePage':
                                include("adminHomePage.php");
                                break;
                            case 'studentList':
                                include("studentList.php");
                                break;
                            case 'instructorList':
                                include("instructorList.php");
                                break;
                            case 'classList':
                                include("classList.php");
                                break;
                            case 'pageList':
                                include("pageList.php");
                                break;
                            case 'studentNew':
                                include("studentNew.php");
                                break;
                            case 'instructorNew':
                                include("instructorNew.php");
                                break;
                            case 'materialNew':
                                include("materialNew.php");
                                break;
                            case 'classNew':
                                include("classNew.php");
                                break;
                            case 'sectionNew':
                                include("sectionNew.php");
                                break;
                            default:
                                include("adminHomePage.php");
                                //echo "Admin Home Page by ECHO"; //include("adminHome.php");
                                break;
                        }
                    }
                    //else {
                        //display this if no page has been selected
                    //    echo "Admin Home Page by ELSE"; //include("adminHome.php");
                    //}
                ?>
            </section>
            
            <div style="clear: both"></div>
            <!--</div>-->
            
            <!-- copyright and school info/contact will go here -->
            <footer id="bottom">
                <?php include("../includes/footer.php"); ?>
            </footer>
            
        </div>
        
    </body>
    
</html>