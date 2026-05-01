@extends('layouts.app')

@section('content')
<style>
    .card { border: none; border-radius: 16px; overflow: hidden; }
    .card-header { background: linear-gradient(135deg, #2e7d32, #43a047) !important; padding: 1.5rem; }
    .table thead th { background-color: #f1f8e9; color: #2e7d32; font-size: 0.8rem; text-transform: uppercase; letter-spacing: 0.5px; font-weight: 700; border-bottom: 2px solid #c8e6c9; }
    .table td { vertical-align: middle; font-size: 0.95rem; color: #37474f; }
    .btn-action { border-radius: 8px; font-size: 0.85rem; padding: 0.4rem 0.8rem; transition: all 0.2s; }
    .btn-action:hover { transform: translateY(-2px); }
    .btn-cadastrar { border-radius: 8px; font-weight: 600; font-size: 0.875rem; padding: 0.4rem 1rem; transition: all 0.2s; }
    
    /* Novos estilos para os botões de editar e excluir */
    .btn-crud { border-radius: 8px; font-size: 0.85rem; padding: 0.4rem; transition: all 0.2s; display: flex; align-items: center; justify-content: center; }
    .btn-crud:hover { transform: translateY(-2px); }

    /* Estilos da Barra de Busca Separada */
    .search-container { background-color: #ffffff; border-radius: 16px; padding: 1.5rem; box-shadow: 0 4px 15px rgba(0,0,0,0.03); border: 1px solid #e8f5e9; }
    .search-group { box-shadow: 0 4px 10px rgba(0,0,0,0.04); border-radius: 10px; transition: all 0.2s; }
    .search-group:focus-within { box-shadow: 0 0 0 3px rgba(67, 160, 71, 0.15); }
    .icon-search { background-color: #ffffff; border: 1.5px solid #c8e6c9; border-right: none; border-radius: 10px 0 0 10px; color: #43a047; padding-left: 1.2rem; }
    .input-search { border-radius: 0 10px 10px 0 !important; border: 1.5px solid #c8e6c9; border-left: none; padding: 0.7rem 1rem; box-shadow: none !important; font-size: 0.95rem; }
    .search-group:focus-within .icon-search, .search-group:focus-within .input-search { border-color: #43a047; }
    .btn-buscar { background: linear-gradient(135deg, #2e7d32, #43a047); border: none; border-radius: 10px; padding: 0.7rem 1.8rem; font-weight: 600; color: white; transition: all 0.2s; }
    .btn-buscar:hover { transform: translateY(-1px); box-shadow: 0 4px 12px rgba(46, 125, 50, 0.4); color: white; }
    .btn-limpar { border-radius: 10px; padding: 0.7rem 1.2rem; font-weight: 600; border: 1.5px solid #dee2e6; color: #6c757d; transition: all 0.2s; background: white; }
    .btn-limpar:hover { background-color: #fff1f0; color: #dc3545; border-color: #ffcdd2; }
</style>

<!-- Alertas de Sucesso e Erro -->
@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show mb-4 shadow-sm" id="alertaSucesso" role="alert">
        <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show mb-4 shadow-sm" id="alertaErro" role="alert">
        <i class="bi bi-exclamation-triangle-fill me-2"></i>{{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<!-- BARRA DE BUSCA SEPARADA E CENTRALIZADA -->
<div class="d-flex justify-content-center mb-4">
    <div class="search-container w-100" style="max-width: 800px;">
        <form action="{{ url('/fazendas') }}" method="GET" class="d-flex gap-3 align-items-center m-0">
            <div class="input-group search-group flex-grow-1">
                <span class="input-group-text icon-search"><i class="bi bi-search"></i></span>
                <input type="text" name="busca" class="form-control input-search" placeholder="Procurar fazenda pelo nome..." value="{{ $busca ?? '' }}">
            </div>
            <button type="submit" class="btn btn-buscar shadow-sm">Pesquisar</button>
            
            @if(!empty($busca))
                <a href="{{ url('/fazendas') }}" class="btn btn-limpar shadow-sm" title="Limpar busca">
                    <i class="bi bi-x-lg"></i>
                </a>
            @endif
        </form>
    </div>
</div>
<!-- FIM DA BARRA DE BUSCA -->

<!-- TABELA DE FAZENDAS -->
<div class="card shadow-lg">
    <div class="card-header d-flex justify-content-between align-items-center">
        <div class="d-flex align-items-center gap-2">
            <i class="bi bi-house fs-4 text-white"></i>
            <h4 class="mb-0 text-white">Fazendas Cadastradas</h4>
        </div>
        <a href="{{ url('/fazendas/create') }}" class="btn btn-light btn-cadastrar">
            <i class="bi bi-plus-circle me-1"></i> Nova Fazenda
        </a>
    </div>

    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover table-bordered align-middle text-center mb-0">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>Localização</th>
                        <th>Qtd. Bovinos</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($fazendas as $fazenda)
                        <tr>
                            <td>#{{ $fazenda->id }}</td>
                            <td class="fw-bold">{{ $fazenda->nome }}</td>
                            <td>{{ $fazenda->localizacao }}</td>
                            <td>
                                <span class="badge bg-success rounded-pill px-3 py-2">{{ $fazenda->total_bovinos }}</span>
                            </td>
                            <td>
                                <div class="d-flex justify-content-center align-items-center gap-2 flex-wrap">
                                    <!-- Ações de Bovinos (Alocação) -->
                                    <div class="btn-group" role="group">
                                        <button type="button" class="btn btn-sm btn-outline-success btn-action" data-bs-toggle="modal" data-bs-target="#modalAdd{{ $fazenda->id }}" title="Vincular Bovino">
                                            <i class="bi bi-plus-lg"></i> Add
                                        </button>
                                        <button type="button" class="btn btn-sm btn-outline-danger btn-action" data-bs-toggle="modal" data-bs-target="#modalRem{{ $fazenda->id }}" title="Desvincular Bovino">
                                            <i class="bi bi-dash-lg"></i> Rem
                                        </button>
                                    </div>

                                    <!-- Linha divisória vertical (opcional) -->
                                    <div class="vr mx-1"></div>

                                    <!-- Ações da Fazenda (Editar/Excluir) -->
                                    <div class="d-flex gap-1">
                                        <a href="/fazendas/{{ $fazenda->id }}/edit" class="btn btn-sm btn-outline-success btn-crud" title="Editar Fazenda">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>
                                        
                                        <form action="/fazendas/{{ $fazenda->id }}" method="POST" onsubmit="return confirm('Tem certeza que deseja excluir esta fazenda?');" class="m-0">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger btn-crud" title="Excluir Fazenda">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </td>
                        </tr>

                        {{-- MODAL ADICIONAR --}}
                        <div class="modal fade" id="modalAdd{{ $fazenda->id }}" tabindex="-1">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header bg-success text-white">
                                        <h5 class="modal-title">Vincular Bovino</h5>
                                    </div>
                                    <form action="{{ url('/fazendas/' . $fazenda->id . '/vincular') }}" method="POST">
                                        @csrf
                                        <div class="modal-body">
                                            <label>Escolha o bovino:</label>
                                            <select name="bovino_id" class="form-select mt-2" required>
                                                <option value="" disabled selected>Selecione um bovino livre...</option>
                                                @foreach($bovinosLivres as $boi)
                                                    <option value="{{ $boi->id }}">#{{ $boi->id }} - {{ $boi->raca }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                                            <button type="submit" class="btn btn-success">Vincular</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        {{-- MODAL REMOVER --}}
                        <div class="modal fade" id="modalRem{{ $fazenda->id }}" tabindex="-1">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header bg-danger text-white">
                                        <h5 class="modal-title">Remover Bovino</h5>
                                    </div>
                                    <div class="modal-body p-0">
                                        <ul class="list-group list-group-flush">
                                            @php $f = $fazendasComRelacionamentos->find($fazenda->id); @endphp
                                            @if($f && $f->bovinos->count() > 0)
                                                @foreach($f->bovinos as $boi)
                                                    <li class="list-group-item d-flex justify-content-between align-items-center py-3">
                                                        <span><strong>#{{ $boi->id }}</strong> - {{ $boi->raca }}</span>
                                                        <form action="{{ url('/fazendas/' . $fazenda->id . '/desvincular/' . $boi->id) }}" method="POST" class="m-0">
                                                            @csrf @method('DELETE')
                                                            <button type="submit" class="btn btn-sm btn-danger">Remover</button>
                                                        </form>
                                                    </li>
                                                @endforeach
                                            @else
                                                <li class="list-group-item text-center p-4 text-muted">Nenhum bovino nesta fazenda.</li>
                                            @endif
                                        </ul>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <tr><td colspan="5" class="p-5 text-muted">Nenhuma fazenda encontrada com este nome.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    function ocultarAlerta(id) {
        const aviso = document.getElementById(id);
        if (aviso) {
            setTimeout(() => {
                aviso.style.transition = "opacity 0.5s ease";
                aviso.style.opacity = "0";
                setTimeout(() => aviso.remove(), 500);
            }, 3000);
        }
    }
    ocultarAlerta('alertaSucesso');
    ocultarAlerta('alertaErro');
</script>
@endsection