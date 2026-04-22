@extends('layouts.app')

@section('content')
<style>
    .card { border: none; border-radius: 16px; overflow: hidden; }
    .card-header { background: linear-gradient(135deg, #2e7d32, #43a047) !important; padding: 1.5rem; }
    .form-label { font-weight: 600; color: #2e7d32; font-size: 0.875rem; text-transform: uppercase; letter-spacing: 0.5px; }
    .form-control { border-radius: 10px; border: 1.5px solid #c8e6c9; padding: 0.6rem 1rem; transition: all 0.2s; }
    .form-control:focus { border-color: #43a047; box-shadow: 0 0 0 3px rgba(67, 160, 71, 0.15); }
    .input-group-text { background-color: #e8f5e9; border: 1.5px solid #c8e6c9; border-radius: 10px 0 0 10px; color: #2e7d32; }
    .input-group .form-control { border-radius: 0 10px 10px 0; }
    .btn-salvar { background: linear-gradient(135deg, #2e7d32, #43a047); border: none; border-radius: 10px; padding: 0.7rem; font-weight: 600; letter-spacing: 0.5px; transition: all 0.2s; }
    .btn-salvar:hover { transform: translateY(-1px); box-shadow: 0 4px 12px rgba(46, 125, 50, 0.4); }
    .btn-cancelar { border-radius: 10px; padding: 0.7rem; font-weight: 600; letter-spacing: 0.5px; border: 1.5px solid #dee2e6; transition: all 0.2s; }
    .btn-cancelar:hover { background-color: #f8f9fa; transform: translateY(-1px); }
</style>

<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card shadow-lg">
            <div class="card-header">
                <div class="d-flex align-items-center gap-2">
                    <i class="bi bi-house-add fs-4 text-white"></i>
                    <h4 class="mb-0 text-white">Cadastro de Fazenda</h4>
                </div>
            </div>

            <div class="card-body p-4">
                @if(session('success'))
                    <div class="alert alert-success d-flex align-items-center gap-2 rounded-3" id="alertaSucesso">
                        <i class="bi bi-check-circle-fill"></i>
                        {{ session('success') }}
                    </div>
                @endif

                @if($errors->any())
                    <div class="alert alert-danger d-flex align-items-center gap-2 rounded-3">
                        <i class="bi bi-exclamation-triangle-fill"></i>
                        <ul class="mb-0 ps-2">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="/fazendas" method="POST">
                    @csrf
                    
                    <div class="mb-3">
                        <label class="form-label">Nome da Fazenda</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-house"></i></span>
                            <input type="text" name="nome" class="form-control" placeholder="Ex: Fazenda Santa Maria" required>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="form-label">Localização</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-geo-alt"></i></span>
                            <input type="text" name="localizacao" class="form-control" placeholder="Ex: Cidade, Estado" required>
                        </div>
                    </div>

                    <div class="d-flex gap-2">
                        <a href="/fazendas" class="btn btn-cancelar w-50 text-secondary">
                            <i class="bi bi-arrow-left me-1"></i> Cancelar
                        </a>
                        <button type="submit" class="btn btn-salvar btn-success w-50 text-white">
                            <i class="bi bi-check-lg me-1"></i> Salvar Fazenda
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>

    const aviso = document.getElementById('alertaSucesso');
    if (aviso) {
        setTimeout(() => {
            aviso.style.transition = "opacity 0.5s ease";
            aviso.style.opacity = "0";
            setTimeout(() => aviso.remove(), 500);
        }, 3000);
    }
</script>
@endsection