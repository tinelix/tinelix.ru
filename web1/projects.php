<?php
    require dirname(__FILE__) . '/cms/core.php';

    global $encoding;
    
    if(strlen($encoding) > 0)
        $encoding = $_GET['encoding'];

    $cms = new TinelixCms\Core($encoding);

    $cms->template->genPageHeader();
    $cms->template->genWebsiteMenu();
    if($_GET['page']) {
        $cms->pages->showProjectPage($_GET['page']);
    } else {
        $cms->pages->showProjectsPage();
    }
    $cms->template->closePage();
    $cms->closeDatabase();
?>
