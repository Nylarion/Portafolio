-- ========================================================
-- 1. CREACIÓN DE LA BASE DE DATOS
-- ========================================================
CREATE DATABASE IF NOT EXISTS `lcerda_db1` 
DEFAULT CHARACTER SET utf8mb4 
COLLATE utf8mb4_unicode_ci;

USE `lcerda_db1`;

-- ========================================================
-- 2. CREACION DE TABLAS
-- ========================================================

CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `username` VARCHAR(50) NOT NULL UNIQUE,
  `password` VARCHAR(255) NOT NULL,
  `nombre_completo` VARCHAR(100) NOT NULL,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


CREATE TABLE IF NOT EXISTS `perfil` (
  `id` INT PRIMARY KEY DEFAULT 1,
  `nombre` VARCHAR(100) NOT NULL,
  `biografia` TEXT NOT NULL,
  `foto` VARCHAR(255) DEFAULT 'profile.png'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


CREATE TABLE IF NOT EXISTS `herramientas` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `slug` VARCHAR(50) NOT NULL UNIQUE,
  `nombre` VARCHAR(100) NOT NULL,
  `icono` VARCHAR(100) NOT NULL,
  `visible` TINYINT(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


CREATE TABLE IF NOT EXISTS `habilidades` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `nombre` VARCHAR(100) NOT NULL,
  `porcentaje` INT NOT NULL DEFAULT 50,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


CREATE TABLE IF NOT EXISTS `proyectos` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `titulo` VARCHAR(100) NOT NULL,
  `descripcion` TEXT NOT NULL,
  `imagen` VARCHAR(255) DEFAULT 'default_project.png',
  `url_demo` VARCHAR(255) DEFAULT '#',
  `url_github` VARCHAR(255) DEFAULT '#',
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `contactos`(
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `nombre` VARCHAR(100) NOT NULL,
  `correo` VARCHAR(100) NOT NULL,
  `asunto` VARCHAR(150) NOT NULL,
  `mensaje` TEXT NOT NULL,
  `fecha` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


-- ========================================================
-- 3. DATOS
-- ========================================================

INSERT INTO `usuarios` (`id`, `username`, `password`, `nombre_completo`) 
VALUES (1, 'admin', 'admin', 'Administrador') -- Cambiar username y password en caso de seguridad de la página.
ON DUPLICATE KEY UPDATE `username`=`username`;

INSERT INTO `perfil` (`id`, `nombre`, `biografia`) 
VALUES (1, 'Tu Nombre', 'Tu biografia');

INSERT INTO `herramientas` (`slug`, `nombre`, `icono`, `visible`) VALUES
('vscode', 'VS Code', 'fa-solid fa-code', 0),
('python', 'Python', 'fa-brands fa-python', 0),
('html', 'HTML', 'fa-brands fa-html5', 0),
('css', 'CSS', 'fa-brands fa-css3-alt', 0),
('js', 'JavaScript', 'fa-brands fa-js', 0),
('git', 'Git', 'fa-brands fa-git-alt', 0),
('linux', 'Linux', 'fa-brands fa-linux', 0),
('php', 'PHP', 'fa-brands fa-php', 0),
('mysql', 'MySQL', 'fa-solid fa-database', 0)
ON DUPLICATE KEY UPDATE `slug`=`slug`;