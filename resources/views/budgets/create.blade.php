<x-app-layout>
    <div class="max-w-1/3 md:max-w-1/2 lg:max-w-[50%] mx-auto bg-white dark:bg-gray-800 text-gray-900 dark:text-white p-6 mx-auto border rounded-md mt-8 overflow-y-hidden mx-4 ">
        <div class="w-[70%] mx-auto text-center">
            <h1 class="text-2xl font-bold mb-6">Criar Orçamento</h1>

            <form action="{{ route('budget.create') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <a href="{{ route('suppliers.index') }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded mb-4 inline-block">
                        Novo Fornecedor
                    </a>
                    <label for="supplier_id" class="block text-lg font-medium text-gray-700 dark:text-gray-300">Selecione um Fornecedor</label>
                    <select name="supplier_id" id="supplier_id" class="form-select mt-1 block w-full dark:bg-gray-700">
                        @foreach($suppliers as $supplier)
                            <option value="{{ $supplier->id }}">{{ $supplier->fantasy_name }}</option>
                        @endforeach
                    </select>
                </div>

                <input type="text" class="hidden" name="purchase_order_id" value="{{ $hashedId }}" />

                <div class="flex justify-center space-x-4 mt-4">
                    <button class="bg-blue-500 hover:bg-blue-700 w-full text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
                        Criar Orçamento
                    </button>
                </div>
            </form>

            <div class="flex justify-start my-8">
                <a href="{{ route('purchase_orders.show', ['hashedId' => $hashedId ]) }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                    Voltar
                </a>
            </div>
        </div>
    </div>
</x-app-layout>

<script>
    $(document).ready(function() {
        $('#supplier_id').select2();
    });
</script>
