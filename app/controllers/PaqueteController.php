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
        $mensajeReservas = $_SESSION['mensaje_reservas'] ?? null;
        unset($_SESSION['mensaje_reservas']);
        require __DIR__ . '/../views/paquetes/reservas.php';
    }

    public function cancelar(): void
    {
        $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

        if ($id === false || $id === null || $id < 1) {
            $_SESSION['mensaje_reservas'] = ['tipo' => 'warning', 'texto' => 'El identificador de la reserva no es válido.'];
        } else {
            $cancelada = $this->modelo->cancelarReserva($id);
            $_SESSION['mensaje_reservas'] = $cancelada
                ? ['tipo' => 'success', 'texto' => 'La reserva fue cancelada.']
                : ['tipo' => 'warning', 'texto' => 'No se encontró la reserva o ya estaba cancelada.'];
        }

        header('Location: index.php?c=paquete&a=reservas', true, 303);
        exit;
    }

    public function eliminar(): void
    {
        $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

        if ($id === false || $id === null || $id < 1) {
            $_SESSION['mensaje_reservas'] = ['tipo' => 'warning', 'texto' => 'El identificador de la reserva no es válido.'];
        } else {
            $eliminada = $this->modelo->eliminarReserva($id);
            $_SESSION['mensaje_reservas'] = $eliminada
                ? ['tipo' => 'success', 'texto' => 'La reserva fue eliminada.']
                : ['tipo' => 'warning', 'texto' => 'No se encontró la reserva para eliminar.'];
        }

        header('Location: index.php?c=paquete&a=reservas', true, 303);
        exit;
    }

    public function login(): void
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $errorLogin = $_SESSION['error_login'] ?? null;
            unset($_SESSION['error_login']);
            $mensajeLogin = ($_GET['mensaje'] ?? '') === 'debes_iniciar_sesion'
                ? 'Debes iniciar sesión para completar tu reserva.'
                : null;
            require __DIR__ . '/../views/paquetes/login.php';
            return;
        }

        $correo = filter_var(trim((string) ($_POST['correo'] ?? '')), FILTER_VALIDATE_EMAIL);
        $password = $_POST['password'] ?? null;

        if ($correo === false || !is_string($password) || $password === '') {
            $_SESSION['error_login'] = 'Ingresa un correo y una contraseña válidos.';
            header('Location: index.php?c=paquete&a=login', true, 303);
            exit;
        }

        $usuario = $this->modelo->autenticarUsuario($correo, $password);
        if ($usuario === null) {
            $_SESSION['error_login'] = 'El correo o la contraseña no son correctos.';
            header('Location: index.php?c=paquete&a=login', true, 303);
            exit;
        }

        session_regenerate_id(true);
        $_SESSION['usuario'] = $usuario;
        $destino = $_SESSION['despues_de_login'] ?? 'index.php?c=paquete&a=index';
        unset($_SESSION['despues_de_login']);
        header('Location: ' . $destino, true, 303);
        exit;
    }

    public function logout(): void
    {
        $_SESSION = [];

        if (ini_get('session.use_cookies')) {
            $parametrosCookie = session_get_cookie_params();
            setcookie(
                session_name(),
                '',
                time() - 42000,
                $parametrosCookie['path'],
                $parametrosCookie['domain'],
                $parametrosCookie['secure'],
                $parametrosCookie['httponly']
            );
        }

        session_destroy();
        header('Location: index.php?c=paquete&a=login', true, 303);
        exit;
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
            if (!isset($_SESSION['usuario']) || empty($_SESSION['usuario']['id'])) {
                $_SESSION['despues_de_login'] = 'index.php?c=paquete&a=detalle&id=' . $id;
                header(
                    'Location: index.php?c=paquete&a=login&mensaje=debes_iniciar_sesion',
                    true,
                    303
                );
                exit;
            }

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

            $usuarioId = (int) $_SESSION['usuario']['id'];

            if (!$this->modelo->crearReserva($id, $fechaViaje, $cantidadPersonas, $usuarioId)) {
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
