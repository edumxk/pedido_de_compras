<?php

namespace App\Http\Controllers;

use App\Models\Provision;
use App\Models\Purchase_order;
use Illuminate\Http\Request;

class ProvisionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(string $hashedId)
    {
        $purchaseOrder = Purchase_order::find($this->decodeHash($hashedId));
        $purchaseOrder->load('provisions');

        return view('provisions.index', compact('purchaseOrder'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if($request->provision_confirmation == 'no'){
            return back()->with('error', 'Provisão de compra não lançada!');
        }

        $request->validate([
            'purchase_order_id' => 'required',
            'provision_confirmation' => 'required',
        ]);

        $purchaseOrder = Purchase_order::find($this->decodeHash($request->purchase_order_id));
        if($purchaseOrder->status != 'provision'){
            return back()->with('error', 'Provisão de compra já lançada! Ou a compra ainda não foi aprovada.');
        }


        try{
            \DB::beginTransaction();
            $purchaseOrder->status = 'purchase';
            $purchaseOrder->save();

            $interaction = $purchaseOrder->interactions()->create([
                'user_id' => auth()->id(),
                'body' => 'Provisão de compra lançada!',
                'purchase_order_id' => $purchaseOrder->id,
            ]);

            $this->sendEmail($purchaseOrder, $interaction->id);


            \DB::commit();
            \Log::info('Provisão de compra lançada: ', ['purchase_order' => $purchaseOrder]);

        }catch (\Exception $e){
            \Log::info('Erro ao lançar a provisão de compra: ' . $e->getMessage());
            return back()->with('error', 'Erro ao confirmar lançamento a provisão de compra!');
        }

        return redirect()->route('purchase_orders.index')->with('success', 'Provisão de compra lançada com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Provision $provision)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Provision $provision)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Provision $provision)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Provision $provision)
    {
        //
    }

    public function buy(Request $request)
    {
        if($request->buy_confirmation == 'no'){
            return back()->with('error', 'Compra não realizada!');
        }

        $request->validate([
            'purchase_order_id' => 'required',
            'buy_confirmation' => 'required',
        ]);

        $purchaseOrder = Purchase_order::find($this->decodeHash($request->purchase_order_id));

        if($purchaseOrder->status != 'purchase'){
            return back()->with('error', 'Compra já realizada! Ou a compra ainda não foi aprovada.');
        }

        try{
            \DB::beginTransaction();
            $purchaseOrder->status = 'received';
            $purchaseOrder->save();

            $interaction = $purchaseOrder->interactions()->create([
                'user_id' => auth()->id(),
                'body' => 'A Compra foi realizada com sucesso! Aguardando recebimento.',
                'purchase_order_id' => $purchaseOrder->id,
            ]);

            \DB::commit();
            \Log::info('Compra Realizada: ', ['purchase_order' => $purchaseOrder]);

        }catch (\Exception $e){
            \Log::info('Erro ao lançar a Compra : ' . $e->getMessage());
            return back()->with('error', 'Erro ao confirmar lançamento da compra!');
        }

        //send email to all in the purchase order
        $this->sendEmail( $purchaseOrder, $interaction->id );

        return redirect()->route('purchase_orders.index')->with('success', 'Compra realizada com sucesso! Aguardando recebimento.');
    }

    public function received(Request $request)
    {
        if($request->received_confirmation == 'no'){
            return back()->with('error', 'Recebimento não confirmado!');
        }

        $request->validate([
            'purchase_order_id' => 'required',
            'received_confirmation' => 'required',
        ]);

        $purchaseOrder = Purchase_order::find($this->decodeHash($request->purchase_order_id));

        if($purchaseOrder->status != 'received'){
            return back()->with('error', 'Recebimento já confirmado! Ou a compra ainda não foi aprovada.');
        }

        try{
            \DB::beginTransaction();
            $purchaseOrder->status = 'finished';
            $purchaseOrder->save();

            $interaction = $purchaseOrder->interactions()->create([
                'user_id' => auth()->id(),
                'body' => 'Recebimento confirmado com sucesso!',
                'purchase_order_id' => $purchaseOrder->id,
            ]);

            \DB::commit();
            \Log::info('Recebimento confirmado: ', ['purchase_order' => $purchaseOrder]);

        }catch (\Exception $e){
            \Log::info('Erro ao confirmar o recebimento: ' . $e->getMessage());
            return back()->with('error', 'Erro ao confirmar o recebimento!');
        }

        //send email to all in the purchase order
        $this->sendEmail( $purchaseOrder, $interaction->id );

        return redirect()->route('purchase_orders.index')->with('success', 'Recebimento confirmado com sucesso!');

    }
}
