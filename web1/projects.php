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

    if($_GET['page']) {
        loadTemplate($db, $_GET['encoding'], showProjectPage($_GET['page'], $encoding));
    } else {
        loadTemplate($db, $_GET['encoding'], showProjectsPage($db, $encoding));
    }
    closePage($_GET['encoding']);
?>
