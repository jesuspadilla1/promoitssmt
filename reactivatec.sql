-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 16-07-2020 a las 22:01:15
-- Versión del servidor: 10.1.25-MariaDB
-- Versión de PHP: 5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `promo_itssmt`
--

DELIMITER $$
--
-- Procedimientos
--
CREATE DEFINER=`reactivatec`@`localhost` PROCEDURE `insertIdinfonegocio` ()  BEGIN
DECLARE id_P INT;
SET id_P = (SELECT idinfo_negocio FROM info_negocio ORDER BY idinfo_negocio DESC LIMIT 1);
INSERT INTO direccion(idinfo_negocio) VALUES(id_P);
INSERT INTO redes_sociales(idinfo_negocio) VALUES(id_P);
INSERT INTO dias_horario(idinfo_negocio) VALUES(id_P);
END$$

CREATE DEFINER=`reactivatec`@`localhost` PROCEDURE `insertIdpersonal` ()  BEGIN
DECLARE id_P INT;
SET id_P = (SELECT idpersonal FROM datos_personales ORDER BY idpersonal DESC LIMIT 1);
INSERT INTO info_negocio(idpersonal) VALUES(id_P);
END$$

CREATE DEFINER=`reactivatec`@`localhost` PROCEDURE `insertIdusuario` ()  BEGIN
DECLARE id_U INT;
SET id_U = (SELECT idusuario FROM usuarios ORDER BY idusuario DESC LIMIT 1);
INSERT INTO datos_personales(idusuario) VALUES(id_U);
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `datos_personales`
--

