<?php
    require dirname(__FILE__) . '/cms/core.php';
    require dirname(__FILE__) . '/cms/pages.php';

    $db = new SQLite3(dirname(__FILE__) . '/cms/pub.db');
    if($_GET['page']) {
        loadTemplate($db, $_GET['encoding'], showProjectPage($_GET['page'], $_GET['encoding']));
    } else {
        loadTemplate($db, $_GET['encoding'], showProjectsPage($db, $_GET['encoding']));
    }
    closePage($_GET['encoding']);
?>
