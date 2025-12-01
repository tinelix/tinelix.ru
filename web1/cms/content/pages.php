<?php
namespace TinelixCms\Content;

include_once dirname(__FILE__) . '/../includes.php';
include_once dirname(__FILE__) . '/../core.php';

use TinelixCms\Core;

class PagesCollection {

    private $db;
    private $cms;
    private $priv_db;
    private $purifier;

    public function __construct($source_db, $source_priv_db, $source_cms) {
        $this->db = $source_db;
        $this->cms = $source_cms;
        $this->priv_db = $source_priv_db;
        $this->purifier = $source_cms->purifier;
    }

    public function showNewStartPage() {
        if($this->cms->encoding == "utf-8") {
            header('Content-Type: text/html; charset=utf-8');
        } else {
            header('Content-Type: text/html; charset=windows-1251');
        }
        $html = "<!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.01 Transitional//EN\">
        \r\n<!-- HTML4 PAGE !-->
        \r\n<html>
        \r\n    <head>
        ";

        $params = "";

        $current_time = new \DateTime('now', new \DateTimeZone('Europe/Moscow'));
        $current_time->setTimestamp($current_time->getTimestamp() + (3 * 60 * 60));

        $day_of_month = intval(date('j', $current_time->getTimestamp()));
        $month = intval(date('m', $current_time->getTimestamp()));

        $formattedMskTime = Core::getFullFormattedMskTime();

        if(!$this->cms->encoding || $this->cms->encoding != "utf-8") {
            $html = $html."
            \r\n        <meta http-equiv=\"Content-Type\" content=\"text/html; charset=windows-1251\">";
        } else {
            $html = $html."
            \r\n        <meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\">";
        }

        $html = $html."
        \r\n        <title>Tinelix (стиль Web 1.0)</title>
        \r\n        <link rel=\"stylesheet\" href=\"".$this->cms->protocol.web1_subdomain."/style.css\">
        \r\n        <link rel=\"stylesheet\" href=\"".$this->cms->protocol.web1_subdomain."/icons.css\">
        \r\n    </head>
        \r\n    <body bgcolor=\"#000000\" text=\"#ffffff\">
        \r\n        <p align=\"center\" style=\"font-size: 14pt;
        \r\n                                    margin-top: 15px;
        \r\n                                    margin-bottom: 0px
        \r\n                                  \"><b>Приветствуем!</b></p>
        \r\n        <p align=\"center\" style=\"font-size: 10pt; margin-top: 2px\">".htmlspecialchars($formattedMskTime)."</p>
        \r\n        <p align=\"center\">Если не видишь картинки, кликни <a href=\"".$this->cms->protocol.web1_subdomain."?lite=1\">сюда.</p>
        \r\n        <div align=\"center\">";

        $columns = "";

        if(strcmp($this->cms->protocol, "https://") == 0)
            $columns = "id, item_name, tls_link, icon_class, small_icon_path";
        else
            $columns = "id, item_name, link, icon_class, small_icon_path";

        $query = "SELECT ".$columns." FROM menu WHERE id >= 0 ORDER BY id ASC;";
        $result = $this->db->query($query);
        $menu_items = array();

        while($menu_item = $result->fetchArray()) {
            array_push($menu_items, $menu_item);
        }

        $html = $html."
        \r\n<table width=\"560\" height=\"560\">
        \t\n    <tbody>";

        for($i = 0; $i < count($menu_items); ++$i) {
            if($menu_items[$i][0] % 3 == 0) {
                $html = $html."
                \r\n                    <tr>";
            }
            if($i == 0)
                $html = $html."
                \r\n    <td align=\"right\" valign=\"bottom\">";
            else if($i == 1)
                $html = $html."
                \r\n    <td align=\"center\" valign=\"top\">";
            else if($i == 2)
                $html = $html."
                \r\n    <td align=\"left\" valign=\"bottom\">";
            else if($i == 3)
                $html = $html."
                \r\n    <td align=\"left\">";
            else if($i == 4)
                $html = $html."
                \r\n    <td align=\"center\">";
            else if($i == 5)
                $html = $html."
                \r\n    <td align=\"right\">";
            else if($menu_items[$i][0] % 3 == 0)
                $html = $html."
                \r\n    <td align=\"right\" valign=\"top\">";
            else if($menu_items[$i][0] % 3 == 1)
                $html = $html."
                \r\n    <td align=\"center\" valign=\"bottom\">";
            else
                $html = $html."
                \r\n    <td align=\"left\" valign=\"top\">";

            if($this->cms->encoding) {
                if(str_contains($menu_items[$i][2], web1_subdomain)) {
                    if(str_contains($menu_items[$i][2], "?"))
                        $params = "&amp;encoding=".htmlspecialchars($this->cms->encoding);
                    else
                        $params = "?encoding=".htmlspecialchars($this->cms->encoding);
                } else {
                    $params = "";
                }
            }

            if($i == 4) {
                if($day_of_month == 1 && $month == 6) {
                    $html = $html."
                    \r\n        <a href=\"".$this->cms->protocol.htmlspecialchars($menu_items[$i][2]).$params."\" class=\"big-icon-center big-icon-seasons-june1-".htmlspecialchars($menu_items[$i][3])."\"></a>
                    \r\n    </td>";
                } else if(($month == 11 && $day_of_month >= 27) || $month == 12 || ($month == 1 && $day_of_month <= 14)) {
                    $html = $html."
                    \r\n        <a href=\"".$this->cms->protocol.htmlspecialchars($menu_items[$i][2]).$params."\" class=\"big-icon-center big-icon-seasons-newyear-".htmlspecialchars($menu_items[$i][3])."\"></a>
                    \r\n    </td>";
                } else {
                    $html = $html."
                    \r\n        <a href=\"".$this->cms->protocol.htmlspecialchars($menu_items[$i][2]).$params."\" class=\"big-icon-center big-icon-".htmlspecialchars($menu_items[$i][3])."\"></a>
                    \r\n    </td>";
                }
            } else {
                $html = $html."
                \r\n        <a href=\"".$this->cms->protocol.htmlspecialchars($menu_items[$i][2].$params)."\" class=\"big-icon big-icon-".htmlspecialchars($menu_items[$i][3])."\"></a>
                \r\n    </td>";
            }

            if($menu_items[$i][0] % 3 == 2) {
                $html = $html."
                \r\n                    </tr>";
            }
        }

        $html = $html."
        \r\n            </tbody>
        \r\n        </table>
        \r\n            <p>
        \r\n            <table width=\"640\" class=\"footer\" cellpadding=\"4\">
        \r\n                <tbody>
        \r\n                    <tr>
        \r\n                        <td align=\"center\">
        \r\n                            Copyright © 2023-2025 Dmitry Tretyakov (aka. Tinelix). Стиль Web 1.0.
        \r\n                            <br><a href=\"https://github.com/tinelix/tinelix.ru\">Исходный код сайта</a>
        \r\n                            <p>
        \r\n                            <img style=\"border:0;\"
        \r\n                                     src=\"".$this->cms->protocol.web1_subdomain."/banners/anybrowser.gif\"
        \r\n                                     alt=\"Лучше смотрится с любым браузером\" height=\"31\" width=\"88\">
        \r\n                            <a href=\"https://gnu.org\">
        \r\n                                <img style=\"border:0;width:88px;height:31px\"
        \r\n                                     src=\"".$this->cms->protocol.web1_subdomain."/banners/gnu.png\"
        \r\n                                     alt=\"Свободное ПО нужно каждому!\" />
        \r\n                            </a>
        \r\n                            <a href=\"http://old-web.com\">
        \r\n                                <img style=\"border:0;width:88px;height:31px\"
        \r\n                                     src=\"".$this->cms->protocol.web1_subdomain."/banners/old-web.gif\"
        \r\n                                     alt=\"Old-Web.com - возвращаем старый Интернет и старые сайты, обсуждаем старые технологии\" />
        \r\n                            </a>
        \r\n                        </td>
        \r\n                    </tr>
        \r\n                </tbody>
        \r\n            </table>
        \r\n        </div>
        \r\n    </body>
        \r\n</html>";
        if(!$this->cms->encoding || $this->cms->encoding != "utf-8") {
            echo mb_convert_encoding($html, "windows-1251", "utf-8");
        } else {
            echo $html;
        }
    }

