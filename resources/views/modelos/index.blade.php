@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">📄 Meus Modelos</h2>
   
    <button class="btn btn-evo-roxo mb-4" data-bs-toggle="modal" data-bs-target="#modalNovoModelo">
        ➕ Novo Modelo
    </button>

    <button class="btn btn-evo-outline mb-4 ms-2" data-bs-toggle="modal" data-bs-target="#modalAjudaModelo">
        ❓ Como criar um modelo corretamente
    </button>

    @php
        $placeholders = [
            'paciente' => 'Nome do paciente',
            'estado_paciente' => 'Estado clínico do paciente',
            'motivo_internacao' => 'Motivo da internação',
            'acompanhante' => 'Nome do acompanhante',
            'parentesco' => 'Parentesco com o paciente',
            'com_quem_reside' => 'Com quem reside',
            'rede_apoio' => 'Rede de apoio',
            'fonte_renda' => 'Fonte de renda',
            'local_origem' => 'Local de origem',
            'data' => 'Data da evolução',
            'profissional' => 'Profissional logado',
            'cress' => 'Número do CRESS'
        ];
    @endphp

    @forelse($modelos as $modelo)
        <div class="card mb-2">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <strong>{{ $modelo->titulo }}</strong>
                    <p class="mb-0 text-muted small">{{ $modelo->created_at->format('d/m/Y H:i') }}</p>
                </div>
                <div>
                    <button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal"
                        data-bs-target="#modalEditarModelo{{ $modelo->id }}">Editar</button>

                    <form action="{{ route('modelos.destroy', $modelo) }}" method="POST" class="d-inline form-excluir-modelo">
                        @csrf @method('DELETE')
                        <button class="btn btn-sm btn-outline-danger btn-excluir" data-titulo="{{ $modelo->titulo }}">
                            Excluir
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Modal Editar -->
        <div class="modal fade" id="modalEditarModelo{{ $modelo->id }}" tabindex="-1">
            <div class="modal-dialog modal-xl">
                <form method="POST" action="{{ route('modelos.update', $modelo) }}" class="form-modelo">
                    @csrf @method('PUT')
                    <input type="hidden" name="_action" value="salvar">
                    <div class="modal-content" style="height: 85vh; display: flex; flex-direction: column;">
                        <div class="modal-header">
                            <h5 class="modal-title">Editar Modelo</h5>
                            <button class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body" style="flex: 1; overflow-y: auto;">
                            <input type="text" name="titulo" class="form-control mb-3"
                                value="{{ $modelo->titulo }}" required placeholder="Título do modelo">

                            <label for="conteudo{{ $modelo->id }}">Conteúdo do Modelo</label>
                            <textarea name="conteudo" id="conteudo{{ $modelo->id }}" class="form-control mb-3" rows="12" required>{{ $modelo->conteudo }}</textarea>

                            <div class="alert alert-success border p-3 small">
                                <strong>Campos dinâmicos disponíveis (clique para inserir):</strong>
                                <x-placeholder-list :placeholders="$placeholders" :targetTextareaId="'conteudo' . $modelo->id" />
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                            <button class="btn btn-primary">Salvar Alterações</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    @empty
        <div class="alert alert-warning">Nenhum modelo cadastrado ainda.</div>
    @endforelse

<!-- Modal Novo -->
<div class="modal fade" id="modalNovoModelo" tabindex="-1">
    <div class="modal-dialog modal-xl">
        <form method="POST" action="{{ route('modelos.store') }}" class="form-modelo">
            @csrf
            <input type="hidden" name="_action" value="salvar">
            <div class="modal-content" style="height: 85vh; display: flex; flex-direction: column;">
                <div class="modal-header">
                    <h5 class="modal-title">Novo Modelo</h5>
                    <button class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body" style="flex: 1; overflow-y: auto;">
                    <input type="text" name="titulo" class="form-control mb-3" placeholder="Título do modelo" required>

                    <label for="conteudo">Conteúdo do Modelo</label>
                    <textarea name="conteudo" id="conteudo" class="form-control mb-3" rows="10"
                        placeholder="Escreva aqui o conteúdo da evolução usando campos como @{{paciente}}, @{{data}}, etc."
                        required></textarea>

                    <div class="alert alert-success border p-3 small">
                        <strong>Campos dinâmicos disponíveis (clique para inserir):</strong>
                        <x-placeholder-list :placeholders="$placeholders" targetTextareaId="conteudo" />
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button class="btn btn-success">Criar Modelo</button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Modal de Ajuda -->
<div class="modal fade" id="modalAjudaModelo" tabindex="-1">
    <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">📘 Ajuda para criar um modelo</h5>
                <button class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body px-4 py-3">
                <h5 class="mb-3">🧠 Exemplo de modelo</h5>
                <pre class="bg-light p-3 rounded small mb-4" style="line-height: 1.8;">
