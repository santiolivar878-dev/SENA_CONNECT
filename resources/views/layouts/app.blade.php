<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>SENACONNECT</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">

    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'Inter', sans-serif;
            background-color: #fff;
            color: #000;
        }

        /* NAVBAR */
        .navbar-senaconnect {
            background-color: #fff;
            padding: 14px 28px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: sticky;
            top: 0;
            z-index: 1000;
            border-bottom: 4px solid #2f9e44;
        }

        .navbar-senaconnect .brand {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 28px;
            color: #000;
            text-decoration: none;
            letter-spacing: 4px;
        }

        .navbar-senaconnect .nav-links {
            display: flex;
            gap: 28px;
            list-style: none;
            margin: 0;
        }

        .navbar-senaconnect .nav-links a {
            color: #000;
            text-decoration: none;
            font-size: 13px;
            font-weight: 500;
            letter-spacing: 2px;
            text-transform: uppercase;
            transition: opacity 0.15s, color 0.15s;
        }

        .navbar-senaconnect .nav-links a:hover { opacity: 0.8; color: #2f9e44; }

        .navbar-senaconnect .nav-actions {
            display: flex;
            gap: 14px;
            align-items: center;
        }

        .navbar-senaconnect .nav-actions a {
            color: #000;
            text-decoration: none;
            font-size: 12px;
            font-weight: 500;
            letter-spacing: 1px;
            text-transform: uppercase;
            transition: opacity 0.15s, color 0.15s;
        }

        .navbar-senaconnect .nav-actions a:hover { opacity: 0.85; color: #2f9e44; }

        .btn-senaconnect {
            background-color: #2f9e44;
            color: #fff;
            border: 2px solid #2f9e44;
            padding: 8px 20px;
            font-size: 12px;
            font-weight: 600;
            letter-spacing: 1px;
            text-transform: uppercase;
            cursor: pointer;
            transition: all 0.15s;
            text-decoration: none;
            display: inline-block;
            border-radius: 6px;
        }

        .btn-senaconnect:hover {
            background-color: #fff;
            color: #2f9e44;
        }

        .btn-senaconnect-outline {
            background-color: #fff;
            color: #2f9e44;
            border: 2px solid #2f9e44;
            padding: 8px 20px;
            font-size: 12px;
            font-weight: 600;
            letter-spacing: 1px;
            text-transform: uppercase;
            cursor: pointer;
            transition: all 0.15s;
            text-decoration: none;
            display: inline-block;
            border-radius: 6px;
        }

        .btn-senaconnect-outline:hover {
            background-color: #2f9e44;
            color: #fff;
        }

        /* FOOTER */
        .footer-senaconnect {
            background-color: #fff;
            color: #000;
            padding: 28px;
            text-align: center;
            margin-top: 80px;
            border-top: 4px solid #2f9e44;
        }

        .footer-senaconnect .brand {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 28px;
            letter-spacing: 6px;
            margin-bottom: 8px;
        }

        .footer-senaconnect p {
            font-size: 12px;
            opacity: 0.8;
            letter-spacing: 1px;
        }

        .navbar-senaconnect .nav-actions {
    display: flex;
    align-items: center;
    gap: 12px;
}

.navbar-senaconnect .nav-actions form {
    margin: 0;
}

    </style>
</head>
<body>

<!-- NAVBAR -->
<nav class="navbar-senaconnect">
    <a href="{{ url('/') }}" class="brand">SENACONNECT</a>

    <ul class="nav-links">
        <li><a href="{{ url('/') }}">Inicio</a></li>
        <li><a href="{{ route('publicaciones.index') }}">Publicaciones</a></li>
        <li><a href="{{ route('vacantes.index') }}">Vacantes</a></li>
    </ul>

    <div class="nav-actions">
        @auth
            <span style="
                font-size:13px;
                font-weight:600;
                color:#000;
                margin-right:10px;
            ">
                {{ Auth::user()->name }}
            </span>

            <a href="{{ route('dashboard') }}">Mi cuenta</a>

            <form method="POST" action="{{ route('logout') }}" style="display:inline;">
                @csrf
                <button type="submit" class="btn-senaconnect-outline">
                    Salir
                </button>
            </form>
        @else
            <a href="{{ route('login') }}">Iniciar Sesión</a>
            <a href="{{ route('register') }}" class="btn-senaconnect">
                Registrarse
            </a>
        @endauth
    </div>
</nav>

    <!-- CONTENIDO -->
    <main>
        @yield('content')
    </main>

    <!-- FOOTER -->
    <footer class="footer-senaconnect">
        <div class="brand">SENACONNECT</div>
        <p>© {{ date('Y') }} SENACONNECT. Todos los derechos reservados.</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>