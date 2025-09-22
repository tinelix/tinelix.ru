<?php
include_once dirname(__FILE__) . '/../cms/core.php';

global $lite;
global $encoding;
global $protocol;

if(count($_GET) > 0)
    $lite = $_GET['lite'];
    
if(strlen($_GET['encoding']) > 0)
    $encoding = $_GET['encoding'];
    
$protocol = isset($_SERVER['HTTPS']) ? 
    'https://' : 'http://';

$cms = new TinelixCms\Core($protocol, $encoding);

if($lite) {
    $cms->template->genPageHeader();
    $cms->template->genWebsiteMenu();
    $cms->pages->getNewYearCountdown();
    $cms->pages->showStartPage();
    $cms->template->closePage();
} else {
    $cms->pages->showNewStartPage();
}

$cms->closeDatabase();
?>
