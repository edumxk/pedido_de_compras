<x-app-layout>
    <div class="bg-white dark:bg-gray-800 p-6">
        @if ($errors->any() || isset($message))
            <x-input-error :messages="$errors->all()"/>
            <a>{{ $message }}</a>
        @endif

        <x-status-order :purchase_order="$purchase_order" />

        <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
            <h1 class="text-center text-3xl font-bold text-gray-900 dark:text-gray-200">Detalhes da Ordem de Compra</h1>
        </div>

        <div class="grid grid-cols-1 gap-12">

            <div class="p-6 bg-white dark:bg-gray-800 shadow rounded-lg">
                <h2 class="text-xl font-bold text-gray-900 dark:text-gray-200">Informações da Ordem de Compra</h2>
                @if($purchase_order->status == 'opened' )
                    <x-edit-purchase-order :purchase_order="$purchase_order" :departments="$departments" />
                @else
                    <x-show-purchase-order :purchase_order="$purchase_order" :departments="$departments" />
                @endif
            </div>

            <div class="p-6 bg-white dark:bg-gray-800 shadow rounded-lg">
                <h2 class="text-xl font-bold text-gray-900 dark:text-gray-200">Interactions</h2>
                <x-interaction-show :purchase_order="$purchase_order" ></x-interaction-show>
            </div>

            <div class="p-6 bg-white dark:bg-gray-800 shadow rounded-lg">
                <h2 class="text-xl font-bold text-gray-900 dark:text-gray-200">Orçamentos</h2>
                @forelse($purchase_order->budgets as $budget)
                    <x-budget.card :budget="$budget" />
                @empty
                    <p class="text-center">Nenhum Orçamento</p>
                @endforelse
            </div>

        </div>

        <x-interaction-create :purchase_order="$purchase_order" />

        @if($purchase_order->status == 'opened')
            <x-approver :purchase_order="$purchase_order" />
        @endif

    </div>
</x-app-layout>
