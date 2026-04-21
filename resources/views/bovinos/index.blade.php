@extends('layouts.app')

@section('content')
<style>
    .card { border: none; border-radius: 16px; overflow: hidden; }
    .card-header { background: linear-gradient(135deg, #2e7d32, #43a047) !important; padding: 1.5rem; }
    .table thead th { background-color: #f1f8e9; color: #2e7d32; font-size: 0.8rem; text-transform: uppercase; letter-spacing: 0.5px; font-weight: 700; border-bottom: 2px solid #c8e6c9; }
    .table td { vertical-align: middle; font-size: 0.95rem; color: #37474f; }
    .table-hover tbody tr:hover { background-color: #f1f8e9; }
    .btn-cadastrar { border-radius: 8px; font-weight: 600; font-size: 0.875rem; padding: 0.4rem 1rem; transition: all 0.2s; }
    .img-hover-wrapper { position: relative; display: inline-block; cursor: pointer; }
    .img-preview { display: none; position: absolute; top: 50%; left: 110%; transform: translateY(-50%); z-index: 999; border-radius: 12px; box-shadow: 0 8px 24px rgba(0,0,0,0.3); width: 220px; height: 220px; object-fit: cover; border: 3px solid #43a047; }
    .img-hover-wrapper:hover .img-preview { display: block; }
    .img-thumb { width: 55px; height: 55px; object-fit: cover; border-radius: 10px; border: 2px solid #c8e6c9; transition: all 0.2s; }
    .zoom-icon { position: absolute; bottom: 2px; right: 2px; background: #43a047; color: white; border-radius: 50%; width: 18px; height: 18px; font-size: 10px; display: flex; align-items: center; justify-content: center; opacity: 0; transition: opacity 0.2s; }
    .img-hover-wrapper:hover .zoom-icon { opacity: 1; }
    .no-photo { display: flex; align-items: center; justify-content: center; width: 55px; height: 55px; background-color: #f1f8e9; border: 2px dashed #c8e6c9; border-radius: 10px; margin: 0 auto; color: #a5d6a7; font-size: 1.4rem; }
    .badge-raca { background-color: #e8f5e9; color: #2e7d32; font-weight: 600; font-size: 0.85rem; padding: 0.35em 0.75em; border-radius: 20px; }
    .empty-state { padding: 3rem; color: #adb5bd; }
</style>

<div class="card shadow-lg">
    <div class="card-header d-flex justify-content-between align-items-center">
        <div class="d-flex align-items-center gap-2">
            <i class="bi bi-list-ul fs-4 text-white"></i>
            <h4 class="mb-0 text-white">Bovinos Cadastrados</h4>
        </div>
        <a href="/bovinos/create" class="btn btn-light btn-cadastrar">
            <i class="bi bi-plus-circle me-1"></i> Cadastrar Novo
        </a>
    </div>

    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover table-bordered align-middle text-center mb-0">
                <thead>
                    <tr>
                        <th><i class="bi bi-hash"></i> ID</th>
                        <th><i class="bi bi-image"></i> Foto</th>
                        <th><i class="bi bi-tag"></i> Raça</th>
                        <th><i class="bi bi-speedometer2"></i> Peso (kg)</th>
                        <th><i class="bi bi-currency-dollar"></i> Preço (R$)</th>
                        <th><i class="bi bi-calendar3"></i> Idade (anos)</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($bovinos as $bovino)
                        <tr>
                            <td><span class="text-muted fw-semibold">#{{ $bovino->id }}</span></td>
                            <td>
                                @if($bovino->imagem)
                                    <div class="img-hover-wrapper">
                                        <img src="{{ asset('storage/' . $bovino->imagem) }}" class="img-thumb" alt="Foto">
                                        <span class="zoom-icon"><i class="bi bi-zoom-in"></i></span>
                                        <img src="{{ asset('storage/' . $bovino->imagem) }}" class="img-preview" alt="Preview">
                                    </div>
                                @else
                                    <div class="no-photo">🐄</div>
                                @endif
                            </td>
                            <td><span class="badge-raca">{{ $bovino->raca }}</span></td>
                            <td>{{ number_format($bovino->peso, 2, ',', '.') }}</td>
                            <td><span class="fw-semibold text-success">R$ {{ number_format($bovino->preco, 2, ',', '.') }}</span></td>
                            <td>{{ $bovino->idade ? $bovino->idade . ' anos' : '-' }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6"><div class="empty-state">Nenhum bovino cadastrado ainda.</div></td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection