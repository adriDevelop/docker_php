

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `inmobiliaria`
--
DROP SCHEMA IF EXISTS inmobiliaria ;

-- -----------------------------------------------------
-- 
-- -----------------------------------------------------
CREATE SCHEMA inmobiliaria DEFAULT CHARACTER SET utf8 ;
USE inmobiliaria;
-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `zonas`
--

CREATE TABLE IF NOT EXISTS `zonas` (
  `idzona` smallint(5) unsigned NOT NULL,
  `descripcion` varchar(50) NOT NULL,
  
  PRIMARY KEY (`idzona`)
) ENGINE=InnoDB DEFAULT CHARACTER SET latin1 COLLATE latin1_spanish_ci;




-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inmuebles`
--

CREATE TABLE IF NOT EXISTS `inmuebles` (
  `idinmuebles` smallint(5) unsigned NOT NULL,
  `zona` smallint(5) unsigned NOT NULL,
  `domicilio` varchar(50) NOT NULL,
  `habitaciones` smallint(1) unsigned NOT NULL,
  `precio` smallint(6) unsigned NOT NULL,
   PRIMARY KEY (`idinmuebles`)
) ENGINE=InnoDB DEFAULT CHARACTER SET latin1 COLLATE latin1_spanish_ci;



-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reservas`
--


CREATE TABLE IF NOT EXISTS `reservas` (
  `idreservas` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `dni` varchar(9) NOT NULL,
  `idinmueble` varchar(50) NOT NULL,
 `fecha` DATE NOT NULL,
  PRIMARY KEY (`idreservas`)
  ) ENGINE=InnoDB DEFAULT CHARACTER SET latin1 COLLATE latin1_spanish_ci;




-- Volcado de datos para la tabla `zonas`
--

INSERT INTO `zonas` (`idzona`, `descripcion`) VALUES
(1, "Centro"),
(2, "Ciudad Jardin"),
(3, "Centro Historico"),
(4, "San Andres"),
(5, "San Lorenzo"),
(6, "Santa Marina"),
(7, "Vallellano");

--
-- Volcado de datos para la tabla `inmuebles`
--
 
INSERT INTO `inmuebles` (`idinmuebles`, `zona`, `domicilio`,`habitaciones`, `precio`) VALUES

(1, 2,"C/Pintor, 2", 2,200),
(2, 3,"C/Rosa, 45",1,350),
(3, 1,"C/Cántaro, 32",3,500),
(4, 6,"C/El molino, 57",4,350),
(5, 1,"C/El olmo",1,350),
(6, 4,"C/Pelayo",3,450),
(7, 5,"C/Sandogal, 6",4,650),
(8, 2,"C/El Peral, 7",2,150),
(9, 7,"C/El Naranjo, 121",4,370),
(10, 2,"C/Soria, 80",2,550)


