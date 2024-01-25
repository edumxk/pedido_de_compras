@props(['purchase_order', 'departments'])

<div>
    @if ($errors->any())
        <x-input-error :messages="$errors->all()"/>
    @endif
    <form action="{{ route('purchase_orders.update', $purchase_order->id) }}" method="POST">
        @csrf
            <div>
                <label for="purchase_subject">Assunto</label>
                <input type="text" name="purchase_subject" id="purchase_subject" value="{{ $purchase_order->purchase_subject }}" />
            </div>
            <div>
                <label for="description">Descrição</label>
                <textarea rows="5" cols="80" type="text" name="description" id="description">{{ $purchase_order->description }}</textarea>
            </div>
            <div>
                <label for="department_id">Departamento</label>
                <select name="department_id" id="department_id">
                    @foreach($departments as $department)
                        @if($department->id == $purchase_order->department_id)
                            <option value="{{ $department->id }}" selected>{{ $department->name }}</option>
                        @else
                            <option value="{{ $department->id }}">{{ $department->name }}</option>
                        @endif
                    @endforeach
                </select>
            </div>
        <div class="">
            <button class="rounded bg-red-500 p-3" type="submit">Salvar Edição</button>
        </div>
    </form>
    <div>
        <x-attachment :purchase_order="$purchase_order" :type="'order'" />
        <x-upload-attachment :purchase_order="$purchase_order" :interaction="null" :budget="null"/>
    </div>
</div>
