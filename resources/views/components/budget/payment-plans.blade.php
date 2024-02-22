<form action="{{ route('payments.store') }}" method="POST">
    @csrf
    <div class="flex flex-col">
        <div class="flex flex-row justify-between">
            <div class="flex flex-col">
                <label for="type" class="text-sm text-gray-600 dark:text-gray-400">Tipo</label>
                <select name="type" id="type" class="w-64 h-10 px-3 text-base placeholder-gray-300 border rounded-lg focus:shadow-outline">
                    <option value="boleto">Boleto</option>
                    <option value="pix">Pix</option>
                    <option value="credito">Crédito</option>
                    <option value="debito">Débito</option>
                    <option value="dinheiro">Dinheiro</option>
                    <option value="cheque">Cheque</option>
                    <option value="outros">Outros</option>
                </select>
            </div>
            <div class="flex flex-col">
                <label for="discount" class="text-sm text-gray-600 dark:text-gray-400">Desconto</label>
                <input type="text" name="discount" id="discount" class="w-64 h-10 px-3 text-base placeholder-gray-300 border rounded-lg focus:shadow-outline" placeholder="Desconto">
            </div>
            <div class="flex flex-col">
                <label for="installments" class="text-sm text-gray-600 dark:text-gray-400">Parcelas</label>
                <input type="text" name="installments" id="installments" class="w-64 h-10 px-3 text-base placeholder-gray-300 border rounded-lg focus:shadow-outline" placeholder="Parcelas">
            </div>
            <div class="flex flex-col">
                <label for="days" class="text-sm text-gray-600 dark:text-gray-400">Dias</label>
                <input type="text" name="days" id="days" class="w-64 h-10 px-3 text-base placeholder-gray-300 border rounded-lg focus:shadow-outline" placeholder="Valor Parcela">
            </div>
            <div class="flex flex-col">
                <label for="action" class="text-sm text-gray-600 dark:text-gray-400">Ação</label>
                <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                    Adicionar
                </button>
            </div>
        </div>
    </div>
</form>