CREATE TABLE `datos_personales` (
  `idpersonal` int(11) NOT NULL,
  `idusuario` int(11) DEFAULT NULL,
  `nombres` varchar(20) COLLATE utf8_spanish_ci DEFAULT NULL,
  `a_paterno` varchar(20) COLLATE utf8_spanish_ci DEFAULT NULL,
  `a_materno` varchar(20) COLLATE utf8_spanish_ci DEFAULT NULL,
  `rfc_usuario` varchar(13) COLLATE utf8_spanish_ci DEFAULT NULL,
  `n_telefono` varchar(15) COLLATE utf8_spanish_ci DEFAULT NULL,
  `correo_usu` varchar(30) COLLATE utf8_spanish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Disparadores `datos_personales`
--
DELIMITER $$
CREATE TRIGGER `insertIdpersonalTrigger` AFTER INSERT ON `datos_personales` FOR EACH ROW CALL insertIdpersonal()
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dias_horario`
--

CREATE TABLE `dias_horario` (
  `iddias_horario` int(11) NOT NULL,
  `idinfo_negocio` int(11) DEFAULT NULL,
  `he_lun` varchar(15) COLLATE utf8_spanish_ci DEFAULT NULL,
  `hc_lun` varchar(15) COLLATE utf8_spanish_ci DEFAULT NULL,
  `hs_lun` varchar(15) COLLATE utf8_spanish_ci DEFAULT NULL,
  `he_mar` varchar(15) COLLATE utf8_spanish_ci DEFAULT NULL,
  `hc_mar` varchar(15) COLLATE utf8_spanish_ci DEFAULT NULL,
  `hs_mar` varchar(15) COLLATE utf8_spanish_ci DEFAULT NULL,
  `he_mie` varchar(15) COLLATE utf8_spanish_ci DEFAULT NULL,
  `hc_mie` varchar(15) COLLATE utf8_spanish_ci DEFAULT NULL,
  `hs_mie` varchar(15) COLLATE utf8_spanish_ci DEFAULT NULL,
  `he_jue` varchar(15) COLLATE utf8_spanish_ci DEFAULT NULL,
  `hc_jue` varchar(15) COLLATE utf8_spanish_ci DEFAULT NULL,
  `hs_jue` varchar(15) COLLATE utf8_spanish_ci DEFAULT NULL,
  `he_vie` varchar(15) COLLATE utf8_spanish_ci DEFAULT NULL,
  `hc_vie` varchar(15) COLLATE utf8_spanish_ci DEFAULT NULL,
  `hs_vie` varchar(15) COLLATE utf8_spanish_ci DEFAULT NULL,
  `he_sab` varchar(15) COLLATE utf8_spanish_ci DEFAULT NULL,
  `hc_sab` varchar(15) COLLATE utf8_spanish_ci DEFAULT NULL,
  `hs_sab` varchar(15) COLLATE utf8_spanish_ci DEFAULT NULL,
  `he_dom` varchar(15) COLLATE utf8_spanish_ci DEFAULT NULL,
  `hc_dom` varchar(15) COLLATE utf8_spanish_ci DEFAULT NULL,
  `hs_dom` varchar(15) COLLATE utf8_spanish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `direccion`
--

CREATE TABLE `direccion` (
  `iddireccion` int(11) NOT NULL,
  `idinfo_negocio` int(11) DEFAULT NULL,
  `idlocalidad` int(11) DEFAULT NULL,
  `calle` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `numero` varchar(10) COLLATE utf8_spanish_ci DEFAULT NULL,
  `estado` varchar(25) COLLATE utf8_spanish_ci DEFAULT NULL,
  `municipio` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `giro`
--

CREATE TABLE `giro` (
  `idgiro` int(11) NOT NULL,
  `n_giro` varchar(200) COLLATE utf8_spanish_ci DEFAULT NULL,
  `d_giro` varchar(250) COLLATE utf8_spanish_ci DEFAULT NULL,
  `c_giro` varchar(9) COLLATE utf8_spanish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `giro`
--

INSERT INTO `giro` (`idgiro`, `n_giro`, `d_giro`, `c_giro`) VALUES
(1, 'Abarrotes en general sin venta de bebidad alcohólicas', 'Comercio al por menor en tiendas de abarrotes, ultramarinos y miscelaneas', 'Productos'),
(2, 'Acabado de productos textiles', 'Preparación e hilado de fibras duras naturales', 'Servicios'),
(3, 'Acabados y decoraciones', 'Comercio al por menor de otros artículos para la decoración de interiores', 'Productos'),
(4, 'Accesorios para computadoras', 'Comercio al por menor de mobiliario, equipo y accesorios de computo', 'Productos'),
(5, 'Aceites y lubricantes', 'Comercio al por menor de aceites y grasas lubricantes, aditivos y similares para vehículos de motor', 'Productos'),
(6, 'Aceros comerciales y sus anexos', 'Comercio al por mayor de materiales metálicos para la construcción y la manufactura', 'Productos'),
(7, 'Adornos para cabello', 'Comercio al por menor de bisutería y accesorios de vestir', 'Productos'),
(8, 'Agencia de viajes', 'Agencia de viajes', 'Servicios'),
(9, 'Agencias de publicidad', 'Servicios de administración de negocios ', 'Servicios'),
(10, 'Alineación y balanceo de automóviles y camiones', 'Alineación y balanceo de automóviles y camiones', 'Servicios'),
(11, 'Almacén de productos y transformación de acero', 'Otros servicios de almacenamiento con instalaciones especializadas ', 'Servicios'),
(12, 'Alquiler de equipo de cómputo', 'Alquiler de equipo de cómputo y de otras máquinas y mobiliario de oficina', 'Servicios'),
(13, 'Alquiler de equipo de cómputo y de otras máquinas y mobiliario de oficina', 'Alquiler de equipo de cómputo y de otras máquinas y mobiliario de oficina', 'Servicios'),
(14, 'Alquiler de instrumentos musicales', 'Alquiler de instrumentos musicales', 'Servicios'),
(15, 'Alquiler de mesas, sillas, vajillas y similares', 'Alquiler de mesas, sillas, vajillas y similares', 'Servicios'),
(16, 'Alquiler de otros artículos para el hogar y personales', 'Alquiler de otros artículos para el hogar y personales', 'Servicios'),
(17, 'Alquiler de prendas de vestir', 'Alquiler de prendas de vestir', 'Servicios'),
(18, 'Alquiler de videocasetes y discos', 'Alquiler de otros artículos para el hogar y personales', 'Servicios'),
(19, 'Alquiler sin intermediación de otros bienes raíces', 'Otros servicios relacionados con los servicios inmobiliarios', 'Servicios'),
(20, 'Alquiler sin intermediación de salones para fiestas y convenciones', 'Alquiler sin intermediación de salones para fiestas y convenciones', 'Servicios'),
(21, 'Alquiler y banquetes', 'Alquiler sin intermediación de salones para fiestas y convenciones', 'Servicios'),
(22, 'Antojitos mexicanos sin venta de bebidas alcolicas', 'Restaurantes con servicios de preparación de antojitos', 'Servicios'),
(23, 'Artículos deportivos escolares juguetería y regalos', 'Comercio al por menor en tiendas departamentales', 'Productos'),
(24, 'Artículos de belleza', 'Comercio al por menor de artículos de perfumería y cosméticos', 'Productos'),
(25, 'Artículos de piel y novedades', 'Fabricación de otros productos de cuero, piel y materiales sucedáneos', 'Productos'),
(26, 'Artículos deportivos', 'Comercio al por menor en tiendas departamentales', 'Productos'),
(27, 'Artículos deportivos y zapatería', 'Comercio al por menor en tiendas departamentales', 'Productos'),
(28, 'Artículos deportivos, higiénicos y pañales', 'Comercio al por menor en tiendas departamentales', 'Productos'),
(29, 'Artículos para decorar interiores', 'Comercio al por menor de otros artículos para la decoración de interiores', 'Productos'),
(30, 'Artículos para manualidades', 'Fabricación de otros productos de cartón y papel', 'Productos'),
(31, 'Artículos religiosos, libros y biblias', 'Comercio al por mayor de libros', 'Productos'),
(32, 'Autolavado', 'Lavado y lubricado de automóviles y camiones', 'Servicios'),
(33, 'Barbería y peluquería', 'Salones y clínicas de belleza y peluquerías', 'Servicios'),
(34, 'Bazar en general', 'Comercio al por menor de artículos usados', 'Productos'),
(35, 'Bicicletas, refacciones y accesorios', 'Comercio al por menor de bicicletas', 'Productos'),
(36, 'Bisutería y artículos de temporada', 'Comercio al por menor de bisutería y accesorios de vestir', 'Productos'),
(37, 'Bonetería', 'Comercio al por menor de artículos de mercería y bonetería', 'Productos'),
(38, 'Boutique', 'Comercio al por mayor de ropa, bisutería y accesorios de vestir', 'Productos'),
(39, 'Cafetería sin venta de bebidas alcohólicas', 'Cafeterías, fuentes de sodas, neverías, refresquerías y similares', 'Servicios'),
(40, 'Cafetería y pizzería sin venta de bebidas alcohólicas', 'Restaurantes con servicio de preparación de pizzas, hamburguesas, hot dogs y pollos rostizados para llevar', 'Servicios'),
(41, 'Carnicería', 'Comercio al por menor de carnes rojas', 'Productos'),
(42, 'Carnicería y abarrotes sin venta de bebidas alcohólicas ', 'Comercio al por menor de carnes rojas', 'Productos'),
(43, 'Carpintería', 'Fabricación de artículos y utensilios de madera para el hogar', 'Productos'),
(44, 'Centro botánico naturista, cerería y artículos para la suerte', 'Comercio al por menor de productos naturistas, medicamentos homeopáticos y de complementos alimenticios', 'Productos'),
(45, 'Centro de acondicionamiento físico del sector privado', 'Centros de acondicionamiento físico del sector privado', 'Servicios'),
(46, 'Centro de atención a clientes, venta de telefonía celular y accesorios en general', 'Comercio al por menor de teléfonos y otros aparatos de comunicación', 'Productos'),
(47, 'Centro de copiado', 'Servicios de fotocopiado, fax y afines', 'Servicios'),
(48, 'Chamarras, artículos de piel y ropa casual', 'Comercio al por menor de ropa de cuero y piel y de otros artículos de estos materiales', 'Productos'),
(49, 'Cirujano dentista *', 'Consultorios dentales del sector privado', 'Servicios'),
(50, 'Clases de belleza, corte y confección', 'Escuelas del sector privado dedicadas a la enseñanza de oficios', 'Servicos'),
(51, 'Clínica de rehabilitación física', 'Consultorios del sector privado de audiología y de terapia ocupacional, física y del lenguaje', 'Servicios'),
(52, 'Clínica médico quirúrgica y farmacia*', 'Clínicas de consultorios médicos del sector privado', 'Servicios'),
(53, 'Cocina económica sin venta de bebidas alcohólicas', 'Restaurantes con servicio de preparación de alimentos a la carta o de comida corrida', 'Servicios'),
(54, 'Comercialización de refacciones industriales', 'Comercio al por mayor de maquinaria y equipo para la industria manufacturera', 'Productos'),
(55, 'Comercializadora de lácteos y embutidos', 'Comercio al por menor de leche, otros productos lácteos y embutidos', 'Productos'),
(56, 'Comercio al por menor de artículos de mochilas de temporada', 'Fabricación de bolsos de mano, maletas y similares', 'Productos'),
(57, 'Comercio al por menor de artículos de papelería', 'Comercio al por menor de artículos de papelería', 'Productos'),
(58, 'Comercio al por menor de artículos deportivos', 'Comercio al por menor de artículos y aparatos deportivos', 'Productos'),
(59, 'Comercio al por menor de bicicletas,refacciones y accesorios', 'Comercio al por menor de bicicletas', 'Productos'),
(60, 'Comercio al por menor de calzado y artículos', 'Comercio al por menor de calzado', 'Productos'),
(61, 'Comercio al por menor de carnes rojas', 'Comercio al por menor de carnes rojas', 'Productos'),
(62, 'Comercio al por menor de cigarros, puros y tabaco', 'Comercio al por menor en tiendas de abarrotes, ultramarinos y misceláneas', 'Productos'),
(63, 'Comercio al por menor de colchas y blancos ', 'Comercio al por menor de blancos ', 'Productos'),
(64, 'Comercio al por menor de computadoras y accesorios', 'Comercio al por menor de mobiliario, equipo y accesorios de cómputo', 'Productos'),
(65, 'Comercio al por menor de cristalería', 'Comercio al por menor de cristalería, loza y utensilios de cocina', 'Productos'),
(66, 'Comercio al por menor de dulces típicos ', 'Comercio al por menor de dulces y materias primas para repostería', 'Productos'),
(67, 'Comercio al por menor de dulces y materias primas para repostería', 'Comercio al por menor de dulces y materias primas para repostería', 'Productos'),
(68, 'Comercio al por menor de dulces, chocolates y confituras', 'Comercio al por menor de dulces y materias primas para repostería', 'Productos'),
(69, 'Comercio al por menor de dulces, chocolates y confitados', 'Comercio al por menor de dulces y materias primas para repostería', 'Productos'),
(70, 'Comercio al por menor de ferretería y tlapalería', 'Comercio al por menor en ferreterías y tlapalerías', 'Productos'),
(71, 'Comercio al por menor de ferretería, tlapalería, material eléctrico y tornillería', 'Comercio al por menor en ferreterías y tlapalerías', 'Productos'),
(72, 'Comercio al por menor de foamy', 'Comercio al por menor de artículos de papelería', 'Productos'),
(73, 'Comercio al por menor de frutas, verduras y legumbres frescas', 'Comercio al por menor de frutas y verduras frescas', 'Productos'),
(74, 'Comercio al por menor de frutas, verduras frescas y pollería', 'Comercio al por menor de frutas y verduras frescas', 'Productos'),
(75, 'Comercio al por menor de joyería, relojes y similares', 'Comercio al por menor de artículos de joyería y relojes', 'Productos'),
(76, 'Comercio al por menor de juguetes', 'Comercio al por menor de juguetes', 'Productos'),
(77, 'Comercio al por menor de juguetes, bicicletas, triciclos, partes para bicicletas y triciclos', 'Comercio al por menor de juguetes', 'Productos'),
(78, 'Comercio al por menor de lámparas ornamentales y cándiles', 'Comercio al por menor de muebles para el hogar', 'Productos'),
(79, 'Comercio al por menor de libros', 'Comercio al por menor de libros', 'Productos'),
(80, 'Comercio al por menor de llantas y cámaras para automóviles, camionetas y camiones', 'Comercio al por menor de llantas y cámaras para automóviles, camionetas y camiones', 'Productos'),
(81, 'Comercio al por menor de material eléctrico, ferretería y papelería', 'Comercio al por menor en ferreterías y tlapalerías', 'Productos'),
(82, 'Comercio al por menor de materiales para construcción excepto madera', 'Comercio al por menor de materiales para la construcción en tiendas de autoservicio especializadas', 'Productos'),
(83, 'Comercio al por menor de materias primas', 'Comercio al por menor de dulces y materias primas para repostería', 'Productos'),
(84, 'Comercio al por menor de medicamentos veterinarios y alimentos para animales', 'Servicios veterinarios para mascotas prestados por el sector privado', 'Servicios'),
(85, 'Comercio al por menor de mochilas, bolsas y regalos', 'Fabricación de bolsos de mano, maletas y similares', 'Productos'),
(86, 'Comercio al por menor de motocicletas, bicimotos, motonetas y motocicletas acuáticas y refacciones', 'Comercio al por menor de motocicletas', 'Productos'),
(87, 'Comercio al por menor de muebles', 'Comercio al por menor de muebles para el hogar', 'Productos'),
(88, 'Comercio al por menor de muebles en abonos', 'Comercio al por menor de muebles para el hogar', 'Productos'),
(89, 'Comercio al por menor de otros alimentos preparados para su consumo (rosticería)', 'Restaurantes que preparan otro tipo de alimentos para llevar', 'Productos'),
(90, 'Comercio al por menor de otros alimentos preparados para su consumo sin venta de bebidas alcohólicas', 'Elaboración de alimentos frescos para consumo inmediato', 'Productos'),
(91, 'Comercio al por menor de otros insumos textiles', 'Acabado de productos textiles', 'Productos'),
(92, 'Comercio al por menor de otros insumos y materiales para la construcción', 'Comercio al por menor de materiales para la construcción en tiendas de autoservicio especializadas', 'Productos'),
(93, 'Comercio al por menor de partes y refacciones nuevas para automóviles camionetas y camiones', 'Comercio al por menor de partes y refacciones nuevas para automóviles, camionetas y camiones', 'Productos'),
(94, 'Comercio al por menor de periódicos, revistas y posters', 'Comercio al por menor de revistas y periódicos', 'Productos'),
(95, 'Comercio al por menor de pinturas, lacas, barnices y similares', 'Comercio al por menor de pintura', 'Productos'),
(96, 'Comercio al por menor de prendas de vestir', 'Comercio al por menor de ropa, excepto de bebé y lencería', 'Productos'),
(97, 'Comercio al por menor de productos farmacéuticos', 'Comercio al por mayor de productos farmacéuticos', 'Productos'),
(98, 'Comercio al por menor de productos naturistas y complementos alimenticios', 'Comercio al por menor de productos naturistas, medicamentos homeopáticos y de complementos alimenticios', 'Productos'),
(99, 'Comercio al por menor de regalos y novedades', 'Comercio al por menor de regalos', 'Productos'),
(100, 'Comercio al por menor de relojes, joyería fina y artículos decorativos de materiales preciosos', 'Comercio al por menor de artículos de joyería y relojes', 'Productos'),
(101, 'Comercio al por menor de ropa para dama y niños', 'Comercio al por menor de ropa, bisutería y accesorios de vestir', 'Productos'),
(102, 'Comercio al por menor de ropa y accesorios para fiestas', 'Comercio al por menor de ropa, bisutería y accesorios de vestir', 'Productos'),
(103, 'Comercio al por menor de semillas y granos alimenticios, especies y chiles secos', 'Comercio al por mayor de semillas y granos alimenticios, especias y chiles secos', 'Productos'),
(104, 'Comercio al por menor de suplementos alimenticios', 'Comercio al por menor de productos naturistas, medicamentos homeopáticos y de complementos alimenticios', 'Productos');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `info_negocio`
--

CREATE TABLE `info_negocio` (
  `idinfo_negocio` int(11) NOT NULL,
  `idpersonal` int(11) DEFAULT NULL,
  `idgiro` int(11) DEFAULT NULL,
  `n_negocio` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `ref_negocio` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `rfc_negocio` varchar(13) COLLATE utf8_spanish_ci DEFAULT NULL,
  `url_imagen1` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `url_imagen2` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `tipo_negocio` varchar(15) COLLATE utf8_spanish_ci DEFAULT NULL,
  `tipo_servicio` varchar(25) COLLATE utf8_spanish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Disparadores `info_negocio`
--
DELIMITER $$
CREATE TRIGGER `insertIdinfonegocioTrigger` AFTER INSERT ON `info_negocio` FOR EACH ROW CALL insertIdinfonegocio()
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `localidad`
--

CREATE TABLE `localidad` (
  `idlocalidad` int(11) NOT NULL,
  `codigo_p` varchar(5) COLLATE utf8_spanish_ci DEFAULT NULL,
  `n_localidad` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `localidad`
--

INSERT INTO `localidad` (`idlocalidad`, `codigo_p`, `n_localidad`) VALUES
(1, '74053', '6 de Enero'),
(2, '74060', 'Álvaro Obregón'),
(3, '74080', 'Ampliación Los Dicios'),
(4, '74041', 'Baja California'),
(5, '74126', 'Benito Juárez'),
(6, '74013', 'Buenavista'),
(7, '74068', 'Buenos Aires'),
(8, '74129', 'Calyeca'),
(9, '74090', 'Carrillo Puerto'),
(10, '74000', 'Centro'),
(11, '74050', 'Domingo Arenas'),
(12, '74031', 'El Arenal'),
(13, '74120', 'El Barrio (Tepatlaxco)'),
(14, '74089', 'El Calvario'),
(15, '74058', 'El Cerrito'),
(16, '74088', 'El Chamizal'),
(17, '74120', 'El Llano (Tepatlaxco)'),
(18, '74064', 'El Moral'),
(19, '74125', 'El Moral (Pueblo)'),
(20, '74068', 'El Río (Heyatzacoalco)'),
(21, '74053', 'Expropiación Petrolera 18 de Marzo'),
(22, '74126', 'Guadalupe'),
(23, '74126', 'Guadalupe Victoria'),
(24, '74013', 'Independecia'),
(25, '74079', 'La Cienega'),
(26, '74120', 'La Colonia Tepatlaxco'),
(27, '74126', 'La Cruz'),
(28, '74129', 'La Deportiva'),
(29, '74068', 'La Huerta'),
(30, '74050', 'La Joya'),
(31, '74099', 'La Joya'),
(32, '74120', 'La Loma (Tepatlaxco)'),
(33, '74030', 'La Purisima'),
(34, '74021', 'La Santisima'),
(35, '74120', 'Las Rosas (Tepatlaxco)'),
(36, '74070', 'Lindavista'),
(37, '74068', 'Llano (Hueyatzacoalco)'),
(38, '74074', 'Llano Grande'),
(39, '74053', 'Lomas de Atoyatenco'),
(40, '74040', 'Lomas de San Antonio'),
(41, '74080', 'Los Angeles'),
(42, '74080', 'Los Dicios'),
(43, '74013', 'Los Volcanes'),
(44, '74120', 'Manantiales (Tepatlaxco)'),
(45, '74020', 'Morelos'),
(46, '74042', 'Ojo de Agua'),
(47, '74053', 'Planetario'),
(48, '74079', 'Plaza Acuario'),
(49, '74088', 'Polaxtla'),
(50, '74078', 'San Antonio'),
(51, '74059', 'San Damian'),
(52, '74030', 'San Isidro'),
(53, '74089', 'San José'),
(54, '74078', 'San Miguel'),
(55, '74040', 'San Miguel Lardizabal'),
(56, '74129', 'Santa Anita'),
(57, '74050', 'Solidaridad'),
(58, '74120', 'Tamazolapa (Tepatlaxco)'),
(59, '74079', 'Tetitla'),
(60, '74129', 'Tlacomulco'),
(61, '74030', 'Valle Norte de San Martín'),
(62, '74069', 'Valle San Martín'),
(63, '74010', 'Villa del Carmen'),
(64, '74068', 'Vista Hermosa'),
(65, '74126', 'Yeloxotchitla');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `negocio_pago`
--

CREATE TABLE `negocio_pago` (
  `idnegocio_pago` int(11) NOT NULL,
  `idpago` int(11) DEFAULT NULL,
  `idinfo_negocio` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `idproductos` int(11) NOT NULL,
  `idinfo_negocio` int(11) DEFAULT NULL,
  `n_producto` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `m_producto` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `redes_sociales`
--

CREATE TABLE `redes_sociales` (
  `idredes_sociales` int(11) NOT NULL,
  `idinfo_negocio` int(11) DEFAULT NULL,
  `correo_n` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `num_local` varchar(10) COLLATE utf8_spanish_ci DEFAULT NULL,
  `num_whats` varchar(10) COLLATE utf8_spanish_ci DEFAULT NULL,
  `dir_face` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `dir_twiter` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `servicios`
--

CREATE TABLE `servicios` (
  `idservicio` int(11) NOT NULL,
  `idinfo_negocio` int(11) DEFAULT NULL,
  `n_servicio` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `d_servicio` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_pago`
--

CREATE TABLE `t_pago` (
  `idpago` int(11) NOT NULL,
  `tipo_pago` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `t_pago`
--

INSERT INTO `t_pago` (`idpago`, `tipo_pago`) VALUES
(1, 'Efectivo'),
(2, 'Tarjeta de Crédito'),
(3, 'Tarjeta de Débito');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `idusuario` int(11) NOT NULL,
  `n_usuario` varchar(15) COLLATE utf8_spanish_ci DEFAULT NULL,
  `c_usuario` varchar(15) COLLATE utf8_spanish_ci DEFAULT NULL,
  `estado` varchar(15) COLLATE utf8_spanish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`idusuario`, `n_usuario`, `c_usuario`, `estado`) VALUES
(1, 'admin', 'admin', 'activo');

--
-- Disparadores `usuarios`
--
DELIMITER $$
CREATE TRIGGER `insertIdusuarioTrigger` AFTER INSERT ON `usuarios` FOR EACH ROW CALL insertIdusuario()
$$
DELIMITER ;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `datos_personales`
--
ALTER TABLE `datos_personales`
  ADD PRIMARY KEY (`idpersonal`),
  ADD KEY `idusuario` (`idusuario`);

--
-- Indices de la tabla `dias_horario`
--
ALTER TABLE `dias_horario`
  ADD PRIMARY KEY (`iddias_horario`),
  ADD KEY `idinfo_negocio` (`idinfo_negocio`);

--
-- Indices de la tabla `direccion`
--
ALTER TABLE `direccion`
  ADD PRIMARY KEY (`iddireccion`),
  ADD KEY `idinfo_negocio` (`idinfo_negocio`),
  ADD KEY `idlocalidad` (`idlocalidad`);

--
-- Indices de la tabla `giro`
--
ALTER TABLE `giro`
  ADD PRIMARY KEY (`idgiro`);

--
-- Indices de la tabla `info_negocio`
--
ALTER TABLE `info_negocio`
  ADD PRIMARY KEY (`idinfo_negocio`),
  ADD KEY `idpersonal` (`idpersonal`),
  ADD KEY `idgiro` (`idgiro`);

--
-- Indices de la tabla `localidad`
--
ALTER TABLE `localidad`
  ADD PRIMARY KEY (`idlocalidad`);

--
-- Indices de la tabla `negocio_pago`
--
ALTER TABLE `negocio_pago`
  ADD PRIMARY KEY (`idnegocio_pago`),
  ADD KEY `idpago` (`idpago`),
  ADD KEY `idinfo_negocio` (`idinfo_negocio`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`idproductos`),
  ADD KEY `idinfo_negocio` (`idinfo_negocio`);

--
-- Indices de la tabla `redes_sociales`
--
ALTER TABLE `redes_sociales`
  ADD PRIMARY KEY (`idredes_sociales`),
  ADD KEY `idinfo_negocio` (`idinfo_negocio`);

--
-- Indices de la tabla `servicios`
--
ALTER TABLE `servicios`
  ADD PRIMARY KEY (`idservicio`),
  ADD KEY `idinfo_negocio` (`idinfo_negocio`);

--
-- Indices de la tabla `t_pago`
--
ALTER TABLE `t_pago`
  ADD PRIMARY KEY (`idpago`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`idusuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `datos_personales`
--
ALTER TABLE `datos_personales`
  MODIFY `idpersonal` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `dias_horario`
--
ALTER TABLE `dias_horario`
  MODIFY `iddias_horario` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `direccion`
--
ALTER TABLE `direccion`
  MODIFY `iddireccion` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `giro`
--
ALTER TABLE `giro`
  MODIFY `idgiro` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=105;
--
-- AUTO_INCREMENT de la tabla `info_negocio`
--
ALTER TABLE `info_negocio`
  MODIFY `idinfo_negocio` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `localidad`
--
ALTER TABLE `localidad`
  MODIFY `idlocalidad` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;
--
-- AUTO_INCREMENT de la tabla `negocio_pago`
--
ALTER TABLE `negocio_pago`
  MODIFY `idnegocio_pago` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `idproductos` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `redes_sociales`
--
ALTER TABLE `redes_sociales`
  MODIFY `idredes_sociales` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `servicios`
--
ALTER TABLE `servicios`
  MODIFY `idservicio` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `t_pago`
--
ALTER TABLE `t_pago`
  MODIFY `idpago` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `idusuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `datos_personales`
--
ALTER TABLE `datos_personales`
  ADD CONSTRAINT `datos_personales_ibfk_1` FOREIGN KEY (`idusuario`) REFERENCES `usuarios` (`idusuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `dias_horario`
--
ALTER TABLE `dias_horario`
  ADD CONSTRAINT `dias_horario_ibfk_1` FOREIGN KEY (`idinfo_negocio`) REFERENCES `info_negocio` (`idinfo_negocio`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `direccion`
--
ALTER TABLE `direccion`
  ADD CONSTRAINT `direccion_ibfk_1` FOREIGN KEY (`idinfo_negocio`) REFERENCES `info_negocio` (`idinfo_negocio`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `direccion_ibfk_2` FOREIGN KEY (`idlocalidad`) REFERENCES `localidad` (`idlocalidad`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `info_negocio`
--
ALTER TABLE `info_negocio`
  ADD CONSTRAINT `info_negocio_ibfk_1` FOREIGN KEY (`idpersonal`) REFERENCES `datos_personales` (`idpersonal`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `info_negocio_ibfk_2` FOREIGN KEY (`idgiro`) REFERENCES `giro` (`idgiro`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `negocio_pago`
--
ALTER TABLE `negocio_pago`
  ADD CONSTRAINT `negocio_pago_ibfk_1` FOREIGN KEY (`idpago`) REFERENCES `t_pago` (`idpago`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `negocio_pago_ibfk_2` FOREIGN KEY (`idinfo_negocio`) REFERENCES `info_negocio` (`idinfo_negocio`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `productos_ibfk_1` FOREIGN KEY (`idinfo_negocio`) REFERENCES `info_negocio` (`idinfo_negocio`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `redes_sociales`
--
ALTER TABLE `redes_sociales`
  ADD CONSTRAINT `redes_sociales_ibfk_1` FOREIGN KEY (`idinfo_negocio`) REFERENCES `info_negocio` (`idinfo_negocio`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `servicios`
--
ALTER TABLE `servicios`
  ADD CONSTRAINT `servicios_ibfk_1` FOREIGN KEY (`idinfo_negocio`) REFERENCES `info_negocio` (`idinfo_negocio`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
