-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 18-05-2018 a las 20:55:07
-- Versión del servidor: 5.6.38
-- Versión de PHP: 7.2.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `practica8`
-- 
CREATE DATABASE practica8;

USE practica8;
-- --------------------------------------------------------
--
-- Estructura de tabla para la tabla `alumnos`
--

CREATE TABLE `alumnos` (
  `matricula` varchar(10) NOT NULL PRIMARY KEY,
  `nombre` text NOT NULL,
  `carrera` int NOT NULL REFERENCES carreras(id),
  `id_tutor` int NOT NULL REFERENCES maestros(no_empleado)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Estructura de tabla para la tabla `maestros`
--

CREATE TABLE `maestros` (
  `no_empleado` varchar(10) NOT NULL PRIMARY KEY,
  `nombre` text NOT NULL,
  `carrera` int NOT NULL REFERENCES carreras(id),
  `email` text NOT NULL,
  `password` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Estructura de tabla para la tabla `carreras`
--

CREATE TABLE `carreras` (
  `id` int(11) PRIMARY KEY AUTO_INCREMENT,
  `nombre` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Estructura de tabla para la tabla `tutorias`
--

CREATE TABLE `tutorias` (
  `id` int(11) PRIMARY KEY AUTO_INCREMENT,
  `tutorado` int(11) NOT NULL  REFERENCES alumnos(matricula),
  `tutor` int(11) NOT NULL  REFERENCES maestros(no_empleado),
  `tipo_tutoria` text NOT NULL,
  `fecha` date NOT NULL,
  `hora` time NOT NULL,
  `tutoria` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


--
-- Volcado de datos para la tabla `maestros`
--

INSERT INTO `maestros` (`no_empleado`, `nombre`, `carrera`,  `email`,  `password`) VALUES
('EMP-001', 'Jose Luis', 'Mecatronica', 'mail@mail.com233','12345'),
('EMP-002', 'Mario Rdz.', 'ITI', 'a@d.com', '54321');

INSERT INTO  `carreras` (`nombre`) VALUES
('Mecatronica'),('ISA'),('PyMES'),('ITI'),('ITM');


/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
