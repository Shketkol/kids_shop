-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1
-- Время создания: Янв 28 2016 г., 15:48
-- Версия сервера: 5.6.21
-- Версия PHP: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `shop`
--

create database `shop`;

-- --------------------------------------------------------

--
-- Структура таблицы `coment_tovar`
--

CREATE TABLE IF NOT EXISTS `coment_tovar` (
  `id` int(11) NOT NULL,
  `name` varchar(45) NOT NULL,
  `text` text,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `name_tovar` varchar(45) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `coment_tovar`
--

INSERT INTO `coment_tovar` (`id`, `name`, `text`, `time`, `name_tovar`) VALUES
  (1, '12', 'gare', '2016-01-23 16:13:36', 'Italy Quam'),
  (2, 'qq', 'wwee', '2016-01-23 16:13:20', 'Etiam Tristique'),
  (3, '13', '33', '2016-01-23 15:18:40', 'Italy Quam');

-- --------------------------------------------------------

--
-- Структура таблицы `orders`
--

CREATE TABLE IF NOT EXISTS `orders` (
  `id` int(11) NOT NULL,
  `id_orders` int(11) NOT NULL,
  `id_tovar` int(11) NOT NULL,
  `count` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `orders`
--

INSERT INTO `orders` (`id`, `id_orders`, `id_tovar`, `count`) VALUES
  (1, 12, 0, 0),
  (2, 20, 1, 0),
  (3, 21, 1, 0),
  (4, 22, 1, 0),
  (5, 22, 2, 0),
  (6, 23, 1, 0),
  (7, 23, 2, 0),
  (8, 24, 1, 0),
  (9, 24, 2, 0),
  (10, 25, 1, 0),
  (11, 25, 2, 0),
  (12, 25, 6, 0),
  (13, 26, 1, 0),
  (14, 26, 2, 0),
  (15, 26, 6, 0),
  (16, 27, 1, 0),
  (17, 28, 1, 0),
  (18, 29, 1, 0),
  (19, 30, 1, 0),
  (20, 30, 4, 0),
  (21, 31, 2, 0),
  (22, 31, 3, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `order_id`
--

CREATE TABLE IF NOT EXISTS `order_id` (
  `id_order` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `delivery` varchar(45) DEFAULT NULL,
  `status` varchar(45) DEFAULT NULL,
  `price` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `order_id`
--

INSERT INTO `order_id` (`id_order`, `id_user`, `time`, `delivery`, `status`, `price`) VALUES
  (1, 6, '2016-01-31 09:43:44', NULL, NULL, 0),
  (2, 6, '2016-01-31 09:44:54', NULL, NULL, 0),
  (3, 3, '2016-01-31 09:45:52', NULL, NULL, 0),
  (4, 3, '2016-01-31 09:56:33', NULL, NULL, 0),
  (5, 3, '2016-01-31 09:58:35', NULL, NULL, 0),
  (6, 3, '2016-01-31 09:58:49', NULL, NULL, 0),
  (7, 3, '2016-01-31 09:59:16', NULL, NULL, 0),
  (8, 3, '2016-01-31 10:03:37', NULL, NULL, 0),
  (9, 3, '2016-01-31 10:03:43', NULL, NULL, 0),
  (10, 3, '2016-01-31 10:17:01', NULL, NULL, 0),
  (11, 3, '2016-01-31 10:17:21', NULL, NULL, 0),
  (12, 3, '2016-01-31 10:37:34', NULL, NULL, 0),
  (13, 3, '2016-01-31 10:42:55', NULL, NULL, 0),
  (14, 3, '2016-01-31 10:43:24', NULL, NULL, 0),
  (15, 3, '2016-01-31 10:46:35', NULL, NULL, 0),
  (16, 3, '2016-01-31 10:47:41', NULL, NULL, 0),
  (17, 3, '2016-01-31 10:48:26', NULL, NULL, 0),
  (18, 3, '2016-01-31 10:48:40', NULL, NULL, 0),
  (19, 3, '2016-01-31 10:49:05', NULL, NULL, 0),
  (20, 3, '2016-01-31 10:50:42', NULL, NULL, 0),
  (21, 3, '2016-01-31 10:52:12', NULL, NULL, 0),
  (22, 3, '2016-01-31 10:54:00', NULL, NULL, 0),
  (23, 3, '2016-01-31 10:56:08', NULL, NULL, 0),
  (24, 3, '2016-01-31 10:56:33', NULL, NULL, 0),
  (25, 6, '2016-01-31 11:14:43', NULL, NULL, 0),
  (26, 6, '2016-01-31 11:32:45', NULL, NULL, 0),
  (27, 6, '2016-01-31 11:33:14', NULL, NULL, 0),
  (28, 6, '2016-01-31 11:33:23', NULL, NULL, 0),
  (29, 6, '2016-01-31 11:34:54', NULL, NULL, 0),
  (30, 5, '2016-02-01 15:56:01', NULL, NULL, 168),
  (31, 5, '2016-02-01 16:56:28', NULL, NULL, 576);

-- --------------------------------------------------------

--
-- Структура таблицы `tovary`
--

CREATE TABLE IF NOT EXISTS `tovary` (
  `id` int(11) NOT NULL,
  `article` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `price` int(11) DEFAULT NULL,
  `url_img` varchar(200) DEFAULT NULL,
  `sklad` int(1) DEFAULT NULL,
  `brend` varchar(100) DEFAULT NULL,
  `other` varchar(100) DEFAULT NULL,
  `time` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `tovary`
--

INSERT INTO `tovary` (`id`, `article`, `name`, `description`, `price`, `url_img`, `sklad`, `brend`, `other`, `time`) VALUES
  (1, 165165, 'Italy Quam', 'iPhone is a revolutionary new mobile phone that allows you to make a call by simply tapping a name or number in your address book, a favorites list, or a call log. It also automatically syncs all your contacts from a PC, Mac, or Internet service. And it lets you select and listen to voicemail messages in whatever order you want just like email.', 122, '/webroot/img/toy/1.jpg', 1, 'er23', 'toy', '0000-00-00 00:00:00'),
  (2, 0, 'Etiam Tristique', 'HTC Touch - in High Definition. Watch music videos and streaming content in awe-inspiring high definition clarity for a mobile experience you never thought possible. Seductively sleek, the HTC Touch HD provides the next generation of mobile functionality, all at a simple touch. Fully integrated with Windows Mobile Professional 6.1, ultrafast 3.5G, GPS, 5MP camera, plus lots more - all delivered on a breathtakingly crisp 3.8" WVGA touchscreen - you can take control of your mobile world with the HTC Touch HD.', 120, '/webroot/img/toy/2.jpg', 1, 'ewfe', 'toy', '0000-00-00 00:00:00'),
  (3, 0, 'Sed At Ante', '', 152, '/webroot/img/toy/3.jpg', 1, 'wef', 'toy', NULL),
  (4, 0, 'Kids Toy', '', 46, '/webroot/img/toy/4.jpg', 1, 'wf', 'toy', NULL),
  (5, 0, 'Baby Chair', '', 120, '/webroot/img/toy/5.jpg', 1, 'wfwef', 'toy', NULL),
  (6, 0, 'Consectetur Adipiscing', '', 145, '/webroot/img/toy/6.jpg', 1, 'wf', 'toy', NULL),
  (7, 0, 'Feminine Designs', '', 168, '/webroot/img/toy/7.jpg', NULL, 'wf', 'toy', NULL),
  (8, 0, 'Платье', '', 185, '/webroot/img/cloth/girl/1.jpg', NULL, 'wef', 'cloth', '0000-00-00 00:00:00'),
  (9, 0, 'Платье', '', 123, '/webroot/img/cloth/girl/2.jpg', NULL, NULL, NULL, NULL),
  (10, 0, 'Платье', '', 198, '/webroot/img/cloth/girl/3.jpg', NULL, NULL, NULL, NULL),
  (11, 0, 'Свитер', '', 212, '/webroot/img/cloth/boy/1.jpg', NULL, NULL, NULL, NULL),
  (12, 0, 'Свитер', '', 13, '/webroot/img/cloth/boy/2.jpg', NULL, NULL, NULL, NULL),
  (13, 0, 'Свитер', '', 819, '/webroot/img/cloth/boy/3.jpg', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(100) unsigned NOT NULL,
  `name` varchar(45) NOT NULL,
  `l_name` varchar(45) NOT NULL,
  `mail` varchar(45) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `region` varchar(100) DEFAULT NULL,
  `region1` varchar(200) DEFAULT NULL,
  `town` varchar(200) DEFAULT NULL,
  `street` varchar(200) DEFAULT NULL,
  `house` varchar(100) DEFAULT NULL,
  `flat` varchar(100) DEFAULT NULL,
  `password` varchar(200) NOT NULL,
  `role` varchar(50) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `name`, `l_name`, `mail`, `phone`, `region`, `region1`, `town`, `street`, `house`, `flat`, `password`, `role`) VALUES
  (3, '12', '12', '', '12', '', '', '', '', '', '', '796585c521dc08bd138d136edef21f08', ''),
  (5, 'admin', 'admin', '', '', '', '', '', '', '', '', '44ca5fa5c67e434b9e779c5febc46f06', 'admin'),
  (6, 'Николай', 'Шкит', 'shketkol@gmail.com', '0963305184', 'Киевская', '', 'Киев', 'Ялтинская', '9а', '84', '796585c521dc08bd138d136edef21f08', 'user');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `coment_tovar`
--
ALTER TABLE `coment_tovar`
ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `orders`
--
ALTER TABLE `orders`
ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `order_id`
--
ALTER TABLE `order_id`
ADD PRIMARY KEY (`id_order`);

--
-- Индексы таблицы `tovary`
--
ALTER TABLE `tovary`
ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `coment_tovar`
--
ALTER TABLE `coment_tovar`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT для таблицы `orders`
--
ALTER TABLE `orders`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT для таблицы `order_id`
--
ALTER TABLE `order_id`
MODIFY `id_order` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=32;
--
-- AUTO_INCREMENT для таблицы `tovary`
--
ALTER TABLE `tovary`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
MODIFY `id` int(100) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
