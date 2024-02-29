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
        $request->validate([
            'purchase_order_id' => 'required',
            'provision_confirmation' => 'required',
        ]);

        $purchaseOrder = Purchase_order::find($this->decodeHash($request->purchase_order_id));



        try{
            \DB::beginTransaction();
            $purchaseOrder->status = 'purchase';
            $purchaseOrder->save();

            $purchaseOrder->interactions()->create([
                'user_id' => auth()->id(),
                'body' => 'Provisão de compra lançada!',
                'purchase_order_id' => $purchaseOrder->id,
            ]);
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
}
