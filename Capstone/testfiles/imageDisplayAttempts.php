<?php
    
	$id = (isset($_GET['id']) && is_numeric($_GET['id'])) ? intval($_GET['id']) : 0;
    $image = getImageFromDatabase($id); // your code to fetch the image
    
    header('Content-Type: image/jpeg');
    echo $image;
    
?>

<img src="image.php?id=<?php echo $image_id; ?>" />



<?php
    echo "<dt><strong>Image:</strong></dt><dd>" . 
        '<img src="data:image/jpeg;base64,'.
        base64_encode($Row['Image']).
        '" width="250" height="250">'."</dd>";
?>        
        
        
<img src="data:image/jpeg;base64,<?php echo base64_encode(stream_get_contents($Row['Image'])); ?>" />



<?php
    $sql = "SELECT * FROM `article` where `id` = 56"; // manipulate id ok 
    $sth = mysqli_query($sql);
    $result=mysqli_fetch_array($sth);
    // this is code to display 
    echo '<img src="data:image/jpeg;base64,'.base64_encode( $result['Image'] ).'"/>'
?>