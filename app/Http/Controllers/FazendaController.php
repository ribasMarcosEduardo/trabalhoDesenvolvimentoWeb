<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Fazenda;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\AlocacaoController;

class FazendaController extends Controller
{
    // Exibe o formulário (view) para cadastrar uma nova fazenda
    public function create()
    {
        return view('fazendas.create');
    }

    // Recebe os dados do formulário, faz a validação e salva a nova fazenda no banco de dados
    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'localizacao' => 'required|string|max:255',
        ]);

        Fazenda::create($request->all());

        return redirect()->back()->with('success', 'Fazenda cadastrada com sucesso!');
    }

    // Lista as fazendas, conta os bovinos de cada uma e aplica o filtro de busca pelo nome
    public function index(Request $request) 
    {

        $busca = $request->input('busca');

        $query = DB::table('fazendas')
            ->leftJoin('alocacoes', 'fazendas.id', '=', 'alocacoes.fazenda_id')
            ->select('fazendas.*', DB::raw('count(alocacoes.id) as total_bovinos'))
            ->groupBy('fazendas.id', 'fazendas.nome', 'fazendas.localizacao', 'fazendas.created_at', 'fazendas.updated_at');

        if ($busca) {
            $query->where('fazendas.nome', 'like', '%' . $busca . '%');
        }

        $fazendas = $query->get();

        $bovinosLivres = AlocacaoController::getBovinosDisponiveis();
        $fazendasComRelacionamentos = Fazenda::with('bovinos')->get();

        return view('fazendas.index', compact('fazendas', 'bovinosLivres', 'fazendasComRelacionamentos', 'busca'));
    }

    // Exibe o formulário de edição já preenchido com os dados da fazenda selecionada
    public function edit(Fazenda $fazenda)
    {
        return view('fazendas.edit', compact('fazenda'));
    }

    // Valida as alterações feitas no formulário e atualiza a fazenda no banco de dados
    public function update(Request $request, Fazenda $fazenda)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'localizacao' => 'required|string|max:255',
        ]);

        $fazenda->update($request->all());

        return redirect('/fazendas')->with('success', 'Fazenda atualizada com sucesso!');
    }

    // Tenta excluir a fazenda do banco de dados, respeitando as regras de negócio
    public function destroy(Fazenda $fazenda)
    {

        $hasAlocacao = DB::table('alocacoes')->where('fazenda_id', $fazenda->id)->exists();

        if ($hasAlocacao) {
            return redirect()->back()->with('error', 'Esta fazenda não pode ser excluída pois possui bovinos alocados nela. Desvincule-os primeiro.');
        }

        $fazenda->delete();

        return redirect()->back()->with('success', 'Fazenda excluída com sucesso!');
    }
}