<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Evoluções</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; line-height: 1.5; }
        h2, h4 { margin-bottom: 4px; }
        .cabecalho { margin-bottom: 30px; text-align: center; }
        .linha { border-bottom: 1px solid #ccc; margin: 10px 0; }
        .evolucao { margin-bottom: 30px; }
        .logo { max-height: 50px; margin-bottom: 10px; }
    </style>
</head>
<body>
    <!-- Logo do sistema -->
    <div class="cabecalho">
        <img src="https://evolucoesassistentesocial.pythonanywhere.com/static/logo.png" class="logo" alt="Logo do Sistema">
        <h2>Evoluções Registradas</h2>
        <p><strong>Profissional:</strong> {{ auth()->user()->name }}</p>
        <p><strong>CRESS:</strong> {{ auth()->user()->cress }}</p>
        <p><strong>Data de Exportação:</strong> {{ now()->format('d/m/Y H:i') }}</p>
        <div class="linha"></div>
    </div>


    <!-- Evoluções -->
    @foreach ($evolucoes as $evo)
        <div class="evolucao">
            <h4>Paciente: {{ $evo->paciente_nome }}</h4>
            <p><strong>Data de Criação:</strong> {{ $evo->created_at->format('d/m/Y H:i') }}</p>
            <p><strong>Conteúdo:</strong></p>
            <p>{!! nl2br(e($evo->conteudo)) !!}</p>
            <div class="linha"></div>
        </div>
    @endforeach
</body>
</html>
