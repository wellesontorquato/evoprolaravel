<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <title>Verifique seu Email - EvoPlus</title>
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
    <img src="{{ asset('images/logo_evoplus_semfundo.png') }}" alt="EvoPlus Logo" class="logo">
    <h2>Bem-vindo ao EvoPlus!</h2>
    <p>Antes de começar, precisamos confirmar seu endereço de e-mail.</p>
    <p>Clique no botão abaixo para verificar sua conta:</p>
    <a href="{{ $url }}" class="btn">Verificar Email</a>
    <p>Se você não criou uma conta, nenhuma ação é necessária.</p>
    <p style="margin-top: 30px; font-size: 0.85rem; color: #999;">Esse link irá expirar em 60 minutos.</p>
  </div>
</body>
</html>
