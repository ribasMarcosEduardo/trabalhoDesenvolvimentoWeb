<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Fazenda;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\AlocacaoController;

class FazendaController extends Controller
{
    public function create()
    {
        return view('fazendas.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'localizacao' => 'required|string|max:255',
        ]);

        Fazenda::create($request->all());

        return redirect()->back()->with('success', 'Fazenda cadastrada com sucesso!');
    }

    public function index() 
    {
        $fazendas = DB::table('fazendas')
            ->leftJoin('alocacoes', 'fazendas.id', '=', 'alocacoes.fazenda_id')
            ->select('fazendas.*', DB::raw('count(alocacoes.id) as total_bovinos'))
            ->groupBy('fazendas.id', 'fazendas.nome', 'fazendas.localizacao', 'fazendas.created_at', 'fazendas.updated_at')
            ->get();

        $bovinosLivres = AlocacaoController::getBovinosDisponiveis();

        $fazendasComRelacionamentos = Fazenda::with('bovinos')->get();

        return view('fazendas.index', compact('fazendas', 'bovinosLivres', 'fazendasComRelacionamentos'));
    }
}
