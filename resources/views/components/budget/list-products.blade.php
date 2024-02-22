<div class="relative overflow-x-auto shadow-md sm:rounded-lg">
    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400 mt-2">

        @php
            $total = 0;
        @endphp

        @forelse($budget->prices as $product)
            @if($loop->first)
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr class="text-base">
                    <th scope="col" class="px-2 py-3 text-center">Descrição</th>
                    <th scope="col" class="px-2 py-3 text-center">Marca</th>
                    <th scope="col" class="px-2 py-3 text-center">Qtd</th>
                    <th scope="col" class="px-2 py-3 text-center">Preço UN</th>
                    <th scope="col" class="px-2 py-3 text-center">Preço Total</th>
                    <th scope="col" class="px-6 py-3 text-center w-32">Ações</th>
                </tr>
                </thead>
                <tbody>
                @endif
                <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ $product->product->description }}</th>
                    <td class="px-2 py-4">{{ $product->product->brand }}</td>
                    <td class="px-2 py-4 text-center">{{ $product->quantity }}</td>
                    <td class="px-2 py-4 text-center">{{ number_format($product->price,2,',','.') }}</td>
                    <td class="px-2 py-4 text-center">{{ number_format($product->price * $product->quantity,2,',','.') }}</td>
                    <td class="px-6 py-4 text-center">
                        <form action="{{ route('budgets.deleteProduct') }}" method="POST">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->product_id }}">
                            <input type="hidden" name="budget_id" value="{{ $budget->hashedId }}">
                            <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                                Excluir
                            </button>
                        </form>
                    </td>
                </tr>
                @php
                    $total += $product->price * $product->quantity;
                @endphp
                @if($loop->last)
                    <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700 text-lg">
                        <th colspan="4" scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">Total</th>
                        <td class="px-6 py-4 text-center">{{ number_format($total,2,',','.') }}</td>
                        <td class="px-6 py-4 text-center"></td>
                    </tr>
                </tbody>
            @endif
        @empty
            <tbody>
            <tr>
                <td colspan="4" class="text-center">Nenhum Produto</td>
            </tr>
            </tbody>
        @endforelse
    </table>
</div>
