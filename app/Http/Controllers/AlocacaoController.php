<?php

namespace App\Http\Controllers;

use App\Models\Bovino;
use App\Models\Fazenda;
use App\Models\Alocacao;
use Illuminate\Http\Request;

class AlocacaoController extends Controller
{
    public static function getBovinosDisponiveis() {
        return \App\Models\Bovino::whereDoesntHave('alocacoes')->get();
    }

    public static function getBovinosDaFazenda($fazenda_id) {
        return Bovino::whereHas('alocacoes', function($query) use ($fazenda_id) {
            $query->where('fazenda_id', $fazenda_id);
        })->get();
    }

    // Vincula o bovino na fazenda
    public function storeVincular(Request $request, $fazenda_id) {

        $quantidadeAtual = Alocacao::where('fazenda_id', $fazenda_id)->count();

        if ($quantidadeAtual >= 5) {
            return redirect('/fazendas')->with('error', 'Capacidade máxima atingida! Esta fazenda já possui 5 bovinos.');
        }

        Alocacao::create([
            'fazenda_id' => $fazenda_id,
            'bovino_id' => $request->bovino_id,
            'data_entrada' => now()
        ]);
        
        return redirect('/fazendas')->with('success', 'Bovino vinculado com sucesso!');
    }

    // Remove o vínculo
    public function destroyDesvincular($fazenda_id, $bovino_id) {
        Alocacao::where('fazenda_id', $fazenda_id)
                ->where('bovino_id', $bovino_id)
                ->delete();
                
        return redirect('/fazendas')->with('success', 'Bovino removido da fazenda!');
    }
}