<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Editar Fornecedor
        </h2>
    </x-slot>

    @if ($errors->any())
        <x-input-error :messages="$errors->all()"/>
    @endif

    <form method="POST" action="{{ route('suppliers.update', $supplier->hashedId) }}" class="space-y-4 mx-auto w-3/5">
        @csrf
        @method('PATCH')

        <div class="flex flex-col px-6">
            <label for="fantasy_name" class="text-gray-700 dark:text-gray-200">Nome Fantasia</label>
            <input type="text" id="fantasy_name" name="fantasy_name" value="{{ old('fantasy_name', $supplier->fantasy_name) }}" required class="px-4 py-2 border rounded-lg dark:bg-gray-800 dark:text-gray-200">
        </div>

        <div class="flex flex-col px-6">
            <label for="company_name" class="text-gray-700 dark:text-gray-200">Razão Social</label>
            <input type="text" id="company_name" name="company_name" value="{{ old('company_name', $supplier->company_name) }}" required class="px-4 py-2 border rounded-lg dark:bg-gray-800 dark:text-gray-200">
        </div>

        <div class="flex flex-col px-6">
            <label for="address" class="text-gray-700 dark:text-gray-200">Endereço</label>
            <input type="text" id="address" name="address" value="{{ old('address', $supplier->address) }}" required class="px-4 py-2 border rounded-lg dark:bg-gray-800 dark:text-gray-200">
        </div>

        <x-suppliers.contacts :supplier="$supplier">
        </x-suppliers.contacts>

        <div class="p-6 flex justify-between">
            <button type="button" id="addContact" class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600">Adicionar Contato</button>
            <button type="submit" class="px-4 py-2 bg-green-500 text-white rounded-lg hover:bg-green-600">Salvar</button>
        </div>
    </form>

    <script src="{{ asset('js/form.js') }}"></script>
</x-app-layout>
