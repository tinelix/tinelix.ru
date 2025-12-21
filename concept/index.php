<?php
    header('Content-Type: text/html; charset=Windows-1251');
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<HTML>
    <HEAD>
        <TITLE>Tinelix</TITLE>
        <META name="http-equiv" content="Content-type: text/html; charset=Windows-1251" charset="Windows-1251">
        <LINK rel="stylesheet" href="styles/main.css">
        <SCRIPT src="scripts/search.js"></SCRIPT>
    </HEAD>
    <BODY bgcolor="#000000" text="#ffffff" link="#00ffff" alink="#00ffff" vlink="#00ffff" topmargin="0">
        <CENTER>
            <!--<DIV class="warning_banner"><B>ВНИМАНИЕ!</B> Сейчас показан концепт новой версии сайта, приуроченная к юбилею YouTube-канала Tinelix, который состоится в мае 2027 года.<P>В последствии сайт может быть реализован и наполнен контентом.</DIV>!-->
            <TABLE width="600" cellpadding="4" cellspacing="0" class="header-links">
                <TR>
                    <TD align="center" width="100"><A href="http://irc.tinelix.ru">IRC-чат</A></TD>
                    <TD align="center" width="100">Музыка</TD>
                    <TD align="center" width="100">Фотографии</TD>
                    <TD align="center" width="100">Блог</TD>
                    <TD align="center" width="100">Ретро-веб</TD>
                </TR>
            </TABLE>
            <TABLE width="600" cellpadding="0" cellspacing="0">
                <TR valign="center">
                    <TD width="100">
                        <IMG src="img/logo.gif" alt="Tinelix"></IMG>
                    </TD>
                    <TD align="center" class="search_area">
                        <FORM action="http://go.tinelix.ru/search">
                            <INPUT name="q" type="text" value="Введите запрос для поиска в Интернете..." size="40" id="web_search" class="search_ta" onfocus="setSearchFocus()">
                            <INPUT type="submit" class="search_btn" value="Поиск">
                        </FORM>
                    </TD>
                </TR>
        </CENTER>
        <CENTER>
            <TABLE width="600" cellpadding="0" cellspacing="0">
                <TR valign="top" class="feed_top">
                    <TD align="left" class="feed_left" width="240">
                        <H4 class="feed_title">Добрый вечер!</H4>
                        <DIV class="today_widget">
                            Вс, <B>21 декабря</B>
                            <TABLE>
                                <TR>
                                    <TD>
                                        <SPAN class="weather_city">с. Камыши, ННР</SPAN>
                                        <BR><SPAN class="weather_temp">-15&deg;</SPAN>
                                        <BR><A href="weather.php" class="weather_link">Прогноз на 7 дней</A>
                                    </TD>
                                </TR>
                            </TABLE>
                        </DIV>
                        <HR></HR>
                        <H4 class="feed_title">Новости в мире ИТ</H4>
                        <B><A href="https://kod.ru">Valve сняла с продаж LCD-версию Steam Deck</a></B>
                        <P class="feed_subtitle"><A href="https://kod.ru">Код Дурова</a> | 13:32, 21.12.2025</P>
                        <P><B><A href="https://kod.ru">Наблюдаются проблемы с Apple Podcasts</a></B>
                        <P class="feed_subtitle"><A href="https://kod.ru">Код Дурова</a> | 10:58, 20.12.2025</P>
                        <P><B><A href="https://kod.ru">Компания SpaceX закупила больше тысячи Cybertruck</A></B>
                        <P class="feed_subtitle"><A href="https://kod.ru">Код Дурова</a> | 15:26, 20.12.2025</P>
                        <P><B><A href="https://hi-tech.mail.ru">Минцифры готовит проект регистрации смартфонов в России по IMEI</A></B>
                        <P class="feed_subtitle"><A href="https://hi-tech.mail.ru">Hi-Tech Mail</a> | 17:33, 19.12.2025</P>
                        <HR></HR>
                        <H4 class="feed_title">Реклама</H4>
                        <B><A href="http://veselcraft.ru">Lorem Ipsum</a></B>
                        <P>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                        <P><P class="feed_subtitle"><A href="https://veselcraft.ru">Veselcraft</a> | Erid: VESELCRAFT</P>

                    </TD>
                    <TD align="left">
                        <H4 class="feed_title">Каталог сайтов</H4>
                        <B>Хобби</B>
                        <BR>
                        <A href="catalog.php?category=hobbies&subcategory=sport">Спорт</A>
                        <A href="catalog.php?category=hobbies&subcategory=programming">Программирование</A>
                        <A href="catalog.php?category=hobbies&subcategory=photos">Фотографии</A>
                        <A href="catalog.php?category=hobbies&subcategory=litherature">Литература</A>
                    </TD>
                </TR>
            <TABLE>
        </CENTER>
    </BODY>
</HTML>
