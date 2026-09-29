-- Ejecutar este script en phpMyAdmin o MySQL Workbench
-- antes de usar la aplicación.

CREATE DATABASE IF NOT EXISTS tickets_db
    CHARACTER SET utf8mb4
    COLLATE utf8mb4_unicode_ci;

USE tickets_db;

CREATE TABLE IF NOT EXISTS ticket (
    id          INT AUTO_INCREMENT PRIMARY KEY,
    titulo      VARCHAR(255) NOT NULL,
    descripcion TEXT         NOT NULL,
    estado      VARCHAR(50)  NOT NULL DEFAULT 'pendiente',
    creado_en   TIMESTAMP    DEFAULT CURRENT_TIMESTAMP
);

-- Datos de prueba
INSERT INTO ticket (titulo, descripcion) VALUES
    ('Error en login',     'El botón de ingresar no responde en Firefox'),
    ('Actualizar manual',  'El manual de usuario está desactualizado');
