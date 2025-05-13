<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Evolução</title>
    <style>
        body { font-family: sans-serif; font-size: 14px; color: #333; }
        h2 { color: #7743DB; margin-bottom: 10px; }
        hr { border-top: 1px solid #ccc; margin: 20px 0; }
    </style>
</head>
<body>
    <h2>Evolução de {{ $evolucao->paciente_nome }}</h2>
    <p><strong>Profissional:</strong> {{ auth()->user()->name }}</p>
    <p><strong>CRESS:</strong> {{ auth()->user()->cress }}</p>
    <p><strong>Data:</strong> {{ $evolucao->created_at->format('d/m/Y H:i') }}</p>
    <hr>
    <p style="white-space: pre-line;">{{ $evolucao->conteudo }}</p>
</body>
</html>
