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
    <meta name="description" content="Consulta tus reservas de viaje en un solo lugar.">
    <title>Reservas Realizadas | Agencia de Viajes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <style>
        :root {
            --ocean: #123b4a;
            --teal: #0e9f9a;
            --ink: #17323c;
            --page: #f2f7f7;
            --shadow: 0 10px 30px rgba(13, 48, 59, .09);
        }

        body {
            color: var(--ink);
            background:
                radial-gradient(ellipse at 10% 12%, rgba(20, 184, 166, .09), transparent 28rem),
                radial-gradient(ellipse at 90% 60%, rgba(255, 138, 101, .08), transparent 25rem),
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
            color: rgba(255, 255, 255, .76);
            transition: color .3s ease;
        }

        .nav-link:hover,
        .nav-link.active {
            color: #fff;
        }

        .reservations-hero {
            position: relative;
            overflow: hidden;
            color: #fff;
            background:
                linear-gradient(115deg, rgba(15, 32, 39, .95), rgba(32, 90, 99, .92) 58%, rgba(14, 159, 154, .84)),
                url('https://images.unsplash.com/photo-1488646953014-85cb44e25828?auto=format&fit=crop&w=1800&q=80') center 45% / cover;
        }

        .reservations-hero::after {
            position: absolute;
            top: -12rem;
            right: 7%;
            width: 30rem;
            height: 30rem;
            content: "";
            border: 1px solid rgba(255, 255, 255, .15);
            border-radius: 50%;
            box-shadow: 0 0 0 42px rgba(255, 255, 255, .035), 0 0 0 84px rgba(255, 255, 255, .025);
        }

        .hero-content {
            position: relative;
            z-index: 1;
            padding-top: 4.5rem;
            padding-bottom: 4.5rem;
        }

        .eyebrow {
            color: #a8f0e2;
            font-size: .76rem;
            font-weight: 800;
            letter-spacing: .14em;
            text-transform: uppercase;
        }

        .reservations-card {
            overflow: hidden;
            border: 1px solid rgba(24, 76, 86, .07);
            border-radius: 16px;
            background: #fff;
            box-shadow: var(--shadow);
        }

        .table {
            --bs-table-bg: transparent;
            --bs-table-color: var(--ink);
            margin-bottom: 0;
        }

        .table thead th {
            padding: 1rem 1.15rem;
            color: #eafbf8;
            background: linear-gradient(105deg, #123b4a, #176b71);
            border: 0;
            font-size: .77rem;
            font-weight: 700;
            letter-spacing: .06em;
            text-transform: uppercase;
            white-space: nowrap;
        }

        .table tbody td,
        .table tbody th {
            padding: 1rem 1.15rem;
            border-color: #edf2f2;
            vertical-align: middle;
        }

        .table tbody tr:nth-child(even) {
            background: #f8fbfb;
        }

        .table-hover tbody tr {
            transition: background-color .25s ease;
        }

        .table-hover tbody tr:hover {
            --bs-table-bg-state: #eaf8f5;
        }

        .reservation-number {
            color: #267c7c;
            font-weight: 800;
        }

        .status-badge {
            display: inline-flex;
            align-items: center;
            gap: .4rem;
            padding: .5rem .75rem;
            border: 1px solid transparent;
            border-radius: 999px;
            font-size: .78rem;
            font-weight: 700;
        }

        .status-pending {
            color: #865800;
            background: #fff4d6;
            border-color: #ffe3a1;
        }

        .status-confirmed {
            color: #146b48;
            background: #daf6e9;
            border-color: #b7ebd0;
        }

        .status-cancelled {
            color: #9c3d46;
            background: #fde7e9;
            border-color: #f7c9cd;
        }

        .status-other {
            color: #52666d;
            background: #e9eff0;
            border-color: #d8e2e3;
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

        .empty-state {
            padding: 4rem 1.5rem;
            text-align: center;
        }

        .empty-icon {
            display: inline-grid;
            width: 5rem;
            height: 5rem;
            place-items: center;
            color: #168d88;
            background: #e4f7f3;
            border-radius: 1.5rem;
            font-size: 2rem;
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
                        <a class="nav-link active" aria-current="page" href="index.php?c=paquete&a=reservas"><i class="bi bi-journal-check me-1"></i>Reservas Realizadas</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <header class="reservations-hero">
        <div class="container hero-content">
            <p class="eyebrow mb-2"><i class="bi bi-journal-check me-2"></i>Tu bitácora viajera</p>
            <h1 class="display-5 fw-bold mb-2">Reservas realizadas</h1>
            <p class="lead mb-0 text-white-50">Todas tus próximas aventuras, organizadas en un solo lugar.</p>
        </div>
    </header>

    <main class="container py-5">
        <div class="d-flex flex-column flex-sm-row justify-content-between align-items-sm-center gap-3 mb-4">
            <div>
                <p class="small text-uppercase fw-bold mb-1" style="color: #0e9f9a; letter-spacing: .12em;">Resumen de viajes</p>
                <h2 class="h3 fw-bold mb-0">Historial de reservas</h2>
            </div>
            <a class="btn btn-gradient rounded-pill px-4" href="index.php?c=paquete&a=index">
                <i class="bi bi-arrow-left me-2"></i>Volver al catálogo
            </a>
        </div>

        <section class="reservations-card" aria-label="Listado de reservas">
            <?php if ($reservas === []): ?>
                <div class="empty-state">
                    <span class="empty-icon mb-3"><i class="bi bi-suitcase"></i></span>
                    <h3 class="h4 fw-bold">Aún no tienes reservas</h3>
                    <p class="text-secondary mb-4">Tu próxima aventura está a solo un clic de distancia.</p>
                    <a class="btn btn-gradient rounded-pill px-4" href="index.php?c=paquete&a=index">Explorar paquetes</a>
                </div>
            <?php else: ?>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
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
                                [$claseEstado, $iconoEstado] = match ($reserva['estado']) {
                                    'Pendiente' => ['status-pending', 'bi-hourglass-split'],
                                    'Confirmada' => ['status-confirmed', 'bi-check-circle-fill'],
                                    'Cancelada' => ['status-cancelled', 'bi-x-circle-fill'],
                                    default => ['status-other', 'bi-info-circle-fill'],
                                };
                                ?>
                                <tr>
                                    <th class="reservation-number" scope="row">#<?= (int) $reserva['id_reserva'] ?></th>
                                    <td><i class="bi bi-person-circle me-2 text-secondary"></i><?= $escapar($reserva['nombre_cliente']) ?></td>
                                    <td class="fw-semibold"><?= $escapar($reserva['titulo_paquete']) ?></td>
                                    <td><i class="bi bi-calendar3 me-2 text-secondary"></i><?= $escapar(date('d/m/Y', strtotime($reserva['fecha_viaje']))) ?></td>
                                    <td><i class="bi bi-people me-1 text-secondary"></i><?= (int) $reserva['cantidad_personas'] ?></td>
                                    <td class="fw-bold">$<?= number_format((float) $reserva['total'], 0, ',', '.') ?> <span class="small fw-normal text-secondary">COP</span></td>
                                    <td>
                                        <span class="status-badge <?= $claseEstado ?>">
                                            <i class="bi <?= $iconoEstado ?>"></i><?= $escapar($reserva['estado']) ?>
                                        </span>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php endif; ?>
        </section>
    </main>

    <footer class="site-footer py-4">
        <div class="container d-flex flex-column flex-sm-row justify-content-between align-items-center gap-2">
            <a class="navbar-brand fw-bold text-white mb-0" href="index.php"><i class="bi bi-compass-fill me-2" style="color: #8ce3d6;"></i>Agencia de Viajes</a>
            <small>&copy; <?= date('Y') ?> Todos los derechos reservados.</small>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
