-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 24, 2018 at 09:09 AM
-- Server version: 5.7.21-0ubuntu0.16.04.1
-- PHP Version: 7.0.25-0ubuntu0.16.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `b_training`
--

-- --------------------------------------------------------

--
-- Table structure for table `app_estadosusuario`
--

CREATE TABLE `app_estadosusuario` (
  `sedu_id` tinyint(4) UNSIGNED NOT NULL,
  `sedu_creacion` datetime DEFAULT NULL,
  `sedu_descripcion` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `app_estadosusuario`
--

INSERT INTO `app_estadosusuario` (`sedu_id`, `sedu_creacion`, `sedu_descripcion`) VALUES
(1, NULL, 'Activado'),
(2, NULL, 'Inactivo');

-- --------------------------------------------------------

--
-- Table structure for table `app_keys`
--

CREATE TABLE `app_keys` (
  `id` int(11) NOT NULL,
  `key` varchar(40) NOT NULL,
  `level` int(2) NOT NULL,
  `ignore_limits` tinyint(1) NOT NULL DEFAULT '0',
  `date_created` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `app_keys`
--

INSERT INTO `app_keys` (`id`, `key`, `level`, `ignore_limits`, `date_created`) VALUES
(1, 'fad24f17d5d26b63bf31430000d185e8', 0, 0, 0),
(2, '94451e243b3ac6be987483787e7fb022', 0, 0, 0),
(3, '97c3580abf2c0225234055703367207d', 0, 0, 0),
(4, '2372672be647833e39e44179efe21ca1', 0, 0, 0),
(5, '6746d563db5b8feb3755c1d25b80dad2', 0, 0, 0),
(6, '7fb512502ed16b7f725e141b07f4dd78', 0, 0, 0),
(7, '55cebe60927a0e9eac757491fed53916', 0, 0, 0),
(8, '40c0379b7ba6539bbf757d557550c5e1', 0, 0, 0),
(9, 'b9fb4e89d6ea94350435d31d02d0f174', 0, 0, 0),
(10, 'b2e82122a68520d4582e7c08076bf197', 0, 0, 0),
(11, 'b44f015754a683ef5d6fea0719404957', 0, 0, 0),
(12, '381a8a7ed9db366ecc02818f78240d8e', 0, 0, 0),
(13, 'a27c8a9e36c005620e6d5a5a57488c38', 0, 0, 0),
(14, '083d790b5a35f55a960d26d541946923', 0, 0, 0),
(15, '1a728752ed5025b79ac5dc22491ff7bb', 0, 0, 0),
(16, '95f335198139fdec22363b4961bd6d9a', 0, 0, 0),
(17, 'c4040c5ea151d95efc57ea419f83d8fc', 0, 0, 0),
(18, '800c6bdf5dcf4e64cda14ea57df51a85', 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `app_tiposusuario`
--

CREATE TABLE `app_tiposusuario` (
  `stdu_id` tinyint(3) UNSIGNED NOT NULL,
  `stdu_creacion` datetime DEFAULT NULL,
  `stdu_ultima_modificacion` datetime DEFAULT NULL,
  `stdu_descripcion` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `app_tiposusuario`
--

INSERT INTO `app_tiposusuario` (`stdu_id`, `stdu_creacion`, `stdu_ultima_modificacion`, `stdu_descripcion`) VALUES
(1, NULL, NULL, 'Cliente'),
(2, NULL, NULL, 'Administrador');

-- --------------------------------------------------------

--
-- Table structure for table `app_usuarios`
--

CREATE TABLE `app_usuarios` (
  `su_id` int(20) UNSIGNED NOT NULL,
  `su_nombres` varchar(100) NOT NULL,
  `su_apellidos` varchar(100) NOT NULL,
  `su_estado` tinyint(4) UNSIGNED DEFAULT '1',
  `su_creacion` datetime DEFAULT NULL,
  `su_ultima_modificacion` datetime DEFAULT NULL,
  `su_movil` varchar(15) NOT NULL,
  `su_token` varchar(40) CHARACTER SET utf8 DEFAULT NULL,
  `su_api_key_push` text,
  `su_tipo_usuario` tinyint(3) UNSIGNED DEFAULT '1',
  `su_correo` varchar(30) NOT NULL,
  `su_ciudad` varchar(30) NOT NULL,
  `su_tipo_dieta` smallint(5) UNSIGNED DEFAULT NULL,
  `su_foto` varchar(50) DEFAULT NULL,
  `su_calificacion` double(2,1) DEFAULT '0.0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `app_usuarios`
--

INSERT INTO `app_usuarios` (`su_id`, `su_nombres`, `su_apellidos`, `su_estado`, `su_creacion`, `su_ultima_modificacion`, `su_movil`, `su_token`, `su_api_key_push`, `su_tipo_usuario`, `su_correo`, `su_ciudad`, `su_tipo_dieta`, `su_foto`, `su_calificacion`) VALUES
(1, 'Cesar', 'Osorio', 1, '2017-10-01 12:26:56', '2018-02-20 17:10:24', '3147013930', NULL, NULL, 2, 'NULL', 'NULL', NULL, NULL, 0.0),
(3, 'Andres', 'Diaz', 1, '2017-10-26 12:26:56', '2018-02-08 12:30:55', '3147013931', '94451e243b3ac6be987483787e7fb022', NULL, 1, 'andres@gmail.com', 'Cartagena', NULL, '1513787451741.jpg', 0.0),
(4, 'pedro', 'Arboleda', 1, '2017-10-26 12:27:30', '2018-02-13 16:42:47', '3147013932', '97c3580abf2c0225234055703367207d', 'c78Pl05Cfps:APA91bFSPlS3Ghlx2tnAuevZNLXC9aLCqBzrNhKRuGeW8fD8et8jV-GCa0uWfugPqsMavF79rhB1WZq7FV_6yeu_hOZhWEP6jwS6STDDUunYNMfdgMU3tF6UmuNVFAWdwnB0vRUVACA2', 1, 'co@progr.acom', 'Pasto', NULL, '1518558163782.jpg', 1.0),
(12, 'pepito', 'perez', 1, '2017-12-01 17:39:25', '2018-01-23 15:49:36', '3141111111', '40c0379b7ba6539bbf757d557550c5e1', NULL, 1, 'pepito@gmail.com', 'cartagena', NULL, '1512167920221.jpg', 3.0),
(13, 'Cristian', 'Cortez', 1, '2017-12-20 10:20:04', '2017-12-20 14:49:04', '3147013990', 'b9fb4e89d6ea94350435d31d02d0f174', NULL, 1, 'juan@gmail.com', 'Buenaventura', NULL, '1513799402764.jpg', 0.0),
(28, 'Juana', 'Arco', 1, '2017-12-27 12:30:44', '2017-12-27 19:15:43', '997989497', 'a27c8a9e36c005620e6d5a5a57488c38', NULL, 1, 'arco@gmail.com', 'Cal8', NULL, '1514420353990.jpg', 0.0),
(32, 'Alejandro', 'Medina', 1, '2017-12-27 15:39:01', '2018-01-10 15:36:47', '3143860980', '1a728752ed5025b79ac5dc22491ff7bb', NULL, 1, 'alejo@gmail.com', 'Cali', NULL, '1515616603144.jpg', 0.0),
(33, 'Kamila', 'Valencia', 1, '2017-12-27 16:36:59', '2018-01-10 15:13:32', '3143860981', '95f335198139fdec22363b4961bd6d9a', NULL, 1, 'kamila@gmail.com', 'Cali', NULL, '1515615207728.jpg', 0.0),
(34, 'Luis Alejandro', 'Arias', 1, '2018-01-03 18:01:30', '2018-01-04 07:23:32', '3163473535', 'c4040c5ea151d95efc57ea419f83d8fc', '1', 1, 'laa@programarte.com.co', 'Cali', NULL, '1515068478542.jpg', 4.0),
(35, 'Juan Manuel', 'Hernandez Arango', 1, '2018-01-04 11:10:41', '2018-01-17 13:08:51', '3217823464', '800c6bdf5dcf4e64cda14ea57df51a85', NULL, 1, 'Primeravistapub@gmail.com', 'Cali', NULL, '1515082534018.jpg', 0.0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `app_estadosusuario`
--
ALTER TABLE `app_estadosusuario`
  ADD PRIMARY KEY (`sedu_id`);

--
-- Indexes for table `app_keys`
--
ALTER TABLE `app_keys`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `app_tiposusuario`
--
ALTER TABLE `app_tiposusuario`
  ADD PRIMARY KEY (`stdu_id`),
  ADD KEY `stdu_id` (`stdu_id`),
  ADD KEY `stdu_id_2` (`stdu_id`);

--
-- Indexes for table `app_usuarios`
--
ALTER TABLE `app_usuarios`
  ADD PRIMARY KEY (`su_id`),
  ADD UNIQUE KEY `Movil` (`su_movil`),
  ADD KEY `sc_id` (`su_id`),
  ADD KEY `Tipo de Usuario` (`su_tipo_usuario`),
  ADD KEY `su_tipo_usuario` (`su_tipo_usuario`),
  ADD KEY `su_estado` (`su_estado`),
  ADD KEY `su_tipo_dieta` (`su_tipo_dieta`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `app_estadosusuario`
--
ALTER TABLE `app_estadosusuario`
  MODIFY `sedu_id` tinyint(4) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `app_keys`
--
ALTER TABLE `app_keys`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `app_tiposusuario`
--
ALTER TABLE `app_tiposusuario`
  MODIFY `stdu_id` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `app_usuarios`
--
ALTER TABLE `app_usuarios`
  MODIFY `su_id` int(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `app_usuarios`
--
ALTER TABLE `app_usuarios`
  ADD CONSTRAINT `app_usuarios_ibfk_1` FOREIGN KEY (`su_tipo_usuario`) REFERENCES `app_tiposusuario` (`stdu_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `app_usuarios_ibfk_2` FOREIGN KEY (`su_estado`) REFERENCES `app_estadosusuario` (`sedu_id`) ON DELETE SET NULL ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
