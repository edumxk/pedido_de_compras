<x-app-layout>

    <x-input-error/>
    <x-error/>
    <img src="{{ asset('img/logo-long.png') }}" alt="Logo" width="200">
    <div class="bg-white dark:bg-gray-800 p-6 mx-auto border p-2 rounded-md mt-8 overflow-y-hidden mx-4">
            <a class="mt-4 inline-block bg-blue-500 text-white rounded px-4 py-2 ml-2" href=" {{ route('purchase_orders.create') }} ">{{ __('Nova ordem de Compra') }}</a>
            <x-filter-index :departments="$departments" />
        </div>

    <x-purchase-list :purchase_orders="$purchase_orders" />

</x-app-layout>
