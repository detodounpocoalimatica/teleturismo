DROP DATABASE IF EXISTS `planetaria_de_teleturismo`;

CREATE DATABASE `planetaria_de_teleturismo`
DEFAULT CHARACTER SET = 'utf8' DEFAULT COLLATE 'utf8_spanish_ci';

USE `planetaria_de_teleturismo`;

CREATE TABLE `usuario`
(
	email_nombre_usuario varchar(255) NOT NULL,	
	nombre varchar(255) NOT NULL,
	apellidos varchar(255) NOT NULL,
	telefono int NOT NULL,
	direccion varchar(1023) NOT NULL,
	password varchar(255) NOT NULL,
	desea_recibir_informacion varchar(3) NOT NULL,
	dato_adicional_de_interes varchar(1023),	
	PRIMARY KEY (email_nombre_usuario)
);

CREATE TABLE `tarjeta`
(
	numero_de_tarjeta varchar(20) NOT NULL,
	anyo_de_caducidad int NOT NULL,
	mes_de_caducidad int NOT NULL,
	numero_secreto int NOT NULL,
	titular varchar(255) NOT NULL,
	PRIMARY KEY (numero_de_tarjeta)
);

CREATE TABLE `usuario_tarjeta`
(
	email_nombre_usuario varchar(255) NOT NULL,
	numero_de_tarjeta varchar(20) NOT NULL,
	PRIMARY KEY (email_nombre_usuario, numero_de_tarjeta),
	FOREIGN KEY (email_nombre_usuario) REFERENCES usuario(email_nombre_usuario),
	FOREIGN KEY (numero_de_tarjeta) REFERENCES tarjeta(numero_de_tarjeta)
);

CREATE TABLE `solicitud_de_informacion`
(
	id int NOT NULL AUTO_INCREMENT,
	nombre varchar(255) NOT NULL,
	apellidos varchar(255) NOT NULL,
	email varchar(255) NOT NULL,
	telefono int NOT NULL,
	direccion varchar(1023) NOT NULL,	
	consulta_de_informacion varchar(1023) NOT NULL,
	desea_recibir_informacion varchar(3) NOT NULL,
	PRIMARY KEY (id)
);

CREATE TABLE `usuario_administrador`
(
	email_nombre_usuario varchar(255) NOT NULL,
	password varchar(255) NOT NULL,	
	PRIMARY KEY (email_nombre_usuario, password)
);

CREATE TABLE `producto_viaje`
(
	id int NOT NULL,
	nombre varchar(255) NOT NULL,
	PRIMARY KEY (id)
);

CREATE TABLE `producto_hardware`
(
	id int NOT NULL,
	nombre varchar(255) NOT NULL,
	PRIMARY KEY (id)
);

CREATE TABLE `solicitud_de_precompra_viaje`
(
	email_nombre_usuario varchar(255) NOT NULL,	
	id_producto_viaje int NOT NULL,
	fecha_y_hora TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	PRIMARY KEY (email_nombre_usuario, id_producto_viaje),
	FOREIGN KEY (email_nombre_usuario) REFERENCES usuario(email_nombre_usuario),
	FOREIGN KEY (id_producto_viaje) REFERENCES producto_viaje(id)
);

CREATE TABLE `solicitud_de_compra_hardware`
(
	email_nombre_usuario varchar(255) NOT NULL,	
	id_producto_hardware int NOT NULL,	
	fecha_y_hora TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	PRIMARY KEY (email_nombre_usuario, id_producto_hardware),
	FOREIGN KEY (email_nombre_usuario) REFERENCES usuario(email_nombre_usuario),
	FOREIGN KEY (id_producto_hardware) REFERENCES producto_hardware(id)
);

INSERT INTO producto_viaje
(id, nombre)
VALUE
(1, 'solicitud de puesto en la cola'),
(2, '3 meses'),
(3, '6 meses'),
(4, '12 meses');

INSERT INTO producto_hardware
(id, nombre)
VALUE
(1, 'One Plus 6 Black Mirror'),
(2, 'MSI GT75 Titan'),
(3, 'GA-X99-SOC Champion'),
(4, 'Nvidia Geforce GTX 1080 TI');

INSERT INTO usuario_administrador
(email_nombre_usuario, password)
VALUE
('miguel@miguel.es', 'jkmmmm77');