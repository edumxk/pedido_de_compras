@props(['purchase_order'])
<div class="mx-auto py-10 sm:px-6 lg:px-8 dark:bg-gray-800 shadow rounded-lg">
    <form class="grid flex-col md:flex-row gap-6 mx-auto" action="{{ route('interactions.store') }}" method="post">
        @csrf
        <input type="hidden" name="purchase_order_id" value="{{ $purchase_order->id }}">
        <div class="flex-1">
            <label for="body" class="block text-xl font-medium dark:text-gray-200 text-gray-700 my-3">Comentário</label>
            <textarea class="mt-1 block w-full rounded-md bg-gray-200 border-transparent focus:border-gray-600 focus:bg-white focus:ring-0 dark:focus:bg-gray-800 dark:focus:text-gray-100 dark:bg-gray-900 dark:text-gray-100" name="body" id="body" cols="60" rows="3"></textarea>
        </div>
        <div class="flex items-end justify-end">
            <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" type="submit">Enviar</button>
        </div>
    </form>
</div>
