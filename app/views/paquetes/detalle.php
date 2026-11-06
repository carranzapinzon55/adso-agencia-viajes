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
$imagenDetalle = $paquete !== null
    ? $imagenesPaquetes[((int) $paquete['id'] - 1) % count($imagenesPaquetes)]
    : $imagenesPaquetes[0];
?>
<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $paquete !== null ? $escapar($paquete['titulo']) . ' | ' : '' ?>Agencia de Viajes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <style>
        :root {
            --ocean: #123b4a;
            --teal: #0e9f9a;
            --coral: #ff8a65;
            --ink: #17323c;
            --muted: #6b7d83;
            --page: #f2f7f7;
            --shadow: 0 10px 30px rgba(13, 48, 59, .09);
        }

        body {
            color: var(--ink);
            background:
                radial-gradient(ellipse at 8% 18%, rgba(20, 184, 166, .09), transparent 28rem),
                radial-gradient(ellipse at 92% 66%, rgba(255, 138, 101, .08), transparent 25rem),
                var(--page);
        }

        .navbar {
            background: rgba(15, 42, 52, .97);
            backdrop-filter: blur(12px);
        }

        .brand-mark {
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
            color: rgba(255, 255, 255, .78);
            transition: color .3s ease;
        }

        .nav-link:hover {
            color: #fff;
        }

        .detail-hero {
            position: relative;
            min-height: 420px;
            display: flex;
            align-items: end;
            overflow: hidden;
            color: #fff;
            background:
                linear-gradient(0deg, rgba(12, 35, 44, .9), rgba(12, 35, 44, .08) 80%),
                linear-gradient(110deg, rgba(15, 32, 39, .34), rgba(14, 159, 154, .18)),
                url('https://images.unsplash.com/<?= $escapar($imagenDetalle) ?>?auto=format&fit=crop&w=2200&q=85') center 48% / cover;
        }

        .hero-content {
            padding-top: 7rem;
            padding-bottom: 3.5rem;
        }

        .eyebrow {
            color: #a8f0e2;
            font-size: .78rem;
            font-weight: 800;
            letter-spacing: .15em;
            text-transform: uppercase;
        }

        .detail-title {
            max-width: 800px;
            font-size: clamp(2.4rem, 5vw, 4.5rem);
            font-weight: 800;
            letter-spacing: -.05em;
            line-height: 1.04;
        }

        .info-chip {
            display: inline-flex;
            align-items: center;
            gap: .45rem;
            padding: .55rem .85rem;
            color: #fff;
            background: rgba(255, 255, 255, .16);
            border: 1px solid rgba(255, 255, 255, .3);
            border-radius: 999px;
            backdrop-filter: blur(8px);
        }

        .detail-main {
            position: relative;
            margin-top: -1.5rem;
            padding-bottom: 5rem;
        }

        .surface-card {
            border: 1px solid rgba(24, 76, 86, .07);
            border-radius: 16px;
            background: #fff;
            box-shadow: var(--shadow);
        }

        .section-label {
            color: var(--teal);
            font-size: .76rem;
            font-weight: 800;
            letter-spacing: .13em;
            text-transform: uppercase;
        }

        .price-box {
            padding: 1.15rem 1.25rem;
            border: 1px solid rgba(14, 159, 154, .12);
            border-radius: 16px;
            background: linear-gradient(135deg, #e8faf6, #f7fbfa);
        }

        .price-value {
            color: var(--ocean);
            font-size: clamp(1.8rem, 4vw, 2.4rem);
            font-weight: 800;
            letter-spacing: -.045em;
        }

        .form-label {
            color: #35535b;
            font-weight: 700;
        }

        .form-control {
            min-height: 3.1rem;
            border-color: #dce8e7;
            border-radius: 12px;
        }

        .form-control:focus {
            border-color: var(--teal);
            box-shadow: 0 0 0 .22rem rgba(14, 159, 154, .13);
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
            transform: translateY(-2px) scale(1.015);
        }

        .btn-soft {
            color: #28646b;
            border: 1px solid #cce5e1;
            background: #eff8f6;
            transition: background .3s ease, transform .3s ease;
        }

        .btn-soft:hover {
            color: var(--ocean);
            background: #e0f3ef;
            transform: translateY(-2px);
        }

        .site-footer {
            color: rgba(255, 255, 255, .72);
            background: #102e39;
        }

        @media (prefers-reduced-motion: reduce) {
            *,
            *::before,
            *::after {
                transition-duration: .01ms !important;
            }
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark sticky-top">
        <div class="container py-2">
            <a class="navbar-brand fw-bold d-flex align-items-center" href="index.php">
                <span class="brand-mark"><i class="bi bi-compass-fill"></i></span>
                Agencia de Viajes
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#menuPrincipal" aria-controls="menuPrincipal" aria-expanded="false" aria-label="Abrir menú">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="menuPrincipal">
                <ul class="navbar-nav ms-auto align-items-lg-center gap-lg-2">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?c=paquete&a=index"><i class="bi bi-suitcase-lg me-1"></i>Paquetes</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?c=paquete&a=reservas"><i class="bi bi-journal-check me-1"></i>Reservas Realizadas</a>
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

    <?php if ($paquete === null): ?>
        <main class="container py-5">
            <div class="surface-card p-4 p-md-5 text-center">
                <span class="display-4 text-warning"><i class="bi bi-exclamation-circle"></i></span>
                <h1 class="h2 fw-bold mt-3">No encontramos este paquete</h1>
                <p class="text-secondary">Puede que ya no esté disponible. Explora el catálogo para encontrar otra aventura.</p>
                <a class="btn btn-gradient rounded-pill px-4" href="index.php?c=paquete&a=index">Volver al catálogo</a>
            </div>
        </main>
    <?php else: ?>
        <header class="detail-hero">
            <div class="container hero-content">
                <p class="eyebrow mb-3"><i class="bi bi-geo-alt-fill me-2"></i><?= $escapar($paquete['nombre_destino']) ?><?= !empty($paquete['pais']) ? ', ' . $escapar($paquete['pais']) : '' ?></p>
                <h1 class="detail-title mb-4"><?= $escapar($paquete['titulo']) ?></h1>
                <div class="d-flex flex-wrap gap-2">
                    <span class="info-chip"><i class="bi bi-clock-fill"></i><?= (int) $paquete['duracion_dias'] ?> <?= (int) $paquete['duracion_dias'] === 1 ? 'día' : 'días' ?></span>
                    <span class="info-chip"><i class="bi bi-stars"></i>Una experiencia para recordar</span>
                </div>
            </div>
        </header>

        <main class="container detail-main">
            <div class="row g-4 g-lg-5">
                <div class="col-lg-7">
                    <section class="surface-card p-4 p-md-5 h-100">
                        <p class="section-label mb-2">El viaje</p>
                        <h2 class="h3 fw-bold mb-3">Una escapada hecha para ti</h2>
                        <?php if (!empty($paquete['incluye'])): ?>
                            <div class="text-secondary lh-lg"><?= nl2br($escapar($paquete['incluye'])) ?></div>
                        <?php else: ?>
                            <p class="text-secondary lh-lg mb-0">Prepárate para descubrir <?= $escapar($paquete['nombre_destino']) ?> a tu propio ritmo y disfrutar cada momento de esta experiencia.</p>
                        <?php endif; ?>
                        <hr class="my-4" style="border-color: #e8efee;">
                        <div class="d-flex align-items-start gap-3">
                            <span class="d-inline-grid flex-shrink-0 rounded-circle" style="width: 3rem; height: 3rem; place-items: center; color: #0e8d88; background: #e5f7f3;">
                                <i class="bi bi-shield-check fs-5"></i>
                            </span>
                            <div>
                                <h3 class="h6 fw-bold mb-1">Reserva fácil y segura</h3>
                                <p class="small text-secondary mb-0">Elige tu fecha y cuántas personas viajarán. El total se calcula según el precio base por persona.</p>
                            </div>
                        </div>
                    </section>
                </div>

                <div class="col-lg-5">
                    <section class="surface-card p-4 p-md-5">
                        <p class="section-label mb-2">Planifica tu salida</p>
                        <h2 class="h3 fw-bold mb-4">Reserva tu aventura</h2>
                        <div class="price-box mb-4">
                            <span class="d-block text-secondary small mb-1">Precio base por persona</span>
                            <span class="price-value">$<?= number_format((float) $paquete['precio_base'], 0, ',', '.') ?></span>
                            <span class="fw-semibold text-secondary"> COP</span>
                        </div>

                        <?php if (isset($_SESSION['usuario']) && !empty($_SESSION['usuario']['id'])): ?>
                            <div class="mb-3">
                                <span class="badge rounded-pill px-3 py-2" style="color: #176b71; background: #e5f7f3;">
                                    <i class="bi bi-person-circle me-1"></i>
                                    Reservando como <?= $escapar($_SESSION['usuario']['nombre']) ?>
                                </span>
                            </div>
                            <form method="post" action="index.php?c=paquete&amp;a=detalle&amp;id=<?= (int) $paquete['id'] ?>">
                                <div class="mb-3">
                                    <label for="fecha_viaje" class="form-label"><i class="bi bi-calendar-event me-2 text-success"></i>Fecha del viaje</label>
                                    <input
                                        type="date"
                                        class="form-control"
                                        id="fecha_viaje"
                                        name="fecha_viaje"
                                        min="<?= date('Y-m-d') ?>"
                                        required
                                    >
                                </div>
                                <div class="mb-4">
                                    <label for="cantidad_personas" class="form-label"><i class="bi bi-people me-2 text-success"></i>Cantidad de personas</label>
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
                                <button type="submit" class="btn btn-gradient btn-lg rounded-pill w-100">
                                    Confirmar Reserva <i class="bi bi-arrow-right-circle ms-2"></i>
                                </button>
                            </form>
                        <?php else: ?>
                            <div class="alert alert-info rounded-4 border-0 mb-0" role="status">
                                <p class="fw-semibold mb-3"><i class="bi bi-info-circle-fill me-2"></i>Inicia sesión para reservar este paquete.</p>
                                <a
                                    class="btn btn-gradient rounded-pill w-100"
                                    href="index.php?c=paquete&amp;a=login&amp;mensaje=debes_iniciar_sesion"
                                >Iniciar Sesión <i class="bi bi-box-arrow-in-right ms-2"></i></a>
                            </div>
                        <?php endif; ?>

                        <a class="btn btn-soft rounded-pill w-100 mt-3" href="index.php?c=paquete&a=index">
                            <i class="bi bi-arrow-left me-2"></i>Volver al catálogo
                        </a>
                    </section>
                </div>
            </div>
        </main>
    <?php endif; ?>

    <footer class="site-footer py-4">
        <div class="container d-flex flex-column flex-sm-row justify-content-between align-items-center gap-2">
            <a class="navbar-brand fw-bold text-white mb-0" href="index.php"><i class="bi bi-compass-fill me-2" style="color: #8ce3d6;"></i>Agencia de Viajes</a>
            <small>&copy; <?= date('Y') ?> Todos los derechos reservados.</small>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
