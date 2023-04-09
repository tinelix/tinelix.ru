<?php
require dirname(__FILE__) . '/cms/core.php';
require dirname(__FILE__) . '/cms/pages.php';
$db = new SQLite3(dirname(__FILE__) . '/cms/pub.db');
genPageHeader($_GET['encoding']);
genWebsiteMenu($_GET['encoding']);
showHardwarePage($db, $_GET['encoding']);
closePage($_GET['encoding']);
?>
