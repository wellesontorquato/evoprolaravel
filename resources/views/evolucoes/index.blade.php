@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">📝 Minhas Evoluções</h2>

    <div class="d-flex justify-content-between align-items-center mb-3">
        <a href="{{ route('evolucoes.create') }}" class="btn btn-evo-roxo">➕ Nova Evolução</a>
    </div>


    <!-- Filtros -->
    <form method="GET" action="{{ route('evolucoes.index') }}" class="row mb-4 g-2">
        <div class="col-md-4">
            <input type="text" name="paciente" class="form-control" placeholder="Buscar por paciente"
                   value="{{ request('paciente') }}">
        </div>
        <div class="col-md-4">
            <select name="periodo" class="form-select">
                <option value="">Todos os períodos</option>
                <option value="hoje" {{ request('periodo') == 'hoje' ? 'selected' : '' }}>Hoje</option>
                <option value="7dias" {{ request('periodo') == '7dias' ? 'selected' : '' }}>Últimos 7 dias</option>
                <option value="mes" {{ request('periodo') == 'mes' ? 'selected' : '' }}>Este mês</option>
            </select>
        </div>
        <div class="col-md-4">
            <button class="btn btn-primary w-100">Filtrar</button>
        </div>
    </form>

    <!-- Lista de Evoluções -->
    @forelse ($evolucoes as $evolucao)
        <div class="card mb-3">
            <div class="card-body">
                <h5 class="card-title d-flex justify-content-between align-items-center">
                    <span>Paciente: {{ $evolucao->paciente_nome }}</span>
                    @if ($evolucao->modelo_nome)
                        <span class="badge bg-light text-dark border">Modelo: {{ $evolucao->modelo_nome }}</span>
                    @endif
                </h5>
                <p class="text-muted mb-2">Criado em {{ $evolucao->created_at->format('d/m/Y H:i') }}</p>

                
                <div class="d-flex gap-2">
                <!-- Ver -->
                <button class="btn btn-outline-primary btn-sm" data-bs-toggle="modal"
                    data-bs-target="#modalEvolucao{{ $evolucao->id }}">Ver</button>

                <!-- Copiar -->
                <button class="btn btn-outline-success btn-sm"
                    onclick="copiarEvolucao('conteudo-{{ $evolucao->id }}')">Copiar</button>

                <!-- PDF -->
                <a href="{{ route('evolucoes.exportar.pdf.unico', $evolucao->id) }}" class="btn btn-outline-secondary btn-sm">
                    📄 Exportar PDF
                </a>

                <!-- Excluir -->
                <form method="POST" action="{{ route('evolucoes.destroy', $evolucao) }}" class="d-inline form-excluir-evolucao">
                    @csrf
                    @method('DELETE')
                    <button type="button" class="btn btn-outline-danger btn-sm btn-excluir-evolucao"
                        data-titulo="{{ $evolucao->paciente_nome }}">
                        🗑️ Excluir
                    </button>
                </form>
            </div>
        </div>

        <!-- Modal de Visualização -->
        <div class="modal fade" id="modalEvolucao{{ $evolucao->id }}" tabindex="-1">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Evolução de {{ $evolucao->paciente_nome }}</h5>
                        <button class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <pre class="mb-0" id="conteudo-{{ $evolucao->id }}" style="white-space: pre-wrap;">{{ $evolucao->conteudo }}</pre>
                    </div>
                </div>
            </div>
        </div>
    @empty
        <div class="alert alert-info">Nenhuma evolução registrada ainda.</div>
    @endforelse

    <!-- Paginação -->
    <div class="mt-4">
        {{ $evolucoes->links() }}
    </div>
</div>

<!-- Scripts -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/izitoast@1.4.0/dist/css/iziToast.min.css"/>
<script src="https://cdn.jsdelivr.net/npm/izitoast@1.4.0/dist/js/iziToast.min.js"></script>

<script>
        // Confirmação de exclusão para evoluções
    document.querySelectorAll('.btn-excluir-evolucao').forEach(botao => {
        botao.addEventListener('click', function (e) {
            e.preventDefault();
            const form = this.closest('form');
            const nomePaciente = this.dataset.titulo;

            iziToast.question({
                timeout: false,
                close: false,
                overlay: true,
                displayMode: 'once',
                title: 'Excluir evolução?',
                message: `Deseja excluir a evolução do paciente "<strong>${nomePaciente}</strong>"?`,
                position: 'center',
                backgroundColor: '#d4c6f0',
                theme: 'light',
                color: 'white',
                buttons: [
                    ['<button style="background:#fff;color:#6f42c1;"><b>Sim, excluir</b></button>', function (instance, toast) {
                        form.submit();
                        instance.hide({ transitionOut: 'fadeOut' }, toast, 'button');
                    }, true],
                    ['<button style="background:#eee;color:#333;">Cancelar</button>', function (instance, toast) {
                        instance.hide({ transitionOut: 'fadeOut' }, toast, 'button');
                    }]
                ]
            });
        });
    });

    function copiarEvolucao(id) {
        const texto = document.getElementById(id).innerText;
        navigator.clipboard.writeText(texto).then(() => {
            iziToast.success({
                title: 'Copiado',
                message: 'Evolução copiada para a área de transferência!',
                position: 'topCenter',
                backgroundColor: '#d4c6f0',
                theme: 'light',
                color: 'white'
            });
        });
    }

    document.addEventListener('DOMContentLoaded', function () {
        const action = localStorage.getItem('_last_evolucao_action');
        const success = {!! json_encode(session('success')) !!};

        if (action === 'salvar' && success) {
            iziToast.success({
                title: 'Sucesso',
                message: success,
                position: 'topCenter',
                timeout: 4000,
                backgroundColor: '#d4c6f0',
                theme: 'light',
                color: 'white'
            });
        }

        localStorage.removeItem('_last_evolucao_action');
    });

    // Marca ação como "salvar" ao submeter formulários de criação/edição
    document.querySelectorAll('form').forEach(form => {
        form.addEventListener('submit', function () {
            const hasAction = this.querySelector('input[name="_action"]');
            if (hasAction) {
                localStorage.setItem('_last_evolucao_action', 'salvar');
            }
        });
    });
</script>
<style>
    .btn-evo-roxo {
        background-color: #7743DB;
        color: white;
        border-color: #7743DB;
    }

    .btn-evo-roxo:hover {
        background-color: #6435c6;
        border-color: #6435c6;
        color: white;
    }
</style>
@endsection
