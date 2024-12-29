-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Окт 24 2024 г., 15:38
-- Версия сервера: 10.4.32-MariaDB
-- Версия PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `e-commerce-test`
--

-- --------------------------------------------------------

--
-- Структура таблицы `auth-data`
--

CREATE TABLE `auth-data` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `auth-data`
--

INSERT INTO `auth-data` (`id`, `username`, `password`) VALUES
(1, 'kamal1305', 'kamal123');

-- --------------------------------------------------------

--
-- Структура таблицы `dashboard_data`
--

CREATE TABLE `dashboard_data` (
  `id` int(6) UNSIGNED NOT NULL,
  `imageUrl` varchar(255) NOT NULL,
  `Title` varchar(255) NOT NULL,
  `Description` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `dashboard_data`
--

INSERT INTO `dashboard_data` (`id`, `imageUrl`, `Title`, `Description`) VALUES
(1, 'https://gratisography.com/wp-content/uploads/2024/03/gratisography-funflower-800x525.jpg', 'Flower', 'the beautiful flower'),
(90, 'https://letsenhasance.io/static/03620c83508fc72c6d2b218c7e304ba5/11499/UpscalerAfter.jpg.......', 'Girl', 'A beautiful girl'),
(130, 'sas', 'asas', 'asa'),
(195, 'as', 'KAMAL', 'sasa'),
(197, 'as', 'sasa', 'sasa'),
(198, 'as', 'sasa', 'sasa12121'),
(200, 'as', 'sasa', 'sasa'),
(202, 'KAMAL', 'KAMAL', 'KAMAL'),
(262, 'asa', 'sas', 'sasas'),
(263, 'asasasasas', 'sasasas', 'sasasasasasa'),
(264, '12', '12', '12'),
(265, '12', '1212', '1');

-- --------------------------------------------------------

--
-- Структура таблицы `navbar-items`
--

CREATE TABLE `navbar-items` (
  `id` int(11) NOT NULL,
  `path_name` text NOT NULL,
  `path` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `navbar-items`
--

INSERT INTO `navbar-items` (`id`, `path_name`, `path`) VALUES
(1, 'Home', '/php-prj'),
(2, 'About', '/php-prj/views/about.view.php'),
(3, 'Dashboard', '/php-prj/views/dashboard.view.php');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `auth-data`
--
ALTER TABLE `auth-data`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `dashboard_data`
--
ALTER TABLE `dashboard_data`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `navbar-items`
--
ALTER TABLE `navbar-items`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `auth-data`
--
ALTER TABLE `auth-data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `dashboard_data`
--
ALTER TABLE `dashboard_data`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=266;

--
-- AUTO_INCREMENT для таблицы `navbar-items`
--
ALTER TABLE `navbar-items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
