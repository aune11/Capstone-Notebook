<?php
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $conn->prepare("INSERT INTO instructor (name, value) VALUES (:name, :value)");
    
    
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':value', $value);
    
    
    
    
    
    
    
    
    //PDO insert
    try {
        $conn = new PDO($conn);//("mysql:host=$servername;dbname=$dbname", $username, $password);
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "INSERT INTO MyGuests (firstname, lastname, email) ".
               "VALUES ('John', 'Doe', 'john@example.com')";
        // use exec() because no results are returned
        $conn->exec($sql);
        echo "New record created successfully";
    }
    catch(PDOException $e) {
        echo $sql . "<br>" . $e->getMessage();
    }

    
    
    
    //PDO select (why is this in a class??)
    echo "<tr><th>Id</th><th>Firstname</th><th>Lastname</th></tr>";
    
    class TableRows extends RecursiveIteratorIterator {
        function __construct($it) {
            parent::__construct($it, self::LEAVES_ONLY);
        }
    
        function current() {
            return "<td style='width:150px;border:1px solid black;'>" . parent::current(). "</td>";
        }
    
        function beginChildren() {
            echo "<tr>";
        }
    
        function endChildren() {
            echo "</tr>" . "\n";
        }
    }
    
    
    
    
    
    
    $q = $db->prepare("SELECT id FROM table WHERE forename = :forename and surname = :surname LIMIT 1");
    $q->bindValue(':forename', 'Joe'); //Joe would be replaced by a variable
    $q->bindValue(':surname',  'Bloggs');
    $q->execute();
    
    if ($q->rowCount() > 0){
        $check = $q->fetch(PDO::FETCH_ASSOC);
        $row_id = $check['id'];
        // do something
    }
    
    $q = $db->prepare("SELECT id FROM table WHERE forename = :forename and surname = :surname");// removed limit 1
    $q->bindValue(':forename', 'Joe');
    $q->bindValue(':surname',  'Bloggs');
    $q->execute();
    
    if ($q->rowCount() > 0){
        $check = $q->fetchAll(PDO::FETCH_ASSOC);
        //$check will now hold an array of returned rows. 
        //let's say we need the second result, i.e. index of 1
        $row_id = $check[1]['id']; 
        // do something
    }
    
    
    
    
    
    
    $conn;
    try {
        $conn = new PDO($conn);//("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $stmt = $conn->prepare("SELECT id, firstname, lastname FROM MyGuests");
        $stmt->execute();
    
        // set the resulting array to associative
        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
        foreach(new TableRows(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
            echo $v;
        }
    }
    catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
    
    
    
    
    
    
    //PDO update
    try {
        $conn = new PDO($conn);//("mysql:host=$servername;dbname=$dbname", $username, $password);
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
        $sql = "UPDATE MyGuests SET lastname='Doe' WHERE id=2";
    
        // Prepare statement
        $stmt = $conn->prepare($sql);
    
        // execute the query
        $stmt->execute();
    
        // echo a message to say the UPDATE succeeded
        echo $stmt->rowCount() . " records UPDATED successfully";
    }
    catch(PDOException $e) {
        echo $sql . "<br>" . $e->getMessage();
    }
    
    
    
    
    
    
    
    //PDO delete
    try {
        $conn = new PDO($conn);//("mysql:host=$servername;dbname=$dbname", $username, $password);
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
        // sql to delete a record
        $sql = "DELETE FROM MyGuests WHERE id=3";
    
        // use exec() because no results are returned
        $conn->exec($sql);
        echo "Record deleted successfully";
    }
    catch(PDOException $e) {
        echo $sql . "<br>" . $e->getMessage();
    }

?>