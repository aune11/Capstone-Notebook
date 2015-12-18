<?php

    include("dbConnect.php");    

        //these two blocks select the next highest ID number based on the maximum number of entries ever entered to
        //prevent overlapping if users were ever deleted
        $NewStud = "select max(StudentID) + 1 as NewNumber from student;";  
        $QueryResult = mysqli_query($conn, $NewStud);//$con->query($SQLstring);

        if (mysqli_num_rows($QueryResult) > 0) {
            while($Row = mysqli_fetch_assoc($QueryResult)) {
                echo "<br />New highest StudentID selected.";
                if (isset($QueryResult)) { 
                    if ($errors == 0) {
                        $StudentID = $Row['NewNumber'];
                    }
                }
                else {
                    print "something went wrong for student...";
                }
                echo $StudentID;
            }
        }
        else {
            echo "Error: ".$SQLstring."<br />".$conn->error;
        }
        
        $NewUser = "select max(UserID) + 1 as NewUser from login"; 
		$QueryResult2 = mysqli_query($conn, $NewUser);

        if (mysqli_num_rows($QueryResult2) > 0) {
            while($Row2 = mysqli_fetch_assoc($QueryResult2)) {
                echo "<br />New highest UserID selected.";
                if (isset($QueryResult2)) { 
                    if ($errors == 0) {
                        $UserID = $Row2['NewUser'];
                    }
                }
                else {
                    print "something went wrong for login...";
                }
                echo $UserID;
            }
        }
        else {
            echo "Error: ".$NewUser."<br />".$conn->error;
        }
        
        //gets the classes and their sections for the class drop down menu
        if ($errors == 0) {
            $Classes = array();
            $GetClass = $conn->query("select sec.SectionID, sec.ClassID, sec.SectionNum, sec.Days, sec.Time, cla.ClassID, cla.Name from section sec ".
                                     "join class cla on cla.ClassID = sec.ClassID");
            
            if (mysqli_num_rows($GetClass) > 0) {
                while ($Row = mysqli_fetch_assoc($GetClass)) {
                    //$FName[] = $Row['FName'];
                    //$LName[] = $Row['LName'];
                    $Classes[] = $Row;
                }
                //mysqli_free_result($QueryResult4);
            }
            else {
                echo "Something went wrong for generating the classes...";
            }
        }
        
        /*$Classes = array();
		$GetClass = "select * from class";
		$ClassResult = $conn->query($GetClass);
		//print $QueryResult;
		//die();
		
		if (mysqli_num_rows($ClassResult) > 0) {
			while ($Row = mysqli_fetch_assoc($ClassResult)) {
				$ClassIDs[] = $Row['ClassID'];
				$ClassName[] = $Row['Name'];				
			}
			//mysql_free_result($QueryResult);
		}
        else {
            echo "no classes found";
        }
        
        //gets the sections for the section drop down menu
        $Sections = array();
		$GetSection = "select sec.SectionID, sec.SectionNum, sec.ClassID, cla.ClassID from section sec " . 
								"join class cla on cla.ClassID = sec.ClassID";// .
								//"where sec.Dept = '" . $Depts . "' and cor.ClassNum = " . $Course;
		$SecResult = $conn->query($GetSection);
		//print $QueryResult;
		//die();
		
		if (mysqli_num_rows($SecResult) > 0) {
			while ($Row = mysqli_fetch_assoc($SecResult)) {
				$SectionIDs[] = $Row['SectionID'];
				$SectionNum[] = $Row['SectionNum'];				
			}
			//mysql_free_result($QueryResult);
		}
        else {
            echo "no sections found";
        }*/
                
        //hashes the password with bcrypt hashing; cost is the strength of the hash; higher the number, the higher the security, but will take more time/resources to hash
        //this is also the actual variable that will be stored in the db
        /*$StorePW = password_hash($PasswordEnter, PASSWORD_BCRYPT); //, array('cost' => 10)
        //echo $StorePW;
        
        $SQLstring = $conn->query("insert into student (StudentID, UserID, ClassID, SectionID, FName, LName, Email) ".
                                  "values('{$StudentID}', '{$UserID}', '{$ClassID}', '{$SectionID}', '{$FName}', '{$LName}', '{$Email}')");
        
        //$UserInsert ="insert into login (UserID, Username, Password, Roles) values('{$UserID}', '{$Username}', '{$StorePW}', '{$SRole}')";
        $SQLstring3 = $conn->query("insert into login (UserID, Username, Password, Roles) values('{$UserID}', '{$Username}', '{$StorePW}', '{$SRole}')");
        //echo $sqlString3;
        //echo $PasswordEnter;
        die();
        header('Location: register.php');*/
    
?>

<!doctype html>
<html>
    <head>
        <title>Register New Student</title>
        <meta charset="utf-8" />
        <link rel="stylesheet" type="text/css" href="../Styles/styles.css" />
        <link rel="stylesheet" type="text/css" href="styles.css" /> <!--css for the top menu; rename this-->
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
            <h3>Student Registration Form</h3>
            <form action="registerInsert.php" method="post" id="registerForm">
                <input type="hidden" name="Roles" value="Student">
                <input type="hidden" name="StudentID" value="<?php echo $StudentID; ?>">
                <input type="hidden" name="UserID" value="<?php echo $UserID; ?>">
                
                <div class="formElement">
                    <input type="text" name="FName" placeholder="First Name" class="tField" size="27" required="yes" />
                </div>
                <div class="formElement">
                    <input type="text" name="LName" placeholder="Last Name" class="tField" size="27" required="yes" />
                </div>
                <div class="formElement">
                    <input type="text" name="Email" placeholder="Email" class="tField" size="27" required="yes" />
                </div>
                
                <div class="formElement">
                    <select name="ClassID">
                        <?php 
                            foreach ($Classes as $Class) {
                                echo "<option value='".$Class['ClassID']."'>".$Class['Name']." ".$Class['SectionNum']." ".$Class['Days']." ".$Class['Time']."</option>";
                            }
                        ?>
                    </select>
                </div>
                
                <div class="formElement">
                    <input type="text" name="Username" placeholder="Username" class="tField" size="27" required="yes" />
                </div>
                <div class="formElement">
                    <input type="password" name="Password" placeholder="Password"class="tField" size="27" required="yes" />
                </div>
                
                <div class="formElement">
                    <input type="submit" class="createStudentButton" id="register" name="Register" value="Create Account" />
                </div>
            </form>
            
            <footer>
                <?php include("../Includes/footer.php"); ?>
            </footer>
        </div>
    </body>
</html>