Paciente <span class="text-danger">@{{paciente}}</span>, encontra-se em <span class="text-danger">@{{estado_paciente}}</span> e recebeu alta hospitalar nesta data, após internação motivada por <span class="text-danger">@{{motivo_internacao}}</span>.

O(a) acompanhante é <span class="text-danger">@{{acompanhante}}</span>, com vínculo de <span class="text-danger">@{{parentesco}}</span>. Relata-se que reside com <span class="text-danger">@{{com_quem_reside}}</span>, com rede de apoio composta por <span class="text-danger">@{{rede_apoio}}</span>. Fonte de renda: <span class="text-danger">@{{fonte_renda}}</span>. Admissão via <span class="text-danger">@{{local_origem}}</span>.

Atendimento por <span class="text-danger">@{{profissional}}</span> – Assistente Social  
CRESS <span class="text-danger">@{{cress}}</span> – <span class="text-danger">@{{data}}</span>
</pre>


                <h5 class="mb-3">🔧 O que será ajustado automaticamente:</h5>
                <ul class="small" style="line-height: 1.6">
                    <li>📌 Substituição de todos os <code>@{{placeholders}}</code> por valores reais informados</li>
                    <li>📘 Concordância de gênero com base no sexo:
                        <ul class="ms-3">
                            <li><code>O(a)</code> → <strong>O</strong> ou <strong>A</strong></li>
                            <li><code>do(a)</code> → <strong>do</strong> ou <strong>da</strong></li>
                            <li><code>orientado(a)</code>, <code>acompanhado(a)</code> etc.</li>
                        </ul>
                    </li>
                    <li>🧠 Tratamento semântico automático via <strong class="text-danger">EvoPlus</strong>:
                        <ul class="ms-3">
                            <li>Paciente: “O(a) paciente”, “do(a) paciente”, “encontrado(a)”, “transferido(a)”...</li>
                            <li>Acompanhante: “seu(sua) acompanhante”, “ao(à) acompanhante”</li>
                        </ul>
                    </li>
                    <li>🪄 Ajustes como “orientado(a)” → “orientada” se gênero for feminino</li>
                    <li>🧹 Capitalização automática e pontuação ao final do texto</li>
                </ul>
            </div>
            <div class="modal-footer px-4">
                <button class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>

<!-- Scripts -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/izitoast@1.4.0/dist/css/iziToast.min.css"/>
<script src="https://cdn.jsdelivr.net/npm/izitoast@1.4.0/dist/js/iziToast.min.js"></script>

<script>
    function inserirPlaceholder(idTextarea, texto) {
        const textarea = document.getElementById(idTextarea);
        if (!textarea) return;
        const start = textarea.selectionStart;
        const end = textarea.selectionEnd;
        const before = textarea.value.substring(0, start);
        const after = textarea.value.substring(end);
        const espacamento = ' ' + texto + ' ';
        textarea.value = before + espacamento + after;
        textarea.focus();
        textarea.selectionEnd = start + espacamento.length;
    }

    document.addEventListener('DOMContentLoaded', function () {
        const action = localStorage.getItem('_last_modelo_action');
        const success = {!! json_encode(session('success')) !!};

        if (action === 'salvar' && success) {
            iziToast.show({
                title: 'Sucesso',
                message: success,
                position: 'topCenter',
                timeout: 4000,
                backgroundColor: '#d4c6f0',
                theme: 'light',
                color: 'white'
            });
        }

        localStorage.removeItem('_last_modelo_action');

        // Detectar alteração real no formulário
        document.querySelectorAll('.form-modelo').forEach(form => {
            let changed = false;

            form.querySelectorAll('input[type="text"], textarea').forEach(el => {
                el.addEventListener('input', () => changed = true);
            });

            form.addEventListener('submit', function () {
                const actionInput = this.querySelector('input[name="_action"]');
                if (actionInput && actionInput.value === 'salvar' && changed) {
                    localStorage.setItem('_last_modelo_action', 'salvar');
                } else {
                    localStorage.removeItem('_last_modelo_action');
                }
            });
        });

        // Confirmação de exclusão
        document.querySelectorAll('.btn-excluir').forEach(botao => {
            botao.addEventListener('click', function (e) {
                e.preventDefault();
                const form = this.closest('form');
                const titulo = this.dataset.titulo;

                iziToast.question({
                    timeout: false,
                    close: false,
                    overlay: true,
                    displayMode: 'once',
                    title: 'Confirmar exclusão?',
                    message: `Deseja excluir o modelo "<strong>${titulo}</strong>"?`,
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

.btn-evo-outline {
    border-color: #7743DB;
    color: #7743DB;
    background-color: white;
}

.btn-evo-outline:hover {
    background-color: #7743DB;
    color: white;
}
</style>
@endsection
