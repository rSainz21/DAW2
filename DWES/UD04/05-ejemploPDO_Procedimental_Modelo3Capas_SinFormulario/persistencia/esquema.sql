DROP DATABASE IF EXISTS laboratorio;
CREATE DATABASE IF NOT EXISTS laboratorio CHARACTER SET utf8mb4;
USE laboratorio;

CREATE TABLE materiales (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    stock INT NOT NULL CHECK (stock >= 0),
    unidad VARCHAR(20) NOT NULL,
    ubicacion VARCHAR(100) NOT NULL
);

-- Auditoría de salidas. Si se borra el material, el histórico se conserva
-- (material_id pasa a NULL y nombre_material guarda una copia del nombre).
CREATE TABLE auditoria_salidas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    material_id INT NULL,
    nombre_material VARCHAR(100) NOT NULL,
    cantidad INT NOT NULL,
    stock_anterior INT NOT NULL,
    stock_nuevo INT NOT NULL,
    fecha TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (material_id) REFERENCES materiales(id) ON DELETE SET NULL
);

INSERT INTO materiales (nombre, stock, unidad, ubicacion) VALUES
('Ácido clorhídrico 37%', 12, 'litros', 'Armario A1'),
('Guantes de nitrilo', 200, 'unidades', 'Estantería B2'),
('Tubos de ensayo', 80, 'unidades', 'Armario C3'),
('Etanol 96%', 25, 'litros', 'Armario A2');
