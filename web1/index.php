<?php
    require dirname(__FILE__) . '/cms/core.php';
    require dirname(__FILE__) . '/cms/pages.php';

    $db = new SQLite3(dirname(__FILE__) . '/cms/pub.db');

    $encoding = "";
    if($_GET['encoding'] ?? null) {
        $encoding = "utf-8";
    } else {
        $encoding = $_GET['encoding'];
    }

    loadTemplate($db, $encoding, showStartPage($db, $_GET['encoding']));
?>
