@props(['purchase_order'])

    <div class="dark:bg-gray-800 bg-white p-6 max-w-2xl mx-auto px-2">
        <h3 class="text-2xl font-semibold text-gray-800 dark:text-white pb-2 text-center">{{ $purchase_order->purchase_subject }}</h3>
        <textarea rows="5" cols="auto" type="text" name="description" id="description" readonly class="w-full border p-2 rounded-md">{{ $purchase_order->description }}</textarea>
    </div>

    @if(Auth::user()->id == $purchase_order->user_id || Auth::user()->is_admin == 1 || Auth::user()->is_buyer == 1 || Auth::user()->is_financial == 1)
    <div class="flex flex-col space-y-4">
        <x-attachment :purchase_order="$purchase_order" :type="'order'" />
    </div>
    @endif

