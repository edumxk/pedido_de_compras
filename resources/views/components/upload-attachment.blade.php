@props(['purchase_order'])
@props(['interaction'])
@props(['budget'])
<div class="p-2">
    <x-grommet-form-attachment width="30px" />
    <form action="{{ route('attachments.upload')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="purchase_order_id" value="{{ $purchase_order->id }}">

        <input type="hidden" name="interaction_id" value="{{ $interaction }}">

        <input type="hidden" name="budget_id" value="{{ $budget }}">

        <input class="text-sm bg-white text-gray-800" type="file" name="file" id="file">
        <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" type="submit">Enviar</button>
    </form>
</div>
