-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Час створення: Лип 20 2023 р., 18:35
-- Версія сервера: 8.0.30
-- Версія PHP: 7.4.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База даних: `marcho`
--

-- --------------------------------------------------------

--
-- Структура таблиці `basket`
--

CREATE TABLE `basket` (
  `id` int NOT NULL,
  `id_product` int DEFAULT NULL,
  `name_user` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `size` varchar(255) DEFAULT NULL,
  `color` varchar(255) DEFAULT NULL,
  `number` int DEFAULT NULL,
  `sum` int DEFAULT NULL,
  `date` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Дамп даних таблиці `basket`
--

INSERT INTO `basket` (`id`, `id_product`, `name_user`, `email`, `phone`, `address`, `size`, `color`, `number`, `sum`, `date`) VALUES
(2, 1, 'phpprogect', 'oleg.khorobriv@gmail.com', '0936175819', 'Зарічна 7', 'XXL', 'Purple', 3, 87, '05-5-2023 9:04'),
(3, 1, 'phpprogect', 'oleg.khorobriv@gmail.com', '0936175819', 'Зарічна 7', 'XXL', 'Purple', 3, 87, '05-5-2023 9:08'),
(4, 3, 'phpprogect', 'oleg.khorobriv@gmail.com', '0936175819', 'Зарічна 7', 'L', 'Red', 2, 80, '06-5-2023 10:19'),
(5, 3, 'phpprogect', 'oleg.khorobriv@gmail.com', '0936175819', 'Зарічна 7', 'L', 'Red', 2, 80, '06-5-2023 10:46'),
(6, 1, 'phpprogect', 'oleg.khorobriv@gmail.com', '0936175819', 'Зарічна 7', 'L', 'Red', 3, 87, '06-5-2023 10:46'),
(7, 1, 'phpprogect', 'oleg.khorobriv@gmail.com', '0936175819', 'Зарічна 7', 'M', 'Red', 3, 87, '06-5-2023 10:48'),
(8, 1, 'phpprogect', 'oleg.khorobriv@gmail.com', '0936175819', 'Зарічна 7', 'XS', 'Green', 1, 29, '06-5-2023 10:50'),
(9, 1, 'phpprogect', 'oleg.khorobriv@gmail.com', '0936175819', 'Зарічна 7', 'L', 'Orange', 5, 145, '29-5-2023 19:01');

-- --------------------------------------------------------

--
-- Структура таблиці `category`
--

CREATE TABLE `category` (
  `id` int NOT NULL,
  `name_category` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Дамп даних таблиці `category`
--

INSERT INTO `category` (`id`, `name_category`) VALUES
(1, 'Woman'),
(2, 'Man'),
(3, 'Sale Products'),
(4, 'Fashion'),
(5, 'Hot Dresses'),
(6, 'Accessories');

-- --------------------------------------------------------

--
-- Структура таблиці `color`
--

CREATE TABLE `color` (
  `id` int NOT NULL,
  `color_html_name` varchar(255) DEFAULT NULL,
  `id_product` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Дамп даних таблиці `color`
--

INSERT INTO `color` (`id`, `color_html_name`, `id_product`) VALUES
(1, '00aeef', 1),
(2, 'f52574', 1),
(3, '24d4ac', 1),
(4, 'ff7e00', 1),
(5, '000', 1),
(6, '923899', 1),
(7, '00aeef', 2),
(8, 'f52574', 2),
(9, '24d4ac', 2),
(10, 'ff7e00', 2),
(12, '000', 2),
(13, '00aeef', 3),
(14, 'f52574', 3),
(15, '24d4ac', 3),
(17, 'f52574', 4),
(19, 'ff7e00', 4),
(20, '000', 4),
(21, '923899', 4),
(22, '00aeef', 5),
(23, 'f52574', 5),
(25, '000', 5),
(26, '00aeef', 6),
(27, 'f52574', 6);

-- --------------------------------------------------------

--
-- Структура таблиці `color_full`
--

CREATE TABLE `color_full` (
  `id` int NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `name_full` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Дамп даних таблиці `color_full`
--

INSERT INTO `color_full` (`id`, `name`, `name_full`) VALUES
(1, '000', 'Black'),
(2, '00aeef', 'Blue'),
(3, '24d4ac', 'Green'),
(4, '923899', 'Purple'),
(7, 'f52574', 'Red'),
(9, 'ff7e00', 'Orange');

-- --------------------------------------------------------

--
-- Структура таблиці `comments`
--

CREATE TABLE `comments` (
  `id` int NOT NULL,
  `name_user` varchar(255) DEFAULT NULL,
  `comments` text,
  `email_user` varchar(255) DEFAULT NULL,
  `star` varchar(10) DEFAULT NULL,
  `id_product` int DEFAULT NULL,
  `date` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Дамп даних таблиці `comments`
--

INSERT INTO `comments` (`id`, `name_user`, `comments`, `email_user`, `star`, `id_product`, `date`) VALUES
(42, 'Олег Журавський', 'Усмішка та доброзичливість можуть змінити день не лише нам, але й іншим людям.', 'oleg.khorobriv@gmail.com', '0', 1, '12-6-2023 9:06'),
(44, 'Олег', 'Кожен новий день відкриває перед нами безліч можливостей.', 'oleg.khorobriv@gmail.com', '4', 3, '12-6-2023 11:13'),
(45, 'Oleg', 'Все чудово', 'oleg.khorobriv@gmail.com', '5', 10, '27-6-2023 19:39'),
(46, 'Олег', 'Чудовий товар. Рекомендую !!!', 'oleg.khorobriv@gmail.com', '4', 1, '20-7-2023 10:49');

-- --------------------------------------------------------

--
-- Структура таблиці `images`
--

CREATE TABLE `images` (
  `id` int NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `id_product` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Дамп даних таблиці `images`
--

INSERT INTO `images` (`id`, `name`, `id_product`) VALUES
(1, '1.jpg', 1),
(2, '1.jpg', 1),
(3, '1.jpg', 1),
(4, '1.jpg', 1),
(5, '1.jpg', 1),
(6, '2.jpg', 2),
(7, '1.jpg', 2),
(8, '1.jpg', 2),
(9, '1.jpg', 2),
(10, '1.jpg', 2),
(11, '3.jpg', 3),
(12, '1.jpg', 3),
(13, '1.jpg', 3),
(14, '1.jpg', 3),
(15, '1.jpg', 3),
(16, '4.jpg', 4),
(17, '1.jpg', 4),
(18, '1.jpg', 4),
(19, '1.jpg', 4),
(20, '1.jpg', 4),
(21, '5.jpg', 5),
(22, '1.jpg', 5),
(23, '1.jpg', 5),
(24, '1.jpg', 5),
(25, '1.jpg', 5),
(26, '6.jpg', 6),
(27, '1.jpg', 6),
(28, '1.jpg', 6),
(29, '1.jpg', 6),
(30, '1.jpg', 6),
(31, '1.jpg', 7),
(32, '1.jpg', 7),
(33, '1.jpg', 7),
(34, '1.jpg', 7),
(35, '1.jpg', 7),
(36, '2.jpg', 8),
(37, '1.jpg', 8),
(38, '1.jpg', 8),
(39, '1.jpg', 8),
(40, '1.jpg', 8),
(41, '3.jpg', 9),
(42, '1.jpg', 9),
(43, '1.jpg', 9),
(44, '1.jpg', 9),
(45, '1.jpg', 9),
(46, '4.jpg', 10),
(47, '1.jpg', 10),
(48, '1.jpg', 10),
(49, '1.jpg', 10),
(50, '1.jpg', 10);

-- --------------------------------------------------------

--
-- Структура таблиці `product`
--

CREATE TABLE `product` (
  `id` int NOT NULL,
  `name_product` varchar(255) DEFAULT NULL,
  `price` int DEFAULT NULL,
  `sale` tinyint(1) DEFAULT NULL,
  `discount` int DEFAULT NULL,
  `description` text,
  `description_min` text,
  `id_category` int DEFAULT NULL,
  `unique_id` varchar(255) DEFAULT NULL,
  `sex` varchar(255) DEFAULT NULL,
  `star` int DEFAULT NULL,
  `img1` varchar(255) DEFAULT NULL,
  `search` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci,
  `date` date DEFAULT NULL,
  `views` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Дамп даних таблиці `product`
--

INSERT INTO `product` (`id`, `name_product`, `price`, `sale`, `discount`, `description`, `description_min`, `id_category`, `unique_id`, `sex`, `star`, `img1`, `search`, `date`, `views`) VALUES
(1, 'Embossed Packet Backpack1', 29, 1, 10, 'Genetic research has become increasingly popular in recent times. The information that can be obtained from DNA analysis can help in understanding our genetic makeup and may have practical applications in medicine and other fields. For example, genetic analysis can help to understand the risk of developing certain diseases and help in preventing their spread. Currently, through genetic research, family relationships can be established, such as determining a child\'s parents or establishing the identity of individuals in criminal investigations. However, scientists note that genetic information should be protected and not used for discrimination. Additionally, genetic analysis is not cheap and accessible to everyone, so it cannot be used in all fields. However, with the development of technology and the lowering of the cost of genetic analysis, its possibilities may become more accessible to a wider range of people.', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Quae eveniet repellat, dicta eius sint perspiciatis magnam facere id. Dolor, sit.', 1, 'PROD_6059137a925a9', 'Woman', 2, '1.jpg', 'Embossed Packet Backpack  рак\nWoman', '2022-06-12', 2),
(2, 'Embossed Packet Backpack2', 189, NULL, NULL, 'Genetic research has become increasingly popular in recent times. The information that can be obtained from DNA analysis can help in understanding our genetic makeup and may have practical applications in medicine and other fields. For example, genetic analysis can help to understand the risk of developing certain diseases and help in preventing their spread. Currently, through genetic research, family relationships can be established, such as determining a child\'s parents or establishing the identity of individuals in criminal investigations. However, scientists note that genetic information should be protected and not used for discrimination. Additionally, genetic analysis is not cheap and accessible to everyone, so it cannot be used in all fields. However, with the development of technology and the lowering of the cost of genetic analysis, its possibilities may become more accessible to a wider range of people.', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Quae eveniet repellat, dicta eius sint perspiciatis magnam facere id. Dolor, sit.', 2, 'PROD_6059137a92639', 'Woman', 0, '2.jpg', 'Embossed Packet Backpack Woman', '2022-06-12', 2),
(3, 'Embossed Packet Backpack3', 40, NULL, 5, 'Genetic research has become increasingly popular in recent times. The information that can be obtained from DNA analysis can help in understanding our genetic makeup and may have practical applications in medicine and other fields. For example, genetic analysis can help to understand the risk of developing certain diseases and help in preventing their spread. Currently, through genetic research, family relationships can be established, such as determining a child\'s parents or establishing the identity of individuals in criminal investigations. However, scientists note that genetic information should be protected and not used for discrimination. Additionally, genetic analysis is not cheap and accessible to everyone, so it cannot be used in all fields. However, with the development of technology and the lowering of the cost of genetic analysis, its possibilities may become more accessible to a wider range of people.', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Quae eveniet repellat, dicta eius sint perspiciatis magnam facere id. Dolor, sit.', 3, 'PROD_6059137a9267c', 'Woman', 4, '3.jpg', 'Embossed Packet Backpack Woman', '2022-06-12', 2),
(4, 'Embossed Packet Backpack4', 29, 1, NULL, 'Genetic research has become increasingly popular in recent times. The information that can be obtained from DNA analysis can help in understanding our genetic makeup and may have practical applications in medicine and other fields. For example, genetic analysis can help to understand the risk of developing certain diseases and help in preventing their spread. Currently, through genetic research, family relationships can be established, such as determining a child\'s parents or establishing the identity of individuals in criminal investigations. However, scientists note that genetic information should be protected and not used for discrimination. Additionally, genetic analysis is not cheap and accessible to everyone, so it cannot be used in all fields. However, with the development of technology and the lowering of the cost of genetic analysis, its possibilities may become more accessible to a wider range of people.', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Quae eveniet repellat, dicta eius sint perspiciatis magnam facere id. Dolor, sit.', 2, 'PROD_6059137a926ba', 'Woman', 5, '4.jpg', 'Embossed  рак Packet Backpack Woman', '2022-06-12', 2),
(5, 'Embossed Packet Backpack5', 121, NULL, 5, 'Genetic research has become increasingly popular in recent times. The information that can be obtained from DNA analysis can help in understanding our genetic makeup and may have practical applications in medicine and other fields. For example, genetic analysis can help to understand the risk of developing certain diseases and help in preventing their spread. Currently, through genetic research, family relationships can be established, such as determining a child\'s parents or establishing the identity of individuals in criminal investigations. However, scientists note that genetic information should be protected and not used for discrimination. Additionally, genetic analysis is not cheap and accessible to everyone, so it cannot be used in all fields. However, with the development of technology and the lowering of the cost of genetic analysis, its possibilities may become more accessible to a wider range of people.', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Quae eveniet repellat, dicta eius sint perspiciatis magnam facere id. Dolor, sit.', 5, 'PROD_6059137a926fd', 'Woman', 3, '5.jpg', 'Embossed Packet Backpack Woman', '2022-06-12', 2),
(6, 'Embossed Packet Backpack6', 29, 1, NULL, 'Genetic research has become increasingly popular in recent times. The information that can be obtained from DNA analysis can help in understanding our genetic makeup and may have practical applications in medicine and other fields. For example, genetic analysis can help to understand the risk of developing certain diseases and help in preventing their spread. Currently, through genetic research, family relationships can be established, such as determining a child\'s parents or establishing the identity of individuals in criminal investigations. However, scientists note that genetic information should be protected and not used for discrimination. Additionally, genetic analysis is not cheap and accessible to everyone, so it cannot be used in all fields. However, with the development of technology and the lowering of the cost of genetic analysis, its possibilities may become more accessible to a wider range of people.', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Quae eveniet repellat, dicta eius sint perspiciatis magnam facere id. Dolor, sit.', 2, 'PROD_6059137a9273f', 'Woman', 0, '6.jpg', 'Embossed Packet Backpack Woman', '2022-06-12', 2),
(7, 'Embossed Packet Backpack7', 349, NULL, NULL, 'Genetic research has become increasingly popular in recent times. The information that can be obtained from DNA analysis can help in understanding our genetic makeup and may have practical applications in medicine and other fields. For example, genetic analysis can help to understand the risk of developing certain diseases and help in preventing their spread. Currently, through genetic research, family relationships can be established, such as determining a child\'s parents or establishing the identity of individuals in criminal investigations. However, scientists note that genetic information should be protected and not used for discrimination. Additionally, genetic analysis is not cheap and accessible to everyone, so it cannot be used in all fields. However, with the development of technology and the lowering of the cost of genetic analysis, its possibilities may become more accessible to a wider range of people.', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Quae eveniet repellat, dicta eius sint perspiciatis magnam facere id. Dolor, sit.', 1, 'PROD_6059137a92781', 'Woman', 3, '1.jpg', 'Embossed Packet Backpack Woman', '2022-06-12', 2),
(8, 'Embossed Packet Backpack8', 300, 1, 12, 'Genetic research has become increasingly popular in recent times. The information that can be obtained from DNA analysis can help in understanding our genetic makeup and may have practical applications in medicine and other fields. For example, genetic analysis can help to understand the risk of developing certain diseases and help in preventing their spread. Currently, through genetic research, family relationships can be established, such as determining a child\'s parents or establishing the identity of individuals in criminal investigations. However, scientists note that genetic information should be protected and not used for discrimination. Additionally, genetic analysis is not cheap and accessible to everyone, so it cannot be used in all fields. However, with the development of technology and the lowering of the cost of genetic analysis, its possibilities may become more accessible to a wider range of people.', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Quae eveniet repellat, dicta eius sint perspiciatis magnam facere id. Dolor, sit.', 1, 'PROD_6059137a927c3', 'Woman', 5, '2.jpg', 'Embossed Packet Backpack Woman', '2022-06-12', 2),
(9, 'Embossed Packet Backpack9', 29, NULL, 20, 'Genetic research has become increasingly popular in recent times. The information that can be obtained from DNA analysis can help in understanding our genetic makeup and may have practical applications in medicine and other fields. For example, genetic analysis can help to understand the risk of developing certain diseases and help in preventing their spread. Currently, through genetic research, family relationships can be established, such as determining a child\'s parents or establishing the identity of individuals in criminal investigations. However, scientists note that genetic information should be protected and not used for discrimination. Additionally, genetic analysis is not cheap and accessible to everyone, so it cannot be used in all fields. However, with the development of technology and the lowering of the cost of genetic analysis, its possibilities may become more accessible to a wider range of people.', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Quae eveniet repellat, dicta eius sint perspiciatis magnam facere id. Dolor, sit.', 1, 'PROD_6059137a92805', 'Woman', 2, '3.jpg', 'Embossed Packet Backpack Woman', '2022-06-12', 2),
(10, 'Embossed Packet Backpack10', 29, NULL, 50, 'Genetic research has become increasingly popular in recent times. The information that can be obtained from DNA analysis can help in understanding our genetic makeup and may have practical applications in medicine and other fields. For example, genetic analysis can help to understand the risk of developing certain diseases and help in preventing their spread. Currently, through genetic research, family relationships can be established, such as determining a child\'s parents or establishing the identity of individuals in criminal investigations. However, scientists note that genetic information should be protected and not used for discrimination. Additionally, genetic analysis is not cheap and accessible to everyone, so it cannot be used in all fields. However, with the development of technology and the lowering of the cost of genetic analysis, its possibilities may become more accessible to a wider range of people.', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Quae eveniet repellat, dicta eius sint perspiciatis magnam facere id. Dolor, sit.', 6, 'PROD_6059137a92847', 'Woman', 5, '4.jpg', 'Embossed Packet Backpack Woman', '2022-06-12', 2);

-- --------------------------------------------------------

--
-- Структура таблиці `reply`
--

CREATE TABLE `reply` (
  `id` int NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `text` text,
  `id_comments` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Дамп даних таблиці `reply`
--

INSERT INTO `reply` (`id`, `name`, `email`, `text`, `id_comments`) VALUES
(6, 'Oleg', 'oleg.khorobriv@gmail.com', 'У вас є багато людей, які цінують і підтримують вас.', 42),
(24, 'Oleg', 'oleg.khorobriv@gmail.com', 'Кожен новий день відкриває перед нами безліч можливостей.', 42),
(25, 'Oleg', 'oleg.khorobriv@gmail.com', 'Успіх – це результат нашої праці та наполегливості.', 44),
(26, 'Юля', 'oleg.khorobriv@gmail.com', 'Справді чудовий товар', 45);

-- --------------------------------------------------------

--
-- Структура таблиці `size`
--

CREATE TABLE `size` (
  `id` int NOT NULL,
  `size` varchar(255) DEFAULT NULL,
  `id_product` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Дамп даних таблиці `size`
--

INSERT INTO `size` (`id`, `size`, `id_product`) VALUES
(1, 'S', 1),
(2, 'M', 1),
(3, 'L', 1),
(4, 'XS', 1),
(5, 'XL', 1),
(6, 'XXL', 1),
(7, 'S', 2),
(8, 'M', 2),
(9, 'L', 2),
(10, 'XS', 2),
(11, 'XL', 2),
(12, 'XXL', 2),
(13, 'S', 3),
(14, 'M', 3),
(15, 'L', 3),
(16, 'S', 4),
(17, 'M', 4),
(18, 'XS', 4),
(19, 'XL', 4),
(20, 'S', 5),
(21, 'M', 5),
(22, 'S', 6),
(23, 'M', 6),
(24, 'L', 6),
(25, 'XS', 6),
(26, 'XL', 6);

-- --------------------------------------------------------

--
-- Структура таблиці `size_full`
--

CREATE TABLE `size_full` (
  `id` int NOT NULL,
  `name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Дамп даних таблиці `size_full`
--

INSERT INTO `size_full` (`id`, `name`) VALUES
(1, 'L'),
(2, 'M'),
(3, 'S'),
(4, 'XL'),
(5, 'XS'),
(6, 'XXL');

-- --------------------------------------------------------

--
-- Структура таблиці `tags`
--

CREATE TABLE `tags` (
  `id` int NOT NULL,
  `name_tags` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `id_product` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Дамп даних таблиці `tags`
--

INSERT INTO `tags` (`id`, `name_tags`, `id_product`) VALUES
(1, 'Sweetshirt', 1),
(2, 'Man Accessories', 1),
(3, 'Fashion', 1),
(4, 'Sweetshirt', 2),
(5, 'Man Accessories', 2),
(6, 'Jewellery', 2),
(7, 'Fashion', 3),
(8, 'Polo', 3),
(9, 'T-Shirt', 3),
(10, 'Sweetshirt', 4),
(11, 'Man Accessories', 4),
(12, 'Fashion', 4),
(13, 'Polo', 4),
(14, 'T-Shirt', 4),
(15, 'Jewellery', 4),
(16, 'Polo', 5),
(17, 'T-Shirt', 5),
(18, 'Jewellery', 5),
(19, 'Sweetshirt', 6),
(20, 'Fashion', 6),
(21, 'T-Shirt', 6);

-- --------------------------------------------------------

--
-- Структура таблиці `tags_full`
--

CREATE TABLE `tags_full` (
  `id` int NOT NULL,
  `name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Дамп даних таблиці `tags_full`
--

INSERT INTO `tags_full` (`id`, `name`) VALUES
(1, 'Fashion'),
(2, 'Jewellery'),
(3, 'Man Accessories'),
(4, 'Polo'),
(5, 'Sweetshirt'),
(6, 'T-Shirt');

-- --------------------------------------------------------

--
-- Структура таблиці `user`
--

CREATE TABLE `user` (
  `id` int NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `pass` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `hash` varchar(255) DEFAULT NULL,
  `ip` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Дамп даних таблиці `user`
--

INSERT INTO `user` (`id`, `name`, `pass`, `email`, `hash`, `ip`) VALUES
(10, NULL, '0750fcff70b1b80f146925315e2a752e', 'oleg.khorobriv@gmail.com', '1b81bcc6e3ddc40ba3661038a426928d', '2130706433');

--
-- Індекси збережених таблиць
--

--
-- Індекси таблиці `basket`
--
ALTER TABLE `basket`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_product` (`id_product`);

--
-- Індекси таблиці `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Індекси таблиці `color`
--
ALTER TABLE `color`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_product` (`id_product`);

--
-- Індекси таблиці `color_full`
--
ALTER TABLE `color_full`
  ADD PRIMARY KEY (`id`);

--
-- Індекси таблиці `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_product` (`id_product`);

--
-- Індекси таблиці `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_product` (`id_product`);

--
-- Індекси таблиці `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_category` (`id_category`);

--
-- Індекси таблиці `reply`
--
ALTER TABLE `reply`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_comments` (`id_comments`);

--
-- Індекси таблиці `size`
--
ALTER TABLE `size`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_product` (`id_product`);

--
-- Індекси таблиці `size_full`
--
ALTER TABLE `size_full`
  ADD PRIMARY KEY (`id`);

--
-- Індекси таблиці `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_product` (`id_product`);

--
-- Індекси таблиці `tags_full`
--
ALTER TABLE `tags_full`
  ADD PRIMARY KEY (`id`);

--
-- Індекси таблиці `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для збережених таблиць
--

--
-- AUTO_INCREMENT для таблиці `basket`
--
ALTER TABLE `basket`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT для таблиці `category`
--
ALTER TABLE `category`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT для таблиці `color`
--
ALTER TABLE `color`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT для таблиці `color_full`
--
ALTER TABLE `color_full`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT для таблиці `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT для таблиці `images`
--
ALTER TABLE `images`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT для таблиці `product`
--
ALTER TABLE `product`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT для таблиці `reply`
--
ALTER TABLE `reply`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT для таблиці `size`
--
ALTER TABLE `size`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT для таблиці `size_full`
--
ALTER TABLE `size_full`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT для таблиці `tags`
--
ALTER TABLE `tags`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT для таблиці `tags_full`
--
ALTER TABLE `tags_full`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT для таблиці `user`
--
ALTER TABLE `user`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Обмеження зовнішнього ключа збережених таблиць
--

--
-- Обмеження зовнішнього ключа таблиці `basket`
--
ALTER TABLE `basket`
  ADD CONSTRAINT `basket_ibfk_1` FOREIGN KEY (`id_product`) REFERENCES `product` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Обмеження зовнішнього ключа таблиці `color`
--
ALTER TABLE `color`
  ADD CONSTRAINT `color_ibfk_1` FOREIGN KEY (`id_product`) REFERENCES `product` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Обмеження зовнішнього ключа таблиці `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`id_product`) REFERENCES `product` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Обмеження зовнішнього ключа таблиці `images`
--
ALTER TABLE `images`
  ADD CONSTRAINT `images_ibfk_1` FOREIGN KEY (`id_product`) REFERENCES `product` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Обмеження зовнішнього ключа таблиці `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`id_category`) REFERENCES `category` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Обмеження зовнішнього ключа таблиці `reply`
--
ALTER TABLE `reply`
  ADD CONSTRAINT `reply_ibfk_1` FOREIGN KEY (`id_comments`) REFERENCES `comments` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Обмеження зовнішнього ключа таблиці `size`
--
ALTER TABLE `size`
  ADD CONSTRAINT `size_ibfk_1` FOREIGN KEY (`id_product`) REFERENCES `product` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Обмеження зовнішнього ключа таблиці `tags`
--
ALTER TABLE `tags`
  ADD CONSTRAINT `tags_ibfk_1` FOREIGN KEY (`id_product`) REFERENCES `product` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
