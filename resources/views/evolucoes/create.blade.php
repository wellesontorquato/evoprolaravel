@extends('layouts.app')

@section('content')
<div class="container py-4">
    <form action="{{ route('evolucoes.store') }}" method="POST" class="p-4 rounded-3 shadow-sm bg-white border">
        @csrf

        <!-- Sessão 1 -->
        <h5 class="fw-bold section-title mb-3">👩‍⚕️ Dados do Paciente</h5>
        <hr class="mb-3 mt-0 section-line">
        <div class="row mb-3">
            <div class="col-md-6">
                <label class="form-label field-label">Nome do Paciente</label>
                <input type="text" name="paciente" id="input_paciente" class="form-control input-purple" placeholder="Digite o nome do paciente">
            </div>
            <div class="col-md-3">
                <label class="form-label field-label">Sexo</label>
                <select name="sexo_paciente" id="input_sexo_paciente" class="form-select input-purple">
                    <option value="Feminino">Feminino</option>
                    <option value="Masculino">Masculino</option>
                </select>
            </div>

            <h5 class="fw-bold section-title mb-3">🧑‍🤝 Modelos de evolução</h5>
            <hr class="mb-3 mt-0 section-line">
            <div class="col-md-4">
                <label class="form-label field-label">Modelo Fixo</label>
                <select name="modelo_fixo" id="modelo_fixo" class="form-select input-purple" data-type="fixo">
                    <option value="">Selecionar modelo fixo</option>
                    @include('evolucoes.partials.modelos-fixos')
                </select>
            </div>
            <div class="col-md-3">
                <label class="form-label field-label">Modelo Personalizado</label>
                <select name="modelo_id" id="modelo_personalizado" class="form-select input-purple" data-type="personalizado">
                    <option value="">Selecionar modelo personalizado</option>
                    @foreach($modelos as $modelo)
                        <option value="{{ $modelo->id }}">{{ $modelo->titulo }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <!-- Sessão 2 -->
        <h5 class="fw-bold section-title mb-3">🧑‍🤝 Dados do Acompanhante</h5>
        <hr class="mb-3 mt-0 section-line">
        <div class="row mb-3">
            <div class="col-md-6">
                <label class="form-label field-label">Nome do Acompanhante</label>
                <input type="text" name="acompanhante" id="input_acompanhante" class="form-control input-purple" placeholder="Nome do acompanhante">
            </div>
            <div class="col-md-3">
                <label class="form-label field-label">Parentesco</label>
                <input type="text" name="parentesco" id="input_parentesco" class="form-control input-purple" placeholder="Parentesco">
            </div>
            <div class="col-md-3">
                <label class="form-label field-label">Sexo</label>
                <select name="sexo_acompanhante" id="input_sexo_acompanhante" class="form-select input-purple">
                    <option value="Feminino">Feminino</option>
                    <option value="Masculino">Masculino</option>
                </select>
            </div>
        </div>

        <!-- Sessão 3 -->
        <h5 class="fw-bold section-title mb-3">📋 Detalhes da Internação</h5>
        <hr class="mb-3 mt-0 section-line">
        <div class="row mb-3">
            <div class="col-md-6">
                <label class="form-label field-label">Estado do Paciente</label>
                <input type="text" name="estado_paciente" id="input_estado_paciente" class="form-control input-purple" placeholder="ex.: Lúcida, orientada, colaborativa">
            </div>
            <div class="col-md-6">
                <label class="form-label field-label">Motivo da Internação</label>
                <input type="text" name="motivo_internacao" id="input_motivo_internacao" class="form-control input-purple" placeholder="ex.: dores na nuca">
            </div>
        </div>

        <!-- Sessão 4 -->
        <h5 class="fw-bold section-title mb-3">🏡 Informações Adicionais</h5>
        <hr class="mb-3 mt-0 section-line">
        <div class="row mb-3">
            <div class="col-md-6">
                <label class="form-label field-label">Com quem Reside</label>
                <input type="text" name="com_quem_reside" id="input_com_quem_reside" class="form-control input-purple" placeholder="ex.: esposa e 2 filhos">
            </div>
            <div class="col-md-6">
                <label class="form-label field-label">Fonte de Renda</label>
                <input type="text" name="fonte_renda" id="input_fonte_renda" class="form-control input-purple" placeholder="ex.: aposentadoria">
            </div>
            <div class="col-md-6 mt-3">
                <label class="form-label field-label">Rede de Apoio</label>
                <input type="text" name="rede_apoio" id="input_rede_apoio" class="form-control input-purple" placeholder="ex.: mãe e irmã">
            </div>
            <div class="col-md-6 mt-3">
                <label class="form-label field-label">Local de Origem (se aplicável)</label>
                <input type="text" name="local_origem" id="input_local_origem" class="form-control input-purple" placeholder="ex.: UPA Benedito Bentes">
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

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const modeloFixoSelect = document.getElementById('modelo_fixo');
        const modeloPersonalizadoSelect = document.getElementById('modelo_personalizado');

        const inputs = [
            'paciente', 'sexo_paciente', 'estado_paciente', 'motivo_internacao',
            'acompanhante', 'sexo_acompanhante', 'parentesco',
            'com_quem_reside', 'rede_apoio', 'fonte_renda', 'local_origem'
        ];

        function setDisabledInputs(placeholders = []) {
            inputs.forEach(name => {
                const el = document.getElementById('input_' + name);
                if (el) {
                    el.disabled = !placeholders.includes(name);
                    if (el.disabled) el.value = '';
                }
            });
        }

        async function getPlaceholders(tipo, valor) {
            if (!valor) return [];

            const url = tipo === 'fixo'
                ? `/api/modelos-fixos/${valor}/placeholders`
                : `/api/modelos-personalizados/${valor}/placeholders`;

            try {
                const response = await fetch(url);
                if (!response.ok) throw new Error('Erro na requisição');

                const data = await response.json();
                return data.placeholders || [];
            } catch (e) {
                console.error('Erro ao buscar placeholders:', e);
                return [];
            }
        }

        async function atualizarCampos(tipo, valor) {
            const placeholders = await getPlaceholders(tipo, valor);
            setDisabledInputs(placeholders);
        }

        modeloFixoSelect.addEventListener('change', function () {
            modeloPersonalizadoSelect.value = '';
            atualizarCampos('fixo', this.value);
        });

        modeloPersonalizadoSelect.addEventListener('change', function () {
            modeloFixoSelect.value = '';
            atualizarCampos('personalizado', this.value);
        });

        setDisabledInputs([]); // desativa todos inicialmente
    });
</script>
@endpush

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
    }
    .section-line { border-top: 2px solid #7b689e !important; }
    .section-title { color: #7b689e !important; }
    .field-label { color: #4f3372; font-weight: 500; }
</style>
@endsection
