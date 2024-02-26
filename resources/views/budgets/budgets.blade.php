<x-app-layout>

    <div class="bg-white dark:bg-gray-800 p-6 mx-auto border p-2 rounded-md mt-8 overflow-y-hidden mx-4">
        <x-show-purchase-order :purchase_order="$purchase_order" />
        <x-attachment :purchase_order="$purchase_order" type="order"/>
        <div class="flex justify-end">
            <a href="{{ route('budgets.create', $purchase_order->hashedId) }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                Novo Orçamento
            </a>
        </div>
    </div>

    <div class="bg-white dark:bg-gray-800 p-6 mx-auto border p-2 rounded-md mt-8 overflow-y-hidden mx-4">
        <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Orçamentos</h1>
        <div class="flex flex-col mt-4">
            @forelse($budgets as $budget)
                <x-budget.card :budget="$budget" />
            @empty
                <p class="text-center">Nenhum Orçamento</p>
            @endforelse
        </div>
    </div>


</x-app-layout>
