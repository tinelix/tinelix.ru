<?php
require dirname(__FILE__) . '/cms/core.php';
require dirname(__FILE__) . '/cms/pages.php';
$db = new SQLite3(dirname(__FILE__) . '/cms/pub.db');
genPageHeader($_GET['encoding']);
genWebsiteMenu($_GET['encoding']);
if($_GET['page']) {
    showProjectPage($_GET['page'], $_GET['encoding']);
} else {
    showProjectsPage($db, $_GET['encoding']);
}
closePage($_GET['encoding']);
?>
