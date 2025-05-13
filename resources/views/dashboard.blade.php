@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h2 class="text-2xl font-semibold text-purple-700 mb-6">📊 Meu Painel</h2>

    <!-- Mensagem de boas-vindas -->
    <div class="mb-4 p-4 bg-purple-50 border border-purple-200 rounded-xl shadow">
        <p class="text-lg">👋 Olá, <strong>{{ auth()->user()->name }}</strong>!</p>
        <p class="text-sm text-gray-600">Use seus modelos personalizados para gerar evoluções completas com poucos cliques.</p>
    </div>

    <!-- Cards Resumo -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
        <div class="p-4 bg-white border border-purple-200 rounded-xl shadow text-center">
            <h3 class="text-purple-700 text-xl font-bold">📌 {{ $totalModelos }}</h3>
            <p class="text-sm text-gray-500">Modelos Cadastrados</p>
        </div>
        <div class="p-4 bg-white border border-purple-200 rounded-xl shadow text-center">
            <h3 class="text-purple-700 text-xl font-bold">🧾 {{ $totalEvolucoes }}</h3>
            <p class="text-sm text-gray-500">Evoluções Geradas</p>
        </div>
        <div class="p-4 bg-white border border-purple-200 rounded-xl shadow text-center">
            <h3 class="text-purple-700 text-xl font-bold">🕓 {{ $ultimaEvolucao?->created_at->format('d/m/Y H:i') ?? '—' }}</h3>
            <p class="text-sm text-gray-500">Última Evolução</p>
        </div>
    </div>

    <!-- Ranking de Modelos Mais Usados -->
    <div class="bg-white p-4 border border-purple-200 rounded-xl shadow mb-6">
        <h4 class="text-purple-700 font-semibold mb-2">🏆 Modelos Mais Usados</h4>
        <ul class="list-disc pl-5 text-sm text-gray-700">
            @forelse ($rankingModelos as $modelo)
                <li>{{ $modelo->titulo }} ({{ $modelo->uso_total }} usos)</li>
            @empty
                <li>Nenhum modelo utilizado ainda.</li>
            @endforelse
        </ul>
    </div>

    <!-- Atalhos Rápidos -->
    <div class="flex flex-wrap gap-3">
        <a href="{{ route('modelos.index') }}" class="btn btn-evo-roxo">➕ Novo Modelo</a>
        <a href="{{ route('evolucoes.create') }}" class="btn btn-evo-roxo">✏️ Gerar Evolução</a>
        <a href="{{ route('evolucoes.index') }}" class="btn btn-evo-roxo">📄 Ver Evoluções</a>
    </div>
</div>
@endsection
