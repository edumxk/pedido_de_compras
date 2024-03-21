@props(['purchase_orders'])
<div class="bg-white dark:bg-gray-800 p-6 mx-auto border p-2 rounded-md mt-8 overflow-y-hidden mx-4">


    @if($purchase_orders)
        <div class="grid grid-rows-1 grid-rows-subgrid overflow-hidden min-w-[130rem] sm:grid-cols-8 gap-4 sm:overflow-x-auto sm:grid-auto-flow max-w-auto ">
            @foreach(['opened', 'approved', 'budget', 'provision', 'purchase', 'received', 'finished','rejected'] as $status)
                <div class=" max-w-64 ">
                    <h2 class="text-lg font-semibold text-gray-900 dark:text-white mb-4 text-center">{{ ucfirst(__($status.'_plural')) }}</h2>
                    @forelse($purchase_orders->where('status', $status) as $purchase_order)
                        <a href="{{ route('purchase_orders.show', $purchase_order->hashedId) }}">
                            <div class="rounded-md border border-gray-200 dark:border-gray-700 shadow m-2 min-h-64">
                                    <div class="bg-{{ 'gray-800' }} dark:bg-{{ 'gray-200' }} h-10 w-100 flex items-center justify-center rounded-t">
                                        <p class="text-{{ 'gray-200' }} dark:text-{{ 'gray-800' }} font-bold">{{ __($purchase_order->department->name) }}</p>
                                    </div>
                                    <div class="h-16">
                                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white mt-2 text-center">{{ \Illuminate\Support\Str::limit($purchase_order->purchase_subject, 48) }}</h3>
                                    </div>
                                <div class="bg-white dark:bg-gray-800 px-4">
                                    <p class="mt-2 text-gray-600 dark:text-gray-300">{{ __($purchase_order->user->name) }}</p>
                                    <p class="mt-2 text-gray-600 dark:text-gray-300"> {{ date_format($purchase_order->created_at,'d/m/Y H:i') }}</p>
                                </div>
                                <div class="text-center">
                                    @if(($status == 'approved' || $status == 'budget') && Auth::user()->is_buyer)
                                         <a href="{{ route('budgets.create', $purchase_order->hashedId) }}" class="mt-4 inline-block bg-green-500 text-white rounded px-4 py-2">{{ __('Inserir Orçamento') }}</a>
                                    @endif
                                </div>
                            </div>
                        </a>
                    @empty
                        <div class="bg-white dark:bg-gray-800 p-4 rounded-md border border-gray-200 dark:border-gray-700 shadow m-2 min-h-64">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">{{ __('Vazio') }}</h3>
                        </div>
                    @endforelse
                </div>
            @endforeach
        </div>
    @endif
</div>