    public function showStartPage() {
        $query = "SELECT id, title, body FROM articles WHERE on_start_page = 1 LIMIT 1;";
        $result = $this->db->query($query);
        $article = $result->fetchArray();
        $article_title = mb_strtoupper($article[1]);
        $html =  "\r\n
        \r\n  <td bgcolor=\"#000000\" valign=\"top\">
        \r\n                        <div class=\"title-text\">".htmlspecialchars($article_title)."</div>
        \r\n                        <hr class=\"title-line\" size=\"1\" noshade />
        \r\n                        <div class=\"text\">".$this->purifier->purify($article[2])."</div>
        \r\n                    </td>";
        if(!$this->cms->encoding || $this->cms->encoding != "utf-8") {
            echo mb_convert_encoding($html, "windows-1251", "utf-8");
        } else {
            echo $html;
        }
    }

    public function showAboutPage() {
        $query = "SELECT id, title, body FROM about LIMIT 1;";
        $result = $this->db->query($query);
        $about_page = $result->fetchArray();
        $about_page_title = mb_strtoupper($about_page[1]);
        $html = "
        \r\n                    <td bgcolor=\"#000000\" valign=\"top\" rowspan=\"3\">
        \r\n                        <div class=\"title-text\">".htmlspecialchars($about_page_title)."</div>
        \r\n                        <hr class=\"title-line\" size=\"1\" noshade />
        \r\n                        <div class=\"text\">
        \r\n                            ".$this->purifier->purify($about_page[2]);
        $html = $html."\r\n               <h3 class=\"lime-header\">Контакты</h3>";
        $query = "SELECT id, name, value FROM contacts;";
        $result = $this->db->query($query) or die("Last error: {$this->db->lastErrorMsg()}\n");
        $contacts = array();
        while($contact = $result->fetchArray()) {
            array_push($contacts, $contact);
        }
        for($i = 0; $i < count($contacts); ++$i) {
            $html = $html."
            \r\n                            <b>".$this->purifier->purify($contacts[$i][1]).":</b> ".$this->purifier->purify($contacts[$i][2])."<br>";
        }
        $html = $html."
        \r\n
        \r\n                        </div>
        \r\n                    </td>";
        if(!$this->cms->encoding || $this->cms->encoding != "utf-8") {
            echo mb_convert_encoding($html, "windows-1251", "utf-8");
        } else {
            echo $html;
        }
    }

