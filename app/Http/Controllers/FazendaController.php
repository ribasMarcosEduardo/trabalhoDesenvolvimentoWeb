<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Fazenda;

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

        return redirect('/bovinos')->with('success', 'Fazenda cadastrada com sucesso!');
    }

    public function index() {
    $fazendas = Fazenda::withCount('bovinos')->get();
    return view('fazendas.index', compact('fazendas'));
}
}
