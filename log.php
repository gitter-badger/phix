<?php require_once 'config.php';
/* ----------------------- ПАРАМЕТРЫ СТРАНИЦЫ ----------------------- */
$page['title'] = 'Лог';
$page['desc'] = 'Лог сервера';
$page['css'][] = 'datatables/datatables/media/css/jquery.dataTables.min.css';
$page['js'][] = 'datatables/datatables/media/js/jquery.dataTables.min.js';

/* ---------------------- КОНТРОЛЛЕР СТРАНИЦЫ ----------------------- */

// Запрашиваем записи лога, относящиеся к API
$logs = db_array("SELECT *, "
                ."DATE_FORMAT(`created_at`, '%d.%m.%y в %H:%m:%s') AS `time` "
                ."FROM `log`"
                ."WHERE `type` = 'API'"
                ."ORDER BY `created_at` DESC");

/* -------------------------- ОТОБРАЖЕНИЕ ------------ */ ob_start(); ?>

<h2>Лог запросов к серверу</h2>
<hr />
<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Время</th>
            <th>Значение</th>
        </tr>
    </thead>
    <tbody>
    <?  foreach ($logs as $log) { ?>
        <tr>
            <td><?= $log['id'] ?></td>
            <td><?= $log['time'] ?></td>
            <td><?= nl2br($log['value']) ?></td>
        </tr>

    <?  } ?>
    </tbody>
</table>

<? require MC_ROOT . '/scripts/render_view.php';