# Vue Guard

This template should help get you started developing with Vue 3 in Vite and includes the following technologies:

- Database
- Php api
- Vue3
  - Composition API
- Typescript
  - Interface
- Axios
- Pinia
  - Composition API
- Vue-router
- Picocss
- Jwt
- Authorization (login)
- Authentication (login specific menu items)
- Local storage
- Json

VueGuard represents a secure, dynamic, and interactive web application developed using modern web technologies. The project includes a PHP-based API along with Vue 3, Composition API, TypeScript, Axios, Pinia, and Vue Router from the Vue ecosystem. User authentication utilizes JSON Web Tokens (JWT), and the application provides different menu options based on the user's authorization status. Local Storage is employed for data storage, and JSON format is used for database interactions. For a minimalist and fast user interface, the project utilizes the Picocss framework. VueGuard combines the powerful and flexible features of Vue.js, the secure coding structure of TypeScript, and the advantages of Pinia for state management to deliver a secure and performant web experience.

## Database

This template uses MySQL as the database.

```SQL
-- Adminer 4.8.1 MySQL 5.5.5-10.6.12-MariaDB-0ubuntu0.22.04.1 dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `username` varchar(15) DEFAULT NULL,
  `password` varchar(15) DEFAULT NULL,
  `counter` int(11) DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_turkish_ci;

INSERT INTO `user` (`id`, `name`, `email`, `username`, `password`, `counter`) VALUES
(1,	'osman',	'kayı',	'osmankayi',	'1',	0)
-- 2024-01-24 13:50:56
```
