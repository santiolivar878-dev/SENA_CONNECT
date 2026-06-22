<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #fff;
            color: #000;
        }
        .auth-wrapper {
            background-color: #f8f9fa;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px 0;
        }
        .auth-card {
            border: 2px solid #2f9e44;
            border-radius: 18px;
            overflow: hidden;
        }
        .auth-card .card-body {
            background-color: #fff;
        }
        .auth-title {
            color: #000;
            font-family: 'Bebas Neue', sans-serif;
            letter-spacing: 2px;
            margin-bottom: 1.5rem;
            text-transform: uppercase;
        }
        .btn-senaconnect {
            background-color: #2f9e44;
            color: #fff;
            border: 2px solid #2f9e44;
            padding: 0.75rem 1.5rem;
            border-radius: 0.5rem;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        .btn-senaconnect:hover {
            background-color: #fff;
            color: #2f9e44;
        }
        .link-senaconnect {
            color: #2f9e44;
            text-decoration: none;
            font-weight: 600;
        }
        .link-senaconnect:hover {
            text-decoration: underline;
        }
        .form-label {
            color: #000;
            font-weight: 600;
        }
        .alert-danger {
            border-color: #2f9e44;
            background-color: #fff5f5;
            color: #000;
        }
    </style>
</head>
<body>
    <div class="auth-wrapper">
        <div class="w-100" style="max-width: 500px;">
            <div class="auth-card card shadow-sm">
                <div class="card-body">
                    <div class="mb-4 text-center">
                        <a href="/" style="text-decoration:none; color:#000;">
                            <h1 style="font-family:'Bebas Neue', sans-serif; letter-spacing:4px; font-size:32px; margin:0;">SENACONNECT</h1>
                        </a>
                    </div>
                    {{ $slot }}
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>