<?php require_once 'config.php';
/* ----------------------- ПАРАМЕТРЫ СТРАНИЦЫ ----------------------- */
$page['title'] = 'Главная';
$page['desc'] = 'Главная страница сайта';

/* ---------------------- КОНТРОЛЛЕР СТРАНИЦЫ ----------------------- */
$articles = [
    0 => [
        'name' => 'Первая статья',
        'desc' => 'Краткое содержание первой статьи',
    ],
    1 => [
        'name' => 'Вторая статья',
        'desc' => 'Краткое содержание второй статьи',
    ],
    2 => [
        'name' => 'Третья статья',
        'desc' => 'Краткое содержание третьей статьи',
    ],
];

/* -------------------------- ОТОБРАЖЕНИЕ ------------ */ ob_start(); ?>

<h2>Главная страница</h2>
<hr />
<? foreach ($articles as $article) r('articles/widget', $article); ?>


<?php require MC_ROOT . '/scripts/render_view.php';