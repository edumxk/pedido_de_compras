<x-app-layout>
    <x-input-error/>
    <x-error/>
    <div class="bg-white dark:bg-gray-800 p-6 mx-auto border p-2 rounded-md mt-8 overflow-y-hidden mx-4">
        <x-filter-index :departments="$departments" />
    </div>
    <x-purchase-list :purchase_orders="$purchase_orders" />
</x-app-layout>
