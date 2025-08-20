-- Script SQL para crear la tabla vehiculos en la base de datos ecotec
-- Sigue la misma estructura que la tabla usuarios pero con campos específicos para vehículos

CREATE DATABASE IF NOT EXISTS `ecotec`;
USE `ecotec`;

CREATE TABLE IF NOT EXISTS `vehiculos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `marca` varchar(100) NOT NULL,
  `modelo` varchar(100) NOT NULL,
  `color` varchar(50) NOT NULL,
  `precio` decimal(10,2) NOT NULL DEFAULT 0.00,
  `imagen` varchar(255) DEFAULT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Insertar algunos datos de ejemplo (opcional)
-- INSERT INTO `vehiculos` (`marca`, `modelo`, `color`, `precio`, `imagen`, `estado`) VALUES
-- ('Toyota', 'Corolla', 'Blanco', 25000.00, '', 1),
-- ('Honda', 'Civic', 'Negro', 28000.00, '', 1),
-- ('Ford', 'Focus', 'Azul', 22000.00, '', 1);