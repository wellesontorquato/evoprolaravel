<?php

namespace App\Http\Controllers;

use App\Models\Evolucao;
use App\Models\Modelo;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Services\ModeloEvolucaoService;
use App\Helpers\TextHelper;

class EvolucaoController extends Controller
{
    public function create(Request $request)
    {
        $modelos = auth()->user()->modelos()->latest()->get();
        $placeholders = [];

        if ($request->filled('modelo_fixo')) {
            $fixos = (new ModeloEvolucaoService())->getFixos();
            $conteudo = $fixos[$request->modelo_fixo] ?? '';
            preg_match_all('/{{(.*?)}}/', $conteudo, $matches);
            $placeholders = array_map('trim', $matches[1]);
        }

        if ($request->filled('modelo_id')) {
            $modelo = Modelo::find($request->modelo_id);
            if ($modelo) {
                preg_match_all('/{{(.*?)}}/', $modelo->conteudo, $matches);
                $placeholders = array_map('trim', $matches[1]);
            }
        }

        return view('evolucoes.create', compact('modelos', 'placeholders'));
    }

    public function store(Request $request, ModeloEvolucaoService $modeloService)
    {
        if (!$request->filled('modelo_id') && !$request->filled('modelo_fixo')) {
            return back()->withErrors(['modelo' => 'Você precisa selecionar um modelo fixo ou personalizado.']);
        }

        $request->validate([
            'paciente' => 'required|string|max:255',
            'modelo_id' => 'nullable|exists:modelos,id',
            'modelo_fixo' => 'nullable|string',
        ]);

        // Corrige o parentesco com base no gênero do acompanhante
        $parentescoCorrigido = TextHelper::ajustarParentesco(
            $request->parentesco,
            $request->sexo_acompanhante
        );

        // Calcula pronome possessivo do acompanhante (ex: seu / sua)
        $pronomeAcomp = TextHelper::obterPronomePosseAcompanhante($request->sexo_acompanhante ?? null);

        // Substituição dos placeholders
        $placeholders = [
            '{{paciente}}' => $request->paciente,
            '{{sexo_paciente}}' => $request->sexo_paciente,
            '{{acompanhante}}' => $request->acompanhante,
            '{{parentesco}}' => $parentescoCorrigido,
            '{{sexo_acompanhante}}' => $request->sexo_acompanhante,
            '{{estado_paciente}}' => $request->estado_paciente,
            '{{motivo_internacao}}' => $request->motivo_internacao,
            '{{com_quem_reside}}' => $request->com_quem_reside,
            '{{rede_apoio}}' => $request->rede_apoio,
            '{{fonte_renda}}' => $request->fonte_renda,
            '{{local_origem}}' => $request->local_origem,
            '{{gestacao}}' => $request->gestacao,
            '{{tipo_parto}}' => $request->tipo_parto,
            '{{sexo_rn}}' => $request->sexo_rn,
            '{{tipo_imovel}}' => $request->tipo_imovel,
            '{{estabilidade_renda}}' => $request->estabilidade_renda,
            '{{rede_acompanhantes}}' => $request->rede_acompanhantes,
            '{{pronome_acomp}}' => $pronomeAcomp,
            '{{data}}' => now()->format('d/m/Y'),
            '{{profissional}}' => auth()->user()->name,
            '{{cress}}' => auth()->user()->cress,
        ];

        $modelo_nome = null;
        $conteudo = '';

        if ($request->filled('modelo_id')) {
            $modelo = Modelo::findOrFail($request->modelo_id);
            $modelo_nome = $modelo->titulo;
            $conteudo = str_replace(array_keys($placeholders), array_values($placeholders), $modelo->conteudo);
        } elseif ($request->filled('modelo_fixo')) {
            $modelo_nome = strtoupper($request->modelo_fixo);
            $conteudo = $modeloService->gerarConteudo($request->modelo_fixo, $placeholders);
        }

        // Etapas de ajuste com base no gênero
        $conteudo = TextHelper::tratarGeneroPaciente($conteudo, $request->sexo_paciente);
        $conteudo = TextHelper::tratarGeneroAcompanhante($conteudo, $request->sexo_acompanhante);
        $conteudo = TextHelper::ajustarGenericosEntreParenteses($conteudo, $request->sexo_acompanhante);
        $conteudo = TextHelper::formatarTexto($conteudo);

        $evolucao = Evolucao::create([
            'user_id' => auth()->id(),
            'paciente_nome' => $request->paciente,
            'modelo_nome' => $modelo_nome,
            'conteudo' => $conteudo,
        ]);

        return redirect()->route('evolucoes.resultado', $evolucao->id);
    }

    public function index(Request $request)
    {
        $query = auth()->user()->evolucoes()->latest();

        if ($request->filled('paciente')) {
            $query->where('paciente_nome', 'like', '%' . $request->paciente . '%');
        }

        if ($request->filled('periodo')) {
            match ($request->periodo) {
                'hoje' => $query->whereDate('created_at', now()->toDateString()),
                '7dias' => $query->where('created_at', '>=', now()->subDays(7)),
                'mes' => $query->whereMonth('created_at', now()->month),
                default => null,
            };
        }

        $evolucoes = $query->paginate(10)->withQueryString();

        return view('evolucoes.index', compact('evolucoes'));
    }

    public function exportarPdf(Request $request)
    {
        $query = auth()->user()->evolucoes()->latest();

        if ($request->filled('paciente')) {
            $query->where('paciente_nome', 'like', '%' . $request->paciente . '%');
        }

        if ($request->filled('periodo')) {
            match ($request->periodo) {
                'hoje' => $query->whereDate('created_at', now()->toDateString()),
                '7dias' => $query->where('created_at', '>=', now()->subDays(7)),
                'mes' => $query->whereMonth('created_at', now()->month),
                default => null,
            };
        }

        $evolucoes = $query->get();

        $pdf = Pdf::loadView('evolucoes.exportar', compact('evolucoes'));

        return $pdf->download('evolucoes-filtradas.pdf');
    }

    public function exportarPdfUnico(Evolucao $evolucao)
    {
        if ($evolucao->user_id !== auth()->id()) {
            abort(403);
        }

        $pdf = Pdf::loadView('evolucoes.exportar_unico', compact('evolucao'));

        return $pdf->download('evolucao-' . $evolucao->id . '.pdf');
    }

    public function resultado($id)
    {
        $evolucao = Evolucao::where('id', $id)->where('user_id', auth()->id())->firstOrFail();
        return view('evolucoes.resultado', compact('evolucao'));
    }

    public function destroy(Evolucao $evolucao)
    {
        if ($evolucao->user_id !== auth()->id()) {
            abort(403);
        }

        $evolucao->delete();

        return redirect()
            ->route('evolucoes.index')
            ->with('success', 'Evolução excluída com sucesso!');
    }
}
