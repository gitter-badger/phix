<?php
// Получение пути к базовому каталогу веб-сервера
define('MC_ROOT', dirname(__FILE__));
//cache dir
define('CACHE_DIR', '/tmp/cache');

// Учетные данные для соединения с базой данных MySQL
$db = [
    'username'  => 'phix_user',
    'password'  => '12041961',
    'host'      => 'localhost',
    'base'      => 'phix',
];

$app = [
    /* Название приложения и секретный случайный ключ (используется в модуле безопасности f_secure.php) */
    'name'          => 'Phix',
    'key'           => '538t5jht8054jht8054jh',
    /* Время жизни токена в минутах (с момента генерации, т.е. вывода формы),
       не рекомендуется более 60, т.к. будет тормозить процедуру валидации токена */
    'token_lifetime'=> 5,
    /* Режим работы приложения (индикация ошибок, активация сервисных функций и пр.): 'debug' или 'production' */
    'mode'          => 'production',
    /* Ключ для работы с API всплывающих подсказок Dadata */
    'dadata_api_key'=> '154fa715902b207f0c64b376646db03631fa273e',
    'os_windows'    => true, //false on real server
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
    'js_raw' => '', /* в этой переменной хранится "сырой" js, не подключаемый из файла, а генерируемый "на лету" */
];

// Подключение к БД и основных функций для работы с ней
require_once(MC_ROOT . '/scripts/f_mysql.php');
// Фиксация и фильтрация входных данных
require_once(MC_ROOT . '/scripts/request.php');
// js & css minifiers
//require_once(MC_ROOT . '/vendor/tubalmartin/cssmin/cssmin.php');
//require_once(MC_ROOT . '/scripts/minifiers/js.php');
require_once '/vendor/matthiasmullie/minify/src/Minify.php';
require_once '/vendor/matthiasmullie/minify/src/CSS.php';
require_once '/vendor/matthiasmullie/minify/src/JS.php';
require_once '/vendor/matthiasmullie/minify/src/Exception.php';
require_once '/vendor/matthiasmullie/path-converter/src/Converter.php';
// Функции для управления подключаемыми стилями и скриптами
require_once(MC_ROOT . '/scripts/assets_cache.php');
// Функции для работы с текстовым контентом
require_once(MC_ROOT . '/scripts/f_content.php');
// Функции защиты и шифрования
require_once(MC_ROOT . '/scripts/f_secure.php');
// Короткие алиасы функций
require_once(MC_ROOT . '/scripts/aliases.php');
