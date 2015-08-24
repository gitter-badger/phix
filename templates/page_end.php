<?php
// Подключение дополнительных скриптов для страницы, если они объявлены
if (count($page['js'])) {
    foreach ($page['js'] as $script) {
        if (substr($script, 0, 4) == 'http') echo "<script src=\"$script\"></script>\r\n";
        else {
            $script_path1 = "/assets/js/" . $script;
            $script_path2 = "/vendor/" . $script;
            if (file_exists(MC_ROOT . $script_path1)) echo "<script src=\"$script_path1\"></script>\r\n";
            else if (file_exists(MC_ROOT . $script_path2)) echo "<script src=\"$script_path2\"></script>\r\n";
        }
    }
}

// Подключение индивидуального скрипта с именем, равным имени страницы, если такой существует
$script_path = "/assets/js/" . substr($self, 0, strlen($self) - 4) . ".js";
if (file_exists( MC_ROOT . $script_path )) echo "<script src=\"$script_path\"></script>\r\n";