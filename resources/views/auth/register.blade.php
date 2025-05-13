<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro - EvoPlus</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/izitoast/1.4.0/css/iziToast.min.css" />
    <style>
        body {
            background: linear-gradient(180deg, #F3EEFF 0%, #ffffff 100%);
            font-family: 'Segoe UI', sans-serif;
        }
        .register-card {
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
        a.text-link {
            color: #7743DB;
            text-decoration: none;
        }
        a.text-link:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="register-card">
        <img src="{{ asset('images/logo_evoplus_semfundo.png') }}" alt="Logo EvoPlus" class="logo">

        @if (session('status'))
            <script>
                document.addEventListener('DOMContentLoaded', () => {
                    iziToast.success({
                        title: 'Sucesso',
                        message: '{{ session('status') }}',
                        position: 'topRight'
                    });
                });
            </script>
        @endif

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="mb-3">
                <label for="name" class="form-label">Nome</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required autofocus>
                @error('name')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required>
                @error('email')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Senha</label>
                <input type="password" class="form-control" id="password" name="password" required>
                @error('password')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="mb-3">
                <label for="password_confirmation" class="form-label">Confirmar Senha</label>
                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
                @error('password_confirmation')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="d-flex justify-content-between align-items-center mb-3">
                <a href="{{ route('login') }}" class="text-link">Já tem uma conta?</a>
            </div>

            <button type="submit" class="btn btn-evo w-100">Criar Conta</button>
        </form>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/izitoast/1.4.0/js/iziToast.min.js"></script>
</body>
</html>
