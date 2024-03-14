<x-app-layout>

    <div class="bg-white dark:bg-gray-800 p-6">
        <x-auth-session-status class="mb-4" :status="session('status')" />
        <x-input-error/>
        <x-error/>
        <x-status-order :purchase_order="$purchase_order"/>

        <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
            <h1 class="text-center text-3xl font-bold text-gray-900 dark:text-gray-200">Detalhes da Ordem de Compra</h1>
        </div>
        <div class="grid grid-cols-1 gap-8">
            <div class="px-6 bg-white dark:bg-gray-800 shadow rounded-lg">
                @if($purchase_order->status == 'opened' && Auth::user()->id == $purchase_order->user_id)
                    <x-edit-purchase-order :purchase_order="$purchase_order" :departments="$departments"/>
                @else
                    <x-show-purchase-order :purchase_order="$purchase_order" :departments="$departments"/>
                @endif
            </div>

            <div class="p-6 bg-white dark:bg-gray-800 shadow rounded-lg">
                <x-interaction-show :purchase_order="$purchase_order"></x-interaction-show>
            </div>
            @if($purchase_order->status != 'finished')
                <x-interaction-create :purchase_order="$purchase_order"/>
            @endif
            <div class="p-6 bg-white dark:bg-gray-800 shadow rounded-lg">
                <h2 class="text-2xl font-bold text-gray-900 dark:text-gray-200 text-center">Orçamentos</h2>
                @forelse($purchase_order->budgets as $budget)
                    <x-budget.card :budget="$budget"/>
                @empty
                    <p class="text-center dark:text-gray-200">Nenhum Orçamento</p>
                @endforelse
                @if(($purchase_order->status == 'budget' || $purchase_order->status == 'approved' ) && Auth::user()->is_buyer)
                    <a class="mt-4 inline-block bg-green-500 text-white rounded px-4 py-2 ml-2" href="{{ route('budgets.create', $purchase_order->hashedId ) }}">{{ __('Inserir Orçamento') }}</a>
                @endif
                @if($purchase_order->budgets->first() && $purchase_order->status == 'provision' && Auth::user()->is_admin == 1)
                    <form action="{{ route('budgets.reprove') }}" class="flex" method="post" >
                        @csrf
                        <input type="hidden" name="purchase_order_id" value="{{ $purchase_order->hashedId }}">
                        <button class="mt-4 inline-block bg-red-500 text-white rounded px-4 py-2 ml-2" type="submit">{{ __('Reprovar Orçamento') }}</button>
                    </form>
                @endif
            </div>
            @if($purchase_order->status == 'provision' && Auth::user()->is_financial == 1 )
                <x-provision.index :purchase_order="$purchase_order"/>
            @endif


            @if($purchase_order->status == 'opened' && Auth::user()->is_admin)
                <x-approver :purchase_order="$purchase_order"/>
            @endif

            @if($purchase_order->status == 'purchase' && (Auth::user()->is_buyer || Auth::user()->id == $purchase_order->user_id))
                <x-provision.buy :purchase_order="$purchase_order"/>
            @endif

            @if($purchase_order->status == 'received' && (Auth::user()->is_buyer || Auth::user()->id == $purchase_order->user_id))
                <x-provision.finish :purchase_order="$purchase_order"/>
            @endif

        </div>


    </div>
</x-app-layout>
