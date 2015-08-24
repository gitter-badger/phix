<?php

/* ФУНКЦИИ РАБОТЫ С ТЕКСТОВЫМ КОНТЕНТОМ */

// Рендер виджета с передачей массива данных внутрь него
function r($widget_path, $v = false) {
    global $page, $app, $self;
    if (! is_array($v)) $content = $v;
    require "/templates/$widget_path.php";
}

// Вывод дампа переменной и остановка выполнения программы
function dd($variable) {
    die ( nl2br( print_r( $variable, true ) ) );
}

// Подключение дополнительного ресурса с проверкой на дублирование
function resource($path, $type = false) {
    global $page;
    if (!is_array($path)) $paths = [$path];
    else $paths = $path;
    foreach ($paths as $path) {
        // Если тип ресурса не указан, пытаемся определить его самостоятельно по последним 3 символам
        if ($type === false) $type_ = substr($path, (strlen($path) - 3), 3);
        else $type_ = $type;
        $type_ = strtolower($type_);
        switch ($type_) {
            case 'css':
                if (array_search($path, $page['css']) === false) $page['css'][] = $path; break;

            case 'js':
            case '.js':
                if (array_search($path, $page['js']) === false) $page['js'][] = $path; break;

            default: /* Подключение скрипта из переменной, а не в виде файла */
                $page['js_raw'] .= "$path\r\n";
        }
    }
}

// Вывод списка подключаемых стилей
function css_resources() {
    global $page;
    $r = '';
    // Подключение дополнительных стилей для страницы, если они объявлены
    if (count($page['css'])) {
        foreach ($page['css'] as $css) {
            if (substr($css, 0, 4) == 'http') $r .= "<link rel=\"stylesheet\" href=\"$css\">\r\n";
            else {
                $css_path1 = "/assets/css/" . $css;
                $css_path2 = "/vendor/" . $css;
                if (file_exists( MC_ROOT . $css_path1 )) $r .= "<link rel=\"stylesheet\" href=\"$css_path1\">\r\n";
                else if (file_exists( MC_ROOT . $css_path2 )) $r .= "<link rel=\"stylesheet\" href=\"$css_path2\">\r\n";
            }
        }
    }
    // Подключение индивидуального стиля с именем, равным имени страницы, если такой существует
    $css_path = "/assets/css/" . substr($self, 0, strlen($self) - 4) . ".css";
    if (file_exists( MC_ROOT . $css_path )) $r .= '<link rel="stylesheet" href="' . $css_path . '">';
    return $r;
}

// Вывод списка подключаемых JS
function js_resources() {
    global $page, $self;
    $r = '';
    // Подключение дополнительных скриптов для страницы, если они объявлены
    if (count($page['js'])) {
        foreach ($page['js'] as $script) {
            if (substr($script, 0, 4) == 'http') $r .= "<script src=\"$script\"></script>\r\n";
            else {
                $script_path1 = "/assets/js/" . $script;
                $script_path2 = "/vendor/" . $script;
                if (file_exists(MC_ROOT . $script_path1)) $r .= "<script src=\"$script_path1\"></script>\r\n";
                else if (file_exists(MC_ROOT . $script_path2)) $r .= "<script src=\"$script_path2\"></script>\r\n";
            }
        }
    }
    // Подключение индивидуального скрипта с именем, равным имени страницы, если такой существует
    $script_path = "/assets/js/" . substr($self, 0, strlen($self) - 4) . ".js";
    if (file_exists( MC_ROOT . $script_path )) $r .= "<script src=\"$script_path\"></script>\r\n";
    // js, не подключаемый из файла, а генерируемый "на лету"
    if (!empty($page['js_raw'])) {
        $r .= '<script type="text/javascript">' . "\r\n";
        $r .= $page['js_raw'];
        $r .= "</script>\r\n";
    }
    return $r;
}