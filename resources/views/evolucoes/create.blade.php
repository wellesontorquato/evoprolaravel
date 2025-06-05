@extends('layouts.app')

@section('content')
<div class="container py-4">
    {{-- Formulário de seleção de modelo --}}
    <div class="p-4 rounded-3 shadow-sm bg-white border mb-4">
        <h5 class="fw-bold section-title mb-3">🧑‍⚕️ Escolha o Modelo de Evolução</h5>
        <hr class="mb-3 mt-0 section-line">
        <div class="row mb-3">
            <div class="col-md-5">
                <label class="form-label field-label">Modelo Fixo</label>
                <select name="modelo_fixo" id="select_modelo_fixo" class="form-select input-purple">
                    <option value="">Selecionar modelo fixo</option>
                    @include('evolucoes.partials.modelos-fixos')
                </select>
            </div>
            <div class="col-md-5">
                <label class="form-label field-label">Modelo Personalizado</label>
                <select id="select_modelo_id" class="form-select input-purple">
                    <option value="">Selecionar modelo personalizado</option>
                    @foreach($modelos as $modelo)
                        <option value="{{ $modelo->id }}">{{ $modelo->titulo }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>

    {{-- Formulário dinâmico --}}
    <form id="form-dinamico" action="{{ route('evolucoes.store') }}" method="POST" class="p-4 rounded-3 shadow-sm bg-white border transition-section" style="max-height: 0; overflow: hidden;">
        @csrf
        <input type="hidden" name="modelo_id" id="input_modelo_id">
        <input type="hidden" name="modelo_fixo" id="input_modelo_fixo">

        {{-- Paciente --}}
        <div class="dynamic-section d-none" data-placeholder="paciente">
            <h5 class="fw-bold section-title mb-3">👩‍⚕️ Dados do Paciente</h5>
            <hr class="mb-3 mt-0 section-line">
            <div class="row mb-3">
                <div class="col-md-6">
                    <label class="form-label field-label">Nome do Paciente</label>
                    <input type="text" name="paciente" class="form-control input-purple" placeholder="Ex: Maria dos Santos">
                </div>
                <div class="col-md-3">
                    <label class="form-label field-label">Sexo</label>
                    <select name="sexo_paciente" class="form-select input-purple">
                        <option value="">Selecione</option>
                        <option value="Feminino">Feminino</option>
                        <option value="Masculino">Masculino</option>
                    </select>
                </div>
            </div>
        </div>


        {{-- Acompanhante --}}
        <div class="dynamic-section d-none" data-placeholder="acompanhante">
            <h5 class="fw-bold section-title mb-3">🧑‍🤝 Dados do Acompanhante</h5>
            <hr class="mb-3 mt-0 section-line">
            <div class="row mb-3">
                <div class="col-md-6">
                    <label class="form-label field-label">Nome do Acompanhante</label>
                    <input type="text" name="acompanhante" class="form-control input-purple" placeholder="Ex: João da Silva">
                </div>
                <div class="col-md-3">
                    <label class="form-label field-label">Parentesco</label>
                    <input type="text" name="parentesco" class="form-control input-purple" placeholder="Ex: Mãe, Irmão, Esposa...">
                </div>
                <div class="col-md-3">
                    <label class="form-label field-label">Sexo</label>
                    <select name="sexo_acompanhante" class="form-select input-purple">
                        <option value="">Selecione</option>
                        <option value="Feminino">Feminino</option>
                        <option value="Masculino">Masculino</option>
                    </select>
                </div>
            </div>
        </div>

        {{-- Internação --}}
        <div class="dynamic-section d-none" data-placeholder="estado_paciente">
            <h5 class="fw-bold section-title mb-3">📋 Detalhes da Internação</h5>
            <hr class="mb-3 mt-0 section-line">
            <div class="row mb-3">
                <div class="col-md-6">
                    <label class="form-label field-label">Estado do Paciente</label>
                    <input type="text" name="estado_paciente" class="form-control input-purple" placeholder="Ex: lúcido, orientado, sonolento...">
                </div>
                <div class="col-md-6">
                    <label class="form-label field-label">Motivo da Internação</label>
                    <input type="text" name="motivo_internacao" class="form-control input-purple" placeholder="Ex: queda, AVC, crise convulsiva...">
                </div>
            </div>
        </div>

        {{-- 🏡 Habitação, Renda e Apoio --}}
        <div class="dynamic-section d-none" data-placeholder="com_quem_reside">
            <h5 class="fw-bold section-title mb-3">🏡 Habitação, Renda e Apoio</h5>
            <hr class="mb-3 mt-0 section-line">
            <div class="row mb-3">
                <div class="col-md-6">
                    <label class="form-label field-label">Com quem Reside</label>
                    <input type="text" name="com_quem_reside" class="form-control input-purple" placeholder="Ex: esposo, filhos, sozinho...">
                </div>
                <div class="col-md-6">
                    <label class="form-label field-label">Fonte de Renda</label>
                    <input type="text" name="fonte_renda" class="form-control input-purple" placeholder="Ex: aposentadoria, auxílio, salário mínimo...">
                </div>
                <div class="col-md-6 mt-3">
                    <label class="form-label field-label">Estabilidade da Renda</label>
                    <input type="text" name="estabilidade_renda" class="form-control input-purple" placeholder="Ex: estável, instável, variável...">
                </div>
                <div class="col-md-6 mt-3">
                    <label class="form-label field-label">Rede de Apoio</label>
                    <input type="text" name="rede_apoio" class="form-control input-purple" placeholder="Ex: filha, neto, vizinhos...">
                </div>
                <div class="col-md-6 mt-3">
                    <label class="form-label field-label">Rede de Acompanhantes</label>
                    <input type="text" name="rede_acompanhantes" class="form-control input-purple" placeholder="Ex: filhas, esposo, irmãos...">
                </div>
                <div class="col-md-6 mt-3">
                    <label class="form-label field-label">Tipo de Imóvel</label>
                    <input type="text" name="tipo_imovel" class="form-control input-purple" placeholder="Ex: próprio, alugado, cedido...">
                </div>
            </div>
        </div>

        {{-- 🌍 Local de Origem --}}
        <div class="dynamic-section d-none" data-placeholder="local_origem">
            <h5 class="fw-bold section-title mb-3">🌍 Local de Origem</h5>
            <hr class="mb-3 mt-0 section-line">
            <div class="row mb-3">
                <div class="col-md-6">
                    <label class="form-label field-label">Local de Origem</label>
                    <input type="text" name="local_origem" class="form-control input-purple" placeholder="Ex: UPA Benedito Bentes, hospital de referência...">
                </div>
            </div>
        </div>

        {{-- 🤰 Dados Obstétricos --}}
        <div class="dynamic-section d-none" data-placeholder="gestacao">
            <h5 class="fw-bold section-title mb-3">🤰 Dados Obstétricos</h5>
            <hr class="mb-3 mt-0 section-line">
            <div class="row mb-3">
                <div class="col-md-4">
                    <label class="form-label field-label">Número da Gestação</label>
                    <input type="text" name="gestacao" class="form-control input-purple" placeholder="Ex: primeira, segunda, terceira...">
                </div>
                <div class="col-md-4">
                    <label class="form-label field-label">Tipo de Parto</label>
                    <input type="text" name="tipo_parto" class="form-control input-purple" placeholder="Ex: normal, cesáreo...">
                </div>
                <div class="col-md-4">
                    <label class="form-label field-label">Sexo do Recém-Nascido</label>
                    <select name="sexo_rn" class="form-select input-purple">
                        <option value="">Selecione</option>
                        <option value="Feminino">Feminino</option>
                        <option value="Masculino">Masculino</option>
                    </select>
                </div>
            </div>
        </div>

        <!-- Botão -->
        <div class="text-center mt-4">
            <button type="submit" class="btn btn-lg btn-purple px-5">
                ✨ Gerar Evolução ✍️
            </button>
        </div>
    </form>
</div>

{{-- Estilos --}}
<style>
    .text-purple { color: #7743DB; }
    .btn-purple {
        background: #7743DB;
        color: #fff;
        border: none;
        border-radius: 8px;
    }
    .btn-purple:hover {
        background: #5e34b2;
        color: #fff;
    }
    .input-purple {
        background-color: #F8F8FA;
        border: 1px solid #ddd;
        border-radius: 8px;
        transition: background-color 0.3s ease;
    }
    .section-line { border-top: 2px solid #7b689e !important; }
    .section-title { color: #7b689e !important; }
    .field-label { color: #4f3372; font-weight: 500; }

    .transition-section {
        transition: max-height 0.6s ease-in-out;
        overflow: hidden;
    }

    .input-disabled {
        background-color: #f0f0f0 !important;
        cursor: not-allowed;
        opacity: 0.6;
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const selectPersonalizado = document.getElementById('select_modelo_id');
    const selectFixo = document.getElementById('select_modelo_fixo');
    const form = document.getElementById('form-dinamico');

    const placeholdersFixos = {
        acolhimento_social: ['paciente', 'acompanhante', 'parentesco', 'estado_paciente', 'motivo_internacao', 'com_quem_reside', 'fonte_renda', 'rede_apoio', 'sexo_paciente', 'sexo_acompanhante'],
        situacao_economica: ['paciente', 'acompanhante', 'parentesco', 'estado_paciente', 'local_origem', 'motivo_internacao', 'com_quem_reside', 'fonte_renda', 'rede_apoio', 'sexo_paciente', 'sexo_acompanhante'],
        planejamento_de_intervencoes: ['paciente', 'acompanhante', 'parentesco', 'estado_paciente', 'motivo_internacao', 'com_quem_reside', 'rede_apoio', 'fonte_renda', 'sexo_paciente', 'sexo_acompanhante'],
        alta_hospitalar: ['paciente', 'data', 'motivo_internacao', 'estado_paciente', 'rede_apoio', 'com_quem_reside', 'fonte_renda', 'sexo_paciente', 'sexo_acompanhante'],
        encaminhamento_social: ['paciente', 'local_origem', 'rede_apoio', 'fonte_renda', 'com_quem_reside', 'estado_paciente', 'sexo_paciente', 'sexo_acompanhante'],
        visita_domiciliar: ['paciente', 'data', 'acompanhante', 'parentesco', 'estado_paciente', 'com_quem_reside', 'fonte_renda', 'rede_apoio', 'sexo_paciente', 'sexo_acompanhante'],
        internacao_psiquiatrica: ['paciente', 'local_origem', 'motivo_internacao', 'estado_paciente', 'acompanhante', 'parentesco', 'com_quem_reside', 'rede_apoio', 'sexo_paciente', 'sexo_acompanhante'],
        avaliacao_socioeconomica: ['paciente', 'com_quem_reside', 'fonte_renda', 'estado_paciente', 'rede_apoio', 'acompanhante', 'parentesco', 'data', 'sexo_paciente', 'sexo_acompanhante'],
        parecer_beneficio: ['paciente', 'com_quem_reside', 'fonte_renda', 'estado_paciente', 'rede_apoio', 'sexo_paciente', 'sexo_acompanhante'],
        acolhimento_obstetrico: ['paciente', 'acompanhante', 'parentesco', 'gestacao', 'tipo_parto', 'sexo_rn', 'com_quem_reside', 'fonte_renda', 'sexo_paciente', 'sexo_acompanhante'],
        avaliacao_leito: ['paciente', 'acompanhante', 'parentesco', 'estado_paciente', 'com_quem_reside', 'fonte_renda', 'rede_apoio', 'tipo_imovel', 'estabilidade_renda', 'rede_acompanhantes', 'sexo_paciente', 'sexo_acompanhante'],
    };

    function exibirCampos(placeholders) {
        form.style.maxHeight = '2000px';
        form.scrollIntoView({ behavior: 'smooth' });

        const sections = document.querySelectorAll('.dynamic-section');

        sections.forEach(section => {
            const campos = section.querySelectorAll('input[name], textarea[name], select[name]');
            let algumCampoValido = false;

            campos.forEach(campo => {
                const nome = campo.name?.replace(/\[\]$/, '');
                const valido = placeholders.includes(nome);

                if (valido) {
                    campo.removeAttribute('readonly');
                    campo.removeAttribute('disabled');
                    campo.classList.remove('input-disabled');
                    algumCampoValido = true;
                } else {
                    campo.setAttribute('readonly', 'readonly');
                    if (campo.tagName === 'SELECT') {
                        campo.setAttribute('disabled', 'disabled');
                    }
                    campo.classList.add('input-disabled');
                }
            });

            if (algumCampoValido) {
                section.classList.remove('d-none');
            } else {
                section.classList.add('d-none');
            }
        });
    }

    if (selectPersonalizado) {
        selectPersonalizado.addEventListener('change', function () {
            const modeloId = this.value;
            if (!modeloId) return;

            if (selectFixo) selectFixo.value = '';
            document.getElementById('input_modelo_fixo').value = '';

            fetch(`/modelo/${modeloId}/placeholders`)
                .then(response => {
                    if (!response.ok) throw new Error('Erro ao carregar placeholders');
                    return response.json();
                })
                .then(placeholders => {
                    document.getElementById('input_modelo_id').value = modeloId;
                    exibirCampos(placeholders);
                })
                .catch(error => {
                    console.error('Erro ao buscar placeholders do modelo personalizado:', error);
                    alert('Erro ao buscar placeholders do modelo personalizado.');
                });
        });
    }

    if (selectFixo) {
        selectFixo.addEventListener('change', function () {
            const modeloFixo = this.value;
            if (!modeloFixo) return;

            if (selectPersonalizado) selectPersonalizado.value = '';
            document.getElementById('input_modelo_id').value = '';
            document.getElementById('input_modelo_fixo').value = modeloFixo;

            const placeholders = placeholdersFixos[modeloFixo] || [];
            exibirCampos(placeholders);
        });
    }
});
</script>
@endsection

