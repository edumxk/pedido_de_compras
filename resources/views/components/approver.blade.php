@props(['purchase_order'])
<div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
    <h1 class="text-center text-3xl font-bold text-gray-900">Diretoria</h1>

    <form class="flex flex-col md:flex-row gap-6 mt-10" action="{{ route('purchase_orders.approve') }}" method="post">
        @csrf
        <input type="hidden" name="purchase_order_id" value="{{ $purchase_order->id }}">
        <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">

        <div class="flex-1">
            <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
            <select class="mt-1 block w-full rounded-md bg-gray-100 border-transparent focus:border-gray-500 focus:bg-white focus:ring-0" name="status">
                <option value="opened">Pendente</option>
                <option value="approved">Aprovar</option>
                <option value="rejected">Reprovar</option>
            </select>
        </div>

        <div class="flex-1">
            <label for="body" class="block text-sm font-medium text-gray-700">Comentário</label>
            <textarea class="mt-1 block w-full rounded-md bg-gray-100 border-transparent focus:border-gray-500 focus:bg-white focus:ring-0" name="body" id="body" cols="60" rows="3"></textarea>
        </div>

        <div class="flex items-end justify-end">
            <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" type="submit">Enviar</button>
        </div>
    </form>
</div>
