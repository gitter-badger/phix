<?php require_once 'config.php';
/* ----------------------- ПАРАМЕТРЫ СТРАНИЦЫ ----------------------- */
$page['title'] = 'Список клиентов';
$page['desc'] = 'Редактирование данных в табличной форме (CRUD)';
resource([
    'datatables/datatables/media/css/jquery.dataTables.min.css',
    'datatables/datatables/media/js/jquery.dataTables.min.js',
]);

// Настройки CRUD редактора на этой странице
$page['crud_editor'] = [
    /*Склонение названия элемента редактирования*/
    'messages' => [
        'elements_list' => 		'Список клиентов',
        'delete_success' => 	'Клиент успешно удален',
        'delete_error' => 		'Ошибка при удалении клиента',
        'create_success' => 	'Клиент успешно создан',
        'save_success' => 		'Информация о клиенте успешно отредактирована',
        'create_error' => 		'Ошибка при создании клиента',
        'save_error' => 		'Ошибка при сохранении данных клиента',
        'edit_element' => 		'Редактирование клиента',
        'create_element' => 	'Добавление нового клиента',
        'new_element' => 		'Добавить клиента'
    ],
    /*Редактируемая таблица*/
    'table' => 'users',
    /*Столбец с первичным ключом таблицы (по умолчанию - 'id')*/
    'primary_key' => 'id',

    /*Поля для редактирования и их настройки*/
    'fields' => [
        'name' => [
            'desc' => 'Имя',
            'type' => 'text',
            'dadata' => ['type' => 'NAME'],
            'required' => true,
        ],
        'address' => [
            'desc' => 'Адрес',
            'type' => 'text',
            'dadata' => [
                'type' => 'ADDRESS',
                'yandex_map' => true,
            ]
        ],
        'company' => [
            'desc' => 'Организация',
            'type' => 'text',
            'dadata' => ['type' => 'PARTY']
        ],
        'bank' => [
            'desc' => 'Банк',
            'type' => 'text',
            'dadata' => ['type' => 'BANK']
        ],
        'email' => [
            'desc' => 'Адрес электронной почты',
            'type' => 'text',
            'dadata' => ['type' => 'EMAIL']
        ],

        /*    'avatar' => Array( 'desc' => 'Фотография',
                'tag' => 'picture',
                'type' => 'text',
                'picture_type' => 'user_avatars',
                'picture_proportions' => 'false'
            ),*/
        'create_at' => [
            'desc' => 'Дата регистрации',
            'type' => 'timestamp',
            'access_edit' => [],
        ],
    ],

    /*Столбцы для вывода в таблицу и их настройки*/
    'table_list_fields' => [
        'id' => ['desc' => '#id'],
        'name' => ['desc' => 'Имя'],
        'address' => ['desc' => 'Адрес'],
        'company' => ['desc' => 'Организация'],
        'bank' => ['desc' => 'Банк'],
        'email' => ['desc' => 'Электронная почта'],
    ],

    /*Запрос списка элементов*/
    'list_request' => "SELECT * FROM `users`",

    /*Скрыть кнопки редактирования*/
    'hide_edit' => false,

    /*Сортировка по колонке №*/
    'sort_column' => 1,
    'sort_order' => 'asc',

    /*Количество на странице*/
    'display_length' => 5,

];


/* ---------------------- КОНТРОЛЛЕР СТРАНИЦЫ ----------------------- */

require MC_ROOT . '/scripts/crud_editor/core.php';

/* -------------------------- ОТОБРАЖЕНИЕ ------------ */ ob_start(); ?>

<h2><?= $page['title'] ?></h2>
<hr />

<div class="row">
    <div class="col-xs-12 mtop-20">
        <? require MC_ROOT . "/templates/{$page['view']}.php"; ?>
    </div><!-- /.col -->
</div><!-- /.row -->
<?
require MC_ROOT . '/scripts/render_view.php';