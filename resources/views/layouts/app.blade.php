<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Sistema de Bovinos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body { background: linear-gradient(135deg, #e8f5e9, #f1f8e9); min-height: 100vh; }

        .navbar-gradient {
            background: linear-gradient(135deg, #2e7d32, #43a047) !important;
        }
    </style>
</head>
<body class="bg-light">

    <nav class="navbar navbar-expand-lg navbar-dark navbar-gradient shadow">
        <div class="container">
            <a class="navbar-brand" href="/">🐄 BoiNaFaixa</a>
            <div class="navbar-nav ms-auto">
                <a class="nav-link" href="/bovinos">Listar</a>
                <a class="nav-link" href="/bovinos/create">Cadastrar</a>
                <a class="nav-link position-relative" href="/carrinho">
                    <i class="bi bi-cart3 fs-5"></i>
                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">0</span>
                </a>
            </div>
        </div>
    </nav>

    <main class="container mt-5 mb-5">
        @yield('content')
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>