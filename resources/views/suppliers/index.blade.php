<x-app-layout>
    <x-error/>
    <x-input-error/>
    <div class="flex flex-col overflow-hidden">
        <div class="-my-2">
            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                <div class="shadow overflow-hidden border-b border-gray-200 dark:border-gray-700 sm:rounded-lg mt-3">
                    <div class="flex justify-between items-center px-6 py-3 bg-gray-50 dark:bg-gray-800">
                        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                            Fornecedores
                        </h2>
                        <a href="{{ route('suppliers.create') }}" class="px-4 py-2 bg-green-500 text-white rounded-lg hover:bg-green-600">Adicionar Fornecedor</a>

                    </div>


                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                        <thead class="bg-gray-50 dark:bg-gray-800 text-lg">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left font-medium text-gray-500 dark:text-gray-200 uppercase tracking-wider">
                                Nome do Fornecedor
                            </th>
                            <th scope="col" class="px-6 py-3 text-center  font-medium text-gray-500 dark:text-gray-200 uppercase tracking-wider">
                                CNPJ
                            </th>
                            <th scope="col" class="px-6 py-3 text-left  font-medium text-gray-500 dark:text-gray-200 uppercase tracking-wider">
                                Nome do Contato
                            </th>
                            <th scope="col" class="px-6 py-3 text-left font-medium text-gray-500 dark:text-gray-200 uppercase tracking-wider">
                                Email
                            </th>
                            <th scope="col" class="relative px-6 py-3">
                                <span class="sr-only">Editar</span>
                            </th>
                        </tr>
                        </thead>
                        <tbody class="bg-white dark:bg-gray-900 divide-y divide-gray-200 dark:divide-gray-700">
                        @foreach ($suppliers as $supplier)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900 dark:text-gray-100">
                                        {{ $supplier->fantasy_name }}
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900 dark:text-gray-100 text-center">
                                        {{ $supplier->cnpj }}
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900 dark:text-gray-100">
                                        @if($supplier->contacts->isEmpty())
                                            <span class="text-red-600 dark:text-red-400">Sem contato</span>
                                        @else
                                            {{ $supplier->contacts->first()->name }}
                                        @endif
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-500 dark:text-gray-400">
                                        @if($supplier->contacts->isEmpty() && !isset($supplier->contacts->first()->email) )
                                            <span class="text-red-600 dark:text-red-400">Sem contato</span>
                                        @else
                                            {{ $supplier->contacts->first()->email }}
                                        @endif
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <a href="{{ route('suppliers.edit', $supplier->hashedId) }}" class="text-indigo-600 hover:text-indigo-900 dark:text-indigo-400 dark:hover:text-indigo-200">Edit</a>
                                        <form action="{{ route('suppliers.delete', $supplier->hashedId) }}" method="get" onsubmit="return confirm('Tem certeza que deseja excluir este fornecedor?');">
                                            @csrf
                                            <button type="submit" class="ml-4 text-red-600 hover:text-red-900 dark:text-red-400 dark:hover:text-red-200 pointer" value="Delete">Excluir</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
