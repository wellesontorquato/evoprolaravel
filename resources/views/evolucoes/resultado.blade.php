@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="bg-white p-4 rounded shadow-sm border">
        <h4 class="text-purple fw-bold mb-3">✨ Evolução Gerada</h4>
        <p><strong>Paciente:</strong> {{ $evolucao->paciente_nome }}</p>
        <hr>

        <div class="mt-3" id="texto-evolucao" style="white-space: pre-line; font-size: 16px;">
            {{ $evolucao->conteudo }}

            <br><br>
            <span class="text-muted">
                {{ auth()->user()->name }} | CRESS {{ auth()->user()->cress }}
            </span>
        </div>

        <div class="mt-4 text-end d-flex justify-content-end gap-2">
            <a href="{{ route('evolucoes.index') }}" class="btn btn-secondary">⬅️ Voltar</a>

            <button class="btn btn-outline-success" onclick="copiarTexto()">📋 Copiar</button>

            <a href="{{ route('evolucoes.exportar.pdf.unico', $evolucao) }}" class="btn btn-purple">📄 Baixar PDF</a>
        </div>
    </div>
</div>

<!-- iziToast CDN -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/izitoast@1.4.0/dist/css/iziToast.min.css">
<script src="https://cdn.jsdelivr.net/npm/izitoast@1.4.0/dist/js/iziToast.min.js"></script>

<style>
    .text-purple {
        color: #7743DB;
    }
    .btn-purple {
        background: #7743DB;
        color: #fff;
        border-radius: 8px;
        border: none;
    }
    .btn-purple:hover {
        background-color: #5e34b2;
    }
</style>

<script>
    function copiarTexto() {
        const texto = document.getElementById('texto-evolucao').innerText;
        navigator.clipboard.writeText(texto).then(() => {
            iziToast.success({
                title: 'Copiado!',
                message: 'Evolução copiada com sucesso!',
                position: 'topCenter',
                timeout: 3000
            });
        }).catch(() => {
            iziToast.error({
                title: 'Erro',
                message: 'Falha ao copiar o texto.',
                position: 'topCenter',
                timeout: 3000
            });
        });
    }
</script>
@endsection
