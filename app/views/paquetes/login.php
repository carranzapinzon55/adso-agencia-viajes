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
    <meta name="description" content="Inicia sesión en Agencia de Viajes.">
    <title>Iniciar sesión | Agencia de Viajes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <style>
        :root {
            --ocean: #123b4a;
            --teal: #0e9f9a;
            --ink: #17323c;
        }

        body {
            min-height: 100vh;
            color: var(--ink);
            background:
                radial-gradient(ellipse at 10% 12%, rgba(20, 184, 166, .13), transparent 30rem),
                radial-gradient(ellipse at 92% 78%, rgba(255, 138, 101, .12), transparent 28rem),
                #f2f7f7;
        }

        .navbar {
            background: rgba(15, 42, 52, .97);
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

        .login-shell {
            min-height: calc(100vh - 74px);
            display: grid;
            place-items: center;
            padding-top: 3rem;
            padding-bottom: 3rem;
        }

        .login-card {
            width: min(100%, 480px);
            overflow: hidden;
            border: 1px solid rgba(24, 76, 86, .08);
            border-radius: 22px;
            background: #fff;
            box-shadow: 0 24px 70px rgba(13, 48, 59, .15);
            animation: rise-in .55s ease both;
        }

        .login-banner {
            position: relative;
            overflow: hidden;
            padding: 2.2rem;
            color: #fff;
            background:
                linear-gradient(120deg, rgba(15, 32, 39, .92), rgba(32, 90, 99, .82), rgba(14, 159, 154, .78)),
                url('https://images.unsplash.com/photo-1501785888041-af3ef285b470?auto=format&fit=crop&w=1200&q=80') center / cover;
        }

        .login-banner::after {
            position: absolute;
            right: -3rem;
            bottom: -7rem;
            width: 16rem;
            height: 16rem;
            content: "";
            border: 1px solid rgba(255, 255, 255, .2);
            border-radius: 50%;
            box-shadow: 0 0 0 25px rgba(255, 255, 255, .04), 0 0 0 50px rgba(255, 255, 255, .03);
        }

        .banner-content {
            position: relative;
            z-index: 1;
        }

        .login-icon {
            display: inline-grid;
            width: 3rem;
            height: 3rem;
            place-items: center;
            color: var(--ocean);
            background: #a8f0e2;
            border-radius: 16px;
            font-size: 1.35rem;
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
            transform: translateY(-2px);
        }

        .demo-box {
            color: #42636a;
            background: #f0f8f6;
            border: 1px solid #dcefeb;
            border-radius: 14px;
        }

        .demo-box code {
            color: #176b71;
        }

        @keyframes rise-in {
            from {
                opacity: 0;
                transform: translateY(14px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @media (prefers-reduced-motion: reduce) {
            *,
            *::before,
            *::after {
                animation-duration: .01ms !important;
                transition-duration: .01ms !important;
            }
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-dark">
        <div class="container py-2">
            <a class="navbar-brand fw-bold d-flex align-items-center" href="index.php?c=paquete&a=index">
                <span class="brand-mark"><i class="bi bi-compass-fill"></i></span>
                Agencia de Viajes
            </a>
            <a class="btn btn-outline-light btn-sm rounded-pill" href="index.php?c=paquete&a=index">
                <i class="bi bi-arrow-left me-1"></i>Volver al catálogo
            </a>
        </div>
    </nav>

    <main class="container login-shell">
        <section class="login-card">
            <div class="login-banner">
                <div class="banner-content">
                    <span class="login-icon mb-3"><i class="bi bi-person-lock"></i></span>
                    <p class="small text-uppercase fw-bold mb-2" style="color: #a8f0e2; letter-spacing: .14em;">Bienvenido de vuelta</p>
                    <h1 class="h2 fw-bold mb-2">Tu siguiente viaje te espera</h1>
                    <p class="mb-0 text-white-50">Inicia sesión para continuar con tus aventuras.</p>
                </div>
            </div>

            <div class="p-4 p-md-5">
                <?php if (!empty($mensajeLogin)): ?>
                    <div class="alert alert-info rounded-4 border-0" role="status">
                        <i class="bi bi-info-circle-fill me-2"></i><?= $escapar($mensajeLogin) ?>
                    </div>
                <?php endif; ?>

                <?php if (!empty($errorLogin)): ?>
                    <div class="alert alert-danger rounded-4 border-0" role="alert">
                        <i class="bi bi-exclamation-circle-fill me-2"></i><?= $escapar($errorLogin) ?>
                    </div>
                <?php endif; ?>

                <form method="post" action="index.php?c=paquete&amp;a=login">
                    <div class="mb-3">
                        <label for="correo" class="form-label">Correo electrónico</label>
                        <div class="input-group">
                            <span class="input-group-text bg-white border-end-0" style="border-color: #dce8e7; border-radius: 12px 0 0 12px;">
                                <i class="bi bi-envelope text-secondary"></i>
                            </span>
                            <input
                                type="email"
                                class="form-control border-start-0"
                                id="correo"
                                name="correo"
                                autocomplete="username"
                                placeholder="tu@correo.com"
                                required
                                style="border-radius: 0 12px 12px 0;"
                            >
                        </div>
                    </div>
                    <div class="mb-4">
                        <label for="password" class="form-label">Contraseña</label>
                        <div class="input-group">
                            <span class="input-group-text bg-white border-end-0" style="border-color: #dce8e7; border-radius: 12px 0 0 12px;">
                                <i class="bi bi-key text-secondary"></i>
                            </span>
                            <input
                                type="password"
                                class="form-control border-start-0"
                                id="password"
                                name="password"
                                autocomplete="current-password"
                                placeholder="Ingresa tu contraseña"
                                required
                                style="border-radius: 0 12px 12px 0;"
                            >
                        </div>
                    </div>
                    <button class="btn btn-gradient btn-lg rounded-pill w-100" type="submit">
                        Iniciar Sesión <i class="bi bi-arrow-right-circle ms-2"></i>
                    </button>
                </form>

                <div class="demo-box p-3 mt-4">
                    <p class="small fw-bold mb-2"><i class="bi bi-lightning-charge-fill me-2 text-warning"></i>Acceso rápido de demostración</p>
                    <p class="small mb-1">Correo: <code>carlos@viajes.com</code></p>
                    <p class="small mb-0">Contraseña: <code>123456</code></p>
                </div>
            </div>
        </section>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
