-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Июн 30 2024 г., 17:52
-- Версия сервера: 8.0.30
-- Версия PHP: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `Izdeliya`
--

-- --------------------------------------------------------

--
-- Структура таблицы `Izdeliya`
--

CREATE TABLE `Izdeliya` (
  `ID` int NOT NULL,
  `Naimenovanie` varchar(255) NOT NULL,
  `Kolichestvo_detaley` int NOT NULL,
  `Trudoemkost` decimal(10,2) NOT NULL,
  `Stoimost` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `Izdeliya`
--

INSERT INTO `Izdeliya` (`ID`, `Naimenovanie`, `Kolichestvo_detaley`, `Trudoemkost`, `Stoimost`) VALUES
('Стол', 50, 20.50, 10000.00),
('Стул', 20, 5.00, 2500.00),
('Шкаф', 100, 50.00, 20000.00),
('Кровать', 80, 30.00, 15000.00),
('Полка', 10, 2.00, 1000.00),
('Комод', 60, 25.00, 8000.00),
('Диван', 150, 40.00, 18000.00),
('Стеллаж', 30, 10.00, 5000.00),
('Тумбочка', 15, 4.00, 3000.00),
('Кресло', 25, 8.00, 7000.00);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `Izdeliya`
--
ALTER TABLE `Izdeliya`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `Izdeliya`
--
ALTER TABLE `Izdeliya`
  MODIFY `ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
