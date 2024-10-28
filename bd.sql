CREATE DATABASE clinica;

USE clinica;

CREATE TABLE Roles (
  id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  nombre varchar(255) NOT NULL,
  descripcion varchar(255) NOT NULL
);

CREATE TABLE Usuarios (
  id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  nombre varchar(255) NOT NULL,
  cedula varchar(255) NOT NULL,
  email varchar(255) NOT NULL,
  contraseña varchar(255) NOT NULL,
  role_id INT NOT NULL,
  FOREIGN KEY (role_id) REFERENCES Roles(id)
);

CREATE TABLE Pacientes (
  id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  cedula varchar(10) NOT NULL,
  nombre varchar(255) NOT NULL.
  dob timestamp NOT NULL,
  historial varchar(255),
  seguro varchar(255),
);

CREATE TABLE Departamento (
  id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  nombre varchar(255) NOT NULL,
  descripcion varchar(255) NOT NULL
);

CREATE TABLE Personales (
  id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  posicion varchar(255) NOT NULL,
  usuario_id INT NOT NULL,
  departamento_id INT NOT NULL,
  FOREIGN KEY(usuario_id) REFERENCES Usuarios(id),
  FOREIGN KEY(departamento_id) REFERENCES Departamento(id)
);

CREATE TABLE EspecialidadesMedicas (
  id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  nombre varchar(255) NOT NULL,
  descripcion varchar(255) NOT NULL
);

CREATE TABLE MedicoEspecialidad (
  id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  especialidad_id INT NOT NULL,
  medico_id INT NOT NULL,
  FOREIGN KEY(especialidad_id) REFERENCES EspecialidadesMedicas(id),
  FOREIGN KEY(medico_id) REFERENCES Personales(id)
);

CREATE TABLE Citas (
  id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  tiempo timestamp NOT NULL,
  lugar varchar(255) NOT NULL,
  paciente_id INT NOT NULL,
  medico_id INT NOT NULL,
  servicio_id INT NOT NULL,
  FOREIGN KEY(paciente_id) REFERENCES Pacientes(id),
  FOREIGN KEY(medico_id) REFERENCES Personales(id),
  FOREIGN KEY(servicio_id) REFERENCES Servicios(id)
);

CREATE TABLE Productos (
  id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  tipo varchar(255) NOT NULL,
  nombre varchar(255) NOT NULL,
  cantidad INT NOT NULL,
  precio DECIMAL(10, 2)
);

CREATE TABLE Servicios (
  id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  nombre varchar(255) NOT NULL,
  precio DECIMAL(10, 2)
);

CREATE TABLE Facturas (
  id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  detalles json,
  total DECIMAL(10, 2),
  cajero_id INT,
  servicio_id INT,
  FOREIGN KEY(cajero_id) REFERENCES Personales(id),
  FOREIGN KEY(servicio_id) REFERENCES Servicios(id)
);


INSERT INTO `roles` (`nombre`, `descripcion`) VALUES 
('USUARIO', 'es un usuario'),
('ADMIN', 'es un administrador');
