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
  nombre varchar(255) NOT NULL,
  dob timestamp NOT NULL,
  seguro varchar(255)
);

CREATE TABLE HistorialMedico (
  id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  registro TEXT NOT NULL
);

CREATE TABLE HistorialPaciente (
  id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  paciente_id INT NOT NULL,
  historial_id INT NOT NULL,
  FOREIGN KEY(paciente_id) REFERENCES Pacientes(id),
  FOREIGN KEY(historial_id) REFERENCES HistorialMedico(id)
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

CREATE TABLE HorarioMedico (
  id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  usuario_id INT NOT NULL,
  dia_semana ENUM('Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado', 'Domingo') NOT NULL,
  hora_inicio TIME NOT NULL,
  hora_fin TIME NOT NULL,
  max_citas INT NOT NULL, 
  FOREIGN KEY (usuario_id) REFERENCES Personales(id)
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

CREATE TABLE Servicios (
  id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  nombre varchar(255) NOT NULL,
  precio DECIMAL(10, 2)
);

CREATE TABLE Citas (
  id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  tiempo timestamp NOT NULL,
  lugar varchar(255) NOT NULL,
  paciente_id INT NOT NULL,
  medico_id INT NOT NULL,
  diagnostico TEXT,
  estado BOOLEAN DEFAULT TRUE,
  pagado BOOLEAN DEFAULT FALSE,
  FOREIGN KEY(paciente_id) REFERENCES Pacientes(id),
  FOREIGN KEY(medico_id) REFERENCES Personales(id)
);

CREATE TABLE Citas_Servicios (
  id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  cita_id INT NOT NULL,
  servicio_id INT NOT NULL,
  FOREIGN KEY (cita_id) REFERENCES Citas(id),
  FOREIGN KEY (servicio_id) REFERENCES Servicios(id)
);

CREATE TABLE Facturas (
  id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  detalles json,
  total DECIMAL(10, 2),
  cajero_id INT NOT NULL,
  cliente_id INT NOT NULL,
  fecha DATETIME DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY(cajero_id) REFERENCES Personales(id),
  FOREIGN KEY(cliente_id) REFERENCES Pacientes(id)
);

CREATE TABLE Recetas (
  id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  cita_id INT,
  descripcion TEXT,
  FOREIGN KEY(cita_id) REFERENCES Citas(id)
);

CREATE TABLE Medicamentos (
  id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  tipo varchar(255) NOT NULL,
  nombre varchar(255) NOT NULL,
  cantidad INT NOT NULL,
  precio DECIMAL(10, 2)
);

CREATE TABLE MedicamentosReceetas (
  id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  receta_id INT,
  medicamento_id INT,
  cantidad INT,
  FOREIGN KEY(receta_id) REFERENCES Recetas(id),
  FOREIGN KEY(medicamento_id) REFERENCES Medicamentos(id)
);


INSERT INTO `roles` (`nombre`, `descripcion`) VALUES 
('USUARIO', 'es un usuario'),
('ADMIN', 'es un administrador');

INSERT INTO especialidadesmedicas (nombre, descripcion) VALUES
('Cardiología', 'Especialidad que se enfoca en el diagnóstico y tratamiento de enfermedades del corazón y del sistema cardiovascular.'),
('Neurología', 'Especialidad médica que trata trastornos del sistema nervioso central y periférico.'),
('Dermatología', 'Especialidad dedicada al diagnóstico y tratamiento de enfermedades de la piel, cabello, y uñas.'),
('Pediatría', 'Especialidad enfocada en la atención médica de bebés, niños y adolescentes.'),
('Ginecología', 'Especialidad médica que se ocupa de la salud del sistema reproductor femenino.'),
('Psiquiatría', 'Especialidad médica que se centra en el diagnóstico, tratamiento y prevención de enfermedades mentales.'),
('Oftalmología', 'Especialidad médica que trata las enfermedades y trastornos de los ojos.'),
('Endocrinología', 'Especialidad dedicada a las glándulas hormonales y los trastornos hormonales.'),
('Gastroenterología', 'Especialidad enfocada en el sistema digestivo y sus enfermedades.'),
('Neumología', 'Especialidad que se enfoca en las enfermedades del sistema respiratorio.'),
('Reumatología', 'Especialidad dedicada al diagnóstico y tratamiento de enfermedades musculoesqueléticas y autoinmunes.'),
('Nefrología', 'Especialidad médica que trata las enfermedades de los riñones.'),
('Oncología', 'Especialidad que se dedica al estudio, diagnóstico y tratamiento del cáncer.'),
('Medicina Interna', 'Especialidad que abarca el diagnóstico y tratamiento de enfermedades complejas en adultos.'),
('Otorrinolaringología', 'Especialidad dedicada al tratamiento de enfermedades de oído, nariz y garganta (ORL).');

INSERT INTO departamento (nombre, descripcion) VALUES
('Ventas', 'Departamento de ventas'),
('Urgencias', 'Atención inmediata para emergencias y casos críticos.'),
('Medicina Interna', 'Tratamiento y manejo de enfermedades generales en adultos.'),
('Pediatría', 'Cuidado y tratamiento de enfermedades en niños y adolescentes.'),
('Ginecología y Obstetricia', 'Salud reproductiva, control prenatal y atención en maternidad.'),
('Cardiología', 'Diagnóstico y tratamiento de enfermedades del corazón y sistema circulatorio.'),
('Neurología', 'Cuidado y tratamiento de enfermedades del sistema nervioso y cerebro.'),
('Oncología', 'Diagnóstico y tratamiento especializado para el cáncer.'),
('Psiquiatría', 'Cuidado de la salud mental y tratamiento de trastornos psiquiátricos.'),
('Radiología', 'Exámenes de diagnóstico por imágenes como rayos X y tomografías.'),
('Laboratorio', 'Análisis clínicos de sangre, orina y otros fluidos.'),
('Rehabilitación', 'Terapias de recuperación física para pacientes post-tratamiento.'),
('Farmacia', 'Suministro y administración de medicamentos.'),
('Cuidados Intensivos (UCI)', 'Cuidado avanzado y monitoreo constante para pacientes en estado crítico.');

INSERT INTO Servicios (nombre, precio) VALUES
('Cita Médica', 50.00),
('Vacuna contra la gripe', 20.00),
('Examen de sangre', 30.00),
('Examen de orina', 15.00),
('Consulta odontológica', 40.00),
('Chequeo general', 60.00),
('Consulta dermatológica', 55.00),
('Vacuna contra el COVID-19', 25.00),
('Examen de rayos X', 70.00),
('Farmacia', 0.00);

INSERT INTO Medicamentos (tipo, nombre, cantidad, precio) VALUES
('Analgésico', 'Paracetamol', 50, 3.50),
('Antibiótico', 'Amoxicilina', 30, 7.25),
('Antiinflamatorio', 'Ibuprofeno', 20, 5.00),
('Antihistamínico', 'Loratadina', 15, 4.20),
('Antipirético', 'Aspirina', 40, 2.75);