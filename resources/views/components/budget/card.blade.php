<div class="dark:bg-gray-800">
    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
        <thead class="bg-gray-50 dark:bg-gray-700">
        <tr>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider dark:text-gray-200 block sm:table-cell">
                Fornecedor
            </th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider dark:text-gray-200 block sm:table-cell">
                Range de Preço
            </th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider dark:text-gray-200 md:text-center block sm:table-cell">
                Plano de Pagamento
            </th>
        </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200 dark:bg-gray-800 dark:divide-gray-700">
            <tr>
                <td class="px-6 py-4 whitespace-nowrap block sm:table-cell">
                    <a href="{{ route('budgets.products', $budget->hashedId) }}" class="text-sm text-gray-900 dark:text-gray-200">
                        {{ $budget->supplier->fantasy_name }}
                    </a>
                </td>
                <td class="px-6 py-4 whitespace-nowrap block sm:table-cell">
                    <div class="text-sm text-gray-900 dark:text-gray-200">
                        @php
                            $range = [];
                            foreach( $budget->payments as $payment ) {
                                $range[]= $payment->getPrice($budget->getTotal());
                            }
                        @endphp
                        {{ $budget->showRangePrice($range) }}
                    </div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap block sm:table-cell">
                    <div class="flex items-center justify-between w-full p-5 font-medium text-gray-500 border border-b-0 border-gray-200 rounded-t-xl focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-800 dark:border-gray-700 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800 gap-3" data-accordion-target="#accordion-collapse-body-{{ $budget->id }}" aria-expanded="false" aria-controls="accordion-collapse-body-{{ $budget->id }}">
                        <span>Detalhes</span>
                        <svg data-accordion-icon class="w-3 h-3 rotate-180 shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5 5 1 1 5"/>
                        </svg>
                    </div>
                    <div id="accordion-collapse-body-{{ $budget->id }}" class="hidden" aria-labelledby="accordion-collapse-heading-{{ $budget->id }}">
                        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
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
                            @forelse($budget->payments as $payment)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900 dark:text-gray-200">
                                            {{ $payment->type }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900 dark:text-gray-200">
                                            {{ $payment->installments }}x
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900 dark:text-gray-200">
                                            {{ $payment->showTypeValue()}}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900 dark:text-gray-200">
                                            {{ number_format($payment->getPrice($budget->getTotal()),2,',','.') }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900 dark:text-gray-200">
                                            <form action="{{ route('budgets.approve') }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="budget_id" value="{{ $budget->hashedId }}" />
                                                <input type="hidden" name="payment_id" value="{{ $payment->id }}" />
                                                <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                                                    Aprovar
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900 dark:text-gray-200">
                                            Nenhum Plano de Pagamento
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                </td>
            </tr>

        </tbody>
    </table>
</div>

<script>
    $(document).ready(function() {
        $('[data-accordion-target]').off('click').on('click', function() {
            let target = $(this).attr('data-accordion-target');
            console.log('target', target);
            $(target).slideToggle();
        });
    });
</script>
