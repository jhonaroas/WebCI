SET FOREIGN_KEY_CHECKS=0;

CREATE DATABASE IF NOT EXISTS id2879657_librarysystem;

USE id2879657_librarysystem;

DROP TABLE IF EXISTS administrador;

CREATE TABLE `administrador` (
  `CodigoAdmin` varchar(70) NOT NULL,
  `Estado` varchar(30) NOT NULL,
  `Nombre` varchar(70) NOT NULL,
  `NombreUsuario` varchar(50) NOT NULL,
  `Clave` varchar(200) NOT NULL,
  `Email` varchar(50) NOT NULL,
  PRIMARY KEY (`CodigoAdmin`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO administrador VALUES("I12217Y2015A1N6684","Activo","Super Administrador","Administrador","2a2e9a58102784ca18e2605a4e727b5f","");
INSERT INTO administrador VALUES("I1Y2017A2N1530","Activo","Wendy Tamayo Bocanegra","Wendy","e10adc3949ba59abbe56e057f20f883e","Wendy@gmail.com");



DROP TABLE IF EXISTS bitacora;

CREATE TABLE `bitacora` (
  `Codigo` varchar(100) NOT NULL,
  `CodigoUsuario` varchar(70) NOT NULL,
  `Tipo` varchar(30) NOT NULL,
  `Fecha` varchar(30) NOT NULL,
  `Entrada` varchar(30) NOT NULL,
  `Salida` varchar(30) NOT NULL,
  PRIMARY KEY (`Codigo`),
  KEY `PrimaryKey` (`CodigoUsuario`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO bitacora VALUES("AI12217Y2015A1N6684N0700-6","I12217Y2015A1N6684","Administrador","01-10-2017","17:00:23","Sin registrar");
INSERT INTO bitacora VALUES("AI12217Y2015A1N6684N1021-5","I12217Y2015A1N6684","Administrador","01-10-2017","16:58:59","17:00:57");
INSERT INTO bitacora VALUES("AI12217Y2015A1N6684N2721-7","I12217Y2015A1N6684","Administrador","01-10-2017","17:15:46","Sin registrar");
INSERT INTO bitacora VALUES("AI12217Y2015A1N6684N5045-9","I12217Y2015A1N6684","Administrador","01-10-2017","17:30:51","Sin registrar");
INSERT INTO bitacora VALUES("AI12217Y2015A1N6684N6840-8","I12217Y2015A1N6684","Administrador","01-10-2017","17:22:16","17:30:26");
INSERT INTO bitacora VALUES("AI12217Y2015A1N6684N8267-4","I12217Y2015A1N6684","Administrador","01-10-2017","11:14:33","Sin registrar");
INSERT INTO bitacora VALUES("AI12217Y2015A1N6684N8307-3","I12217Y2015A1N6684","Administrador","01-10-2017","08:54:01","Sin registrar");
INSERT INTO bitacora VALUES("AI12217Y2015A1N6684N8834-2","I12217Y2015A1N6684","Administrador","24-09-2017","23:11:56","Sin registrar");
INSERT INTO bitacora VALUES("AI12217Y2015A1N6684N9262-1","I12217Y2015A1N6684","Administrador","24-09-2017","21:46:13","Sin registrar");



DROP TABLE IF EXISTS categoria;

CREATE TABLE `categoria` (
  `CodigoCategoria` varchar(20) NOT NULL,
  `Nombre` varchar(50) NOT NULL,
  PRIMARY KEY (`CodigoCategoria`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO categoria VALUES("1","Programación ");



DROP TABLE IF EXISTS docente;

CREATE TABLE `docente` (
  `DUI` varchar(20) NOT NULL,
  `CodigoSeccion` varchar(70) NOT NULL,
  `Nombre` varchar(50) NOT NULL,
  `Apellido` varchar(50) NOT NULL,
  `Telefono` int(20) NOT NULL,
  `Especialidad` varchar(40) NOT NULL,
  `Jornada` varchar(50) NOT NULL,
  PRIMARY KEY (`DUI`),
  KEY `CodigoSeccion` (`CodigoSeccion`),
  CONSTRAINT `docente_ibfk_1` FOREIGN KEY (`CodigoSeccion`) REFERENCES `seccion` (`CodigoSeccion`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO docente VALUES("48963218","I1Y2017S1N5431","Julio","Porras Soto","13607895","Ing Mecatronica","Mañana");



DROP TABLE IF EXISTS encargado;

CREATE TABLE `encargado` (
  `DUI` varchar(20) NOT NULL,
  `Nombre` varchar(50) NOT NULL,
  `Telefono` int(20) NOT NULL,
  PRIMARY KEY (`DUI`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO encargado VALUES("45777622","Rocio Muñoz Avila","98546859");



DROP TABLE IF EXISTS estudiante;

CREATE TABLE `estudiante` (
  `NIE` varchar(20) NOT NULL,
  `DUI` varchar(20) NOT NULL,
  `CodigoSeccion` varchar(70) NOT NULL,
  `Nombre` varchar(50) NOT NULL,
  `Apellido` varchar(50) NOT NULL,
  `Parentesco` varchar(50) NOT NULL,
  PRIMARY KEY (`NIE`),
  KEY `DUI` (`DUI`),
  KEY `CodigoSeccion` (`CodigoSeccion`),
  CONSTRAINT `estudiante_ibfk_1` FOREIGN KEY (`DUI`) REFERENCES `encargado` (`DUI`),
  CONSTRAINT `estudiante_ibfk_2` FOREIGN KEY (`CodigoSeccion`) REFERENCES `seccion` (`CodigoSeccion`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO estudiante VALUES("45777621","45777622","I1Y2017S1N5431","Alejandro","Rodriguez Landa","Ninguno");



DROP TABLE IF EXISTS institucion;

CREATE TABLE `institucion` (
  `CodigoInfraestructura` int(30) NOT NULL,
  `Nombre` varchar(70) NOT NULL,
  `Distrito` varchar(30) NOT NULL,
  `Telefono` int(8) NOT NULL,
  `Year` int(4) NOT NULL,
  PRIMARY KEY (`CodigoInfraestructura`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO institucion VALUES("1","Biblioteca Cental Libre","10","13600490","2017");



DROP TABLE IF EXISTS libro;

CREATE TABLE `libro` (
  `CodigoLibro` varchar(70) NOT NULL,
  `CodigoCorrelativo` varchar(20) NOT NULL,
  `CodigoCategoria` varchar(20) NOT NULL,
  `CodigoProveedor` varchar(70) NOT NULL,
  `CodigoInfraestructura` int(20) NOT NULL,
  `Autor` varchar(70) NOT NULL,
  `Pais` varchar(50) NOT NULL,
  `Year` varchar(7) NOT NULL,
  `Estimado` decimal(30,2) NOT NULL,
  `Titulo` varchar(77) NOT NULL,
  `Edicion` varchar(50) NOT NULL,
  `Ubicacion` varchar(50) NOT NULL,
  `Cargo` varchar(7) NOT NULL,
  `Editorial` varchar(70) NOT NULL,
  `Existencias` int(7) NOT NULL,
  `Prestado` int(20) NOT NULL,
  `Estado` varchar(50) NOT NULL,
  PRIMARY KEY (`CodigoLibro`),
  KEY `CodigoCategoria` (`CodigoCategoria`),
  KEY `CodigoProveedor` (`CodigoProveedor`),
  KEY `CodigoInfraestructura` (`CodigoInfraestructura`),
  CONSTRAINT `libro_ibfk_2` FOREIGN KEY (`CodigoInfraestructura`) REFERENCES `institucion` (`CodigoInfraestructura`),
  CONSTRAINT `libro_ibfk_3` FOREIGN KEY (`CodigoCategoria`) REFERENCES `categoria` (`CodigoCategoria`),
  CONSTRAINT `libro_ibfk_4` FOREIGN KEY (`CodigoProveedor`) REFERENCES `proveedor` (`CodigoProveedor`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO libro VALUES("I1Y2017C1B1N2033","9789688802052","1","I1Y2017P1N0868","1","BRIAN W. KERNIGHAN","MEXICO","1991","100.00","EL LENGUAJE DE PROGRAMACION C","2 EDICION","SECTOR 5","1-3","PRENTICE HALL HISPANOAMERICANA S.A","3","0","Bueno");



DROP TABLE IF EXISTS personal;

CREATE TABLE `personal` (
  `DUI` varchar(20) NOT NULL,
  `Nombre` varchar(50) NOT NULL,
  `Apellido` varchar(50) NOT NULL,
  `Telefono` int(20) NOT NULL,
  `Cargo` varchar(50) NOT NULL,
  PRIMARY KEY (`DUI`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;




DROP TABLE IF EXISTS prestamo;

CREATE TABLE `prestamo` (
  `CodigoPrestamo` varchar(70) NOT NULL,
  `CodigoLibro` varchar(70) NOT NULL,
  `CorrelativoLibro` varchar(70) NOT NULL,
  `CodigoAdmin` varchar(70) NOT NULL,
  `FechaSalida` varchar(30) NOT NULL,
  `FechaEntrega` varchar(30) NOT NULL,
  `Estado` varchar(30) NOT NULL,
  PRIMARY KEY (`CodigoPrestamo`),
  KEY `CodigoLibro` (`CodigoLibro`),
  KEY `CodigoAdmin` (`CodigoAdmin`),
  CONSTRAINT `prestamo_ibfk_3` FOREIGN KEY (`CodigoLibro`) REFERENCES `libro` (`CodigoLibro`),
  CONSTRAINT `prestamo_ibfk_4` FOREIGN KEY (`CodigoAdmin`) REFERENCES `administrador` (`CodigoAdmin`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;




DROP TABLE IF EXISTS prestamodocente;

CREATE TABLE `prestamodocente` (
  `CodigoPrestamo` varchar(70) NOT NULL,
  `DUI` varchar(20) NOT NULL,
  KEY `CodigoPrestamo` (`CodigoPrestamo`),
  KEY `DUI` (`DUI`),
  KEY `CodigoPrestamo_2` (`CodigoPrestamo`),
  CONSTRAINT `prestamodocente_ibfk_1` FOREIGN KEY (`CodigoPrestamo`) REFERENCES `prestamo` (`CodigoPrestamo`),
  CONSTRAINT `prestamodocente_ibfk_2` FOREIGN KEY (`DUI`) REFERENCES `docente` (`DUI`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;




DROP TABLE IF EXISTS prestamoestudiante;

CREATE TABLE `prestamoestudiante` (
  `CodigoPrestamo` varchar(70) NOT NULL,
  `NIE` varchar(20) NOT NULL,
  KEY `CodigoPrestamo` (`CodigoPrestamo`),
  KEY `NIE` (`NIE`),
  CONSTRAINT `prestamoestudiante_ibfk_1` FOREIGN KEY (`NIE`) REFERENCES `estudiante` (`NIE`),
  CONSTRAINT `prestamoestudiante_ibfk_2` FOREIGN KEY (`CodigoPrestamo`) REFERENCES `prestamo` (`CodigoPrestamo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;




DROP TABLE IF EXISTS prestamopersonal;

CREATE TABLE `prestamopersonal` (
  `CodigoPrestamo` varchar(70) NOT NULL,
  `DUI` varchar(20) NOT NULL,
  KEY `CodigoPrestamo` (`CodigoPrestamo`),
  KEY `DUI` (`DUI`),
  CONSTRAINT `prestamopersonal_ibfk_1` FOREIGN KEY (`CodigoPrestamo`) REFERENCES `prestamo` (`CodigoPrestamo`),
  CONSTRAINT `prestamopersonal_ibfk_2` FOREIGN KEY (`DUI`) REFERENCES `personal` (`DUI`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;




DROP TABLE IF EXISTS prestamovisitante;

CREATE TABLE `prestamovisitante` (
  `CodigoPrestamo` varchar(70) NOT NULL,
  `DUI` varchar(20) NOT NULL,
  `Nombre` varchar(50) NOT NULL,
  `Telefono` int(20) NOT NULL,
  `Institucion` varchar(70) NOT NULL,
  KEY `CodigoPrestamo` (`CodigoPrestamo`),
  CONSTRAINT `prestamovisitante_ibfk_1` FOREIGN KEY (`CodigoPrestamo`) REFERENCES `prestamo` (`CodigoPrestamo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;




DROP TABLE IF EXISTS proveedor;

CREATE TABLE `proveedor` (
  `CodigoProveedor` varchar(70) NOT NULL,
  `Nombre` varchar(50) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `Direccion` varchar(70) NOT NULL,
  `Telefono` int(15) NOT NULL,
  `ResponAtencion` varchar(50) NOT NULL,
  PRIMARY KEY (`CodigoProveedor`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO proveedor VALUES("I1Y2017P1N0868","Jasson Campos Lazo","Jasson@gmail.com","av los proceres 546","55978634","Maria Lujan Luna");



DROP TABLE IF EXISTS seccion;

CREATE TABLE `seccion` (
  `CodigoSeccion` varchar(70) NOT NULL,
  `Nombre` varchar(50) NOT NULL,
  PRIMARY KEY (`CodigoSeccion`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO seccion VALUES("I1Y2017S1N5431","2017Electrotécnia A");



SET FOREIGN_KEY_CHECKS=1;