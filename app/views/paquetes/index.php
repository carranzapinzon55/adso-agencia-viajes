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
    <meta name="description" content="Encuentra tu próximo destino con Agencia de Viajes.">
    <title>Paquetes de viaje | Agencia de Viajes</title>
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
                        <a class="nav-link active" aria-current="page" href="index.php?c=paquete&a=index">Paquetes</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?c=paquete&a=reservas">Reservas Realizadas</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <header class="bg-primary text-white py-5">
        <div class="container py-4">
            <div class="row align-items-center">
                <div class="col-lg-8">
                    <p class="text-uppercase fw-semibold mb-2">Tu próxima aventura comienza aquí</p>
                    <h1 class="display-4 fw-bold">Viaja, descubre y disfruta</h1>
                    <p class="lead mb-0">Explora nuestros paquetes y encuentra el destino ideal para tu próximo viaje.</p>
                </div>
            </div>
        </div>
    </header>

    <main class="container py-5">
        <div class="d-flex flex-column flex-sm-row justify-content-between align-items-sm-end gap-2 mb-4">
            <div>
                <p class="text-primary text-uppercase fw-semibold mb-1">Experiencias para ti</p>
                <h2 class="h3 mb-0">Paquetes disponibles</h2>
            </div>
            <span class="text-secondary"><?= count($paquetes) ?> paquetes</span>
        </div>

        <?php if ($paquetes === []): ?>
            <div class="alert alert-info" role="status">
                Por el momento no hay paquetes disponibles. Vuelve pronto para descubrir nuevos destinos.
            </div>
        <?php else: ?>
            <div class="row g-4">
                <?php foreach ($paquetes as $paquete): ?>
                    <div class="col-12 col-md-6 col-lg-4">
                        <article class="card h-100 border-0 shadow-sm">
                            <img
                                src="https://placehold.co/800x500/0d6efd/ffffff?text=<?= rawurlencode((string) $paquete['nombre_destino']) ?>"
                                class="card-img-top"
                                alt="Imagen de <?= $escapar($paquete['nombre_destino']) ?>"
                                loading="lazy"
                                style="height: 220px; object-fit: cover;"
                            >
                            <div class="card-body d-flex flex-column p-4">
                                <p class="text-primary fw-semibold mb-2"><?= $escapar($paquete['nombre_destino']) ?><?= !empty($paquete['pais']) ? ', ' . $escapar($paquete['pais']) : '' ?></p>
                                <h3 class="h5 card-title"><?= $escapar($paquete['titulo']) ?></h3>
                                <p class="text-secondary mb-3">
                                    <span class="fw-semibold"><?= $escapar($paquete['duracion_dias']) ?></span>
                                    <?= (int) $paquete['duracion_dias'] === 1 ? 'día' : 'días' ?>
                                </p>
                                <p class="h5 fw-bold mb-4">
                                    $<?= number_format((float) $paquete['precio_base'], 0, ',', '.') ?>
                                    <span class="fs-6 fw-normal text-secondary">COP / persona</span>
                                </p>
                                <a
                                    class="btn btn-primary mt-auto"
                                    href="index.php?c=paquete&amp;a=detalle&amp;id=<?= (int) $paquete['id'] ?>"
                                >Ver paquete</a>
                            </div>
                        </article>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </main>

    <footer class="bg-white border-top py-4">
        <div class="container text-center text-secondary">
            <small>&copy; <?= date('Y') ?> Agencia de Viajes. Todos los derechos reservados.</small>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
