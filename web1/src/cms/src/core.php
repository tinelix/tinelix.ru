<?php

    use ByJG\Jinja\Template;

    function loadTemplate($db, $html_encoding, $content) {
        $template_fn = dirname(__FILE__)."/template.html";
        if(file_exists($template_fn)) {
            $template_file = fread(fopen($template_fn, "r"), filesize($template_fn));
            $template = new Template($template_file);
            $template->withUndefined(new DebugUndefined());

            // Setting encoding
            if($html_encoding == "cp1251") {
                $header = '<meta http-equiv=\"Content-Type\" content=\"text/html; charset=windows-1251\">";';
            } else {
                $header = '<meta http-equiv=\"Content-Type\" content=\"text/html; charset="'.$html_encoding.'">";';
            }

            // Setting website title bar
            $current_time = new DateTime('now', new DateTimeZone('Europe/Moscow'));
            $dw = date("w");
            $formatter = new IntlDateFormatter('ru_RU', IntlDateFormatter::MEDIUM, IntlDateFormatter::MEDIUM);
            $dws = array('Воскресенье', 'Понедельник', 'Вторник', 'Среда', 'Четверг', 'Пятница', 'Суббота');
            $formatter->setPattern('dd.MM.yyyy');

            $query = "SELECT * FROM menu;";
            $result = $db->query($query);
            $menu_items = array();
            while($menu_item = $result->fetchArray()) {
                array_push($menu_items, $menu_item);
            };

            $variables = [
                'web1_subdomain' => 'web1.tinelix.ru',
                'irc_subdomain' => 'irc.tinelix.ru',
                'currnet_dw' => $dws["w"][$dw],
                'date' => $formatter->format($current_time),
                'lastupd_date' => "09.02.2024",
                'html_encoding' => $html_encoding,
                'content' => $content,
                'menu_items' => $menu_items
            ];

            $html = $template->render($variables);
            if(!$html_encoding || $html_encoding != "utf-8") {
                echo mb_convert_encoding($html, "windows-1251", "utf-8");
            } else {
                echo $html;
            }
        } else {
            echo "<html><body><b>Jinja template not found!</b><p>Check the template path: <pre>".$template_fn."</pre></body></html>";
        }
    }
?>
