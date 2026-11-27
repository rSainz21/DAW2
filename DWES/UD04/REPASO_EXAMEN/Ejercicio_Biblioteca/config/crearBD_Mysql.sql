DROP DATABASE IF EXISTS biblioteca;
CREATE DATABASE IF NOT EXISTS biblioteca CHARACTER SET utf8mb4;

USE biblioteca;

DROP TABLE IF EXISTS libros;

CREATE TABLE libros(
    id INT AUTO_INCREMENT PRIMARY KEY,
    titulo VARCHAR(255) NOT NULL,
    precio DECIMAL(10, 2) NOT NULL
) ENGINE=InnoDB;

INSERT INTO libros
(titulo, precio)
VALUES
('El Quijote', 15.00),
('La Regenta', 12.50),
('Platero y yo', 9.90);

