<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema BoiNaFaixa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body { background: linear-gradient(135deg, #e8f5e9, #f1f8e9); min-height: 100vh; }

        .navbar-gradient {
            background: linear-gradient(135deg, #2e7d32, #43a047) !important;
        }
        
        /* Ajustes suaves para os dropdowns do menu */
        .dropdown-menu { border-radius: 12px; padding: 0.5rem; }
        .dropdown-item { border-radius: 8px; transition: all 0.2s; padding: 0.5rem 1rem; }
        .dropdown-item:hover { background-color: #e8f5e9; color: #2e7d32; }
    </style>
</head>
<body class="bg-light">

    <nav class="navbar navbar-expand-lg navbar-dark navbar-gradient shadow">
        <div class="container">
            <a class="navbar-brand fw-bold" href="/">🐄 BoiNaFaixa</a>
            
            <!-- Botão responsivo para aparecer no celular -->
            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#menuNavegacao" aria-controls="menuNavegacao" aria-expanded="false" aria-label="Alternar navegação">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="menuNavegacao">
                <ul class="navbar-nav ms-auto gap-1">
                    
                    <!-- Menu Fazendas -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="menuFazendas" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-house-door me-1"></i> Fazendas
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0" aria-labelledby="menuFazendas">
                            <li>
                                <a class="dropdown-item" href="/fazendas">
                                    <i class="bi bi-list-ul me-2 text-success"></i> Listar Fazendas
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="/fazendas/create">
                                    <i class="bi bi-plus-circle me-2 text-success"></i> Nova Fazenda
                                </a>
                            </li>
                        </ul>
                    </li>

                    <!-- Menu Bovinos -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="menuBovinos" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-tag me-1"></i> Bovinos
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0" aria-labelledby="menuBovinos">
                            <li>
                                <a class="dropdown-item" href="/bovinos">
                                    <i class="bi bi-list-ul me-2 text-success"></i> Listar Bovinos
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="/bovinos/create">
                                    <i class="bi bi-plus-circle me-2 text-success"></i> Novo Bovino
                                </a>
                            </li>
                        </ul>
                    </li>

                </ul>
            </div>
        </div>
    </nav>

    <main class="container mt-5 mb-5">
        @yield('content')
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>