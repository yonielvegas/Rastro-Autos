-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 22-07-2025 a las 13:40:59
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
-- Estructura de tabla para la tabla `categoria`
--

DROP TABLE IF EXISTS `categoria`;
CREATE TABLE IF NOT EXISTS `categoria` (
  `id_cat` int NOT NULL,
  `categoria` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id_cat`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`id_cat`, `categoria`) VALUES
(1, 'Carroceria'),
(2, 'Motor'),
(3, 'Puertas'),
(4, 'Vidrios'),
(5, 'Espejos');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `factura`
--

DROP TABLE IF EXISTS `factura`;
CREATE TABLE IF NOT EXISTS `factura` (
  `id_factura` int NOT NULL AUTO_INCREMENT,
  `fecha` datetime DEFAULT CURRENT_TIMESTAMP,
  `total_factura` decimal(10,2) NOT NULL,
  PRIMARY KEY (`id_factura`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `marca`
--

DROP TABLE IF EXISTS `marca`;
CREATE TABLE IF NOT EXISTS `marca` (
  `id_marca` int NOT NULL,
  `marca` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id_marca`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `marca`
--

INSERT INTO `marca` (`id_marca`, `marca`) VALUES
(1, 'Toyota'),
(2, 'Mazda'),
(3, 'Ford');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `modelo`
--

DROP TABLE IF EXISTS `modelo`;
CREATE TABLE IF NOT EXISTS `modelo` (
  `id_modelo` int NOT NULL AUTO_INCREMENT,
  `modelo` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `anio` year NOT NULL,
  `id_marca` int NOT NULL,
  PRIMARY KEY (`id_modelo`),
  KEY `id_marca` (`id_marca`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `modelo`
--

INSERT INTO `modelo` (`id_modelo`, `modelo`, `anio`, `id_marca`) VALUES
(1, 'Corolla', '2023', 1),
(2, 'Rav4', '2022', 1),
(3, 'Prado', '2011', 1),
(4, 'CX-5', '2011', 2),
(5, 'MX-5 Miata', '2016', 2),
(6, 'CX-30', '2022', 2),
(7, 'Mustang', '2005', 3),
(8, 'Escape', '2012', 3),
(9, 'F-150', '2010', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `partes_autos`
--

DROP TABLE IF EXISTS `partes_autos`;
CREATE TABLE IF NOT EXISTS `partes_autos` (
  `id_parte` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descripcion` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `precio` decimal(10,2) NOT NULL,
  `cantidad_stock` int NOT NULL,
  `codigo_serie` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_marca` int NOT NULL,
  `id_modelo` int NOT NULL,
  `id_cat` int NOT NULL,
  `imagen` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `imagen_thumbnail` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fecha_registro` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_parte`),
  KEY `id_marca` (`id_marca`),
  KEY `id_modelo` (`id_modelo`),
  KEY `id_cat` (`id_cat`)
) ENGINE=MyISAM AUTO_INCREMENT=138 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `partes_autos`
--

INSERT INTO `partes_autos` (`id_parte`, `nombre`, `descripcion`, `precio`, `cantidad_stock`, `codigo_serie`, `id_marca`, `id_modelo`, `id_cat`, `imagen`, `imagen_thumbnail`, `fecha_registro`) VALUES
(1, 'nombre', 'descripcion', 0.00, 0, 'codigo_serie', 0, 0, 0, NULL, NULL, '0000-00-00 00:00:00'),
(2, 'nombre', 'descripcion', 0.00, 0, 'codigo_serie', 0, 0, 0, NULL, NULL, '0000-00-00 00:00:00'),
(3, 'Panel lateral', 'Panel lateral diseñado específicamente para vehículos Toyota modelo Corolla del año 2023. Forma part', 55.83, 13, 'TOY-COR-2023-PA', 1, 1, 1, NULL, NULL, '0000-00-00 00:00:00'),
(4, 'Panel lateral', 'Panel lateral diseñado específicamente para vehículos Toyota modelo Rav4 del año 2022. Forma parte d', 123.10, 6, 'TOY-RAV-2022-PA', 1, 2, 1, NULL, NULL, '0000-00-00 00:00:00'),
(5, 'Panel lateral', 'Panel lateral diseñado específicamente para vehículos Toyota modelo Prado del año 2011. Forma parte ', 83.82, 12, 'TOY-PRA-2011-PA', 1, 3, 1, NULL, NULL, '0000-00-00 00:00:00'),
(6, 'Panel lateral', 'Panel lateral diseñado específicamente para vehículos Mazda modelo CX-5 del año 2011. Forma parte de', 160.90, 17, 'MAZ-CX--2011-PA', 2, 4, 1, NULL, NULL, '0000-00-00 00:00:00'),
(7, 'Panel lateral', 'Panel lateral diseñado específicamente para vehículos Mazda modelo MX-5 Miata del año 2016. Forma pa', 123.32, 19, 'MAZ-MX--2016-PA', 2, 5, 1, NULL, NULL, '0000-00-00 00:00:00'),
(8, 'Panel lateral', 'Panel lateral diseñado específicamente para vehículos Mazda modelo CX-30 del año 2022. Forma parte d', 153.05, 9, 'MAZ-CX--2022-PA', 2, 6, 1, NULL, NULL, '0000-00-00 00:00:00'),
(9, 'Panel lateral', 'Panel lateral diseñado específicamente para vehículos Ford modelo Mustang del año 2005. Forma parte ', 235.11, 13, 'FOR-MUS-2005-PA', 3, 7, 1, NULL, NULL, '0000-00-00 00:00:00'),
(10, 'Panel lateral', 'Panel lateral diseñado específicamente para vehículos Ford modelo Escape del año 2012. Forma parte d', 221.17, 14, 'FOR-ESC-2012-PA', 3, 8, 1, NULL, NULL, '0000-00-00 00:00:00'),
(11, 'Panel lateral', 'Panel lateral diseñado específicamente para vehículos Ford modelo F-150 del año 2010. Forma parte de', 162.70, 8, 'FOR-F-1-2010-PA', 3, 9, 1, NULL, NULL, '0000-00-00 00:00:00'),
(12, 'Cofre', 'Cofre diseñado específicamente para vehículos Toyota modelo Corolla del año 2023. Forma parte de la ', 134.73, 14, 'TOY-COR-2023-CO', 1, 1, 1, NULL, NULL, '0000-00-00 00:00:00'),
(13, 'Cofre', 'Cofre diseñado específicamente para vehículos Toyota modelo Rav4 del año 2022. Forma parte de la cat', 217.70, 19, 'TOY-RAV-2022-CO', 1, 2, 1, NULL, NULL, '0000-00-00 00:00:00'),
(14, 'Cofre', 'Cofre diseñado específicamente para vehículos Toyota modelo Prado del año 2011. Forma parte de la ca', 198.90, 10, 'TOY-PRA-2011-CO', 1, 3, 1, NULL, NULL, '0000-00-00 00:00:00'),
(15, 'Cofre', 'Cofre diseñado específicamente para vehículos Mazda modelo CX-5 del año 2011. Forma parte de la cate', 181.40, 17, 'MAZ-CX--2011-CO', 2, 4, 1, NULL, NULL, '0000-00-00 00:00:00'),
(16, 'Cofre', 'Cofre diseñado específicamente para vehículos Mazda modelo MX-5 Miata del año 2016. Forma parte de l', 137.18, 18, 'MAZ-MX--2016-CO', 2, 5, 1, NULL, NULL, '0000-00-00 00:00:00'),
(17, 'Cofre', 'Cofre diseñado específicamente para vehículos Mazda modelo CX-30 del año 2022. Forma parte de la cat', 163.33, 11, 'MAZ-CX--2022-CO', 2, 6, 1, NULL, NULL, '0000-00-00 00:00:00'),
(18, 'Cofre', 'Cofre diseñado específicamente para vehículos Ford modelo Mustang del año 2005. Forma parte de la ca', 220.84, 19, 'FOR-MUS-2005-CO', 3, 7, 1, NULL, NULL, '0000-00-00 00:00:00'),
(19, 'Cofre', 'Cofre diseñado específicamente para vehículos Ford modelo Escape del año 2012. Forma parte de la cat', 117.75, 5, 'FOR-ESC-2012-CO', 3, 8, 1, NULL, NULL, '0000-00-00 00:00:00'),
(20, 'Cofre', 'Cofre diseñado específicamente para vehículos Ford modelo F-150 del año 2010. Forma parte de la cate', 42.50, 15, 'FOR-F-1-2010-CO', 3, 9, 1, NULL, NULL, '0000-00-00 00:00:00'),
(21, 'Guardafangos', 'Guardafangos diseñado específicamente para vehículos Toyota modelo Corolla del año 2023. Forma parte', 65.23, 19, 'TOY-COR-2023-GU', 1, 1, 1, NULL, NULL, '0000-00-00 00:00:00'),
(22, 'Guardafangos', 'Guardafangos diseñado específicamente para vehículos Toyota modelo Rav4 del año 2022. Forma parte de', 197.10, 14, 'TOY-RAV-2022-GU', 1, 2, 1, NULL, NULL, '0000-00-00 00:00:00'),
(23, 'Guardafangos', 'Guardafangos diseñado específicamente para vehículos Toyota modelo Prado del año 2011. Forma parte d', 122.17, 17, 'TOY-PRA-2011-GU', 1, 3, 1, NULL, NULL, '0000-00-00 00:00:00'),
(24, 'Guardafangos', 'Guardafangos diseñado específicamente para vehículos Mazda modelo CX-5 del año 2011. Forma parte de ', 64.72, 6, 'MAZ-CX--2011-GU', 2, 4, 1, NULL, NULL, '0000-00-00 00:00:00'),
(25, 'Guardafangos', 'Guardafangos diseñado específicamente para vehículos Mazda modelo MX-5 Miata del año 2016. Forma par', 231.58, 14, 'MAZ-MX--2016-GU', 2, 5, 1, NULL, NULL, '0000-00-00 00:00:00'),
(26, 'Guardafangos', 'Guardafangos diseñado específicamente para vehículos Mazda modelo CX-30 del año 2022. Forma parte de', 227.17, 20, 'MAZ-CX--2022-GU', 2, 6, 1, NULL, NULL, '0000-00-00 00:00:00'),
(27, 'Guardafangos', 'Guardafangos diseñado específicamente para vehículos Ford modelo Mustang del año 2005. Forma parte d', 182.07, 10, 'FOR-MUS-2005-GU', 3, 7, 1, NULL, NULL, '0000-00-00 00:00:00'),
(28, 'Guardafangos', 'Guardafangos diseñado específicamente para vehículos Ford modelo Escape del año 2012. Forma parte de', 35.82, 10, 'FOR-ESC-2012-GU', 3, 8, 1, NULL, NULL, '0000-00-00 00:00:00'),
(29, 'Guardafangos', 'Guardafangos diseñado específicamente para vehículos Ford modelo F-150 del año 2010. Forma parte de ', 53.83, 13, 'FOR-F-1-2010-GU', 3, 9, 1, NULL, NULL, '0000-00-00 00:00:00'),
(30, 'Bujías', 'Bujías diseñado específicamente para vehículos Toyota modelo Corolla del año 2023. Forma parte de la', 115.34, 15, 'TOY-COR-2023-BU', 1, 1, 2, NULL, NULL, '0000-00-00 00:00:00'),
(31, 'Bujías', 'Bujías diseñado específicamente para vehículos Toyota modelo Rav4 del año 2022. Forma parte de la ca', 69.33, 9, 'TOY-RAV-2022-BU', 1, 2, 2, NULL, NULL, '0000-00-00 00:00:00'),
(32, 'Bujías', 'Bujías diseñado específicamente para vehículos Toyota modelo Prado del año 2011. Forma parte de la c', 154.00, 20, 'TOY-PRA-2011-BU', 1, 3, 2, NULL, NULL, '0000-00-00 00:00:00'),
(33, 'Bujías', 'Bujías diseñado específicamente para vehículos Mazda modelo CX-5 del año 2011. Forma parte de la cat', 49.80, 6, 'MAZ-CX--2011-BU', 2, 4, 2, NULL, NULL, '0000-00-00 00:00:00'),
(34, 'Bujías', 'Bujías diseñado específicamente para vehículos Mazda modelo MX-5 Miata del año 2016. Forma parte de ', 208.69, 5, 'MAZ-MX--2016-BU', 2, 5, 2, NULL, NULL, '0000-00-00 00:00:00'),
(35, 'Bujías', 'Bujías diseñado específicamente para vehículos Mazda modelo CX-30 del año 2022. Forma parte de la ca', 145.13, 7, 'MAZ-CX--2022-BU', 2, 6, 2, NULL, NULL, '0000-00-00 00:00:00'),
(36, 'Bujías', 'Bujías diseñado específicamente para vehículos Ford modelo Mustang del año 2005. Forma parte de la c', 167.25, 15, 'FOR-MUS-2005-BU', 3, 7, 2, NULL, NULL, '0000-00-00 00:00:00'),
(37, 'Bujías', 'Bujías diseñado específicamente para vehículos Ford modelo Escape del año 2012. Forma parte de la ca', 165.97, 18, 'FOR-ESC-2012-BU', 3, 8, 2, NULL, NULL, '0000-00-00 00:00:00'),
(38, 'Bujías', 'Bujías diseñado específicamente para vehículos Ford modelo F-150 del año 2010. Forma parte de la cat', 129.55, 6, 'FOR-F-1-2010-BU', 3, 9, 2, NULL, NULL, '0000-00-00 00:00:00'),
(39, 'Radiador', 'Radiador diseñado específicamente para vehículos Toyota modelo Corolla del año 2023. Forma parte de ', 235.73, 7, 'TOY-COR-2023-RA', 1, 1, 2, NULL, NULL, '0000-00-00 00:00:00'),
(40, 'Radiador', 'Radiador diseñado específicamente para vehículos Toyota modelo Rav4 del año 2022. Forma parte de la ', 218.56, 14, 'TOY-RAV-2022-RA', 1, 2, 2, NULL, NULL, '0000-00-00 00:00:00'),
(41, 'Radiador', 'Radiador diseñado específicamente para vehículos Toyota modelo Prado del año 2011. Forma parte de la', 235.97, 20, 'TOY-PRA-2011-RA', 1, 3, 2, NULL, NULL, '0000-00-00 00:00:00'),
(42, 'Radiador', 'Radiador diseñado específicamente para vehículos Mazda modelo CX-5 del año 2011. Forma parte de la c', 99.06, 17, 'MAZ-CX--2011-RA', 2, 4, 2, NULL, NULL, '0000-00-00 00:00:00'),
(43, 'Radiador', 'Radiador diseñado específicamente para vehículos Mazda modelo MX-5 Miata del año 2016. Forma parte d', 198.69, 11, 'MAZ-MX--2016-RA', 2, 5, 2, NULL, NULL, '0000-00-00 00:00:00'),
(44, 'Radiador', 'Radiador diseñado específicamente para vehículos Mazda modelo CX-30 del año 2022. Forma parte de la ', 201.60, 14, 'MAZ-CX--2022-RA', 2, 6, 2, NULL, NULL, '0000-00-00 00:00:00'),
(45, 'Radiador', 'Radiador diseñado específicamente para vehículos Ford modelo Mustang del año 2005. Forma parte de la', 132.52, 15, 'FOR-MUS-2005-RA', 3, 7, 2, NULL, NULL, '0000-00-00 00:00:00'),
(46, 'Radiador', 'Radiador diseñado específicamente para vehículos Ford modelo Escape del año 2012. Forma parte de la ', 221.31, 15, 'FOR-ESC-2012-RA', 3, 8, 2, NULL, NULL, '0000-00-00 00:00:00'),
(47, 'Radiador', 'Radiador diseñado específicamente para vehículos Ford modelo F-150 del año 2010. Forma parte de la c', 169.59, 9, 'FOR-F-1-2010-RA', 3, 9, 2, NULL, NULL, '0000-00-00 00:00:00'),
(48, 'Alternador', 'Alternador diseñado específicamente para vehículos Toyota modelo Corolla del año 2023. Forma parte d', 168.21, 9, 'TOY-COR-2023-AL', 1, 1, 2, NULL, NULL, '0000-00-00 00:00:00'),
(49, 'Alternador', 'Alternador diseñado específicamente para vehículos Toyota modelo Rav4 del año 2022. Forma parte de l', 152.27, 16, 'TOY-RAV-2022-AL', 1, 2, 2, NULL, NULL, '0000-00-00 00:00:00'),
(50, 'Alternador', 'Alternador diseñado específicamente para vehículos Toyota modelo Prado del año 2011. Forma parte de ', 84.75, 6, 'TOY-PRA-2011-AL', 1, 3, 2, NULL, NULL, '0000-00-00 00:00:00'),
(51, 'Alternador', 'Alternador diseñado específicamente para vehículos Mazda modelo CX-5 del año 2011. Forma parte de la', 105.77, 16, 'MAZ-CX--2011-AL', 2, 4, 2, NULL, NULL, '0000-00-00 00:00:00'),
(52, 'Alternador', 'Alternador diseñado específicamente para vehículos Mazda modelo MX-5 Miata del año 2016. Forma parte', 41.76, 16, 'MAZ-MX--2016-AL', 2, 5, 2, NULL, NULL, '0000-00-00 00:00:00'),
(53, 'Alternador', 'Alternador diseñado específicamente para vehículos Mazda modelo CX-30 del año 2022. Forma parte de l', 174.56, 9, 'MAZ-CX--2022-AL', 2, 6, 2, NULL, NULL, '0000-00-00 00:00:00'),
(54, 'Alternador', 'Alternador diseñado específicamente para vehículos Ford modelo Mustang del año 2005. Forma parte de ', 152.48, 19, 'FOR-MUS-2005-AL', 3, 7, 2, NULL, NULL, '0000-00-00 00:00:00'),
(55, 'Alternador', 'Alternador diseñado específicamente para vehículos Ford modelo Escape del año 2012. Forma parte de l', 26.61, 11, 'FOR-ESC-2012-AL', 3, 8, 2, NULL, NULL, '0000-00-00 00:00:00'),
(56, 'Alternador', 'Alternador diseñado específicamente para vehículos Ford modelo F-150 del año 2010. Forma parte de la', 129.91, 18, 'FOR-F-1-2010-AL', 3, 9, 2, NULL, NULL, '0000-00-00 00:00:00'),
(57, 'Manija exterior', 'Manija exterior diseñado específicamente para vehículos Toyota modelo Corolla del año 2023. Forma pa', 116.73, 10, 'TOY-COR-2023-MA', 1, 1, 3, NULL, NULL, '0000-00-00 00:00:00'),
(58, 'Manija exterior', 'Manija exterior diseñado específicamente para vehículos Toyota modelo Rav4 del año 2022. Forma parte', 78.17, 20, 'TOY-RAV-2022-MA', 1, 2, 3, NULL, NULL, '0000-00-00 00:00:00'),
(59, 'Manija exterior', 'Manija exterior diseñado específicamente para vehículos Toyota modelo Prado del año 2011. Forma part', 108.01, 15, 'TOY-PRA-2011-MA', 1, 3, 3, NULL, NULL, '0000-00-00 00:00:00'),
(60, 'Manija exterior', 'Manija exterior diseñado específicamente para vehículos Mazda modelo CX-5 del año 2011. Forma parte ', 43.39, 15, 'MAZ-CX--2011-MA', 2, 4, 3, NULL, NULL, '0000-00-00 00:00:00'),
(61, 'Manija exterior', 'Manija exterior diseñado específicamente para vehículos Mazda modelo MX-5 Miata del año 2016. Forma ', 134.14, 18, 'MAZ-MX--2016-MA', 2, 5, 3, NULL, NULL, '0000-00-00 00:00:00'),
(62, 'Manija exterior', 'Manija exterior diseñado específicamente para vehículos Mazda modelo CX-30 del año 2022. Forma parte', 60.12, 13, 'MAZ-CX--2022-MA', 2, 6, 3, NULL, NULL, '0000-00-00 00:00:00'),
(63, 'Manija exterior', 'Manija exterior diseñado específicamente para vehículos Ford modelo Mustang del año 2005. Forma part', 179.22, 6, 'FOR-MUS-2005-MA', 3, 7, 3, NULL, NULL, '0000-00-00 00:00:00'),
(64, 'Manija exterior', 'Manija exterior diseñado específicamente para vehículos Ford modelo Escape del año 2012. Forma parte', 132.07, 11, 'FOR-ESC-2012-MA', 3, 8, 3, NULL, NULL, '0000-00-00 00:00:00'),
(65, 'Manija exterior', 'Manija exterior diseñado específicamente para vehículos Ford modelo F-150 del año 2010. Forma parte ', 87.04, 14, 'FOR-F-1-2010-MA', 3, 9, 3, NULL, NULL, '0000-00-00 00:00:00'),
(66, 'Bisagra de puerta', 'Bisagra de puerta diseñado específicamente para vehículos Toyota modelo Corolla del año 2023. Forma ', 205.75, 9, 'TOY-COR-2023-BI', 1, 1, 3, NULL, NULL, '0000-00-00 00:00:00'),
(67, 'Bisagra de puerta', 'Bisagra de puerta diseñado específicamente para vehículos Toyota modelo Rav4 del año 2022. Forma par', 178.36, 13, 'TOY-RAV-2022-BI', 1, 2, 3, NULL, NULL, '0000-00-00 00:00:00'),
(68, 'Bisagra de puerta', 'Bisagra de puerta diseñado específicamente para vehículos Toyota modelo Prado del año 2011. Forma pa', 168.15, 7, 'TOY-PRA-2011-BI', 1, 3, 3, NULL, NULL, '0000-00-00 00:00:00'),
(69, 'Bisagra de puerta', 'Bisagra de puerta diseñado específicamente para vehículos Mazda modelo CX-5 del año 2011. Forma part', 149.94, 17, 'MAZ-CX--2011-BI', 2, 4, 3, NULL, NULL, '0000-00-00 00:00:00'),
(70, 'Bisagra de puerta', 'Bisagra de puerta diseñado específicamente para vehículos Mazda modelo MX-5 Miata del año 2016. Form', 71.29, 11, 'MAZ-MX--2016-BI', 2, 5, 3, NULL, NULL, '0000-00-00 00:00:00'),
(71, 'Bisagra de puerta', 'Bisagra de puerta diseñado específicamente para vehículos Mazda modelo CX-30 del año 2022. Forma par', 143.26, 10, 'MAZ-CX--2022-BI', 2, 6, 3, NULL, NULL, '0000-00-00 00:00:00'),
(72, 'Bisagra de puerta', 'Bisagra de puerta diseñado específicamente para vehículos Ford modelo Mustang del año 2005. Forma pa', 208.35, 11, 'FOR-MUS-2005-BI', 3, 7, 3, NULL, NULL, '0000-00-00 00:00:00'),
(73, 'Bisagra de puerta', 'Bisagra de puerta diseñado específicamente para vehículos Ford modelo Escape del año 2012. Forma par', 128.35, 17, 'FOR-ESC-2012-BI', 3, 8, 3, NULL, NULL, '0000-00-00 00:00:00'),
(74, 'Bisagra de puerta', 'Bisagra de puerta diseñado específicamente para vehículos Ford modelo F-150 del año 2010. Forma part', 98.98, 12, 'FOR-F-1-2010-BI', 3, 9, 3, NULL, NULL, '0000-00-00 00:00:00'),
(75, 'Panel de puerta', 'Panel de puerta diseñado específicamente para vehículos Toyota modelo Corolla del año 2023. Forma pa', 244.67, 5, 'TOY-COR-2023-PA', 1, 1, 3, NULL, NULL, '0000-00-00 00:00:00'),
(76, 'Panel de puerta', 'Panel de puerta diseñado específicamente para vehículos Toyota modelo Rav4 del año 2022. Forma parte', 227.99, 19, 'TOY-RAV-2022-PA', 1, 2, 3, NULL, NULL, '0000-00-00 00:00:00'),
(77, 'Panel de puerta', 'Panel de puerta diseñado específicamente para vehículos Toyota modelo Prado del año 2011. Forma part', 155.53, 12, 'TOY-PRA-2011-PA', 1, 3, 3, NULL, NULL, '0000-00-00 00:00:00'),
(78, 'Panel de puerta', 'Panel de puerta diseñado específicamente para vehículos Mazda modelo CX-5 del año 2011. Forma parte ', 163.83, 7, 'MAZ-CX--2011-PA', 2, 4, 3, NULL, NULL, '0000-00-00 00:00:00'),
(79, 'Panel de puerta', 'Panel de puerta diseñado específicamente para vehículos Mazda modelo MX-5 Miata del año 2016. Forma ', 239.64, 6, 'MAZ-MX--2016-PA', 2, 5, 3, NULL, NULL, '0000-00-00 00:00:00'),
(80, 'Panel de puerta', 'Panel de puerta diseñado específicamente para vehículos Mazda modelo CX-30 del año 2022. Forma parte', 146.79, 14, 'MAZ-CX--2022-PA', 2, 6, 3, NULL, NULL, '0000-00-00 00:00:00'),
(81, 'Panel de puerta', 'Panel de puerta diseñado específicamente para vehículos Ford modelo Mustang del año 2005. Forma part', 62.32, 12, 'FOR-MUS-2005-PA', 3, 7, 3, NULL, NULL, '0000-00-00 00:00:00'),
(82, 'Panel de puerta', 'Panel de puerta diseñado específicamente para vehículos Ford modelo Escape del año 2012. Forma parte', 224.20, 6, 'FOR-ESC-2012-PA', 3, 8, 3, NULL, NULL, '0000-00-00 00:00:00'),
(83, 'Panel de puerta', 'Panel de puerta diseñado específicamente para vehículos Ford modelo F-150 del año 2010. Forma parte ', 98.06, 19, 'FOR-F-1-2010-PA', 3, 9, 3, NULL, NULL, '0000-00-00 00:00:00'),
(84, 'Parabrisas delantero', 'Parabrisas delantero diseñado específicamente para vehículos Toyota modelo Corolla del año 2023. For', 186.62, 7, 'TOY-COR-2023-PA', 1, 1, 4, NULL, NULL, '0000-00-00 00:00:00'),
(85, 'Parabrisas delantero', 'Parabrisas delantero diseñado específicamente para vehículos Toyota modelo Rav4 del año 2022. Forma ', 232.74, 20, 'TOY-RAV-2022-PA', 1, 2, 4, NULL, NULL, '0000-00-00 00:00:00'),
(86, 'Parabrisas delantero', 'Parabrisas delantero diseñado específicamente para vehículos Toyota modelo Prado del año 2011. Forma', 48.60, 20, 'TOY-PRA-2011-PA', 1, 3, 4, NULL, NULL, '0000-00-00 00:00:00'),
(87, 'Parabrisas delantero', 'Parabrisas delantero diseñado específicamente para vehículos Mazda modelo CX-5 del año 2011. Forma p', 143.38, 10, 'MAZ-CX--2011-PA', 2, 4, 4, NULL, NULL, '0000-00-00 00:00:00'),
(88, 'Parabrisas delantero', 'Parabrisas delantero diseñado específicamente para vehículos Mazda modelo MX-5 Miata del año 2016. F', 239.41, 13, 'MAZ-MX--2016-PA', 2, 5, 4, NULL, NULL, '0000-00-00 00:00:00'),
(89, 'Parabrisas delantero', 'Parabrisas delantero diseñado específicamente para vehículos Mazda modelo CX-30 del año 2022. Forma ', 196.64, 5, 'MAZ-CX--2022-PA', 2, 6, 4, NULL, NULL, '0000-00-00 00:00:00'),
(90, 'Parabrisas delantero', 'Parabrisas delantero diseñado específicamente para vehículos Ford modelo Mustang del año 2005. Forma', 191.26, 7, 'FOR-MUS-2005-PA', 3, 7, 4, NULL, NULL, '0000-00-00 00:00:00'),
(91, 'Parabrisas delantero', 'Parabrisas delantero diseñado específicamente para vehículos Ford modelo Escape del año 2012. Forma ', 147.10, 15, 'FOR-ESC-2012-PA', 3, 8, 4, NULL, NULL, '0000-00-00 00:00:00'),
(92, 'Parabrisas delantero', 'Parabrisas delantero diseñado específicamente para vehículos Ford modelo F-150 del año 2010. Forma p', 76.54, 19, 'FOR-F-1-2010-PA', 3, 9, 4, NULL, NULL, '0000-00-00 00:00:00'),
(93, 'Luna lateral', 'Luna lateral diseñado específicamente para vehículos Toyota modelo Corolla del año 2023. Forma parte', 34.26, 10, 'TOY-COR-2023-LU', 1, 1, 4, NULL, NULL, '0000-00-00 00:00:00'),
(94, 'Luna lateral', 'Luna lateral diseñado específicamente para vehículos Toyota modelo Rav4 del año 2022. Forma parte de', 67.61, 6, 'TOY-RAV-2022-LU', 1, 2, 4, NULL, NULL, '0000-00-00 00:00:00'),
(95, 'Luna lateral', 'Luna lateral diseñado específicamente para vehículos Toyota modelo Prado del año 2011. Forma parte d', 124.54, 9, 'TOY-PRA-2011-LU', 1, 3, 4, NULL, NULL, '0000-00-00 00:00:00'),
(96, 'Luna lateral', 'Luna lateral diseñado específicamente para vehículos Mazda modelo CX-5 del año 2011. Forma parte de ', 75.67, 9, 'MAZ-CX--2011-LU', 2, 4, 4, NULL, NULL, '0000-00-00 00:00:00'),
(97, 'Luna lateral', 'Luna lateral diseñado específicamente para vehículos Mazda modelo MX-5 Miata del año 2016. Forma par', 130.93, 9, 'MAZ-MX--2016-LU', 2, 5, 4, NULL, NULL, '0000-00-00 00:00:00'),
(98, 'Luna lateral', 'Luna lateral diseñado específicamente para vehículos Mazda modelo CX-30 del año 2022. Forma parte de', 207.64, 5, 'MAZ-CX--2022-LU', 2, 6, 4, NULL, NULL, '0000-00-00 00:00:00'),
(99, 'Luna lateral', 'Luna lateral diseñado específicamente para vehículos Ford modelo Mustang del año 2005. Forma parte d', 81.98, 14, 'FOR-MUS-2005-LU', 3, 7, 4, NULL, NULL, '0000-00-00 00:00:00'),
(100, 'Luna lateral', 'Luna lateral diseñado específicamente para vehículos Ford modelo Escape del año 2012. Forma parte de', 180.14, 20, 'FOR-ESC-2012-LU', 3, 8, 4, NULL, NULL, '0000-00-00 00:00:00'),
(101, 'Luna lateral', 'Luna lateral diseñado específicamente para vehículos Ford modelo F-150 del año 2010. Forma parte de ', 184.60, 12, 'FOR-F-1-2010-LU', 3, 9, 4, NULL, NULL, '0000-00-00 00:00:00'),
(102, 'Cristal de ventana triangular', 'Cristal de ventana triangular diseñado específicamente para vehículos Toyota modelo Corolla del año ', 222.38, 11, 'TOY-COR-2023-CR', 1, 1, 4, NULL, NULL, '0000-00-00 00:00:00'),
(103, 'Cristal de ventana triangular', 'Cristal de ventana triangular diseñado específicamente para vehículos Toyota modelo Rav4 del año 202', 93.76, 7, 'TOY-RAV-2022-CR', 1, 2, 4, NULL, NULL, '0000-00-00 00:00:00'),
(104, 'Cristal de ventana triangular', 'Cristal de ventana triangular diseñado específicamente para vehículos Toyota modelo Prado del año 20', 195.81, 15, 'TOY-PRA-2011-CR', 1, 3, 4, NULL, NULL, '0000-00-00 00:00:00'),
(105, 'Cristal de ventana triangular', 'Cristal de ventana triangular diseñado específicamente para vehículos Mazda modelo CX-5 del año 2011', 175.40, 5, 'MAZ-CX--2011-CR', 2, 4, 4, NULL, NULL, '0000-00-00 00:00:00'),
(106, 'Cristal de ventana triangular', 'Cristal de ventana triangular diseñado específicamente para vehículos Mazda modelo MX-5 Miata del añ', 102.08, 18, 'MAZ-MX--2016-CR', 2, 5, 4, NULL, NULL, '0000-00-00 00:00:00'),
(107, 'Cristal de ventana triangular', 'Cristal de ventana triangular diseñado específicamente para vehículos Mazda modelo CX-30 del año 202', 196.65, 6, 'MAZ-CX--2022-CR', 2, 6, 4, NULL, NULL, '0000-00-00 00:00:00'),
(108, 'Cristal de ventana triangular', 'Cristal de ventana triangular diseñado específicamente para vehículos Ford modelo Mustang del año 20', 128.88, 6, 'FOR-MUS-2005-CR', 3, 7, 4, NULL, NULL, '0000-00-00 00:00:00'),
(109, 'Cristal de ventana triangular', 'Cristal de ventana triangular diseñado específicamente para vehículos Ford modelo Escape del año 201', 49.70, 20, 'FOR-ESC-2012-CR', 3, 8, 4, NULL, NULL, '0000-00-00 00:00:00'),
(110, 'Cristal de ventana triangular', 'Cristal de ventana triangular diseñado específicamente para vehículos Ford modelo F-150 del año 2010', 109.52, 18, 'FOR-F-1-2010-CR', 3, 9, 4, NULL, NULL, '0000-00-00 00:00:00'),
(111, 'Espejo retrovisor interior', 'Espejo retrovisor interior diseñado específicamente para vehículos Toyota modelo Corolla del año 202', 125.15, 6, 'TOY-COR-2023-ES', 1, 1, 5, NULL, NULL, '0000-00-00 00:00:00'),
(112, 'Espejo retrovisor interior', 'Espejo retrovisor interior diseñado específicamente para vehículos Toyota modelo Rav4 del año 2022. ', 107.57, 19, 'TOY-RAV-2022-ES', 1, 2, 5, NULL, NULL, '0000-00-00 00:00:00'),
(113, 'Espejo retrovisor interior', 'Espejo retrovisor interior diseñado específicamente para vehículos Toyota modelo Prado del año 2011.', 155.65, 6, 'TOY-PRA-2011-ES', 1, 3, 5, NULL, NULL, '0000-00-00 00:00:00'),
(114, 'Espejo retrovisor interior', 'Espejo retrovisor interior diseñado específicamente para vehículos Mazda modelo CX-5 del año 2011. F', 150.71, 7, 'MAZ-CX--2011-ES', 2, 4, 5, NULL, NULL, '0000-00-00 00:00:00'),
(115, 'Espejo retrovisor interior', 'Espejo retrovisor interior diseñado específicamente para vehículos Mazda modelo MX-5 Miata del año 2', 175.30, 18, 'MAZ-MX--2016-ES', 2, 5, 5, NULL, NULL, '0000-00-00 00:00:00'),
(116, 'Espejo retrovisor interior', 'Espejo retrovisor interior diseñado específicamente para vehículos Mazda modelo CX-30 del año 2022. ', 46.74, 17, 'MAZ-CX--2022-ES', 2, 6, 5, NULL, NULL, '0000-00-00 00:00:00'),
(117, 'Espejo retrovisor interior', 'Espejo retrovisor interior diseñado específicamente para vehículos Ford modelo Mustang del año 2005.', 169.63, 7, 'FOR-MUS-2005-ES', 3, 7, 5, NULL, NULL, '0000-00-00 00:00:00'),
(118, 'Espejo retrovisor interior', 'Espejo retrovisor interior diseñado específicamente para vehículos Ford modelo Escape del año 2012. ', 165.22, 18, 'FOR-ESC-2012-ES', 3, 8, 5, NULL, NULL, '0000-00-00 00:00:00'),
(119, 'Espejo retrovisor interior', 'Espejo retrovisor interior diseñado específicamente para vehículos Ford modelo F-150 del año 2010. F', 32.74, 18, 'FOR-F-1-2010-ES', 3, 9, 5, NULL, NULL, '0000-00-00 00:00:00'),
(120, 'Espejo retrovisor exterior izquierdo', 'Espejo retrovisor exterior izquierdo diseñado específicamente para vehículos Toyota modelo Corolla d', 200.52, 11, 'TOY-COR-2023-ES', 1, 1, 5, NULL, NULL, '0000-00-00 00:00:00'),
(121, 'Espejo retrovisor exterior izquierdo', 'Espejo retrovisor exterior izquierdo diseñado específicamente para vehículos Toyota modelo Rav4 del ', 201.80, 8, 'TOY-RAV-2022-ES', 1, 2, 5, NULL, NULL, '0000-00-00 00:00:00'),
(122, 'Espejo retrovisor exterior izquierdo', 'Espejo retrovisor exterior izquierdo diseñado específicamente para vehículos Toyota modelo Prado del', 40.89, 16, 'TOY-PRA-2011-ES', 1, 3, 5, NULL, NULL, '0000-00-00 00:00:00'),
(123, 'Espejo retrovisor exterior izquierdo', 'Espejo retrovisor exterior izquierdo diseñado específicamente para vehículos Mazda modelo CX-5 del a', 41.00, 17, 'MAZ-CX--2011-ES', 2, 4, 5, NULL, NULL, '0000-00-00 00:00:00'),
(124, 'Espejo retrovisor exterior izquierdo', 'Espejo retrovisor exterior izquierdo diseñado específicamente para vehículos Mazda modelo MX-5 Miata', 132.10, 17, 'MAZ-MX--2016-ES', 2, 5, 5, NULL, NULL, '0000-00-00 00:00:00'),
(125, 'Espejo retrovisor exterior izquierdo', 'Espejo retrovisor exterior izquierdo diseñado específicamente para vehículos Mazda modelo CX-30 del ', 154.48, 17, 'MAZ-CX--2022-ES', 2, 6, 5, NULL, NULL, '0000-00-00 00:00:00'),
(126, 'Espejo retrovisor exterior izquierdo', 'Espejo retrovisor exterior izquierdo diseñado específicamente para vehículos Ford modelo Mustang del', 129.63, 6, 'FOR-MUS-2005-ES', 3, 7, 5, NULL, NULL, '0000-00-00 00:00:00'),
(127, 'Espejo retrovisor exterior izquierdo', 'Espejo retrovisor exterior izquierdo diseñado específicamente para vehículos Ford modelo Escape del ', 137.95, 10, 'FOR-ESC-2012-ES', 3, 8, 5, NULL, NULL, '0000-00-00 00:00:00'),
(128, 'Espejo retrovisor exterior izquierdo', 'Espejo retrovisor exterior izquierdo diseñado específicamente para vehículos Ford modelo F-150 del a', 198.39, 5, 'FOR-F-1-2010-ES', 3, 9, 5, NULL, NULL, '0000-00-00 00:00:00'),
(129, 'Cristal de espejo de repuesto', 'Cristal de espejo de repuesto diseñado específicamente para vehículos Toyota modelo Corolla del año ', 147.73, 17, 'TOY-COR-2023-CR', 1, 1, 5, NULL, NULL, '0000-00-00 00:00:00'),
(130, 'Cristal de espejo de repuesto', 'Cristal de espejo de repuesto diseñado específicamente para vehículos Toyota modelo Rav4 del año 202', 133.40, 9, 'TOY-RAV-2022-CR', 1, 2, 5, NULL, NULL, '0000-00-00 00:00:00'),
(131, 'Cristal de espejo de repuesto', 'Cristal de espejo de repuesto diseñado específicamente para vehículos Toyota modelo Prado del año 20', 78.17, 19, 'TOY-PRA-2011-CR', 1, 3, 5, NULL, NULL, '0000-00-00 00:00:00'),
(132, 'Cristal de espejo de repuesto', 'Cristal de espejo de repuesto diseñado específicamente para vehículos Mazda modelo CX-5 del año 2011', 129.31, 19, 'MAZ-CX--2011-CR', 2, 4, 5, NULL, NULL, '0000-00-00 00:00:00'),
(133, 'Cristal de espejo de repuesto', 'Cristal de espejo de repuesto diseñado específicamente para vehículos Mazda modelo MX-5 Miata del añ', 153.35, 16, 'MAZ-MX--2016-CR', 2, 5, 5, NULL, NULL, '0000-00-00 00:00:00'),
(134, 'Cristal de espejo de repuesto', 'Cristal de espejo de repuesto diseñado específicamente para vehículos Mazda modelo CX-30 del año 202', 111.45, 12, 'MAZ-CX--2022-CR', 2, 6, 5, NULL, NULL, '0000-00-00 00:00:00'),
(135, 'Cristal de espejo de repuesto', 'Cristal de espejo de repuesto diseñado específicamente para vehículos Ford modelo Mustang del año 20', 234.86, 9, 'FOR-MUS-2005-CR', 3, 7, 5, NULL, NULL, '0000-00-00 00:00:00'),
(136, 'Cristal de espejo de repuesto', 'Cristal de espejo de repuesto diseñado específicamente para vehículos Ford modelo Escape del año 201', 172.74, 11, 'FOR-ESC-2012-CR', 3, 8, 5, NULL, NULL, '0000-00-00 00:00:00'),
(137, 'Cristal de espejo de repuesto', 'Cristal de espejo de repuesto diseñado específicamente para vehículos Ford modelo F-150 del año 2010', 44.91, 9, 'FOR-F-1-2010-CR', 3, 9, 5, NULL, NULL, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `parte_vendida`
--

DROP TABLE IF EXISTS `parte_vendida`;
CREATE TABLE IF NOT EXISTS `parte_vendida` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_factura` int DEFAULT NULL,
  `id_parte` int NOT NULL,
  `id_usuario` int NOT NULL,
  `cantidad` int NOT NULL,
  `precio_total` decimal(10,2) NOT NULL,
  `fecha_venta` datetime DEFAULT CURRENT_TIMESTAMP,
  `en_carrito` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `id_parte` (`id_parte`),
  KEY `id_usuario` (`id_usuario`),
  KEY `id_factura` (`id_factura`)
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
) ENGINE=MyISAM AUTO_INCREMENT=91 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(52, 'usuario_intentos', 'Select LOGIN_OK', 1, 'admin', '::1', '2025-07-21 16:33:24'),
(53, 'usuario_intentos', 'Select LOGIN_FAIL', 1, 'admin', '::1', '2025-07-21 16:39:35'),
(54, 'usuario_intentos', 'Select LOGIN_FAIL', 1, 'admin', '::1', '2025-07-21 16:40:22'),
(55, 'usuario_intentos', 'Select LOGIN_OK', 1, 'admin', '::1', '2025-07-21 16:41:03'),
(56, 'usuario_intentos', 'Select LOGIN_OK', 4, 'salmon', '::1', '2025-07-21 16:43:56'),
(57, 'usuario_intentos', 'Select LOGIN_FAIL', 2, 'yonielvegas', '::1', '2025-07-21 16:53:52'),
(58, 'usuario_intentos', 'Select LOGIN_FAIL', 2, 'yonielvegas', '::1', '2025-07-21 16:54:03'),
(59, 'usuario_intentos', 'Select LOGIN_OK', 1, 'admin', '::1', '2025-07-21 17:06:45'),
(60, 'usuario_intentos', 'Select LOGIN_FAIL', 2, 'yonielvegas', '::1', '2025-07-21 17:35:41'),
(61, 'usuario_intentos', 'Select LOGIN_FAIL', 2, 'yonielvegas', '::1', '2025-07-21 17:36:14'),
(62, 'usuario_intentos', 'Select LOGIN_OK', 2, 'yonielvegas', '::1', '2025-07-21 17:37:11'),
(63, 'usuario_intentos', 'Select LOGIN_OK', 1, 'admin', '::1', '2025-07-21 17:44:06'),
(64, 'usuario_intentos', 'Select LOGIN_FAIL', 1, 'admin', '::1', '2025-07-21 18:28:26'),
(65, 'usuario_intentos', 'Select LOGIN_OK', 1, 'admin', '::1', '2025-07-21 18:28:36'),
(66, 'usuario_intentos', 'Select LOGIN_OK', 1, 'admin', '::1', '2025-07-21 18:33:48'),
(67, 'usuario_intentos', 'Select LOGIN_OK', 1, 'admin', '::1', '2025-07-21 18:38:52'),
(68, 'usuario_intentos', 'Select LOGIN_FAIL', 1, 'admin', '::1', '2025-07-21 18:41:48'),
(69, 'usuario_intentos', 'Select LOGIN_OK', 1, 'admin', '::1', '2025-07-21 18:42:00'),
(70, 'usuario_intentos', 'Select LOGIN_FAIL', 2, 'yonielvegas', '::1', '2025-07-21 18:49:23'),
(71, 'usuario_intentos', 'Select LOGIN_FAIL', 2, 'yonielvegas', '::1', '2025-07-21 18:49:30'),
(72, 'usuario_intentos', 'Select LOGIN_OK', 2, 'yonielvegas', '::1', '2025-07-21 18:49:39'),
(73, 'usuario_intentos', 'Select LOGIN_FAIL', 2, 'yonielvegas', '::1', '2025-07-21 18:49:50'),
(74, 'usuario_intentos', 'Select LOGIN_FAIL', 2, 'yonielvegas', '::1', '2025-07-21 18:49:58'),
(75, 'usuario_intentos', 'Select LOGIN_FAIL', 2, 'yonielvegas', '::1', '2025-07-21 18:50:03'),
(76, 'usuario_intentos', 'Select LOGIN_OK', 2, 'yonielvegas', '::1', '2025-07-21 18:50:27'),
(77, 'usuario_intentos', 'Select LOGIN_OK', 2, 'yonielvegas', '::1', '2025-07-21 18:57:17'),
(78, 'usuario_intentos', 'Select LOGIN_OK', 2, 'yonielvegas', '::1', '2025-07-21 19:00:58'),
(79, 'usuario_intentos', 'Select LOGIN_FAIL', 2, 'yonielvegas', '::1', '2025-07-21 19:01:04'),
(80, 'usuario_intentos', 'Select LOGIN_OK', 2, 'yonielvegas', '::1', '2025-07-21 19:03:26'),
(81, 'usuario_intentos', 'Select LOGIN_OK', 2, 'yonielvegas', '::1', '2025-07-21 19:03:46'),
(82, 'usuario_intentos', 'Select LOGIN_OK', 2, 'yonielvegas', '::1', '2025-07-21 19:08:09'),
(83, 'usuario_intentos', 'Select LOGIN_OK', 2, 'yonielvegas', '::1', '2025-07-21 19:10:38'),
(84, 'usuario_intentos', 'Select LOGIN_OK', 2, 'yonielvegas', '::1', '2025-07-21 19:17:12'),
(85, 'usuario_intentos', 'Select LOGIN_OK', 2, 'yonielvegas', '::1', '2025-07-21 21:10:59'),
(86, 'usuario_intentos', 'Select LOGIN_OK', 1, 'admin', '::1', '2025-07-21 21:11:10'),
(87, 'usuario_intentos', 'Select LOGIN_OK', 2, 'yonielvegas', '::1', '2025-07-21 21:14:55'),
(88, 'usuario_intentos', 'Select LOGIN_OK', 2, 'yonielvegas', '::1', '2025-07-21 21:15:04'),
(89, 'usuario_intentos', 'Select LOGIN_OK', 2, 'yonielvegas', '::1', '2025-07-21 21:15:05'),
(90, 'usuario_intentos', 'Select LOGIN_OK', 1, 'admin', '::1', '2025-07-21 22:15:38');

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
(1, 'Administrador', 'General', 'admin@example.com', '0000000000', 'admin', '$2y$10$EzDMd99mA87WwNFOxRDNLOBaSzOMyacQ9lA.q9U/rv6KOD7mjUU9S', 1),
(2, 'Yoel', 'Samaniego', 'yoelsamaniego4@gmail.com', '62834187', 'yonielvegas', '$2y$13$oLl9aizqjfwO1FSfpNBkYOZ1BW2umti5ivUxHuPpq7th1KKp6fiHy', 1),
(3, 'Ana', 'Pinto', 'anapinto@gmail.com', '62873192', 'anap', '$2y$10$aiKOJXZ.r.an3oT5OZNO4eBTB.6YMvGdNGEgCdmBtv5wVSiBbQMbu', 1),
(4, 'Irina', 'Fong', 'IrinaF@gmail.com', '34675632', 'salmon', '$2y$10$Kca2hIpI079gLHZsSuSnoOz49P/Qc62q5SZFJ8OeQbUeVCjRGyOH6', 1),
(5, 'pedro', 'perez', 'pedro@gmail.com', '232344534', 'pedro2', '$2y$10$F0zK73ivGOC1xIlu9tnFDu93HLG5EFERCWXjLyIZRxSnlSh9E06aC', 1),
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
(4, 4, 2),
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
(4, 4, 0, 0),
(5, 5, 1, 0),
(6, 6, 1, 0);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
