<?php
    require dirname(__FILE__) . '/cms/src/core.php';
    require dirname(__FILE__) . '/cms/src/pages.php';

    $db = new SQLite3(dirname(__FILE__) . '/cms/pub.db');

    $encoding = "utf-8";

    loadTemplate($db, $encoding, showStartPage($db, $_GET['encoding']));
?>
