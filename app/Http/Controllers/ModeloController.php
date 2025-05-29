<?php

namespace App\Http\Controllers;

use App\Models\Modelo;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class ModeloController extends Controller
{
    use AuthorizesRequests;

    public function index()
    {
        $modelos = auth()->user()->modelos()->latest()->get();
        return view('modelos.index', compact('modelos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'titulo' => 'required|string|max:255',
            'conteudo' => 'required|string',
        ]);

        auth()->user()->modelos()->create($request->only('titulo', 'conteudo'));

        return redirect()
            ->back()
            ->withInput(['_action' => 'salvar'])
            ->with('success', 'Modelo criado com sucesso!');
    }

    public function update(Request $request, Modelo $modelo)
    {
        $this->authorize('update', $modelo);

        $request->validate([
            'titulo' => 'required|string|max:255',
            'conteudo' => 'required|string',
        ]);

        $modelo->update($request->only('titulo', 'conteudo'));

        return redirect()
            ->back()
            ->withInput(['_action' => 'salvar'])
            ->with('success', 'Modelo atualizado com sucesso!');
    }

    public function destroy(Modelo $modelo)
    {
        $this->authorize('delete', $modelo);
        $modelo->delete();

        return redirect()->back()->with('success', 'Modelo excluído com sucesso!');
    }

    /**
     * Retorna os placeholders dinâmicos do modelo selecionado
     */
    public function placeholders(Modelo $modelo)
    {
        $this->authorize('view', $modelo);

        // Extrai os placeholders com formato {{nome_placeholder}}
        preg_match_all('/\{\{\s*(.*?)\s*\}\}/', $modelo->conteudo, $matches);

        // Remove duplicados e organiza
        $placeholders = array_unique($matches[1]);

        return response()->json($placeholders);
    }
}
