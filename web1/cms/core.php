<?php
    function genPageHeader($html_encoding) {
        if($html_encoding == "utf-8") {
            header('Content-Type: text/html; charset=utf-8');
        } else {
            header('Content-Type: text/html; charset=windows-1251');
        }
        $web1_subdomain = "web1.tinelix.ru";
        $irc_subdomain = "irc.tinelix.ru";
        $current_time = new DateTime('now', new DateTimeZone('Europe/Moscow'));
        $dw = date("w");
        $formatter = new IntlDateFormatter('ru_RU', IntlDateFormatter::MEDIUM, IntlDateFormatter::MEDIUM);
        $dws = array('Воскресенье', 'Понедельник', 'Вторник', 'Среда', 'Четверг', 'Пятница', 'Суббота');
        $formatter->setPattern('dd.MM.yyyy');
        $format_date = $formatter->format($current_time);
        $html = "<!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.01 Transitional//EN\">
        \r\n<!-- HTML4 PAGE !-->
        \r\n<html>
        \r\n    <head>
        ";
        $params = "";
        if($html_encoding) {
            $params = "?encoding=".$html_encoding;
        }
        if(!$html_encoding || $html_encoding != "utf-8") {
            $html = $html."
        \r\n        <meta http-equiv=\"Content-Type\" content=\"text/html; charset=windows-1251\">";
        } else {
            $html = $html."
        \r\n        <meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\">";
        }

        $html = $html."
        \r\n        <title>Tinelix (стиль Web 1.0)</title>
        \r\n        <link rel=\"stylesheet\" href=\"http://".$web1_subdomain."/style.css\">
        \r\n    </head>
        \r\n    <body>
        \r\n        <div align=\"center\">
        \r\n        <!-- TABLE LAYOUT !-->
        \r\n        <table width=\"640\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\">
        \r\n            <!-- HEADER !-->
        \r\n            <tbody>
        \r\n                <tr>
        \r\n                    <td>
        \r\n                        <img src=\"http://".$web1_subdomain."/images/header.gif\" alt=\"Tinelix\">
        \r\n                    </td>
        \r\n                </tr>
        \r\n            </tbody>
        \r\n        </table>
        \r\n        <table width=\"640\" cellspacing=\"4\" cellpadding=\"4\" border=\"0\" class=\"subheader\">
        \r\n            <tbody>
        \r\n                <tr>
        \r\n                    <td align=\"left\">
        \r\n                        <div align=\"left\">
        \r\n                            ".$dws[$dw].", ".$format_date.". Последнее обновление от ".getLastUpdatedDate()."
        \r\n                        </div>
        \r\n                    </td>
        \r\n                    <td align=\"right\">
        \r\n                        <a href=\"http://".$web1_subdomain."\">CP1251</a> / <a href=\"http://".$web1_subdomain."?encoding=utf-8\">UTF-8</a>
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

    function genWebsiteMenu($html_encoding) {
        $web1_subdomain = "web1.tinelix.ru";
        $irc_subdomain = "irc.tinelix.ru";
        $params = "";
        if($html_encoding) {
            $params = "?encoding=".$html_encoding;
        }
        $new_year_countdown = -round((time() - strtotime("2024-01-01")) / (60 * 60 * 24));
        $html = "
            \r\n        <table width=\"640\" cellspacing=\"4\" cellpadding=\"0\" border=\"0\" bgcolor=\"#232323\">
            \r\n            <tbody>
            \r\n                <tr>
            \r\n                    <td bgcolor=\"#151515\" width=\"150\" valign=\"top\">
            \r\n                        <div class=\"title-text\">МЕНЮ САЙТА</div>
            \r\n                        <hr class=\"accent-color cell\" size=\"1\">
            \r\n                        <div class=\"menu-links text\">
            \r\n                            <a href=\"http://".$web1_subdomain."\">Домой</a>
            \r\n                            <p class=\"newline\"><a href=\"http://".$web1_subdomain."/projects.php".$params."\">Проекты</a>
            \r\n                            <p class=\"newline\"><a href=\"http://".$web1_subdomain."/hardware.php".$params."\">Оборудование</a>
            \r\n                            <p class=\"newline\"><a href=\"http://irc.tinelix.ru\">IRC-чат</a>
            \r\n                            <p class=\"newline\"><a href=\"https://t.me/tinelixdonators\">Пожертвования</a>
            \r\n                            <p class=\"newline\"><a href=\"http://".$web1_subdomain."/about.php".$params."\">О себе</a>
            \r\n                            <hr class=\"simple-line\" size=\"1\">
            \r\n                            <p class=\"newline\"><a href=\"http://".$web1_subdomain."/banner.php".$params."\">Баннер для сайта</a>
            \r\n                            <p class=\"newline\"><a href=\"http://ovk.tinelix.ru\">Tinelix Astorium</a>
            \r\n                        </div>
            \r\n                        <hr style=\"background: #232323; color: #232323; border: none margin-top: 0px;\" size=\"4\">
            \r\n                        <div class=\"title-text\">ДО НОВОГО ГОДА</div>
            \r\n                        <hr class=\"accent-color cell\" size=\"1\">
            \r\n                        <p style=\"text-align: center; font-size: 18pt; margin-top: 4px; margin-top: 0px; margin-bottom: 0px;\"><b class=\"highlight\">".$new_year_countdown."</b></p>
            \r\n                        <p style=\"text-align: center; margin-top: 0px;\">дней</p><p></p>
            \r\n                    </td>
        ";
        if(!$html_encoding || $html_encoding != "utf-8") {
            echo mb_convert_encoding($html, "windows-1251", "utf-8");
        } else {
            echo $html;
        }
    }

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


    function getLastUpdatedDate() {
        return "04.10.2023";
    }

    function closePage($html_encoding) {
        $web1_subdomain = "web1.tinelix.ru";
        $html = "<p>
        \r\n            <table width=\"640\" class=\"footer\" cellpadding=\"4\">
        \r\n                <tbody>
        \r\n                    <tr>
        \r\n                        <td align=\"center\">
        \r\n                            Copyright © 2023 Dmitry Tretyakov (aka. Tinelix). Стиль Web 1.0.
        \r\n                            <br><a href=\"https://github.com/tinelix/tinelix.ru\">Исходный код сайта</a>
        \r\n                            <p>
        \r\n                            <a href=\"http://validator.w3.org/check?uri=referer\">
        \r\n                                <img style=\"border:0;\"
        \r\n                                     src=\"http://".$web1_subdomain."/banners/valid-html401.png\"
        \r\n                                     alt=\"Valid HTML 4.01 Transitional\" height=\"31\" width=\"88\">
        \r\n                            </a>
        \r\n                            <a href=\"http://jigsaw.w3.org/css-validator/check/referer\">
        \r\n                                <img style=\"border:0;width:88px;height:31px\"
        \r\n                                     src=\"http://".$web1_subdomain."/banners/valid-css.png\"
        \r\n                                     alt=\"Правильный CSS!\" />
        \r\n                            </a>
        \r\n                            <a href=\"https://gnu.org\">
        \r\n                                <img style=\"border:0;width:88px;height:31px\"
        \r\n                                     src=\"http://".$web1_subdomain."/banners/gnu.png\"
        \r\n                                     alt=\"Свободное ПО нужно каждому!\" />
        \r\n                            </a>
        \r\n                        </td>
        \r\n                    </tr>
        \r\n                </tbody>
        \r\n            </table>
        \r\n        </div>
        \r\n    </body>
        \r\n</html>";
        if(!$html_encoding || $html_encoding != "utf-8") {
            echo mb_convert_encoding($html, "windows-1251", "utf-8");
        } else {
            echo $html;
        }
        $db->close();
        unset($db);
    }
?>
