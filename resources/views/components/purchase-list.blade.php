@props(['purchase_orders'])

<div class="bg-white dark:bg-gray-800 p-6 mx-auto border p-2 rounded-md mt-8 overflow-y-hidden mx-4">


    @if($purchase_orders)
        <div class="grid grid-rows-1 grid-rows-subgrid overflow-hidden min-w-[130rem] sm:grid-cols-8 gap-4 sm:overflow-x-auto sm:grid-auto-flow max-w-auto ">
            @foreach(['opened', 'approved', 'budget', 'provision', 'purchase', 'received', 'finished','rejected'] as $status)
                <div class=" max-w-64 ">
                    <h2 class="text-lg font-semibold text-gray-900 dark:text-white mb-4 text-center">{{ ucfirst($status) }}</h2>
                    @foreach($purchase_orders->where('status', $status) as $purchase_order)
                        <div class="bg-white dark:bg-gray-800 p-4 rounded-md border border-gray-200 dark:border-gray-700 shadow m-2 min-h-64">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">{{ $purchase_order->purchase_subject }}</h3>
                            <p class="mt-2 text-gray-600 dark:text-gray-300">{{ __($purchase_order->user->name) }}</p>
                            <p class="mt-2 text-gray-600 dark:text-gray-300">{{ __($purchase_order->department->name) }}</p>
                            <p class="mt-2 text-gray-600 dark:text-gray-300"> {{ date_format($purchase_order->created_at,'d/m/Y H:i') }}</p>
                            <a href="{{ route('purchase_orders.show', $purchase_order->hashedId) }}" class="mt-4 inline-block bg-blue-500 text-white rounded px-4 py-2">{{ __('Ver detalhes') }}</a>
                            @if($status == 'approved')
                                <a href="{{ route('budgets.index', $purchase_order->hashedId) }}" class="mt-4 inline-block bg-blue-500 text-white rounded px-4 py-2">{{ __('Inserir Orçamento') }}</a>
                            @endif
                        </div>
                    @endforeach
                </div>
            @endforeach
        </div>
    @endif
</div>
