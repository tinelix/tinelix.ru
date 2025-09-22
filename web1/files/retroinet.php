<?php
    require dirname(__FILE__) . '/../cms/core.php';

    global $encoding;
    global $protocol;
    
    $protocol = isset($_SERVER['HTTPS']) ? 
        'https://' : 'http://';
    
    if(strlen($encoding) > 0)
        $encoding = $_GET['encoding'];

    $cms = new TinelixCms\Core($protocol, $encoding);

    $cms->template->genPageHeader();
    $cms->template->genWebsiteMenu();

    $cms->pages->getNewYearCountdown();
    
    $cms->pages->showRetroInternetPage();
    
	$cms->template->closePage();
    $cms->closeDatabase();
?>
