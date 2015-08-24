<?php

/* ФУНКЦИИ РАБОТЫ С ТЕКСТОВЫМ КОНТЕНТОМ */

// Рендер виджета с передачей массива данных внутрь него
function r($widget_path, $v = false) {
    require "/templates/$widget_path.php";
}

// Вывод дампа переменной и остановка выполнения программы
function dd($variable) {
    die ( nl2br( print_r( $variable, true ) ) );
}