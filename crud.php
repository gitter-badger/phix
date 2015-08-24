<?php require_once 'config.php';
/* ----------------------- ПАРАМЕТРЫ СТРАНИЦЫ ----------------------- */
$page['title'] = 'Список клиентов';
$page['desc'] = 'Редактирование данных в табличной форме (CRUD)';
resource([
    'datatables/datatables/media/css/jquery.dataTables.min.css',
    'datatables/datatables/media/js/jquery.dataTables.min.js',
]);

/* ---------------------- КОНТРОЛЛЕР СТРАНИЦЫ ----------------------- */

// Склонение названия элемента редактирования
$messages = Array(
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
);
// Редактируемая таблица
$table = 'users';
// Идентификатор строки
$row_id = 'id';
// Поля для редактирования
$fields = [
    'name' => [
        'desc' => 'Имя',
        'type' => 'text',
        'required' => true
    ],
    'vk_id' => [
        'desc' => 'id Вконтакте',
        'type' => 'text',
    ],
    'address' => [
        'desc' => 'Адрес',
        'type' => 'text',
        'dadata' => [
            'type' => 'ADDRESS',
            'yandex_map' => true
        ]
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
        'access_edit' => []
    ],
];

// Настройки колонок таблицы
$table_list_fields = [
    'id' => ['desc' => '#id'],
    'name' => ['desc' => 'Имя'],
    'vk_id' => [
        'desc' => 'Имя',
        'value' => '<a href="http://vk.com/id{{vk_id}}">{{vk_id}}</a>',
    ],
    'create_at' => ['desc' => 'Дата регистрации'],
];

// Запрос списка элементов
$list_request = "SELECT * FROM `users`";

// Скрыть кнопки редактирования
//$hide_edit = true;

// Сортировка по колонке
$sort_column = 1;

// Количество на странице
$display_length = 5;

/* ---------------------- КОНТРОЛЛЕР СТРАНИЦЫ ----------------------- */

require MC_ROOT . '/scripts/crud_editor/core.php';

/* -------------------------- ОТОБРАЖЕНИЕ ------------ */ ob_start();

require MC_ROOT . '/templates/crud_editor/base_view.php';

require MC_ROOT . '/scripts/render_view.php';