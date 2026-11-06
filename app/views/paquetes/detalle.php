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
    <title><?= $paquete !== null ? $escapar($paquete['titulo']) . ' | ' : '' ?>Agencia de Viajes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold" href="index.php">Agencia de Viajes</a>
            <a class="btn btn-outline-light btn-sm" href="index.php?c=paquete&a=index">Ver paquetes</a>
        </div>
    </nav>

    <main class="container py-5">
        <?php if ($paquete === null): ?>
            <div class="alert alert-warning" role="alert">
                No encontramos el paquete solicitado.
            </div>
            <a class="btn btn-primary" href="index.php?c=paquete&a=index">Volver a los paquetes</a>
        <?php else: ?>
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="card border-0 shadow-sm overflow-hidden">
                        <img
                            src="https://placehold.co/1200x500/0d6efd/ffffff?text=<?= rawurlencode((string) $paquete['nombre_destino']) ?>"
                            class="card-img-top"
                            alt="Imagen de <?= $escapar($paquete['nombre_destino']) ?>"
                            style="max-height: 360px; object-fit: cover;"
                        >
                        <div class="card-body p-4 p-md-5">
                            <p class="text-primary text-uppercase fw-semibold mb-2">
                                <?= $escapar($paquete['nombre_destino']) ?><?= !empty($paquete['pais']) ? ', ' . $escapar($paquete['pais']) : '' ?>
                            </p>
                            <h1 class="display-6 fw-bold mb-3"><?= $escapar($paquete['titulo']) ?></h1>
                            <p class="text-secondary">
                                Duración: <?= $escapar($paquete['duracion_dias']) ?>
                                <?= (int) $paquete['duracion_dias'] === 1 ? 'día' : 'días' ?>
                            </p>

                            <?php if (!empty($paquete['incluye'])): ?>
                                <section class="mb-4">
                                    <h2 class="h5">Detalles del paquete</h2>
                                    <p class="mb-0"><?= nl2br($escapar($paquete['incluye'])) ?></p>
                                </section>
                            <?php endif; ?>

                            <div class="bg-light rounded p-3 mb-4">
                                <span class="text-secondary d-block">Precio base por persona</span>
                                <span class="h3 fw-bold text-primary">
                                    $<?= number_format((float) $paquete['precio_base'], 0, ',', '.') ?> COP
                                </span>
                            </div>

                            <form method="post">
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label for="fecha_viaje" class="form-label">Fecha del viaje</label>
                                        <input
                                            type="date"
                                            class="form-control"
                                            id="fecha_viaje"
                                            name="fecha_viaje"
                                            min="<?= date('Y-m-d') ?>"
                                            required
                                        >
                                    </div>
                                    <div class="col-md-6">
                                        <label for="cantidad_personas" class="form-label">Cantidad de personas</label>
                                        <input
                                            type="number"
                                            class="form-control"
                                            id="cantidad_personas"
                                            name="cantidad_personas"
                                            min="1"
                                            value="1"
                                            required
                                        >
                                    </div>
                                    <div class="col-12 d-flex flex-column flex-sm-row gap-2 mt-4">
                                        <button type="submit" class="btn btn-primary">Confirmar Reserva</button>
                                        <a class="btn btn-outline-secondary" href="index.php?c=paquete&a=index">Volver a paquetes</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
