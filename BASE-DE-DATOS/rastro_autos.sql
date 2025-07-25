-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 24-07-2025 a las 18:02:35
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
  `categoria` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
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
  `estado` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_factura`)
) ENGINE=MyISAM AUTO_INCREMENT=66 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `factura`
--

INSERT INTO `factura` (`id_factura`, `fecha`, `total_factura`, `estado`) VALUES
(1, '2025-07-23 12:38:38', 614.81, 1),
(2, '2025-07-23 16:36:06', 462.00, 1),
(3, '2025-07-23 16:49:29', 462.00, 1),
(4, '2025-07-23 16:51:13', 462.00, 1),
(5, '2025-07-23 17:03:55', 154.00, 1),
(6, '2025-07-23 17:06:13', 154.00, 1),
(7, '2025-07-23 17:09:49', 154.00, 1),
(8, '2025-07-23 17:12:18', 380.40, 1),
(9, '2025-07-23 17:14:50', 1005.84, 1),
(10, '2025-03-05 09:15:22', 321.80, 1),
(11, '2025-03-08 11:30:45', 452.42, 1),
(12, '2025-03-12 14:20:33', 462.00, 1),
(13, '2025-03-15 10:45:12', 326.57, 1),
(14, '2025-03-18 16:30:28', 466.97, 1),
(15, '2025-03-22 13:10:55', 281.43, 1),
(16, '2025-03-25 09:30:17', 392.37, 1),
(17, '2025-03-28 15:45:39', 683.30, 1),
(18, '2025-04-02 10:20:11', 217.70, 1),
(19, '2025-04-05 14:35:44', 572.83, 1),
(20, '2025-04-08 11:10:33', 314.72, 1),
(21, '2025-04-12 16:25:19', 414.53, 1),
(22, '2025-04-15 09:40:27', 532.96, 1),
(23, '2025-04-18 13:15:48', 370.34, 1),
(24, '2025-04-22 10:30:56', 383.04, 1),
(25, '2025-04-25 15:20:14', 514.10, 1),
(26, '2025-04-28 11:45:37', 233.53, 1),
(27, '2025-05-03 09:10:22', 387.66, 1),
(28, '2025-05-06 14:25:43', 305.30, 1),
(29, '2025-05-10 11:30:15', 410.26, 1),
(30, '2025-05-13 16:40:29', 355.14, 1),
(31, '2025-05-16 10:15:38', 340.94, 1),
(32, '2025-05-19 13:50:47', 313.48, 1),
(33, '2025-05-22 09:20:16', 433.63, 1),
(34, '2025-05-25 15:35:24', 435.77, 1),
(35, '2025-05-28 11:05:33', 260.28, 1),
(36, '2025-05-30 14:45:52', 378.09, 1),
(37, '2025-06-02 10:30:11', 269.00, 1),
(38, '2025-06-05 13:20:39', 179.22, 1),
(39, '2025-06-09 16:10:28', 409.41, 1),
(40, '2025-06-12 09:45:17', 342.73, 1),
(41, '2025-06-15 14:30:44', 379.84, 1),
(42, '2025-06-18 11:15:33', 176.62, 1),
(43, '2025-06-21 15:25:19', 263.42, 1),
(44, '2025-06-24 10:40:27', 401.34, 1),
(45, '2025-06-27 13:50:38', 245.52, 1),
(46, '2025-06-30 16:20:15', 441.78, 1),
(47, '2025-07-03 09:30:22', 213.13, 1),
(48, '2025-07-06 14:15:43', 294.90, 1),
(49, '2025-07-10 11:25:15', 214.30, 1),
(50, '2025-07-13 16:35:29', 261.60, 1),
(51, '2025-07-16 10:20:38', 357.90, 1),
(52, '2025-07-19 13:40:47', 163.83, 1),
(53, '2025-07-22 09:10:16', 234.76, 1),
(54, '2025-07-23 10:30:24', 244.72, 1),
(55, '2025-07-23 11:45:33', 344.49, 1),
(56, '2025-07-23 13:20:52', 297.43, 1),
(57, '2025-07-23 14:35:11', 217.70, 1),
(58, '2025-07-23 15:50:39', 358.02, 1),
(59, '2025-07-23 16:10:28', 160.25, 1),
(60, '2025-07-23 17:25:17', 384.50, 1),
(61, '2025-07-23 18:30:44', 413.65, 1),
(62, '2025-07-23 19:45:33', 204.99, 1),
(63, '2025-07-23 20:15:19', 223.33, 1),
(64, '2025-07-23 21:30:27', 353.82, 1),
(65, '2025-07-23 22:45:38', 296.80, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `marca`
--

DROP TABLE IF EXISTS `marca`;
CREATE TABLE IF NOT EXISTS `marca` (
  `id_marca` int NOT NULL,
  `marca` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
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
  `modelo` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
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
  `nombre` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `descripcion` varchar(800) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `precio` decimal(10,2) NOT NULL,
  `cantidad_stock` int NOT NULL,
  `codigo_serie` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_marca` int NOT NULL,
  `id_modelo` int NOT NULL,
  `id_cat` int NOT NULL,
  `imagen` varchar(750) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `imagen_thumbnail` varchar(750) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fecha_registro` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_parte`),
  KEY `id_marca` (`id_marca`),
  KEY `id_modelo` (`id_modelo`),
  KEY `id_cat` (`id_cat`)
) ENGINE=MyISAM AUTO_INCREMENT=102 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `partes_autos`
--

