<?php
// Получение пути к базовому каталогу веб-сервера
define('MC_ROOT', dirname(__FILE__));

// Учетные данные для соединения с базой данных MySQL
$db = [
    'username'  => 'phix_user',
    'password'  => '12041961',
    'host'      => 'localhost',
    'base'      => 'phix',
];

// Название приложения и секретный случайный ключ (используется в модуле безопасности f_secure.php)
$app = [
    'name'          => 'Phix',
    'key'           => '538t5jht8054jht8054jh',
    /* Время жизни токена в минутах (с момента генерации, т.е. вывода формы),
       не рекомендуется более 60, т.к. будет тормозить процедуру валидации токена */
    'token_lifetime'=> 5,
];

// Дефолтные настройки страницы
$page = [
    /* Шаблон страницы по-умолчанию */
    'template'  => 'layout',

    /* CSS - стили по-умолчанию */
    'css'  => [
        'twbs/bootstrap/dist/css/bootstrap.min.css',
        'twbs/bootstrap/dist/css/bootstrap-theme.min.css',
        'components/font-awesome/css/font-awesome.min.css',
        'http://fonts.googleapis.com/css?family=Open+Sans',
        'main.css',
    ],

    /* JS - скрипты по-умолчанию */
    'js'  => [
        'components/jquery/jquery.min.js',
        'twbs/bootstrap/dist/js/bootstrap.min.js',
    ],
];

// Подключение к БД и основных функций для работы с ней
require_once(MC_ROOT . '/scripts/f_mysql.php');
// Фиксация и фильтрация входных данных
require_once(MC_ROOT . '/scripts/request.php');
// Функции для работы с текстовым контентом
require_once(MC_ROOT . '/scripts/f_content.php');
// Функции защиты и шифрования
require_once(MC_ROOT . '/scripts/f_secure.php');