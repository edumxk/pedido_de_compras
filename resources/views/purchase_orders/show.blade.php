<x-app-layout>
    <div class="bg-white p-6">
        @if ($errors->any() || isset($message))
            <x-input-error :messages="$errors->all()"/>
            <a>{{ $message }}</a>
        @endif

            @if($purchase_order->status == 'approved')
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                    <strong class="font-bold">Aprovado!</strong>
                    <span class="block sm:inline">Esta ordem de compra foi aprovada.</span>
                </div>
            @elseif($purchase_order->status == 'rejected')
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                    <strong class="font-bold">Reprovado!</strong>
                    <span class="block sm:inline">Esta ordem de compra foi reprovada.</span>
                </div>
            @else
                <div class="bg-yellow-100 border border-yellow-400 text-yellow-700 px-4 py-3 rounded relative" role="alert">
                    <strong class="font-bold">Pendente!</strong>
                    <span class="block sm:inline">Esta ordem de compra está pendente de aprovação.</span>
                </div>
            @endif

        <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
            <h1 class="text-center text-3xl font-bold text-gray-900">Detalhes da Ordem de Compra</h1>
        </div>

        <div class="flex flex-col md:flex-row md:space-x-6 space-y-6 md:space-y-0">
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
