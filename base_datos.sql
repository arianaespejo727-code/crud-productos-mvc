CREATE DATABASE evaluacion_mvc;
USE evaluacion_mvc;

CREATE TABLE productos (
id INT PRIMARY KEY AUTO_INCREMENT,
nombre VARCHAR(100),
categoria VARCHAR(80),
precio DECIMAL(10,2)
); 

INSERT INTO productos (nombre,categoria,precio) VALUES
('Laptop', 'Tecnologia', 3000),
('Silla gamer', 'Muebles', 549),
('Monitor', 'Tecnologia', 659),
('Escritorio gamer', 'Muebles', 356.65 ),
('Adidas Samba', 'Zapatillas', 429);


