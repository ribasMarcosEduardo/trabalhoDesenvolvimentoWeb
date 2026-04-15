<?php

namespace App\Http\Controllers;

use App\Models\Bovino;
use Illuminate\Http\Request;

class BovinoController extends Controller
{
    // Abre formulário
    public function create()
    {
        return view('bovinos.create');
    }

    // Salva no banco
    public function store(Request $request)
{
    $request->validate([
        'raca' => 'required',
        'peso' => 'required|numeric',
        'age'  => 'nullable|integer',
        'imagem' => 'nullable|image'
    ]);

    $data = $request->all();

    if ($request->hasFile('imagem')) {
        $path = $request->file('imagem')->store('bovinos', 'public');
        $data['imagem'] = $path;
    }

    Bovino::create($data);

    return redirect()->back()->with('success', 'Bovino cadastrado com sucesso!');
}
}