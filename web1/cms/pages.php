<?php
    function showProjectsPage($db) {
            $query = "SELECT id, name, description, link FROM projects;";
            $result = $db->query($query) or die("Last error: {$db->lastErrorMsg()}\n");
            $projects = array();
            $html = "\r\n                    <td bgcolor=\"#151515\" valign=\"top\">
                \r\n                        <div class=\"title-text\">�������</div>
                \r\n                        <hr class=\"accent-color\" size=\"1\"/>
                \r\n                        <div class=\"text\">";
            $html_cp1251 = mb_convert_encoding($html, "utf-8", "windows-1251");
            echo $html_cp1251;
            while($project = $result->fetchArray()) {
                array_push($projects, $project);
            }
            for($i = 0; $i < count($projects); ++$i) {
                echo "
                \r\n                            <a href=\"".$projects[$i][3]."\">".$projects[$i][1]."</a>
                \r\n                            <br><span class=\"subtext\">".$projects[$i][2]."</span>";
                if($i < count($projects) - 1) {
                    echo "
                    \r\n                            <hr size=\"1\"/>";
                }
            }
            echo "</div>
                \r\n                    </td>
                \r\n                </tr>
                \r\n            </tbody>
                \r\n        </table>";
        }

    function showProjectPage($i) {
        if($i == 0) {
            $html = "
                \r\n                    <td bgcolor=\"#151515\" valign=\"top\">
                \r\n                        <div class=\"title-text\">TINELIX IRC CLIENT</div>
                \r\n                        <hr class=\"accent-color\" size=\"1\"/>
                \r\n                        <div class=\"text\">
                \r\n                            <i>���� �� �� ������� c IRC, ������� <a href=\"http://irc.tinelix.ru\">�����</a>.</i>
                \r\n                            <h4>�����������</h4>
                \r\n                            ��� �� � ����� ���������� � �������� <a href=\"http://narodweb.ru\" target=\"_blank\">�������� ��������� ������</a> � ������ ���� 2021 �., � ������� � ���� ������ ��������� ����� ����� � �������� ������������ IRC-������� �� ����� ���������������� Python 3.x � �� ���� PyQt5, ��� ��� ����� ��� ������� <a href=\"https://youtube.com/veselcraft\" target=\"_blank\">�������� ������� (Veselcraft)</a> ����� ������ ��� �������� Escargot �� ����� JavaScript ��� ������������� node.js.
                \r\n                            <h4>������ ���������</h4>
                \r\n                            <h5>0.1.2 ��� Android</h5>
                \r\n                            <ol>
                \r\n                                <li>������ ��������� Android 2.x, ������� ��������� � ������ 0.1.0, ������� ������� ��� ����������. ���, ��� �������� ������ Android ���� 3.0.</li>
                \r\n                                <li>��������� ����������� ��������� ���������������� QUIT-���������.</li>
                \r\n                            </ol>
                \r\n                            <h4>�������� ���</h4>
                \r\n                            <div align=\"center\">
                \r\n                                <a href=\"https://github.com/tinelix/irc-client-win32_64\">��� Windows (x86/x64)</a>
                \r\n                                <br><a href=\"https://github.com/tinelix/irc-client-win32_64\">��� Windows (x86/x64)</a>
                \r\n                                <br><a href=\"https://github.com/tinelix/irc-client-win32s\">��� Win32s</a>
                \r\n                                <br><a href=\"https://github.com/tinelix/irc-client\">��� Python</a>
                \r\n                            </div>
                \r\n                            <h4>��������������-���������������� �����</h4>
                \r\n                            <div align=\"center\">
                \r\n                                <a href=\"https://github.com/tinelix/irc-client-win32_64\">��� Windows (x86/x64)</a>
                \r\n                                <br><a href=\"https://github.com/tinelix/irc-client-win32s/releases/tag/0.1.12-beta-win32s\">��� Win32s</a>
                \r\n                            </div>
                \r\n                        </div>
                \r\n                    </td>
                \r\n                </tr>
                \r\n            </tbody>
                \r\n        </table>";
            $html_cp1251 = mb_convert_encoding($html, "utf-8", "windows-1251");
            echo $html_cp1251;
        } else if($i == 1) {
            $html = "
                \r\n                    <td bgcolor=\"#151515\" valign=\"top\">
                \r\n                        <div class=\"title-text\">TINELIX MICROBOT</div>
                \r\n                        <hr class=\"accent-color\" size=\"1\"/>
                \r\n                        <div class=\"text\">
                \r\n                            ������� ��������������-�������������� ��� Microbot �� Disnake.
                \r\n                            <p>���� Discord-��� �������� ��������� ���������� ���� VisionOne, ���������� �������� ���� ���������� � �������� 2021 ����. ��� � ��������������, �� ����� ���������� � �� SQlite3, ���������� � ����, ����� �������� ������� ������ � OpenWeatherMap, ���������� ������ �� ���������, ���������� ����� \"���������\" � ������������ ��������� ����� � ��������� ���������.
                \r\n                            <br><br>������ ��� ����������� ����� <b>11</b> ��������.
                \r\n                            <h4>������ ������</h4>
                \r\n                            <table rules=\"all\" cellpadding=\"5\" bordercolor=\"#8f8f8f\">
                \r\n                            <tbody>
                \r\n                                <tr>
                \r\n                                    <th>�������</th>
                \r\n                                    <th>���������</th>
                \r\n                                    <th>��������</th>
                \r\n                                </tr>
                \r\n                                <tr>
                \r\n                                    <td><code>help</code></td>
                \r\n                                    <td><code>help</code> ��� <code>help [��� �������]</code></td>
                \r\n                                    <td>���������� ���������� ����������, ������� ������ ��������� ������.</td>
                \r\n                                </tr>
                \r\n                                <tr>
                \r\n                                    <td><code>about</code></td>
                \r\n                                    <td><code>about</code></td>
                \r\n                                    <td>���������� �������� ����, � ����� ��������� ����������.</td>
                \r\n                                </tr>
                \r\n                                <tr>
                \r\n                                    <td><code>user</code></td>
                \r\n                                    <td><code>user [@���������� | ID ��������� | ��������]</code></td>
                \r\n                                    <td>���������� ���������� � ������������.</td>
                \r\n                                </tr>
                \r\n                                <tr>
                \r\n                                    <td><code>guild</code></td>
                \r\n                                    <td><code>guild</code></td>
                \r\n                                    <td>���������� ���������� � ������� (�������)</td>
                \r\n                                </tr>
                \r\n                                <tr>
                \r\n                                    <td><code>ping</code></td>
                \r\n                                    <td><code>ping</code></td>
                \r\n                                    <td>��� ����.</td>
                \r\n                                </tr>
                \r\n                                <tr>
                \r\n                                    <td><code>8ball</code></td>
                \r\n                                    <td><code>8ball [������]</code></td>
                \r\n                                    <td>���������� ��� ������ ������� ��������� �����. ��� ���������� ��������!</td>
                \r\n                                </tr>
                \r\n                                <tr>
                \r\n                                    <td><code>rngen</code> ��� <code>rand</code></td>
                \r\n                                    <td><code>rngen [������ ���������]-[����� ���������]</code></td>
                \r\n                                    <td>���������� ��������� ����� � ��������� ���������.</td>
                \r\n                                </tr>
                \r\n                                <tr>
                \r\n                                    <td><code>weather</code></td>
                \r\n                                    <td><code>weather [����� ��� ���������� �����]</code></td>
                \r\n                                    <td>���������� ������� ������ �� ��������� 24 ����. ��� ����� ������������ ������ <a href=\"https://openweathermap.org/\">OpenWeatherMap</a>.</td>
                \r\n                                </tr>
                \r\n                                <tr>
                \r\n                                    <td><code>wiki</code></td>
                \r\n                                    <td><code>wiki [������ �������� ��������]</code></td>
                \r\n                                    <td>���������� ������ � ��������� � ������� �����.</td>
                \r\n                                </tr>
                \r\n                                <tr>
                \r\n                                    <td><code>settings</code></td>
                \r\n                                    <td><code>settings</code> ��� <code>settings [-L] [��������]</code></td>
                \r\n                                    <td>��������� ����.</td>
                \r\n                                </tr>
                \r\n                                <tr>
                \r\n                                    <td><code>calc</code></td>
                \r\n                                    <td><code>calc [���������]</code></td>
                \r\n                                    <td>���������� �����������.</td>
                \r\n                                </tr>
                \r\n                                <tr>
                \r\n                                    <td><code>codec</code></td>
                \r\n                                    <td><code>codec [-d / -e] [��������] [����������]</code></td>
                \r\n                                    <td>����������� � ���������� ������.</td>
                \r\n                                </tr>
                \r\n                                <tr>
                \r\n                                    <td><code>timers</code></td>
                \r\n                                    <td><code>timers</code><br><code>timers [-Cr / -Ce] [��� �������] -t [����-��-�� ��:��:��] -e [������]</code><br><code>timers -D [��� �������]</code></td>
                \r\n                                    <td>�������� � ���������� ��������� � ��������� � ���������� �������.</td>
                \r\n                                </tr>
                \r\n                                <tr>
                \r\n                                    <td><code>publish</code></td>
                \r\n                                    <td><code>publish</code> ��� <code>publish [�����]</code></td>
                \r\n                                    <td>��������� ��������� � ���������� ������ ��� ������� ����� �� ������ ����.</td>
                \r\n                                </tr>
                \r\n                            </tbody></table>
                \r\n                            <h4>�������� ���</h4>
                \r\n                            <div align=\"center\">
                \r\n                                <a href=\"https://github.com/tinelix/irc-client-win32_64\">��� Windows (x86/x64)</a>
                \r\n                                <br><a href=\"https://github.com/tinelix/irc-client-win32_64\">��� Windows (x86/x64)</a>
                \r\n                                <br><a href=\"https://github.com/tinelix/irc-client-win32s\">��� Win32s</a>
                \r\n                                <br><a href=\"https://github.com/tinelix/irc-client\">��� Python</a>
                \r\n                            </div>
                \r\n                            <h4>��������������-���������������� �����</h4>
                \r\n                            <div align=\"center\">
                \r\n                                <a href=\"https://github.com/tinelix/irc-client-win32_64\">��� Windows (x86/x64)</a>
                \r\n                                <br><a href=\"https://github.com/tinelix/irc-client-win32s/releases/tag/0.1.12-beta-win32s\">��� Win32s</a>
                \r\n                            </div>
                \r\n                        </div>
                \r\n                    </td>
                \r\n                </tr>
                \r\n            </tbody>
                \r\n        </table>";
            $html_cp1251 = mb_convert_encoding($html, "utf-8", "windows-1251");
            echo $html_cp1251;
        } else if ($i == 2) {
            $html = "
                \r\n                    <td bgcolor=\"#151515\" valign=\"top\">
                \r\n                        <div class=\"title-text\">OPENVK LEGACY</div>
                \r\n                        <hr class=\"accent-color\" size=\"1\"/>
                \r\n                        <div class=\"text\">
                \r\n                            <ol>
                \r\n                                <li>��������� ���������� OpenVK ��� �����-��������� �� Android � �������� ��������� 3.0.4 �� 2013 ����.</li>
                \r\n                                <li>���������� �������������� ������� �������� Android 2.1 Eclair, �� ���� �������� ����� ������ 2010-�� ������ ����������.</li>
                \r\n                            </ol>
                \r\n                            <h4>������ ���������</h4>
                \r\n                            <h5>1.1, ������ �176</h5>
                \r\n                            <ol>
                \r\n                                <li>��������� ��������������� ��������� �����. �������� ��������, ����������� ��������������� ����� �������� ���� � Android 3.1+, ����� ���������� ������������� ��������� �����.</li>
                \r\n                                <li>�������� ����������� ���� �������� ������� ����������: ������ �����-���� ����������� �������� ������ View ������������ ���������. ��� ������ ������ ���������� ������� �����������, �� ��� ���� ������� ������ � ������������ (����� ����� ����������, ����).</li>
                \r\n                                <li>��������� ����� ��������.</li>
                \r\n                                <li>������ ������ ������ ��� �������� ���������� ����� ����������, ��� ������ ��������� ��������� ����������.</li>
                \r\n                                <li><s>��������� ���, ��������� � ���������� ������ � �����.</s></li>
                \r\n                            </ol>
                \r\n                            <h4>�������� ���</h4>
                \r\n                            <div align=\"center\">
                \r\n                                <a href=\"https://github.com/tinelix/microbot\">��� Android</a>
                \r\n                            </div>
                \r\n                            <h4>��������������-���������������� �����</h4>
                \r\n                            <div align=\"center\">
                \r\n                                <a href=\"https://f-droid.org/packages/uk.openvk.android.legacy\">F-Droid</a>
                \r\n                                <br><a href=\"https://github.com/openvk/mobile-android-legacy/releases/tag/1.1.176-alpha\">GitHub</a>
                \r\n                            </div>
                \r\n                        </div>
                \r\n                    </td>
                \r\n                </tr>
                \r\n            </tbody>
                \r\n        </table>";
            $html_cp1251 = mb_convert_encoding($html, "utf-8", "windows-1251");
            echo $html_cp1251;
        }
    }

    function showHardwarePage($db) {
            $query = "SELECT id, name, specs FROM hardware WHERE type = 0;";
            $result = $db->query($query) or die("Last error: {$db->lastErrorMsg()}\n");
            $computers = array();
            $html = "\r\n                    <td bgcolor=\"#151515\" valign=\"top\">
                     \r\n                        <div class=\"title-text\">������������</div>
                     \r\n                        <hr class=\"accent-color\" size=\"1\"/>
                     \r\n                        <div class=\"text\">";
            $html_cp1251 = mb_convert_encoding($html, "utf-8", "windows-1251");
            echo $html_cp1251;
            while($computer = $result->fetchArray()) {
                array_push($computers, $computer);
            }
            echo mb_convert_encoding("\r\n                          <h3>����������</h3>", "utf-8", "windows-1251");
            for($i = 0; $i < count($computers); ++$i) {
                echo "
                \r\n                            <h4>".$computers[$i][1]."</h4>
                \r\n                            ".$computers[$i][2];
            }
            echo mb_convert_encoding("\r\n                          <h3>���������</h3>", "utf-8", "windows-1251");
            $query = "SELECT id, name, specs FROM hardware WHERE type = 1;";
            $result = $db->query($query) or die("Last error: {$db->lastErrorMsg()}\n");
            $phones = array();
            while($phone = $result->fetchArray()) {
                array_push($phones, $phone);
            }
            for($i = 0; $i < count($phones); ++$i) {
                echo "
                \r\n                            <h4>".$phones[$i][1]."</h4>
                \r\n                            ".$phones[$i][2];
            }
            echo "</div>
                \r\n                    </td>
                \r\n                </tr>
                \r\n            </tbody>
                \r\n        </table>";
    }

    function showWebsiteBannersPage($db) {
            $query = "SELECT id, name, link FROM banners;";
            $result = $db->query($query) or die("Last error: {$db->lastErrorMsg()}\n");
            $banners = array();
            $html = "\r\n                    <td bgcolor=\"#151515\" valign=\"top\">
                     \r\n                        <div class=\"title-text\">������ ��� �����</div>
                     \r\n                        <hr class=\"accent-color\" size=\"1\"/>
                     \r\n                        <div class=\"text\">";
            $html_cp1251 = mb_convert_encoding($html, "utf-8", "windows-1251");
            echo $html_cp1251;
            while($banner = $result->fetchArray()) {
                array_push($banners, $banner);
            }
            for($i = 0; $i < count($banners); ++$i) {
                echo "
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
            echo "</div>
                \r\n                    </td>
                \r\n                </tr>
                \r\n            </tbody>
                \r\n        </table>";
    }
?>
