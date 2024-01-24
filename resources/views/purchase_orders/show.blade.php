<x-app-layout>
    <div class="bg-white p-6">
        @if ($errors->any())
            <x-input-error :messages="$errors->all()"/>
        @endif

        <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
            <h1 class="text-center text-3xl font-bold text-gray-900">Detalhes da Ordem de Compra</h1>
        </div>

        <x-edit-purchase-order :purchase_order="$purchase_order" :departments="$departments" />

        <div>
            <x-interaction :purchase_order="$purchase_order" ></x-interaction>
        </div>

    </div>

</x-app-layout>
