-- phpMyAdmin SQL Dump
-- version 3.3.2deb1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 20-08-2010 a las 13:15:38
-- Versión del servidor: 5.1.41
-- Versión de PHP: 5.3.2-1ubuntu4.2

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `manual_programacion`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `adm_bdconsulta`
--

CREATE TABLE IF NOT EXISTS `adm_bdconsulta` (
  `id_adm_bdconsulta` int(6) NOT NULL AUTO_INCREMENT,
  `orden` int(6) NOT NULL,
  `texto` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_adm_bdconsulta`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Volcar la base de datos para la tabla `adm_bdconsulta`
--

INSERT INTO `adm_bdconsulta` (`id_adm_bdconsulta`, `orden`, `texto`) VALUES
(1, 1, 'texto 1'),
(2, 2, 'texto 2'),
(3, 3, 'texto 3');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `adm_sin_valores`
--

CREATE TABLE IF NOT EXISTS `adm_sin_valores` (
  `id_adm_sin_valores` int(6) NOT NULL AUTO_INCREMENT,
  `orden` int(6) NOT NULL,
  `titulo` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_adm_sin_valores`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Volcar la base de datos para la tabla `adm_sin_valores`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `adm_usuarios`
--

CREATE TABLE IF NOT EXISTS `adm_usuarios` (
  `id_adm_usuarios` int(6) NOT NULL AUTO_INCREMENT,
  `orden` int(6) NOT NULL,
  `usuario_general` varchar(100) DEFAULT NULL,
  `usuarios_habilitados` varchar(200) DEFAULT NULL,
  `administrador` varchar(100) DEFAULT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `descripcion` longtext,
  PRIMARY KEY (`id_adm_usuarios`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Volcar la base de datos para la tabla `adm_usuarios`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `adm_valores`
--

CREATE TABLE IF NOT EXISTS `adm_valores` (
  `id_adm_valores` int(6) NOT NULL AUTO_INCREMENT,
  `orden` int(6) NOT NULL,
  `titulo` varchar(50) DEFAULT NULL,
  `texto` longtext,
  `fecha_alta` int(20) DEFAULT NULL,
  `link` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id_adm_valores`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

--
-- Volcar la base de datos para la tabla `adm_valores`
--

INSERT INTO `adm_valores` (`id_adm_valores`, `orden`, `titulo`, `texto`, `fecha_alta`, `link`) VALUES
(1, 1, 'Casa  FOA', 'Casa FOA es un espacio de diseño que nace con la intención de recaudar fondos para la Fundación Oftalmológica Argentina Jorge Malbran.', 1282186800, 'www.casafoa.com/'),
(2, 2, 'Casa  - Wikipedia, la enciclopedia libre', 'Una casa, del latín casa (cabaña), es una edificación construida para ser habitada por una persona o un grupo de personas; suele organizarse en una o varias ...', 1282186800, 'es.wikipedia.org/wiki/Casa'),
(3, 3, 'Casa  Argentina - Ciudad Internacional Universitar', 'logo. Entrer · Entrar · logo.', 1282186800, 'www.casaargentinaenparis.org/'),
(4, 4, 'Casa  XI - Escuela de Astrología - Cursos a Distan', 'HOME. Las actividades de Casa XI giran en torno a dos grandes programas de estudio: los cursos de Astrología, cursos de astrología a distancia y La Matriz ...', 1282186800, 'www.casaonce.com/'),
(5, 5, 'La Casa del Blues', '9 Jul 2010 ... El legendario guitarrista de Piedmont Blues John "Bowling Green" Cephas falleció el pasado miércoles 4 de Marzo por la mañana en su casa en ...', 1282186800, 'www.lacasadelblues.com.ar/'),
(6, 6, 'ARGENTINA EN CASA', 'ARGENTINA EN CASA. RADIOS y TV · NOTICIAS · VARIEDADES · CINE Y SERIES · RECITALES · DESCARGAS MP3 · REVISTAS · Webs Amigas · Info. de contacto ...', 1282186800, 'www.argentinaencasa.com/'),
(7, 7, 'CASA  ARGENTINA - New Orleans, Louisiana, EE.UU.', 'Tanto en el area literaria como artística, Casa  Argentina ha presentado personalidades y grupos de prestigio internacional como Jorge Luis Borges, ...', 1282186800, 'www.casaargentina.net/'),
(8, 8, 'Planos de Casas Gratis | De Planos punto Com', 'Planos de casas y departamentos listos para descargar totalmente gratis.', 1282186800, 'deplanos.com/'),
(9, 9, 'Tu casa en Argentina', 'BUENOS AIRES APARTMENTS. Do you want to feel at home and confortable when you travel? Don´t miss the chance. Whe offer you a great opportunity because whe ...', 1282186800, 'www.tucasargentina.com/'),
(10, 10, 'Hotel Casa Real (Salta - Argentina) Turismo en Sal', 'Hotel Casa Real (Salta - Argentina). Hotel cuatro estrellas ubicado en la Provincia de Salta. Disfrute del turismo de Salta. Uno de los más destacados ...', 1282186800, 'www.casarealsalta.com/'),
(11, 11, 'Casa  SaltShaker', 'Casa SaltShaker. Closed Door Restaurant / Salon for Food and Conversation ... Casa SaltShaker on Facebook. Hot off the Press! / Recien de la Prensa! ...', 1282186800, 'www.casasaltshaker.com/');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `kirke_componente`
--

CREATE TABLE IF NOT EXISTS `kirke_componente` (
  `id_componente` int(6) NOT NULL AUTO_INCREMENT,
  `id_tabla` int(6) NOT NULL DEFAULT '0',
  `orden` int(6) NOT NULL DEFAULT '0',
  `componente` varchar(30) DEFAULT NULL,
  `tabla_campo` varchar(40) DEFAULT NULL,
  PRIMARY KEY (`id_componente`),
  KEY `id_pagina` (`id_tabla`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=100011 ;

--
-- Volcar la base de datos para la tabla `kirke_componente`
--

INSERT INTO `kirke_componente` (`id_componente`, `id_tabla`, `orden`, `componente`, `tabla_campo`) VALUES
(100000, 100000, 1, '001-CampoTexto', 'texto'),
(100001, 100001, 2, '001-CampoTexto', 'titulo'),
(100002, 100002, 3, '001-CampoTexto', 'usuario_general'),
(100003, 100002, 4, '001-CampoTexto', 'usuarios_habilitados'),
(100004, 100002, 5, '001-CampoTexto', 'administrador'),
(100005, 100002, 6, '001-CampoTexto', 'nombre'),
(100006, 100002, 7, '002-CampoTextoLargo', 'descripcion'),
(100007, 100003, 8, '001-CampoTexto', 'titulo'),
(100008, 100003, 9, '002-CampoTextoLargo', 'texto'),
(100009, 100003, 11, '011-FechaConPop', 'fecha_alta'),
(100010, 100003, 10, '001-CampoTexto', 'link');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `kirke_componente_parametro`
--

CREATE TABLE IF NOT EXISTS `kirke_componente_parametro` (
  `id_componente_parametro` int(6) NOT NULL AUTO_INCREMENT,
  `id_componente` int(6) NOT NULL DEFAULT '0',
  `parametro` varchar(30) DEFAULT NULL,
  `valor` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id_componente_parametro`),
  KEY `id_componente` (`id_componente`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=100177 ;

--
-- Volcar la base de datos para la tabla `kirke_componente_parametro`
--

INSERT INTO `kirke_componente_parametro` (`id_componente_parametro`, `id_componente`, `parametro`, `valor`) VALUES
(100000, 100000, 'tipo_dato', 'texto'),
(100001, 100000, 'largo', '50'),
(100002, 100000, 'tb_columna_tipo', 'nombre'),
(100003, 100000, 'listado_mostrar', 's'),
(100004, 100000, 'obligatorio', 'no_nulo'),
(100005, 100000, 'permite_html', 'n'),
(100006, 100000, 'idioma_cs', 'Texto'),
(100007, 100000, 'fuente', ''),
(100008, 100000, 'estilo_fuente', ''),
(100009, 100000, 'color_fuente', ''),
(100010, 100000, 'tamano_fuente', ''),
(100011, 100000, 'color_fondo', ''),
(100012, 100000, 'justificado', ''),
(100013, 100000, 'ancho_caja', ''),
(100014, 100000, 'validacion', 'validacion'),
(100015, 100000, 'mascara', 'mascara'),
(100016, 100001, 'tipo_dato', 'texto'),
(100017, 100001, 'largo', '50'),
(100018, 100001, 'tb_columna_tipo', 'nombre'),
(100019, 100001, 'listado_mostrar', 's'),
(100020, 100001, 'obligatorio', 'no_nulo'),
(100021, 100001, 'permite_html', 'n'),
(100022, 100001, 'idioma_cs', 'Titulo'),
(100023, 100001, 'fuente', ''),
(100024, 100001, 'estilo_fuente', ''),
(100025, 100001, 'color_fuente', ''),
(100026, 100001, 'tamano_fuente', ''),
(100027, 100001, 'color_fondo', ''),
(100028, 100001, 'justificado', ''),
(100029, 100001, 'ancho_caja', ''),
(100030, 100001, 'validacion', 'validacion'),
(100031, 100001, 'mascara', 'mascara'),
(100032, 100002, 'tipo_dato', 'texto'),
(100033, 100002, 'largo', '100'),
(100034, 100002, 'tb_columna_tipo', 'nombre'),
(100035, 100002, 'listado_mostrar', 's'),
(100036, 100002, 'obligatorio', 'no_nulo'),
(100037, 100002, 'permite_html', 'n'),
(100038, 100002, 'idioma_cs', 'Usuario General'),
(100039, 100002, 'fuente', ''),
(100040, 100002, 'estilo_fuente', ''),
(100041, 100002, 'color_fuente', ''),
(100042, 100002, 'tamano_fuente', ''),
(100043, 100002, 'color_fondo', ''),
(100044, 100002, 'justificado', ''),
(100045, 100002, 'ancho_caja', ''),
(100046, 100002, 'validacion', 'validacion'),
(100047, 100002, 'mascara', 'mascara'),
(100048, 100003, 'tipo_dato', 'texto'),
(100049, 100003, 'largo', '200'),
(100050, 100003, 'tb_columna_tipo', 'nombre'),
(100051, 100003, 'listado_mostrar', 's'),
(100052, 100003, 'obligatorio', 'nulo'),
(100053, 100003, 'permite_html', 'n'),
(100054, 100003, 'idioma_cs', 'Usuarios habilitados'),
(100055, 100003, 'fuente', ''),
(100056, 100003, 'estilo_fuente', ''),
(100057, 100003, 'color_fuente', ''),
(100058, 100003, 'tamano_fuente', ''),
(100059, 100003, 'color_fondo', ''),
(100060, 100003, 'justificado', ''),
(100061, 100003, 'ancho_caja', ''),
(100062, 100003, 'validacion', 'validacion'),
(100063, 100003, 'mascara', 'mascara'),
(100064, 100004, 'tipo_dato', 'texto'),
(100065, 100004, 'largo', '100'),
(100066, 100004, 'tb_columna_tipo', 'nombre'),
(100067, 100004, 'listado_mostrar', 'n'),
(100068, 100004, 'obligatorio', 'nulo'),
(100069, 100004, 'permite_html', 'n'),
(100070, 100004, 'idioma_cs', 'Administrador'),
(100071, 100004, 'fuente', ''),
(100072, 100004, 'estilo_fuente', ''),
(100073, 100004, 'color_fuente', ''),
(100074, 100004, 'tamano_fuente', ''),
(100075, 100004, 'color_fondo', ''),
(100076, 100004, 'justificado', ''),
(100077, 100004, 'ancho_caja', ''),
(100078, 100004, 'validacion', 'validacion'),
(100079, 100004, 'mascara', 'mascara'),
(100080, 100005, 'tipo_dato', 'texto'),
(100081, 100005, 'largo', '100'),
(100082, 100005, 'tb_columna_tipo', 'nombre'),
(100083, 100005, 'listado_mostrar', 's'),
(100084, 100005, 'obligatorio', 'nulo'),
(100085, 100005, 'permite_html', 'n'),
(100086, 100005, 'idioma_cs', 'Nombre'),
(100087, 100005, 'fuente', ''),
(100088, 100005, 'estilo_fuente', ''),
(100089, 100005, 'color_fuente', ''),
(100090, 100005, 'tamano_fuente', ''),
(100091, 100005, 'color_fondo', ''),
(100092, 100005, 'justificado', ''),
(100093, 100005, 'ancho_caja', ''),
(100094, 100005, 'validacion', 'validacion'),
(100095, 100005, 'mascara', 'mascara'),
(100096, 100006, 'tipo_dato', 'texto_largo'),
(100097, 100006, 'tb_columna_tipo', 'nombre'),
(100098, 100006, 'alto', '5'),
(100099, 100006, 'ancho', '100'),
(100100, 100006, 'listado_mostrar', 'n'),
(100101, 100006, 'obligatorio', 'nulo'),
(100102, 100006, 'permite_html', 'n'),
(100103, 100006, 'idioma_cs', 'Descripcion'),
(100104, 100006, 'fuente', ''),
(100105, 100006, 'estilo_fuente', ''),
(100106, 100006, 'color_fuente', ''),
(100107, 100006, 'tamano_fuente', ''),
(100108, 100006, 'color_fondo', ''),
(100109, 100006, 'justificado', ''),
(100110, 100006, 'ancho_caja', ''),
(100111, 100006, 'validacion', 'validacion'),
(100112, 100007, 'tipo_dato', 'texto'),
(100113, 100007, 'largo', '50'),
(100114, 100007, 'tb_columna_tipo', 'nombre'),
(100115, 100007, 'listado_mostrar', 's'),
(100116, 100007, 'obligatorio', 'nulo'),
(100117, 100007, 'permite_html', 'n'),
(100118, 100007, 'idioma_cs', 'Titulo'),
(100119, 100007, 'fuente', ''),
(100120, 100007, 'estilo_fuente', ''),
(100121, 100007, 'color_fuente', ''),
(100122, 100007, 'tamano_fuente', ''),
(100123, 100007, 'color_fondo', ''),
(100124, 100007, 'justificado', ''),
(100125, 100007, 'ancho_caja', ''),
(100126, 100007, 'validacion', 'validacion'),
(100127, 100007, 'mascara', 'mascara'),
(100128, 100008, 'tipo_dato', 'texto_largo'),
(100129, 100008, 'tb_columna_tipo', 'nombre'),
(100130, 100008, 'alto', '5'),
(100131, 100008, 'ancho', '100'),
(100132, 100008, 'listado_mostrar', 'n'),
(100133, 100008, 'obligatorio', 'nulo'),
(100134, 100008, 'permite_html', 'n'),
(100135, 100008, 'idioma_cs', 'Texto'),
(100136, 100008, 'fuente', ''),
(100137, 100008, 'estilo_fuente', ''),
(100138, 100008, 'color_fuente', ''),
(100139, 100008, 'tamano_fuente', ''),
(100140, 100008, 'color_fondo', ''),
(100141, 100008, 'justificado', ''),
(100142, 100008, 'ancho_caja', ''),
(100143, 100008, 'validacion', 'validacion'),
(100144, 100009, 'tipo_dato', 'numero'),
(100153, 100010, 'tipo_dato', 'texto'),
(100154, 100010, 'largo', '200'),
(100155, 100010, 'tb_columna_tipo', 'nombre'),
(100156, 100010, 'listado_mostrar', 's'),
(100157, 100010, 'obligatorio', 'nulo'),
(100158, 100010, 'permite_html', 'n'),
(100159, 100010, 'idioma_cs', 'Link'),
(100160, 100010, 'fuente', ''),
(100161, 100010, 'estilo_fuente', ''),
(100162, 100010, 'color_fuente', ''),
(100163, 100010, 'tamano_fuente', ''),
(100164, 100010, 'color_fondo', ''),
(100165, 100010, 'justificado', ''),
(100166, 100010, 'ancho_caja', ''),
(100167, 100010, 'validacion', 'validacion'),
(100168, 100010, 'mascara', 'mascara'),
(100169, 100009, 'mostrar_f_actual', 's'),
(100170, 100009, 'tb_columna_tipo', 'fecha'),
(100171, 100009, 'largo', '20'),
(100172, 100009, 'formato_fecha', ''),
(100173, 100009, 'listado_mostrar', 's'),
(100174, 100009, 'obligatorio', 'nulo'),
(100175, 100009, 'idioma_cs', 'Fecha de alta'),
(100176, 100009, 'tipo', 'tipo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `kirke_ip_control`
--

CREATE TABLE IF NOT EXISTS `kirke_ip_control` (
  `id_ip_control` int(6) NOT NULL AUTO_INCREMENT,
  `id_usuario` int(6) NOT NULL DEFAULT '0',
  `ip` varchar(20) DEFAULT NULL,
  `condicion` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id_ip_control`),
  KEY `id_usuario` (`id_usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Volcar la base de datos para la tabla `kirke_ip_control`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `kirke_log`
--

CREATE TABLE IF NOT EXISTS `kirke_log` (
  `id_log` int(6) NOT NULL AUTO_INCREMENT,
  `id_usuario` int(6) NOT NULL DEFAULT '0',
  `elemento` varchar(100) NOT NULL,
  `pagina` varchar(200) DEFAULT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `hora` int(30) NOT NULL DEFAULT '0',
  `navegador` varchar(100) DEFAULT NULL,
  `ip` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id_log`),
  KEY `usuario` (`id_usuario`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=170 ;

--
-- Volcar la base de datos para la tabla `kirke_log`
--

INSERT INTO `kirke_log` (`id_log`, `id_usuario`, `elemento`, `pagina`, `nombre`, `hora`, `navegador`, `ip`) VALUES
(1, 1, 'Pagina', 'Bienvenida', '', 1281556125, 'FireFox', '192.168.1.102'),
(2, 1, 'Pagina', 'PaginaListado', '', 1281556132, 'FireFox', '192.168.1.102'),
(3, 1, 'Pagina', 'PrefijoListado', '', 1281556135, 'FireFox', '192.168.1.102'),
(4, 1, 'Pagina', 'PrefijoAlta', '', 1281556137, 'FireFox', '192.168.1.102'),
(5, 1, 'Pagina', 'PrefijoAltaInsercion', '', 1281556145, 'FireFox', '192.168.1.102'),
(6, 1, 'Pagina', 'PrefijoListado', '', 1281556145, 'FireFox', '192.168.1.102'),
(7, 1, 'Pagina', 'PaginaListado', '', 1281556147, 'FireFox', '192.168.1.102'),
(8, 1, 'Pagina', 'PaginaAlta', '', 1281556149, 'FireFox', '192.168.1.102'),
(9, 1, 'Pagina', 'PaginaAltaInsercion', '', 1281556188, 'FireFox', '192.168.1.102'),
(10, 1, 'Pagina', 'ComponenteListado', '', 1281556188, 'FireFox', '192.168.1.102'),
(11, 1, 'Pagina', 'ComponenteAlta', '', 1281556214, 'FireFox', '192.168.1.102'),
(12, 1, 'Pagina', 'ComponenteAltaInsercion', '', 1281556231, 'FireFox', '192.168.1.102'),
(13, 1, 'Pagina', 'ComponenteListado', '', 1281556232, 'FireFox', '192.168.1.102'),
(14, 1, 'Pagina', 'PaginaListado', '', 1281556235, 'FireFox', '192.168.1.102'),
(15, 1, 'Pagina', 'RegistroListado', '', 1281556237, 'FireFox', '192.168.1.102'),
(16, 1, 'Pagina', 'PaginaListado', '', 1281556240, 'FireFox', '192.168.1.102'),
(17, 1, 'Pagina', 'RegistroListado', '', 1281556267, 'FireFox', '192.168.1.102'),
(18, 1, 'Pagina', 'RegistroAlta', '', 1281556268, 'FireFox', '192.168.1.102'),
(19, 1, 'Pagina', 'RegistroAltaPrevia', '', 1281556274, 'FireFox', '192.168.1.102'),
(20, 1, 'Pagina', 'RegistroAltaInsercion', '', 1281556275, 'FireFox', '192.168.1.102'),
(21, 1, 'Pagina', 'RegistroListado', '', 1281556275, 'FireFox', '192.168.1.102'),
(22, 1, 'Pagina', 'RegistroAlta', '', 1281556277, 'FireFox', '192.168.1.102'),
(23, 1, 'Pagina', 'RegistroAltaPrevia', '', 1281556280, 'FireFox', '192.168.1.102'),
(24, 1, 'Pagina', 'RegistroAltaInsercion', '', 1281556282, 'FireFox', '192.168.1.102'),
(25, 1, 'Pagina', 'RegistroListado', '', 1281556282, 'FireFox', '192.168.1.102'),
(26, 1, 'Pagina', 'RegistroAlta', '', 1281556283, 'FireFox', '192.168.1.102'),
(27, 1, 'Pagina', 'RegistroAltaPrevia', '', 1281556289, 'FireFox', '192.168.1.102'),
(28, 1, 'Pagina', 'RegistroAltaInsercion', '', 1281556290, 'FireFox', '192.168.1.102'),
(29, 1, 'Pagina', 'RegistroListado', '', 1281556290, 'FireFox', '192.168.1.102'),
(30, 1, 'Pagina', 'PaginaListado', '', 1281556456, 'FireFox', '192.168.1.102'),
(31, 1, 'Pagina', 'PaginaAlta', '', 1281556458, 'FireFox', '192.168.1.102'),
(32, 1, 'Pagina', 'PaginaAltaInsercion', '', 1281556472, 'FireFox', '192.168.1.102'),
(33, 1, 'Pagina', 'ComponenteListado', '', 1281556473, 'FireFox', '192.168.1.102'),
(34, 1, 'Pagina', 'ComponenteAlta', '', 1281556475, 'FireFox', '192.168.1.102'),
(35, 1, 'Pagina', 'ComponenteAltaInsercion', '', 1281556489, 'FireFox', '192.168.1.102'),
(36, 1, 'Pagina', 'ComponenteListado', '', 1281556490, 'FireFox', '192.168.1.102'),
(37, 1, 'Pagina', 'Bienvenida', '', 1281709305, 'FireFox', '192.168.1.102'),
(38, 1, 'Pagina', 'PaginaListado', '', 1281709331, 'FireFox', '192.168.1.102'),
(39, 1, 'Pagina', 'PaginaAlta', '', 1281709335, 'FireFox', '192.168.1.102'),
(40, 1, 'Pagina', 'PaginaAltaInsercion', '', 1281709357, 'FireFox', '192.168.1.102'),
(41, 1, 'Pagina', 'ComponenteListado', '', 1281709357, 'FireFox', '192.168.1.102'),
(42, 1, 'Pagina', 'ComponenteAlta', '', 1281709458, 'FireFox', '192.168.1.102'),
(43, 1, 'Pagina', 'ComponenteAltaInsercion', '', 1281709479, 'FireFox', '192.168.1.102'),
(44, 1, 'Pagina', 'ComponenteListado', '', 1281709480, 'FireFox', '192.168.1.102'),
(45, 1, 'Pagina', 'ComponenteAlta', '', 1281709488, 'FireFox', '192.168.1.102'),
(46, 1, 'Pagina', 'ComponenteAltaInsercion', '', 1281709506, 'FireFox', '192.168.1.102'),
(47, 1, 'Pagina', 'ComponenteListado', '', 1281709507, 'FireFox', '192.168.1.102'),
(48, 1, 'Pagina', 'ComponenteAlta', '', 1281709520, 'FireFox', '192.168.1.102'),
(49, 1, 'Pagina', 'ComponenteAltaInsercion', '', 1281709536, 'FireFox', '192.168.1.102'),
(50, 1, 'Pagina', 'ComponenteListado', '', 1281709537, 'FireFox', '192.168.1.102'),
(51, 1, 'Pagina', 'ComponenteAlta', '', 1281709547, 'FireFox', '192.168.1.102'),
(52, 1, 'Pagina', 'ComponenteAltaInsercion', '', 1281709557, 'FireFox', '192.168.1.102'),
(53, 1, 'Pagina', 'ComponenteListado', '', 1281709558, 'FireFox', '192.168.1.102'),
(54, 1, 'Pagina', 'ComponenteAlta', '', 1281709571, 'FireFox', '192.168.1.102'),
(55, 1, 'Pagina', 'ComponenteAltaInsercion', '', 1281709582, 'FireFox', '192.168.1.102'),
(56, 1, 'Pagina', 'ComponenteListado', '', 1281709583, 'FireFox', '192.168.1.102'),
(57, 1, 'Pagina', 'ComponenteListado', '', 1281709833, 'FireFox', '192.168.1.102'),
(58, 1, 'Pagina', 'Bienvenida', '', 1282225369, 'FireFox', '192.168.1.102'),
(59, 1, 'Pagina', 'PaginaListado', '', 1282225372, 'FireFox', '192.168.1.102'),
(60, 1, 'Pagina', 'PaginaAlta', '', 1282225379, 'FireFox', '192.168.1.102'),
(61, 1, 'Pagina', 'PaginaAltaInsercion', '', 1282225387, 'FireFox', '192.168.1.102'),
(62, 1, 'Pagina', 'ComponenteListado', '', 1282225387, 'FireFox', '192.168.1.102'),
(63, 1, 'Pagina', 'ComponenteAlta', '', 1282225394, 'FireFox', '192.168.1.102'),
(64, 1, 'Pagina', 'ComponenteAltaInsercion', '', 1282225406, 'FireFox', '192.168.1.102'),
(65, 1, 'Pagina', 'ComponenteListado', '', 1282225407, 'FireFox', '192.168.1.102'),
(66, 1, 'Pagina', 'ComponenteAlta', '', 1282225419, 'FireFox', '192.168.1.102'),
(67, 1, 'Pagina', 'ComponenteListado', '', 1282225421, 'FireFox', '192.168.1.102'),
(68, 1, 'Pagina', 'ComponenteAlta', '', 1282225434, 'FireFox', '192.168.1.102'),
(69, 1, 'Pagina', 'ComponenteAltaInsercion', '', 1282225445, 'FireFox', '192.168.1.102'),
(70, 1, 'Pagina', 'ComponenteListado', '', 1282225447, 'FireFox', '192.168.1.102'),
(71, 1, 'Pagina', 'ComponenteAlta', '', 1282225451, 'FireFox', '192.168.1.102'),
(72, 1, 'Pagina', 'ComponenteAltaInsercion', '', 1282225459, 'FireFox', '192.168.1.102'),
(73, 1, 'Pagina', 'ComponenteListado', '', 1282225460, 'FireFox', '192.168.1.102'),
(74, 1, 'Pagina', 'PaginaListado', '', 1282225471, 'FireFox', '192.168.1.102'),
(75, 1, 'Pagina', 'MenuListado', '', 1282225477, 'FireFox', '192.168.1.102'),
(76, 1, 'Pagina', 'MenuAlta', '', 1282225478, 'FireFox', '192.168.1.102'),
(77, 1, 'Pagina', 'MenuAltaInsercion', '', 1282225485, 'FireFox', '192.168.1.102'),
(78, 1, 'Pagina', 'MenuListado', '', 1282225485, 'FireFox', '192.168.1.102'),
(79, 1, 'Pagina', 'MenuLinkListado', '', 1282225488, 'FireFox', '192.168.1.102'),
(80, 1, 'Pagina', 'MenuLinkAlta', '', 1282225490, 'FireFox', '192.168.1.102'),
(81, 1, 'Pagina', 'MenuLinkAltaInsercion', '', 1282225499, 'FireFox', '192.168.1.102'),
(82, 1, 'Pagina', 'MenuLinkParametroAlta', '', 1282225500, 'FireFox', '192.168.1.102'),
(83, 1, 'Pagina', 'MenuLinkParametroAltaInsercion', '', 1282225501, 'FireFox', '192.168.1.102'),
(84, 1, 'Pagina', 'MenuLinkListado', '', 1282225501, 'FireFox', '192.168.1.102'),
(85, 1, 'Pagina', 'MenuLinkAlta', '', 1282225503, 'FireFox', '192.168.1.102'),
(86, 1, 'Pagina', 'MenuLinkAltaInsercion', '', 1282225509, 'FireFox', '192.168.1.102'),
(87, 1, 'Pagina', 'MenuLinkParametroAlta', '', 1282225509, 'FireFox', '192.168.1.102'),
(88, 1, 'Pagina', 'MenuLinkParametroAltaInsercion', '', 1282225510, 'FireFox', '192.168.1.102'),
(89, 1, 'Pagina', 'MenuLinkListado', '', 1282225510, 'FireFox', '192.168.1.102'),
(90, 1, 'Pagina', 'MenuLinkAlta', '', 1282225512, 'FireFox', '192.168.1.102'),
(91, 1, 'Pagina', 'MenuLinkAltaInsercion', '', 1282225517, 'FireFox', '192.168.1.102'),
(92, 1, 'Pagina', 'MenuLinkParametroAlta', '', 1282225517, 'FireFox', '192.168.1.102'),
(93, 1, 'Pagina', 'MenuLinkParametroAltaInsercion', '', 1282225518, 'FireFox', '192.168.1.102'),
(94, 1, 'Pagina', 'MenuLinkListado', '', 1282225519, 'FireFox', '192.168.1.102'),
(95, 1, 'Pagina', 'MenuLinkAlta', '', 1282225521, 'FireFox', '192.168.1.102'),
(96, 1, 'Pagina', 'MenuLinkAltaInsercion', '', 1282225526, 'FireFox', '192.168.1.102'),
(97, 1, 'Pagina', 'MenuLinkParametroAlta', '', 1282225526, 'FireFox', '192.168.1.102'),
(98, 1, 'Pagina', 'MenuLinkParametroAltaInsercion', '', 1282225528, 'FireFox', '192.168.1.102'),
(99, 1, 'Pagina', 'MenuLinkListado', '', 1282225528, 'FireFox', '192.168.1.102'),
(100, 1, 'Pagina', 'RegistroListado', '', 1282225530, 'FireFox', '192.168.1.102'),
(101, 1, 'Pagina', 'RegistroAlta', '', 1282225532, 'FireFox', '192.168.1.102'),
(102, 1, 'Pagina', 'RegistroAltaPrevia', '', 1282225573, 'FireFox', '192.168.1.102'),
(103, 1, 'Pagina', 'RegistroAltaInsercion', '', 1282225575, 'FireFox', '192.168.1.102'),
(104, 1, 'Pagina', 'RegistroListado', '', 1282225575, 'FireFox', '192.168.1.102'),
(105, 1, 'Pagina', 'RegistroAlta', '', 1282225577, 'FireFox', '192.168.1.102'),
(106, 1, 'Pagina', 'RegistroAltaPrevia', '', 1282225599, 'FireFox', '192.168.1.102'),
(107, 1, 'Pagina', 'RegistroAltaInsercion', '', 1282225601, 'FireFox', '192.168.1.102'),
(108, 1, 'Pagina', 'RegistroListado', '', 1282225601, 'FireFox', '192.168.1.102'),
(109, 1, 'Pagina', 'PaginaListado', '', 1282225606, 'FireFox', '192.168.1.102'),
(110, 1, 'Pagina', 'ComponenteListado', '', 1282225608, 'FireFox', '192.168.1.102'),
(111, 1, 'Pagina', 'ComponenteAlta', '', 1282225613, 'FireFox', '192.168.1.102'),
(112, 1, 'Pagina', 'ComponenteAltaInsercion', '', 1282225636, 'FireFox', '192.168.1.102'),
(113, 1, 'Pagina', 'ComponenteListado', '', 1282225637, 'FireFox', '192.168.1.102'),
(114, 1, 'Pagina', 'RegistroListado', '', 1282225641, 'FireFox', '192.168.1.102'),
(115, 1, 'Pagina', 'RegistroModificacion', '', 1282225645, 'FireFox', '192.168.1.102'),
(116, 1, 'Pagina', 'RegistroModificacionPrevia', '', 1282225653, 'FireFox', '192.168.1.102'),
(117, 1, 'Pagina', 'RegistroModificacionInsercion', '', 1282225654, 'FireFox', '192.168.1.102'),
(118, 1, 'Pagina', 'RegistroListado', '', 1282225655, 'FireFox', '192.168.1.102'),
(119, 1, 'Pagina', 'RegistroModificacion', '', 1282225657, 'FireFox', '192.168.1.102'),
(120, 1, 'Pagina', 'RegistroModificacionPrevia', '', 1282225667, 'FireFox', '192.168.1.102'),
(121, 1, 'Pagina', 'RegistroModificacionInsercion', '', 1282225668, 'FireFox', '192.168.1.102'),
(122, 1, 'Pagina', 'RegistroListado', '', 1282225668, 'FireFox', '192.168.1.102'),
(123, 1, 'Pagina', 'RegistroListado', '', 1282225672, 'FireFox', '192.168.1.102'),
(124, 1, 'Pagina', 'PaginaListado', '', 1282225676, 'FireFox', '192.168.1.102'),
(125, 1, 'Pagina', 'ComponenteListado', '', 1282225679, 'FireFox', '192.168.1.102'),
(126, 1, 'Pagina', 'ComponenteListado', '', 1282225681, 'FireFox', '192.168.1.102'),
(127, 1, 'Pagina', 'ComponenteModificacion', '', 1282225684, 'FireFox', '192.168.1.102'),
(128, 1, 'Pagina', 'ComponenteModificacionInsercion', '', 1282225693, 'FireFox', '192.168.1.102'),
(129, 1, 'Pagina', 'ComponenteListado', '', 1282225694, 'FireFox', '192.168.1.102'),
(130, 1, 'Pagina', 'PaginaListado', '', 1282225697, 'FireFox', '192.168.1.102'),
(131, 1, 'Pagina', 'RegistroListado', '', 1282225700, 'FireFox', '192.168.1.102'),
(132, 1, 'Pagina', 'RegistroAlta', '', 1282225703, 'FireFox', '192.168.1.102'),
(133, 1, 'Pagina', 'RegistroAltaPrevia', '', 1282225718, 'FireFox', '192.168.1.102'),
(134, 1, 'Pagina', 'RegistroAltaInsercion', '', 1282225720, 'FireFox', '192.168.1.102'),
(135, 1, 'Pagina', 'RegistroListado', '', 1282225720, 'FireFox', '192.168.1.102'),
(136, 1, 'Pagina', 'RegistroAlta', '', 1282225722, 'FireFox', '192.168.1.102'),
(137, 1, 'Pagina', 'RegistroAltaPrevia', '', 1282225736, 'FireFox', '192.168.1.102'),
(138, 1, 'Pagina', 'RegistroAltaInsercion', '', 1282225741, 'FireFox', '192.168.1.102'),
(139, 1, 'Pagina', 'RegistroListado', '', 1282225741, 'FireFox', '192.168.1.102'),
(140, 1, 'Pagina', 'RegistroAlta', '', 1282225743, 'FireFox', '192.168.1.102'),
(141, 1, 'Pagina', 'RegistroAltaPrevia', '', 1282225756, 'FireFox', '192.168.1.102'),
(142, 1, 'Pagina', 'RegistroAltaInsercion', '', 1282225757, 'FireFox', '192.168.1.102'),
(143, 1, 'Pagina', 'RegistroListado', '', 1282225757, 'FireFox', '192.168.1.102'),
(144, 1, 'Pagina', 'RegistroAlta', '', 1282225765, 'FireFox', '192.168.1.102'),
(145, 1, 'Pagina', 'RegistroAltaPrevia', '', 1282225777, 'FireFox', '192.168.1.102'),
(146, 1, 'Pagina', 'RegistroAltaInsercion', '', 1282225779, 'FireFox', '192.168.1.102'),
(147, 1, 'Pagina', 'RegistroListado', '', 1282225779, 'FireFox', '192.168.1.102'),
(148, 1, 'Pagina', 'RegistroAlta', '', 1282225782, 'FireFox', '192.168.1.102'),
(149, 1, 'Pagina', 'RegistroAltaPrevia', '', 1282225800, 'FireFox', '192.168.1.102'),
(150, 1, 'Pagina', 'RegistroAltaInsercion', '', 1282225802, 'FireFox', '192.168.1.102'),
(151, 1, 'Pagina', 'RegistroListado', '', 1282225802, 'FireFox', '192.168.1.102'),
(152, 1, 'Pagina', 'RegistroAlta', '', 1282225805, 'FireFox', '192.168.1.102'),
(153, 1, 'Pagina', 'RegistroAltaPrevia', '', 1282225816, 'FireFox', '192.168.1.102'),
(154, 1, 'Pagina', 'RegistroAltaInsercion', '', 1282225817, 'FireFox', '192.168.1.102'),
(155, 1, 'Pagina', 'RegistroListado', '', 1282225818, 'FireFox', '192.168.1.102'),
(156, 1, 'Pagina', 'RegistroAlta', '', 1282225820, 'FireFox', '192.168.1.102'),
(157, 1, 'Pagina', 'RegistroAltaPrevia', '', 1282225834, 'FireFox', '192.168.1.102'),
(158, 1, 'Pagina', 'RegistroAltaInsercion', '', 1282225836, 'FireFox', '192.168.1.102'),
(159, 1, 'Pagina', 'RegistroListado', '', 1282225836, 'FireFox', '192.168.1.102'),
(160, 1, 'Pagina', 'RegistroAlta', '', 1282225843, 'FireFox', '192.168.1.102'),
(161, 1, 'Pagina', 'RegistroAltaPrevia', '', 1282225855, 'FireFox', '192.168.1.102'),
(162, 1, 'Pagina', 'RegistroAltaInsercion', '', 1282225856, 'FireFox', '192.168.1.102'),
(163, 1, 'Pagina', 'RegistroListado', '', 1282225857, 'FireFox', '192.168.1.102'),
(164, 1, 'Pagina', 'RegistroAlta', '', 1282225860, 'FireFox', '192.168.1.102'),
(165, 1, 'Pagina', 'RegistroAltaPrevia', '', 1282225869, 'FireFox', '192.168.1.102'),
(166, 1, 'Pagina', 'RegistroAlta', '', 1282225873, 'FireFox', '192.168.1.102'),
(167, 1, 'Pagina', 'RegistroAltaPrevia', '', 1282225883, 'FireFox', '192.168.1.102'),
(168, 1, 'Pagina', 'RegistroAltaInsercion', '', 1282225891, 'FireFox', '192.168.1.102'),
(169, 1, 'Pagina', 'RegistroListado', '', 1282225891, 'FireFox', '192.168.1.102');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `kirke_menu`
--

CREATE TABLE IF NOT EXISTS `kirke_menu` (
  `id_menu` int(6) NOT NULL AUTO_INCREMENT,
  `nivel1_orden` int(3) DEFAULT NULL,
  `nivel2_orden` int(6) DEFAULT NULL,
  `nivel3_orden` int(3) DEFAULT NULL,
  `nivel4_orden` int(3) DEFAULT NULL,
  `habilitado` char(1) DEFAULT NULL,
  PRIMARY KEY (`id_menu`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Volcar la base de datos para la tabla `kirke_menu`
--

INSERT INTO `kirke_menu` (`id_menu`, `nivel1_orden`, `nivel2_orden`, `nivel3_orden`, `nivel4_orden`, `habilitado`) VALUES
(1, 1, NULL, NULL, NULL, 's');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `kirke_menu_link`
--

CREATE TABLE IF NOT EXISTS `kirke_menu_link` (
  `id_menu_link` int(6) NOT NULL AUTO_INCREMENT,
  `id_menu` int(6) NOT NULL,
  `id_elemento` int(6) NOT NULL,
  `elemento` varchar(100) NOT NULL,
  `orden` int(6) NOT NULL,
  `habilitado` char(1) DEFAULT NULL,
  PRIMARY KEY (`id_menu_link`),
  KEY `id_menu` (`id_menu`,`id_elemento`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Volcar la base de datos para la tabla `kirke_menu_link`
--

INSERT INTO `kirke_menu_link` (`id_menu_link`, `id_menu`, `id_elemento`, `elemento`, `orden`, `habilitado`) VALUES
(1, 1, 100000, 'pagina', 1, 's'),
(2, 1, 100001, 'pagina', 2, 's'),
(3, 1, 100002, 'pagina', 3, 's'),
(4, 1, 100003, 'pagina', 4, 's');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `kirke_menu_link_nombre`
--

CREATE TABLE IF NOT EXISTS `kirke_menu_link_nombre` (
  `id_menu_link_nombre` int(6) NOT NULL AUTO_INCREMENT,
  `id_menu_link` int(6) NOT NULL,
  `menu_link_nombre` varchar(30) DEFAULT NULL,
  `idioma_codigo` char(2) DEFAULT NULL,
  PRIMARY KEY (`id_menu_link_nombre`),
  KEY `id_menu_link` (`id_menu_link`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Volcar la base de datos para la tabla `kirke_menu_link_nombre`
--

INSERT INTO `kirke_menu_link_nombre` (`id_menu_link_nombre`, `id_menu_link`, `menu_link_nombre`, `idioma_codigo`) VALUES
(1, 1, 'DB consulta', 'cs'),
(2, 2, 'Sin valores', 'cs'),
(3, 3, 'Usuarios', 'cs'),
(4, 4, 'Valores', 'cs');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `kirke_menu_link_parametro`
--

CREATE TABLE IF NOT EXISTS `kirke_menu_link_parametro` (
  `id_menu_link_parametro` int(6) NOT NULL AUTO_INCREMENT,
  `id_menu_link` int(6) NOT NULL,
  `kk_generar` int(2) NOT NULL,
  `tipo` varchar(30) DEFAULT NULL,
  `id_elemento` int(6) NOT NULL,
  `parametro` varchar(30) DEFAULT NULL,
  `valor` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id_menu_link_parametro`),
  KEY `id_menu_link` (`id_menu_link`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Volcar la base de datos para la tabla `kirke_menu_link_parametro`
--

INSERT INTO `kirke_menu_link_parametro` (`id_menu_link_parametro`, `id_menu_link`, `kk_generar`, `tipo`, `id_elemento`, `parametro`, `valor`) VALUES
(1, 1, 0, 'orden', 100000, '', ''),
(2, 2, 0, 'orden', 100001, '', ''),
(3, 3, 0, 'orden', 100002, '', ''),
(4, 4, 0, 'orden', 100003, '', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `kirke_menu_nombre`
--

CREATE TABLE IF NOT EXISTS `kirke_menu_nombre` (
  `id_menu_nombre` int(6) NOT NULL AUTO_INCREMENT,
  `id_menu` int(6) NOT NULL DEFAULT '0',
  `menu_nombre` varchar(30) DEFAULT NULL,
  `idioma_codigo` char(2) DEFAULT NULL,
  PRIMARY KEY (`id_menu_nombre`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Volcar la base de datos para la tabla `kirke_menu_nombre`
--

INSERT INTO `kirke_menu_nombre` (`id_menu_nombre`, `id_menu`, `menu_nombre`, `idioma_codigo`) VALUES
(1, 1, 'Administracion', 'cs');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `kirke_rol`
--

CREATE TABLE IF NOT EXISTS `kirke_rol` (
  `id_rol` int(6) NOT NULL AUTO_INCREMENT,
  `orden` int(6) NOT NULL,
  `rol` varchar(100) DEFAULT NULL,
  `descripcion` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_rol`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Volcar la base de datos para la tabla `kirke_rol`
--

INSERT INTO `kirke_rol` (`id_rol`, `orden`, `rol`, `descripcion`) VALUES
(1, 0, '{TR|o_administrador_general}', '{TR|o_administrador_general_descripcion}'),
(2, 0, '{TR|o_administrador_usuarios}', '{TR|o_administrador_usuarios_descripcion}');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `kirke_rol_detalle`
--

CREATE TABLE IF NOT EXISTS `kirke_rol_detalle` (
  `id_rol_detalle` int(6) NOT NULL AUTO_INCREMENT,
  `id_rol` int(6) NOT NULL,
  `elemento` varchar(100) DEFAULT NULL,
  `id_elemento` int(6) DEFAULT NULL,
  `permiso` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_rol_detalle`),
  KEY `id_rol` (`id_rol`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Volcar la base de datos para la tabla `kirke_rol_detalle`
--

INSERT INTO `kirke_rol_detalle` (`id_rol_detalle`, `id_rol`, `elemento`, `id_elemento`, `permiso`) VALUES
(1, 1, NULL, NULL, NULL),
(2, 2, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `kirke_tabla`
--

CREATE TABLE IF NOT EXISTS `kirke_tabla` (
  `id_tabla` int(6) NOT NULL AUTO_INCREMENT,
  `id_tabla_prefijo` int(6) NOT NULL DEFAULT '0',
  `orden` int(6) NOT NULL,
  `tabla_nombre` varchar(30) DEFAULT NULL,
  `habilitado` char(1) DEFAULT NULL,
  `tipo` varchar(30) DEFAULT NULL,
  `plantilla` longtext,
  PRIMARY KEY (`id_tabla`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=100004 ;

--
-- Volcar la base de datos para la tabla `kirke_tabla`
--

INSERT INTO `kirke_tabla` (`id_tabla`, `id_tabla_prefijo`, `orden`, `tabla_nombre`, `habilitado`, `tipo`, `plantilla`) VALUES
(100000, 100000, 1, 'bdconsulta', 's', 'registros', NULL),
(100001, 100000, 2, 'sin_valores', 's', 'registros', NULL),
(100002, 100000, 3, 'usuarios', 's', 'registros', NULL),
(100003, 100000, 4, 'valores', 's', 'registros', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `kirke_tabla_nombre_idioma`
--

CREATE TABLE IF NOT EXISTS `kirke_tabla_nombre_idioma` (
  `id_tabla_nombre_idioma` int(6) NOT NULL AUTO_INCREMENT,
  `id_tabla` int(6) NOT NULL DEFAULT '0',
  `idioma_codigo` char(2) DEFAULT NULL,
  `tabla_nombre_idioma` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id_tabla_nombre_idioma`),
  KEY `id_idioma` (`idioma_codigo`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=100004 ;

--
-- Volcar la base de datos para la tabla `kirke_tabla_nombre_idioma`
--

INSERT INTO `kirke_tabla_nombre_idioma` (`id_tabla_nombre_idioma`, `id_tabla`, `idioma_codigo`, `tabla_nombre_idioma`) VALUES
(100000, 100000, 'cs', 'DB consulta'),
(100001, 100001, 'cs', 'Sin valores'),
(100002, 100002, 'cs', 'Usuarios'),
(100003, 100003, 'cs', 'Valores');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `kirke_tabla_parametro`
--

CREATE TABLE IF NOT EXISTS `kirke_tabla_parametro` (
  `id_tabla_parametro` int(6) NOT NULL AUTO_INCREMENT,
  `id_tabla` int(6) NOT NULL,
  `tipo` varchar(30) DEFAULT NULL,
  `parametro` varchar(30) DEFAULT NULL,
  `valor` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id_tabla_parametro`),
  KEY `id_tabla` (`id_tabla`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Volcar la base de datos para la tabla `kirke_tabla_parametro`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `kirke_tabla_prefijo`
--

CREATE TABLE IF NOT EXISTS `kirke_tabla_prefijo` (
  `id_tabla_prefijo` int(6) NOT NULL AUTO_INCREMENT,
  `orden` int(6) NOT NULL,
  `prefijo` varchar(6) DEFAULT NULL,
  `descripcion` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_tabla_prefijo`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=100001 ;

--
-- Volcar la base de datos para la tabla `kirke_tabla_prefijo`
--

INSERT INTO `kirke_tabla_prefijo` (`id_tabla_prefijo`, `orden`, `prefijo`, `descripcion`) VALUES
(100000, 1, 'adm', 'Administracion del sitio');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `kirke_tmp`
--

CREATE TABLE IF NOT EXISTS `kirke_tmp` (
  `id_tmp` int(6) NOT NULL AUTO_INCREMENT,
  `fecha` int(20) NOT NULL,
  `id_componente` int(6) NOT NULL,
  `contenido` longtext,
  PRIMARY KEY (`id_tmp`),
  KEY `id_componente` (`id_componente`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Volcar la base de datos para la tabla `kirke_tmp`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `kirke_usuario`
--

CREATE TABLE IF NOT EXISTS `kirke_usuario` (
  `id_usuario` int(6) NOT NULL AUTO_INCREMENT,
  `orden` int(6) NOT NULL,
  `nombre` varchar(50) DEFAULT NULL,
  `apellido` varchar(50) DEFAULT NULL,
  `usuario` varchar(20) DEFAULT NULL,
  `clave` varchar(32) DEFAULT NULL,
  `mail` varchar(50) DEFAULT NULL,
  `telefono` varchar(30) DEFAULT NULL,
  `habilitado` char(1) DEFAULT NULL,
  PRIMARY KEY (`id_usuario`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Volcar la base de datos para la tabla `kirke_usuario`
--

INSERT INTO `kirke_usuario` (`id_usuario`, `orden`, `nombre`, `apellido`, `usuario`, `clave`, `mail`, `telefono`, `habilitado`) VALUES
(1, 1, 'kirke', 'kirke', 'kirke', 'e4afca97a13bd913ad0627a5ffc48d01', 'kirke@kirke.ws', '', 's');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `kirke_usuario_atributo`
--

CREATE TABLE IF NOT EXISTS `kirke_usuario_atributo` (
  `id_usuario_atributo` int(6) NOT NULL AUTO_INCREMENT,
  `id_usuario` int(6) NOT NULL,
  `atributo_nombre` varchar(50) DEFAULT NULL,
  `atributo_valor` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_usuario_atributo`),
  KEY `id_usuario` (`id_usuario`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Volcar la base de datos para la tabla `kirke_usuario_atributo`
--

INSERT INTO `kirke_usuario_atributo` (`id_usuario_atributo`, `id_usuario`, `atributo_nombre`, `atributo_valor`) VALUES
(1, 1, 'idioma', 'cs'),
(2, 1, 'plantilla', 'kirke');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `kirke_usuario_rol`
--

CREATE TABLE IF NOT EXISTS `kirke_usuario_rol` (
  `id_usuario_rol` int(6) NOT NULL AUTO_INCREMENT,
  `id_usuario` int(6) NOT NULL DEFAULT '0',
  `id_rol` int(6) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_usuario_rol`),
  KEY `id_usuario` (`id_usuario`,`id_rol`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Volcar la base de datos para la tabla `kirke_usuario_rol`
--

INSERT INTO `kirke_usuario_rol` (`id_usuario_rol`, `id_usuario`, `id_rol`) VALUES
(1, 1, 1);
