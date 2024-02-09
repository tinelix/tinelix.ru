<?php
    use ByJG\Jinja\Template;

    require dirname(__FILE__).'/cms/src/core.php';
    require dirname(__FILE__).'/cms/src/pages.php';
    require dirname(__FILE__).'/../vendor/autoload.php';

    $db = new SQLite3(dirname(__FILE__) . '/cms/src/pub.db');

    $encoding = "";
    if($_GET['encoding']) {
        $encoding = $_GET['encoding'];
    } else {
        $encoding = "utf-8";
    }

    loadTemplate($db, $encoding, showStartPage($db, $encoding));

    unset($db);
?>
