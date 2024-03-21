<form action="{{ route('payments.store') }}" method="POST">
    @csrf
    <div class="flex flex-col">
        <div class="flex flex-row justify-between">
            <div class="flex flex-col">
                <label for="type" class="text-sm text-gray-600 dark:text-gray-400">Tipo</label>
                <select name="type" id="type" class="w-64 h-10 px-3 text-base placeholder-gray-300 border rounded-lg focus:shadow-outline" @selected('type')>
                    <option {{ old('type') == 'boleto' ? 'selected' : '' }} value="boleto">Boleto</option>
                    <option {{ old('type') == 'pix' ? 'selected' : '' }} value="pix">Pix</option>
                    <option {{ old('type') == 'credito' ? 'selected' : '' }} value="credito">Crédito</option>
                    <option {{ old('type') == 'debito' ? 'selected' : '' }} value="debito">Débito</option>
                    <option {{ old('type') == 'dinheiro' ? 'selected' : '' }} value="dinheiro">Dinheiro</option>
                    <option {{ old('type') == 'cheque' ? 'selected' : '' }} value="cheque">Cheque</option>
                    <option {{ old('type') == 'outros' ? 'selected' : '' }} value="outros">Outros</option>
                </select>
            </div>
            <div>
                <input name="budget_id" id="budget_id" hidden value="{{ $budget->hashedId }}" >
            </div>
            <div class="flex flex-col">
                <label for="discount" class="text-sm text-gray-600 dark:text-gray-400">Desconto</label>
                <input type="text" name="discount" id="discount" class="w-24 h-10 px-3 text-base placeholder-gray-300 border rounded-lg focus:shadow-outline" placeholder="Desconto" value="{{ old('discount') }}">
            </div>
            <div class="flex flex-col">
                <label for="addition" class="text-sm text-gray-600 dark:text-gray-400">Acrécimo</label>
                <input type="text" name="addition" id="addition" class="w-24 h-10 px-3 text-base placeholder-gray-300 border rounded-lg focus:shadow-outline" placeholder="Desconto" value="{{ old('addition') }}">
            </div>
            <div class="flex flex-col">
                <label for="installments" class="text-sm text-gray-600 dark:text-gray-400">Parcelas</label>
                <input type="text" name="installments" id="installments" class="w-32 h-10 px-3 text-base placeholder-gray-300 border rounded-lg focus:shadow-outline" value="{{ old('installments') }}" placeholder="Parcelas">
            </div>
            <div class="flex flex-col">
                <label for="days" class="text-sm text-gray-600 dark:text-gray-400">Dias</label>
                <input type="text" name="days" id="days" class="w-64 h-10 px-3 text-base placeholder-gray-300 border rounded-lg focus:shadow-outline" value="{{ old('days') }}" placeholder="30, 60, 90, 120...">
            </div>
            <div class="flex flex-col">
                <label for="action" class="text-sm text-gray-600 dark:text-gray-400 text-center">Ação</label>
                <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                    Adicionar
                </button>
            </div>
        </div>
    </div>
</form>
