<?php
    require dirname(__FILE__) . '/cms/src/core.php';
    require dirname(__FILE__) . '/cms/src/pages.php';

    $db = new SQLite3(dirname(__FILE__) . '/cms/src/pub.db');

    $encoding = "";
    if($_GET['encoding']) {
        $encoding = $_GET['encoding'];
    } else {
        $encoding = "utf-8";
    }

    Tinelix\Oldwebsite\loadTemplate($db, $_GET['encoding'], showAboutPage($db, $encoding));

    unset($db);
?>