INSERT INTO `partes_autos` (`id_parte`, `nombre`, `descripcion`, `precio`, `cantidad_stock`, `codigo_serie`, `id_marca`, `id_modelo`, `id_cat`, `imagen`, `imagen_thumbnail`, `fecha_registro`) VALUES
(2, 'Panel lateral', 'Panel lateral diseñado específicamente para vehículos Toyota modelo Corolla del año 2023. Forma parte de la categoría \'Carroceria\' y ha sido fabricado con acero reforzado de alta calidad. Presenta un acabado brillante en color blanco, que asegura no solo resistencia y durabilidad, sino también una integración estética con el diseño original del vehículo. Ideal para reparaciones, mejoras o restauraciones completas, manteniendo el rendimiento y la apariencia del auto en condiciones óptimas.', 55.83, 13, 'TOY-COR-2023-PA', 1, 1, 1, NULL, NULL, '2021-05-15 13:23:45'),
(3, 'Panel lateral', 'Panel lateral diseñado específicamente para vehículos Toyota modelo Rav4 del año 2022. Forma parte de la categoría \'Carroceria\' y ha sido fabricado con plástico ABS de alta calidad. Presenta un acabado liso en color blanco, que asegura no solo resistencia y durabilidad, sino también una integración estética con el diseño original del vehículo. Ideal para reparaciones, mejoras o restauraciones completas, manteniendo el rendimiento y la apariencia del auto en condiciones óptimas.', 123.10, 6, 'TOY-RAV-2022-PA', 1, 2, 1, NULL, NULL, '2021-07-22 19:37:12'),
(4, 'Panel lateral', 'Panel lateral diseñado específicamente para vehículos Toyota modelo Prado del año 2011. Forma parte de la categoría \'Carroceria\' y ha sido fabricado con aluminio de alta calidad. Presenta un acabado liso en color plateado, que asegura no solo resistencia y durabilidad, sino también una integración estética con el diseño original del vehículo. Ideal para reparaciones, mejoras o restauraciones completas, manteniendo el rendimiento y la apariencia del auto en condiciones óptimas.', 83.82, 0, 'TOY-PRA-2011-PA', 1, 3, 1, NULL, NULL, '2021-03-10 14:45:30'),
(5, 'Panel lateral', 'Panel lateral diseñado específicamente para vehículos Mazda modelo CX-5 del año 2011. Forma parte de la categoría \'Carroceria\' y ha sido fabricado con aluminio de alta calidad. Presenta un acabado liso en color gris metálico, que asegura no solo resistencia y durabilidad, sino también una integración estética con el diseño original del vehículo. Ideal para reparaciones, mejoras o restauraciones completas, manteniendo el rendimiento y la apariencia del auto en condiciones óptimas.', 160.90, 17, 'MAZ-CX--2011-PA', 2, 4, 1, NULL, NULL, '2021-11-05 21:20:18'),
(6, 'Panel lateral', 'Panel lateral diseñado específicamente para vehículos Mazda modelo MX-5 Miata del año 2016. Forma parte de la categoría \'Carroceria\' y ha sido fabricado con vidrio templado de alta calidad. Presenta un acabado brillante en color blanco, que asegura no solo resistencia y durabilidad, sino también una integración estética con el diseño original del vehículo. Ideal para reparaciones, mejoras o restauraciones completas, manteniendo el rendimiento y la apariencia del auto en condiciones óptimas.', 123.32, 19, 'MAZ-MX--2016-PA', 2, 5, 1, NULL, NULL, '2021-09-18 16:12:55'),
(7, 'Panel lateral', 'Panel lateral diseñado específicamente para vehículos Ford modelo Escape del año 2012. Forma parte de la categoría \'Carroceria\' y ha sido fabricado con acero reforzado de alta calidad. Presenta un acabado liso en color negro, que asegura no solo resistencia y durabilidad, sino también una integración estética con el diseño original del vehículo. Ideal para reparaciones, mejoras o restauraciones completas, manteniendo el rendimiento y la apariencia del auto en condiciones óptimas.', 221.17, 14, 'FOR-ESC-2012-PA', 3, 8, 1, NULL, NULL, '2021-12-30 18:25:40'),
(8, 'Panel lateral', 'Panel lateral diseñado específicamente para vehículos Ford modelo F-150 del año 2010. Forma parte de la categoría \'Carroceria\' y ha sido fabricado con vidrio templado de alta calidad. Presenta un acabado liso en color azul oscuro, que asegura no solo resistencia y durabilidad, sino también una integración estética con el diseño original del vehículo. Ideal para reparaciones, mejoras o restauraciones completas, manteniendo el rendimiento y la apariencia del auto en condiciones óptimas.', 162.70, 7, 'FOR-F-1-2010-PA', 3, 9, 1, NULL, NULL, '2021-08-14 15:30:22'),
(9, 'Cofre', 'Cofre diseñado específicamente para vehículos Toyota modelo Corolla del año 2023. Forma parte de la categoría \'Carroceria\' y ha sido fabricado con material compuesto de alta calidad. Presenta un acabado texturizado en color blanco, que asegura no solo resistencia y durabilidad, sino también una integración estética con el diseño original del vehículo. Ideal para reparaciones, mejoras o restauraciones completas, manteniendo el rendimiento y la apariencia del auto en condiciones óptimas.', 134.73, 14, 'TOY-COR-2023-CO', 1, 1, 1, NULL, NULL, '2021-04-27 20:45:33'),
(10, 'Cofre', 'Cofre diseñado específicamente para vehículos Toyota modelo Rav4 del año 2022. Forma parte de la categoría \'Carroceria\' y ha sido fabricado con vidrio templado de alta calidad. Presenta un acabado texturizado en color blanco, que asegura no solo resistencia y durabilidad, sino también una integración estética con el diseño original del vehículo. Ideal para reparaciones, mejoras o restauraciones completas, manteniendo el rendimiento y la apariencia del auto en condiciones óptimas.', 217.70, 18, 'TOY-RAV-2022-CO', 1, 2, 1, NULL, NULL, '2021-06-08 12:18:29'),
(11, 'Cofre', 'Cofre diseñado específicamente para vehículos Mazda modelo MX-5 Miata del año 2016. Forma parte de la categoría \'Carroceria\' y ha sido fabricado con aluminio de alta calidad. Presenta un acabado mate en color blanco, que asegura no solo resistencia y durabilidad, sino también una integración estética con el diseño original del vehículo. Ideal para reparaciones, mejoras o restauraciones completas, manteniendo el rendimiento y la apariencia del auto en condiciones óptimas.', 137.18, 18, 'MAZ-MX--2016-CO', 2, 5, 1, NULL, NULL, '2021-02-19 17:50:15'),
(12, 'Cofre', 'Cofre diseñado específicamente para vehículos Ford modelo Mustang del año 2005. Forma parte de la categoría \'Carroceria\' y ha sido fabricado con vidrio templado de alta calidad. Presenta un acabado mate en color negro, que asegura no solo resistencia y durabilidad, sino también una integración estética con el diseño original del vehículo. Ideal para reparaciones, mejoras o restauraciones completas, manteniendo el rendimiento y la apariencia del auto en condiciones óptimas.', 220.84, 19, 'FOR-MUS-2005-CO', 3, 7, 1, NULL, NULL, '2021-10-11 22:33:47'),
(13, 'Cofre', 'Cofre diseñado específicamente para vehículos Ford modelo Escape del año 2012. Forma parte de la categoría \'Carroceria\' y ha sido fabricado con aluminio de alta calidad. Presenta un acabado mate en color negro, que asegura no solo resistencia y durabilidad, sino también una integración estética con el diseño original del vehículo. Ideal para reparaciones, mejoras o restauraciones completas, manteniendo el rendimiento y la apariencia del auto en condiciones óptimas.', 117.75, 5, 'FOR-ESC-2012-CO', 3, 8, 1, NULL, NULL, '2021-01-25 14:40:21'),
(14, 'Cofre', 'Cofre diseñado específicamente para vehículos Ford modelo F-150 del año 2010. Forma parte de la categoría \'Carroceria\' y ha sido fabricado con aluminio de alta calidad. Presenta un acabado liso en color plateado, que asegura no solo resistencia y durabilidad, sino también una integración estética con el diseño original del vehículo. Ideal para reparaciones, mejoras o restauraciones completas, manteniendo el rendimiento y la apariencia del auto en condiciones óptimas.', 42.50, 15, 'FOR-F-1-2010-CO', 3, 9, 1, NULL, NULL, '2021-07-03 19:22:38'),
(15, 'Guardafangos', 'Guardafangos diseñado específicamente para vehículos Toyota modelo Corolla del año 2023. Forma parte de la categoría \'Carroceria\' y ha sido fabricado con plástico ABS de alta calidad. Presenta un acabado texturizado en color blanco, que asegura no solo resistencia y durabilidad, sino también una integración estética con el diseño original del vehículo. Ideal para reparaciones, mejoras o restauraciones completas, manteniendo el rendimiento y la apariencia del auto en condiciones óptimas.', 65.23, 19, 'TOY-COR-2023-GU', 1, 1, 1, NULL, NULL, '2021-12-15 13:15:42'),
(16, 'Guardafangos', 'Guardafangos diseñado específicamente para vehículos Toyota modelo Rav4 del año 2022. Forma parte de la categoría \'Carroceria\' y ha sido fabricado con acero reforzado de alta calidad. Presenta un acabado texturizado en color negro, que asegura no solo resistencia y durabilidad, sino también una integración estética con el diseño original del vehículo. Ideal para reparaciones, mejoras o restauraciones completas, manteniendo el rendimiento y la apariencia del auto en condiciones óptimas.', 197.10, 14, 'TOY-RAV-2022-GU', 1, 2, 1, NULL, NULL, '2021-05-29 21:55:10'),
(17, 'Guardafangos', 'Guardafangos diseñado específicamente para vehículos Toyota modelo Prado del año 2011. Forma parte de la categoría \'Carroceria\' y ha sido fabricado con vidrio templado de alta calidad. Presenta un acabado mate en color azul oscuro, que asegura no solo resistencia y durabilidad, sino también una integración estética con el diseño original del vehículo. Ideal para reparaciones, mejoras o restauraciones completas, manteniendo el rendimiento y la apariencia del auto en condiciones óptimas.', 122.17, 17, 'TOY-PRA-2011-GU', 1, 3, 1, NULL, NULL, '2021-03-17 16:30:25'),
(18, 'Guardafangos', 'Guardafangos diseñado específicamente para vehículos Mazda modelo MX-5 Miata del año 2016. Forma parte de la categoría \'Carroceria\' y ha sido fabricado con aluminio de alta calidad. Presenta un acabado mate en color gris metálico, que asegura no solo resistencia y durabilidad, sino también una integración estética con el diseño original del vehículo. Ideal para reparaciones, mejoras o restauraciones completas, manteniendo el rendimiento y la apariencia del auto en condiciones óptimas.', 231.58, 14, 'MAZ-MX--2016-GU', 2, 5, 1, NULL, NULL, '2021-09-22 18:45:50'),
(19, 'Guardafangos', 'Guardafangos diseñado específicamente para vehículos Ford modelo Mustang del año 2005. Forma parte de la categoría \'Carroceria\' y ha sido fabricado con vidrio templado de alta calidad. Presenta un acabado liso en color blanco, que asegura no solo resistencia y durabilidad, sino también una integración estética con el diseño original del vehículo. Ideal para reparaciones, mejoras o restauraciones completas, manteniendo el rendimiento y la apariencia del auto en condiciones óptimas.', 182.07, 10, 'FOR-MUS-2005-GU', 3, 7, 1, NULL, NULL, '2021-11-08 15:20:35'),
(20, 'Guardafangos', 'Guardafangos diseñado específicamente para vehículos Ford modelo Escape del año 2012. Forma parte de la categoría \'Carroceria\' y ha sido fabricado con aluminio de alta calidad. Presenta un acabado texturizado en color plateado, que asegura no solo resistencia y durabilidad, sino también una integración estética con el diseño original del vehículo. Ideal para reparaciones, mejoras o restauraciones completas, manteniendo el rendimiento y la apariencia del auto en condiciones óptimas.', 35.82, 10, 'FOR-ESC-2012-GU', 3, 8, 1, NULL, NULL, '2021-04-05 20:10:48'),
(21, 'Guardafangos', 'Guardafangos diseñado específicamente para vehículos Ford modelo F-150 del año 2010. Forma parte de la categoría \'Carroceria\' y ha sido fabricado con aluminio de alta calidad. Presenta un acabado brillante en color azul oscuro, que asegura no solo resistencia y durabilidad, sino también una integración estética con el diseño original del vehículo. Ideal para reparaciones, mejoras o restauraciones completas, manteniendo el rendimiento y la apariencia del auto en condiciones óptimas.', 53.83, 13, 'FOR-F-1-2010-GU', 3, 9, 1, NULL, NULL, '2021-08-30 12:25:19'),
(22, 'Bujías', 'Bujías diseñado específicamente para vehículos Toyota modelo Corolla del año 2023. Forma parte de la categoría \'Motor\' y ha sido fabricado con vidrio templado de alta calidad. Presenta un acabado liso en color azul oscuro, que asegura no solo resistencia y durabilidad, sino también una integración estética con el diseño original del vehículo. Ideal para reparaciones, mejoras o restauraciones completas, manteniendo el rendimiento y la apariencia del auto en condiciones óptimas.', 115.34, 15, 'TOY-COR-2023-BU', 1, 1, 2, NULL, NULL, '2021-06-12 17:40:30'),
(23, 'Bujías', 'Bujías diseñado específicamente para vehículos Toyota modelo Rav4 del año 2022. Forma parte de la categoría \'Motor\' y ha sido fabricado con aluminio de alta calidad. Presenta un acabado texturizado en color blanco, que asegura no solo resistencia y durabilidad, sino también una integración estética con el diseño original del vehículo. Ideal para reparaciones, mejoras o restauraciones completas, manteniendo el rendimiento y la apariencia del auto en condiciones óptimas.', 69.33, 9, 'TOY-RAV-2022-BU', 1, 2, 2, NULL, NULL, '2021-02-28 22:15:22'),
(24, 'Bujías', 'Bujías diseñado específicamente para vehículos Toyota modelo Prado del año 2011. Forma parte de la categoría \'Motor\' y ha sido fabricado con material compuesto de alta calidad. Presenta un acabado brillante en color gris metálico, que asegura no solo resistencia y durabilidad, sino también una integración estética con el diseño original del vehículo. Ideal para reparaciones, mejoras o restauraciones completas, manteniendo el rendimiento y la apariencia del auto en condiciones óptimas.', 154.00, 17, 'TOY-PRA-2011-BU', 1, 3, 2, NULL, NULL, '2021-10-19 14:50:41'),
(25, 'Bujías', 'Bujías diseñado específicamente para vehículos Mazda modelo MX-5 Miata del año 2016. Forma parte de la categoría \'Motor\' y ha sido fabricado con plástico ABS de alta calidad. Presenta un acabado mate en color blanco, que asegura no solo resistencia y durabilidad, sino también una integración estética con el diseño original del vehículo. Ideal para reparaciones, mejoras o restauraciones completas, manteniendo el rendimiento y la apariencia del auto en condiciones óptimas.', 208.69, 5, 'MAZ-MX--2016-BU', 2, 5, 2, NULL, NULL, '2021-01-14 19:35:17'),
(26, 'Bujías', 'Bujías diseñado específicamente para vehículos Mazda modelo CX-30 del año 2022. Forma parte de la categoría \'Motor\' y ha sido fabricado con aluminio de alta calidad. Presenta un acabado mate en color azul oscuro, que asegura no solo resistencia y durabilidad, sino también una integración estética con el diseño original del vehículo. Ideal para reparaciones, mejoras o restauraciones completas, manteniendo el rendimiento y la apariencia del auto en condiciones óptimas.', 145.13, 7, 'MAZ-CX--2022-BU', 2, 6, 2, NULL, NULL, '2021-07-27 13:22:53'),
(27, 'Bujías', 'Bujías diseñado específicamente para vehículos Ford modelo Mustang del año 2005. Forma parte de la categoría \'Motor\' y ha sido fabricado con material compuesto de alta calidad. Presenta un acabado brillante en color negro, que asegura no solo resistencia y durabilidad, sino también una integración estética con el diseño original del vehículo. Ideal para reparaciones, mejoras o restauraciones completas, manteniendo el rendimiento y la apariencia del auto en condiciones óptimas.', 167.25, 15, 'FOR-MUS-2005-BU', 3, 7, 2, NULL, NULL, '2021-12-03 21:45:29'),
(28, 'Bujías', 'Bujías diseñado específicamente para vehículos Ford modelo F-150 del año 2010. Forma parte de la categoría \'Motor\' y ha sido fabricado con acero reforzado de alta calidad. Presenta un acabado texturizado en color plateado, que asegura no solo resistencia y durabilidad, sino también una integración estética con el diseño original del vehículo. Ideal para reparaciones, mejoras o restauraciones completas, manteniendo el rendimiento y la apariencia del auto en condiciones óptimas.', 129.55, 6, 'FOR-F-1-2010-BU', 3, 9, 2, NULL, NULL, '2021-05-10 16:30:44'),
(29, 'Radiador', 'Radiador diseñado específicamente para vehículos Toyota modelo Corolla del año 2023. Forma parte de la categoría \'Motor\' y ha sido fabricado con acero reforzado de alta calidad. Presenta un acabado texturizado en color gris metálico, que asegura no solo resistencia y durabilidad, sino también una integración estética con el diseño original del vehículo. Ideal para reparaciones, mejoras o restauraciones completas, manteniendo el rendimiento y la apariencia del auto en condiciones óptimas.', 235.73, 7, 'TOY-COR-2023-RA', 1, 1, 2, NULL, NULL, '2021-03-22 18:20:15'),
(30, 'Radiador', 'Radiador diseñado específicamente para vehículos Toyota modelo Rav4 del año 2022. Forma parte de la categoría \'Motor\' y ha sido fabricado con vidrio templado de alta calidad. Presenta un acabado liso en color azul oscuro, que asegura no solo resistencia y durabilidad, sino también una integración estética con el diseño original del vehículo. Ideal para reparaciones, mejoras o restauraciones completas, manteniendo el rendimiento y la apariencia del auto en condiciones óptimas.', 218.56, 14, 'TOY-RAV-2022-RA', 1, 2, 2, NULL, NULL, '2021-09-15 15:55:38'),
(31, 'Radiador', 'Radiador diseñado específicamente para vehículos Toyota modelo Prado del año 2011. Forma parte de la categoría \'Motor\' y ha sido fabricado con aluminio de alta calidad. Presenta un acabado brillante en color gris metálico, que asegura no solo resistencia y durabilidad, sino también una integración estética con el diseño original del vehículo. Ideal para reparaciones, mejoras o restauraciones completas, manteniendo el rendimiento y la apariencia del auto en condiciones óptimas.', 235.97, 20, 'TOY-PRA-2011-RA', 1, 3, 2, NULL, NULL, '2021-11-28 20:40:27'),
(32, 'Radiador', 'Radiador diseñado específicamente para vehículos Mazda modelo CX-5 del año 2011. Forma parte de la categoría \'Motor\' y ha sido fabricado con plástico ABS de alta calidad. Presenta un acabado texturizado en color azul oscuro, que asegura no solo resistencia y durabilidad, sino también una integración estética con el diseño original del vehículo. Ideal para reparaciones, mejoras o restauraciones completas, manteniendo el rendimiento y la apariencia del auto en condiciones óptimas.', 99.06, 17, 'MAZ-CX--2011-RA', 2, 4, 2, NULL, NULL, '2021-04-18 12:15:52'),
(33, 'Radiador', 'Radiador diseñado específicamente para vehículos Mazda modelo CX-30 del año 2022. Forma parte de la categoría \'Motor\' y ha sido fabricado con material compuesto de alta calidad. Presenta un acabado brillante en color negro, que asegura no solo resistencia y durabilidad, sino también una integración estética con el diseño original del vehículo. Ideal para reparaciones, mejoras o restauraciones completas, manteniendo el rendimiento y la apariencia del auto en condiciones óptimas.', 201.60, 14, 'MAZ-CX--2022-RA', 2, 6, 2, NULL, NULL, '2021-08-05 17:30:19'),
(34, 'Radiador', 'Radiador diseñado específicamente para vehículos Ford modelo Mustang del año 2005. Forma parte de la categoría \'Motor\' y ha sido fabricado con material compuesto de alta calidad. Presenta un acabado brillante en color negro, que asegura no solo resistencia y durabilidad, sino también una integración estética con el diseño original del vehículo. Ideal para reparaciones, mejoras o restauraciones completas, manteniendo el rendimiento y la apariencia del auto en condiciones óptimas.', 132.52, 15, 'FOR-MUS-2005-RA', 3, 7, 2, NULL, NULL, '2021-06-20 22:25:43'),
(35, 'Radiador', 'Radiador diseñado específicamente para vehículos Ford modelo F-150 del año 2010. Forma parte de la categoría \'Motor\' y ha sido fabricado con aluminio de alta calidad. Presenta un acabado texturizado en color negro, que asegura no solo resistencia y durabilidad, sino también una integración estética con el diseño original del vehículo. Ideal para reparaciones, mejoras o restauraciones completas, manteniendo el rendimiento y la apariencia del auto en condiciones óptimas.', 169.59, 9, 'FOR-F-1-2010-RA', 3, 9, 2, NULL, NULL, '2021-02-10 14:45:31'),
(36, 'Alternador', 'Alternador diseñado específicamente para vehículos Toyota modelo Corolla del año 2023. Forma parte de la categoría \'Motor\' y ha sido fabricado con plástico ABS de alta calidad. Presenta un acabado liso en color azul oscuro, que asegura no solo resistencia y durabilidad, sino también una integración estética con el diseño original del vehículo. Ideal para reparaciones, mejoras o restauraciones completas, manteniendo el rendimiento y la apariencia del auto en condiciones óptimas.', 168.21, 9, 'TOY-COR-2023-AL', 1, 1, 2, NULL, NULL, '2021-10-22 19:50:26'),
(37, 'Alternador', 'Alternador diseñado específicamente para vehículos Toyota modelo Rav4 del año 2022. Forma parte de la categoría \'Motor\' y ha sido fabricado con aluminio de alta calidad. Presenta un acabado liso en color plateado, que asegura no solo resistencia y durabilidad, sino también una integración estética con el diseño original del vehículo. Ideal para reparaciones, mejoras o restauraciones completas, manteniendo el rendimiento y la apariencia del auto en condiciones óptimas.', 152.27, 16, 'TOY-RAV-2022-AL', 1, 2, 2, NULL, NULL, '2021-01-05 13:35:14'),
(38, 'Alternador', 'Alternador diseñado específicamente para vehículos Toyota modelo Prado del año 2011. Forma parte de la categoría \'Motor\' y ha sido fabricado con vidrio templado de alta calidad. Presenta un acabado brillante en color plateado, que asegura no solo resistencia y durabilidad, sino también una integración estética con el diseño original del vehículo. Ideal para reparaciones, mejoras o restauraciones completas, manteniendo el rendimiento y la apariencia del auto en condiciones óptimas.', 84.75, 6, 'TOY-PRA-2011-AL', 1, 3, 2, NULL, NULL, '2021-07-19 21:20:48'),
(39, 'Alternador', 'Alternador diseñado específicamente para vehículos Mazda modelo CX-5 del año 2011. Forma parte de la categoría \'Motor\' y ha sido fabricado con material compuesto de alta calidad. Presenta un acabado brillante en color blanco, que asegura no solo resistencia y durabilidad, sino también una integración estética con el diseño original del vehículo. Ideal para reparaciones, mejoras o restauraciones completas, manteniendo el rendimiento y la apariencia del auto en condiciones óptimas.', 105.77, 16, 'MAZ-CX--2011-AL', 2, 4, 2, NULL, NULL, '2021-12-28 16:15:33'),
(40, 'Alternador', 'Alternador diseñado específicamente para vehículos Mazda modelo CX-30 del año 2022. Forma parte de la categoría \'Motor\' y ha sido fabricado con vidrio templado de alta calidad. Presenta un acabado texturizado en color negro, que asegura no solo resistencia y durabilidad, sino también una integración estética con el diseño original del vehículo. Ideal para reparaciones, mejoras o restauraciones completas, manteniendo el rendimiento y la apariencia del auto en condiciones óptimas.', 174.56, 9, 'MAZ-CX--2022-AL', 2, 6, 2, NULL, NULL, '2021-05-03 18:40:22'),
(41, 'Alternador', 'Alternador diseñado específicamente para vehículos Ford modelo Escape del año 2012. Forma parte de la categoría \'Motor\' y ha sido fabricado con plástico ABS de alta calidad. Presenta un acabado mate en color negro, que asegura no solo resistencia y durabilidad, sino también una integración estética con el diseño original del vehículo. Ideal para reparaciones, mejoras o restauraciones completas, manteniendo el rendimiento y la apariencia del auto en condiciones óptimas.', 26.61, 11, 'FOR-ESC-2012-AL', 3, 8, 2, NULL, NULL, '2021-03-12 15:25:47'),
(42, 'Alternador', 'Alternador diseñado específicamente para vehículos Ford modelo F-150 del año 2010. Forma parte de la categoría \'Motor\' y ha sido fabricado con aluminio de alta calidad. Presenta un acabado liso en color plateado, que asegura no solo resistencia y durabilidad, sino también una integración estética con el diseño original del vehículo. Ideal para reparaciones, mejoras o restauraciones completas, manteniendo el rendimiento y la apariencia del auto en condiciones óptimas.', 129.91, 18, 'FOR-F-1-2010-AL', 3, 9, 2, NULL, NULL, '2021-09-25 20:30:19'),
(43, 'Manija exterior', 'Manija exterior diseñado específicamente para vehículos Toyota modelo Corolla del año 2023. Forma parte de la categoría \'Puertas\' y ha sido fabricado con material compuesto de alta calidad. Presenta un acabado mate en color gris metálico, que asegura no solo resistencia y durabilidad, sino también una integración estética con el diseño original del vehículo. Ideal para reparaciones, mejoras o restauraciones completas, manteniendo el rendimiento y la apariencia del auto en condiciones óptimas.', 116.73, 10, 'TOY-COR-2023-MA', 1, 1, 3, NULL, NULL, '2021-11-15 12:50:38'),
(44, 'Manija exterior', 'Manija exterior diseñado específicamente para vehículos Toyota modelo Rav4 del año 2022. Forma parte de la categoría \'Puertas\' y ha sido fabricado con vidrio templado de alta calidad. Presenta un acabado brillante en color blanco, que asegura no solo resistencia y durabilidad, sino también una integración estética con el diseño original del vehículo. Ideal para reparaciones, mejoras o restauraciones completas, manteniendo el rendimiento y la apariencia del auto en condiciones óptimas.', 78.17, 20, 'TOY-RAV-2022-MA', 1, 2, 3, NULL, NULL, '2021-04-22 17:45:25'),
(45, 'Manija exterior', 'Manija exterior diseñado específicamente para vehículos Toyota modelo Prado del año 2011. Forma parte de la categoría \'Puertas\' y ha sido fabricado con material compuesto de alta calidad. Presenta un acabado texturizado en color negro, que asegura no solo resistencia y durabilidad, sino también una integración estética con el diseño original del vehículo. Ideal para reparaciones, mejoras o restauraciones completas, manteniendo el rendimiento y la apariencia del auto en condiciones óptimas.', 108.01, 15, 'TOY-PRA-2011-MA', 1, 3, 3, NULL, NULL, '2021-08-10 22:20:54'),
(46, 'Manija exterior', 'Manija exterior diseñado específicamente para vehículos Mazda modelo MX-5 Miata del año 2016. Forma parte de la categoría \'Puertas\' y ha sido fabricado con acero reforzado de alta calidad. Presenta un acabado liso en color blanco, que asegura no solo resistencia y durabilidad, sino también una integración estética con el diseño original del vehículo. Ideal para reparaciones, mejoras o restauraciones completas, manteniendo el rendimiento y la apariencia del auto en condiciones óptimas.', 134.14, 18, 'MAZ-MX--2016-MA', 2, 5, 3, NULL, NULL, '2021-06-05 14:35:41'),
(47, 'Manija exterior', 'Manija exterior diseñado específicamente para vehículos Ford modelo Mustang del año 2005. Forma parte de la categoría \'Puertas\' y ha sido fabricado con plástico ABS de alta calidad. Presenta un acabado mate en color negro, que asegura no solo resistencia y durabilidad, sino también una integración estética con el diseño original del vehículo. Ideal para reparaciones, mejoras o restauraciones completas, manteniendo el rendimiento y la apariencia del auto en condiciones óptimas.', 179.22, 6, 'FOR-MUS-2005-MA', 3, 7, 3, NULL, NULL, '2021-02-22 19:50:28'),
(48, 'Manija exterior', 'Manija exterior diseñado específicamente para vehículos Ford modelo Escape del año 2012. Forma parte de la categoría \'Puertas\' y ha sido fabricado con acero reforzado de alta calidad. Presenta un acabado brillante en color gris metálico, que asegura no solo resistencia y durabilidad, sino también una integración estética con el diseño original del vehículo. Ideal para reparaciones, mejoras o restauraciones completas, manteniendo el rendimiento y la apariencia del auto en condiciones óptimas.', 132.07, 11, 'FOR-ESC-2012-MA', 3, 8, 3, NULL, NULL, '2021-10-08 13:25:37'),
(49, 'Manija exterior', 'Manija exterior diseñado específicamente para vehículos Ford modelo F-150 del año 2010. Forma parte de la categoría \'Puertas\' y ha sido fabricado con plástico ABS de alta calidad. Presenta un acabado liso en color plateado, que asegura no solo resistencia y durabilidad, sino también una integración estética con el diseño original del vehículo. Ideal para reparaciones, mejoras o restauraciones completas, manteniendo el rendimiento y la apariencia del auto en condiciones óptimas.', 87.04, 14, 'FOR-F-1-2010-MA', 3, 9, 3, NULL, NULL, '2021-01-20 21:40:15'),
(50, 'Bisagra de puerta', 'Bisagra de puerta diseñado específicamente para vehículos Toyota modelo Corolla del año 2023. Forma parte de la categoría \'Puertas\' y ha sido fabricado con aluminio de alta calidad. Presenta un acabado brillante en color azul oscuro, que asegura no solo resistencia y durabilidad, sino también una integración estética con el diseño original del vehículo. Ideal para reparaciones, mejoras o restauraciones completas, manteniendo el rendimiento y la apariencia del auto en condiciones óptimas.', 205.75, 9, 'TOY-COR-2023-BI', 1, 1, 3, NULL, NULL, '2021-07-12 16:55:42'),
(51, 'Bisagra de puerta', 'Bisagra de puerta diseñado específicamente para vehículos Toyota modelo Rav4 del año 2022. Forma parte de la categoría \'Puertas\' y ha sido fabricado con aluminio de alta calidad. Presenta un acabado brillante en color azul oscuro, que asegura no solo resistencia y durabilidad, sino también una integración estética con el diseño original del vehículo. Ideal para reparaciones, mejoras o restauraciones completas, manteniendo el rendimiento y la apariencia del auto en condiciones óptimas.', 178.36, 13, 'TOY-RAV-2022-BI', 1, 2, 3, NULL, NULL, '2021-12-19 18:30:29'),
(52, 'Bisagra de puerta', 'Bisagra de puerta diseñado específicamente para vehículos Toyota modelo Prado del año 2011. Forma parte de la categoría \'Puertas\' y ha sido fabricado con aluminio de alta calidad. Presenta un acabado liso en color blanco, que asegura no solo resistencia y durabilidad, sino también una integración estética con el diseño original del vehículo. Ideal para reparaciones, mejoras o restauraciones completas, manteniendo el rendimiento y la apariencia del auto en condiciones óptimas.', 168.15, 7, 'TOY-PRA-2011-BI', 1, 3, 3, NULL, NULL, '2021-05-25 15:45:16'),
(53, 'Bisagra de puerta', 'Bisagra de puerta diseñado específicamente para vehículos Mazda modelo CX-5 del año 2011. Forma parte de la categoría \'Puertas\' y ha sido fabricado con vidrio templado de alta calidad. Presenta un acabado texturizado en color gris metálico, que asegura no solo resistencia y durabilidad, sino también una integración estética con el diseño original del vehículo. Ideal para reparaciones, mejoras o restauraciones completas, manteniendo el rendimiento y la apariencia del auto en condiciones óptimas.', 149.94, 17, 'MAZ-CX--2011-BI', 2, 4, 3, NULL, NULL, '2021-03-08 20:20:33'),
(54, 'Bisagra de puerta', 'Bisagra de puerta diseñado específicamente para vehículos Mazda modelo MX-5 Miata del año 2016. Forma parte de la categoría \'Puertas\' y ha sido fabricado con acero reforzado de alta calidad. Presenta un acabado mate en color gris metálico, que asegura no solo resistencia y durabilidad, sino también una integración estética con el diseño original del vehículo. Ideal para reparaciones, mejoras o restauraciones completas, manteniendo el rendimiento y la apariencia del auto en condiciones óptimas.', 71.29, 11, 'MAZ-MX--2016-BI', 2, 5, 3, NULL, NULL, '2021-09-30 12:35:48'),
(55, 'Bisagra de puerta', 'Bisagra de puerta diseñado específicamente para vehículos Ford modelo Mustang del año 2005. Forma parte de la categoría \'Puertas\' y ha sido fabricado con plástico ABS de alta calidad. Presenta un acabado brillante en color gris metálico, que asegura no solo resistencia y durabilidad, sino también una integración estética con el diseño original del vehículo. Ideal para reparaciones, mejoras o restauraciones completas, manteniendo el rendimiento y la apariencia del auto en condiciones óptimas.', 208.35, 11, 'FOR-MUS-2005-BI', 3, 7, 3, NULL, NULL, '2021-11-18 17:50:24'),
(56, 'Bisagra de puerta', 'Bisagra de puerta diseñado específicamente para vehículos Ford modelo F-150 del año 2010. Forma parte de la categoría \'Puertas\' y ha sido fabricado con vidrio templado de alta calidad. Presenta un acabado texturizado en color negro, que asegura no solo resistencia y durabilidad, sino también una integración estética con el diseño original del vehículo. Ideal para reparaciones, mejoras o restauraciones completas, manteniendo el rendimiento y la apariencia del auto en condiciones óptimas.', 98.98, 12, 'FOR-F-1-2010-BI', 3, 9, 3, NULL, NULL, '2021-04-15 22:25:11'),
(57, 'Panel de puerta', 'Panel de puerta diseñado específicamente para vehículos Toyota modelo Corolla del año 2023. Forma parte de la categoría \'Puertas\' y ha sido fabricado con aluminio de alta calidad. Presenta un acabado brillante en color blanco, que asegura no solo resistencia y durabilidad, sino también una integración estética con el diseño original del vehículo. Ideal para reparaciones, mejoras o restauraciones completas, manteniendo el rendimiento y la apariencia del auto en condiciones óptimas.', 244.67, 5, 'TOY-COR-2023-PA', 1, 1, 3, NULL, NULL, '2021-08-28 14:40:37'),
(58, 'Panel de puerta', 'Panel de puerta diseñado específicamente para vehículos Toyota modelo Rav4 del año 2022. Forma parte de la categoría \'Puertas\' y ha sido fabricado con aluminio de alta calidad. Presenta un acabado brillante en color azul oscuro, que asegura no solo resistencia y durabilidad, sino también una integración estética con el diseño original del vehículo. Ideal para reparaciones, mejoras o restauraciones completas, manteniendo el rendimiento y la apariencia del auto en condiciones óptimas.', 227.99, 19, 'TOY-RAV-2022-PA', 1, 2, 3, NULL, NULL, '2021-06-15 19:55:22'),
(59, 'Panel de puerta', 'Panel de puerta diseñado específicamente para vehículos Mazda modelo CX-5 del año 2011. Forma parte de la categoría \'Puertas\' y ha sido fabricado con aluminio de alta calidad. Presenta un acabado mate en color negro, que asegura no solo resistencia y durabilidad, sino también una integración estética con el diseño original del vehículo. Ideal para reparaciones, mejoras o restauraciones completas, manteniendo el rendimiento y la apariencia del auto en condiciones óptimas.', 163.83, 7, 'MAZ-CX--2011-PA', 2, 4, 3, NULL, NULL, '2021-02-05 13:30:49'),
(60, 'Panel de puerta', 'Panel de puerta diseñado específicamente para vehículos Mazda modelo MX-5 Miata del año 2016. Forma parte de la categoría \'Puertas\' y ha sido fabricado con plástico ABS de alta calidad. Presenta un acabado liso en color negro, que asegura no solo resistencia y durabilidad, sino también una integración estética con el diseño original del vehículo. Ideal para reparaciones, mejoras o restauraciones completas, manteniendo el rendimiento y la apariencia del auto en condiciones óptimas.', 239.64, 6, 'MAZ-MX--2016-PA', 2, 5, 3, NULL, NULL, '2021-10-29 21:45:35'),
(61, 'Panel de puerta', 'Panel de puerta diseñado específicamente para vehículos Mazda modelo CX-30 del año 2022. Forma parte de la categoría \'Puertas\' y ha sido fabricado con material compuesto de alta calidad. Presenta un acabado texturizado en color plateado, que asegura no solo resistencia y durabilidad, sino también una integración estética con el diseño original del vehículo. Ideal para reparaciones, mejoras o restauraciones completas, manteniendo el rendimiento y la apariencia del auto en condiciones óptimas.', 146.79, 14, 'MAZ-CX--2022-PA', 2, 6, 3, NULL, NULL, '2021-01-10 16:20:18'),
(62, 'Panel de puerta', 'Panel de puerta diseñado específicamente para vehículos Ford modelo Mustang del año 2005. Forma parte de la categoría \'Puertas\' y ha sido fabricado con vidrio templado de alta calidad. Presenta un acabado brillante en color negro, que asegura no solo resistencia y durabilidad, sino también una integración estética con el diseño original del vehículo. Ideal para reparaciones, mejoras o restauraciones completas, manteniendo el rendimiento y la apariencia del auto en condiciones óptimas.', 62.32, 12, 'FOR-MUS-2005-PA', 3, 7, 3, NULL, NULL, '2021-07-24 18:35:44'),
(63, 'Panel de puerta', 'Panel de puerta diseñado específicamente para vehículos Ford modelo F-150 del año 2010. Forma parte de la categoría \'Puertas\' y ha sido fabricado con material compuesto de alta calidad. Presenta un acabado liso en color azul oscuro, que asegura no solo resistencia y durabilidad, sino también una integración estética con el diseño original del vehículo. Ideal para reparaciones, mejoras o restauraciones completas, manteniendo el rendimiento y la apariencia del auto en condiciones óptimas.', 98.06, 19, 'FOR-F-1-2010-PA', 3, 9, 3, NULL, NULL, '2021-12-05 15:50:31'),
(64, 'Parabrisas delantero', 'Parabrisas delantero diseñado específicamente para vehículos Toyota modelo Corolla del año 2023. Forma parte de la categoría \'Vidrios\' y ha sido fabricado con material compuesto de alta calidad. Presenta un acabado brillante en color blanco, que asegura no solo resistencia y durabilidad, sino también una integración estética con el diseño original del vehículo. Ideal para reparaciones, mejoras o restauraciones completas, manteniendo el rendimiento y la apariencia del auto en condiciones óptimas.', 186.62, 7, 'TOY-COR-2023-PA', 1, 1, 4, NULL, NULL, '2021-05-18 20:25:17'),
(65, 'Parabrisas delantero', 'Parabrisas delantero diseñado específicamente para vehículos Toyota modelo Rav4 del año 2022. Forma parte de la categoría \'Vidrios\' y ha sido fabricado con acero reforzado de alta calidad. Presenta un acabado liso en color gris metálico, que asegura no solo resistencia y durabilidad, sino también una integración estética con el diseño original del vehículo. Ideal para reparaciones, mejoras o restauraciones completas, manteniendo el rendimiento y la apariencia del auto en condiciones óptimas.', 232.74, 20, 'TOY-RAV-2022-PA', 1, 2, 4, NULL, NULL, '2021-03-25 12:40:52'),
(66, 'Parabrisas delantero', 'Parabrisas delantero diseñado específicamente para vehículos Toyota modelo Prado del año 2011. Forma parte de la categoría \'Vidrios\' y ha sido fabricado con vidrio templado de alta calidad. Presenta un acabado mate en color negro, que asegura no solo resistencia y durabilidad, sino también una integración estética con el diseño original del vehículo. Ideal para reparaciones, mejoras o restauraciones completas, manteniendo el rendimiento y la apariencia del auto en condiciones óptimas.', 48.60, 20, 'TOY-PRA-2011-PA', 1, 3, 4, NULL, NULL, '2021-09-12 17:55:38'),
(67, 'Parabrisas delantero', 'Parabrisas delantero diseñado específicamente para vehículos Mazda modelo CX-5 del año 2011. Forma parte de la categoría \'Vidrios\' y ha sido fabricado con material compuesto de alta calidad. Presenta un acabado mate en color negro, que asegura no solo resistencia y durabilidad, sino también una integración estética con el diseño original del vehículo. Ideal para reparaciones, mejoras o restauraciones completas, manteniendo el rendimiento y la apariencia del auto en condiciones óptimas.', 143.38, 10, 'MAZ-CX--2011-PA', 2, 4, 4, NULL, NULL, '2021-11-25 22:30:25'),
(68, 'Parabrisas delantero', 'Parabrisas delantero diseñado específicamente para vehículos Mazda modelo MX-5 Miata del año 2016. Forma parte de la categoría \'Vidrios\' y ha sido fabricado con material compuesto de alta calidad. Presenta un acabado mate en color plateado, que asegura no solo resistencia y durabilidad, sino también una integración estética con el diseño original del vehículo. Ideal para reparaciones, mejoras o restauraciones completas, manteniendo el rendimiento y la apariencia del auto en condiciones óptimas.', 239.41, 13, 'MAZ-MX--2016-PA', 2, 5, 4, NULL, NULL, '2021-04-08 14:45:41'),
(69, 'Parabrisas delantero', 'Parabrisas delantero diseñado específicamente para vehículos Mazda modelo CX-30 del año 2022. Forma parte de la categoría \'Vidrios\' y ha sido fabricado con acero reforzado de alta calidad. Presenta un acabado mate en color plateado, que asegura no solo resistencia y durabilidad, sino también una integración estética con el diseño original del vehículo. Ideal para reparaciones, mejoras o restauraciones completas, manteniendo el rendimiento y la apariencia del auto en condiciones óptimas.', 196.64, 5, 'MAZ-CX--2022-PA', 2, 6, 4, NULL, NULL, '2021-08-20 19:20:16'),
(70, 'Parabrisas delantero', 'Parabrisas delantero diseñado específicamente para vehículos Ford modelo Escape del año 2012. Forma parte de la categoría \'Vidrios\' y ha sido fabricado con vidrio templado de alta calidad. Presenta un acabado mate en color gris metálico, que asegura no solo resistencia y durabilidad, sino también una integración estética con el diseño original del vehículo. Ideal para reparaciones, mejoras o restauraciones completas, manteniendo el rendimiento y la apariencia del auto en condiciones óptimas.', 147.10, 15, 'FOR-ESC-2012-PA', 3, 8, 4, NULL, NULL, '2021-06-28 13:35:33'),
(71, 'Luna lateral', 'Luna lateral diseñado específicamente para vehículos Toyota modelo Corolla del año 2023. Forma parte de la categoría \'Vidrios\' y ha sido fabricado con aluminio de alta calidad. Presenta un acabado mate en color blanco, que asegura no solo resistencia y durabilidad, sino también una integración estética con el diseño original del vehículo. Ideal para reparaciones, mejoras o restauraciones completas, manteniendo el rendimiento y la apariencia del auto en condiciones óptimas.', 34.26, 10, 'TOY-COR-2023-LU', 1, 1, 4, NULL, NULL, '2021-02-15 21:50:29'),
(72, 'Luna lateral', 'Luna lateral diseñado específicamente para vehículos Toyota modelo Rav4 del año 2022. Forma parte de la categoría \'Vidrios\' y ha sido fabricado con acero reforzado de alta calidad. Presenta un acabado mate en color gris metálico, que asegura no solo resistencia y durabilidad, sino también una integración estética con el diseño original del vehículo. Ideal para reparaciones, mejoras o restauraciones completas, manteniendo el rendimiento y la apariencia del auto en condiciones óptimas.', 67.61, 6, 'TOY-RAV-2022-LU', 1, 2, 4, NULL, NULL, '2021-10-05 16:25:44'),
(73, 'Luna lateral', 'Luna lateral diseñado específicamente para vehículos Mazda modelo CX-5 del año 2011. Forma parte de la categoría \'Vidrios\' y ha sido fabricado con vidrio templado de alta calidad. Presenta un acabado texturizado en color negro, que asegura no solo resistencia y durabilidad, sino también una integración estética con el diseño original del vehículo. Ideal para reparaciones, mejoras o restauraciones completas, manteniendo el rendimiento y la apariencia del auto en condiciones óptimas.', 75.67, 9, 'MAZ-CX--2011-LU', 2, 4, 4, NULL, NULL, '2021-01-28 18:40:20'),
(74, 'Luna lateral', 'Luna lateral diseñado específicamente para vehículos Mazda modelo MX-5 Miata del año 2016. Forma parte de la categoría \'Vidrios\' y ha sido fabricado con material compuesto de alta calidad. Presenta un acabado mate en color blanco, que asegura no solo resistencia y durabilidad, sino también una integración estética con el diseño original del vehículo. Ideal para reparaciones, mejoras o restauraciones completas, manteniendo el rendimiento y la apariencia del auto en condiciones óptimas.', 130.93, 9, 'MAZ-MX--2016-LU', 2, 5, 4, NULL, NULL, '2021-07-15 15:55:37'),
(75, 'Luna lateral', 'Luna lateral diseñado específicamente para vehículos Mazda modelo CX-30 del año 2022. Forma parte de la categoría \'Vidrios\' y ha sido fabricado con material compuesto de alta calidad. Presenta un acabado mate en color blanco, que asegura no solo resistencia y durabilidad, sino también una integración estética con el diseño original del vehículo. Ideal para reparaciones, mejoras o restauraciones completas, manteniendo el rendimiento y la apariencia del auto en condiciones óptimas.', 207.64, 5, 'MAZ-CX--2022-LU', 2, 6, 4, NULL, NULL, '2021-12-22 20:30:52'),
(76, 'Luna lateral', 'Luna lateral diseñado específicamente para vehículos Ford modelo Mustang del año 2005. Forma parte de la categoría \'Vidrios\' y ha sido fabricado con plástico ABS de alta calidad. Presenta un acabado liso en color negro, que asegura no solo resistencia y durabilidad, sino también una integración estética con el diseño original del vehículo. Ideal para reparaciones, mejoras o restauraciones completas, manteniendo el rendimiento y la apariencia del auto en condiciones óptimas.', 81.98, 14, 'FOR-MUS-2005-LU', 3, 7, 4, NULL, NULL, '2021-05-08 12:45:18'),
(77, 'Luna lateral', 'Luna lateral diseñado específicamente para vehículos Ford modelo F-150 del año 2010. Forma parte de la categoría \'Vidrios\' y ha sido fabricado con vidrio templado de alta calidad. Presenta un acabado brillante en color negro, que asegura no solo resistencia y durabilidad, sino también una integración estética con el diseño original del vehículo. Ideal para reparaciones, mejoras o restauraciones completas, manteniendo el rendimiento y la apariencia del auto en condiciones óptimas.', 184.60, 12, 'FOR-F-1-2010-LU', 3, 9, 4, NULL, NULL, '2021-03-15 17:20:34'),
(78, 'Cristal de ventana triangular', 'Cristal de ventana triangular diseñado específicamente para vehículos Toyota modelo Rav4 del año 2022. Forma parte de la categoría \'Vidrios\' y ha sido fabricado con vidrio templado de alta calidad. Presenta un acabado mate en color blanco, que asegura no solo resistencia y durabilidad, sino también una integración estética con el diseño original del vehículo. Ideal para reparaciones, mejoras o restauraciones completas, manteniendo el rendimiento y la apariencia del auto en condiciones óptimas.', 93.76, 7, 'TOY-RAV-2022-CR', 1, 2, 4, NULL, NULL, '2021-09-28 22:35:49'),
(79, 'Cristal de ventana triangular', 'Cristal de ventana triangular diseñado específicamente para vehículos Toyota modelo Prado del año 2011. Forma parte de la categoría \'Vidrios\' y ha sido fabricado con material compuesto de alta calidad. Presenta un acabado mate en color blanco, que asegura no solo resistencia y durabilidad, sino también una integración estética con el diseño original del vehículo. Ideal para reparaciones, mejoras o restauraciones completas, manteniendo el rendimiento y la apariencia del auto en condiciones óptimas.', 195.81, 15, 'TOY-PRA-2011-CR', 1, 3, 4, NULL, NULL, '2021-11-10 14:50:25'),
(80, 'Cristal de ventana triangular', 'Cristal de ventana triangular diseñado específicamente para vehículos Mazda modelo CX-5 del año 2011. Forma parte de la categoría \'Vidrios\' y ha sido fabricado con vidrio templado de alta calidad. Presenta un acabado brillante en color blanco, que asegura no solo resistencia y durabilidad, sino también una integración estética con el diseño original del vehículo. Ideal para reparaciones, mejoras o restauraciones completas, manteniendo el rendimiento y la apariencia del auto en condiciones óptimas.', 175.40, 5, 'MAZ-CX--2011-CR', 2, 4, 4, NULL, NULL, '2021-04-25 19:25:41'),
(81, 'Cristal de ventana triangular', 'Cristal de ventana triangular diseñado específicamente para vehículos Mazda modelo CX-30 del año 2022. Forma parte de la categoría \'Vidrios\' y ha sido fabricado con vidrio templado de alta calidad. Presenta un acabado texturizado en color blanco, que asegura no solo resistencia y durabilidad, sino también una integración estética con el diseño original del vehículo. Ideal para reparaciones, mejoras o restauraciones completas, manteniendo el rendimiento y la apariencia del auto en condiciones óptimas.', 196.65, 6, 'MAZ-CX--2022-CR', 2, 6, 4, NULL, NULL, '2021-08-15 13:40:16'),
(82, 'Cristal de ventana triangular', 'Cristal de ventana triangular diseñado específicamente para vehículos Ford modelo Mustang del año 2005. Forma parte de la categoría \'Vidrios\' y ha sido fabricado con plástico ABS de alta calidad. Presenta un acabado mate en color plateado, que asegura no solo resistencia y durabilidad, sino también una integración estética con el diseño original del vehículo. Ideal para reparaciones, mejoras o restauraciones completas, manteniendo el rendimiento y la apariencia del auto en condiciones óptimas.', 128.88, 6, 'FOR-MUS-2005-CR', 3, 7, 4, NULL, NULL, '2021-06-22 21:55:32'),
(83, 'Cristal de ventana triangular', 'Cristal de ventana triangular diseñado específicamente para vehículos Ford modelo F-150 del año 2010. Forma parte de la categoría \'Vidrios\' y ha sido fabricado con vidrio templado de alta calidad. Presenta un acabado brillante en color negro, que asegura no solo resistencia y durabilidad, sino también una integración estética con el diseño original del vehículo. Ideal para reparaciones, mejoras o restauraciones completas, manteniendo el rendimiento y la apariencia del auto en condiciones óptimas.', 109.52, 18, 'FOR-F-1-2010-CR', 3, 9, 4, NULL, NULL, '2021-02-12 16:20:47'),
(84, 'Espejo retrovisor interior', 'Espejo retrovisor interior diseñado específicamente para vehículos Toyota modelo Corolla del año 2023. Forma parte de la categoría \'Espejos\' y ha sido fabricado con vidrio templado de alta calidad. Presenta un acabado liso en color negro, que asegura no solo resistencia y durabilidad, sino también una integración estética con el diseño original del vehículo. Ideal para reparaciones, mejoras o restauraciones completas, manteniendo el rendimiento y la apariencia del auto en condiciones óptimas.', 125.15, 6, 'TOY-COR-2023-ES', 1, 1, 5, NULL, NULL, '2021-10-18 18:35:23'),
(85, 'Espejo retrovisor interior', 'Espejo retrovisor interior diseñado específicamente para vehículos Toyota modelo Rav4 del año 2022. Forma parte de la categoría \'Espejos\' y ha sido fabricado con acero reforzado de alta calidad. Presenta un acabado brillante en color plateado, que asegura no solo resistencia y durabilidad, sino también una integración estética con el diseño original del vehículo. Ideal para reparaciones, mejoras o restauraciones completas, manteniendo el rendimiento y la apariencia del auto en condiciones óptimas.', 107.57, 19, 'TOY-RAV-2022-ES', 1, 2, 5, NULL, NULL, '2021-01-08 15:50:38');
INSERT INTO `partes_autos` (`id_parte`, `nombre`, `descripcion`, `precio`, `cantidad_stock`, `codigo_serie`, `id_marca`, `id_modelo`, `id_cat`, `imagen`, `imagen_thumbnail`, `fecha_registro`) VALUES
(86, 'Espejo retrovisor interior', 'Espejo retrovisor interior diseñado específicamente para vehículos Toyota modelo Prado del año 2011. Forma parte de la categoría \'Espejos\' y ha sido fabricado con material compuesto de alta calidad. Presenta un acabado liso en color negro, que asegura no solo resistencia y durabilidad, sino también una integración estética con el diseño original del vehículo. Ideal para reparaciones, mejoras o restauraciones completas, manteniendo el rendimiento y la apariencia del auto en condiciones óptimas.', 155.65, 6, 'TOY-PRA-2011-ES', 1, 3, 5, NULL, NULL, '2021-07-30 20:25:14'),
(87, 'Espejo retrovisor interior', 'Espejo retrovisor interior diseñado específicamente para vehículos Ford modelo Mustang del año 2005. Forma parte de la categoría \'Espejos\' y ha sido fabricado con aluminio de alta calidad. Presenta un acabado texturizado en color azul oscuro, que asegura no solo resistencia y durabilidad, sino también una integración estética con el diseño original del vehículo. Ideal para reparaciones, mejoras o restauraciones completas, manteniendo el rendimiento y la apariencia del auto en condiciones óptimas.', 169.63, 7, 'FOR-MUS-2005-ES', 3, 7, 5, NULL, NULL, '2021-12-10 12:40:49'),
(88, 'Espejo retrovisor interior', 'Espejo retrovisor interior diseñado específicamente para vehículos Ford modelo Escape del año 2012. Forma parte de la categoría \'Espejos\' y ha sido fabricado con aluminio de alta calidad. Presenta un acabado brillante en color blanco, que asegura no solo resistencia y durabilidad, sino también una integración estética con el diseño original del vehículo. Ideal para reparaciones, mejoras o restauraciones completas, manteniendo el rendimiento y la apariencia del auto en condiciones óptimas.', 165.22, 18, 'FOR-ESC-2012-ES', 3, 8, 5, NULL, NULL, '2021-05-22 17:55:25'),
(89, 'Espejo retrovisor exterior izquierdo', 'Espejo retrovisor exterior izquierdo diseñado específicamente para vehículos Toyota modelo Corolla del año 2023. Forma parte de la categoría \'Espejos\' y ha sido fabricado con acero reforzado de alta calidad. Presenta un acabado liso en color azul oscuro, que asegura no solo resistencia y durabilidad, sino también una integración estética con el diseño original del vehículo. Ideal para reparaciones, mejoras o restauraciones completas, manteniendo el rendimiento y la apariencia del auto en condiciones óptimas.', 200.52, 11, 'TOY-COR-2023-ES', 1, 1, 5, NULL, NULL, '2021-03-28 22:20:40'),
(90, 'Espejo retrovisor exterior izquierdo', 'Espejo retrovisor exterior izquierdo diseñado específicamente para vehículos Toyota modelo Rav4 del año 2022. Forma parte de la categoría \'Espejos\' y ha sido fabricado con acero reforzado de alta calidad. Presenta un acabado liso en color blanco, que asegura no solo resistencia y durabilidad, sino también una integración estética con el diseño original del vehículo. Ideal para reparaciones, mejoras o restauraciones completas, manteniendo el rendimiento y la apariencia del auto en condiciones óptimas.', 201.80, 8, 'TOY-RAV-2022-ES', 1, 2, 5, NULL, NULL, '2021-09-15 14:35:56'),
(91, 'Espejo retrovisor exterior izquierdo', 'Espejo retrovisor exterior izquierdo diseñado específicamente para vehículos Toyota modelo Prado del año 2011. Forma parte de la categoría \'Espejos\' y ha sido fabricado con acero reforzado de alta calidad. Presenta un acabado mate en color blanco, que asegura no solo resistencia y durabilidad, sino también una integración estética con el diseño original del vehículo. Ideal para reparaciones, mejoras o restauraciones completas, manteniendo el rendimiento y la apariencia del auto en condiciones óptimas.', 40.89, 16, 'TOY-PRA-2011-ES', 1, 3, 5, NULL, NULL, '2021-11-22 19:50:31'),
(92, 'Espejo retrovisor exterior izquierdo', 'Espejo retrovisor exterior izquierdo diseñado específicamente para vehículos Mazda modelo CX-30 del año 2022. Forma parte de la categoría \'Espejos\' y ha sido fabricado con material compuesto de alta calidad. Presenta un acabado liso en color blanco, que asegura no solo resistencia y durabilidad, sino también una integración estética con el diseño original del vehículo. Ideal para reparaciones, mejoras o restauraciones completas, manteniendo el rendimiento y la apariencia del auto en condiciones óptimas.', 154.48, 17, 'MAZ-CX--2022-ES', 2, 6, 5, NULL, NULL, '2021-04-12 13:25:47'),
(93, 'Espejo retrovisor exterior izquierdo', 'Espejo retrovisor exterior izquierdo diseñado específicamente para vehículos Ford modelo Mustang del año 2005. Forma parte de la categoría \'Espejos\' y ha sido fabricado con vidrio templado de alta calidad. Presenta un acabado mate en color azul oscuro, que asegura no solo resistencia y durabilidad, sino también una integración estética con el diseño original del vehículo. Ideal para reparaciones, mejoras o restauraciones completas, manteniendo el rendimiento y la apariencia del auto en condiciones óptimas.', 129.63, 6, 'FOR-MUS-2005-ES', 3, 7, 5, NULL, NULL, '2021-08-25 21:40:22'),
(94, 'Espejo retrovisor exterior izquierdo', 'Espejo retrovisor exterior izquierdo diseñado específicamente para vehículos Ford modelo Escape del año 2012. Forma parte de la categoría \'Espejos\' y ha sido fabricado con acero reforzado de alta calidad. Presenta un acabado liso en color azul oscuro, que asegura no solo resistencia y durabilidad, sino también una integración estética con el diseño original del vehículo. Ideal para reparaciones, mejoras o restauraciones completas, manteniendo el rendimiento y la apariencia del auto en condiciones óptimas.', 137.95, 10, 'FOR-ESC-2012-ES', 3, 8, 5, NULL, NULL, '2021-06-18 16:55:38'),
(95, 'Espejo retrovisor exterior izquierdo', 'Espejo retrovisor exterior izquierdo diseñado específicamente para vehículos Ford modelo F-150 del año 2010. Forma parte de la categoría \'Espejos\' y ha sido fabricado con plástico ABS de alta calidad. Presenta un acabado brillante en color blanco, que asegura no solo resistencia y durabilidad, sino también una integración estética con el diseño original del vehículo. Ideal para reparaciones, mejoras o restauraciones completas, manteniendo el rendimiento y la apariencia del auto en condiciones óptimas.', 198.39, 5, 'FOR-F-1-2010-ES', 3, 9, 5, NULL, NULL, '2021-02-08 18:20:53'),
(96, 'Cristal de espejo de repuesto', 'Cristal de espejo de repuesto diseñado específicamente para vehículos Toyota modelo Corolla del año 2023. Forma parte de la categoría \'Espejos\' y ha sido fabricado con vidrio templado de alta calidad. Presenta un acabado brillante en color gris metálico, que asegura no solo resistencia y durabilidad, sino también una integración estética con el diseño original del vehículo. Ideal para reparaciones, mejoras o restauraciones completas, manteniendo el rendimiento y la apariencia del auto en condiciones óptimas.', 147.73, 17, 'TOY-COR-2023-CR', 1, 1, 5, NULL, NULL, '2021-10-15 15:35:29'),
(97, 'Cristal de espejo de repuesto', 'Cristal de espejo de repuesto diseñado específicamente para vehículos Toyota modelo Rav4 del año 2022. Forma parte de la categoría \'Espejos\' y ha sido fabricado con vidrio templado de alta calidad. Presenta un acabado texturizado en color negro, que asegura no solo resistencia y durabilidad, sino también una integración estética con el diseño original del vehículo. Ideal para reparaciones, mejoras o restauraciones completas, manteniendo el rendimiento y la apariencia del auto en condiciones óptimas.', 133.40, 9, 'TOY-RAV-2022-CR', 1, 2, 5, NULL, NULL, '2021-01-30 20:50:44'),
(98, 'Cristal de espejo de repuesto', 'Cristal de espejo de repuesto diseñado específicamente para vehículos Toyota modelo Prado del año 2011. Forma parte de la categoría \'Espejos\' y ha sido fabricado con plástico ABS de alta calidad. Presenta un acabado mate en color azul oscuro, que asegura no solo resistencia y durabilidad, sino también una integración estética con el diseño original del vehículo. Ideal para reparaciones, mejoras o restauraciones completas, manteniendo el rendimiento y la apariencia del auto en condiciones óptimas.', 78.17, 19, 'TOY-PRA-2011-CR', 1, 3, 5, NULL, NULL, '2021-07-22 12:25:10'),
(99, 'Cristal de espejo de repuesto', 'Cristal de espejo de repuesto diseñado específicamente para vehículos Mazda modelo CX-5 del año 2011. Forma parte de la categoría \'Espejos\' y ha sido fabricado con material compuesto de alta calidad. Presenta un acabado liso en color negro, que asegura no solo resistencia y durabilidad, sino también una integración estética con el diseño original del vehículo. Ideal para reparaciones, mejoras o restauraciones completas, manteniendo el rendimiento y la apariencia del auto en condiciones óptimas.', 129.31, 19, 'MAZ-CX--2011-CR', 2, 4, 5, NULL, NULL, '2021-12-18 17:40:35'),
(100, 'Cristal de espejo de repuesto', 'Cristal de espejo de repuesto diseñado específicamente para vehículos Ford modelo Escape del año 2012. Forma parte de la categoría \'Espejos\' y ha sido fabricado con aluminio de alta calidad. Presenta un acabado liso en color negro, que asegura no solo resistencia y durabilidad, sino también una integración estética con el diseño original del vehículo. Ideal para reparaciones, mejoras o restauraciones completas, manteniendo el rendimiento y la apariencia del auto en condiciones óptimas.', 172.74, 11, 'FOR-ESC-2012-CR', 3, 8, 5, NULL, NULL, '2021-05-30 22:55:21'),
(101, 'Cristal de espejo de repuesto', 'Cristal de espejo de repuesto diseñado específicamente para vehículos Ford modelo F-150 del año 2010. Forma parte de la categoría \'Espejos\' y ha sido fabricado con acero reforzado de alta calidad. Presenta un acabado liso en color plateado, que asegura no solo resistencia y durabilidad, sino también una integración estética con el diseño original del vehículo. Ideal para reparaciones, mejoras o restauraciones completas, manteniendo el rendimiento y la apariencia del auto en condiciones óptimas.', 44.91, 9, 'FOR-F-1-2010-CR', 3, 9, 5, NULL, NULL, '2021-03-05 14:20:46');

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
) ENGINE=MyISAM AUTO_INCREMENT=139 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `parte_vendida`
--

