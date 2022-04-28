-- --------------------------------------------------------
-- Хост:                         127.0.0.1
-- Версия сервера:               5.7.33 - MySQL Community Server (GPL)
-- Операционная система:         Win64
-- HeidiSQL Версия:              11.3.0.6295
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Дамп структуры для таблица tiny-url.redirects
CREATE TABLE IF NOT EXISTS `redirects` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `url_id` int(11) NOT NULL,
  `redirect_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- Дамп данных таблицы tiny-url.redirects: ~7 rows (приблизительно)
DELETE FROM `redirects`;
/*!40000 ALTER TABLE `redirects` DISABLE KEYS */;
INSERT INTO `redirects` (`id`, `url_id`, `redirect_date`) VALUES
	(1, 3, '2022-04-28 02:37:19'),
	(2, 2, '2022-04-28 02:38:09'),
	(3, 4, '2022-04-28 02:44:00'),
	(4, 6, '2022-04-28 02:53:51'),
	(5, 7, '2022-04-28 03:00:35'),
	(6, 7, '2022-04-28 03:02:12'),
	(7, 7, '2022-04-28 03:08:08');
/*!40000 ALTER TABLE `redirects` ENABLE KEYS */;

-- Дамп структуры для таблица tiny-url.urls
CREATE TABLE IF NOT EXISTS `urls` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `url` varchar(256) NOT NULL,
  `short_url` varchar(50) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- Дамп данных таблицы tiny-url.urls: ~7 rows (приблизительно)
DELETE FROM `urls`;
/*!40000 ALTER TABLE `urls` DISABLE KEYS */;
INSERT INTO `urls` (`id`, `url`, `short_url`, `created_at`) VALUES
	(1, 'https://www.php.net/manual/ru/intro.session.php', 'go/z5zwpMS', '2022-04-28 02:36:47'),
	(2, 'http://joxi.ru/V2VyXzlSBvoQlm', 'go/McuUM7j', '2022-04-28 02:36:55'),
	(3, 'https://www.youtube.com/watch?v=H3XjwXCZES4', 'go/MJlz5fS', '2022-04-28 02:37:10'),
	(4, 'https://www.youtube.com/watch?v=SzqeTeW9OAo&t=3052s', 'go/xNSGY7k', '2022-04-28 02:43:50'),
	(5, 'https://jwt.io/introduction', 'go/LK8IV0d', '2022-04-28 02:49:14'),
	(6, 'https://jwt.io/#debugger-io', 'go/xWPPUpV', '2022-04-28 02:53:42'),
	(7, 'https://htmlweb.ru/php/example/avtorizacija.php', 'go/zXG69bO', '2022-04-28 02:59:08');
/*!40000 ALTER TABLE `urls` ENABLE KEYS */;

-- Дамп структуры для таблица tiny-url.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(50) NOT NULL,
  `password` varchar(128) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- Дамп данных таблицы tiny-url.users: ~1 rows (приблизительно)
DELETE FROM `users`;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `login`, `password`) VALUES
	(1, 'test', '$2y$10$NRwQzV8Gaxm27rE6rClYXelkGClnmnH09l.YFiohpprd9nw3AJWvO');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