    public function showProjectsPage() {
        $query = "SELECT id, name, description, link FROM projects;";
        $result = $this->db->query($query) or die("Last error: {$this->db->lastErrorMsg()}\n");
        $projects = array();
        $html = "\r\n                    <td bgcolor=\"#000000\" valign=\"top\" rowspan=\"3\">
        \r\n                        <div class=\"title-text\">ПРОЕКТЫ</div>
        \r\n                        <hr class=\"title-line\" size=\"1\" noshade />
        \r\n                        <div class=\"text\">";
        $params = "";
        while($project = $result->fetchArray()) {
            array_push($projects, $project);
        }
        for($i = 0; $i < count($projects); ++$i) {
            if($html_encoding) {
                if(strpos($projects[$i][3], "?")) {
                    $params = "&encoding=".$this->db->encoding;
                } else {
                    $params = "?encoding=".$this->db->encoding;
                }
            }
            $html = $html."
            \r\n                            <a href=\"".htmlspecialchars($projects[$i][3].$params)."\">".htmlspecialchars($projects[$i][1])."</a>
            \r\n                            <br><span class=\"subtext\">".$this->purifier->purify($projects[$i][2])."</span>";
            if($i < count($projects) - 1) {
                $html = $html. "
                \r\n                            <hr size=\"1\"/>";
            }
        }
        $html = $html."
        </div>
        \r\n                    </td>";
        if(!$this->cms->encoding || $this->cms->encoding != "utf-8") {
            echo mb_convert_encoding($html, "windows-1251", "utf-8");
        } else {
            echo $html;
        }
    }

    public function showProjectPage($i) {
        $html = "";
        $query = "SELECT id, title, body, address FROM pages WHERE address = 'projects.php?page={$i}' LIMIT 1;";
        $result = $this->db->query($query) or die("Last error: {$this->db->lastErrorMsg()}\n");
        $page = $result->fetchArray();
        $page_title = mb_strtoupper($page[1]);

        if($i > 0 && $i <= 3) {
            $html = "
            \r\n                    <td bgcolor=\"#000000\" valign=\"top\" rowspan=\"3\">
            \r\n                        <div class=\"title-line\">".htmlspecialchars($page_title)."</div>
            \r\n                        <hr class=\"accent-color\" size=\"1\" />
            \r\n                        <div class=\"text\">
            \r\n				".$this->purifier->purify($page[2])."
            \r\n                        </div>
            \r\n                    </td>";
        } else {
            $html = "
            \r\n                    <td bgcolor=\"#000000\" valign=\"top\">
            \r\n                        <div class=\"title-text\">ОШИБКА</div>
            \r\n                        <hr class=\"title-line\" size=\"1\" noshade />
            \r\n                        <div class=\"text\">
            \r\n                           Такой страницы не существует.
            \r\n                        </div>
            \r\n                    </td>";
        }
        if(!$this->cms->encoding || $this->cms->encoding != "utf-8") {
            echo mb_convert_encoding($html, "windows-1251", "utf-8");
        } else {
            echo $html;
        }
    }

