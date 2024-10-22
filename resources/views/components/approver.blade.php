@props(['purchase_order'])
<div class="grid grid-cols-1 gap-8 max-w-2xl mx-auto px-10 rounded shadow">
    <h1 class="text-center text-3xl font-bold text-gray-900 dark:text-gray-200">Diretoria</h1>

    <form class="md:flex-row gap-6 mt-10" action="{{ route('purchase_orders.approve') }}" method="post">
        @csrf
        <input type="hidden" name="purchase_order_id" value="{{ $purchase_order->id }}">
        <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">

        <div class="py-3">
            <label for="status" class="block text-lg font-medium text-gray-700 dark:text-gray-200">Status</label>
            <select class="mt-1 block w-full rounded-md bg-gray-100 dark:border-gray-600 focus:border-gray-500 focus:bg-white focus:ring-0 dark:bg-gray-800 dark:focus:bg-gray-800 dark:text-gray-200 dark:focus:border-gray-200" name="status" id="status">
                <option value="opened">Pendente</option>
                <option value="approved">Aprovar</option>
                <option value="rejected">Reprovar</option>
                <option value="received">Aprovação Direta Para Provisão</option>
            </select>
        </div>

        <div class="py-3">
            <label for="body-approver" class="block text-lg font-medium text-gray-700 dark:text-gray-200">Comentário</label>
            <textarea class="mt-1 block w-full rounded-md bg-gray-100 border-transparent focus:border-gray-500 focus:bg-white focus:ring-0 dark:bg-gray-900 dark:focus:bg-gray-700 dark:text-gray-200" name="body" id="body-approver" cols="60" rows="3"></textarea>
        </div>

        <div class="text-right py-3">
            <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" type="submit">Enviar</button>
        </div>
    </form>
</div>
