@props(['purchase_order', 'departments'])

<div class="flex flex-col space-y-4">
    @if ($errors->any())
        <x-input-error :messages="$errors->all()"/>
    @endif
    <form action="{{ route('purchase_orders.update', $purchase_order->id) }}" method="POST" class="space-y-4">
        @csrf
        <div class="flex flex-col space-y-2">
            <label for="purchase_subject" class="font-bold text-lg">Assunto</label>
            <input type="text" name="purchase_subject" id="purchase_subject" value="{{ $purchase_order->purchase_subject }}" class="border p-2 rounded-md" />
        </div>
        <div class="flex flex-col space-y-2">
            <label for="description" class="font-bold text-lg">Descrição</label>
            <textarea rows="5" cols="80" type="text" name="description" id="description" class="border p-2 rounded-md">{{ $purchase_order->description }}</textarea>
        </div>
        <div class="flex flex-col space-y-2">
            <label for="department_id" class="font-bold text-lg">Departamento</label>
            <select name="department_id" id="department_id" class="border p-2 rounded-md">
                @foreach($departments as $department)
                    @if($department->id == $purchase_order->department_id)
                        <option value="{{ $department->id }}" selected>{{ $department->name }}</option>
                    @else
                        <option value="{{ $department->id }}">{{ $department->name }}</option>
                    @endif
                @endforeach
            </select>
        </div>
        <div class="flex justify-center">
            <button class="rounded bg-red-500 p-3 text-white font-bold" type="submit">Salvar Edição</button>
        </div>
    </form>
    <div class="flex flex-col space-y-4">
        <x-attachment :purchase_order="$purchase_order" :type="'order'" />
        <x-upload-attachment :purchase_order="$purchase_order" :interaction="null" :budget="null"/>
    </div>
</div>
