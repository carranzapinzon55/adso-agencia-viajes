<?php

declare(strict_types=1);

$escapar = static fn (mixed $valor): string => htmlspecialchars(
    (string) $valor,
    ENT_QUOTES | ENT_SUBSTITUTE,
    'UTF-8'
);
$imagenesPaquetes = [
    'photo-1519046904884-53103b34b206',
    'photo-1530789253388-582c481c54b0',
    'photo-1464822759023-fed622ff2c3b',
    'photo-1519681393784-d120267933ba',
    'photo-1500530855697-b586d89ba3ee',
];
?>
<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Encuentra tu próximo destino y vive una experiencia inolvidable.">
    <title>Viaja con nosotros | Agencia de Viajes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <style>
        :root {
            --ocean: #123b4a;
            --teal: #0e9f9a;
            --coral: #ff8a65;
            --ink: #17323c;
            --muted: #6b7d83;
            --surface: #ffffff;
            --page: #f2f7f7;
            --shadow: 0 10px 30px rgba(13, 48, 59, .09);
        }

        body {
            color: var(--ink);
            background:
                radial-gradient(ellipse at 8% 12%, rgba(20, 184, 166, .09), transparent 28rem),
                radial-gradient(ellipse at 92% 38%, rgba(255, 138, 101, .08), transparent 25rem),
                var(--page);
        }

        .navbar {
            background: rgba(15, 42, 52, .97);
            backdrop-filter: blur(12px);
        }

        .navbar-brand-mark {
            display: inline-grid;
            width: 2.25rem;
            height: 2.25rem;
            place-items: center;
            margin-right: .55rem;
            color: var(--ocean);
            background: #a8f0e2;
            border-radius: 12px;
        }

        .nav-link {
            color: rgba(255, 255, 255, .76);
            transition: color .3s ease;
        }

        .nav-link:hover,
        .nav-link.active {
            color: #fff;
        }

        .hero {
            position: relative;
            overflow: hidden;
            min-height: 490px;
            display: flex;
            align-items: center;
            color: #fff;
            background:
                linear-gradient(110deg, rgba(15, 32, 39, .92), rgba(32, 90, 99, .66) 58%, rgba(14, 159, 154, .34)),
                url('https://images.unsplash.com/photo-1501785888041-af3ef285b470?auto=format&fit=crop&w=2200&q=85') center 48% / cover;
        }

        .hero::after {
            position: absolute;
            right: -7rem;
            bottom: -17rem;
            width: 38rem;
            height: 38rem;
            content: "";
            border: 1px solid rgba(255, 255, 255, .15);
            border-radius: 50%;
            box-shadow: 0 0 0 48px rgba(255, 255, 255, .035), 0 0 0 96px rgba(255, 255, 255, .025);
        }

        .hero-content {
            position: relative;
            z-index: 1;
            max-width: 760px;
            padding-top: 5rem;
            padding-bottom: 5rem;
        }

        .eyebrow {
            color: #8ce3d6;
            font-size: .78rem;
            font-weight: 800;
            letter-spacing: .16em;
            text-transform: uppercase;
        }

        .hero h1 {
            max-width: 700px;
            font-size: clamp(2.6rem, 6vw, 5rem);
            font-weight: 800;
            letter-spacing: -.055em;
            line-height: 1.02;
        }

        .hero-copy {
            max-width: 570px;
            color: rgba(255, 255, 255, .84);
            font-size: clamp(1.05rem, 2vw, 1.2rem);
        }

        .btn-gradient {
            color: #fff;
            border: 0;
            background: linear-gradient(110deg, #0e9f9a, #17bba9 55%, #ff936e);
            box-shadow: 0 9px 22px rgba(14, 159, 154, .24);
            transition: transform .3s ease, box-shadow .3s ease, filter .3s ease;
        }

        .btn-gradient:hover,
        .btn-gradient:focus-visible {
            color: #fff;
            filter: brightness(1.06);
            box-shadow: 0 13px 28px rgba(14, 159, 154, .35);
            transform: translateY(-2px) scale(1.02);
        }

        .catalog-section {
            padding-top: 5rem;
            padding-bottom: 5.5rem;
        }

        .section-kicker {
            color: var(--teal);
            font-size: .76rem;
            font-weight: 800;
            letter-spacing: .14em;
            text-transform: uppercase;
        }

        .section-title {
            font-weight: 800;
            letter-spacing: -.04em;
        }

        .package-count {
            padding: .65rem 1rem;
            color: #28646b;
            background: #e0f5f1;
            border-radius: 999px;
            font-weight: 700;
        }

        .package-card {
            overflow: hidden;
            border: 1px solid rgba(24, 76, 86, .07);
            border-radius: 16px;
            background: var(--surface);
            box-shadow: var(--shadow);
            transition: transform .3s ease, box-shadow .3s ease;
        }

        .package-card:hover {
            box-shadow: 0 22px 45px rgba(13, 48, 59, .16);
            transform: translateY(-8px);
        }

        .package-image-wrap {
            position: relative;
            overflow: hidden;
            height: 245px;
            background: #dcebea;
        }

        .package-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform .6s ease;
        }

        .package-card:hover .package-image {
            transform: scale(1.06);
        }

        .image-label {
            position: absolute;
            top: 1rem;
            left: 1rem;
            padding: .45rem .75rem;
            color: var(--ocean);
            background: rgba(255, 255, 255, .92);
            border-radius: 999px;
            font-size: .8rem;
            font-weight: 700;
            backdrop-filter: blur(8px);
        }

        .package-card .card-body {
            padding: 1.4rem;
        }

        .info-chip {
            display: inline-flex;
            align-items: center;
            gap: .4rem;
            padding: .45rem .7rem;
            color: #42636a;
            background: #f0f7f6;
            border-radius: 999px;
            font-size: .83rem;
            font-weight: 600;
        }

        .info-chip i {
            color: var(--teal);
        }

        .price {
            color: var(--ocean);
            font-size: 1.35rem;
            font-weight: 800;
            letter-spacing: -.03em;
        }

        .price small {
            color: var(--muted);
            font-size: .78rem;
            font-weight: 500;
            letter-spacing: 0;
        }

        .site-footer {
            color: rgba(255, 255, 255, .72);
            background: #102e39;
        }

        @media (prefers-reduced-motion: reduce) {
            *,
            *::before,
            *::after {
                scroll-behavior: auto !important;
                transition-duration: .01ms !important;
            }
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark sticky-top">
        <div class="container py-2">
            <a class="navbar-brand fw-bold d-flex align-items-center" href="index.php">
                <span class="navbar-brand-mark"><i class="bi bi-compass-fill"></i></span>
                Agencia de Viajes
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#menuPrincipal" aria-controls="menuPrincipal" aria-expanded="false" aria-label="Abrir menú">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="menuPrincipal">
                <ul class="navbar-nav ms-auto align-items-lg-center gap-lg-2">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="index.php?c=paquete&a=index">
                            <i class="bi bi-suitcase-lg me-1"></i> Paquetes
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?c=paquete&a=reservas">
                            <i class="bi bi-journal-check me-1"></i> Reservas Realizadas
                        </a>
                    </li>
                    <?php if (isset($_SESSION['usuario'])): ?>
                        <li class="nav-item">
                            <span class="nav-link"><i class="bi bi-person-circle me-1"></i><?= $escapar($_SESSION['usuario']['nombre']) ?></span>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="index.php?c=paquete&a=logout"><i class="bi bi-box-arrow-right me-1"></i>Cerrar Sesión</a>
                        </li>
                    <?php else: ?>
                        <li class="nav-item">
                            <a class="nav-link" href="index.php?c=paquete&a=login"><i class="bi bi-box-arrow-in-right me-1"></i>Iniciar Sesión</a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>

    <header class="hero">
        <div class="container hero-content">
            <p class="eyebrow mb-3"><i class="bi bi-sun me-2"></i>El mundo te está esperando</p>
            <h1 class="mb-4">Colecciona lugares, no cosas.</h1>
            <p class="hero-copy mb-4">Descubre destinos que inspiran, experiencias que conectan y viajes hechos para recordar toda la vida.</p>
            <a class="btn btn-gradient btn-lg rounded-pill px-4" href="#paquetes">
                Explorar destinos <i class="bi bi-arrow-down-right ms-2"></i>
            </a>
        </div>
    </header>

    <main>
        <section class="catalog-section" id="paquetes">
            <div class="container">
                <div class="d-flex flex-column flex-sm-row justify-content-between align-items-sm-end gap-3 mb-4 mb-lg-5">
                    <div>
                        <p class="section-kicker mb-2">Escapadas seleccionadas</p>
                        <h2 class="section-title display-6 mb-0">Tu próxima historia comienza aquí</h2>
                    </div>
                    <span class="package-count"><i class="bi bi-globe-americas me-2"></i><?= count($paquetes) ?> paquetes</span>
                </div>

                <?php if ($paquetes === []): ?>
                    <div class="alert border-0 shadow-sm rounded-4 p-4" role="status" style="background: #e6f7f4; color: #28646b;">
                        <i class="bi bi-info-circle-fill me-2"></i>
                        Por el momento no hay paquetes disponibles. Vuelve pronto para descubrir nuevos destinos.
                    </div>
                <?php else: ?>
                    <div class="row g-4">
                        <?php foreach ($paquetes as $paquete): ?>
                            <?php
                            $indiceImagen = ((int) $paquete['id'] - 1) % count($imagenesPaquetes);
                            $imagen = $imagenesPaquetes[$indiceImagen];
                            ?>
                            <div class="col-12 col-md-6 col-lg-4">
                                <article class="card package-card h-100">
                                    <div class="package-image-wrap">
                                        <img
                                            src="https://images.unsplash.com/<?= $escapar($imagen) ?>?auto=format&amp;fit=crop&amp;w=1000&amp;q=82"
                                            class="package-image"
                                            alt="Paisaje de <?= $escapar($paquete['nombre_destino']) ?>"
                                            loading="lazy"
                                        >
                                        <span class="image-label"><i class="bi bi-stars me-1"></i>Experiencia destacada</span>
                                    </div>
                                    <div class="card-body d-flex flex-column">
                                        <div class="d-flex flex-wrap gap-2 mb-3">
                                            <span class="info-chip"><i class="bi bi-geo-alt-fill"></i><?= $escapar($paquete['nombre_destino']) ?><?= !empty($paquete['pais']) ? ', ' . $escapar($paquete['pais']) : '' ?></span>
                                            <span class="info-chip"><i class="bi bi-clock-fill"></i><?= (int) $paquete['duracion_dias'] ?> <?= (int) $paquete['duracion_dias'] === 1 ? 'día' : 'días' ?></span>
                                        </div>
                                        <h3 class="h4 fw-bold mb-3"><?= $escapar($paquete['titulo']) ?></h3>
                                        <div class="d-flex justify-content-between align-items-end gap-2 mt-auto pt-3">
                                            <p class="price mb-0">
                                                $<?= number_format((float) $paquete['precio_base'], 0, ',', '.') ?>
                                                <small class="d-block">COP / persona</small>
                                            </p>
                                            <a
                                                class="btn btn-gradient rounded-pill px-3"
                                                href="index.php?c=paquete&amp;a=detalle&amp;id=<?= (int) $paquete['id'] ?>"
                                                aria-label="Ver paquete <?= $escapar($paquete['titulo']) ?>"
                                            >Descubrir <i class="bi bi-arrow-up-right ms-1"></i></a>
                                        </div>
                                    </div>
                                </article>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>
        </section>
    </main>

    <footer class="site-footer py-4">
        <div class="container d-flex flex-column flex-sm-row justify-content-between align-items-center gap-2">
            <a class="navbar-brand fw-bold text-white mb-0" href="index.php"><i class="bi bi-compass-fill me-2" style="color: #8ce3d6;"></i>Agencia de Viajes</a>
            <small>&copy; <?= date('Y') ?> Todos los derechos reservados. Hecho para viajeros.</small>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
