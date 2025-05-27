@extends('layouts.app')

@section('content')
<div class="container py-4">
    <form action="{{ route('evolucoes.create') }}" method="GET" class="p-4 rounded-3 shadow-sm bg-white border mb-4">
        <h5 class="fw-bold section-title mb-3">🧑‍⚕️ Escolha o Modelo de Evolução</h5>
        <hr class="mb-3 mt-0 section-line">
        <div class="row mb-3">
            <div class="col-md-5">
                <label class="form-label field-label">Modelo Fixo</label>
                <select name="modelo_fixo" class="form-select input-purple" onchange="this.form.submit()">
                    <option value="">Selecionar modelo fixo</option>
                    @include('evolucoes.partials.modelos-fixos')
                </select>
            </div>
            <div class="col-md-5">
                <label class="form-label field-label">Modelo Personalizado</label>
                <select name="modelo_id" class="form-select input-purple" onchange="this.form.submit()">
                    <option value="">Selecionar modelo personalizado</option>
                    @foreach($modelos as $modelo)
                        <option value="{{ $modelo->id }}" {{ request('modelo_id') == $modelo->id ? 'selected' : '' }}>
                            {{ $modelo->titulo }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>
    </form>

    <form action="{{ route('evolucoes.store') }}" method="POST" class="p-4 rounded-3 shadow-sm bg-white border">
        @csrf

        <!-- Dados ocultos do modelo selecionado -->
        <input type="hidden" name="modelo_fixo" value="{{ request('modelo_fixo') }}">
        <input type="hidden" name="modelo_id" value="{{ request('modelo_id') }}">

        <!-- Sessão 1 -->
        <h5 class="fw-bold section-title mb-3">👩‍⚕️ Dados do Paciente</h5>
        <hr class="mb-3 mt-0 section-line">
        <div class="row mb-3">
            <div class="col-md-6">
                <label class="form-label field-label">Nome do Paciente</label>
                <input type="text" name="paciente" id="input_paciente" class="form-control input-purple" placeholder="Digite o nome do paciente" {{ !in_array('paciente', $placeholders ?? []) ? 'disabled class=input-disabled' : '' }}>
            </div>
            <div class="col-md-3">
                <label class="form-label field-label">Sexo</label>
                <select name="sexo_paciente" id="input_sexo_paciente" class="form-select input-purple" required>
                    <option value="Feminino">Feminino</option>
                    <option value="Masculino">Masculino</option>
                </select>
            </div>
        </div>

        <!-- Sessão 2 -->
        <h5 class="fw-bold section-title mb-3">🧑‍🤝 Dados do Acompanhante</h5>
        <hr class="mb-3 mt-0 section-line">
        <div class="row mb-3">
            <div class="col-md-6">
                <label class="form-label field-label">Nome do Acompanhante</label>
                <input type="text" name="acompanhante" id="input_acompanhante" class="form-control input-purple" {{ !in_array('acompanhante', $placeholders ?? []) ? 'disabled class=input-disabled' : '' }}>
            </div>
            <div class="col-md-3">
                <label class="form-label field-label">Parentesco</label>
                <input type="text" name="parentesco" id="input_parentesco" class="form-control input-purple" {{ !in_array('parentesco', $placeholders ?? []) ? 'disabled class=input-disabled' : '' }}>
            </div>
            <div class="col-md-3">
                <label class="form-label field-label">Sexo</label>
                <select name="sexo_acompanhante" id="input_sexo_acompanhante" class="form-select input-purple" required>
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
                <input type="text" name="estado_paciente" id="input_estado_paciente" class="form-control input-purple" {{ !in_array('estado_paciente', $placeholders ?? []) ? 'disabled class=input-disabled' : '' }}>
            </div>
            <div class="col-md-6">
                <label class="form-label field-label">Motivo da Internação</label>
                <input type="text" name="motivo_internacao" id="input_motivo_internacao" class="form-control input-purple" {{ !in_array('motivo_internacao', $placeholders ?? []) ? 'disabled class=input-disabled' : '' }}>
            </div>
        </div>

        <!-- Sessão 4 -->
        <h5 class="fw-bold section-title mb-3">🏡 Informações Adicionais</h5>
        <hr class="mb-3 mt-0 section-line">
        <div class="row mb-3">
            <div class="col-md-6">
                <label class="form-label field-label">Com quem Reside</label>
                <input type="text" name="com_quem_reside" id="input_com_quem_reside" class="form-control input-purple" {{ !in_array('com_quem_reside', $placeholders ?? []) ? 'disabled class=input-disabled' : '' }}>
            </div>
            <div class="col-md-6">
                <label class="form-label field-label">Fonte de Renda</label>
                <input type="text" name="fonte_renda" id="input_fonte_renda" class="form-control input-purple" {{ !in_array('fonte_renda', $placeholders ?? []) ? 'disabled class=input-disabled' : '' }}>
            </div>
            <div class="col-md-6 mt-3">
                <label class="form-label field-label">Rede de Apoio</label>
                <input type="text" name="rede_apoio" id="input_rede_apoio" class="form-control input-purple" {{ !in_array('rede_apoio', $placeholders ?? []) ? 'disabled class=input-disabled' : '' }}>
            </div>
            <div class="col-md-6 mt-3">
                <label class="form-label field-label">Local de Origem</label>
                <input type="text" name="local_origem" id="input_local_origem" class="form-control input-purple" {{ !in_array('local_origem', $placeholders ?? []) ? 'disabled class=input-disabled' : '' }}>
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
    .input-disabled {
        background-color: #e9ecef !important;
        cursor: not-allowed !important;
        pointer-events: none; /* impede interações em select */
        color: #6c757d !important;
    }
    .section-line { border-top: 2px solid #7b689e !important; }
    .section-title { color: #7b689e !important; }
    .field-label { color: #4f3372; font-weight: 500; }
</style>
@endsection
