<?php
    function genPageHeader() {
        $web1_subdomain = "web1.tinelix.ru";
        $irc_subdomain = "irc.tinelix.ru";
        $current_time = new DateTime('now', new DateTimeZone('Europe/Moscow'));
        $dw = date("w");
        $formatter = new IntlDateFormatter('ru_RU', IntlDateFormatter::MEDIUM, IntlDateFormatter::MEDIUM);
        $dws = array('�����������', '�����������', '�������', '�����', '�������', '�������', '�������');
        $formatter->setPattern('dd.MM.yyyy');
        $format_date = mb_convert_encoding($formatter->format($current_time), "windows-1251", "utf-8");
        $html = "<!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.01 Transitional//EN\">
        \r\n<!-- HTML4 PAGE !-->
        \r\n<html>
        \r\n    <head>
        \r\n        <meta http-equiv=\"Content-Type\" content=\"text/html; charset=windows-1251\">
        \r\n        <title>Tinelix (����� Web 1.0)</title>
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
        \r\n                        <div align=\"center\">
        \r\n                            ".$dws[$dw].", ".$format_date.". ��������� ���������� �� ".getLastUpdatedDate()."
        \r\n                        </div>
        \r\n                    </td>
        \r\n                </tr>
        \r\n            </tbody>
        \r\n        </table>";
        $html_cp1251 = mb_convert_encoding($html, "utf-8", "windows-1251");
        echo $html_cp1251;
    }

    function genWebsiteMenu() {
        $web1_subdomain = "web1.tinelix.ru";
        $irc_subdomain = "irc.tinelix.ru";
        $html = "
            \r\n        <table width=\"640\" cellspacing=\"4\" cellpadding=\"0\" border=\"0\" bgcolor=\"#232323\">
            \r\n            <tbody>
            \r\n                <tr>
            \r\n                    <td bgcolor=\"#151515\" width=\"150\" valign=\"top\">
            \r\n                        <div class=\"title-text\">���� �����</div>
            \r\n                        <hr class=\"accent-color cell\" size=\"1\"/>
            \r\n                        <div class=\"menu-links text\">
            \r\n                            <a href=\".\">�����</a>
            \r\n                            <p class=\"newline\"><a href=\"http://".$web1_subdomain."/projects.php\">�������</a>
            \r\n                            <p class=\"newline\"><a href=\"http://".$web1_subdomain."/hardware.php\">������������</a>
            \r\n                            <p class=\"newline\"><a href=\"http://irc.tinelix.ru\">IRC-���</a>
            \r\n                            <p class=\"newline\"><a href=\"https://t.me/tinelixdonators\">�������������</a>
            \r\n                            <p class=\"newline\"><a href=\"http://".$web1_subdomain."/about.php\">� ����</a>
            \r\n                            <hr bgcolor=\"#3a3a3a\" size=\"1\"/>
            \r\n                            <p class=\"newline\"><a href=\"http://".$web1_subdomain."/banner.php\">������ ��� �����</a>
            \r\n                        </div>
            \r\n                    </td>
        ";
        $html_cp1251 = mb_convert_encoding($html, "utf-8", "windows-1251");
        echo $html_cp1251;
    }

    function showStartPage($db) {
        $web1_subdomain = "web1.tinelix.ru";
        $irc_subdomain = "irc.tinelix.ru";
        $query = "SELECT id, title, body FROM articles WHERE on_start_page = 1 LIMIT 1;";
        $result = $db->query($query);
        $article = $result->fetchArray();
        $article_title = mb_strtoupper($article[1]);
        echo "\r\n                    <td bgcolor=\"#151515\" valign=\"top\">
            \r\n                        <div class=\"title-text\">".$article_title."</div>
            \r\n                        <hr class=\"accent-color\" size=\"1\"/>
            \r\n                        <div class=\"text\">".$article[2]."</div>
            \r\n                    </td>
            \r\n                </tr>
            \r\n            </tbody>
            \r\n        </table>";
    }

    function showAboutPage($db) {
        $web1_subdomain = "web1.tinelix.ru";
        $irc_subdomain = "irc.tinelix.ru";
        $query = "SELECT id, title, body FROM about LIMIT 1;";
        $result = $db->query($query);
        $about_page = $result->fetchArray();
        $about_page_title = mb_strtoupper($about_page[1]);
        echo "
            \r\n                    <td bgcolor=\"#151515\" valign=\"top\">
            \r\n                        <div class=\"title-text\">".$about_page_title."</div>
            \r\n                        <hr class=\"accent-color\" size=\"1\"/>
            \r\n                        <div class=\"text\">
            \r\n                            ".$about_page[2];
        echo mb_convert_encoding("\r\n               <h3>��������</h3>", "utf-8", "windows-1251");
        $query = "SELECT id, name, value FROM contacts;";
        $result = $db->query($query) or die("Last error: {$db->lastErrorMsg()}\n");
        $contacts = array();
        while($contact = $result->fetchArray()) {
            array_push($contacts, $contact);
        }
        for($i = 0; $i < count($contacts); ++$i) {
            echo "
            \r\n                            <b>".$contacts[$i][1].":</b> ".$contacts[$i][2]."<br>";
        }
        echo "
            \r\n
            \r\n                        </div>
            \r\n                    </td>
            \r\n                </tr>
            \r\n            </tbody>
            \r\n        </table>";
    }


    function getLastUpdatedDate() {
        return "31.03.2023";
    }

    function closePage() {
        $html = "
        \r\n    </body>
        \r\n</html>";
        $html_cp1251 = mb_convert_encoding($html, "utf-8", "windows-1251");
        echo $html_cp1251;
        $db->close();
        unset($db);
    }
?>
