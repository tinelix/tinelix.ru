<?php
    function genPageHeader($html_encoding) {
        if($html_encoding == "utf-8") {
            header('Content-Type: text/html; charset=utf-8');
        } else {
            header('Content-Type: text/html; charset=windows-1251');
        }
        $web1_subdomain = "web1.tinelix.ru";
        $irc_subdomain = "irc.tinelix.ru";
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
        \r\n                            ".getFullFormattedMskTime().". Последнее обновление от ".getLastUpdatedDate()."
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

    function genWebsiteMenu($db, $html_encoding) {
        $web1_subdomain = "web1.tinelix.ru";
        $irc_subdomain = "irc.tinelix.ru";
        $params = "";
        if($html_encoding) {
            $params = "?encoding=".$html_encoding;
        }
        date_default_timezone_set('Europe/Moscow');
        $query = "SELECT * FROM menu;";
        $result = $db->query($query);
        $menu_items = array();
        while($menu_item = $result->fetchArray()) {
            array_push($menu_items, $menu_item);
        }
        $menu = "";
        for($i = 0; $i < count($menu_items); ++$i) {
            if($menu_items[$i][0] < 0)
                $menu = $menu."\r\n<hr class=\"simple-line\" size=\"1\">";
            elseif($i > 0)
                $menu = $menu."\r\n<p class=\"newline\"><a href=\"".$menu_items[$i][2].$params."\">".$menu_items[$i][1]."</a>";
            else
                $menu = $menu."\r\n<a href=\"".$menu_items[$i][2].$params."\">".$menu_items[$i][1]."</a>";
        }
        $html = "
            \r\n        <table width=\"640\" cellspacing=\"4\" cellpadding=\"0\" border=\"0\" bgcolor=\"#232323\">
            \r\n            <tbody>
            \r\n                <tr>
            \r\n                    <td bgcolor=\"#151515\" width=\"150\" valign=\"top\">
            \r\n                        <div class=\"title-text\">МЕНЮ САЙТА</div>
            \r\n                        <hr class=\"accent-color cell\" size=\"1\">
            \r\n                        <div class=\"menu-links text\" style=\"margin-bottom: 0px;\">
            \r\n                            ".$menu."
            \r\n                        </div>
            \r\n                    </td>
        ";
        if(!$html_encoding || $html_encoding != "utf-8") {
            echo mb_convert_encoding($html, "windows-1251", "utf-8");
        } else {
            echo $html;
        }

        /* This part of code will uncommenting before 2025 year.
         *
         * $new_year_countdown = -round((time() - strtotime("2025-01-01")) / (60 * 60 * 24));
         * if($new_year_countdown >= 0) {
         *   $new_year_countdown_h = -(round((time() - strtotime("2025-01-01")) / (60 * 60)) % 24);
         *   $new_year_countdown_min = -(round((time() - strtotime("2025-01-01")) / 60) % 60);
         *   $new_year_countdown_sec = -(round(time() - strtotime("2025-01-01")) % 60);
         * } else {
         *   $new_year_countdown = 0;
         *   $new_year_countdown_h = 0;
         *   $new_year_countdown_min = 0;
         *   $new_year_countdown_sec = 0;
         * }
         */
    }

    function getFullFormattedMskTime() {
        $current_time = new DateTime('now', new DateTimeZone('Europe/Moscow'));
	$current_time->setTimestamp($current_time->getTimestamp() + (3 * 60 * 60));
        $dw = date("w", $current_time->getTimestamp());
        $formatter = new IntlDateFormatter('ru_RU', IntlDateFormatter::MEDIUM, IntlDateFormatter::MEDIUM);
        $dws = array('Воскресенье', 'Понедельник', 'Вторник', 'Среда', 'Четверг', 'Пятница', 'Суббота');
        $formatter->setPattern('dd.MM.yyyy');
        $format_date = $formatter->format($current_time);
        return $dws[$dw].", ".$format_date;
    }

    function getLastUpdatedDate() {
        return "24.05.2024";
    }

    function closePage($html_encoding) {
        $web1_subdomain = "web1.tinelix.ru";
        $html = "
                                </tr>
        \r\n                </tbody>
        \r\n            </table>
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
        \r\n                            <a href=\"http://narodweb.ru\">
        \r\n                                <img style=\"border:0;width:88px;height:31px\"
        \r\n                                     src=\"http://".$web1_subdomain."/banners/ndr.gif\"
        \r\n                                     alt=\"Сайт проекта &lt;Народное достояние Рунета&gt;\" />
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
    }
?>
