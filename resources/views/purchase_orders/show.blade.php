<x-app-layout>
    <div class="bg-white p-6">
        @if ($errors->any() || isset($message))
            <x-input-error :messages="$errors->all()"/>
            <a>{{ $message }}</a>
        @endif

        <x-status-order :purchase_order="$purchase_order" />

        <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
            <h1 class="text-center text-3xl font-bold text-gray-900">Detalhes da Ordem de Compra</h1>
        </div>

        <div class="flex flex-col md:flex-row md:space-x-12 space-y-12 md:space-y-0">
            <div class="flex-1">
                <div class="p-6 bg-white shadow rounded-lg">
                    <h2 class="text-xl font-bold text-gray-900">Informações da Ordem de Compra</h2>
                    @if($purchase_order->status == 'opened' )
                        <x-edit-purchase-order :purchase_order="$purchase_order" :departments="$departments" />
                    @else
                        <x-show-purchase-order :purchase_order="$purchase_order" :departments="$departments" />
                    @endif

                </div>
            </div>

            <div class="flex-1">
                <div class="p-6 bg-white shadow rounded-lg">
                    <h2 class="text-xl font-bold text-gray-900">Interactions</h2>
                    <div>
                        <x-interaction-show :purchase_order="$purchase_order" ></x-interaction-show>
                    </div>

                </div>
            </div>
        </div>

            <div>
                <x-interaction-create :purchase_order="$purchase_order" />
            </div>

            <div class="mt-6">
                <x-approver :purchase_order="$purchase_order" />
            </div>
    </div>


</x-app-layout>
