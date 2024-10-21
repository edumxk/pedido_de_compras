<?php

namespace App\Http\Controllers;

use App\Http\Requests\addProductRequest;
use App\Models\Budget;
use App\Models\Product;
use App\Models\Purchase_order;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BudgetController extends Controller
{

    public function index(string|int $hashedId)
    {

        $purchase_order = Purchase_order::find($this->decodeHash($hashedId));
        $purchase_order->hashedId = $hashedId;
        $budgets = $purchase_order->budgets;

        $budgets = $budgets->map(function ($budget) {
            $budget->hashedId = $this->createHash($budget->id);
            return $budget;
        });


        $attachments = $purchase_order->attachments;
        $interactions = $purchase_order->interactions;

        return view('budgets.budgets', compact('budgets', 'purchase_order', 'attachments', 'interactions'));
    }

    public function show(string|int $hashedId)
    {
        if(!Auth::user()->is_buyer)
            return redirect()->back()->with('error', 'Você não tem permissão para criar orçamentos');
        //$categories = Category::all();
        //$products = Product::all();
        $suppliers = Supplier::all();

        return view('budgets.create', compact('suppliers', 'hashedId'));

    }

    public function store(Request $request)
    {
        if(!Auth::user()->is_buyer)
            return redirect()->back()->with('error', 'Você não tem permissão para criar orçamentos');

        $request->validate([
            'supplier_id' => 'required',
            'purchase_order_id' => 'required',
        ]);

        try{
            $purchase_order = Purchase_order::find($this->decodeHash($request->purchase_order_id));

            //add userid to the request
            $request->merge([
                'user_id' => auth()->id(),
                'status' => 'pending',
                'payment_id' => null,
                'purchase_order_id' => $purchase_order->id,
            ]);

            $budget = Budget::create($request->all());

            if($purchase_order->status == 'approved'){
                $purchase_order->status = 'budget';
                $purchase_order->save();
            }

        }catch (\Exception $e){
            \Log::error('Erro ao criar orçamento: '.$e->getMessage());
            return redirect()->back()->with('error', 'Erro ao criar orçamento: '.$e->getMessage());
        }
        //send email to admin 5 min after create a budget
        try {
            $this->sendEmail( $purchase_order );
        }catch (\Exception $e){
            \Log::error('Erro ao enviar email no orçamento: '.$e->getMessage());
        }
        \Log::info('Orçamento criado com sucesso');
        return redirect()->route('budgets.products', $this->createHash($budget->id) );
    }

    public function products(string|int $hashedId)
    {
        if(!Auth::user()->is_buyer )
            return redirect()->back()->with('error', 'Você não tem permissão para editar orçamentos');

        $budget = Budget::find($this->decodeHash($hashedId));
        if ($budget == null)
            return redirect()->route('purchase_orders.index')->with('error', 'Orçamento não encontrado');


        if($budget->status != 'pending')
            return redirect()->back()->with('error', 'Não é permitido alterar um orçamento já aprovado');

        $products = Product::all();
        $products = $products->map(function ($product) {
            $product->hashedId = $this->createHash($product->id);
            return $product;
        });

        $budget->hashedId = $hashedId;
        if($budget->products == null || $budget->products->isEmpty ){
            $budget->products = [];
            $hashedId = $this->createHash($budget->purchase_order->id);
            return view('budgets.products', compact('budget', 'products', 'hashedId'));
        }

        $budget->products = $budget->products->map(function ($product) {
            $product->hashedId = $this->createHash($product->id);
            return $product;
        });
        return view('budgets.products', compact('budget', 'products', 'hashedId'));
    }

    public function storeProducts(addProductRequest $request)
    {

        $budget = Budget::find($this->decodeHash($request->budget_id));
        $price = [
            'budget_id' => $budget->id,
            'product_id' => $request->product_id,
            'quantity' => str_replace(',', '.', $request->quantity),
            'price' => str_replace(',', '.', $request->price),
            'supplier_id' => $budget->supplier_id,
        ];

        $message = $budget->prices()->create($price);
        return redirect()->route('budgets.products', $request->budget_id)->with('message', 'Product added to budget successfully');
    }

    public function deleteProduct(Request $request)
    {
        $price = Budget::find($this->decodeHash($request->budget_id))->prices->where('product_id', $request->product_id)->first();
        $message = $price->delete();
        return redirect()->route('budgets.products', $request->budget_id)->with('$message', 'Product removed from budget successfully');
    }

    public function approve(Request $request)
    {
        //if user is not admin, redirect to home
        if (!auth()->user()->is_admin)
            return redirect()->back()->with('error', 'Você não tem permissão para aprovar orçamentos');

        \DB::enableQueryLog(); // Ativar o log de consultas
        \DB::beginTransaction();
        try {
            $budget = Budget::find($this->decodeHash($request->budget_id));
            $purchase_order = Purchase_order::find($budget->purchase_order_id);
            $budget->status = 'approved';
            $budget->user_id = auth()->id();
            $purchase_order->status = 'provision';
            \Log::info('Salvando Status: '. $purchase_order->save());
            //inicia transação db e dar rollback caso tenha erros

            foreach ($purchase_order->budgets as $budget) {
                if($request->budget_id == $this->createHash($budget->id))
                    $budget->status = 'approved';
                //else
                   // $budget->status = 'rejected';
                $budget->save();
                \Log::info('Salvando Status do Orçamento: '.$budget->status . '|budget_id: '.$budget->id);

                foreach ($budget->payments as $payment) {
                    if($request->payment_id == $payment->id){
                        $payment->status = 'approved';
                        $payment->save();
                        \log::info('pagamentos alterados: '.$payment->status . '|payment_id: '.$payment->id);
                    }
                    else{
                        if($request->budget_id == $this->createHash($payment->budget_id)){
                            $payment->status = 'rejected';
                            $payment->save();
                            \log::info('pagamentos alterados: '.$payment->status . '|payment_id: '.$payment->id);
                        }
                    }
                    \log::info('pagamentos alterados: '.$payment->status);
                }
            }
            \DB::commit();
        } catch (\Exception $e) {
            \DB::rollback();
            return redirect()->back()->with('error', 'Error approving budget');
        }

        //create a interaction of the approval
        $interaction = $purchase_order->interactions()->create([
            'user_id' => auth()->id(),
            'body' => 'Orçamento aprovado! Liberado para Compra.',
        ]);
        //send email to all in the purchase order
        $this->sendEmail( $purchase_order, $interaction->id );

        return redirect()->back()->with('message', 'Orçamento aprovado com sucesso');
    }

    public function cancelApprove(Request $request)
    {
        //if user is not admin, redirect to home
        if (!auth()->user()->is_admin)
            return redirect()->back()->with('error', 'Você não tem permissão para cancelar aprovação de orçamentos');

        try {
            \DB::enableQueryLog(); // Ativar o log de consultas
            \DB::beginTransaction();
            $purchase_order = Purchase_order::find($this->decodeHash($request->purchase_order_id));
            $purchase_order->status = 'budget';
            \Log::info('Salvando Status: ' . $purchase_order->save());
            //inicia transação db e dar rollback caso tenha erros

            foreach ($purchase_order->budgets as $budget) {
                    $budget->status = 'pending';
                $budget->save();
                \Log::info('Salvando Status do Orçamento: ' . $budget->status . '|budget_id: ' . $budget->id);

                foreach ($budget->payments as $payment) {
                    $payment->status = 'pending';
                    $payment->save();
                    \log::info('pagamentos alterados: ' . $payment->status . '|payment_id: ' . $payment->id);
                }
            }
            \DB::commit();
        } catch (\Exception $e) {
            \DB::rollback();
            return redirect()->back()->with('error', 'Error canceling budget approval');
        }

        //create a interaction of the approval
        $interaction = $purchase_order->interactions()->create([
            'user_id' => auth()->id(),
            'body' => 'Aprovação do orçamento cancelada. Verificar com o administrador.',
        ]);

        //send email to all in the purchase order
        $this->sendEmail( $purchase_order, $interaction->id );


        return redirect()->back()->with('message', 'Aprovação do orçamento cancelada com sucesso');
    }
}
