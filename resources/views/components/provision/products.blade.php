@props(['budget'])
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
                    <th scope="col" class="px-2 py-3 text-center">Desc/Acre</th>
                    <th scope="col" class="px-2 py-3 text-center">Preço Total</th>
                </tr>
                </thead>
                <tbody>
                @endif
                <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ $product->product->description }}</th>
                    <td class="px-2 py-4">{{ $product->product->brand }}</td>
                    <td class="px-2 py-4 text-center">{{ $product->quantity }}</td>
                    <td class="px-2 py-4 text-center">{{ number_format($product->price,2,',','.') }}</td>
                    <td class="px-2 py-4 text-center">{{ $product->budget->payments->where('status', 'approved')->first()->showTypeValue() }}</td>
                    <td class="px-2 py-4 text-center">{{ number_format($product->budget->payments->where('status', 'approved')->first()->getPrice($product->price * $product->quantity),2,',','.') }}</td>
                </tr>
                @php
                    $total += $product->price * $product->quantity;
                @endphp
                @if($loop->last)
                    @php
                        $budget->total = $total;
                    @endphp
                    <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700 text-lg">
                        <th colspan="5" scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">Total</th>
                        <td class="px-6 py-4 text-center">{{'R$ ' . number_format($product->budget->payments->where('status', 'approved')->first()->getPrice($budget->total) ,2,',','.') }}</td>
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
