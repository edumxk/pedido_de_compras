@props(['purchase_order'])

<div class="mt-4">
    <h3 class="text-lg font-semibold text-gray-800">Assunto: {{ $purchase_order->subject }}</h3>
    <p class="mt-2 text-gray-600">{{ $purchase_order->description }}</p>
</div>
