<?php
    namespace TinelixCms\Content;
    
    include_once dirname(__FILE__) . '/../includes.php';
    include_once dirname(__FILE__) . '/../core.php';
    
    use TinelixCms\Core;
    
    class PagesCollection {
        
        private $db;
        private $cms;
        private $purifier;
    
        public function __construct($source_db, $source_cms) {
            $this->db = $source_db;
            $this->cms = $source_cms;
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
            \r\n        <link rel=\"stylesheet\" href=\"http://".web1_subdomain."/style.css\">
            \r\n        <link rel=\"stylesheet\" href=\"http://".web1_subdomain."/icons.css\">
            \r\n    </head>
            \r\n    <body>
            \r\n        <p align=\"center\" style=\"font-size: 14pt;
            \r\n                                    margin-top: 15px;
            \r\n                                    margin-bottom: 0px
            \r\n                                  \"><b>Приветствуем!</b></p>
            \r\n        <p align=\"center\" style=\"font-size: 10pt; margin-top: 2px\">".htmlspecialchars($formattedMskTime)."</p>
            \r\n        <div align=\"center\">";

            $query = "SELECT * FROM menu WHERE id >= 0 ORDER BY id ASC;";
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
					$params = "&encoding=".htmlspecialchars($this->cms->encoding);
				else
					$params = "?encoding=".htmlspecialchars($this->cms->encoding);
			} else {
				$params = "";
			}
            	    }

                    if($i == 4) {
                        if($day_of_month == 1 && $month == 6) {
                            $html = $html."
                            \r\n        <a href=\"".htmlspecialchars($menu_items[$i][2]).$params."\" class=\"big-icon-center big-icon-seasons-june1-".htmlspecialchars($menu_items[$i][3])."\"/>
                            \r\n    </td>";
                        } else {
                            $html = $html."
                            \r\n        <a href=\"".htmlspecialchars($menu_items[$i][2]).$params."\" class=\"big-icon-center big-icon-".htmlspecialchars($menu_items[$i][3])."\"/>
                            \r\n    </td>";
                        }
                    } else {
                       $html = $html."
                        \r\n        <a href=\"".htmlspecialchars($menu_items[$i][2].$params)."\" class=\"big-icon big-icon-".htmlspecialchars($menu_items[$i][3])."\"/>
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
            \r\n                            Copyright © 2023-2024 Dmitry Tretyakov (aka. Tinelix). Стиль Web 1.0.
            \r\n                            <br><a href=\"https://github.com/tinelix/tinelix.ru\">Исходный код сайта</a>
            \r\n                            <p>
            \r\n                            <a href=\"http://validator.w3.org/check?uri=referer\">
            \r\n                                <img style=\"border:0;\"
            \r\n                                     src=\"http://".web1_subdomain."/banners/valid-html401.png\"
            \r\n                                     alt=\"Valid HTML 4.01 Transitional\" height=\"31\" width=\"88\">
            \r\n                            </a>
            \r\n                            <a href=\"http://jigsaw.w3.org/css-validator/check/referer\">
            \r\n                                <img style=\"border:0;width:88px;height:31px\"
            \r\n                                     src=\"http://".web1_subdomain."/banners/valid-css.png\"
            \r\n                                     alt=\"Правильный CSS!\" />
            \r\n                            </a>
            \r\n                            <a href=\"https://gnu.org\">
            \r\n                                <img style=\"border:0;width:88px;height:31px\"
            \r\n                                     src=\"http://".web1_subdomain."/banners/gnu.png\"
            \r\n                                     alt=\"Свободное ПО нужно каждому!\" />
            \r\n                            </a>
            \r\n                            <a href=\"http://narodweb.ru\">
            \r\n                                <img style=\"border:0;width:88px;height:31px\"
            \r\n                                     src=\"http://".web1_subdomain."/banners/ndr.gif\"
            \r\n                                     alt=\"Сайт проекта &lt;Народное достояние Рунета&gt;\" />
            \r\n                            </a>
            \r\n                        </td>
            \r\n                    </tr>
            \r\n                </tbody>
            \r\n            </table>
            \r\n        </div>
            \r\n    </body>
            \r\n</html>";
            if(!$this->db->encoding || $this->db->encoding != "utf-8") {
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
            $html =  "\r\n                    <td bgcolor=\"#151515\" valign=\"top\">
                \r\n                        <div class=\"title-text\">".htmlspecialchars($article_title)."</div>
                \r\n                        <hr class=\"accent-color\" size=\"1\">
                \r\n                        <div class=\"text\">".$this->purifier->purify($article[2])."</div>
                \r\n                    </td>";
            if(!$this->db->encoding || $this->db->encoding != "utf-8") {
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
                \r\n                    <td bgcolor=\"#151515\" valign=\"top\">
                \r\n                        <div class=\"title-text\">".htmlspecialchars($about_page_title)."</div>
                \r\n                        <hr class=\"accent-color\" size=\"1\"/>
                \r\n                        <div class=\"text\">
                \r\n                            ".$this->purifier->purify($about_page[2]);
            $html = $html."\r\n               <h3>Контакты</h3>";
            $query = "SELECT id, name, value FROM contacts;";
            $result = $this->db->query($query) or die("Last error: {$this->db->lastErrorMsg()}\n");
            $contacts = array();
            while($contact = $result->fetchArray()) {
                array_push($contacts, $contact);
            }
            for($i = 0; $i < count($contacts); ++$i) {
                $html = $html."
                \r\n                            <b>".$contacts[$i][1].":</b> ".$this->purifier->purify($contacts[$i][2])."<br>";
            }
            $html = $html."
                \r\n
                \r\n                        </div>
                \r\n                    </td>";
            if(!$this->db->encoding || $this->db->encoding != "utf-8") {
                echo mb_convert_encoding($html, "windows-1251", "utf-8");
            } else {
                echo $html;
            }
        }

        public function showProjectsPage() {
            $query = "SELECT id, name, description, link FROM projects;";
            $result = $this->db->query($query) or die("Last error: {$this->db->lastErrorMsg()}\n");
            $projects = array();
            $html = "\r\n                    <td bgcolor=\"#151515\" valign=\"top\">
                    \r\n                        <div class=\"title-text\">ПРОЕКТЫ</div>
                    \r\n                        <hr class=\"accent-color\" size=\"1\"/>
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
            if(!$this->db->encoding || $this->db->encoding != "utf-8") {
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
                    \r\n                    <td bgcolor=\"#151515\" valign=\"top\">
                    \r\n                        <div class=\"title-text\">".htmlspecialchars($page_title)."</div>
                    \r\n                        <hr class=\"accent-color\" size=\"1\"/>
                    \r\n                        <div class=\"text\">
            \r\n				".$this->purifier->purify($page[2])."
                    \r\n                        </div>
                    \r\n                    </td>";
            } else {
                $html = "
                    \r\n                    <td bgcolor=\"#151515\" valign=\"top\">
                    \r\n                        <div class=\"title-text\">ОШИБКА</div>
                    \r\n                        <hr class=\"accent-color\" size=\"1\"/>
                    \r\n                        <div class=\"text\">
                    \r\n                           Такой страницы не существует.
                    \r\n                        </div>
                    \r\n                    </td>";
            }
            if(!$this->db->encoding || $this->db->encoding != "utf-8") {
                echo mb_convert_encoding($html, "windows-1251", "utf-8");
            } else {
                echo $html;
            }
        }

        public function showHardwarePage() {
            $html = "\r\n                    <td bgcolor=\"#151515\" valign=\"top\">
                         \r\n                        <div class=\"title-text\">ОБОРУДОВАНИЕ</div>
                         \r\n                        <hr class=\"accent-color\" size=\"1\"/>
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
            $html = $html."\r\n                          <h3>Ноутбуки</h3>";
            for($i = 0; $i < count($laptops); ++$i) {
                    $html = $html."
                    \r\n                            <h4>".htmlspecialchars($laptops[$i][1])."</h4>
                    \r\n                            ".$this->purifier->purify($laptops[$i][2]);
            }
            
            $html = $html."\r\n                          <h3>Смартфоны</h3>";
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
              
            $html = $html."</div>
                    \r\n                    </td>";
            if(!$this->db->encoding || $this->db->encoding != "utf-8") {
                echo mb_convert_encoding($html, "windows-1251", "utf-8");
            } else {
                echo $html;
            }
        }

        public function showWebsiteBannersPage() {
                $query = "SELECT id, name, link FROM banners;";
                $result = $this->db->query($query) or die("Last error: {$this->db->lastErrorMsg()}\n");
                $banners = array();
                $html = "\r\n                    <td bgcolor=\"#151515\" valign=\"top\">
                         \r\n                        <div class=\"title-text\">БАННЕР ДЛЯ САЙТА</div>
                         \r\n                        <hr class=\"accent-color\" size=\"1\"/>
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
                    \r\n                                <img src=\"".htmlspecialchars($banners[$i][2])."\" width=\"88\" height=\"31\" alt=\"\">
                    \r\n                                <br>
                    \r\n                                <pre class=\"full-code\">
    &lt;a href=\"http://".web1_subdomain."\"&gt;
        &lt;img src=\"".$banners[$i][2]."\"
             width=\"88\" height=\"31\" border=\"0\"/&gt;
    &lt;/a&gt;
    </pre>
                                                    </div>
                    \r\n                            ";
                }
                $html = $html."</div>
                    \r\n                    </td>";
            if(!$this->db->encoding || $this->db->encoding != "utf-8") {
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
                    \r\n                    <td bgcolor=\"#151515\" valign=\"top\">
                    \r\n                        <div class=\"title-text\">".htmlspecialchars($page_title)."</div>
                    \r\n                        <hr class=\"accent-color\" size=\"1\"/>
                    \r\n                        <div class=\"text\">
                    \r\n				            ".$this->purifier->purify($page[2])."
                    \r\n                        </div>
                    \r\n                    </td>";
            if(!$this->db->encoding || $this->db->encoding != "utf-8") {
                echo mb_convert_encoding($html, "windows-1251", "utf-8");
            } else {
                echo $html;
            }
        }
    }
?>
