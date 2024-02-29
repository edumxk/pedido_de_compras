@props(['purchase_order'])
@php
    try {
        $payment = $purchase_order->budgets->where('status', 'approved')->first()->payments->where('status', 'approved')->first();
    } catch (\Throwable $th) {
        $payment = null;
    }

@endphp
<div class="dark:bg-gray-800">
    <form class="mx-auto max-w-xl p-6 bg-white rounded shadow-md dark:bg-gray-700" method="POST" action="{{ route('provisions.store') }}">
        @csrf
        <input type="hidden" name="purchase_order_id" value="{{ $purchase_order->hashedId }}">
        <h2 class="text-2xl font-bold mb-5 text-gray-900 dark:text-white">Confirmação de Provisão</h2>
        <div class="mb-4">
            <label class="block text-gray-700 dark:text-gray-200 text-sm font-bold mb-2" for="name">
                Dados do Pagamento
            </label>
            <ol>
                <li class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline dark:bg-gray-800 dark:text-white" id="name" type="text" name="name" required>
                    {{ 'Tipo: ' . $payment->type }}
                </li>
                <li class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline dark:bg-gray-800 dark:text-white" id="name" type="text" name="name" required>
                    {{ "\nParcelas: " . $payment->installments . 'x'}}
                </li>
                <li class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline dark:bg-gray-800 dark:text-white" id="name" type="text" name="name" required>
                    {{ "\nPrazo: ". $payment->days }}
                </li>
                <li class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline dark:bg-gray-800 dark:text-white" id="name" type="text" name="name" required>
                    {{ "\nValor: " .
                     number_format($payment
                     ->getPrice($purchase_order->budgets
                     ->where('status', 'approved')
                     ->first()
                     ->getTotal()), 2, ',','.') }}
                </li>
            </ol>
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 dark:text-gray-200 text-sm font-bold mb-2" for="provision_confirmation">
                Confirmar Provisão
            </label>
            <div class="relative inline-block w-10 mr-2 align-middle select-none transition duration-200 ease-in">
                <input type="checkbox" name="provision_confirmation" id="provision_confirmation" class="toggle-checkbox absolute block w-6 h-6 rounded-full bg-white border-4 appearance-none cursor-pointer active:bg-blue"/>
                <label for="provision_confirmation" class="toggle-label block overflow-hidden h-6 rounded-full bg-gray-300 cursor-pointer"></label>
            </div>
        </div>
        <div class="flex items-center justify-between">
            <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
                Send
            </button>
        </div>
    </form>
</div>

<style>
    .toggle-checkbox:checked {
        right: 0;
        border-color: #1D4ED8;
        background-color: #1D4ED8;
    }

    .toggle-checkbox:checked + .toggle-label {
        background-color: #1D4ED8;
    }

    .toggle-checkbox:focus + .toggle-label,
    .toggle-checkbox:active + .toggle-label {
        box-shadow: 0 0 1px #4B5563;
    }

    .toggle-checkbox:checked:focus + .toggle-label,
    .toggle-checkbox:checked:active + .toggle-label {
        box-shadow: 0 0 1px #4B5563;
    }

    .toggle-checkbox:disabled + .toggle-label {
        background-color: #4B5563;
        box-shadow: none;
    }

    .toggle-checkbox:checked:disabled + .toggle-label {
        background-color: #4B5563;
        box-shadow: none;
    }
</style>
