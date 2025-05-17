CREATE DATABASE IF NOT EXIST biblioteca;

USE biblioteca;

CREATE TABLE usuarios(
    codigo INT PRIMARY KEY NOT NULL,
    usuario VARCHAR(60) NOT NULL,
    pass VARCHAR(10)NOT NULL,
    tipoUsuario ENUM('admin', 'alumno')NOT NULL        
);

CREATE TABLE libros(
    isb VARCHAR(20)PRIMARY KEY NOT NULL,
    nombre VARCHAR(120)NOT NULL,
    autor VARCHAR(120)NOT NULL,
    editorial VARCHAR(120)NOT NULL,
    año VARCHAR(10) NOT NULL,
    edicion VARCHAR(40)NOT NULL,
    cantidad INT(4)NOT NULL,
    foto VARCHAR(255)NOT NULL
);

CREATE TABLE prestamoAct(
    id_prestamo INT AUTO_INCREMENT PRIMARY KEY,
    codigo INT,
    libro VARCHAR(120)NOT NULL,
    usuario VARCHAR(120) NOT NULL,
    fecha_inicio DATE,
    fecha_termino DATE,
    isb VARCHAR(20),
    FOREIGN KEY (codigo) REFERENCES usuarios(codigo),
    FOREIGN KEY (isb) REFERENCES libros(isb)
);

CREATE TABLE prestamoHist(
    id_historial INT AUTO_INCREMENT PRIMARY KEY,
    codigo INT,
    libro VARCHAR(120)NOT NULL,
    usuario VARCHAR(120) NOT NULL,
    fechaI DATE,
    FechaF DATE,
    isb VARCHAR(20),
    FOREIGN KEY (codigo) REFERENCES usuarios(codigo),
    FOREIGN KEY (isb) REFERENCES libros(isb)
);