
<?php
    
    //this begins a new session
    //session_start();
    //$_SESSION = array();
    //a session_destroy is used here to ensure that no prior session is in play to ensure a clean login (I think?  don't quite remember)
    //session_destroy();

?>

<!--<div id="loginForm">
    
    <h4 class="loginHeader">Login</h4>
    
    <form action="verifyLogin.php" method="post">
        
        <span>Username: <input type="text" name="username" message="Username requried" required="Yes" /></span>
        <span>Password: <input type="password" name="password" message="Password required" required="Yes" /></span>
        <span><input type="submit" name="submit" VALUE="Login" /></span>
        
    </form>
    
</div>-->

<?php
/*
    include("dbConnect.php");    
    
    if(isset($_POST['Login'])) {
        $Username = $_POST['Username'];
        $Password = $_POST['Password'];
        
        $result = $conn->query("select * from login where Username = '$Username'");// and Password = '$Password'");
        
        //if ($result === true) { 
            $Row = $result->fetch_array(MYSQLI_BOTH);
            $Role = $Row['Roles'];
            
            //echo "Outside";
            if (password_verify($Password, $Row['Password'])) {
                
                echo "$Role";
            
                session_start();
                $_SESSION['UserID'] = $Row['UserID'];
                if ($Role == "Student") {
                    header('Location: http://localhost:8080/Capstone/home.php');
                }
                else if ($Row['Roles'] == "Admin" || $Row['Roles'] == "Instructor") {
                    header('Location: http://localhost:8080/Capstone/Admin/adminHome.php');
                }
                else {
                    session_start();
                    $_SESSION['LoginFail'] = "Yes";
                }
            }
            
            header('Location: adminHome.php');
        //}
        //else {
            //echo "No data for that user found.  Use your Back button to return to the previous page.";
        //}
    }
*/
?>

<!doctype html>
<html>
    <head>
        <title>Login</title>
        <meta charset="utf-8" />
        <link rel="stylesheet" type="text/css" href="../Styles/styles.css" />
        <link rel="stylesheet" type="text/css" href="styles.css" /> <!--css for the top menu-->
    </head>
    
    <!--NOTE: see the CSSMenuBuilder website to made some dropdowns.  may not need it
    here, but will be useful elsewhere on the site.-->
    
    <body>
        <div id="main">
            <header>
                <?php include("../Includes/header.php"); ?>
            </header>
            
            <div id="cssmenu">
                <ul>
                   <li class='active'><a href='register.php'><span>Register</span></a></li>
                   <li><a href='loginForm.php'><span>Login</span></a></li>
                </ul>
            </div>
            
            <h3>Login</h3>
            
            <form action="newVerify.php" method="post"><!-- id="verifyLogin.php">-->
                <?php
                    /*if(isset($_SESSION['LoginFail'])) {
                        echo '<div class="formElement">Login failed.  Please try again.</div>';
                    } */               
                ?>
                <div class="formElement">
                    <span><input type="text" name="Username" class="tField" placeholder="Username" required="yes" /></span><!--placeholder="Username"--> 
                </div>
                <div class="formElement">
                    <span><input type="password" name="Password" class="tField" placeholder="Password" required="yes" /><!--placeholder="Password"--> 
                </div>
                <div class="formElement">
                    <input type="submit" name="Login" class="createStudentButton" id="register" value="Login" />
                </div>
            </form>
            
            <footer>
                <?php include("../Includes/footer.php"); ?>
            </footer>
        </div>
    </body>
</html>