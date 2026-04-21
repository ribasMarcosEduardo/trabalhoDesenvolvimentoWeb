<?php

namespace App\Http\Controllers;

use App\Models\Bovino;
use Illuminate\Http\Request;

class BovinoController extends Controller
{
    public function create()
    {
        return view('bovinos.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'raca'   => 'required|string|max:255',
            'peso'   => 'required|numeric|min:0',
            'preco'  => 'required|numeric|min:0',
            'idade'  => 'nullable|integer|min:0',
            'imagem' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:10240',
        ]);

        $path = null;

        if ($request->hasFile('imagem')) {
            $path = $request->file('imagem')->store('bovinos', 'public');
        }

        Bovino::create([
            'raca'   => $request->raca,
            'peso'   => $request->peso,
            'preco'  => $request->preco,
            'idade'  => $request->idade,
            'imagem' => $path,
        ]);

        return redirect()->back()->with('success', 'Bovino cadastrado com sucesso!');
    }

    public function index()
    {
        $bovinos = Bovino::all(); 
        return view('bovinos.index', compact('bovinos'));
    }
}