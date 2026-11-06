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

    public function getReservas(): array
    {
        $consulta = '
            SELECT
                r.id AS id_reserva,
                u.nombre AS nombre_cliente,
                p.titulo AS titulo_paquete,
                r.fecha_viaje,
                r.cantidad_personas,
                r.total,
                r.estado
            FROM reserva AS r
            INNER JOIN usuario AS u ON u.id = r.usuario_id
            INNER JOIN paquete AS p ON p.id = r.paquete_id
            ORDER BY r.fecha_viaje DESC
        ';

        $sentencia = $this->conexion->query($consulta);

        return $sentencia->fetchAll();
    }

    public function crearReserva(
        int $paqueteId,
        string $fechaViaje,
        int $cantidadPersonas,
        int $usuarioId = 1
    ): bool {
        $this->conexion->beginTransaction();

        try {
            $verificarUsuario = $this->conexion->prepare(
                'SELECT id FROM usuario WHERE id = :usuario_id LIMIT 1'
            );
            $verificarUsuario->bindValue(':usuario_id', $usuarioId, PDO::PARAM_INT);
            $verificarUsuario->execute();

            if ($verificarUsuario->fetchColumn() === false) {
                $crearUsuario = $this->conexion->prepare(
                    'INSERT INTO usuario (id, nombre, correo, password, rol)
                     VALUES (:id, :nombre, :correo, :password, :rol)'
                );
                $crearUsuario->bindValue(':id', $usuarioId, PDO::PARAM_INT);
                $crearUsuario->bindValue(':nombre', 'Cliente de reservas');
                $crearUsuario->bindValue(
                    ':correo',
                    'cliente-reservas-' . bin2hex(random_bytes(8)) . '@agencia-viajes.local'
                );
                $crearUsuario->bindValue(
                    ':password',
                    password_hash(bin2hex(random_bytes(32)), PASSWORD_DEFAULT)
                );
                $crearUsuario->bindValue(':rol', 'Cliente');
                $crearUsuario->execute();
            }

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

            $reservaCreada = $sentencia->rowCount() === 1;
            if (!$reservaCreada) {
                $this->conexion->rollBack();
                return false;
            }

            $this->conexion->commit();

            return true;
        } catch (Throwable $error) {
            if ($this->conexion->inTransaction()) {
                $this->conexion->rollBack();
            }

            throw $error;
        }
    }
}
