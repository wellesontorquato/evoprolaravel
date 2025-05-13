<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Redefinir Senha - EvoPlus</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/izitoast/1.4.0/css/iziToast.min.css" />
    <style>
        body {
            background: linear-gradient(180deg, #F3EEFF 0%, #ffffff 100%);
            font-family: 'Segoe UI', sans-serif;
        }
        .reset-card {
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
    </style>
</head>
<body>
    <div class="reset-card">
        <img src="{{ asset('images/logo_evoplus_semfundo.png') }}" alt="Logo EvoPlus" class="logo">
        <h5 class="text-center text-purple fw-bold mb-4">🔐 Redefinir sua senha</h5>

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

        <form method="POST" action="{{ route('password.store') }}">
            @csrf

            <input type="hidden" name="token" value="{{ $request->route('token') }}">

            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" id="email" name="email" class="form-control" value="{{ old('email', $request->email) }}" required autofocus>
                @error('email')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Nova Senha</label>
                <input type="password" id="password" name="password" class="form-control" required autocomplete="new-password">
                @error('password')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="mb-3">
                <label for="password_confirmation" class="form-label">Confirmar Nova Senha</label>
                <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" required autocomplete="new-password">
                @error('password_confirmation')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <button type="submit" class="btn btn-evo w-100">Redefinir Senha</button>
        </form>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/izitoast/1.4.0/js/iziToast.min.js"></script>
</body>
</html>
