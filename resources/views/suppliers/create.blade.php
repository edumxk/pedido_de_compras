<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Fornecedores') }}
        </h2>
    </x-slot>

    <div class="bg-white dark:bg-gray-800 text-gray-900 dark:text-white p-6 mx-auto border p-2 rounded-md mt-8 overflow-y-hidden mx-4 sm:w-3/5">
        <p class="text-sm sm
        :text-base md:text-lg lg:text-xl">Cadastrar Fornecedor</p>
        <x-auth-session-status class="mb-4" :status="session('status')" />
        <x-input-error/>
        <x-error/>
        <form action="{{ route('suppliers.store') }}" method="POST" class="space-y-4 mx-auto">
            @csrf
            <div class="flex flex-col space-y-4">
                <div class="flex flex-col">
                    <label for="cnpj" class="text-gray-700 dark:text-gray-200">CNPJ</label>
                    <input type="text" id="cnpj" name="cnpj" value="{{ old('cnpj') }}" required class="px-4 py-2 border rounded-lg dark:bg-gray-800 dark:text-gray-200">
                </div>
                <div class="flex flex-col">
                    <label for="fantasy_name" class="text-gray-700 dark:text-gray-200">Nome Fantasia</label>
                    <input type="text" id="fantasy_name" name="fantasy_name" value="{{ old('fantasy_name') }}" required class="px-4 py-2 border rounded-lg dark:bg-gray-800 dark:text-gray-200">
                </div>
                <div class="flex flex-col">
                    <label for="company_name" class="text-gray-700 dark:text-gray-200">Razão Social</label>
                    <input type="text" id="company_name" name="company_name" value="{{ old('company_name') }}" required class="px-4 py-2 border rounded-lg dark:bg-gray-800 dark:text-gray-200">
                </div>
                <div class="flex flex-col">
                    <label for="address" class="text-gray-700 dark:text-gray-200">Endereço</label>
                    <input type="text" id="address" name="address" value="{{ old('address') }}" class="px-4 py-2 border rounded-lg dark:bg-gray-800 dark:text-gray-200" readonly>
                </div>
                <div class="p-6 flex justify-between">
                    <button type="button" id="addContact" class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600">Adicionar Contato</button>
                </div>
                <div id="contacts" class="space-y-4">
                </div>
                    <div class="flex justify-end">
                        <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
                            Cadastrar
                        </button>
                    </div>
            </div>
        </form>
        <script src="{{ asset('js/form.js') }}"></script>
    </div>
</x-app-layout>
