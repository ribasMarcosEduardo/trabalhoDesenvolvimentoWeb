<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Cadastrar Bovino</title>

    <!-- Bootstrap CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container mt-5">

    <!-- Card centralizado -->
    <div class="row justify-content-center">
        <div class="col-md-6">

            <div class="card shadow">
                <div class="card-header bg-success text-white">
                    <h4 class="mb-0">Cadastro de Bovino</h4>
                </div>

                <div class="card-body">

                    <!-- Mensagem de sucesso -->
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <!-- Formulário -->
                    <form action="/bovinos" method="POST" enctype="multipart/form-data">
                        @csrf

                        <!-- Raça -->
                        <div class="mb-3">
                            <label class="form-label">Raça</label>
                            <input type="text" name="raca" class="form-control">
                        </div>

                        <!-- Peso -->
                        <div class="mb-3">
                            <label class="form-label">Peso (kg)</label>
                            <input type="number" step="0.01" name="peso" class="form-control">
                        </div>

                        <!-- Idade -->
                        <div class="mb-3">
                            <label class="form-label">Idade (anos)</label>
                            <input type="number" name="age" class="form-control">
                        </div>

                        <!-- Imagem -->
                        <div class="mb-3">
                            <label class="form-label">Imagem do Bovino</label>
                            <input type="file" name="imagem" class="form-control">
                        </div>

                        <button type="submit" class="btn btn-success w-100">
                            Salvar Bovino
                        </button>
                    </form>

                </div>
            </div>

        </div>
    </div>

</div>

</body>
</html>