<x-app-layout>
    <div class="bg-white">
        <ul class="px-6">
            <li class="p-2">{{ $purchase_order->purchase_subject }}</li>
            <li class="p-2">{{ $purchase_order->description }}</li>
            <li class="p-2">{{ date_format($purchase_order->created_at,'d/m/Y H:i:s' )  }}</li>
            <li class="p-2">{{ date_format($purchase_order->updated_at,'d/m/Y H:i:s' )  }}</li>
        </ul>

        <a class="w-20 bg-red-500 ml-2 p-2 rounded " href="{{ route('purchase_orders.index') }}"> Retornar</a>
    </div>


</x-app-layout>
