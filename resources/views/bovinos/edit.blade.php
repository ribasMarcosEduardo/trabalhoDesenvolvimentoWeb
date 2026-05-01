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
    .preview-img { display: none; width: 100%; max-height: 250px; object-fit: contain; border-radius: 10px; margin-top: 15px; border: 2px solid #c8e6c9; background-color: #fcfcfc; transition: transform 0.3s ease; }
    .preview-img:hover { transform: scale(1.05); cursor: zoom-in; border-color: #43a047; }
</style>

<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card shadow-lg">
            <div class="card-header">
                <div class="d-flex align-items-center gap-2">
                    <i class="bi bi-pencil-square fs-4 text-white"></i>
                    <h4 class="mb-0 text-white">Editar Bovino #{{ $bovino->id }}</h4>
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

                <form action="/bovinos/{{ $bovino->id }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    
                    <div class="mb-3">
                        <label class="form-label">Raça</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-tag"></i></span>
                            <input type="text" name="raca" class="form-control" placeholder="Ex: Nelore, Angus..." value="{{ old('raca', $bovino->raca) }}">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-6 mb-3">
                            <label class="form-label">Peso (kg)</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-speedometer2"></i></span>
                                <input type="number" step="0.01" name="peso" class="form-control" placeholder="0,00" value="{{ old('peso', $bovino->peso) }}">
                            </div>
                        </div>
                        <div class="col-6 mb-3">
                            <label class="form-label">Preço (R$)</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-currency-dollar"></i></span>
                                <input type="number" step="0.01" name="preco" class="form-control" placeholder="0,00" value="{{ old('preco', $bovino->preco) }}">
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Idade (anos)</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-calendar3"></i></span>
                            <input type="number" name="idade" class="form-control" placeholder="Ex: 3" value="{{ old('idade', $bovino->idade) }}">
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="form-label">Imagem do Bovino</label>
                        <input type="file" name="imagem" class="form-control" id="inputImagem" accept="image/*">
                        <small class="text-muted d-block mt-1">Deixe em branco para manter a imagem atual.</small>
                        
                        <!-- Mostra a imagem atual se existir, senão fica oculto aguardando upload -->
                        <img id="previewImagem" class="preview-img" alt="Prévia" 
                             src="{{ $bovino->imagem ? asset('storage/' . $bovino->imagem) : '' }}" 
                             style="{{ $bovino->imagem ? 'display: block;' : 'display: none;' }}">
                    </div>

                    <div class="d-flex gap-2">
                        <a href="/bovinos" class="btn btn-cancelar w-50 text-secondary">
                            <i class="bi bi-arrow-left me-1"></i> Cancelar
                        </a>
                        <button type="submit" class="btn btn-salvar btn-success w-50 text-white">
                            <i class="bi bi-check-lg me-1"></i> Atualizar Bovino
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    document.getElementById('inputImagem').addEventListener('change', function () {
        const preview = document.getElementById('previewImagem');
        const file = this.files[0];
        if (file) {
            preview.src = URL.createObjectURL(file);
            preview.style.display = 'block';
        } else {
            // Se o usuário cancelar a seleção, volta para a imagem original (se existir) ou esconde
            const imagemOriginal = "{{ $bovino->imagem ? asset('storage/' . $bovino->imagem) : '' }}";
            if(imagemOriginal) {
                preview.src = imagemOriginal;
                preview.style.display = 'block';
            } else {
                preview.style.display = 'none';
                preview.src = '';
            }
        }
    });

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