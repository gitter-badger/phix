<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title><?= $page['title'] . ' | ' . $app['name'] ?></title>

<?php
// Подключение дополнительных скриптов для страницы, если они объявлены
if (count($page['css'])) {
    foreach ($page['css'] as $css) {
        if (substr($css, 0, 4) == 'http') echo "<link rel=\"stylesheet\" href=\"$css\">\r\n";
        else {
            $css_path1 = "/assets/css/" . $css;
            $css_path2 = "/vendor/" . $css;
            if (file_exists( MC_ROOT . $css_path1 )) echo "<link rel=\"stylesheet\" href=\"$css_path1\">\r\n";
            else if (file_exists( MC_ROOT . $css_path2 )) echo "<link rel=\"stylesheet\" href=\"$css_path2\">\r\n";
        }
    }
}

// Подключение индивидуального скрипта с именем, равным имени страницы, если такой существует
$css_path = "/assets/css/" . substr($self, 0, strlen($self) - 4) . ".css";
if (file_exists( MC_ROOT . $css_path )) echo '<link rel="stylesheet" href="' . $css_path . '">';

?>

<!-- HTML5 shim and Respond.css for IE8 support of HTML5 elements and media queries -->
<!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.css"></script>
<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.css"></script>
<![endif]-->

<!-- Fav and touch icons -->
<link rel="shortcut icon" href="/favicon.ico">