<?php

    include("Admin/dbConnect.php");
    
    $Nav = $conn->query("SELECT PageID, ClassID, SectionID, Title ".
                        "FROM page ".
                        //"join class cla on cla.ClassID = pag.PageID.". 
                        "WHERE ClassID = '".$ClassID."' and SectionID = '".$SectionID."', sort ASC"); //$dbc
    $NavResult = mysqli_fetch_assoc($Nav);
    
?>

<ul>
    <?php
        do {
            ?>
            <li><a href="home.php?PageID=<?php echo $NavResult['PageID'] ?>"><?php echo $NavResult['Title']; ?></a></li>
            <?php
        } while ($NavResult = mysqli_fetch_assoc($Nav));
    ?>
</ul>