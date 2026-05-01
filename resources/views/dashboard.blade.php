@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4 text-success fw-bold"><i class="bi bi-graph-up me-2"></i> Dashboard BoiNaFaixa</h2>
    
    <div class="row g-4">
        <!-- Card Total Fazendas -->
        <div class="col-md-4">
            <div class="card shadow-sm border-0 bg-primary text-white h-100" style="border-radius: 16px;">
                <div class="card-body text-center p-4">
                    <i class="bi bi-house-door display-4 mb-3"></i>
                    <h5 class="card-title text-uppercase fw-semibold mb-0">Total de Fazendas</h5>
                    <h1 class="display-5 fw-bold mt-2">{{ $totalFazendas }}</h1>
                </div>
            </div>
        </div>

        <!-- Card Total Bovinos -->
        <div class="col-md-4">
            <div class="card shadow-sm border-0 bg-success text-white h-100" style="border-radius: 16px;">
                <div class="card-body text-center p-4">
                    <i class="bi bi-tag display-4 mb-3"></i>
                    <h5 class="card-title text-uppercase fw-semibold mb-0">Total de Bovinos</h5>
                    <h1 class="display-5 fw-bold mt-2">{{ $totalBovinos }}</h1>
                </div>
            </div>
        </div>

        <!-- Card Bovinos Livres -->
        <div class="col-md-4">
            <div class="card shadow-sm border-0 bg-warning text-dark h-100" style="border-radius: 16px;">
                <div class="card-body text-center p-4">
                    <i class="bi bi-unlock display-4 mb-3"></i>
                    <h5 class="card-title text-uppercase fw-semibold mb-0">Bovinos Livres</h5>
                    <h1 class="display-5 fw-bold mt-2">{{ $bovinosLivres }}</h1>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection