<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Editar Produtos') }}
        </h2>
    </x-slot>

    <div class="bg-white dark:bg-gray-800 text-gray-900 dark:text-white p-6 mx-auto border p-2 rounded-md mt-8 overflow-y-hidden mx-4 sm:w-3/5">
        <p class="text-sm sm:text-base md:text-lg lg:text-xl">Editar Produtos</p>
        @if ($errors->any())
            <x-input-error :messages="$errors->all()"/>
        @endif
        <form action="{{ route('products.update', $product->hashedId) }}" method="POST" class="space-y-4 mx-auto">
            @csrf
            @method('PATCH')
            <div class="flex flex-col space-y-4">
                <div class="flex flex-col">
                    <label for="description" class="text-gray-700 dark:text-gray-200">Descrição</label>
                    <input type="text" id="description" name="description" value="{{ $product->description }}" required class="px-4 py-2 border rounded-lg dark:bg-gray-800 dark:text-gray-200">
                </div>
                <div class="flex flex-col">
                    <label for="price" class="text-gray-700 dark:text-gray-200">Marca</label>
                    <input type="text" id="brand" name="brand" value="{{ $product->brand }}" required class="px-4 py-2 border rounded-lg dark:bg-gray-800 dark:text-gray-200">
                </div>
                <div class="flex flex-col">
                    <label for="price" class="text-gray-700 dark:text-gray-200">Modelo</label>
                    <input type="text" id="model" name="model" value="{{ $product->model }}" required class="px-4 py-2 border rounded-lg dark:bg-gray-800 dark:text-gray-200">
                </div>
                <div class="flex flex-col">
                    <label for="price" class="text-gray-700 dark:text-gray-200">Categoria</label>
                    <select name="category_id" id="category_id" required class="px-4 py-2 border rounded-lg dark:bg-gray-800 dark:text-gray-200">
                        <option value="" selected>Selecione uma Categoria</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ $product->category_id == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="flex justify-end">
                    <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
                        Atualizar
                    </button>
                </div>
            </div>
        </form>
        <!-- redirect back button -->
        <div class="flex justify-start">
            <a href="{{ route('products.index') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Voltar</a>
        </div>
    </div>
</x-app-layout>
