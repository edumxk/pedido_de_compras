<div class="grid place-items-center dark:bg-gray-800 dark:text-white">
    <form method="POST" action="{{ route('budgets.storeProducts') }}" class="w-full max-w-md">
        @csrf
        <input type="hidden" name="budget_id" value="{{ $budget->hashedId }}">
        <h1 class="text-2xl font-bold text-gray-900 dark:text-white pb-3">Adicione um Produto ao Orçamento</h1>
        <div class="grid grid-cols-1 gap-4">
            <label for="product-select" class="text-sm sm:text-base md:text-lg lg:text-xl font-bold">Produto</label>
            <select name="product_id" id="product-select" class="w-auto h-10 dark:bg-gray-700" required>
                <option value="">Selecione um produto</option>
                @foreach($products as $product)
                    <option value="{{ $product->id }}" {{ old('product_id') == $product->id ? 'selected' : '' }}>{{ $product->description }} {{ $product->brand }}</option>
                @endforeach
            </select>

            <div>
                <label for="quantity" class="text-sm sm:text-base md:text-lg lg:text-xl font-bold">Quantidade</label>
                <input type="text" name="quantity" id="quantity" value="{{ old('quantity') }}" class="w-full h-10 dark:bg-gray-700 text-right" required>
            </div>
            <div>
                <label for="price" class="text-sm sm:text-base md:text-lg lg:text-xl font-bold">Preço</label>
                <input type="text" name="price" id="price" value="{{ old('price') }}" class="w-full h-10 dark:bg-gray-700 text-right" required>
            </div>
            <div class="flex justify-end">
                <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                    Adicionar
                </button>
            </div>
        </div>
    </form>
</div>
