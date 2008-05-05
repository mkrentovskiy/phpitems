-- phpMyAdmin SQL Dump
-- version 2.10.1
-- http://www.phpmyadmin.net
-- 
-- Хост: localhost
-- Время создания: Окт 04 2007 г., 18:32
-- Версия сервера: 5.0.26
-- Версия PHP: 5.2.0

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

-- 
-- База данных: `webshop`
-- 

-- --------------------------------------------------------

-- 
-- Структура таблицы `categories`
-- 

DROP TABLE IF EXISTS `categories`;
CREATE TABLE `categories` (
  `id_categories` int(8) NOT NULL auto_increment,
  `title` char(128) collate utf8_unicode_ci default NULL,
  `pos` int(8) default NULL,
  `enable` tinyint(1) default NULL,
  `i_base` int(8) default NULL,
  KEY `id_categories` (`id_categories`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

-- 
-- Дамп данных таблицы `categories`
-- 

INSERT INTO `categories` (`id_categories`, `title`, `pos`, `enable`, `i_base`) VALUES 
(1, 'Категория', 1, 1, 0),
(2, 'Субкатегория', 2, 1, 1);

-- --------------------------------------------------------

-- 
-- Структура таблицы `cat_areas`
-- 

DROP TABLE IF EXISTS `cat_areas`;
CREATE TABLE `cat_areas` (
  `id_area` tinyint(3) unsigned NOT NULL auto_increment,
  `area` char(64) collate utf8_unicode_ci default NULL,
  `pos` tinyint(3) unsigned default NULL,
  UNIQUE KEY `id_areas` (`id_area`),
  KEY `id_areas_2` (`id_area`),
  KEY `pos` (`pos`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

-- 
-- Дамп данных таблицы `cat_areas`
-- 

INSERT INTO `cat_areas` (`id_area`, `area`, `pos`) VALUES 
(1, 'Общее', 1),
(2, 'Продукция', 2),
(3, 'Заказы', 3),
(4, 'Пользователи и группы', 4);

-- --------------------------------------------------------

-- 
-- Структура таблицы `cat_domains`
-- 

DROP TABLE IF EXISTS `cat_domains`;
CREATE TABLE `cat_domains` (
  `id_domains` int(6) unsigned NOT NULL auto_increment,
  `name` varchar(64) collate utf8_unicode_ci default NULL,
  `title` varchar(128) collate utf8_unicode_ci default NULL,
  `comment` text collate utf8_unicode_ci,
  `object` varchar(128) collate utf8_unicode_ci default NULL,
  `r_table` varchar(128) collate utf8_unicode_ci default NULL,
  `is_key` tinyint(1) unsigned default '0',
  `is_on_list` tinyint(1) unsigned default '0',
  `is_on_select` tinyint(1) unsigned default '0',
  `is_parsed` tinyint(1) unsigned default '0',
  `in_table` varchar(128) collate utf8_unicode_ci default NULL,
  `addin` text collate utf8_unicode_ci,
  `pos` tinyint(3) unsigned default NULL,
  `param` varchar(64) collate utf8_unicode_ci default NULL,
  UNIQUE KEY `id_domains` (`id_domains`),
  KEY `id_domains_2` (`id_domains`),
  KEY `pos` (`pos`,`name`,`in_table`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=81 ;

-- 
-- Дамп данных таблицы `cat_domains`
-- 

INSERT INTO `cat_domains` (`id_domains`, `name`, `title`, `comment`, `object`, `r_table`, `is_key`, `is_on_list`, `is_on_select`, `is_parsed`, `in_table`, `addin`, `pos`, `param`) VALUES 
(1, 'id_static', '', '', 'DomKey', '', 1, 0, 0, 0, 'static', '', 0, '8'),
(2, 'id_documents', '', '', 'DomKey', '', 1, 0, 0, 0, 'documents', '', 0, '8'),
(3, 'id', 'Индентификатор', '', 'DomTitle', '', 0, 1, 1, 0, 'documents', '', 1, '32'),
(4, 'title', 'Заголовок', '', 'DomTitle', '', 0, 1, 0, 0, 'documents', '', 2, '127'),
(5, 'info', 'Информация', '', 'DomVRichText', '', 0, 0, 0, 0, 'documents', '', 3, ''),
(6, 'id_r_user', '', '', 'DomKey', '', 1, 0, 0, 0, 'r_user', '', 0, '8'),
(7, 'login', 'Логин', '', 'DomTitle', '', 0, 1, 1, 0, 'r_user', '', 5, '16'),
(8, 'passwd', 'Пароль', '', 'DomTitle', '', 0, 0, 0, 0, 'r_user', '', 6, '16'),
(55, 'price', 'Цена для пользователя', '', 'DomSSet', '', 0, 1, 0, 0, 'r_user', 'c=Розничная;d=Дилерская', 17, '1'),
(10, 'mail', 'E-mail', '', 'DomTitle', '', 0, 1, 0, 0, 'r_user', '', 3, '128'),
(11, 'name', 'Имя пользователя', '', 'DomTitle', '', 0, 1, 0, 0, 'r_user', '', 1, '255'),
(12, 'enable', 'Разрешен доступ', '', 'DomBool', '', 0, 0, 0, 0, 'r_user', '', 12, ''),
(13, 'usecases', 'Преценденты', '', 'DomSetKey', 'r_usecase', 0, 1, 0, 0, 'r_group', '', 3, ''),
(14, 'title', 'Описание', '', 'DomTitle', '', 0, 1, 1, 0, 'r_group', '', 2, '128'),
(15, 'id_r_group', '', '', 'DomKey', '', 1, 0, 0, 0, 'r_group', '', 0, '8'),
(16, 'enable', 'Группа разрешена', '', 'DomBool', '', 0, 1, 0, 0, 'r_group', '', 4, ''),
(17, 'in_group', 'Группа', '', 'DomParKey', 'r_group', 0, 1, 0, 0, 'r_user', '', 14, '8'),
(18, 'name', 'Имя', '', 'DomTitle', '', 0, 1, 0, 0, 'r_group', '', 1, '32'),
(19, 'name', 'Название', '', 'DomTitle', '', 0, 1, 0, 0, 'r_usecase', '', 1, '128'),
(20, 'id_r_usecase', '', '', 'DomKey', '', 1, 0, 0, 0, 'r_usecase', '', 0, '8'),
(21, 'tmark', 'Время регистрации', '', 'DomCalendar', '', 0, 0, 0, 0, 'r_user', '', 15, ''),
(22, 'ip', 'IP-адрес регистрирующего', '', 'DomTitle', '', 0, 0, 0, 0, 'r_user', '', 16, '16'),
(23, 'phone', 'Телефон', '', 'DomTitle', '', 0, 1, 0, 0, 'r_user', '', 4, '64'),
(24, 'title', 'Описание', '', 'DomTitle', '', 0, 1, 1, 0, 'r_usecase', '', 2, '255'),
(25, 'id_categories', '', '', 'DomKey', '', 1, 0, 0, 0, 'categories', '', 0, '8'),
(26, 'title', 'Название', '', 'DomTitle', '', 0, 1, 1, 0, 'categories', '', 1, '128'),
(27, 'pos', 'Позиция', '', 'DomPosition', '', 0, 0, 0, 0, 'categories', '', 2, '8'),
(28, 'enable', 'Разрешить к показу', '', 'DomBool', '', 0, 0, 0, 0, 'categories', '', 3, ''),
(29, 'id_headline', '', '', 'DomKey', '', 1, 0, 0, 0, 'headline', '', 0, '8'),
(30, 'tmark', 'Время добавления', '', 'DomCalendar', '', 0, 1, 0, 0, 'headline', '', 1, ''),
(31, 'title', 'Название', '', 'DomTitle', '', 0, 1, 1, 0, 'headline', '', 2, '128'),
(32, 'info', 'Информация', '', 'DomSText', '', 0, 0, 0, 0, 'headline', '', 3, ''),
(33, 'comment', 'Комментарий', '', 'DomTitle', '', 0, 0, 0, 0, 'headline', '', 4, '255'),
(34, 'img', 'Фотография', 'с прозрачным задним фоном с тенью, PNG', 'DomImageLink', '', 0, 0, 0, 0, 'headline', '', 5, '128'),
(35, 'link', 'Ссылка', '', 'DomTitle', '', 0, 1, 0, 0, 'headline', '', 6, '255'),
(36, 'id_menu', '', '', 'DomKey', '', 1, 0, 0, 0, 'menu', '', 0, '8'),
(37, 'title', 'Название', '', 'DomTitle', '', 0, 1, 1, 0, 'menu', '', 1, '32'),
(38, 'link', 'Ссылка', '', 'DomTitle', '', 0, 1, 0, 0, 'menu', '', 2, '255'),
(39, 'pos', 'Позиция', '', 'DomPosition', '', 0, 1, 0, 0, 'menu', '', 3, '4'),
(40, 'id_sessions', '', '', 'DomKey', '', 1, 0, 0, 0, 'sessions', '', 0, '8'),
(41, 'sid', 'Сессия', '', 'DomTitle', '', 0, 1, 0, 0, 'sessions', '', 1, '64'),
(42, 'tmark', 'Время авторизации', '', 'DomCalendar', '', 0, 1, 0, 0, 'sessions', '', 2, ''),
(43, 'ip', 'IP-адрес', '', 'DomTitle', '', 0, 1, 0, 0, 'sessions', '', 3, '16'),
(44, 'obj', 'Объект', '', 'DomSText', '', 0, 0, 0, 0, 'sessions', '', 4, ''),
(45, 'id_products', 'Артикул', '', 'DomKey', '', 1, 1, 0, 0, 'products', '', 0, '8'),
(46, 'category', 'Категория', '', 'DomSelfParKey', 'categories', 0, 1, 0, 0, 'products', '', 1, '8'),
(47, 'title', 'Название', '', 'DomTitle', '', 0, 1, 1, 0, 'products', '', 2, '255'),
(48, 'img', 'Фото', '', 'DomPhotoLink', '', 0, 0, 0, 0, 'products', '110:0:200:0', 3, '128'),
(49, 'shortinfo', 'Краткое описание', '', 'DomSText', '', 0, 0, 0, 0, 'products', '', 4, ''),
(50, 'info', 'Подробное описание', '', 'DomVRichText', '', 0, 0, 0, 0, 'products', '', 6, ''),
(51, 'warranty', 'Гарантия', '', 'DomTitle', '', 0, 0, 0, 0, 'products', '', 7, '64'),
(52, 'is_lead', 'Ведущий продукт', 'с самой лучшей ценой', 'DomBool', '', 0, 0, 0, 0, 'products', '', 8, ''),
(53, 'c_price', 'Розничная цена', '', 'DomFloat', '', 0, 0, 0, 0, 'products', '', 10, ''),
(54, 'd_price', 'Дилерская цена', '', 'DomFloat', '', 0, 0, 0, 0, 'products', '', 11, ''),
(56, 'activation_code', 'Код активации', 'для проверки E-mail', 'DomTitle', '', 0, 0, 0, 0, 'r_user', '', 13, '128'),
(57, 'id', 'Идентификатор страницы', '', 'DomNumber', '', 0, 1, 0, 0, 'static', '', 1, '4'),
(58, 'title', 'Название страницы', '', 'DomTitle', '', 0, 1, 1, 0, 'static', '', 2, '255'),
(59, 'info', 'Информация', '', 'DomVRichText', '', 0, 0, 0, 0, 'static', '', 3, ''),
(60, 'i_base', 'Корневой раздел', '', 'DomSelfParKey', 'categories', 0, 0, 0, 0, 'categories', '', 0, '8'),
(61, 'id_requests', '', '', 'DomKey', '', 1, 0, 0, 0, 'requests', '', 0, '8'),
(62, 'id_request_states', '', '', 'DomKey', '', 1, 0, 0, 0, 'request_states', '', 0, '8'),
(63, 'id_request_items', '', '', 'DomKey', '', 1, 0, 0, 0, 'request_items', '', 0, '8'),
(64, 'request', 'Заказ', '', 'DomParKey', 'requests', 0, 1, 0, 0, 'request_items', '', 1, '8'),
(65, 'product', 'Продукт', '', 'DomParKey', 'products', 0, 1, 0, 0, 'request_items', '', 2, '8'),
(66, 'num', 'Количество', '', 'DomNumber', '', 0, 1, 0, 0, 'request_items', '', 3, '8'),
(67, 'price', 'Цена', '', 'DomFloat', '', 0, 1, 0, 0, 'request_items', '', 4, ''),
(68, 'state', 'Состояние', '', 'DomTitle', '', 0, 1, 1, 0, 'request_states', '', 1, '64'),
(69, 'pos', 'Позиция', '', 'DomPosition', '', 0, 1, 0, 0, 'request_states', '', 2, '4'),
(70, 'user', 'Пользователь', '', 'DomParKey', 'r_user', 0, 1, 0, 0, 'requests', '', 1, '8'),
(71, 'tmark', 'Дата поступления заказа', '', 'DomCalendar', '', 0, 1, 1, 0, 'requests', '', 2, ''),
(72, 'ip', 'IP-адрес', '', 'DomTitle', '', 0, 0, 0, 0, 'requests', '', 3, '16'),
(73, 'total', 'Всего', '', 'DomFloat', '', 0, 1, 0, 0, 'requests', '', 4, ''),
(74, 'state', 'Состояние заказа', '', 'DomParKey', 'request_states', 0, 1, 0, 0, 'requests', '', 5, '8'),
(75, 'saled', 'Продано', '', 'DomFloat', '', 0, 1, 0, 0, 'products', '', 12, '8'),
(76, 'title', 'Название', '', 'DomTitle', '', 0, 1, 0, 0, 'request_items', '', 5, '255'),
(78, 'comment', 'Комментарий', '', 'DomSText', '', 0, 1, 0, 0, 'requests', '', 6, ''),
(79, 'pid', 'Артикул', '', 'DomTitle', '', 0, 1, 0, 0, 'request_items', '', 1, '32');

-- --------------------------------------------------------

-- 
-- Структура таблицы `cat_groups`
-- 

DROP TABLE IF EXISTS `cat_groups`;
CREATE TABLE `cat_groups` (
  `ugroup` char(32) collate utf8_unicode_ci NOT NULL default '',
  `mod_table` char(128) collate utf8_unicode_ci NOT NULL default '',
  `is_show` tinyint(1) unsigned default '0',
  `is_edit` tinyint(1) unsigned default '0',
  `is_publish` tinyint(1) unsigned default '0',
  `is_limited` tinyint(1) unsigned default '0',
  KEY `login_2` (`ugroup`),
  KEY `login` (`ugroup`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- 
-- Дамп данных таблицы `cat_groups`
-- 

INSERT INTO `cat_groups` (`ugroup`, `mod_table`, `is_show`, `is_edit`, `is_publish`, `is_limited`) VALUES 
('admin', 'ModFileManager', 1, 1, 0, 0),
('admin', 'ModBackup', 1, 1, 0, 0),
('admin', 'static', 1, 1, 1, 0),
('admin', 'documents', 1, 1, 1, 0),
('admin', 'r_group', 1, 1, 1, 0),
('admin', 'r_user', 1, 1, 1, 0),
('admin', 'r_usecase', 1, 1, 1, 0),
('admin', 'categories', 1, 1, 1, 0),
('admin', 'headline', 1, 1, 1, 0),
('admin', 'menu', 1, 1, 1, 0),
('admin', 'sessions', 1, 1, 1, 0),
('admin', 'products', 1, 1, 1, 0),
('admin', 'requests', 1, 1, 1, 0),
('admin', 'request_states', 1, 1, 1, 0),
('admin', 'request_items', 1, 1, 1, 0),
('admin', 'ModImport', 1, 1, 0, 0);

-- --------------------------------------------------------

-- 
-- Структура таблицы `cat_log`
-- 

DROP TABLE IF EXISTS `cat_log`;
CREATE TABLE `cat_log` (
  `tmark` datetime NOT NULL default '0000-00-00 00:00:00',
  `object` char(32) collate utf8_unicode_ci default NULL,
  `user` char(32) collate utf8_unicode_ci default NULL,
  `event` char(255) collate utf8_unicode_ci default '0',
  `ip` char(16) collate utf8_unicode_ci default NULL,
  KEY `tmark` (`tmark`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- 
-- Дамп данных таблицы `cat_log`
-- 

INSERT INTO `cat_log` (`tmark`, `object`, `user`, `event`, `ip`) VALUES 
('2007-10-03 17:26:36', 'menu', 'admin', 'delete [id_menu=6]', '127.0.0.3'),
('2007-10-03 18:11:18', 'categories', 'admin', 'insert', '127.0.0.3'),
('2007-10-03 18:11:29', 'categories', 'admin', 'insert', '127.0.0.3'),
('2007-10-03 18:16:15', 'headline', 'admin', 'insert', '127.0.0.3'),
('2007-10-03 18:18:27', 'products', 'admin', 'insert', '127.0.0.3'),
('2007-10-03 18:21:25', 'r_user', 'admin', 'insert', '127.0.0.3'),
('2007-10-03 18:22:44', 'static', 'admin', 'insert', '127.0.0.3'),
('2007-10-03 18:24:35', 'documents', 'admin', 'update [id_documents=2]', '127.0.0.3'),
('2007-10-03 18:24:50', 'menu', 'admin', 'update [id_menu=2]', '127.0.0.3'),
('2007-10-04 12:39:32', 'menu', 'admin', 'update [id_menu=1]', '127.0.0.3'),
('2007-10-04 12:39:40', 'menu', 'admin', 'update [id_menu=2]', '127.0.0.3'),
('2007-10-04 12:39:47', 'menu', 'admin', 'update [id_menu=2]', '127.0.0.3'),
('2007-10-04 12:39:55', 'menu', 'admin', 'update [id_menu=3]', '127.0.0.3'),
('2007-10-04 12:40:04', 'menu', 'admin', 'update [id_menu=4]', '127.0.0.3'),
('2007-10-04 12:40:17', 'menu', 'admin', 'update [id_menu=5]', '127.0.0.3'),
('2007-10-04 13:59:18', 'documents', 'admin', 'update [id_documents=2]', '127.0.0.3'),
('2007-10-04 14:03:35', 'documents', 'admin', 'update [id_documents=2]', '127.0.0.3'),
('2007-10-04 14:21:19', 'documents', 'admin', 'update [id_documents=2]', '127.0.0.3'),
('2007-10-04 14:24:06', 'documents', 'admin', 'update [id_documents=2]', '127.0.0.3'),
('2007-10-04 14:26:26', 'documents', 'admin', 'update [id_documents=2]', '127.0.0.3'),
('2007-10-04 14:27:33', 'documents', 'admin', 'update [id_documents=2]', '127.0.0.3'),
('2007-10-04 14:43:54', 'documents', 'admin', 'delete [id_documents=5]', '127.0.0.3'),
('2007-10-04 14:49:49', 'documents', 'admin', 'update [id_documents=6]', '127.0.0.3'),
('2007-10-04 14:53:00', 'documents', 'admin', 'update [id_documents=4]', '127.0.0.3'),
('2007-10-04 14:53:58', 'documents', 'admin', 'update [id_documents=7]', '127.0.0.3'),
('2007-10-04 14:54:20', 'documents', 'admin', 'update [id_documents=8]', '127.0.0.3'),
('2007-10-04 14:54:47', 'documents', 'admin', 'update [id_documents=9]', '127.0.0.3'),
('2007-10-04 14:56:41', 'documents', 'admin', 'update [id_documents=10]', '127.0.0.3'),
('2007-10-04 14:56:59', 'documents', 'admin', 'update [id_documents=11]', '127.0.0.3'),
('2007-10-04 14:58:26', 'documents', 'admin', 'update [id_documents=12]', '127.0.0.3'),
('2007-10-04 14:58:37', 'documents', 'admin', 'update [id_documents=16]', '127.0.0.3'),
('2007-10-04 14:59:16', 'documents', 'admin', 'update [id_documents=15]', '127.0.0.3'),
('2007-10-04 14:59:27', 'documents', 'admin', 'update [id_documents=14]', '127.0.0.3'),
('2007-10-04 15:00:17', 'documents', 'admin', 'update [id_documents=13]', '127.0.0.3'),
('2007-10-04 15:01:20', 'documents', 'admin', 'update [id_documents=12]', '127.0.0.3'),
('2007-10-04 18:03:47', 'requests', 'admin', 'delete [id_requests=1]', '127.0.0.3'),
('2007-10-04 18:03:50', 'requests', 'admin', 'delete [id_requests=2]', '127.0.0.3'),
('2007-10-04 18:03:53', 'requests', 'admin', 'delete [id_requests=3]', '127.0.0.3'),
('2007-10-04 18:04:02', 'request_items', 'admin', 'delete [id_request_items=4]', '127.0.0.3'),
('2007-10-04 18:04:11', 'requests', 'admin', 'delete [id_requests=4]', '127.0.0.3'),
('2007-10-04 18:04:16', 'request_items', 'admin', 'delete [id_request_items=1]', '127.0.0.3'),
('2007-10-04 18:04:21', 'request_items', 'admin', 'delete [id_request_items=2]', '127.0.0.3'),
('2007-10-04 18:04:24', 'request_items', 'admin', 'delete [id_request_items=3]', '127.0.0.3'),
('2007-10-04 18:06:03', 'products', 'admin', 'update [id_products=1]', '127.0.0.3'),
('2007-10-04 18:07:59', 'products', 'admin', 'update [id_products=1]', '127.0.0.3');

-- --------------------------------------------------------

-- 
-- Структура таблицы `cat_mail_tasks`
-- 

DROP TABLE IF EXISTS `cat_mail_tasks`;
CREATE TABLE `cat_mail_tasks` (
  `task_id` int(32) unsigned NOT NULL auto_increment,
  `from` varchar(128) collate utf8_unicode_ci default NULL,
  `to` int(8) unsigned NOT NULL default '0',
  `to_limit` text collate utf8_unicode_ci,
  `subj` varchar(128) collate utf8_unicode_ci default NULL,
  `uid` varchar(64) collate utf8_unicode_ci NOT NULL default '0',
  `data` longtext collate utf8_unicode_ci,
  `tmark` datetime NOT NULL default '0000-00-00 00:00:00',
  `state` tinyint(1) default '0',
  PRIMARY KEY  (`task_id`),
  UNIQUE KEY `task_id` (`task_id`),
  KEY `task_id_2` (`task_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- 
-- Дамп данных таблицы `cat_mail_tasks`
-- 


-- --------------------------------------------------------

-- 
-- Структура таблицы `cat_tables`
-- 

DROP TABLE IF EXISTS `cat_tables`;
CREATE TABLE `cat_tables` (
  `name` char(128) collate utf8_unicode_ci NOT NULL default '',
  `area` tinyint(3) unsigned NOT NULL default '0',
  `created_by` char(32) collate utf8_unicode_ci default NULL,
  `object` char(64) collate utf8_unicode_ci default NULL,
  `title` char(255) collate utf8_unicode_ci default NULL,
  `pos` tinyint(3) unsigned NOT NULL default '0',
  PRIMARY KEY  (`name`),
  KEY `area` (`area`,`pos`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- 
-- Дамп данных таблицы `cat_tables`
-- 

INSERT INTO `cat_tables` (`name`, `area`, `created_by`, `object`, `title`, `pos`) VALUES 
('static', 1, 'admin', 'TabCommon', 'Статические страницы', 1),
('documents', 1, 'admin', 'TabCommon', 'Вспомогательные элементы', 2),
('r_user', 4, 'admin', 'TabCommon', 'Пользователи', 2),
('r_group', 4, 'admin', 'TabCommon', 'Группы', 1),
('r_usecase', 4, 'admin', 'TabCommon', 'Функции', 3),
('categories', 2, 'admin', 'TabStructed', 'Категории', 1),
('headline', 2, 'admin', 'TabCommon', 'Передовой продукт', 10),
('menu', 1, 'admin', 'TabCommon', 'Меню', 3),
('sessions', 4, 'admin', 'TabCommon', 'Сессии', 5),
('products', 2, 'admin', 'TabCommon', 'Продукты', 2),
('requests', 3, 'admin', 'TabCommon', 'Заказы', 1),
('request_states', 3, 'admin', 'TabCommon', 'Состояния заказов', 5),
('request_items', 3, 'admin', 'TabCommon', 'Комплектация', 2);

-- --------------------------------------------------------

-- 
-- Структура таблицы `cat_users`
-- 

DROP TABLE IF EXISTS `cat_users`;
CREATE TABLE `cat_users` (
  `login` char(32) collate utf8_unicode_ci NOT NULL default '',
  `passwd` char(32) collate utf8_unicode_ci NOT NULL default '',
  `ugroup` char(32) collate utf8_unicode_ci default NULL,
  `person` char(255) collate utf8_unicode_ci default NULL,
  `email` char(128) collate utf8_unicode_ci default NULL,
  `is_system` tinyint(1) unsigned default '0',
  `is_control` tinyint(1) unsigned default '0',
  `is_info` tinyint(1) unsigned default '0',
  UNIQUE KEY `login` (`login`),
  KEY `login_2` (`login`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- 
-- Дамп данных таблицы `cat_users`
-- 

INSERT INTO `cat_users` (`login`, `passwd`, `ugroup`, `person`, `email`, `is_system`, `is_control`, `is_info`) VALUES 
('admin', 'admin', 'admin', 'Administrator', 'webmaster@localhost', 1, 1, 1);

-- --------------------------------------------------------

-- 
-- Структура таблицы `documents`
-- 

DROP TABLE IF EXISTS `documents`;
CREATE TABLE `documents` (
  `id_documents` int(8) NOT NULL auto_increment,
  `id` varchar(32) collate utf8_unicode_ci default NULL,
  `title` varchar(127) collate utf8_unicode_ci default NULL,
  `info` text collate utf8_unicode_ci,
  KEY `id_documents` (`id_documents`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=17 ;

-- 
-- Дамп данных таблицы `documents`
-- 

INSERT INTO `documents` (`id_documents`, `id`, `title`, `info`) VALUES 
(1, 'reply_already_registered', 'Вы уже зарегистрированы', 'Для регистрации нового посетителя Вам необходимо предварительно <a href="?usecase=Logout">покинуть систему</a>! В противном случае регистрация будет недоступной.'),
(2, 'registration_info', 'Регистрация нового пользователя системы', 'Для создания и отслеживания хода выполнения заказов Вам необходимо пройти процедуру регистрации. Обратите, пожалуйста, внимание на следующие правила при заполнении нижеприведенной формы:<br />\r\n<ul>\r\n    <li>логин и пароль должны содержать только латинские символы и цифры. Спецсимволы и русские буквы недопустимы;</li>\r\n    <li>длина пароля не должна быть меньше 6 символов;</li>\r\n    <li>адрес электронной почты, указаный при регистрации, должен существовать. На него будет выслано письмо с кодом активации параметров пользователя.</li>\r\n</ul>\r\n<form method="post" action="/" onsubmit="return validateRegistration(this);">\r\n    <input type="hidden" value="Registration" name="usecase" />\r\n    <table width="100%" cellspacing="1" cellpadding="2" border="0" class="pt8">\r\n        <tbody>\r\n            <tr>\r\n                <td width="35%" valign="middle" align="right" class="ftitle">Логин</td>\r\n                <td width="65%" valign="top" align="left" class="felement">                               <input type="text" notice="Поле должно быть заполнено и содержать латинские символы" pattern="\\w+" maxlength="16" size="16" value="" name="f_login" mustbe="1" />                              </td>\r\n            </tr>\r\n            <tr>\r\n                <td width="35%" valign="middle" align="right" class="ftitle">Пароль</td>\r\n                <td width="65%" valign="top" align="left" class="felement">                               <input type="password" notice="Поле должно содержать латинские символы и цифры. Длина пароля не должна быть меньше 6 символов" pattern="\\w{6,16}" maxlegth="16" size="16" value="" name="f_passwd" mustbe="1" />                             </td>\r\n            </tr>\r\n            <tr>\r\n                <td width="35%" valign="middle" align="right" class="ftitle">Пароль (повторный ввод)</td>\r\n                <td width="65%" valign="top" align="left" class="felement">                               <input type="password" notice="Поле должно содержать латинские символы и цифры. Длина пароля не должна быть меньше 6 символов" pattern="\\w{6,16}" maxlegth="16" size="16" value="" name="f_passwdd" mustbe="1" />                             </td>\r\n            </tr>\r\n            <tr>\r\n                <td width="35%" valign="middle" align="right" class="ftitle">Ваше имя и фамилия</td>\r\n                <td width="65%" valign="top" align="left" class="felement">                               <input type="text" notice="Поле должно быть заполнено" pattern="string" maxlength="255" size="32" value="" name="f_name" mustbe="1" />                             </td>\r\n            </tr>\r\n            <tr>\r\n                <td width="35%" valign="middle" align="right" class="ftitle">Телефон</td>\r\n                <td width="65%" valign="top" align="left" class="felement">                               <input type="text" notice="Поле должно быть заполнено" pattern="string" maxlength="64" size="32" value="" name="f_phone" mustbe="1" />                              </td>\r\n            </tr>\r\n            <tr>\r\n                <td width="35%" valign="middle" align="right" class="ftitle">E-mail</td>\r\n                <td width="65%" valign="top" align="left" class="felement">                               <input type="text" notice="Поле должно быть содержать корректный E-mail" pattern="email" maxlength="127" size="32" value="" name="f_mail" mustbe="1" />                             </td>\r\n            </tr>\r\n            <tr>\r\n                <td align="right" class="fsubmit" colspan="2">                               <input type="submit" class="silver" value="Зарегистрироваться" />                             </td>\r\n            </tr>\r\n        </tbody>\r\n    </table>\r\n</form>'),
(3, 'registration_done', 'Регистрация успешно завершена', 'На Ваш электронный адрес было выслано письмо, содержащее ссылку активации пользователя. После завершения активации Вы можете получить полноценный доступ к системе.'),
(4, 'mail_registration', 'Вы успешно зарегистрированы в нашем интернет-магазине', 'Вы успешно зарегистрированы в нашем интернет-магазине.<br /><br /><span style="font-weight: bold;">Ваши параметры входа</span><br />Логин: @login@<br />Пароль: @passwd@<br /><br />Для активации пользователя, пожалуйста, перейдите по следующей ссылке:<br /><a href="https://www.webshop.ru/?usecase=Activation&amp;id=@activation_code@">https://webshop.ru/index.php?usecase=Activation&amp;id=@activation_code@</a><br /><br />В случае возникновения проблем напишите по адресу <a href="mailto:support@webshop.ru">support@webshop.ru</a>. Наши технические специалисты постараются решить возникшие проблемы в максимально кратчайший срок.<br /><br /><span style="font-style: italic; color: rgb(153, 153, 153);">C уважением,</span><br style="font-style: italic; color: rgb(153, 153, 153);" /><span style="font-style: italic; color: rgb(153, 153, 153);">Администрация webshop.ru</span>'),
(6, 'login_invalid', NULL, '<span style="font-weight: bold; color: rgb(255, 0, 0);">Введеный Вами логин уже существует или недостоверен!</span><br /><br />Логин должен состоять из латинских букв и цифр. Попробуйте иное словосочетание префикс Вашего электронного адреса.<br /><br />Пожалуйста, <a href="/Registration/">вернитесь и заполните форму еще раз</a>.'),
(7, 'activation_unsuccessful', NULL, '<span style="font-weight: bold; color: rgb(255, 0, 0);">Активация прошла неуспешно!<br /><br /></span>Пожалуйста, свяжитесь со службой поддержки по адресу <a href="mailto:support@webshop.ru">support@webshop.ru</a> с указанием Вашего логина и кода акивации.'),
(8, 'activation_successful', 'Активация завершена', 'Активация благополучно завершена. Вы можете воспользоваться логином и паролем, указанном в электронном письме.'),
(9, 'access_denited', 'Доступ к данному разделу ограничен', 'Для доступа к данному разделу Вам необходимо <a href="/Registration/">зарегистрироваться</a> в системе и войти с указанными при регистрации именем пользователя и паролем.'),
(10, 'request_complete', 'Спасибо за заказ!', 'Ваш заказ успешно размещен в нашей системе. Наш специалист свяжется с Вами по телефону и уточнит заказ и способ доставки.  <br /><br />На Ваш электронный ящик было отправлено уведомление, содержащее номер заказа. Пожалуйста, сохраните его до момента выполнения заказа. <br /><br />Текущее состояние Вашего заказа вы можене посмотреть в разделе <a href="/ShowRequests/">Заказы</a>.'),
(11, 'new_request', 'Новый заказ добавлен в систему', 'В интернет-магазине зарегистрирован новый заказ.<br /><br />Параметры:<br />\r\n<table width="100%" cellspacing="10" cellpadding="0" border="0" class="pt8">\r\n    <tbody>\r\n        <tr>\r\n            <td style="font-weight: bold;">Номер заказа</td>\r\n            <td>R-@id_requests@</td>\r\n        </tr>\r\n        <tr>\r\n            <td style="font-weight: bold;">Пользователь</td>\r\n            <td>@login@</td>\r\n        </tr>\r\n        <tr>\r\n            <td style="font-weight: bold;">Время создания</td>\r\n            <td>@tmark@</td>\r\n        </tr>\r\n        <tr>\r\n            <td><span style="font-weight: bold;">Общая сумма заказа</span></td>\r\n            <td>@total@ руб.</td>\r\n        </tr>\r\n        <tr>\r\n            <td colspan="2"><strong>Содержание заказа</strong><br />@ritems@</td>\r\n        </tr>\r\n    </tbody>\r\n</table>\r\n<br />\r\n<div style="text-align: center;"><span style="color: rgb(0, 0, 128);">Пожалуйста, сохраните данно письмо до момента завершения обработки заказа. </span></div>'),
(12, 'password_must_be_safe', 'Напоминание пароля', 'Изменить пароль Вы можете, написав письмо на адрес <a href="mailto:support@webshop.ru?subject=%u0421%u043C%u0435%u043D%u0430%20%u043F%u0430%u0440%u043E%u043B%u044F">support@webshop.ru</a>. Это следует сделать в случае, если Ваш пароль стал известен третьим лицам.<br /><br />Для напоминания пароля по электронной почте заполните, пожалуйста, нижеприведённую форму. <br /><br />\r\n<form onsubmit="return validateForm(this);" method="post" action="/">\r\n    <input type="hidden" value="RememberPassword" name="usecase" />\r\n    <table width="100%" cellspacing="1" cellpadding="2" border="0" class="pt8">\r\n        <tbody>\r\n            <tr>\r\n                <td width="35%" valign="middle" align="right" class="ftitle">E-mail</td>\r\n                <td width="65%" valign="top" align="left" class="felement">                         <input type="text" mustbe="1" notice="Поле должно быть содержать корректный E-mail" pattern="email" maxlength="127" size="32" value="" name="f_mail" />                       </td>\r\n            </tr>\r\n            <tr>\r\n                <td align="right" class="fsubmit" colspan="2">                         <input type="submit" class="silver" value="Напомнить пароль" />                       </td>\r\n            </tr>\r\n        </tbody>\r\n    </table>\r\n</form>'),
(13, 'no_user_found', 'Напоминание пароля', '<br /><span style="font-weight: bold; color: rgb(255, 0, 0);">Пользователь с данным электронным адресом не найден!</span><br /><br />Это могло случиться по ряду причин:<br />\r\n<ul>\r\n    <li>Вы неправильно ввели Ваш электронный адрес;</li>\r\n    <li>при регистрации в системе был использован другой электронный адрес;</li>\r\n    <li>Ваша запись была удалена или заблокирована администратором системы.</li>\r\n</ul>\r\nПопробуйте, пожалуйста, <a href="/RememberPassword/">повторить операцию</a>. При повторном возникновении ошибки - <a href="mailto:support@webshop.ru?subject=%u041F%u0440%u043E%u0431%u043B%u0435%u043C%u044B%20%u0441%20%u0432%u043E%u0441%u0441%u0442%u0430%u043D%u043E%u0432%u043B%u0435%u043D%u0438%u0435%u043C%20%u043F%u0430%u0440%u043E%u043B%u044F">свяжитесь со службой поддержки</a>.'),
(14, 'remember_done', 'Напоминание пароля', '<br /><span style="font-weight: bold; color: rgb(0, 0, 128);">Процедура напоминания пароля успешно завершена!</span><br /><br />На Ваш электронный ящик были высланы данные&nbsp; для доступа к системе. Пожалуйста, сохраните их в надёжном месте и не передавайте третьим лицам.'),
(15, 'mail_remember_password', 'Напоминание пароля', 'Напоминаем Вам параметры входа в систему:<br /><br /><span style="font-weight: bold;">Логин</span>: @login@<br /><span style="font-weight: bold;">Пароль</span>: @passwd@<br /><br />В случае возникновения сложностей с входом в систему или при желании поменять существующую регистрационную информацию&nbsp; напишите по адресу <a href="mailto:support@webshop.ru">support@webshop.ru</a>.<br /><br /><span style="font-style: italic; color: rgb(153, 153, 153);">C уважением,</span><br style="font-style: italic; color: rgb(153, 153, 153);" /><span style="font-style: italic; color: rgb(153, 153, 153);">Администрация webshop.ru</span>'),
(16, 'short_search_request', 'Поиск', '<span style="font-weight: bold; color: rgb(255, 0, 0);"><br />Вы ввели слишком короткий поисковый запрос!</span><br /><br />Попробуйте переформулировать слово для поиска или ввести более точное значение.');

-- --------------------------------------------------------

-- 
-- Структура таблицы `headline`
-- 

DROP TABLE IF EXISTS `headline`;
CREATE TABLE `headline` (
  `id_headline` int(8) NOT NULL auto_increment,
  `tmark` datetime default NULL,
  `title` varchar(128) collate utf8_unicode_ci default NULL,
  `info` text collate utf8_unicode_ci,
  `comment` varchar(255) collate utf8_unicode_ci default NULL,
  `img` varchar(128) collate utf8_unicode_ci default NULL,
  `link` varchar(255) collate utf8_unicode_ci default NULL,
  KEY `id_headline` (`id_headline`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

-- 
-- Дамп данных таблицы `headline`
-- 

INSERT INTO `headline` (`id_headline`, `tmark`, `title`, `info`, `comment`, `img`, `link`) VALUES 
(1, '2007-10-03 18:15:52', 'Новый кульный передовой продукт!', 'Иначе никак', NULL, NULL, NULL);

-- --------------------------------------------------------

-- 
-- Структура таблицы `menu`
-- 

DROP TABLE IF EXISTS `menu`;
CREATE TABLE `menu` (
  `id_menu` int(8) NOT NULL auto_increment,
  `title` char(32) collate utf8_unicode_ci default NULL,
  `link` char(255) collate utf8_unicode_ci default NULL,
  `pos` int(4) default NULL,
  KEY `id_menu` (`id_menu`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=7 ;

-- 
-- Дамп данных таблицы `menu`
-- 

INSERT INTO `menu` (`id_menu`, `title`, `link`, `pos`) VALUES 
(1, 'Прайс-лист', '/ShowStatic/1/', 1),
(2, 'Регистрация', '/Registration/', 2),
(3, 'Заказы', '/ShowRequests/', 3),
(4, 'Корзина', '/ShowChart/', 4),
(5, 'О компании', '/ShowStatic/2/', 5);

-- --------------------------------------------------------

-- 
-- Структура таблицы `products`
-- 

DROP TABLE IF EXISTS `products`;
CREATE TABLE `products` (
  `id_products` int(8) NOT NULL auto_increment,
  `category` int(8) default NULL,
  `title` varchar(255) collate utf8_unicode_ci default NULL,
  `img` varchar(128) collate utf8_unicode_ci default NULL,
  `shortinfo` text collate utf8_unicode_ci,
  `info` text collate utf8_unicode_ci,
  `warranty` varchar(64) collate utf8_unicode_ci default NULL,
  `is_lead` tinyint(1) default NULL,
  `c_price` float default NULL,
  `d_price` float default NULL,
  `saled` float default NULL,
  KEY `id_products` (`id_products`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

-- 
-- Дамп данных таблицы `products`
-- 

INSERT INTO `products` (`id_products`, `category`, `title`, `img`, `shortinfo`, `info`, `warranty`, `is_lead`, `c_price`, `d_price`, `saled`) VALUES 
(1, 2, '123', NULL, NULL, NULL, '12 ', 1, 1, 2, 1038);

-- --------------------------------------------------------

-- 
-- Структура таблицы `requests`
-- 

DROP TABLE IF EXISTS `requests`;
CREATE TABLE `requests` (
  `id_requests` int(8) NOT NULL auto_increment,
  `user` int(8) default NULL,
  `tmark` datetime default NULL,
  `ip` varchar(16) collate utf8_unicode_ci default NULL,
  `total` float default NULL,
  `state` int(8) default NULL,
  `comment` text collate utf8_unicode_ci,
  KEY `id_requests` (`id_requests`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=9 ;

-- 
-- Дамп данных таблицы `requests`
-- 

INSERT INTO `requests` (`id_requests`, `user`, `tmark`, `ip`, `total`, `state`, `comment`) VALUES 
(8, 1, '2007-10-04 18:24:19', '127.0.0.3', 345, 1, NULL),
(7, 1, '2007-10-04 18:24:19', '127.0.0.3', 345, 1, NULL),
(6, 1, '2007-10-04 18:24:19', '127.0.0.3', 345, 1, NULL),
(5, 1, '2007-10-04 18:04:49', '127.0.0.3', 15129, 1, NULL);

-- --------------------------------------------------------

-- 
-- Структура таблицы `request_items`
-- 

DROP TABLE IF EXISTS `request_items`;
CREATE TABLE `request_items` (
  `id_request_items` int(8) NOT NULL auto_increment,
  `request` int(8) default NULL,
  `product` int(8) default NULL,
  `num` int(8) default NULL,
  `price` float default NULL,
  `title` char(255) collate utf8_unicode_ci default NULL,
  `pid` char(32) collate utf8_unicode_ci default NULL,
  KEY `id_request_items` (`id_request_items`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=9 ;

-- 
-- Дамп данных таблицы `request_items`
-- 

INSERT INTO `request_items` (`id_request_items`, `request`, `product`, `num`, `price`, `title`, `pid`) VALUES 
(7, 7, 1, 345, 1, '123', '1'),
(6, 6, 1, 345, 1, '123', '1'),
(5, 5, 1, 123, 123, '123', '1'),
(8, 8, 1, 345, 1, '123', '1');

-- --------------------------------------------------------

-- 
-- Структура таблицы `request_states`
-- 

DROP TABLE IF EXISTS `request_states`;
CREATE TABLE `request_states` (
  `id_request_states` int(8) NOT NULL auto_increment,
  `state` char(64) collate utf8_unicode_ci default NULL,
  `pos` int(4) default NULL,
  KEY `id_request_states` (`id_request_states`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=9 ;

-- 
-- Дамп данных таблицы `request_states`
-- 

INSERT INTO `request_states` (`id_request_states`, `state`, `pos`) VALUES 
(1, 'Добавлен в систему', 1),
(2, 'Принят к исполнению', 2),
(3, 'В транзите', 3),
(4, 'Выполнен', 4),
(5, 'Отклонен', 5),
(6, 'Закрыт', 6),
(7, 'Ожидание предоплаты', 7),
(8, 'Ожидание подтверждения', 8);

-- --------------------------------------------------------

-- 
-- Структура таблицы `r_group`
-- 

DROP TABLE IF EXISTS `r_group`;
CREATE TABLE `r_group` (
  `id_r_group` int(8) NOT NULL auto_increment,
  `title` varchar(128) collate utf8_unicode_ci default NULL,
  `usecases` text collate utf8_unicode_ci,
  `enable` tinyint(1) default NULL,
  `name` varchar(32) collate utf8_unicode_ci default NULL,
  KEY `id_r_group` (`id_r_group`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

-- 
-- Дамп данных таблицы `r_group`
-- 

INSERT INTO `r_group` (`id_r_group`, `title`, `usecases`, `enable`, `name`) VALUES 
(1, 'Клиент', 'ucstart, ucregistration, ucfogotpassword, ucshowcategory, ucaddtochart, ucupdatechart, ucremovefromchart, ucmakerequest, ucsendrequest, ucshowrequests, ucshowproduct, uclogout\r\n', 1, 'Client');

-- --------------------------------------------------------

-- 
-- Структура таблицы `r_usecase`
-- 

DROP TABLE IF EXISTS `r_usecase`;
CREATE TABLE `r_usecase` (
  `id_r_usecase` int(8) NOT NULL auto_increment,
  `name` char(128) collate utf8_unicode_ci default NULL,
  `title` char(255) collate utf8_unicode_ci default NULL,
  KEY `id_r_usecase` (`id_r_usecase`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=23 ;

-- 
-- Дамп данных таблицы `r_usecase`
-- 

INSERT INTO `r_usecase` (`id_r_usecase`, `name`, `title`) VALUES 
(1, 'ucstart', 'Войти в систему'),
(2, 'uclogout', 'Выйти из системы'),
(20, 'ucshowrequests', 'Показать заказы'),
(18, 'ucstartssl', 'Авторизация по SSL'),
(19, 'ucprocesschart', 'Создать заказ'),
(14, 'ucregistration', 'Регистрация'),
(21, 'ucrememberpassword', 'Напоминание пароля'),
(22, 'ucsearchproduct', 'Поиск продукта');

-- --------------------------------------------------------

-- 
-- Структура таблицы `r_usecase_r_group`
-- 

DROP TABLE IF EXISTS `r_usecase_r_group`;
CREATE TABLE `r_usecase_r_group` (
  `r_group` int(8) NOT NULL default '0',
  `r_usecase` int(8) NOT NULL default '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- 
-- Дамп данных таблицы `r_usecase_r_group`
-- 

INSERT INTO `r_usecase_r_group` (`r_group`, `r_usecase`) VALUES 
(1, 20),
(1, 22),
(1, 21),
(1, 2),
(1, 1),
(1, 14),
(1, 19);

-- --------------------------------------------------------

-- 
-- Структура таблицы `r_user`
-- 

DROP TABLE IF EXISTS `r_user`;
CREATE TABLE `r_user` (
  `id_r_user` int(8) NOT NULL auto_increment,
  `login` char(16) collate utf8_unicode_ci default NULL,
  `passwd` char(16) collate utf8_unicode_ci default NULL,
  `enable` tinyint(1) default NULL,
  `in_group` int(8) default NULL,
  `name` char(255) collate utf8_unicode_ci default NULL,
  `mail` char(128) collate utf8_unicode_ci default NULL,
  `tmark` datetime default NULL,
  `ip` char(16) collate utf8_unicode_ci default NULL,
  `phone` char(64) collate utf8_unicode_ci default NULL,
  `price` char(1) collate utf8_unicode_ci default NULL,
  `activation_code` char(128) collate utf8_unicode_ci default NULL,
  KEY `id_r_user` (`id_r_user`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

-- 
-- Дамп данных таблицы `r_user`
-- 

INSERT INTO `r_user` (`id_r_user`, `login`, `passwd`, `enable`, `in_group`, `name`, `mail`, `tmark`, `ip`, `phone`, `price`, `activation_code`) VALUES 
(1, 'booter', 'booter', 1, 1, 'booter', 'booter@tula.net', '2007-10-03 18:20:54', NULL, '38-40-68', 'c', NULL),
(2, 'qwe', '123123', 0, 1, '123', 'booter@verbix.net', '2007-10-04 15:38:41', '127.0.0.3', '123', 'c', '3f953d18e5ae8085753a611147cd6b58');

-- --------------------------------------------------------

-- 
-- Структура таблицы `sessions`
-- 

DROP TABLE IF EXISTS `sessions`;
CREATE TABLE `sessions` (
  `id_sessions` int(8) NOT NULL auto_increment,
  `sid` varchar(255) collate utf8_unicode_ci default NULL,
  `tmark` datetime default NULL,
  `ip` varchar(16) collate utf8_unicode_ci default NULL,
  `obj` text collate utf8_unicode_ci,
  KEY `id_sessions` (`id_sessions`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=13 ;

-- 
-- Дамп данных таблицы `sessions`
-- 

INSERT INTO `sessions` (`id_sessions`, `sid`, `tmark`, `ip`, `obj`) VALUES 
(1, 'mp42tpohf0vbl57o9aqng73mmthu1s9v', '2007-10-04 16:16:44', '127.0.0.3', 'O:4:"User":8:{s:5:"login";N;s:2:"id";N;s:4:"name";N;s:5:"price";N;s:4:"mail";N;s:5:"group";N;s:8:"group_id";N;s:5:"valid";b:0;}'),
(2, 'mp42tpohf0vbl57o9aqng73mmthu1s9v', '2007-10-04 16:17:33', '127.0.0.3', 'O:4:"User":8:{s:5:"login";N;s:2:"id";N;s:4:"name";N;s:5:"price";N;s:4:"mail";N;s:5:"group";N;s:8:"group_id";N;s:5:"valid";b:0;}'),
(3, 'mp42tpohf0vbl57o9aqng73mmthu1s9v', '2007-10-04 16:21:58', '127.0.0.3', 'O:4:"User":8:{s:5:"login";N;s:2:"id";N;s:4:"name";N;s:5:"price";N;s:4:"mail";N;s:5:"group";N;s:8:"group_id";N;s:5:"valid";b:0;}'),
(4, 'mp42tpohf0vbl57o9aqng73mmthu1s9v', '2007-10-04 16:22:43', '127.0.0.3', 'O:4:"User":8:{s:5:"login";N;s:2:"id";N;s:4:"name";N;s:5:"price";N;s:4:"mail";N;s:5:"group";N;s:8:"group_id";N;s:5:"valid";b:0;}'),
(5, 'mp42tpohf0vbl57o9aqng73mmthu1s9v', '2007-10-04 16:23:54', '127.0.0.3', 'O:4:"User":8:{s:5:"login";N;s:2:"id";N;s:4:"name";N;s:5:"price";N;s:4:"mail";N;s:5:"group";N;s:8:"group_id";N;s:5:"valid";b:0;}'),
(6, 'mp42tpohf0vbl57o9aqng73mmthu1s9v', '2007-10-04 16:25:05', '127.0.0.3', 'O:4:"User":8:{s:5:"login";N;s:2:"id";N;s:4:"name";N;s:5:"price";N;s:4:"mail";N;s:5:"group";N;s:8:"group_id";N;s:5:"valid";b:0;}'),
(7, 'mp42tpohf0vbl57o9aqng73mmthu1s9v', '2007-10-04 16:36:44', '127.0.0.3', 'O:4:"User":8:{s:5:"login";s:6:"booter";s:2:"id";N;s:4:"name";s:6:"booter";s:5:"price";s:1:"c";s:4:"mail";s:15:"booter@tula.net";s:5:"group";O:5:"Group":4:{s:5:"group";s:1:"1";s:5:"title";s:12:"Клиент";s:4:"name";s:6:"Client";s:7:"objects";a:7:{s:7:"ucstart";s:1:"1";s:8:"uclogout";s:1:"1";s:14:"ucshowrequests";s:1:"1";s:14:"ucprocesschart";s:1:"1";s:14:"ucregistration";s:1:"1";s:18:"ucrememberpassword";s:1:"1";s:15:"ucsearchproduct";s:1:"1";}}s:8:"group_id";s:1:"1";s:5:"valid";b:1;}'),
(8, 'mp42tpohf0vbl57o9aqng73mmthu1s9v', '2007-10-04 16:52:58', '127.0.0.3', 'O:4:"User":8:{s:5:"login";s:6:"booter";s:2:"id";N;s:4:"name";s:6:"booter";s:5:"price";s:1:"c";s:4:"mail";s:15:"booter@tula.net";s:5:"group";O:5:"Group":4:{s:5:"group";s:1:"1";s:5:"title";s:12:"Клиент";s:4:"name";s:6:"Client";s:7:"objects";a:7:{s:7:"ucstart";s:1:"1";s:8:"uclogout";s:1:"1";s:14:"ucshowrequests";s:1:"1";s:14:"ucprocesschart";s:1:"1";s:14:"ucregistration";s:1:"1";s:18:"ucrememberpassword";s:1:"1";s:15:"ucsearchproduct";s:1:"1";}}s:8:"group_id";s:1:"1";s:5:"valid";b:1;}'),
(9, 'mp42tpohf0vbl57o9aqng73mmthu1s9v', '2007-10-04 16:53:13', '127.0.0.3', 'O:4:"User":8:{s:5:"login";s:6:"booter";s:2:"id";N;s:4:"name";s:6:"booter";s:5:"price";s:1:"c";s:4:"mail";s:15:"booter@tula.net";s:5:"group";O:5:"Group":4:{s:5:"group";s:1:"1";s:5:"title";s:12:"Клиент";s:4:"name";s:6:"Client";s:7:"objects";a:7:{s:7:"ucstart";s:1:"1";s:8:"uclogout";s:1:"1";s:14:"ucshowrequests";s:1:"1";s:14:"ucprocesschart";s:1:"1";s:14:"ucregistration";s:1:"1";s:18:"ucrememberpassword";s:1:"1";s:15:"ucsearchproduct";s:1:"1";}}s:8:"group_id";s:1:"1";s:5:"valid";b:1;}'),
(10, 'mp42tpohf0vbl57o9aqng73mmthu1s9v', '2007-10-04 17:10:54', '127.0.0.3', 'O:4:"User":8:{s:5:"login";s:6:"booter";s:2:"id";N;s:4:"name";s:6:"booter";s:5:"price";s:1:"c";s:4:"mail";s:15:"booter@tula.net";s:5:"group";O:5:"Group":4:{s:5:"group";s:1:"1";s:5:"title";s:12:"Клиент";s:4:"name";s:6:"Client";s:7:"objects";a:7:{s:7:"ucstart";s:1:"1";s:8:"uclogout";s:1:"1";s:14:"ucshowrequests";s:1:"1";s:14:"ucprocesschart";s:1:"1";s:14:"ucregistration";s:1:"1";s:18:"ucrememberpassword";s:1:"1";s:15:"ucsearchproduct";s:1:"1";}}s:8:"group_id";s:1:"1";s:5:"valid";b:1;}'),
(11, 'mp42tpohf0vbl57o9aqng73mmthu1s9v', '2007-10-04 17:25:21', '127.0.0.3', 'O:4:"User":8:{s:5:"login";s:6:"booter";s:2:"id";s:1:"1";s:4:"name";s:6:"booter";s:5:"price";s:1:"c";s:4:"mail";s:15:"booter@tula.net";s:5:"group";O:5:"Group":4:{s:5:"group";s:1:"1";s:5:"title";s:12:"Клиент";s:4:"name";s:6:"Client";s:7:"objects";a:7:{s:7:"ucstart";s:1:"1";s:8:"uclogout";s:1:"1";s:14:"ucshowrequests";s:1:"1";s:14:"ucprocesschart";s:1:"1";s:14:"ucregistration";s:1:"1";s:18:"ucrememberpassword";s:1:"1";s:15:"ucsearchproduct";s:1:"1";}}s:8:"group_id";s:1:"1";s:5:"valid";b:1;}'),
(12, 'mp42tpohf0vbl57o9aqng73mmthu1s9v', '2007-10-04 18:18:13', '127.0.0.3', 'O:4:"User":8:{s:5:"login";s:6:"booter";s:2:"id";s:1:"1";s:4:"name";s:6:"booter";s:5:"price";s:1:"c";s:4:"mail";s:15:"booter@tula.net";s:5:"group";O:5:"Group":4:{s:5:"group";s:1:"1";s:5:"title";s:12:"Клиент";s:4:"name";s:6:"Client";s:7:"objects";a:7:{s:7:"ucstart";s:1:"1";s:8:"uclogout";s:1:"1";s:14:"ucshowrequests";s:1:"1";s:14:"ucprocesschart";s:1:"1";s:14:"ucregistration";s:1:"1";s:18:"ucrememberpassword";s:1:"1";s:15:"ucsearchproduct";s:1:"1";}}s:8:"group_id";s:1:"1";s:5:"valid";b:1;}');

-- --------------------------------------------------------

-- 
-- Структура таблицы `static`
-- 

DROP TABLE IF EXISTS `static`;
CREATE TABLE `static` (
  `id_static` int(8) NOT NULL auto_increment,
  `id` int(4) default NULL,
  `title` varchar(255) collate utf8_unicode_ci default NULL,
  `info` text collate utf8_unicode_ci,
  KEY `id_static` (`id_static`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

-- 
-- Дамп данных таблицы `static`
-- 

INSERT INTO `static` (`id_static`, `id`, `title`, `info`) VALUES 
(1, 1, '123123', '131231231 2 312');
