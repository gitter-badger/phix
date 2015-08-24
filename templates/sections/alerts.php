<?php

/* ИНФОРМАЦИОННЫЕ УВЕДОМЛЕНИЯ В ВЕРХНЕЙ ЧАСТИ СТРАНИЦЫ */

if (!empty($page['success_msg'])) e('bootstrap3/alert', ['class' => 'success', 'msg' => $page['success_msg']]);
if (!empty($page['error_msg'])) e('bootstrap3/alert', ['class' => 'danger', 'msg' => $page['error_msg']]);