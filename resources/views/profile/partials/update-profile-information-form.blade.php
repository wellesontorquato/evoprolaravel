<section class="bg-white p-6 rounded-xl shadow mb-6 border border-purple-200">
    <h2 class="text-xl font-semibold text-purple-700 mb-4 flex items-center gap-2">
        👤 Informações do Perfil
    </h2>

    <form method="POST" action="{{ route('profile.update') }}" class="grid grid-cols-1 md:grid-cols-2 gap-4">
        @csrf
        @method('patch')

        <!-- Nome -->
        <div class="col-span-2 md:col-span-1">
            <label for="name" class="block text-sm font-medium text-gray-700">Nome</label>
            <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}"
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-purple-500 focus:border-purple-500" required />
        </div>

        <!-- Email -->
        <div class="col-span-2 md:col-span-1">
            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
            <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}"
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-purple-500 focus:border-purple-500" required />
        </div>

        <!-- CRESS -->
        <div class="col-span-2">
            <label for="cress" class="block text-sm font-medium text-gray-700">CRESS</label>
            <input type="text" name="cress" id="cress" value="{{ old('cress', $user->cress) }}"
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-purple-500 focus:border-purple-500" />
        </div>

        <!-- Assinatura -->
        <div class="col-span-2">
            <label for="signature" class="block text-sm font-medium text-gray-700">Assinatura</label>
            <textarea name="signature" id="signature" rows="3"
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-purple-500 focus:border-purple-500">{{ old('signature', $user->signature) }}</textarea>
        </div>

        <!-- Botão -->
        <div class="col-span-2 mt-4">
            <button type="submit"
                class="bg-purple-600 text-white px-6 py-2 rounded-lg hover:bg-purple-700 transition">
                💾 Salvar Alterações
            </button>
        </div>
    </form>
</section>

<!-- iziToast -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/izitoast@1.4.0/dist/css/iziToast.min.css"/>
<script src="https://cdn.jsdelivr.net/npm/izitoast@1.4.0/dist/js/iziToast.min.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const success = {!! json_encode(session('success')) !!};

        if (success) {
            iziToast.success({
                title: 'Sucesso',
                message: success,
                position: 'topCenter',
                timeout: 4000,
                backgroundColor: '#7743DB',
                theme: 'light',
                color: 'white'
            });
        }
    });
</script>
