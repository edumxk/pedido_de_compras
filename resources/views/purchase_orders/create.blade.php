
<x-app-layout>
    @section('title', __('Nova Ordem de Compra'))
    <h1>{{ __('Nova Ordem de Compra') }}</h1>
    @if($errors->any())
        <div class="bg-red-50 rounded">
            <ul>
                @foreach ($errors->all() as $error)
                    <li class="text-red-600">{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form method="post" action="{{ route('purchase_orders.store') }}">
        @csrf
        <div class="form-group">
            <label for="purchase_subject">{{ __('Assunto') }}</label>
            <input type="text" class="form-control" id="purchase_subject" name="purchase_subject" placeholder="{{ __('Assunto') }}">
        </div>
        <div class="form-group">
            <label for="description">{{ __('Descrição') }}</label>
            <textarea rows="10" cols="80" class="form-control" id="description" name="description" placeholder="{{ __('Descrição') }}"></textarea>
        </div>
        <div>
            <!-- get departments from database -->
            <label for="department_id">{{ __('Departamento') }}</label>
            <select name="department_id" id="department_id">
                @foreach($departments as $department)
                    <option value="{{ $department->id }}">{{ $department->name }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">{{ __('Salvar') }}</button>
    </form>
</x-app-layout>
