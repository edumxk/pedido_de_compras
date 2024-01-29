<form method="POST" action="{{ route('purchase_orders.index') }}">
    <div class="flex flex-col sm:flex-row space-y-2 sm:space-y-0 sm:space-x-2 py-6">
        @csrf
        <input type="text" name="subject_description" class="border p-2 rounded-md w-full sm:w-64" placeholder="Assunto ou Descrição" value="{{ request('subject_description') }}">
        <select name="department_id" class="border p-2 rounded-md w-full sm:w-64">
            <option value="" selected>Selecione um Departamento</option>
            @foreach($departments as $department)
                <option value="{{ $department->id }}" {{ request('department_id') == $department->id ? 'selected' : '' }}>{{ $department->name }}</option>
            @endforeach
        </select>
        <input type="text" name="user_name" class="border p-2 rounded-md w-full sm:w-64" placeholder="Nome do Usuário" value="{{ request('user_name') }}">
        <button type="submit" class="bg-blue-500 text-white rounded px-4 py-2 w-full sm:w-auto">{{ __('Filtrar') }}</button>
    </div>
</form>
