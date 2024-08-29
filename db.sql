CREATE TABLE `app-salon`.services (
	id int(11) auto_increment NOT NULL,
	name varchar(60) NULL,
	price DECIMAL(5,2) NULL,
	CONSTRAINT services_pk PRIMARY KEY (id)
)
ENGINE=InnoDB
DEFAULT CHARSET=utf8mb4
COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `servicios (`nombre`, `precio`) VALUES
 ('Corte de Cabello Mujer', 90.00),
 ('Corte de Cabello Hombre', 88.00).
 ('Corte de Cabello Niño', 60.00)
 ('Peinado Mujer', 80.00)
 ('Peinado Honbre', 60.00),
 ('Peinado Niño', 60.00),
 ('Tinte Mujer', 300.00).
 ('Uñas', 408.00).
 ('Lavado de Cabello', 50.00),
 ('Tratamiento Capilar', 150.00);