<?php
require dirname(__FILE__) . '/../cms/core.php';
require dirname(__FILE__) . '/../cms/pages.php';
genPageHeader($_GET['encoding']);
genWebsiteMenu($_GET['encoding']);
showProjectPage(2, $_GET['encoding']);
closePage($_GET['encoding']);
?>
