<div class="overflow-x-auto">
    <table class="min-w-[60%] mx-auto table-auto text-gray-700 dark:text-gray-200 mx-auto text-sm">
        @forelse($budget->payments as $payment)
            @if($loop->first)
                <thead>
                    <tr class="text-left dark:bg-gray-900">
                        <th class="pl-4  py-2">Tipo de Pagamento</th>
                        <th class="mx-4 py-2">Desconto/Acrécimo</th>
                        <th class="mx-4 py-2">Valor Desconto</th>
                        <th class="mx-4 py-2">Parcelas</th>
                        <th class="mx-4 py-2">Dias</th>
                        <th class="mx-4 py-2 text-center">Ações</th>
                    </tr>
                </thead>
        <tbody>
            @endif
                <tr class="dark:odd:bg-gray-800 dark:even:bg-gray-900 even:bg-gray-100">
                    <td class="px-3">{{ $payment->type }}</td>
                    <td class="px-3">{{ $payment->showTypeValue() }}</td>
                    <td class="px-3">{{ number_format($payment->getPrice($budget->getTotal()),2,',','.') }}</td>
                    <td class="px-3">{{ $payment->installments }}</td>
                    <td class="px-3">{{ $payment->days }}</td>
                    <td class="mx-auto text center">
                        <form action="{{ route('payments.delete') }}" method="POST">
                            @csrf
                            <input type="hidden" name="payment_id" value="{{ $payment->id }}">
                            <button type="submit" class="bg-red-500 h-8 my-auto w-full hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                                Excluir
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center">Nenhum Pagamento</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
