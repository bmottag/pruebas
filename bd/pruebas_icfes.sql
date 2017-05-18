-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 18-05-2017 a las 05:36:47
-- Versión del servidor: 10.1.16-MariaDB
-- Versión de PHP: 5.6.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `pruebas_icfes`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alertas`
--

CREATE TABLE `alertas` (
  `id_alerta` int(10) NOT NULL,
  `descripcion_alerta` text NOT NULL,
  `fk_id_tipo_alerta` int(1) NOT NULL,
  `mensaje_alerta` text NOT NULL,
  `fecha_alerta` date DEFAULT NULL,
  `hora_alerta` varchar(10) NOT NULL,
  `fk_id_rol` int(1) NOT NULL,
  `tiempo_duracion_alerta` varchar(10) NOT NULL,
  `fk_id_sesion` int(10) NOT NULL,
  `fecha_creacion` date NOT NULL,
  `fecha_inicio` datetime NOT NULL,
  `fecha_fin` datetime NOT NULL,
  `estado_alerta` int(1) NOT NULL COMMENT '1: Activa; 2: Inactiva'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `alertas`
--

INSERT INTO `alertas` (`id_alerta`, `descripcion_alerta`, `fk_id_tipo_alerta`, `mensaje_alerta`, `fecha_alerta`, `hora_alerta`, `fk_id_rol`, `tiempo_duracion_alerta`, `fk_id_sesion`, `fecha_creacion`, `fecha_inicio`, `fecha_fin`, `estado_alerta`) VALUES
(1, 'Pruebas de la primera alerta que se va a mostrar', 3, 'El mensaje que se va a mostrar al usuario toca empezar a clasificar los mensajes por el tipo de alerta', '2017-05-08', '10:30', 4, '45', 1, '2017-05-15', '2017-05-08 10:30:00', '2017-05-08 11:15:00', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `param_divipola`
--

CREATE TABLE `param_divipola` (
  `dpto_divipola` int(1) NOT NULL,
  `mpio_divipola` int(3) NOT NULL,
  `dpto_divipola_nombre` varchar(100) NOT NULL,
  `mpio_divipola_nombre` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `param_divipola`
--

INSERT INTO `param_divipola` (`dpto_divipola`, `mpio_divipola`, `dpto_divipola_nombre`, `mpio_divipola_nombre`) VALUES
(5, 5001, 'Antioquia', 'MEDELLÍN'),
(5, 5002, 'Antioquia', 'ABEJORRAL'),
(5, 5004, 'Antioquia', 'ABRIAQUÍ'),
(5, 5021, 'Antioquia', 'ALEJANDRÍA'),
(5, 5030, 'Antioquia', 'AMAGÁ'),
(5, 5031, 'Antioquia', 'AMALFI'),
(5, 5034, 'Antioquia', 'ANDES'),
(5, 5036, 'Antioquia', 'ANGELÓPOLIS'),
(5, 5038, 'Antioquia', 'ANGOSTURA'),
(5, 5040, 'Antioquia', 'ANORÍ'),
(5, 5042, 'Antioquia', 'SANTA FÉ DE ANTIOQUIA'),
(5, 5044, 'Antioquia', 'ANZÁ'),
(5, 5045, 'Antioquia', 'APARTADÓ'),
(5, 5051, 'Antioquia', 'ARBOLETES'),
(5, 5055, 'Antioquia', 'ARGELIA'),
(5, 5059, 'Antioquia', 'ARMENIA'),
(5, 5079, 'Antioquia', 'BARBOSA'),
(5, 5086, 'Antioquia', 'BELMIRA'),
(5, 5088, 'Antioquia', 'BELLO'),
(5, 5091, 'Antioquia', 'BETANIA'),
(5, 5093, 'Antioquia', 'BETULIA'),
(5, 5101, 'Antioquia', 'CIUDAD BOLÍVAR'),
(5, 5107, 'Antioquia', 'BRICEÑO'),
(5, 5113, 'Antioquia', 'BURITICÁ'),
(5, 5120, 'Antioquia', 'CÁCERES'),
(5, 5125, 'Antioquia', 'CAICEDO'),
(5, 5129, 'Antioquia', 'CALDAS'),
(5, 5134, 'Antioquia', 'CAMPAMENTO'),
(5, 5138, 'Antioquia', 'CAÑASGORDAS'),
(5, 5142, 'Antioquia', 'CARACOLÍ'),
(5, 5145, 'Antioquia', 'CARAMANTA'),
(5, 5147, 'Antioquia', 'CAREPA'),
(5, 5148, 'Antioquia', 'EL CARMEN DE VIBORAL'),
(5, 5150, 'Antioquia', 'CAROLINA'),
(5, 5154, 'Antioquia', 'CAUCASIA'),
(5, 5172, 'Antioquia', 'CHIGORODÓ'),
(5, 5190, 'Antioquia', 'CISNEROS'),
(5, 5197, 'Antioquia', 'COCORNÁ'),
(5, 5206, 'Antioquia', 'CONCEPCIÓN'),
(5, 5209, 'Antioquia', 'CONCORDIA'),
(5, 5212, 'Antioquia', 'COPACABANA'),
(5, 5234, 'Antioquia', 'DABEIBA'),
(5, 5237, 'Antioquia', 'DONMATÍAS'),
(5, 5240, 'Antioquia', 'EBÉJICO'),
(5, 5250, 'Antioquia', 'EL BAGRE'),
(5, 5264, 'Antioquia', 'ENTRERRÍOS'),
(5, 5266, 'Antioquia', 'ENVIGADO'),
(5, 5282, 'Antioquia', 'FREDONIA'),
(5, 5284, 'Antioquia', 'FRONTINO'),
(5, 5306, 'Antioquia', 'GIRALDO'),
(5, 5308, 'Antioquia', 'GIRARDOTA'),
(5, 5310, 'Antioquia', 'GÓMEZ PLATA'),
(5, 5313, 'Antioquia', 'GRANADA'),
(5, 5315, 'Antioquia', 'GUADALUPE'),
(5, 5318, 'Antioquia', 'GUARNE'),
(5, 5321, 'Antioquia', 'GUATAPÉ'),
(5, 5347, 'Antioquia', 'HELICONIA'),
(5, 5353, 'Antioquia', 'HISPANIA'),
(5, 5360, 'Antioquia', 'ITAGÜÍ'),
(5, 5361, 'Antioquia', 'ITUANGO'),
(5, 5364, 'Antioquia', 'JARDÍN'),
(5, 5368, 'Antioquia', 'JERICÓ'),
(5, 5376, 'Antioquia', 'LA CEJA'),
(5, 5380, 'Antioquia', 'LA ESTRELLA'),
(5, 5390, 'Antioquia', 'LA PINTADA'),
(5, 5400, 'Antioquia', 'LA UNIÓN'),
(5, 5411, 'Antioquia', 'LIBORINA'),
(5, 5425, 'Antioquia', 'MACEO'),
(5, 5440, 'Antioquia', 'MARINILLA'),
(5, 5467, 'Antioquia', 'MONTEBELLO'),
(5, 5475, 'Antioquia', 'MURINDÓ'),
(5, 5480, 'Antioquia', 'MUTATÁ'),
(5, 5483, 'Antioquia', 'NARIÑO'),
(5, 5490, 'Antioquia', 'NECOCLÍ'),
(5, 5495, 'Antioquia', 'NECHÍ'),
(5, 5501, 'Antioquia', 'OLAYA'),
(5, 5541, 'Antioquia', 'PEÑOL'),
(5, 5543, 'Antioquia', 'PEQUE'),
(5, 5576, 'Antioquia', 'PUEBLORRICO'),
(5, 5579, 'Antioquia', 'PUERTO BERRÍO'),
(5, 5585, 'Antioquia', 'PUERTO NARE'),
(5, 5591, 'Antioquia', 'PUERTO TRIUNFO'),
(5, 5604, 'Antioquia', 'REMEDIOS'),
(5, 5607, 'Antioquia', 'RETIRO'),
(5, 5615, 'Antioquia', 'RIONEGRO'),
(5, 5628, 'Antioquia', 'SABANALARGA'),
(5, 5631, 'Antioquia', 'SABANETA'),
(5, 5642, 'Antioquia', 'SALGAR'),
(5, 5647, 'Antioquia', 'SAN ANDRÉS DE CUERQUÍA'),
(5, 5649, 'Antioquia', 'SAN CARLOS'),
(5, 5652, 'Antioquia', 'SAN FRANCISCO'),
(5, 5656, 'Antioquia', 'SAN JERÓNIMO'),
(5, 5658, 'Antioquia', 'SAN JOSÉ DE LA MONTAÑA'),
(5, 5659, 'Antioquia', 'SAN JUAN DE URABÁ'),
(5, 5660, 'Antioquia', 'SAN LUIS'),
(5, 5664, 'Antioquia', 'SAN PEDRO DE LOS MILAGROS'),
(5, 5665, 'Antioquia', 'SAN PEDRO DE URABÁ'),
(5, 5667, 'Antioquia', 'SAN RAFAEL'),
(5, 5670, 'Antioquia', 'SAN ROQUE'),
(5, 5674, 'Antioquia', 'SAN VICENTE FERRER'),
(5, 5679, 'Antioquia', 'SANTA BÁRBARA'),
(5, 5686, 'Antioquia', 'SANTA ROSA DE OSOS'),
(5, 5690, 'Antioquia', 'SANTO DOMINGO'),
(5, 5697, 'Antioquia', 'EL SANTUARIO'),
(5, 5736, 'Antioquia', 'SEGOVIA'),
(5, 5756, 'Antioquia', 'SONSÓN'),
(5, 5761, 'Antioquia', 'SOPETRÁN'),
(5, 5789, 'Antioquia', 'TÁMESIS'),
(5, 5790, 'Antioquia', 'TARAZÁ'),
(5, 5792, 'Antioquia', 'TARSO'),
(5, 5809, 'Antioquia', 'TITIRIBÍ'),
(5, 5819, 'Antioquia', 'TOLEDO'),
(5, 5837, 'Antioquia', 'TURBO'),
(5, 5842, 'Antioquia', 'URAMITA'),
(5, 5847, 'Antioquia', 'URRAO'),
(5, 5854, 'Antioquia', 'VALDIVIA'),
(5, 5856, 'Antioquia', 'VALPARAÍSO'),
(5, 5858, 'Antioquia', 'VEGACHÍ'),
(5, 5861, 'Antioquia', 'VENECIA'),
(5, 5873, 'Antioquia', 'VIGÍA DEL FUERTE'),
(5, 5885, 'Antioquia', 'YALÍ'),
(5, 5887, 'Antioquia', 'YARUMAL'),
(5, 5890, 'Antioquia', 'YOLOMBÓ'),
(5, 5893, 'Antioquia', 'YONDÓ'),
(5, 5895, 'Antioquia', 'ZARAGOZA'),
(8, 8001, 'Atlántico', 'BARRANQUILLA'),
(8, 8078, 'Atlántico', 'BARANOA'),
(8, 8137, 'Atlántico', 'CAMPO DE LA CRUZ'),
(8, 8141, 'Atlántico', 'CANDELARIA'),
(8, 8296, 'Atlántico', 'GALAPA'),
(8, 8372, 'Atlántico', 'JUAN DE ACOSTA'),
(8, 8421, 'Atlántico', 'LURUACO'),
(8, 8433, 'Atlántico', 'MALAMBO'),
(8, 8436, 'Atlántico', 'MANATÍ'),
(8, 8520, 'Atlántico', 'PALMAR DE VARELA'),
(8, 8549, 'Atlántico', 'PIOJÓ'),
(8, 8558, 'Atlántico', 'POLONUEVO'),
(8, 8560, 'Atlántico', 'PONEDERA'),
(8, 8573, 'Atlántico', 'PUERTO COLOMBIA'),
(8, 8606, 'Atlántico', 'REPELÓN'),
(8, 8634, 'Atlántico', 'SABANAGRANDE'),
(8, 8638, 'Atlántico', 'SABANALARGA'),
(8, 8675, 'Atlántico', 'SANTA LUCÍA'),
(8, 8685, 'Atlántico', 'SANTO TOMÁS'),
(8, 8758, 'Atlántico', 'SOLEDAD'),
(8, 8770, 'Atlántico', 'SUAN'),
(8, 8832, 'Atlántico', 'TUBARÁ'),
(8, 8849, 'Atlántico', 'USIACURÍ'),
(11, 11001, 'Bogotá, D.C.', 'BOGOTÁ, D.C.'),
(13, 13001, 'Bolívar', 'CARTAGENA DE INDIAS'),
(13, 13006, 'Bolívar', 'ACHÍ'),
(13, 13030, 'Bolívar', 'ALTOS DEL ROSARIO'),
(13, 13042, 'Bolívar', 'ARENAL'),
(13, 13052, 'Bolívar', 'ARJONA'),
(13, 13062, 'Bolívar', 'ARROYOHONDO'),
(13, 13074, 'Bolívar', 'BARRANCO DE LOBA'),
(13, 13140, 'Bolívar', 'CALAMAR'),
(13, 13160, 'Bolívar', 'CANTAGALLO'),
(13, 13188, 'Bolívar', 'CICUCO'),
(13, 13212, 'Bolívar', 'CÓRDOBA'),
(13, 13222, 'Bolívar', 'CLEMENCIA'),
(13, 13244, 'Bolívar', 'EL CARMEN DE BOLÍVAR'),
(13, 13248, 'Bolívar', 'EL GUAMO'),
(13, 13268, 'Bolívar', 'EL PEÑÓN'),
(13, 13300, 'Bolívar', 'HATILLO DE LOBA'),
(13, 13430, 'Bolívar', 'MAGANGUÉ'),
(13, 13433, 'Bolívar', 'MAHATES'),
(13, 13440, 'Bolívar', 'MARGARITA'),
(13, 13442, 'Bolívar', 'MARÍA LA BAJA'),
(13, 13458, 'Bolívar', 'MONTECRISTO'),
(13, 13468, 'Bolívar', 'MOMPÓS'),
(13, 13473, 'Bolívar', 'MORALES'),
(13, 13490, 'Bolívar', 'NOROSÍ'),
(13, 13549, 'Bolívar', 'PINILLOS'),
(13, 13580, 'Bolívar', 'REGIDOR'),
(13, 13600, 'Bolívar', 'RÍO VIEJO'),
(13, 13620, 'Bolívar', 'SAN CRISTÓBAL'),
(13, 13647, 'Bolívar', 'SAN ESTANISLAO'),
(13, 13650, 'Bolívar', 'SAN FERNANDO'),
(13, 13654, 'Bolívar', 'SAN JACINTO'),
(13, 13655, 'Bolívar', 'SAN JACINTO DEL CAUCA'),
(13, 13657, 'Bolívar', 'SAN JUAN NEPOMUCENO'),
(13, 13667, 'Bolívar', 'SAN MARTÍN DE LOBA'),
(13, 13670, 'Bolívar', 'SAN PABLO'),
(13, 13673, 'Bolívar', 'SANTA CATALINA'),
(13, 13683, 'Bolívar', 'SANTA ROSA'),
(13, 13688, 'Bolívar', 'SANTA ROSA DEL SUR'),
(13, 13744, 'Bolívar', 'SIMITÍ'),
(13, 13760, 'Bolívar', 'SOPLAVIENTO'),
(13, 13780, 'Bolívar', 'TALAIGUA NUEVO'),
(13, 13810, 'Bolívar', 'TIQUISIO'),
(13, 13836, 'Bolívar', 'TURBACO'),
(13, 13838, 'Bolívar', 'TURBANÁ'),
(13, 13873, 'Bolívar', 'VILLANUEVA'),
(13, 13894, 'Bolívar', 'ZAMBRANO'),
(15, 15001, 'Boyacá', 'TUNJA'),
(15, 15022, 'Boyacá', 'ALMEIDA'),
(15, 15047, 'Boyacá', 'AQUITANIA'),
(15, 15051, 'Boyacá', 'ARCABUCO'),
(15, 15087, 'Boyacá', 'BELÉN'),
(15, 15090, 'Boyacá', 'BERBEO'),
(15, 15092, 'Boyacá', 'BETÉITIVA'),
(15, 15097, 'Boyacá', 'BOAVITA'),
(15, 15104, 'Boyacá', 'BOYACÁ'),
(15, 15106, 'Boyacá', 'BRICEÑO'),
(15, 15109, 'Boyacá', 'BUENAVISTA'),
(15, 15114, 'Boyacá', 'BUSBANZÁ'),
(15, 15131, 'Boyacá', 'CALDAS'),
(15, 15135, 'Boyacá', 'CAMPOHERMOSO'),
(15, 15162, 'Boyacá', 'CERINZA'),
(15, 15172, 'Boyacá', 'CHINAVITA'),
(15, 15176, 'Boyacá', 'CHIQUINQUIRÁ'),
(15, 15180, 'Boyacá', 'CHISCAS'),
(15, 15183, 'Boyacá', 'CHITA'),
(15, 15185, 'Boyacá', 'CHITARAQUE'),
(15, 15187, 'Boyacá', 'CHIVATÁ'),
(15, 15189, 'Boyacá', 'CIÉNEGA'),
(15, 15204, 'Boyacá', 'CÓMBITA'),
(15, 15212, 'Boyacá', 'COPER'),
(15, 15215, 'Boyacá', 'CORRALES'),
(15, 15218, 'Boyacá', 'COVARACHÍA'),
(15, 15223, 'Boyacá', 'CUBARÁ'),
(15, 15224, 'Boyacá', 'CUCAITA'),
(15, 15226, 'Boyacá', 'CUÍTIVA'),
(15, 15232, 'Boyacá', 'CHÍQUIZA'),
(15, 15236, 'Boyacá', 'CHIVOR'),
(15, 15238, 'Boyacá', 'DUITAMA'),
(15, 15244, 'Boyacá', 'EL COCUY'),
(15, 15248, 'Boyacá', 'EL ESPINO'),
(15, 15272, 'Boyacá', 'FIRAVITOBA'),
(15, 15276, 'Boyacá', 'FLORESTA'),
(15, 15293, 'Boyacá', 'GACHANTIVÁ'),
(15, 15296, 'Boyacá', 'GÁMEZA'),
(15, 15299, 'Boyacá', 'GARAGOA'),
(15, 15317, 'Boyacá', 'GUACAMAYAS'),
(15, 15322, 'Boyacá', 'GUATEQUE'),
(15, 15325, 'Boyacá', 'GUAYATÁ'),
(15, 15332, 'Boyacá', 'GÜICÁN DE LA SIERRA'),
(15, 15362, 'Boyacá', 'IZA'),
(15, 15367, 'Boyacá', 'JENESANO'),
(15, 15368, 'Boyacá', 'JERICÓ'),
(15, 15377, 'Boyacá', 'LABRANZAGRANDE'),
(15, 15380, 'Boyacá', 'LA CAPILLA'),
(15, 15401, 'Boyacá', 'LA VICTORIA'),
(15, 15403, 'Boyacá', 'LA UVITA'),
(15, 15407, 'Boyacá', 'VILLA DE LEYVA'),
(15, 15425, 'Boyacá', 'MACANAL'),
(15, 15442, 'Boyacá', 'MARIPÍ'),
(15, 15455, 'Boyacá', 'MIRAFLORES'),
(15, 15464, 'Boyacá', 'MONGUA'),
(15, 15466, 'Boyacá', 'MONGUÍ'),
(15, 15469, 'Boyacá', 'MONIQUIRÁ'),
(15, 15476, 'Boyacá', 'MOTAVITA'),
(15, 15480, 'Boyacá', 'MUZO'),
(15, 15491, 'Boyacá', 'NOBSA'),
(15, 15494, 'Boyacá', 'NUEVO COLÓN'),
(15, 15500, 'Boyacá', 'OICATÁ'),
(15, 15507, 'Boyacá', 'OTANCHE'),
(15, 15511, 'Boyacá', 'PACHAVITA'),
(15, 15514, 'Boyacá', 'PÁEZ'),
(15, 15516, 'Boyacá', 'PAIPA'),
(15, 15518, 'Boyacá', 'PAJARITO'),
(15, 15522, 'Boyacá', 'PANQUEBA'),
(15, 15531, 'Boyacá', 'PAUNA'),
(15, 15533, 'Boyacá', 'PAYA'),
(15, 15537, 'Boyacá', 'PAZ DE RÍO'),
(15, 15542, 'Boyacá', 'PESCA'),
(15, 15550, 'Boyacá', 'PISBA'),
(15, 15572, 'Boyacá', 'PUERTO BOYACÁ'),
(15, 15580, 'Boyacá', 'QUÍPAMA'),
(15, 15599, 'Boyacá', 'RAMIRIQUÍ'),
(15, 15600, 'Boyacá', 'RÁQUIRA'),
(15, 15621, 'Boyacá', 'RONDÓN'),
(15, 15632, 'Boyacá', 'SABOYÁ'),
(15, 15638, 'Boyacá', 'SÁCHICA'),
(15, 15646, 'Boyacá', 'SAMACÁ'),
(15, 15660, 'Boyacá', 'SAN EDUARDO'),
(15, 15664, 'Boyacá', 'SAN JOSÉ DE PARE'),
(15, 15667, 'Boyacá', 'SAN LUIS DE GACENO'),
(15, 15673, 'Boyacá', 'SAN MATEO'),
(15, 15676, 'Boyacá', 'SAN MIGUEL DE SEMA'),
(15, 15681, 'Boyacá', 'SAN PABLO DE BORBUR'),
(15, 15686, 'Boyacá', 'SANTANA'),
(15, 15690, 'Boyacá', 'SANTA MARÍA'),
(15, 15693, 'Boyacá', 'SANTA ROSA DE VITERBO'),
(15, 15696, 'Boyacá', 'SANTA SOFÍA'),
(15, 15720, 'Boyacá', 'SATIVANORTE'),
(15, 15723, 'Boyacá', 'SATIVASUR'),
(15, 15740, 'Boyacá', 'SIACHOQUE'),
(15, 15753, 'Boyacá', 'SOATÁ'),
(15, 15755, 'Boyacá', 'SOCOTÁ'),
(15, 15757, 'Boyacá', 'SOCHA'),
(15, 15759, 'Boyacá', 'SOGAMOSO'),
(15, 15761, 'Boyacá', 'SOMONDOCO'),
(15, 15762, 'Boyacá', 'SORA'),
(15, 15763, 'Boyacá', 'SOTAQUIRÁ'),
(15, 15764, 'Boyacá', 'SORACÁ'),
(15, 15774, 'Boyacá', 'SUSACÓN'),
(15, 15776, 'Boyacá', 'SUTAMARCHÁN'),
(15, 15778, 'Boyacá', 'SUTATENZA'),
(15, 15790, 'Boyacá', 'TASCO'),
(15, 15798, 'Boyacá', 'TENZA'),
(15, 15804, 'Boyacá', 'TIBANÁ'),
(15, 15806, 'Boyacá', 'TIBASOSA'),
(15, 15808, 'Boyacá', 'TINJACÁ'),
(15, 15810, 'Boyacá', 'TIPACOQUE'),
(15, 15814, 'Boyacá', 'TOCA'),
(15, 15816, 'Boyacá', 'TOGÜÍ'),
(15, 15820, 'Boyacá', 'TÓPAGA'),
(15, 15822, 'Boyacá', 'TOTA'),
(15, 15832, 'Boyacá', 'TUNUNGUÁ'),
(15, 15835, 'Boyacá', 'TURMEQUÉ'),
(15, 15837, 'Boyacá', 'TUTA'),
(15, 15839, 'Boyacá', 'TUTAZÁ'),
(15, 15842, 'Boyacá', 'ÚMBITA'),
(15, 15861, 'Boyacá', 'VENTAQUEMADA'),
(15, 15879, 'Boyacá', 'VIRACACHÁ'),
(15, 15897, 'Boyacá', 'ZETAQUIRA'),
(17, 17001, 'Caldas', 'MANIZALES'),
(17, 17013, 'Caldas', 'AGUADAS'),
(17, 17042, 'Caldas', 'ANSERMA'),
(17, 17050, 'Caldas', 'ARANZAZU'),
(17, 17088, 'Caldas', 'BELALCÁZAR'),
(17, 17174, 'Caldas', 'CHINCHINÁ'),
(17, 17272, 'Caldas', 'FILADELFIA'),
(17, 17380, 'Caldas', 'LA DORADA'),
(17, 17388, 'Caldas', 'LA MERCED'),
(17, 17433, 'Caldas', 'MANZANARES'),
(17, 17442, 'Caldas', 'MARMATO'),
(17, 17444, 'Caldas', 'MARQUETALIA'),
(17, 17446, 'Caldas', 'MARULANDA'),
(17, 17486, 'Caldas', 'NEIRA'),
(17, 17495, 'Caldas', 'NORCASIA'),
(17, 17513, 'Caldas', 'PÁCORA'),
(17, 17524, 'Caldas', 'PALESTINA'),
(17, 17541, 'Caldas', 'PENSILVANIA'),
(17, 17614, 'Caldas', 'RIOSUCIO'),
(17, 17616, 'Caldas', 'RISARALDA'),
(17, 17653, 'Caldas', 'SALAMINA'),
(17, 17662, 'Caldas', 'SAMANÁ'),
(17, 17665, 'Caldas', 'SAN JOSÉ'),
(17, 17777, 'Caldas', 'SUPÍA'),
(17, 17867, 'Caldas', 'VICTORIA'),
(17, 17873, 'Caldas', 'VILLAMARÍA'),
(17, 17877, 'Caldas', 'VITERBO'),
(18, 18001, 'Caquetá', 'FLORENCIA'),
(18, 18029, 'Caquetá', 'ALBANIA'),
(18, 18094, 'Caquetá', 'BELÉN DE LOS ANDAQUÍES'),
(18, 18150, 'Caquetá', 'CARTAGENA DEL CHAIRÁ'),
(18, 18205, 'Caquetá', 'CURILLO'),
(18, 18247, 'Caquetá', 'EL DONCELLO'),
(18, 18256, 'Caquetá', 'EL PAUJÍL'),
(18, 18410, 'Caquetá', 'LA MONTAÑITA'),
(18, 18460, 'Caquetá', 'MILÁN'),
(18, 18479, 'Caquetá', 'MORELIA'),
(18, 18592, 'Caquetá', 'PUERTO RICO'),
(18, 18610, 'Caquetá', 'SAN JOSÉ DEL FRAGUA'),
(18, 18753, 'Caquetá', 'SAN VICENTE DEL CAGUÁN'),
(18, 18756, 'Caquetá', 'SOLANO'),
(18, 18785, 'Caquetá', 'SOLITA'),
(18, 18860, 'Caquetá', 'VALPARAÍSO'),
(19, 19001, 'Cauca', 'POPAYÁN'),
(19, 19022, 'Cauca', 'ALMAGUER'),
(19, 19050, 'Cauca', 'ARGELIA'),
(19, 19075, 'Cauca', 'BALBOA'),
(19, 19100, 'Cauca', 'BOLÍVAR'),
(19, 19110, 'Cauca', 'BUENOS AIRES'),
(19, 19130, 'Cauca', 'CAJIBÍO'),
(19, 19137, 'Cauca', 'CALDONO'),
(19, 19142, 'Cauca', 'CALOTO'),
(19, 19212, 'Cauca', 'CORINTO'),
(19, 19256, 'Cauca', 'EL TAMBO'),
(19, 19290, 'Cauca', 'FLORENCIA'),
(19, 19300, 'Cauca', 'GUACHENÉ'),
(19, 19318, 'Cauca', 'GUAPÍ'),
(19, 19355, 'Cauca', 'INZÁ'),
(19, 19364, 'Cauca', 'JAMBALÓ'),
(19, 19392, 'Cauca', 'LA SIERRA'),
(19, 19397, 'Cauca', 'LA VEGA'),
(19, 19418, 'Cauca', 'LÓPEZ DE MICAY'),
(19, 19450, 'Cauca', 'MERCADERES'),
(19, 19455, 'Cauca', 'MIRANDA'),
(19, 19473, 'Cauca', 'MORALES'),
(19, 19513, 'Cauca', 'PADILLA'),
(19, 19517, 'Cauca', 'PÁEZ'),
(19, 19532, 'Cauca', 'PATÍA'),
(19, 19533, 'Cauca', 'PIAMONTE'),
(19, 19548, 'Cauca', 'PIENDAMÓ - TUNÍA'),
(19, 19573, 'Cauca', 'PUERTO TEJADA'),
(19, 19585, 'Cauca', 'PURACÉ'),
(19, 19622, 'Cauca', 'ROSAS'),
(19, 19693, 'Cauca', 'SAN SEBASTIÁN'),
(19, 19698, 'Cauca', 'SANTANDER DE QUILICHAO'),
(19, 19701, 'Cauca', 'SANTA ROSA'),
(19, 19743, 'Cauca', 'SILVIA'),
(19, 19760, 'Cauca', 'SOTARA'),
(19, 19780, 'Cauca', 'SUÁREZ'),
(19, 19785, 'Cauca', 'SUCRE'),
(19, 19807, 'Cauca', 'TIMBÍO'),
(19, 19809, 'Cauca', 'TIMBIQUÍ'),
(19, 19821, 'Cauca', 'TORIBÍO'),
(19, 19824, 'Cauca', 'TOTORÓ'),
(19, 19845, 'Cauca', 'VILLA RICA'),
(20, 20001, 'Cesar', 'VALLEDUPAR'),
(20, 20011, 'Cesar', 'AGUACHICA'),
(20, 20013, 'Cesar', 'AGUSTÍN CODAZZI'),
(20, 20032, 'Cesar', 'ASTREA'),
(20, 20045, 'Cesar', 'BECERRIL'),
(20, 20060, 'Cesar', 'BOSCONIA'),
(20, 20175, 'Cesar', 'CHIMICHAGUA'),
(20, 20178, 'Cesar', 'CHIRIGUANÁ'),
(20, 20228, 'Cesar', 'CURUMANÍ'),
(20, 20238, 'Cesar', 'EL COPEY'),
(20, 20250, 'Cesar', 'EL PASO'),
(20, 20295, 'Cesar', 'GAMARRA'),
(20, 20310, 'Cesar', 'GONZÁLEZ'),
(20, 20383, 'Cesar', 'LA GLORIA'),
(20, 20400, 'Cesar', 'LA JAGUA DE IBIRICO'),
(20, 20443, 'Cesar', 'MANAURE BALCÓN DEL CESAR'),
(20, 20517, 'Cesar', 'PAILITAS'),
(20, 20550, 'Cesar', 'PELAYA'),
(20, 20570, 'Cesar', 'PUEBLO BELLO'),
(20, 20614, 'Cesar', 'RÍO DE ORO'),
(20, 20621, 'Cesar', 'LA PAZ'),
(20, 20710, 'Cesar', 'SAN ALBERTO'),
(20, 20750, 'Cesar', 'SAN DIEGO'),
(20, 20770, 'Cesar', 'SAN MARTÍN'),
(20, 20787, 'Cesar', 'TAMALAMEQUE'),
(23, 23001, 'Córdoba', 'MONTERÍA'),
(23, 23068, 'Córdoba', 'AYAPEL'),
(23, 23079, 'Córdoba', 'BUENAVISTA'),
(23, 23090, 'Córdoba', 'CANALETE'),
(23, 23162, 'Córdoba', 'CERETÉ'),
(23, 23168, 'Córdoba', 'CHIMÁ'),
(23, 23182, 'Córdoba', 'CHINÚ'),
(23, 23189, 'Córdoba', 'CIÉNAGA DE ORO'),
(23, 23300, 'Córdoba', 'COTORRA'),
(23, 23350, 'Córdoba', 'LA APARTADA'),
(23, 23417, 'Córdoba', 'LORICA'),
(23, 23419, 'Córdoba', 'LOS CÓRDOBAS'),
(23, 23464, 'Córdoba', 'MOMIL'),
(23, 23466, 'Córdoba', 'MONTELÍBANO'),
(23, 23500, 'Córdoba', 'MOÑITOS'),
(23, 23555, 'Córdoba', 'PLANETA RICA'),
(23, 23570, 'Córdoba', 'PUEBLO NUEVO'),
(23, 23574, 'Córdoba', 'PUERTO ESCONDIDO'),
(23, 23580, 'Córdoba', 'PUERTO LIBERTADOR'),
(23, 23586, 'Córdoba', 'PURÍSIMA DE LA CONCEPCIÓN'),
(23, 23660, 'Córdoba', 'SAHAGÚN'),
(23, 23670, 'Córdoba', 'SAN ANDRÉS DE SOTAVENTO'),
(23, 23672, 'Córdoba', 'SAN ANTERO'),
(23, 23675, 'Córdoba', 'SAN BERNARDO DEL VIENTO'),
(23, 23678, 'Córdoba', 'SAN CARLOS'),
(23, 23682, 'Córdoba', 'SAN JOSÉ DE URÉ'),
(23, 23686, 'Córdoba', 'SAN PELAYO'),
(23, 23807, 'Córdoba', 'TIERRALTA'),
(23, 23815, 'Córdoba', 'TUCHÍN'),
(23, 23855, 'Córdoba', 'VALENCIA'),
(25, 25001, 'Cundinamarca', 'AGUA DE DIOS'),
(25, 25019, 'Cundinamarca', 'ALBÁN'),
(25, 25035, 'Cundinamarca', 'ANAPOIMA'),
(25, 25040, 'Cundinamarca', 'ANOLAIMA'),
(25, 25053, 'Cundinamarca', 'ARBELÁEZ'),
(25, 25086, 'Cundinamarca', 'BELTRÁN'),
(25, 25095, 'Cundinamarca', 'BITUIMA'),
(25, 25099, 'Cundinamarca', 'BOJACÁ'),
(25, 25120, 'Cundinamarca', 'CABRERA'),
(25, 25123, 'Cundinamarca', 'CACHIPAY'),
(25, 25126, 'Cundinamarca', 'CAJICÁ'),
(25, 25148, 'Cundinamarca', 'CAPARRAPÍ'),
(25, 25151, 'Cundinamarca', 'CÁQUEZA'),
(25, 25154, 'Cundinamarca', 'CARMEN DE CARUPA'),
(25, 25168, 'Cundinamarca', 'CHAGUANÍ'),
(25, 25175, 'Cundinamarca', 'CHÍA'),
(25, 25178, 'Cundinamarca', 'CHIPAQUE'),
(25, 25181, 'Cundinamarca', 'CHOACHÍ'),
(25, 25183, 'Cundinamarca', 'CHOCONTÁ'),
(25, 25200, 'Cundinamarca', 'COGUA'),
(25, 25214, 'Cundinamarca', 'COTA'),
(25, 25224, 'Cundinamarca', 'CUCUNUBÁ'),
(25, 25245, 'Cundinamarca', 'EL COLEGIO'),
(25, 25258, 'Cundinamarca', 'EL PEÑÓN'),
(25, 25260, 'Cundinamarca', 'EL ROSAL'),
(25, 25269, 'Cundinamarca', 'FACATATIVÁ'),
(25, 25279, 'Cundinamarca', 'FÓMEQUE'),
(25, 25281, 'Cundinamarca', 'FOSCA'),
(25, 25286, 'Cundinamarca', 'FUNZA'),
(25, 25288, 'Cundinamarca', 'FÚQUENE'),
(25, 25290, 'Cundinamarca', 'FUSAGASUGÁ'),
(25, 25293, 'Cundinamarca', 'GACHALÁ'),
(25, 25295, 'Cundinamarca', 'GACHANCIPÁ'),
(25, 25297, 'Cundinamarca', 'GACHETÁ'),
(25, 25299, 'Cundinamarca', 'GAMA'),
(25, 25307, 'Cundinamarca', 'GIRARDOT'),
(25, 25312, 'Cundinamarca', 'GRANADA'),
(25, 25317, 'Cundinamarca', 'GUACHETÁ'),
(25, 25320, 'Cundinamarca', 'GUADUAS'),
(25, 25322, 'Cundinamarca', 'GUASCA'),
(25, 25324, 'Cundinamarca', 'GUATAQUÍ'),
(25, 25326, 'Cundinamarca', 'GUATAVITA'),
(25, 25328, 'Cundinamarca', 'GUAYABAL DE SÍQUIMA'),
(25, 25335, 'Cundinamarca', 'GUAYABETAL'),
(25, 25339, 'Cundinamarca', 'GUTIÉRREZ'),
(25, 25368, 'Cundinamarca', 'JERUSALÉN'),
(25, 25372, 'Cundinamarca', 'JUNÍN'),
(25, 25377, 'Cundinamarca', 'LA CALERA'),
(25, 25386, 'Cundinamarca', 'LA MESA'),
(25, 25394, 'Cundinamarca', 'LA PALMA'),
(25, 25398, 'Cundinamarca', 'LA PEÑA'),
(25, 25402, 'Cundinamarca', 'LA VEGA'),
(25, 25407, 'Cundinamarca', 'LENGUAZAQUE'),
(25, 25426, 'Cundinamarca', 'MACHETÁ'),
(25, 25430, 'Cundinamarca', 'MADRID'),
(25, 25436, 'Cundinamarca', 'MANTA'),
(25, 25438, 'Cundinamarca', 'MEDINA'),
(25, 25473, 'Cundinamarca', 'MOSQUERA'),
(25, 25483, 'Cundinamarca', 'NARIÑO'),
(25, 25486, 'Cundinamarca', 'NEMOCÓN'),
(25, 25488, 'Cundinamarca', 'NILO'),
(25, 25489, 'Cundinamarca', 'NIMAIMA'),
(25, 25491, 'Cundinamarca', 'NOCAIMA'),
(25, 25506, 'Cundinamarca', 'VENECIA'),
(25, 25513, 'Cundinamarca', 'PACHO'),
(25, 25518, 'Cundinamarca', 'PAIME'),
(25, 25524, 'Cundinamarca', 'PANDI'),
(25, 25530, 'Cundinamarca', 'PARATEBUENO'),
(25, 25535, 'Cundinamarca', 'PASCA'),
(25, 25572, 'Cundinamarca', 'PUERTO SALGAR'),
(25, 25580, 'Cundinamarca', 'PULÍ'),
(25, 25592, 'Cundinamarca', 'QUEBRADANEGRA'),
(25, 25594, 'Cundinamarca', 'QUETAME'),
(25, 25596, 'Cundinamarca', 'QUIPILE'),
(25, 25599, 'Cundinamarca', 'APULO'),
(25, 25612, 'Cundinamarca', 'RICAURTE'),
(25, 25645, 'Cundinamarca', 'SAN ANTONIO DEL TEQUENDAMA'),
(25, 25649, 'Cundinamarca', 'SAN BERNARDO'),
(25, 25653, 'Cundinamarca', 'SAN CAYETANO'),
(25, 25658, 'Cundinamarca', 'SAN FRANCISCO'),
(25, 25662, 'Cundinamarca', 'SAN JUAN DE RIOSECO'),
(25, 25718, 'Cundinamarca', 'SASAIMA'),
(25, 25736, 'Cundinamarca', 'SESQUILÉ'),
(25, 25740, 'Cundinamarca', 'SIBATÉ'),
(25, 25743, 'Cundinamarca', 'SILVANIA'),
(25, 25745, 'Cundinamarca', 'SIMIJACA'),
(25, 25754, 'Cundinamarca', 'SOACHA'),
(25, 25758, 'Cundinamarca', 'SOPÓ'),
(25, 25769, 'Cundinamarca', 'SUBACHOQUE'),
(25, 25772, 'Cundinamarca', 'SUESCA'),
(25, 25777, 'Cundinamarca', 'SUPATÁ'),
(25, 25779, 'Cundinamarca', 'SUSA'),
(25, 25781, 'Cundinamarca', 'SUTATAUSA'),
(25, 25785, 'Cundinamarca', 'TABIO'),
(25, 25793, 'Cundinamarca', 'TAUSA'),
(25, 25797, 'Cundinamarca', 'TENA'),
(25, 25799, 'Cundinamarca', 'TENJO'),
(25, 25805, 'Cundinamarca', 'TIBACUY'),
(25, 25807, 'Cundinamarca', 'TIBIRITA'),
(25, 25815, 'Cundinamarca', 'TOCAIMA'),
(25, 25817, 'Cundinamarca', 'TOCANCIPÁ'),
(25, 25823, 'Cundinamarca', 'TOPAIPÍ'),
(25, 25839, 'Cundinamarca', 'UBALÁ'),
(25, 25841, 'Cundinamarca', 'UBAQUE'),
(25, 25843, 'Cundinamarca', 'VILLA DE SAN DIEGO DE UBATÉ'),
(25, 25845, 'Cundinamarca', 'UNE'),
(25, 25851, 'Cundinamarca', 'ÚTICA'),
(25, 25862, 'Cundinamarca', 'VERGARA'),
(25, 25867, 'Cundinamarca', 'VIANÍ'),
(25, 25871, 'Cundinamarca', 'VILLAGÓMEZ'),
(25, 25873, 'Cundinamarca', 'VILLAPINZÓN'),
(25, 25875, 'Cundinamarca', 'VILLETA'),
(25, 25878, 'Cundinamarca', 'VIOTÁ'),
(25, 25885, 'Cundinamarca', 'YACOPÍ'),
(25, 25898, 'Cundinamarca', 'ZIPACÓN'),
(25, 25899, 'Cundinamarca', 'ZIPAQUIRÁ'),
(27, 27001, 'Chocó', 'QUIBDÓ'),
(27, 27006, 'Chocó', 'ACANDÍ'),
(27, 27025, 'Chocó', 'ALTO BAUDÓ'),
(27, 27050, 'Chocó', 'ATRATO'),
(27, 27073, 'Chocó', 'BAGADÓ'),
(27, 27075, 'Chocó', 'BAHÍA SOLANO'),
(27, 27077, 'Chocó', 'BAJO BAUDÓ'),
(27, 27099, 'Chocó', 'BOJAYÁ'),
(27, 27135, 'Chocó', 'EL CANTÓN DEL SAN PABLO'),
(27, 27150, 'Chocó', 'CARMEN DEL DARIÉN'),
(27, 27160, 'Chocó', 'CÉRTEGUI'),
(27, 27205, 'Chocó', 'CONDOTO'),
(27, 27245, 'Chocó', 'EL CARMEN DE ATRATO'),
(27, 27250, 'Chocó', 'EL LITORAL DEL SAN JUAN'),
(27, 27361, 'Chocó', 'ISTMINA'),
(27, 27372, 'Chocó', 'JURADÓ'),
(27, 27413, 'Chocó', 'LLORÓ'),
(27, 27425, 'Chocó', 'MEDIO ATRATO'),
(27, 27430, 'Chocó', 'MEDIO BAUDÓ'),
(27, 27450, 'Chocó', 'MEDIO SAN JUAN'),
(27, 27491, 'Chocó', 'NÓVITA'),
(27, 27495, 'Chocó', 'NUQUÍ'),
(27, 27580, 'Chocó', 'RÍO IRÓ'),
(27, 27600, 'Chocó', 'RÍO QUITO'),
(27, 27615, 'Chocó', 'RIOSUCIO'),
(27, 27660, 'Chocó', 'SAN JOSÉ DEL PALMAR'),
(27, 27745, 'Chocó', 'SIPÍ'),
(27, 27787, 'Chocó', 'TADÓ'),
(27, 27800, 'Chocó', 'UNGUÍA'),
(27, 27810, 'Chocó', 'UNIÓN PANAMERICANA'),
(41, 41001, 'Huila', 'NEIVA'),
(41, 41006, 'Huila', 'ACEVEDO'),
(41, 41013, 'Huila', 'AGRADO'),
(41, 41016, 'Huila', 'AIPE'),
(41, 41020, 'Huila', 'ALGECIRAS'),
(41, 41026, 'Huila', 'ALTAMIRA'),
(41, 41078, 'Huila', 'BARAYA'),
(41, 41132, 'Huila', 'CAMPOALEGRE'),
(41, 41206, 'Huila', 'COLOMBIA'),
(41, 41244, 'Huila', 'ELÍAS'),
(41, 41298, 'Huila', 'GARZÓN'),
(41, 41306, 'Huila', 'GIGANTE'),
(41, 41319, 'Huila', 'GUADALUPE'),
(41, 41349, 'Huila', 'HOBO'),
(41, 41357, 'Huila', 'ÍQUIRA'),
(41, 41359, 'Huila', 'ISNOS'),
(41, 41378, 'Huila', 'LA ARGENTINA'),
(41, 41396, 'Huila', 'LA PLATA'),
(41, 41483, 'Huila', 'NÁTAGA'),
(41, 41503, 'Huila', 'OPORAPA'),
(41, 41518, 'Huila', 'PAICOL'),
(41, 41524, 'Huila', 'PALERMO'),
(41, 41530, 'Huila', 'PALESTINA'),
(41, 41548, 'Huila', 'PITAL'),
(41, 41551, 'Huila', 'PITALITO'),
(41, 41615, 'Huila', 'RIVERA'),
(41, 41660, 'Huila', 'SALADOBLANCO'),
(41, 41668, 'Huila', 'SAN AGUSTÍN'),
(41, 41676, 'Huila', 'SANTA MARÍA'),
(41, 41770, 'Huila', 'SUAZA'),
(41, 41791, 'Huila', 'TARQUI'),
(41, 41797, 'Huila', 'TESALIA'),
(41, 41799, 'Huila', 'TELLO'),
(41, 41801, 'Huila', 'TERUEL'),
(41, 41807, 'Huila', 'TIMANÁ'),
(41, 41872, 'Huila', 'VILLAVIEJA'),
(41, 41885, 'Huila', 'YAGUARÁ'),
(44, 44001, 'La Guajira', 'RIOHACHA'),
(44, 44035, 'La Guajira', 'ALBANIA'),
(44, 44078, 'La Guajira', 'BARRANCAS'),
(44, 44090, 'La Guajira', 'DIBULLA'),
(44, 44098, 'La Guajira', 'DISTRACCIÓN'),
(44, 44110, 'La Guajira', 'EL MOLINO'),
(44, 44279, 'La Guajira', 'FONSECA'),
(44, 44378, 'La Guajira', 'HATONUEVO'),
(44, 44420, 'La Guajira', 'LA JAGUA DEL PILAR'),
(44, 44430, 'La Guajira', 'MAICAO'),
(44, 44560, 'La Guajira', 'MANAURE'),
(44, 44650, 'La Guajira', 'SAN JUAN DEL CESAR'),
(44, 44847, 'La Guajira', 'URIBIA'),
(44, 44855, 'La Guajira', 'URUMITA'),
(44, 44874, 'La Guajira', 'VILLANUEVA'),
(47, 47001, 'Magdalena', 'SANTA MARTA'),
(47, 47030, 'Magdalena', 'ALGARROBO'),
(47, 47053, 'Magdalena', 'ARACATACA'),
(47, 47058, 'Magdalena', 'ARIGUANÍ'),
(47, 47161, 'Magdalena', 'CERRO DE SAN ANTONIO'),
(47, 47170, 'Magdalena', 'CHIVOLO'),
(47, 47189, 'Magdalena', 'CIÉNAGA'),
(47, 47205, 'Magdalena', 'CONCORDIA'),
(47, 47245, 'Magdalena', 'EL BANCO'),
(47, 47258, 'Magdalena', 'EL PIÑÓN'),
(47, 47268, 'Magdalena', 'EL RETÉN'),
(47, 47288, 'Magdalena', 'FUNDACIÓN'),
(47, 47318, 'Magdalena', 'GUAMAL'),
(47, 47460, 'Magdalena', 'NUEVA GRANADA'),
(47, 47541, 'Magdalena', 'PEDRAZA'),
(47, 47545, 'Magdalena', 'PIJIÑO DEL CARMEN'),
(47, 47551, 'Magdalena', 'PIVIJAY'),
(47, 47555, 'Magdalena', 'PLATO'),
(47, 47570, 'Magdalena', 'PUEBLOVIEJO'),
(47, 47605, 'Magdalena', 'REMOLINO'),
(47, 47660, 'Magdalena', 'SABANAS DE SAN ÁNGEL'),
(47, 47675, 'Magdalena', 'SALAMINA'),
(47, 47692, 'Magdalena', 'SAN SEBASTIÁN DE BUENAVISTA'),
(47, 47703, 'Magdalena', 'SAN ZENÓN'),
(47, 47707, 'Magdalena', 'SANTA ANA'),
(47, 47720, 'Magdalena', 'SANTA BÁRBARA DE PINTO'),
(47, 47745, 'Magdalena', 'SITIONUEVO'),
(47, 47798, 'Magdalena', 'TENERIFE'),
(47, 47960, 'Magdalena', 'ZAPAYÁN'),
(47, 47980, 'Magdalena', 'ZONA BANANERA'),
(50, 50001, 'Meta', 'VILLAVICENCIO'),
(50, 50006, 'Meta', 'ACACÍAS'),
(50, 50110, 'Meta', 'BARRANCA DE UPÍA'),
(50, 50124, 'Meta', 'CABUYARO'),
(50, 50150, 'Meta', 'CASTILLA LA NUEVA'),
(50, 50223, 'Meta', 'CUBARRAL'),
(50, 50226, 'Meta', 'CUMARAL'),
(50, 50245, 'Meta', 'EL CALVARIO'),
(50, 50251, 'Meta', 'EL CASTILLO'),
(50, 50270, 'Meta', 'EL DORADO'),
(50, 50287, 'Meta', 'FUENTE DE ORO'),
(50, 50313, 'Meta', 'GRANADA'),
(50, 50318, 'Meta', 'GUAMAL'),
(50, 50325, 'Meta', 'MAPIRIPÁN'),
(50, 50330, 'Meta', 'MESETAS'),
(50, 50350, 'Meta', 'LA MACARENA'),
(50, 50370, 'Meta', 'URIBE'),
(50, 50400, 'Meta', 'LEJANÍAS'),
(50, 50450, 'Meta', 'PUERTO CONCORDIA'),
(50, 50568, 'Meta', 'PUERTO GAITÁN'),
(50, 50573, 'Meta', 'PUERTO LÓPEZ'),
(50, 50577, 'Meta', 'PUERTO LLERAS'),
(50, 50590, 'Meta', 'PUERTO RICO'),
(50, 50606, 'Meta', 'RESTREPO'),
(50, 50680, 'Meta', 'SAN CARLOS DE GUAROA'),
(50, 50683, 'Meta', 'SAN JUAN DE ARAMA'),
(50, 50686, 'Meta', 'SAN JUANITO'),
(50, 50689, 'Meta', 'SAN MARTÍN'),
(50, 50711, 'Meta', 'VISTAHERMOSA'),
(52, 52001, 'Nariño', 'PASTO'),
(52, 52019, 'Nariño', 'ALBÁN'),
(52, 52022, 'Nariño', 'ALDANA'),
(52, 52036, 'Nariño', 'ANCUYÁ'),
(52, 52051, 'Nariño', 'ARBOLEDA'),
(52, 52079, 'Nariño', 'BARBACOAS'),
(52, 52083, 'Nariño', 'BELÉN'),
(52, 52110, 'Nariño', 'BUESACO'),
(52, 52203, 'Nariño', 'COLÓN'),
(52, 52207, 'Nariño', 'CONSACÁ'),
(52, 52210, 'Nariño', 'CONTADERO'),
(52, 52215, 'Nariño', 'CÓRDOBA'),
(52, 52224, 'Nariño', 'CUASPÚD'),
(52, 52227, 'Nariño', 'CUMBAL'),
(52, 52233, 'Nariño', 'CUMBITARA'),
(52, 52240, 'Nariño', 'CHACHAGÜÍ'),
(52, 52250, 'Nariño', 'EL CHARCO'),
(52, 52254, 'Nariño', 'EL PEÑOL'),
(52, 52256, 'Nariño', 'EL ROSARIO'),
(52, 52258, 'Nariño', 'EL TABLÓN DE GÓMEZ'),
(52, 52260, 'Nariño', 'EL TAMBO'),
(52, 52287, 'Nariño', 'FUNES'),
(52, 52317, 'Nariño', 'GUACHUCAL'),
(52, 52320, 'Nariño', 'GUAITARILLA'),
(52, 52323, 'Nariño', 'GUALMATÁN'),
(52, 52352, 'Nariño', 'ILES'),
(52, 52354, 'Nariño', 'IMUÉS'),
(52, 52356, 'Nariño', 'IPIALES'),
(52, 52378, 'Nariño', 'LA CRUZ'),
(52, 52381, 'Nariño', 'LA FLORIDA'),
(52, 52385, 'Nariño', 'LA LLANADA'),
(52, 52390, 'Nariño', 'LA TOLA'),
(52, 52399, 'Nariño', 'LA UNIÓN'),
(52, 52405, 'Nariño', 'LEIVA'),
(52, 52411, 'Nariño', 'LINARES'),
(52, 52418, 'Nariño', 'LOS ANDES'),
(52, 52427, 'Nariño', 'MAGÜÍ'),
(52, 52435, 'Nariño', 'MALLAMA'),
(52, 52473, 'Nariño', 'MOSQUERA'),
(52, 52480, 'Nariño', 'NARIÑO'),
(52, 52490, 'Nariño', 'OLAYA HERRERA'),
(52, 52506, 'Nariño', 'OSPINA'),
(52, 52520, 'Nariño', 'FRANCISCO PIZARRO'),
(52, 52540, 'Nariño', 'POLICARPA'),
(52, 52560, 'Nariño', 'POTOSÍ'),
(52, 52565, 'Nariño', 'PROVIDENCIA'),
(52, 52573, 'Nariño', 'PUERRES'),
(52, 52585, 'Nariño', 'PUPIALES'),
(52, 52612, 'Nariño', 'RICAURTE'),
(52, 52621, 'Nariño', 'ROBERTO PAYÁN'),
(52, 52678, 'Nariño', 'SAMANIEGO'),
(52, 52683, 'Nariño', 'SANDONÁ'),
(52, 52685, 'Nariño', 'SAN BERNARDO'),
(52, 52687, 'Nariño', 'SAN LORENZO'),
(52, 52693, 'Nariño', 'SAN PABLO'),
(52, 52694, 'Nariño', 'SAN PEDRO DE CARTAGO'),
(52, 52696, 'Nariño', 'SANTA BÁRBARA'),
(52, 52699, 'Nariño', 'SANTACRUZ'),
(52, 52720, 'Nariño', 'SAPUYES'),
(52, 52786, 'Nariño', 'TAMINANGO'),
(52, 52788, 'Nariño', 'TANGUA'),
(52, 52835, 'Nariño', 'SAN ANDRÉS DE TUMACO'),
(52, 52838, 'Nariño', 'TÚQUERRES'),
(52, 52885, 'Nariño', 'YACUANQUER'),
(54, 54001, 'Norte de Santander', 'CÚCUTA'),
(54, 54003, 'Norte de Santander', 'ÁBREGO'),
(54, 54051, 'Norte de Santander', 'ARBOLEDAS'),
(54, 54099, 'Norte de Santander', 'BOCHALEMA'),
(54, 54109, 'Norte de Santander', 'BUCARASICA'),
(54, 54125, 'Norte de Santander', 'CÁCOTA'),
(54, 54128, 'Norte de Santander', 'CÁCHIRA'),
(54, 54172, 'Norte de Santander', 'CHINÁCOTA'),
(54, 54174, 'Norte de Santander', 'CHITAGÁ'),
(54, 54206, 'Norte de Santander', 'CONVENCIÓN'),
(54, 54223, 'Norte de Santander', 'CUCUTILLA'),
(54, 54239, 'Norte de Santander', 'DURANIA'),
(54, 54245, 'Norte de Santander', 'EL CARMEN'),
(54, 54250, 'Norte de Santander', 'EL TARRA'),
(54, 54261, 'Norte de Santander', 'EL ZULIA'),
(54, 54313, 'Norte de Santander', 'GRAMALOTE'),
(54, 54344, 'Norte de Santander', 'HACARÍ'),
(54, 54347, 'Norte de Santander', 'HERRÁN'),
(54, 54377, 'Norte de Santander', 'LABATECA'),
(54, 54385, 'Norte de Santander', 'LA ESPERANZA'),
(54, 54398, 'Norte de Santander', 'LA PLAYA'),
(54, 54405, 'Norte de Santander', 'LOS PATIOS'),
(54, 54418, 'Norte de Santander', 'LOURDES'),
(54, 54480, 'Norte de Santander', 'MUTISCUA'),
(54, 54498, 'Norte de Santander', 'OCAÑA'),
(54, 54518, 'Norte de Santander', 'PAMPLONA'),
(54, 54520, 'Norte de Santander', 'PAMPLONITA'),
(54, 54553, 'Norte de Santander', 'PUERTO SANTANDER'),
(54, 54599, 'Norte de Santander', 'RAGONVALIA'),
(54, 54660, 'Norte de Santander', 'SALAZAR'),
(54, 54670, 'Norte de Santander', 'SAN CALIXTO'),
(54, 54673, 'Norte de Santander', 'SAN CAYETANO'),
(54, 54680, 'Norte de Santander', 'SANTIAGO'),
(54, 54720, 'Norte de Santander', 'SARDINATA'),
(54, 54743, 'Norte de Santander', 'SILOS'),
(54, 54800, 'Norte de Santander', 'TEORAMA'),
(54, 54810, 'Norte de Santander', 'TIBÚ'),
(54, 54820, 'Norte de Santander', 'TOLEDO'),
(54, 54871, 'Norte de Santander', 'VILLA CARO'),
(54, 54874, 'Norte de Santander', 'VILLA DEL ROSARIO'),
(63, 63001, 'Quindio', 'ARMENIA'),
(63, 63111, 'Quindio', 'BUENAVISTA'),
(63, 63130, 'Quindio', 'CALARCÁ'),
(63, 63190, 'Quindio', 'CIRCASIA'),
(63, 63212, 'Quindio', 'CÓRDOBA'),
(63, 63272, 'Quindio', 'FILANDIA'),
(63, 63302, 'Quindio', 'GÉNOVA'),
(63, 63401, 'Quindio', 'LA TEBAIDA'),
(63, 63470, 'Quindio', 'MONTENEGRO'),
(63, 63548, 'Quindio', 'PIJAO'),
(63, 63594, 'Quindio', 'QUIMBAYA'),
(63, 63690, 'Quindio', 'SALENTO'),
(66, 66001, 'Risaralda', 'PEREIRA'),
(66, 66045, 'Risaralda', 'APÍA'),
(66, 66075, 'Risaralda', 'BALBOA'),
(66, 66088, 'Risaralda', 'BELÉN DE UMBRÍA'),
(66, 66170, 'Risaralda', 'DOSQUEBRADAS'),
(66, 66318, 'Risaralda', 'GUÁTICA'),
(66, 66383, 'Risaralda', 'LA CELIA'),
(66, 66400, 'Risaralda', 'LA VIRGINIA'),
(66, 66440, 'Risaralda', 'MARSELLA'),
(66, 66456, 'Risaralda', 'MISTRATÓ'),
(66, 66572, 'Risaralda', 'PUEBLO RICO'),
(66, 66594, 'Risaralda', 'QUINCHÍA'),
(66, 66682, 'Risaralda', 'SANTA ROSA DE CABAL'),
(66, 66687, 'Risaralda', 'SANTUARIO'),
(68, 68001, 'Santander', 'BUCARAMANGA'),
(68, 68013, 'Santander', 'AGUADA'),
(68, 68020, 'Santander', 'ALBANIA'),
(68, 68051, 'Santander', 'ARATOCA'),
(68, 68077, 'Santander', 'BARBOSA'),
(68, 68079, 'Santander', 'BARICHARA'),
(68, 68081, 'Santander', 'BARRANCABERMEJA'),
(68, 68092, 'Santander', 'BETULIA'),
(68, 68101, 'Santander', 'BOLÍVAR'),
(68, 68121, 'Santander', 'CABRERA'),
(68, 68132, 'Santander', 'CALIFORNIA'),
(68, 68147, 'Santander', 'CAPITANEJO'),
(68, 68152, 'Santander', 'CARCASÍ'),
(68, 68160, 'Santander', 'CEPITÁ'),
(68, 68162, 'Santander', 'CERRITO'),
(68, 68167, 'Santander', 'CHARALÁ'),
(68, 68169, 'Santander', 'CHARTA'),
(68, 68176, 'Santander', 'CHIMA'),
(68, 68179, 'Santander', 'CHIPATÁ'),
(68, 68190, 'Santander', 'CIMITARRA'),
(68, 68207, 'Santander', 'CONCEPCIÓN'),
(68, 68209, 'Santander', 'CONFINES'),
(68, 68211, 'Santander', 'CONTRATACIÓN'),
(68, 68217, 'Santander', 'COROMORO'),
(68, 68229, 'Santander', 'CURITÍ'),
(68, 68235, 'Santander', 'EL CARMEN DE CHUCURÍ'),
(68, 68245, 'Santander', 'EL GUACAMAYO'),
(68, 68250, 'Santander', 'EL PEÑÓN'),
(68, 68255, 'Santander', 'EL PLAYÓN'),
(68, 68264, 'Santander', 'ENCINO'),
(68, 68266, 'Santander', 'ENCISO'),
(68, 68271, 'Santander', 'FLORIÁN'),
(68, 68276, 'Santander', 'FLORIDABLANCA'),
(68, 68296, 'Santander', 'GALÁN'),
(68, 68298, 'Santander', 'GÁMBITA'),
(68, 68307, 'Santander', 'GIRÓN'),
(68, 68318, 'Santander', 'GUACA'),
(68, 68320, 'Santander', 'GUADALUPE'),
(68, 68322, 'Santander', 'GUAPOTÁ'),
(68, 68324, 'Santander', 'GUAVATÁ'),
(68, 68327, 'Santander', 'GÜEPSA'),
(68, 68344, 'Santander', 'HATO'),
(68, 68368, 'Santander', 'JESÚS MARÍA'),
(68, 68370, 'Santander', 'JORDÁN'),
(68, 68377, 'Santander', 'LA BELLEZA'),
(68, 68385, 'Santander', 'LANDÁZURI'),
(68, 68397, 'Santander', 'LA PAZ'),
(68, 68406, 'Santander', 'LEBRIJA'),
(68, 68418, 'Santander', 'LOS SANTOS'),
(68, 68425, 'Santander', 'MACARAVITA'),
(68, 68432, 'Santander', 'MÁLAGA'),
(68, 68444, 'Santander', 'MATANZA'),
(68, 68464, 'Santander', 'MOGOTES'),
(68, 68468, 'Santander', 'MOLAGAVITA'),
(68, 68498, 'Santander', 'OCAMONTE'),
(68, 68500, 'Santander', 'OIBA'),
(68, 68502, 'Santander', 'ONZAGA'),
(68, 68522, 'Santander', 'PALMAR'),
(68, 68524, 'Santander', 'PALMAS DEL SOCORRO'),
(68, 68533, 'Santander', 'PÁRAMO'),
(68, 68547, 'Santander', 'PIEDECUESTA'),
(68, 68549, 'Santander', 'PINCHOTE'),
(68, 68572, 'Santander', 'PUENTE NACIONAL'),
(68, 68573, 'Santander', 'PUERTO PARRA'),
(68, 68575, 'Santander', 'PUERTO WILCHES'),
(68, 68615, 'Santander', 'RIONEGRO'),
(68, 68655, 'Santander', 'SABANA DE TORRES'),
(68, 68669, 'Santander', 'SAN ANDRÉS'),
(68, 68673, 'Santander', 'SAN BENITO'),
(68, 68679, 'Santander', 'SAN GIL'),
(68, 68682, 'Santander', 'SAN JOAQUÍN'),
(68, 68684, 'Santander', 'SAN JOSÉ DE MIRANDA'),
(68, 68686, 'Santander', 'SAN MIGUEL'),
(68, 68689, 'Santander', 'SAN VICENTE DE CHUCURÍ'),
(68, 68705, 'Santander', 'SANTA BÁRBARA'),
(68, 68720, 'Santander', 'SANTA HELENA DEL OPÓN'),
(68, 68745, 'Santander', 'SIMACOTA'),
(68, 68755, 'Santander', 'SOCORRO'),
(68, 68770, 'Santander', 'SUAITA'),
(68, 68773, 'Santander', 'SUCRE'),
(68, 68780, 'Santander', 'SURATÁ'),
(68, 68820, 'Santander', 'TONA'),
(68, 68855, 'Santander', 'VALLE DE SAN JOSÉ'),
(68, 68861, 'Santander', 'VÉLEZ'),
(68, 68867, 'Santander', 'VETAS'),
(68, 68872, 'Santander', 'VILLANUEVA'),
(68, 68895, 'Santander', 'ZAPATOCA'),
(70, 70001, 'Sucre', 'SINCELEJO'),
(70, 70110, 'Sucre', 'BUENAVISTA'),
(70, 70124, 'Sucre', 'CAIMITO'),
(70, 70204, 'Sucre', 'COLOSÓ'),
(70, 70215, 'Sucre', 'COROZAL'),
(70, 70221, 'Sucre', 'COVEÑAS'),
(70, 70230, 'Sucre', 'CHALÁN'),
(70, 70233, 'Sucre', 'EL ROBLE'),
(70, 70235, 'Sucre', 'GALERAS'),
(70, 70265, 'Sucre', 'GUARANDA'),
(70, 70400, 'Sucre', 'LA UNIÓN'),
(70, 70418, 'Sucre', 'LOS PALMITOS'),
(70, 70429, 'Sucre', 'MAJAGUAL'),
(70, 70473, 'Sucre', 'MORROA'),
(70, 70508, 'Sucre', 'OVEJAS'),
(70, 70523, 'Sucre', 'PALMITO'),
(70, 70670, 'Sucre', 'SAMPUÉS'),
(70, 70678, 'Sucre', 'SAN BENITO ABAD'),
(70, 70702, 'Sucre', 'SAN JUAN DE BETULIA'),
(70, 70708, 'Sucre', 'SAN MARCOS'),
(70, 70713, 'Sucre', 'SAN ONOFRE'),
(70, 70717, 'Sucre', 'SAN PEDRO'),
(70, 70742, 'Sucre', 'SAN LUIS DE SINCÉ'),
(70, 70771, 'Sucre', 'SUCRE'),
(70, 70820, 'Sucre', 'SANTIAGO DE TOLÚ'),
(70, 70823, 'Sucre', 'TOLÚ VIEJO'),
(73, 73001, 'Tolima', 'IBAGUÉ'),
(73, 73024, 'Tolima', 'ALPUJARRA'),
(73, 73026, 'Tolima', 'ALVARADO'),
(73, 73030, 'Tolima', 'AMBALEMA'),
(73, 73043, 'Tolima', 'ANZOÁTEGUI'),
(73, 73055, 'Tolima', 'ARMERO'),
(73, 73067, 'Tolima', 'ATACO'),
(73, 73124, 'Tolima', 'CAJAMARCA'),
(73, 73148, 'Tolima', 'CARMEN DE APICALÁ'),
(73, 73152, 'Tolima', 'CASABIANCA'),
(73, 73168, 'Tolima', 'CHAPARRAL'),
(73, 73200, 'Tolima', 'COELLO'),
(73, 73217, 'Tolima', 'COYAIMA'),
(73, 73226, 'Tolima', 'CUNDAY'),
(73, 73236, 'Tolima', 'DOLORES'),
(73, 73268, 'Tolima', 'ESPINAL'),
(73, 73270, 'Tolima', 'FALAN'),
(73, 73275, 'Tolima', 'FLANDES'),
(73, 73283, 'Tolima', 'FRESNO'),
(73, 73319, 'Tolima', 'GUAMO'),
(73, 73347, 'Tolima', 'HERVEO'),
(73, 73349, 'Tolima', 'HONDA'),
(73, 73352, 'Tolima', 'ICONONZO'),
(73, 73408, 'Tolima', 'LÉRIDA'),
(73, 73411, 'Tolima', 'LÍBANO'),
(73, 73443, 'Tolima', 'SAN SEBASTIÁN DE MARIQUITA'),
(73, 73449, 'Tolima', 'MELGAR'),
(73, 73461, 'Tolima', 'MURILLO'),
(73, 73483, 'Tolima', 'NATAGAIMA'),
(73, 73504, 'Tolima', 'ORTEGA'),
(73, 73520, 'Tolima', 'PALOCABILDO'),
(73, 73547, 'Tolima', 'PIEDRAS'),
(73, 73555, 'Tolima', 'PLANADAS'),
(73, 73563, 'Tolima', 'PRADO'),
(73, 73585, 'Tolima', 'PURIFICACIÓN'),
(73, 73616, 'Tolima', 'RIOBLANCO'),
(73, 73622, 'Tolima', 'RONCESVALLES'),
(73, 73624, 'Tolima', 'ROVIRA'),
(73, 73671, 'Tolima', 'SALDAÑA'),
(73, 73675, 'Tolima', 'SAN ANTONIO'),
(73, 73678, 'Tolima', 'SAN LUIS'),
(73, 73686, 'Tolima', 'SANTA ISABEL'),
(73, 73770, 'Tolima', 'SUÁREZ'),
(73, 73854, 'Tolima', 'VALLE DE SAN JUAN'),
(73, 73861, 'Tolima', 'VENADILLO'),
(73, 73870, 'Tolima', 'VILLAHERMOSA'),
(73, 73873, 'Tolima', 'VILLARRICA'),
(76, 76001, 'Valle del Cauca', 'CALI'),
(76, 76020, 'Valle del Cauca', 'ALCALÁ'),
(76, 76036, 'Valle del Cauca', 'ANDALUCÍA'),
(76, 76041, 'Valle del Cauca', 'ANSERMANUEVO'),
(76, 76054, 'Valle del Cauca', 'ARGELIA'),
(76, 76100, 'Valle del Cauca', 'BOLÍVAR'),
(76, 76109, 'Valle del Cauca', 'BUENAVENTURA'),
(76, 76111, 'Valle del Cauca', 'GUADALAJARA DE BUGA'),
(76, 76113, 'Valle del Cauca', 'BUGALAGRANDE'),
(76, 76122, 'Valle del Cauca', 'CAICEDONIA'),
(76, 76126, 'Valle del Cauca', 'CALIMA'),
(76, 76130, 'Valle del Cauca', 'CANDELARIA'),
(76, 76147, 'Valle del Cauca', 'CARTAGO'),
(76, 76233, 'Valle del Cauca', 'DAGUA'),
(76, 76243, 'Valle del Cauca', 'EL ÁGUILA'),
(76, 76246, 'Valle del Cauca', 'EL CAIRO'),
(76, 76248, 'Valle del Cauca', 'EL CERRITO'),
(76, 76250, 'Valle del Cauca', 'EL DOVIO'),
(76, 76275, 'Valle del Cauca', 'FLORIDA'),
(76, 76306, 'Valle del Cauca', 'GINEBRA'),
(76, 76318, 'Valle del Cauca', 'GUACARÍ'),
(76, 76364, 'Valle del Cauca', 'JAMUNDÍ'),
(76, 76377, 'Valle del Cauca', 'LA CUMBRE'),
(76, 76400, 'Valle del Cauca', 'LA UNIÓN'),
(76, 76403, 'Valle del Cauca', 'LA VICTORIA'),
(76, 76497, 'Valle del Cauca', 'OBANDO'),
(76, 76520, 'Valle del Cauca', 'PALMIRA'),
(76, 76563, 'Valle del Cauca', 'PRADERA'),
(76, 76606, 'Valle del Cauca', 'RESTREPO'),
(76, 76616, 'Valle del Cauca', 'RIOFRÍO'),
(76, 76622, 'Valle del Cauca', 'ROLDANILLO'),
(76, 76670, 'Valle del Cauca', 'SAN PEDRO'),
(76, 76736, 'Valle del Cauca', 'SEVILLA'),
(76, 76823, 'Valle del Cauca', 'TORO'),
(76, 76828, 'Valle del Cauca', 'TRUJILLO'),
(76, 76834, 'Valle del Cauca', 'TULUÁ'),
(76, 76845, 'Valle del Cauca', 'ULLOA'),
(76, 76863, 'Valle del Cauca', 'VERSALLES'),
(76, 76869, 'Valle del Cauca', 'VIJES'),
(76, 76890, 'Valle del Cauca', 'YOTOCO'),
(76, 76892, 'Valle del Cauca', 'YUMBO'),
(76, 76895, 'Valle del Cauca', 'ZARZAL'),
(81, 81001, 'Arauca', 'ARAUCA'),
(81, 81065, 'Arauca', 'ARAUQUITA'),
(81, 81220, 'Arauca', 'CRAVO NORTE'),
(81, 81300, 'Arauca', 'FORTUL'),
(81, 81591, 'Arauca', 'PUERTO RONDÓN'),
(81, 81736, 'Arauca', 'SARAVENA'),
(81, 81794, 'Arauca', 'TAME'),
(85, 85001, 'Casanare', 'YOPAL'),
(85, 85010, 'Casanare', 'AGUAZUL'),
(85, 85015, 'Casanare', 'CHÁMEZA'),
(85, 85125, 'Casanare', 'HATO COROZAL'),
(85, 85136, 'Casanare', 'LA SALINA'),
(85, 85139, 'Casanare', 'MANÍ'),
(85, 85162, 'Casanare', 'MONTERREY'),
(85, 85225, 'Casanare', 'NUNCHÍA'),
(85, 85230, 'Casanare', 'OROCUÉ'),
(85, 85250, 'Casanare', 'PAZ DE ARIPORO'),
(85, 85263, 'Casanare', 'PORE'),
(85, 85279, 'Casanare', 'RECETOR'),
(85, 85300, 'Casanare', 'SABANALARGA'),
(85, 85315, 'Casanare', 'SÁCAMA'),
(85, 85325, 'Casanare', 'SAN LUIS DE PALENQUE'),
(85, 85400, 'Casanare', 'TÁMARA'),
(85, 85410, 'Casanare', 'TAURAMENA'),
(85, 85430, 'Casanare', 'TRINIDAD'),
(85, 85440, 'Casanare', 'VILLANUEVA'),
(86, 86001, 'Putumayo', 'MOCOA'),
(86, 86219, 'Putumayo', 'COLÓN'),
(86, 86320, 'Putumayo', 'ORITO'),
(86, 86568, 'Putumayo', 'PUERTO ASÍS'),
(86, 86569, 'Putumayo', 'PUERTO CAICEDO'),
(86, 86571, 'Putumayo', 'PUERTO GUZMÁN'),
(86, 86573, 'Putumayo', 'PUERTO LEGUÍZAMO'),
(86, 86749, 'Putumayo', 'SIBUNDOY'),
(86, 86755, 'Putumayo', 'SAN FRANCISCO'),
(86, 86757, 'Putumayo', 'SAN MIGUEL'),
(86, 86760, 'Putumayo', 'SANTIAGO'),
(86, 86865, 'Putumayo', 'VALLE DEL GUAMUEZ'),
(86, 86885, 'Putumayo', 'VILLAGARZÓN'),
(88, 88001, 'Archipiélago de San Andrés, Providencia y Santa Catalina', 'SAN ANDRÉS'),
(88, 88564, 'Archipiélago de San Andrés, Providencia y Santa Catalina', 'PROVIDENCIA'),
(91, 91001, 'Amazonas', 'LETICIA'),
(91, 91263, 'Amazonas', 'EL ENCANTO'),
(91, 91405, 'Amazonas', 'LA CHORRERA'),
(91, 91407, 'Amazonas', 'LA PEDRERA'),
(91, 91430, 'Amazonas', 'LA VICTORIA'),
(91, 91460, 'Amazonas', 'MIRITÍ - PARANÁ'),
(91, 91530, 'Amazonas', 'PUERTO ALEGRÍA'),
(91, 91536, 'Amazonas', 'PUERTO ARICA'),
(91, 91540, 'Amazonas', 'PUERTO NARIÑO'),
(91, 91669, 'Amazonas', 'PUERTO SANTANDER'),
(91, 91798, 'Amazonas', 'TARAPACÁ'),
(94, 94001, 'Guainía', 'INÍRIDA'),
(94, 94343, 'Guainía', 'BARRANCO MINAS'),
(94, 94663, 'Guainía', 'MAPIRIPANA'),
(94, 94883, 'Guainía', 'SAN FELIPE'),
(94, 94884, 'Guainía', 'PUERTO COLOMBIA'),
(94, 94885, 'Guainía', 'LA GUADALUPE'),
(94, 94886, 'Guainía', 'CACAHUAL'),
(94, 94887, 'Guainía', 'PANA PANA'),
(94, 94888, 'Guainía', 'MORICHAL'),
(95, 95001, 'Guaviare', 'SAN JOSÉ DEL GUAVIARE'),
(95, 95015, 'Guaviare', 'CALAMAR'),
(95, 95025, 'Guaviare', 'EL RETORNO'),
(95, 95200, 'Guaviare', 'MIRAFLORES'),
(97, 97001, 'Vaupés', 'MITÚ'),
(97, 97161, 'Vaupés', 'CARURÚ'),
(97, 97511, 'Vaupés', 'PACOA'),
(97, 97666, 'Vaupés', 'TARAIRA'),
(97, 97777, 'Vaupés', 'PAPUNAHUA'),
(97, 97889, 'Vaupés', 'YAVARATÉ'),
(99, 99001, 'Vichada', 'PUERTO CARREÑO'),
(99, 99524, 'Vichada', 'LA PRIMAVERA'),
(99, 99624, 'Vichada', 'SANTA ROSALÍA'),
(99, 99773, 'Vichada', 'CUMARIBO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `param_grupo_instrumentos`
--

CREATE TABLE `param_grupo_instrumentos` (
  `id_grupo_instrumentos` int(10) NOT NULL,
  `fk_id_prueba` int(10) NOT NULL,
  `nombre_grupo_instrumentos` varchar(50) NOT NULL,
  `fecha` date NOT NULL,
  `fecha_creacion` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `param_grupo_instrumentos`
--

INSERT INTO `param_grupo_instrumentos` (`id_grupo_instrumentos`, `fk_id_prueba`, `nombre_grupo_instrumentos`, `fecha`, `fecha_creacion`) VALUES
(1, 1, 'GSA TyT.', '2017-05-09', '2017-05-12'),
(2, 1, 'EK TyT', '0000-00-00', '2017-05-12'),
(3, 1, 'Recluso TyT', '0000-00-00', '2017-05-12');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `param_organizaciones`
--

CREATE TABLE `param_organizaciones` (
  `id_organizacion` int(1) NOT NULL,
  `nombre_organizacion` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `param_organizaciones`
--

INSERT INTO `param_organizaciones` (`id_organizacion`, `nombre_organizacion`) VALUES
(1, 'Penitenciarías INPEC'),
(2, 'Penitenciarías Distritales'),
(3, 'Centro de reclusión de menores'),
(4, 'Consulados.'),
(5, 'Institución de educación media'),
(6, 'Institución de educación básica'),
(7, 'IES'),
(8, 'Otro');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `param_regiones`
--

CREATE TABLE `param_regiones` (
  `id_region` int(1) NOT NULL,
  `nombre_region` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `param_regiones`
--

INSERT INTO `param_regiones` (`id_region`, `nombre_region`) VALUES
(1, 'Barranquilla'),
(2, 'Bogotá'),
(3, 'Bucaramanga\r\n'),
(4, 'Cali'),
(5, 'Cartagena'),
(6, 'Cúcuta'),
(7, 'Ibagué'),
(8, 'Manizales'),
(9, 'Medellín'),
(10, 'Montería'),
(11, 'Neiva'),
(12, 'Pasto'),
(13, 'Popayán'),
(14, 'Tunja'),
(15, 'Valledupar');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `param_roles`
--

CREATE TABLE `param_roles` (
  `id_rol` int(1) NOT NULL,
  `nombre_rol` varchar(100) NOT NULL,
  `descripcion` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `param_roles`
--

INSERT INTO `param_roles` (`id_rol`, `nombre_rol`, `descripcion`) VALUES
(1, 'Administrador', 'Acceso a todas las funcionalidades del sistema'),
(2, 'Directivo ICFES', 'Acceso a las funcionalidades objeto del negocio a nivel nacional'),
(3, 'Coordinador regional', 'Acceso a las funcionalidades objeto del negocio a nivel regional'),
(4, 'Delegado', 'Acceso a las funcionalidades objeto del negocio a nivel de sitio de aplicación');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `param_tipo_alerta`
--

CREATE TABLE `param_tipo_alerta` (
  `id_tipo_alerta` int(1) NOT NULL,
  `nombre_tipo_alerta` varchar(50) NOT NULL,
  `descripcion_tipo_alerta` text NOT NULL,
  `observacion_alerta` text NOT NULL,
  `fecha_creacion` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `param_tipo_alerta`
--

INSERT INTO `param_tipo_alerta` (`id_tipo_alerta`, `nombre_tipo_alerta`, `descripcion_tipo_alerta`, `observacion_alerta`, `fecha_creacion`) VALUES
(1, 'Informativa', 'Botón (Aceptar o Cerrar). No tiene registro, solo se muestra para informar sobre algún tema de interés. Pasados cinco (5) minutos se debe dejar de mostrar.', '- Debe incluir botón Aceptar o Cerrar, con el objeto que el usuario pueda dejar de visualizar o cerrar el mensaje.\r\n- Después de cinco (5) minutos debe dejar de mostrarse.', '2017-05-10'),
(2, 'Notificación', 'Botones (Si - No). Se espera respuesta del usuario y lleva registro. En caso de respuesta afirmativa (Si), se debe hacer registro y no es obligatorio diligenciar observación o motivo. En caso de respuesta negativa (No), se debe hacer registro y es obligatorio consignar la observación o motivo. En caso de no respuesta, se debe hacer registro automático o asistido por el sistema con observación o motivo (No respuesta) y notificar a usuario de nivel jerárquico superior.', '- Debe incluir botones Si - No.\r\n- Debe incluir una caja de texto en donde se pueden registrar observaciones o motivos, que solo es obligatorio en su registro cuando se selecciona opción "No" o cuando no hay respuesta por parte del usuario, caso en el cual el sistema hace registro automático o asistido.\r\n- Después de quince (15) minutos sin haber recibido respuesta "No respuesta", se debe hacer registro automático o asistido por el sistema con observación o motivo (No respuesta) y se envía notificación a usuario de nivel jerárquico superior. Una vez se hace registro y notifica al nivel jerárquico superior, el mensaje debe dejar de mostrase.', '2017-05-10'),
(3, 'Consolidación', 'Botón (Enviar). Tiene registro obligatorio de una cifra o valor, opcional se puede registrar algún motivo u observación. En caso de no respuesta, se debe hacer registro automático o asistido por el sistema con motivo (No respuesta) y notificar a usuario de nivel jerárquico superior.', '- Debe incluir botón Enviar.\r\n- Debe incluir una caja de texto en donde se pueden registrar observaciones o motivos; que no tiene obligatoriedad en su registro, excepto cuando no hay respuesta por parte del usuario, caso en el cual el sistema hace registro automático.\r\n- Después de quince (15) minutos sin haber recibido respuesta "No respuesta", se debe hacer registro automático o asistido por el sistema con observación o motivo (No respuesta) y se envía notificación a usuario de nivel jerárquico superior. Una vez se hace registro y notifica al nivel jerárquico superior, el mensaje debe dejar de mostrase.', '2017-05-10');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `param_zonas`
--

CREATE TABLE `param_zonas` (
  `id_zona` int(1) NOT NULL,
  `nombre_zona` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `param_zonas`
--

INSERT INTO `param_zonas` (`id_zona`, `nombre_zona`) VALUES
(1, 'Centro'),
(2, 'Norte'),
(3, 'Sur'),
(4, 'Oriente'),
(5, 'Occidente'),
(6, 'Nororiente'),
(7, 'Noroccidente'),
(8, 'Suroriente'),
(9, 'Suroccidente');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pruebas`
--

