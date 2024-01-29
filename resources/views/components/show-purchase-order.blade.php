@props(['purchase_order'])

    <div class="mt-4 dark:bg-gray-800 bg-white p-6 max-w-2xl mx-auto p-2 mt-8">
        <h3 class="text-lg font-semibold text-gray-800 dark:text-white">Assunto: {{ $purchase_order->purchase_subject }}</h3>
        <p class="mt-2 text-gray-600 dark:text-gray-300">{{ $purchase_order->description }}</p>
    </div>

