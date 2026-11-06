<?php

declare(strict_types=1);

require_once __DIR__ . '/../config/Database.php';

class Paquete
{
    private PDO $conexion;

    public function __construct()
    {
        $this->conexion = Database::connect();
    }

    public function getAll(): array
    {
        $consulta = '
            SELECT
                p.id,
                p.titulo,
                p.destino_id,
                p.duracion_dias,
                p.incluye,
                d.nombre_destino,
                d.pais,
                d.precio_base
            FROM paquete AS p
            INNER JOIN destino AS d ON d.id = p.destino_id
            ORDER BY p.id DESC
        ';

        $sentencia = $this->conexion->query($consulta);

        return $sentencia->fetchAll();
    }

    public function getById(int $id): ?array
    {
        $consulta = '
            SELECT
                p.id,
                p.titulo,
                p.destino_id,
                p.duracion_dias,
                p.incluye,
                d.nombre_destino,
                d.pais,
                d.precio_base
            FROM paquete AS p
            INNER JOIN destino AS d ON d.id = p.destino_id
            WHERE p.id = :id
            LIMIT 1
        ';

        $sentencia = $this->conexion->prepare($consulta);
        $sentencia->bindValue(':id', $id, PDO::PARAM_INT);
        $sentencia->execute();

        $paquete = $sentencia->fetch();

        return $paquete === false ? null : $paquete;
    }

    public function crearReserva(
        int $paqueteId,
        string $fechaViaje,
        int $cantidadPersonas,
        int $usuarioId = 1
    ): bool {
        $consulta = '
            INSERT INTO reserva (
                usuario_id,
                paquete_id,
                fecha_viaje,
                cantidad_personas,
                total
            )
            SELECT
                :usuario_id,
                p.id,
                :fecha_viaje,
                :cantidad_personas,
                d.precio_base * :cantidad_personas_total
            FROM paquete AS p
            INNER JOIN destino AS d ON d.id = p.destino_id
            WHERE p.id = :paquete_id
        ';

        $sentencia = $this->conexion->prepare($consulta);
        $sentencia->bindValue(':usuario_id', $usuarioId, PDO::PARAM_INT);
        $sentencia->bindValue(':fecha_viaje', $fechaViaje);
        $sentencia->bindValue(':cantidad_personas', $cantidadPersonas, PDO::PARAM_INT);
        $sentencia->bindValue(':cantidad_personas_total', $cantidadPersonas, PDO::PARAM_INT);
        $sentencia->bindValue(':paquete_id', $paqueteId, PDO::PARAM_INT);
        $sentencia->execute();

        return $sentencia->rowCount() === 1;
    }
}
