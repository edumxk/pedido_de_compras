@props(['budget'])
<x-error/>
<div class="relative overflow-x-auto shadow-md py-6">
    <table class="xl:min-w-[70vw] lg:min-w-full min-w-full mx-auto divide-y divide-gray-200 dark:divide-gray-700">
        @php $total = 0; @endphp

        @forelse($budget->prices as $product)
            @if($loop->first)
                <thead class="bg-gray-50 uppercase dark:bg-gray-700">
                <tr>
                    <th colspan="5" class="dark:text-gray-100 py-2">Produtos</th>
                </tr>
                <tr class="px-6 py-3 text-left text-xs font-medium text-gray-500 tracking-wider dark:text-gray-200">
                    <th class="px-6 py-3">Descrição</th>
                    <th class="px-6 py-3">Marca</th>
                    <th class="px-6 py-3 w-20 text-center">Qtd</th>
                    <th class="px-6 py-3 w-40 text-center">Preço UN</th>
                    <th class="px-6 py-3 w-40 text-center">Preço Total</th>
                </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200 dark:bg-gray-800 dark:divide-gray-700">
                @endif
                <tr class="border-b dark:border-gray-700 uppercase">
                    <th class="text-left pl-4 py-1 text-gray-900 whitespace-nowrap dark:text-white">{{ $product->product->description }}</th>
                    <td class="text-sm text-gray-900 dark:text-gray-200 pl-4 py-1">{{ $product->product->brand }}</td>
                    <td class="text-sm text-gray-900 dark:text-gray-200 text-center">{{ number_format($product->quantity, 2, ',', '.') }}</td>
                    <td class="text-sm text-gray-900 dark:text-gray-200 text-center">{{ number_format($product->price, 2, ',', '.') }}</td>
                    <td class="text-sm text-gray-900 dark:text-gray-200 text-center">{{ number_format($product->price * $product->quantity, 2, ',', '.') }}</td>
                </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center py-3 dark:text-gray-200">Nenhum Produto Cadastrado no Orçamento!</td>
                    </tr>
                @endforelse

                @forelse($budget->payments as $payment)
                    @if($loop->first)
                        <thead class="bg-gray-50 uppercase dark:bg-gray-700">
                        <tr>
                            <th colspan="5" class="dark:text-gray-100 py-2">Plano de Pagamento</th>
                        </tr>
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 tracking-wider dark:text-gray-200">Tipo</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 tracking-wider dark:text-gray-200">Parcelas</th>
                            <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 tracking-wider dark:text-gray-200">Valor</th>
                            <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 tracking-wider dark:text-gray-200">Preço</th>
                            <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 tracking-wider dark:text-gray-200">Ação</th>
                        </tr>
                        </thead>
                <tbody class="bg-white divide-y divide-gray-200 dark:bg-gray-800 dark:divide-gray-700">
                @endif
                <tr>
                    <td class="whitespace-nowrap h-7 pl-4 text-sm text-gray-900 dark:text-gray-200 uppercase">{{ $payment->type }}</td>
                    <td class="whitespace-nowrap pl-12 text-sm text-gray-900 dark:text-gray-200">{{ $payment->installments }}x</td>
                    <td class="whitespace-nowrap pl-4 text-sm text-gray-900 dark:text-gray-200">{{ $payment->showTypeValue() }}</td>
                    <td class="whitespace-nowrap text-center text-sm text-gray-900 dark:text-gray-200">{{ number_format($payment->getPrice($budget->getTotal()), 2, ',', '.') }}</td>
                    <td class="whitespace-nowrap text-center text-sm text-gray-900 dark:text-gray-200">
                        @if($payment->status == 'approved')
                            <span class="bg-green-500 text-white font-bold py-1 px-2 rounded">Aprovado</span>
                        @elseif($payment->status == 'rejected')
                            <span class="bg-red-500 text-white font-bold py-1 px-2 rounded">Reprovado</span>
                        @else
                            <form action="{{ route('budgets.approve') }}" method="POST">
                                @csrf
                                <input type="hidden" name="budget_id" value="{{ $budget->hashedId }}" />
                                <input type="hidden" name="payment_id" value="{{ $payment->id }}" />
                                <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-1 px-2 rounded">Aprovar</button>
                            </form>
                        @endif
                    </td>
                </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center py-3 dark:text-gray-200">Nenhum Plano de Pagamento Cadastrado!</td>
                    </tr>
                @endforelse
    </table>
</div>
