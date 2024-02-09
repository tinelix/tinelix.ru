<?php
    require dirname(__FILE__) . '/cms/src/core.php';
    require dirname(__FILE__) . '/cms/src/pages.php';

    $encoding = "";
    if($_GET['encoding']) {
        $encoding = $_GET['encoding'];
    } else {
        $encoding = "utf-8";
    }

    if($_GET['page']) {
        Tinelix\Oldwebsite\loadTemplate($db, $_GET['encoding'], showProjectPage($_GET['page'], $encoding));
    } else {
        Tinelix\Oldwebsite\loadTemplate($db, $_GET['encoding'], showProjectsPage($db, $encoding));
    }

    unset($db);
?>
