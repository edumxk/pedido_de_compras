@props(['purchase_order'])
<div>
    <h5 class="m-5">#formulário de interação... Comentário e anexo</h5>
    @foreach($purchase_order->interactions as $interaction)
        <div class="m-5">
            <span>{{ $interaction->body }}</span>
            <span>Post: {{ date_format($interaction->created_at, 'd/m/Y H:i:s') }}</span>
        </div>
        <x-upload-attachment :purchase_order="$purchase_order" :interaction="$interaction->id" :budget="null" />
    @endforeach
    @if(isset($purchase_order->interactions))
        <x-attachment :purchase_order="$purchase_order" :type="'interaction'" />
    @endif
</div>
