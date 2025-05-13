<?php

namespace App\Http\Controllers;

use App\Models\Modelo;
use App\Models\Evolucao;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        $totalModelos = $user->modelos()->count();
        $totalEvolucoes = $user->evolucoes()->count();
        $ultimaEvolucao = $user->evolucoes()->latest()->first();

        // Agrupa por modelo_nome e conta quantas vezes foi usado
        $rankingModelos = Evolucao::where('user_id', $user->id)
            ->select('modelo_nome', DB::raw('count(*) as uso_total'))
            ->whereNotNull('modelo_nome')
            ->groupBy('modelo_nome')
            ->orderByDesc('uso_total')
            ->limit(5)
            ->get()
            ->map(function ($item) {
                return (object)[
                    'titulo' => $item->modelo_nome,
                    'uso_total' => $item->uso_total
                ];
            });

        return view('dashboard', compact(
            'totalModelos',
            'totalEvolucoes',
            'ultimaEvolucao',
            'rankingModelos'
        ));
    }
}
