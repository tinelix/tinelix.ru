<?php
    require dirname(__FILE__) . '/cms/core.php';
    require dirname(__FILE__) . '/cms/pages.php';

    $db = new SQLite3(dirname(__FILE__) . '/cms/pub.db');

    $encoding = "";
    if($_GET['encoding']) {
        $encoding = $_GET['encoding'];
    } else {
        $encoding = "utf-8";
    }

    loadTemplate($db, , showStartPage($db, $_GET['encoding']));
?>
