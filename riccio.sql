-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1
-- Время создания: Янв 11 2015 г., 17:35
-- Версия сервера: 5.5.25
-- Версия PHP: 5.3.13

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `riccio`
--

-- --------------------------------------------------------

--
-- Структура таблицы `article`
--

CREATE TABLE IF NOT EXISTS `article` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `alias` varchar(128) NOT NULL,
  `title` varchar(256) NOT NULL,
  `keywords` varchar(256) NOT NULL,
  `description` varchar(256) NOT NULL,
  `content` varchar(4096) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `alias` (`alias`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Дамп данных таблицы `article`
--

INSERT INTO `article` (`id`, `alias`, `title`, `keywords`, `description`, `content`) VALUES
(1, 'riccio', 'Первая страница', 'ежик, колючий, ключевые слова', 'Ох уж эти ежи!', 'Обыкновенный ёж — животное небольших размеров. Длина его тела составляет 20—30 см,  хвоста — около 3 см,[3] масса тела — 700—800 г.[4] Уши относительно небольшие  (обычно меньше 3,5 см). Морда вытянутая. Нос у животного острый и постоянно влажный.  У обыкновенных ежей, обитающих на Кипре, уши более крупные.[5] На верхней челюсти у  ежей 20 мелких острых зубов, а на нижней — 16. Верхние резцы широко расставлены, оставляя  место для прикуса нижним резцам. Голова относительно крупная, клинообразная, со  слабоудлинённым лицевым отделом.[6] На лапах по 5 пальцев с острыми когтями. Задние  конечности более длинные, чем передние.[5] Иглы у обыкновенного ежа короткие, не более 3 см.  На голове иглы разделены на 2 части «пробором». Поверхность игл гладкая, окраска их слагается  чередованием буроватых и светлых поясков[7]. На спине, боках и голове иглы достигают в длину  2 см. Внутри они полые, наполненные воздухом. Растут иглы с такой же скоростью, как и волосы. '),
(2, 'snoe', 'Вторая о ежах', 'зеленый, красный, серый, фиолетовый, админ', 'Ох уж эти ежи!', 'Обыкновенный ёж — животное небольших размеров. Длина его тела составляет 20—30 см,  хвоста — около 3 см,[3] масса тела — 700—800 г.[4] Уши относительно небольшие  (обычно меньше 3,5 см). Морда вытянутая. Нос у животного острый и постоянно влажный.  У обыкновенных ежей, обитающих на Кипре, уши более крупные.[5] На верхней челюсти у  ежей 20 мелких острых зубов, а на нижней — 16. Верхние резцы широко расставлены, оставляя  место для прикуса нижним резцам. Голова относительно крупная, клинообразная, со  слабоудлинённым лицевым отделом.[6] На лапах по 5 пальцев с острыми когтями. Задние  конечности более длинные, чем передние.[5] Иглы у обыкновенного ежа короткие, не более 3 см.  На голове иглы разделены на 2 части «пробором». Поверхность игл гладкая, окраска их слагается  чередованием буроватых и светлых поясков[7]. На спине, боках и голове иглы достигают в длину  2 см. Внутри они полые, наполненные воздухом. Растут иглы с такой же скоростью, как и волосы. ');

-- --------------------------------------------------------

--
-- Структура таблицы `core`
--

CREATE TABLE IF NOT EXISTS `core` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(256) NOT NULL,
  `home` varchar(256) NOT NULL,
  `copy` varchar(256) NOT NULL,
  `theme` varchar(256) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Дамп данных таблицы `core`
--

INSERT INTO `core` (`id`, `title`, `home`, `copy`, `theme`) VALUES
(1, 'Riccio CMS', 'http://riccio/', '&copy Dimko 2012-2014', 'new');

-- --------------------------------------------------------

--
-- Структура таблицы `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(12) NOT NULL,
  `password` varchar(8) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `login` (`login`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Дамп данных таблицы `user`
--

INSERT INTO `user` (`id`, `login`, `password`) VALUES
(1, 'root', 'pswd'),
(2, 'dimkoqwe1', 'lolka');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
