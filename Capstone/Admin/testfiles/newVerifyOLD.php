<?php
    //session_start();
    //ob_start(); //this is supposed to make header() work, but doesn't seem to have affected it; see bottom of page for "ending" function
    
    //even when header() is placed at the top of the page, it won't redirect
    //header('Location: localhost:8080\Capstone\home.php');
    
    include("dbConnect.php");    
    
    if(isset($_POST['Login'])) {
        $Username = $_POST['Username'];
        $Password = $_POST['Password'];
        
        //update: everthing is getting pulled, but the password_verify is not working...
        $query = "select * from login where Username = '".$Username."'";
        $Result = $conn->query($query);// and Password = '$Password'");  //have tried both = '".$Username."' and = $Username, neither works
        //$Row = $result->fetch_array(MYSQLI_BOTH);
        
        //$select = "SELECT password FROM users WHERE username= '$username'";
        //$resultaat = $db->query($select);
        
        if($Result->num_rows>0) {
            while($Row=$Result->fetch_assoc()) {
                if (password_verify($Password, $Row['Password'])) {
                    echo 'Password is valid!';
                    header("Location: home.php");
                } else {
                    echo 'Invalid password.';
                }
            }
        }
        
    /*    $select = "SELECT password FROM users WHERE username= '$username'";
        $resultaat = $db->query($select);
        
        if($resultaat->num_rows>0) {
            while($rij=$resultaat->fetch_assoc()) {
                if (password_verify($password, $rij['password'])) {
                    echo 'Password is valid!'; //header("Location: userpage.php");
                } else {
                    echo 'Invalid password.';
                }
            }
        }
        echo "FIRST TEST "; //shows up
        //$Row variable above originally here
        echo "<br />SECOND TEST "; //shows up
        $confirmPass = $Row['Password'];
        //$ph = password_hash( "Joh", PASSWORD_BCRYPT);
        echo "<br />\$confirm var: ". $confirmPass;
        $passwordHash = password_hash($Password, PASSWORD_BCRYPT);
        echo "<br />\$passwordHash: ".$passwordHash;
        $checkhash = password_verify($Password, $confirmPass);
        
        echo "<br />Check Hash Value ".$checkhash;
        
        
        
        $PW = password_verify($Password, $confirmPass);
        echo "$PW"; //this is not getting echoed because nothing for the password_verify to check
        
        if (password_verify($Password, $confirmPass)) {
            
            echo "THIRD TEST "; //doesn't show up...

            session_start();
            $_SESSION['UserID'] = $Row['UserID'];
            header('Location: localhost:8080\Capstone\home.php'); //why doesn't this work?
            
            $Role = $conn->query("select Roles from login where UserID = '".$_SESSION['UserID']."'.");//$Row['Roles'];
            
            if ($Role == "Student") {
                header('Location: localhost:8080\Capstone\home.php');
            }
            else if ($Role == "Admin" || $Role == "Instructor") {
                header('Location: localhost:8080\Capstone\Admin\adminHome.php');
            }
            else {
                session_start();
                $_SESSION['LoginFail'] = "Yes";
            }
        }
        else {
            echo "Nothing was found.";
        }*/
    }
    
    //ob_end(); //tied to ob_start() at the top of the page
?>