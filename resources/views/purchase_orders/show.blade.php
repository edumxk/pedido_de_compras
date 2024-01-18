<x-app-layout>
    <div class="bg-white">
        <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
            <h1 class="text-center text-3xl font-bold text-gray-900">Detalhes da Ordem de Compra</h1>
        </div>


    <div class="flex justify-center pb-5 px-6">
        <div class="inline-block w-48 h-12 text-center ">
            <label class="" for="purchase_subject">{{ __("Assunto") }}</label>
        </div>
        <div class="flex grow justify-items-center h-12">
            <input class="grow rounded border-0 p-0" type="text" id="purchase_subject" name="purchase_subject" value="{{ $purchase_order->purchase_subject }}" disabled>
        </div>
    </div>
    <div class="flex justify-center pb-5 px-6">
        <div class="inline-block w-48 h-12 text-center ">
            <label class="" for="description">{{ __("Descrição") }}</label>
        </div>
        <div class="flex grow justify-items-center h-12">
            <input class="grow rounded border-0 p-0 hover:text-gray-500 type="text" id="description" name="description" value="{{ $purchase_order->description }}" disabled>
        </div>
    </div>
        <a class="w-20 bg-red-500 ml-2 p-2 rounded bg-gray-500" href="{{ route('purchase_orders.index') }}"> Retornar</a>


</div>


</x-app-layout>
