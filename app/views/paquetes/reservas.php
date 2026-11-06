<?php

declare(strict_types=1);

$escapar = static fn (mixed $valor): string => htmlspecialchars(
    (string) $valor,
    ENT_QUOTES | ENT_SUBSTITUTE,
    'UTF-8'
);
?>
<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Consulta las reservas realizadas en Agencia de Viajes.">
    <title>Reservas Realizadas | Agencia de Viajes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold" href="index.php">Agencia de Viajes</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#menuPrincipal" aria-controls="menuPrincipal" aria-expanded="false" aria-label="Abrir menú">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="menuPrincipal">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?c=paquete&a=index">Paquetes</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="index.php?c=paquete&a=reservas">Reservas Realizadas</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <main class="container py-5">
        <div class="d-flex flex-column flex-sm-row justify-content-between align-items-sm-end gap-3 mb-4">
            <div>
                <p class="text-primary text-uppercase fw-semibold mb-1">Gestión de viajes</p>
                <h1 class="h2 mb-0">Reservas Realizadas</h1>
            </div>
            <a class="btn btn-primary" href="index.php?c=paquete&a=index">Volver al catálogo</a>
        </div>

        <div class="card border-0 shadow-sm">
            <div class="card-body p-0">
                <?php if ($reservas === []): ?>
                    <div class="alert alert-info m-3 mb-0" role="status">
                        Aún no hay reservas registradas.
                    </div>
                <?php else: ?>
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="table-primary">
                                <tr>
                                    <th scope="col"># Reserva</th>
                                    <th scope="col">Cliente</th>
                                    <th scope="col">Paquete</th>
                                    <th scope="col">Fecha Viaje</th>
                                    <th scope="col">Personas</th>
                                    <th scope="col">Total</th>
                                    <th scope="col">Estado</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($reservas as $reserva): ?>
                                    <?php
                                    $claseEstado = match ($reserva['estado']) {
                                        'Pendiente' => 'text-bg-warning',
                                        'Confirmada' => 'text-bg-success',
                                        default => 'text-bg-secondary',
                                    };
                                    ?>
                                    <tr>
                                        <th scope="row"><?= (int) $reserva['id_reserva'] ?></th>
                                        <td><?= $escapar($reserva['nombre_cliente']) ?></td>
                                        <td><?= $escapar($reserva['titulo_paquete']) ?></td>
                                        <td><?= $escapar($reserva['fecha_viaje']) ?></td>
                                        <td><?= (int) $reserva['cantidad_personas'] ?></td>
                                        <td>$<?= number_format((float) $reserva['total'], 0, ',', '.') ?> COP</td>
                                        <td>
                                            <span class="badge <?= $claseEstado ?>"><?= $escapar($reserva['estado']) ?></span>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
