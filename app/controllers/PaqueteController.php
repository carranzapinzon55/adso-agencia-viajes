<?php

declare(strict_types=1);

require_once __DIR__ . '/../models/Paquete.php';

class PaqueteController
{
    private Paquete $modelo;

    public function __construct()
    {
        $this->modelo = new Paquete();
    }

    public function index(): void
    {
        $paquetes = $this->modelo->getAll();
        require __DIR__ . '/../views/paquetes/index.php';
    }

    public function reservas(): void
    {
        $reservas = $this->modelo->getReservas();
        require __DIR__ . '/../views/paquetes/reservas.php';
    }

    public function detalle(): void
    {
        if (session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
        }

        $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
        $paquete = $id !== false && $id !== null && $id > 0
            ? $this->modelo->getById($id)
            : null;

        if ($paquete === null || $id === false || $id === null || $id <= 0) {
            http_response_code(404);
            require __DIR__ . '/../views/paquetes/detalle.php';
            return;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $fechaViaje = $_POST['fecha_viaje'] ?? null;
            $cantidadPersonas = filter_input(INPUT_POST, 'cantidad_personas', FILTER_VALIDATE_INT);
            $fechaValida = is_string($fechaViaje)
                ? \DateTimeImmutable::createFromFormat('!Y-m-d', $fechaViaje)
                : false;

            if (
                $fechaValida === false
                || $fechaValida->format('Y-m-d') !== $fechaViaje
                || $fechaValida < new \DateTimeImmutable('today')
                || $cantidadPersonas === false
                || $cantidadPersonas === null
                || $cantidadPersonas < 1
            ) {
                http_response_code(400);
                exit('La fecha del viaje o la cantidad de personas no son válidas.');
            }

            if (!$this->modelo->crearReserva($id, $fechaViaje, $cantidadPersonas, 1)) {
                http_response_code(404);
                exit('No se pudo crear la reserva para el paquete solicitado.');
            }

            $_SESSION['reserva_exitosa'] = true;
            header('Location: index.php?c=paquete&a=detalle&id=' . $id, true, 303);
            exit;
        }

        $reservaExitosa = $_SESSION['reserva_exitosa'] ?? false;
        unset($_SESSION['reserva_exitosa']);

        require __DIR__ . '/../views/paquetes/detalle.php';

        if ($reservaExitosa) {
            echo '<script>alert("¡Reserva realizada con éxito!");</script>';
        }
    }
}
