-- phpMyAdmin SQL Dump
-- version 4.2.5
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Время создания: Янв 05 2017 г., 10:10
-- Версия сервера: 5.7.15-log
-- Версия PHP: 5.6.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `simple-blog`
--

-- --------------------------------------------------------

--
-- Структура таблицы `author`
--

CREATE TABLE IF NOT EXISTS `author` (
`author_id` int(11) NOT NULL,
  `name` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=3 ;

--
-- Дамп данных таблицы `author`
--

INSERT INTO `author` (`author_id`, `name`) VALUES
(1, 'Lugano'),
(2, 'Picazzo');

-- --------------------------------------------------------

--
-- Структура таблицы `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
`comment_id` int(11) NOT NULL,
  `text` text COLLATE utf8_bin NOT NULL,
  `author_id` int(11) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=8 ;

--
-- Дамп данных таблицы `comments`
--

INSERT INTO `comments` (`comment_id`, `text`, `author_id`) VALUES
(1, 'First comment for news Test', 1),
(2, 'Second coments for news Test', 1),
(4, 'This is third comment', 1),
(5, 'This is first comment', 2),
(6, 'Comment for record', 1),
(7, '<script type=\\"text/javascript\\">alert(\\''Hello\\'');</script>', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `news`
--

CREATE TABLE IF NOT EXISTS `news` (
`news_id` int(11) NOT NULL,
  `text` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `author_id` int(11) NOT NULL,
  `date_added` datetime NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=6 ;

--
-- Дамп данных таблицы `news`
--

INSERT INTO `news` (`news_id`, `text`, `author_id`, `date_added`) VALUES
(1, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dicta ex ipsam id possimus, expedita facilis, at amet tempora perferendis porro ea explicabo accusamus ut. Consequatur sunt fugiat minus, eveniet natus.Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dicta ex ipsam id possimus, expedita facilis, at amet tempora perferendis porro ea explicabo accusamus ut. Consequatur sunt fugiat minus, eveniet natus.Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dicta ex ipsam id possimus, expedita facilis, at amet tempora perferendis porro ea explicabo accusamus ut. Consequatur sunt fugiat minus, eveniet natus.', 1, '0000-00-00 00:00:00'),
(2, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dicta ex ipsam id possimus, expedita facilis, at amet tempora perferendis porro ea explicabo accusamus ut. Consequatur sunt fugiat minus, eveniet natus.Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dicta ex ipsam id possimus, expedita facilis, at amet tempora perferendis porro ea explicabo accusamus ut. Consequatur sunt fugiat minus, eveniet natus.Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dicta ex ipsam id possimus, expedita facilis, at amet tempora perferendis porro ea explicabo accusamus ut. Consequatur sunt fugiat minus, eveniet natus.', 1, '2017-01-03 19:23:22'),
(3, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dicta ex ipsam id possimus, expedita facilis, at amet tempora perferendis porro ea explicabo accusamus ut. Consequatur sunt fugiat minus, eveniet natus.Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dicta ex ipsam id possimus, expedita facilis, at amet tempora perferendis porro ea explicabo accusamus ut. Consequatur sunt fugiat minus, eveniet natus.Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dicta ex ipsam id possimus, expedita facilis, at amet tempora perferendis porro ea explicabo accusamus ut. Consequatur sunt fugiat minus, eveniet natus.', 1, '2017-01-03 23:32:28'),
(4, 'Just a new record without any reason', 1, '2017-01-04 13:33:28'),
(5, 'Excellent news about new year and Christmas', 2, '2017-01-04 18:58:37');

-- --------------------------------------------------------

--
-- Структура таблицы `news_comment`
--

CREATE TABLE IF NOT EXISTS `news_comment` (
  `news_id` int(11) NOT NULL,
  `comment_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Дамп данных таблицы `news_comment`
--

INSERT INTO `news_comment` (`news_id`, `comment_id`) VALUES
(1, 1),
(1, 2),
(1, 4),
(3, 5),
(4, 6),
(4, 7);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `author`
--
ALTER TABLE `author`
 ADD PRIMARY KEY (`author_id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
 ADD PRIMARY KEY (`comment_id`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
 ADD PRIMARY KEY (`news_id`);

--
-- Indexes for table `news_comment`
--
ALTER TABLE `news_comment`
 ADD PRIMARY KEY (`comment_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `author`
--
ALTER TABLE `author`
MODIFY `author_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
MODIFY `news_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
