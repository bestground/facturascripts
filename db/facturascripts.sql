-- phpMyAdmin SQL Dump
-- version 4.0.6
-- http://www.phpmyadmin.net
--
-- Servidor: localhost:3306
-- Tiempo de generación: 20-01-2015 a las 17:51:22
-- Versión del servidor: 5.5.32
-- Versión de PHP: 5.4.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `facturascripts`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `agentes`
--

CREATE TABLE IF NOT EXISTS `agentes` (
  `apellidos` varchar(100) COLLATE utf8_bin NOT NULL,
  `ciudad` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `codagente` varchar(10) COLLATE utf8_bin NOT NULL,
  `coddepartamento` varchar(6) COLLATE utf8_bin DEFAULT NULL,
  `codpais` varchar(20) COLLATE utf8_bin DEFAULT NULL,
  `codpostal` varchar(10) COLLATE utf8_bin DEFAULT NULL,
  `direccion` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `dnicif` varchar(15) COLLATE utf8_bin NOT NULL,
  `email` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `fax` varchar(15) COLLATE utf8_bin DEFAULT NULL,
  `idprovincia` int(11) DEFAULT NULL,
  `idusuario` varchar(30) COLLATE utf8_bin DEFAULT NULL,
  `irpf` double DEFAULT NULL,
  `nombre` varchar(50) COLLATE utf8_bin NOT NULL,
  `nombreap` varchar(150) COLLATE utf8_bin DEFAULT NULL,
  `porcomision` double DEFAULT NULL,
  `provincia` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `telefono` varchar(15) COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`codagente`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `agentes`
--

INSERT INTO `agentes` (`apellidos`, `ciudad`, `codagente`, `coddepartamento`, `codpais`, `codpostal`, `direccion`, `dnicif`, `email`, `fax`, `idprovincia`, `idusuario`, `irpf`, `nombre`, `nombreap`, `porcomision`, `provincia`, `telefono`) VALUES
('Pepe', NULL, '1', NULL, NULL, NULL, NULL, '00000014Z', NULL, NULL, NULL, NULL, NULL, 'Paco', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `albaranescli`
--

CREATE TABLE IF NOT EXISTS `albaranescli` (
  `apartado` varchar(10) COLLATE utf8_bin DEFAULT NULL,
  `cifnif` varchar(20) COLLATE utf8_bin NOT NULL,
  `ciudad` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `codagente` varchar(10) COLLATE utf8_bin DEFAULT NULL,
  `codalmacen` varchar(4) COLLATE utf8_bin DEFAULT NULL,
  `codcliente` varchar(6) COLLATE utf8_bin DEFAULT NULL,
  `coddir` int(11) DEFAULT NULL,
  `coddivisa` varchar(3) COLLATE utf8_bin NOT NULL,
  `codejercicio` varchar(4) COLLATE utf8_bin NOT NULL,
  `codigo` varchar(12) COLLATE utf8_bin NOT NULL,
  `codpago` varchar(10) COLLATE utf8_bin NOT NULL,
  `codpais` varchar(20) COLLATE utf8_bin DEFAULT NULL,
  `codpostal` varchar(10) COLLATE utf8_bin DEFAULT NULL,
  `codserie` varchar(2) COLLATE utf8_bin NOT NULL,
  `direccion` varchar(100) COLLATE utf8_bin NOT NULL,
  `fecha` date NOT NULL,
  `hora` time DEFAULT '00:00:00',
  `idalbaran` int(11) NOT NULL AUTO_INCREMENT,
  `idfactura` int(11) DEFAULT NULL,
  `idprovincia` int(11) DEFAULT NULL,
  `irpf` double NOT NULL DEFAULT '0',
  `neto` double NOT NULL DEFAULT '0',
  `nombrecliente` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `numero` varchar(12) COLLATE utf8_bin NOT NULL,
  `numero2` varchar(20) COLLATE utf8_bin DEFAULT NULL,
  `observaciones` text COLLATE utf8_bin,
  `porcomision` double DEFAULT NULL,
  `provincia` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `ptefactura` tinyint(1) NOT NULL DEFAULT '1',
  `recfinanciero` double NOT NULL DEFAULT '0',
  `tasaconv` double NOT NULL DEFAULT '1',
  `total` double NOT NULL DEFAULT '0',
  `totaleuros` double NOT NULL DEFAULT '0',
  `totalirpf` double NOT NULL DEFAULT '0',
  `totaliva` double NOT NULL DEFAULT '0',
  `totalrecargo` double NOT NULL DEFAULT '0',
  `total_bruto` double NOT NULL DEFAULT '0',
  `importe_iva` double NOT NULL DEFAULT '0',
  `total_factura` double NOT NULL DEFAULT '0',
  `pago_senor` double NOT NULL DEFAULT '0',
  PRIMARY KEY (`idalbaran`),
  UNIQUE KEY `uniq_codigo_albaranescli` (`codigo`),
  KEY `ca_albaranescli_series2` (`codserie`),
  KEY `ca_albaranescli_ejercicios2` (`codejercicio`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=28 ;

--
-- Volcado de datos para la tabla `albaranescli`
--

INSERT INTO `albaranescli` (`apartado`, `cifnif`, `ciudad`, `codagente`, `codalmacen`, `codcliente`, `coddir`, `coddivisa`, `codejercicio`, `codigo`, `codpago`, `codpais`, `codpostal`, `codserie`, `direccion`, `fecha`, `hora`, `idalbaran`, `idfactura`, `idprovincia`, `irpf`, `neto`, `nombrecliente`, `numero`, `numero2`, `observaciones`, `porcomision`, `provincia`, `ptefactura`, `recfinanciero`, `tasaconv`, `total`, `totaleuros`, `totalirpf`, `totaliva`, `totalrecargo`, `total_bruto`, `importe_iva`, `total_factura`, `pago_senor`) VALUES
('', '9778568a', 'León', '1', 'ALG', '000001', 1, 'EUR', '0001', '00010A000024', 'CONT', 'ESP', '24007', 'A', 'C/ Padre Risco', '2015-01-21', '01:59:28', 24, NULL, NULL, 0, 0, 'cliente prueba', '24', '', '', 0, 'León', 1, 0, 1, 0, 0, 0, 0, 0, 32.39, 6.8, 39.19, 90.36),
('', '9778568a', 'León', '1', 'ALG', '000001', 1, 'EUR', '0001', '00010A000025', 'CONT', 'ESP', '24007', 'A', 'C/ Padre Risco', '2015-01-21', '02:05:44', 25, NULL, NULL, 0, 0, 'cliente prueba', '25', '', '', 0, 'León', 1, 0, 1, 0, 0, 0, 0, 0, 71.75, 15.07, 86.82, 200.18),
('', '9778568a', 'León', '1', 'ALG', '000001', 1, 'EUR', '0001', '00010A000026', 'CONT', 'ESP', '24007', 'A', 'C/ Padre Risco', '2015-01-21', '02:23:50', 26, NULL, NULL, 0, 88.55, 'cliente prueba', '26', NULL, '', 0, 'León', 1, 0, 1, 88.55, 88.55, 0, 0, 0, 22.14, 4.65, 26.79, 61.76),
('', '9778568a', 'León', '1', 'ALG', '000001', 1, 'EUR', '0001', '00010A000027', 'CONT', 'ESP', '24007', 'A', 'C/ Padre Risco', '2015-01-21', '02:36:01', 27, NULL, NULL, 0, 0, 'cliente prueba', '27', '', '', 0, 'León', 1, 0, 1, 0, 0, 0, 0, 0, 5.13, 1.08, 6.21, 14.29);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `albaranesprov`
--

CREATE TABLE IF NOT EXISTS `albaranesprov` (
  `cifnif` varchar(20) COLLATE utf8_bin NOT NULL,
  `codagente` varchar(10) COLLATE utf8_bin DEFAULT NULL,
  `codalmacen` varchar(4) COLLATE utf8_bin DEFAULT NULL,
  `coddivisa` varchar(3) COLLATE utf8_bin NOT NULL,
  `codejercicio` varchar(4) COLLATE utf8_bin NOT NULL,
  `codigo` varchar(12) COLLATE utf8_bin NOT NULL,
  `codpago` varchar(10) COLLATE utf8_bin DEFAULT NULL,
  `codproveedor` varchar(6) COLLATE utf8_bin DEFAULT NULL,
  `codserie` varchar(2) COLLATE utf8_bin NOT NULL,
  `fecha` date NOT NULL,
  `hora` time NOT NULL DEFAULT '00:00:00',
  `idalbaran` int(11) NOT NULL AUTO_INCREMENT,
  `idfactura` int(11) DEFAULT NULL,
  `irpf` double NOT NULL DEFAULT '0',
  `neto` double NOT NULL DEFAULT '0',
  `nombre` varchar(100) COLLATE utf8_bin NOT NULL,
  `numero` varchar(12) COLLATE utf8_bin NOT NULL,
  `numproveedor` varchar(20) COLLATE utf8_bin DEFAULT NULL,
  `observaciones` text COLLATE utf8_bin,
  `ptefactura` tinyint(1) NOT NULL DEFAULT '1',
  `recfinanciero` double NOT NULL DEFAULT '0',
  `tasaconv` double NOT NULL DEFAULT '1',
  `total` double NOT NULL DEFAULT '0',
  `totaleuros` double NOT NULL DEFAULT '0',
  `totalirpf` double NOT NULL DEFAULT '0',
  `totaliva` double NOT NULL DEFAULT '0',
  `totalrecargo` double NOT NULL DEFAULT '0',
  PRIMARY KEY (`idalbaran`),
  UNIQUE KEY `uniq_codigo_albaranesprov` (`codigo`),
  KEY `ca_albaranesprov_series2` (`codserie`),
  KEY `ca_albaranesprov_ejercicios2` (`codejercicio`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `almacenes`
--

CREATE TABLE IF NOT EXISTS `almacenes` (
  `apartado` varchar(10) COLLATE utf8_bin DEFAULT NULL,
  `codalmacen` varchar(4) COLLATE utf8_bin NOT NULL,
  `codpais` varchar(20) COLLATE utf8_bin DEFAULT NULL,
  `codpostal` varchar(10) COLLATE utf8_bin DEFAULT NULL,
  `contacto` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `direccion` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `fax` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `idprovincia` int(11) DEFAULT NULL,
  `nombre` varchar(100) COLLATE utf8_bin NOT NULL,
  `observaciones` text COLLATE utf8_bin,
  `poblacion` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `porpvp` double DEFAULT NULL,
  `provincia` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `telefono` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `tipovaloracion` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`codalmacen`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `almacenes`
--

INSERT INTO `almacenes` (`apartado`, `codalmacen`, `codpais`, `codpostal`, `contacto`, `direccion`, `fax`, `idprovincia`, `nombre`, `observaciones`, `poblacion`, `porpvp`, `provincia`, `telefono`, `tipovaloracion`) VALUES
(NULL, 'ALG', NULL, '', '', '', '', NULL, 'ALMACEN GENERAL', NULL, '', NULL, NULL, '', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `articulos`
--

CREATE TABLE IF NOT EXISTS `articulos` (
  `factualizado` date DEFAULT NULL,
  `destacado` tinyint(1) DEFAULT '0',
  `bloqueado` tinyint(1) DEFAULT '0',
  `equivalencia` varchar(18) COLLATE utf8_bin DEFAULT NULL,
  `idsubcuentairpfcom` int(11) DEFAULT NULL,
  `idsubcuentacom` int(11) DEFAULT NULL,
  `stockmin` double DEFAULT '0',
  `observaciones` text COLLATE utf8_bin,
  `codbarras` varchar(18) COLLATE utf8_bin DEFAULT NULL,
  `codimpuesto` varchar(10) COLLATE utf8_bin DEFAULT NULL,
  `stockfis` double DEFAULT '0',
  `stockmax` double DEFAULT '0',
  `costemedio` double DEFAULT '0',
  `preciocoste` double DEFAULT '0',
  `tipocodbarras` varchar(8) COLLATE utf8_bin DEFAULT 'Code39',
  `nostock` tinyint(1) DEFAULT NULL,
  `codsubcuentacom` varchar(15) COLLATE utf8_bin DEFAULT NULL,
  `descripcion` varchar(100) COLLATE utf8_bin NOT NULL,
  `codsubcuentairpfcom` varchar(15) COLLATE utf8_bin DEFAULT NULL,
  `secompra` tinyint(1) DEFAULT NULL,
  `codfamilia` varchar(4) COLLATE utf8_bin DEFAULT NULL,
  `imagen` text COLLATE utf8_bin,
  `controlstock` tinyint(1) DEFAULT '0',
  `referencia` varchar(18) COLLATE utf8_bin NOT NULL,
  `pvp` double DEFAULT '0',
  `sevende` tinyint(1) DEFAULT NULL,
  `publico` tinyint(1) DEFAULT '0',
  `dueno` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `telefonodueno` varchar(30) COLLATE utf8_bin DEFAULT NULL,
  `tipodni` varchar(25) COLLATE utf8_bin DEFAULT 'DNI',
  `fentrada` date DEFAULT NULL,
  `fsalida` date DEFAULT NULL,
  PRIMARY KEY (`referencia`),
  KEY `ca_articulos_impuestos2` (`codimpuesto`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `articulos`
--

INSERT INTO `articulos` (`factualizado`, `destacado`, `bloqueado`, `equivalencia`, `idsubcuentairpfcom`, `idsubcuentacom`, `stockmin`, `observaciones`, `codbarras`, `codimpuesto`, `stockfis`, `stockmax`, `costemedio`, `preciocoste`, `tipocodbarras`, `nostock`, `codsubcuentacom`, `descripcion`, `codsubcuentairpfcom`, `secompra`, `codfamilia`, `imagen`, `controlstock`, `referencia`, `pvp`, `sevende`, `publico`, `dueno`, `telefonodueno`, `tipodni`, `fentrada`, `fsalida`) VALUES
('2015-01-20', 0, 0, NULL, NULL, NULL, 0, '', '', 'IVA21', 0, 0, 0, 0, 'Code39', NULL, NULL, 'REF2', NULL, 1, 'VARI', NULL, 1, 'REF2', 20.5, 1, 0, '', '', '', '2015-01-20', '2015-01-20'),
('2015-01-19', 0, 0, NULL, NULL, NULL, 0, '', '', 'IVA21', 2, 0, 0, 0, 'Code39', NULL, NULL, 'Artículo Borrame', NULL, 1, 'VARI', NULL, 1, 'REF3', 88.55, 1, 0, '', '', '', '2015-01-18', '2015-01-18'),
('2015-01-21', 0, 0, NULL, NULL, NULL, 0, '', '', 'IVA21', 0, 0, 0, 0, 'Code39', NULL, NULL, 'ref11', NULL, 1, 'VARI', NULL, 1, 'ref11', 11.22, 1, 0, '', '', '', '2015-01-21', '2015-01-21');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `articulostarifas`
--

CREATE TABLE IF NOT EXISTS `articulostarifas` (
  `codtarifa` varchar(6) COLLATE utf8_bin NOT NULL,
  `descuento` double NOT NULL DEFAULT '0',
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pvp` double DEFAULT NULL,
  `referencia` varchar(18) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uniq_articulostarifas_tarif_ref` (`codtarifa`,`referencia`),
  KEY `ca_articulostarifas_articulos2` (`referencia`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cajas`
--

CREATE TABLE IF NOT EXISTS `cajas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fs_id` int(11) NOT NULL,
  `codagente` varchar(10) COLLATE utf8_bin NOT NULL,
  `f_inicio` timestamp NOT NULL ON UPDATE CURRENT_TIMESTAMP,
  `d_inicio` double NOT NULL DEFAULT '0',
  `f_fin` timestamp NULL DEFAULT NULL,
  `d_fin` double DEFAULT NULL,
  `tickets` int(11) DEFAULT NULL,
  `ip` varchar(40) COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ca_cajas_agentes2` (`codagente`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `cajas`
--

INSERT INTO `cajas` (`id`, `fs_id`, `codagente`, `f_inicio`, `d_inicio`, `f_fin`, `d_fin`, `tickets`, `ip`) VALUES
(1, 1, '1', '2015-01-18 20:10:13', 0, NULL, 0, 0, '::1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE IF NOT EXISTS `clientes` (
  `capitalimpagado` double DEFAULT NULL,
  `cifnif` varchar(20) COLLATE utf8_bin NOT NULL,
  `codagente` varchar(10) COLLATE utf8_bin DEFAULT NULL,
  `codcliente` varchar(6) COLLATE utf8_bin NOT NULL,
  `codcontacto` varchar(6) COLLATE utf8_bin DEFAULT NULL,
  `codcuentadom` varchar(6) COLLATE utf8_bin DEFAULT NULL,
  `codcuentarem` varchar(6) COLLATE utf8_bin DEFAULT NULL,
  `coddivisa` varchar(3) COLLATE utf8_bin DEFAULT NULL,
  `codedi` varchar(17) COLLATE utf8_bin DEFAULT NULL,
  `codgrupo` varchar(6) COLLATE utf8_bin DEFAULT NULL,
  `codpago` varchar(10) COLLATE utf8_bin DEFAULT NULL,
  `codserie` varchar(2) COLLATE utf8_bin NOT NULL,
  `codsubcuenta` varchar(15) COLLATE utf8_bin DEFAULT NULL,
  `codtiporappel` varchar(10) COLLATE utf8_bin DEFAULT NULL,
  `contacto` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `copiasfactura` int(11) DEFAULT NULL,
  `debaja` tinyint(1) DEFAULT NULL,
  `email` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `fax` varchar(30) COLLATE utf8_bin DEFAULT NULL,
  `fechabaja` date DEFAULT NULL,
  `idsubcuenta` int(11) DEFAULT NULL,
  `ivaincluido` tinyint(1) DEFAULT NULL,
  `nombre` varchar(100) COLLATE utf8_bin NOT NULL,
  `nombrecomercial` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `observaciones` text COLLATE utf8_bin,
  `recargo` tinyint(1) DEFAULT NULL,
  `regimeniva` varchar(20) COLLATE utf8_bin DEFAULT NULL,
  `riesgoalcanzado` double DEFAULT NULL,
  `riesgomax` double DEFAULT NULL,
  `telefono1` varchar(30) COLLATE utf8_bin DEFAULT NULL,
  `telefono2` varchar(30) COLLATE utf8_bin DEFAULT NULL,
  `tipoidfiscal` varchar(25) COLLATE utf8_bin NOT NULL DEFAULT 'NIF',
  `web` varchar(250) COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`codcliente`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`capitalimpagado`, `cifnif`, `codagente`, `codcliente`, `codcontacto`, `codcuentadom`, `codcuentarem`, `coddivisa`, `codedi`, `codgrupo`, `codpago`, `codserie`, `codsubcuenta`, `codtiporappel`, `contacto`, `copiasfactura`, `debaja`, `email`, `fax`, `fechabaja`, `idsubcuenta`, `ivaincluido`, `nombre`, `nombrecomercial`, `observaciones`, `recargo`, `regimeniva`, `riesgoalcanzado`, `riesgomax`, `telefono1`, `telefono2`, `tipoidfiscal`, `web`) VALUES
(NULL, '9778568a', NULL, '000001', NULL, NULL, NULL, 'EUR', NULL, NULL, 'CONT', 'A', NULL, NULL, NULL, NULL, 0, '', '', NULL, NULL, NULL, 'cliente prueba', 'cliente prueba', '', 0, 'General', NULL, NULL, '', '', 'NIF', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `co_asientos`
--

CREATE TABLE IF NOT EXISTS `co_asientos` (
  `codejercicio` varchar(4) COLLATE utf8_bin NOT NULL,
  `codplanasiento` varchar(20) COLLATE utf8_bin DEFAULT NULL,
  `concepto` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `documento` varchar(30) COLLATE utf8_bin DEFAULT NULL,
  `editable` tinyint(1) NOT NULL,
  `fecha` date NOT NULL,
  `idasiento` int(11) NOT NULL AUTO_INCREMENT,
  `idconcepto` varchar(4) COLLATE utf8_bin DEFAULT NULL,
  `importe` double DEFAULT NULL,
  `numero` int(11) NOT NULL,
  `tipodocumento` varchar(25) COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`idasiento`),
  KEY `ca_co_asientos_ejercicios2` (`codejercicio`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `co_codbalances08`
--

CREATE TABLE IF NOT EXISTS `co_codbalances08` (
  `descripcion4ba` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `descripcion4` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `nivel4` varchar(5) COLLATE utf8_bin DEFAULT NULL,
  `descripcion3` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `orden3` varchar(5) COLLATE utf8_bin DEFAULT NULL,
  `nivel3` varchar(5) COLLATE utf8_bin DEFAULT NULL,
  `descripcion2` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `nivel2` int(11) DEFAULT NULL,
  `descripcion1` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `nivel1` varchar(5) COLLATE utf8_bin DEFAULT NULL,
  `naturaleza` varchar(15) COLLATE utf8_bin NOT NULL,
  `codbalance` varchar(15) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`codbalance`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `co_conceptospar`
--

CREATE TABLE IF NOT EXISTS `co_conceptospar` (
  `concepto` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `idconceptopar` varchar(4) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`idconceptopar`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `co_cuentas`
--

CREATE TABLE IF NOT EXISTS `co_cuentas` (
  `codbalance` varchar(15) COLLATE utf8_bin DEFAULT NULL,
  `codcuenta` varchar(6) COLLATE utf8_bin NOT NULL,
  `codejercicio` varchar(4) COLLATE utf8_bin NOT NULL,
  `codepigrafe` varchar(6) COLLATE utf8_bin NOT NULL,
  `descripcion` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `idcuenta` int(11) NOT NULL AUTO_INCREMENT,
  `idcuentaesp` varchar(6) COLLATE utf8_bin DEFAULT NULL,
  `idepigrafe` int(11) NOT NULL,
  PRIMARY KEY (`idcuenta`),
  KEY `ca_co_cuentas_ejercicios` (`codejercicio`),
  KEY `ca_co_cuentas_epigrafes2` (`idepigrafe`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `co_cuentasesp`
--

CREATE TABLE IF NOT EXISTS `co_cuentasesp` (
  `codcuenta` varchar(6) COLLATE utf8_bin DEFAULT NULL,
  `codsubcuenta` varchar(15) COLLATE utf8_bin DEFAULT NULL,
  `descripcion` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `idcuentaesp` varchar(6) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`idcuentaesp`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `co_epigrafes`
--

CREATE TABLE IF NOT EXISTS `co_epigrafes` (
  `codejercicio` varchar(4) COLLATE utf8_bin NOT NULL,
  `codepigrafe` varchar(6) COLLATE utf8_bin NOT NULL,
  `descripcion` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `idepigrafe` int(11) NOT NULL AUTO_INCREMENT,
  `idgrupo` int(11) DEFAULT NULL,
  `idpadre` int(11) DEFAULT NULL,
  PRIMARY KEY (`idepigrafe`),
  KEY `ca_co_epigrafes_ejercicios` (`codejercicio`),
  KEY `ca_co_epigrafes_gruposepigrafes2` (`idgrupo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `co_gruposepigrafes`
--

CREATE TABLE IF NOT EXISTS `co_gruposepigrafes` (
  `codejercicio` varchar(4) COLLATE utf8_bin NOT NULL,
  `codgrupo` varchar(6) COLLATE utf8_bin NOT NULL,
  `descripcion` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `idgrupo` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`idgrupo`),
  KEY `ca_co_gruposepigrafes_ejercicios` (`codejercicio`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `co_regiva`
--

CREATE TABLE IF NOT EXISTS `co_regiva` (
  `codejercicio` varchar(4) COLLATE utf8_bin NOT NULL,
  `codsubcuentaacr` varchar(15) COLLATE utf8_bin DEFAULT NULL,
  `codsubcuentadeu` varchar(15) COLLATE utf8_bin DEFAULT NULL,
  `fechaasiento` date NOT NULL,
  `fechafin` date NOT NULL,
  `fechainicio` date NOT NULL,
  `idasiento` int(11) NOT NULL,
  `idregiva` int(11) NOT NULL AUTO_INCREMENT,
  `idsubcuentaacr` int(11) DEFAULT NULL,
  `idsubcuentadeu` int(11) DEFAULT NULL,
  `periodo` varchar(8) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`idregiva`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `co_secuencias`
--

CREATE TABLE IF NOT EXISTS `co_secuencias` (
  `codejercicio` varchar(4) COLLATE utf8_bin NOT NULL,
  `descripcion` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `idsecuencia` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) COLLATE utf8_bin NOT NULL,
  `valor` int(11) DEFAULT NULL,
  `valorout` int(11) DEFAULT NULL,
  PRIMARY KEY (`idsecuencia`),
  KEY `ca_co_secuencias_ejercicios` (`codejercicio`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `co_subcuentas`
--

CREATE TABLE IF NOT EXISTS `co_subcuentas` (
  `codcuenta` varchar(6) COLLATE utf8_bin NOT NULL,
  `coddivisa` varchar(3) COLLATE utf8_bin NOT NULL,
  `codejercicio` varchar(4) COLLATE utf8_bin NOT NULL,
  `codimpuesto` varchar(10) COLLATE utf8_bin DEFAULT NULL,
  `codsubcuenta` varchar(15) COLLATE utf8_bin NOT NULL,
  `debe` double NOT NULL,
  `descripcion` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `haber` double NOT NULL,
  `idcuenta` int(11) DEFAULT NULL,
  `idsubcuenta` int(11) NOT NULL AUTO_INCREMENT,
  `iva` double NOT NULL,
  `recargo` double NOT NULL,
  `saldo` double NOT NULL,
  PRIMARY KEY (`idsubcuenta`),
  KEY `ca_co_subcuentas_ejercicios` (`codejercicio`),
  KEY `ca_co_subcuentas_cuentas2` (`idcuenta`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `co_subcuentascli`
--

CREATE TABLE IF NOT EXISTS `co_subcuentascli` (
  `codcliente` varchar(6) COLLATE utf8_bin DEFAULT NULL,
  `codejercicio` varchar(4) COLLATE utf8_bin NOT NULL,
  `codsubcuenta` varchar(15) COLLATE utf8_bin NOT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idsubcuenta` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `ca_co_subcuentascli_ejercicios2` (`codejercicio`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cuentasbanco`
--

CREATE TABLE IF NOT EXISTS `cuentasbanco` (
  `sufijo` varchar(3) COLLATE utf8_bin DEFAULT NULL,
  `ctaagencia` varchar(4) COLLATE utf8_bin NOT NULL,
  `idsubcuentaecgc` int(11) DEFAULT NULL,
  `ctaentidad` varchar(4) COLLATE utf8_bin NOT NULL,
  `entidad` varchar(4) COLLATE utf8_bin DEFAULT NULL,
  `agencia` varchar(4) COLLATE utf8_bin DEFAULT NULL,
  `codsubcuenta` varchar(15) COLLATE utf8_bin DEFAULT NULL,
  `cuenta` varchar(10) COLLATE utf8_bin NOT NULL,
  `descripcion` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `codsubcuentaecgc` varchar(15) COLLATE utf8_bin DEFAULT NULL,
  `iban` varchar(34) COLLATE utf8_bin DEFAULT NULL,
  `codcuenta` varchar(6) COLLATE utf8_bin NOT NULL,
  `idsubcuenta` int(11) DEFAULT NULL,
  `swift` varchar(11) COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`codcuenta`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cuentasbcocli`
--

CREATE TABLE IF NOT EXISTS `cuentasbcocli` (
  `descripcion` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `swift` varchar(11) COLLATE utf8_bin DEFAULT NULL,
  `ctaentidad` varchar(4) COLLATE utf8_bin DEFAULT NULL,
  `iban` varchar(34) COLLATE utf8_bin DEFAULT NULL,
  `agencia` varchar(4) COLLATE utf8_bin DEFAULT NULL,
  `entidad` varchar(4) COLLATE utf8_bin DEFAULT NULL,
  `codcliente` varchar(6) COLLATE utf8_bin NOT NULL,
  `ctaagencia` varchar(4) COLLATE utf8_bin DEFAULT NULL,
  `codcuenta` varchar(6) COLLATE utf8_bin NOT NULL,
  `cuenta` varchar(10) COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`codcuenta`),
  KEY `ca_cuentasbcocli_clientes` (`codcliente`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cuentasbcopro`
--

CREATE TABLE IF NOT EXISTS `cuentasbcopro` (
  `agencia` varchar(4) COLLATE utf8_bin DEFAULT NULL,
  `codcuenta` varchar(6) COLLATE utf8_bin NOT NULL,
  `codproveedor` varchar(6) COLLATE utf8_bin NOT NULL,
  `ctaagencia` varchar(4) COLLATE utf8_bin DEFAULT NULL,
  `ctaentidad` varchar(4) COLLATE utf8_bin DEFAULT NULL,
  `cuenta` varchar(10) COLLATE utf8_bin DEFAULT NULL,
  `descripcion` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `entidad` varchar(4) COLLATE utf8_bin DEFAULT NULL,
  `iban` varchar(34) COLLATE utf8_bin DEFAULT NULL,
  `swift` varchar(11) COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`codcuenta`),
  KEY `ca_cuentasbcopro_proveedores` (`codproveedor`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dirclientes`
--

CREATE TABLE IF NOT EXISTS `dirclientes` (
  `codcliente` varchar(6) COLLATE utf8_bin NOT NULL,
  `codpais` varchar(20) COLLATE utf8_bin DEFAULT NULL,
  `apartado` varchar(10) COLLATE utf8_bin DEFAULT NULL,
  `idprovincia` int(11) DEFAULT NULL,
  `provincia` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `ciudad` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `codpostal` varchar(10) COLLATE utf8_bin DEFAULT NULL,
  `direccion` varchar(100) COLLATE utf8_bin NOT NULL,
  `domenvio` tinyint(1) DEFAULT NULL,
  `domfacturacion` tinyint(1) DEFAULT NULL,
  `descripcion` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`),
  KEY `ca_dirclientes_clientes` (`codcliente`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `dirclientes`
--

INSERT INTO `dirclientes` (`codcliente`, `codpais`, `apartado`, `idprovincia`, `provincia`, `ciudad`, `codpostal`, `direccion`, `domenvio`, `domfacturacion`, `descripcion`, `id`) VALUES
('000001', 'ESP', '', NULL, 'León', 'León', '24007', 'C/ Padre Risco', 1, 1, 'Principal', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `divisas`
--

CREATE TABLE IF NOT EXISTS `divisas` (
  `bandera` text COLLATE utf8_bin,
  `coddivisa` varchar(3) COLLATE utf8_bin NOT NULL,
  `codiso` varchar(3) COLLATE utf8_bin DEFAULT NULL,
  `descripcion` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `simbolo` varchar(10) COLLATE utf8_bin DEFAULT NULL,
  `tasaconv` double NOT NULL,
  PRIMARY KEY (`coddivisa`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `divisas`
--

INSERT INTO `divisas` (`bandera`, `coddivisa`, `codiso`, `descripcion`, `fecha`, `simbolo`, `tasaconv`) VALUES
(NULL, 'EUR', '978', 'EUROS', NULL, '€', 1),
(NULL, 'USD', '840', 'DÓLARES EE.UU.', NULL, '$', 1.36);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ejercicios`
--

CREATE TABLE IF NOT EXISTS `ejercicios` (
  `idasientocierre` int(11) DEFAULT NULL,
  `idasientopyg` int(11) DEFAULT NULL,
  `idasientoapertura` int(11) DEFAULT NULL,
  `plancontable` varchar(2) COLLATE utf8_bin DEFAULT NULL,
  `longsubcuenta` int(11) DEFAULT NULL,
  `estado` varchar(15) COLLATE utf8_bin NOT NULL,
  `fechafin` date NOT NULL,
  `fechainicio` date NOT NULL,
  `nombre` varchar(100) COLLATE utf8_bin NOT NULL,
  `codejercicio` varchar(4) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`codejercicio`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `ejercicios`
--

INSERT INTO `ejercicios` (`idasientocierre`, `idasientopyg`, `idasientoapertura`, `plancontable`, `longsubcuenta`, `estado`, `fechafin`, `fechainicio`, `nombre`, `codejercicio`) VALUES
(NULL, NULL, NULL, '08', 10, 'ABIERTO', '2015-12-31', '2015-01-01', '2015', '0001');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empresa`
--

CREATE TABLE IF NOT EXISTS `empresa` (
  `administrador` varchar(100) COLLATE utf8_bin NOT NULL,
  `apartado` varchar(10) COLLATE utf8_bin DEFAULT NULL,
  `cifnif` varchar(20) COLLATE utf8_bin NOT NULL,
  `ciudad` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `codalmacen` varchar(4) COLLATE utf8_bin DEFAULT NULL,
  `codcuentarem` varchar(6) COLLATE utf8_bin DEFAULT NULL,
  `coddivisa` varchar(3) COLLATE utf8_bin DEFAULT NULL,
  `codedi` varchar(17) COLLATE utf8_bin DEFAULT NULL,
  `codejercicio` varchar(4) COLLATE utf8_bin DEFAULT NULL,
  `codpago` varchar(10) COLLATE utf8_bin DEFAULT NULL,
  `codpais` varchar(20) COLLATE utf8_bin DEFAULT NULL,
  `codpostal` varchar(10) COLLATE utf8_bin DEFAULT NULL,
  `codserie` varchar(2) COLLATE utf8_bin DEFAULT NULL,
  `contintegrada` tinyint(1) DEFAULT NULL,
  `direccion` varchar(100) COLLATE utf8_bin NOT NULL,
  `email` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `email_firma` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `email_password` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `fax` varchar(20) COLLATE utf8_bin DEFAULT NULL,
  `horario` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idprovincia` int(11) DEFAULT NULL,
  `lema` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `logo` text COLLATE utf8_bin,
  `nombre` varchar(100) COLLATE utf8_bin NOT NULL,
  `nombrecorto` varchar(32) COLLATE utf8_bin DEFAULT NULL,
  `pie_factura` text COLLATE utf8_bin,
  `provincia` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `recequivalencia` tinyint(1) DEFAULT NULL,
  `stockpedidos` tinyint(1) DEFAULT NULL,
  `telefono` varchar(20) COLLATE utf8_bin DEFAULT NULL,
  `web` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `empresa`
--

INSERT INTO `empresa` (`administrador`, `apartado`, `cifnif`, `ciudad`, `codalmacen`, `codcuentarem`, `coddivisa`, `codedi`, `codejercicio`, `codpago`, `codpais`, `codpostal`, `codserie`, `contintegrada`, `direccion`, `email`, `email_firma`, `email_password`, `fax`, `horario`, `id`, `idprovincia`, `lema`, `logo`, `nombre`, `nombrecorto`, `pie_factura`, `provincia`, `recequivalencia`, `stockpedidos`, `telefono`, `web`) VALUES
('', '', '25444457-V', 'Zaragoza', 'ALG', NULL, 'EUR', NULL, '0001', 'CONT', 'ESP', '', 'A', 0, 'Pablo Remacha nº15', '', '', 'admin', '', '', 1, NULL, '', NULL, 'Vendetu', 'Vendetu', '', 'Zaragoza', 0, 0, '', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `facturascli`
--

CREATE TABLE IF NOT EXISTS `facturascli` (
  `apartado` varchar(10) COLLATE utf8_bin DEFAULT NULL,
  `automatica` tinyint(1) NOT NULL,
  `cifnif` varchar(20) COLLATE utf8_bin NOT NULL,
  `ciudad` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `codagente` varchar(10) COLLATE utf8_bin DEFAULT NULL,
  `codalmacen` varchar(4) COLLATE utf8_bin DEFAULT NULL,
  `codcliente` varchar(6) COLLATE utf8_bin DEFAULT NULL,
  `coddir` int(11) DEFAULT NULL,
  `coddivisa` varchar(3) COLLATE utf8_bin NOT NULL,
  `codejercicio` varchar(4) COLLATE utf8_bin NOT NULL,
  `codigo` varchar(12) COLLATE utf8_bin NOT NULL,
  `codigorect` varchar(12) COLLATE utf8_bin DEFAULT NULL,
  `codpago` varchar(10) COLLATE utf8_bin NOT NULL,
  `codpais` varchar(20) COLLATE utf8_bin DEFAULT NULL,
  `codpostal` varchar(10) COLLATE utf8_bin DEFAULT NULL,
  `codserie` varchar(2) COLLATE utf8_bin NOT NULL,
  `deabono` tinyint(1) NOT NULL,
  `direccion` varchar(100) COLLATE utf8_bin NOT NULL,
  `editable` tinyint(1) NOT NULL,
  `fecha` date NOT NULL,
  `hora` time NOT NULL DEFAULT '00:00:00',
  `idasiento` int(11) DEFAULT NULL,
  `idfactura` int(11) NOT NULL AUTO_INCREMENT,
  `idfacturarect` int(11) DEFAULT NULL,
  `idpagodevol` int(11) DEFAULT NULL,
  `idprovincia` int(11) DEFAULT NULL,
  `irpf` double NOT NULL,
  `neto` double NOT NULL,
  `nogenerarasiento` tinyint(1) NOT NULL,
  `nombrecliente` varchar(100) COLLATE utf8_bin NOT NULL,
  `numero` varchar(12) COLLATE utf8_bin NOT NULL,
  `numero2` varchar(20) COLLATE utf8_bin DEFAULT NULL,
  `observaciones` text COLLATE utf8_bin,
  `pagada` tinyint(1) NOT NULL DEFAULT '0',
  `porcomision` double DEFAULT NULL,
  `provincia` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `recfinanciero` double NOT NULL,
  `tasaconv` double NOT NULL,
  `total` double NOT NULL,
  `totaleuros` double NOT NULL,
  `totalirpf` double NOT NULL,
  `totaliva` double NOT NULL,
  `totalrecargo` double DEFAULT NULL,
  `tpv` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`idfactura`),
  UNIQUE KEY `uniq_codigo_facturascli` (`codigo`),
  KEY `ca_facturascli_series2` (`codserie`),
  KEY `ca_facturascli_ejercicios2` (`codejercicio`),
  KEY `ca_facturascli_asiento2` (`idasiento`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `facturasprov`
--

CREATE TABLE IF NOT EXISTS `facturasprov` (
  `automatica` tinyint(1) NOT NULL,
  `cifnif` varchar(20) COLLATE utf8_bin NOT NULL,
  `codagente` varchar(10) COLLATE utf8_bin DEFAULT NULL,
  `codalmacen` varchar(4) COLLATE utf8_bin DEFAULT NULL,
  `coddivisa` varchar(3) COLLATE utf8_bin NOT NULL,
  `codejercicio` varchar(4) COLLATE utf8_bin NOT NULL,
  `codigo` varchar(12) COLLATE utf8_bin NOT NULL,
  `codigorect` varchar(12) COLLATE utf8_bin DEFAULT NULL,
  `codpago` varchar(10) COLLATE utf8_bin NOT NULL,
  `codproveedor` varchar(6) COLLATE utf8_bin DEFAULT NULL,
  `codserie` varchar(2) COLLATE utf8_bin NOT NULL,
  `deabono` tinyint(1) NOT NULL,
  `editable` tinyint(1) NOT NULL DEFAULT '0',
  `fecha` date NOT NULL,
  `hora` time NOT NULL DEFAULT '00:00:00',
  `idasiento` int(11) DEFAULT NULL,
  `idfactura` int(11) NOT NULL AUTO_INCREMENT,
  `idfacturarect` int(11) DEFAULT NULL,
  `idpagodevol` int(11) DEFAULT NULL,
  `irpf` double DEFAULT NULL,
  `neto` double DEFAULT NULL,
  `nogenerarasiento` tinyint(1) NOT NULL,
  `nombre` varchar(100) COLLATE utf8_bin NOT NULL,
  `numero` varchar(12) COLLATE utf8_bin NOT NULL,
  `numproveedor` varchar(20) COLLATE utf8_bin DEFAULT NULL,
  `observaciones` text COLLATE utf8_bin,
  `pagada` tinyint(1) NOT NULL DEFAULT '0',
  `recfinanciero` double NOT NULL,
  `tasaconv` double NOT NULL,
  `total` double DEFAULT NULL,
  `totaleuros` double DEFAULT NULL,
  `totalirpf` double DEFAULT NULL,
  `totaliva` double DEFAULT NULL,
  `totalrecargo` double DEFAULT NULL,
  PRIMARY KEY (`idfactura`),
  UNIQUE KEY `uniq_codigo_facturasprov` (`codigo`),
  KEY `ca_facturasprov_series2` (`codserie`),
  KEY `ca_facturasprov_ejercicios2` (`codejercicio`),
  KEY `ca_facturasprov_asiento2` (`idasiento`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `familias`
--

CREATE TABLE IF NOT EXISTS `familias` (
  `descripcion` varchar(100) COLLATE utf8_bin NOT NULL,
  `codfamilia` varchar(4) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`codfamilia`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `familias`
--

INSERT INTO `familias` (`descripcion`, `codfamilia`) VALUES
('VARIOS', 'VARI');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `formaspago`
--

CREATE TABLE IF NOT EXISTS `formaspago` (
  `codpago` varchar(10) COLLATE utf8_bin NOT NULL,
  `descripcion` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `genrecibos` varchar(10) COLLATE utf8_bin NOT NULL,
  `codcuenta` varchar(6) COLLATE utf8_bin DEFAULT NULL,
  `domiciliado` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`codpago`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `formaspago`
--

INSERT INTO `formaspago` (`codpago`, `descripcion`, `genrecibos`, `codcuenta`, `domiciliado`) VALUES
('CONT', 'CONTADO', 'Emitidos', NULL, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fs_extensions2`
--

CREATE TABLE IF NOT EXISTS `fs_extensions2` (
  `name` varchar(50) COLLATE utf8_bin NOT NULL,
  `page_from` varchar(30) COLLATE utf8_bin NOT NULL,
  `page_to` varchar(30) COLLATE utf8_bin DEFAULT NULL,
  `type` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `text` text COLLATE utf8_bin,
  `params` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`name`,`page_from`),
  KEY `ca_fs_extensions2_fs_pages` (`page_from`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `fs_extensions2`
--

INSERT INTO `fs_extensions2` (`name`, `page_from`, `page_to`, `type`, `text`, `params`) VALUES
('albaranes_agente', 'ventas_albaranes', 'admin_agente', 'button', 'Facturas de cliente', ''),
('albaranes_articulo', 'ventas_albaranes', 'ventas_articulo', 'button', 'Facturas de cliente', ''),
('albaranes_cliente', 'ventas_albaranes', 'ventas_cliente', 'button', 'Facturas', ''),
('chart.js', 'informe_albaranes', NULL, 'head', '<script src="plugins/informes_y_charts/view/js/chartjs/Chart.min.js"></script>', ''),
('email_albaran', 'ventas_imprimir', 'ventas_albaran', 'email', 'Factura simple', '&albaran=TRUE'),
('email_factura', 'ventas_imprimir', 'ventas_factura', 'email', 'Factura simple', '&factura=TRUE&tipo=simple'),
('imprimir_albaran', 'ventas_imprimir', 'ventas_albaran', 'pdf', 'Factura simple', '&albaran=TRUE'),
('imprimir_factura', 'ventas_imprimir', 'ventas_factura', 'pdf', 'Factura simple', '&factura=TRUE&tipo=simple'),
('imprimir_factura_carta', 'ventas_imprimir', 'ventas_factura', 'pdf', 'Modelo carta', '&factura=TRUE&tipo=carta'),
('imprimir_factura_firma', 'ventas_imprimir', 'ventas_factura', 'pdf', 'Factura con firma', '&factura=TRUE&tipo=firma');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fs_logs`
--

CREATE TABLE IF NOT EXISTS `fs_logs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tipo` varchar(50) COLLATE utf8_bin NOT NULL,
  `detalle` varchar(128) COLLATE utf8_bin NOT NULL,
  `fecha` timestamp NOT NULL ON UPDATE CURRENT_TIMESTAMP,
  `usuario` varchar(12) COLLATE utf8_bin DEFAULT NULL,
  `ip` varchar(40) COLLATE utf8_bin DEFAULT NULL,
  `alerta` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=31 ;

--
-- Volcado de datos para la tabla `fs_logs`
--

INSERT INTO `fs_logs` (`id`, `tipo`, `detalle`, `fecha`, `usuario`, `ip`, `alerta`) VALUES
(1, 'login', 'Login correcto.', '2015-01-18 20:04:35', 'admin', '::1', 0),
(2, 'error', 'Empleado no encontrado.', '2015-01-18 20:05:26', 'admin', '::1', 0),
(3, 'error', 'Usuario no encontrado.', '2015-01-18 20:05:26', 'admin', '::1', 0),
(4, 'error', '¡albarán de proveedor no encontrado!', '2015-01-18 20:05:27', 'admin', '::1', 0),
(5, 'error', '¡Factura de proveedor no encontrada!', '2015-01-18 20:05:27', 'admin', '::1', 0),
(6, 'error', '¡Proveedor no encontrado!', '2015-01-18 20:05:27', 'admin', '::1', 0),
(7, 'error', 'Asiento no encontrado.', '2015-01-18 20:05:27', 'admin', '::1', 0),
(8, 'error', 'Balance no encontrado.', '2015-01-18 20:05:27', 'admin', '::1', 0),
(9, 'error', 'Cuenta no encontrada.', '2015-01-18 20:05:27', 'admin', '::1', 0),
(10, 'error', 'Ejercicio no encontrado.', '2015-01-18 20:05:28', 'admin', '::1', 0),
(11, 'error', 'Subcuenta no encontrada.', '2015-01-18 20:05:28', 'admin', '::1', 0),
(12, 'error', 'Memcache está deshabilitado y es necesario para continuar. Clase Memcache no encontrada. Debes\n               <a target="_blank"', '2015-01-18 20:05:28', 'admin', '::1', 0),
(13, 'error', '¡albarán de cliente no encontrado!', '2015-01-18 20:05:29', 'admin', '::1', 0),
(14, 'error', '¡albarán de cliente no encontrado!', '2015-01-18 20:05:29', 'admin', '::1', 0),
(15, 'error', 'Artículo no encontrado.', '2015-01-18 20:05:29', 'admin', '::1', 0),
(16, 'error', 'Artículo no encontrado.', '2015-01-18 20:05:29', 'admin', '::1', 0),
(17, 'error', '¡Cliente no encontrado!', '2015-01-18 20:05:30', 'admin', '::1', 0),
(18, 'error', '¡Cliente no encontrado!', '2015-01-18 20:05:30', 'admin', '::1', 0),
(19, 'error', '¡Factura de cliente no encontrada!', '2015-01-18 20:05:30', 'admin', '::1', 0),
(20, 'error', '¡Factura de cliente no encontrada!', '2015-01-18 20:05:30', 'admin', '::1', 0),
(21, 'error', 'Familia no encontrada.', '2015-01-18 20:05:30', 'admin', '::1', 0),
(22, 'error', 'Familia no encontrada.', '2015-01-18 20:05:30', 'admin', '::1', 0),
(23, 'error', '¡Imposible guardar la linea con referencia: REF3', '2015-01-19 20:35:47', 'admin', '::1', 0),
(24, 'error', '¡Imposible guardar la linea con referencia: REF3', '2015-01-19 20:37:17', 'admin', '::1', 0),
(25, 'error', 'El total difiere entre el controlador y la vista (176 frente a ). Debes informar del error.', '2015-01-20 01:36:15', 'admin', '::1', 0),
(26, 'error', 'Usuario no encontrado.', '2015-01-20 02:27:49', 'admin', '::1', 0),
(27, 'login', 'El usuario ha cerrado la sesión.', '2015-01-20 02:33:48', 'admin', '::1', 0),
(28, 'login', 'Login correcto.', '2015-01-20 02:33:54', 'admin', '::1', 0),
(29, 'login', 'El usuario ha cerrado la sesión.', '2015-01-20 02:43:15', 'admin', '::1', 0),
(30, 'login', 'Login correcto.', '2015-01-20 03:01:47', 'admin', '::1', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fs_pages`
--

CREATE TABLE IF NOT EXISTS `fs_pages` (
  `name` varchar(30) COLLATE utf8_bin NOT NULL,
  `title` varchar(40) COLLATE utf8_bin NOT NULL,
  `folder` varchar(15) COLLATE utf8_bin NOT NULL,
  `version` varchar(10) COLLATE utf8_bin DEFAULT NULL,
  `show_on_menu` tinyint(1) NOT NULL DEFAULT '1',
  `important` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `fs_pages`
--

INSERT INTO `fs_pages` (`name`, `title`, `folder`, `version`, `show_on_menu`, `important`) VALUES
('admin_agente', 'Empleado', 'admin', '2014.12.4', 0, 0),
('admin_agentes', 'Empleados', 'admin', '2014.12.4', 1, 0),
('admin_almacenes', 'Almacenes', 'admin', '2014.12.4', 1, 0),
('admin_config2', 'Configuración avanzada', 'admin', '2014.12.4', 1, 0),
('admin_empresa', 'Empresa', 'admin', '2014.12.4', 1, 0),
('admin_info', 'Información del sistema', 'admin', '2014.12.4', 1, 0),
('admin_pages', 'Páginas', 'admin', '2014.12.4', 1, 0),
('admin_user', 'Usuario', 'admin', '2014.12.4', 0, 0),
('admin_users', 'Usuarios', 'admin', '2014.12.4', 1, 0),
('backup', 'Backups', 'admin', '2014.12.4', 1, 0),
('importar_familia', 'importar familia', 'ventas', '2014.12.4', 0, 0),
('informe_albaranes', 'Facturas', 'informes', '2014.12.4', 1, 0),
('informe_articulos', 'Artículos', 'informes', '2014.12.4', 1, 0),
('nueva_compra', 'nueva compra', 'compras', '2014.12.4', 0, 0),
('nueva_venta', 'nueva venta', 'ventas', '2014.12.4', 0, 0),
('subcuenta_asociada', 'Asignar subcuenta...', 'contabilidad', '2014.12.4', 0, 0),
('tpv_caja', 'Caja', 'TPV', '2014.12.4', 1, 0),
('tpv_recambios', 'TPV Genérico', 'TPV', '2014.12.4', 1, 0),
('ventas_agrupar_albaranes', 'Agrupar albaranes', 'ventas', '2014.12.4', 0, 0),
('ventas_albaran', 'factura de cliente', 'ventas', '2014.12.4', 0, 0),
('ventas_albaranes', 'Facturas de cliente', 'ventas', '2014.12.4', 1, 1),
('ventas_articulo', 'Articulo', 'ventas', '2014.12.4', 0, 0),
('ventas_articulos', 'Artículos', 'ventas', '2014.12.4', 1, 0),
('ventas_cliente', 'Cliente', 'ventas', '2014.12.4', 0, 0),
('ventas_clientes', 'Clientes', 'ventas', '2014.12.4', 1, 0),
('ventas_familia', 'Familia', 'ventas', '2014.12.4', 0, 0),
('ventas_familias', 'Familias', 'ventas', '2014.12.4', 1, 0),
('ventas_imprimir', 'imprimir', 'ventas', '2014.12.4', 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fs_users`
--

CREATE TABLE IF NOT EXISTS `fs_users` (
  `nick` varchar(12) COLLATE utf8_bin NOT NULL,
  `password` varchar(100) COLLATE utf8_bin NOT NULL,
  `log_key` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `admin` tinyint(1) NOT NULL DEFAULT '0',
  `codagente` varchar(10) COLLATE utf8_bin DEFAULT NULL,
  `last_login` date DEFAULT NULL,
  `last_login_time` time DEFAULT NULL,
  `last_ip` varchar(40) COLLATE utf8_bin DEFAULT NULL,
  `last_browser` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `fs_page` varchar(30) COLLATE utf8_bin DEFAULT NULL,
  `codejercicio` varchar(4) COLLATE utf8_bin DEFAULT NULL,
  `template` varchar(40) COLLATE utf8_bin NOT NULL DEFAULT 'bootstrap-yeti.css',
  PRIMARY KEY (`nick`),
  KEY `ca_fs_users_agentes2` (`codagente`),
  KEY `ca_fs_users_pages2` (`fs_page`),
  KEY `ca_fs_users_ejercicios2` (`codejercicio`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `fs_users`
--

INSERT INTO `fs_users` (`nick`, `password`, `log_key`, `admin`, `codagente`, `last_login`, `last_login_time`, `last_ip`, `last_browser`, `fs_page`, `codejercicio`, `template`) VALUES
('admin', 'd033e22ae348aeb5660fc2140aec35850c4da997', '152055a9de8bc3f6ab6929dc26c218fa0a499107', 1, '1', '2015-01-21', '02:49:24', '::1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_8_5) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.99 Safari/537.36', 'ventas_albaranes', '0001', 'bootstrap-yeti.css');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fs_vars`
--

CREATE TABLE IF NOT EXISTS `fs_vars` (
  `name` varchar(35) COLLATE utf8_bin NOT NULL,
  `varchar` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `fs_vars`
--

INSERT INTO `fs_vars` (`name`, `varchar`) VALUES
('first_time', '1'),
('mail_enc', 'ssl'),
('mail_host', 'smtp.gmail.com'),
('mail_port', '465'),
('mail_user', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `gruposclientes`
--

CREATE TABLE IF NOT EXISTS `gruposclientes` (
  `codgrupo` varchar(6) COLLATE utf8_bin NOT NULL,
  `nombre` varchar(100) COLLATE utf8_bin NOT NULL,
  `codtarifa` varchar(6) COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`codgrupo`),
  KEY `ca_gruposclientes_tarifas` (`codtarifa`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `impuestos`
--

CREATE TABLE IF NOT EXISTS `impuestos` (
  `codimpuesto` varchar(10) COLLATE utf8_bin NOT NULL,
  `codsubcuentaacr` varchar(15) COLLATE utf8_bin DEFAULT NULL,
  `codsubcuentadeu` varchar(15) COLLATE utf8_bin DEFAULT NULL,
  `codsubcuentaivadedadue` varchar(15) COLLATE utf8_bin DEFAULT NULL,
  `codsubcuentaivadevadue` varchar(15) COLLATE utf8_bin DEFAULT NULL,
  `codsubcuentaivadeventue` varchar(15) COLLATE utf8_bin DEFAULT NULL,
  `codsubcuentaivarepexe` varchar(15) COLLATE utf8_bin DEFAULT NULL,
  `codsubcuentaivarepexp` varchar(15) COLLATE utf8_bin DEFAULT NULL,
  `codsubcuentaivarepre` varchar(15) COLLATE utf8_bin DEFAULT NULL,
  `codsubcuentaivasopagra` varchar(15) COLLATE utf8_bin DEFAULT NULL,
  `codsubcuentaivasopexe` varchar(15) COLLATE utf8_bin DEFAULT NULL,
  `codsubcuentaivasopimp` varchar(15) COLLATE utf8_bin DEFAULT NULL,
  `codsubcuentarep` varchar(15) COLLATE utf8_bin DEFAULT NULL,
  `codsubcuentasop` varchar(15) COLLATE utf8_bin DEFAULT NULL,
  `descripcion` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `idsubcuentaacr` int(11) DEFAULT NULL,
  `idsubcuentadeu` int(11) DEFAULT NULL,
  `idsubcuentaivadedadue` int(11) DEFAULT NULL,
  `idsubcuentaivadevadue` int(11) DEFAULT NULL,
  `idsubcuentaivadeventue` int(11) DEFAULT NULL,
  `idsubcuentaivarepexe` int(11) DEFAULT NULL,
  `idsubcuentaivarepexp` int(11) DEFAULT NULL,
  `idsubcuentaivarepre` int(11) DEFAULT NULL,
  `idsubcuentaivasopagra` int(11) DEFAULT NULL,
  `idsubcuentaivasopexe` int(11) DEFAULT NULL,
  `idsubcuentaivasopimp` int(11) DEFAULT NULL,
  `idsubcuentarep` int(11) DEFAULT NULL,
  `idsubcuentasop` int(11) DEFAULT NULL,
  `iva` double NOT NULL,
  `recargo` double NOT NULL,
  PRIMARY KEY (`codimpuesto`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `impuestos`
--

INSERT INTO `impuestos` (`codimpuesto`, `codsubcuentaacr`, `codsubcuentadeu`, `codsubcuentaivadedadue`, `codsubcuentaivadevadue`, `codsubcuentaivadeventue`, `codsubcuentaivarepexe`, `codsubcuentaivarepexp`, `codsubcuentaivarepre`, `codsubcuentaivasopagra`, `codsubcuentaivasopexe`, `codsubcuentaivasopimp`, `codsubcuentarep`, `codsubcuentasop`, `descripcion`, `idsubcuentaacr`, `idsubcuentadeu`, `idsubcuentaivadedadue`, `idsubcuentaivadevadue`, `idsubcuentaivadeventue`, `idsubcuentaivarepexe`, `idsubcuentaivarepexp`, `idsubcuentaivarepre`, `idsubcuentaivasopagra`, `idsubcuentaivasopexe`, `idsubcuentaivasopimp`, `idsubcuentarep`, `idsubcuentasop`, `iva`, `recargo`) VALUES
('IVA0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'IVA 0%', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
('IVA10', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'IVA 10%', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 10, 1.4),
('IVA21', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'IVA 21%', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 21, 5.2),
('IVA4', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'IVA 4%', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 4, 0.5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lineasalbaranescli`
--

CREATE TABLE IF NOT EXISTS `lineasalbaranescli` (
  `cantidad` double NOT NULL DEFAULT '0',
  `codimpuesto` varchar(10) COLLATE utf8_bin DEFAULT NULL,
  `descripcion` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `dtolineal` double NOT NULL DEFAULT '0',
  `dtopor` double NOT NULL DEFAULT '0',
  `idalbaran` int(11) NOT NULL,
  `idlinea` int(11) NOT NULL AUTO_INCREMENT,
  `idlineapedido` int(11) NOT NULL DEFAULT '0',
  `idpedido` int(11) NOT NULL DEFAULT '0',
  `irpf` double DEFAULT NULL,
  `iva` double NOT NULL DEFAULT '0',
  `porcomision` double DEFAULT NULL,
  `pvpsindto` double NOT NULL DEFAULT '0',
  `pvptotal` double NOT NULL DEFAULT '0',
  `pvpunitario` double NOT NULL DEFAULT '0',
  `recargo` double DEFAULT '0',
  `referencia` varchar(18) COLLATE utf8_bin NOT NULL,
  `com_total` double NOT NULL DEFAULT '0',
  `com_porcentaje` double NOT NULL DEFAULT '0',
  `total_menos_comision` double NOT NULL DEFAULT '0',
  `com_iva` double NOT NULL DEFAULT '0',
  `neto_real` double NOT NULL DEFAULT '0',
  PRIMARY KEY (`idlinea`),
  KEY `ca_lineasalbaranescli_albaranescli2` (`idalbaran`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=6 ;

--
-- Volcado de datos para la tabla `lineasalbaranescli`
--

INSERT INTO `lineasalbaranescli` (`cantidad`, `codimpuesto`, `descripcion`, `dtolineal`, `dtopor`, `idalbaran`, `idlinea`, `idlineapedido`, `idpedido`, `irpf`, `iva`, `porcomision`, `pvpsindto`, `pvptotal`, `pvpunitario`, `recargo`, `referencia`, `com_total`, `com_porcentaje`, `total_menos_comision`, `com_iva`, `neto_real`) VALUES
(2, 'IVA0', 'REF2', 0, 0, 24, 1, 0, 0, 0, 0, NULL, 0, 0, 20.5, 0, 'REF2', 10.25, 25, 30.75, 2.15, 28.6),
(1, 'IVA0', 'Artículo Borrame', 0, 0, 24, 2, 0, 0, 0, 0, NULL, 0, 0, 88.55, 0, 'REF3', 22.14, 25, 66.41, 4.65, 61.76),
(14, 'IVA0', 'REF2', 0, 0, 25, 3, 0, 0, 0, 0, NULL, 0, 0, 20.5, 0, 'REF2', 71.75, 25, 215.25, 15.07, 200.18),
(1, 'IVA0', 'Artículo Borrame', 0, 0, 26, 4, 0, 0, 0, 0, NULL, 88.55, 88.55, 88.55, 0, 'REF3', 22.14, 25, 66.41, 4.65, 61.76),
(1, 'IVA0', 'REF2', 0, 0, 27, 5, 0, 0, 0, 0, NULL, 0, 0, 20.5, 0, 'REF2', 5.13, 25, 15.37, 1.08, 14.29);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lineasalbaranesprov`
--

CREATE TABLE IF NOT EXISTS `lineasalbaranesprov` (
  `cantidad` double NOT NULL DEFAULT '0',
  `codimpuesto` varchar(10) COLLATE utf8_bin DEFAULT NULL,
  `descripcion` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `dtolineal` double NOT NULL DEFAULT '0',
  `dtopor` double NOT NULL DEFAULT '0',
  `idalbaran` int(11) NOT NULL,
  `idlinea` int(11) NOT NULL AUTO_INCREMENT,
  `idlineapedido` int(11) NOT NULL DEFAULT '0',
  `idpedido` int(11) NOT NULL DEFAULT '0',
  `irpf` double DEFAULT NULL,
  `iva` double NOT NULL DEFAULT '0',
  `pvpsindto` double NOT NULL DEFAULT '0',
  `pvptotal` double NOT NULL DEFAULT '0',
  `pvpunitario` double NOT NULL DEFAULT '0',
  `recargo` double DEFAULT '0',
  `referencia` varchar(18) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`idlinea`),
  KEY `ca_lineasalbaranesprov_albaranesprov2` (`idalbaran`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lineasfacturascli`
--

CREATE TABLE IF NOT EXISTS `lineasfacturascli` (
  `cantidad` double NOT NULL,
  `codimpuesto` varchar(10) COLLATE utf8_bin DEFAULT NULL,
  `descripcion` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `dtolineal` double NOT NULL,
  `dtopor` double NOT NULL,
  `idalbaran` int(11) DEFAULT NULL,
  `idfactura` int(11) NOT NULL,
  `idlinea` int(11) NOT NULL AUTO_INCREMENT,
  `irpf` double DEFAULT NULL,
  `iva` double NOT NULL,
  `porcomision` double DEFAULT NULL,
  `pvpsindto` double NOT NULL,
  `pvptotal` double NOT NULL,
  `pvpunitario` double NOT NULL,
  `recargo` double DEFAULT NULL,
  `referencia` varchar(18) COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`idlinea`),
  KEY `ca_linea_facturascli2` (`idfactura`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `paises`
--

CREATE TABLE IF NOT EXISTS `paises` (
  `validarprov` tinyint(1) DEFAULT NULL,
  `codiso` varchar(2) COLLATE utf8_bin DEFAULT NULL,
  `bandera` text COLLATE utf8_bin,
  `nombre` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `codpais` varchar(20) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`codpais`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `paises`
--

INSERT INTO `paises` (`validarprov`, `codiso`, `bandera`, `nombre`, `codpais`) VALUES
(NULL, 'AR', NULL, 'Argentina', 'ARG'),
(NULL, 'CL', NULL, 'Chile', 'CHL'),
(NULL, 'CO', NULL, 'Colombia', 'COL'),
(NULL, 'EC', NULL, 'Ecuador', 'ECU'),
(NULL, 'ES', NULL, 'España', 'ESP'),
(NULL, 'MX', NULL, 'México', 'MEX'),
(NULL, 'PA', NULL, 'Panamá', 'PAN'),
(NULL, 'VE', NULL, 'Venezuela', 'VEN');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedores`
--

CREATE TABLE IF NOT EXISTS `proveedores` (
  `cifnif` varchar(20) COLLATE utf8_bin NOT NULL,
  `codcontacto` varchar(6) COLLATE utf8_bin DEFAULT NULL,
  `codcuentadom` varchar(6) COLLATE utf8_bin DEFAULT NULL,
  `codcuentapago` varchar(6) COLLATE utf8_bin DEFAULT NULL,
  `coddivisa` varchar(3) COLLATE utf8_bin DEFAULT NULL,
  `codpago` varchar(10) COLLATE utf8_bin DEFAULT NULL,
  `codproveedor` varchar(6) COLLATE utf8_bin NOT NULL,
  `codserie` varchar(2) COLLATE utf8_bin DEFAULT NULL,
  `codsubcuenta` varchar(15) COLLATE utf8_bin DEFAULT NULL,
  `contacto` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `email` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `fax` varchar(30) COLLATE utf8_bin DEFAULT NULL,
  `idsubcuenta` int(11) DEFAULT NULL,
  `ivaportes` double DEFAULT NULL,
  `nombre` varchar(100) COLLATE utf8_bin NOT NULL,
  `nombrecomercial` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `observaciones` text COLLATE utf8_bin,
  `recfinanciero` varchar(20) COLLATE utf8_bin DEFAULT NULL,
  `regimeniva` varchar(20) COLLATE utf8_bin DEFAULT NULL,
  `telefono1` varchar(30) COLLATE utf8_bin DEFAULT NULL,
  `telefono2` varchar(30) COLLATE utf8_bin DEFAULT NULL,
  `tipoidfiscal` varchar(25) COLLATE utf8_bin NOT NULL DEFAULT 'NIF',
  `web` varchar(250) COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`codproveedor`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `secuencias`
--

CREATE TABLE IF NOT EXISTS `secuencias` (
  `descripcion` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `id` int(11) NOT NULL,
  `idsec` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) COLLATE utf8_bin NOT NULL,
  `valor` int(11) DEFAULT NULL,
  `valorout` int(11) DEFAULT NULL,
  PRIMARY KEY (`idsec`),
  KEY `ca_secuencias_secuenciasejercicios` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `secuencias`
--

INSERT INTO `secuencias` (`descripcion`, `id`, `idsec`, `nombre`, `valor`, `valorout`) VALUES
('Secuencia del ejercicio 0001 y la serie A', 1, 1, 'nalbarancli', 1, 28);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `secuenciasejercicios`
--

CREATE TABLE IF NOT EXISTS `secuenciasejercicios` (
  `codejercicio` varchar(4) COLLATE utf8_bin NOT NULL,
  `codserie` varchar(2) COLLATE utf8_bin NOT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nalbarancli` int(11) NOT NULL,
  `nalbaranprov` int(11) NOT NULL,
  `nfacturacli` int(11) NOT NULL,
  `nfacturaprov` int(11) NOT NULL,
  `npedidocli` int(11) NOT NULL,
  `npedidoprov` int(11) NOT NULL,
  `npresupuestocli` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `ca_secuenciasejercicios_ejercicios` (`codejercicio`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `secuenciasejercicios`
--

INSERT INTO `secuenciasejercicios` (`codejercicio`, `codserie`, `id`, `nalbarancli`, `nalbaranprov`, `nfacturacli`, `nfacturaprov`, `npedidocli`, `npedidoprov`, `npresupuestocli`) VALUES
('0001', 'A', 1, 1, 1, 1, 1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `series`
--

CREATE TABLE IF NOT EXISTS `series` (
  `irpf` double DEFAULT NULL,
  `idcuenta` int(11) DEFAULT NULL,
  `codserie` varchar(2) COLLATE utf8_bin NOT NULL,
  `descripcion` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `siniva` tinyint(1) DEFAULT NULL,
  `codcuenta` varchar(6) COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`codserie`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `series`
--

INSERT INTO `series` (`irpf`, `idcuenta`, `codserie`, `descripcion`, `siniva`, `codcuenta`) VALUES
(0, NULL, 'A', 'SERIE A', 0, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `stocks`
--

CREATE TABLE IF NOT EXISTS `stocks` (
  `referencia` varchar(18) COLLATE utf8_bin NOT NULL,
  `disponible` double NOT NULL,
  `stockmin` double NOT NULL DEFAULT '0',
  `reservada` double NOT NULL,
  `horaultreg` time DEFAULT '00:00:00',
  `nombre` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `pterecibir` double NOT NULL,
  `fechaultreg` date DEFAULT '2015-01-21',
  `codalmacen` varchar(4) COLLATE utf8_bin NOT NULL,
  `cantidadultreg` double NOT NULL DEFAULT '0',
  `idstock` int(11) NOT NULL AUTO_INCREMENT,
  `cantidad` double NOT NULL DEFAULT '0',
  `stockmax` double NOT NULL DEFAULT '0',
  PRIMARY KEY (`idstock`),
  UNIQUE KEY `uniq_stocks_almacen_referencia` (`codalmacen`,`referencia`),
  KEY `ca_stocks_articulos2` (`referencia`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `stocks`
--

INSERT INTO `stocks` (`referencia`, `disponible`, `stockmin`, `reservada`, `horaultreg`, `nombre`, `pterecibir`, `fechaultreg`, `codalmacen`, `cantidadultreg`, `idstock`, `cantidad`, `stockmax`) VALUES
('REF3', 2, 0, 0, '00:00:00', '', 0, '2015-01-18', 'ALG', 0, 1, 2, 0),
('REF2', 0, 0, 0, '00:00:00', '', 0, '2015-01-20', 'ALG', 0, 2, 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tarifas`
--

CREATE TABLE IF NOT EXISTS `tarifas` (
  `incporcentual` double NOT NULL,
  `inclineal` double NOT NULL DEFAULT '0',
  `nombre` varchar(50) COLLATE utf8_bin NOT NULL,
  `codtarifa` varchar(6) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`codtarifa`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `albaranescli`
--
ALTER TABLE `albaranescli`
  ADD CONSTRAINT `ca_albaranescli_ejercicios2` FOREIGN KEY (`codejercicio`) REFERENCES `ejercicios` (`codejercicio`) ON UPDATE CASCADE,
  ADD CONSTRAINT `ca_albaranescli_series2` FOREIGN KEY (`codserie`) REFERENCES `series` (`codserie`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `albaranesprov`
--
ALTER TABLE `albaranesprov`
  ADD CONSTRAINT `ca_albaranesprov_ejercicios2` FOREIGN KEY (`codejercicio`) REFERENCES `ejercicios` (`codejercicio`) ON UPDATE CASCADE,
  ADD CONSTRAINT `ca_albaranesprov_series2` FOREIGN KEY (`codserie`) REFERENCES `series` (`codserie`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `articulos`
--
ALTER TABLE `articulos`
  ADD CONSTRAINT `ca_articulos_impuestos2` FOREIGN KEY (`codimpuesto`) REFERENCES `impuestos` (`codimpuesto`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `articulostarifas`
--
ALTER TABLE `articulostarifas`
  ADD CONSTRAINT `ca_articulostarifas_articulos2` FOREIGN KEY (`referencia`) REFERENCES `articulos` (`referencia`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ca_articulostarifas_tarifas2` FOREIGN KEY (`codtarifa`) REFERENCES `tarifas` (`codtarifa`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `cajas`
--
ALTER TABLE `cajas`
  ADD CONSTRAINT `ca_cajas_agentes2` FOREIGN KEY (`codagente`) REFERENCES `agentes` (`codagente`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `co_asientos`
--
ALTER TABLE `co_asientos`
  ADD CONSTRAINT `ca_co_asientos_ejercicios2` FOREIGN KEY (`codejercicio`) REFERENCES `ejercicios` (`codejercicio`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `co_cuentas`
--
ALTER TABLE `co_cuentas`
  ADD CONSTRAINT `ca_co_cuentas_ejercicios` FOREIGN KEY (`codejercicio`) REFERENCES `ejercicios` (`codejercicio`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ca_co_cuentas_epigrafes2` FOREIGN KEY (`idepigrafe`) REFERENCES `co_epigrafes` (`idepigrafe`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `co_epigrafes`
--
ALTER TABLE `co_epigrafes`
  ADD CONSTRAINT `ca_co_epigrafes_ejercicios` FOREIGN KEY (`codejercicio`) REFERENCES `ejercicios` (`codejercicio`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ca_co_epigrafes_gruposepigrafes2` FOREIGN KEY (`idgrupo`) REFERENCES `co_gruposepigrafes` (`idgrupo`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `co_gruposepigrafes`
--
ALTER TABLE `co_gruposepigrafes`
  ADD CONSTRAINT `ca_co_gruposepigrafes_ejercicios` FOREIGN KEY (`codejercicio`) REFERENCES `ejercicios` (`codejercicio`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `co_secuencias`
--
ALTER TABLE `co_secuencias`
  ADD CONSTRAINT `ca_co_secuencias_ejercicios` FOREIGN KEY (`codejercicio`) REFERENCES `ejercicios` (`codejercicio`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `co_subcuentas`
--
ALTER TABLE `co_subcuentas`
  ADD CONSTRAINT `ca_co_subcuentas_cuentas2` FOREIGN KEY (`idcuenta`) REFERENCES `co_cuentas` (`idcuenta`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ca_co_subcuentas_ejercicios` FOREIGN KEY (`codejercicio`) REFERENCES `ejercicios` (`codejercicio`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `co_subcuentascli`
--
ALTER TABLE `co_subcuentascli`
  ADD CONSTRAINT `ca_co_subcuentascli_ejercicios2` FOREIGN KEY (`codejercicio`) REFERENCES `ejercicios` (`codejercicio`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `cuentasbcocli`
--
ALTER TABLE `cuentasbcocli`
  ADD CONSTRAINT `ca_cuentasbcocli_clientes` FOREIGN KEY (`codcliente`) REFERENCES `clientes` (`codcliente`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `cuentasbcopro`
--
ALTER TABLE `cuentasbcopro`
  ADD CONSTRAINT `ca_cuentasbcopro_proveedores` FOREIGN KEY (`codproveedor`) REFERENCES `proveedores` (`codproveedor`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `dirclientes`
--
ALTER TABLE `dirclientes`
  ADD CONSTRAINT `ca_dirclientes_clientes` FOREIGN KEY (`codcliente`) REFERENCES `clientes` (`codcliente`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `facturascli`
--
ALTER TABLE `facturascli`
  ADD CONSTRAINT `ca_facturascli_asiento2` FOREIGN KEY (`idasiento`) REFERENCES `co_asientos` (`idasiento`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `ca_facturascli_ejercicios2` FOREIGN KEY (`codejercicio`) REFERENCES `ejercicios` (`codejercicio`) ON UPDATE CASCADE,
  ADD CONSTRAINT `ca_facturascli_series2` FOREIGN KEY (`codserie`) REFERENCES `series` (`codserie`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `facturasprov`
--
ALTER TABLE `facturasprov`
  ADD CONSTRAINT `ca_facturasprov_asiento2` FOREIGN KEY (`idasiento`) REFERENCES `co_asientos` (`idasiento`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `ca_facturasprov_ejercicios2` FOREIGN KEY (`codejercicio`) REFERENCES `ejercicios` (`codejercicio`) ON UPDATE CASCADE,
  ADD CONSTRAINT `ca_facturasprov_series2` FOREIGN KEY (`codserie`) REFERENCES `series` (`codserie`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `fs_extensions2`
--
ALTER TABLE `fs_extensions2`
  ADD CONSTRAINT `ca_fs_extensions2_fs_pages` FOREIGN KEY (`page_from`) REFERENCES `fs_pages` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `fs_users`
--
ALTER TABLE `fs_users`
  ADD CONSTRAINT `ca_fs_users_agentes2` FOREIGN KEY (`codagente`) REFERENCES `agentes` (`codagente`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `ca_fs_users_ejercicios2` FOREIGN KEY (`codejercicio`) REFERENCES `ejercicios` (`codejercicio`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `ca_fs_users_pages2` FOREIGN KEY (`fs_page`) REFERENCES `fs_pages` (`name`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Filtros para la tabla `gruposclientes`
--
ALTER TABLE `gruposclientes`
  ADD CONSTRAINT `ca_gruposclientes_tarifas` FOREIGN KEY (`codtarifa`) REFERENCES `tarifas` (`codtarifa`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Filtros para la tabla `lineasalbaranescli`
--
ALTER TABLE `lineasalbaranescli`
  ADD CONSTRAINT `ca_lineasalbaranescli_albaranescli2` FOREIGN KEY (`idalbaran`) REFERENCES `albaranescli` (`idalbaran`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `lineasalbaranesprov`
--
ALTER TABLE `lineasalbaranesprov`
  ADD CONSTRAINT `ca_lineasalbaranesprov_albaranesprov2` FOREIGN KEY (`idalbaran`) REFERENCES `albaranesprov` (`idalbaran`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `lineasfacturascli`
--
ALTER TABLE `lineasfacturascli`
  ADD CONSTRAINT `ca_linea_facturascli2` FOREIGN KEY (`idfactura`) REFERENCES `facturascli` (`idfactura`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `secuencias`
--
ALTER TABLE `secuencias`
  ADD CONSTRAINT `ca_secuencias_secuenciasejercicios` FOREIGN KEY (`id`) REFERENCES `secuenciasejercicios` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `secuenciasejercicios`
--
ALTER TABLE `secuenciasejercicios`
  ADD CONSTRAINT `ca_secuenciasejercicios_ejercicios` FOREIGN KEY (`codejercicio`) REFERENCES `ejercicios` (`codejercicio`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `stocks`
--
ALTER TABLE `stocks`
  ADD CONSTRAINT `ca_stocks_almacenes3` FOREIGN KEY (`codalmacen`) REFERENCES `almacenes` (`codalmacen`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ca_stocks_articulos2` FOREIGN KEY (`referencia`) REFERENCES `articulos` (`referencia`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