    public function showHardwarePage() {
        $html = "\r\n                    <td bgcolor=\"#000000\" valign=\"top\" rowspan=\"3\">
        \r\n                        <div class=\"title-text\">ОБОРУДОВАНИЕ</div>
        \r\n                        <hr class=\"title-line\" size=\"1\" noshade />
        \r\n                        <div class=\"text\">";

        $query = "SELECT id, name, specs FROM hardware WHERE type = 0;";
        $result = $this->db->query($query) or die("Last error: {$this->db->lastErrorMsg()}\n");
        $computers = array();
        while($computer = $result->fetchArray()) {
            array_push($computers, $computer);
        }
        $html = $html."\r\n                          <h3>Компьютеры</h3>";
        for($i = 0; $i < count($computers); ++$i) {
            $html = $html."
            \r\n                            <h4>".htmlspecialchars($computers[$i][1])."</h4>
            \r\n                            ".$this->purifier->purify($computers[$i][2]);
        }

        $query = "SELECT id, name, specs FROM hardware WHERE type = 1;";
        $result = $this->db->query($query) or die("Last error: {$this->db->lastErrorMsg()}\n");
        $laptops = array();
        while($laptop = $result->fetchArray()) {
            array_push($laptops, $laptop);
        }
        $html = $html."\r\n                          <h3 class=\"lime-header\">Ноутбуки</h3>";
        for($i = 0; $i < count($laptops); ++$i) {
            $html = $html."
            \r\n                            <h4>".htmlspecialchars($laptops[$i][1])."</h4>
            \r\n                            ".$this->purifier->purify($laptops[$i][2]);
        }

        $html = $html."\r\n                          <h3 class=\"magenta-header\">Смартфоны</h3>";
        $query = "SELECT id, name, specs FROM hardware WHERE type = 2;";
        $result = $this->db->query($query) or die("Last error: {$this->db->lastErrorMsg()}\n");
        $phones = array();
        while($phone = $result->fetchArray()) {
            array_push($phones, $phone);
        }
        for($i = 0; $i < count($phones); ++$i) {
            $html = $html."
            \r\n                            <h4>".htmlspecialchars($phones[$i][1])."</h4>
            \r\n                            ".$this->purifier->purify($phones[$i][2]);
        }

        $html = $html."<p style=\"font-size: 9pt\"><b>*</b> Несмотря на то, что готовая конфигурация была идентичной, компьютер был пересобран перед покупкой.</p>";

        $html = $html."</div>
        \r\n                    </td>";

        if(!$this->cms->encoding || $this->cms->encoding != "utf-8") {
            echo mb_convert_encoding($html, "windows-1251", "utf-8");
        } else {
            echo $html;
        }
    }

    public function showWebsiteBannersPage() {
        $query = "SELECT id, name, link FROM banners;";
        $result = $this->db->query($query) or die("Last error: {$this->db->lastErrorMsg()}\n");
        $banners = array();
        $html = "\r\n                    <td bgcolor=\"#000000\" valign=\"top\" rowspan=\"3\">
        \r\n                        <div class=\"title-text\">БАННЕР ДЛЯ САЙТА</div>
        \r\n                        <hr class=\"title-line\" size=\"1\" noshade/>
        \r\n                        <div class=\"text\">
        \r\n                        Прикрепите любой из предложенных баннеров на свой ретросайт, так нас проще будет найти.
        \r\n<p><div class=\"warning-banner\"><b>ВНИМАНИЕ!</b> Для показа баннеров на современных браузерах советуем отключить блокировщик рекламы или добавить сайт <b>".web1_subdomain."</b> в исключения блокировки.</div>";
        while($banner = $result->fetchArray()) {
            array_push($banners, $banner);
        }
        for($i = 0; $i < count($banners); ++$i) {
            $html = $html."
            \r\n                            <h4>".htmlspecialchars($banners[$i][1])."</h4>
            \r\n                            <div align=\"center\">
            \r\n                                <img src=\"".$this->cms->protocol.htmlspecialchars($banners[$i][2])."\" width=\"88\" height=\"31\" alt=\"\">
            \r\n                                <p>
            \r\n                                <textarea rows=\"4\" cols=\"40\" readonly class=\"full-code\">
            &lt;a href=\"".$this->cms->protocol.web1_subdomain."\"&gt;&lt;img src=\"http://".$banners[$i][2]."\" width=\"88\" height=\"31\" border=\"0\"/&gt;&lt;/a&gt;</textarea>
            </div>
            \r\n                            ";
        }
        $html = $html."</div>
        \r\n                    </td>";
        if(!$this->cms->encoding || $this->cms->encoding != "utf-8") {
            echo mb_convert_encoding($html, "windows-1251", "utf-8");
        } else {
            echo $html;
        }
    }

