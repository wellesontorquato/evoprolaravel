<section class="bg-white p-6 rounded-xl shadow mb-6 border border-purple-200">
    <h2 class="text-xl font-semibold text-purple-700 mb-4 flex items-center gap-2">
        🔐 Alterar Senha
    </h2>

    <form method="POST" action="{{ route('password.update') }}" class="grid grid-cols-1 md:grid-cols-2 gap-4">
        @csrf
        @method('put')

        <!-- Senha Atual -->
        <div class="col-span-2">
            <label for="current_password" class="block text-sm font-medium text-gray-700">Senha Atual</label>
            <input type="password" id="current_password" name="current_password"
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-purple-500 focus:border-purple-500"
                autocomplete="current-password">
            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
        </div>

        <!-- Nova Senha -->
        <div>
            <label for="password" class="block text-sm font-medium text-gray-700">Nova Senha</label>
            <input type="password" id="password" name="password"
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-purple-500 focus:border-purple-500"
                autocomplete="new-password">
            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
        </div>

        <!-- Confirmação -->
        <div>
            <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirmar Senha</label>
            <input type="password" id="password_confirmation" name="password_confirmation"
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-purple-500 focus:border-purple-500"
                autocomplete="new-password">
            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
        </div>

        <!-- Botão -->
        <div class="col-span-2 mt-4">
            <button type="submit"
                class="bg-purple-600 text-white px-6 py-2 rounded-lg hover:bg-purple-700 transition">
                💾 Atualizar Senha
            </button>
        </div>
    </form>
</section>

<!-- iziToast -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/izitoast@1.4.0/dist/css/iziToast.min.css"/>
<script src="https://cdn.jsdelivr.net/npm/izitoast@1.4.0/dist/js/iziToast.min.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const senhaAtualizada = {!! json_encode(session('status') === 'password-updated' ? 'Senha atualizada com sucesso!' : null) !!};

        if (senhaAtualizada) {
            iziToast.success({
                title: 'Sucesso',
                message: senhaAtualizada,
                position: 'topCenter',
                timeout: 4000,
                backgroundColor: '#7743DB',
                theme: 'light',
                color: 'white'
            });
        }
    });
</script>

<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
