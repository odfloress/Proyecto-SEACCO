-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 25-11-2022 a las 22:59:50
-- Versión del servidor: 10.1.38-MariaDB
-- Versión de PHP: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `seacco_bd`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_areas`
--

CREATE TABLE `tbl_areas` (
  `ID_AREA` bigint(20) NOT NULL,
  `AREA` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `ESTADO` varchar(10) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `tbl_areas`
--

INSERT INTO `tbl_areas` (`ID_AREA`, `AREA`, `ESTADO`) VALUES
(1, 'ADMINISTRATIVA', 'ACTIVO'),
(2, 'MANO DE OBRA', 'ACTIVO'),
(4, 'PRUEBA', 'INACTIVO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_asignaciones`
--

CREATE TABLE `tbl_asignaciones` (
  `ID_ASIGNADO` bigint(20) NOT NULL,
  `ID_PROYECTO` bigint(20) NOT NULL,
  `ID_USUARIO` bigint(20) NOT NULL,
  `ID_PRODUCTOS` bigint(20) NOT NULL,
  `CANT_ASIGNADA` decimal(10,2) NOT NULL,
  `CANT_ENTREGADA` decimal(10,2) DEFAULT '0.00',
  `ID_ESTADO_ASIGNACION` bigint(20) NOT NULL,
  `DESCRIPCION_ASIGNACION` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `DESCRIPCION_ENTREGA` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL,
  `FECHA_ASIGNADO` datetime NOT NULL,
  `FECHA_ENTREGA` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `tbl_asignaciones`
--

INSERT INTO `tbl_asignaciones` (`ID_ASIGNADO`, `ID_PROYECTO`, `ID_USUARIO`, `ID_PRODUCTOS`, `CANT_ASIGNADA`, `CANT_ENTREGADA`, `ID_ESTADO_ASIGNACION`, `DESCRIPCION_ASIGNACION`, `DESCRIPCION_ENTREGA`, `FECHA_ASIGNADO`, `FECHA_ENTREGA`) VALUES
(9, 1, 37, 2, '7.00', NULL, 1, 'DESC', NULL, '2022-11-25 04:10:13', '2022-11-27 03:10:15'),
(10, 1, 41, 3, '7.00', '0.00', 1, 'DES', NULL, '2022-11-25 04:10:00', '2022-11-27 04:12:00'),
(11, 1, 35, 1, '7.00', '0.00', 1, 'desc', NULL, '2022-11-25 14:54:00', '2022-11-27 14:54:00'),
(12, 1, 35, 1, '2.00', '0.00', 1, 'descri', NULL, '2022-11-25 15:02:00', '2022-11-27 15:03:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_bienvenida_portafolio`
--

CREATE TABLE `tbl_bienvenida_portafolio` (
  `ID_IMAGEN` bigint(20) NOT NULL,
  `TIPO` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `IMAGEN` varchar(2000) COLLATE utf8_spanish_ci NOT NULL,
  `RUTA` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `TITULO` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `DESCRIPCION` varchar(300) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `tbl_bienvenida_portafolio`
--

INSERT INTO `tbl_bienvenida_portafolio` (`ID_IMAGEN`, `TIPO`, `IMAGEN`, `RUTA`, `TITULO`, `DESCRIPCION`) VALUES
(2, 'BIENVENIDA', '1666153860_Lighthouse.jpg', '../../imagenes/1666153860_Lighthouse.jpg', 'BANNER 2', 'SEGUNDO BANNER DE LA VISTA BIENVENIDA SE ENCUENTRA A LA PAR DE POLITICA MEDIOAMBIENTAL'),
(3, 'BIENVENIDA', '1661114924_Centro-civico.jpg', '../../imagenes/1661114924_Centro-civico.jpg', 'BANNER 3', 'BANNER 3 DE ENCUENTRA AL FINAL DE LA VISTA BIENVENIDA'),
(4, 'BIENVENIDA', '1663031721_Tulips.jpg', '../../imagenes/1663031721_Tulips.jpg', 'MUESTRA 1', 'DESCRIPCIONDE LA IMAGEN'),
(5, 'BIENVENIDA', '1663031733_Hydrangeas.jpg', '../../imagenes/1663031733_Hydrangeas.jpg', 'MUESTRA 2', 'DESCRIPCIONDE LA IMAGEN'),
(6, 'BIENVENIDA', '1663031758_Lighthouse.jpg', '../../imagenes/1663031758_Lighthouse.jpg', 'MUESTRA 3', 'DESCRIPCIONDE LA IMAGEN'),
(7, 'BIENVENIDA', '1663031747_Chrysanthemum.jpg', '../../imagenes/1663031747_Chrysanthemum.jpg', 'MUESTRA 4', 'DESCRIPCIONDE LA IMAGEN'),
(8, 'BIENVENIDA', '1663031768_Penguins.jpg', '../../imagenes/1663031768_Penguins.jpg', 'MUESTRA 5', 'DESCRIPCIONDE LA IMAGEN'),
(9, 'BIENVENIDA', '1663031788_Penguins.jpg', '../../imagenes/1663031788_Penguins.jpg', 'MUESTRA 6', 'DESCRIPCIONDE LA IMAGEN'),
(10, 'BIENVENIDA', '1663031801_Koala.jpg', '../../imagenes/1663031801_Koala.jpg', 'MUESTRA 7', 'DESCRIPCIONDE LA IMAGEN'),
(11, 'BIENVENIDA', '1663031814_Hydrangeas.jpg', '../../imagenes/1663031814_Hydrangeas.jpg', 'MUESTRA 8', 'DESCRIPCIONDE LA IMAGEN'),
(13, 'BIENVENIDA', '1663031712_Penguins.jpg', '../../imagenes/1663031712_Penguins.jpg', 'BANNER 1', 'BANNER PRINCIPAL DE LA VISTA BIENVENIDA');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_bitacora`
--

CREATE TABLE `tbl_bitacora` (
  `ID_BITACORA` bigint(100) NOT NULL,
  `FECHA` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `USUARIO` varchar(255) NOT NULL,
  `OPERACION` varchar(100) NOT NULL,
  `PANTALLA` varchar(255) NOT NULL,
  `CAMPO` varchar(255) NOT NULL,
  `ID_REGISTRO` bigint(20) NOT NULL,
  `VALOR_ORIGINAL` varchar(255) DEFAULT NULL,
  `VALOR_NUEVO` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tbl_bitacora`
--

INSERT INTO `tbl_bitacora` (`ID_BITACORA`, `FECHA`, `USUARIO`, `OPERACION`, `PANTALLA`, `CAMPO`, `ID_REGISTRO`, `VALOR_ORIGINAL`, `VALOR_NUEVO`) VALUES
(1, '0000-00-00 00:00:00', 'ADMINISTRADOR', 'INGRESO', 'LOGIN', 'NINGUNO', 1, 'ESTADO ACTIVO', 'SE LOGUEO'),
(2, '0000-00-00 00:00:00', 'ADMINISTRADOR', 'INGRESO', 'LOGIN', 'NINGUNO', 1, 'ESTADO ACTIVO', 'SE LOGUEO'),
(6, '2023-11-22 19:20:10', 'ADMINISTRADOR', 'EDITO', 'PERMISOS', 'INSERTAR', 0, 'PANTALLA: ROLES', 'ROL: PROFESOR'),
(7, '2023-11-22 19:20:10', 'ADMINISTRADOR', 'EDITO', 'PERMISOS', 'EDITAR', 0, 'PANTALLA: ROLES', 'ROL: PROFESOR'),
(8, '2023-11-22 19:20:10', 'ADMINISTRADOR', 'EDITO', 'PERMISOS', 'CONSULTAR', 0, 'PANTALLA: ROLES', 'ROL: PROFESOR'),
(9, '2023-11-22 19:20:31', 'ADMINISTRADOR', 'EDITO', 'ROLES', 'DESCRIPCION', 6, 'PROFESOR TRES', 'PROFESOR TRESS'),
(10, '2023-11-22 19:21:01', 'ADMINISTRADOR', 'EDITO', 'CONTACTOS', 'FACEBOOK', 1, 'https://www.facebook.com/Constructora-Seacco-658896417875063/', 'https://www.facebook.com/Constructora-Seacco-658896417875063'),
(11, '0000-00-00 00:00:00', 'ADMINISTRADOR', 'INGRESO', 'LOGIN', 'NINGUNO', 1, 'ESTADO ACTIVO', 'SE LOGUEO'),
(12, '0000-00-00 00:00:00', 'ADMINISTRADOR', 'EDITO', 'ROLES', 'DESCRIPCION', 6, 'PROFESOR TRES', 'PROFESOR TRESS'),
(13, '2023-11-22 20:55:17', 'ADMINISTRADOR', 'EDITO', 'ROLES', 'DESCRIPCION', 6, 'PROFESOR TRESS', 'PROFESOR TRES'),
(14, '2022-11-23 09:03:56', 'ADMINISTRADOR', 'EDITO', 'ROLES', 'DESCRIPCION', 6, 'PROFESOR TRESS', 'PROFESOR TRES'),
(15, '0000-00-00 00:00:00', 'USUARIOO', 'INGRESO', 'LOGIN', 'NINGUNO', 1, 'ESTADO ACTIVO', 'SE LOGUEO'),
(16, '0000-00-00 00:00:00', 'ADMINISTRADOR', 'INGRESO', 'LOGIN', 'NINGUNO', 1, 'ESTADO ACTIVO', 'SE LOGUEO'),
(17, '0000-00-00 00:00:00', 'ADMINISTRADOR', 'INGRESO', 'LOGIN', 'NINGUNO', 1, 'ESTADO ACTIVO', 'SE LOGUEO'),
(18, '0000-00-00 00:00:00', 'ADMINISTRADOR', 'INGRESO', 'LOGIN', 'NINGUNO', 1, 'ESTADO ACTIVO', 'SE LOGUEO'),
(19, '0000-00-00 00:00:00', 'ADMINISTRADOR', 'INGRESO', 'LOGIN', 'NINGUNO', 1, 'ESTADO ACTIVO', 'SE LOGUEO'),
(20, '0000-00-00 00:00:00', 'ADMINISTRADOR', 'INGRESO', 'LOGIN', 'NINGUNO', 1, 'ESTADO ACTIVO', 'SE LOGUEO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_catalogo`
--

CREATE TABLE `tbl_catalogo` (
  `ID_CATALOGO` bigint(20) NOT NULL,
  `NOMBRE_CATALOGO` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `RUTA` varchar(1000) COLLATE utf8_spanish_ci NOT NULL,
  `DESCRIPCION` varchar(300) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `tbl_catalogo`
--

INSERT INTO `tbl_catalogo` (`ID_CATALOGO`, `NOMBRE_CATALOGO`, `RUTA`, `DESCRIPCION`) VALUES
(1, 'HFGDFSAZ', '../../imagenes/1668983259_Koala.jpg', 'DGFSDADGFSDADGFSDADGFSDADGFSDADGFSDADGFSDADGFSDADGFSDADGFSDADGFSDADGFSDADGFSDADGFSDADGFSDADGFSDADGFSDADGFSDADGFSDADGFSDADGFSDADGFSDADGFSDADGFSDADGFSDADGFSDADGFSDADGFSDADGFSDADGFSDADGFSDADGFSDADGFSDADGFSDADGFSDADGFSDADGFSDADGFSDADGFSDA'),
(2, 'DFSASA', '../../imagenes/1668983246_Tulips.jpg', 'SDAA'),
(3, 'HGFADS', '../../imagenes/1668712406_Lighthouse.jpg', 'WRFADSA'),
(4, 'HGFDSA', '../../imagenes/1668983233_Hydrangeas.jpg', 'ERFWDSA'),
(5, 'YIUTYJTGRFDAVQASD', '../../imagenes/1668983219_Lighthouse.jpg', 'HGRFEAWTER'),
(6, 'HGFD', '../../imagenes/1668983203_Lighthouse.jpg', 'GHSFSDC'),
(7, 'JYHGFD', '../../imagenes/1668983191_Hydrangeas.jpg', 'HTSGFCX'),
(8, 'UYYYTTGFD', '../../imagenes/1668983181_Hydrangeas.jpg', 'YTHGFDCX'),
(9, 'YTGFDSF', '../../imagenes/1668983168_Tulips.jpg', 'FGVDXCDSGFDSX'),
(10, 'DJHBN', '../../imagenes/1668983158_Lighthouse.jpg', 'DSFGDFHSFGHFGH'),
(11, 'HGAFSDZCXDSF', '../../imagenes/1668983147_Hydrangeas.jpg', 'HTRGADSFCX'),
(12, 'GFADSCX', '../../imagenes/1668983136_Chrysanthemum.jpg', 'GDAFSXVCVGH'),
(13, 'SSDVDS', '../../imagenes/1668983127_Tulips.jpg', 'ASDFDSDFASDF'),
(14, 'ADGHF', '../../imagenes/1668983117_Lighthouse.jpg', 'FCSAADFASDF'),
(15, 'GASFD', '../../imagenes/1668983101_Hydrangeas.jpg', 'SDFADFG');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_categoria_producto`
--

CREATE TABLE `tbl_categoria_producto` (
  `ID_CATEGORIA` bigint(20) NOT NULL,
  `NOMBRE_CATEGORIA` varchar(255) NOT NULL,
  `ESTADO` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tbl_categoria_producto`
--

INSERT INTO `tbl_categoria_producto` (`ID_CATEGORIA`, `NOMBRE_CATEGORIA`, `ESTADO`) VALUES
(1, 'MOTOR', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_clientes`
--

CREATE TABLE `tbl_clientes` (
  `ID_CLIENTE` bigint(20) NOT NULL,
  `CODIGO` varchar(15) COLLATE utf8_spanish_ci NOT NULL,
  `NOMBRE_CLIENTE` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `APELLIDO` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `CORREO` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `TELEFONO` int(15) NOT NULL,
  `DIRECCION` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `REFERENCIA` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `ID_GENERO` int(7) NOT NULL,
  `FOTO` varchar(200) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `tbl_clientes`
--

INSERT INTO `tbl_clientes` (`ID_CLIENTE`, `CODIGO`, `NOMBRE_CLIENTE`, `APELLIDO`, `CORREO`, `TELEFONO`, `DIRECCION`, `REFERENCIA`, `ID_GENERO`, `FOTO`) VALUES
(1, 'GFDS', 'FDS', 'FDSA', 'correo@gmail', 23233454, 'EFDDF', 'ERE', 3, '../../imagenes/1661219710_pantallas.png'),
(2, '8888888888888', 'SDFA', 'SDAA', 'asda@sdd', 54322133, 'DFSDFSD', 'SDFSDF', 4, '../../imagenes/1668982312_Hydrangeas.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_compras`
--

CREATE TABLE `tbl_compras` (
  `ID_COMPRA` bigint(20) NOT NULL,
  `ID_PROVEEDOR` bigint(20) NOT NULL,
  `TOTAL_COMPRA` decimal(10,2) NOT NULL,
  `FECHA_COMPRA` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `USUARIO` varchar(255) NOT NULL,
  `ESTADO_COMPRA` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tbl_compras`
--

INSERT INTO `tbl_compras` (`ID_COMPRA`, `ID_PROVEEDOR`, `TOTAL_COMPRA`, `FECHA_COMPRA`, `USUARIO`, `ESTADO_COMPRA`) VALUES
(1, 1, '14.00', '2022-08-25 15:35:00', 'ADMINISTRADOR', 'FINALIZADO'),
(2, 1, '28.00', '2022-08-25 15:38:11', 'ADMINISTRADOR', 'FINALIZADO'),
(13, 1, '14.00', '2022-11-23 23:32:20', 'ADMINISTRADOR', 'FINALIZADO'),
(16, 1, '28.00', '2022-11-24 18:03:48', 'ADMINISTRADOR', 'FINALIZADO'),
(17, 1, '17.50', '2022-11-24 20:13:59', 'ADMINISTRADOR', 'FINALIZADO'),
(20, 1, '14.00', '2022-11-24 23:34:13', 'ADMINISTRADOR', 'FINALIZADO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_departamentos`
--

CREATE TABLE `tbl_departamentos` (
  `ID_DEPARTAMENTO` bigint(20) NOT NULL,
  `DEPARTAMENTO` varchar(255) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `tbl_departamentos`
--

INSERT INTO `tbl_departamentos` (`ID_DEPARTAMENTO`, `DEPARTAMENTO`) VALUES
(1, 'LA CEIBA'),
(2, 'COLÓN'),
(3, 'COMAYAGUA'),
(4, 'COPÁN'),
(5, 'CORTÉS'),
(6, 'CHOLUTECA'),
(7, 'EL PARAÍSO'),
(8, 'FRANCISCO MORAZÁN'),
(9, 'GRACIAS A DIOS'),
(10, 'INTIBUCÁ'),
(11, 'ISLAS DE LA BAHÍA'),
(12, 'LA PAZ'),
(13, 'LEMPIRA'),
(14, 'OCOTEPEQUE'),
(15, 'OLANCHO'),
(16, 'SANTA BÁRBARA'),
(17, 'VALLE'),
(18, 'YORO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_detalle_asignacion`
--

CREATE TABLE `tbl_detalle_asignacion` (
  `ID_DETALLE_ASIGNACION` bigint(20) NOT NULL,
  `ID_ASIGNADO` bigint(20) NOT NULL,
  `DESCRIPCION_ASIGNACION1` varchar(255) NOT NULL,
  `ID_PRODUCTO` bigint(20) NOT NULL,
  `CANTIDAD` int(10) NOT NULL,
  `USUARIO1` varchar(50) NOT NULL,
  `FECHA_ASIGNADO` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `FECHA_ENTREGA` date NOT NULL,
  `ID_ESTADO_HERRAMIENTA` bigint(6) NOT NULL,
  `ID_ESTADO_ASIGNACION` bigint(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Disparadores `tbl_detalle_asignacion`
--
DELIMITER $$
CREATE TRIGGER `triger_debuelve_inventario` AFTER DELETE ON `tbl_detalle_asignacion` FOR EACH ROW UPDATE tbl_inventario SET  CANTIDAD_DISPONIBLE=CANTIDAD_DISPONIBLE+old.CANTIDAD WHERE ID_PRODUCTOS=old.ID_PRODUCTO
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_detalle_compra`
--

CREATE TABLE `tbl_detalle_compra` (
  `ID_DETALLE` bigint(20) NOT NULL,
  `ID_COMPRA` bigint(20) NOT NULL,
  `ID_PRODUCTO` bigint(20) NOT NULL,
  `GARANTIA` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL,
  `ID_UNIDAD_MEDIDA` bigint(20) NOT NULL,
  `CANTIDAD` decimal(10,2) NOT NULL,
  `PRECIO` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `tbl_detalle_compra`
--

INSERT INTO `tbl_detalle_compra` (`ID_DETALLE`, `ID_COMPRA`, `ID_PRODUCTO`, `GARANTIA`, `ID_UNIDAD_MEDIDA`, `CANTIDAD`, `PRECIO`) VALUES
(5, 16, 1, 'NINGUNA', 3, '7.00', '2.00'),
(6, 16, 2, '3 MESES', 3, '7.00', '2.00'),
(7, 17, 1, 'NINGUNA', 3, '7.00', '2.50'),
(9, 20, 1, 'NINGUNA', 3, '7.00', '2.00');

--
-- Disparadores `tbl_detalle_compra`
--
DELIMITER $$
CREATE TRIGGER `triger_resta_inventario` AFTER DELETE ON `tbl_detalle_compra` FOR EACH ROW UPDATE tbl_inventario SET  CANTIDAD_DISPONIBLE=CANTIDAD_DISPONIBLE-old.CANTIDAD WHERE ID_PRODUCTOS=old.ID_PRODUCTO
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_devoluciones`
--

CREATE TABLE `tbl_devoluciones` (
  `ID_DEVOLUCION` bigint(20) NOT NULL,
  `ID_PRODUCTO` bigint(20) NOT NULL,
  `CANTIDAD` decimal(10,2) NOT NULL,
  `ID_PROVEEDOR` bigint(20) NOT NULL,
  `DESCRIPCION_DEVOLUCION` varchar(255) COLLATE utf8mb4_spanish_ci NOT NULL,
  `USUARIO` varchar(100) COLLATE utf8mb4_spanish_ci NOT NULL,
  `FECHA` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `tbl_devoluciones`
--

INSERT INTO `tbl_devoluciones` (`ID_DEVOLUCION`, `ID_PRODUCTO`, `CANTIDAD`, `ID_PROVEEDOR`, `DESCRIPCION_DEVOLUCION`, `USUARIO`, `FECHA`) VALUES
(17, 1, '1.00', 1, 'SA', 'ADMINISTRADOR', '2022-11-25 02:13:44');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_estados_proyectos`
--

CREATE TABLE `tbl_estados_proyectos` (
  `ID_ESTADOS` bigint(20) NOT NULL,
  `ESTADO_PROYECTO` varchar(255) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `tbl_estados_proyectos`
--

INSERT INTO `tbl_estados_proyectos` (`ID_ESTADOS`, `ESTADO_PROYECTO`) VALUES
(1, 'SOLICITUD'),
(4, 'EN PROCESO'),
(5, 'DETENIDO'),
(6, 'FINALIZADO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_estado_asignacion`
--

CREATE TABLE `tbl_estado_asignacion` (
  `ID_ESTADO_ASIGNACION` bigint(6) NOT NULL,
  `ESTADO_ASIGNACION` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  `ESTADOS` varchar(10) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `tbl_estado_asignacion`
--

INSERT INTO `tbl_estado_asignacion` (`ID_ESTADO_ASIGNACION`, `ESTADO_ASIGNACION`, `ESTADOS`) VALUES
(1, 'ASIGNADO', 'ACTIVO'),
(2, 'ENTREGADO', 'ACTIVO'),
(3, 'DDDD', 'INACTIVO'),
(5, 'WEREWE', 'ACTIVO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_estado_herramienta`
--

CREATE TABLE `tbl_estado_herramienta` (
  `ID_ESTADO_HERRAMIENTA` bigint(6) NOT NULL,
  `ESTADO` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  `ESTADOS` varchar(10) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `tbl_estado_herramienta`
--

INSERT INTO `tbl_estado_herramienta` (`ID_ESTADO_HERRAMIENTA`, `ESTADO`, `ESTADOS`) VALUES
(1, 'EN REPARACIÓN', 'ACTIVO'),
(2, 'DAÑADO', 'INACTIVO'),
(4, 'DSASDASSDSS', 'ACTIVO'),
(5, 'SDDSDFSD', 'ACTIVO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_estado_usuario`
--

CREATE TABLE `tbl_estado_usuario` (
  `ID_ESTADO_USUARIO` bigint(20) NOT NULL,
  `NOMBRE_ESTADO` varchar(255) NOT NULL,
  `DESCRIPCION` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tbl_estado_usuario`
--

INSERT INTO `tbl_estado_usuario` (`ID_ESTADO_USUARIO`, `NOMBRE_ESTADO`, `DESCRIPCION`) VALUES
(1, 'ACTIVO', 'czvbxc'),
(2, 'INACTIVO', 'SFSDF'),
(3, 'BLOQUEADO', 'DFFDF'),
(4, 'NUEVO', 'DFSDF'),
(5, 'SOLICITUD', 'SOLICITUDES DE EMPLEO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_generos`
--

CREATE TABLE `tbl_generos` (
  `ID_GENERO` int(7) NOT NULL,
  `GENERO` varchar(30) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `tbl_generos`
--

INSERT INTO `tbl_generos` (`ID_GENERO`, `GENERO`) VALUES
(3, 'MASCULINO'),
(4, 'FEMENINO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_inventario`
--

CREATE TABLE `tbl_inventario` (
  `ID_INVENTARIO` bigint(20) NOT NULL,
  `ID_PRODUCTOS` bigint(20) NOT NULL,
  `CANTIDAD_MINIMA` int(10) NOT NULL,
  `CANTIDAD_MAXIMA` int(10) NOT NULL,
  `CANTIDAD_DISPONIBLE` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `tbl_inventario`
--

INSERT INTO `tbl_inventario` (`ID_INVENTARIO`, `ID_PRODUCTOS`, `CANTIDAD_MINIMA`, `CANTIDAD_MAXIMA`, `CANTIDAD_DISPONIBLE`) VALUES
(1, 1, 7, 14, '11.00'),
(2, 2, 5, 10, '7.00'),
(3, 3, 43, 543, '0.00'),
(4, 5, 32, 44, '1.00'),
(5, 6, 5, 20, '0.00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_kardex`
--

CREATE TABLE `tbl_kardex` (
  `ID_KARDEX` bigint(20) NOT NULL,
  `ID_PRODUCTO` bigint(20) NOT NULL,
  `ID_COMPRA` bigint(20) DEFAULT NULL,
  `ID_ASIGNACION` int(20) DEFAULT NULL,
  `USUARIO` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `CANTIDAD` int(10) NOT NULL,
  `TIPO_MOVIMIENTO` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `FECHA_HORA` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `tbl_kardex`
--

INSERT INTO `tbl_kardex` (`ID_KARDEX`, `ID_PRODUCTO`, `ID_COMPRA`, `ID_ASIGNACION`, `USUARIO`, `CANTIDAD`, `TIPO_MOVIMIENTO`, `FECHA_HORA`) VALUES
(1, 1, 1, 0, 'ADMINISTRADOR', 7, 'ENTRADA', '2022-08-25 15:34:54'),
(2, 1, 0, 2, 'ADMINISTRADOR', 5, 'SALIDA', '2022-08-25 15:36:44'),
(3, 2, 2, 0, 'ADMINISTRADOR', 14, 'ENTRADA', '2022-08-25 15:38:07'),
(4, 2, 0, 2, 'ADMINISTRADOR', 4, 'SALIDA', '2022-08-25 15:38:33'),
(6, 1, NULL, 8, 'ADMINISTRADOR', 2, 'SALIDA', '2022-10-18 23:25:15'),
(16, 1, 13, NULL, 'ADMINISTRADOR', 7, 'ENTRADA', '2022-11-23 23:32:12'),
(22, 2, 16, NULL, 'ADMINISTRADOR', 7, 'ENTRADA', '2022-11-24 06:03:30'),
(23, 1, 17, NULL, 'ADMINISTRADOR', 7, 'ENTRADA', '2022-11-24 08:13:42'),
(25, 1, 20, NULL, 'ADMINISTRADOR', 7, 'ENTRADA COMPRA', '2022-11-24 11:34:07'),
(35, 1, 17, NULL, 'ADMINISTRADOR', 1, 'DEVOLUCION', '2022-11-25 02:13:44'),
(36, 1, NULL, 0, 'ADMINISTRADOR', 2, 'SALIDA ASIGNACION', '2022-11-25 03:03:06');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_ms_objetos`
--

CREATE TABLE `tbl_ms_objetos` (
  `ID_OBJETO` bigint(20) NOT NULL,
  `OBJETO` varchar(100) NOT NULL,
  `DESCRIPCION` varchar(100) NOT NULL,
  `TIPO_OBJETO` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tbl_ms_objetos`
--

INSERT INTO `tbl_ms_objetos` (`ID_OBJETO`, `OBJETO`, `DESCRIPCION`, `TIPO_OBJETO`) VALUES
(1, 'USUARIOS', 'ADMINISTRA LOS ADMINISTRADORES', 'MODULO PERSONAS'),
(2, 'TABLERO', 'MUSTRA ALGUNAS ESTADISTICAS', 'ESTADISTICO'),
(3, 'PERFIL', 'MUESTRA LOS DATOS DEL USUARIO', 'PERFIL'),
(4, 'CLIENTES', 'ADMINISTRA LOS CLIENTES', 'MODULO PERSONAS'),
(5, 'PROVEEDORES', 'ADMINISTRA LOS PROVEEDORES', 'MODULO PERSONAS'),
(6, 'BIENVENIDA', 'ADMINISTRA LA PANTALLA DE BIENVENIDA', 'MODULO  CATALOGO'),
(7, 'PORTAFOLIO', 'ADMINISTRA EL PORTAFOLIO', 'MODULO CATALOGO'),
(8, 'COMPRAS', 'ADMINISTRA LAS COMPRAS', 'MODULO  INVENTARIO'),
(9, 'ASIGNACIONES', 'ADMINISTRA LAS ASIGNACIONES DE HERRAMIETA', 'MODULO  INVENTARIO'),
(10, 'INVENTARIO', 'MUESTRA TODO EL INVENTARIO REGISTRADO', 'MODULO INVENTARIO'),
(11, 'CATEGORIA DE PRODUCTOS', 'ADMINISTRA LAS CATEGORIAS DE LAS HERRAMIENTAS', 'MODULO  INVENTARIO'),
(12, 'PRODUCTOS', 'ADMINISTRA LOS PRODUCTOS', 'MODULO INVENTARIO'),
(13, 'PROYECTOS', 'ADMINISTRA LOS PRODUCTOS', 'MODULO DE PROYECTOS'),
(14, 'ESTADO PROYECTOS', 'ADMINISTRA LOS ESTADOS DE LOS PRODUCTOS', 'MODULO PROYECTOS'),
(15, 'REPORTES DE PERSONAS', 'CREA REPORTES DE PERSONAS', 'MODULO REPORTES'),
(16, 'REPORTES DE INVENTARIO', 'CREA REPORTES DE INVENTARIO', 'MODULO REPORTES'),
(17, 'REPOSTES DE PROYECTOS', 'CREA REPORTES DE PROYECTOS', 'MODULO REPORTES'),
(18, 'NUESTROS CONTACTOS', 'ADMINISTRA LOS CONTACTOS', 'MODULO DE AJUSTES'),
(19, 'ROLES', 'ADMINISTRA LOS ROLES', 'MODULO DE AJUSTES'),
(20, 'PERMISO DE ROLES', 'ADMINISTRA LOS PERMISOS DE LOS ROLES', 'MODULO DE AJUSTES'),
(21, 'PREGUNTAS DE SEGURIDAD', 'ADMINISTRA LAS PREGUNTAS DE SEGURIDAD', 'MODULO DE AJUSTES'),
(22, 'BITACORA', 'MUESTRA LAS ACCIONES DEL USUARIO', 'MODULO DE AJUSTES'),
(23, 'BACKUP', 'EXPORTA E IMPORTA LA BD', 'MODULO DE AJUSTES'),
(24, 'PROFESIONES', 'ADMINISTRA LAS PROFESIONES', 'MODULO MANTENIMIENTO'),
(25, 'ESTADOS DE ASIGNACION', 'ADMINISTRA LOS ESTADOS DE ASIGNACION', 'MODULO DE MANTENIMIENTO'),
(26, 'ESTADOS DE HERRAMIENTAS', 'ADMINISTRA LOS ESTADOS DE HERRAMIENTAS', 'MODULO DE MANTENIMIENTO'),
(27, 'DEPARTAMENTOS', 'ADMINISTRA LOS DEPARTAMENTOS', 'MODULO DE MANTENIMIENTO'),
(28, 'PARAMETROS', 'PANTALLA ADMINISTRATIVA DE PARAMETROS', 'MODULO SEGURIDAD'),
(29, 'GENEROS', 'PANTALLA ADMINISTRATIVA DE GENEROS', 'MODULO DE MANTENIMIENTO'),
(30, 'AREAS DE EMPLEO', 'PANTALLA DE AMINISTRACIONDE AREAS DE EMPLEO', 'MODULO DE MANTENIMIENTO'),
(31, 'CATALOGOS', 'ADMINISTRACION DE CATALOGOS', 'MODULO  CATALOGO'),
(32, 'RESPUESTAS DE USUARIO', 'PANTALLA ADMINISTRATIVA DE RESPUESTAS DE USARIO', 'MODULO DE SEGURIDAD'),
(33, 'DEVOLUCIONES', 'CRUD DEVOLUCIONES', 'MODULO INVENTARIO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_ms_roles_ojetos`
--

CREATE TABLE `tbl_ms_roles_ojetos` (
  `ID_OBJETO` bigint(20) NOT NULL,
  `ID_ROL` bigint(20) NOT NULL,
  `PERMISO_INSERCION` int(1) NOT NULL,
  `PERMISO_ELIMINACION` int(1) NOT NULL,
  `PERMISO_ACTUALIZACION` int(1) NOT NULL,
  `PERMISO_CONSULTAR` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tbl_ms_roles_ojetos`
--

INSERT INTO `tbl_ms_roles_ojetos` (`ID_OBJETO`, `ID_ROL`, `PERMISO_INSERCION`, `PERMISO_ELIMINACION`, `PERMISO_ACTUALIZACION`, `PERMISO_CONSULTAR`) VALUES
(6, 3, 1, 1, 1, 1),
(3, 3, 1, 1, 1, 1),
(19, 3, 1, 1, 1, 1),
(7, 3, 1, 1, 1, 1),
(21, 3, 1, 1, 1, 1),
(1, 3, 1, 1, 1, 1),
(20, 3, 1, 1, 1, 1),
(24, 3, 1, 1, 1, 1),
(25, 3, 1, 1, 1, 1),
(2, 3, 1, 1, 1, 1),
(26, 3, 1, 1, 1, 1),
(27, 3, 1, 1, 1, 1),
(5, 3, 1, 1, 1, 1),
(13, 3, 1, 1, 1, 1),
(14, 3, 1, 1, 1, 1),
(18, 3, 1, 1, 1, 1),
(12, 3, 1, 1, 1, 1),
(29, 3, 1, 1, 1, 1),
(28, 3, 1, 1, 1, 1),
(9, 3, 1, 1, 1, 1),
(10, 3, 1, 1, 1, 1),
(11, 3, 1, 1, 1, 1),
(15, 3, 1, 1, 1, 1),
(16, 3, 1, 1, 1, 1),
(23, 3, 1, 1, 1, 1),
(22, 3, 1, 1, 1, 1),
(17, 3, 1, 1, 1, 1),
(30, 3, 1, 1, 1, 1),
(31, 3, 1, 1, 1, 1),
(4, 3, 1, 1, 1, 1),
(8, 3, 1, 1, 1, 1),
(1, 4, 1, 1, 1, 1),
(5, 4, 1, 1, 1, 1),
(8, 4, 1, 1, 1, 1),
(1, 5, 0, 0, 0, 0),
(4, 4, 1, 1, 1, 1),
(6, 4, 1, 1, 1, 1),
(7, 4, 1, 1, 1, 1),
(19, 6, 0, 1, 0, 1),
(21, 6, 1, 1, 1, 1),
(2, 4, 1, 0, 0, 0),
(3, 5, 0, 0, 0, 0),
(2, 5, 1, 0, 0, 0),
(32, 3, 1, 1, 1, 1),
(33, 3, 1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_nuestros_contactos`
--

CREATE TABLE `tbl_nuestros_contactos` (
  `ID_CONTACTO` bigint(20) DEFAULT NULL,
  `TELEFONO` int(15) DEFAULT NULL,
  `CORREO` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL,
  `DIRECCION` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL,
  `FACEBOOK` varchar(250) COLLATE utf8_spanish_ci DEFAULT NULL,
  `INSTAGRAM` varchar(250) COLLATE utf8_spanish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `tbl_nuestros_contactos`
--

INSERT INTO `tbl_nuestros_contactos` (`ID_CONTACTO`, `TELEFONO`, `CORREO`, `DIRECCION`, `FACEBOOK`, `INSTAGRAM`) VALUES
(1, 98653241, 'proyectos@seaccohn.com', 'TEGUCIGALPA, HONDURAS.', 'https://www.facebook.com/Constructora-Seacco-658896417875063', 'https://www.instagram.com/Constructora-Seacco-658896417875063/'),
(2, NULL, 'seaccoc@gmail.com', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_parametros`
--

CREATE TABLE `tbl_parametros` (
  `ID_PARAMETRO` bigint(20) NOT NULL,
  `ID_USUARIO` bigint(20) NOT NULL,
  `PARAMETRO` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `VALOR` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `FECHA_CREACION` datetime NOT NULL,
  `FECHA_MODIFICACION` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `tbl_parametros`
--

INSERT INTO `tbl_parametros` (`ID_PARAMETRO`, `ID_USUARIO`, `PARAMETRO`, `VALOR`, `FECHA_CREACION`, `FECHA_MODIFICACION`) VALUES
(5, 31, 'INTENTOS', '3', '2022-06-24 03:04:00', '2022-08-05 18:35:32'),
(6, 31, 'PREGUNTAS', '2', '2022-07-07 00:00:00', '2022-07-14 00:00:00'),
(7, 31, 'NOMBRE', 'SEACCO S. DE. R.L.', '2022-06-24 03:04:00', '2022-08-19 22:23:33'),
(8, 31, 'MIN_CONTRASENA', '5', '2022-11-10 00:00:00', '2022-11-11 00:00:00'),
(9, 31, 'MAX_CONTRASENA', '7', '2022-11-10 00:00:00', '2022-11-11 00:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_portafolio`
--

CREATE TABLE `tbl_portafolio` (
  `ID_IMAGEN` bigint(20) NOT NULL,
  `ID_CATALOGO` bigint(20) NOT NULL,
  `IMAGEN` varchar(1000) COLLATE utf8_spanish_ci NOT NULL,
  `RUTA_PORTAFOLIO` varchar(1000) COLLATE utf8_spanish_ci NOT NULL,
  `TITULO` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `DESCRIPCION_PORTAFOLIO` varchar(300) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `tbl_portafolio`
--

INSERT INTO `tbl_portafolio` (`ID_IMAGEN`, `ID_CATALOGO`, `IMAGEN`, `RUTA_PORTAFOLIO`, `TITULO`, `DESCRIPCION_PORTAFOLIO`) VALUES
(1, 1, '1666585986_Lighthouse.jpg', '../../imagenes/1666585986_Lighthouse.jpg', 'COCINA', 'DESZSDGF'),
(3, 3, '1668983071_Hydrangeas.jpg', '../../imagenes/1668983071_Hydrangeas.jpg', 'DFS', 'SDFSDFDSF'),
(4, 6, '1668983061_Tulips.jpg', '../../imagenes/1668983061_Tulips.jpg', 'ASDASD', 'ASDASDA ASDASDA ASDASDA ASDASDA ASDASDA ASDASDA ASDASDA ASDASDA ASDASDA ASDASDA ASDASDA ASDASDAASDASDA ASDASDA ASDASDA ASDASDAASDASDA'),
(5, 8, '1668983049_Desert.jpg', '../../imagenes/1668983049_Desert.jpg', 'TITULOS DE MA', 'DESASDAS SDFSDFSDFSDFSD'),
(6, 1, '1668983037_Tulips.jpg', '../../imagenes/1668983037_Tulips.jpg', 'ASD', 'ASD'),
(7, 10, '1668983026_Hydrangeas.jpg', '../../imagenes/1668983026_Hydrangeas.jpg', 'ASDASDASDAS', 'ASDASDAS');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_preguntas`
--

CREATE TABLE `tbl_preguntas` (
  `ID_PREGUNTA` bigint(20) NOT NULL,
  `PREGUNTA` varchar(255) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `tbl_preguntas`
--

INSERT INTO `tbl_preguntas` (`ID_PREGUNTA`, `PREGUNTA`) VALUES
(6, '¿CUAL ES TU COLOR FAVORITO?'),
(7, '¿CUAL ES TU COMIDA FAVORITA?');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_productos`
--

CREATE TABLE `tbl_productos` (
  `ID_PRODUCTO` bigint(20) NOT NULL,
  `ID_CATEGORIA` bigint(20) NOT NULL,
  `CANTIDAD_MIN` int(11) NOT NULL,
  `CANTIDAD_MAX` int(11) NOT NULL,
  `FOTO` varchar(2000) COLLATE utf8_spanish_ci NOT NULL,
  `CODIGO` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  `NOMBRE` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `DESCRIPCION_MODELO` varchar(255) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `tbl_productos`
--

INSERT INTO `tbl_productos` (`ID_PRODUCTO`, `ID_CATEGORIA`, `CANTIDAD_MIN`, `CANTIDAD_MAX`, `FOTO`, `CODIGO`, `NOMBRE`, `DESCRIPCION_MODELO`) VALUES
(1, 1, 7, 14, '../../imagenes/1661466383_Centro-civico.jpg', 'CODIGO', 'MARTILLO', 'DESCRIPCION'),
(2, 1, 5, 10, '../../imagenes/1661463454_fondo14.jpeg', 'TALADRO123', 'TALADRO', 'DECR'),
(3, 1, 43, 543, '../../imagenes/1661466738_Hydrangeas.jpg', 'MO', 'PULIDORA', 'DWSA'),
(5, 1, 32, 44, '../../imagenes/1666248221_Penguins.jpg', 'DSAt', 'TE', 'DSS'),
(6, 1, 5, 20, '../../imagenes/1668984431_Penguins.jpg', '5SD5-5S5F', 'BOMBA DE AGUA', 'BOMBA DE AGUA');

--
-- Disparadores `tbl_productos`
--
DELIMITER $$
CREATE TRIGGER `triger_insertar_inventario` AFTER INSERT ON `tbl_productos` FOR EACH ROW INSERT INTO tbl_inventario (ID_PRODUCTOS, CANTIDAD_MINIMA, CANTIDAD_MAXIMA, CANTIDAD_DISPONIBLE) VALUES (NEW.ID_PRODUCTO, NEW.CANTIDAD_MIN, NEW.CANTIDAD_MAX, 0)
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `trigger_editar_inventario` AFTER UPDATE ON `tbl_productos` FOR EACH ROW UPDATE tbl_inventario SET CANTIDAD_MINIMA=NEW.CANTIDAD_MIN, CANTIDAD_MAXIMA=NEW.CANTIDAD_MAX WHERE ID_PRODUCTOS=old.ID_PRODUCTO
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_profesiones`
--

CREATE TABLE `tbl_profesiones` (
  `ID_PROFESION` bigint(20) NOT NULL,
  `PROFESION` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL,
  `ESTADO` varchar(10) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `tbl_profesiones`
--

INSERT INTO `tbl_profesiones` (`ID_PROFESION`, `PROFESION`, `ESTADO`) VALUES
(5, 'CARPINTERO', 'INACTIVO'),
(7, 'ELECTRICISTA', 'ACTIVO'),
(9, 'MAESTRO DE OBRA', 'ACTIVO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_proveedores`
--

CREATE TABLE `tbl_proveedores` (
  `ID_PROVEEDOR` bigint(20) NOT NULL,
  `NOMBRE` varchar(250) NOT NULL,
  `NOMBRE_REFERENCIA` varchar(250) NOT NULL,
  `SECTOR_COMERCIAL` varchar(255) NOT NULL,
  `DIRECCION` varchar(255) NOT NULL,
  `TELEFONO` int(15) NOT NULL,
  `CORREO` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tbl_proveedores`
--

INSERT INTO `tbl_proveedores` (`ID_PROVEEDOR`, `NOMBRE`, `NOMBRE_REFERENCIA`, `SECTOR_COMERCIAL`, `DIRECCION`, `TELEFONO`, `CORREO`) VALUES
(1, 'LA MUDIAL', 'REFERENCIA', 'SECTORES', 'DIRECCION', 76876567, 'correo@gmail.com'),
(2, 'PROVEEDORES', 'REFERENCIA', 'SECTOR', 'DIRECCIONES', 76876565, 'correo1@gmail.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_proyectos`
--

CREATE TABLE `tbl_proyectos` (
  `ID_PROYECTO` bigint(20) NOT NULL,
  `ID_CLIENTE` bigint(20) NOT NULL,
  `ID_USUARIO` bigint(20) DEFAULT NULL,
  `ID_ESTADOS` bigint(20) NOT NULL,
  `NOMBRE_PROYECTO` varchar(255) NOT NULL,
  `DESCRIPCION` varchar(300) NOT NULL,
  `ID_DEPARTAMENTO` bigint(20) NOT NULL,
  `UBICACION` varchar(255) NOT NULL,
  `FECHA_INICIO` date NOT NULL,
  `FECHA_FINAL` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tbl_proyectos`
--

INSERT INTO `tbl_proyectos` (`ID_PROYECTO`, `ID_CLIENTE`, `ID_USUARIO`, `ID_ESTADOS`, `NOMBRE_PROYECTO`, `DESCRIPCION`, `ID_DEPARTAMENTO`, `UBICACION`, `FECHA_INICIO`, `FECHA_FINAL`) VALUES
(1, 1, 31, 4, 'NOMBRE', 'DESC', 2, 'UB', '2022-08-23', '2022-08-24'),
(2, 1, 31, 1, 'DFS', 'SDAA', 16, 'FEDWS', '2022-10-21', '2022-10-21');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_respuestas_usuario`
--

CREATE TABLE `tbl_respuestas_usuario` (
  `ID_RESPUESTA` bigint(20) NOT NULL,
  `ID_PREGUNTA` bigint(20) NOT NULL,
  `USUARIO` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `RESPUESTA` varchar(255) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `tbl_respuestas_usuario`
--

INSERT INTO `tbl_respuestas_usuario` (`ID_RESPUESTA`, `ID_PREGUNTA`, `USUARIO`, `RESPUESTA`) VALUES
(89, 6, 'ADMINISTRADOR', 'BLANCO'),
(90, 7, 'ADMINISTRADOR', 'PIZZA'),
(101, 6, 'INFORMATICA', 'BLANCO'),
(102, 7, 'INFORMATICA', 'ROJO'),
(103, 6, 'USUARIOS', 'BLANCO'),
(104, 7, 'USUARIOS', 'HAMBURGUEZA'),
(105, 6, 'FAVIEL', 'BLANCO'),
(106, 7, 'FAVIEL', 'PIZZA'),
(107, 6, 'USUARIOO', 'BLANCO'),
(108, 7, 'USUARIOO', 'PIZZA');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_roles`
--

CREATE TABLE `tbl_roles` (
  `ID_ROL` bigint(20) NOT NULL,
  `ROL` varchar(60) COLLATE utf8_spanish_ci DEFAULT NULL,
  `DESCRIPCION` varchar(60) COLLATE utf8_spanish_ci DEFAULT NULL,
  `ESTADO_ROL` varchar(10) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `tbl_roles`
--

INSERT INTO `tbl_roles` (`ID_ROL`, `ROL`, `DESCRIPCION`, `ESTADO_ROL`) VALUES
(3, 'SUPERADMIN', 'TIENE ACCESO A TODO', 'ACTIVO'),
(4, 'EMPLEADOS', 'DESCRIPCION', 'ACTIVO'),
(5, 'CLIENTES', 'DE', 'ACTIVO'),
(6, 'PROFESOR', 'PROFESOR TRES', 'ACTIVO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_unidad_medida`
--

CREATE TABLE `tbl_unidad_medida` (
  `ID_UNIDAD_MEDIDA` bigint(20) NOT NULL,
  `UNIDAD_MEDIDA` varchar(255) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `tbl_unidad_medida`
--

INSERT INTO `tbl_unidad_medida` (`ID_UNIDAD_MEDIDA`, `UNIDAD_MEDIDA`) VALUES
(3, 'UNIDADES'),
(4, 'LITROS'),
(5, 'GALONES'),
(6, 'LIBRAS'),
(7, 'METROS CUADRADOS'),
(8, 'METROS'),
(9, 'KILOGRAMO'),
(10, 'YARDAS');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_usuarios`
--

CREATE TABLE `tbl_usuarios` (
  `ID_USUARIO` bigint(20) NOT NULL,
  `ID_ROL` bigint(20) NOT NULL,
  `ID_ESTADO_USUARIO` bigint(20) NOT NULL,
  `NOMBRE` varchar(255) NOT NULL,
  `APELLIDO` varchar(255) NOT NULL,
  `USUARIO` varchar(255) NOT NULL,
  `CORREO` varchar(255) NOT NULL,
  `ID_GENERO` int(7) NOT NULL,
  `DNI` varchar(15) NOT NULL,
  `ID_PROFESION` bigint(20) NOT NULL,
  `DIRECCION` varchar(255) NOT NULL,
  `CELULAR` int(15) NOT NULL,
  `REFERENCIA` varchar(255) DEFAULT NULL,
  `CEL_REFERENCIA` int(15) DEFAULT NULL,
  `EXPERIENCIA_LABORAL` varchar(255) NOT NULL,
  `CURRICULUM` varchar(400) DEFAULT NULL,
  `FOTO` varchar(2000) DEFAULT NULL,
  `ID_AREA` bigint(20) NOT NULL,
  `CONTRASENA` varchar(255) NOT NULL,
  `VENCIMIENTO_USUARIO` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `VENCIMIENTO_TOKEN` datetime NOT NULL,
  `TOKEN` varchar(255) NOT NULL,
  `INTENTOS` int(1) NOT NULL,
  `CANT_PREGUNTAS` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tbl_usuarios`
--

INSERT INTO `tbl_usuarios` (`ID_USUARIO`, `ID_ROL`, `ID_ESTADO_USUARIO`, `NOMBRE`, `APELLIDO`, `USUARIO`, `CORREO`, `ID_GENERO`, `DNI`, `ID_PROFESION`, `DIRECCION`, `CELULAR`, `REFERENCIA`, `CEL_REFERENCIA`, `EXPERIENCIA_LABORAL`, `CURRICULUM`, `FOTO`, `ID_AREA`, `CONTRASENA`, `VENCIMIENTO_USUARIO`, `VENCIMIENTO_TOKEN`, `TOKEN`, `INTENTOS`, `CANT_PREGUNTAS`) VALUES
(31, 3, 1, 'WILER', 'CABRERA', 'ADMINISTRADOR', 'wilmer.cabrera@unah.hn', 3, '4566667687766', 9, 'DIRECCION', 23345678, 'REFERENCIA', 23456789, 'EXPERIENCIA', '../../curriculum/1659412956_Diagrama de base de datos.pdf', '../../imagenes/1663031669_Penguins.jpg', 1, 'd727091b60eab588f1c83cc478ef4862b663b57f743754140010b9e964dbf1004c8a595a1758605cce7bb4aed838b5ad549c045cff02c9bcb362941c1d223cf6', '2022-11-14 00:26:13', '2022-11-14 18:26:10', '117dadc1b95d5cefd7c7946ceef90a4dd06ae11938fd8a84d842b3126dc0e1c9dbac60186698fd872d4e088ff5ffb563972ae3f133c1a62a584a14b091722611', 0, 2),
(35, 6, 1, 'INFORMATICA', 'INFORMATICA', 'INFORMATICA', 'odfloress@unah.hn', 3, '080120002999999', 7, 'INFORMATICA', 77765553, 'REFERENCIAS', 87563456, 'INFORMATICA', '../../curriculum///1665850624_Tema 2 ConsultoriÌa.pdf', '../../imagenes/1665850624_Lighthouse.jpg', 1, 'd727091b60eab588f1c83cc478ef4862b663b57f743754140010b9e964dbf1004c8a595a1758605cce7bb4aed838b5ad549c045cff02c9bcb362941c1d223cf6', '2022-11-12 04:46:54', '2022-10-16 10:24:31', 'f52467ccf1bd5f20066796b5bf6f0aa074ed2feb6a3602fb5a644ca9e9d0b70eca98cb5ae21e9425a893a51fa4912283c9de2db8b9cf1ebcfebf11e99e22b076', 0, 2),
(37, 4, 1, 'NOMBRE', 'APELLIDO', 'USUARIOS', 'correo@unah.hn', 3, '7654321234567', 5, 'DIRECC', 12123123, 'REFERENCIA', 22222222, 'EXPERIENCIA', '../../curriculum//1666056938_Tema 2 Consultoría.pdf', '../../imagenes/1666056938_Lighthouse.jpg', 1, '6dc8f0c745743812048e3f6ea7ebca26581e1621f95521c17e6b1e93b2e66f603eb67c81c785bd2187d26576525bcb8ae0a058938eb3253b0dc9813af55a10f6', '2022-10-18 01:41:10', '0000-00-00 00:00:00', '', 0, 2),
(40, 3, 1, 'FAVIEL', 'CRUZ', 'FAVIEL', 'cruzfaviel@gmail.com', 3, '0801200012345', 7, 'TGU', 96325874, 'QWERTY', 95236541, 'NINGUNA', '', '', 1, '18194c2449030e3aa9d6547c81c64dcb72efd98102d660a4f4a4f8e0ac64b1c592596649fade8ee57d367f4debeffbd74ece32dea5184def245982679b6517d4', '2022-10-31 22:18:37', '2022-11-01 16:16:50', '37f669f1dc9f1bb09225ba7152b9016d705b071e8505dd29bec93af0a69f517da0cb737084f417a432c60794974e33b338e59355d5977c8ac9a123ac83bde38c', 0, 2),
(41, 4, 1, 'SAMUEL', 'SA', 'USUARIOSSS', 'correosunah@unah.hn', 3, '3423423423545', 5, 'DEQWQ', 34432342, 'SAASDASd', 23423423, 'ASDASDAS', '../../curriculum/1668476046_Unidad 1 - Creación de Tablas y Bases de Datos.pdf', '../../imagenes/1668476046_Lighthouse.jpg', 1, '6dc8f0c745743812048e3f6ea7ebca26581e1621f95521c17e6b1e93b2e66f603eb67c81c785bd2187d26576525bcb8ae0a058938eb3253b0dc9813af55a10f6', '2022-11-15 01:34:06', '0000-00-00 00:00:00', '', 0, 0),
(42, 4, 1, 'NOMBRESS', 'APELLIDOSS', 'USUARIOO', 'coress@unah.hnn', 3, '7656544323121', 5, 'FDESA', 54331222, 'FDSASD', 74322221, 'FDSA', '../../curriculum//1669049990_Glosario unidad 5.pdf', '../../imagenes/1669049990_Koala.jpg', 1, 'd727091b60eab588f1c83cc478ef4862b663b57f743754140010b9e964dbf1004c8a595a1758605cce7bb4aed838b5ad549c045cff02c9bcb362941c1d223cf6', '2022-11-21 17:03:42', '0000-00-00 00:00:00', '', 0, 2);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `tbl_areas`
--
ALTER TABLE `tbl_areas`
  ADD PRIMARY KEY (`ID_AREA`);

--
-- Indices de la tabla `tbl_asignaciones`
--
ALTER TABLE `tbl_asignaciones`
  ADD PRIMARY KEY (`ID_ASIGNADO`),
  ADD KEY `ID_PROYECTO` (`ID_PROYECTO`),
  ADD KEY `ID_USUARIO` (`ID_USUARIO`),
  ADD KEY `ID_PRODUCTOS` (`ID_PRODUCTOS`),
  ADD KEY `ID_ESTADO_ASIGNACION` (`ID_ESTADO_ASIGNACION`);

--
-- Indices de la tabla `tbl_bienvenida_portafolio`
--
ALTER TABLE `tbl_bienvenida_portafolio`
  ADD PRIMARY KEY (`ID_IMAGEN`);

--
-- Indices de la tabla `tbl_bitacora`
--
ALTER TABLE `tbl_bitacora`
  ADD PRIMARY KEY (`ID_BITACORA`);

--
-- Indices de la tabla `tbl_catalogo`
--
ALTER TABLE `tbl_catalogo`
  ADD PRIMARY KEY (`ID_CATALOGO`);

--
-- Indices de la tabla `tbl_categoria_producto`
--
ALTER TABLE `tbl_categoria_producto`
  ADD PRIMARY KEY (`ID_CATEGORIA`);

--
-- Indices de la tabla `tbl_clientes`
--
ALTER TABLE `tbl_clientes`
  ADD PRIMARY KEY (`ID_CLIENTE`),
  ADD UNIQUE KEY `CORREO` (`CORREO`),
  ADD KEY `ID_GENERO` (`ID_GENERO`);

--
-- Indices de la tabla `tbl_compras`
--
ALTER TABLE `tbl_compras`
  ADD PRIMARY KEY (`ID_COMPRA`),
  ADD KEY `ID_PROVEEDOR` (`ID_PROVEEDOR`),
  ADD KEY `ID_PROVEEDOR_2` (`ID_PROVEEDOR`);

--
-- Indices de la tabla `tbl_departamentos`
--
ALTER TABLE `tbl_departamentos`
  ADD PRIMARY KEY (`ID_DEPARTAMENTO`);

--
-- Indices de la tabla `tbl_detalle_asignacion`
--
ALTER TABLE `tbl_detalle_asignacion`
  ADD PRIMARY KEY (`ID_DETALLE_ASIGNACION`),
  ADD KEY `ID_ASIGNADO` (`ID_ASIGNADO`),
  ADD KEY `ID_ASIGNADO_2` (`ID_ASIGNADO`),
  ADD KEY `ID_PRODUCTO` (`ID_PRODUCTO`),
  ADD KEY `ID_ESTADO_HERRAMIENTA` (`ID_ESTADO_HERRAMIENTA`),
  ADD KEY `ID_ESTADO_ASIGNACION` (`ID_ESTADO_ASIGNACION`);

--
-- Indices de la tabla `tbl_detalle_compra`
--
ALTER TABLE `tbl_detalle_compra`
  ADD PRIMARY KEY (`ID_DETALLE`),
  ADD KEY `ID_PRODUCTO` (`ID_PRODUCTO`),
  ADD KEY `ID_COMPRA` (`ID_COMPRA`),
  ADD KEY `ID_UNIDAD_MEDIDA` (`ID_UNIDAD_MEDIDA`);

--
-- Indices de la tabla `tbl_devoluciones`
--
ALTER TABLE `tbl_devoluciones`
  ADD PRIMARY KEY (`ID_DEVOLUCION`),
  ADD KEY `ID_PRODUCTO` (`ID_PRODUCTO`),
  ADD KEY `ID_PROVEEDOR` (`ID_PROVEEDOR`);

--
-- Indices de la tabla `tbl_estados_proyectos`
--
ALTER TABLE `tbl_estados_proyectos`
  ADD PRIMARY KEY (`ID_ESTADOS`);

--
-- Indices de la tabla `tbl_estado_asignacion`
--
ALTER TABLE `tbl_estado_asignacion`
  ADD PRIMARY KEY (`ID_ESTADO_ASIGNACION`);

--
-- Indices de la tabla `tbl_estado_herramienta`
--
ALTER TABLE `tbl_estado_herramienta`
  ADD PRIMARY KEY (`ID_ESTADO_HERRAMIENTA`);

--
-- Indices de la tabla `tbl_estado_usuario`
--
ALTER TABLE `tbl_estado_usuario`
  ADD PRIMARY KEY (`ID_ESTADO_USUARIO`);

--
-- Indices de la tabla `tbl_generos`
--
ALTER TABLE `tbl_generos`
  ADD PRIMARY KEY (`ID_GENERO`);

--
-- Indices de la tabla `tbl_inventario`
--
ALTER TABLE `tbl_inventario`
  ADD PRIMARY KEY (`ID_INVENTARIO`),
  ADD KEY `ID_PRODUCTOS` (`ID_PRODUCTOS`);

--
-- Indices de la tabla `tbl_kardex`
--
ALTER TABLE `tbl_kardex`
  ADD PRIMARY KEY (`ID_KARDEX`),
  ADD KEY `ID_PRODUCTO` (`ID_PRODUCTO`),
  ADD KEY `ID_COMPRA` (`ID_COMPRA`);

--
-- Indices de la tabla `tbl_ms_objetos`
--
ALTER TABLE `tbl_ms_objetos`
  ADD PRIMARY KEY (`ID_OBJETO`);

--
-- Indices de la tabla `tbl_ms_roles_ojetos`
--
ALTER TABLE `tbl_ms_roles_ojetos`
  ADD KEY `ID_ROL` (`ID_ROL`),
  ADD KEY `ID_ROL_2` (`ID_ROL`),
  ADD KEY `ID_OBJETO` (`ID_OBJETO`);

--
-- Indices de la tabla `tbl_parametros`
--
ALTER TABLE `tbl_parametros`
  ADD PRIMARY KEY (`ID_PARAMETRO`),
  ADD KEY `ID_USUARIO` (`ID_USUARIO`),
  ADD KEY `ID_USUARIO_2` (`ID_USUARIO`);

--
-- Indices de la tabla `tbl_portafolio`
--
ALTER TABLE `tbl_portafolio`
  ADD PRIMARY KEY (`ID_IMAGEN`),
  ADD KEY `ID_CATALOGO` (`ID_CATALOGO`);

--
-- Indices de la tabla `tbl_preguntas`
--
ALTER TABLE `tbl_preguntas`
  ADD PRIMARY KEY (`ID_PREGUNTA`);

--
-- Indices de la tabla `tbl_productos`
--
ALTER TABLE `tbl_productos`
  ADD PRIMARY KEY (`ID_PRODUCTO`),
  ADD KEY `ID_CATEGORIA` (`ID_CATEGORIA`);

--
-- Indices de la tabla `tbl_profesiones`
--
ALTER TABLE `tbl_profesiones`
  ADD PRIMARY KEY (`ID_PROFESION`);

--
-- Indices de la tabla `tbl_proveedores`
--
ALTER TABLE `tbl_proveedores`
  ADD PRIMARY KEY (`ID_PROVEEDOR`);

--
-- Indices de la tabla `tbl_proyectos`
--
ALTER TABLE `tbl_proyectos`
  ADD PRIMARY KEY (`ID_PROYECTO`),
  ADD KEY `FK_ID_CLIENTE` (`ID_CLIENTE`),
  ADD KEY `ID_ESTADO` (`ID_ESTADOS`),
  ADD KEY `ID_CLIENTE` (`ID_CLIENTE`),
  ADD KEY `ID_DEPARTAMENTO` (`ID_DEPARTAMENTO`),
  ADD KEY `ID_USUARIO` (`ID_USUARIO`);

--
-- Indices de la tabla `tbl_respuestas_usuario`
--
ALTER TABLE `tbl_respuestas_usuario`
  ADD PRIMARY KEY (`ID_RESPUESTA`),
  ADD KEY `ID_USUARIO` (`ID_PREGUNTA`),
  ADD KEY `ID_PREGUNTA` (`ID_PREGUNTA`),
  ADD KEY `ID_PREGUNTA_2` (`ID_PREGUNTA`),
  ADD KEY `ID_PREGUNTA_3` (`ID_PREGUNTA`);

--
-- Indices de la tabla `tbl_roles`
--
ALTER TABLE `tbl_roles`
  ADD PRIMARY KEY (`ID_ROL`);

--
-- Indices de la tabla `tbl_unidad_medida`
--
ALTER TABLE `tbl_unidad_medida`
  ADD PRIMARY KEY (`ID_UNIDAD_MEDIDA`);

--
-- Indices de la tabla `tbl_usuarios`
--
ALTER TABLE `tbl_usuarios`
  ADD PRIMARY KEY (`ID_USUARIO`),
  ADD UNIQUE KEY `DNI` (`DNI`),
  ADD KEY `ID_ESTADO_USUARIO` (`ID_ESTADO_USUARIO`),
  ADD KEY `ID_ROL` (`ID_ROL`),
  ADD KEY `ID_PROFESION` (`ID_PROFESION`),
  ADD KEY `ID_GENERO` (`ID_GENERO`),
  ADD KEY `ID_AREA` (`ID_AREA`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `tbl_areas`
--
ALTER TABLE `tbl_areas`
  MODIFY `ID_AREA` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `tbl_asignaciones`
--
ALTER TABLE `tbl_asignaciones`
  MODIFY `ID_ASIGNADO` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `tbl_bienvenida_portafolio`
--
ALTER TABLE `tbl_bienvenida_portafolio`
  MODIFY `ID_IMAGEN` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `tbl_bitacora`
--
ALTER TABLE `tbl_bitacora`
  MODIFY `ID_BITACORA` bigint(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `tbl_catalogo`
--
ALTER TABLE `tbl_catalogo`
  MODIFY `ID_CATALOGO` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `tbl_categoria_producto`
--
ALTER TABLE `tbl_categoria_producto`
  MODIFY `ID_CATEGORIA` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `tbl_clientes`
--
ALTER TABLE `tbl_clientes`
  MODIFY `ID_CLIENTE` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `tbl_compras`
--
ALTER TABLE `tbl_compras`
  MODIFY `ID_COMPRA` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `tbl_departamentos`
--
ALTER TABLE `tbl_departamentos`
  MODIFY `ID_DEPARTAMENTO` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de la tabla `tbl_detalle_asignacion`
--
ALTER TABLE `tbl_detalle_asignacion`
  MODIFY `ID_DETALLE_ASIGNACION` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `tbl_detalle_compra`
--
ALTER TABLE `tbl_detalle_compra`
  MODIFY `ID_DETALLE` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `tbl_devoluciones`
--
ALTER TABLE `tbl_devoluciones`
  MODIFY `ID_DEVOLUCION` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de la tabla `tbl_estados_proyectos`
--
ALTER TABLE `tbl_estados_proyectos`
  MODIFY `ID_ESTADOS` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `tbl_estado_asignacion`
--
ALTER TABLE `tbl_estado_asignacion`
  MODIFY `ID_ESTADO_ASIGNACION` bigint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `tbl_estado_herramienta`
--
ALTER TABLE `tbl_estado_herramienta`
  MODIFY `ID_ESTADO_HERRAMIENTA` bigint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `tbl_estado_usuario`
--
ALTER TABLE `tbl_estado_usuario`
  MODIFY `ID_ESTADO_USUARIO` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `tbl_generos`
--
ALTER TABLE `tbl_generos`
  MODIFY `ID_GENERO` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `tbl_inventario`
--
ALTER TABLE `tbl_inventario`
  MODIFY `ID_INVENTARIO` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `tbl_kardex`
--
ALTER TABLE `tbl_kardex`
  MODIFY `ID_KARDEX` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT de la tabla `tbl_ms_objetos`
--
ALTER TABLE `tbl_ms_objetos`
  MODIFY `ID_OBJETO` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT de la tabla `tbl_parametros`
--
ALTER TABLE `tbl_parametros`
  MODIFY `ID_PARAMETRO` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `tbl_portafolio`
--
ALTER TABLE `tbl_portafolio`
  MODIFY `ID_IMAGEN` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `tbl_preguntas`
--
ALTER TABLE `tbl_preguntas`
  MODIFY `ID_PREGUNTA` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `tbl_productos`
--
ALTER TABLE `tbl_productos`
  MODIFY `ID_PRODUCTO` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `tbl_profesiones`
--
ALTER TABLE `tbl_profesiones`
  MODIFY `ID_PROFESION` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `tbl_proveedores`
--
ALTER TABLE `tbl_proveedores`
  MODIFY `ID_PROVEEDOR` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `tbl_proyectos`
--
ALTER TABLE `tbl_proyectos`
  MODIFY `ID_PROYECTO` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `tbl_respuestas_usuario`
--
ALTER TABLE `tbl_respuestas_usuario`
  MODIFY `ID_RESPUESTA` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=109;

--
-- AUTO_INCREMENT de la tabla `tbl_roles`
--
ALTER TABLE `tbl_roles`
  MODIFY `ID_ROL` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `tbl_unidad_medida`
--
ALTER TABLE `tbl_unidad_medida`
  MODIFY `ID_UNIDAD_MEDIDA` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `tbl_usuarios`
--
ALTER TABLE `tbl_usuarios`
  MODIFY `ID_USUARIO` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `tbl_asignaciones`
--
ALTER TABLE `tbl_asignaciones`
  ADD CONSTRAINT `tbl_asignaciones_ibfk_1` FOREIGN KEY (`ID_PROYECTO`) REFERENCES `tbl_proyectos` (`ID_PROYECTO`),
  ADD CONSTRAINT `tbl_asignaciones_ibfk_2` FOREIGN KEY (`ID_USUARIO`) REFERENCES `tbl_usuarios` (`ID_USUARIO`),
  ADD CONSTRAINT `tbl_asignaciones_ibfk_3` FOREIGN KEY (`ID_PRODUCTOS`) REFERENCES `tbl_productos` (`ID_PRODUCTO`),
  ADD CONSTRAINT `tbl_asignaciones_ibfk_4` FOREIGN KEY (`ID_ESTADO_ASIGNACION`) REFERENCES `tbl_estado_asignacion` (`ID_ESTADO_ASIGNACION`);

--
-- Filtros para la tabla `tbl_clientes`
--
ALTER TABLE `tbl_clientes`
  ADD CONSTRAINT `tbl_clientes_ibfk_1` FOREIGN KEY (`ID_GENERO`) REFERENCES `tbl_generos` (`ID_GENERO`);

--
-- Filtros para la tabla `tbl_compras`
--
ALTER TABLE `tbl_compras`
  ADD CONSTRAINT `tbl_compras_ibfk_1` FOREIGN KEY (`ID_PROVEEDOR`) REFERENCES `tbl_proveedores` (`ID_PROVEEDOR`);

--
-- Filtros para la tabla `tbl_detalle_asignacion`
--
ALTER TABLE `tbl_detalle_asignacion`
  ADD CONSTRAINT `tbl_detalle_asignacion_ibfk_2` FOREIGN KEY (`ID_PRODUCTO`) REFERENCES `tbl_productos` (`ID_PRODUCTO`),
  ADD CONSTRAINT `tbl_detalle_asignacion_ibfk_3` FOREIGN KEY (`ID_ESTADO_HERRAMIENTA`) REFERENCES `tbl_estado_herramienta` (`ID_ESTADO_HERRAMIENTA`),
  ADD CONSTRAINT `tbl_detalle_asignacion_ibfk_4` FOREIGN KEY (`ID_ESTADO_ASIGNACION`) REFERENCES `tbl_estado_asignacion` (`ID_ESTADO_ASIGNACION`);

--
-- Filtros para la tabla `tbl_detalle_compra`
--
ALTER TABLE `tbl_detalle_compra`
  ADD CONSTRAINT `tbl_detalle_compra_ibfk_1` FOREIGN KEY (`ID_COMPRA`) REFERENCES `tbl_compras` (`ID_COMPRA`),
  ADD CONSTRAINT `tbl_detalle_compra_ibfk_2` FOREIGN KEY (`ID_PRODUCTO`) REFERENCES `tbl_productos` (`ID_PRODUCTO`),
  ADD CONSTRAINT `tbl_detalle_compra_ibfk_3` FOREIGN KEY (`ID_UNIDAD_MEDIDA`) REFERENCES `tbl_unidad_medida` (`ID_UNIDAD_MEDIDA`);

--
-- Filtros para la tabla `tbl_devoluciones`
--
ALTER TABLE `tbl_devoluciones`
  ADD CONSTRAINT `tbl_devoluciones_ibfk_1` FOREIGN KEY (`ID_PRODUCTO`) REFERENCES `tbl_productos` (`ID_PRODUCTO`),
  ADD CONSTRAINT `tbl_devoluciones_ibfk_2` FOREIGN KEY (`ID_PROVEEDOR`) REFERENCES `tbl_proveedores` (`ID_PROVEEDOR`);

--
-- Filtros para la tabla `tbl_inventario`
--
ALTER TABLE `tbl_inventario`
  ADD CONSTRAINT `tbl_inventario_ibfk_1` FOREIGN KEY (`ID_PRODUCTOS`) REFERENCES `tbl_productos` (`ID_PRODUCTO`);

--
-- Filtros para la tabla `tbl_kardex`
--
ALTER TABLE `tbl_kardex`
  ADD CONSTRAINT `tbl_kardex_ibfk_1` FOREIGN KEY (`ID_PRODUCTO`) REFERENCES `tbl_productos` (`ID_PRODUCTO`);

--
-- Filtros para la tabla `tbl_ms_roles_ojetos`
--
ALTER TABLE `tbl_ms_roles_ojetos`
  ADD CONSTRAINT `tbl_ms_roles_ojetos_ibfk_1` FOREIGN KEY (`ID_OBJETO`) REFERENCES `tbl_ms_objetos` (`ID_OBJETO`),
  ADD CONSTRAINT `tbl_ms_roles_ojetos_ibfk_2` FOREIGN KEY (`ID_ROL`) REFERENCES `tbl_roles` (`ID_ROL`);

--
-- Filtros para la tabla `tbl_parametros`
--
ALTER TABLE `tbl_parametros`
  ADD CONSTRAINT `tbl_parametros_ibfk_1` FOREIGN KEY (`ID_USUARIO`) REFERENCES `tbl_usuarios` (`ID_USUARIO`);

--
-- Filtros para la tabla `tbl_portafolio`
--
ALTER TABLE `tbl_portafolio`
  ADD CONSTRAINT `tbl_portafolio_ibfk_1` FOREIGN KEY (`ID_CATALOGO`) REFERENCES `tbl_catalogo` (`ID_CATALOGO`);

--
-- Filtros para la tabla `tbl_productos`
--
ALTER TABLE `tbl_productos`
  ADD CONSTRAINT `tbl_productos_ibfk_1` FOREIGN KEY (`ID_CATEGORIA`) REFERENCES `tbl_categoria_producto` (`ID_CATEGORIA`);

--
-- Filtros para la tabla `tbl_proyectos`
--
ALTER TABLE `tbl_proyectos`
  ADD CONSTRAINT `tbl_proyectos_ibfk_1` FOREIGN KEY (`ID_CLIENTE`) REFERENCES `tbl_clientes` (`ID_CLIENTE`),
  ADD CONSTRAINT `tbl_proyectos_ibfk_2` FOREIGN KEY (`ID_USUARIO`) REFERENCES `tbl_usuarios` (`ID_USUARIO`),
  ADD CONSTRAINT `tbl_proyectos_ibfk_3` FOREIGN KEY (`ID_ESTADOS`) REFERENCES `tbl_estados_proyectos` (`ID_ESTADOS`),
  ADD CONSTRAINT `tbl_proyectos_ibfk_4` FOREIGN KEY (`ID_DEPARTAMENTO`) REFERENCES `tbl_departamentos` (`ID_DEPARTAMENTO`);

--
-- Filtros para la tabla `tbl_respuestas_usuario`
--
ALTER TABLE `tbl_respuestas_usuario`
  ADD CONSTRAINT `tbl_respuestas_usuario_ibfk_1` FOREIGN KEY (`ID_PREGUNTA`) REFERENCES `tbl_preguntas` (`ID_PREGUNTA`);

--
-- Filtros para la tabla `tbl_usuarios`
--
ALTER TABLE `tbl_usuarios`
  ADD CONSTRAINT `tbl_usuarios_ibfk_1` FOREIGN KEY (`ID_ROL`) REFERENCES `tbl_roles` (`ID_ROL`),
  ADD CONSTRAINT `tbl_usuarios_ibfk_2` FOREIGN KEY (`ID_ESTADO_USUARIO`) REFERENCES `tbl_estado_usuario` (`ID_ESTADO_USUARIO`),
  ADD CONSTRAINT `tbl_usuarios_ibfk_3` FOREIGN KEY (`ID_GENERO`) REFERENCES `tbl_generos` (`ID_GENERO`),
  ADD CONSTRAINT `tbl_usuarios_ibfk_4` FOREIGN KEY (`ID_PROFESION`) REFERENCES `tbl_profesiones` (`ID_PROFESION`),
  ADD CONSTRAINT `tbl_usuarios_ibfk_5` FOREIGN KEY (`ID_AREA`) REFERENCES `tbl_areas` (`ID_AREA`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
