CREATE DATABASE IF NOT EXISTS agencia_viajes_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE agencia_viajes_db;

CREATE TABLE usuario (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    correo VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    rol ENUM('Administrador', 'Cliente') DEFAULT 'Cliente',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE destino (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre_destino VARCHAR(100) NOT NULL,
    pais VARCHAR(50) NOT NULL,
    descripcion TEXT,
    precio_base DECIMAL(10,2) NOT NULL
);

CREATE TABLE paquete (
    id INT AUTO_INCREMENT PRIMARY KEY,
    titulo VARCHAR(100) NOT NULL,
    destino_id INT NOT NULL,
    duracion_dias INT NOT NULL,
    incluye TEXT,
    FOREIGN KEY (destino_id) REFERENCES destino(id) ON DELETE CASCADE
);

CREATE TABLE reserva (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario_id INT NOT NULL,
    paquete_id INT NOT NULL,
    fecha_viaje DATE NOT NULL,
    cantidad_personas INT NOT NULL,
    total DECIMAL(10,2) NOT NULL,
    estado ENUM('Pendiente', 'Confirmada', 'Cancelada') DEFAULT 'Pendiente',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (usuario_id) REFERENCES usuario(id) ON DELETE CASCADE,
    FOREIGN KEY (paquete_id) REFERENCES paquete(id) ON DELETE CASCADE
);

CREATE TABLE pago (
    id INT AUTO_INCREMENT PRIMARY KEY,
    reserva_id INT NOT NULL,
    monto DECIMAL(10,2) NOT NULL,
    metodo_pago VARCHAR(50) NOT NULL,
    fecha_pago TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (reserva_id) REFERENCES reserva(id) ON DELETE CASCADE
);
