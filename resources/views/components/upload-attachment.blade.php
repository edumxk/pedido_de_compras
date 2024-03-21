@props(['purchase_order'])
@props(['interaction'])
@props(['budget'])
<div class="p-2">

    <form action="{{ route('attachments.upload')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="purchase_order_id" value="{{ $purchase_order->id }}">
        <input type="hidden" name="interaction_id" value="{{ $interaction }}">
        <input type="hidden" name="budget_id" value="{{ $budget }}">
        <div class="flex space-x-8">
            <x-grommet-form-attachment width="50px" class="dark:text-white" />
            <input class="dark:text-gray-200 w-full py-2" type="file" name="file" id="file">
            <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" type="submit">Enviar</button>
        </div>
    </form>
</div>
