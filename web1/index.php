<?php
include_once dirname(__FILE__) . '/cms/core.php';

global $lite;
global $encoding;

if(count($_GET) > 0)
    $lite = $_GET['lite'];
    
if(strlen($encoding) > 0)
    $encoding = $_GET['encoding'];

$cms = new TinelixCms\Core($encoding);

if($lite) {
    $cms->template->genPageHeader();
    $cms->template->genWebsiteMenu();
    $cms->pages->showStartPage();
    $cms->template->closePage();
} else {
    $cms->pages->showNewStartPage();
}
$cms->closeDatabase();
?>