    public function showRetroInternetPage() {
        $html = "";
        $query = "SELECT id, title, body, address FROM pages WHERE address = 'retroinet.php' LIMIT 1;";
        $result = $this->db->query($query) or die("Last error: {$this->db->lastErrorMsg()}\n");
        $page = $result->fetchArray();
        $page_title = mb_strtoupper($page[1]);

        $html = "
        \r\n                    <td bgcolor=\"#000000\" valign=\"top\" rowspan=\"3\">
        \r\n                        <div class=\"title-text\">".htmlspecialchars($page_title)."</div>
        \r\n                        <hr class=\"accent-color\" size=\"1\" noshade />
        \r\n                        <div class=\"text\">
        \r\n				            ".$this->purifier->purify($page[2])."
        \r\n                        </div>
        \r\n                    </td>";
        if(!$this->cms->encoding || $this->cms->encoding != "utf-8") {
            echo mb_convert_encoding($html, "windows-1251", "utf-8");
        } else {
            echo $html;
        }
    }

    function getNewYearCountdown() {
        $year = Core::getCurrentYear();

        $current_time = time();

        $msk = 3 * 60 * 60;

        $new_year = strtotime(($year + 1)."-01-01");
        $new_year_countdown = floor((-$current_time - $msk + $new_year) / (60 * 60 * 24));

        if($new_year_countdown >= 0 && $year == 2025) {
            $new_year_countdown_h = floor((-$current_time - $msk + $new_year) / (60 * 60)) % 24;
            $new_year_countdown_min = floor((-$current_time - $msk  + $new_year) / 60) % 60;
            $new_year_countdown_sec = floor(-$current_time - $msk + $new_year) % 60;
        } else {
            $new_year_countdown = 0;
            $new_year_countdown_h = 0;
            $new_year_countdown_min = 0;
            $new_year_countdown_sec = 0;
        }

        if($new_year_countdown <= 100) {
            $html = "
            \r\n			    <div class=\"left-sidebar\" style=\"background-image: url(images/cells/ny_countdown.gif); height: 120px\">
            \r\n                        <div style=\"height: 20px\">
            \r\n                            <div class=\"title-text\" style=\"color: white;\">ДО НОВОГО ГОДА</div>
            \r\n                            <hr class=\"title-line cell\" size=\"1\" noshade />
            \r\n                            <div class=\"text\" style=\"margin-bottom: 0px; text-align: center\">
            \r\n                                    <span style=\"font-size: 22pt; color: #4fff4f\"><b>".$new_year_countdown."</b></span>
            \r\n					                <br><span>дн.</span>
            \r\n							<p style=\"margin-top: 4px; font-size: 10pt;\"><a href=\"".$this->cms->protocol.web1_subdomain."/newyear.php\">Подробнее >>></a>
            \r\n                            </div>
            \r\n                        </div>
            \r\n			    </div>
            \r\n
            ";
        if(!$this->cms->encoding || $this->cms->encoding != "utf-8") {
            echo mb_convert_encoding($html, "windows-1251", "utf-8");
        } else {
            echo $html;
        }
        }
    }

