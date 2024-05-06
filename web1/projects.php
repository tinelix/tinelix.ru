<?php
require dirname(__FILE__) . '/cms/core.php';
require dirname(__FILE__) . '/cms/pages.php';
$db = new SQLite3(dirname(__FILE__) . '/cms/pub.db');
genPageHeader($_GET['encoding']);
genWebsiteMenu($db, $_GET['encoding']);
if($_GET['page']) {
    showProjectPage($db, $_GET['page'], $_GET['encoding']);
} else {
    showProjectsPage($db, $_GET['encoding']);
}
closePage($_GET['encoding']);
$db->close();
unset($db);
?>
