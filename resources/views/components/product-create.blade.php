@props(['categories'])
<div id="newProductModal" class="hidden w-[30rem]">
    <form id="newProductForm" action="{{ route('product.create') }}" method="POST">
        @csrf
        <div class="mb-4">
            <label for="productName" class="block text-gray-700 dark:text-white text-sm font-bold mb-2">Descrição do Produto:</label>
            <input id="productName" name="description" type="text" class="dark:bg-gray-800 shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 dark:text-white leading-tight focus:outline-none focus:shadow-outline">
        </div>

        <div class="mb-4">
            <label for="productBrand" class="block text-gray-700 dark:text-white text-sm font-bold mb-2">Marca do Produto:</label>
            <input id="productBrand" name="brand" type="text" class="dark:bg-gray-800 shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 dark:text-white leading-tight focus:outline-none focus:shadow-outline">
        </div>

        <div class="mb-4">
            <label for="productCategory" class="block text-gray-700 dark:text-white text-sm font-bold mb-2">Categoria do Produto:</label>
            <select id="productCategory" name="category" class="dark:bg-gray-800 shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 dark:text-white leading-tight focus:outline-none focus:shadow-outline">

                @forelse($categories as $category)
                    @if($loop->first)
                        <option value="0">Selecione uma categoria</option>
                    @endif
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @empty
                    <option value="0">Nenhuma categoria cadastrada</option>
                @endforelse
            </select>
        </div>

        <button class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">Criar Produto</button>
    </form>
</div>
