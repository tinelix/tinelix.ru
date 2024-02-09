<?php
require dirname(__FILE__) . '/cms/core.php';
require dirname(__FILE__) . '/cms/pages.php';

    $db = new SQLite3(dirname(__FILE__) . '/cms/pub.db');
    loadTemplate($db, $_GET['encoding'], showStartPage($db, $_GET['encoding']));
?>
