<?php
    require dirname(__FILE__) . '/cms/core.php';
    require dirname(__FILE__) . '/cms/pages.php';

    $encoding = "";
    if($_GET['encoding']) {
        $encoding = $_GET['encoding'];
    } else {
        $encoding = "utf-8";
    }

    $db = new SQLite3(dirname(__FILE__) . '/cms/pub.db');
    loadTemplate($db, $_GET['encoding'], showHardwarePage($db, $encoding));
?>
