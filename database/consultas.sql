USE agencia_viajes_db;

-- 1. INSERT: Registrar nuevo usuario
INSERT INTO usuario (nombre, correo, password, rol) 
VALUES ('Carlos Viajero', 'carlos@viajes.com', '123456', 'Cliente');

-- 2. SELECT con filtro y orden
SELECT * FROM destino 
WHERE pais = 'Colombia' 
ORDER BY precio_base ASC;

-- 3. UPDATE: Actualizar precio base
SELECT * FROM destino;

-- 4. DELETE: Eliminar reserva cancelada
DELETE FROM reserva WHERE id = 5 AND estado = 'Cancelada';

-- 5. JOIN: Reservas con cliente y paquete
SELECT r.id AS id_reserva, u.nombre AS cliente, p.titulo AS paquete, r.fecha_viaje, r.total, r.estado
SELECT r.id AS id_reserva, u.nombre AS cliente, p.titulo AS paquete, r.fecha_viaje, r.total, r.estado
FROM reserva r
JOIN usuario u ON u.id = r.usuario_id
JOIN paquete p ON p.id = r.paquete_id
ORDER BY r.fecha_viaje DESC;

-- 6. AGREGACIÓN (SUM / GROUP BY)
SELECT p.titulo AS paquete, SUM(r.total) AS ingresos_totales
FROM reserva r
JOIN paquete p ON p.id = r.paquete_id
GROUP BY p.id, p.titulo
ORDER BY ingresos_totales DESC;

-- 7. HAVING: Paquetes con más de 2 reservas
SELECT paquete_id, COUNT(*) AS total_reservas
FROM reserva
GROUP BY paquete_id
HAVING COUNT(*) > 2;
