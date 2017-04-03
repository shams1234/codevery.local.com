-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Мар 29 2017 г., 23:17
-- Версия сервера: 5.5.53
-- Версия PHP: 5.6.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `codevery_app`
--

-- --------------------------------------------------------

--
-- Структура таблицы `comments`
--

CREATE TABLE `comments` (
  `cid` int(11) NOT NULL,
  `mid` int(11) NOT NULL,
  `parent_id` int(11) NOT NULL,
  `child_id` int(11) NOT NULL,
  `author` varchar(100) NOT NULL,
  `cdesc` text NOT NULL,
  `cdate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `messages`
--

CREATE TABLE `messages` (
  `MID` int(10) UNSIGNED NOT NULL,
  `mtitle` varchar(200) NOT NULL,
  `mdesc` text NOT NULL,
  `mpic` text NOT NULL,
  `mauthor` varchar(50) NOT NULL,
  `mdate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `messages`
--

INSERT INTO `messages` (`MID`, `mtitle`, `mdesc`, `mpic`, `mauthor`, `mdate`) VALUES
(11, '1 sunt aut facere repellat provident occaecati excepturi optio reprehenderit', 'quia et suscipit\\nsuscipit recusandae consequuntur expedita et cum\\nreprehenderit molestiae ut ut quas totam\\nnostrum rerum est autem sunt rem eveniet architecto', 'https://randomuser.me/api/portraits/men/51.jpg', '@shams', '0000-00-00 00:00:00'),
(12, '2 qui est esse', 'est rerum tempore vitae\\nsequi sint nihil reprehenderit dolor beatae ea dolores neque\\nfugiat blanditiis voluptate porro vel nihil molestiae ut reiciendis\\nqui aperiam non debitis possimus qui neque nisi nulla', 'https://randomuser.me/api/portraits/men/52.jpg', '@shams', '0000-00-00 00:00:00'),
(13, '3 ea molestias quasi exercitationem repellat qui ipsa sit aut', 'et iusto sed quo iure\\nvoluptatem occaecati omnis eligendi aut ad\\nvoluptatem doloribus vel accusantium quis pariatur\\nmolestiae porro eius odio et labore et velit aut', 'https://randomuser.me/api/portraits/men/53.jpg', '@shams', '0000-00-00 00:00:00'),
(14, '4 sunt aut facere repellat provident occaecati excepturi optio reprehenderit', 'quia et suscipit\\nsuscipit recusandae consequuntur expedita et cum\\nreprehenderit molestiae ut ut quas totam\\nnostrum rerum est autem sunt rem eveniet architecto', 'https://randomuser.me/api/portraits/men/51.jpg', '@shams', '0000-00-00 00:00:00'),
(15, '5 qui est esse', 'est rerum tempore vitae\\nsequi sint nihil reprehenderit dolor beatae ea dolores neque\\nfugiat blanditiis voluptate porro vel nihil molestiae ut reiciendis\\nqui aperiam non debitis possimus qui neque nisi nulla', 'https://randomuser.me/api/portraits/men/52.jpg', '@shams', '0000-00-00 00:00:00'),
(16, '6 ea molestias quasi exercitationem repellat qui ipsa sit aut', 'et iusto sed quo iure\\nvoluptatem occaecati omnis eligendi aut ad\\nvoluptatem doloribus vel accusantium quis pariatur\\nmolestiae porro eius odio et labore et velit aut', 'https://randomuser.me/api/portraits/men/53.jpg', '@shams', '0000-00-00 00:00:00'),
(17, '7 sunt aut facere repellat provident occaecati excepturi optio reprehenderit', 'quia et suscipit\\nsuscipit recusandae consequuntur expedita et cum\\nreprehenderit molestiae ut ut quas totam\\nnostrum rerum est autem sunt rem eveniet architecto', 'https://randomuser.me/api/portraits/men/51.jpg', '@shams', '0000-00-00 00:00:00'),
(18, '8 qui est esse', 'est rerum tempore vitae\\nsequi sint nihil reprehenderit dolor beatae ea dolores neque\\nfugiat blanditiis voluptate porro vel nihil molestiae ut reiciendis\\nqui aperiam non debitis possimus qui neque nisi nulla', 'https://randomuser.me/api/portraits/men/52.jpg', '@shams', '0000-00-00 00:00:00'),
(19, '9 ea molestias quasi exercitationem repellat qui ipsa sit aut', 'et iusto sed quo iure\\nvoluptatem occaecati omnis eligendi aut ad\\nvoluptatem doloribus vel accusantium quis pariatur\\nmolestiae porro eius odio et labore et velit aut', 'https://randomuser.me/api/portraits/men/53.jpg', '@shams', '0000-00-00 00:00:00'),
(20, '11 sunt aut facere repellat provident occaecati excepturi optio reprehenderit', 'quia et suscipit\\nsuscipit recusandae consequuntur expedita et cum\\nreprehenderit molestiae ut ut quas totam\\nnostrum rerum est autem sunt rem eveniet architecto', 'https://randomuser.me/api/portraits/men/51.jpg', '@shams', '0000-00-00 00:00:00'),
(21, '12 qui est esse', 'est rerum tempore vitae\\nsequi sint nihil reprehenderit dolor beatae ea dolores neque\\nfugiat blanditiis voluptate porro vel nihil molestiae ut reiciendis\\nqui aperiam non debitis possimus qui neque nisi nulla', 'https://randomuser.me/api/portraits/men/52.jpg', '@shams', '0000-00-00 00:00:00'),
(22, '10 ea molestias quasi exercitationem repellat qui ipsa sit aut', 'et iusto sed quo iure\\nvoluptatem occaecati omnis eligendi aut ad\\nvoluptatem doloribus vel accusantium quis pariatur\\nmolestiae porro eius odio et labore et velit aut', 'https://randomuser.me/api/portraits/men/53.jpg', '@shams', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `userid` int(11) NOT NULL,
  `username` varchar(30) DEFAULT NULL,
  `userpass` varchar(250) DEFAULT NULL,
  `userfullname` varchar(100) DEFAULT NULL,
  `useremail` varchar(70) DEFAULT NULL,
  `joined` datetime NOT NULL,
  `type` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`userid`, `username`, `userpass`, `userfullname`, `useremail`, `joined`, `type`) VALUES
(12, 'codevery', '123', 'codevery', 'codevery@support.com', '2017-03-22 00:00:00', 1);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`cid`);

--
-- Индексы таблицы `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`MID`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userid`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `useremail` (`useremail`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `comments`
--
ALTER TABLE `comments`
  MODIFY `cid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=84;
--
-- AUTO_INCREMENT для таблицы `messages`
--
ALTER TABLE `messages`
  MODIFY `MID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=292;
--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `userid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
