<?php 
    
    include("dbConnect.php");
    
    $num_rec_per_page=1;
    //sets the page to 1 if no page has been selected
    if (isset($_GET["page"])) {
        $page  = $_GET["page"];
    } else {
        $page=1;
    }
    
    $start_from = ($page-1) * $num_rec_per_page; 
    $GetPage = "SELECT * FROM page.pag ".
            "join student.stu on stu.SectionID = pag.SectionID ".
            "where stu.UserID = '".$_SESSION['UserID']."' and pag.SectionID = stu.SectionID ".
            "LIMIT '$start_from', '$num_rec_per_page'";
    $Retrieved = mysql_query ($GetPage); //run the query
?>

<!-- table actually won't be used; will incorporate the while below into the appropriate column in the student page something like:

    while ($Row = mysqli_fetch_assoc($Retrieved) {
        echo $Row['Title']."\<br /><br />";
        echo $Row['Text']."<br />";
-->
<table> 
    <tr><td>Name</td><td>Phone</td></tr>
    <?php 
        while ($Row = mysql_fetch_assoc($Retrieved)) { 
    ?> 
        <tr>
            <td><?php echo $Row['Title']; ?></td>
            <td><?php echo $Row['Text']; ?></td>            
        </tr>
    <?php 
        }; 
    ?> 
</table>

<?php 
    $Pages = "SELECT * FROM page"; 
    $PagesResult = mysql_query($Pages); //run the query
    $total_records = mysql_num_rows($PagesResult);  //count number of records
    $total_pages = ceil($total_records / $num_rec_per_page); 
    
    echo "<a href='pagination.php?page=1'>".'|<-'."</a> "; // Goto 1st page  
    
    $CurrentPage;
    
    for ($i=1; $i<=$total_pages; $i++) {
        echo "<a href='pagination.php?page=".$i."'>".$i."</a> ";
        echo "";
    };
    
    echo "<a href='pagination.php?page=$total_pages'>".'->|'."</a> "; // Goto last page
?>