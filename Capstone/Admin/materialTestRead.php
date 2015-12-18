<?php
    session_start();
    if(isset($_SESSION['UserID'])) {
    }
    else {
        header("Location: loginForm.php");
    }
    
    $errors = 0;
    include('dbConnect.php');
    
    $MarkdownGet = $conn->query("select * from page where Title = \"2 markdown\"");
    
    /*$PageFind = $conn->query("select * from page where InstructorID = '".$InstructorID."'");
    //$SQLstring = "select * from $TableName"; 
    //$QueryResult = mysqli_query($conn, $SQLstring);
    
    if (mysqli_num_rows($PageFind) > 0) {
        while ($Row = mysqli_fetch_assoc($PageFind)) {
            $Pages[] = $Row;
        }
        //mysql_free_result($QueryResult);
    } else {
        echo "No results were found";
    }*/
    

    if (mysqli_num_rows($MarkdownGet) > 0) {
        while($Row = mysqli_fetch_assoc($MarkdownGet)) {
            $PageID = $Row['PageID'];
            $ClassID = $Row['ClassID'];
            $SectionID = $Row['SectionID'];
            $InstructorID = $Row['InstructorID'];
            $Title = $Row['Title'];
            $Text = $Row['Text'];
        }
    }
    
    
?>

<!doctype html>

<html>

	<head>
		<title>Markdown Test Page</title>
		<!--<link rel="stylesheet" type="text/css" href="styles/styles.css">
		<script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>-->
		
	</head>
	
	<body>
		
		<div id="main">
			main cookies
			<?php
				include('Parsedown/Parsedown.php');
				$Parsedown = new Parsedown();
			?>
            
			<div class="content">
                content cookies
				<?php
                print_r($Text);
					//if (!isset($_GET['page'])) { 
					//	include('adminHome.php');
					//} 
					/*elseif (preg_match('@\.md$@', $_GET['page'])) {
						$file_to_read = file_get_contents($_GET['page']);
						echo $Parsedown->text($file_to_read);
					} */
                    
                    //<!--outputs the selected material-->
                    //else {   
                        echo '<h3 class="instructorAreaTitle">'.$Title.'</h3>';
                        $file_to_read = file_get_contents($Text);
                        echo $Parsedown->text($file_to_read);
                    //}

                
					/*else {
						if (file_exists($_GET['page'])) {
							include($_GET['page']);
						} 
						else {
							header('Location: /PHPDirectory/index.php');
						}
					}*/
				?>
			</div>
			
			<div style="clear: both;"></div>
			
		</div>
		
	</body>
		
</html>

