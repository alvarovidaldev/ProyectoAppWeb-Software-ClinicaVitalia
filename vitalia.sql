-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 10-06-2024 a las 06:52:36
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `vitalia`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `administrador`
--

CREATE TABLE `administrador` (
  `idAdministrador` int(11) NOT NULL,
  `aNombre` varchar(45) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `aPaterno` varchar(45) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `aMaterno` varchar(45) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `aTelefono` varchar(45) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `aCi` varchar(45) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `email` varchar(80) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `pasword` char(65) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `estado` varchar(20) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL DEFAULT 'Activo'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `administrador`
--

INSERT INTO `administrador` (`idAdministrador`, `aNombre`, `aPaterno`, `aMaterno`, `aTelefono`, `aCi`, `email`, `pasword`, `estado`) VALUES
(1, 'Rodrigo', 'Aruquipa', 'Yujra', '76515357', '12992412', 'rodrigo@gmail.com', '$2y$10$o/1LoFgKUpg196559wZGMuwYlAPhCFUK.fH1BbIGYWhIFcliTv0xm', 'Activo'),
(2, 'Alvaro Vidal', 'Mamani', 'Vargas', '78807786', '12345678', 'alvaro@gmail.com', '$2y$10$CxfXzwIwmtCCYiZRYI0RHOpOjMV0DecafDtr8X3kE6ZHoOXZOdJyS', 'Activo'),
(3, 'Sergio', 'Bautista', 'Chura', '67338247', '13217386', 'sergio@gmail.com', '$2y$10$O2F08amG8NqyTa9GTyFVSu02o5tLYEUqQZ9/EcLSRlysBlPPamMNC', 'Activo'),
(4, 'Jessica Adriana', 'Maydana', 'Chambi', '72342173', '13549906', 'jessica@gmail.com', '$2y$10$1IC2WDLfoXH9fxfgkuRaE.H1NjyZ.oZGP4QfHJ4SgihR9ZPL/jo8a', 'Activo'),
(5, 'Milton Alejandro', 'Villarroel', 'Garvizu', '79149181', '4776421', 'milton@gmail.com', '$2y$10$s3gVVnZGjwWXBcZsn63Wk.COPjl/.MpAMspIpsPyk6nEcFDorrcai', 'Activo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `atencion`
--

CREATE TABLE `atencion` (
  `idAtencion` int(11) NOT NULL,
  `fechaAtencion` date NOT NULL,
  `diagnostico` varchar(40) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `tratamiento` text CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `costoAtencion` decimal(10,2) NOT NULL,
  `idPaciente` int(11) NOT NULL,
  `idMedico` int(11) NOT NULL,
  `idCita` int(11) NOT NULL,
  `estado` varchar(20) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL DEFAULT 'Activo'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `atencion`
--

INSERT INTO `atencion` (`idAtencion`, `fechaAtencion`, `diagnostico`, `tratamiento`, `costoAtencion`, `idPaciente`, `idMedico`, `idCita`, `estado`) VALUES
(4, '0000-00-00', 'Cefalea ', 'Analgésicos', 100.00, 3, 2, 1, 'Activo'),
(6, '0000-00-00', 'Angina de Pecho', 'Nitratos (Nitroglicerina):\r\n\r\nUso: Alivia rápidamente el dolor de la angina al dilatar las arterias coronarias y mejorar el flujo sanguíneo al corazón.\r\nAdministración: Puede ser tomada como una pastilla sublingual, un spray o un parche transdérmico.', 100.00, 1, 2, 2, 'Activo'),
(11, '2024-05-29', 'inflamacion', 'pomadas', 50.00, 1, 4, 2, 'Activo'),
(12, '2024-05-29', 'www', 'viatlia', 50.00, 6, 1, 4, 'Activo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cita`
--

CREATE TABLE `cita` (
  `idCita` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `hora` time NOT NULL,
  `motivo` varchar(40) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `idMedico` int(11) NOT NULL,
  `idPaciente` int(11) NOT NULL,
  `estado` varchar(20) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL DEFAULT 'Activo'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `cita`
--

INSERT INTO `cita` (`idCita`, `fecha`, `hora`, `motivo`, `idMedico`, `idPaciente`, `estado`) VALUES
(1, '2024-05-31', '09:00:00', 'dolor de cabeza', 2, 3, 'Activo'),
(2, '2024-05-29', '11:00:00', 'Dolor intenso en el pecho', 2, 1, 'Activo'),
(3, '2024-05-30', '12:00:00', 'Dolor Abdominal', 3, 1, 'Activo'),
(4, '2024-05-29', '14:00:00', 'Lesion pierna', 1, 6, 'Activo'),
(5, '2024-06-05', '09:00:00', 'lesion', 4, 1, 'Activo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `medico`
--

CREATE TABLE `medico` (
  `idMedico` int(11) NOT NULL,
  `mNombre` varchar(45) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `mPaterno` varchar(45) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `mMaterno` varchar(45) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `mTelefono` varchar(20) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `especialidad` varchar(45) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `mCi` varchar(20) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `imagen` varchar(100) NOT NULL,
  `email` varchar(80) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `pasword` char(65) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `estado` varchar(20) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL DEFAULT 'Activo'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `medico`
--

INSERT INTO `medico` (`idMedico`, `mNombre`, `mPaterno`, `mMaterno`, `mTelefono`, `especialidad`, `mCi`, `imagen`, `email`, `pasword`, `estado`) VALUES
(1, 'Fernando ', 'Vargas', 'Illanes', '76515357', 'Traumatólogo', '52543487', '1', 'vargas@gmail.com', '$2y$10$/gxs9TSxVr2UbNhi41wJleYOv9.bN3rE.nrGomS8f57ngbBD79ZCK', 'Activo'),
(2, 'Milton Alejandro', 'Villarroel', 'Garvizu', '79149181', 'Cardiólogo', '4776421', '2', 'alejandro@gmail.com', '$2y$10$hpsYqV4rDHoRfbHP3nW73eXlZfDehW/Wh45oXHkdPOEoFjhig7c9m', 'Activo'),
(3, 'Alvaro Vidal', 'Mamani', 'Vargas', '78807786', 'Ginecologo', '13696217', '3', 'vidal@gmail.com', '$2y$10$l84uMBPdtlgjzsQQ9w8VJedTmLgf2vI5wGtYR5vXQSNJv5GZITpRS', 'Activo'),
(4, 'Rodrigo', 'Aruquipa', 'Yujra', '76515357', 'Cirujano', '12992412', '4', 'aruquipa@gmail.com', '$2y$10$8af6uqOpNuE/wYDoRx.jLOCrVAOCHT6nQWFC25qTfR1wjiTNC8Tqi', 'Activo'),
(5, 'Jessica Adriana', 'Maydana', 'Chambi', '72342173', 'dermatologo', '13549906', '5', 'Adri@gmail.com', '$2y$10$SpTabzzrFTpnCaLO.bj1TuAWdnIYVxYyyGoZoxOKWbAkIHB.K93lq', 'Activo'),
(6, 'Sergio', 'Bautista', 'Chura', '67338247', 'Medicina Interna', '13217386', '6', 'bautista@gmail.com', '$2y$10$rSTNSQ37OU.w4fEIJT.uIeS3Pilx5BTWmOKhqmEVCf5RzLZG8NORm', 'Activo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `paciente`
--

CREATE TABLE `paciente` (
  `idPaciente` int(11) NOT NULL,
  `pNombre` varchar(45) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `pPaterno` varchar(45) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `pMaterno` varchar(45) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `pCi` varchar(20) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `pTelefono` varchar(45) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `pFechaN` date NOT NULL,
  `email` varchar(80) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `pasword` char(65) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `estado` varchar(20) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL DEFAULT 'Activo'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `paciente`
--

INSERT INTO `paciente` (`idPaciente`, `pNombre`, `pPaterno`, `pMaterno`, `pCi`, `pTelefono`, `pFechaN`, `email`, `pasword`, `estado`) VALUES
(1, 'Pamela', 'Vicente', 'Alarcon', '16324745', '78693348', '2004-03-29', 'pame@gmail.com', '$2y$10$02qzNcmQWoaUOLmaxklVWeX4i9gkVwsPP8SzRiU7A6q6CYT5Q4jg.', 'Activo'),
(2, 'Juan', 'Condori', 'Moya', '14557896', '75487554', '2005-03-08', 'juan@gmail.com', '$2y$10$EjpsjRzis9NpjY183yTmUuJ6YlwfFvY30OuPAAQCJFPiHCGanOXFu', 'Activo'),
(3, 'Pedro', 'Perez', 'Pereyra', '14785623', '74658796', '2024-02-29', 'pedro@gmail.com', '$2y$10$DzX1fdL7/xIg4HHKzujV0eaxHQ8XlmtRn20hk7RIxvjjFU05zsA2y', 'Activo'),
(4, 'Daniela Paola', 'Torres', 'vargas', '17852562', '61234567', '2024-05-03', 'daniela@gmail.com', '$2y$10$FsBva8VeE.jfkwauN4qq5Owa.jK4oAA0657eD0xVEVItfa5GUOS1m', 'Activo'),
(5, 'Miguel', 'Ruiz', 'Morales', '14785240', '67123456', '2023-11-02', 'miguel@gmail.com', '$2y$10$8tsvSPCmFVq5Uj/YPumYd.LS24H8.Qr.Dpnhu1Dh1j.HuAaPXygli', 'Activo'),
(6, '1', '1', '1', '11', '1', '2024-05-29', '11@gm.com', '$2y$10$OSEYAo6us8UCpH/kIZ.wp.adyWINorZC6OgWYyq9.PKQtYWRJgAQm', 'Activo'),
(7, 'aa', 'aa', 'aa', '11', '11', '2024-06-09', 'aa@gmail.com', '$2y$10$PorJaOmBkC6EQS/ymRfsSO8fceyupGVceyc0w.q1XjqNYcwNQYcL.', 'Inactivo'),
(9, 'bb', 'bb', 'bb', '22', '22', '2024-06-08', 'bb@gmail.com', '$2y$10$qaQdqYBxdGNV5.k0i/kh6e7r724srmsxH4dV0XJjTTF8gfKc/N.LC', 'Activo');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `administrador`
--
ALTER TABLE `administrador`
  ADD PRIMARY KEY (`idAdministrador`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indices de la tabla `atencion`
--
ALTER TABLE `atencion`
  ADD PRIMARY KEY (`idAtencion`);

--
-- Indices de la tabla `cita`
--
ALTER TABLE `cita`
  ADD PRIMARY KEY (`idCita`);

--
-- Indices de la tabla `medico`
--
ALTER TABLE `medico`
  ADD PRIMARY KEY (`idMedico`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indices de la tabla `paciente`
--
ALTER TABLE `paciente`
  ADD PRIMARY KEY (`idPaciente`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `administrador`
--
ALTER TABLE `administrador`
  MODIFY `idAdministrador` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `atencion`
--
ALTER TABLE `atencion`
  MODIFY `idAtencion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `cita`
--
ALTER TABLE `cita`
  MODIFY `idCita` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `medico`
--
ALTER TABLE `medico`
  MODIFY `idMedico` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `paciente`
--
ALTER TABLE `paciente`
  MODIFY `idPaciente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
