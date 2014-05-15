-- phpMyAdmin SQL Dump
-- version 4.0.10
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Время создания: Май 15 2014 г., 20:36
-- Версия сервера: 5.5.37
-- Версия PHP: 5.3.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `zeleno`
--

-- --------------------------------------------------------

--
-- Структура таблицы `admin_users`
--

CREATE TABLE IF NOT EXISTS `admin_users` (
  `login` varchar(48) NOT NULL,
  `password` varchar(48) NOT NULL,
  `access` int(11) NOT NULL,
  `par` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `admin_users`
--

INSERT INTO `admin_users` (`login`, `password`, `access`, `par`) VALUES
('anton', 'b0baee9d279d34fa1dfd71aadb908c3f', 1, 2);

-- --------------------------------------------------------

--
-- Структура таблицы `photo`
--

CREATE TABLE IF NOT EXISTS `photo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `src` mediumtext NOT NULL,
  `desc` text NOT NULL,
  `title` mediumtext NOT NULL,
  `rang` int(11) NOT NULL,
  `usr` varchar(16) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=26 ;

--
-- Дамп данных таблицы `photo`
--

INSERT INTO `photo` (`id`, `src`, `desc`, `title`, `rang`, `usr`) VALUES
(1, 'foto1.jpg', 'описание 1 описание 1 описание 1', 'заголовок 1', 3, 'anton'),
(2, 'foto2.jpg', 'описание 2 описание 2 описание 2', 'заголовок 2', 2, 'anton'),
(3, 'foto3.jpg', 'описание 3 описание 3 описание 3', 'заголовок 3', 1, 'anton'),
(4, 'foto4.jpg', 'описание 4 описание 4 описание 4', 'ме<b>дfsgdfg</b>уза4', 5, 'anton'),
(5, 'foto5.jpg', 'описание 5 описание 5 описание 5', 'заголовок 5', 6, 'anton'),
(6, 'foto6.jpg', 'описание 6 описание 6 описание 6', 'заголовок 6', 4, 'anton'),
(25, '111111.jpg', '111111', '111111111', 7, 'anton');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
