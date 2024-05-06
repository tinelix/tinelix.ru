<?php
require dirname(__FILE__) . '/cms/core.php';
require dirname(__FILE__) . '/cms/pages.php';

$db = new SQLite3(dirname(__FILE__) . '/cms/pub.db');

genPageHeader($_GET['encoding']);
genWebsiteMenu($db, $_GET['encoding']);
showRetroInternetPage($db, $_GET['encoding']);
closePage($_GET['encoding']);

$db->close();
unset($db);
?>
