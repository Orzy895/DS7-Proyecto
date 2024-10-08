CREATE DATABASE PFASE1;

USE PFASE1;

CREATE TABLE Roles (
  id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  nombre varchar(255) NOT NULL,
  descripcion varchar(255) NOT NULL
);

CREATE TABLE Usuarios (
  id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  nombre varchar(255) NOT NULL,
  celula varchar(255) NOT NULL,
  email varchar(255) NOT NULL,
  contraseña varchar(255) NOT NULL,
  role_id INT NOT NULL,
  FOREIGN KEY (role_id) REFERENCES Roles(id)
);

CREATE TABLE Permisos (
  id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  descripcion varchar(255)
);

CREATE TABLE Roles_Permisos (
  id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  role_id INT NOT NULL,
  permiso_id INT,
  FOREIGN KEY (role_id) REFERENCES Roles(id),
  FOREIGN KEY(permiso_id) REFERENCES Permisos(id)
);

CREATE TABLE Pacientes (
  id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  usuario_id INT,
  historial varchar(255),
  seguro varchar(255),
  FOREIGN KEY(usuario_id) REFERENCES Usuarios(id)
);

CREATE TABLE Personales (
  id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  usuario_id INT NOT NULL,
  posicion varchar(255) NOT NULL,
  FOREIGN KEY(usuario_id) REFERENCES Usuarios(id)
);

CREATE TABLE Citas (
  id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  tiempo timestamp NOT NULL,
  lugar varchar(255) NOT NULL,
  paciente_id INT NOT NULL,
  medico_id INT NOT NULL,
  FOREIGN KEY(paciente_id) REFERENCES Pacientes(id),
  FOREIGN KEY(medico_id) REFERENCES Personales(id)
);

CREATE TABLE Productos (
  id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  tipo varchar(255) NOT NULL,
  nombre varchar(255) NOT NULL,
  cantidad INT NOT NULL,
  precio DECIMAL(10, 2)
);

CREATE TABLE Facturas (
  id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  detalles json,
  total DECIMAL(10, 2),
  cajero_id INT,
  FOREIGN KEY(cajero_id) REFERENCES Personales(id)
);

INSERT INTO `roles` (`id`, `nombre`, `descripcion`) VALUES (NULL, 'USUARIO', 'es un usuario');