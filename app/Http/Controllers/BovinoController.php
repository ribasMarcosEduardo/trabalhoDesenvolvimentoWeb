<?php

namespace App\Http\Controllers;

use App\Models\Bovino;
use Illuminate\Http\Request;
use App\Models\Alocacao;
use Illuminate\Support\Facades\Storage;

class BovinoController extends Controller
{
    // Exibe o formulário de cadastro de um novo bovino.
    public function create()
    {
        return view('bovinos.create');
    }

    //Valida os dados e salva um novo bovino no banco de dados.
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

    // lista todos os bovinos cadastrados no sistema.
    public function index()
    {
        $bovinos = Bovino::all(); 
        return view('bovinos.index', compact('bovinos'));
    }

    // Exibe o formulário de edição para um bovino específico.
    public function edit(Bovino $bovino)
    {
        return view('bovinos.edit', compact('bovino'));
    }

    // Valida e atualiza os dados de um bovino existente, gerenciando a troca de imagens.
    public function update(Request $request, Bovino $bovino)
    {
        $request->validate([
            'raca'   => 'required|string|max:255',
            'peso'   => 'required|numeric|min:0',
            'preco'  => 'required|numeric|min:0',
            'idade'  => 'nullable|integer|min:0',
            'imagem' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:10240',
        ]);

        $path = $bovino->imagem;

        if ($request->hasFile('imagem')) {

            if ($bovino->imagem && Storage::disk('public')->exists($bovino->imagem)) {
                Storage::disk('public')->delete($bovino->imagem);
            }
            $path = $request->file('imagem')->store('bovinos', 'public');
        }

        $bovino->update([
            'raca'   => $request->raca,
            'peso'   => $request->peso,
            'preco'  => $request->preco,
            'idade'  => $request->idade,
            'imagem' => $path,
        ]);

        return redirect('/bovinos')->with('success', 'Bovino atualizado com sucesso!');
    }

    // Exclui um bovino do sistema, desde que não esteja vinculado a nenhuma fazenda.
    public function destroy(Bovino $bovino)
    {
        $hasAlocacao = Alocacao::where('bovino_id', $bovino->id)->exists();

        if ($hasAlocacao) {
            return redirect()->back()->with('error', 'Este bovino não pode ser excluído pois está vinculado a uma fazenda (alocação).');
        }

        if ($bovino->imagem && Storage::disk('public')->exists($bovino->imagem)) {
            Storage::disk('public')->delete($bovino->imagem);
        }

        $bovino->delete();

        return redirect()->back()->with('success', 'Bovino excluído com sucesso!');
    }

}