<div class="overflow-x-auto">
    <table class="w-3/4 table-auto text-gray-200 mx-auto">
        <thead>
        <tr class="text-left bg-gray-800">
            <th class="px-4 py-2">Tipo de Pagamento</th>
            <th class="px-4 py-2">Desconto/Acrécimo</th>
            <th class="px-4 py-2">Valor Desconto</th>
            <th class="px-4 py-2">Parcelas</th>
            <th class="px-4 py-2">Dias</th>
            <th class="px-4 py-2">Ações</th>
        </tr>
        </thead>
        <tbody>
        @foreach($budget->payments as $payment)
            <tr>
                <td class=" px-4 py-2">{{ $payment->type }}</td>
                <td class=" px-4 py-2">{{ $payment->showTypeValue() }}</td>
                <td class=" px-4 py-2">{{ number_format($payment->getPrice($budget->getTotal()),2,',','.') }}</td>
                <td class=" px-4 py-2">{{ $payment->installments }}</td>
                <td class=" px-4 py-2">{{ $payment->days }}</td>
                <td class=" px-4 py-2">
                    <form action="{{ route('payments.delete') }}" method="POST">
                        @csrf
                        <input type="hidden" name="payment_id" value="{{ $payment->id }}">
                        <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                            Excluir
                        </button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
