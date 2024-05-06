<?php

    function showStartPage($db, $html_encoding) {
        $web1_subdomain = "web1.tinelix.ru";
        $irc_subdomain = "irc.tinelix.ru";
        $query = "SELECT id, title, body FROM articles WHERE on_start_page = 1 LIMIT 1;";
        $result = $db->query($query);
        $article = $result->fetchArray();
        $article_title = mb_strtoupper($article[1]);
        $html =  "\r\n                    <td bgcolor=\"#151515\" valign=\"top\">
            \r\n                        <div class=\"title-text\">".$article_title."</div>
            \r\n                        <hr class=\"accent-color\" size=\"1\">
            \r\n                        <div class=\"text\">".$article[2]."</div>
            \r\n                    </td>
            \r\n                </tr>
            \r\n            </tbody>
            \r\n        </table>";
        if(!$html_encoding || $html_encoding != "utf-8") {
            echo mb_convert_encoding($html, "windows-1251", "utf-8");
        } else {
            echo $html;
        }
    }

    function showAboutPage($db, $html_encoding) {
        $web1_subdomain = "web1.tinelix.ru";
        $irc_subdomain = "irc.tinelix.ru";
        $query = "SELECT id, title, body FROM about LIMIT 1;";
        $result = $db->query($query);
        $about_page = $result->fetchArray();
        $about_page_title = mb_strtoupper($about_page[1]);
        $html = "
            \r\n                    <td bgcolor=\"#151515\" valign=\"top\">
            \r\n                        <div class=\"title-text\">".$about_page_title."</div>
            \r\n                        <hr class=\"accent-color\" size=\"1\"/>
            \r\n                        <div class=\"text\">
            \r\n                            ".$about_page[2];
        $html = $html."\r\n               <h3>Контакты</h3>";
        $query = "SELECT id, name, value FROM contacts;";
        $result = $db->query($query) or die("Last error: {$db->lastErrorMsg()}\n");
        $contacts = array();
        while($contact = $result->fetchArray()) {
            array_push($contacts, $contact);
        }
        for($i = 0; $i < count($contacts); ++$i) {
            $html = $html."
            \r\n                            <b>".$contacts[$i][1].":</b> ".$contacts[$i][2]."<br>";
        }
        $html = $html."
            \r\n
            \r\n                        </div>
            \r\n                    </td>
            \r\n                </tr>
            \r\n            </tbody>
            \r\n        </table>";
        if(!$html_encoding || $html_encoding != "utf-8") {
            echo mb_convert_encoding($html, "windows-1251", "utf-8");
        } else {
            echo $html;
        }
    }

    function showProjectsPage($db, $html_encoding) {
        $query = "SELECT id, name, description, link FROM projects;";
        $result = $db->query($query) or die("Last error: {$db->lastErrorMsg()}\n");
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
                    $params = "&encoding=".$html_encoding;
                } else {
                    $params = "?encoding=".$html_encoding;
                }
            }
            $html = $html."
                \r\n                            <a href=\"".$projects[$i][3].$params."\">".$projects[$i][1]."</a>
                \r\n                            <br><span class=\"subtext\">".$projects[$i][2]."</span>";
            if($i < count($projects) - 1) {
                $html = $html. "
                    \r\n                            <hr size=\"1\"/>";
            }
        }
        $html = $html."
            </div>
                \r\n                    </td>
                \r\n                </tr>
                \r\n            </tbody>
                \r\n        </table>";
        if(!$html_encoding || $html_encoding != "utf-8") {
            echo mb_convert_encoding($html, "windows-1251", "utf-8");
        } else {
            echo $html;
        }
    }

    function showProjectPage($db, $i, $html_encoding) {
        $html = "";
	$query = "SELECT id, title, body, address FROM pages WHERE address = 'projects.php?page={$i}' LIMIT 1;";
        $result = $db->query($query) or die("Last error: {$db->lastErrorMsg()}\n");
        $page = $result->fetchArray();
	$page_title = mb_strtoupper($page[1]);

        if($i > 0 && $i <= 3) {
          $html = "
                \r\n                    <td bgcolor=\"#151515\" valign=\"top\">
                \r\n                        <div class=\"title-text\">".$page_title."</div>
                \r\n                        <hr class=\"accent-color\" size=\"1\"/>
                \r\n                        <div class=\"text\">
		\r\n				".$page[2]."
                \r\n                        </div>
                \r\n                    </td>
                \r\n                </tr>
                \r\n            </tbody>
                \r\n        </table>";
        } else {
            $html = "
                \r\n                    <td bgcolor=\"#151515\" valign=\"top\">
                \r\n                        <div class=\"title-text\">ОШИБКА</div>
                \r\n                        <hr class=\"accent-color\" size=\"1\"/>
                \r\n                        <div class=\"text\">
                \r\n                           Такой страницы не существует.
                \r\n                        </div>
                \r\n                    </td>
                \r\n                </tr>
                \r\n            </tbody>
                \r\n        </table>";
        }
        if(!$html_encoding || $html_encoding != "utf-8") {
            echo mb_convert_encoding($html, "windows-1251", "utf-8");
        } else {
            echo $html;
        }
    }

    function showHardwarePage($db, $html_encoding) {
        $query = "SELECT id, name, specs FROM hardware WHERE type = 0;";
        $result = $db->query($query) or die("Last error: {$db->lastErrorMsg()}\n");
        $computers = array();
        $html = "\r\n                    <td bgcolor=\"#151515\" valign=\"top\">
                     \r\n                        <div class=\"title-text\">ОБОРУДОВАНИЕ</div>
                     \r\n                        <hr class=\"accent-color\" size=\"1\"/>
                     \r\n                        <div class=\"text\">";
        while($computer = $result->fetchArray()) {
                array_push($computers, $computer);
        }
        $html = $html."\r\n                          <h3>Компьютеры</h3>";
        for($i = 0; $i < count($computers); ++$i) {
                $html = $html."
                \r\n                            <h4>".$computers[$i][1]."</h4>
                \r\n                            ".$computers[$i][2];
        }
        $html = $html."\r\n                          <h3>Смартфоны</h3>";
        $query = "SELECT id, name, specs FROM hardware WHERE type = 1;";
        $result = $db->query($query) or die("Last error: {$db->lastErrorMsg()}\n");
        $phones = array();
        while($phone = $result->fetchArray()) {
            array_push($phones, $phone);
        }
        for($i = 0; $i < count($phones); ++$i) {
            $html = $html."
                \r\n                            <h4>".$phones[$i][1]."</h4>
                \r\n                            ".$phones[$i][2];
        }
        $html = $html."</div>
                \r\n                    </td>
                \r\n                </tr>
                \r\n            </tbody>
                \r\n        </table>";
        if(!$html_encoding || $html_encoding != "utf-8") {
            echo mb_convert_encoding($html, "windows-1251", "utf-8");
        } else {
            echo $html;
        }
    }

    function showWebsiteBannersPage($db, $html_encoding) {
            $web1_subdomain = "web1.tinelix.ru";
            $query = "SELECT id, name, link FROM banners;";
            $result = $db->query($query) or die("Last error: {$db->lastErrorMsg()}\n");
            $banners = array();
            $html = "\r\n                    <td bgcolor=\"#151515\" valign=\"top\">
                     \r\n                        <div class=\"title-text\">БАННЕР ДЛЯ САЙТА</div>
                     \r\n                        <hr class=\"accent-color\" size=\"1\"/>
                     \r\n                        <div class=\"text\">
                     \r\n                        Прикрепите любой из предложенных баннеров на свой ретросайт, так нас проще будет найти.
                     \r\n<p><div class=\"warning-banner\"><b>ВНИМАНИЕ!</b> Для показа баннеров на современных браузерах советуем отключить блокировщик рекламы или добавить сайт <b>".$web1_subdomain."</b> в исключения блокировки.</div>";
            while($banner = $result->fetchArray()) {
                array_push($banners, $banner);
            }
            for($i = 0; $i < count($banners); ++$i) {
                $html = $html."
                \r\n                            <h4>".$banners[$i][1]."</h4>
                \r\n                            <div align=\"center\">
                \r\n                                <img src=\"".$banners[$i][2]."\" width=\"88\" height=\"31\" alt=\"\">
                \r\n                                <br>
                \r\n                                <pre class=\"full-code\">
&lt;a href=\"http://".$web1_subdomain."\"&gt;
    &lt;img src=\"".$banners[$i][2]."\"
         width=\"88\" height=\"31\" border=\"0\"/&gt;
&lt;/a&gt;
</pre>
                                                </div>
                \r\n                            ";
            }
            $html = $html."</div>
                \r\n                    </td>
                \r\n                </tr>
                \r\n            </table>";
        if(!$html_encoding || $html_encoding != "utf-8") {
            echo mb_convert_encoding($html, "windows-1251", "utf-8");
        } else {
            echo $html;
        }
    }
?>
