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
</style>

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
                                <span class="badge bg-success rounded-pill">{{ $fazenda->total_bovinos }}</span>
                            </td>
                            <td class="d-flex justify-content-center gap-1">
                                <button type="button" class="btn btn-sm btn-outline-success btn-action" data-bs-toggle="modal" data-bs-target="#modalAdd{{ $fazenda->id }}">
                                    <i class="bi bi-plus-lg"></i> Add
                                </button>
                                <button type="button" class="btn btn-sm btn-outline-danger btn-action" data-bs-toggle="modal" data-bs-target="#modalRem{{ $fazenda->id }}">
                                    <i class="bi bi-dash-lg"></i> Rem
                                </button>
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
                                            <select name="bovino_id" class="form-control" required>
                                                @foreach($bovinosLivres as $boi)
                                                    <option value="{{ $boi->id }}">#{{ $boi->id }} - {{ $boi->raca }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="modal-footer">
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
                                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                                        <span>ID #{{ $boi->id }} - {{ $boi->raca }}</span>
                                                        <form action="{{ url('/fazendas/' . $fazenda->id . '/desvincular/' . $boi->id) }}" method="POST">
                                                            @csrf @method('DELETE')
                                                            <button type="submit" class="btn btn-sm btn-outline-danger">Remover</button>
                                                        </form>
                                                    </li>
                                                @endforeach
                                            @else
                                                <li class="list-group-item text-center">Nenhum bovino nesta fazenda.</li>
                                            @endif
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <tr><td colspan="5" class="p-4 text-muted">Nenhuma fazenda.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection