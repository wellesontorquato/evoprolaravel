<!-- resources/views/layouts/sidebar.blade.php -->
      <div class="sidebar">
            <div class="text-center my-3 px-3">
                <img src="{{ asset('images/logo_evoplus_semfundo.png') }}" alt="EvoPlus" style="max-width: 140px; height: auto;">
            </div>
            <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">🏠 Dashboard</a>
            <a href="{{ route('evolucoes.index') }}" class="{{ request()->routeIs('evolucoes.*') ? 'active' : '' }}">📝 Minhas Evoluções</a>
            <a href="{{ route('modelos.index') }}" class="{{ request()->routeIs('modelos.*') ? 'active' : '' }}">🧩 Meus Modelos</a>
            <a href="{{ route('profile.edit') }}" class="{{ request()->routeIs('profile.edit') ? 'active' : '' }}">👤 Meu Perfil</a>
            <form method="POST" action="{{ route('logout') }}" class="mt-4 text-center">
                @csrf
                <button class="btn btn-sm btn-outline-danger w-75">🚪 Sair</button>
            </form>
        </div>
<style>
        body {
            margin-left: 250px; /* espaço para o sidebar */
        }

        .sidebar {
            width: 250px;
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            background-color: #f8f9fa;
            padding-top: 1rem;
            border-right: 1px solid #dee2e6;
            z-index: 1030;
        }

        .sidebar a {
            display: block;
            padding: 10px 20px;
            color: #333;
            text-decoration: none;
        }

        .sidebar a:hover,
        .sidebar a.active {
            background-color: #e9ecef;
            color: #7743DB;
            font-weight: 600;
        }

        .container {
            max-width: 100%;
        }
        .text-purple {
            color: #7743DB !important;
        }
</style>
