@props(['purchase_orders', 'products', 'categories'])
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<div>
    <div class="flex items-center justify-between">
        <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
            Criar Orçamento
        </button>
        <button id="newProductButton" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
            Novo Produto
        </button>
    </div>
    <form id="budgetForm" action="{{ route('budget.create') }}" method="POST">
        @csrf
        <div class="mb-4">
              <label for="products" class="block text-gray-700 dark:text-white text-sm font-bold mb-2">Produtos:</label>
                <select id="products" name="products[]" multiple="multiple" class="dark:bg-gray-800 shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 dark:text-white leading-tight focus:outline-none focus:shadow-outline">
                    @forelse($products as $product)
                        @if($loop->first)
                            <option value="0">Selecione um produto</option>
                        @endif
                        <option value="{{ $product->id }}">{{ $product->description }}</option>
                    @empty
                        <option value="0">Nenhum produto cadastrado</option>
                    @endforelse
                </select>
        </div>
    </form>

    <x-product-create :categories="$categories" />
</div>

<script>

    document.getElementById('newProductButton').addEventListener('click', function(event) {

        event.preventDefault();

        if(document.getElementById('newProductModal').classList.contains('hidden'))
            document.getElementById('newProductModal').classList.remove('hidden');
        else
            document.getElementById('newProductModal').classList.add('hidden');
    });

    $(document).ready(function() {
        $('#productCategory').select2();
        $('#supplier_id').select2();
    });
</script>