INSERT INTO `parte_vendida` (`id`, `id_factura`, `id_parte`, `id_usuario`, `cantidad`, `precio_total`, `fecha_venta`, `en_carrito`) VALUES
(5, 1, 56, 2, 1, 98.98, '2025-07-23 15:22:11', 0),
(4, 1, 21, 2, 1, 53.83, '2025-07-23 13:47:38', 0),
(6, 1, 24, 2, 3, 462.00, '2025-07-23 15:22:19', 0),
(7, 2, 24, 2, 3, 462.00, '2025-07-23 16:36:06', 0),
(8, 3, 24, 2, 3, 462.00, '2025-07-23 16:49:29', 0),
(9, 4, 24, 2, 3, 462.00, '2025-07-23 16:51:13', 0),
(10, 5, 24, 2, 1, 154.00, '2025-07-23 17:03:55', 0),
(11, 6, 24, 2, 1, 154.00, '2025-07-23 17:06:13', 0),
(12, 7, 24, 2, 1, 154.00, '2025-07-23 17:09:49', 0),
(17, 10, 5, 3, 2, 321.80, '2025-03-05 09:15:22', 0),
(14, 9, 4, 6, 12, 1005.84, '2025-07-23 17:14:50', 0),
(15, 8, 10, 2, 1, 217.70, '2025-07-23 17:18:04', 0),
(16, 8, 8, 2, 1, 162.70, '2025-07-23 17:50:05', 0),
(18, 11, 12, 5, 1, 220.84, '2025-03-08 11:30:45', 0),
(19, 11, 18, 5, 1, 231.58, '2025-03-08 11:30:45', 0),
(20, 12, 24, 2, 3, 462.00, '2025-03-12 14:20:33', 0),
(21, 13, 30, 4, 1, 218.56, '2025-03-15 10:45:12', 0),
(22, 13, 45, 4, 1, 108.01, '2025-03-15 10:45:12', 0),
(23, 14, 7, 6, 1, 221.17, '2025-03-18 16:30:28', 0),
(24, 14, 15, 6, 2, 130.46, '2025-03-18 16:30:28', 0),
(25, 14, 22, 6, 1, 115.34, '2025-03-18 16:30:28', 0),
(26, 15, 33, 7, 1, 201.60, '2025-03-22 13:10:55', 0),
(27, 15, 41, 7, 3, 79.83, '2025-03-22 13:10:55', 0),
(28, 16, 50, 8, 1, 205.75, '2025-03-25 09:30:17', 0),
(29, 16, 64, 8, 1, 186.62, '2025-03-25 09:30:17', 0),
(30, 18, 10, 3, 1, 217.70, '2025-04-02 10:20:11', 0),
(31, 19, 19, 5, 2, 364.14, '2025-04-05 14:35:44', 0),
(32, 19, 25, 5, 1, 208.69, '2025-04-05 14:35:44', 0),
(33, 20, 26, 2, 1, 145.13, '2025-04-08 11:10:33', 0),
(34, 20, 35, 2, 1, 169.59, '2025-04-08 11:10:33', 0),
(35, 21, 36, 4, 1, 168.21, '2025-04-12 16:25:19', 0),
(36, 21, 44, 4, 1, 78.17, '2025-04-12 16:25:19', 0),
(37, 21, 52, 4, 1, 168.15, '2025-04-12 16:25:19', 0),
(38, 22, 53, 6, 1, 149.94, '2025-04-15 09:40:27', 0),
(39, 22, 60, 6, 1, 239.64, '2025-04-15 09:40:27', 0),
(40, 22, 67, 6, 1, 143.38, '2025-04-15 09:40:27', 0),
(41, 23, 68, 7, 1, 239.41, '2025-04-18 13:15:48', 0),
(42, 23, 74, 7, 1, 130.93, '2025-04-18 13:15:48', 0),
(43, 24, 75, 8, 1, 207.64, '2025-04-22 10:30:56', 0),
(44, 24, 80, 8, 1, 175.40, '2025-04-22 10:30:56', 0),
(45, 26, 91, 3, 1, 40.89, '2025-04-28 11:45:37', 0),
(46, 26, 96, 3, 1, 147.73, '2025-04-28 11:45:37', 0),
(47, 26, 101, 3, 1, 44.91, '2025-04-28 11:45:37', 0),
(48, 27, 2, 5, 1, 55.83, '2025-05-03 09:10:22', 0),
(49, 27, 9, 5, 1, 134.73, '2025-05-03 09:10:22', 0),
(50, 27, 16, 5, 1, 197.10, '2025-05-03 09:10:22', 0),
(51, 28, 23, 2, 1, 69.33, '2025-05-06 14:25:43', 0),
(52, 28, 31, 2, 1, 235.97, '2025-05-06 14:25:43', 0),
(53, 29, 32, 4, 1, 99.06, '2025-05-10 11:30:15', 0),
(54, 29, 39, 4, 1, 105.77, '2025-05-10 11:30:15', 0),
(55, 29, 46, 4, 1, 134.14, '2025-05-10 11:30:15', 0),
(56, 29, 54, 4, 1, 71.29, '2025-05-10 11:30:15', 0),
(57, 30, 55, 6, 1, 208.35, '2025-05-13 16:40:29', 0),
(58, 30, 61, 6, 1, 146.79, '2025-05-13 16:40:29', 0),
(59, 31, 62, 7, 1, 62.32, '2025-05-16 10:20:38', 0),
(60, 31, 69, 7, 1, 196.64, '2025-05-16 10:20:38', 0),
(61, 31, 76, 7, 1, 81.98, '2025-05-16 10:20:38', 0),
(62, 32, 77, 8, 1, 184.60, '2025-05-19 13:50:47', 0),
(63, 32, 82, 8, 1, 128.88, '2025-05-19 13:50:47', 0),
(64, 33, 83, 1, 1, 109.52, '2025-05-22 09:20:16', 0),
(65, 33, 87, 1, 1, 169.63, '2025-05-22 09:20:16', 0),
(66, 33, 92, 1, 1, 154.48, '2025-05-22 09:20:16', 0),
(67, 34, 93, 3, 1, 129.63, '2025-05-25 15:35:24', 0),
(68, 34, 97, 3, 1, 133.40, '2025-05-25 15:35:24', 0),
(69, 34, 100, 3, 1, 172.74, '2025-05-25 15:35:24', 0),
(70, 35, 3, 5, 1, 123.10, '2025-05-28 11:05:33', 0),
(71, 35, 11, 5, 1, 137.18, '2025-05-28 11:05:33', 0),
(72, 36, 14, 2, 1, 42.50, '2025-05-30 14:45:52', 0),
(73, 36, 20, 2, 1, 35.82, '2025-05-30 14:45:52', 0),
(74, 36, 27, 2, 1, 167.25, '2025-05-30 14:45:52', 0),
(75, 36, 34, 2, 1, 132.52, '2025-05-30 14:45:52', 0),
(76, 37, 37, 4, 1, 152.27, '2025-06-02 10:30:11', 0),
(77, 37, 43, 4, 1, 116.73, '2025-06-02 10:30:11', 0),
(78, 38, 47, 6, 1, 179.22, '2025-06-05 13:20:39', 0),
(79, 39, 48, 7, 1, 132.07, '2025-06-09 16:10:28', 0),
(80, 39, 51, 7, 1, 178.36, '2025-06-09 16:10:28', 0),
(81, 39, 56, 7, 1, 98.98, '2025-06-09 16:10:28', 0),
(82, 40, 57, 8, 1, 244.67, '2025-06-12 09:45:17', 0),
(83, 40, 63, 8, 1, 98.06, '2025-06-12 09:45:17', 0),
(84, 41, 65, 1, 1, 232.74, '2025-06-15 14:30:44', 0),
(85, 41, 70, 1, 1, 147.10, '2025-06-15 14:30:44', 0),
(86, 42, 66, 3, 1, 48.60, '2025-06-18 11:15:33', 0),
(87, 42, 71, 3, 1, 34.26, '2025-06-18 11:15:33', 0),
(88, 42, 78, 3, 1, 93.76, '2025-06-18 11:15:33', 0),
(89, 43, 72, 5, 1, 67.61, '2025-06-21 15:25:19', 0),
(90, 43, 79, 5, 1, 195.81, '2025-06-21 15:25:19', 0),
(91, 44, 73, 2, 1, 75.67, '2025-06-24 10:40:27', 0),
(92, 44, 84, 2, 1, 125.15, '2025-06-24 10:40:27', 0),
(93, 44, 89, 2, 1, 200.52, '2025-06-24 10:40:27', 0),
(94, 45, 85, 4, 1, 107.57, '2025-06-27 13:50:38', 0),
(95, 45, 94, 4, 1, 137.95, '2025-06-27 13:50:38', 0),
(96, 46, 88, 6, 1, 165.22, '2025-06-30 16:20:15', 0),
(97, 46, 95, 6, 1, 198.39, '2025-06-30 16:20:15', 0),
(98, 46, 98, 6, 1, 78.17, '2025-06-30 16:20:15', 0),
(99, 47, 99, 7, 1, 129.31, '2025-07-03 09:30:22', 0),
(100, 47, 4, 7, 1, 83.82, '2025-07-03 09:30:22', 0),
(101, 48, 6, 8, 1, 123.32, '2025-07-06 14:15:43', 0),
(102, 48, 13, 8, 1, 117.75, '2025-07-06 14:15:43', 0),
(103, 48, 21, 8, 1, 53.83, '2025-07-06 14:15:43', 0),
(104, 49, 28, 1, 1, 129.55, '2025-07-10 11:25:15', 0),
(105, 49, 38, 1, 1, 84.75, '2025-07-10 11:25:15', 0),
(106, 50, 40, 3, 1, 174.56, '2025-07-13 16:35:29', 0),
(107, 50, 49, 3, 1, 87.04, '2025-07-13 16:35:29', 0),
(108, 51, 42, 5, 1, 129.91, '2025-07-16 10:20:38', 0),
(109, 51, 58, 5, 1, 227.99, '2025-07-16 10:20:38', 0),
(110, 52, 59, 2, 1, 163.83, '2025-07-19 13:40:47', 0),
(111, 53, 2, 4, 1, 55.83, '2025-07-22 09:10:16', 0),
(112, 53, 2, 4, 1, 55.83, '2025-07-22 09:10:16', 0),
(113, 53, 3, 4, 1, 123.10, '2025-07-22 09:10:16', 0),
(114, 54, 4, 6, 1, 83.82, '2025-07-23 10:30:24', 0),
(115, 54, 5, 6, 1, 160.90, '2025-07-23 10:30:24', 0),
(116, 55, 6, 7, 1, 123.32, '2025-07-23 11:45:33', 0),
(117, 55, 7, 7, 1, 221.17, '2025-07-23 11:45:33', 0),
(118, 56, 8, 8, 1, 162.70, '2025-07-23 13:20:52', 0),
(119, 56, 9, 8, 1, 134.73, '2025-07-23 13:20:52', 0),
(120, 57, 10, 1, 1, 217.70, '2025-07-23 14:35:11', 0),
(121, 58, 11, 3, 1, 137.18, '2025-07-23 15:50:39', 0),
(122, 58, 12, 3, 1, 220.84, '2025-07-23 15:50:39', 0),
(123, 59, 13, 5, 1, 117.75, '2025-07-23 17:25:17', 0),
(124, 59, 14, 5, 1, 42.50, '2025-07-23 17:25:17', 0),
(125, 60, 15, 2, 1, 65.23, '2025-07-23 18:30:44', 0),
(126, 60, 16, 2, 1, 197.10, '2025-07-23 18:30:44', 0),
(127, 60, 17, 2, 1, 122.17, '2025-07-23 18:30:44', 0),
(128, 61, 18, 4, 1, 231.58, '2025-07-23 19:45:33', 0),
(129, 61, 19, 4, 1, 182.07, '2025-07-23 19:45:33', 0),
(130, 62, 20, 6, 1, 35.82, '2025-07-23 20:15:19', 0),
(131, 62, 21, 6, 1, 53.83, '2025-07-23 20:15:19', 0),
(132, 62, 22, 6, 1, 115.34, '2025-07-23 20:15:19', 0),
(133, 63, 23, 7, 1, 69.33, '2025-07-23 21:30:27', 0),
(134, 63, 24, 7, 1, 154.00, '2025-07-23 21:30:27', 0),
(135, 64, 25, 8, 1, 208.69, '2025-07-23 22:45:38', 0),
(136, 64, 26, 8, 1, 145.13, '2025-07-23 22:45:38', 0),
(137, 65, 27, 1, 1, 167.25, '2025-07-23 23:59:59', 0),
(138, 65, 28, 1, 1, 129.55, '2025-07-23 23:59:59', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permisos`
--

DROP TABLE IF EXISTS `permisos`;
CREATE TABLE IF NOT EXISTS `permisos` (
  `id_permiso` int NOT NULL AUTO_INCREMENT,
  `nombre_permiso` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_permiso`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `permisos`
--

INSERT INTO `permisos` (`id_permiso`, `nombre_permiso`) VALUES
(1, 'lectura'),
(2, 'escritura'),
(3, 'generar_reporte');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permisos_usuarios`
--

DROP TABLE IF EXISTS `permisos_usuarios`;
CREATE TABLE IF NOT EXISTS `permisos_usuarios` (
  `id_usuario` int NOT NULL,
  `id_permiso` int NOT NULL,
  PRIMARY KEY (`id_usuario`,`id_permiso`),
  KEY `id_permiso` (`id_permiso`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `permisos_usuarios`
--

INSERT INTO `permisos_usuarios` (`id_usuario`, `id_permiso`) VALUES
(1, 1),
(1, 2),
(1, 3),
(2, 0),
(3, 0),
(4, 1),
(5, 0),
(6, 0),
(7, 0),
(8, 1),
(8, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

DROP TABLE IF EXISTS `roles`;
CREATE TABLE IF NOT EXISTS `roles` (
  `id_rol` int NOT NULL AUTO_INCREMENT,
  `nombre_rol` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id_rol`),
  UNIQUE KEY `nombre` (`nombre_rol`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id_rol`, `nombre_rol`) VALUES
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
  `tabla_afectada` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `accion` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_usuario` int DEFAULT NULL,
  `usuario` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `ip_usuario` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `registro` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_traza`),
  KEY `id_usuario` (`id_usuario`)
) ENGINE=MyISAM AUTO_INCREMENT=162 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(90, 'usuario_intentos', 'Select LOGIN_OK', 1, 'admin', '::1', '2025-07-21 22:15:38'),
(91, 'usuario_intentos', 'Select LOGIN_OK', 2, 'yonielvegas', '::1', '2025-07-22 16:35:05'),
(92, 'usuario_intentos', 'Select LOGIN_OK', 2, 'yonielvegas', '::1', '2025-07-22 16:36:06'),
(93, 'usuario_intentos', 'Select LOGIN_OK', 1, 'admin', '::1', '2025-07-22 16:36:42'),
(94, 'usuario_intentos', 'Select LOGIN_OK', 2, 'yonielvegas', '::1', '2025-07-22 16:39:24'),
(95, 'usuario_intentos', 'Select LOGIN_OK', 2, 'yonielvegas', '::1', '2025-07-22 16:50:39'),
(96, 'usuario_intentos', 'Select LOGIN_FAIL', 1, 'admin', '::1', '2025-07-22 22:13:22'),
(97, 'usuario_intentos', 'Select LOGIN_FAIL', 1, 'admin', '::1', '2025-07-22 22:14:02'),
(98, 'usuario_intentos', 'Select LOGIN_OK', 1, 'admin', '::1', '2025-07-22 22:25:45'),
(99, 'usuario_intentos', 'Select LOGIN_OK', 2, 'yonielvegas', '::1', '2025-07-23 17:34:00'),
(100, 'parte_vendida', 'inserción', 16, '2', '::1', '2025-07-23 17:38:38'),
(101, 'parte_vendida', 'actualización', 16, '2', '::1', '2025-07-23 17:38:44'),
(102, 'parte_vendida', 'inserción', 23, '2', '::1', '2025-07-23 17:38:51'),
(103, 'parte_vendida', 'actualización', 23, '2', '::1', '2025-07-23 17:38:57'),
(104, 'usuario_intentos', 'Select LOGIN_FAIL', 1, 'admin', '::1', '2025-07-23 17:50:12'),
(105, 'usuario_intentos', 'Select LOGIN_OK', 1, 'admin', '::1', '2025-07-23 17:50:22'),
(106, 'usuario_intentos', 'Select LOGIN_OK', 2, 'yonielvegas', '::1', '2025-07-23 18:47:09'),
(107, 'parte_vendida', 'inserción', 21, '2', '::1', '2025-07-23 18:47:26'),
(108, 'parte_vendida', 'inserción', 21, '2', '::1', '2025-07-23 18:47:38'),
(109, 'parte_vendida', 'inserción', 56, '2', '::1', '2025-07-23 20:22:11'),
(110, 'parte_vendida', 'inserción', 24, '2', '::1', '2025-07-23 20:22:19'),
(111, 'parte_vendida', 'inserción', 24, '2', '::1', '2025-07-23 21:36:06'),
(112, 'parte_vendida', 'inserción', 24, '2', '::1', '2025-07-23 21:49:29'),
(113, 'parte_vendida', 'inserción', 24, '2', '::1', '2025-07-23 21:51:13'),
(114, 'parte_vendida', 'inserción', 24, '2', '::1', '2025-07-23 22:03:55'),
(115, 'parte_vendida', 'inserción', 24, '2', '::1', '2025-07-23 22:06:13'),
(116, 'parte_vendida', 'inserción', 24, '2', '::1', '2025-07-23 22:09:49'),
(117, 'parte_vendida', 'inserción', 4, '2', '::1', '2025-07-23 22:12:18'),
(118, 'parte_vendida', 'actualización', 4, '2', '::1', '2025-07-23 22:12:45'),
(119, 'usuario_intentos', 'Select LOGIN_OK', 4, 'salmon', '::1', '2025-07-23 22:13:25'),
(120, 'usuario_intentos', 'Select LOGIN_OK', 6, 'juanp', '::1', '2025-07-23 22:13:47'),
(121, 'usuario_intentos', 'Select LOGIN_OK', 6, 'juanp', '::1', '2025-07-23 22:14:16'),
(122, 'parte_vendida', 'inserción', 4, '6', '::1', '2025-07-23 22:14:50'),
(123, 'usuario_intentos', 'Select LOGIN_OK', 2, 'yonielvegas', '::1', '2025-07-23 22:15:07'),
(124, 'parte_vendida', 'inserción', 10, '2', '::1', '2025-07-23 22:18:04'),
(125, 'usuario_intentos', 'Select LOGIN_OK', 1, 'admin', '::1', '2025-07-23 22:19:39'),
(126, 'usuario_intentos', 'Select LOGIN_OK', 2, 'yonielvegas', '::1', '2025-07-23 22:39:28'),
(127, 'usuario_intentos', 'Select LOGIN_OK', 1, 'admin', '::1', '2025-07-23 22:45:48'),
(128, 'usuario_intentos', 'Select LOGIN_OK', 2, 'yonielvegas', '::1', '2025-07-23 22:49:39'),
(129, 'parte_vendida', 'inserción', 8, '2', '::1', '2025-07-23 22:50:05'),
(130, 'usuario_intentos', 'Select LOGIN_OK', 1, 'admin', '::1', '2025-07-23 22:51:24'),
(131, 'usuario_intentos', 'Select LOGIN_FAIL', 1, 'admin', '::1', '2025-07-24 00:00:13'),
(132, 'usuario_intentos', 'Select LOGIN_OK', 1, 'admin', '::1', '2025-07-24 00:00:28'),
(133, 'usuario_intentos', 'Select LOGIN_OK', 2, 'yonielvegas', '::1', '2025-07-24 14:15:57'),
(134, 'usuario_intentos', 'Select LOGIN_OK', 1, 'admin', '::1', '2025-07-24 14:50:05'),
(135, 'usuario_intentos', 'Select LOGIN_OK', 1, 'admin', '::1', '2025-07-24 14:58:40'),
(136, 'usuario_intentos', 'Select LOGIN_FAIL', 1, 'admin', '::1', '2025-07-24 14:58:53'),
(137, 'usuario_intentos', 'Select LOGIN_OK', 1, 'admin', '::1', '2025-07-24 14:59:24'),
(138, 'usuario_intentos', 'Select LOGIN_OK', 1, 'admin', '::1', '2025-07-24 15:02:56'),
(139, 'usuario_intentos', 'Select LOGIN_OK', 1, 'admin', '::1', '2025-07-24 15:07:00'),
(140, 'usuario_intentos', 'Select LOGIN_OK', 1, 'admin', '::1', '2025-07-24 15:17:20'),
(141, 'usuario_intentos', 'Select LOGIN_OK', 1, 'admin', '::1', '2025-07-24 15:26:11'),
(142, 'usuario_intentos', 'Select LOGIN_OK', 4, 'salmon', '::1', '2025-07-24 15:28:30'),
(143, 'usuario_intentos', 'Select LOGIN_OK', 1, 'admin', '::1', '2025-07-24 15:29:28'),
(144, 'usuario_intentos', 'Select LOGIN_FAIL', 1, 'admin', '::1', '2025-07-24 15:59:51'),
(145, 'usuario_intentos', 'Select LOGIN_OK', 1, 'admin', '::1', '2025-07-24 15:59:59'),
(146, 'usuario_intentos', 'Select LOGIN_OK', 1, 'admin', '::1', '2025-07-24 16:09:04'),
(147, 'usuario_intentos', 'Select LOGIN_OK', 1, 'admin', '::1', '2025-07-24 16:15:32'),
(148, 'usuario_intentos', 'Select LOGIN_OK', 1, 'admin', '::1', '2025-07-24 16:17:47'),
(149, 'usuario_intentos', 'Select LOGIN_FAIL', 1, 'admin', '::1', '2025-07-24 16:18:17'),
(150, 'usuario_intentos', 'Select LOGIN_OK', 1, 'admin', '::1', '2025-07-24 16:18:25'),
(151, 'usuario_intentos', 'Select LOGIN_FAIL', 1, 'admin', '::1', '2025-07-24 16:18:51'),
(152, 'usuario_intentos', 'Select LOGIN_OK', 1, 'admin', '::1', '2025-07-24 16:19:15'),
(153, 'usuario_intentos', 'Select LOGIN_OK', 1, 'admin', '::1', '2025-07-24 16:19:44'),
(154, 'usuario_intentos', 'Select LOGIN_FAIL', 1, 'admin', '::1', '2025-07-24 16:22:08'),
(155, 'usuario_intentos', 'Select LOGIN_OK', 1, 'admin', '::1', '2025-07-24 16:22:16'),
(156, 'usuario_intentos', 'Select LOGIN_FAIL', 1, 'admin', '::1', '2025-07-24 16:44:25'),
(157, 'usuario_intentos', 'Select LOGIN_OK', 1, 'admin', '::1', '2025-07-24 16:44:33'),
(158, 'usuario_intentos', 'Select LOGIN_OK', 1, 'admin', '::1', '2025-07-24 16:45:30'),
(159, 'usuario_intentos', 'Select LOGIN_OK', 1, 'admin', '::1', '2025-07-24 16:47:27'),
(160, 'usuario_intentos', 'Select LOGIN_OK', 2, 'yonielvegas', '::1', '2025-07-24 16:49:36'),
(161, 'usuario_intentos', 'Select LOGIN_OK', 1, 'admin', '::1', '2025-07-24 17:48:02');

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
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `nombre`, `apellido`, `correo`, `telefono`, `usuario`, `password`, `activo`) VALUES
(1, 'Administrador', 'General', 'admin@example.com', '0000000000', 'admin', '$2y$10$H/pm0ydBBgz1eW.pJNxWA.lRaJwUTqJ3OuthUS4opexiHY9XhMokK', 1),
(2, 'Yoel', 'Samaniego', 'yoelsamaniego4@gmail.com', '62834187', 'yonielvegas', '$2y$13$oLl9aizqjfwO1FSfpNBkYOZ1BW2umti5ivUxHuPpq7th1KKp6fiHy', 1),
(3, 'Ana', 'Pinto', 'anapinto@gmail.com', '62873192', 'anap', '$2y$13$jt96g.ARqwh2EY2vsc5A6.imp1LNrUA05Qmn/aYdY5/OGCxaMMlgO', 1),
(4, 'Irina', 'Fong', 'IrinaF@gmail.com', '34675632', 'salmon', '$2y$13$jt96g.ARqwh2EY2vsc5A6.imp1LNrUA05Qmn/aYdY5/OGCxaMMlgO', 1),
(5, 'pedro', 'perez', 'pedro@gmail.com', '232344534', 'pedro2', '$2y$13$jt96g.ARqwh2EY2vsc5A6.imp1LNrUA05Qmn/aYdY5/OGCxaMMlgO', 1),
(6, 'Juan', 'Gonzales', 'juanperez@gmail.com', '442323233', 'juanp', '$2y$13$jt96g.ARqwh2EY2vsc5A6.imp1LNrUA05Qmn/aYdY5/OGCxaMMlgO', 1),
(7, 'Elda', 'Rodriguez', 'eldabr@gmail.com', '64373787', 'Eldabr', '$2y$13$jt96g.ARqwh2EY2vsc5A6.imp1LNrUA05Qmn/aYdY5/OGCxaMMlgO', 1),
(8, 'Gabriel', 'González', 'gabi@gmail.com', '64120822', 'gabig05', '$2y$13$jt96g.ARqwh2EY2vsc5A6.imp1LNrUA05Qmn/aYdY5/OGCxaMMlgO', 1);

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
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(7, 7, 3),
(8, 8, 2);

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
(6, 6, 0, 0);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
