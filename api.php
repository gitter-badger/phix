<?php require_once ('config.php');
require_once(MC_ROOT . '/scripts/f_json.php');

// Чтение входного JSON-потока
$headers = getallheaders();
if ($headers["Content-Type"] != "application/json; charset=utf-8")
    api_exit ('Ошибка! Входной формат данных не является массивом JSON');

$data_in = json_decode(file_get_contents("php://input"), true) ?: [];

// Текстовый дамп массива для занесения в лог
$data_in_txt = print_r($data_in, true);
$data_in_txt = substr ($data_in_txt, 8, strlen($data_in_txt) - 10);

// Массив для вывода результата
$result = Array();

// Функция досрочного завершения с выводом ошибки
function api_exit ($error_txt, $success = false) {
    global $data_in, $result, $data_in_txt;
    if (!empty($error_txt)) {
        $result['error'] = true;
        $result['error_msg'] .= $error_txt;
    }
    // Текстовый дамп выходного массива для занесения в лог
    $data_out_txt = print_r($result, true);
    $data_out_txt = substr ($data_out_txt, 8, strlen($data_out_txt) - 10);
    // Заносим входные и выходные данные в лог
    f_log("$data_in_txt\r\n$data_out_txt", 'API');
    echo json_encode_cyr($result);
    exit();
}

// Функция проверки обязательных параметров
function required_parameters_check ($parameters_required) {
    global $data_in, $result;
    // Проверка наличия обязательных параметров
    $required_error_parameters = Array();
    if (!empty($parameters_required) || count($parameters_required)) {
        foreach ($parameters_required as $parameter_name) {
            // Если параметр не пришел - заносим в массив его как ошибочный
            if (empty( $data_in[$parameter_name] )) $required_error_parameters[] = $parameter_name;
        }
        if (!empty($required_error_parameters)) api_exit ('Отсутствуют обязательные параметры: ' . implode (', ', $required_error_parameters) );
    }
}

// Проверка, запрошен какой-либо метод API
if (empty( $data_in['method'] )) api_exit ('Необходимо указать метод API');

// Выполнение методов API
switch ( $data_in['method'] ) {

    case 'search_next_task':
        //required_parameters_check (Array('account'));
        $result = search_next_task ();
        break;

    default:
        api_exit ('Неизвестный метод API');
}

// Сценарий успешного завершения в случае отсутствия ошибок
api_exit ('', true);