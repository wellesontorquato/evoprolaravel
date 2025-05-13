<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - EvoPlus</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/izitoast/1.4.0/css/iziToast.min.css" />
    <style>
        body {
            background: linear-gradient(180deg, #F3EEFF 0%, #ffffff 100%);
            font-family: 'Segoe UI', sans-serif;
        }
        .login-card {
            max-width: 420px;
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
    <div class="login-card">
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

        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required autofocus>
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

            <div class="form-check mb-3">
                <input type="checkbox" class="form-check-input" id="remember" name="remember">
                <label class="form-check-label" for="remember">Lembrar de mim</label>
            </div>

            <div class="d-flex justify-content-between align-items-center mb-3">
                @if (Route::has('password.request'))
                    <a class="text-link" href="{{ route('password.request') }}">Esqueceu a senha?</a>
                @endif
            </div>

            <button type="submit" class="btn btn-evo w-100">Entrar</button>

            </form>

            <div class="text-center mt-4">
                <span class="text-muted">Ainda não tem uma conta?</span><br>
                <a href="{{ route('register') }}" class="btn btn-evo w-50">Criar Conta</a>
            </div>

            </div>

            <script src="https://cdnjs.cloudflare.com/ajax/libs/izitoast/1.4.0/js/iziToast.min.js"></script>
            </body>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/izitoast/1.4.0/js/iziToast.min.js"></script>
</body>
</html>