    function showMoreNewYearCountdown() {
        $year = "2025";

        $current_time = time();

        $tz_offset = 3 * 60 * 60;

        $tz_name = "Europe/Moscow";
        $l18n_tz_name = "Московское время: ";

        if(isset($_POST["region"])) {
            switch($_POST["region"]) {
                case "berlin":
                    $l18n_tz_name = "Время в Берлине: ";
                    $tz_name = "Europe/Berlin";
                    $tz_offset = 1 * 60 * 60;
                    break;
                case "paris":
                    $l18n_tz_name = "Время в Париже: ";
                    $tz_name = "Europe/Paris";
                    $tz_offset = 1 * 60 * 60;
                    break;
                case "helsinki":
                    $l18n_tz_name = "Время в Хельсинки: ";
                    $tz_name = "Europe/Helsinki";
                    $tz_offset = 1 * 60 * 60;
                    break;
                case "kiev":
                    $l18n_tz_name = "Киевское время: ";
                    $tz_name = "Europe/Kiev";
                    $tz_offset = 2 * 60 * 60;
                    break;
                case "kaliningrad":
                    $l18n_tz_name = "Время в Калининграде: ";
                    $tz_name = "Europe/Kaliningrad";
                    $tz_offset = 2 * 60 * 60;
                    break;
                case "sevastopol":
                    $l18n_tz_name = "Время в Севастополе: ";
                    $tz_name = "Europe/Moscow";
                    $tz_offset = 3 * 60 * 60;
                    break;
                case "donetsk":
                    $l18n_tz_name = "Время в Донецке: ";
                    $tz_name = "Europe/Moscow";
                    $tz_offset = 3 * 60 * 60;
                    break;
                case "lugansk":
                    $l18n_tz_name = "Время в Луганске: ";
                    $tz_name = "Europe/Moscow";
                    $tz_offset = 3 * 60 * 60;
                    break;
                case "yerevan":
                    $l18n_tz_name = "Время в Ереване: ";
                    $tz_name = "Asia/Yerevan";
                    $tz_offset = 4 * 60 * 60;
                    break;
                case "astrakhan":
                    $l18n_tz_name = "Время в Астрахани: ";
                    $tz_name = "Europe/Astrakhan";
                    $tz_offset = 4 * 60 * 60;
                    break;
                case "volgograd":
                    $l18n_tz_name = "Время в Волгограде: ";
                    $tz_name = "Europe/Volgograd";
                    $tz_offset = 4 * 60 * 60;
                    break;
                case "ulyanovsk":
                    $l18n_tz_name = "Время в Ульяновске: ";
                    $tz_name = "Europe/Volgograd";
                    $tz_offset = 4 * 60 * 60;
                    break;
                case "samara":
                    $l18n_tz_name = "Самарское время: ";
                    $tz_name = "Europe/Samara";
                    $tz_offset = 4 * 60 * 60;
                    break;
                case "yekaterinburg":
                    $l18n_tz_name = "Время в Екатеринбурге: ";
                    $tz_offset = 5 * 60 * 60;
                    break;
                case "chelyabinsk":
                    $l18n_tz_name = "Время в Челябинске: ";
                    $tz_offset = 5 * 60 * 60;
                    break;
                case "astana":
                    $l18n_tz_name = "Время в Алмате: ";
                    $tz_offset = 5 * 60 * 60;
                    break;
                case "omsk":
                    $l18n_tz_name = "Омское время: ";
                    $tz_name = "Asia/Omsk";
                    $tz_offset = 6 * 60 * 60;
                    break;
                case "novosibirsk":
                    $l18n_tz_name = "Новосибирское время: ";
                    $tz_name = "Asia/Novosibirsk";
                    $tz_offset = 7 * 60 * 60;
                    break;
                case "barnaul":
                    $l18n_tz_name = "Время в Барнауле: ";
                    $tz_name = "Asia/Barnaul";
                    $tz_offset = 7 * 60 * 60;
                    break;
                case "gorno-altaisk":
                    $l18n_tz_name = "Время в Горно-Алтайске: ";
                    $tz_name = "Etc/UTC+7";
                    $tz_offset = 7 * 60 * 60;
                    break;
                case "krasnoyarsk":
                    $l18n_tz_name = "Красноярское время: ";
                    $tz_name = "Asia/Krasnoyarsk";
                    $tz_offset = 7 * 60 * 60;
                    break;
                case "tomsk":
                    $l18n_tz_name = "Время в Томске: ";
                    $tz_name = "Etc/UTC+7";
                    $tz_offset = 7 * 60 * 60;
                    break;
                case "irkutsk":
                    $l18n_tz_name = "Время в Иркутске: ";
                    $tz_name = "Etc/UTC+7";
                    $tz_offset = 7 * 60 * 60;
                    break;
                case "beijing":
                    $l18n_tz_name = "Пекинское время: ";
                    $tz_name = "Asia/Shanghai";
                    $tz_offset = 8 * 60 * 60;
                    break;
                case "yakutsk":
                    $l18n_tz_name = "Время в Якутске: ";
                    $tz_name = "Etc/UTC+9";
                    $tz_offset = 9 * 60 * 60;
                    break;
                case "vladivostok":
                    $l18n_tz_name = "Время во Владивостоке: ";
                    $tz_name = "Asia/Vladivostok";
                    $tz_offset = 10 * 60 * 60;
                    break;
                case "magadan":
                    $l18n_tz_name = "Магаданское время: ";
                    $tz_name = "Asia/Magadan";
                    $tz_offset = 11 * 60 * 60;
                    break;
            }
        }

        $new_year = strtotime(($year + 1)."-01-01");
        $new_year_countdown = floor((-$current_time - $tz_offset + $new_year) / (60 * 60 * 24));

        if($new_year_countdown >= 0) {
            $new_year_countdown_h = floor((-$current_time - $tz_offset + $new_year) / (60 * 60)) % 24;
            $new_year_countdown_min = floor((-$current_time - $tz_offset  + $new_year) / 60) % 60;
            $new_year_countdown_sec = floor(-$current_time - $tz_offset + $new_year) % 60;
        } else {
            $new_year_countdown = 0;
            $new_year_countdown_h = 0;
            $new_year_countdown_min = 0;
            $new_year_countdown_sec = 0;
        }

        if($new_year_countdown <= 100 && $new_year_countdown >= 0) {
            $page = "<h3 style=\"background: none; background-color: transparent; color: #ffffff\">До Нового года осталось</h3>
            <table cellpadding=\"0\" cellspacing=\"0\" align=\"center\" border=\"0\" width=\"140\" height=\"140\">
            <tbody>
            <td width=\"114\">
            <div>
            <div style=\"background: url(".$this->cms->protocol.web1_subdomain."/images/newyear/ny_countdown_frame.gif) no-repeat; background-position: center;
            font-family: Shantell Sans Medium; font-size: 25pt; padding-top: 38px; padding-bottom: 36px;\">
            <center><b id=\"ny_countdown_days\">".$new_year_countdown."</b></center>
            </div>
            <div style=\"text-align: center; width: 114px\"><span>дн.</span></div>
            </div>
            </td>
            <td width=\"114\">
            <div>
            <div style=\"background: url(".$this->cms->protocol.web1_subdomain."/images/newyear/ny_countdown_frame_v2.gif) no-repeat; background-position: center;
            font-family: Shantell Sans Medium; color: #209a20; font-size: 25pt; padding-top: 38px; padding-bottom: 36px\">
            <center><b id=\"ny_countdown_hr\">".$new_year_countdown_h."</b></center>
            </div>
            <div style=\"text-align: center; width: 114px\"><span>ч.</span></div>
            </div>
            </td>
            <td width=\"114\">
            <div>
            <div style=\"background: url(".$this->cms->protocol.web1_subdomain."/images/newyear/ny_countdown_frame_v2.gif) no-repeat; background-position: center;
            font-family: Shantell Sans Medium; color: #209a20; font-size: 25pt; padding-top: 38px; padding-bottom: 36px\">
            <center><b id=\"ny_countdown_min\">".$new_year_countdown_min."</b></center>
            </div>
            <div style=\"text-align: center; width: 114px\"><span>мин.</span></div>
            </div>
            </td>
            <td width=\"114\">
            <div>
            <div style=\"background: url(".$this->cms->protocol.web1_subdomain."/images/newyear/ny_countdown_frame_v2.gif) no-repeat; background-position: center;
            font-family: Shantell Sans Medium; color: #209a20; font-size: 25pt; padding-top: 38px; padding-bottom: 36px\">
            <center><b id=\"ny_countdown_sec\">".$new_year_countdown_sec."</b></center>
            </div>
            <div style=\"text-align: center; width: 114px\"><span>сек.</span></div></div>
            </div>
            </td>
            </tbody>
            </table>
            <form action=\"newyear.php\" method=\"post\">
            <p>
            <div style=\"text-align: center\">
            Ваш город<sup>*</sup>:
            <select style=\"margin-left: 8px\" name=\"region\" id=\"ny_region\">
            <option disabled>--- Российская Федерация ---</option>
            <option value=\"kaliningrad\">Калининград</option>
            <option value=\"moscow\" selected>Москва</option>
            <option value=\"petersburg\">Санкт-Петербург</option>
            <option value=\"n_novgorod\">Нижний Новгород</option>
            <option value=\"astrakhan\">Астрахань</option>
            <option value=\"volgograd\">Волгоград</option>
            <option value=\"ulyanovsk\">Ульяновск</option>
            <option value=\"samara\">Самара</option>
            <option value=\"yekaterinburg\">Екатеринбург</option>
            <option value=\"chelyabinsk\">Челябинск</option>
            <option value=\"omsk\">Омск</option>
            <option value=\"krasnoyarsk\">Красноярск</option>
            <option value=\"novosibirsk\">Новосибирск</option>
            <option value=\"tomsk\">Томск</option>
            <option value=\"gorno-altaisk\">Горно-Алтайск</option>
            <option value=\"barnaul\">Барнаул</option>
            <option value=\"irkutsk\">Иркутск</option>
            <option value=\"yakutsk\">Якутск</option>
            <option value=\"vladivostok\">Владивосток</option>
            <option value=\"magadan\">Магадан</option>
            <option disabled>------- <3 Мир вам! <3 -------</option>
            <option value=\"sevastopol\">Севастополь</option>
            <option value=\"donetsk\">Донецк</option>
            <option value=\"lugansk\">Луганск</option>
            <option disabled>------- Другие страны -------</option>
            <option value=\"berlin\">Берлин, Германия</option>
            <option value=\"paris\">Париж, Франция</option>
            <option value=\"helsinki\">Хельсинки, Финляндия</option>
            <option value=\"kiev\">Киев, Украина</option>
            <option value=\"minsk\">Минск, Беларусь</option>
            <option value=\"yerevan\">Ереван, Армения</option>
            <option value=\"astana\">Астана, Казахстан</option>
            <option value=\"beijing\">Пекин, Китай</option>
            </select>";

            // if the browser does not support JS, we offer an alternative option - getting an accurate countdown via a POST request
            if(str_contains($_SERVER['HTTP_USER_AGENT'], "Opera 2") || str_contains($_SERVER['HTTP_USER_AGENT'], "Opera 3") ||
                str_contains($_SERVER['HTTP_USER_AGENT'], "Opera 4") || str_contains($_SERVER['HTTP_USER_AGENT'], "Opera 5"))
                $page = $page." <input type=\"submit\" value=\"Показать\"><p><b>".$l18n_tz_name."</b>".Core::getFormattedDateTime($tz_name, "d.m.Y H:i:s", false);
            else
                $page = $page."<noscript> <input type=\"submit\" value=\"Показать\"></noscript>";

            $page = $page."<h5>* список не полный и может обновляться в ближайшее время</h5>
            </div>
            </form>".$this->getNewYearFunFactsAdvent();

        } else {
            $page = "<h3>Не трогай, это на Новый год!</h3><p>А пока вы сейчас ждете, советую поиграть в <a href=\"https://vk.com/elochkagame\">Ёлочку</a><sup>*</sup>.
            Она работает круглый год.<h5>* не является прямой рекламой.</h5>";
        }

        $html = "
        \r\n                    <td bgcolor=\"#7a1a1a\" valign=\"top\" rowspan=\"3\">
        \r\n                        <div class=\"title-text\" style=\"color: white\">ОБРАТНЫЙ ОТСЧЁТ ДО НОВОГО ГОДА</div>
        \r\n                        <hr class=\"title-line\" size=\"1\" noshade />
        \r\n                        <div class=\"text\">
        \r\n                        ".$page."
        \r\n                        </div>
        \r\n                    </td>";
        if(!$this->cms->encoding || $this->cms->encoding != "utf-8") {
            echo mb_convert_encoding($html, "windows-1251", "utf-8");
        } else {
            echo $html;
        }

    }

