<?php
    require dirname(__FILE__) . '/cms/src/core.php';
    require dirname(__FILE__) . '/cms/src/pages.php';

    $db = new SQLite3(dirname(__FILE__) . '/cms/src/pub.db');

    $encoding = "utf-8";

    Tinelix\Oldwebsite\loadTemplate($db, $encoding, showStartPage($db, $encoding));
?>
