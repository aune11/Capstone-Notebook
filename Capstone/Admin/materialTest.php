<?php

?>

<form action="materialTestSubmit.php" method="post" enctype="multipart/form-data">
    <!--<input type="hidden" name="directory" value="<?php //echo (empty($_GET['directory']) ? '' : htmlentities(trim($_GET['directory']))); ?>" />-->
    
    <span><input type="text" name="filename" value="" class="filename" />.md</span><br />
    <span class="note">Note: Yes, spaces are acceptable; enter your filename as you want it to appear in the site navigation.</span>
    <br />
    <br />
    <textarea name="contents" rows="40" cols="80"></textarea>
    <br />
    <input type="submit" value="Submit New File" class="submitFile" /> <span id="noName"></span>
    <br />
    
</form>