CREATE TABLE `pruebas` (
  `id_prueba` int(10) NOT NULL,
  `nombre_prueba` varchar(100) NOT NULL,
  `descripcion_prueba` text NOT NULL,
  `anio_prueba` int(1) NOT NULL,
  `semestre_prueba` int(1) NOT NULL,
  `fecha_creacion` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `pruebas`
--

INSERT INTO `pruebas` (`id_prueba`, `nombre_prueba`, `descripcion_prueba`, `anio_prueba`, `semestre_prueba`, `fecha_creacion`) VALUES
(1, 'Saber TyT', 'Exámenes de competencias genéricas, pruebas saber Técnico y Tecnólogo TyT', 2017, 2, '2017-05-13');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sesiones`
--

CREATE TABLE `sesiones` (
  `id_sesion` int(10) NOT NULL,
  `fk_id_grupo_instrumentos` int(10) NOT NULL,
  `sesion_prueba` varchar(10) NOT NULL,
  `hora_inicio_prueba` varchar(10) DEFAULT NULL,
  `hora_fin_prueba` varchar(10) DEFAULT NULL,
  `fecha_creacion` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `sesiones`
--

INSERT INTO `sesiones` (`id_sesion`, `fk_id_grupo_instrumentos`, `sesion_prueba`, `hora_inicio_prueba`, `hora_fin_prueba`, `fecha_creacion`) VALUES
(1, 1, '1', '04:30', '10:00', '2017-05-16');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sitios`
--

CREATE TABLE `sitios` (
  `id_sitio` int(10) NOT NULL,
  `nombre_sitio` varchar(100) NOT NULL,
  `direccion_sitio` varchar(100) NOT NULL,
  `barrio_sitio` varchar(100) NOT NULL,
  `telefono_sitio` varchar(20) NOT NULL,
  `fax_sitio` varchar(10) DEFAULT NULL,
  `celular_sitio` varchar(10) NOT NULL,
  `email_sitio` varchar(50) NOT NULL,
  `codigo_postal_sitio` varchar(10) NOT NULL,
  `fk_id_organizacion` int(1) NOT NULL,
  `fk_id_region` int(1) NOT NULL,
  `fk_dpto_divipola` int(1) NOT NULL,
  `fk_mpio_divipola` int(3) NOT NULL,
  `fk_id_zona` int(1) NOT NULL,
  `cotacto_nombres` varchar(100) DEFAULT NULL,
  `cotacto_apellidos` varchar(100) DEFAULT NULL,
  `cotacto_telefono` varchar(10) DEFAULT NULL,
  `cotacto_celular` varchar(10) DEFAULT NULL,
  `cotacto_email` varchar(50) DEFAULT NULL,
  `estado_sitio` int(1) NOT NULL DEFAULT '1' COMMENT '1:activo; 2:inactivo',
  `fecha_creacion` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `sitios`
--

INSERT INTO `sitios` (`id_sitio`, `nombre_sitio`, `direccion_sitio`, `barrio_sitio`, `telefono_sitio`, `fax_sitio`, `celular_sitio`, `email_sitio`, `codigo_postal_sitio`, `fk_id_organizacion`, `fk_id_region`, `fk_dpto_divipola`, `fk_mpio_divipola`, `fk_id_zona`, `cotacto_nombres`, `cotacto_apellidos`, `cotacto_telefono`, `cotacto_celular`, `cotacto_email`, `estado_sitio`, `fecha_creacion`) VALUES
(1, 'Canada', '6408 Mackenzie', 'Mackenzie', '333333', '5555555', '3135461642', 'benmotta@gmail.com', 't4b 3v7', 1, 15, 99, 99773, 9, NULL, NULL, NULL, NULL, NULL, 1, '2017-05-12');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id_usuario` int(10) NOT NULL,
  `numero_documento` int(10) NOT NULL,
  `nombres_usuario` varchar(50) NOT NULL,
  `apellidos_usuario` varchar(50) NOT NULL,
  `direccion_usuario` varchar(250) NOT NULL,
  `telefono_fijo` varchar(12) DEFAULT NULL,
  `celular` varchar(12) NOT NULL,
  `email` varchar(70) DEFAULT NULL,
  `log_user` int(10) NOT NULL,
  `fecha_creacion` date DEFAULT NULL,
  `password` varchar(50) NOT NULL,
  `fk_id_rol` int(1) NOT NULL,
  `estado` int(1) NOT NULL DEFAULT '1' COMMENT '1:active; 2:inactive',
  `fk_id_sitio` int(10) DEFAULT NULL,
  `fk_id_prueba` int(10) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id_usuario`, `numero_documento`, `nombres_usuario`, `apellidos_usuario`, `direccion_usuario`, `telefono_fijo`, `celular`, `email`, `log_user`, `fecha_creacion`, `password`, `fk_id_rol`, `estado`, `fk_id_sitio`, `fk_id_prueba`) VALUES
(1, 12645615, 'Benjamin', 'Motta', 'Cra. 2 No. 16a-38', '3347766', '3015505382', 'benmotta@gmail.com', 12645615, '2017-05-01', 'e10adc3949ba59abbe56e057f20f883e', 1, 1, 1, 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `alertas`
--
ALTER TABLE `alertas`
  ADD PRIMARY KEY (`id_alerta`),
  ADD KEY `fk_id_tipo_alerta` (`fk_id_tipo_alerta`),
  ADD KEY `fk_id_rol` (`fk_id_rol`),
  ADD KEY `fk_id_prueba` (`fk_id_sesion`);

--
-- Indices de la tabla `param_divipola`
--
ALTER TABLE `param_divipola`
  ADD PRIMARY KEY (`mpio_divipola`),
  ADD KEY `dpto_divipola` (`dpto_divipola`);

--
-- Indices de la tabla `param_grupo_instrumentos`
--
ALTER TABLE `param_grupo_instrumentos`
  ADD PRIMARY KEY (`id_grupo_instrumentos`),
  ADD KEY `fk_id_prueba` (`fk_id_prueba`);

--
-- Indices de la tabla `param_organizaciones`
--
ALTER TABLE `param_organizaciones`
  ADD PRIMARY KEY (`id_organizacion`);

--
-- Indices de la tabla `param_regiones`
--
ALTER TABLE `param_regiones`
  ADD PRIMARY KEY (`id_region`);

--
-- Indices de la tabla `param_roles`
--
ALTER TABLE `param_roles`
  ADD PRIMARY KEY (`id_rol`);

--
-- Indices de la tabla `param_tipo_alerta`
--
ALTER TABLE `param_tipo_alerta`
  ADD PRIMARY KEY (`id_tipo_alerta`);

--
-- Indices de la tabla `param_zonas`
--
ALTER TABLE `param_zonas`
  ADD PRIMARY KEY (`id_zona`);

--
-- Indices de la tabla `pruebas`
--
ALTER TABLE `pruebas`
  ADD PRIMARY KEY (`id_prueba`),
  ADD KEY `anio_prueba` (`anio_prueba`);

--
-- Indices de la tabla `sesiones`
--
ALTER TABLE `sesiones`
  ADD PRIMARY KEY (`id_sesion`),
  ADD KEY `fk_id_grupo_instrumentos` (`fk_id_grupo_instrumentos`);

--
-- Indices de la tabla `sitios`
--
ALTER TABLE `sitios`
  ADD PRIMARY KEY (`id_sitio`),
  ADD KEY `fk_id_organizacion` (`fk_id_organizacion`),
  ADD KEY `fk_id_region` (`fk_id_region`),
  ADD KEY `fk_id_zona` (`fk_id_zona`),
  ADD KEY `fk_dpto_divipola` (`fk_dpto_divipola`),
  ADD KEY `fk_mpio_divipola` (`fk_mpio_divipola`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id_usuario`),
  ADD UNIQUE KEY `numero_documento` (`numero_documento`),
  ADD UNIQUE KEY `log_user` (`log_user`),
  ADD KEY `fk_id_rol` (`fk_id_rol`),
  ADD KEY `fk_id_sitio` (`fk_id_sitio`),
  ADD KEY `fk_id_prueba` (`fk_id_prueba`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `alertas`
--
ALTER TABLE `alertas`
  MODIFY `id_alerta` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `param_grupo_instrumentos`
--
ALTER TABLE `param_grupo_instrumentos`
  MODIFY `id_grupo_instrumentos` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `param_organizaciones`
--
ALTER TABLE `param_organizaciones`
  MODIFY `id_organizacion` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT de la tabla `param_regiones`
--
ALTER TABLE `param_regiones`
  MODIFY `id_region` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT de la tabla `param_roles`
--
ALTER TABLE `param_roles`
  MODIFY `id_rol` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `param_tipo_alerta`
--
ALTER TABLE `param_tipo_alerta`
  MODIFY `id_tipo_alerta` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `param_zonas`
--
ALTER TABLE `param_zonas`
  MODIFY `id_zona` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT de la tabla `pruebas`
--
ALTER TABLE `pruebas`
  MODIFY `id_prueba` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `sesiones`
--
ALTER TABLE `sesiones`
  MODIFY `id_sesion` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `sitios`
--
ALTER TABLE `sitios`
  MODIFY `id_sitio` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id_usuario` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `param_grupo_instrumentos`
--
ALTER TABLE `param_grupo_instrumentos`
  ADD CONSTRAINT `param_grupo_instrumentos_ibfk_1` FOREIGN KEY (`fk_id_prueba`) REFERENCES `pruebas` (`id_prueba`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `sesiones`
--
ALTER TABLE `sesiones`
  ADD CONSTRAINT `sesiones_ibfk_2` FOREIGN KEY (`fk_id_grupo_instrumentos`) REFERENCES `param_grupo_instrumentos` (`id_grupo_instrumentos`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `sitios`
--
ALTER TABLE `sitios`
  ADD CONSTRAINT `sitios_ibfk_1` FOREIGN KEY (`fk_id_zona`) REFERENCES `param_zonas` (`id_zona`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `sitios_ibfk_2` FOREIGN KEY (`fk_id_region`) REFERENCES `param_regiones` (`id_region`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `sitios_ibfk_3` FOREIGN KEY (`fk_id_organizacion`) REFERENCES `param_organizaciones` (`id_organizacion`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `sitios_ibfk_4` FOREIGN KEY (`fk_mpio_divipola`) REFERENCES `param_divipola` (`mpio_divipola`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
