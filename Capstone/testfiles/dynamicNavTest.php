<?php

    function menu() {
        //global $dbc;
    /*****/
        //$GetPage = "SELECT * FROM page pag ".
        //    "join student stu on stu.SectionID = pag.SectionID ".
        //    "where stu.UserID = '".$_SESSION['UserID']."' and ".
        //    "pag.SectionID = stu.SectionID ";
    /*****/
    /*
$result = $dbc->prepare('SELECT page, linktext, visable, parent FROM content WHERE visable > 0 ORDER BY parent,sort ASC');
$result->execute();
$result->bind_result($menu_page, $menu_linktext, $menu_visible, $menu_parent);
     */
        $result = $conn->prepare("SELECT PageID, ClassID, SectionID, Title ".
                                 "FROM page ".
                                 //"join class cla on cla.ClassID = pag.PageID.". 
                                 "WHERE ClassID = '".$sectionID."' and SectionID = '".$sectionID."', sort ASC"); //$dbc
        $result->execute();
        $result->bind_result($menu_page, $menu_linktext, $menu_visible, $menu_parent);
    
        while($result->fetch()) {
            if($menu_parent == 0) {
                $menu[$menu_page]=$menu_linktext;
            }
            elseif(!empty($menu[$menu_parent])) {
                $sub[$menu_parent][]=$menu_linktext;
            }
        }
    
        $result->close();
    
        if(!empty($menu)) {
            echo '<ul class="sf-menu" id="nav">';
            foreach($menu as $page=>$link) {
                echo "<li><a href='$link'>$link</a>";
                /*if(!empty($sub[$page])) {
                    echo '<ul>';
                    foreach($sub[$page] as $lnk) echo "<li><a href='$lnk'>$lnk</a></li>";
                    echo '</ul>';
                }*/
                echo '</li>';
            }
        echo '</ul>';
        }
    }
?>