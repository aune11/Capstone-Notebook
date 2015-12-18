<?php
    $servername = "localhost:3310"; //this will need to be changed to the appropriate host and port when uploaded to its final server
    $username = "root";
    $password = "";
    $db = "notebook";
    
    $errors = 0;
    // Creates connection
    $conn = new mysqli($servername, $username, $password, $db); //new mysqli
    
    // Checks connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error . "<br /><br />Please use your browser's Back button to return to the previous page.");
        ++$errors;
    }
    //if connection is successful
    else {
        //echo "Connected successfully."; //comment this out once the site has most functionality finished
    }
?>