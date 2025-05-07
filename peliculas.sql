-- Crear la base de datos (solo una vez)
CREATE DATABASE IF NOT EXISTS peliculas_db CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE peliculas_db;

-- Tabla de categorías o géneros
CREATE TABLE categoria (
    id_categoria INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(50) NOT NULL UNIQUE
);

-- Tabla de idiomas
CREATE TABLE idioma (
    id_idioma INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(50) NOT NULL UNIQUE
);

-- Tabla de películas
CREATE TABLE pelicula (
    id_pelicula INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(255) NOT NULL,
    puntuacion DECIMAL(3,1), -- CHECK puede omitirse por compatibilidad
    fecha_estreno DATE,
    recaudacion DECIMAL(15,2),
    id_categoria INT,
    id_idioma INT,
    FOREIGN KEY (id_categoria) REFERENCES categoria(id_categoria),
    FOREIGN KEY (id_idioma) REFERENCES idioma(id_idioma)
);

-- Tabla de actores
CREATE TABLE actor (
    id_actor INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    apellido VARCHAR(100) NOT NULL
);

-- Tabla intermedia entre película y actor (muchos a muchos)
CREATE TABLE pelicula_actor (
    id_pelicula INT,
    id_actor INT,
    PRIMARY KEY (id_pelicula, id_actor),
    FOREIGN KEY (id_pelicula) REFERENCES pelicula(id_pelicula),
    FOREIGN KEY (id_actor) REFERENCES actor(id_actor)
);

-- Tabla de directores
CREATE TABLE director (
    id_director INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    apellido VARCHAR(100) NOT NULL
);

-- Tabla intermedia entre película y director (por si hay más de uno)
CREATE TABLE pelicula_director (
    id_pelicula INT,
    id_director INT,
    PRIMARY KEY (id_pelicula, id_director),
    FOREIGN KEY (id_pelicula) REFERENCES pelicula(id_pelicula),
    FOREIGN KEY (id_director) REFERENCES director(id_director)
);
