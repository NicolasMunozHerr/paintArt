-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 29-11-2022 a las 01:01:49
-- Versión del servidor: 10.5.16-MariaDB
-- Versión de PHP: 7.3.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `id19786183_paintart`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `artista`
--

CREATE TABLE `artista` (
  `idArtista` int(11) NOT NULL,
  `biografia` varchar(200) DEFAULT NULL,
  `Usuario_Registrado_idUsuario_Registrado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `artista`
--

INSERT INTO `artista` (`idArtista`, `biografia`, `Usuario_Registrado_idUsuario_Registrado`) VALUES
(1, 'esto es una biografia', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `artista_has_clicks`
--

CREATE TABLE `artista_has_clicks` (
  `Artista_idArtista` int(11) NOT NULL,
  `clicks_idclicks` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `artista_has_clicks`
--

INSERT INTO `artista_has_clicks` (`Artista_idArtista`, `clicks_idclicks`) VALUES
(1, 44),
(1, 45),
(1, 60),
(1, 66),
(1, 67),
(1, 71),
(1, 76),
(1, 136),
(1, 143),
(1, 144),
(1, 145),
(1, 146),
(1, 147),
(1, 148),
(1, 202),
(1, 256),
(1, 264);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clicks`
--

CREATE TABLE `clicks` (
  `idclicks` int(11) NOT NULL,
  `fechaClick` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `clicks`
--

INSERT INTO `clicks` (`idclicks`, `fechaClick`) VALUES
(44, '2022-11-25'),
(45, '2022-11-25'),
(46, '2022-11-25'),
(47, '2022-11-25'),
(48, '2022-11-25'),
(49, '2022-11-25'),
(50, '2022-11-25'),
(51, '2022-11-25'),
(52, '2022-11-25'),
(53, '2022-11-25'),
(54, '2022-11-25'),
(55, '2022-11-25'),
(56, '2022-11-25'),
(57, '2022-11-25'),
(58, '2022-11-25'),
(59, '2022-11-25'),
(60, '2022-11-25'),
(61, '2022-11-25'),
(62, '2022-11-25'),
(63, '2022-11-25'),
(64, '2022-11-25'),
(65, '2022-11-25'),
(66, '2022-11-26'),
(67, '2022-11-26'),
(69, '2022-11-27'),
(70, '2022-11-27'),
(71, '2022-11-27'),
(72, '2022-11-27'),
(73, '2022-11-27'),
(74, '2022-11-27'),
(75, '2022-11-27'),
(76, '2022-11-27'),
(77, '2022-11-27'),
(78, '2022-11-27'),
(79, '2022-11-27'),
(80, '2022-11-27'),
(81, '2022-11-27'),
(82, '2022-11-27'),
(83, '2022-11-27'),
(111, '2022-11-27'),
(119, '2022-11-27'),
(120, '2022-11-27'),
(121, '2022-11-27'),
(122, '2022-11-27'),
(123, '2022-11-27'),
(124, '2022-11-27'),
(125, '2022-11-27'),
(126, '2022-11-27'),
(127, '2022-11-27'),
(128, '2022-11-27'),
(129, '2022-11-27'),
(130, '2022-11-27'),
(131, '2022-11-27'),
(132, '2022-11-27'),
(133, '2022-11-27'),
(134, '2022-11-27'),
(135, '2022-11-27'),
(136, '2022-11-27'),
(137, '2022-11-27'),
(138, '2022-11-27'),
(139, '2022-11-27'),
(140, '2022-11-27'),
(141, '2022-11-27'),
(142, '2022-11-27'),
(143, '2022-11-27'),
(144, '2022-11-27'),
(145, '2022-11-27'),
(146, '2022-11-27'),
(147, '2022-11-27'),
(148, '2022-11-27'),
(149, '2022-11-27'),
(150, '2022-11-27'),
(151, '2022-11-27'),
(152, '2022-11-27'),
(153, '2022-11-27'),
(154, '2022-11-27'),
(155, '2022-11-27'),
(156, '2022-11-27'),
(157, '2022-11-27'),
(158, '2022-11-27'),
(159, '2022-11-27'),
(160, '2022-11-27'),
(161, '2022-11-27'),
(162, '2022-11-27'),
(163, '2022-11-27'),
(164, '2022-11-27'),
(165, '2022-11-27'),
(166, '2022-11-27'),
(167, '2022-11-27'),
(168, '2022-11-27'),
(169, '2022-11-27'),
(170, '2022-11-27'),
(171, '2022-11-27'),
(172, '2022-11-27'),
(173, '2022-11-27'),
(174, '2022-11-27'),
(175, '2022-11-27'),
(176, '2022-11-27'),
(177, '2022-11-27'),
(178, '2022-11-27'),
(179, '2022-11-27'),
(180, '2022-11-27'),
(181, '2022-11-27'),
(182, '2022-11-27'),
(183, '2022-11-27'),
(184, '2022-11-27'),
(185, '2022-11-27'),
(186, '2022-11-27'),
(187, '2022-11-27'),
(188, '2022-11-27'),
(189, '2022-11-27'),
(190, '2022-11-27'),
(191, '2022-11-27'),
(192, '2022-11-27'),
(193, '2022-11-27'),
(194, '2022-11-27'),
(195, '2022-11-27'),
(196, '2022-11-27'),
(197, '2022-11-27'),
(198, '2022-11-27'),
(199, '2022-11-27'),
(200, '2022-11-27'),
(201, '2022-11-27'),
(202, '2022-11-27'),
(203, '2022-11-28'),
(204, '2022-11-28'),
(205, '2022-11-28'),
(206, '2022-11-28'),
(207, '2022-11-28'),
(208, '2022-11-28'),
(209, '2022-11-28'),
(210, '2022-11-28'),
(211, '2022-11-28'),
(212, '2022-11-28'),
(213, '2022-11-28'),
(214, '2022-11-28'),
(215, '2022-11-28'),
(216, '2022-11-28'),
(217, '2022-11-28'),
(218, '2022-11-28'),
(219, '2022-11-28'),
(220, '2022-11-28'),
(221, '2022-11-28'),
(222, '2022-11-28'),
(223, '2022-11-28'),
(224, '2022-11-28'),
(225, '2022-11-28'),
(226, '2022-11-28'),
(227, '2022-11-28'),
(228, '2022-11-28'),
(229, '2022-11-28'),
(230, '2022-11-28'),
(231, '2022-11-28'),
(232, '2022-11-28'),
(233, '2022-11-28'),
(234, '2022-11-28'),
(235, '2022-11-28'),
(236, '2022-11-28'),
(237, '2022-11-28'),
(238, '2022-11-28'),
(239, '2022-11-28'),
(240, '2022-11-28'),
(241, '2022-11-28'),
(242, '2022-11-28'),
(243, '2022-11-28'),
(244, '2022-11-28'),
(245, '2022-11-28'),
(246, '2022-11-28'),
(247, '2022-11-28'),
(248, '2022-11-28'),
(249, '2022-11-28'),
(250, '2022-11-28'),
(251, '2022-11-28'),
(252, '2022-11-28'),
(253, '2022-11-28'),
(254, '2022-11-28'),
(255, '2022-11-28'),
(256, '2022-11-28'),
(257, '2022-11-28'),
(258, '2022-11-28'),
(259, '2022-11-28'),
(260, '2022-11-28'),
(261, '2022-11-28'),
(262, '2022-11-28'),
(263, '2022-11-28'),
(264, '2022-11-28');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compra`
--

CREATE TABLE `compra` (
  `idCompra` int(11) NOT NULL,
  `fechaCompra` date DEFAULT NULL,
  `metodoCompra` varchar(45) DEFAULT NULL,
  `Usuario_Registrado_idUsuario_Registrado` int(11) NOT NULL,
  `Artista_idArtista` int(11) NOT NULL,
  `Direccion_IdDireccion` int(11) NOT NULL,
  `estadoEnvio` varchar(50) DEFAULT NULL,
  `Obra_idObra` int(11) NOT NULL,
  `precioCompra` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `compra`
--

INSERT INTO `compra` (`idCompra`, `fechaCompra`, `metodoCompra`, `Usuario_Registrado_idUsuario_Registrado`, `Artista_idArtista`, `Direccion_IdDireccion`, `estadoEnvio`, `Obra_idObra`, `precioCompra`) VALUES
(2, '2022-11-25', 'webpay', 2, 1, 2, '123123', 3, 123123),
(3, '2022-11-27', 'webpay', 5, 1, 7, NULL, 3, 123123),
(4, '2022-11-27', 'webpay', 5, 1, 8, NULL, 3, 123123);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contraseña`
--

CREATE TABLE `contraseña` (
  `idcontraseña` int(11) NOT NULL,
  `email` varchar(45) DEFAULT NULL,
  `token` varchar(200) DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `codigo` int(11) DEFAULT NULL,
  `Usuario_Registrado_idUsuario_Registrado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `control_ip`
--

CREATE TABLE `control_ip` (
  `ip` varchar(20) NOT NULL,
  `fecha` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `critica`
--

CREATE TABLE `critica` (
  `idCrititica` int(11) NOT NULL,
  `valoracion` int(11) DEFAULT NULL,
  `critica` varchar(200) DEFAULT NULL,
  `Obra_idObra` int(11) NOT NULL,
  `Usuario_Registrado_idUsuario_Registrado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `critica`
--

INSERT INTO `critica` (`idCrititica`, `valoracion`, `critica`, `Obra_idObra`, `Usuario_Registrado_idUsuario_Registrado`) VALUES
(8, 5, 'Comentario', 3, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `direccion`
--

CREATE TABLE `direccion` (
  `IdDireccion` int(11) NOT NULL,
  `region` varchar(45) DEFAULT NULL,
  `ciudad` varchar(45) DEFAULT NULL,
  `comuna` varchar(45) DEFAULT NULL,
  `calle` varchar(45) DEFAULT NULL,
  `tipoHogar` int(11) DEFAULT NULL,
  `numeracion` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `direccion`
--

INSERT INTO `direccion` (`IdDireccion`, `region`, `ciudad`, `comuna`, `calle`, `tipoHogar`, `numeracion`) VALUES
(1, 'Arica-Parinacota', 'sdfs', 'sdfs', 'sdfs', 1, 234),
(2, 'Arica-Parinacota', 'santiago', 'santiago', 'santiago', 1, 123),
(3, 'Arica-Parinacota', '123', '123', '123', 1, 123),
(4, 'Arica-Parinacota', 'asdasda', 'asdasd', 'asda', 2, 123),
(5, 'Arica-Parinacota', 'Santiago', 'Maipu', 'Cordillera de los andes', 1, 600),
(6, 'Arica-Parinacota', 'peticion', 'Maipu', 'coridllera de los andes', 1, 123123123),
(7, 'Metropolitana', 'Santiago', 'maipu', 'av cordillera de los andes ', 1, 600),
(8, 'Arica-Parinacota', 'Santiago', 'maipu', 'av cordillera de los andes ', 1, 600),
(9, 'Arica-Parinacota', 'Santiago', 'Santiago', 'Santiago', 1, 123),
(10, 'Arica-Parinacota', 'Santiago', 'maipu', 'av cordillera de los andes ', 1, 600),
(11, 'Arica-Parinacota', 'Santiago', 'maipu', 'av cordillera de los andes ', 1, 600),
(12, 'Arica-Parinacota', 'Santiago', 'maipu', 'av cordillera de los andes ', 2, 123),
(13, 'Arica-Parinacota', 'Santiago', 'maipu', 'av cordillera de los andes ', 1, 600),
(14, 'Arica-Parinacota', 'Santiago', 'maipu', 'Santiago', 1, 600),
(15, 'Arica-Parinacota', 'Santiago', 'maipu', 'av cordillera de los andes ', 1, 600),
(16, 'Arica-Parinacota', 'Santiago', 'maipu', 'av cordillera de los andes ', 1, 600),
(17, 'Arica-Parinacota', 'Santiago', 'compra', 'av cordillera de los andes ', 1, 600),
(18, 'Arica-Parinacota', '123', '123', '123', 1, 123),
(19, 'Arica-Parinacota', '123', '1231', '1231', 1, 123),
(20, 'Arica-Parinacota', '123', 'maipu', '123', 1, 123),
(21, 'Arica-Parinacota', 'Santiago', 'maipu', '123', 1, 123),
(22, 'Arica-Parinacota', 'Santiago', 'maipu', '123', 1, 123),
(23, 'Arica-Parinacota', 'Santiago', 'maipu', 'av cordillera de los andes ', 1, 123),
(24, 'Arica-Parinacota', 'Santiago', 'maipu', 'av cordillera de los andes ', 1, 123),
(25, 'Arica-Parinacota', 'Santiago', 'maipu', 'av cordillera de los andes ', 1, 123),
(26, 'Arica-Parinacota', 'Santiago', 'maipu', 'av cordillera de los andes ', 2, 600),
(27, 'Arica-Parinacota', 'Santiago', 'maipu', 'av cordillera de los andes ', 1, 600),
(28, 'Arica-Parinacota', 'Santiago', 'maipu', 'av cordillera de los andes ', 1, 600),
(29, 'Arica-Parinacota', 'Santiago', 'maipu', 'av cordillera de los andes ', 1, 600),
(30, 'Arica-Parinacota', 'Santiago', 'maipu', 'av cordillera de los andes ', 1, 600),
(31, 'Metropolitana', 'padre hurtado', 'padre hurtado', 'av laguna 3581', 1, 123),
(32, 'Arica-Parinacota', 'Santiago', 'maipu', 'av cordillera de los andes ', 1, 600);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `imagen`
--

CREATE TABLE `imagen` (
  `idImagen` int(11) NOT NULL,
  `UrlImagen` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `imagen`
--

INSERT INTO `imagen` (`idImagen`, `UrlImagen`) VALUES
(2, 'imagenesUser/f9aa54d803Obra de Alex Chellew.jpeg'),
(5, 'imagenesObra/a5170e8ad6Prueba.jpg'),
(6, 'imagenesObra/4b5f8443c1especifico.jpg'),
(7, 'imagenes/avatar.png'),
(8, 'imagenes/avatar.png'),
(9, 'imagenes/avatar.png'),
(10, 'imagenesNota/b913338d69Obra de Alex Chellew.jpeg'),
(11, 'imagenesObra/dab1b707dbObra de Alex Chellew.jpeg'),
(12, 'imagenesObra/b7e1b9f808bonito.jpg'),
(13, 'imagenes/avatar.png'),
(16, 'imagenesObra/f028a50543Obra de Alex Chellew.jpeg'),
(17, 'imagenesObra/ac8c06228dc690bba74ef87dc86e5753a65890125d.jpg'),
(18, 'imagenesObra/51ff1bebf3c690bba74ef87dc86e5753a65890125d.jpg'),
(19, 'imagenesObra/0ba811f2e4c690bba74ef87dc86e5753a65890125d.jpg'),
(20, 'imagenesObra/5fdecd2018c690bba74ef87dc86e5753a65890125d.jpg'),
(21, 'imagenesObra/dea4c8fde4c690bba74ef87dc86e5753a65890125d.jpg'),
(22, 'imagenesObra/3bfc9d88a5c690bba74ef87dc86e5753a65890125d.jpg'),
(23, 'imagenesObra/b65d9829d6c690bba74ef87dc86e5753a65890125d.jpg'),
(24, 'imagenesObra/8307f2c540c690bba74ef87dc86e5753a65890125d.jpg'),
(25, 'imagenesObra/f8dc2f8047c690bba74ef87dc86e5753a65890125d.jpg'),
(26, 'imagenesObra/7ed5bbad8cc690bba74ef87dc86e5753a65890125d.jpg'),
(27, 'imagenesObra/7c1ea70178c690bba74ef87dc86e5753a65890125d.jpg'),
(28, 'imagenesObra/ae06c5f35fc690bba74ef87dc86e5753a65890125d.jpg'),
(29, 'imagenesObra/b94cf2093ac690bba74ef87dc86e5753a65890125d.jpg'),
(30, 'imagenesObra/5669dc72efc690bba74ef87dc86e5753a65890125d.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `notainformativa`
--

CREATE TABLE `notainformativa` (
  `idnotaInformativa` int(11) NOT NULL,
  `titular` varchar(45) DEFAULT NULL,
  `cuerpo` varchar(5000) DEFAULT NULL,
  `epigrafe` varchar(45) DEFAULT NULL,
  `Usuario_Registrado_idUsuario_Registrado` int(11) NOT NULL,
  `Imagen_idImagen` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `notainformativa`
--

INSERT INTO `notainformativa` (`idnotaInformativa`, `titular`, `cuerpo`, `epigrafe`, `Usuario_Registrado_idUsuario_Registrado`, `Imagen_idImagen`) VALUES
(1, 'Esta es un ejemplo', '<p style=\"margin-right: 0px; margin-bottom: 10px; margin-left: 0px; font-family: &quot;Open Sans&quot;; padding: 10px 0px; color: rgb(64, 64, 64); font-size: 14px; line-height: 25px; letter-spacing: normal; background-color: rgb(255, 255, 255); text-align: justify;\">La feria internacional<span style=\"font-weight: 700;\">&nbsp;ART WEEK</span>, que conecta al público con las últimas tendencias de las artes visuales, llega por primera vez a Las Condes, a los jardines de&nbsp;<span style=\"font-weight: 700;\">Santa Rosa de Apoquindo</span>, (Padre Hurtado Sur 1195 y Visviri 1200), entre el 25 y 27 de noviembre, de 11:00 a 20:00 horas.</p><p style=\"margin-right: 0px; margin-bottom: 10px; margin-left: 0px; font-family: &quot;Open Sans&quot;; padding: 10px 0px; color: rgb(64, 64, 64); font-size: 14px; line-height: 25px; letter-spacing: normal; background-color: rgb(255, 255, 255); text-align: justify;\">Se trata de uno de los encuentros de arte interdisciplinario más importantes del país y en ésta, su tercera versión, reúne a más de 200 artistas de Chile, Argentina, Perú, México y Rusia, tanto consagrados como emergentes. Además de los stands de venta, este año se presenta en la Casa-Museo una exposición interactiva de “muralismo de luz”.</p><p class=\"paragraph  \" style=\"font-size: 1.25rem; margin-bottom: 30px; line-height: 1.75; font-family: georgia, times, &quot;times new roman&quot;, serif; letter-spacing: normal; background-color: rgb(255, 255, 255);\"><span style=\"color: rgb(64, 64, 64); font-family: &quot;Open Sans&quot;; font-size: 14px; text-align: justify;\">&nbsp;Entradas a la venta en&nbsp;</span><a href=\"http://www.passline.com/sitio/art-week-2022\" style=\"background-color: rgb(255, 255, 255); font-family: &quot;Open Sans&quot;; font-size: 14px; text-align: justify; font-weight: normal; color: rgb(12, 174, 197); text-decoration: none; transition: color 0.15s ease 0s;\">www.passline.com/sitio/art-week-2022</a><span style=\"color: rgb(64, 64, 64); font-family: &quot;Open Sans&quot;; font-size: 14px; text-align: justify;\">.&nbsp;$ 2.000 general / 2x1 Tarjeta Vecino Las Condes.&nbsp;&nbsp;</span><span style=\"font-size: 1.25rem;\">“Se trata de una persona de sexo masculino,&nbsp;</span><span style=\"font-size: 1.25rem; font-weight: 700;\">mayor de edad, no vacunado&nbsp;</span><span style=\"font-size: 1.25rem;\">y que fue diagnosticada con la enfermedad el 20 de octubre,&nbsp;</span><span style=\"font-size: 1.25rem; font-weight: 700;\">contaba con patologías de base y el sistema inmunológico debilitado</span><span style=\"font-size: 1.25rem;\">&nbsp;(inmunosupresión)”, indicaron desde el Minsal.</span><br></p><p class=\"paragraph  \" style=\"font-size: 1.25rem; margin-bottom: 30px; line-height: 1.75; font-family: georgia, times, &quot;times new roman&quot;, serif; letter-spacing: normal; background-color: rgb(255, 255, 255);\">La Organización Mundial de la Salud (OMS)&nbsp;<span style=\"font-weight: 700;\">declaró en junio de este año alerta sanitaria mundial&nbsp;</span>por viruela del mono y al 15 de noviembre se registran más de 79.000 mil contagios por la infección y&nbsp;<span style=\"font-weight: 700;\">50 fallecidos a nivel global.</span></p><p class=\"paragraph  \" style=\"font-size: 1.25rem; margin-bottom: 30px; line-height: 1.75; font-family: georgia, times, &quot;times new roman&quot;, serif; letter-spacing: normal; background-color: rgb(255, 255, 255);\">“Debemos recordar que la principal vía de transmisión de la Viruela del Mono es el&nbsp;<span style=\"font-weight: 700;\">contacto estrecho prolongado piel con piel</span>, por lo que las personas con múltiples parejas sexuales o con conductas de riesgo tienen más probabilidades de enfermar”, agregaron.</p><p class=\"paragraph  \" style=\"font-size: 1.25rem; margin-bottom: 30px; line-height: 1.75; font-family: georgia, times, &quot;times new roman&quot;, serif; letter-spacing: normal; background-color: rgb(255, 255, 255);\">La Autoridad Sanitaria enfatizo en la<span style=\"font-weight: 700;\">&nbsp;importancia de la consulta oportuna&nbsp;</span>en un centro asistencial ante la aparición de síntomas como lesiones de la piel o de las mucosas, particularmente en la zona genital, lo cual puede acompañarse de temperatura sobre 38,5ºC, ganglios inflamados, dolor de cabeza, dolores musculares y decaimiento.</p>', 'solo ejemplo', 5, 10);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `obra`
--

CREATE TABLE `obra` (
  `idObra` int(11) NOT NULL,
  `categoria` varchar(20) DEFAULT NULL,
  `detalles` varchar(100) DEFAULT NULL,
  `dimensiones` varchar(20) DEFAULT NULL,
  `fechaPublicacion` date DEFAULT NULL,
  `precio` int(11) DEFAULT NULL,
  `Reacciones` int(11) DEFAULT NULL,
  `SobreObra` varchar(500) DEFAULT NULL,
  `tecnica` varchar(150) DEFAULT NULL,
  `Titulo` varchar(45) DEFAULT NULL,
  `stock` int(11) DEFAULT NULL,
  `Artista_idArtista` int(11) NOT NULL,
  `Imagen_idImagen` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `obra`
--

INSERT INTO `obra` (`idObra`, `categoria`, `detalles`, `dimensiones`, `fechaPublicacion`, `precio`, `Reacciones`, `SobreObra`, `tecnica`, `Titulo`, `stock`, `Artista_idArtista`, `Imagen_idImagen`) VALUES
(3, 'Arte urbano', 'asda', '123X12', NULL, 123123, 1, 'ajsdoiaj', '123', 'Hola soy Obra', 8, 1, 5),
(4, 'Arte urbano', 'Hola soy Obra', '123X123', NULL, 1231231, 2, 'asdasdas', 'Hola soy Obra', 'Hola soy Obra', 1, 1, 6),
(5, 'Arte urbano', 'Subasta ejemplo', '123X123', NULL, 10000, 2, 'Subasta ejemploSubasta ejemplo Subasta ejemplo Subasta ejemplo', 'Subasta ejemplo', 'Subasta', 1, 1, 11),
(6, 'Arte urbano', 'Subasta', '123X123', NULL, 123, 2, 'SubastaSubastaSubastaSubasta', 'Subasta', 'Subasta', 1, 1, 12),
(7, 'Arte urbano', 'baneados', '123X123', NULL, 123, 2, '', 'Hola soy Obra', 'baneado', 1, 1, 16),
(8, 'Arte urbano', 'Obra de ejemplo', '123X123', NULL, 50000, 0, 'Obra de ejemploObra de ejemploObra de ejemploObra de ejemplo', 'Obra de ejemplo', 'Obra de ejemplo', 25, 1, 17),
(9, 'Arte urbano', 'Obra de ejemplo', '123X123', NULL, 40000, 0, 'Obra de ejemploObra de ejemplo', 'Obra de ejemplo', 'Obra de ejemplo', 12, 1, 18),
(10, 'Arte urbano', 'Obra de ejemplo', '123X123', NULL, 20000, 0, 'Obra de ejemploObra de ejemploObra de ejemploObra de ejemplo', 'Obra de ejemplo', 'Obra de ejemplo', 12, 1, 19),
(11, 'Arte urbano', 'Obra de ejemplo', '123X123', NULL, 40000, 0, 'Obra de ejemploObra de ejemploObra de ejemploObra de ejemplo', 'Obra de ejemplo', 'Obra de ejemplo', 123, 1, 20),
(12, 'Arte urbano', 'Obra de ejemplo', '123X123', NULL, 50000, 0, 'Obra de ejemploObra de ejemploObra de ejemplo', 'Obra de ejemplo', 'Obra de ejemplo', 11, 1, 21),
(13, 'Arte urbano', 'Obra de ejemplo', '123X123', NULL, 123, 0, 'Obra de ejemploObra de ejemploObra de ejemplo', 'Obra de ejemplo', 'Obra de ejemplo', 12, 1, 22),
(14, 'Arte urbano', 'Obra de ejemplo', '123X123', NULL, 20000, 0, 'Obra de ejemploObra de ejemploObra de ejemplo', 'Obra de ejemplo', 'Obra de ejemplo', 11, 1, 23),
(15, 'Arte urbano', 'Obra de ejemplo', '123X123', NULL, 40000, 0, 'Obra de ejemploObra de ejemplo', 'Obra de ejemplo', 'Obra de ejemplo', 11, 1, 24),
(16, 'Arte urbano', 'Obra de ejemploObra de ejemplo', '123X123', NULL, 50000, 0, 'Obra de ejemploObra de ejemploObra de ejemplo', 'Obra de ejemplo', 'Obra de ejemploObra de ejemplo', 11, 1, 25),
(17, 'Arte urbano', 'Obra de ejemploObra de ejemplo', '123X123', NULL, 50000, 0, 'Obra de ejemploObra de ejemplo', 'Obra de ejemploObra de ejemplo', 'Obra de ejemplo', 11, 1, 26),
(18, 'Arte urbano', 'Obra de ejemploObra de ejemplo', '123X123', NULL, 11, 0, 'Obra de ejemploObra de ejemplo', 'Obra de ejemplo', 'Obra de ejemplo', 123, 1, 27),
(19, 'Arte urbano', 'Obra de ejemplo', '123X123', NULL, 123, 0, 'Obra de ejemploObra de ejemploObra de ejemplo', 'Obra de ejemploObra de ejemplo', 'Obra de ejemplo', 123, 1, 28),
(20, 'Arte urbano', 'Obra de ejemplo', '123X123', NULL, 123, 0, 'Obra de ejemploObra de ejemplo', 'Obra de ejemplo', 'Obra de ejemplo', 123, 1, 29),
(21, 'Arte optico', 'Obra de ejemplo', '123X123', NULL, 40000, 0, 'Obra de ejemploObra de ejemploObra de ejemplo', 'Obra de ejemplo', 'Obra de ejemplo', 11, 1, 30);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `obra_has_clicks`
--

CREATE TABLE `obra_has_clicks` (
  `Obra_idObra` int(11) NOT NULL,
  `clicks_idclicks` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `obra_has_clicks`
--

INSERT INTO `obra_has_clicks` (`Obra_idObra`, `clicks_idclicks`) VALUES
(3, 46),
(3, 47),
(3, 48),
(3, 49),
(3, 50),
(3, 51),
(3, 52),
(3, 53),
(3, 54),
(3, 55),
(3, 56),
(3, 57),
(3, 58),
(3, 59),
(3, 73),
(3, 74),
(3, 75),
(3, 77),
(3, 78),
(3, 79),
(3, 80),
(3, 81),
(3, 82),
(3, 83),
(3, 121),
(3, 157),
(3, 192),
(3, 193),
(3, 194),
(3, 195),
(3, 196),
(3, 197),
(3, 198),
(3, 199),
(3, 200),
(3, 201),
(3, 205),
(3, 244),
(3, 245),
(3, 246),
(3, 247),
(3, 248),
(3, 249),
(3, 250),
(3, 251),
(3, 252),
(3, 253),
(3, 254),
(3, 255),
(4, 61),
(4, 62),
(4, 64),
(4, 65),
(4, 210),
(4, 211),
(4, 237),
(4, 238),
(5, 111),
(5, 130),
(5, 131),
(5, 132),
(5, 133),
(5, 134),
(5, 135),
(5, 137),
(5, 138),
(5, 139),
(5, 140),
(5, 141),
(5, 142),
(5, 149),
(5, 150),
(5, 151),
(5, 152),
(5, 153),
(5, 154),
(5, 155),
(5, 156),
(5, 158),
(5, 159),
(5, 160),
(5, 161),
(5, 162),
(5, 163),
(5, 164),
(5, 165),
(5, 166),
(5, 167),
(5, 168),
(5, 169),
(5, 170),
(5, 171),
(5, 172),
(5, 173),
(5, 174),
(5, 175),
(5, 176),
(5, 177),
(5, 178),
(5, 179),
(5, 180),
(5, 181),
(5, 182),
(5, 183),
(5, 184),
(5, 185),
(5, 186),
(5, 187),
(5, 188),
(5, 189),
(5, 190),
(5, 191),
(5, 212),
(5, 213),
(5, 221),
(5, 222),
(5, 225),
(5, 226),
(5, 227),
(5, 228),
(5, 229),
(5, 230),
(5, 231),
(5, 232),
(5, 233),
(5, 235),
(5, 236),
(5, 241),
(5, 242),
(5, 243),
(6, 119),
(6, 120),
(6, 122),
(6, 123),
(6, 124),
(6, 125),
(6, 126),
(6, 127),
(6, 128),
(6, 129),
(6, 203),
(6, 204),
(6, 206),
(6, 207),
(6, 208),
(6, 209),
(6, 214),
(6, 215),
(6, 216),
(6, 217),
(6, 218),
(6, 219),
(6, 220),
(6, 223),
(6, 224),
(6, 234),
(6, 239),
(6, 240),
(7, 257),
(7, 258),
(7, 259),
(7, 260),
(7, 261),
(7, 262),
(7, 263);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `peticion`
--

CREATE TABLE `peticion` (
  `idpeticion` int(11) NOT NULL,
  `asunto` varchar(45) DEFAULT NULL,
  `descripcion` varchar(200) DEFAULT NULL,
  `estado` int(11) DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `precio` varchar(45) DEFAULT NULL,
  `Usuario_Registrado_idUsuario_Registrado` int(11) NOT NULL,
  `Artista_idArtista` int(11) NOT NULL,
  `Direccion_IdDireccion` int(11) NOT NULL,
  `estadoEnvio` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `peticion`
--

INSERT INTO `peticion` (`idpeticion`, `asunto`, `descripcion`, `estado`, `fecha`, `precio`, `Usuario_Registrado_idUsuario_Registrado`, `Artista_idArtista`, `Direccion_IdDireccion`, `estadoEnvio`) VALUES
(1, 'asda', 'asda', 3, '2022-11-25', '123', 2, 1, 3, 'nose'),
(3, 'Decoracion', 'asda', 2, '2022-11-26', '123123', 2, 1, 6, NULL),
(8, 'asda', 'asdasd', 3, '2022-11-27', '123', 2, 1, 21, '123');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `recibo`
--

CREATE TABLE `recibo` (
  `Numboleta` int(11) NOT NULL,
  `fechaEmision` date DEFAULT NULL,
  `detalles` varchar(45) DEFAULT NULL,
  `total` int(11) DEFAULT NULL,
  `correoUsuario` varchar(45) DEFAULT NULL,
  `Compra_idCompra` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `registropujadores`
--

CREATE TABLE `registropujadores` (
  `idregistroPujadores` int(11) NOT NULL,
  `valor` varchar(45) DEFAULT NULL,
  `Direccion_IdDireccion` int(11) NOT NULL,
  `Usuario_Registrado_idUsuario_Registrado` int(11) NOT NULL,
  `Subasta_idSubasta` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `registropujadores`
--

INSERT INTO `registropujadores` (`idregistroPujadores`, `valor`, `Direccion_IdDireccion`, `Usuario_Registrado_idUsuario_Registrado`, `Subasta_idSubasta`) VALUES
(17, '1470000', 30, 2, 3),
(18, '1440000', 31, 6, 3),
(19, '10123', 32, 2, 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reportes`
--

CREATE TABLE `reportes` (
  `idreportes` int(11) NOT NULL,
  `explicacion` varchar(200) DEFAULT NULL,
  `razon` varchar(45) DEFAULT NULL,
  `Usuario_Registrado_idUsuario_Registrado` int(11) NOT NULL,
  `Obra_idObra` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reportesuser`
--

CREATE TABLE `reportesuser` (
  `idReportesUser` int(11) NOT NULL,
  `explicacion` varchar(200) DEFAULT NULL,
  `razon` varchar(45) DEFAULT NULL,
  `Usuario_Registrado_idUsuario_Registrado` int(11) NOT NULL,
  `Critica_idCrititica` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `subasta`
--

CREATE TABLE `subasta` (
  `idSubasta` int(11) NOT NULL,
  `fechaTermino` datetime DEFAULT NULL,
  `precioPuja` int(11) DEFAULT NULL,
  `Artista_idArtista` int(11) NOT NULL,
  `Obra_idObra` int(11) NOT NULL,
  `estadoEnvio` varchar(50) DEFAULT NULL,
  `precioMinimo` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `subasta`
--

INSERT INTO `subasta` (`idSubasta`, `fechaTermino`, `precioPuja`, `Artista_idArtista`, `Obra_idObra`, `estadoEnvio`, `precioMinimo`) VALUES
(2, '2022-11-26 02:31:30', 1241231, 1, 4, NULL, 1231231),
(3, '2022-11-30 20:10:34', 1470000, 1, 5, NULL, 10000),
(4, '2022-11-30 21:15:17', 190123, 1, 6, NULL, 123),
(5, '2022-11-28 09:10:24', 10123, 1, 7, NULL, 123);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tarjetauser`
--

CREATE TABLE `tarjetauser` (
  `idTarjetaUser` int(11) NOT NULL,
  `numTarjeta` bigint(20) DEFAULT NULL,
  `mesCaducidad` int(11) DEFAULT NULL,
  `AñoCaducidad` int(11) DEFAULT NULL,
  `cvv` int(11) DEFAULT NULL,
  `Usuario_Registrado_idUsuario_Registrado` int(11) NOT NULL,
  `tipoTarjeta` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tarjetauser`
--

INSERT INTO `tarjetauser` (`idTarjetaUser`, `numTarjeta`, `mesCaducidad`, `AñoCaducidad`, `cvv`, `Usuario_Registrado_idUsuario_Registrado`, `tipoTarjeta`) VALUES
(14, 5646487987981321, 8, 24, 123, 2, 'Debito'),
(15, 1234113412341234, 10, 27, 815, 6, 'Credito');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario_registrado`
--

CREATE TABLE `usuario_registrado` (
  `idUsuario_Registrado` int(11) NOT NULL,
  `nombre` varchar(40) DEFAULT NULL,
  `apellido` varchar(40) DEFAULT NULL,
  `correo` varchar(45) DEFAULT NULL,
  `numeroTel` varchar(20) DEFAULT NULL,
  `contraseña` varchar(50) DEFAULT NULL,
  `fechaNac` date DEFAULT NULL,
  `permisos` int(11) DEFAULT NULL,
  `rut` varchar(20) DEFAULT NULL,
  `Imagen_idImagen` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `usuario_registrado`
--

INSERT INTO `usuario_registrado` (`idUsuario_Registrado`, `nombre`, `apellido`, `correo`, `numeroTel`, `contraseña`, `fechaNac`, `permisos`, `rut`, `Imagen_idImagen`) VALUES
(2, 'Nicolas felipe', 'Muñoz Herrrea', 'nicolasmunoz9866@gmail.com', '56958454441', 'hola1234', '2000-06-01', 2, '20391171-8', 2),
(4, 'Sebastian Andres', 'Muñoz', 'user@painArt.cl', '13455646548', 'hola12', '2000-06-01', 1, '20391172-6', 8),
(5, 'ADMINISTRADOR', 'ADM', 'admin@painArt.cl', '22132146987', 'admin12', '2000-06-01', 3, '20391171-8', 9),
(6, 'juan pablo', 'ruz', 'juanpabloruz25@gmail.com', '948449820', '12345', '2000-09-25', 1, '20590818-8', 13);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `artista`
--
ALTER TABLE `artista`
  ADD PRIMARY KEY (`idArtista`),
  ADD KEY `fk_Artista_Usuario_Registrado1_idx` (`Usuario_Registrado_idUsuario_Registrado`);

--
-- Indices de la tabla `artista_has_clicks`
--
ALTER TABLE `artista_has_clicks`
  ADD PRIMARY KEY (`Artista_idArtista`,`clicks_idclicks`),
  ADD KEY `fk_Artista_has_clicks_clicks1_idx` (`clicks_idclicks`),
  ADD KEY `fk_Artista_has_clicks_Artista1_idx` (`Artista_idArtista`);

--
-- Indices de la tabla `clicks`
--
ALTER TABLE `clicks`
  ADD PRIMARY KEY (`idclicks`);

--
-- Indices de la tabla `compra`
--
ALTER TABLE `compra`
  ADD PRIMARY KEY (`idCompra`),
  ADD KEY `fk_Compra_Usuario_Registrado1_idx` (`Usuario_Registrado_idUsuario_Registrado`),
  ADD KEY `fk_Compra_Artista1_idx` (`Artista_idArtista`),
  ADD KEY `fk_Compra_Direccion1_idx` (`Direccion_IdDireccion`),
  ADD KEY `fk_Compra_Obra1_idx` (`Obra_idObra`);

--
-- Indices de la tabla `contraseña`
--
ALTER TABLE `contraseña`
  ADD PRIMARY KEY (`idcontraseña`),
  ADD KEY `fk_contraseña_Usuario_Registrado1_idx` (`Usuario_Registrado_idUsuario_Registrado`);

--
-- Indices de la tabla `control_ip`
--
ALTER TABLE `control_ip`
  ADD PRIMARY KEY (`ip`),
  ADD UNIQUE KEY `ip_UNIQUE` (`ip`);

--
-- Indices de la tabla `critica`
--
ALTER TABLE `critica`
  ADD PRIMARY KEY (`idCrititica`),
  ADD KEY `fk_Critica_Obra1_idx` (`Obra_idObra`),
  ADD KEY `fk_Critica_Usuario_Registrado1_idx` (`Usuario_Registrado_idUsuario_Registrado`);

--
-- Indices de la tabla `direccion`
--
ALTER TABLE `direccion`
  ADD PRIMARY KEY (`IdDireccion`);

--
-- Indices de la tabla `imagen`
--
ALTER TABLE `imagen`
  ADD PRIMARY KEY (`idImagen`);

--
-- Indices de la tabla `notainformativa`
--
ALTER TABLE `notainformativa`
  ADD PRIMARY KEY (`idnotaInformativa`),
  ADD KEY `fk_notaInformativa_Usuario_Registrado1_idx` (`Usuario_Registrado_idUsuario_Registrado`),
  ADD KEY `fk_notaInformativa_Imagen1_idx` (`Imagen_idImagen`);

--
-- Indices de la tabla `obra`
--
ALTER TABLE `obra`
  ADD PRIMARY KEY (`idObra`),
  ADD KEY `fk_Obra_Artista1_idx` (`Artista_idArtista`),
  ADD KEY `fk_Obra_Imagen1_idx` (`Imagen_idImagen`);

--
-- Indices de la tabla `obra_has_clicks`
--
ALTER TABLE `obra_has_clicks`
  ADD PRIMARY KEY (`Obra_idObra`,`clicks_idclicks`),
  ADD KEY `fk_Obra_has_clicks_clicks1_idx` (`clicks_idclicks`),
  ADD KEY `fk_Obra_has_clicks_Obra1_idx` (`Obra_idObra`);

--
-- Indices de la tabla `peticion`
--
ALTER TABLE `peticion`
  ADD PRIMARY KEY (`idpeticion`),
  ADD KEY `fk_peticion_Usuario_Registrado1_idx` (`Usuario_Registrado_idUsuario_Registrado`),
  ADD KEY `fk_peticion_Artista1_idx` (`Artista_idArtista`),
  ADD KEY `fk_peticion_Direccion1_idx` (`Direccion_IdDireccion`);

--
-- Indices de la tabla `recibo`
--
ALTER TABLE `recibo`
  ADD PRIMARY KEY (`Numboleta`),
  ADD KEY `fk_recibo_Compra1_idx` (`Compra_idCompra`);

--
-- Indices de la tabla `registropujadores`
--
ALTER TABLE `registropujadores`
  ADD PRIMARY KEY (`idregistroPujadores`),
  ADD KEY `fk_registroPujadores_Direccion1_idx` (`Direccion_IdDireccion`),
  ADD KEY `fk_registroPujadores_Usuario_Registrado1_idx` (`Usuario_Registrado_idUsuario_Registrado`),
  ADD KEY `fk_registroPujadores_Subasta1_idx` (`Subasta_idSubasta`);

--
-- Indices de la tabla `reportes`
--
ALTER TABLE `reportes`
  ADD PRIMARY KEY (`idreportes`),
  ADD KEY `fk_reportes_Usuario_Registrado1_idx` (`Usuario_Registrado_idUsuario_Registrado`),
  ADD KEY `fk_reportes_Obra1_idx` (`Obra_idObra`);

--
-- Indices de la tabla `reportesuser`
--
ALTER TABLE `reportesuser`
  ADD PRIMARY KEY (`idReportesUser`),
  ADD KEY `fk_reportesuser_Usuario_Registrado1_idx` (`Usuario_Registrado_idUsuario_Registrado`),
  ADD KEY `fk_reportesuser_Critica1_idx` (`Critica_idCrititica`);

--
-- Indices de la tabla `subasta`
--
ALTER TABLE `subasta`
  ADD PRIMARY KEY (`idSubasta`),
  ADD KEY `fk_Subasta_Artista1_idx` (`Artista_idArtista`),
  ADD KEY `fk_Subasta_Obra1_idx` (`Obra_idObra`);

--
-- Indices de la tabla `tarjetauser`
--
ALTER TABLE `tarjetauser`
  ADD PRIMARY KEY (`idTarjetaUser`),
  ADD KEY `fk_TarjetaUser_Usuario_Registrado1_idx` (`Usuario_Registrado_idUsuario_Registrado`);

--
-- Indices de la tabla `usuario_registrado`
--
ALTER TABLE `usuario_registrado`
  ADD PRIMARY KEY (`idUsuario_Registrado`),
  ADD KEY `fk_Usuario_Registrado_Imagen1_idx` (`Imagen_idImagen`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `artista`
--
ALTER TABLE `artista`
  MODIFY `idArtista` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `clicks`
--
ALTER TABLE `clicks`
  MODIFY `idclicks` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=265;

--
-- AUTO_INCREMENT de la tabla `compra`
--
ALTER TABLE `compra`
  MODIFY `idCompra` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `contraseña`
--
ALTER TABLE `contraseña`
  MODIFY `idcontraseña` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `critica`
--
ALTER TABLE `critica`
  MODIFY `idCrititica` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `direccion`
--
ALTER TABLE `direccion`
  MODIFY `IdDireccion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT de la tabla `imagen`
--
ALTER TABLE `imagen`
  MODIFY `idImagen` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT de la tabla `notainformativa`
--
ALTER TABLE `notainformativa`
  MODIFY `idnotaInformativa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `obra`
--
ALTER TABLE `obra`
  MODIFY `idObra` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de la tabla `peticion`
--
ALTER TABLE `peticion`
  MODIFY `idpeticion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `recibo`
--
ALTER TABLE `recibo`
  MODIFY `Numboleta` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `registropujadores`
--
ALTER TABLE `registropujadores`
  MODIFY `idregistroPujadores` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de la tabla `reportes`
--
ALTER TABLE `reportes`
  MODIFY `idreportes` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `reportesuser`
--
ALTER TABLE `reportesuser`
  MODIFY `idReportesUser` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `subasta`
--
ALTER TABLE `subasta`
  MODIFY `idSubasta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `tarjetauser`
--
ALTER TABLE `tarjetauser`
  MODIFY `idTarjetaUser` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `usuario_registrado`
--
ALTER TABLE `usuario_registrado`
  MODIFY `idUsuario_Registrado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `artista`
--
ALTER TABLE `artista`
  ADD CONSTRAINT `fk_Artista_Usuario_Registrado1` FOREIGN KEY (`Usuario_Registrado_idUsuario_Registrado`) REFERENCES `usuario_registrado` (`idUsuario_Registrado`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `artista_has_clicks`
--
ALTER TABLE `artista_has_clicks`
  ADD CONSTRAINT `fk_Artista_has_clicks_Artista1` FOREIGN KEY (`Artista_idArtista`) REFERENCES `artista` (`idArtista`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Artista_has_clicks_clicks1` FOREIGN KEY (`clicks_idclicks`) REFERENCES `clicks` (`idclicks`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `compra`
--
ALTER TABLE `compra`
  ADD CONSTRAINT `fk_Compra_Artista1` FOREIGN KEY (`Artista_idArtista`) REFERENCES `artista` (`idArtista`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Compra_Direccion1` FOREIGN KEY (`Direccion_IdDireccion`) REFERENCES `direccion` (`IdDireccion`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Compra_Obra1` FOREIGN KEY (`Obra_idObra`) REFERENCES `obra` (`idObra`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Compra_Usuario_Registrado1` FOREIGN KEY (`Usuario_Registrado_idUsuario_Registrado`) REFERENCES `usuario_registrado` (`idUsuario_Registrado`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `contraseña`
--
ALTER TABLE `contraseña`
  ADD CONSTRAINT `fk_contraseña_Usuario_Registrado1` FOREIGN KEY (`Usuario_Registrado_idUsuario_Registrado`) REFERENCES `usuario_registrado` (`idUsuario_Registrado`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `critica`
--
ALTER TABLE `critica`
  ADD CONSTRAINT `fk_Critica_Obra1` FOREIGN KEY (`Obra_idObra`) REFERENCES `obra` (`idObra`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Critica_Usuario_Registrado1` FOREIGN KEY (`Usuario_Registrado_idUsuario_Registrado`) REFERENCES `usuario_registrado` (`idUsuario_Registrado`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `notainformativa`
--
ALTER TABLE `notainformativa`
  ADD CONSTRAINT `fk_notaInformativa_Imagen1` FOREIGN KEY (`Imagen_idImagen`) REFERENCES `imagen` (`idImagen`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_notaInformativa_Usuario_Registrado1` FOREIGN KEY (`Usuario_Registrado_idUsuario_Registrado`) REFERENCES `usuario_registrado` (`idUsuario_Registrado`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `obra`
--
ALTER TABLE `obra`
  ADD CONSTRAINT `fk_Obra_Artista1` FOREIGN KEY (`Artista_idArtista`) REFERENCES `artista` (`idArtista`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Obra_Imagen1` FOREIGN KEY (`Imagen_idImagen`) REFERENCES `imagen` (`idImagen`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `obra_has_clicks`
--
ALTER TABLE `obra_has_clicks`
  ADD CONSTRAINT `fk_Obra_has_clicks_Obra1` FOREIGN KEY (`Obra_idObra`) REFERENCES `obra` (`idObra`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Obra_has_clicks_clicks1` FOREIGN KEY (`clicks_idclicks`) REFERENCES `clicks` (`idclicks`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `peticion`
--
ALTER TABLE `peticion`
  ADD CONSTRAINT `fk_peticion_Artista1` FOREIGN KEY (`Artista_idArtista`) REFERENCES `artista` (`idArtista`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_peticion_Direccion1` FOREIGN KEY (`Direccion_IdDireccion`) REFERENCES `direccion` (`IdDireccion`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_peticion_Usuario_Registrado1` FOREIGN KEY (`Usuario_Registrado_idUsuario_Registrado`) REFERENCES `usuario_registrado` (`idUsuario_Registrado`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `recibo`
--
ALTER TABLE `recibo`
  ADD CONSTRAINT `fk_recibo_Compra1` FOREIGN KEY (`Compra_idCompra`) REFERENCES `compra` (`idCompra`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `registropujadores`
--
ALTER TABLE `registropujadores`
  ADD CONSTRAINT `fk_registroPujadores_Direccion1` FOREIGN KEY (`Direccion_IdDireccion`) REFERENCES `direccion` (`IdDireccion`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_registroPujadores_Subasta1` FOREIGN KEY (`Subasta_idSubasta`) REFERENCES `subasta` (`idSubasta`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_registroPujadores_Usuario_Registrado1` FOREIGN KEY (`Usuario_Registrado_idUsuario_Registrado`) REFERENCES `usuario_registrado` (`idUsuario_Registrado`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `reportes`
--
ALTER TABLE `reportes`
  ADD CONSTRAINT `fk_reportes_Obra1` FOREIGN KEY (`Obra_idObra`) REFERENCES `obra` (`idObra`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_reportes_Usuario_Registrado1` FOREIGN KEY (`Usuario_Registrado_idUsuario_Registrado`) REFERENCES `usuario_registrado` (`idUsuario_Registrado`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `reportesuser`
--
ALTER TABLE `reportesuser`
  ADD CONSTRAINT `fk_reportesuser_Critica1` FOREIGN KEY (`Critica_idCrititica`) REFERENCES `critica` (`idCrititica`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_reportesuser_Usuario_Registrado1` FOREIGN KEY (`Usuario_Registrado_idUsuario_Registrado`) REFERENCES `usuario_registrado` (`idUsuario_Registrado`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `subasta`
--
ALTER TABLE `subasta`
  ADD CONSTRAINT `fk_Subasta_Artista1` FOREIGN KEY (`Artista_idArtista`) REFERENCES `artista` (`idArtista`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Subasta_Obra1` FOREIGN KEY (`Obra_idObra`) REFERENCES `obra` (`idObra`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tarjetauser`
--
ALTER TABLE `tarjetauser`
  ADD CONSTRAINT `fk_TarjetaUser_Usuario_Registrado1` FOREIGN KEY (`Usuario_Registrado_idUsuario_Registrado`) REFERENCES `usuario_registrado` (`idUsuario_Registrado`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `usuario_registrado`
--
ALTER TABLE `usuario_registrado`
  ADD CONSTRAINT `fk_Usuario_Registrado_Imagen1` FOREIGN KEY (`Imagen_idImagen`) REFERENCES `imagen` (`idImagen`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
