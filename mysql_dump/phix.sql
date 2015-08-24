-- phpMyAdmin SQL Dump
-- version 4.0.10.6
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1:3306
-- Время создания: Авг 25 2015 г., 02:43
-- Версия сервера: 5.6.22-log
-- Версия PHP: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `phix`
--

-- --------------------------------------------------------

--
-- Структура таблицы `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'первичный ключ',
  `user_id` int(11) NOT NULL COMMENT 'автор комментария (id в таблице users)',
  `value` text NOT NULL COMMENT 'содержание комментария',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'время создания записи',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `log`
--

CREATE TABLE IF NOT EXISTS `log` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'первичный ключ',
  `type` varchar(10) NOT NULL COMMENT 'тип события',
  `self` varchar(100) NOT NULL COMMENT 'текущий url',
  `value` text NOT NULL COMMENT 'сообщение лога',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'время создания записи',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=15 ;

--
-- Дамп данных таблицы `log`
--

INSERT INTO `log` (`id`, `type`, `self`, `value`, `created_at`) VALUES
(1, 'API', 'api.php', '\r\n    [error] => 1\n    [error_msg] => Ошибка! Входной формат данных не является массивом JSON\n', '2015-08-22 22:07:20'),
(2, 'API', 'api.php', '\r\n    [error] => 1\n    [error_msg] => Ошибка! Входной формат данных не является массивом JSON\n', '2015-08-22 22:09:48'),
(3, 'API', 'api.php', '\r\n    [error] => 1\n    [error_msg] => Ошибка! Входной формат данных не является массивом JSON\n', '2015-08-22 22:10:06'),
(4, 'API', 'api.php', '\r\n    [error] => 1\n    [error_msg] => Ошибка! Входной формат данных не является массивом JSON\n', '2015-08-23 11:04:09'),
(5, 'mysql', '', 'SELECT *, DATE_FORMAT(`created_at`, ''%D.%m.%y в %H:%m:%s'') AS `time` FROM `log`WHERE `type` = `API`ORDER BY `created_at` DESC\nUnknown column ''API'' in ''where clause''', '2015-08-23 11:35:51'),
(6, 'mysql', '', 'SELECT *, DATE_FORMAT(`created_at`, ''%D.%m.%y в %H:%m:%s'') AS `time` FROM `log`WHERE `type` = `API`ORDER BY `created_at` DESC\r\nUnknown column ''API'' in ''where clause''', '2015-08-23 11:36:26'),
(7, 'mysql', '', 'SELECT *, DATE_FORMAT(`created_at`, ''%D.%m.%y в %H:%m:%s'') AS `time` FROM `log`WHERE `type` = `API`ORDER BY `created_at` DESC\r\nUnknown column ''API'' in ''where clause''', '2015-08-23 11:36:38'),
(8, 'mysql', '', 'SELECT * FROM `lim_pictures` WHERE `picture_type`=''user_avatars'' AND `picture_field`=''avatar'' AND `picture_element`='''' AND `picture_width`>0 ORDER BY `picture_tst` DESC\r\nTable ''phix.lim_pictures'' doesn''t exist', '2015-08-24 23:07:02'),
(9, 'mysql', '', 'INSERT INTO `users` SET `name`=''Тестов Тест Тестович'', `vk_id`='''', `address`=''Респ Марий Эл, г Йошкар-Ола, ул Краснофлотская'', `avatar`=''''\nUnknown column ''avatar'' in ''field list''', '2015-08-24 23:08:19'),
(10, 'mysql', '', 'SELECT * FROM `lim_pictures` WHERE `picture_type`=''user_avatars'' AND `picture_field`=''avatar'' AND `picture_element`='''' AND `picture_width`>0 ORDER BY `picture_tst` DESC\r\nTable ''phix.lim_pictures'' doesn''t exist', '2015-08-24 23:08:19'),
(11, 'mysql', '', 'SELECT * FROM `lim_pictures` WHERE `picture_type`=''user_avatars'' AND `picture_field`=''avatar'' AND `picture_element`='''' AND `picture_width`>0 ORDER BY `picture_tst` DESC\nTable ''phix.lim_pictures'' doesn''t exist', '2015-08-24 23:08:44'),
(12, 'EDITOR', 'crud.php', 'Не заполнено обязательное поле: Имя', '2015-08-24 23:08:47'),
(13, 'mysql', '', 'SELECT * FROM `lim_pictures` WHERE `picture_type`=''user_avatars'' AND `picture_field`=''avatar'' AND `picture_element`='''' AND `picture_width`>0 ORDER BY `picture_tst` DESC\r\nTable ''phix.lim_pictures'' doesn''t exist', '2015-08-24 23:08:47'),
(14, 'EDITOR', 'crud.php', 'Не заполнено обязательное поле: Имя', '2015-08-24 23:12:09');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'первичный ключ',
  `name` varchar(100) NOT NULL COMMENT 'имя пользователя',
  `vk_id` int(11) NOT NULL COMMENT 'id вконтакте',
  `address` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'время создания записи',
  `updated_at` timestamp NOT NULL COMMENT 'время последнего обновления записи',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `name`, `vk_id`, `address`, `created_at`, `updated_at`) VALUES
(2, 'Иванов Иван Иванович', 12345, 'Респ Татарстан, г Казань, ул Хади Такташа, д 31', '2015-08-24 23:16:41', '0000-00-00 00:00:00');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
