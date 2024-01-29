<x-app-layout>
    <div class="bg-white dark:bg-gray-800 p-6  min-w-[130rem] mx-auto border p-2 rounded-md mt-8 overflow-y-hidden ">
        <div class="py-4">
            <a class="mt-4 inline-block bg-blue-500 text-white rounded px-4 py-2" href=" {{ route('purchase_orders.create') }} ">{{ __('Nova ordem de Compra') }}</a>
        </div>

        <x-filter-index :departments="$departments" />

        @if($purchase_orders)
            <div class="grid grid-rows-1 grid-rows-subgrid sm:grid-cols-8 gap-4 sm:overflow-x-auto sm:grid-auto-flow max-w-auto ">
                @foreach(['opened', 'approved', 'budget', 'provision', 'purchase', 'received', 'finished','rejected'] as $status)
                    <div class="min-w-64 max-w-64">
                        <h2 class="text-lg font-semibold text-gray-900 dark:text-white mb-4 text-center">{{ ucfirst($status) }}</h2>
                        @foreach($purchase_orders->where('status', $status) as $purchase_order)
                            <div class="bg-white dark:bg-gray-800 p-4 rounded-md border border-gray-200 dark:border-gray-700 shadow m-2 min-h-64">
                                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">{{ $purchase_order->purchase_subject }}</h3>
                                <p class="mt-2 text-gray-600 dark:text-gray-300">{{ __($purchase_order->user->name) }}</p>
                                <p class="mt-2 text-gray-600 dark:text-gray-300">{{ __($purchase_order->department->name) }}</p>
                                <p class="mt-2 text-gray-600 dark:text-gray-300"> {{ date_format($purchase_order->created_at,'d/m/Y H:i') }}</p>
                                <a href="{{ route('purchase_orders.show', $purchase_order->id) }}" class="mt-4 inline-block bg-blue-500 text-white rounded px-4 py-2">{{ __('Ver detalhes') }}</a>
                            </div>
                        @endforeach
                    </div>
                @endforeach
            </div>
        @endif
    </div>


</x-app-layout>
