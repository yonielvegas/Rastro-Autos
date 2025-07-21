-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 21-07-2025 a las 16:37:16
-- Versión del servidor: 9.1.0
-- Versión de PHP: 8.3.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `rastro_autos`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comentarios`
--

DROP TABLE IF EXISTS `comentarios`;
CREATE TABLE IF NOT EXISTS `comentarios` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_usuario` int NOT NULL,
  `id_parte` int NOT NULL,
  `comentario` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `publicado` tinyint(1) DEFAULT '0',
  `fecha_publicacion` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `id_parte` (`id_parte`),
  KEY `id_usuario` (`id_usuario`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `partes_autos`
--

DROP TABLE IF EXISTS `partes_autos`;
CREATE TABLE IF NOT EXISTS `partes_autos` (
  `id_parte` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `descripcion` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `precio` decimal(10,2) NOT NULL,
  `cantidad_stock` int NOT NULL,
  `marca_auto` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `modelo_auto` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `año_auto` int NOT NULL,
  `imagen` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `imagen_thumbnail` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_seccion` int NOT NULL,
  PRIMARY KEY (`id_parte`),
  KEY `id_seccion` (`id_seccion`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `partes_vendidas`
--

DROP TABLE IF EXISTS `partes_vendidas`;
CREATE TABLE IF NOT EXISTS `partes_vendidas` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_parte` int NOT NULL,
  `id_usuario` int NOT NULL,
  `cantidad` int NOT NULL,
  `precio_total` decimal(10,2) NOT NULL,
  `fecha_venta` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `id_parte` (`id_parte`),
  KEY `id_usuario` (`id_usuario`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

DROP TABLE IF EXISTS `roles`;
CREATE TABLE IF NOT EXISTS `roles` (
  `id_rol` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id_rol`),
  UNIQUE KEY `nombre` (`nombre`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id_rol`, `nombre`) VALUES
(1, 'administrador'),
(2, 'operativo'),
(3, 'usuario');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `seccion_parte`
--

DROP TABLE IF EXISTS `seccion_parte`;
CREATE TABLE IF NOT EXISTS `seccion_parte` (
  `id_seccion` int NOT NULL AUTO_INCREMENT,
  `seccion` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id_seccion`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `trazabilidad`
--

DROP TABLE IF EXISTS `trazabilidad`;
CREATE TABLE IF NOT EXISTS `trazabilidad` (
  `id_traza` int NOT NULL AUTO_INCREMENT,
  `tabla_afectada` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `accion` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_usuario` int DEFAULT NULL,
  `usuario` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ip_usuario` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `registro` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_traza`),
  KEY `id_usuario` (`id_usuario`)
) ENGINE=MyISAM AUTO_INCREMENT=53 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `trazabilidad`
--

INSERT INTO `trazabilidad` (`id_traza`, `tabla_afectada`, `accion`, `id_usuario`, `usuario`, `ip_usuario`, `registro`) VALUES
(1, 'usuario_intentos', 'Select LOGIN_OK', 1, 'admin', '::1', '2025-07-21 12:28:13'),
(2, 'usuario_intentos', 'Select LOGIN_FAIL', 1, 'admin', '::1', '2025-07-21 12:28:31'),
(3, 'usuarios_rol', 'Insertar Rol', 7, 'Eldabr', '::1', '2025-07-21 13:07:36'),
(4, 'usuarios', 'INSERT', 7, 'Eldabr', '::1', '2025-07-21 13:07:36'),
(5, 'usuario_intentos', 'Select LOGIN_FAIL', 1, 'admin', '::1', '2025-07-21 13:16:28'),
(6, 'usuario_intentos', 'Select LOGIN_FAIL', 1, 'admin', '::1', '2025-07-21 13:20:09'),
(7, 'usuario_intentos', 'Select LOGIN_OK', 1, 'admin', '::1', '2025-07-21 13:20:20'),
(8, 'usuario_intentos', 'Select LOGIN_OK', 2, 'yonielvegas', '::1', '2025-07-21 13:20:36'),
(9, 'usuario_intentos', 'Select LOGIN_FAIL', 2, 'yonielvegas', '::1', '2025-07-21 13:20:44'),
(10, 'usuario_intentos', 'Select LOGIN_FAIL', 2, 'yonielvegas', '::1', '2025-07-21 13:23:05'),
(11, 'usuario_intentos', 'Select LOGIN_FAIL', 2, 'yonielvegas', '::1', '2025-07-21 13:24:07'),
(12, 'usuario_intentos', 'Select LOGIN_FAIL', 2, 'yonielvegas', '::1', '2025-07-21 13:24:49'),
(13, 'usuario_intentos', 'Select LOGIN_FAIL', 2, 'yonielvegas', '::1', '2025-07-21 13:24:54'),
(14, 'usuario_intentos', 'Select LOGIN_OK', 2, 'yonielvegas', '::1', '2025-07-21 13:25:51'),
(15, 'usuario_intentos', 'Select LOGIN_FAIL', 2, 'yonielvegas', '::1', '2025-07-21 13:40:34'),
(16, 'usuario_intentos', 'Select LOGIN_OK', 2, 'yonielvegas', '::1', '2025-07-21 13:40:47'),
(17, 'usuario_intentos', 'Select LOGIN_OK', 2, 'yonielvegas', '::1', '2025-07-21 13:41:00'),
(18, 'usuario_intentos', 'Select LOGIN_FAIL', 2, 'yonielvegas', '::1', '2025-07-21 13:47:05'),
(19, 'usuario_intentos', 'Select LOGIN_FAIL', 2, 'yonielvegas', '::1', '2025-07-21 13:48:21'),
(20, 'usuario_intentos', 'Select LOGIN_OK', 2, 'yonielvegas', '::1', '2025-07-21 13:48:29'),
(21, 'usuario_intentos', 'Select LOGIN_OK', 2, 'yonielvegas', '::1', '2025-07-21 13:53:41'),
(22, 'usuario_intentos', 'Select LOGIN_OK', 2, 'yonielvegas', '::1', '2025-07-21 13:56:24'),
(23, 'usuario_intentos', 'Select LOGIN_OK', 2, 'yonielvegas', '::1', '2025-07-21 14:05:42'),
(24, 'usuario_intentos', 'Select LOGIN_OK', 1, 'admin', '::1', '2025-07-21 14:06:13'),
(25, 'usuario_intentos', 'Select LOGIN_OK', 1, 'admin', '::1', '2025-07-21 14:09:02'),
(26, 'usuario_intentos', 'Select LOGIN_FAIL', 2, 'yonielvegas', '::1', '2025-07-21 14:12:20'),
(27, 'usuario_intentos', 'Select LOGIN_FAIL', 2, 'yonielvegas', '::1', '2025-07-21 14:12:32'),
(28, 'usuario_intentos', 'Select LOGIN_OK', 2, 'yonielvegas', '::1', '2025-07-21 14:13:33'),
(29, 'usuario_intentos', 'Select LOGIN_OK', 2, 'yonielvegas', '::1', '2025-07-21 14:14:10'),
(30, 'usuario_intentos', 'Select LOGIN_OK', 2, 'yonielvegas', '::1', '2025-07-21 14:15:39'),
(31, 'usuario_intentos', 'Select LOGIN_OK', 2, 'yonielvegas', '::1', '2025-07-21 14:23:25'),
(32, 'usuario_intentos', 'Select LOGIN_FAIL', 2, 'yonielvegas', '::1', '2025-07-21 14:23:47'),
(33, 'usuario_intentos', 'Select LOGIN_OK', 2, 'yonielvegas', '::1', '2025-07-21 14:24:26'),
(34, 'usuario_intentos', 'Select LOGIN_OK', 1, 'admin', '::1', '2025-07-21 14:24:40'),
(35, 'usuario_intentos', 'Select LOGIN_OK', 1, 'admin', '::1', '2025-07-21 14:25:36'),
(36, 'usuario_intentos', 'Select LOGIN_OK', 2, 'yonielvegas', '::1', '2025-07-21 14:25:59'),
(37, 'usuario_intentos', 'Select LOGIN_FAIL', 2, 'yonielvegas', '::1', '2025-07-21 14:26:03'),
(38, 'usuario_intentos', 'Select LOGIN_FAIL', 2, 'yonielvegas', '::1', '2025-07-21 14:26:07'),
(39, 'usuario_intentos', 'Select LOGIN_FAIL', 2, 'yonielvegas', '::1', '2025-07-21 14:26:10'),
(40, 'usuario_intentos', 'Select LOGIN_FAIL', 2, 'yonielvegas', '::1', '2025-07-21 14:29:02'),
(41, 'usuario_intentos', 'Select LOGIN_FAIL', 2, 'yonielvegas', '::1', '2025-07-21 14:33:32'),
(42, 'usuario_intentos', 'Select LOGIN_OK', 2, 'yonielvegas', '::1', '2025-07-21 14:33:40'),
(43, 'usuario_intentos', 'Select LOGIN_OK', 2, 'yonielvegas', '::1', '2025-07-21 14:35:25'),
(44, 'usuario_intentos', 'Select LOGIN_OK', 2, 'yonielvegas', '::1', '2025-07-21 14:36:43'),
(45, 'usuario_intentos', 'Select LOGIN_FAIL', 2, 'yonielvegas', '::1', '2025-07-21 14:36:52'),
(46, 'usuario_intentos', 'Select LOGIN_FAIL', 2, 'yonielvegas', '::1', '2025-07-21 14:38:46'),
(47, 'usuario_intentos', 'Select LOGIN_FAIL', 2, 'yonielvegas', '::1', '2025-07-21 14:39:46'),
(48, 'usuario_intentos', 'Select LOGIN_FAIL', 1, 'admin', '::1', '2025-07-21 14:39:52'),
(49, 'usuario_intentos', 'Select LOGIN_FAIL', 2, 'yonielvegas', '::1', '2025-07-21 14:56:07'),
(50, 'usuario_intentos', 'Select LOGIN_FAIL', 2, 'yonielvegas', '::1', '2025-07-21 14:56:16'),
(51, 'usuario_intentos', 'Select LOGIN_OK', 2, 'yonielvegas', '::1', '2025-07-21 16:33:14'),
(52, 'usuario_intentos', 'Select LOGIN_OK', 1, 'admin', '::1', '2025-07-21 16:33:24');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE IF NOT EXISTS `usuarios` (
  `id_usuario` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `apellido` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `correo` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `telefono` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `usuario` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `activo` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`id_usuario`),
  UNIQUE KEY `usuario` (`usuario`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `nombre`, `apellido`, `correo`, `telefono`, `usuario`, `password`, `activo`) VALUES
(1, 'Administrador', 'General', 'admin@example.com', '0000000000', 'admin', '$2y$10$q8VUgCGP8j4VshXUTCZfnuh74WQ9nJnBxwRcl/KSlwoaUnNOT4e9W', 1),
(2, 'Yoel', 'Samaniego', 'yoelsamaniego4@gmail.com', '62834187', 'yonielvegas', '$2y$10$q8VUgCGP8j4VshXUTCZfnuh74WQ9nJnBxwRcl/KSlwoaUnNOT4e9W', 1),
(3, 'Ana', 'Pinto', 'anapinto@gmail.com', '62873192', 'anap', '$2y$10$aiKOJXZ.r.an3oT5OZNO4eBTB.6YMvGdNGEgCdmBtv5wVSiBbQMbu', 1),
(4, 'Irina', 'Fong', 'IrinaF@gmail.com', '34675632', 'salmon', '$2y$10$Kca2hIpI079gLHZsSuSnoOz49P/Qc62q5SZFJ8OeQbUeVCjRGyOH6', 1),
(5, 'pedro', 'perez', 'pedro@gmail.com', '232344534', 'pedro22', '$2y$10$NI6jkzgF60n0FF7HdtXDqOlAIXyrGDjNGPchJ.UvllmpjU5aEhQD2', 1),
(6, 'Juan', 'Gonzales', 'juanperez@gmail.com', '442323233', 'juanp', '$2y$10$ITgGFjNb/T6RXxSLIPNjf.EDv2d3RDo0mqrikV.eAi3VkLNnOO09a', 1),
(7, 'Elda', 'Rodriguez', 'eldabr@gmail.com', '64373787', 'Eldabr', '$2y$10$nJP6LJ5LQYmAKWpzko.Cue5juLW8oBo65MjXBiMLncmG4biLBqA6C', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios_roles`
--

DROP TABLE IF EXISTS `usuarios_roles`;
CREATE TABLE IF NOT EXISTS `usuarios_roles` (
  `id_usurol` int NOT NULL AUTO_INCREMENT,
  `id_usuario` int NOT NULL,
  `id_rol` int NOT NULL,
  PRIMARY KEY (`id_usurol`),
  KEY `id_usuario` (`id_usuario`),
  KEY `id_rol` (`id_rol`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `usuarios_roles`
--

INSERT INTO `usuarios_roles` (`id_usurol`, `id_usuario`, `id_rol`) VALUES
(1, 1, 1),
(2, 2, 3),
(3, 3, 3),
(4, 4, 3),
(5, 5, 3),
(6, 6, 3),
(7, 7, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario_intentos`
--

DROP TABLE IF EXISTS `usuario_intentos`;
CREATE TABLE IF NOT EXISTS `usuario_intentos` (
  `id_intentos` int NOT NULL AUTO_INCREMENT,
  `id_usuario` int NOT NULL,
  `intentos` int DEFAULT '0',
  `bloqueado` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id_intentos`),
  KEY `id_usuario` (`id_usuario`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `usuario_intentos`
--

INSERT INTO `usuario_intentos` (`id_intentos`, `id_usuario`, `intentos`, `bloqueado`) VALUES
(1, 1, 0, 0),
(2, 2, 0, 0),
(3, 3, 1, 1),
(4, 4, 1, 0),
(5, 5, 1, 0),
(6, 6, 1, 0);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
