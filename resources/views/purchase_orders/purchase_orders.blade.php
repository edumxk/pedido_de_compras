<x-app-layout>

    <div>
        <div class="p-4">

            <a class="bg-white rounded border-gray-500 p-1" href=" {{ route('purchase_orders.create') }} ">{{ __('Nova ordem de Compra') }}</a>

        </div>



        @if($purchase_orders)
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                {{ __('Assunto') }}
                            </th>
                            <th scope="col" class="px-6 py-3">
                                {{ __('Descrição') }}</th>
                            <th scope="col" class="px-6 py-3">
                                {{ __('Solicitante') }}</th>
                            <th scope="col" class="px-6 py-3">
                                {{ __('Status') }}</th>
                            <th scope="col" class="px-6 py-3">
                                {{ __('Departamento') }}</th>
                            <th scope="col" class="px-6 py-3">
                                {{ __('Abertura') }}</th>
                            </tr>
                    </thead>
                    <tbody>
                    @foreach($purchase_orders as $purchase_order)
                       <tr>
                            <td>{{ $purchase_order->purchase_subject }}</td>
                           <td> <a href="{{ route('purchase_orders.show', $purchase_order->id) }}"> {{ substr($purchase_order->description, 0,75).'...' }}</a></td>
                            <td>{{ $purchase_order->user->name }}</td>
                            <td>{{ $purchase_order->status }}</td>
                            <td>{{ $purchase_order->department->name }}</td>
                            <td>{{ date_format($purchase_order->created_at,'d/m/Y H:i') }}</td>
                       </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
</x-app-layout>
