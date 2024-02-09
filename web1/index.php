<?php
    require dirname(__FILE__) . '/cms/src/core.php';
    require dirname(__FILE__) . '/cms/src/pages.php';

    $encoding = "";
    if($_GET['encoding']) {
        $encoding = $_GET['encoding'];
    } else {
        $encoding = "utf-8";
    }

    Tinelix\Oldwebsite\loadTemplate($db, $encoding, showStartPage($db, $encoding));

    unset($db);
?>
