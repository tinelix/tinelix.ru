<?php
    function showProjectsPage($db, $html_encoding) {
        $query = "SELECT id, name, description, link FROM projects;";
        $result = $db->query($query) or die("Last error: {$db->lastErrorMsg()}\n");
        $projects = array();
        $html = "\r\n                    <td bgcolor=\"#151515\" valign=\"top\">
                \r\n                        <div class=\"title-text\">ПРОЕКТЫ</div>
                \r\n                        <hr class=\"accent-color\" size=\"1\"/>
                \r\n                        <div class=\"text\">";
        $params = "";
        if($html_encoding) {
            $params = "?encoding=".$html_encoding;
        }
        while($project = $result->fetchArray()) {
            array_push($projects, $project);
        }
        for($i = 0; $i < count($projects); ++$i) {
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

    function showProjectPage($i, $html_encoding) {
        $html = "";
        if($i == 0) {
            $html = "
                \r\n                    <td bgcolor=\"#151515\" valign=\"top\">
                \r\n                        <div class=\"title-text\">TINELIX IRC CLIENT</div>
                \r\n                        <hr class=\"accent-color\" size=\"1\"/>
                \r\n                        <div class=\"text\">
                \r\n                            <i>Если вы не знакомы c IRC, нажмите <a href=\"http://irc.tinelix.ru\">здесь</a>.</i>
                \r\n                            <h4>Предыстория</h4>
                \r\n                            Раз уж я начал знакомство с проектом <a href=\"http://narodweb.ru\" target=\"_blank\">Народное достояние Рунета</a> в начале лета 2021 г., в августе в моей голове появилась такая мысль о создании собственного IRC-клиента на языке программирования Python 3.x и на базе PyQt5, так как тогда мой коллега <a href=\"https://youtube.com/veselcraft\" target=\"_blank\">Владимир Баринов (Veselcraft)</a> писал клиент для серверов Escargot на языке JavaScript для интепретатора node.js.
                \r\n                            <h4>Журнал изменений</h4>
                \r\n                            <h5>0.1.2 для Android</h5>
                \r\n                            <ol>
                \r\n                                <li>Помимо поддержки Android 2.x, которая появилась с версии 0.1.0, улучшен внешний вид приложения. Это, что касается версий Android ниже 3.0.</li>
                \r\n                                <li>Добавлена возможность создавать пользовательские QUIT-сообщения.</li>
                \r\n                            </ol>
                \r\n                            <h4>Исходный код</h4>
                \r\n                            <div align=\"center\">
                \r\n                                <a href=\"https://github.com/tinelix/irc-client-win32_64\">для Windows (x86/x64)</a>
                \r\n                                <br><a href=\"https://github.com/tinelix/irc-client-win32_64\">для Windows (x86/x64)</a>
                \r\n                                <br><a href=\"https://github.com/tinelix/irc-client-win32s\">для Win32s</a>
                \r\n                                <br><a href=\"https://github.com/tinelix/irc-client\">для Python</a>
                \r\n                            </div>
                \r\n                            <h4>Предварительно-скомпилированные файлы</h4>
                \r\n                            <div align=\"center\">
                \r\n                                <a href=\"https://github.com/tinelix/irc-client-win32_64\">для Windows (x86/x64)</a>
                \r\n                                <br><a href=\"https://github.com/tinelix/irc-client-win32s/releases/tag/0.1.12-beta-win32s\">для Win32s</a>
                \r\n                            </div>
                \r\n                        </div>
                \r\n                    </td>
                \r\n                </tr>
                \r\n            </tbody>
                \r\n        </table>";
        } else if($i == 1) {
            $html = "
                \r\n                    <td bgcolor=\"#151515\" valign=\"top\">
                \r\n                        <div class=\"title-text\">TINELIX MICROBOT</div>
                \r\n                        <hr class=\"accent-color\" size=\"1\"/>
                \r\n                        <div class=\"text\">
                \r\n                            Простой развлекательно-информационный бот Microbot на Disnake.
                \r\n                            <p>Этот Discord-бот является очередным преемником бота VisionOne, разработка которого была прекращена в середине 2021 года. Как и предшественник, он имеет интеграцию с БД SQlite3, упрощенную в разы, умеет узнавать местную погоду в OpenWeatherMap, показывать статьи из Википедии, развлекать игрой \"Восьмерка\" и генерировать случайные числа в указанном диапазоне.
                \r\n                            <br><br>Сейчас бот насчитывает около <b>11</b> серверов.
                \r\n                            <h4>Список команд</h4>
                \r\n                            <table rules=\"all\" cellpadding=\"5\" bordercolor=\"#8f8f8f\">
                \r\n                            <tbody>
                \r\n                                <tr>
                \r\n                                    <th>Команда</th>
                \r\n                                    <th>Синтаксис</th>
                \r\n                                    <th>Описание</th>
                \r\n                                </tr>
                \r\n                                <tr>
                \r\n                                    <td><code>help</code></td>
                \r\n                                    <td><code>help</code> или <code>help [имя команды]</code></td>
                \r\n                                    <td>Показывает справочную информацию, включая список доступных команд.</td>
                \r\n                                </tr>
                \r\n                                <tr>
                \r\n                                    <td><code>about</code></td>
                \r\n                                    <td><code>about</code></td>
                \r\n                                    <td>Показывает описание бота, а также служебную информацию.</td>
                \r\n                                </tr>
                \r\n                                <tr>
                \r\n                                    <td><code>user</code></td>
                \r\n                                    <td><code>user [@упоминание | ID участника | юзернейм]</code></td>
                \r\n                                    <td>Показывает информацию о пользователе.</td>
                \r\n                                </tr>
                \r\n                                <tr>
                \r\n                                    <td><code>guild</code></td>
                \r\n                                    <td><code>guild</code></td>
                \r\n                                    <td>Показывает информацию о гильдии (сервере)</td>
                \r\n                                </tr>
                \r\n                                <tr>
                \r\n                                    <td><code>ping</code></td>
                \r\n                                    <td><code>ping</code></td>
                \r\n                                    <td>Пни меня.</td>
                \r\n                                </tr>
                \r\n                                <tr>
                \r\n                                    <td><code>8ball</code></td>
                \r\n                                    <td><code>8ball [вопрос]</code></td>
                \r\n                                    <td>Генерирует для любого вопроса случайный ответ. Все совпадения случайны!</td>
                \r\n                                </tr>
                \r\n                                <tr>
                \r\n                                    <td><code>rngen</code> или <code>rand</code></td>
                \r\n                                    <td><code>rngen [начало диапазона]-[конец диапазона]</code></td>
                \r\n                                    <td>Генерирует случайное число в указанном диапазоне.</td>
                \r\n                                </tr>
                \r\n                                <tr>
                \r\n                                    <td><code>weather</code></td>
                \r\n                                    <td><code>weather [город или населенный пункт]</code></td>
                \r\n                                    <td>Отображает прогноз погоды на ближайшие 24 часа. Для этого используется сервис <a href=\"https://openweathermap.org/\">OpenWeatherMap</a>.</td>
                \r\n                                </tr>
                \r\n                                <tr>
                \r\n                                    <td><code>wiki</code></td>
                \r\n                                    <td><code>wiki [полное название страницы]</code></td>
                \r\n                                    <td>Показывает статью в Википедии в краткой форме.</td>
                \r\n                                </tr>
                \r\n                                <tr>
                \r\n                                    <td><code>settings</code></td>
                \r\n                                    <td><code>settings</code> или <code>settings [-L] [значение]</code></td>
                \r\n                                    <td>Настройки бота.</td>
                \r\n                                </tr>
                \r\n                                <tr>
                \r\n                                    <td><code>calc</code></td>
                \r\n                                    <td><code>calc [выражение]</code></td>
                \r\n                                    <td>Простейший калькулятор.</td>
                \r\n                                </tr>
                \r\n                                <tr>
                \r\n                                    <td><code>codec</code></td>
                \r\n                                    <td><code>codec [-d / -e] [алгоритм] [содержимое]</code></td>
                \r\n                                    <td>Расшифровка и зашифровка текста.</td>
                \r\n                                </tr>
                \r\n                                <tr>
                \r\n                                    <td><code>timers</code></td>
                \r\n                                    <td><code>timers</code><br><code>timers [-Cr / -Ce] [имя таймера] -t [ГГГГ-ММ-ДД ЧЧ:ММ:СС] -e [эмодзи]</code><br><code>timers -D [имя таймера]</code></td>
                \r\n                                    <td>Создание и управление таймерами в прошедшее и оставшиеся времени.</td>
                \r\n                                </tr>
                \r\n                                <tr>
                \r\n                                    <td><code>publish</code></td>
                \r\n                                    <td><code>publish</code> или <code>publish [текст]</code></td>
                \r\n                                    <td>Публикует сообщения с новостного канала без лишнего клика по кнопке мыши.</td>
                \r\n                                </tr>
                \r\n                            </tbody></table>
                \r\n                            <h4>Исходный код</h4>
                \r\n                            <div align=\"center\">
                \r\n                                <a href=\"https://github.com/tinelix/irc-client-win32_64\">для Windows (x86/x64)</a>
                \r\n                                <br><a href=\"https://github.com/tinelix/irc-client-win32_64\">для Windows (x86/x64)</a>
                \r\n                                <br><a href=\"https://github.com/tinelix/irc-client-win32s\">для Win32s</a>
                \r\n                                <br><a href=\"https://github.com/tinelix/irc-client\">для Python</a>
                \r\n                            </div>
                \r\n                            <h4>Предварительно-скомпилированные файлы</h4>
                \r\n                            <div align=\"center\">
                \r\n                                <a href=\"https://github.com/tinelix/irc-client-win32_64\">для Windows (x86/x64)</a>
                \r\n                                <br><a href=\"https://github.com/tinelix/irc-client-win32s/releases/tag/0.1.12-beta-win32s\">для Win32s</a>
                \r\n                            </div>
                \r\n                        </div>
                \r\n                    </td>
                \r\n                </tr>
                \r\n            </tbody>
                \r\n        </table>";
        } else if ($i == 2) {
            $html = "
                \r\n                    <td bgcolor=\"#151515\" valign=\"top\">
                \r\n                        <div class=\"title-text\">OPENVK LEGACY</div>
                \r\n                        <hr class=\"accent-color\" size=\"1\"/>
                \r\n                        <div class=\"text\">
                \r\n                            <ol>
                \r\n                                <li>Мобильное приложение OpenVK для ретро-устройств на Android с дизайном ВКонтакте 3.0.4 из 2013 года.</li>
                \r\n                                <li>Минимально поддерживаемой версией является Android 2.1 Eclair, то есть аппараты времён начала 2010-ых вполне пригодятся.</li>
                \r\n                            </ol>
                \r\n                            <h4>Журнал изменений</h4>
                \r\n                            <h5>1.1, сборка №176</h5>
                \r\n                            <ol>
                \r\n                                <li>Добавлено воспроизведение вложенных видео. Обратите внимание, полноценное воспроизведение видео доступно лишь в Android 3.1+, иначе приходится устанавливать сторонний плеер.</li>
                \r\n                                <li>Проведен рефакторинг всех основных макетов интерфейса: вместо каких-либо примитивных объектов класса View используются фрагменты. Это делает работу приложения намного эффективнее, но при этом имеются косяки в переключении (позже будет исправлено, окда).</li>
                \r\n                                <li>Переделан экран настроек.</li>
                \r\n                                <li>Теперь панель эмодзи при открытии клавиатуры сразу скрывается, что делает прокрутку сообщений комфортным.</li>
                \r\n                                <li><s>Исправлен баг, связанный с прокруткой постов в ленте.</s></li>
                \r\n                            </ol>
                \r\n                            <h4>Исходный код</h4>
                \r\n                            <div align=\"center\">
                \r\n                                <a href=\"https://github.com/tinelix/microbot\">для Android</a>
                \r\n                            </div>
                \r\n                            <h4>Предварительно-скомпилированные файлы</h4>
                \r\n                            <div align=\"center\">
                \r\n                                <a href=\"https://f-droid.org/packages/uk.openvk.android.legacy\">F-Droid</a>
                \r\n                                <br><a href=\"https://github.com/openvk/mobile-android-legacy/releases/tag/1.1.176-alpha\">GitHub</a>
                \r\n                            </div>
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
            $query = "SELECT id, name, link FROM banners;";
            $result = $db->query($query) or die("Last error: {$db->lastErrorMsg()}\n");
            $banners = array();
            $html = "\r\n                    <td bgcolor=\"#151515\" valign=\"top\">
                     \r\n                        <div class=\"title-text\">БАННЕР ДЛЯ САЙТА</div>
                     \r\n                        <hr class=\"accent-color\" size=\"1\"/>
                     \r\n                        <div class=\"text\">";
            while($banner = $result->fetchArray()) {
                array_push($banners, $banner);
            }
            for($i = 0; $i < count($banners); ++$i) {
                $html = $html."
                \r\n                            <h4>".$banners[$i][1]."</h4>
                \r\n                            <div align=\"center\">
                \r\n                                <img src=\"".$banners[$i][2]."\" width=\"88\" height=\"31\" />
                \r\n                                <br>
                \r\n                                <pre class=\"full-code\">
&lt;a href=\"http://web1.tinelix.ru/\"&gt;
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
                \r\n            </tbody>
                \r\n        </table>";
        if(!$html_encoding || $html_encoding != "utf-8") {
            echo mb_convert_encoding($html, "windows-1251", "utf-8");
        } else {
            echo $html;
        }
    }
?>
