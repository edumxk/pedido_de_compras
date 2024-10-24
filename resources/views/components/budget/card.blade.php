<div class="dark:bg-gray-800 py-16">
    <div class="flex items-center hover:cursor-pointer hover:dark:bg-gray-700 hover:bg-gray-200 justify-between w-full p-5 font-medium text-gray-500 border border-b-0 border-gray-200 rounded-t-xl focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-800 dark:border-gray-700 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800 gap-3" data-accordion-target="#accordion-collapse-body-product-{{ $budget->id }}" aria-expanded="false" aria-controls="accordion-collapse-body-product-{{ $budget->id }}">

        <span>
            <label>Range de Preço do Orçamento:</label>
            <label class="text-sm text-gray-900 dark:text-gray-200 text-center">
                @php
                    $range = [];
                    foreach( $budget->payments as $payment ) {
                        $range[]= $payment->getPrice($budget->getTotal());
                    }
                @endphp
                {{ $budget->showRangePrice($range) }}
            </label>
        </span>
        <span>
            <a href="{{ route('budgets.products', $budget->hashedId) }}" title="Clique para Editar o Orçamento" class="text-sm text-gray-900 dark:text-gray-200 p-6 hover:dark:bg-gray-500">
                <label>Fornecedor:</label>
                <label class="text-sm uppercase text-gray-900 dark:text-gray-200">
                    {{ $budget->supplier->fantasy_name }}
                </label>
            </a>
            @if($budget->status == 'approved')
                <span class="bg-green-500 text-white font-bold py-2 px-4 rounded">Aprovado</span>
            @elseif($budget->status == 'rejected')
                <span class="bg-red-500 text-white font-bold py-2 px-4 rounded">Reprovado</span>
            @else
                <span class="bg-yellow-500 text-white font-bold py-2 px-4 rounded">Pendente</span>
            @endif
        </span>
        <span>
            <label>Valor dos Produtos:</label>
            <label class="text-sm text-gray-900 dark:text-gray-200">
                R$ {{ number_format($budget->getTotal(),2,',','.') }}
            </label>
        </span>

        <svg data-accordion-icon class="w-3 h-3 rotate-180 shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5 5 1 1 5"/>
        </svg>
    </div>
    <div id="accordion-collapse-body-product-{{ $budget->id }}" class="">
        <x-budget.products :budget="$budget"/>
        <x-budget.budget-approve :budget="$budget"/>
    </div>
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
