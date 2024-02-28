/* creación de la base de datos */

DROP DATABASE IF EXISTS gdce;
CREATE DATABASE gdce;

USE gdce;



/* creación de las tablas */

-- tabla portátiles

CREATE OR REPLACE TABLE portatiles(
  id_portatil integer AUTO_INCREMENT,
  codigo varchar(4) NOT NULL,
  marca varchar(24),
  modelo varchar(24),
  estado varchar(24) NOT NULL,
  procesador varchar(24),
  memoria_ram integer(4),
  capacidad integer(8),
  dispositivo_almacenamiento varchar(24),
  id_almacen integer,
  PRIMARY KEY (id_portatil)
);


-- tabla aplicaciones

CREATE OR REPLACE TABLE aplicaciones(
  id_aplicacion integer AUTO_INCREMENT,
  aplicacion varchar(32) NOT NULL,
  id_portatil integer,
  PRIMARY KEY (id_aplicacion)
);


-- tabla cargadores

CREATE OR REPLACE TABLE cargadores(
  id_cargador integer AUTO_INCREMENT,
  codigo varchar(4) NOT NULL,
  potencia integer(4),
  estado varchar(24) NOT NULL,
  id_almacen integer,
  PRIMARY KEY (id_cargador)
);


-- tabla cargan

CREATE OR REPLACE TABLE cargan(
  id_carga integer AUTO_INCREMENT,
  id_portatil integer,
  id_cargador integer,
  PRIMARY KEY(id_carga)
);


-- tabla almacenes

CREATE OR REPLACE TABLE almacenes(
  id_almacen integer AUTO_INCREMENT,
  aula varchar(4) NOT NULL,
  capacidad integer(4),
  PRIMARY KEY (id_almacen)
);


-- tabla alumnos

CREATE OR REPLACE TABLE alumnos(
  id_alumno integer AUTO_INCREMENT,
  dni varchar(8) NOT NULL,
  nombre varchar(24) NOT NULL,
  apellidos varchar(48),
  estado_matricula varchar(16) NOT NULL,
  id_portatil integer,
  PRIMARY KEY (id_alumno)
);


-- tabla cursos

CREATE OR REPLACE TABLE cursos(
  id_curso integer AUTO_INCREMENT,
  nombre varchar(96) NOT NULL,
  nombre_corto varchar(8),
  curso varchar(16) NOT NULL,
  turno varchar(8) NOT NULL,
  aula varchar(4) NOT NULL,
  tutor varchar(24) NOT NULL,
  PRIMARY KEY (id_curso)
);


-- tabla cursan

CREATE OR REPLACE TABLE cursan(
  id_cursa integer AUTO_INCREMENT,
  curso_academico varchar(8) NOT NULL,
  id_alumno integer,
  id_curso integer,
  PRIMARY KEY (id_cursa)
);



/* creación de restricciones */

-- restricciones de portátiles

ALTER TABLE portatiles

  ADD CONSTRAINT uk_codigo
  UNIQUE KEY (codigo),

  ADD CONSTRAINT fk_portatiles_almacenes
  FOREIGN KEY (id_almacen)
  REFERENCES almacenes(id_almacen);


-- restricciones de aplicaciones

ALTER TABLE aplicaciones

  ADD CONSTRAINT uk_aplicacion_portatil
  UNIQUE KEY (aplicacion, id_portatil),

  ADD CONSTRAINT fk_aplicaciones_portatiles
  FOREIGN KEY (id_portatil)
  REFERENCES portatiles(id_portatil);


-- restricciones de cargadores

ALTER TABLE cargadores

  ADD CONSTRAINT uk_codigo
  UNIQUE KEY (codigo),

  ADD CONSTRAINT fk_cargadores_almacenes
  FOREIGN KEY (id_almacen)
  REFERENCES almacenes(id_almacen);


-- restricciones de cargadores

ALTER TABLE cargan

  ADD CONSTRAINT uk_portatil_cargador
  UNIQUE KEY (id_portatil, id_cargador),

  ADD CONSTRAINT fk_cargan_portatiles
  FOREIGN KEY (id_portatil)
  REFERENCES portatiles(id_portatil),

  ADD CONSTRAINT fk_cargan_cargadores
  FOREIGN KEY (id_cargador)
  REFERENCES cargadores(id_cargador);


-- restricciones de almacenes

ALTER TABLE almacenes

  ADD CONSTRAINT uk_aula
  UNIQUE KEY (aula);


-- restricciones de alumnos

ALTER TABLE alumnos

  ADD CONSTRAINT uk_dni
  UNIQUE KEY (dni),

  ADD CONSTRAINT fk_alumnos_portatiles
  FOREIGN KEY (id_portatil)
  REFERENCES portatiles(id_portatil);


-- restricciones de cursos

ALTER TABLE cursos

  ADD CONSTRAINT uk_nombre_curso
  UNIQUE KEY (nombre, curso);


-- restricciones de cursan

ALTER TABLE cursan

  ADD CONSTRAINT uk_alumno_curso
  UNIQUE KEY (id_alumno, id_curso),

  ADD CONSTRAINT fk_cursan_alumnos
  FOREIGN KEY (id_alumno)
  REFERENCES alumnos(id_alumno),

  ADD CONSTRAINT fk_cursan_cursos
  FOREIGN KEY (id_curso)
  REFERENCES cursos(id_curso);