    function getNewYearFunFactsAdvent() {
        if(Core::getCurrentYear() == 2025) {
            $current_time = new \DateTime('now', new \DateTimeZone('Europe/Moscow'));
            $current_time->setTimestamp($current_time->getTimestamp() + (3 * 60 * 60));

            $day_of_month = intval(date('j', $current_time->getTimestamp())) < 10 ? "0".intval(date('j', $current_time->getTimestamp())) : intval(date('j', $current_time->getTimestamp()));
            $month = intval(date('m', $current_time->getTimestamp())) < 10 ? "0".intval(date('m', $current_time->getTimestamp())) : intval(date('m', $current_time->getTimestamp()));

            $query = "SELECT date, category, text, author, source FROM advent WHERE date = \"".Core::getCurrentYear()."-".$month."-".$day_of_month."\";";
            $result = $this->priv_db->query($query) or die("Last error: {$this->priv_db->lastErrorMsg()}\n");

            $letter = $result->fetchArray();

            $category = $letter[1];
            $text = $letter[2];
            $author = $letter[3];
            $source = $letter[4];

            return "<p><div class=\"advent\">
                        <table>
                            <tbody>
                                <tr>
                                    <td>
                                        <img style=\"float: left; padding-right: 8px\" src=\"".$this->cms->protocol.web1_subdomain."/images/newyear/candycanes_dance.gif\" />
                                    </td>
                                    <td>
                                        <h3>Новогодний адвент</h3>
                                        <b>Рубрика: </b>".$category."<p>".$text."<p style=\"font-size: 9pt\"></i>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan=\"2\"><i>Источник: ".$author.($source == null ? "" : ", ".$source)."</td>
                                </tr>
                            </tbody>
                        </table>
                ";
        }
    }
}
?>
