<x-app-layout>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <div class="bg-white dark:bg-gray-800 text-gray-900 dark:text-white p-6 mx-auto border p-2 rounded-md mt-8 overflow-y-hidden mx-4">
        <p class="text-sm sm:text-base md:text-lg lg:text-xl">Selecione um Fornecedor</p>
        <form action="{{ route('budget.create') }}" method="POST">
            @csrf
            <!-- Campo de seleção para fornecedores -->
            <div class="mb-4 grid grid-cols-2 py-6">
                <select name="supplier_id" id="supplier_id" class="form-select">
                    @foreach($suppliers as $supplier)
                        <option value="{{ $supplier->id }}">{{ $supplier->fantasy_name }}</option>
                    @endforeach
                </select>
            </div>

            <input type="text" class="hidden" name="purchase_order_id" value="{{ $id }}" />



            <div class="flex justify-end">
                <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
                    Criar Orçamento
                </button>
            </div>
        </form>

        <!-- Cadastrar Fornecedor -->
        <div class="flex justify-end">
            <a href="{{ route('suppliers.index') }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                Novo Fornecedor
            </a>

    </div>

</x-app-layout>

<script>
    $(document).ready(function() {
        $('#supplier_id').select2();
    });
</script>
