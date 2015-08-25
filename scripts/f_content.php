<?php
require_once  MC_ROOT . '/min/utils.php';

/* ФУНКЦИИ РАБОТЫ С ТЕКСТОВЫМ КОНТЕНТОМ */

// Вставка выполняемого кода или виджета с передачей массива данных внутрь него
// Переданный массив данных доступен внутри виджета как массив $v
// Если передан не массив, а единственная переменная, то она доступна как $v, так и как $content
// Формат файла - строго .php (окончание '.php' при вызове функции можно опустить)
function execute($widget_path, $v = false) {
    global $page, $app, $self;
    $type = substr($widget_path, (strlen($widget_path) - 4), 4);
    if ($type != '.php') $widget_path = trim($widget_path) . '.php';
    if (! is_array($v)) $content = $v;
    $full_path = MC_ROOT . '/templates/' . $widget_path;
    if ($app['mode'] == 'debug') require $full_path;
    else @require $full_path;
}

// Рендер файла с передачей массива данных внутрь него
// Значения в переданном ассоциативном массиве заменяют вставки [[name]] в файле, где name - имя ключа массива
// т.е. если в переданном массиве $array['foo'] = '123', то [[foo]] при рендеринге будет заменено на 123.
// Формат (расширение) файла может быть любой - js, html и пр.
function render($file_path, $v = []) {
    global $page, $app, $self;
    if (strpos($file_path, '.') === false) $file_path = trim($file_path) . '.php';
    $file_content = file_get_contents(MC_ROOT . '/templates/' . $file_path);
    // Обработка вставок вида [[name]]
    preg_match_all('/\/?\*?\[\[\s+([\w-_]+)\s+\]\]\*?\/?/i', $file_content, $matches);
    //dd($matches);
    if (!empty($matches[1]))
        foreach ($matches[1] as $num => $name)
            $file_content = str_replace($matches[0][$num], $v[$name], $file_content);
    return $file_content;
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
    global $page, $app, $self;
    $r = '';
    $all_css; //array will all css for minification    
    
    // Подключение дополнительных стилей для страницы, если они объявлены
    if (count($page['css'])) {
        foreach ($page['css'] as $css) {
            if (substr($css, 0, 4) == 'http') $r .= "<link rel=\"stylesheet\" href=\"$css\">\r\n";
            else {
                $css_path1 = "/assets/css/" . $css;
                $css_path2 = "/vendor/" . $css;
                if (file_exists( MC_ROOT . $css_path1 )) 
                {
                    //$r .= "<link rel=\"stylesheet\" href=\"$css_path1\">\r\n";
                    $all_css[]='/' . $css_path1;
                }
                else if (file_exists( MC_ROOT . $css_path2 )) 
                {
                    //$r .= "<link rel=\"stylesheet\" href=\"$css_path2\">\r\n";
                    $all_css[]='/' . $css_path2;
                }
                
            }
        }
    }
    // Подключение индивидуального стиля с именем, равным имени страницы, если такой существует
    $css_path = "/assets/css/" . substr($self, 0, strlen($self) - 4) . ".css";
    if (file_exists( MC_ROOT . $css_path )) 
    {
        //$r .= '<link rel="stylesheet" href="' . $css_path . '">';
        $all_css[]='/' . $css_path;
    }
        
    $cssUri = Minify_getUri($all_css); // a list of files

    $r .= '<link rel="stylesheet" href="' . $cssUri . '">';
    
    return $r;
}

// Вывод списка подключаемых JS
function js_resources() {
    global $page, $self;
    $r = '';
    $all_js; //array will all js for minification
    // Подключение дополнительных скриптов для страницы, если они объявлены
    if (count($page['js'])) {
        foreach ($page['js'] as $script) {
            if (substr($script, 0, 4) == 'http') $r .= "<script src=\"$script\"></script>\r\n";
            else {
                $script_path1 = "/assets/js/" . $script;
                $script_path2 = "/vendor/" . $script;
                if (file_exists(MC_ROOT . $script_path1)) 
                {
                    //$r .= "<script src=\"$script_path1\"></script>\r\n";
                    $all_js[]='/' . $script_path1;
                }
                else if (file_exists(MC_ROOT . $script_path2)) 
                {
                    //$r .= "<script src=\"$script_path2\"></script>\r\n";
                    $all_js[]='/' . $script_path2;
                }
            }
        }
    }
    // Подключение индивидуального скрипта с именем, равным имени страницы, если такой существует
    $script_path = "/assets/js/" . substr($self, 0, strlen($self) - 4) . ".js";
    if (file_exists( MC_ROOT . $script_path )) 
    {
        $r .= "<script src=\"$script_path\"></script>\r\n";
        $all_js[]='/' . $script_path;
    }
    // js, не подключаемый из файла, а генерируемый "на лету"
    if (!empty($page['js_raw'])) {
        $r .= '<script type="text/javascript">' . "\r\n";
        $r .= $page['js_raw'];
        $r .= "</script>\r\n";
    }
    
    $jsUri = Minify_getUri($all_js); // a list of files
    $r .= '<script type="text/javascript" src="' . $jsUri . '"></script>\r\n';
    
    return $r;
}