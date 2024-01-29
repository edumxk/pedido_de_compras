@props(['purchase_order'])
<div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8 dark:bg-gray-800 bg-white">
    <h1 class="text-center text-3xl font-bold text-gray-900 dark:text-white">Interações da Ordem de Compra</h1>
    @foreach($purchase_order->interactions as $interaction)
        <div class="my-10">
            <h2 class="text-xl font-bold text-gray-900 dark:text-white mb-2">{{ $interaction->user->name }}</h2>
            <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-2">{{ $interaction->body }}</h2>
            <span class="text-gray-500 dark:text-gray-300">Postado em: {{ date_format($interaction->created_at, 'd/m/Y H:i:s') }}</span>

            <div class="mt-5">
                <x-attachment :purchase_order="$purchase_order" :type="'interaction'" :interaction="$interaction->id" :budget="null" />
            </div>
            @if($interaction->created_at->addHours(48) >= now() && Auth()->user()->id == $purchase_order->user_id)
                <button id="toggleButton{{ $interaction->id }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mt-5">
                    Uploads
                </button>

                <div id="uploads{{ $interaction->id }}" class="hidden mt-5">
                    <x-upload-attachment :purchase_order="$purchase_order" :interaction="$interaction->id" :budget="null" />
                </div>
            @endif
        </div>
    @endforeach
</div>
