@props(['purchase_order'])
<div class="max-w-7xl mx-auto py-5 sm:px-4 lg:px-6 dark:bg-gray-800 bg-white">
    <h1 class="text-center text-2xl font-semibold text-gray-900 dark:text-white">Interações da Ordem de Compra</h1>
    @foreach($purchase_order->interactions as $interaction)
        <div class="my-5">
            <h2 class="text-lg font-semibold text-gray-900 dark:text-white mb-1">{{ $interaction->user->name }}</h2>
            <h2 class="text-xl font-semibold text-gray-900 dark:text-white mb-1">{{ $interaction->body }}</h2>
            <span class="text-gray-500 dark:text-gray-300 pr-10">Postado em: {{ date_format($interaction->created_at, 'd/m/Y H:i:s') }}</span>
            @if($interaction->attachments->isNotEmpty())
                <button id="toggleButtonf{{ $interaction->id }}" class="bg-green-400 hover:bg-green-600 text-white font-bold py-1 px-3 rounded mb-3">
                    Ver Anexos
                </button>
                <div id="upload{{ $interaction->id }}" class="hidden">
                    <x-attachment :purchase_order="$purchase_order" :type="'interaction'" :interaction="$interaction->id" :budget="null" />
                </div>
            @endif
            @if($interaction->created_at->addHours(48) >= now() && Auth()->user()->id == $interaction->user_id)
                <button id="toggleButton{{ $interaction->id }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-3 rounded mb-3">
                    Uploads
                </button>
                <div id="uploads{{ $interaction->id }}" class="hidden mt-3">
                    <x-upload-attachment :purchase_order="$purchase_order" :interaction="$interaction->id" :budget="null" />
                </div>
            @endif
            <div class="border-b border-gray-300 mt-5"></div>
        </div>
    @endforeach
</div>
