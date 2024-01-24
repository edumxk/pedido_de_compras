@props(['purchase_order'])
@props(['interaction'])
@props(['budget'])
<div class="p-2">
    <x-grommet-form-attachment width="60px" />
    <form action="{{ route('attachments.upload')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="purchase_order_id" value="{{ $purchase_order->id }}">
        @if(isset($interaction))
            <input type="hidden" name="interaction_id" value="{{ $interaction }}">
        @endif
        @if(isset($budget))
            <input type="hidden" name="budget_id" value="{{ $budget }}">
        @endif
        <input type="file" name="file" id="file">
        <button type="submit">Enviar</button>
    </form>
</div>
