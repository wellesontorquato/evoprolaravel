<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <title>Redefinição de Senha - EvoPro</title>
  <style>
    body {
      background: #f8f6ff;
      font-family: 'Segoe UI', sans-serif;
      color: #333;
      padding: 2rem;
    }
    .container {
      background: #fff;
      max-width: 600px;
      margin: auto;
      padding: 2rem;
      border-radius: 10px;
      box-shadow: 0 8px 20px rgba(0,0,0,0.1);
    }
    .btn {
      background-color: #A084DC;
      color: white;
      padding: 12px 20px;
      text-decoration: none;
      border-radius: 8px;
      display: inline-block;
      margin-top: 20px;
    }
    .btn:hover {
      background-color: #8a6dc3;
    }
    .logo {
      width: 80px;
      margin-bottom: 20px;
    }
    p {
      line-height: 1.5;
    }
  </style>
</head>
<body>
  <div class="container">
    <img src="{{ asset('images/logo_evopro_semfundo.png') }}" alt="EvoPro Logo" class="logo">
    <h2>Olá!</h2>
    <p>Recebemos uma solicitação para redefinir a senha da sua conta no <strong>EvoPro</strong>.</p>
    <p>Para continuar, clique no botão abaixo:</p>
    <a href="{{ $url }}" class="btn">Redefinir Senha</a>
    <p>Se você não solicitou essa alteração, nenhuma ação é necessária.</p>
    <p style="margin-top: 30px; font-size: 0.85rem; color: #999;">Esse link irá expirar em 60 minutos.</p>
  </div>
</body>
</html>
