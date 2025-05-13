<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Recuperar Senha - EvoPlus</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/izitoast/1.4.0/css/iziToast.min.css" />
    <style>
        body {
            background: linear-gradient(180deg, #F3EEFF 0%, #ffffff 100%);
            font-family: 'Segoe UI', sans-serif;
        }
        .card-box {
            max-width: 480px;
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
        .form-label {
            color: #7743DB;
            font-weight: 500;
        }
        .logo {
            display: block;
            margin: 0 auto 1rem;
            width: 100px;
        }
        .text-link {
            display: block;
            text-align: center;
            margin-top: 1rem;
            font-size: 0.9rem;
            color: #7743DB;
            text-decoration: none;
        }
        .text-link:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="card-box">
        <img src="{{ asset('images/logo_evoplus_semfundo.png') }}" alt="Logo EvoPlus" class="logo">
        <h5 class="text-center text-purple fw-bold mb-4">📩 Recuperar Senha</h5>

        <p class="text-muted small text-center mb-3">
            Informe seu e-mail e enviaremos um link para redefinir sua senha.
        </p>

        @if (session('status'))
            <script>
                document.addEventListener('DOMContentLoaded', () => {
                    iziToast.success({
                        title: 'Enviado!',
                        message: '{{ session('status') }}',
                        position: 'topRight'
                    });
                });
            </script>
        @endif

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" class="form-control" required autofocus>
                @error('email')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <button type="submit" class="btn btn-evo w-100">Enviar link de recuperação</button>
            <a href="{{ route('login') }}" class="text-link">← Voltar ao login</a>
        </form>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/izitoast/1.4.0/js/iziToast.min.js"></script>
</body>
</html>
