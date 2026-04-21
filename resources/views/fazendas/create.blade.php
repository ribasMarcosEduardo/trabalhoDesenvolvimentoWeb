@extends('layouts.app')

@section('content')
<style>
    .card { border: none; border-radius: 16px; overflow: hidden; }
    .card-header { background: linear-gradient(135deg, #2e7d32, #43a047) !important; padding: 1.5rem; }
    .form-label { font-weight: 600; color: #2e7d32; font-size: 0.875rem; text-transform: uppercase; letter-spacing: 0.5px; }
    .form-control { border-radius: 10px; border: 1.5px solid #c8e6c9; padding: 0.6rem 1rem; }
    .btn-salvar { background: linear-gradient(135deg, #2e7d32, #43a047); border: none; border-radius: 10px; padding: 0.7rem; font-weight: 600; color: white; }
</style>

<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card shadow-lg">
            <div class="card-header">
                <div class="d-flex align-items-center gap-2">
                    <i class="bi bi-house-add fs-4 text-white"></i>
                    <h4 class="mb-0 text-white">Cadastrar Fazenda</h4>
                </div>
            </div>

            <div class="card-body p-4">
                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach($errors->all() as $error) <li>{{ $error }}</li> @endforeach
                        </ul>
                    </div>
                @endif

                <form action="/fazendas" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Nome da Fazenda</label>
                        <input type="text" name="nome" class="form-control" required>
                    </div>

                    <div class="mb-4">
                        <label class="form-label">Localização</label>
                        <input type="text" name="localizacao" class="form-control" required>
                    </div>

                    <div class="d-flex gap-2">
                        <a href="/bovinos" class="btn btn-outline-secondary w-50">Cancelar</a>
                        <button type="submit" class="btn btn-salvar w-50">Salvar Fazenda</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection