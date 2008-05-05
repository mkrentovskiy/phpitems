-- phpMyAdmin SQL Dump
-- version 2.10.1
-- http://www.phpmyadmin.net
-- 
-- Хост: localhost
-- Время создания: Июл 18 2007 г., 14:28
-- Версия сервера: 5.0.26
-- Версия PHP: 5.2.0

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

-- 
-- База данных: `hcp`
-- 

-- --------------------------------------------------------

-- 
-- Структура таблицы `d_companytypes`
-- 

CREATE TABLE `d_companytypes` (
  `id` tinyint(1) NOT NULL auto_increment,
  `title` varchar(32) collate utf8_unicode_ci NOT NULL default '',
  `img` char(3) collate utf8_unicode_ci NOT NULL default '',
  `pos` tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=6 ;

-- 
-- Дамп данных таблицы `d_companytypes`
-- 

INSERT INTO `d_companytypes` (`id`, `title`, `img`, `pos`) VALUES 
(1, 'Наша компания', '1', 9),
(2, 'Неопределенная компания', '2', 1),
(3, 'Хороший партнер', '3', 2),
(4, 'Строгий/беспокойный партнер', '4', 3),
(5, 'Нехорошие люди', '5', 4);

-- --------------------------------------------------------

-- 
-- Структура таблицы `d_documenttypes`
-- 

CREATE TABLE `d_documenttypes` (
  `id` tinyint(4) NOT NULL default '0',
  `type` varchar(255) collate utf8_unicode_ci NOT NULL default '',
  `dfile` varchar(255) collate utf8_unicode_ci NOT NULL default '',
  `pos` tinyint(4) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- 
-- Дамп данных таблицы `d_documenttypes`
-- 

INSERT INTO `d_documenttypes` (`id`, `type`, `dfile`, `pos`) VALUES 
(1, 'Договор на разработку сайта', '', 1);

-- --------------------------------------------------------

-- 
-- Структура таблицы `d_projectstates`
-- 

CREATE TABLE `d_projectstates` (
  `id` int(1) NOT NULL auto_increment,
  `state` varchar(32) collate utf8_unicode_ci NOT NULL default '',
  `pos` int(1) NOT NULL default '0',
  PRIMARY KEY  (`id`),
  UNIQUE KEY `id` (`id`),
  KEY `pos` (`pos`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=7 ;

-- 
-- Дамп данных таблицы `d_projectstates`
-- 

INSERT INTO `d_projectstates` (`id`, `state`, `pos`) VALUES 
(1, 'Договор', 1),
(2, 'Работа', 2),
(3, 'Простой', 3),
(4, 'Сдача', 4),
(5, 'Успех', 8),
(6, 'Провал', 9);

-- --------------------------------------------------------

-- 
-- Структура таблицы `d_projecttypes`
-- 

CREATE TABLE `d_projecttypes` (
  `id` int(4) NOT NULL auto_increment,
  `type` varchar(64) collate utf8_unicode_ci NOT NULL default '',
  `img` char(3) collate utf8_unicode_ci default NULL,
  `pos` int(4) NOT NULL default '0',
  PRIMARY KEY  (`id`),
  UNIQUE KEY `id` (`id`),
  KEY `pos` (`pos`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

-- 
-- Дамп данных таблицы `d_projecttypes`
-- 

INSERT INTO `d_projecttypes` (`id`, `type`, `img`, `pos`) VALUES 
(1, 'Интернет решение', 'web', 1),
(2, 'Прикладное ПО', 'app', 2),
(3, 'АСУТП', 'emb', 3),
(4, 'Консалтинг', 'any', 10);

-- --------------------------------------------------------

-- 
-- Структура таблицы `d_tasktypes`
-- 

CREATE TABLE `d_tasktypes` (
  `id` int(8) NOT NULL auto_increment,
  `type` varchar(255) collate utf8_unicode_ci NOT NULL default '',
  `color` varchar(6) collate utf8_unicode_ci NOT NULL default 'ffffff',
  `pos` int(8) NOT NULL default '0',
  PRIMARY KEY  (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

-- 
-- Дамп данных таблицы `d_tasktypes`
-- 

INSERT INTO `d_tasktypes` (`id`, `type`, `color`, `pos`) VALUES 
(1, 'Несрочно', 'ffffff', 0);

-- --------------------------------------------------------

-- 
-- Структура таблицы `i_costareas`
-- 

CREATE TABLE `i_costareas` (
  `id` int(32) NOT NULL auto_increment,
  `pid` int(32) NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `pid` (`pid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- 
-- Дамп данных таблицы `i_costareas`
-- 


-- --------------------------------------------------------

-- 
-- Структура таблицы `i_costsitem`
-- 

CREATE TABLE `i_costsitem` (
  `id` int(32) NOT NULL auto_increment,
  `plan` varchar(32) collate utf8_unicode_ci NOT NULL,
  `area` varchar(32) collate utf8_unicode_ci NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `plan` (`plan`,`area`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- 
-- Дамп данных таблицы `i_costsitem`
-- 


-- --------------------------------------------------------

-- 
-- Структура таблицы `i_costsplan`
-- 

CREATE TABLE `i_costsplan` (
  `id` int(32) NOT NULL auto_increment,
  `pid` int(32) NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `pid` (`pid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- 
-- Дамп данных таблицы `i_costsplan`
-- 


-- --------------------------------------------------------

-- 
-- Структура таблицы `o_address`
-- 

CREATE TABLE `o_address` (
  `id` int(32) NOT NULL auto_increment,
  `zip` int(6) NOT NULL default '0',
  `state` varchar(128) collate utf8_unicode_ci NOT NULL default '',
  `region` varchar(128) collate utf8_unicode_ci NOT NULL default '',
  `city` varchar(64) collate utf8_unicode_ci NOT NULL default '',
  `street` varchar(128) collate utf8_unicode_ci NOT NULL default '',
  `house` varchar(8) collate utf8_unicode_ci NOT NULL default '',
  `flat` varchar(8) collate utf8_unicode_ci NOT NULL default '',
  `comment` text collate utf8_unicode_ci,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

-- 
-- Дамп данных таблицы `o_address`
-- 

INSERT INTO `o_address` (`id`, `zip`, `state`, `region`, `city`, `street`, `house`, `flat`, `comment`) VALUES 
(1, 1234, '1324', '1234', '1234', '1324', '', '', '');

-- --------------------------------------------------------

-- 
-- Структура таблицы `o_bill`
-- 

CREATE TABLE `o_bill` (
  `id` int(32) unsigned NOT NULL auto_increment,
  `bill` varchar(20) collate utf8_unicode_ci NOT NULL default '0',
  `bank` varchar(128) collate utf8_unicode_ci NOT NULL default '',
  `corbill` varchar(20) collate utf8_unicode_ci NOT NULL default '0',
  `bik` varchar(9) collate utf8_unicode_ci NOT NULL default '0',
  PRIMARY KEY  (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- 
-- Дамп данных таблицы `o_bill`
-- 


-- --------------------------------------------------------

-- 
-- Структура таблицы `o_company`
-- 

CREATE TABLE `o_company` (
  `id` int(32) unsigned NOT NULL auto_increment,
  `title` varchar(255) collate utf8_unicode_ci NOT NULL default '',
  `fform` tinyint(1) NOT NULL default '0',
  `email` varchar(128) collate utf8_unicode_ci NOT NULL default '',
  `inn` varchar(10) collate utf8_unicode_ci NOT NULL default '0',
  `kpp` varchar(9) collate utf8_unicode_ci NOT NULL default '0',
  `okved` varchar(5) collate utf8_unicode_ci NOT NULL default '0',
  `okpo` varchar(8) collate utf8_unicode_ci NOT NULL default '0',
  `tborn` date NOT NULL default '0000-00-00',
  `type` tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- 
-- Дамп данных таблицы `o_company`
-- 


-- --------------------------------------------------------

-- 
-- Структура таблицы `o_document`
-- 

CREATE TABLE `o_document` (
  `id` int(32) NOT NULL auto_increment,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- 
-- Дамп данных таблицы `o_document`
-- 


-- --------------------------------------------------------

-- 
-- Структура таблицы `o_file`
-- 

CREATE TABLE `o_file` (
  `id` int(32) NOT NULL auto_increment,
  `title` varchar(255) collate utf8_unicode_ci NOT NULL default '',
  `filename` varchar(255) collate utf8_unicode_ci NOT NULL default '',
  `type` char(3) collate utf8_unicode_ci NOT NULL default 'unc',
  `comment` text collate utf8_unicode_ci NOT NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=23 ;

-- 
-- Дамп данных таблицы `o_file`
-- 

INSERT INTO `o_file` (`id`, `title`, `filename`, `type`, `comment`) VALUES 
(1, 'Доклад с kernel.org', 'data/file/09072007132719_', '19_', 'очень краткое описание'),
(2, '123', 'data/file/12072007125637_', '37_', ''),
(3, '12', 'data/file/12072007125723_', '23_', ''),
(4, '123', 'data/file/12072007131516_', '16_', ''),
(5, '12', 'data/file/12072007132232_', '32_', ''),
(6, '12', 'data/file/12072007132345_', '45_', ''),
(7, '321', 'data/file/bligh-Reprint.pdf', 'pdf', ''),
(8, 'qwe', 'data/file/crouse-Reprint.pdf', 'pdf', 'asd'),
(9, 'asd', 'data/file/12072007134659_bligh-Reprint.pdf', 'pdf', 'sdas asd as'),
(10, '123', 'data/file/brown_2-Reprint.pdf', 'pdf', 'eqqe'),
(11, '123', 'data/file/12072007143415_crouse-Reprint.pdf', 'pdf', ''),
(12, 'ячсцуацуасцу', 'data/file/12072007143547_briglia-Reprint.pdf', 'pdf', ''),
(13, 'ячсцуацуасцу', 'data/file/patch.txt', 'txt', ''),
(14, 'ячсророро', 'data/file/12072007145017_', '17_', ''),
(15, 'vxzcvzcxv', 'data/file/12072007143415_crouse-Reprint.pdf', '', 'rweqrqwrq'),
(16, '1vvfdvsdv', 'data/file/june.xml', 'xml', ''),
(17, '1vvfdvsdv', 'data/file/june.xml', 'xml', ''),
(18, '1vvfdvsdv', 'data/file/june.xml', 'xml', ''),
(19, 'Budjet', 'data/file/12072007172135_Byudzhet.xls', 'xls', ''),
(20, '32423423', 'data/file/httperf-0.9.0.tar.gz', '.gz', ''),
(21, '1vvfdvsdv', 'data/file/june.xml', '', 'rwrwerwe'),
(22, '1vvfdvsdv', 'data/file/june.xml', '', 'rwrwerwe');

-- --------------------------------------------------------

-- 
-- Структура таблицы `o_folder`
-- 

CREATE TABLE `o_folder` (
  `id` int(32) NOT NULL auto_increment,
  `name` varchar(255) collate utf8_unicode_ci NOT NULL default '',
  `color` varchar(6) collate utf8_unicode_ci NOT NULL default 'ffffff',
  `tmark` datetime default NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=17 ;

-- 
-- Дамп данных таблицы `o_folder`
-- 

INSERT INTO `o_folder` (`id`, `name`, `color`, `tmark`) VALUES 
(1, 'Все проекты', 'CCCCFF', '2007-07-09 13:26:17'),
(2, 'Все проекты', 'FFCCCC', '2007-07-11 16:26:48'),
(3, 'Не все проекты', 'FFCCCC', '2007-07-11 16:27:07'),
(4, 'Не все проекты', 'FFFFCC', '2007-07-11 16:29:57'),
(5, 'Не все проекты', 'FFCCFF', '2007-07-11 16:30:28'),
(6, '123', 'CCFFCC', '2007-07-11 16:33:36'),
(7, '123', 'CCFFCC', '2007-07-11 16:33:38'),
(8, 'Не все проекты', 'CCFFFF', '2007-07-11 16:38:16'),
(9, 'Не все проекты', 'CCCCFF', '2007-07-11 16:39:11'),
(10, 'Не все проекты', 'CCFFCC', '2007-07-11 16:39:20'),
(11, 'Не все проекты', 'CCCCFF', '2007-07-11 16:39:44'),
(12, 'Не все проекты', 'FFFFCC', '2007-07-11 16:40:11'),
(13, 'Не все проекты', 'CCFFCC', '2007-07-11 16:40:16'),
(14, 'Не все проекты', 'FFCCFF', '2007-07-11 16:40:21'),
(15, 'внвпавп', 'CCFFCC', '2007-07-11 16:48:23'),
(16, '123', 'CCFFCC', '2007-07-11 16:52:59');

-- --------------------------------------------------------

-- 
-- Структура таблицы `o_image`
-- 

CREATE TABLE `o_image` (
  `id` int(32) NOT NULL auto_increment,
  `title` varchar(255) collate utf8_unicode_ci NOT NULL default '',
  `filename` varchar(255) collate utf8_unicode_ci NOT NULL default '',
  `has_preview` tinyint(1) NOT NULL default '0',
  `comment` text collate utf8_unicode_ci NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=8 ;

-- 
-- Дамп данных таблицы `o_image`
-- 

INSERT INTO `o_image` (`id`, `title`, `filename`, `has_preview`, `comment`) VALUES 
(1, 'logo', 'data/image/e-logo.png', 1, ''),
(2, '312312312', 'data/image/P4267782.JPG', 0, ''),
(3, '312312312', 'data/image/P4267782.JPG', 1, ''),
(4, '312312312', 'data/image/P6248605.JPG', 0, ''),
(5, '312312312', 'data/image/P6248605.JPG', 1, ''),
(6, '312312', 'data/image/P6248593.JPG', 0, ''),
(7, '312312', 'data/image/P6248593.JPG', 1, '');

-- --------------------------------------------------------

-- 
-- Структура таблицы `o_note`
-- 

CREATE TABLE `o_note` (
  `id` int(32) NOT NULL auto_increment,
  `note` blob NOT NULL,
  `author` varchar(255) collate utf8_unicode_ci NOT NULL default '',
  `tmark` datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

-- 
-- Дамп данных таблицы `o_note`
-- 

INSERT INTO `o_note` (`id`, `note`, `author`, `tmark`) VALUES 
(1, 0x3c666f6e742073697a653d2232223e2831333a33313a333529203c2f666f6e743e3c656d3e3c666f6e7420636f6c6f723d2223353061303530223e3c666f6e742073697a653d2233223e6368336b317337205b667362373140753137332e6e34392e6d63632e74756c612e6e65745d20d0b2d0bed188d191d0bb20d0b220d0bad0bed0bcd0bdd0b0d182d1832e3c2f666f6e743e3c2f666f6e743e3c2f656d3e3c6272202f3e0a3c666f6e742073697a653d2232223e3c666f6e7420636f6c6f723d2223396132336462223e2831333a33313a353029203c2f666f6e743e3c2f666f6e743e3c666f6e7420636f6c6f723d2223396132336462223e3c666f6e742073697a653d2233223e4b6f72614c4c3a3c2f666f6e743e3c2f666f6e743e3c666f6e742073697a653d2233223e203c666f6e7420636f6c6f723d2223303030303030223ed0b2d181d0b520d181d0bfd18fd18220d187d182d0be20d0bbd0b83f3f3f3c2f666f6e743e3c2f666f6e743e3c6272202f3e0a3c666f6e742073697a653d2232223e3c666f6e7420636f6c6f723d2223396132336462223e2831333a33313a353329203c2f666f6e743e3c2f666f6e743e3c666f6e7420636f6c6f723d2223396132336462223e3c666f6e742073697a653d2233223e4b6f72614c4c3a3c2f666f6e743e3c2f666f6e743e3c666f6e742073697a653d2233223e203c666f6e7420636f6c6f723d2223303030303030223ed18dd0b9213c2f666f6e743e3c2f666f6e743e3c6272202f3e0a3c666f6e742073697a653d2232223e3c666f6e7420636f6c6f723d2223666435373566223e2831333a33323a303429203c2f666f6e743e3c2f666f6e743e3c666f6e7420636f6c6f723d2223666435373566223e3c666f6e742073697a653d2233223e76736c3a3c2f666f6e743e3c2f666f6e743e3c666f6e742073697a653d2233223e203c666f6e7420636f6c6f723d2223303030303030223ed0b2d181d0b520d0b0d180d0b1d0b0d0b9d182d0b5d0bd20d0bfd0be2dd181d182d0b0d185d0b0d0bdd0bed0b2d181d0bad0b83c2f666f6e743e3c2f666f6e743e3c6272202f3e0a3c666f6e742073697a653d2232223e3c666f6e7420636f6c6f723d2223343665313466223e2831333a33323a313229203c2f666f6e743e3c2f666f6e743e3c666f6e7420636f6c6f723d2223343665313466223e3c666f6e742073697a653d2233223e4469616d6f6e443a3c2f666f6e743e3c2f666f6e743e3c666f6e742073697a653d2233223e203c666f6e7420636f6c6f723d2223303030303030223e48693c2f666f6e743e3c2f666f6e743e3c6272202f3e0a3c666f6e742073697a653d2232223e2831333a33323a313629203c2f666f6e743e3c656d3e3c666f6e7420636f6c6f723d2223353061303530223e3c666f6e742073697a653d2233223e496e466c616d6573205b67656f7267726940753139352e6e33362e6d63632e74756c612e6e65745d20d0b2d0bed188d191d0bb20d0b220d0bad0bed0bcd0bdd0b0d182d1832e3c2f666f6e743e3c2f666f6e743e3c2f656d3e3c6272202f3e0a3c666f6e742073697a653d2232223e2831333a33323a323429203c2f666f6e743e3c656d3e3c666f6e7420636f6c6f723d2223353061303530223e3c666f6e742073697a653d2233223e496e466c616d657320d0b2d18bd188d0b5d0bb20d0b8d0b720d0bad0bed0bcd0bdd0b0d182d18b2e3c2f666f6e743e3c2f666f6e743e3c2f656d3e3c6272202f3e0a3c666f6e742073697a653d2232223e3c666f6e7420636f6c6f723d2223396132336462223e2831333a33323a323429203c2f666f6e743e3c2f666f6e743e3c666f6e7420636f6c6f723d2223396132336462223e3c666f6e742073697a653d2233223e4b6f72614c4c3a3c2f666f6e743e3c2f666f6e743e3c666f6e742073697a653d2233223e203c666f6e7420636f6c6f723d2223303030303030223e76736c3a20d0bed0bed0be2929293c2f666f6e743e3c2f666f6e743e3c6272202f3e0a3c666f6e742073697a653d2232223e3c666f6e7420636f6c6f723d2223326137666664223e2831333a33323a323529203c2f666f6e743e3c2f666f6e743e3c666f6e7420636f6c6f723d2223326137666664223e3c666f6e742073697a653d2233223e54657848656b5f773a3c2f666f6e743e3c2f666f6e743e3c666f6e742073697a653d2233223e203c666f6e7420636f6c6f723d2223303030303030223ed0bfd0be2dd181d182d0b0d0bad0b0d0bdd0bed0b2d181d0bad0b83c2f666f6e743e3c2f666f6e743e, 'Максим Крентовский', '2007-07-09 13:32:50'),
(2, 0xd183d0b9d183d0b9d186d183d0b9d186d183d0b9d186d183d0b9d186d183d0b9d186d183, 'Максим Крентовский', '2007-07-11 17:17:57'),
(3, 0x3c6469763e3c666f6e742073697a653d2232223e2831333a33313a333529203c2f666f6e743e3c656d3e3c666f6e7420636f6c6f723d2223353061303530223e3c666f6e742073697a653d2233223e6368336b317337205b667362373140753137332e6e34392e6d63632e74756c612e6e65745d20d0b2d0bed188d191d0bb20d0b220d0bad0bed0bcd0bdd0b0d182d1832e3c2f666f6e743e3c2f666f6e743e3c2f656d3e3c6272202f3e0a3c666f6e742073697a653d2232223e3c666f6e7420636f6c6f723d2223396132336462223e2831333a33313a353029203c2f666f6e743e3c2f666f6e743e3c666f6e7420636f6c6f723d2223396132336462223e3c666f6e742073697a653d2233223e4b6f72614c4c3a3c2f666f6e743e3c2f666f6e743e3c666f6e742073697a653d2233223e203c666f6e7420636f6c6f723d2223303030303030223ed0b2d181d0b520d181d0bfd18fd18220d187d182d0be20d0bbd0b83f3f3f3c2f666f6e743e3c2f666f6e743e3c6272202f3e0a3c666f6e742073697a653d2232223e3c666f6e7420636f6c6f723d2223666435373566223e2831333a33323a303429203c2f666f6e743e3c2f666f6e743e3c666f6e7420636f6c6f723d2223666435373566223e3c666f6e742073697a653d2233223e76736c3a3c2f666f6e743e3c2f666f6e743e3c666f6e742073697a653d2233223e203c666f6e7420636f6c6f723d2223303030303030223ed0b2d181d0b520d0b0d180d0b1d0b0d0b9d182d0b5d0bd20d0bfd0be2dd181d182d0b0d185d0b0d0bdd0bed0b2d181d0bad0b83c2f666f6e743e3c2f666f6e743e3c6272202f3e0a3c666f6e742073697a653d2232223e3c666f6e7420636f6c6f723d2223343665313466223e2831333a33323a313229203c2f666f6e743e3c2f666f6e743e3c666f6e7420636f6c6f723d2223343665313466223e3c666f6e742073697a653d2233223e4469616d6f6e443a3c2f666f6e743e3c2f666f6e743e3c666f6e742073697a653d2233223e203c666f6e7420636f6c6f723d2223303030303030223e48693c2f666f6e743e3c2f666f6e743e3c6272202f3e0a3c666f6e742073697a653d2232223e2831333a33323a313629203c2f666f6e743e3c656d3e3c666f6e7420636f6c6f723d2223353061303530223e3c666f6e742073697a653d2233223e496e466c616d6573205b67656f7267726940753139352e6e33362e6d63632e74756c612e6e65745d20d0b2d0bed188d191d0bb20d0b220d0bad0bed0bcd0bdd0b0d182d1832e3c2f666f6e743e3c2f666f6e743e3c2f656d3e3c6272202f3e0a3c666f6e742073697a653d2232223e2831333a33323a323429203c2f666f6e743e3c656d3e3c666f6e7420636f6c6f723d2223353061303530223e3c666f6e742073697a653d2233223e496e466c616d657320d0b2d18bd188d0b5d0bb20d0b8d0b720d0bad0bed0bcd0bdd0b0d182d18b2e3c2f666f6e743e3c2f666f6e743e3c2f656d3e3c6272202f3e0a3c666f6e742073697a653d2232223e3c666f6e7420636f6c6f723d2223396132336462223e2831333a33323a323429203c2f666f6e743e3c2f666f6e743e3c666f6e7420636f6c6f723d2223396132336462223e3c666f6e742073697a653d2233223e4b6f72614c4c3a3c2f666f6e743e3c2f666f6e743e3c666f6e742073697a653d2233223e203c666f6e7420636f6c6f723d2223303030303030223e76736c3a20d0bed0bed0be2929293c2f666f6e743e3c2f666f6e743e3c6272202f3e0a3c666f6e742073697a653d2232223e3c666f6e7420636f6c6f723d2223326137666664223e2831333a33323a323529203c2f666f6e743e3c2f666f6e743e3c666f6e7420636f6c6f723d2223326137666664223e3c666f6e742073697a653d2233223e54657848656b5f773a3c2f666f6e743e3c2f666f6e743e3c666f6e742073697a653d2233223e203c666f6e7420636f6c6f723d2223303030303030223ed0bfd0be2dd181d182d0b0d0bad0b0d0bdd0bed0b2d181d0bad0b83c2f666f6e743e3c2f666f6e743e3c2f6469763e, 'Максим Крентовский', '2007-07-13 11:48:37');

-- --------------------------------------------------------

-- 
-- Структура таблицы `o_person`
-- 

CREATE TABLE `o_person` (
  `id` int(32) NOT NULL auto_increment,
  `fname` varchar(128) collate utf8_unicode_ci NOT NULL default '',
  `mname` varchar(128) collate utf8_unicode_ci NOT NULL default '',
  `lname` varchar(128) collate utf8_unicode_ci NOT NULL default '',
  `title` varchar(128) collate utf8_unicode_ci NOT NULL default '',
  `sex` tinyint(1) NOT NULL default '0',
  `tborn` date NOT NULL default '0000-00-00',
  `dserial` varchar(4) collate utf8_unicode_ci NOT NULL default '',
  `dnumber` varchar(6) collate utf8_unicode_ci NOT NULL default '',
  `ddpt` varchar(128) collate utf8_unicode_ci NOT NULL default '',
  `dtmark` date NOT NULL default '0000-00-00',
  PRIMARY KEY  (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- 
-- Дамп данных таблицы `o_person`
-- 


-- --------------------------------------------------------

-- 
-- Структура таблицы `o_phone`
-- 

CREATE TABLE `o_phone` (
  `id` int(32) NOT NULL auto_increment,
  `country` int(4) NOT NULL default '0',
  `area` int(5) NOT NULL default '0',
  `number` int(11) default NULL,
  `is_cellular` tinyint(1) NOT NULL default '0',
  `is_fax` tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- 
-- Дамп данных таблицы `o_phone`
-- 


-- --------------------------------------------------------

-- 
-- Структура таблицы `o_project`
-- 

CREATE TABLE `o_project` (
  `id` int(32) NOT NULL auto_increment,
  `title` varchar(255) collate utf8_unicode_ci NOT NULL default '',
  `type` int(4) NOT NULL default '0',
  `description` text collate utf8_unicode_ci NOT NULL,
  `state` int(1) NOT NULL default '0',
  `tmark` datetime NOT NULL default '0000-00-00 00:00:00',
  `tchangestate` datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=14 ;

-- 
-- Дамп данных таблицы `o_project`
-- 

INSERT INTO `o_project` (`id`, `title`, `type`, `description`, `state`, `tmark`, `tchangestate`) VALUES 
(1, 'WFlow', 1, 'Система управления проектами и документооборотом', 2, '2007-07-09 13:25:28', '2007-07-11 15:53:41'),
(2, 'WFlow 2', 1, 'Система управления проектами и документооборотом', 2, '0000-00-00 00:00:00', '2007-07-11 18:14:50'),
(3, 'WFlow 3', 1, 'Система управления проектами и документооборотом', 3, '0000-00-00 00:00:00', '2007-07-11 18:14:52'),
(4, 'WFlow 4', 1, 'Система управления проектами и документооборотом', 4, '0000-00-00 00:00:00', '2007-07-11 18:14:54'),
(5, 'Робота началась', 3, 'Правда непонятно над чем...', 5, '0000-00-00 00:00:00', '2007-07-11 18:14:55'),
(6, '123', 1, '123', 6, '0000-00-00 00:00:00', '2007-07-11 18:14:55'),
(7, 'WFlow 5', 1, 'Система управления проектами и документооборотом', 3, '0000-00-00 00:00:00', '2007-07-11 16:47:45'),
(8, '123', 1, '456', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(9, 'WFlow 56', 1, 'Система управления проектами и документооборотом', 5, '0000-00-00 00:00:00', '2007-07-11 18:16:08'),
(10, '213', 1, '123213', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(11, '123', 2, '123', 4, '0000-00-00 00:00:00', '2007-07-11 17:35:43'),
(12, '432', 4, '123', 0, '2007-07-11 17:09:24', '0000-00-00 00:00:00'),
(13, 'Сурьезный консалтинг', 4, '1233', 5, '2007-07-11 17:09:24', '2007-07-13 11:47:41');

-- --------------------------------------------------------

-- 
-- Структура таблицы `o_record`
-- 

CREATE TABLE `o_record` (
  `id` int(32) NOT NULL auto_increment,
  `title` varchar(255) collate utf8_unicode_ci NOT NULL default '',
  `filename` varchar(255) collate utf8_unicode_ci NOT NULL default '',
  `comment` text collate utf8_unicode_ci NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=6 ;

-- 
-- Дамп данных таблицы `o_record`
-- 

INSERT INTO `o_record` (`id`, `title`, `filename`, `comment`) VALUES 
(1, 'Everlast', 'data/record/01-Whitey.mp3', ''),
(2, 'Everlast', 'data/record/05._MORSKAYA.mp3', ''),
(3, '3123123', 'data/record/03._NOCHI_V_STILE_BUGI_-_2.mp3', ''),
(4, '3123123', 'data/record/02._NOCHI_V_STILE_BUGI.mp3', ''),
(5, '3123123123123', 'data/record/12072007173150_02._NOCHI_V_STILE_BUGI.mp3', '');

-- --------------------------------------------------------

-- 
-- Структура таблицы `o_task`
-- 

CREATE TABLE `o_task` (
  `id` int(32) NOT NULL auto_increment,
  `type` int(8) NOT NULL default '0',
  `title` varchar(255) collate utf8_unicode_ci NOT NULL default '',
  `description` text collate utf8_unicode_ci NOT NULL,
  `pc` int(3) NOT NULL default '0',
  `tmark` datetime NOT NULL default '0000-00-00 00:00:00',
  `deadline` date NOT NULL default '0000-00-00',
  PRIMARY KEY  (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=27 ;

-- 
-- Дамп данных таблицы `o_task`
-- 

INSERT INTO `o_task` (`id`, `type`, `title`, `description`, `pc`, `tmark`, `deadline`) VALUES 
(1, 1, 'Добить HCP', 'Начать и закончить', 42, '2007-07-09 13:29:17', '2007-07-10'),
(2, 1, '1324', '134', 23, '2007-07-11 16:51:27', '2007-07-20'),
(3, 1, '123', '123', 14, '2007-07-11 17:13:36', '2007-07-12'),
(4, 1, '123', '213', 100, '2007-07-11 17:13:59', '2007-07-12'),
(5, 1, '123', '', 100, '2007-07-11 17:14:21', '2007-07-29'),
(6, 1, '123', '3123123213', 100, '2007-07-11 17:14:39', '2007-07-29'),
(7, 1, 'Добить HCP', '', 92, '2007-07-12 18:22:29', '2007-07-10'),
(8, 1, 'Добить HCP', 'asdasdasdsa', 92, '2007-07-12 18:22:54', '2007-07-10'),
(9, 1, 'Добить HCP', '', 50, '2007-07-12 18:23:17', '2007-07-10'),
(10, 1, 'Добить HCP', '', 64, '2007-07-12 18:29:03', '2007-07-10'),
(11, 1, 'Добить HCP', '', 48, '2007-07-12 18:30:58', '2007-07-10'),
(12, 1, 'Добить HCP', '', 63, '2007-07-12 18:40:22', '2007-07-10'),
(13, 1, 'Добить HCP', '', 79, '2007-07-12 18:41:25', '2007-07-10'),
(14, 1, 'Добить HCP', '', 88, '2007-07-12 18:43:08', '2007-07-10'),
(15, 1, 'Добить HCP', '', 77, '2007-07-12 18:43:41', '2007-07-10'),
(16, 1, 'Добить HCP', '', 39, '2007-07-12 18:44:46', '2007-07-10'),
(17, 1, 'Добить HCP', '', 81, '2007-07-12 18:45:51', '2007-07-10'),
(18, 1, 'Добить HCP', '', 50, '2007-07-12 18:46:49', '2007-07-10'),
(19, 1, 'Добить HCP', '', 28, '2007-07-12 18:48:11', '2007-07-10'),
(20, 1, 'Добить HCP', '', 42, '2007-07-12 18:49:41', '2007-07-10'),
(21, 1, 'Добить HCP', '', 52, '2007-07-12 18:50:52', '2007-07-10'),
(22, 1, 'Добить HCP', '', 65, '2007-07-12 18:52:25', '2007-07-10'),
(23, 1, 'Добить HCP', '', 74, '2007-07-12 18:52:43', '2007-07-10'),
(24, 1, 'Добить HCP', '', 82, '2007-07-12 18:52:49', '2007-07-10'),
(25, 1, 'Добить HCP', '', 43, '2007-07-13 11:47:56', '2007-07-10'),
(26, 1, '123', '', 53, '2007-07-13 18:11:02', '2007-07-29');

-- --------------------------------------------------------

-- 
-- Структура таблицы `s_classes`
-- 

CREATE TABLE `s_classes` (
  `id` varchar(64) collate utf8_unicode_ci NOT NULL default '',
  `title` varchar(255) collate utf8_unicode_ci NOT NULL default '',
  `priority` int(8) NOT NULL default '0',
  `npp` int(4) NOT NULL default '5',
  `ppp` int(11) NOT NULL default '10',
  PRIMARY KEY  (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- 
-- Дамп данных таблицы `s_classes`
-- 

INSERT INTO `s_classes` (`id`, `title`, `priority`, `npp`, `ppp`) VALUES 
('project', 'Проект', 0, 5, 10),
('file', 'Файл', 3, 5, 10),
('image', 'Изображение', 4, 5, 10),
('note', 'Пометка', 12, 5, 10),
('folder', 'Папка', 1, 5, 10),
('company', 'Компания', 10, 5, 10),
('person', 'Персона', 11, 5, 10),
('task', 'Задача', 6, 5, 10),
('record', 'Аудиозапись', 7, 5, 10),
('address', 'Адрес', 20, 5, 10),
('phone', 'Телефон', 21, 5, 10),
('bill', 'Банковский счет', 22, 5, 10);

-- --------------------------------------------------------

-- 
-- Структура таблицы `s_objects`
-- 

CREATE TABLE `s_objects` (
  `id` int(32) NOT NULL auto_increment,
  `pid` int(32) NOT NULL default '0',
  `vid` int(32) NOT NULL default '0',
  `class` varchar(64) collate utf8_unicode_ci NOT NULL default '',
  `link` int(32) NOT NULL default '0',
  `version` int(8) NOT NULL default '0',
  `tmark` datetime NOT NULL default '0000-00-00 00:00:00',
  `user` varchar(16) collate utf8_unicode_ci NOT NULL default '0',
  `enable` tinyint(1) NOT NULL default '0',
  `title` varchar(255) collate utf8_unicode_ci NOT NULL default '',
  PRIMARY KEY  (`id`),
  KEY `pid` (`pid`),
  KEY `enable` (`enable`),
  KEY `vid` (`vid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=85 ;

-- 
-- Дамп данных таблицы `s_objects`
-- 

INSERT INTO `s_objects` (`id`, `pid`, `vid`, `class`, `link`, `version`, `tmark`, `user`, `enable`, `title`) VALUES 
(1, 0, 0, 'project', 1, 1, '2007-07-09 13:25:28', 'mkrentovskiy', 0, 'Проект: WFlow'),
(2, 0, 0, 'folder', 1, 1, '2007-07-09 13:26:17', 'mkrentovskiy', 0, 'Папка: Все проекты'),
(3, 0, 0, 'file', 1, 1, '2007-07-09 13:27:20', 'mkrentovskiy', 1, 'Файл: Доклад с kernel.org'),
(4, 0, 0, 'task', 1, 1, '2007-07-09 13:29:17', 'mkrentovskiy', 0, 'Задача: '),
(5, 0, 0, 'note', 1, 1, '2007-07-09 13:32:50', 'mkrentovskiy', 0, ''),
(6, 0, 1, 'project', 2, 2, '2007-07-11 15:58:52', 'mkrentovskiy', 0, 'Проект: WFlow 2'),
(7, 0, 6, 'project', 3, 3, '2007-07-11 16:05:36', 'mkrentovskiy', 0, 'Проект: WFlow 3'),
(8, 0, 7, 'project', 4, 4, '2007-07-11 16:06:01', 'mkrentovskiy', 0, 'Проект: WFlow 4'),
(9, 0, 8, 'project', 7, 5, '2007-07-11 16:26:13', 'mkrentovskiy', 0, 'Проект: WFlow 5'),
(10, 0, 2, 'folder', 2, 2, '2007-07-11 16:26:48', 'mkrentovskiy', 0, 'Папка: Все проекты'),
(11, 0, 10, 'folder', 3, 3, '2007-07-11 16:27:07', 'mkrentovskiy', 0, 'Папка: Не все проекты'),
(12, 0, 11, 'folder', 4, 4, '2007-07-11 16:29:57', 'mkrentovskiy', 0, 'Папка: Не все проекты'),
(13, 0, 12, 'folder', 5, 5, '2007-07-11 16:30:28', 'mkrentovskiy', 0, 'Папка: Не все проекты'),
(14, 0, 13, 'folder', 8, 6, '2007-07-11 16:38:16', 'mkrentovskiy', 0, 'Папка: Не все проекты'),
(15, 0, 14, 'folder', 9, 7, '2007-07-11 16:39:11', 'mkrentovskiy', 0, 'Папка: Не все проекты'),
(16, 0, 15, 'folder', 10, 8, '2007-07-11 16:39:20', 'mkrentovskiy', 0, 'Папка: Не все проекты'),
(17, 0, 16, 'folder', 11, 9, '2007-07-11 16:39:44', 'mkrentovskiy', 0, 'Папка: Не все проекты'),
(18, 0, 17, 'folder', 12, 10, '2007-07-11 16:40:11', 'mkrentovskiy', 0, 'Папка: Не все проекты'),
(19, 0, 18, 'folder', 13, 11, '2007-07-11 16:40:16', 'mkrentovskiy', 0, 'Папка: Не все проекты'),
(20, 0, 19, 'folder', 14, 12, '2007-07-11 16:40:21', 'mkrentovskiy', 1, 'Папка: Не все проекты'),
(21, 0, 9, 'project', 9, 6, '2007-07-11 16:47:54', 'mkrentovskiy', 1, 'Проект: WFlow 56'),
(22, 0, 0, 'project', 11, 1, '2007-07-11 17:05:06', 'mkrentovskiy', 1, 'Проект: 123'),
(23, 0, 0, 'project', 12, 1, '2007-07-11 17:09:24', 'mkrentovskiy', 0, 'Проект: 432'),
(24, 0, 23, 'project', 13, 2, '2007-07-11 17:10:06', 'mkrentovskiy', 1, 'Проект: Сурьезный консалтинг'),
(25, 20, 23, 'project', 13, 2, '2007-07-11 17:11:27', 'mkrentovskiy', 1, 'Проект: Сурьезный консалтинг'),
(26, 25, 0, 'task', 3, 1, '2007-07-11 17:13:36', 'mkrentovskiy', 0, 'Задача: '),
(27, 25, 26, 'task', 4, 2, '2007-07-11 17:13:59', 'mkrentovskiy', 0, 'Задача: '),
(28, 25, 27, 'task', 5, 3, '2007-07-11 17:14:21', 'mkrentovskiy', 0, 'Задача: '),
(29, 25, 28, 'task', 6, 4, '2007-07-11 17:14:39', 'mkrentovskiy', 0, 'Задача: '),
(30, 0, 0, 'note', 2, 1, '2007-07-11 17:17:57', 'mkrentovskiy', 0, ''),
(31, 0, 0, 'file', 2, 1, '2007-07-12 12:56:38', 'mkrentovskiy', 1, 'Файл: 123'),
(32, 0, 0, 'file', 3, 1, '2007-07-12 12:57:23', 'mkrentovskiy', 1, 'Файл: 12'),
(33, 0, 0, 'file', 4, 1, '2007-07-12 13:15:17', 'mkrentovskiy', 1, 'Файл: 123'),
(34, 0, 0, 'file', 5, 1, '2007-07-12 13:22:32', 'mkrentovskiy', 1, 'Файл: 12'),
(35, 0, 0, 'file', 6, 1, '2007-07-12 13:23:45', 'mkrentovskiy', 1, 'Файл: 12'),
(36, 0, 0, 'file', 7, 1, '2007-07-12 13:39:54', 'mkrentovskiy', 1, 'Файл: 321'),
(37, 0, 0, 'file', 8, 1, '2007-07-12 13:44:13', 'mkrentovskiy', 1, 'Файл: qwe'),
(38, 0, 0, 'file', 9, 1, '2007-07-12 13:47:37', 'mkrentovskiy', 1, 'Файл: asd'),
(39, 0, 0, 'file', 10, 1, '2007-07-12 13:50:27', 'mkrentovskiy', 1, 'Файл: 123'),
(40, 0, 0, 'image', 1, 1, '2007-07-12 13:53:55', 'mkrentovskiy', 1, 'Изображение: logo'),
(41, 0, 0, 'file', 11, 1, '2007-07-12 14:34:32', 'mkrentovskiy', 0, 'Файл: 123'),
(42, 0, 0, 'file', 12, 1, '2007-07-12 14:35:47', 'mkrentovskiy', 0, 'Файл: ячсцуацуасцу'),
(43, 0, 42, 'file', 13, 2, '2007-07-12 14:50:06', 'mkrentovskiy', 0, 'Файл: ячсцуацуасцу'),
(44, 0, 43, 'file', 14, 3, '2007-07-12 14:50:17', 'mkrentovskiy', 1, 'Файл: ячсророро'),
(45, 0, 41, 'file', 15, 2, '2007-07-12 16:33:27', 'mkrentovskiy', 1, 'Файл: vxzcvzcxv'),
(46, 0, 0, 'image', 2, 1, '2007-07-12 16:42:24', 'mkrentovskiy', 0, 'Изображение: 312312312'),
(47, 0, 46, 'image', 3, 2, '2007-07-12 16:42:43', 'mkrentovskiy', 0, 'Изображение: 312312312'),
(48, 0, 47, 'image', 4, 3, '2007-07-12 16:43:01', 'mkrentovskiy', 0, 'Изображение: 312312312'),
(49, 0, 48, 'image', 5, 4, '2007-07-12 16:43:07', 'mkrentovskiy', 1, 'Изображение: 312312312'),
(50, 0, 0, 'record', 1, 1, '2007-07-12 16:57:36', 'mkrentovskiy', 0, 'Запись: Everlast'),
(51, 0, 50, 'record', 2, 2, '2007-07-12 17:02:28', 'mkrentovskiy', 1, 'Запись: Everlast'),
(52, 0, 0, 'record', 3, 1, '2007-07-12 17:03:51', 'mkrentovskiy', 0, 'Запись: 3123123'),
(53, 0, 52, 'record', 4, 2, '2007-07-12 17:04:21', 'mkrentovskiy', 1, 'Запись: 3123123'),
(54, 0, 0, 'file', 16, 1, '2007-07-12 17:15:49', 'mkrentovskiy', 1, 'Файл: 1vvfdvsdv'),
(55, 0, 0, 'file', 16, 1, '2007-07-12 17:16:50', 'mkrentovskiy', 1, 'Файл: 1vvfdvsdv'),
(56, 0, 0, 'file', 16, 1, '2007-07-12 17:18:12', 'mkrentovskiy', 0, 'Файл: 1vvfdvsdv'),
(57, 0, 0, 'file', 19, 1, '2007-07-12 17:21:39', 'mkrentovskiy', 1, 'Файл: Budjet'),
(58, 0, 0, 'file', 20, 1, '2007-07-12 17:25:33', 'mkrentovskiy', 1, 'Файл: 32423423'),
(59, 0, 0, 'record', 5, 1, '2007-07-12 17:31:50', 'mkrentovskiy', 1, 'Запись: 3123123123123'),
(60, 0, 0, 'image', 6, 1, '2007-07-12 17:34:33', 'mkrentovskiy', 0, 'Изображение: 312312'),
(61, 0, 60, 'image', 7, 2, '2007-07-12 17:34:47', 'mkrentovskiy', 1, 'Изображение: 312312'),
(62, 0, 4, 'task', 7, 2, '2007-07-12 18:22:29', 'mkrentovskiy', 0, 'Задача: '),
(63, 0, 62, 'task', 8, 3, '2007-07-12 18:22:54', 'mkrentovskiy', 0, 'Задача: '),
(64, 0, 63, 'task', 9, 4, '2007-07-12 18:23:17', 'mkrentovskiy', 0, 'Задача: '),
(65, 0, 64, 'task', 10, 5, '2007-07-12 18:29:03', 'mkrentovskiy', 0, 'Задача: '),
(66, 0, 65, 'task', 11, 6, '2007-07-12 18:30:58', 'mkrentovskiy', 0, 'Задача: '),
(67, 0, 66, 'task', 12, 7, '2007-07-12 18:40:22', 'mkrentovskiy', 0, 'Задача: '),
(68, 0, 67, 'task', 13, 8, '2007-07-12 18:41:25', 'mkrentovskiy', 0, 'Задача: '),
(69, 0, 68, 'task', 14, 9, '2007-07-12 18:43:08', 'mkrentovskiy', 0, 'Задача: '),
(70, 0, 69, 'task', 15, 10, '2007-07-12 18:43:41', 'mkrentovskiy', 0, 'Задача: '),
(71, 0, 70, 'task', 16, 11, '2007-07-12 18:44:46', 'mkrentovskiy', 0, 'Задача: '),
(72, 0, 71, 'task', 17, 12, '2007-07-12 18:45:51', 'mkrentovskiy', 0, 'Задача: '),
(73, 0, 72, 'task', 18, 13, '2007-07-12 18:46:49', 'mkrentovskiy', 0, 'Задача: '),
(74, 0, 73, 'task', 19, 14, '2007-07-12 18:48:11', 'mkrentovskiy', 0, 'Задача: '),
(75, 0, 74, 'task', 20, 15, '2007-07-12 18:49:41', 'mkrentovskiy', 0, 'Задача: '),
(76, 0, 75, 'task', 21, 16, '2007-07-12 18:50:52', 'mkrentovskiy', 0, 'Задача: '),
(77, 0, 76, 'task', 22, 17, '2007-07-12 18:52:25', 'mkrentovskiy', 0, 'Задача: '),
(78, 0, 77, 'task', 23, 18, '2007-07-12 18:52:43', 'mkrentovskiy', 0, 'Задача: '),
(79, 0, 78, 'task', 24, 19, '2007-07-12 18:52:49', 'mkrentovskiy', 0, 'Задача: '),
(80, 0, 79, 'task', 25, 20, '2007-07-13 11:47:56', 'mkrentovskiy', 1, 'Задача: '),
(81, 0, 5, 'note', 3, 2, '2007-07-13 11:48:37', 'mkrentovskiy', 1, ''),
(82, 0, 56, 'file', 21, 2, '2007-07-13 11:49:59', 'mkrentovskiy', 0, 'Файл: 1vvfdvsdv'),
(83, 0, 82, 'file', 21, 3, '2007-07-13 11:50:01', 'mkrentovskiy', 1, 'Файл: 1vvfdvsdv'),
(84, 25, 29, 'task', 26, 5, '2007-07-13 18:11:02', 'mkrentovskiy', 0, 'Задача: ');

-- --------------------------------------------------------

-- 
-- Структура таблицы `s_scheduler`
-- 

CREATE TABLE `s_scheduler` (
  `id` int(32) NOT NULL auto_increment,
  `tmark` datetime NOT NULL,
  `user` char(16) collate utf8_unicode_ci NOT NULL,
  `task` varchar(255) collate utf8_unicode_ci NOT NULL,
  `comment` text collate utf8_unicode_ci NOT NULL,
  `area` smallint(1) NOT NULL default '0',
  `object` blob NOT NULL,
  `is_done` tinyint(1) unsigned NOT NULL default '0',
  PRIMARY KEY  (`id`),
  KEY `tmark` (`tmark`),
  KEY `area` (`area`,`is_done`),
  KEY `user` (`user`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

-- 
-- Дамп данных таблицы `s_scheduler`
-- 

INSERT INTO `s_scheduler` (`id`, `tmark`, `user`, `task`, `comment`, `area`, `object`, `is_done`) VALUES 
(1, '2007-07-20 16:29:35', 'mkrentovskiy', 'Пакет документов', 'для Интерэнерго', 1, '', 0),
(2, '2007-07-20 16:30:22', 'mkrentovskiy', 'Просроченное задание', '', 1, '', 2);

-- --------------------------------------------------------

-- 
-- Структура таблицы `s_sections`
-- 

CREATE TABLE `s_sections` (
  `name` varchar(32) collate utf8_unicode_ci NOT NULL default '',
  `title` varchar(128) collate utf8_unicode_ci default '',
  `enable` tinyint(1) default '0',
  PRIMARY KEY  (`name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- 
-- Дамп данных таблицы `s_sections`
-- 

INSERT INTO `s_sections` (`name`, `title`, `enable`) VALUES 
('users', 'Пользователи', 1);

-- --------------------------------------------------------

-- 
-- Структура таблицы `s_sections_objects`
-- 

CREATE TABLE `s_sections_objects` (
  `section` char(32) collate utf8_unicode_ci NOT NULL default '',
  `object` int(32) NOT NULL default '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- 
-- Дамп данных таблицы `s_sections_objects`
-- 


-- --------------------------------------------------------

-- 
-- Структура таблицы `s_sections_usecases`
-- 

CREATE TABLE `s_sections_usecases` (
  `section` char(32) collate utf8_unicode_ci NOT NULL default '',
  `usecase` char(128) collate utf8_unicode_ci NOT NULL default '',
  KEY `i_section` (`section`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- 
-- Дамп данных таблицы `s_sections_usecases`
-- 

INSERT INTO `s_sections_usecases` (`section`, `usecase`) VALUES 
('users', 'ucstart'),
('users', 'uclogout'),
('users', 'ucaddobject'),
('users', 'ucsetprojectstate'),
('users', 'ucshowobjectstree'),
('users', 'ucshowclassaddform'),
('users', 'uccommititem'),
('users', 'ucshowcontrolform'),
('users', 'ucuploadfile'),
('users', 'ucshowobjectitem'),
('users', 'ucdeleteobjectitem'),
('users', 'uccopyobjectitem'),
('users', 'ucshowdocuments'),
('users', 'ucshowfinances'),
('users', 'ucmovetask'),
('users', 'ucremovetask'),
('users', 'ucshowdocumentitem'),
('users', 'ucexecutetaskitem');

-- --------------------------------------------------------

-- 
-- Структура таблицы `s_usecases`
-- 

CREATE TABLE `s_usecases` (
  `name` char(128) collate utf8_unicode_ci NOT NULL default '',
  `title` char(255) collate utf8_unicode_ci default '',
  PRIMARY KEY  (`name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- 
-- Дамп данных таблицы `s_usecases`
-- 

INSERT INTO `s_usecases` (`name`, `title`) VALUES 
('ucstart', 'Начальная страница'),
('uclogout', 'Выход из системы'),
('ucshowobjectstree', 'Показать дерево объектов'),
('ucsetprojectstate', 'Установить состояние для проекта'),
('ucaddobject', 'Добавить объект'),
('ucshowclassaddform', 'Показать форму для добавления'),
('ucadddictionaryset', 'Добавить значение в справочник'),
('ucgetcontrolform', 'Получить панель управления объектом'),
('ucuploadfile', 'Закачать файл'),
('ucshowobjectitem', 'Показать объект'),
('ucdeleteobjectitem', 'Удалить объект'),
('uccopyobjectitem', 'Копирование объекта'),
('ucshowdocuments', 'Показать документы'),
('ucshowfinances', 'Показать финансы');

-- --------------------------------------------------------

-- 
-- Структура таблицы `s_users`
-- 

CREATE TABLE `s_users` (
  `login` char(16) collate utf8_unicode_ci NOT NULL default '',
  `passwd` char(64) collate utf8_unicode_ci default NULL,
  `enable` tinyint(1) default '0',
  `in_group` char(32) collate utf8_unicode_ci NOT NULL default '',
  `name` char(255) collate utf8_unicode_ci default NULL,
  `mail` char(128) collate utf8_unicode_ci default NULL,
  `tmark` datetime default NULL,
  `phone` char(64) collate utf8_unicode_ci default NULL,
  PRIMARY KEY  (`login`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- 
-- Дамп данных таблицы `s_users`
-- 

INSERT INTO `s_users` (`login`, `passwd`, `enable`, `in_group`, `name`, `mail`, `tmark`, `phone`) VALUES 
('mkrentovskiy', '51f6bca6a506aa881576efd185edc7cc', 1, 'users', 'Максим Крентовский', 'mkrentovskiy@gmail.com', '2006-11-23 01:57:39', '+7 (4872) 38-40-68');
