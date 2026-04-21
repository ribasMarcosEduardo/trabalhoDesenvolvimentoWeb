<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Alocacao;

class AlocacaoController extends Controller
{
    public function store(Request $request) 
    {
   
        $request->validate([
            'bovino_id' => 'required|exists:bovinos,id',
            'fazenda_id' => 'required|exists:fazendas,id',
            'data_entrada' => 'required|date'
        ]);

    
        \App\Models\Alocacao::create($request->all());

        return redirect()->route('bovinos.index')->with('success', 'Bovino alocado com sucesso!');
    }
}
