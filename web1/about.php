<?php
require dirname(__FILE__) . '/cms/core.php';

    global $encoding;
    
    if(strlen($encoding) > 0)
        $encoding = $_GET['encoding'];

    $cms = new TinelixCms\Core($encoding);

    $cms->template->genPageHeader();
    $cms->template->genWebsiteMenu();
    
    $cms->pages->showAboutPage();
    
	$cms->template->closePage();
    $cms->closeDatabase();
?>
