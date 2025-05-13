<section class="bg-white p-6 rounded-xl shadow border border-red-200">
    <h2 class="text-xl font-semibold text-red-700 mb-4 flex items-center gap-2">
        ❌ Excluir Conta
    </h2>

    <p class="text-sm text-gray-700 mb-4">
        Uma vez que sua conta for excluída, todos os dados serão permanentemente apagados.
        Certifique-se de salvar o que for necessário antes.
    </p>

    <button
        class="bg-red-600 text-white px-6 py-2 rounded hover:bg-red-700 transition"
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
    >
        🗑️ Deletar Conta
    </button>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="p-6">
            @csrf
            @method('delete')

            <h2 class="text-lg font-semibold text-gray-900 mb-3">
                Tem certeza que deseja excluir sua conta?
            </h2>

            <p class="text-sm text-gray-700 mb-4">
                Por favor, insira sua senha para confirmar que deseja excluir sua conta permanentemente.
            </p>

            <div>
                <input type="password" name="password" id="password"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-red-500 focus:border-red-500"
                    placeholder="Senha">
                <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
            </div>

            <div class="mt-6 flex justify-end gap-2">
                <button type="button" class="btn btn-secondary" x-on:click="$dispatch('close')">Cancelar</button>
                <button type="submit" class="bg-red-600 text-white px-6 py-2 rounded hover:bg-red-700 transition">Excluir Conta</button>
            </div>
        </form>
    </x-modal>
</section>

<!-- iziToast -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/izitoast@1.4.0/dist/css/iziToast.min.css"/>
<script src="https://cdn.jsdelivr.net/npm/izitoast@1.4.0/dist/js/iziToast.min.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const sucessoExclusao = {!! json_encode(session('success')) !!};

        if (sucessoExclusao) {
            iziToast.success({
                title: 'Sucesso',
                message: sucessoExclusao,
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
