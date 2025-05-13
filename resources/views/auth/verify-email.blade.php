<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verificação de Email - EvoPlus</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/izitoast/1.4.0/css/iziToast.min.css" />
    <style>
        body {
            background: linear-gradient(180deg, #F3EEFF 0%, #ffffff 100%);
            font-family: 'Segoe UI', sans-serif;
        }
        .verify-card {
            max-width: 500px;
            margin: 5rem auto;
            background: white;
            border-radius: 1rem;
            padding: 2rem;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }
        .btn-evo {
            background-color: #A084DC;
            color: white;
        }
        .btn-evo:hover {
            background-color: #8a6dc3;
        }
        .logo {
            display: block;
            margin: 0 auto 1rem;
            width: 100px;
        }
        .text-purple {
            color: #7743DB;
        }
    </style>
</head>
<body>

    <div class="verify-card text-center">
        <img src="{{ asset('images/logo_evoplus_semfundo.png') }}" alt="Logo EvoPlus" class="logo">

        <h5 class="text-purple mb-3 fw-bold">Verifique seu endereço de e-mail</h5>

        <p class="text-muted">
            Obrigado por se cadastrar! Antes de começar, verifique seu endereço de e-mail clicando no link que enviamos para você. Caso não tenha recebido, podemos enviar novamente.
        </p>

        @if (session('status') == 'verification-link-sent')
            <script>
                document.addEventListener('DOMContentLoaded', () => {
                    iziToast.success({
                        title: 'Link reenviado!',
                        message: 'Um novo link de verificação foi enviado para seu e-mail.',
                        position: 'topRight'
                    });
                });
            </script>
        @endif

        <div class="d-flex justify-content-center gap-3 mt-4">
            <form method="POST" action="{{ route('verification.send') }}">
                @csrf
                <button type="submit" class="btn btn-evo">Reenviar e-mail</button>
            </form>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn btn-outline-secondary">Sair</button>
            </form>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/izitoast/1.4.0/js/iziToast.min.js"></script>
</body>
</html>
