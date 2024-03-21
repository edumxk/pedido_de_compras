@props(['purchase_order'])
<div class="dark:bg-gray-800 mx-auto p-6 bg-white rounded shadow-md dark:bg-gray-700">
    <div class="mb-4">
        <h1 class="text-3xl font-bold mb-5 text-gray-900 dark:text-white text-center">Confirmar Recebimento</h1>
    </div>
    <form class="mx-auto max-w-xl p-6 bg-white rounded shadow-md dark:bg-gray-700" method="POST" action="{{ route('provisions.received') }}">
        @csrf
        <input type="hidden" name="purchase_order_id" value="{{ $purchase_order->hashedId }}">
        <div class="mb-4">
            <label class="block text-gray-700 dark:text-gray-200 text-sm font-bold mb-2" for="provision_confirmation">
                Confirmar Compra
            </label>
            <div class="relative inline-block w-10 mr-2 align-middle select-none transition duration-200 ease-in">
                <input type="checkbox" name="received_confirmation" id="received_confirmation" class="toggle-checkbox absolute block w-6 h-6 rounded-full bg-white border-4 appearance-none cursor-pointer active:bg-blue"/>
                <label for="received_confirmation" class="toggle-label block overflow-hidden h-6 rounded-full bg-gray-300 cursor-pointer"></label>
            </div>
        </div>
        <div class="flex items-center justify-between">
            <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
                Enviar
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
