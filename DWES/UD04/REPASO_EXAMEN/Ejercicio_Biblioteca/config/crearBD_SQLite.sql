DROP TABLE IF EXISTS libros;

CREATE TABLE libros(
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    titulo TEXT NOT NULL,
    precio REAL NOT NULL
);

INSERT INTO libros
(titulo, precio)
VALUES
('El Quijote', 15.00),
('La Regenta', 12.50),
('Platero y yo', 9.90);