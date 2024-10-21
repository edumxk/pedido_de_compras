<div>
    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
        @forelse($budget->payments as $payment)
            @if($loop->first)
            <thead class="bg-gray-50 dark:bg-gray-700">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider dark:text-gray-200">
                        Tipo
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider dark:text-gray-200">
                        Parcelas
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider dark:text-gray-200">
                        Valor
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider dark:text-gray-200">
                        Preço
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider dark:text-gray-200">
                        Ação
                    </th>
                </tr>
            </thead>
        <tbody class="bg-white divide-y divide-gray-200 dark:bg-gray-800 dark:divide-gray-700">
           @endif
            <tr>
                <td class=" whitespace-nowrap">
                    <div class="text-sm text-gray-900 dark:text-gray-200">
                        {{ $payment->type }}
                    </div>
                </td>
                <td class=" whitespace-nowrap">
                    <div class="text-sm text-gray-900 dark:text-gray-200">
                        {{ $payment->installments }}x
                    </div>
                </td>
                <td class=" whitespace-nowrap">
                    <div class="text-sm text-gray-900 dark:text-gray-200">
                        {{ $payment->showTypeValue()}}
                    </div>
                </td>
                <td class=" whitespace-nowrap">
                    <div class="text-sm text-gray-900 dark:text-gray-200">
                        {{ number_format($payment->getPrice($budget->getTotal()),2,',','.') }}
                    </div>
                </td>
                <td class=" whitespace-nowrap">
                    <div class="text-sm text-gray-900 dark:text-gray-200">
                        @if($payment->status == 'approved')
                            <span class="bg-green-500 text-white font-bold py-2 px-4 rounded">
                                        Aprovado
                                    </span>
                        @elseif($payment->status == 'rejected')
                            <span class="bg-red-500 text-white font-bold py-2 px-4 rounded">
                                        Reprovado
                                    </span>
                        @else
                            <form action="{{ route('budgets.approve') }}" method="POST">
                                @csrf
                                <input type="hidden" name="budget_id" value="{{ $budget->hashedId }}" />
                                <input type="hidden" name="payment_id" value="{{ $payment->id }}" />
                                <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                                    Aprovar
                                </button>
                            </form>
                        @endif
                    </div>
                </td>
            </tr>
        @empty
            <tr>
                <td class=" whitespace-nowrap">
                    <div class="text-sm text-gray-900 dark:text-gray-200 text-center pt-3">
                        Nenhum Plano de Pagamento Cadastrado!
                    </div>
                </td>
            </tr>
        @endforelse
        </tbody>
    </table>
</div>
