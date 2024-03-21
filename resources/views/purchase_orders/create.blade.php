<x-app-layout>


    <div class="bg-white dark:bg-gray-800 p-6 max-w-2xl mx-auto border p-2 rounded-md mt-8">
        @section('title', __('Nova Ordem de Compra'))
        <h1 class="text-center text-3xl font-bold text-gray-900 dark:text-white mb-4">{{ __('Nova Ordem de Compra') }}</h1>
        <x-input-error/>
        <x-error/>
        <form method="post" action="{{ route('purchase_orders.store') }}" class="space-y-4">
            @csrf
            <div class="flex flex-col space-y-2">
                <label for="purchase_subject" class="font-bold text-lg text-gray-900 dark:text-white">{{ __('Assunto') }}</label>
                <input type="text" class="border p-2 rounded-md" id="purchase_subject" name="purchase_subject" value="{{ old('purchase_subject') }}" placeholder="{{ __('Assunto') }}">
            </div>
            <div class="flex flex-col space-y-2">
                <label for="description" class="font-bold text-lg text-gray-900 dark:text-white">{{ __('Descrição') }}</label>
                <textarea rows="5" cols="80" class="border p-2 rounded-md" id="description" name="description" placeholder="{{ __('Descrição') }}">{{ old('description') }}</textarea>
            </div>
            <div class="flex flex-col space-y-2">
                <!-- get departments from database -->
                <label for="department_id" class="font-bold text-lg text-gray-900 dark:text-white">{{ __('Departamento') }}</label>
                <select name="department_id" id="department_id" class="border p-2 rounded-md">
                    @foreach($departments as $department)
                        @if($department->id == old('department_id'))
                            <option value="{{ $department->id }}" selected>{{ $department->name }}</option>
                        @else
                            <option value="{{ $department->id }}">{{ $department->name }}</option>
                        @endif
                    @endforeach
                </select>
            </div>
            <div class="flex justify-center">
                <button type="submit" class="rounded bg-blue-500 px-4 py-2 text-white font-bold text-sm uppercase tracking-wider">{{ __('Salvar') }}</button>
            </div>
        </form>
    </div>
</x-app-layout>
