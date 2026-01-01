<?php
    namespace TinelixCms\Templates;
    
    include_once dirname(__FILE__) . '/../core.php';
    include_once dirname(__FILE__) . '/../content/pages.php';
    include_once dirname(__FILE__) . '/../includes.php';
    
    use TinelixCms\Core;

    class DefaultTemplate {
        
        private $db;
        private $cms;
        private $purifier;
        
        public function __construct($source_db, $source_cms) {
            $this->db = $source_db;
            $this->cms = $source_cms;
            $this->purifier = $source_cms->purifier;
        }
        
        function genPageHeader($js_addr = null, $onload_func = null) {
            if($this->cms->encoding == "utf-8") {
                header('Content-Type: text/html; charset=utf-8');
            } else {
                header('Content-Type: text/html; charset=windows-1251');
            }

            $current_time = new \DateTime('now', new \DateTimeZone('Europe/Moscow'));
            $current_time->setTimestamp($current_time->getTimestamp() + (3 * 60 * 60));

            $day_of_month = intval(date('j', $current_time->getTimestamp()));
            $month = intval(date('m', $current_time->getTimestamp()));

            $html = "<!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.01 Transitional//EN\">
            \r\n<!-- HTML4 PAGE !-->
            \r\n<html>
            \r\n    <head>
            ";
            $params = "";
            if($this->cms->encoding) {
                $params = "?encoding=".$this->cms->encoding;
            }
            if(!$this->cms->encoding || $this->cms->encoding != "utf-8") {
                $html = $html."
            \r\n        <meta http-equiv=\"Content-Type\" content=\"text/html; charset=windows-1251\">";
            } else {
                $html = $html."
            \r\n        <meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\">";
            }

            $page_params = "";

            $html = $html."
            \r\n        <title>Tinelix (стиль Web 1.0)</title>
            \r\n        <link rel=\"stylesheet\" href=\"".$this->cms->protocol.web1_subdomain."/style.css\">
	    ";
	    
	    if($js_addr)
		$html = $html."
			\r\n<script src=\"".$this->cms->protocol.web1_subdomain."/scripts/".$js_addr."\"></script>
		";

	    $html = $html."
            \r\n    </head>
            \r\n    <body bgcolor=\"#000000\" text=\"#ffffff\""; 

            if($onload_func) 
                $html = $html." onload=\"".$onload_func."\"";

	    $html = $html.">
            \r\n        <div align=\"center\">
            \r\n        <!-- TABLE LAYOUT !-->
            \r\n        <table width=\"640\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\">
            \r\n            <!-- HEADER !-->
            \r\n            <tbody>
            \r\n                <tr>
            \r\n                    <td>
            ";

        if(($month == 11 && $day_of_month >= 27) || $month == 12 || ($month == 1 && $day_of_month <= 14)) {
            $html = $html."<img src=\"".$this->cms->protocol.web1_subdomain."/images/header/header_ny.gif\" alt=\"Tinelix\">";
        } else {
            $html = $html."<img src=\"".$this->cms->protocol.web1_subdomain."/images/header/header.gif\" alt=\"Tinelix\">";
        }

        $html = $html."
            \r\n                    </td>
            \r\n                </tr>
            \r\n            </tbody>
            \r\n        </table>
            \r\n        <table width=\"640\" cellspacing=\"4\" cellpadding=\"4\" border=\"0\" class=\"subheader\">
            \r\n            <tbody>
            \r\n                <tr>
            \r\n                    <td align=\"left\">
            \r\n                        <div align=\"left\">
            \r\n                            ".htmlspecialchars(Core::getFullFormattedMskTime()).". Последнее обновление от ".Core::getLastUpdatedDate()."
            \r\n                        </div>
            \r\n                    </td>
            \r\n                    <td align=\"right\">
            \r\n                        <a href=\"".$this->genHTTPGetParams($_SERVER['PHP_SELF'], "cp1251")."\">CP1251</a> / <a href=\"".$this->genHTTPGetParams($_SERVER['PHP_SELF'], "utf-8")."\">UTF-8</a>
            \r\n                    </td>
            \r\n                </tr>
            \r\n            </tbody>
            \r\n        </table>";

            if(!$this->cms->encoding || $this->cms->encoding != "utf-8") {
                echo mb_convert_encoding($html, "windows-1251", "utf-8");
            } else {
                echo $html;
            }
        }

        function genWebsiteMenu() {
            $params = "";
            if($this->cms->encoding) {
                $params = "?encoding=".$this->cms->encoding;
            }
            date_default_timezone_set('Europe/Moscow');
            
            if(strstr($this->cms->protocol, 'https'))
                $columns = "id, item_name, tls_link, icon_class, small_icon_path";
            else
                $columns = "id, item_name, link, icon_class, small_icon_path";
                
            $query = "SELECT ".$columns." FROM menu";
            
            $result = $this->db->query($query);
            $menu_items = array();
            while($menu_item = $result->fetchArray()) {
                array_push($menu_items, $menu_item);
            }
            $menu = "";
            for($i = 0; $i < count($menu_items); ++$i) {
                if($menu_items[$i][0] < 0)
                    $menu = $menu."\r\n<hr class=\"simple-line\" size=\"1\">";
                elseif($i > 0)
                    $menu = $menu."\r\n<p class=\"newline\"><a href=\"".$this->cms->protocol.htmlspecialchars($menu_items[$i][2].$params)."\">".htmlspecialchars($menu_items[$i][1])."</a>";
                else
                    $menu = $menu."\r\n<a href=\"".$this->cms->protocol.htmlspecialchars($menu_items[$i][2].$params)."\">".htmlspecialchars($menu_items[$i][1])."</a>";
            }
            $html = "
                \r\n        <table width=\"640\" cellspacing=\"4\" cellpadding=\"0\" border=\"0\" bgcolor=\"#000000\">
                \r\n            <tbody>
                \r\n                <tr>
                \r\n                    <td width=\"150\" valign=\"top\">
		\r\n			    <div class=\"menu-column\">
                \r\n                        	<div class=\"title-text\">МЕНЮ САЙТА</div>
                \r\n                        	<hr class=\"title-line cell\" size=\"1\" noshade />
                \r\n                        	<div class=\"menu-links text\" style=\"margin-bottom: 0px;\">
                \r\n                            	".$this->purifier->purify($menu)."
                \r\n                        	</div>
		\r\n			    </div>
            ";

	    if(!$this->cms->encoding || $this->cms->encoding != "utf-8") {
                echo mb_convert_encoding($html, "windows-1251", "utf-8");
            } else {
                echo $html;
            }
        }

        function closePage() {
            $html = "
                                    </tr>
            \r\n                </tbody>
            \r\n            </table>
            \r\n            <p>
            \r\n            <table width=\"640\" class=\"footer\" cellpadding=\"4\">
            \r\n                <tbody>
            \r\n                    <tr>
            \r\n                        <td align=\"center\">
            \r\n                            Copyright © 2023-2026 Dmitry Tretyakov (aka. Tinelix). Стиль Web 1.0.
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

        function genHTTPGetParams($path = "/", $encoding = "cp1251") {
            $page_params = "";

            $url = $this->cms->protocol.web1_subdomain.$path;

            $url_p = $this->cms->protocol.web1_subdomain.$path;

            if(!$_GET["lite"] && !$_GET["pages"]) {
                $page_params = "?encoding=".$encoding;
            } else if($_GET["lite"] && !$_GET["pages"]) {
                $page_params = "?lite=".$_GET["lite"]."&encoding=".$encoding;
            } else if(!$_GET["lite"] && $_GET["pages"]) {
                $page_params = "?pages=".$_GET["pages"]."&encoding=".$encoding;
            } else {
                $page_params = "?pages=".$_GET["pages"]."&lite=".$_GET["lite"]."&encoding=".$encoding;
            }

            return $url_p.$page_params;
        }
    }
?>
