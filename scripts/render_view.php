<?php

/* ВЫВОД ПРЕДСТАВЛЕНИЯ СТРАНИЦЫ */

$content = ob_get_contents(); // Получаем содержимое буфера вывода в переменную
ob_end_clean(); //сбрасываем и выключаем буфер
//header("Content-Type: text/html; charset=UTF-8");

// Рендеринг шаблона страницы
r( $page['template'], $content );
mysql_close();