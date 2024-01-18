
<x-app-layout>
    @section('title', __('Nova Ordem de Compra'))
    <h1>{{ __('Nova Ordem de Compra') }}</h1>
    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
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
        <button type="submit" class="btn btn-primary">{{ __('Salvar') }}</button>
    </form>
</x-app-layout>
