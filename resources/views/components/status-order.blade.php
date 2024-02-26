@props(['purchase_order'])

@if($purchase_order->status == 'approved')
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
        <strong class="font-bold">Aprovado!</strong>
        <span class="block sm:inline">Esta ordem de compra foi aprovada.</span>
    </div>
@elseif($purchase_order->status == 'rejected')
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
        <strong class="font-bold">Reprovado!</strong>
        <span class="block sm:inline">Esta ordem de compra foi reprovada.</span>
    </div>
@elseif($purchase_order->status == 'opened')
    <div class="bg-yellow-100 border border-yellow-400 text-yellow-700 px-4 py-3 rounded relative" role="alert">
        <strong class="font-bold">Pendente!</strong>
        <span class="block sm:inline">Esta ordem de compra está pendente de aprovação.</span>
    </div>
@elseif($purchase_order->status == 'budget')
    <div class="bg-blue-100 border border-blue-400 text-blue-700 px-4 py-3 rounded relative" role="alert">
        <strong class="font-bold">Em orçamento!</strong>
        <span class="block sm:inline">Esta ordem com orçamento pendente de aprovação.</span>
    </div>
@elseif($purchase_order->status == 'provision')
    <div class="bg-blue-100 border border-yellow-400 text-yellow-700 px-4 py-3 rounded relative" role="alert">
        <strong class="font-bold">Em Provisão!</strong>
        <span class="block sm:inline">Esta ordem de compra ainda não foi provisionada.</span>
    </div>
@endif
