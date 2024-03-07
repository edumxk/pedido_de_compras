<x-app-layout>


    <x-slot name="header">
        <h2 class="text-2xl font-semibold text-gray-800 dark:text-gray-200 leading-tight mb-2">
            {{ __('Produtos') }}
        </h2>
        <!-- cadastrar produto -->
    <div>
        <a href="{{ route('products.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mt-2">Cadastrar Produto</a>
    </div>
    </x-slot>
    <x-input-error/>
    <x-error/>
    <div class="flex flex-col">
        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                <div class="shadow overflow-hidden border-b border-gray-200 dark:border-gray-800 sm:rounded-lg">

                        <form action="{{ route('products.index') }}" method="GET">
                            <div class="flex flex-col sm:flex-row space-y-2 sm:space-y-0 sm:space-x-2 py-6">
                                <input type="text" name="search" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-800 dark:text-gray-200 dark:bg-gray-800 leading-tight focus:outline-none focus:shadow-outline" placeholder="Pesquisar produtos..." value="{{ request()->search }}">
                                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mt-2">Pesquisar</button>
                            </div>
                        </form>


                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-800">
                        <thead>
                        <tr>
                            <th class="px-6 py-3 bg-gray-50 dark:bg-gray-800 text-left text-xs leading-4 font-medium text-gray-500 dark:text-gray-200 uppercase tracking-wider">Descrição</th>
                            <th class="px-6 py-3 bg-gray-50 dark:bg-gray-800 text-left text-xs leading-4 font-medium text-gray-500 dark:text-gray-200 uppercase tracking-wider">Marca</th>
                            <th class="px-6 py-3 bg-gray-50 dark:bg-gray-800 text-left text-xs leading-4 font-medium text-gray-500 dark:text-gray-200 uppercase tracking-wider">Modelo</th>
                            <th class="px-6 py-3 bg-gray-50 dark:bg-gray-800 text-left text-xs leading-4 font-medium text-gray-500 dark:text-gray-200 uppercase tracking-wider">Categoria</th>
                            <th class="px-6 py-3 bg-gray-50 dark:bg-gray-800"></th>
                        </tr>
                        </thead>
                        <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-600">
                        @foreach ($products as $product)
                            <tr>
                                <td class="px-6 py-4 whitespace-no-wrap text-gray-700 dark:text-gray-300">{{ $product->description }}</td>
                                <td class="px-6 py-4 whitespace-no-wrap text-gray-700 dark:text-gray-300">{{ $product->brand }}</td>
                                <td class="px-6 py-4 whitespace-no-wrap text-gray-700 dark:text-gray-300">{{ $product->model }}</td>
                                <td class="px-6 py-4 whitespace-no-wrap text-gray-700 dark:text-gray-300">{{ $product->category->name }}</td>
                                <td class="px-6 py-4 whitespace-no-wrap text-right text-sm">
                                    <div class="grid grid-cols-2 gap-2">
                                        <a href="{{ route('products.edit', $product->hashedId) }}" class="text-blue-600 hover:text-blue-900">Editar</a>
                                        <form action="{{ route('products.destroy', $product->hashedId) }}" method="POST" class="inline" onsubmit="return confirm('Tem certeza que deseja excluir este produto?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-900">Excluir</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <div class="mt-4">
                        {{ $products->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
